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

        // POST verilerini al
        $musteri_id    = $_POST['musteri_id']   ?? null;
        $satis_id      = $_POST['satis_id']     ?? null;
        $odeme_tarih   = $_POST['odeme_tarih']  ?? null;
        $odeme_tutar   = $_POST['odeme_tutar']  ?? null;
        $odeme_tur     = $_POST['odeme_tur']    ?? null;

        // Gerekli alanlar dolu mu kontrol et
        if ($musteri_id && $satis_id && $odeme_tarih && $odeme_tutar && $odeme_tur) {
            // Benzersiz ödeme ID'si oluştur
            $odeme_id = uniqid("odeme_");

            // SQL sorgusu
            $sql = "INSERT INTO sb_odemeler (odeme_id, musteri_id, satis_id, odeme_tarih, odeme_tutar, odeme_tur)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $odeme_id,
                $musteri_id,
                $satis_id,
                $odeme_tarih,
                $odeme_tutar,
                $odeme_tur
            ]);

            echo "<p style='color:green; text-align:center;'>✅ Ödeme başarıyla eklendi.</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>⚠️ Lütfen tüm alanları doldurun.</p>";
        }

    } catch (PDOException $e) {
        echo "<p style='color:red; text-align:center;'>❌ Veritabanı hatası: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:red; text-align:center;'>⛔ Bu sayfa sadece POST istekleri içindir.</p>";
}
?>

