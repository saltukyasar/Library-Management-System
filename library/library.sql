-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 05:27 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `isim` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `kullaniciAdi` varchar(100) NOT NULL,
  `sifre` varchar(100) NOT NULL,
  `guncellemeTarihi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET= latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `isim`, `AdminEmail`, `kullaniciAdi`, `sifre`, `guncellemeTarihi`) VALUES
(1, 'Anuj Kumar', 'phpgurukulofficial@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2017-07-16 18:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `yazarTablo`
--

CREATE TABLE `yazarTablo` (
  `id` int(11) NOT NULL,
  `yazarIsim` varchar(159) DEFAULT NULL,
  `olusturmaTarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET= latin1;

--
-- Dumping data for table `yazarTablo`
--

INSERT INTO `yazarTablo` (`id`, `yazarIsim`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
(1, 'Anuj kumar', '2017-07-08 12:49:09', '2017-07-08 15:16:59'),
(2, 'Chetan Bhagatt', '2017-07-08 14:30:23', '2017-07-08 15:15:09'),
(3, 'Anita Desai', '2017-07-08 14:35:08', NULL),
(4, 'HC Verma', '2017-07-08 14:35:21', NULL),
(5, 'R.D. Sharma ', '2017-07-08 14:35:36', NULL),
(9, 'fwdfrwer', '2017-07-08 15:22:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kitaplarTablo`
--

CREATE TABLE `kitaplarTablo` (
  `id` int(11) NOT NULL,
  `kitapIsim` varchar(255) DEFAULT NULL,
  `kategoriId` int(11) DEFAULT NULL,
  `yazarId` int(11) DEFAULT NULL,
  `ISBNdeger` int(11) DEFAULT NULL,
  `kitapFiyt` int(11) DEFAULT NULL,
  `kayitZmn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET= latin1;

--
-- Dumping data for table `kitaplarTablo`
--

INSERT INTO `kitaplarTablo` (`id`, `kitapIsim`, `kategoriId`, `yazarId`, `ISBNdeger`, `kitapFiyt`, `kayitZmn`, `guncellemeTarihi`) VALUES
(1, 'PHP And MySql programming', 5, 1, 222333, 20, '2017-07-08 20:04:55', '2017-07-15 05:54:41'),
(3, 'physics', 6, 4, 1111, 15, '2017-07-08 20:17:31', '2017-07-15 06:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `kategoriTbl`
--

CREATE TABLE `kategoriTbl` (
  `id` int(11) NOT NULL,
  `kategoriIsim` varchar(150) DEFAULT NULL,
  `durum` int(1) DEFAULT NULL,
  `olusturmaTarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET= latin1;

--
-- Dumping data for table `kategoriTbl`
--

INSERT INTO `kategoriTbl` (`id`, `kategoriIsim`, `durum`, `olusturmaTarihi`, `guncellemeTarihi`) VALUES
(4, 'Romantic', 1, '2017-07-04 18:35:25', '2017-07-06 16:00:42'),
(5, 'Technology', 1, '2017-07-04 18:35:39', '2017-07-08 17:13:03'),
(6, 'Science', 1, '2017-07-04 18:35:55', '0000-00-00 00:00:00'),
(7, 'Management', 0, '2017-07-04 18:36:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `emanetTablo`
--

CREATE TABLE `emanetTablo` (
  `id` int(11) NOT NULL,
  `kitapId` int(11) DEFAULT NULL,
  `uyeId` varchar(150) DEFAULT NULL,
  `verilisTarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `teslimTarih` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sonDurum` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET= latin1;

--
-- Dumping data for table `emanetTablo`
--

INSERT INTO `emanetTablo` (`id`, `kitapId`, `uyeId`, `verilisTarih`, `teslimTarih`, `sonDurum`, `fine`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `uyeTablo`
--

CREATE TABLE `uyeTablo` (
  `id` int(11) NOT NULL,
  `uyeId` varchar(100) DEFAULT NULL,
  `isim` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `telNo` char(11) DEFAULT NULL,
  `sifre` varchar(120) DEFAULT NULL,
  `durum` int(1) DEFAULT NULL,
  `kayitZmn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `guncellemeTarihi` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET= latin1;

--
-- Dumping data for table `uyeTablo`
--

INSERT INTO `uyeTablo` (`id`, `uyeId`, `isim`, `EmailId`, `telNo`, `sifre`, `durum`, `kayitZmn`, `guncellemeTarihi`) VALUES
(1, 'SID002', 'Anuj kumar', 'anuj.lpu1@gmail.com', '9865472555', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-11 15:37:05', '2017-07-15 18:26:21'),
(4, 'SID005', 'sdfsd', 'csfsd@dfsfks.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 0, '2017-07-11 15:41:27', '2017-07-15 17:43:03'),
(8, 'SID009', 'test', 'test@gmail.com', '2359874527', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-11 15:58:28', '2017-07-15 13:42:44'),
(9, 'SID010', 'Amit', 'amit@gmail.com', '8585856224', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-15 13:40:30', NULL),
(10, 'SID011', 'Sarita Pandey', 'sarita@gmail.com', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 1, '2017-07-15 18:00:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yazarTablo`
--
ALTER TABLE `yazarTablo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitaplarTablo`
--
ALTER TABLE `kitaplarTablo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoriTbl`
--
ALTER TABLE `kategoriTbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emanetTablo`
--
ALTER TABLE `emanetTablo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uyeTablo`
--
ALTER TABLE `uyeTablo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uyeId` (`uyeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `yazarTablo`
--
ALTER TABLE `yazarTablo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kitaplarTablo`
--
ALTER TABLE `kitaplarTablo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategoriTbl`
--
ALTER TABLE `kategoriTbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emanetTablo`
--
ALTER TABLE `emanetTablo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uyeTablo`
--
ALTER TABLE `uyeTablo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
