<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/index.css">
        <title>Taitaja 2020</title>
    </head>
    <body>
        <?php
            if (isset($_GET['order'])) {
                if ($_GET['order'] == true) {
                    echo "<div class='notification'><h2>Ordered successfully!</h2></div>";
                }
            }
        ?>
        <div class="navbar">
            <a href="#" class="navbar-icon-holder">
                <img src="./logo/logo_dark.svg" alt="logo_nav" class="navbar-icon"> 
            </a>
        </div>
        <div class="banner">
            <h1></h1>
            <p class="introduction"></p>
        </div>
        <div class="content">
            <div class="split-left white">
                <img src="./images/pexels-andrea-piacquadio-3807649.jpg" alt="img1" class="inner-image"> 
            </div>
            <div class="split-right">
                <h1 class="content-banner"></h1>
                <p class="content-introduction"></p>
            </div>
        </div>
        <div class="content">
            <div class="split-right">
                <h1 class="content-banner"></h1>
                <p class="content-introduction"></p>
            </div>
            <div class="split-left white">
                <img src="./Rengaskuvat/Kumho-Talvisomepohja19-FB1200x628-FIN-2.png" alt="img1" class="inner-ad"> 
                <iframe class="inner-map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=24.816618561744693%2C64.2645852001554%2C24.82015907764435%2C64.2656124093793&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=19/64.26510/24.81839">Näytä isommalla kartalla</a></small>
            </div>
        </div>
        <div class="videot">
            <iframe class="vaihto"
                src="https://www.youtube.com/embed/A5z-cM5eU00">
            </iframe>
            <div class="split-right">
                <h1 class="video-banner"></h1>
                <p class="video-introduction"></p>
            </div>
            <div class="split-left">
                <img src="./Rengaskuvat/Kumho_Talviasomepohja20-21_FB1080x1080_SUOMI1.png" alt="img1" class="inner-image"> 
            </div>
        </div>
        <div class="renkaat" id="results">
            <div class="options">
                <form>
                    <p>Rengaskoko:</p>
                    <select name="koko" name="size">
                        <?php
                            
                            $koko = "";

                            if(isset($_GET['koko'])) {
                                $koko = $_GET['koko']; 
                            } else {
                                $koko = "165/55-14";
                            }
                                
                            require "./php/connect.php";
                            $sql = "SELECT DISTINCT Koko FROM renkaat ORDER BY Koko ASC";

                            $stmt = $pdo->query($sql);
                            $rows = $stmt->fetchAll();
                            
                            foreach ($rows as $row) {
                                echo "<option value=" . $row["Koko"] . ">" . $row["Koko"] . "</option>";
                            }
                        ?>
                    </select>
                    <button href="#results" type="submit" value="search">Hae</button>
                </form>
            </div>
            <div class="results">
                <?php
                    if (isset($_POST["order"]) && isset($_POST["amount"]) && isset($_POST["id"])) {
                        if ($_POST["amount"] > 0) {
                            header('Location: ./tilaus/index.php?order=' . $_POST["id"] . '&amount=' . $_POST["amount"]);
                            die();
                        } else {
                            
                        }
                    }

                    require "./php/connect.php";
                    $sql = "SELECT * FROM renkaat WHERE Koko LIKE '%$koko%' ORDER BY Koko ASC ";

                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchAll();
                    
                    echo "<table>";
                    echo "<tr> <td></td> <td>Rengas</td> <td>Tyyppi</td> <td>Koko</td> <td>Hinta</td>";
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<td>" . "</td>";
                        echo "<td>" . $row["Merkki"] . " " . $row["Malli"] . "</td>";
                        echo "<td>" . $row["Tyyppi"] . "</td>";
                        echo "<td>" . $row["Koko"] . "</td>";
                        echo "<td>" . $row["Hinta"] . "€</td>";
                        echo "<td><form method='post' action='#results'><input class='amount' name='id' type='hidden' value='" . $row["RengasID"] . "'/><input class='amount' name='amount' type='number' value='search' placeholder='Määrä' min='0'/> <input type='submit' name='order' value='Tilaa' /> </form></td>";
                        echo "</tr>";
                    }
                    echo "</table>";


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