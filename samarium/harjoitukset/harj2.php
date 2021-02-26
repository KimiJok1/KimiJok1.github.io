<?php
    date_default_timezone_set('UTC');

    $aidinika = 30;
    $isanika = 34;
    $lapsenika = 4;

    echo "Iät yhtensä on " . ($aidinika + $isanika + $lapsenika) . "<br>";
    echo "Äiti oli " . ($aidinika - $lapsenika) . " kun hän sai lapsen<br>";
    echo "Isä syntyi vuonna " . (date("Y") - $isanika) . "<br><br>";

    $alv = 0.24;

    echo "Arvonlisävero hinnalle 10€ on " . (10 * $alv) . "€<br>";
    echo "Arvonlisävero hinnalle 20€ on " . (20 * $alv) . "€<br>";
    echo "Arvonlisävero hinnalle 35.5€ on " . (35.5 * $alv) . "€<br>";
    echo "Arvonlisävero hinnalle 1.8€ on " . (1.8 * $alv) . "€<br>";
?>