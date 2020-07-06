-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 03 Apr 2020 pada 15.51
-- Versi Server: 5.7.28-0ubuntu0.19.04.2
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
-- Struktur dari tabel `master_upt`
--

CREATE TABLE `master_upt` (
  `id_upt` int(11) NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `kode_upt` varchar(10) NOT NULL,
  `upt` varchar(255) NOT NULL,
  `id_kanwil` int(11) NOT NULL,
  `id_zona_waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_upt`
--

INSERT INTO `master_upt` (`id_upt`, `prefix`, `kode_upt`, `upt`, `id_kanwil`, `id_zona_waktu`) VALUES
(1, '01', 'UPT01', 'BAPAS KELAS I CIREBON', 10, 3),
(2, '02', 'UPT02', 'BAPAS KELAS I MANADO', 30, 3),
(3, '03', 'UPT03', 'BAPAS KELAS I PALANGKARAYA', 15, 3),
(4, '04', 'UPT04', 'BAPAS KELAS II CIANGIR', 4, 3),
(5, '05', 'UPT05', 'BAPAS KELAS II JAMBI', 9, 3),
(6, '06', 'UPT06', 'BAPAS KELAS II MUARA TEWE', 15, 3),
(7, '07', 'UPT07', 'BAPAS KELAS II PANGKALAN BUN', 15, 3),
(8, '08', 'UPT08', 'BAPAS KLAS I BANDUNG', 10, 3),
(9, '09', 'UPT09', 'BAPAS KLAS I BANJARMASIN', 14, 3),
(10, '10', 'UPT10', 'BAPAS KLAS I DENPASAR', 2, 3),
(11, '11', 'UPT11', 'BAPAS KLAS I JAKARTA BARAT', 7, 3),
(12, '12', 'UPT12', 'BAPAS KLAS I JAKARTA PUSAT', 7, 3),
(13, '13', 'UPT13', 'BAPAS KLAS I JAKARTA SELATAN', 7, 3),
(14, '14', 'UPT14', 'BAPAS KLAS I JAKARTA TIMUR/JAKARTA UTARA', 7, 3),
(15, '15', 'UPT15', 'BAPAS KLAS I MAKASSAR', 27, 3),
(16, '16', 'UPT16', 'BAPAS KLAS I MALANG', 12, 3),
(17, '17', 'UPT17', 'BAPAS KLAS I MANOKWARI', 24, 3),
(18, '18', 'UPT18', 'BAPAS KLAS I MEDAN', 33, 3),
(19, '19', 'UPT19', 'BAPAS KLAS I PADANG', 31, 3),
(20, '20', 'UPT20', 'BAPAS KLAS I PALEMBANG', 32, 3),
(21, '21', 'UPT21', 'BAPAS KLAS I SEMARANG', 11, 3),
(22, '22', 'UPT22', 'BAPAS KLAS I SURABAYA', 12, 3),
(23, '23', 'UPT23', 'BAPAS KLAS I SURAKARTA', 11, 3),
(24, '24', 'UPT24', 'BAPAS KLAS I YOGYAKARTA', 6, 3),
(25, '25', 'UPT25', 'BAPAS KLAS II ACEH', 1, 3),
(26, '', 'UPT26', 'BAPAS KLAS II AMBON', 19, 3),
(27, '', 'UPT27', 'BAPAS KLAS II AMUNTAI', 14, 3),
(28, '', 'UPT28', 'BAPAS KLAS II BALIKPAPAN', 16, 3),
(29, '', 'UPT29', 'BAPAS KLAS II BANDAR LAMPUNG', 18, 3),
(30, '', 'UPT30', 'BAPAS KLAS II BAU-BAU', 29, 3),
(31, '', 'UPT31', 'BAPAS KLAS II BENGKULU', 5, 3),
(32, '', 'UPT32', 'BAPAS KLAS II BOGOR', 10, 3),
(33, '', 'UPT33', 'BAPAS KLAS II BOJONEGORO', 12, 3),
(34, '', 'UPT34', 'BAPAS KLAS II BUKITTINGGI', 31, 3),
(35, '', 'UPT35', 'BAPAS KLAS II GARUT', 10, 3),
(36, '', 'UPT36', 'BAPAS KLAS II GORONTALO', 8, 3),
(37, '', 'UPT37', 'BAPAS KLAS II JAYAPURA', 23, 3),
(38, '', 'UPT38', 'BAPAS KLAS II JEMBER', 12, 3),
(39, '', 'UPT39', 'BAPAS KLAS II KARANGASEM', 2, 3),
(40, '', 'UPT40', 'BAPAS KLAS II KEDIRI', 12, 3),
(41, '', 'UPT41', 'BAPAS KLAS II KENDARI', 29, 3),
(42, '', 'UPT42', 'BAPAS KLAS II KUPANG', 22, 3),
(43, '', 'UPT43', 'BAPAS KLAS II KUTACANE', 1, 3),
(44, '', 'UPT44', 'BAPAS KLAS II LAHAT', 32, 3),
(45, '', 'UPT45', 'BAPAS KLAS II LUWUK', 28, 3),
(46, '', 'UPT46', 'BAPAS KLAS II MADIUN', 12, 3),
(47, '', 'UPT47', 'BAPAS KLAS II MAGELANG', 11, 3),
(48, '', 'UPT48', 'BAPAS KLAS II MATARAM', 21, 3),
(49, '', 'UPT49', 'BAPAS KLAS II MERAUKE', 23, 3),
(50, '', 'UPT50', 'BAPAS KLAS II METRO', 18, 3),
(51, '', 'UPT51', 'BAPAS KLAS II MUARA BUNGO', 9, 3),
(52, '', 'UPT52', 'BAPAS KLAS II PALOPO', 27, 3),
(53, '', 'UPT53', 'BAPAS KLAS II PALU', 28, 3),
(54, '', 'UPT54', 'BAPAS KLAS II PAMEKASAN', 12, 3),
(55, '', 'UPT55', 'BAPAS KLAS II PANGKAL PINANG', 3, 3),
(56, '', 'UPT56', 'BAPAS KLAS II PATI', 11, 3),
(57, '', 'UPT57', 'BAPAS KLAS II PEKALONGAN', 11, 3),
(58, '', 'UPT58', 'BAPAS KLAS II PEKANBARU', 25, 3),
(59, '', 'UPT59', 'BAPAS KLAS II POLEWALI', 26, 3),
(60, '', 'UPT60', 'BAPAS KLAS II PONTIANAK', 13, 3),
(61, '', 'UPT61', 'BAPAS KLAS II PURWOKERTO', 11, 3),
(62, '', 'UPT62', 'BAPAS KLAS II SAMARINDA', 16, 3),
(63, '', 'UPT63', 'BAPAS KLAS II SERANG', 4, 3),
(64, '', 'UPT64', 'BAPAS KLAS II SERANG', 4, 3),
(65, '', 'UPT65', 'BAPAS KLAS II SIBOLGA', 33, 3),
(66, '', 'UPT66', 'BAPAS KLAS II SINTANG', 13, 3),
(67, '', 'UPT67', 'BAPAS KLAS II SORONG', 24, 3),
(68, '', 'UPT68', 'BAPAS KLAS II SUMBAWA BESAR', 21, 3),
(69, '', 'UPT69', 'BAPAS KLAS II TANJUNG PINANG', 17, 3),
(70, '', 'UPT70', 'BAPAS KLAS II TERNATE', 20, 3),
(71, '', 'UPT71', 'BAPAS KLAS II WAIKABUBAK', 22, 3),
(72, '', 'UPT72', 'BAPAS KLAS II WATAMPONE', 27, 3),
(73, '', 'UPT73', 'BAPAS KLAS II WONOSARI', 6, 3),
(74, '', 'UPT88', 'SUKABUMI', 10, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_upt`
--
ALTER TABLE `master_upt`
  ADD PRIMARY KEY (`id_upt`),
  ADD UNIQUE KEY `kode_upt` (`kode_upt`),
  ADD KEY `id_kanwil_id_upt` (`id_kanwil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_upt`
--
ALTER TABLE `master_upt`
  MODIFY `id_upt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `master_upt`
--
ALTER TABLE `master_upt`
  ADD CONSTRAINT `id_kanwil_id_upt` FOREIGN KEY (`id_kanwil`) REFERENCES `master_kanwil` (`id_kanwil`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
