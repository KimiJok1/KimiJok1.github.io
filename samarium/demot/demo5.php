<?php

if(isset($_POST["nimi"],$_POST["ika"])) {
    $nimi = htmlentities($_POST["nimi"]);
    $ika = htmlentities($_POST["ika"]);

    echo "Hei $nimi, oletko todella $ika vuotta vanha?";
}
else {
//tähän itse lomake
?>

<form method="post">
<!-- vaihtoehdot kirjoittamiseen: 
1. tiedoston polku (tässä: ./index.php?sivu=demo5&kansio=demot)
2. tietoturvattuna $_SERVER["PHP_SELF"]
<?php /* echo htmlentities($_SERVER['PHP_SELF']); */?>
3. Ei mitään-->
<label for="nimi">Nimi</label><br>
<input type="text" name="nimi" required><br>

<label for="ika">Ikä</label><br>
<input type="number" min="7" max="75" name="ika" required><br>

<input type="reset" value ="Tyhjennä">
<input type="submit" value="Lähetä">
</form>
<?php
}