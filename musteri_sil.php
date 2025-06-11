<?php
$musteri_id = $_GET['musteri_id'] ?? null;

if ($musteri_id && !empty($musteri_id)) {
    $host = "localhost";
    $dbname = "sb_makyaj";
    $username = "root";
    $password = "0606";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM sb_musteriler WHERE musteri_id = :id");
        $stmt->bindParam(':id', $musteri_id, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "✅ Müşteri ID: $musteri_id başarıyla silindi.";
        } else {
            echo "⚠️ Müşteri ID: $musteri_id bulunamadı.";
        }
    } catch (PDOException $e) {
        echo "❌ Hata: " . $e->getMessage();
    }
} else {
    echo "⛔ Lütfen geçerli bir müşteri ID girin.";
}
?>

