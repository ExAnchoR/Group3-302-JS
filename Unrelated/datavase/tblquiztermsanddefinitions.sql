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
-- Table structure for table `tblquiztermsanddefinitions`
--

CREATE TABLE `tblquiztermsanddefinitions` (
  `quizTerm_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `termss` varchar(255) NOT NULL,
  `definitionss` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblquiztermsanddefinitions`
--

INSERT INTO `tblquiztermsanddefinitions` (`quizTerm_id`, `quiz_id`, `termss`, `definitionss`) VALUES
(1, 54, 'bal', 'bal'),
(2, 55, 'ambot', 'ambot'),
(3, 56, 'iasjdi', 'iasjdi'),
(4, 57, 'ano', 'ano'),
(5, 58, 'but', 'but'),
(6, 67, '', ''),
(7, 68, '', ''),
(8, 69, '', ''),
(9, 70, '', ''),
(10, 71, '[\"sadasd\",\"omkieomkie\"]', '[\"sadasd\",\"omkie\"]'),
(11, 72, '[\"sadasd\",\"omkieomkie\",\"123\"]', '[\"sadasd\",\"omkie\",\"123\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblquiztermsanddefinitions`
--
ALTER TABLE `tblquiztermsanddefinitions`
  ADD PRIMARY KEY (`quizTerm_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblquiztermsanddefinitions`
--
ALTER TABLE `tblquiztermsanddefinitions`
  MODIFY `quizTerm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblquiztermsanddefinitions`
--
ALTER TABLE `tblquiztermsanddefinitions`
  ADD CONSTRAINT `tblquiztermsanddefinitions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `tblquizzes` (`quiz_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
