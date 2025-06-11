<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT o.odeme_id, o.musteri_id, m.musteri_ad, m.musteri_soyad, o.odeme_tutar, o.odeme_tarih, o.odeme_tur
            FROM sb_odemeler o
            INNER JOIN sb_musteriler m ON o.musteri_id = m.musteri_id
            ORDER BY o.odeme_tarih DESC";
    $stmt = $pdo->query($sql);
    $odemeler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ödeme Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-buttons a {
            display: inline-block;
            padding: 10px 20px;
            background-color:rgb(0, 0, 0);;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 0 10px;
        }

        .top-buttons a:hover {
            background-color:rgb(0, 0, 0);;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
        }

        th {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin: 2px;
            display: inline-block;
        }

        .btn-guncelle { background-color: rgb(0, 0, 0); color: white; }
        .btn-sil { background-color:rgb(0, 0, 0); color: white; }
        .btn-detay { background-color: rgb(0, 0, 0); color: white; }
    </style>
</head>
<body>
<div class="container">
    <h2>Ödeme Listesi</h2>

    <div class="top-buttons">
        <a href="o_ekle.html">➕ Ödeme Ekle</a>
    </div>

    <?php if (count($odemeler) > 0): ?>
        <table>
            <thead>
            <tr>
                <th>Müşteri</th>
                <th>Tutar (₺)</th>
                <th>Tarih</th>
                <th>Yöntem</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($odemeler as $odeme): ?>
                <tr>
                    <td><?= htmlspecialchars($odeme['musteri_ad'] . ' ' . $odeme['musteri_soyad']) ?></td>
                    <td><?= number_format($odeme['odeme_tutar'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($odeme['odeme_tarih']) ?></td>
                    <td><?= htmlspecialchars($odeme['odeme_tur']) ?></td>
                    <td>
                        <a href="o_guncelle.html?odeme_id=<?= $odeme['odeme_id'] ?>" class="btn btn-guncelle">Güncelle</a>
                        <a href="o_sil.html?odeme_id=<?= $odeme['odeme_id'] ?>" class="btn btn-sil" onclick="return confirm('Ödeme silinsin mi?')">Sil</a>
                        <a href="odeme_detay.html.php?odeme_id=<?= $odeme['odeme_id'] ?>" class="btn btn-detay">Detay</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Hiç ödeme kaydı bulunamadı.</p>
    <?php endif; ?>
</div>
</body>
</html>
