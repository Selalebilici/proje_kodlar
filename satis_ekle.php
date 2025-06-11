<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "sb_makyaj";
$username = "root";
$password = "0606";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $satis_id    = $_POST['satis_id'] ?? '';
    $musteri_id  = $_POST['musteri_id'] ?? '';
    $urun_id     = $_POST['urun_id'] ?? '';
    $satis_fiyat = $_POST['satis_fiyat'] ?? '';
    $satis_tarih_raw = $_POST['satis_tarih'] ?? null;
$satis_tarih = $satis_tarih_raw ? date('Y-m-d H:i:s', strtotime($satis_tarih_raw)) : null;

if ($satis_id && $musteri_id && $urun_id && $satis_fiyat && $satis_tarih) {
    // prosedür çağrısı burada
} else {
    echo "⚠️ Lütfen tüm alanları geçerli şekilde doldurun.";
}

    if ($satis_id && $musteri_id && $urun_id && is_numeric($satis_fiyat) && strtotime($satis_tarih)) {
        $stmt = $pdo->prepare("CALL sb_SatisEkle(?, ?, ?, ?, ?)");
        $stmt->execute([$satis_id, $musteri_id, $urun_id, $satis_fiyat, $satis_tarih]);

        echo "<div style='color:green;'>✅ Satış başarıyla eklendi.</div>";
    } else {
        echo "<div style='color:orange;'>⚠️ Lütfen tüm alanları geçerli şekilde doldurun.</div>";
    }

} catch (PDOException $e) {
    echo "<div style='color:red;'>❌ Hata: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>


