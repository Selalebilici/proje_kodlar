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
        // PDO bağlantısı
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Form verilerini al
        $odeme_id    = $_POST['odeme_id']     ?? null;
        $musteri_id  = $_POST['musteri_id']   ?? null;
        $odeme_tarih = $_POST['odeme_tarih']  ?? null;
        $odeme_tutar = $_POST['odeme_tutar']  ?? null;
        $odeme_tur   = $_POST['odeme_tur']    ?? null;

        if ($odeme_id && $musteri_id && $odeme_tarih && $odeme_tutar && $odeme_tur) {
            // Prosedürü çağır
            $stmt = $pdo->prepare("CALL sb_OdemeGuncelle(:oid, :mid, :tarih, :tutar, :tur)");
            $stmt->execute([
                ':oid'   => $odeme_id,
                ':mid'   => $musteri_id,
                ':tarih' => $odeme_tarih,
                ':tutar' => $odeme_tutar,
                ':tur'   => $odeme_tur
            ]);

            echo "<p style='text-align:center;color:green;'>✅ Ödeme başarıyla güncellendi.</p>";
        } else {
            echo "<p style='text-align:center;color:red;'>⚠️ Lütfen tüm alanları doldurun.</p>";
        }

    } catch (PDOException $e) {
        echo "<p style='text-align:center;color:red;'>❌ Hata: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='text-align:center;color:red;'>⛔ Bu sayfa sadece POST istekleri içindir.</p>";
}
?>
