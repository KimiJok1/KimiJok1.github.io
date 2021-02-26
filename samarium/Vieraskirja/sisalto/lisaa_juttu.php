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
if (!empty($_POST["otsikko"]) && !empty($_POST["kpl"])) {
    $lisayspvm = date('Y-m-j');
    $otsikko = $_POST['otsikko'];
    $otsikko = putsaa($otsikko);
    $kpl = $_POST['kpl'];
    $kpl = putsaa($kpl);

    if(!empty($_POST['poistamispvm'])) $poistamispvm = $_POST['poistamispvm'];
    else {
        $poistamispvm = strtotime($lisayspvm) + 1209600;//14 päivää sekunteina
        $poistamispvm = date('Y-m-j', $poistamispvm);
    }

    $kid=$_SESSION["kid"];

    $sql = "INSERT INTO juttu (otsikko,kpl,poistamispvm,lisayspvm,kid) VALUES (?,?,?,?,?)";

    $kysely=$yhteys->prepare($sql);
    $kysely->execute(array($otsikko,$kpl,$poistamispvm,$lisayspvm,$kid)); if($kysely!=FALSE) echo "Tiedot lisätty";
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
        if (!isset($_POST['otsikko'])) echo "Kirjoita otsikko";    
        if (!isset($_POST['kpl'])) echo "Kirjoita myös juttu";
    }
?>

    <form action="./admin.php?sivu=lisaa_juttu" method="post">

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
    <input class="button" type="submit" value="Lisää juttu" name="painike">
    </p>
    
    </form>

<?php
}
?>