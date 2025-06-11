<?php
$satisToplam = null;
$odemeToplam = null;
$hata = null;

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sb_makyaj;charset=utf8", "root", "0606");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt1 = $pdo->query("CALL sb_SatislarToplam()");
    $satisToplam = $stmt1->fetchColumn();
    $stmt1->closeCursor(); 

    
    $stmt2 = $pdo->query("CALL sb_OdemelerToplam()");
    $odemeToplam = $stmt2->fetchColumn();
    $stmt2->closeCursor();

} catch (PDOException $e) {
    $hata = "❌ Hata: " . $e->getMessage();
}
?>
