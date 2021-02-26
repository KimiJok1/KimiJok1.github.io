<?php

    require "yhteys.php";

    $sql = "SELECT * FROM users";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    $ok = false;

    if (isset($_COOKIE["_LOGIN"])) {
        $ok = $_COOKIE["_LOGIN"];
    }

    if (isset($_POST["password"]) && isset($_POST["username"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll();

        if (count($rows) > 0) {
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $stmt = $pdo->query($sql);
            $rows = $stmt->fetchAll();
            if (count($rows) > 0) {
                setcookie("_LOGIN", true, time() +2592000);
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "Not a valid account!";
        }
    }

    if (isset($_POST["password_reg"]) && isset($_POST["username_reg"])) {
        $username_reg = $_POST["username_reg"];
        $password_reg = $_POST["password_reg"];

        $sql = "SELECT * FROM users WHERE username='$username_reg' AND password='$password_reg'";
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll();

        if (count($rows) > 0) {
            echo "Username already exists!";
        } else {
            $sql = "INSERT INTO `users` (`username`, `password`) VALUES (?, ?)";
            $data = array ($username_reg, $password_reg);

            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
            setcookie("_LOGIN", true, time() +2592000);
            $ok = true;
        }
    }

    if (isset($_POST["logout"])) {
        setcookie("_LOGIN", false, time() +0);
        $ok = false;
    }
    
    if ($ok == false) {
?>

<form method="post">
    <label for="keksi">Rekisteröidy</label><br>
    <input type="text" name="username_reg" value=""/><br>
    <input type="password" name="password_reg" value=""/><br>   
    <input type="submit" name="register" value="Rekisteröidy"/>
</form><br>

<form method="post">
    <label for="keksi">Kirjaudu sisään</label><br>
    <input type="text" name="username" value=""/><br>
    <input type="password" name="password" value=""/><br>   
    <input type="submit" name="login" value="Kirjaudu"/>
</form>

<?php
    } else {
?>

<form method="post">
    <input type="submit" name="logout" value="Kirjaudu ulos"/>
</form>


<?php
    }
?>