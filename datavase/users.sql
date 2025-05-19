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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'charles lawrence i. bandiola', 'pochucks1@gmail.com', '$2y$10$UeNDUXM229Jo/xNEKZz9bO.V.9v3fCE0r.cj2i09vmgKH1G1U2kNG', '2025-04-20 12:16:15'),
(2, 'idk', '123@gmail.com', '$2y$10$BUy9m/hb3zA.hNdFCjCaEOe9lcdld8j2kVM/ulvlT19b4dT6RN7kq', '2025-04-26 08:50:00'),
(3, 'okay rako', 'haha@gmail.com', '$2y$10$Q3mSR7MQMfe4K4zr.HEwrO3wCZ1PhH2DIpbl6VIZ5m1iFFSf5wGm.', '2025-04-27 01:00:46'),
(4, 'sample1', 'sample1@gmail.com', '$2y$10$ChlmU4fjRTdM.muOg2PAMOAhgvXQSQ/CyitUq7TpcT9iCnDndfEmi', '2025-04-27 08:38:36'),
(5, 'sample2', 'sample2@gmail.com', '$2y$10$IiFxHg6v.xC1ns2bryR7W.g10VyomkybapKD1XCAABkLGv2KJVIDq', '2025-04-27 08:39:03'),
(6, 'sno banaman em', 'snobanamanem@gmail.com', '$2y$10$DbStLOJtCRQ3wFDNmNtTqerSRrCtgBgno.Z1VBXjj66cYkt6lcdwq', '2025-05-04 09:52:51'),
(7, 'pochucks', 'ahaha@gmail.com', '$2y$10$KPfPHwBlpysQdvIGYlOhOOXNPwkIRpKbOrBHppvOmRPIdVk10BBhW', '2025-05-04 09:54:38'),
(8, '23424', '3423@gmail.com', '123', '2025-05-04 09:55:58'),
(9, '123', '1233@gmail.com', '$2y$10$arjjhwfgTZDpYl0fwAWkce9kV/vOwRqG0cAcF.H2MmitglEfXA2vm', '2025-05-04 10:04:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
