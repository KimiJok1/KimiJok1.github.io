<?php
$dsn = 'mysql:dbname=20jokkim;host=localhost';
$user = '20jokkim';
$passwd = 'U2FsYW1hNTY3IQ==';

try {
    $pdo = new PDO($dsn, $user, base64_decode($passwd));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>