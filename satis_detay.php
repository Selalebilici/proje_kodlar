<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("
        SELECT
            s.satis_id,
            m.musteri_id,
            u.urun_id,
            CONCAT(m.musteri_ad, ' ', m.musteri_soyad) AS `Müşteri Ad Soyad`,
            u.urun_ad AS `Ürün`,
            u.urun_kategori AS `Kategori`,
            u.urun_marka AS `Marka`,
            u.urun_fiyat AS `Birim Fiyat`,
            s.satis_fiyat AS `Satış Fiyatı`,
            s.satis_tarih AS `Satış Tarihi`
        FROM sb_musteriler m
        INNER JOIN sb_satislar s ON m.musteri_id = s.musteri_id
        INNER JOIN sb_urunler u ON s.urun_id = u.urun_id
    ");

    $satislar = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error_message = "❌ Hata: " . $e->getMessage();
}
?>
