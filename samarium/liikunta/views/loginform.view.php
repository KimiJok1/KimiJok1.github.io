<?php
include "./views/partials/head.php";
?>
<h1>Kirjaudu sisään</h1>
<form method ="post">

<label for="name">Käyttäjätunnus</label><br>
<input type="text" name="name"><br>

<label for="password">Salasana</label><br>
<input type="password" name="password"><br>
<br>
<input type="submit" value="Kirjaudu">
</form>