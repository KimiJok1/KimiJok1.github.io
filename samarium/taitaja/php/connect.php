<?php

$dsn = 'mysql:dbname=T2021280_DB;host=localhost';
$user = 'T2021280_user';
$password = 'U2FsYW1hNTY3MCE=';

try {
    $pdo = new PDO($dsn, $user, base64_decode($password));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>