-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2021 at 09:06 PM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.3.26

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `id_jabatan`, `id_status`, `username`, `password`, `nama`, `alamat`, `telp`, `email`, `link_foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ketua', '$2y$10$AJij7pSKhixb5cNdmn5SNu1nPLZWlHCqvFXv.g9pNDGZy5AiGTCEy', 'Administrator', 'malang', '08123123123', 'ketua@gmail.com', 'public/storage/foto_profil/1.jpg', NULL, '2020-11-01 05:23:26', '2021-01-05 12:36:00'),
(2, 5, 1, 'rayhanadri', '$2y$10$tIlB5nbXojr1sByqoDYepe9/Ggn5aCGJxc0grFTnq1BIE2uhogkSy', 'Rayhan Adri', NULL, '085966556997', 'rayhanadri@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', '43262xTAG90OnI4YMK6fBZslsuvyxCSmeLKVvlgvrQftxbeqjexeiZKw54ua', '2020-11-02 01:42:10', '2020-11-07 09:36:33'),
(3, 4, 1, 'csdrifki', '$2y$10$9sSY8QEjYMAzqC9v/zJaM.wEsovBUa0tdMjMN86zcQTjeaEOs97pW', 'Mochamad Rifki', 'De Rumah 33', '081938112222', 'csdrifki@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', 'Xv8AmYS3ajLqMGhqihYJJu5XufN9VOV5XRwuIxAfZVJLMg4U23hVKh5d1m2b', '2020-11-02 02:37:26', '2020-11-02 03:14:50'),
(4, 2, 1, 'ismiarta', '$2y$10$nq/dItUbmrhmXb0xRIjWme60UJx6DVVGvWSqs/w.J6ku4V6EfwWB6', 'Ismiarta Aknuranda', '-', '-', 'ismiarta@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-11-02 03:10:40', '2020-11-14 15:33:36'),
(5, 4, 1, 'Joehar', '$2y$10$Rw09KJ1b/6uypeg6fo8K7OdAQKNSYnBCwWdBGb6pXEbG0cB8kx2na', 'M. Jauhar Evandri', 'Jl. CIkampek no. 1, RT/RW: 05/06. Kel. Penanggungan, Kec. Klojen, Malang.', '081233505099', 'joehalkens@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', '2QYdwiLdDudrErQrHfZOvMBHJS0oNdDIhRXDcRo6vKwh4mduXiVLYdZORhVP', '2020-11-02 05:41:18', '2020-11-02 06:03:11'),
(6, 5, 1, 'syarifinnur', '$2y$10$ZF114xls/jhPB6r1X1F/TuK9z4GR8gcn2FQCTclxGTGm0qux7dJcq', 'syarifinnur', 'Jalan  Manunggal No. 2 Lingkungan Kebon Bawak Tengah Ampenan. Kota Mataram, NTB', '081805716402', 'syarifinnur@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-11-02 06:11:57', '2020-11-12 11:05:34'),
(7, 5, 1, 'Fawwaz', '$2y$10$h/j.BDwDnctUszmXd/rG/OuWMGrTPM.BCRDWvHYLLCaZKcJYlnniG', 'Muhammad Fawwaz Mahdi', 'Jl raya kludan no 63 rt3rw3 desa kludan, tanggulangin sidoarjo', '0895364838369', 'fawwazmahdi24@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-11-02 16:50:40', '2020-11-03 02:13:35'),
(9, 5, 1, 'anasusb11', '$2y$10$fxQaFrEzDWS.0M15t8XrqOc1Ma.Ev1qlwN1mqEAXZkzwMx/lI1R4.', 'Annas Usbah', 'Jl. Veteran no 8C kelurahan Penanggungan kecamatan klojen Malang', '081930549415', 'anasusb11@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-11-07 00:53:57', '2020-11-12 11:05:13'),
(10, 4, 3, 'tobigans', '$2y$10$GP.4aFT.s2aE.ZqPjHKRiuxE91Hnh9t870b..XNd54dtUZybB8xxa', 'tobigans', 'tobigans', '142412124', 'zodiaxbro@gmail.com', 'public/dist/assets/img/avatar/avatar-1.png', NULL, '2020-11-23 01:50:40', '2020-11-23 01:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id` int(11) NOT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  `id_katalog` int(11) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `sumber` varchar(255) DEFAULT NULL,
  `merek` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `link_qr` varchar(255) DEFAULT NULL,
  `link_foto_barang` varchar(255) DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_pendaftaran` timestamp NULL DEFAULT NULL,
  `tgl_diperbarui` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id`, `id_lokasi`, `id_katalog`, `kode`, `sumber`, `merek`, `tipe`, `status`, `link_qr`, `link_foto_barang`, `harga_satuan`, `keterangan`, `tgl_pendaftaran`, `tgl_diperbarui`) VALUES
