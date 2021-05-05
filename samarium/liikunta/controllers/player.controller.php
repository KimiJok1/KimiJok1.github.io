<?php
require "./database/models/Player.php";
require "./helpers/helper.php";

function indexcontroller()
{
    $players = getAllPlayers();
    $sports = getAllSports();
    $entries = getAllEntries();
    require "./views/index.view.php";
}

function admincontroller()
{
    $players = getAllPlayers();
    $sports = getAllSports();
    $entries = getAllEntries();
    require "./views/admin.view.php";
}

function createcontroller()
{
    require "./views/create.view.php";
}

function postcreatecontroller()
{
    if ($_GET["type"] == "entry") {
        if(isset($_POST["user"],$_POST["sport"],$_POST["time"],$_POST["intensity"],$_POST["length"])) {
            $user = $_POST["user"];
            $sport = $_POST["sport"];
            $time = $_POST["time"];
            $intensity = $_POST["intensity"];
            $length = $_POST["length"];
    
            $data = array($user,$sport,$time,$intensity,$length);
            $ok = addEntry($data);
    
            if($ok) {
                $message = "Merkintä lisätty";
    
            } else {
                $message = "Merkinnän lisääminen ei onnistunut";  
            }
        } else { 
            $message = "Lomakkeelta puuttuu tietoja";      
        }
        $players = getAllPlayers();
        $sports = getAllSports();
        $entries = getAllEntries();
        require "./views/admin.view.php";
    } else if ($_GET["type"] == "sport") {
        if(isset($_POST["name"])) {
            $name = $_POST["name"];
    
            $data = array($name);
            $ok = addSport($data);
    
            if($ok) {
                $message = "Merkintä lisätty";
    
            } else {
                $message = "Merkinnän lisääminen ei onnistunut";  
            }
        } else { 
            $message = "Lomakkeelta puuttuu tietoja";      
        }
        $players = getAllPlayers();
        $sports = getAllSports();
        $entries = getAllEntries();
        require "./views/admin.view.php";
    } else if ($_GET["type"] == "user") {
        if(isset($_POST["name"],$_POST["password"],$_POST["password2"],$_POST["email"])  &&  $_POST["password"] === $_POST["password2"])   {
            $name = sanit($_POST["name"]);
            $password = sanitpassword($_POST["password"]);
            $email = sanit($_POST["email"]);
    
            $data = array($name,$password,$email); 
    
            $ok = addPlayer($data);
    
            if($ok) {
                $message = "Rekisteröinti onnistui";
            }
            else {
                $message = "Rekisteröinti ei onnistu.";
            }
        } else {
            $message = "Tiedoissa vikaa";
        }
        $players = getAllPlayers();
        $sports = getAllSports();
        $entries = getAllEntries();
        require "./views/admin.view.php";
    } else {
        $players = getAllPlayers();
        $sports = getAllSports();
        $entries = getAllEntries();
        require "./views/admin.view.php";
    }
}

function postregistercontroller()
{
    if(isset($_POST["name"],$_POST["password"],$_POST["password2"],$_POST["email"])  &&  $_POST["password"] === $_POST["password2"])   {
        $name = sanit($_POST["name"]);
        $password = sanitpassword($_POST["password"]);
        $email = sanit($_POST["email"]);

        $data = array($name,$password,$email); 

        $ok = addPlayer($data);

        if($ok) {
            $message = "Rekisteröinti onnistui";
            $players = getAllPlayers();
            $sports = getAllSports();
            $entries = getAllEntries();
            require "./views/index.view.php";
        }
        else {
            $message = "Rekisteröinti ei onnistu.";
            require "./views/registerform.view.php";
        }
    } else {
        $message = "Tiedoissa vikaa";
        require "./views/registerform.view.php";
    }
}

