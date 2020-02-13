-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2020 at 01:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simasjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `link_foto` varchar(255) DEFAULT 'public/dist/assets/img/avatar/avatar-1.png',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `id_jabatan`, `id_status`, `username`, `password`, `nama`, `alamat`, `telp`, `email`, `link_foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ketua', '$2y$10$oX2b5kO9NK2Bjvia2dPBr.LKwn2QKYeDNCSBAmb2NbNggwASM6Vvm', 'Pak Ketua', 'Malang', '08123123456', 'ketua@gmail.com', 'public/storage/foto_profil/1.png', NULL, '2020-02-12 23:40:42', '2020-02-13 00:27:58'),
(2, 4, 1, 'takmir1', '$2y$10$clXnYwpCa/i8oJL99Vao5eVC6wdebgaiVwk6n4HNInK4xUfh6ZHN2', 'Takmir Satu', 'Malang', '08123123456', 'takmir1@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-02-12 23:41:46', '2020-02-12 23:41:46'),
(3, 4, 1, 'remas1', '$2y$10$opBN/04FBm7RIpyf2.2PZ.JroQBSjxHRdbSWvPSCnzdVx8jKzDZqu', 'Remas Satu', 'Malang', '08123123456', 'remas123@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-02-12 23:42:33', '2020-02-12 23:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_pembuat` int(11) DEFAULT NULL,
  `id_penerima` int(11) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `sudah_baca` int(11) DEFAULT 0,
  `icon` varchar(100) DEFAULT NULL,
  `bg` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `tgl_dibuat` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifikasi_anggota1_idx` (`id_pembuat`),
  ADD KEY `fk_notifikasi_anggota2_idx` (`id_penerima`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `fk_notifikasi_anggota1` FOREIGN KEY (`id_pembuat`) REFERENCES `anggota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifikasi_anggota2` FOREIGN KEY (`id_penerima`) REFERENCES `anggota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
