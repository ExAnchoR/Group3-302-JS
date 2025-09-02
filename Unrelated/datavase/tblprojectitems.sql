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
-- Table structure for table `tblprojectitems`
--

CREATE TABLE `tblprojectitems` (
  `project_item_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `termss` varchar(255) NOT NULL,
  `definitionss` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprojectitems`
--

INSERT INTO `tblprojectitems` (`project_item_id`, `project_id`, `termss`, `definitionss`) VALUES
(1, 9, 'iasjdi', 'iasjdi'),
(2, 10, 'ano', 'ano'),
(3, 11, 'but', 'but'),
(4, 13, '', ''),
(5, 14, '', ''),
(6, 15, '', ''),
(7, 16, '', ''),
(8, 17, '[\"sadasd\",\"omkieomkie\"]', '[\"sadasd\",\"omkie\"]'),
(9, 18, '[\"sadasd\",\"omkieomkie\",\"123\"]', '[\"sadasd\",\"omkie\",\"123\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblprojectitems`
--
ALTER TABLE `tblprojectitems`
  ADD PRIMARY KEY (`project_item_id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblprojectitems`
--
ALTER TABLE `tblprojectitems`
  MODIFY `project_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblprojectitems`
--
ALTER TABLE `tblprojectitems`
  ADD CONSTRAINT `tblprojectitems_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tblprojects` (`project_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
