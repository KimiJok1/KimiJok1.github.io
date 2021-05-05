<?php
include "./views/partials/head.php";
require "./database/connection.php"
?>
<h1>Muokkaa</h1>
<?php
switch($type) {
    case "user":
        $sql = "SELECT * FROM harj2_kayttaja";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchALL();
        
        ?>
        <form method ="post">
            <label for="name">Nimi</label><br>
            <input type ="text" name ="name" value="<?=$rows[0]["name"]?>" required><br>

            <label for="email">Email</label><br>
            <input type="email" name="email" value="<?=$rows[0]["email"]?>" required><br>
            <br>
            <input type="submit" value="Muokkaa käyttäjää">
            </form>
        </form>
        <?php
        break;
    default:
        break;
}