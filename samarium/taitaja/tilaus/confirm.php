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
                    require "../php/connect.php";

                    session_start();
                    $uservariables = $_SESSION['uservariables'];
                    $userdata = $_SESSION['userdata'];

                    $id = $_GET["order"];
                    $sql = "SELECT * FROM renkaat WHERE RengasID LIKE '%$id%'";

                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchAll();

                    echo '<p><b>' . $_GET["amount"] . " kpl " . $rows[0]["Merkki"] . " " . $rows[0]["Malli"] . ", " . $rows[0]["Koko"] . ", " . $rows[0]["Tyyppi"] . '</b></p>';
                    echo '<p>' . $rows[0]["Hinta"] * $_GET["amount"] . "€</p>";
                    for ($i = 0; $i < count($userdata); $i++) {
                        echo " <p><b>" . $uservariables[$i] . ":</b> " . $userdata[$i] . "</p>";
                    }
                    if(isset($_POST["yes"])) {

                        $sql = "SELECT * FROM renkaat WHERE RengasID LIKE '%$id%'";

                        $stmt = $pdo->query($sql);
                        $rows = $stmt->fetchAll();

                        if ($rows[0]["Saldo"] >= $_GET["amount"]) {
                            $newvalue = $rows[0]["Saldo"] - $_GET["amount"];
                            $sql = "UPDATE `asiakasrekisteri` SET Saldo = `$newvalue` WHERE RengasID = $id";
                            
                            $sql = "INSERT INTO `asiakasrekisteri` (`Nimi`, `Postiosoite`,`Email`,`Puhelin`,`TuoteID`) VALUES (?, ?, ?, ?, ?)";
                            $data = array($userdata[0], $userdata[1] ,$userdata[4], intval($userdata[5]), $id);
        
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute($data);

                            header("Location: ../index.php?order=true");
                        } else {
                            header("Location: ../index.php?order=false");
                        }

                    }
                } else {
                    header("Location: ../index.php");
                }
                ?>
                <hr>
                <h2>Ovatko tiedot oikein?</h2>
                <form method="post">
                    <input type="submit" name="yes" value="Kyllä">
                    <input type="submit" name="no" value="Ei">
                </form>
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
                        //header("Location: ../index.php");
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