<?php
include "./views/partials/head.php";
?>
    <h1>Rekisteröidy</h1>
    <form method ="post">
    <label for="name">Nimi</label><br>
    <input type ="text" name ="name" required><br>

    <label for ="password">Salasana</label><br>
    <input type="password" name="password" required><br>

    <label for="password2">Salasana uudelleen</label><br>
    <input type="password" name="password2" required><br>

    <label for="email">Email</label><br>
    <input type="email" name="email" required><br>
    <br>
    <input type="submit" value="Rekisteröidy">
    </form>

<?php
include "./views/partials/end.php";
?>