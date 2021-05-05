<html>
    <head>
        <title>Kirja</title>
    </head>
    <body>
        <?php
            if(isset($_POST["tekija"]) && isset($_POST["nimi"]) && isset($_POST["hinta"])){
                $tekija=$_POST["tekija"];
                $nimi=$_POST["nimi"];
                $hinta=$_POST["hinta"];

                array_push($kirjat,new Kirja($nimi, $tekija, $hinta));
            }
        ?>

        <h1>Kirja</h1>

        <form method="post">
            <p>Tekijä</p>
            <input type="text" name="tekija">

            <p>Nimi</p>
            <input type="text" name="nimi">

            <p>Hinta</p>
            <input type="text" name="hinta">

            <input type="submit">
        </form>

        <?php
            for ($i = 0; $i < count($kirjat); $i++) {
                echo "<h4>Kirjan tiedot</h4>";
                echo "Kirjan nimi: " . $kirjat[$i]->palauta_nimi() . "<br>";
                echo "Kirjan tekijä: " . $kirjat[$i]->palauta_tekija() . "<br>";
                echo "Kirjan hinta: " . $kirjat[$i]->palauta_hinta() . "€<br>";
                echo "Kirjan alennettu hinta: " . $kirjat[$i]->palauta_alennettu_hinta() . "€<br>";
            }
        ?>
    </body>
</html>