-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 10:28 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata_lombok`
--

-- --------------------------------------------------------

--
-- Table structure for table `ds_evidences`
--

CREATE TABLE `ds_evidences` (
  `id` int(11) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ds_evidences`
--

INSERT INTO `ds_evidences` (`id`, `code`, `name`) VALUES
(1, 'D1', 'Fotografi'),
(2, 'D1', 'Berenang'),
(3, 'D1', 'Memancing'),
(4, 'D1', 'Membaca'),
(5, 'D1', 'Sepeda Alam'),
(6, 'D1', 'Piknik'),
(7, 'D1', 'Lari'),
(8, 'D1', 'Naik gunung/Bukit'),
(9, 'D1', 'Berkemah'),
(10, 'D1', 'Wisata Perahu'),
(11, 'D1', 'Kurang dari 50 ribu'),
(12, 'D1', 'Lebih dari 100 ribu'),
(13, 'D1', 'Lebih dari 100'),
(14, 'D1', 'Kamar Mandi'),
(15, 'D1', 'Tempat duduk'),
(16, 'D1', 'Kuliner'),
(17, 'D1', 'Kamar'),
(18, 'D1', 'Parkiran'),
(19, 'D1', 'Tempat Solat'),
(20, 'D1', 'Tempat Sepi'),
(21, 'D1', 'Taman Bermain'),
(22, 'D1', 'Taman Bunga'),
(23, 'D1', 'Spot Foto'),
(24, 'D1', 'Lapangan Voly, Bola, Basket'),
(25, 'D1', 'Kolam Renang'),
(26, 'D1', 'Lebih dari 1KM'),
(27, 'D1', 'Kurang dari 1 KM'),
(28, 'D1', 'Lebih dari 5 Kilo'),
(29, 'D1', 'Kurang dari 1 Hari'),
(30, 'D1', 'Kurang dari 2 Hari');

-- --------------------------------------------------------

--
-- Table structure for table `ds_problems`
--

CREATE TABLE `ds_problems` (
  `id` int(11) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ds_problems`
--

INSERT INTO `ds_problems` (`id`, `code`, `name`, `notes`) VALUES
(1, 'P1', 'Daerah Sembalun', 'Sembalun Lawang, Pusuk'),
(2, 'P2', 'Daerah Sembelia', 'Pantai Sulung'),
(3, 'P3', 'Daerah Jerowaru', 'Pantai Pink, Pantai Surga');

-- --------------------------------------------------------

--
-- Table structure for table `ds_rules`
--

CREATE TABLE `ds_rules` (
  `id_problem` int(11) DEFAULT NULL,
  `id_evidence` int(11) DEFAULT NULL,
  `cf` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ds_rules`
--

INSERT INTO `ds_rules` (`id_problem`, `id_evidence`, `cf`) VALUES
(1, 1, 0.3),
(2, 1, 0.3),
(3, 1, 0.3),
(1, 2, 0.3),
(2, 2, 0.3),
(3, 2, 0.3),
(1, 3, 0.3),
(2, 3, 0.3),
(3, 3, 0.3),
(1, 4, 0.6),
(2, 4, 0.6),
(1, 5, 0.6),
(2, 5, 0.6),
(1, 6, 0.6),
(2, 6, 0.6),
(3, 6, 0.6),
(1, 7, 0.6),
(2, 7, 0.6),
(1, 8, 0.6),
(1, 9, 0.6),
(3, 9, 0.6),
(2, 10, 0.7),
(2, 11, 0.6),
(3, 11, 0.6),
(2, 12, 0.6),
(3, 12, 0.6),
(2, 13, 0.6),
(3, 13, 0.6),
(3, 14, 0.85),
(3, 15, 0.4),
(3, 16, 0.85),
(3, 17, 0.75),
(3, 18, 0.9),
(3, 19, 0.9),
(3, 20, 0.75),
(2, 21, 0.6),
(3, 21, 0.6),
(1, 22, 0.6),
(3, 22, 0.6),
(1, 23, 0.6),
(3, 23, 0.6),
(1, 24, 0.7),
(1, 25, 0.85),
(1, 26, 0.9),
(1, 27, 0.35),
(1, 28, 0.6),
(1, 29, 0.75),
(1, 30, 0.95),
(2, 31, 0.95),
(2, 32, 0.45),
(2, 33, 0.8),
(2, 34, 0.9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ds_evidences`
--
ALTER TABLE `ds_evidences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_problems`
--
ALTER TABLE `ds_problems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ds_evidences`
--
ALTER TABLE `ds_evidences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ds_problems`
--
ALTER TABLE `ds_problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
