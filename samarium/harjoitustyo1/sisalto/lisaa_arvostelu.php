<?php

/******************
Taulun rakenne
jid int(6) auto_increment (on siis autonumber tai laskuri-tyyppinen), pääavain
otsikko varchar(100)
kpl text
poistamispvm date NOT NULL
lisayspvm date
kid int(6)
**********************/
require "./tietokanta/yhteys.php";

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

if (!empty($_POST["otsikko"]) && !empty($_POST["kpl"])) {
    $lisayspvm = date('Y-m-j');
    $otsikko = $_POST['otsikko'];
    $otsikko = putsaa($otsikko);
    $arvosana = $_POST['arvosana'];
    $kpl = $_POST['kpl'];
    $kpl = putsaa($kpl);
    $aid = $_POST['arvosteltava'][0];

    if(!empty($_POST['poistamispvm'])) $poistamispvm = $_POST['poistamispvm'];
    else {
        $poistamispvm = strtotime($lisayspvm) + 1209600;//14 päivää sekunteina
        $poistamispvm = date('Y-m-j', $poistamispvm);
    }

    $kid=$_SESSION["kid"];

    $sql = "INSERT INTO arvostelu (arvosana,otsikko,kpl,poistamispvm,lisayspvm,kid,aid) VALUES (?,?,?,?,?,?,?)";

    $kysely=$yhteys->prepare($sql);
    console_log(array($arvosana,$otsikko,$kpl,$poistamispvm,$lisayspvm,$kid,$aid));
    $kysely->execute(array($arvosana,$otsikko,$kpl,$poistamispvm,$lisayspvm,$kid,$aid)); if($kysely!=FALSE) echo "Tiedot lisätty";
    else echo "Lisäys ei onnistunut, yritä myöhemmin uudelleen";
}
else {

/********************************************************************
Jos tietoja puuttuu tai tullaan ensimmäistä kertaa sovellukseen,
tulostetaan lomake (valmiit tiedot lomakkeeseen). Jos tietoja puuttuu
tulostetaan niistä ilmoitus
********************************************************************/

    echo "Täytä lomake kokonaan, pakolliset kentät on merkitty tähdellä.";
    if(isset($_POST["painike"])) {
        if (!isset($_POST['arvosana'])) echo "Anna arvosana";  
        if (!isset($_POST['otsikko'])) echo "Kirjoita otsikko";    
        if (!isset($_POST['kpl'])) echo "Kirjoita myös arvostelu";
        if (!isset($_POST['arvosteltava'])) echo "Valitse arvosteltava peli";  
    }
?>

    <form action="./admin.php?sivu=lisaa_arvostelu" method="post">

    <p>
    <label for="arvosana">* Arvosana</label><br>
    <input type="number" name="arvosana" min="1" max="5" value="<?php if(isset($arvosana)) echo $arvosana;?>">
    </p>

    <p>
    <label for="otsikko">* Otsikko</label><br>
    <input type="text" name="otsikko" value="<?php if(isset($_POST["otsikko"])) echo $_POST["otsikko"]?>">
    </p>

    <p>
    <label for="kpl">* Teksti</label><br>
    <textarea name="kpl" cols="45" rows="5"><?php if(isset($_POST["kpl"])) echo $_POST["kpl"]?></textarea>
    </p>

    <p>
    <label for="poistamispvm">Poistamispvm (jos et aseta päiväystä, poistuu automaattisesti kahden viikon kuluttua)</label><br>
    <input type="text" id="pvm1" name="poistamispvm" <?php if(isset($_POST["poistamispvm"])) echo $_POST["poistamispvm"];?>"><br>
    <a href="javascript:NewCal('pvm1','mmddyyyy','','')">
    <img class="kuvake" src="./tyyli/kuvat/froge.gif" width="16" height="16" border="0" alt="Klikkaa valitaksesi päivämäärä"></a><br>
    Huom. Kirjoitettaessa esitysmuoto vvvv-kk-pv </p>

    <p>
    <select name="arvosteltava" id="arvosteltava">
        <?php
            $sql="SELECT * FROM arvosteltava ORDER BY nimi ASC";
            $kysely=$yhteys->query($sql);
            
            $rivit = $kysely->rowCount();
            $vastaus = $kysely->fetchAll(PDO::FETCH_ASSOC); 

            for($i = 0; $i < $rivit; $i++) {
                echo '<option value="' . $vastaus[$i]["aid"] . '">' . $vastaus[$i]["nimi"] . '</option>';
            }
        ?>
    </select>
    </p>

    <p>
    <input class="button" type="submit" value="Lisää arvostelu" name="painike">
    </p>
    
    </form>

<?php
}
?>