<?php
include "./views/partials/adminhead.php";
?>
<h1>Hallintapaneeli</h1>

<?php
if(isset($message)) echo $message;
?>


<?php
foreach($players as $player) { ?>
<h4><?=$player["nickname"];?></h4>
<a href="./index.php?action=editplayer&playerID=<?= $player["playerID"];?>">Muokkaa</a><br>
<a href="./index.php?action=deleteplayer&playerID=<?= $player["playerID"];?>">Poista</a><br>

<?php
}
include "./views/partials/end.php";
?>