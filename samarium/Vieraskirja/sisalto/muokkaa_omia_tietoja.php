<?php
/* Tiedosto hakee vanhat käyttäjän tiedot lomakkeelle ja submit-painikkeen painamisen jälkeen lähettää ne palvelimelle. Tietojen oikeellisuus tarkistetaan ja jos kaikki on kunnossa, päivitetään tietokantaan. * Jotta käyttäjän tietoja voi muuttaa, tarvitaan käyttäjäid, jonka saa istunnosta. 
Taulun kentät
* kid int(6) auto_increment (on siis autonumber tai laskuri-tyyppinen)
* sukunimi varchar(30)
* etunimi varchar(30)
* ktunnus varchar(30)
* salasana varchar(100)
*/
require "./tietokanta/yhteys.php";
$kid=$_SESSION["kid"];//hakee kirjautumisen kohdalla luodusta istuntomuuttujasta kirjautuneen käyttäjän kid:n


if(isset($_GET["mode"])) $mode=$_GET["mode"];
else $mode="muokkaa";

/*********************************************************************/
$istuntosalasana=$_SESSION["salasana"];//otetaan muuttujaan salasana, joka käyttäjällä on kirjautuessa
$tiedotok=false;
if(!empty($_POST["etunimi"]) && !empty($_POST["sukunimi"]) && !empty($_POST["ktunnus"]) && !empty($_POST["email"]) && !empty($_POST["syntymaaika"]) && !empty($_POST["vanhasalasana"]) && muunna_salasana($_POST["vanhasalasana"])== $istuntosalasana) {
    //otetaan lähetetyt tiedot muuttujiin
    $etunimi=putsaa($_POST["etunimi"]);
    $sukunimi=putsaa($_POST["sukunimi"]);
    $email=$_POST["email"];
    $syntymaaika=$_POST["syntymaaika"];

    $tiedotok=true;

    //haetaan uudet salasanat ja tarkistetaan, että ne ovat samat. Jos ovat samat, otetaan uusi salasana muuttujaan $salasana
    if(!empty($_POST["salasana"]) && !empty($_POST["tokasalasana"]))     {

        if(putsaa($_POST["salasana"]) == putsaa($_POST["tokasalasana"])) {

            $salasana=muunna_salasana($_POST["salasana"]);
        }
        // jos eivät ole samat, mitään muutoksia ei tehdä
        else {
            $tiedotok=FALSE;
            echo "Uudet salasanat eivät vastaa toisiaan, muutoksia ei tehdä!<br>";
        }
    }
    //jos ei annettu, salasana napataan istunnosta eli vanha salasana jää voimaan
    else  {
    $salasana = $istuntosalasana;    
    }

    // salasanasuojataan lomakkeella annettu vanha salasana
    $vanhasalasana=muunna_salasana($_POST["vanhasalasana"]);

    //jos annettu vanha ei vastaa istunnossa olevaa salasanaa, muutosta ei tehdä
    if($istuntosalasana!=$vanhasalasana) {
        $tiedotok=FALSE;
        echo "Anna alkuperäinen salasana oikein!<br>";
    }

    if($tiedotok==true) {
        //rakennetaan sql-lause
        $sql="UPDATE kayttaja SET etunimi=:etunimi,sukunimi=:sukunimi,salasana=:salasana,email=:email,syntymaaika=:syntymaaika WHERE kid=:kid;";
        $kysely=$yhteys->prepare($sql);
        $kysely->execute(array(":etunimi"=>$etunimi,":sukunimi"=>$sukunimi,":email"=>$email,":syntymaaika"=>$syntymaaika,":salasana"=>$salasana,":kid"=>$kid));

        if($kysely) {
            echo "Tiedot muutettu";
            $tiedotok=true;
            $_SESSION["salasana"]=$salasana; //vaihdetaan istunnon salasanaa
        }
    }
} 

//jos tietoja puuttuu tai ei ole lähetetty lomaketta, haetaan olemassaolevat tiedot kannasta
if($tiedotok==false){

    $sql="SELECT * FROM kayttaja WHERE kid='$kid'";//huom, tieto istunnosta, ei vaarallinen
    $kysely=$yhteys->query($sql);
    if(!$kysely) echo "Käyttäjää ei löydy.";
    else     {//arvot kannasta muuttujiin 
        $rivi = $kysely->fetchAll(PDO::FETCH_ASSOC); 
        $etunimi=$rivi[0]["etunimi"];
        $sukunimi=$rivi[0]["sukunimi"];
        $email=$rivi[0]["email"];
        $syntymaaika=$rivi[0]["syntymaaika"];
        $ktunnus=$rivi[0]["ktunnus"];
        $salasana=$rivi[0]["salasana"];
    }
?>

    <form action="admin.php?sivu=muokkaa_omia_tietoja&mode=muokkaa&kid=<?php echo $kid;?>" method="post">

    <p>
    <label for="ktunnus">* Käyttäjätunnus </label><br><?php if(isset($ktunnus)) echo $ktunnus;//näyttää ktunnus arvon;?>
    <input type="hidden" name="ktunnus" value="<?php if(isset($ktunnus)) echo $ktunnus;//piilokenttä, ei näy, mutta siirtyy ?>">
    </p>
    
    <p>
    <label for="etunimi">* Etunimi </label><br>
    <input type="text" name="etunimi" value="<?php if(isset($etunimi)) echo $etunimi;?>">
    </p>
    
    <p>
    <label for="sukunimi">* Sukunimi </label><br>
    <input type="text" name="sukunimi" value="<?php if(isset($sukunimi)) echo $sukunimi;?>">
    </p>

    <p>
    <label for="syntymaaika">* Syntymäaika</label><br>
    <input type="text" id="syntymaaika" name="syntymaaika" <?php if(isset($syntymaaika)) echo $syntymaaika;?>><br>
    <a href="javascript:NewCal('syntymaaika','mmddyyyy','','')">
    <img class="kuvake" src="./tyyli/kuvat/froge.gif" width="48" height="48" border="0" alt="Klikkaa valitaksesi päivämäärä"></a><br>
    </p>
    
    <p>
    <label for="email">* Sähköposti </label><br>
    <input type="text" name="email" value="<?php if(isset($email)) echo $email;?>">
    </p>
    
    <p>    Salasanan muutos</p>
    
    <p>
    <label for="salasana">Uusi salasana </label><br>
    <input type="password" name="salasana">
    </p>
    
    <p>
    <label for="tokasalasana">Uusi salasana uudelleen </label><br>
    <input type="password" name="tokasalasana"?>
    </p>
    
    <p>
    <label for="vanhasalasana">* Vanha salasana (pakollinen kaikissa muutoksissa)</label><br>
    <input type="password" name="vanhasalasana">
    </p>
    
    <p>
    <input class="button" type="submit" value="Muuta tiedot">
    </p>
    
    </form>

<?php
}
?>