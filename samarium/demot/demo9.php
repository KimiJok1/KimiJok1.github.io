<?php
    require "yhteys.php";

    $sql = "SELECT * FROM games";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    echo "<table border='1'>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row["gameid"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["company"] . "</td>";
        echo "<td>" . $row["release"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>