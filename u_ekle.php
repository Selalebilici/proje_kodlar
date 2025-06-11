<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['urun_id'], $_POST['urun_ad'], $_POST['urun_kategori'], $_POST['urun_marka'], $_POST['urun_fiyat'], $_POST['urun_stok']) &&
        !empty($_POST['urun_id']) && !empty($_POST['urun_ad']) && !empty($_POST['urun_kategori']) &&
        !empty($_POST['urun_marka']) && !empty($_POST['urun_fiyat']) && !empty($_POST['urun_stok'])
    ) {
        $urun_id = $_POST['urun_id'];
        $urun_ad = $_POST['urun_ad'];
        $urun_kategori = $_POST['urun_kategori'];
        $urun_marka = $_POST['urun_marka'];
        $urun_fiyat = $_POST['urun_fiyat'];
        $urun_stok = $_POST['urun_stok'];

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO sb_urunler (urun_id, urun_ad, urun_kategori, urun_marka, urun_fiyat, urun_stok) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$urun_id, $urun_ad, $urun_kategori, $urun_marka, $urun_fiyat, $urun_stok]);

            echo "✅ Ürün başarıyla eklendi.";
        } catch (PDOException $e) {
            echo "❌ Veritabanı hatası: " . $e->getMessage();
        }
    } else {
        echo "⛔ Gerekli veriler eksik veya hatalı.";
    }
}
?>
