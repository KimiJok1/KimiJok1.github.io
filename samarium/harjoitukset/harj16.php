<?php
require "../harjoitukset/yhteys.php";
?>
<h1>1. Hahmot</h1>
<form action="">
    <select id="race" onchange="haeHahmo()" onfocus="haeHahmo()"><br>
        <?php
            $sql = "SELECT * FROM race";
            $stmt = $pdo->query($sql);
            $rows = $stmt->fetchALL();
            
            foreach ($rows as $row){
                $RaceID = $row["raceID"];
                $name = $row["name"];
                echo "<option value=$RaceID>$name</option>";
            }
        ?>
    </select>
</form>

<h4>Tulos</h4>
<p id="txtTulos"></p>

<h1>2. Haku</h1>
<form action="">
    <input type="text" id="haku" name="haku" onkeyup="haeUutinen()"><br />
</form>

<h4>Tulos</h4>
<p id="txtTulos2"></p>

<script>
    function haeHahmo() {
        let race = document.getElementById("race").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../harjoitukset/harj16b.php?race=" + race, true);
        xmlhttp.onload = function () {
            document.getElementById("txtTulos").innerHTML = this.responseText;
        };
        xmlhttp.send();
    }
    function haeUutinen() {
        let haku = document.getElementById("haku").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../harjoitukset/harj16c.php?haku=" + haku, true);
        xmlhttp.onload = function () {
            document.getElementById("txtTulos2").innerHTML = this.responseText;
        };
        xmlhttp.send();
    }
</script>