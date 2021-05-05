<?php
include "./views/partials/head.php";
require "./database/connection.php"
?>
<h1>Luo uusi</h1>
<?php
switch($_GET["type"]) {
    case "user":
        ?>
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
        </form>
        <?php
        break;
    case "entry":
        ?>
        <form method ="post">
            <label for="user">Käyttäjä</label><br>
            <select name="user" id="user"><br>
                <?php
                    $sql = "SELECT * FROM harj2_kayttaja";
                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchALL();
                    
                    foreach ($rows as $row){
                        $pid = $row["pid"];
                        $name = $row["name"];
                        echo "<option value=$pid>$name</option>";
                    }
                ?>
            </select><br>

            <label for ="sport">Laji</label><br>
            <select name="sport" id="sport"><br>
                <?php
                    $sql = "SELECT * FROM harj2_laji";
                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchALL();
                    
                    foreach ($rows as $row){
                        $lid = $row["lid"];
                        $name = $row["name"];
                        echo "<option value=$lid>$name</option>";
                    }
                ?>
            </select><br>

            <label for="time">Aika</label><br>
            <input type="number" name="time" required><br>

            <label for="intensity">Intensiivisyys</label><br>
            <input type="number" name="intensity" required><br>

            <label for="length">Pituus</label><br>
            <input type="number" name="length" required><br>
            <br>
            <input type="submit" value="Lisää merkintä">
            </form>
        </form>
        <?php
        break;
    case "sport":
        ?>
        <form method ="post">
            <label for="name">Lajin nimi</label><br>
            <input type ="text" name ="name" required><br>

            <input type="submit" value="Lisää laji">
            </form>
        </form>
        <?php
        break;

    default:
        break;
}