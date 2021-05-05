<?php
include "./views/partials/adminhead.php";
?>
<h1>Hallintapaneeli</h1>
<hr>
<h2>Käyttäjät</h2>
<?php
if(isset($message)) echo $message;

foreach($users as $user) { ?>
<h3><?=$user["kayttajatunnus"];?></h3>
<a href="./index.php?action=deleteuser&kayttajaID=<?= $user["kayttajaID"];?>">Poista</a><br>
<?php
}

?>
<hr>
<h2>Uutiset </h2>

<a href="./index.php?action=addnews">Luo uusi uutinen</a><br>
<?php

foreach($uutiset as $uutinen) { ?>
<h3><?=$uutinen["otsikko"];?></h3>
<p><?=substr($uutinen["sisalto"], 0, 100) . "...";?></p>
<a href="./index.php?action=editnews&uutinenID=<?= $uutinen["uutinenID"];?>">Muokkaa</a><br>
<a href="./index.php?action=deletenews&uutinenID=<?= $uutinen["uutinenID"];?>">Poista</a><br>

<?php
}
include "./views/partials/end.php";
?>