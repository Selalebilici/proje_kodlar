<?php
$sonuclar = [];
$hata = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['filtre'])) {
    $filtre = $_GET['filtre'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("CALL sb_UrunBul(:filtre)");
        $stmt->execute(['filtre' => $filtre]);
        $sonuclar = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $hata = "❌ Hata: " . $e->getMessage();
    }
}
?>
