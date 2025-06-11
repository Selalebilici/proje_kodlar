<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Müşteri Bakiye Sorgulama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 40px;
        }

        form {
            background: #fff;
            max-width: 400px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label, input {
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color:rgb(0, 0, 0);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color:rgb(0, 0, 0);
        }

        .result {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<form action="" method="POST">
    <h2>Müşteri Bakiye Sorgulama</h2>
    <label for="musteri_id">Müşteri ID:</label>
    <input type="text" name="musteri_id" id="musteri_id" required>

    <button type="submit">Sorgula</button>

    <?php include 'musteri_bakiye.php'; ?>
    
    <?php if ($bakiye !== null): ?>
        <p class="result">🔎 Müşteri Bakiyesi: <?= htmlspecialchars($bakiye) ?> ₺</p>
    <?php elseif ($hata): ?>
        <p class="error"><?= htmlspecialchars($hata) ?></p>
    <?php endif; ?>
</form>

</body>
</html>
