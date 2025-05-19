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
-- Table structure for table `tblquizitems`
--

CREATE TABLE `tblquizitems` (
  `quiz_item_id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `project_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblquizitems`
--

INSERT INTO `tblquizitems` (`quiz_item_id`, `quiz_id`, `project_item_id`) VALUES
(1, 58, 3),
(2, 67, 4),
(3, 68, 5),
(4, 69, 6),
(5, 70, 7),
(6, 71, 8),
(7, 72, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblquizitems`
--
ALTER TABLE `tblquizitems`
  ADD PRIMARY KEY (`quiz_item_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `project_item_id` (`project_item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblquizitems`
--
ALTER TABLE `tblquizitems`
  MODIFY `quiz_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblquizitems`
--
ALTER TABLE `tblquizitems`
  ADD CONSTRAINT `tblquizitems_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `tblquizzes` (`quiz_id`),
  ADD CONSTRAINT `tblquizitems_ibfk_2` FOREIGN KEY (`project_item_id`) REFERENCES `tblprojectitems` (`project_item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
