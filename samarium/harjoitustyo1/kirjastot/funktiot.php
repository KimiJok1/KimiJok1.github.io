<?php

function tulosta_alku()
{
    require "./kirjastot/alku.php";
    date_default_timezone_set("Europe/Helsinki"); 
}

function tulosta_admin_alku()
{
    require "./kirjastot/admin_alku.php";
    date_default_timezone_set("Europe/Helsinki"); 
}

function tulosta_loppu()
{
    require "./kirjastot/loppu.php";
}

function tulosta_admin_loppu()
{
    require "./kirjastot/admin_loppu.php";
}

function tulosta_sisalto($sivu)
{
    $sallitut=array('rekisteroidy','kirjaudu','arvostelu','kirjoittajan_arvostelut','etusivu');
    if(in_array($sivu,$sallitut))     {
        $sivu=$sivu.".php";
        require "./sisalto/$sivu";
    }
    else require "./sisalto/etusivu.php";
}

function tulosta_admin_sisalto($sivu)
{
    $sallitut=array('muokkaa_omia_tietoja','lisaa_arvostelu','muokkaa_arvostelua','admin_etusivu');
    if(in_array($sivu,$sallitut))     {
        $sivu=$sivu.".php";
        require "./sisalto/$sivu";
    }
    else require "./sisalto/admin_etusivu.php";
}

function putsaa($sana)
{
    $sana=trim($sana);//poistaa tyhjät merkit merkkijonon alusta ja lopusta
    $sana=htmlspecialchars($sana); //muuntaa html-tagit entiteeteiksi
    return $sana;
}

function muunna_salasana($sana) //apufunktio salasanan vahvistusta varten
{
    $sana = hash("sha256",$sana);
    return $sana;
}

?>