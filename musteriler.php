<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT musteri_id, musteri_ad, musteri_soyad, musteri_tel, musteri_mail FROM sb_musteriler ORDER BY musteri_ad ASC";
    $stmt = $pdo->query($sql);
    $musteriler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Müşteri Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .top-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-buttons a {
            display: inline-block;
            margin: 5px 10px;
            padding: 8px 16px;
            background-color:rgb(0, 0, 0);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .top-buttons a:hover {
            background-color:rgb(0, 0, 0);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2px;
        }

        .btn-sil {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        .btn-guncelle {
            background-color:rgb(0, 0, 0);
            color: white;
        }

        .btn-bakiye {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        a.btn {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Müşteri Listesi</h2>

        <div class="top-buttons">
            <a href="m_ekle.html">➕ Ekle</a>
        </div>

        <?php if (count($musteriler) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th> <!-- Müşteri ID eklendi -->
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Telefon</th>
                    <th>E-posta</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($musteriler as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['musteri_id']) ?></td> <!-- ID gösteriliyor -->
                    <td><?= htmlspecialchars($m['musteri_ad']) ?></td>
                    <td><?= htmlspecialchars($m['musteri_soyad']) ?></td>
                    <td><?= htmlspecialchars($m['musteri_tel']) ?></td>
                    <td><?= htmlspecialchars($m['musteri_mail']) ?></td>
                    <td>
                        <a href="musteri_sil.php?musteri_id=<?= $m['musteri_id'] ?>" class="btn btn-sil" onclick="return confirm('Müşteri silinsin mi?')">Sil</a>
                        <a href="m_guncelle.html?musteri_id=<?= $m['musteri_id'] ?>" class="btn btn-guncelle">Güncelle</a>
                        <a href="musteri_bakiye.html.php" class="btn btn-bakiye">Bakiye</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Hiç müşteri bulunamadı.</p>
        <?php endif; ?>
    </div>
</body>
</html>

