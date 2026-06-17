-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2026 at 04:08 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sraddha_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_menu` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_menu`, `jumlah`, `harga`, `subtotal`) VALUES
(2, 15, 10, 1, 26000.00, 26000.00),
(3, 15, 12, 1, 25000.00, 25000.00),
(12, 14, 2, 1, 23000.00, 23000.00),
(13, 17, 2, 5, 23000.00, 115000.00);

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int NOT NULL,
  `no_meja` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `no_meja`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(8, '04'),
(9, '05'),
(10, '06'),
(11, '07'),
(12, '08'),
(13, '100');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `kategori` enum('Coffee','Non Coffee','Manual Brew','Tea','Chocolate') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int DEFAULT '0',
  `deskripsi` text,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `kategori`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
(1, 'Kopsu GA', 'Coffee', 21000.00, 40, 'Kopi susu gula aren (hot)', 'kopi-susu-ga.jpg'),
(2, 'Kopsu GA (Ice)', 'Coffee', 23000.00, 41, 'Kopi susu gula aren (ice)', 'd8fd167a30cf300f1d1271312304f2.jpg'),
(3, 'Kopsu DAN', 'Coffee', 24000.00, 25, 'Kopi susu pandan', 'dan.jpg'),
(4, 'Kopsu Klasik', 'Coffee', 22000.00, 48, 'Kopi susu klasik', 'kopsu.jpg'),
(5, 'Avocado Coffee', 'Coffee', 30000.00, 51, 'Kopi alpukat', 'avocado-coffee-foto-resep-utama.jpg'),
(6, 'Matcha Coffee', 'Coffee', 28000.00, 40, 'Kopi matcha', 'mtcha.jpg'),
(7, 'Baileys Coffee', 'Coffee', 27000.00, 40, 'Kopi baileys', 'images.jpg'),
(8, 'Mochachino', 'Coffee', 27000.00, 33, 'Kopi mocha', 'Mochachino.jpg'),
(9, 'Banana Coffee', 'Coffee', 26000.00, 40, 'Kopi pisang', 'Banana_Coffee.jpg'),
(10, 'Butterscotch', 'Coffee', 26000.00, 34, 'Kopi butterscotch', 'Butterscotch.jpg'),
(11, 'Caramel Latte', 'Coffee', 25000.00, 40, 'Kopi caramel', 'images_(1).jpg'),
(12, 'Hazelnut Latte', 'Coffee', 25000.00, 39, 'Kopi hazelnut', 'Hazelnut_Latte.jpg'),
(13, 'Vanilla Latte', 'Coffee', 25000.00, 40, 'Kopi vanilla', 'Vanilla_Latte.jpg'),
(14, 'Cafe Latte', 'Coffee', 20000.00, 40, 'Latte hot', 'Cafe_Latte.jpg'),
(15, 'Cafe Latte (Ice)', 'Coffee', 22000.00, 40, 'Latte ice', 'Cafe_Latte_(Ice).jpg'),
(16, 'Cappuccino', 'Coffee', 20000.00, 40, 'Cappuccino hot', 'Cappuccino.jpg'),
(17, 'Cappuccino (Ice)', 'Coffee', 22000.00, 40, 'Cappuccino ice', 'Cappuccino_ice.jpg'),
(18, 'Americano', 'Coffee', 18000.00, 40, 'Americano hot', 'Americano.jpg'),
(19, 'Americano (Ice)', 'Coffee', 20000.00, 40, 'Americano ice', 'Americano_ice.jpg'),
(20, 'Espresso', 'Coffee', 15000.00, 40, 'Espresso', 'Espresso.jpg'),
(21, 'Mastrala', 'Non Coffee', 30000.00, 30, 'Minuman non kopi', ''),
(22, 'Komayu', 'Non Coffee', 26000.00, 30, 'Minuman non kopi', ''),
(23, 'Mala (Hot)', 'Non Coffee', 23000.00, 30, 'Matcha latte', ''),
(24, 'Mala (Ice)', 'Non Coffee', 25000.00, 30, 'Matcha latte ice', ''),
(25, 'Tala (Hot)', 'Non Coffee', 22000.00, 30, 'Taro latte', ''),
(26, 'Tala (Ice)', 'Non Coffee', 24000.00, 30, 'Taro latte ice', ''),
(27, 'Revela (Hot)', 'Non Coffee', 22000.00, 30, 'Red velvet latte', ''),
(28, 'Revela (Ice)', 'Non Coffee', 24000.00, 30, 'Red velvet latte ice', ''),
(29, 'Mocktail', 'Non Coffee', 25000.00, 30, 'Minuman segar', ''),
(30, 'Air Mineral', 'Non Coffee', 4000.00, 100, 'Air putih', ''),
(31, 'Choco Rum', 'Chocolate', 28000.00, 30, 'Coklat rum', ''),
(32, 'Choco Hazelnut', 'Chocolate', 27000.00, 30, 'Coklat hazelnut', ''),
(33, 'Choco Caramel', 'Chocolate', 27000.00, 30, 'Coklat caramel', ''),
(34, 'Choco Vanilla', 'Chocolate', 27000.00, 30, 'Coklat vanilla', ''),
(35, 'Choco', 'Chocolate', 25000.00, 30, 'Coklat original', ''),
(36, 'Lychee Tea', 'Tea', 17000.00, 30, 'Teh lychee', ''),
(37, 'Lemon Tea (Hot)', 'Tea', 13000.00, 30, 'Teh lemon panas', ''),
(38, 'Lemon Tea (Ice)', 'Tea', 15000.00, 30, 'Teh lemon dingin', ''),
(39, 'Sweet Tea (Hot)', 'Tea', 10000.00, 30, 'Teh manis panas', ''),
(40, 'Sweet Tea (Ice)', 'Tea', 12000.00, 30, 'Teh manis dingin', ''),
(41, 'V60', 'Manual Brew', 25000.00, 20, 'Manual brew V60', ''),
(42, 'V60 Special Beans', 'Manual Brew', 30000.00, 20, 'V60 beans spesial', ''),
(43, 'Japanese', 'Manual Brew', 27000.00, 20, 'Japanese style', ''),
(44, 'Japanese Special Beans', 'Manual Brew', 32000.00, 20, 'Japanese beans spesial', ''),
(45, 'Vietnam Drip', 'Manual Brew', 22000.00, 20, 'Vietnam drip', ''),
(46, 'Tea (Refill All)', 'Manual Brew', 22000.00, 20, 'Teh refill', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_user` int NOT NULL,
  `id_meja` int NOT NULL,
  `no_pesanan` varchar(50) NOT NULL,
  `no_invoce` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `metode_pembayaran` enum('Tunai','QRIS') DEFAULT NULL,
  `status_pembayaran` enum('pending','paid') DEFAULT 'pending',
  `status_pesanan` enum('diproses','selesai','dibatalkan') DEFAULT 'diproses',
  `total_harga` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_meja`, `no_pesanan`, `no_invoce`, `tanggal`, `metode_pembayaran`, `status_pembayaran`, `status_pesanan`, `total_harga`) VALUES
(14, 9, 1, '1', '1', '2026-04-23 14:34:47', 'Tunai', 'paid', 'selesai', 23000.00),
(15, 9, 1, '2', '2', '2026-04-23 14:42:09', 'Tunai', 'paid', 'diproses', 51000.00),
(17, 9, 1, '3', '3', '2026-05-17 08:43:59', 'QRIS', 'paid', 'diproses', 115000.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jabatan`, `username`, `password`) VALUES
(9, 'Zulmi', 'Owner', 'owner12', 'owner123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_meja` (`id_meja`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `id_meja` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
