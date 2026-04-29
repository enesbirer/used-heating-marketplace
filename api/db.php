<?php
// InfinityFree MySQL Ayarları
$host = 'localhost'; // InfinityFree'de genellikle sqlXXX.infinityfree.com olur
$db_name = 'birer_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
?>