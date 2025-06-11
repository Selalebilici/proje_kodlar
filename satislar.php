<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT 
                s.satis_id, 
                s.satis_tarih, 
                s.satis_fiyat,
                m.musteri_ad, 
                m.musteri_soyad, 
                u.urun_ad 
            FROM sb_satislar s
            LEFT JOIN sb_musteriler m ON s.musteri_id = m.musteri_id
            LEFT JOIN sb_urunler u ON s.urun_id = u.urun_id
            ORDER BY s.satis_tarih DESC";
    $stmt = $pdo->query($sql);
    $satislar = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satışlar Listesi</title>
    <style>
        table {border-collapse: collapse; width: 100%;}
        th, td {border: 1px solid #ccc; padding: 8px; text-align: left;}
        th {background-color: #eee;}
        a.button {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            background-color:rgb(0, 0, 0);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }
        a.button.delete {background-color: #f44336;}
        a.button.detail {background-color:rgb(0, 0, 0);}
    </style>
</head>
<body>
    <h2>Satışlar</h2>

    <p>
        <a href="satis_ekle.html" class="button">Yeni Satış Ekle</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Satış ID</th>
                <th>Müşteri</th>
                <th>Ürün</th>
                <th>Tarih</th>
                <th>Fiyat (₺)</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($satislar): ?>
                <?php foreach ($satislar as $satis): ?>
                    <tr>
                        <td><?= htmlspecialchars($satis['satis_id']) ?></td>
                        <td><?= htmlspecialchars($satis['musteri_ad'] . ' ' . $satis['musteri_soyad']) ?></td>
                        <td><?= htmlspecialchars($satis['urun_ad']) ?></td>
                        <td><?= htmlspecialchars($satis['satis_tarih']) ?></td>
                        <td><?= htmlspecialchars(number_format($satis['satis_fiyat'], 2)) ?></td>
                        <td>
                            <a href="satis_detay.html.php?satis_id=<?= urlencode($satis['satis_id']) ?>" class="button detail">Detay</a>
                            <a href="satis_sil.html?satis_id=<?= urlencode($satis['satis_id']) ?>" class="button delete" onclick="return confirm('Bu satışı silmek istediğinizden emin misiniz?');">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Satış bulunamadı.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
