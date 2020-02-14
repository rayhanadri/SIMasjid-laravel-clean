-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 01:31 PM
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
  `id` int(11) UNSIGNED NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'public/dist/assets/img/avatar/avatar-1.png',
  `id_status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `id_jabatan`, `username`, `password`, `nama`, `alamat`, `telp`, `email`, `link_foto`, `id_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'rayhanadri', '$2y$10$ADywxAPNm/U6INB9R4yfY.3UPCpf/W9/2sLAtLGU12/6EPPIK/MGm', 'Rayhan Adri', 'Malang', '085966556997', 'rayerzz99@gmail.com', 'foto_profil/rayhanadri.jpg', 1, 'PhLryR7ZSuNgCh2wPexVE4jAUOu1xfoBtoWw22mgNKbMfAAtEVjKj9A7rL7p', '2019-10-11 10:16:23', '2019-10-18 04:22:36'),
(5, 4, 'testdaftar', '$2y$10$cM1SjEsoLmytdCv7EAEmv.Gdqy42m6xKl97soWy.U7C4DfQtVPAUu', 'asdwqwer', 'malang', '12312312', 'tester@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', 1, NULL, '2019-10-11 12:50:09', '2019-10-12 19:15:21'),
(6, 9, 'tester123', '$2y$10$iX83T.ktB3WCk.G0Mb9j7.JypszjsQSDDL.ll.BoEUlft4p4BGxim', 'testerr', 'asdas', '123123', 'qwe@qwe.co', 'public/dist/assets/img/avatar/avatar-1.png', 2, NULL, '2019-10-11 12:50:54', '2019-10-12 08:38:56'),
(8, 6, 'budi', '$2y$10$vW9R2iU/tobHcoM7brlLveRYaS0CJMLo/7VuuX72WMKcVFDN844hW', 'Budi Budiman', 'asdasd asdas', '09819023890123', 'budi@gmail.com', 'foto_profil/budi.jpg', 1, NULL, '2019-10-11 14:30:26', '2019-10-13 14:36:32'),
(21, 8, 'zxcv', '$2y$10$rnvPXRt9A3YBlN0oCuw9AuinxEQ/jZOARaMN8OV21di8GSzSM7nIm', 'zxcv', 'zxcv', 'zxc', 'zxcv2@s.c', 'public/dist/assets/img/avatar/avatar-1.png', 3, NULL, '2019-10-11 18:51:10', '2019-10-11 18:51:10'),
(22, 9, 'calontakmir1', '$2y$10$Ap9N4vZ9C.4CzATBPBMQ0.sErqIc7Oklljdk2HlKGktSwBRQs/N1e', 'calon takmir 123', 'calon', '0801293', 'calon@c.com', 'public/dist/assets/img/avatar/avatar-1.png', 1, NULL, '2019-10-12 08:41:06', '2019-10-12 08:58:30'),
(23, 1, 'ketua', '$2y$10$JsCcNL37GUm/E9EREuMd2.J/.QkaKfJqx8M17gUn70LSmDVGdJ3gq', 'ketua', 'ketua', '123123123123', 'ketua@gmail.com', 'foto_profil/ketua.jpg', 1, NULL, '2019-10-12 09:27:12', '2019-10-17 00:36:43'),
(24, 8, 'nahyarirda', '$2y$10$qVRtiZSCUV.b0cKoCbNbP.D7/W7mXIhYRzX9Rp5gP05mbA1K.B5dG', 'Nahyar Irda', 'Jl. Bunga Coklat no.20, Kecamatan Jatimulyo, Kelurahan Lowokwaru, Kota Malang, Jawa Timur.', '08123456789', 'nahyarirda@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', 3, NULL, '2019-10-13 14:33:11', '2019-10-13 14:33:11'),
(25, 8, 'qwerty', '$2y$10$4LJG4l0itCxBZT4F586SLOJWemq5Cok/gh7ie25/HDTMhWtPjdTK2', 'qwerty', 'qwerty', '12312313', 'qwerty@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', 3, NULL, '2019-10-13 16:53:17', '2019-10-13 16:53:17'),
(26, 8, 'belumaktif', '$2y$10$yr2Q0JEl9In5PyQOlA6psu6rqCUSbw9y400kNwBbrGsEJbETvLzy2', 'belum aktif', 'qweqweqwe', '098787987', 'qwerty123@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', 3, NULL, '2019-10-14 10:26:05', '2019-10-14 10:26:05'),
(27, 8, 'baru', '$2y$10$M180SE0zbCsrJASgIgdwGOesmV.GGzdsaA8XqOsMU1rMeR8vA16p6', 'baru', 'malang', '098098', 'baru@mail.co', 'public/dist/assets/img/avatar/avatar-1.png', 3, NULL, '2019-10-17 00:40:51', '2019-10-17 00:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_jabatan`
--

CREATE TABLE `anggota_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_jabatan`
--

INSERT INTO `anggota_jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Ketua Takmir'),
(2, 'Bendahara'),
(3, 'Sekretaris'),
(4, 'Kerohanian'),
(5, 'Kepala Rumah Tangga'),
(6, 'Humas'),
(7, 'Keamanan'),
(8, 'Takmir'),
(9, 'Remaja Masjid');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_status`
--

CREATE TABLE `anggota_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_status`
--

INSERT INTO `anggota_status` (`id_status`, `status`) VALUES
(1, 'Aktif'),
(2, 'Non-Aktif'),
(3, 'Belum Verifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_10_08_215357_anggota', 1),
(3, '2019_10_08_220400_anggota', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sadmin@gmail.com', '$2y$10$9giAJD3afHPFHoPRnFtwzu9oeM3I9.DElqKY6zi8R26DwvMVonIk6', '2019-10-08 16:07:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_username_unique` (`username`),
  ADD UNIQUE KEY `anggota_email_unique` (`email`);

--
-- Indexes for table `anggota_jabatan`
--
ALTER TABLE `anggota_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `anggota_status`
--
ALTER TABLE `anggota_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `anggota_jabatan`
--
ALTER TABLE `anggota_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `anggota_status`
--
ALTER TABLE `anggota_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
