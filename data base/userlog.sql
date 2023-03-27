-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 11:32 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `journal_ID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `manu` varchar(30) NOT NULL,
  `journal_title` varchar(255) NOT NULL,
  `abstracts` varchar(255) NOT NULL,
  `key_words` varchar(255) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`journal_ID`, `UserID`, `first_name`, `last_name`, `phone`, `address`, `manu`, `journal_title`, `abstracts`, `key_words`, `file_name`) VALUES
(9656, 12330, 'Suman', 'Mondal', '786583', 'Champadanga-Dankuni road', 'Recherché paper', 'test title', 'lorem', 'lorem', 'test'),
(9669, 12330, 'Suman', 'Mondal', '786583', 'gdhxg d hdh  yf  f', 'Recherché paper', 'hfh', 'wfde', 'dytd', '11100722016');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `UserID` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phn` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`UserID`, `first_name`, `last_name`, `email`, `phn`, `password`, `date`) VALUES
(12329, 'Suma', 'mon', 'smondal.qwerty@gmail.com', '7865833872', '$2y$10$YTmH2gGrwwyzKZPseln.fuWDzeGsiWuQIZDbrzejPC2EP0WKLhLqG', '2023-03-21 19:38:21'),
(12330, 'Suman', 'Mondal', 'smondal@gmail.com', '786583', '$2y$10$Z0pRsEnTc.MCbZ7FDKUHKOptSrKjSs5/KApQgVrmgoNbjuZuCSQLa', '2023-03-21 23:28:31'),
(12331, 'Suman', 'monbdal', 's.qwerty@gmail.com', '454354', '$2y$10$9BoQ5027HEfOBeR14ruAbuvA5MRBZ5wSvOe2rFoiK0r9u6jyVon1m', '2023-03-27 00:52:29'),
(12333, 'Abhi', 'Mon', 'smoy@gmail.com', '132453423', '$2y$10$lfJhZlWdBWQwpXFBANvjMevNxbP8Uh1sZLHz/XkELMMzj7zuchsnW', '2023-03-27 02:20:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`journal_ID`),
  ADD UNIQUE KEY `journal_title` (`journal_title`),
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `address` (`email`),
  ADD UNIQUE KEY `phn0` (`phn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `journal_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9670;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12334;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
