-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2026 at 12:49 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daftar_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '$2y$10$fa8.RK5u/GjeyZGq4EvFsOGQ7b9CnBbsuUsAXYYBUnMw3UE/SxkfK');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tahun_terbit` int DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` text,
  `bahasa` varchar(30) DEFAULT 'Indonesia',
  `harga` decimal(10,2) NOT NULL,
  `stok` int DEFAULT '0',
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `tahun_terbit`, `kategori`, `deskripsi`, `bahasa`, `harga`, `stok`, `gambar`, `created_at`) VALUES
(1, 'Bumi', 2014, 'Fiksi Ilmiah', 'Raib bisa menghilang. Sejak kecil ia menyimpan rahasia itu. Tapi satu kejadian membawanya ke petualangan lintas dunia yang tak pernah ia bayangkan.', 'Indonesia', 89000.00, 25, 'Bumi.jpg', '2026-09-30 00:47:41'),
(2, 'Bulan', 2015, 'Fiksi Ilmiah', 'Petualangan berlanjut! Raib, Seli, dan Ali kini menghadapi ancaman dari klan misterius yang jauh lebih kuat dari yang pernah mereka temui.', 'Indonesia', 89000.00, 20, 'Bulan.jpg', '2026-09-30 00:47:41'),
(3, 'Matahari', 2016, 'Fiksi Ilmiah', 'Perjalanan ke dunia baru yang lebih luas dan berbahaya. Rahasia tentang asal-usul kemampuan Raib mulai terungkap satu per satu.', 'Indonesia', 89000.00, 18, 'Matahari_Minor.jpg', '2026-09-30 00:47:41'),
(4, 'Hujan', 2016, 'Romance', 'Kisah Lail dan Esok di masa depan, saat bencana besar mengubah dunia. Tentang cinta, kehilangan, dan ingatan yang ingin dilupakan.', 'Indonesia', 85000.00, 30, '6abd00f7a9efd.jpg', '2026-09-30 00:47:41'),
(5, 'Tentang Kamu', 2016, 'Romance', 'Seorang pengacara menelusuri warisan seorang perempuan bernama Sri Ningsih. Dari sana terungkap kisah hidup yang panjang, dari Indonesia hingga Eropa.', 'Indonesia', 85000.00, 22, '6abd01c40472b.jpg', '2026-09-30 00:47:41'),
(6, 'Rindu', 2014, 'Sejarah', 'Perjalanan kapal haji tahun 1938 mempertemukan berbagai penumpang dengan pertanyaan besar tentang hidup, dosa, dan kedamaian hati.', 'Indonesia', 89000.00, 20, '6abd01a2d6590.jpg', '2026-09-30 00:47:41'),
(7, 'Pulang', 2015, 'Petualangan', 'Bujang, anak muda dari pedalaman, terjun ke dunia gelap para \"shadow economy\" dan belajar arti keluarga, kesetiaan, dan pilihan hidup.', 'Indonesia', 85000.00, 17, '6abd01883c98d.jpg', '2026-09-30 00:47:41'),
(8, 'Pergi', 2018, 'Petualangan', 'Lanjutan kisah Bujang, yang kini harus menghadapi masa lalu dan konsekuensi dari jalan yang ia pilih.', 'Indonesia', 90000.00, 14, '6abd016df38e9.jpg', '2026-09-30 00:47:41'),
(9, 'Komet', 2018, 'Fiksi Ilmiah', 'Petualangan Raib, Seli, dan Ali berlanjut ke Klan Komet, dunia paralel penuh teknologi dan rahasia yang menguji persahabatan mereka.', 'Indonesia', 95000.00, 10, '6abd014bd88dc.jpg', '2026-09-30 00:47:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

