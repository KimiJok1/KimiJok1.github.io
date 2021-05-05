<?php
require "./database/models/kayttaja.php";

/***************************************** */

$data = array("untoliini","pasusasa");
$ok = addUser($data);
if($ok) echo "Lisätty";
else echo "Ei onnaa";

/*************************************** */

/*$ok = deletePlayer(8);
if($ok) echo "Poistettu";
else echo "Ei onnaa";
?>*/