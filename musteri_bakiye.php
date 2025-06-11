<?php
$bakiye = null;
$hata = null;


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['musteri_id'])) {
    $musteri_id = $_POST['musteri_id'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("CALL sb_MusteriBakiye(?)");
        $stmt->execute([$musteri_id]);
        $bakiye = $stmt->fetchColumn();

    } catch (PDOException $e) {
        $hata = "❌ Hata: " . $e->getMessage();
    }
}
?>
