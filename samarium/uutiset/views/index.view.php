<?php
include "./views/partials/head.php";
?>

<h1>Kaikki uutiset</h1>

<?php
if(isset($message)) echo $message;
?>


<?php
foreach($uutiset as $uutinen) { ?>
<h2><?=$uutinen["otsikko"];?></h2>
<p><?=substr($uutinen["sisalto"], 0, 100) . "...";?></p>
<a href="./index.php?action=shownews&uutinenID=<?=$uutinen["uutinenID"];?>">Lue lisää</a>
<?php
}
include "./views/partials/end.php";
?>