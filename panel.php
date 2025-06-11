<?php
session_start();
if (!isset($_SESSION['musteri_id'])) {
    header("Location: giris.html");
    exit;
}
echo "Hoşgeldiniz, " . $_SESSION['adi'] . " " . $_SESSION['soyadi'];
?>
