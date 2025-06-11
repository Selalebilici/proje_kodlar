<?php
// Hataları göster
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Veritabanı bağlantısı
$host = "localhost";
$dbname = "sb_makyaj";
$username = "root";
$password = "0606";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $urun_id = $_POST["urun_id"] ?? null;
    $stok = $_POST["stok"] ?? null;

    if ($urun_id && is_numeric($stok)) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE sb_urunler SET urun_stok = ? WHERE urun_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$stok, $urun_id]);

            if ($stmt->rowCount() > 0) {
                echo "<p style='color:green; text-align:center;'>✅ Stok başarıyla güncellendi.</p>";
            } else {
                echo "<p style='color:orange; text-align:center;'>⚠️ Güncellenecek ürün bulunamadı.</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='color:red; text-align:center;'>❌ Hata: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>⚠️ Lütfen tüm alanları doğru şekilde doldurun.</p>";
    }
} else {
    echo "<p style='color:red; text-align:center;'>⛔ Bu sayfa yalnızca POST isteklerini kabul eder.</p>";
}
?>
