<?php
// config/database.php
$host = 'localhost';
$db = 'DietaDB';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Eroare la conectarea la baza de date: " . $e->getMessage());
}
?>