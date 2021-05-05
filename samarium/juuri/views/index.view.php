<?php
include "./views/partials/head.php";
?>

<h1>Kaikki pelaajat</h1>

<?php
if(isset($message)) echo $message;
?>


<?php
foreach($players as $player) { ?>
<h4><?=$player["nickname"];?></h4>
<?php
}
include "./views/partials/end.php";
?>