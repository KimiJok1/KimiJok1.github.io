<?php
session_start(); 

if(isset($_GET["action"])) $action = $_GET["action"];
else $action = "index";

$method = strtolower($_SERVER["REQUEST_METHOD"]); 
require "./controllers/player.controller.php";
require "./helpers/auth.php";

switch($action) {

    case "index":
    indexcontroller();
    break;

    case "register":
    if($method=="get")
    require "./views/registerform.view.php";
    else postregistercontroller();
    break;

    case "login":
    if($method =="get")
    require "./views/loginform.view.php";
    else postlogincontroller();
    break;

    case "admin":
    if(islogged()) {
        admincontroller();
    } else require "./views/loginform.view.php";
    break;

    case "logout":
    if(islogged()) {
        logoutcontroller();
    } else indexcontroller();
    break;

    case "delete":
    if(islogged()) {
        deletecontroller();
    } else require "./views/loginform.view.php";
    break;

    case "edit":
    if(islogged()) {
        if($method == "get") {
            editcontroller();
        } else posteditcontroller();
    } else require "./views/loginform.view.php";
    break;

    case "editplayer":
    if(islogged()) {
        if($method == "get") {
            geteditplayercontroller();
        }
        else posteditplayercontroller();
    } else require "./views/loginform.view.php";
    break;

    case "create":
    if(islogged()) {
        if($method == "get") {
            createcontroller();
        }
        else postcreatecontroller();
    }
    else require "./views/loginform.view.php";
    break;

    default:
    echo "404";
    exit;
}