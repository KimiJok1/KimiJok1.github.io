<?php
include "./views/partials/head.php";
?>

<?php
$user = getPlayerById($_SESSION["id"]); 
if ($user[0]["admin"] == 1) {
?>
<div class="list">
    <div class="players">
        <h2 class="label">KÄYTTÄJÄT</h2>
        <a href="index.php?action=create&type=user">Lisää uusi</a>
        <?php
        foreach($players as $player) { ?>
            <div class="userframe">
                <a class="edit" href="index.php?action=delete&pid=<?=$player["pid"]?>">Poista</a>
                <a class="delete" href="index.php?action=edit&pid=<?=$player["pid"]?>">Muokkaa</a>
                <h5>Käyttäjänimi</h5>
                <h4><?=$player["name"];?></h4>
                <h5>Merkinnät</h5>
                <h4><?=getPlayerEntriesByUserId($player["pid"])?></h4>
                <h5>Sähköpostiosoite</h5>
                <h4><?=$player["email"];?></h4>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="entries">
        <h2 class="label">MERKINNÄT</h2>
        <a href="index.php?action=create&type=entry">Lisää uusi</a>
        <?php
        foreach($entries as $entry) { ?>
            <div class="entryframe">
                <a class="edit" href="index.php?action=delete&mid=<?=$entry["mid"]?>">Poista</a>
                <a class="delete" href="index.php?action=edit&mid=<?=$entry["mid"]?>">Muokkaa</a>
                <h5>Käyttäjänimi</h5>
                <h4><?=getPlayerById($entry["user"])[0]["name"];?></h4>
                <h5>Tyyppi</h5>
                <h4><?=getLajiById($entry["sport"])[0]["name"];?></h4>
                <h5>Kesto</h5>
                <h4><?=$entry["time"]?> minuuttia</h4>
                <h5>Intensiteetti</h5>
                <h4><?=$entry["intensity"]?></h4>
                <h5>Matka</h5>
                <h4><?=$entry["length"]?>km</h4>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="sports">
        <h2 class="label">LAJIT</h2>
        <a href="index.php?action=create&type=sport">Lisää uusi</a>
        <?php
        foreach($sports as $sport) { ?>
            <div class="sportframe">
                <a class="edit" href="index.php?action=delete&lid=<?=$sport["lid"]?>">Poista</a>
                <a class="delete" href="index.php?action=edit&lid=<?=$sport["lid"]?>">Muokkaa</a>
                <h4>Laji</h4>
                <h3><?=$sport["name"];?></h3>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="adframe">
        <h2 id="adtext">MAINOS</h2>
        <div class="ad">
            <img src="./public/images/picardia.png" alt="elmo">
        </div>
    </div>
</div>

<?php
} else {
    header("Location:./index.php");
}
include "./views/partials/end.php";
?>