<?php
require "./yhteys.php";
 
if (isset($_GET["id"])){
    // tuli get
    $sql = "SELECT * FROM h10_tapahtumat WHERE tapahtumaID=?";
    $data = array($_GET["id"]);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $rows = $stmt->fetchAll();
    //var_dump($rows);
    if (!$rows) {
        echo "Ei Paikkoja!";
    }
    else {
        $nimi = $rows[0]["nimi"];
        $paivays = $rows[0]["paivays"];
        $tapahtumaID = $_GET["id"];
    }
}
 
if (isset($_POST["nimi"], $_POST["paivays"], 
 $_POST["tapahtumaID"])) {
    // tuli post 
    $nimi = $_POST["nimi"];
    $paivays = $_POST["paivays"];
    $tapahtumaID = $_POST["id"];
    $data = array($_POST["nimi"], $_POST["paivays"], $_POST["tapahtumaID"]);
    $sql = "UPDATE `h10_tapahtumat` SET `nimi`=?, 
        `paivays`=? WHERE tapahtumaID=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    header('Location: ../partials/index.php?sivu=harj10&kansio=harjoitukset');
    exit;
}
 
?>
<h2>Muokkaa tapahtumaa</h2>
<form method="post">
<input type="text" value="<?php echo $nimi; ?>" name="nimi" /><br />
<input type="date" value="<?php echo $paivays; ?>" name="paivays" /><br />
<input type="hidden" name="tapahtumaID" value="<?php echo $tapahtumaID; ?>" />
<input type="submit" value="Save" /><br />
</form>