<?php include 'odeme_detay.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ödeme Detayları</title>
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
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: rgba(0,0,0,0.1);
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

<h2>Ödeme Detayları</h2>

<?php if (!empty($odemeler)): ?>
    <table>
        <tr>
            <th>Ödeme ID</th>
            <th>Müşteri ID</th>
            <th>Müşteri Ad Soyad</th>
            <th>Ödeme Tarihi</th>
            <th>Ödeme Tutarı</th>
            <th>Ödeme Türü</th>
        </tr>
        <?php foreach ($odemeler as $odeme): ?>
            <tr>
                <td><?= htmlspecialchars($odeme['odeme_id']) ?></td>
                <td><?= htmlspecialchars($odeme['musteri_id']) ?></td>
                <td><?= htmlspecialchars($odeme['Müşteri Ad Soyad']) ?></td>
                <td><?= htmlspecialchars($odeme['Ödeme Tarihi']) ?></td>
                <td><?= htmlspecialchars($odeme['Ödeme Tutarı']) ?></td>
                <td><?= htmlspecialchars($odeme['Ödeme Türü']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="no-data"><?= isset($error_message) ? $error_message : "🔴 Kayıt bulunamadı." ?></p>
<?php endif; ?>

</body>
</html>
