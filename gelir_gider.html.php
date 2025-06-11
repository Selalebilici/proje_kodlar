<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Toplam Satış & Ödeme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ececec;
            padding: 50px;
        }

        .container {
            background-color: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
        }

        .sonuc {
            font-size: 20px;
            margin: 15px 0;
            color: #333;
        }

        .hata {
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }

        .label {
            font-weight: bold;
            color:rgb(0, 0, 0);
        }
    </style>
</head>
<body>

<?php include 'gelir_gider.php'; ?>

<div class="container">
    <h2>Toplam Satış ve Ödeme Tutarı</h2>

    <?php if ($hata): ?>
        <p class="hata"><?= htmlspecialchars($hata) ?></p>
    <?php else: ?>
        <p class="sonuc"><span class="label">💰 Toplam Satış:</span> <?= $satisToplam !== null ? $satisToplam . " ₺" : "Yok" ?></p>
        <p class="sonuc"><span class="label">💸 Toplam Ödeme:</span> <?= $odemeToplam !== null ? $odemeToplam . " ₺" : "Yok" ?></p>
    <?php endif; ?>
</div>

</body>
</html>
