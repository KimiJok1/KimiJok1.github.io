<?php
require "./yhteys.php";
 
if (isset($_POST["nimi"], $_POST["paivays"], $_POST["tapahtumaID"])) {
    $nimi = $_POST["nimi"];
    $paivays = $_POST["paivays"];
    $tapahtumaID = $_POST["id"];
    $data = array($_POST["nimi"], $_POST["paivays"], $_POST["tapahtumaID"]);
    $sql = "INSERT INTO h10_tapahtumat values('?', '$nimi','$paivays')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    header('Location: ../partials/index.php?sivu=harj10&kansio=harjoitukset');
    exit;
}
 
?>
<h2>Luo tapahtuma</h2>
<form method="post">
    <input type="text" placeholder="Nimi" name="nimi" /><br>
    <input type="date" placeholder="" name="paivays" /><br>
    <input type="hidden" name="tapahtumaID" value="" />
    <input type="submit" value="Save" /><br>
</form>