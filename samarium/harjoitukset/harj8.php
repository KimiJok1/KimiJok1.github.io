<?php
    echo "<h2>8.1</h2>";

    echo date("h:i:sa");
    echo "<br>";
    echo date("Y-m-d");
    echo "<br>";
    echo date("l");

    echo "<h2>8.2</h2>";
    echo mktime(12,45,0,2,2,2022);

    echo "<h2>8.3</h2>";

    function palautaPvm() {
        return date("d.m.Y") . "<br>";
    }

    function laskeLoppumisPvm($paivia) {
        $date = date("d.m.Y");
        return date("d.m.Y", strtotime($date."+ $paivia days")) . "<br>";
    }

    echo palautaPvm();
    echo laskeLoppumisPvm(5);

    echo "<h2>8.4</h2>";

    function onVokaali($kirjain) {
        $vokaalit = array("A","E","I","O","U","Y","Ä","Ö");
        if (in_array(strtoupper($kirjain),$vokaalit)) {
            return " $kirjain on vokaali <br>";
        } else {
            return "$kirjain ei ole vokaali <br>";
        }
    }

    function sanitize_name($name) {
        trim($name," \n\r\t\v\0" );
    }

    echo onVokaali("A");
    echo onVokaali("B")
?>