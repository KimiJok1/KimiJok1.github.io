<?php
    require "../demot/yhteys.php";

    $sql = "SELECT * FROM musiikkityylit";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    echo "<ul>";
    foreach ($rows as $row) {
        echo "<li>" . $row["Tyyli"] . "</li>";
    }
    echo "</ul>";

    $sql = "SELECT * FROM renkaat";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    echo "<table border='1'>";
    echo "<tr>";
    echo "<td>Merkki</td>";
    echo "<td>Malli</td>";
    echo "<td>Tyyppi</td>";
    echo "<td>Koko</td>";
    echo "<td>Hinta</td>";
    echo "<td>Saldo</td>";
    echo "</tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row["Merkki"]. "</td>";
        echo "<td>" . $row["Malli"]. "</td>";
        echo "<td>" . $row["Tyyppi"]. "</td>";
        echo "<td>" . $row["Koko"]. "</td>";
        echo "<td>" . $row["Hinta"]. "</td>";
        echo "<td>" . $row["Saldo"]. "</td>";
        echo "</tr>";
    }
    echo "</table>"
?>