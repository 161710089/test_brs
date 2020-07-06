-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 23 Mar 2020 pada 10.44
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
-- Struktur untuk view `view_inventory`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_inventory`  AS  select `inventory_in`.`kode_barang` AS `kode_barang`,`inventory_in`.`kode_kantor` AS `kode_kantor`,`inventory_in`.`id_satuan` AS `id_satuan`,`inventory_in`.`harga_pokok_penjualan` AS `harga_pokok_penjualan`,(`inventory_in`.`kuantitas` - (case when (`inventory_out`.`kuantitas` is not null) then `inventory_out`.`kuantitas` else 0 end)) AS `kuantitas`,`master_satuan`.`satuan` AS `satuan` from ((((select `inventory_pusat`.`kode_barang` AS `kode_barang`,`inventory_pusat`.`kode_pusat` AS `kode_kantor`,`inventory_pusat`.`id_satuan` AS `id_satuan`,avg((case when (`inventory_pusat`.`transaksi` = 'purchase order') then `inventory_pusat`.`harga_pokok_penjualan` end)) AS `harga_pokok_penjualan`,sum(`inventory_pusat`.`kuantitas`) AS `kuantitas` from `inventory_pusat` where (`inventory_pusat`.`status` = 'in') group by `inventory_pusat`.`kode_barang`,`inventory_pusat`.`kode_pusat`,`inventory_pusat`.`id_satuan`) union select `inventory_upt`.`kode_barang` AS `kode_barang`,`inventory_upt`.`kode_upt` AS `kode_kantor`,`inventory_upt`.`id_satuan` AS `id_satuan`,avg((case when (`inventory_upt`.`transaksi` = 'purchase order') then `inventory_upt`.`harga_pokok_penjualan` end)) AS `harga_pokok_penjualan`,sum(`inventory_upt`.`kuantitas`) AS `kuantitas` from `inventory_upt` where (`inventory_upt`.`status` = 'in') group by `inventory_upt`.`kode_barang`,`inventory_upt`.`kode_upt`,`inventory_upt`.`id_satuan`) `inventory_in` left join (select `inventory_pusat`.`kode_barang` AS `kode_barang`,`inventory_pusat`.`kode_pusat` AS `kode_kantor`,`inventory_pusat`.`id_satuan` AS `id_satuan`,sum(`inventory_pusat`.`kuantitas`) AS `kuantitas` from `inventory_pusat` where (`inventory_pusat`.`status` = 'out') group by `inventory_pusat`.`kode_barang`,`inventory_pusat`.`kode_pusat`,`inventory_pusat`.`id_satuan` union select `inventory_upt`.`kode_barang` AS `kode_barang`,`inventory_upt`.`kode_upt` AS `kode_kantor`,`inventory_upt`.`id_satuan` AS `id_satuan`,sum(`inventory_upt`.`kuantitas`) AS `kuantitas` from `inventory_upt` where (`inventory_upt`.`status` = 'out') group by `inventory_upt`.`kode_barang`,`inventory_upt`.`kode_upt`,`inventory_upt`.`id_satuan`) `inventory_out` on(((`inventory_in`.`kode_kantor` = `inventory_out`.`kode_kantor`) and (`inventory_in`.`kode_barang` = `inventory_out`.`kode_barang`) and (`inventory_in`.`id_satuan` = `inventory_out`.`id_satuan`)))) left join `master_satuan` on((`inventory_in`.`id_satuan` = `master_satuan`.`id_satuan`))) ;

--
-- VIEW  `view_inventory`
-- Data: Tidak ada
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
