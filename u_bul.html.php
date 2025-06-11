<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Arama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef1f5;
            padding: 40px;
        }

        .form-container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-right: 10px;
        }

        button {
            padding: 10px 15px;
            background-color:rgb(0, 0, 0);
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        .no-data {
            margin-top: 20px;
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ürün Ara</h2>
    <form method="GET" action="">
        <input type="text" name="filtre" placeholder="Ürün adı, marka, kategori..." required>
        <button type="submit">Ara</button>
    </form>

    <?php include 'u_bul.php'; ?>

    <?php if (!empty($sonuclar)): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Kategori</th>
                <th>Marka</th>
                <th>Fiyat</th>
                <th>Stok</th>
            </tr>
            <?php foreach ($sonuclar as $urun): ?>
                <tr>
                    <td><?= htmlspecialchars($urun['urun_id']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_ad']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_kategori']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_marka']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_fiyat']) ?> ₺</td>
                    <td><?= htmlspecialchars($urun['urun_stok']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($_GET['filtre'])): ?>
        <p class="no-data">🔍 Sonuç bulunamadı.</p>
    <?php endif; ?>
</div>

</body>
</html>
