<?php
require "./database/models/kayttaja.php";
require "./database/models/uutinen.php";
require "./helpers/helper.php";

function indexcontroller()
{
    $uutiset = getAllNews();
    require "./views/index.view.php";
}

function admincontroller()
{
    $uutiset = getAllNews();
    $users = getAllUsers();
    require "./views/admin.view.php";
}


function deletenewscontroller()
{
    if(isset($_GET["uutinenID"])) {
        $uutinenID = $_GET["uutinenID"];
        if(deleteNews($uutinenID)) $message="Uutinen on poistettu";
        else $message="Uutinen ei poistunut";
        $uutiset = getAllNews();
        $users = getAllUsers();
        require "./views/admin.view.php";
    } else header("Location:./index.php?action=admin");
}

function getaddnewscontroller()
{   
    require "./views/lisaauutinenform.view.php";
}

function addnewscontroller()
{
    $uutiset = getAllNews();
    $users = getAllUsers();
    if(isset($_POST["otsikko"],$_POST["sisalto"],$_POST["kirjoittaja"],$_POST["deletion_date"]))   {
        $data = array($_POST["otsikko"],$_POST["sisalto"],$_POST["deletion_date"],$_POST["kirjoittaja"]);
        if(addNews($data)) {
            $message = "Uutinen on lisätty";
        } else {
            $message = "Uutisen lisääminen ei onnistunut";  
        }
        $uutiset = getAllNews();
        $users = getAllUsers();
        require "./views/admin.view.php";
    } else {
        if(isset($_GET["uutinenID"])) {
            $uutinenID = $_GET["uutinenID"];
            $uutinen = getNewsById($uutinenID);
            require "./views/muokkaauutistaform.view.php";
        }
    }
}

function geteditnewscontroller()
{
    if(isset($_GET["uutinenID"])) {
        $uutinenID = $_GET["uutinenID"];
        $uutinen = getNewsById($uutinenID);
        require "./views/muokkaauutistaform.view.php";
    } else {
        $message="Ei valittuna uutista";
        $players = getAllPlayers();
        require "./admin.view.php";
    }
}

function editnewscontroller()
{
    $uutiset = getAllNews();
    $users = getAllUsers();
    if(isset($_POST["otsikko"],$_POST["sisalto"]))   {
        $data = array($_POST["otsikko"],$_POST["sisalto"],$_GET["uutinenID"]);
        if(editNews($data)) {
            $message = "Muokkaus on tehty";
        } else {
            $message = "Muokkaus ei onnistunut";  
        }
        $uutiset = getAllNews();
        $users = getAllUsers();
        require "./views/admin.view.php";
    } else {
        if(isset($_GET["uutinenID"])) {
            $uutinenID = $_GET["uutinenID"];
            $uutinen = getNewsById($uutinenID);
            require "./views/muokkaauutistaform.view.php";
        }
    }
}

function shownewscontroller()
{
    if(isset($_GET["uutinenID"])) {
        $uutinen = getNewsById($_GET["uutinenID"]);
        require "./views/uutinen.view.php";
    } else header("Location:./index.php");
}


function postregistercontroller()
{
    if(isset($_POST["username"],$_POST["password"],$_POST["password2"])  &&  $_POST["password"] === $_POST["password2"])   {
        $username = sanit($_POST["username"]);
        $password = sanitpassword($_POST["password"]);

        $data = array($username,$password); 

        $ok = adduser($data);

        if($ok) {
            $message = "Rekisteröinti onnistui";
            $uutiset = getAllNews();
            require "./views/index.view.php";
        }
        else {
            $message = "Rekisteröinti ei onnistu...";
            require "./views/rekisteroidyform.view.php";
        }
    } else {
        $message = "Tiedoissa vikaa...";
        require "./views/rekisteroidyform.view.php";
    }
}

function postlogincontroller()
{
   if(isset($_POST["username"],$_POST["password"]))  {
       $username = sanit($_POST["username"]);
       $password = sanit($_POST["password"]);

       $ok = loginuser($username,$password);

       if($ok) {
            $user = getuserByusername($username);
            $id = $user[0]["kayttajaID"];
            $ip = $_SERVER["REMOTE_ADDR"];

            $_SESSION["id"] = $id;
            $_SESSION["ip"] = $ip;

            $users = getAllUsers();
            $uutiset = getAllNews();
            require "./views/admin.view.php";
       } else {
           $message = "Käyttäjää ei löydy";
           require "./views/kirjauduform.view.php";
       }
   } else {
       $message = "Täytä kaikki tiedot!";
       require "./views/kirjauduform.view.php";
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

function deleteusercontroller()
{
    if(isset($_GET["kayttajaID"])) {
        $kayttajaID = $_GET["kayttajaID"];
        if(deleteuser($kayttajaID)) $message="Käyttäjä on poistettu";
        else $message="Käyttäjä ei poistunut";
        $users = getAllUsers();
        require "./views/admin.view.php";
    } else header("Location:./index.php?action=admin");
}

?>