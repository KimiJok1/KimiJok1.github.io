<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP-harjoitukset</title>
        <link rel="stylesheet" href="tyyli.css">
        <link rel="icon" type="image/gif" href="./favicon.gif"/>
    </head>
    <body>
        <?php
            if (isset($_POST["logout"])) {
                setcookie("_LOGINMAIN",false, time() +0);
                header("Refresh:0");
            }
        ?>
        <form method="post">
            <input type="submit" name="logout" value="Kirjaudu ulos">
        </form>
        <div id="header">
            <a>PHP Index</a>
        </div>