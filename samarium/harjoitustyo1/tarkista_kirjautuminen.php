<?php
require "./tietokanta/tkfunktiot.php";
require "./kirjastot/funktiot.php";
if(!empty($_POST["ktunnus"]) && !empty($_POST["salasana"])) {
    $ktunnus = $_POST["ktunnus"];
    $salasana = $_POST["salasana"];
    $ktunnus = putsaa($ktunnus);
    $salasana=muunna_salasana($salasana);

    require "./tietokanta/yhteys.php";
    $id = hae_id_kannasta($ktunnus,$salasana);
    if(!empty($id)) {
        session_start();
        $_SESSION["kid"] = $id;
        $_SESSION["istuntoid"] = session_id();
        $_SESSION["salasana"]=$salasana;
        header("Pragma: No-Cache");
        header("Location: admin.php");
        die();
    }
    else header("Location: index.php?sivu=kirjaudu&vaarin=true");
}
else header("Location: index.php?sivu=kirjaudu&puuttuu=true");