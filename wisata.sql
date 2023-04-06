-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2022 at 05:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `pesanan_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nohp` varchar(14) DEFAULT NULL,
  `wisata_id` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `dewasa` int(10) DEFAULT NULL,
  `anak` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`pesanan_id`, `nama_lengkap`, `nik`, `nohp`, `wisata_id`, `tanggal`, `dewasa`, `anak`, `total`) VALUES
(37, 'budi sentosa jaya', '324878234823764', '0832874276423', 23, '2022-09-13', 1, 1, 30000),
(38, 'Bambang', '3746723674672', '083284787634', 24, '2022-09-17', 2, 1, 37500);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `wisata_id` int(11) NOT NULL,
  `nama_wisata` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(6) DEFAULT NULL,
  `visitors` int(10) NOT NULL DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`wisata_id`, `nama_wisata`, `deskripsi`, `harga`, `visitors`, `gambar`, `youtube`) VALUES
(23, 'Air Panas Guci', 'Wisata Air panas ini terdapat di lereng Gunung Slamet bagian utara sehingga suasana pegunungan yang sejuk dan asri sangat terasa.', 20000, 2, 'guci.jpg', 'https://www.youtube.com/embed/YrTHjMYKnV0'),
(24, 'Pantai Alam Indah', 'Pantai Alam Indah menawarkan keindahan Laut Jawa yang tenang, dilengkapi beberapa fasilitas pendukung yang disediakan.', 15000, 3, 'pai.jpg', 'https://www.youtube.com/embed/m5vPFEp3FJ0'),
(25, 'Waduk Cacaban', 'Waduk ini didukung dengan latar belakang pemandangan hutan dengan panorama yang indah.', 10000, 0, 'waduk.jpg', 'https://www.youtube.com/embed/VK_C3TcKNAI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`pesanan_id`),
  ADD KEY `fk_pesanan_wisata_id` (`wisata_id`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`wisata_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `pesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `wisata_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_wisata_id` FOREIGN KEY (`wisata_id`) REFERENCES `wisata` (`wisata_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
