<?php

$conn = mysqli_connect("localhost", "root", "", "shopping");

$host = 'localhost';
$dbname = 'shopping';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    die("Koneksi gagal: " . $e->getMessage());
}
?>