-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 09:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat') DEFAULT 'Baik',
  `tahun_pengadaan` year(4) DEFAULT NULL,
  `status` enum('Tersedia','Dipinjam','Maintenance') NOT NULL DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `id_kategori`, `id_lab`, `jumlah`, `kondisi`, `tahun_pengadaan`, `status`) VALUES
(1, 'PC001', 'Komputer Desktop', 1, 1, 30, 'Baik', '2024', 'Dipinjam'),
(2, 'SW001', 'Switch 24 Port', 2, 3, 5, 'Baik', '2023', 'Tersedia'),
(3, 'PR001', 'Printer Epson L3210', 3, 2, 2, 'Baik', '2022', 'Tersedia'),
(4, 'PJ001', 'pc', 4, 4, 3, 'Rusak Ringan', '2026', 'Tersedia'),
(5, 'BRG001', 'Komputer ASUS Core i5', 1, 1, 10, 'Baik', '2026', 'Maintenance'),
(14, 'NA012', 'KOMPUTER ACER', 1, 2, 8, 'Baik', '2008', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Komputer'),
(2, 'Jaringan'),
(3, 'Peripheral'),
(4, 'Multimedia'),
(5, 'laptop'),
(9, 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id_lab` int(11) NOT NULL,
  `nama_lab` varchar(100) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `penanggung_jawab` varchar(100) DEFAULT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`id_lab`, `nama_lab`, `lokasi`, `penanggung_jawab`, `kapasitas`) VALUES
(1, 'Lab Komputer 1', 'Gedung A Lantai 2', 'Budi Santoso', 30),
(2, 'Lab Komputer 2', 'Gedung A Lantai 2', 'eduuu', 35),
(3, 'Lab Jaringan', 'Gedung B Lantai 1', 'Andi Pratama', 25),
(4, 'Lab Multimedia', 'Gedung B Lantai 2', 'Rina Putri', 40),
(5, 'Lab Komputer 1', 'Gedung A Lantai 2', 'meysaaaaa', 0),
(7, 'Lab Komputer 3', 'Gedung A Lantai 2', 'wayan', 21);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id_maintenance` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_maintenance` date DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `biaya` decimal(12,2) DEFAULT 0.00,
  `status` enum('Proses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id_maintenance`, `id_barang`, `tanggal_maintenance`, `deskripsi`, `tanggal`, `keterangan`, `biaya`, `status`) VALUES
(1, 4, NULL, NULL, '2026-06-10', 'Penggantian lampu proyektor', 500000.00, 'Selesai'),
(2, 3, NULL, NULL, '2026-06-15', 'Pembersihan printer', 150000.00, 'Proses'),
(5, 4, '2026-06-24', 'lelet', '2026-06-25', 'ga dipake', 0.05, 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan') DEFAULT 'Dipinjam',
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_barang`, `nama_peminjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `id_user`) VALUES
(1, 1, 'tegar', '2026-06-20', '2026-06-22', 'Dipinjam', NULL),
(4, 5, 'zizuuy', '2026-06-22', '2026-06-23', 'Dikembalikan', NULL),
(5, 4, 'tegar', '2026-07-03', '2026-07-11', 'Dikembalikan', NULL),
(6, 2, 'meysa cantik', '2026-06-22', '2026-06-22', 'Dikembalikan', NULL),
(7, 3, 'arya', '2026-06-24', '2026-06-25', 'Dikembalikan', NULL),
(10, 2, 'atala', '2026-06-24', '2026-06-25', 'Dikembalikan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','laboran','mahasiswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prodi` varchar(100) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `nim`, `username`, `password`, `role`, `created_at`, `prodi`, `kelas`, `no_hp`) VALUES
(1, 'Administrator', NULL, 'admin', 'admin123', 'admin', '2026-06-22 02:02:04', NULL, NULL, NULL),
(4, 'Edu Bp', NULL, 'edubp', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2026-06-24 06:05:07', NULL, NULL, NULL),
(5, 'Athala AGF', NULL, 'athalaagf', 'e10adc3949ba59abbe56e057f20f883e', 'laboran', '2026-06-24 13:54:17', NULL, NULL, NULL),
(6, 'Mahasiswa Demo', '23000001', 'mahasiswa', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa', '2026-06-25 12:31:18', 'Teknik Informatika', 'TI 4A', '08123456789'),
(8, 'Test Laboran', NULL, 'test123', '123456', 'admin', '2026-06-25 19:19:53', NULL, NULL, NULL),
(11, 'Athala AGF', NULL, 'thala', '123456', 'laboran', '2026-06-25 19:36:09', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `fk_barang_kategori` (`id_kategori`),
  ADD KEY `fk_barang_lab` (`id_lab`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id_lab`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id_maintenance`),
  ADD KEY `fk_maintenance_barang` (`id_barang`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_peminjaman_barang` (`id_barang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id_maintenance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_lab`) REFERENCES `laboratorium` (`id_lab`),
  ADD CONSTRAINT `fk_barang_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_barang_lab` FOREIGN KEY (`id_lab`) REFERENCES `laboratorium` (`id_lab`);

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `fk_maintenance_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
