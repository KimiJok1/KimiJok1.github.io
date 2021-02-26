<?php
// poista.php
require "./yhteys.php";
 
if (isset($_GET["id"])) {
$sql = "DELETE FROM h10_tapahtumat WHERE tapahtumaID=?";
$data = array($_GET["id"]);
$stmt = $pdo->prepare($sql);
$stmt->execute($data);
header('Location: ../partials/index.php?sivu=harj10&kansio=harjoitukset');
exit;
}
?>