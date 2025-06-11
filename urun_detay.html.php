<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['urun_id'])) {
    echo "Ürün ID belirtilmedi.";
    exit();
}

$urun_id = $_GET['urun_id'];

// Veritabanı bağlantısı
$host = "localhost";
$dbname = "sb_makyaj";
$username = "root";
$password = "0606";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM sb_urunler WHERE urun_id = :urun_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':urun_id' => $urun_id]);
    $urun = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$urun) {
        echo "Ürün bulunamadı.";
        exit();
    }
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Detayı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        strong {
            color: #444;
        }

        .price {
            color: #000000;
            font-weight: bold;
            font-size: 20px;
        }

        .back-link {
            display: block;
            margin-top: 30px;
            text-align: center;
        }

        .back-link a {
            color: #000000;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= htmlspecialchars($urun['urun_ad']) ?></h2>
        <p><strong>Kategori:</strong> <?= htmlspecialchars($urun['urun_kategori']) ?></p>
        <p><strong>Marka:</strong> <?= htmlspecialchars($urun['urun_marka']) ?></p>
        <p><strong>Fiyat:</strong> <span class="price"><?= htmlspecialchars($urun['urun_fiyat']) ?> ₺</span></p>
        <p><strong>Stok:</strong> <?= htmlspecialchars($urun['urun_stok']) ?></p>

        <div class="back-link">
            <a href="urunler.php">← Ürün Listesine Dön</a>
        </div>
    </div>
</body>
</html>