(1, 3, 16, 'FI1', 'Pengadaan', 'Ikea', 'Dombas', 'Baik', 'public/storage/qr-code/img-FI1.png', 'public/storage/foto_aset/FUIN1.jpg', 2300000, 'kondisi oke', '2020-11-01 05:33:13', '2020-11-01 05:35:07'),
(2, 3, 16, 'FI2', 'Pengadaan', 'Ikea', 'Dombas', 'Rusak', 'public/storage/qr-code/img-FI2.png', 'public/storage/foto_aset/FUIN2.jpg', 2300000, 'Engselnya rusak', '2020-11-01 05:33:13', '2020-11-02 03:41:42'),
(3, 1, 3, 'PAK3', 'Pengadaan', 'Honda', 'Beat', 'Dipinjam', 'public/storage/qr-code/img-PAK3.png', 'public/storage/foto_aset/PRAK3.jpg', 7000000, 'Dipinjam Pak Budi. \r\nKontak hp: 08123123456', '2020-11-02 23:22:52', '2020-11-02 23:23:53'),
(4, 3, 17, 'FI4', 'Produksi', '-', '-', 'Dilepas', 'public/storage/qr-code/img-FI4.png', 'public/storage/foto_aset/FUIN4.jpg', 150000, 'Disumbangkan ke panti asuhan XYZ', '2020-11-02 23:26:17', '2020-11-02 23:27:04'),
(9, 3, 5, 'PMI9', 'Hibah', 'asus', 'x44h', 'Baik', 'public/storage/qr-code/img-PMI9.png', 'public/storage/foto_aset/PMI9.jpg', 4000000, '', '2020-11-05 17:27:05', '2020-11-05 17:27:05'),
(11, 3, 4, 'PMI11', 'Pengadaan', 'canon', 'ip287', 'Baik', 'public/storage/qr-code/img-PMI11.png', 'public/storage/foto_aset/PMI11.jpg', 2000000, '', '2020-11-05 17:36:07', '2020-11-05 17:36:07'),
(16, 9, 4, 'PMI16', 'Pengadaan', 'EPSON', 'L210', 'Baik', 'public/storage/qr-code/img-PMI16.png', 'public/storage/foto_aset/PMI16.jpg', 1100000, '', '2020-11-14 15:50:16', '2020-11-14 15:50:16'),
(17, 9, 20, 'PMI17', 'Pengadaan', 'LG', '26LH20R', 'Baik', 'public/storage/qr-code/img-PMI17.png', 'public/storage/foto_aset/PMI17.jpg', 1500000, '01 18-06', '2020-11-14 15:53:24', '2020-11-14 15:53:24'),
(19, 6, 4, 'PMI19', 'Pengadaan', 'Canon', 'ip2770', 'Baik', 'public/storage/qr-code/img-PMI19.png', 'public/storage/foto_aset/PMI19.jpg', 2000000, '', '2021-01-06 06:48:09', '2021-01-06 06:48:09'),
(20, 3, 4, 'PMI20', 'Pengadaan', 'Canon', 'ip287', 'Baik', 'public/storage/qr-code/img-PMI20.png', 'public/storage/foto_aset/PMI20.jpg', 1200000, '', '2021-01-11 02:33:23', '2021-01-11 02:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `katalog`
--

CREATE TABLE `katalog` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_barang` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `katalog`
--

INSERT INTO `katalog` (`id`, `id_kategori`, `nama_barang`) VALUES
(3, 11, 'Sepeda Motor'),
(4, 5, 'Printer'),
(5, 5, 'Laptop'),
(7, 6, 'Tangga'),
(8, 11, 'Mobil'),
(9, 6, 'Air Condtioner'),
(11, 8, 'Kitab Riyadus Shalihin'),
(12, 9, 'Pel'),
(13, 10, 'Pisau Dapur'),
(15, 12, 'Sajadah'),
(16, 7, 'Lemari Besi'),
(17, 7, 'Meja Kayu'),
(18, 7, 'Lemari Kayu'),
(19, 5, 'Komputer'),
(20, 5, 'Monitor'),
(21, 5, 'CPU'),
(22, 5, 'Keyboard'),
(23, 5, 'Mouse'),
(24, 5, 'Power Supply'),
(25, 5, 'TV'),
(26, 5, 'Proyektor'),
(27, 5, 'Layar Proyektor'),
(28, 5, 'Kabel HDMI'),
(29, 6, 'Remote Air Conditioner'),
(30, 6, 'Microphone'),
(31, 5, 'Router'),
(32, 6, 'Speaker'),
(33, 6, 'Kipas Angin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `id_pj` int(11) DEFAULT NULL,
  `kode` varchar(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `id_pj`, `kode`, `nama`) VALUES
(5, NULL, 'PMI', 'Peralatan dan Mesin IT'),
(6, NULL, 'PMN', 'Peralatan dan Mesin Non IT'),
(7, 1, 'FI', 'Furniture dan Interior'),
(8, 1, 'MB', 'Mushaf dan Buku'),
(9, NULL, 'PKM', 'Peralatan Kebersihan dan Kamar Mandi'),
(10, NULL, 'PMD', 'Peralatan Makan dan Dapur'),
(11, 1, 'PAK', 'Peralatan Angkut dan Kendaraan'),
(12, NULL, 'PS', 'Peralatan Sholat'),
(13, 1, 'GD', 'Gedung');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`) VALUES
(1, 'Parkiran 1'),
(2, 'Lantai 1 Luar'),
(3, 'Lantai 1 Dalam'),
(5, 'Pos Jaga'),
(6, 'Sekretriat'),
(7, 'Kamar Mandi Ikhwan'),
(8, 'Kamar Mandi Akhwat'),
(9, 'Kamar Remas'),
(10, 'Dapur'),
(13, 'Mihrab');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_pembuat` int(11) DEFAULT NULL,
  `id_penerima` int(11) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `sudah_baca` int(11) DEFAULT 0,
  `icon` varchar(100) DEFAULT NULL,
  `bg` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `tgl_dibuat` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengelola_aset`
