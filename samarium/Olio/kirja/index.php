<?php
require "kirja.php";

$kirjat = array();
array_push($kirjat,new Kirja("Maan alla", "Elly Griffiths", 27.95));

require "kirja.view.php";
?>
