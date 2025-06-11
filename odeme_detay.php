<?php
// Veritabanı bağlantısı
$host = "localhost";
$dbname = "sb_makyaj";
$username = "root";
$password = "0606";

$odemeler = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prosedürü çağır
    $stmt = $pdo->query("CALL sb_OdemeDetay()");
    $odemeler = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error_message = "❌ Hata: " . $e->getMessage();
}
?>
