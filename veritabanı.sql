-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Haz 2025, 19:05:15
-- Sunucu sürümü: 8.0.33
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sb_makyaj`
--
CREATE DATABASE IF NOT EXISTS `sb_makyaj` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `sb_makyaj`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sb_kategoriler`
--

CREATE TABLE `sb_kategoriler` (
  `kategori_id` varchar(64) NOT NULL,
  `kategori_ad` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sb_markalar`
--

CREATE TABLE `sb_markalar` (
  `marka_id` varchar(64) NOT NULL,
  `marka_ad` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sb_musteriler`
--

CREATE TABLE `sb_musteriler` (
  `musteri_id` varchar(64) NOT NULL,
  `musteri_ad` varchar(64) DEFAULT NULL,
  `musteri_soyad` varchar(64) DEFAULT NULL,
  `musteri_tel` varchar(64) DEFAULT NULL,
  `musteri_mail` varchar(64) DEFAULT NULL,
  `musteri_adres` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `sb_musteriler`
--

INSERT INTO `sb_musteriler` (`musteri_id`, `musteri_ad`, `musteri_soyad`, `musteri_tel`, `musteri_mail`, `musteri_adres`) VALUES
('a', 'Aslı', 'Yargın', '05516489574', 'asliy@gmail.com', 'Ankara'),
('e', 'Efe', 'Baykın', '5633965487', 'efe@gmail.com', 'Sakarya'),
('s', 'Şelale', 'Bilici', '5523182765', 'selele@gmail.com', 'Ankara'),
('y', 'Sude', 'Yücel', '05523162496', 'sude@gmail.com', 'Ankara'),
('z', 'Zehra', 'Olgun', '5489652874', 'zehra@gmail.com', 'Denizli');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sb_odemeler`
--

CREATE TABLE `sb_odemeler` (
  `odeme_id` varchar(64) NOT NULL,
  `musteri_id` varchar(64) DEFAULT NULL,
  `odeme_tarih` date DEFAULT NULL,
  `odeme_tutar` float DEFAULT NULL,
  `satis_id` varchar(64) DEFAULT NULL,
  `odeme_tur` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `sb_odemeler`
--

INSERT INTO `sb_odemeler` (`odeme_id`, `musteri_id`, `odeme_tarih`, `odeme_tutar`, `satis_id`, `odeme_tur`) VALUES
('odeme_6847f87a44720', 's', '2025-07-06', 500, 'ss', 'Kredi Kartı'),
('odeme_6847f95e5b93c', 'e', '2024-05-12', 100, 'sssss', '3 taksit');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sb_satislar`
--

CREATE TABLE `sb_satislar` (
  `satis_id` varchar(64) NOT NULL,
  `musteri_id` varchar(64) DEFAULT NULL,
  `urun_id` varchar(64) DEFAULT NULL,
  `satis_tarih` date DEFAULT NULL,
  `satis_fiyat` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `sb_satislar`
--

INSERT INTO `sb_satislar` (`satis_id`, `musteri_id`, `urun_id`, `satis_tarih`, `satis_fiyat`) VALUES
('ss', 's', 'f', '2025-07-06', 500),
('sssss', 'e', 'e', '2024-05-12', 300),
('sy', 'y', 'm', '2024-02-12', 400);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sb_urunler`
--

CREATE TABLE `sb_urunler` (
  `urun_id` varchar(64) NOT NULL,
  `urun_kategori` varchar(64) DEFAULT NULL,
  `urun_marka` varchar(64) DEFAULT NULL,
  `urun_ad` varchar(64) DEFAULT NULL,
  `urun_fiyat` float DEFAULT NULL,
  `urun_stok` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `sb_urunler`
--

INSERT INTO `sb_urunler` (`urun_id`, `urun_kategori`, `urun_marka`, `urun_ad`, `urun_fiyat`, `urun_stok`) VALUES
('e', 'göz', 'maybelline', 'eyeliner', 300, 10),
('f', 'cilt', 'lorael', 'fondöten', 500, 7),
('ff', 'göz', 'Revolution', 'Far', 400, 9),
('k', 'cilt', 'maybelline', 'kapatıcı', 400, 6),
('m', 'göz', 'maybelline', 'maskara', 400, 6),
('oo', 'tırnak', 'mara', 'oje', 60, 10),
('p', 'cilt', 'pastel', 'pudra', 200, 16),
('r', 'dudak ', 'maybelline', 'ruj', 600, 12);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `sb_kategoriler`
--
ALTER TABLE `sb_kategoriler`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `sb_markalar`
--
ALTER TABLE `sb_markalar`
  ADD PRIMARY KEY (`marka_id`);

--
-- Tablo için indeksler `sb_musteriler`
--
ALTER TABLE `sb_musteriler`
  ADD PRIMARY KEY (`musteri_id`);

--
-- Tablo için indeksler `sb_odemeler`
--
ALTER TABLE `sb_odemeler`
  ADD PRIMARY KEY (`odeme_id`),
  ADD KEY `fk_satis` (`satis_id`),
  ADD KEY `sb_odemeler_ibfk_1` (`musteri_id`);

--
-- Tablo için indeksler `sb_satislar`
--
ALTER TABLE `sb_satislar`
  ADD PRIMARY KEY (`satis_id`),
  ADD KEY `urun_id` (`urun_id`),
  ADD KEY `sb_satislar_ibfk_3` (`musteri_id`);

--
-- Tablo için indeksler `sb_urunler`
--
ALTER TABLE `sb_urunler`
  ADD PRIMARY KEY (`urun_id`),
  ADD KEY `kategori_id` (`urun_kategori`),
  ADD KEY `marka_id` (`urun_marka`);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `sb_odemeler`
--
ALTER TABLE `sb_odemeler`
  ADD CONSTRAINT `fk_satis` FOREIGN KEY (`satis_id`) REFERENCES `sb_satislar` (`satis_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sb_odemeler_ibfk_1` FOREIGN KEY (`musteri_id`) REFERENCES `sb_musteriler` (`musteri_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `sb_satislar`
--
ALTER TABLE `sb_satislar`
  ADD CONSTRAINT `sb_satislar_ibfk_2` FOREIGN KEY (`urun_id`) REFERENCES `sb_urunler` (`urun_id`),
  ADD CONSTRAINT `sb_satislar_ibfk_3` FOREIGN KEY (`musteri_id`) REFERENCES `sb_musteriler` (`musteri_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
