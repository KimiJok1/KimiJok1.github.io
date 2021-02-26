<h1>4.1</h1>
<form method="post">

<label for="luku1">Rahamäärä</label><br>
<input type="text" name="luku1" required><br>

<input type="submit" name="laske" value="Tarkista">
</form>

<h3>Vastaus</h3>

<?php
    if(isset($_POST["luku1"])) {
        $luku1 = htmlentities($_POST["luku1"]);
        $vastaus = round($luku1/1.55, 3);
        echo "<h4>$vastaus litraa</h4>";
    }
?>  

<h1>4.2</h1>
<form method="post">

<label for="luku1">Rahamäärä</label><br>
<input type="text" name="luku1" required><br>
<label for="luku1">Hinta</label><br>
<input type="text" name="luku2" required><br>

<input type="submit" name="laske" value="Laske">
</form>

<h3>Vastaus</h3>

<?php
    if(isset($_POST["luku1"],$_POST["luku2"])) {
        $luku1 = htmlentities($_POST["luku1"]);
        $luku2 = htmlentities($_POST["luku2"]);
        $vastaus = $luku1-$luku2;
        echo "<h4>Asiakas saa takaisin $vastaus €</h4>";
    }
?>  

<h1>4.3</h1>
<form method="post">

<label for="luku1">Hinta</label><br>
<input type="text" name="luku1" required><br>
<label for="luku1">Arvonlisäveroprosentti</label><br>
<input type="text" name="luku2" required><br>

<input type="submit" name="laske" value="Laske">
</form>

<h3>Vastaus</h3>

<?php
    if(isset($_POST["luku1"],$_POST["luku2"])) {
        $luku1 = htmlentities($_POST["luku1"]);
        $luku2 = htmlentities($_POST["luku2"]);
        $vastaus1 = $luku1 * ($luku2/100);
        $vastaus2 = $luku1+$vastaus1;
        echo "<h4>Arvonlisäveron euromäärä: $vastaus1 €, verollinen hinta: $vastaus2 €</h4>";
    }
?>  