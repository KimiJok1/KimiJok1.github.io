<?php
require "./database/models/Player.php";
require "./helpers/helper.php";

function indexcontroller()
{
    $players = getAllPlayers();
    require "./views/index.view.php";
}

function admincontroller()
{
    $players = getAllPlayers();
    require "./views/admin.view.php";
}

function postregistercontroller()
{
    if(isset($_POST["nickname"],$_POST["password"],$_POST["password2"],$_POST["email"],$_POST["character"])  &&  $_POST["password"] === $_POST["password2"])   {
        $nickname = sanit($_POST["nickname"]);
        $password = sanitpassword($_POST["password"]);
        $email = sanit($_POST["email"]);
        $current_character = sanit($_POST["character"]);
        $lastLogin = date('Y-m-d');

        $data = array($nickname,$password,$email,$current_character,$lastLogin); 

        $ok = addPlayer($data);

        if($ok) {
            $message = "Rekisteröinti onnistui";
            $players = getAllPlayers();
            require "./views/index.view.php";
        }
        else {
            $message = "Rekisteröinti ei onnistu...";
            require "./views/registerform.view.php";
        }
    } else {
        $message = "Tiedoissa vikaa...";
        require "./views/registerform.view.php";
    }
}

function postlogincontroller()
{
   if(isset($_POST["nickname"],$_POST["password"]))  {
       $nickname = sanit($_POST["nickname"]);
       $password = sanit($_POST["password"]);

       $ok = loginPlayer($nickname,$password);

       if($ok) {
           $player =getPlayerByNickname($nickname);
           $id = $player[0]["playerID"];
           $ip = $_SERVER["REMOTE_ADDR"];

           $_SESSION["id"] = $id;
           $_SESSION["ip"] = $ip;

           $players = getAllPlayers();
           require "./views/admin.view.php";
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

function deleteplayercontroller()
{
    if(isset($_GET["playerID"])) {
        $playerID = $_GET["playerID"];
        if(deletePlayer($playerID)) $message="Pelaaja on poistettu";
        else $message="Pelaaja ei poistunut";
        $players = getAllPlayers();
        require "./views/admin.view.php";
    } else header("Location:./index.php?action=admin");
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
        require "./admin.view.php";
    }
}

function posteditplayercontroller()
{
    if(isset($_POST["playerID"],$_POST["nickname"],$_POST["email"],$_POST["character"])) {
        $playerID = $_POST["playerID"];
        $nickname = sanit($_POST["nickname"]);
        $email = sanit($_POST["email"]);
        $current_character = sanit($_POST["character"]);
        if(isset($_POST["banned"])) $banned = 1;
        else $banned=0; 

        $data = array($nickname,$email,$current_character,$banned,$playerID);

        if(editPlayer($data)) {
            $message = "Muokkaus on tehty";

        } else {
            $message = "Muokkaus ei onnistunut";  
        }
    } else { 
        $message = "Lomakkeelta puuttuu tietoja";         
    }
    $players = getAllPlayers();
    require "./views/admin.view.php";
}

?>