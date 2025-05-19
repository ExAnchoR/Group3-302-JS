-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 03:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbaccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblprojects`
--

CREATE TABLE `tblprojects` (
  `project_id` int(11) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprojects`
--

INSERT INTO `tblprojects` (`project_id`, `title_id`, `email`) VALUES
(1, 'sample1k', 'sample2@gmail.com'),
(2, 'sample2k', 'sample2@gmail.com'),
(3, 'sample4k', 'sample2@gmail.com'),
(4, 'great', 'sample2@gmail.com'),
(5, 'sample8k', 'sample2@gmail.com'),
(6, 'come what mau', 'sample2@gmail.com'),
(7, 'bal', 'sample2@gmail.com'),
(8, 'ambot', 'sample2@gmail.com'),
(9, 'iasjdi', 'sample2@gmail.com'),
(10, 'ano', 'sample2@gmail.com'),
(11, 'but', 'sample2@gmail.com'),
(12, 'sasa', 'sample2@gmail.com'),
(13, 'sasasa', 'sample2@gmail.com'),
(14, 'wds', 'sample2@gmail.com'),
(15, 'sd', 'sample2@gmail.com'),
(16, 'sadasd', 'sample2@gmail.com'),
(17, 'omkie', 'sample2@gmail.com'),
(18, 'omkie', 'sample2@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblprojects`
--
ALTER TABLE `tblprojects`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
