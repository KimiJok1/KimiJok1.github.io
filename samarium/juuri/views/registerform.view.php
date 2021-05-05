<?php
include "./views/partials/head.php";
?>

<h1>Rekisteröidy</h1>

<form method ="post">
<label for="nickname">Nickname</label><br>
<input type ="text" name ="nickname" required><br>

<label for ="password">Salasana</label><br>
<input type="password" name="password" required><br>

<label for="password2">Salasana uudelleen</label><br>
<input type="password" name="password2" required><br>

<label for="email">Email</label><br>
<input type="email" name="email" required><br>

<label for="character">Hahmo</label><br>
<select name="character">
    <option value="hirviö">hirviö</option>
    <option value ="keiju">keiju</option>
    <option value="olio">olio</option>
</select><br><br>

<input type="submit" value="Rekisteröi pelaaja">
</form>

<?php
include "./views/partials/end.php";
?>