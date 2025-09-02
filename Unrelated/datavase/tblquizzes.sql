-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 03:45 PM
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
-- Table structure for table `tblquizzes`
--

CREATE TABLE `tblquizzes` (
  `quiz_id` int(11) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblquizzes`
--

INSERT INTO `tblquizzes` (`quiz_id`, `title_id`, `user_id`) VALUES
(24, 'sample37', 5),
(25, 'sample38', 5),
(26, 'sample41', 5),
(27, 'sample42', 5),
(28, 'sample44', 5),
(29, 'sample46', 5),
(30, 'sample47', 5),
(31, 'sample49', 5),
(32, 'sample50', 5),
(33, 'sample50', 5),
(36, 'sample126', 5),
(37, 'sample500', 5),
(38, 'sample600', 5),
(39, 'sampleszzzzz', 1),
(40, 'math', 1),
(41, 'science', 1),
(42, 'sample1k', 5),
(43, 'sample2k', 5),
(44, 'sample3k', 5),
(45, 'sample4k', 5),
(46, 'sample5k', 5),
(47, 'great', 5),
(48, 'haha', 5),
(49, 'hahaha', 5),
(50, 'sample6k', 5),
(51, 'sample7k', 5),
(52, 'sample8k', 5),
(53, 'come what mau', 5),
(54, 'bal', 5),
(55, 'ambot', 5),
(56, 'iasjdi', 5),
(57, 'ano', 5),
(58, 'but', 5),
(65, 'sasa', 5),
(66, 'sas', 5),
(67, 'sasasa', 5),
(68, 'wds', 5),
(69, 'sd', 5),
(70, 'sadasd', 5),
(71, 'omkie', 5),
(72, 'omkie', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblquizzes`
--
ALTER TABLE `tblquizzes`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblquizzes`
--
ALTER TABLE `tblquizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblquizzes`
--
ALTER TABLE `tblquizzes`
  ADD CONSTRAINT `tblquizzes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
