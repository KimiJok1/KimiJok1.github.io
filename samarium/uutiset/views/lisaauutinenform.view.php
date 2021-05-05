<?php
include "./views/partials/adminhead.php";
?>

<form method ="post">
<label for="otsikko">Otsikko</label><br>
<input type="text" name="otsikko" placeholder="Otsikko"><br>

<label for="sisalto">Sisältö</label><br>
<textarea rows="5" cols="60" name="sisalto">
</textarea><br>

<label for="kirjoittaja">Kirjoittaja</label><br>
<input type="text" name="kirjoittaja" placeholder="Kirjoittaja"><br>

<label for="deletion_date">Deletion date</label><br>
<input type="date" name="deletion_date" min="<?=date("Y-m-d");?>" max="2023-12-31" value="" required><br>

<input type="submit" value="Lisää">
</form>