<?php
    require "./yhteys.php";

    $luku = $_REQUEST["race"];
    $hahmo = "SELECT * FROM characters WHERE raceID=?";

    $stm = $pdo->prepare($hahmo);
    
    $stm->bindValue(1, $luku);
    $stm->execute();

    $rows = $stm->fetchALL();
    $str = "";
    //error_reporting(0);
    foreach ($rows as $row) {
    $str = $str . "<h3>" . $row["characterID"] . "</h3><p>" . $row["name"] . "</p>";
    }
    echo $str;
?>