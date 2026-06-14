<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "yemekticaret";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Bağlantı Başarılı";
} catch (PDOException $e) {
    echo "Hata Oluştu" . $e->getMessage() . "";
}


?>