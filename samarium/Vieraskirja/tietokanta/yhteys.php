<?php
    $host ="localhost";
    $user = "20jokkim";
    $pass = "U2FsYW1hNTY3IQ==";
    $dbname = "20jokkim";

    try //yritetään ottaa yhteys
    { 
        $yhteys = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,  base64_decode($pass)); 
        //luo PDO-olion
    } 
    catch(PDOException $e) // jos ei onnistu (poikkeus)
    { 
        echo $e->getMessage(); //antaa ilmoituksen siitä, missä virhe
    }
?>