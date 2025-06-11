<?php
// Bağlantı
$conn = new mysqli("localhost", "root", "0606", "sb_makyaj");
if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}

// Silme işlemi
if (isset($_GET['sil'])) {
    $urun_id = $conn->real_escape_string($_GET['sil']);
    $conn->query("DELETE FROM sb_urunler WHERE urun_id = '$urun_id'");
    header("Location: urun_sil.php"); // Sayfayı yenile
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Ürün Sil</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        padding: 30px;
    }
    h2 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        margin-top: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color:rgb(0, 0, 0);
        color: white;
    }
    .sil-button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }
    .sil-button:hover {
        background-color: #c82333;
    }
  </style>
</head>
<body>

<h2>Ürün Silme</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Ad</th>
    <th>Kategori</th>
    <th>Marka</th>
    <th>Fiyat</th>
    <th>Stok</th>
    <th>İşlem</th>
  </tr>

<?php
// Ürünleri listele
$result = $conn->query("SELECT * FROM sb_urunler");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['urun_id']}</td>
            <td>{$row['urun_ad']}</td>
            <td>{$row['urun_kategori']}</td>
            <td>{$row['urun_marka']}</td>
            <td>{$row['urun_fiyat']}</td>
            <td>{$row['urun_stok']}</td>
            <td><a href='urun_sil.php?sil={$row['urun_id']}' onclick='return confirm(\"Bu ürünü silmek istediğinize emin misiniz?\")'>
                <button class='sil-button'>Sil</button>
            </a></td>
          </tr>";
}
?>

</table>
</body>
</html>
