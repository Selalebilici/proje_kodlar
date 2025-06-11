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
        $musteri_id   = $_POST['musteri_id']   ?? null;
        $musteri_ad   = $_POST['musteri_ad']   ?? null;
        $musteri_soyad= $_POST['musteri_soyad']?? null;
        $musteri_tel  = $_POST['musteri_tel']  ?? null;
        $musteri_mail = $_POST['musteri_mail'] ?? null;
        $musteri_adres= $_POST['musteri_adres']?? null;

        if ($musteri_id && $musteri_ad && $musteri_soyad && $musteri_tel && $musteri_mail && $musteri_adres) {
            // Prosedürü çağır
            $stmt = $pdo->prepare("CALL sb_MusteriGuncelle(:mid, :ad, :soyad, :tel, :mail, :adres)");
            $stmt->execute([
                ':mid'   => $musteri_id,
                ':ad'    => $musteri_ad,
                ':soyad' => $musteri_soyad,
                ':tel'   => $musteri_tel,
                ':mail'  => $musteri_mail,
                ':adres' => $musteri_adres
            ]);

            echo "<p style='text-align:center;color:green;'>✅ Müşteri başarıyla güncellendi.</p>";
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