--

CREATE TABLE `pengelola_aset` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `input_data` tinyint(1) NOT NULL DEFAULT 1,
  `update_data` tinyint(1) NOT NULL DEFAULT 0,
  `delete_data` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengelola_aset`
--

INSERT INTO `pengelola_aset` (`id`, `id_anggota`, `input_data`, `update_data`, `delete_data`) VALUES
(3, 3, 1, 1, 0),
(4, 4, 1, 1, 1),
(5, 5, 1, 1, 1),
(6, 7, 1, 0, 0),
(16, 1, 1, 0, 0),
(21, 9, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_aset`
--

CREATE TABLE `riwayat_aset` (
  `id` int(11) NOT NULL,
  `status_awal` varchar(100) DEFAULT NULL,
  `status_akhir` varchar(100) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_aset` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_aset`
--

INSERT INTO `riwayat_aset` (`id`, `status_awal`, `status_akhir`, `waktu`, `keterangan`, `id_aset`) VALUES
(1, '-', 'Baik', '2020-11-01 05:33:13', 'Kondisi oke', 1),
(2, '-', 'Baik', '2020-11-01 05:33:13', 'Kondisi oke', 2),
(3, 'Baik', 'Rusak', '2020-11-01 05:34:22', 'engsel rusak', 1),
(4, 'Rusak', 'Diperbaiki', '2020-11-01 05:34:52', 'diperbaiki di bengkel', 1),
(5, 'Diperbaiki', 'Baik', '2020-11-01 05:35:07', 'kondisi oke', 1),
(6, 'Baik', 'Rusak', '2020-11-02 03:41:42', 'Engselnya rusak', 2),
(7, '-', 'Baik', '2020-11-02 23:22:52', 'Kondisi oke', 3),
(8, 'Baik', 'Dipinjam', '2020-11-02 23:23:53', 'Dipinjam Pak Budi. \r\nKontak hp: 08123123456', 3),
(9, '-', 'Baik', '2020-11-02 23:26:17', 'Kondisi oke', 4),
(10, 'Dilepas', 'Dilepas', '2020-11-02 23:27:04', 'Disumbangkan ke panti asuhan XYZ', 4),
(11, '-', 'Rusak', '2020-11-02 23:29:42', 'mesin mati', 5),
(12, '-', 'Rusak', '2020-11-02 23:29:49', 'mesin mati', 6),
(13, 'Rusak', 'Diperbaiki', '2020-11-02 23:30:37', 'Dalam perbaikan di bengkel', 5),
(14, '-', 'Baik', '2020-11-05 06:04:37', '', 7),
(15, '-', 'Baik', '2020-11-05 17:03:43', 'Ok', 8),
(16, '-', 'Baik', '2020-11-05 17:27:05', '', 9),
(17, '-', 'Baik', '2020-11-05 17:27:08', '', 10),
(18, '-', 'Baik', '2020-11-05 17:36:07', '', 11),
(19, '-', 'Baik', '2020-11-07 09:10:47', 'oke', 12),
(20, '-', 'Baik', '2020-11-07 09:17:47', 'oke', 13),
(21, '-', 'Baik', '2020-11-07 09:17:56', 'oke', 14),
(22, '-', 'Baik', '2020-11-07 09:34:28', '', 15),
(23, '-', 'Baik', '2020-11-14 15:50:16', '', 16),
(24, '-', 'Baik', '2020-11-14 15:53:24', '01 18-06', 17),
(25, '-', 'Baik', '2021-01-06 05:47:18', '', 18),
(26, '-', 'Baik', '2021-01-06 06:48:09', '', 19),
(27, '-', 'Baik', '2021-01-11 02:33:24', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `usulan`
--

CREATE TABLE `usulan` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan_usulan` text DEFAULT NULL,
  `id_pengusul` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diperbarui` date NOT NULL,
  `alasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usulan`
--

INSERT INTO `usulan` (`id`, `nama_barang`, `jumlah`, `keterangan_usulan`, `id_pengusul`, `status`, `tgl_dibuat`, `tgl_diperbarui`, `alasan`) VALUES
(1, 'Rak Buku', 1, 'Untuk menyimpan buku dan kitab', 1, 'Belum Diproses', '2020-12-23', '2020-12-23', NULL),
(2, 'Meja Kayu', 2, NULL, 1, 'Selesai', '2020-12-30', '2020-12-30', NULL);

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
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`),
  ADD KEY `fk_aset_lokasi1_idx` (`id_lokasi`),
  ADD KEY `fk_aset_katalog1_idx` (`id_katalog`);

--
-- Indexes for table `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_kategori_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`),
  ADD KEY `fk_kategori_anggota1_idx` (`id_pj`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifikasi_anggota1_idx` (`id_penerima`),
  ADD KEY `fk_notifikasi_anggota2_idx` (`id_pembuat`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengelola_aset`
--
ALTER TABLE `pengelola_aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengelola_aset_anggota_idx` (`id_anggota`);

--
-- Indexes for table `riwayat_aset`
--
ALTER TABLE `riwayat_aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_inventaris_inventaris1_idx` (`id_aset`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usulan_ibfk_1` (`id_pengusul`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `katalog`
--
ALTER TABLE `katalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengelola_aset`
--
ALTER TABLE `pengelola_aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `riwayat_aset`
--
ALTER TABLE `riwayat_aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `fk_aset_katalog1` FOREIGN KEY (`id_katalog`) REFERENCES `katalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aset_lokasi1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `katalog`
--
ALTER TABLE `katalog`
  ADD CONSTRAINT `fk_id_kategori_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
