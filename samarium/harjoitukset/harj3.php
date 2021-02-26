<html>
    <?php
        echo "<h2>3.1</h2>";
        echo "Voittajanumero on " . rand(1,1000) . " <br>";

        echo "<h2>3.2</h2>";
        echo "1.5 pyöristettynä alaspäin on " . floor(1.5) .  "<br>";
        echo "1.456 pyöristettynä ylöspäin kahden desimaalin tarkkuudella on " . round(1.456,2) . "<br>";
        echo "68995 kymmenien tarkkuudella on " . round(68995, -1) . "<br>";
        echo "124.558 satojen tarkkuudella on " . round(124.558, -2) . "<br>";
        echo "3.14 pyöristettynä ylöspäin kokonaisluvuksi on " . ceil(3.14) . "<br>";

        echo "<h2>3.3</h2>";
        $juu = rand(1,20);
        if($juu % 2 == 0) {
            echo "Parillinen<br>";
        } else {
            echo "Pariton<br>";
        }

        echo "<h2>3.4</h2>";

        $juu2 = rand(1,100);
        if($juu2 < 50 && $juu2 > 30) {
            echo $juu2 . ", pienehkö<br>";
        }
        else if($juu2 < 10 || $juu2 > 90) {
            echo $juu2 . ", ääriarvo<br>";
        }
        else if($juu2 < 50 || $juu2 % 2 == 0) {
            echo $juu2 . ", pieni ja parillinen<br>";
        }
        else if($juu2 != 35) {
            echo $juu2 . ", ei 35<br>";
        }
        else {
            echo $juu2;
        }
        echo "<h2>3.5</h2>";
        if (sqrt(146) > 3^3){
            echo "146:den neliöjuuri on suurempi";
        } else {
            echo "3 potenssiin 3 on suurempi" ;
        }
        echo "<br>";
        if (165 % 8 > hexdec("03")){
            echo "165:den jakojäännös on suurempi";
        } else {
            echo "Hexadesimaali 03 on suurempi" ;
        }
        echo "<br>";
        if (hexdec("AF") > 155 && hexdec("AF") > 5 ^3){
            echo "Hexadesimaali AF on suurin";
        } else if (5 ^3 > 155 && 5 ^3 >hexdec("AF")){
            echo "5 potenssiin 3 on suurin";
        } else {
            echo "155 on suurin" ;
        }
    ?>
</html>