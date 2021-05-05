<?php
session_start(); 

if(isset($_GET["action"])) $action = $_GET["action"];
else $action = "index";

$method = strtolower($_SERVER["REQUEST_METHOD"]); 
require "./controllers/kayttaja.controller.php";
require "./helpers/auth.php";

switch($action) {

    case "index":
    indexcontroller();
    break;

    case "register":
    if($method=="get")
    require "./views/rekisteroidyform.view.php";
    else postregistercontroller();
    break;

    case "login":
    if($method =="get")
    require "./views/kirjauduform.view.php";
    else postlogincontroller();
    break;

    case "edit":
    if(islogged()) {
        editnewscontroller();
    } else require "./views/kirjauduform.view.php";
    break;

    case "admin":
    if(islogged()) {
        admincontroller();
    } else require "./views/kirjauduform.view.php";
    break;

    case "logout":
    if(islogged()) {
        logoutcontroller();
    } else indexcontroller();
    break;

    case "deleteuser":
    if(islogged()) {
        deleteusercontroller();
    } else require "./views/kirjauduform.view.php";
    break;

    case "shownews":
    shownewscontroller();
    break;

    case "addnews":
    if($method =="get") {
        getaddnewscontroller();
    } else addnewscontroller();
    break;

    case "editnews":
    if($method =="get") {
        geteditnewscontroller();
    } else editnewscontroller();
    break;

    case "deletenews":
    if(islogged()) {
        deletenewscontroller();
    } else require "./views/kirjauduform.view.php";
    break;

    default:
    echo "404";
}