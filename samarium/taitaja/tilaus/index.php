<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/index.css">
        <title>Taitaja 2020</title>
    </head>
    <body>
        <div class="navbar">
            <a href="../index.php" class="navbar-icon-holder">
                <img src="../logo/logo_dark.svg" alt="logo_nav" class="navbar-icon"> 
            </a>
        </div>
        <div class="order white">
            <div class="order-left">
                <h1>Tilauksesi:</h1>
                <?php
                if (isset($_GET['order'])) {
                    if (isset($_POST["confirm"])) {
                        session_start();
                        $_SESSION = array();
                        $_SESSION['userdata'] = array();
                        $_SESSION['uservariables'] = array();
                        foreach ($_POST as $key => $value) {
                            if ($key != "confirm") {
                                array_push($_SESSION['userdata'], $value);
                                array_push($_SESSION['uservariables'], $key);
                            }
                        }
                        header("Location: ./confirm.php?order=" . $_GET['order'] . "&amount=" . $_GET['amount']);
                    } else if (isset($_POST["cancel"])) {

                    } else {
                        require "../php/connect.php";
                        $id = $_GET["order"];
                        $sql = "SELECT * FROM renkaat WHERE RengasID LIKE '%$id%'";

                        $stmt = $pdo->query($sql);
                        $rows = $stmt->fetchAll();

                        echo '<h2>' . $_GET["amount"] . " kpl " . $rows[0]["Merkki"] . " " . $rows[0]["Malli"] . ", " . $rows[0]["Koko"] . ", " . $rows[0]["Tyyppi"] . '</h2>';
                        echo '<h2>' . $rows[0]["Hinta"] * $_GET["amount"] . "€</h2>";
                    }
                } else {
                    //header("Location: ../index.php");
                }
                ?>
                <hr>
                <div class="order-details">
                    <form method="post" class="order-form">
                        <label>Nimi:</label><br>
                        <input type="text" name="Nimi" value="" minlength="5" required/><hr>
                        <label>Osoite:</label><br>
                        <input type="text" name="Osoite" value="" minlength="6" required/><hr>
                        <label>Postinumero:</label><br>
                        <input type="number" name="Postinumero" value="" minlength="5" maxlength="5" required/><hr>
                        <label>Kaupunki:</label><br>
                        <input type="text" name="Kaupunki" value="" minlength="2" required/><hr>
                        <label>Sähköpostiosoite:</label><br>
                        <input type="email" name="Sähköpostiosoite" value="" required/><hr>
                        <label>Puhelinnumero:</label><br>
                        <input type="number" name="Puhelinnumero" value="" minlength="6" maxlength="12"required/><hr>
                        <label>Toimitustapa:</label><br>
                        <select name="Kuljetus">
                            <option value="Nouto liikkeestä">Nouto liikkeestä</option>
                            <option value="Matkahuolto">Matkahuolto</option>
                        </select><br>
                        <button type="submit" name="confirm">Vahvista tilaus</button>
                    </form>
                </div>
                <a href="../index.php"><button name="cancel">Peruuta tilaus</button></a>
            </div>
            <div class="order-right">
                <?php
                    if (isset($_GET['order'])) {
                        require "../php/connect.php";
                        $id = $_GET["order"];
                        $sql = "SELECT * FROM renkaat WHERE RengasID LIKE '%$id%'";

                        $stmt = $pdo->query($sql);
                        $rows = $stmt->fetchAll();

                        if ($rows[0]["Merkki"] == "Nokian") {
                            echo "<img src='../Rengaskuvat/Nokian_Tyres-Arctic_Sense_Grip.jpg' alt='img1' class='order-img'>";
                        } else if ($rows[0]["Merkki"] == "Kumho") {
                            echo "<img src='../Rengaskuvat/Kumho_Wintercraft_tunnelmakuva1024x768.jpg' alt='img1' class='order-img'>";
                        } else if ($rows[0]["Merkki"] == "Hankook") {
                            echo "<img src='../Rengaskuvat/Hankook_Kinergy_4S_2.jpg' alt='img1' class='order-img'>";
                        }
                    } else {
                        header("Location: ../index.php");
                    }
                ?>
            </div>
        </div> 
        <div class="footer">
            <p>Mustapään Auto Oy<br>
                Mustat Renkaat<br>
                Kosteenkatu 1, 86300 Oulainen<br>
                Puh. 040-7128158<br>
                email. myyntimies@mustatrenkaat.net
            </p>
        </div>
    </body>
</html>