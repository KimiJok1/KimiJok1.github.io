<h1>Tapahtumat</h1>

<?php
    if (isset($_POST["add"])) {
        header('Location: ../harjoitukset/create.php');
    }
?>

<form method="post">
    <input type="submit" name="add" value="Lisää tapahtuma"/>
</form>

<?php
    require "yhteys.php";

    $sql = "SELECT * FROM h10_tapahtumat WHERE paivays > now() ORDER BY paivays ASC";

    $stmt = $pdo->query($sql);  
    $rows = $stmt->fetchAll();



    echo "<table>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row["tapahtumaID"] . "</td>";
        echo "<td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["paivays"] . "</td>";
        echo "<td><a href='../harjoitukset/poista.php?id=" . $row["tapahtumaID"] . "'>delete</a> <a href='../harjoitukset/muokkaa.php?id=" . $row["tapahtumaID"] . "'>edit</a></td>";
        echo "</tr>";
    }
    echo "</table>";
?>