-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2019 at 10:42 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikarwan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_gaji`
--

DROP TABLE IF EXISTS `tb_gaji`;
CREATE TABLE IF NOT EXISTS `tb_gaji` (
  `id_gaji` int(11) NOT NULL AUTO_INCREMENT,
  `grade` char(2) NOT NULL,
  `gaji` int(11) NOT NULL,
  PRIMARY KEY (`id_gaji`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_gaji`
--

INSERT INTO `tb_gaji` (`id_gaji`, `grade`, `gaji`) VALUES
(1, 'A', 1000000),
(2, 'B', 2000000),
(3, 'C', 3000000),
(4, 'D', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

DROP TABLE IF EXISTS `tb_karyawan`;
CREATE TABLE IF NOT EXISTS `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `nip` text NOT NULL,
  `nama` text NOT NULL,
  `gender` char(2) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `grade` char(2) NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nip`, `nama`, `gender`, `tgl_lahir`, `tgl_masuk`, `grade`) VALUES
(1, '001', 'Ari', 'M', '1990-10-10', '2018-10-10', 'A'),
(15, '004', 'Dina', 'F', '1995-01-08', '2009-11-02', 'D'),
(13, '002', 'Budi', 'M', '1980-12-20', '2008-10-01', 'B'),
(14, '003', 'Cila', 'F', '1995-01-08', '2009-11-02', 'C');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
