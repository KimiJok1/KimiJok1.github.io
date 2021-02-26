<html>
    <?php
        echo "<h1>Hello world!</h1>";
        echo "<p>\"Kun hyppäät ilosta ilmaan,<br> varo,<br> ettei kukaan vedä maata jalkojesi alta (Stanislaw Jerzy Lec)\"</p>";

        $omanimi = "Kimi";
        echo "Kirjoittajan nimi on $omanimi <br>";

        $luku1 = 5;
        $summa = $luku1 + $luku1;
        $erotus = $luku1 - $luku1;
        $tulo = $luku1 * $luku1;

        echo "Luku = $luku1<br>";
        echo "Summa = $summa<br>";
        echo "Erotus = $erotus<br>";
        echo "Tulo = $tulo<br>";

        $vaalea = 10;
        $tumma = 30;
        define("SUOJAKERROIN_25",25);
        define("SUOJAKERROIN_50",50);

        $vaalean_aika_25 = (SUOJAKERROIN_25 * $vaalea)/60;
        echo "Vaalea voi olla kertoimella 25 auringossa $vaalean_aika_25 tuntia<br>";

        $vaalean_aika_50 = (SUOJAKERROIN_50 * $vaalea)/60;
        echo "Vaalea voi olla kertoimella 50 auringossa $vaalean_aika_50 tuntia<br>";

        $tumman_aika_25 = (SUOJAKERROIN_25 * $tumma)/60;
        echo "Tumma voi olla kertoimella 25 auringossa $tumman_aika_25 tuntia<br>";

        $tumman_aika_50 = (SUOJAKERROIN_50 * $tumma)/60;
        echo "Tumma voi olla kertoimella 50 auringossa $tumman_aika_50 tuntia<br>";
    ?>
</html>