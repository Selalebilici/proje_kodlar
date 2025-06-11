<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT urun_id, urun_ad, urun_kategori, urun_fiyat, urun_stok FROM sb_urunler ORDER BY urun_ad ASC";
    $stmt = $pdo->query($sql);
    $urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
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

        .top-buttons2 {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1000;
}

.top-buttons2 a {
    display: inline-block;
    text-decoration: underline;
    border-bottom: 2px solid black; /* siyah alt çizgi */
    text-decoration: none;
    padding: 8px 16px;
    background-color: transparent; /* Arka plan yok */
    color: black; /* Siyah renk */
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
}

.top-buttons2 a:hover {
    color: #555; 
    text-decoration: none;
}


        .top-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-buttons a {
            display: inline-block;
            margin: 5px 10px;
            padding: 8px 16px;
            background-color:rgb(0, 0, 0);;
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
            background-color:rgb(0, 0, 0);
            color: white;
        }

        .btn-guncelle {
            background-color:rgb(0, 0, 0);
            color: white;
        }

        .btn-stok {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        .btn-detay {
            background-color:rgb(0, 0, 0);;
            color: white;
        }

        form.inline-form {
            display: inline;
        }

        input[type="number"] {
            width: 60px;
            padding: 4px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Ürün Listesi</h2>

        <div class="top-buttons">
            <a href="u_ekle.html">➕ Ekle</a>
            <a href="u_bul.html.php">🔍 Bul</a>
            
        </div>
        <div class="top-buttons2">
    <a href="index.html">-> Ana Sayfa</a>
</div>


        <?php if (count($urunler) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Kategori</th>
                    <th>Fiyat (₺)</th>
                    <th>Stok</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($urunler as $urun): ?>
                <tr>
                    <td><?= htmlspecialchars($urun['urun_ad']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_kategori']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_fiyat']) ?></td>
                    <td><?= htmlspecialchars($urun['urun_stok']) ?></td>
                    <td>
                        <a href="urun_sil.php?urun_id=<?= $urun['urun_id'] ?>" class="btn btn-sil" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">Sil</a>
                        <a href="u_guncelle.html?urun_id=<?= $urun['urun_id'] ?>" class="btn btn-guncelle">Güncelle</a>
                        <a href="urun_detay.html.php?urun_id=<?= $urun['urun_id'] ?>" class="btn btn-detay">Detay</a>
                        
                        <form action="u_stokguncelle.html" method="get" class="inline-form">
                            <input type="hidden" name="urun_id" value="<?= $urun['urun_id'] ?>">
                            <input type="number" name="yeni_stok" min="0" placeholder="Stok">
                            <button type="submit" class="btn btn-stok">Stok Güncelle</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Hiç ürün bulunamadı.</p>
        <?php endif; ?>
    </div>
</body>
</html>
