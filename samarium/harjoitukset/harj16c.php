<?php
    require "./yhteys.php";
    $haku = $_REQUEST["haku"];
    $sql = "SELECT * FROM uutinen WHERE otsikko LIKE '%$haku%'";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    $name = "";

    foreach($rows as $row) {
        $name = $name . "<h2>" . $row["otsikko"] . "</h2><p>" . $row["sisalto"] . "</p>";
    }

    echo $name;
?>