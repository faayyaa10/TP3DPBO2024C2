-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_album`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(100) NOT NULL,
  `title_track` varchar(100) NOT NULL,
  `tahun_rilis` year(4) DEFAULT NULL,
  `jumlah_lagu` int(11) DEFAULT NULL,
  `id_musisi` int(11) DEFAULT NULL,
  `id_label` int(11) DEFAULT NULL,
  `foto_album` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `nama_album`, `title_track`, `tahun_rilis`, `jumlah_lagu`, `id_musisi`, `id_label`, `foto_album`) VALUES
(1, 'Colorful Trauma', 'I hate you', '2022', 5, 1, 1, 'colorfulTrauma.jpeg'),
(2, 'Attacca', 'Rock With You', '2021', 7, 2, 2, 'attacca.jpeg'),
(3, 'The Book of Us: The Demon', 'Zombie', '2020', 8, 3, 3, 'theDemon.jpeg'),
(4, 'Orange Blood', 'Sweet Venom', '2023', 7, 4, 4, 'orangeBlood.jpeg'),
(19, 'Dark Blood', 'Bite Me', '2023', 6, 4, 4, 'darkBlood.jpg'),
(20, 'The Book of Us: Entropy', 'Sweet Chaos', '2019', 11, 3, 3, 'entropy.jpg'),
(21, 'Face the Sun', 'HOT', '2022', 9, 2, 2, 'faceTheSun.jpg'),
(22, 'Only Lovers Left', 'Waiting', '2021', 6, 1, 1, 'onlyLoversLeft.jpeg'),
(26, 'DUAL', 'Back To Me', '2023', 11, 8, 6, 'dual.jpeg'),
(27, 'Midnight Guest', 'DM', '2022', 5, 10, 2, 'midnightGuest.jpeg'),
(28, 'Dimension: Answer', 'Blessed-Cursed', '2022', 11, 4, 4, 'albumDA.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE `label` (
  `id_label` int(11) NOT NULL,
  `nama_label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id_label`, `nama_label`) VALUES
(1, 'Yuehua Entertainment'),
(2, 'Pledis Entertainment'),
(3, 'JYP Entertainment'),
(4, 'Belift Lab'),
(6, 'Windfall');

-- --------------------------------------------------------

--
-- Table structure for table `musisi`
--

CREATE TABLE `musisi` (
  `id_musisi` int(11) NOT NULL,
  `nama_musisi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `musisi`
--

INSERT INTO `musisi` (`id_musisi`, `nama_musisi`) VALUES
(1, 'WOODZ'),
(2, 'Seventeen'),
(3, 'Day6'),
(4, 'Enhypen'),
(5, 'Xdinary Heroes'),
(8, 'The Rose'),
(10, 'fromis_9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_musisi` (`id_musisi`),
  ADD KEY `id_label` (`id_label`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id_label`);

--
-- Indexes for table `musisi`
--
ALTER TABLE `musisi`
  ADD PRIMARY KEY (`id_musisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `label`
--
ALTER TABLE `label`
  MODIFY `id_label` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `musisi`
--
ALTER TABLE `musisi`
  MODIFY `id_musisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_musisi`) REFERENCES `musisi` (`id_musisi`),
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`id_label`) REFERENCES `label` (`id_label`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
