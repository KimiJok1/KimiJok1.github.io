<?php
include "./views/partials/head.php";
?>

<h1>Rekisteröidy</h1>

<form method ="post">
<label for="username">Nickname</label><br>
<input type ="text" name ="username" required><br>

<label for ="password">Salasana</label><br>
<input type="password" name="password" required><br>

<label for="password2">Salasana uudelleen</label><br>
<input type="password" name="password2" required><br>

<input type="submit" value="Rekisteröi pelaaja">
</form>

<?php
include "./views/partials/end.php";
?>