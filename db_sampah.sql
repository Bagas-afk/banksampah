-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 07:45 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_harga`
--

CREATE TABLE `tb_harga` (
  `id_harga` int(11) NOT NULL,
  `kategori` varchar(128) NOT NULL,
  `jenis_sampah` varchar(128) NOT NULL,
  `harga` varchar(128) NOT NULL,
  `satuan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_harga`
--

INSERT INTO `tb_harga` (`id_harga`, `kategori`, `jenis_sampah`, `harga`, `satuan`) VALUES
(9, 'Kertas', 'Buku SDA', '3000', 'Kg'),
(10, 'Besi', 'Plastik', '2500', 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

CREATE TABLE `tb_logs` (
  `id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `datetime` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_setor`
--

CREATE TABLE `tb_setor` (
  `id_setoran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_sampah` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_setor`
--

INSERT INTO `tb_setor` (`id_setoran`, `tanggal`, `id_nasabah`, `id_sampah`, `jumlah`, `sub_total`) VALUES
(1, '2020-09-09', 10, 10, 5, 150000),
(7, '2020-09-05', 10, 9, 10, 3700070),
(11, '2020-09-04', 10, 10, 12, 360000),
(12, '2020-09-24', 11, 9, 10, 3700070),
(13, '2020-09-19', 13, 9, 2, 7400),
(14, '2020-09-26', 16, 10, 2, 6000),
(15, '2020-09-30', 0, 9, 4, 12000),
(16, '2020-09-26', 18, 10, 5, 12500),
(17, '2020-09-12', 0, 10, 2, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `no_telpon` varchar(13) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kecamatan` varchar(128) NOT NULL,
  `kelurahan` varchar(128) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `no_rekening` int(12) NOT NULL,
  `role_id` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `image` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `no_telpon`, `email`, `password`, `agama`, `alamat`, `kecamatan`, `kelurahan`, `status`, `pekerjaan`, `bank`, `no_rekening`, `role_id`, `date_created`, `image`) VALUES
(0, '2147483647', 'bagasaaa', '0000-00-00', '', '08779878959', 'bagasaci@gmail.com', '$2y$10$f/z1uv8k38oOc7liDxnAeOKUEqJp8nB5gu3g9i/xIu2ORgdAiZ89W', '', 'Jalan begini banget', 'Ciputat', 'Sawah Baru', 'kawin', '', 'CIMB Niaga', 8888888, 2, 1600420494, 'default.png'),
(8, '2147483647', 'Anonymose', '1982-05-03', 'perempuan', '2147483647', 'hildauser@gmail.com', '$2y$10$Vui7//eSMKa18K1nODJ7GOu20SjknRMRFm6ihwpOZau/Uzj3QvTT6', 'Islam', 'Jalanin aja yang ada', '', '0', 'kawin', 'Pengangguran', 'Mandiri', 2147483647, 1, 0, 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_harga`
--
ALTER TABLE `tb_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_setor`
--
ALTER TABLE `tb_setor`
  ADD PRIMARY KEY (`id_setoran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_harga`
--
ALTER TABLE `tb_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_setor`
--
ALTER TABLE `tb_setor`
  MODIFY `id_setoran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
