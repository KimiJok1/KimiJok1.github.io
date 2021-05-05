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
    $sql="DELETE FROM arvostelu WHERE jid=?"; 
    $kysely = $yhteys->prepare($sql); 
    $kysely->execute(array($jid));
    header("Location:admin.php");
}

if($mode=="muokkaa") {
    if(!empty($_POST["otsikko"]) && !empty($_POST["kpl"]))     {
        $lisayspvm = date('Y-m-j');
        $otsikko = $_POST['otsikko'];
        $otsikko = putsaa($otsikko);
        $arvosana = $_POST['arvosana'];
        $kpl = $_POST['kpl'];
        $kpl = putsaa($kpl);
        $aid = $_POST['arvosteltava'][0];

        if(isset($_POST['poistamispvm'])) $poistamispvm=$_POST['poistamispvm'];
        else {
            $poistamispvm = strtotime($lisayspvm) + (14 * 24 * 60 * 60);//14 päivää sekunteina
            $poistamispvm = date('Y-m-j', $poistamispvm);
        }

        $kid=$_SESSION["kid"];

        $sql = "UPDATE arvostelu set arvosana=:arvosana,otsikko=:otsikko,kpl=:kpl,poistamispvm=:poistamispvm,lisayspvm=:lisayspvm,kid=:kid,aid=:aid WHERE jid=:jid";

        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array(":arvosana"=>$arvosana,":otsikko"=>$otsikko,":kpl"=>$kpl,":poistamispvm"=>$poistamispvm,"lisayspvm"=>$lisayspvm,":kid"=>$kid,":jid"=>$jid,":aid"=>$aid));

        if($kysely)         {
            echo "Tiedot muutettu!<br>";
            echo "<a href=\"admin.php\">Palaa arvosteluluetteloon.</a><br>";
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
            if (empty($_POST['kpl'])) echo "Kirjoita itse arvostelu";
            if (empty($_POST['arvosteltava'])) echo "Valitse arvosteltava tuote";   
        }
        else {
            $sql="SELECT * FROM arvostelu WHERE jid=?";
            $kysely = $yhteys->prepare($sql);
            $kysely->execute(array($jid));

            $rivi = $kysely->fetchAll(PDO::FETCH_ASSOC); 
            if(!$rivi) echo "arvostelua ei löydy ";
            else {
                $jid=$rivi[0]["jid"];
                $lisayspvm=$rivi[0]["lisayspvm"];
                $poistamispvm=$rivi[0]["poistamispvm"];
                $arvosana=$rivi[0]["arvosana"];
                $otsikko=$rivi[0]["otsikko"];
                $kpl=$rivi[0]["kpl"];
                $kid=$rivi[0]["kid"];
                $aid=$rivi[0]["arvosteltava"][0];
            }
        }
        ?>
        <form action="./admin.php?sivu=muokkaa_arvostelua&mode=muokkaa&jid=<?php echo $jid;?>" method="post">
        
        <p>
        <label for="arvosana">* Arvosana</label><br>
        <input type="number" name="arvosana" min="1" max="5" value="<?php if(isset($arvosana)) echo $arvosana;?>">
        </p>

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
        <label for="arvosteltava">Arvosteltava peli</label><br>
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
        <input class="button" type="submit" value="Muokkaa arvostelua" name="painike">
        </p>
        
        </form>

        <?php
    }
}
?>