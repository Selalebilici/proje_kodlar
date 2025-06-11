<?php include 'satis_detay.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Satış Detayları</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Satış Detayları</h2>

<?php if (!empty($satislar)): ?>
    <table>
        <tr>
            <th>Satış ID</th>
            <th>Müşteri ID</th>
            <th>Ürün ID</th>
            <th>Müşteri Ad Soyad</th>
            <th>Ürün</th>
            <th>Kategori</th>
            <th>Marka</th>
            <th>Birim Fiyat</th>
            <th>Satış Fiyatı</th>
            <th>Satış Tarihi</th>
        </tr>
        <?php foreach ($satislar as $satis): ?>
            <tr>
                <td><?= htmlspecialchars($satis['satis_id']) ?></td>
                <td><?= htmlspecialchars($satis['musteri_id']) ?></td>
                <td><?= htmlspecialchars($satis['urun_id']) ?></td>
                <td><?= htmlspecialchars($satis['Müşteri Ad Soyad']) ?></td>
                <td><?= htmlspecialchars($satis['Ürün']) ?></td>
                <td><?= htmlspecialchars($satis['Kategori']) ?></td>
                <td><?= htmlspecialchars($satis['Marka']) ?></td>
                <td><?= htmlspecialchars($satis['Birim Fiyat']) ?> ₺</td>
                <td><?= htmlspecialchars($satis['Satış Fiyatı']) ?> ₺</td>
                <td><?= htmlspecialchars($satis['Satış Tarihi']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="no-data"><?= isset($error_message) ? $error_message : "🔴 Satış kaydı bulunamadı." ?></p>
<?php endif; ?>

</body>
</html>
