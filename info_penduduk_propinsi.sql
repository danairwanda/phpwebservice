-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2015 at 04:56 PM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.6.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_enterprise`
--

-- --------------------------------------------------------

--
-- Table structure for table `info_penduduk_propinsi`
--

CREATE TABLE IF NOT EXISTS `info_penduduk_propinsi` (
  `prop_id` int(11) NOT NULL,
  `prop_kode` varchar(2) NOT NULL,
  `prop_nama` varchar(100) NOT NULL,
  `prop_ibukota` varchar(100) DEFAULT NULL,
  `prop_jml_penduduk_pria` bigint(20) NOT NULL DEFAULT '0',
  `prop_jml_penduduk_wanita` bigint(20) NOT NULL DEFAULT '0',
  `prop_website` varchar(100) DEFAULT NULL,
  `prop_map_latitude` float(10,6) NOT NULL DEFAULT '0.000000',
  `prop_map_longitude` float(10,6) NOT NULL DEFAULT '0.000000'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_penduduk_propinsi`
--

INSERT INTO `info_penduduk_propinsi` (`prop_id`, `prop_kode`, `prop_nama`, `prop_ibukota`, `prop_jml_penduduk_pria`, `prop_jml_penduduk_wanita`, `prop_website`, `prop_map_latitude`, `prop_map_longitude`) VALUES
(1, '11', 'Nanggroe Aceh Darussalam', 'Banda Aceh', 2005763, 2025826, 'http://www.acehprov.go.id', 5.351273, 95.562370),
(2, '12', 'Sumatera Utara', 'Medan', 5833465, 5855522, 'http://www.pempropsu.go.id', 2.115355, 99.545097),
(3, '13', 'Sumatera Barat', 'Padang', 2248970, 2306840, 'http://www.sumbarprov.go.id', -0.739940, 100.800003),
(4, '14', 'Riau', 'Pekanbaru', 2329094, 2234312, 'http://www.riau.go.id', 0.886826, 101.706825),
(5, '15', 'Jambi', 'Jambi', 1351370, 1275846, 'http://www.jambiprov.go.id', -1.485183, 102.438057),
(6, '16', 'Sumatera Selatan', 'Palembang', 3424444, 3343201, 'http://www.sumselprov.go.id', -3.319437, 103.914398),
(7, '17', 'Bengkulu', 'Bengkulu', 788630, 757656, 'http://www.bengkuluprov.go.id', -3.800649, 102.256203),
(8, '18', 'Lampung', 'Bandar Lampung', 3682753, 3421819, 'http://www.lampung.go.id', -5.450000, 105.266670),
(9, '19', 'Kep. Bangka Belitung', 'Pangkal Pinang', 543878, 498950, 'http://www.babelprov.go.id', -2.741051, 106.440590),
(10, '20', 'Kepulauan Riau', 'Tanjung Pinang', 636078, 636933, 'http://www.kepripro.go.id', 0.900000, 104.449997),
(11, '30', 'Banten', 'Serang', 4587897, 4420254, 'http://www.bantenprov..go.id', -6.405817, 106.064018),
(12, '31', 'DKI Jakarta', 'Jakarta', 4390746, 4448501, 'http://www.jakarta.go.id', -6.211544, 106.845169),
(13, '32', 'Jawa Barat', 'Bandung', 19703106, 19183869, 'http://www.jabarprov.go.id', -7.090911, 107.668884),
(14, '33', 'Jawa Tengah', 'Semarang', 15929449, 15966665, 'http://www.jatengprov.go.id', -7.150975, 110.140259),
(15, '34', 'DI Yogyakarta', 'Yogyakarta', 1669939, 1667156, 'http://www.jogjaprov.go.id', -7.797224, 110.368797),
(16, '35', 'Jawa Timur', 'Surabaya', 17906468, 18151639, 'http://www.jatimprov.go.id', -7.289166, 112.734398),
(17, '51', 'Bali', 'Denpasar', 1715130, 1662962, 'http://www.baliprov.go.id', -8.670458, 115.212631),
(18, '52', 'Nusa Tenggara Barat', 'Mataram', 2014744, 2154951, 'http://www.ntbprov.go.id', -8.581824, 116.106834),
(19, '53', 'Nusa Tenggara Timur', 'Kupang', 2125959, 2117223, 'http://www.nttprov.go.id', -10.184301, 123.594849),
(20, '61', 'Kalimantan Barat', 'Pontianak', 2070557, 1972260, 'http://www.kalbar.go.id', 0.142927, 109.257378),
(21, '62', 'Kalimantan Tengah', 'Palangkaraya', 986430, 926596, 'http://www.kalteng.go.id', -1.681488, 113.382355),
(22, '63', 'Kalimantan Selatan', 'Banjarmasin', 1650537, 1620876, 'http://www.kalselprov.go.id', -3.092642, 115.283760),
(23, '64', 'Kalimantan Timur', 'Samarinda', 1486179, 1354695, 'http://www.kaltimprov.go.id', 1.640630, 116.419388),
(24, '70', 'Gorontalo', 'Gorontalo', 463073, 456942, 'http://www.gorontaloprov.go.id', 0.544261, 123.042610),
(25, '71', 'Sulawesi Utara', 'Manado', 1080528, 1040489, 'http://www.sulut.go.id', 1.470889, 124.845459),
(26, '72', 'Sulawesi Tengah', 'Palu', 1174656, 1116313, 'http://www.sulteng..go.id', -1.430025, 121.445618),
(27, '73', 'Sulawesi Selatan', 'Makasar', 4115294, 4341829, 'http://www.sulselprov.go.id', -5.137623, 119.412460),
(28, '74', 'Sulawesi Tenggara', 'Kendari', 988121, 972576, 'http://www.sulteng.go.id', -4.144910, 122.174606),
(29, '75', 'Sulawesi Barat', 'Mamuju', 0, 0, 'http://www.sulbar.go.id', -2.844137, 119.232079),
(30, '81', 'Maluku', 'Maluku', 634107, 615105, 'http://www.malukuprov.go.id', -3.238462, 130.145279),
(31, '82', 'Maluku Utara', 'Ternate', 452127, 429740, 'http://www.malutprov.go.id', 1.570999, 127.808769),
(32, '85', 'Papua', 'Jayapura', 1290799, 1149039, 'http://www.papua.go.id', -2.523695, 140.697128),
(33, '87', 'Papua Barat', 'Manokwari', 0, 0, 'http://www.papuabarat.go.id', -0.866667, 131.250000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_penduduk_propinsi`
--
ALTER TABLE `info_penduduk_propinsi`
  ADD PRIMARY KEY (`prop_id`),
  ADD UNIQUE KEY `prop_kode` (`prop_kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_penduduk_propinsi`
--
ALTER TABLE `info_penduduk_propinsi`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
