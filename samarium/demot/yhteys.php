<?php
// Yhteys
$dsn = 'mysql:dbname=20jokkim;host=localhost';
$user = '20jokkim';
$password = 'U2FsYW1hNTY3IQ==';

try {
    $pdo = new PDO($dsn, $user, base64_decode($password));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>