function postlogincontroller()
{
   if(isset($_POST["name"],$_POST["password"]))  {
       $name = sanit($_POST["name"]);
       $password = sanit($_POST["password"]);

       $ok = loginPlayer($name,$password);

       if($ok) {
            $player = getPlayerByname($name);
            $id = $player[0]["pid"];
            $ip = $_SERVER["REMOTE_ADDR"];

            $_SESSION["id"] = $id;
            $_SESSION["ip"] = $ip;

            $players = getAllPlayers();
            $sports = getAllSports();
            $entries = getAllEntries();
            if ($player[0]["admin"] == 1) {
                require "./views/admin.view.php";
            } else {
                require "./views/index.view.php";
            }
       } else {
           $message = "Käyttäjää ei löydy";
           require "./views/loginform.view.php";
       }
   } else {
       $message = "Täytä kaikki tiedot!";
       require "./views/loginform.view.php";
   }
}

function logoutcontroller()
{
    if(isset($_SESSION["ip"],$_SESSION["id"]))  {
        session_unset(); 
        session_destroy();
        header("Location:./index.php");
    } else header("Location:./index.php");
}

function deletecontroller()
{
    if (isset($_GET["mid"])) {
        $ok = deleteEntry($_GET["mid"]);
        if ($ok) {
            header("Location:./index.php?action=admin");
        } else {
            echo "oog";
        }
    } else if (isset($_GET["pid"])) {
        $ok = deletePlayer($_GET["pid"]);
        if ($ok) {
            header("Location:./index.php?action=admin");
        } else {
            echo "oog";
        }
    } else if (isset($_GET["lid"])) {
        $ok = deleteSport($_GET["lid"]);

        if ($ok) {
            header("Location:./index.php?action=admin");
        } else {
            echo "oog";
        }
    } else {
        header("Location:./index.php?action=admin");
    }
}

function editcontroller()
{
    if (isset($_GET["mid"])) {
        $type = "entry";
        require "./views/edit.view.php";
    } else if (isset($_GET["pid"])) {
        $type = "user";
        require "./views/edit.view.php";
    } else if (isset($_GET["lid"])) {
        $type = "sport";
        require "./views/edit.view.php";
    } else {
        header("Location:./index.php?action=admin");
    }
}

function posteditcontroller()
{
    if (isset($_POST["mid"])) {
        if(isset($_POST["user"],$_POST["sport"],$_POST["time"],$_POST["intensity"],$_POST["length"])) {
            $user = $_POST["user"];
            $sport = $_POST["sport"];
            $time = $_POST["time"];
            $intensity = $_POST["intensity"];
            $length = $_POST["length"];
    
            $data = array($user,$sport,$time,$intensity,$length);
    
            if(editPlayer($data)) {
                $message = "Muokkaus on tehty";
    
            } else {
                $message = "Muokkaus ei onnistunut";  
            }
        } else { 
            $message = "Lomakkeelta puuttuu tietoja";         
        }
        $players = getAllPlayers();
        $sports = getAllSports();
        $entries = getAllEntries();
        require "./views/admin.view.php";
    }
}

function geteditplayercontroller()
{
    if(isset($_GET["playerID"])) {
        $playerID=$_GET["playerID"];
        $player = getPlayerById($playerID);
        require "./views/editplayerform.view.php";
    } else {
        $message="Ei valittuna pelaajaa";
        $players = getAllPlayers();
        $sports = getAllSports();
        $entries = getAllEntries();
        require "./admin.view.php";
    }
}

function posteditplayercontroller()
{
    if(isset($_POST["playerID"],$_POST["name"],$_POST["email"],$_POST["character"])) {
        $playerID = $_POST["playerID"];
        $name = sanit($_POST["name"]);
        $email = sanit($_POST["email"]);
        $current_character = sanit($_POST["character"]);
        if(isset($_POST["banned"])) $banned = 1;
        else $banned=0; 

        $data = array($name,$email,$current_character,$banned,$playerID);

        if(editPlayer($data)) {
            $message = "Muokkaus on tehty";

        } else {
            $message = "Muokkaus ei onnistunut";  
        }
    } else { 
        $message = "Lomakkeelta puuttuu tietoja";         
    }
    $players = getAllPlayers();
    $sports = getAllSports();
    $entries = getAllEntries();
    require "./views/admin.view.php";
}

?>