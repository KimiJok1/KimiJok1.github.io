<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Liikunta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="./">Etusivu</a><br></li>
            <?php
                if (isset($_SESSION["id"])) {
                    $plr = getPlayerById($_SESSION["id"]);
                    if($plr[0]["admin"] == 1) {
                        echo '<li><a href="./index.php?action=admin">Admin</a><br></li>';
                    }
                    echo '<li><a href="./index.php?action=logout">Kirjaudu ulos</a><br></li>';
                } else {
                    echo '<li><a href="./index.php?action=register">Rekisteröidy</a></li>';
                    echo '<li><a href="./index.php?action=login">Kirjaudu</a><br></li>';
                }
                ?>
        </ul>
    </nav>
<hr>