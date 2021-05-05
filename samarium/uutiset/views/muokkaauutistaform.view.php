<?php
include "./views/partials/head.php";
?>

<form method ="post">
<label for="otsikko">Otsikko</label><br>
<input type="text" name="otsikko" value="<?= $uutinen[0]["otsikko"]?>"><br>

<label for="sisalto">Sisältö</label><br>
<textarea rows="5" cols="60" name="sisalto">
<?= $uutinen[0]["sisalto"]?>
</textarea><br>

<input type="submit" value="Muokkaa">
</form>