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
        $urun_id       = $_POST['urun_id']       ?? null;
        $urun_ad       = $_POST['urun_ad']       ?? null;
        $urun_kategori = $_POST['urun_kategori'] ?? null;
        $urun_marka    = $_POST['urun_marka']    ?? null;
        $urun_fiyat    = $_POST['urun_fiyat']    ?? null;
        $urun_stok     = $_POST['urun_stok']     ?? null;

        if ($urun_id && $urun_ad && $urun_kategori && $urun_marka && $urun_fiyat && $urun_stok) {
            // Prosedürü çağır
            $stmt = $pdo->prepare("CALL sb_UrunGuncelle(:uid, :ad, :kategori, :marka, :fiyat, :stok)");
            $stmt->execute([
                ':uid'      => $urun_id,
                ':ad'       => $urun_ad,
                ':kategori' => $urun_kategori,
                ':marka'    => $urun_marka,
                ':fiyat'    => $urun_fiyat,
                ':stok'     => $urun_stok
            ]);

            echo "<p style='text-align:center;color:green;'>✅ Ürün başarıyla güncellendi.</p>";
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
