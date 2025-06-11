<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    if (
        isset($_POST['musteri_id'], $_POST['adi'], $_POST['soyadi'], $_POST['telefon'], $_POST['mail'], $_POST['adres']) &&
        !empty($_POST['musteri_id'])
    ) {
        $host = "localhost";
        $dbname = "sb_makyaj";
        $username = "root";
        $password = "0606";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Değerleri al
            $musteriID = $_POST['musteri_id'];
            $adi = $_POST['adi'];
            $soyadi = $_POST['soyadi'];
            $telefon = $_POST['telefon'];
            $mail = $_POST['mail'];
            $adres = $_POST['adres'];

            // Stored procedure çağrısı
            $stmt = $conn->prepare("CALL sb_MusteriEkle(:musteriID, :adi, :soyadi, :telefon, :mail, :adres)");
            $stmt->bindParam(':musteriID', $musteriID, PDO::PARAM_STR);
            $stmt->bindParam(':adi', $adi, PDO::PARAM_STR);
            $stmt->bindParam(':soyadi', $soyadi, PDO::PARAM_STR);
            $stmt->bindParam(':telefon', $telefon, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':adres', $adres, PDO::PARAM_STR);

            $stmt->execute();

            echo "✅ Müşteri başarıyla eklendi.";
        } catch (PDOException $e) {
            echo "❌ Hata: " . $e->getMessage();
        }

    } else {
        echo "Lütfen tüm alanları doldurun.";
    }

} else {
    echo "Form gönderilmedi.";
}
?>

