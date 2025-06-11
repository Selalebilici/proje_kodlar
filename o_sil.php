<?php
// Hataları göster
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Veritabanı bilgileri
$host = "localhost";
$dbname = "sb_makyaj";
$username = "root";
$password = "0606";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $odeme_id = $_POST['odeme_id'] ?? null;

        if ($odeme_id) {
            $stmt = $pdo->prepare("CALL sb_OdemeSil(:oid)");
            $stmt->execute([
                ':oid' => $odeme_id
            ]);

            echo "<p style='text-align:center; color:green;'>✅ Ödeme başarıyla silindi.</p>";
        } else {
            echo "<p style='text-align:center; color:red;'>⚠️ Ödeme ID girilmedi.</p>";
        }

    } catch (PDOException $e) {
        echo "<p style='text-align:center; color:red;'>❌ Hata: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='text-align:center; color:red;'>⛔ Bu sayfa sadece POST istekleri içindir.</p>";
}
?>
