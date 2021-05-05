<?php
include "./views/partials/head.php";
?>
<?php
if(isset($message)) echo $message;
?>


<h2><?=$uutinen[0]["otsikko"];?></h2>
<p><?=$uutinen[0]["sisalto"];?></p>

<?php
include "./views/partials/end.php";
?>