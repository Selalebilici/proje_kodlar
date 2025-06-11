<?php
$host = "localhost";
$dbname = "sb_makyaj";
$username = "root";
$password = "0606";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $satis_id = $_POST['satis_id'] ?? null;

    if ($satis_id) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Satış Silme SQL (veya prosedür)
            $stmt = $pdo->prepare("DELETE FROM sb_satislar WHERE satis_id = ?");
            $stmt->execute([$satis_id]);

            if ($stmt->rowCount() > 0) {
                echo "✅ Satış başarıyla silindi.";
            } else {
                echo "⚠️ Belirtilen ID ile eşleşen satış bulunamadı.";
            }

        } catch (PDOException $e) {
            echo "❌ Hata: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Lütfen Satış ID bilgisini girin.";
    }
} else {
    echo "Form gönderilmedi.";
}
?>
