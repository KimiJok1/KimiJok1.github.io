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
if(isset($_GET["jid"])) $jid=$_GET["jid"];
else $jid="";

if(isset($_GET["mode"])) $mode=$_GET["mode"];
else $mode="muokkaa";
if($mode=="poista")
{
    $sql="DELETE FROM juttu WHERE jid=?"; 
    $kysely = $yhteys->prepare($sql); 
    $kysely->execute(array($jid));
    header("Location:admin.php");
}

if($mode=="muokkaa") {
    if(!empty($_POST["otsikko"]) && !empty($_POST["kpl"]))     {
        $lisayspvm = date('Y-m-j');
        $otsikko = $_POST['otsikko'];
        $otsikko = putsaa($otsikko);
        $kpl = $_POST['kpl'];
        $kpl = putsaa($kpl);

        if(isset($_POST['poistamispvm'])) $poistamispvm=$_POST['poistamispvm'];
        else {
            $poistamispvm = strtotime($lisayspvm) + (14 * 24 * 60 * 60);//14 päivää sekunteina
            $poistamispvm = date('Y-m-j', $poistamispvm);
        }

        $kid=$_SESSION["kid"];

        $sql = "UPDATE juttu set otsikko=:otsikko,kpl=:kpl,poistamispvm=:poistamispvm,lisayspvm=:lisayspvm,kid=:kid WHERE jid=:jid";

        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array(":otsikko"=>$otsikko,":kpl"=>$kpl,":poistamispvm"=>$poistamispvm,"lisayspvm"=>$lisayspvm,":kid"=>$kid,":jid"=>$jid));

        if($kysely)         {
            echo "Tiedot muutettu!<br>";
            echo "<a href=\"admin.php\">Palaa juttuluetteloon.</a><br>";
        }
    }
    else {

    /********************************************************************
    Jos tietoja puuttuu tai tullaan ensimmäistä kertaa sovellukseen,
    tulostetaan lomake (valmiit tiedot lomakkeeseen). Jos tietoja puuttuu
    tulostetaan niistä ilmoitus
    ********************************************************************/

        echo "Täytä lomake kokonaan, pakolliset kentät on merkitty tähdellä.";
        if(!empty($_POST)) {
            if (empty($_POST['otsikko'])) echo "Kirjoita otsikko";    
            if (empty($_POST['kpl'])) echo "Kirjoita itse juttu";
        }
        else {
            $sql="SELECT * FROM juttu WHERE jid=?";
            $kysely = $yhteys->prepare($sql);
            $kysely->execute(array($jid));

            $rivi = $kysely->fetchAll(PDO::FETCH_ASSOC); 
            if(!$rivi) echo "Juttua ei löydy ";
            else {
                $jid=$rivi[0]["jid"];
                $lisayspvm=$rivi[0]["lisayspvm"];
                $poistamispvm=$rivi[0]["poistamispvm"];
                $otsikko=$rivi[0]["otsikko"];
                $kpl=$rivi[0]["kpl"];
                $kid=$rivi[0]["kid"];
            }
        }
        ?>
        <form action="./admin.php?sivu=muokkaa_juttua&mode=muokkaa&jid=<?php echo $jid;?>" method="post">
        
        <p>
        <label for="otsikko">* Otsikko</label><br>
        <input type="text" name="otsikko" value="<?php if(isset($otsikko)) echo $otsikko;?>">
        </p>

        <p>
        <label for="otsikko">* Teksti</label><br>
        <textarea name="kpl" cols="45" rows="5"><?php if(isset($kpl)) echo $kpl?></textarea>
        </p>

        <p>
        <label for="poistamispvm">Poistamispvm (jos et aseta päiväystä, poistuu automaattisesti kahden viikon kuluttua)</label><br>
        <input type="text" id="pvm1" name="poistamispvm" <?php if(isset($_POST["poistamispvm"])) echo $_POST["poistamispvm"];?>><br>
        <a href="javascript:NewCal('pvm1','mmddyyyy','','')">
        <img class="kuvake" src="./tyyli/kuvat/froge.gif" width="64" height="64" border="0" alt="Klikkaa valitaksesi päivämäärä"></a><br>
        Huom. Kirjoitettaessa esitysmuoto vvvv-kk-pv </p>

        <p>
        <input class="button" type="submit" value="Muokkaa juttua" name="painike">
        </p>
        
        </form>

        <?php
    }
}
?>