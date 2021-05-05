<html>
    <head>
        <title>Ympyrä</title>
    </head>
    <body>
        <h1>Ympyrä</h1>
        <?php
            echo "<h4>Ympyrän tiedot</h4>";
            echo "Ympyrän numero: " . $ympyra1->palauta_nro() . "<br>";
            echo "Ympyran pinta-ala: " . $ympyra1->laske_pinta_ala() . "<br>";
            echo "Ympyran piiri: " . $ympyra1->laske_piiri();
        ?>
        <?php
            echo "<h4>Ympyrän tiedot</h4>";
            echo "Ympyrän numero: " . $ympyra2->palauta_nro() . "<br>";
            echo "Ympyran pinta-ala: " . $ympyra2->laske_pinta_ala() . "<br>";
            echo "Ympyran piiri: " . $ympyra2->laske_piiri();
        ?>
    </body>
</html>