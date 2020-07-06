-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 09 Mei 2020 pada 08.01
-- Versi Server: 5.7.29-0ubuntu0.16.04.1
-- PHP Version: 7.2.24-0ubuntu0.19.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jeera3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier_snack_petugas_barang`
--

CREATE TABLE `suplier_snack_petugas_barang` (
  `id_barang` int(11) NOT NULL,
  `id_suplier_snack_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suplier_snack_petugas_barang`
--

INSERT INTO `suplier_snack_petugas_barang` (`id_barang`, `id_suplier_snack_petugas`) VALUES
(366, 4),
(367, 4),
(368, 4),
(369, 4),
(370, 4),
(371, 4),
(372, 4),
(373, 4),
(374, 4),
(375, 4),
(376, 4),
(377, 4),
(378, 4),
(379, 4),
(380, 4),
(381, 4),
(382, 4),
(383, 4),
(384, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suplier_snack_petugas_barang`
--
ALTER TABLE `suplier_snack_petugas_barang`
  ADD KEY `suplier_snack_petugas_barang` (`id_barang`),
  ADD KEY `suplier_snack_petugas_master` (`id_suplier_snack_petugas`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
