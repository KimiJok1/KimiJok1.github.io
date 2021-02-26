<?php
    $luku1 = 0;
    $luku2 = "0";
    $luku3 = -1;
    $luku4 = 1;
    $luku5 = 100;

    if ($luku1 == 0) {
        echo "nolla<br>";
    };
    if ($luku2 == 0) {
        echo "nolla<br>";
    };
    if ($luku2 < $luku4) {
        echo "luku 2 on pienempi<br>";
    } else {
        echo "luku 2 ei ole pienempi<br>";
    };
    if ($luku1 < $luku4 && $luku4 < $luku5) {
        echo "välissä<br>";
    }
    if ($luku1 > $luku4 || $luku4 > $luku5) {
        echo "reunassa<br>";
    } else {
        echo "ok<br>";
    }
    var_dump($luku1);
    var_dump($luku2);
?>