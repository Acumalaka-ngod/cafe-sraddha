-- Tabel addons
CREATE TABLE IF NOT EXISTS `addons` (
  `id_addon` int NOT NULL AUTO_INCREMENT,
  `nama_addon` varchar(100) NOT NULL,
  `harga` decimal(10,2) DEFAULT '0.00',
  `kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_addon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Kolom addons di detail_transaksi
ALTER TABLE `detail_transaksi` ADD COLUMN IF NOT EXISTS `addons` TEXT NULL AFTER `subtotal`;
