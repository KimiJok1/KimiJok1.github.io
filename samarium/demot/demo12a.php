<?php
    if (isset($_POST["keksi"])) {
        setcookie("keksi",$_POST["keksi"],time()+3600);
    }

    if (isset($_POST["clear"])) {
        setcookie("keksi","",time());
    }
?>

<form method="post">
    <label for="keksi">Syötä keksille tieto</label><br>
    <input type="text" name="keksi" value=""/>
    <input type="submit" name="save" value="Tallenna"/>
</form>

<form method="post">
    <input type="submit" name="clear" value="Tyhjennä"/>
</form>