<?php
echo "<h1>5.1</h1>";
for ($i = 1; $i <= 10; $i++) {
    echo "Kimi Jokelainen<br>";
}

echo "<h1>5.2</h1>";
$curyear = date('Y');
for ($year = date('Y'); $year < $curyear + 5; $year++) {
    echo $year."<br>";
}

echo "<h1>5.3</h1>";

if (isset($_POST["height"]) && isset($_POST["height"])) {
    $h = $_POST["height"];
    $w = $_POST["width"];
    for ($i = 0; $i < $h; $i++) {
        for ($o = 1; $o < $w; $o++) {
            echo "*";
        }
        echo "*<br>";
    }
}
?>

<form method="post">
    <input type="number" value="" name="height" placeholder="Korkeus"><br>
    <input type="number" value="" name="width" placeholder="Leveys"><br>
    <input type="submit" value="Lähetä" name="submit"><br>
</form>

<?php
    echo "<h1>5.4</h1>";
    $etunimet = array("Timo", "Tero", "Tauno");
    $sukunimet = array("Virtanen", "Salonen", "Nieminen");
    $etunimet_l = count($etunimet);
    $sukunimet_l = count($sukunimet);
    for ($i = 0; $i < $etunimet_l; $i++) {
        echo $sukunimet[$i] . ", " . $etunimet[$i] . "<br>";
    }

    echo "<h1>5.5</h1>";

    if (isset($_POST["random"])) {
        $rng1 = rand(0, $etunimet_l - 1);
        $rng2 = rand(0, $sukunimet_l - 1);
        echo $sukunimet[$rng2] . ", " . $etunimet[$rng1] . "<br>";
    }

    $maat = array (
        array(0,"Finland","Helsinki","5528737"),
        array(1,"Sweden","Stockholm","10377781"),
        array(2,"Norway","Oslo","5372191"),
        array(3,"Denmark","Copenhagen","5809502"),
        array(4,"Iceland","Reykjavik","343518")
    );

    echo '<form method="post">';
    echo '<input type="submit" value="Arvo satunnainen nimi" name="random"><br>';
    echo '</form>';

    echo "<h1>5.6</h1>";
    echo "<h3>l o o k   d o w n</h3>";

    echo "<table>";
    echo "<tr> <th>Index</th> <th>Maa</th> <th>Pääkaupunki</th> <th>Asukasluku</th> </tr>";
    for ($i = 0; $i < count($maat); $i++) {
        echo "<tr>";
        for ($o = 0; $o < count($maat[$i]); $o++) {
            echo  "<th>" . $maat[$i][$o] . "</th>";
        }
        echo "</tr>";
    }
    echo "</table";
?>