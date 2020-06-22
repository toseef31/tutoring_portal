-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2020 at 11:56 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OnBoarding`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sur_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('inactive','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `verify_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `sur_name`, `company_name`, `email`, `password`, `mobile`, `local`, `location`, `choice_number`, `status`, `verify_code`, `created_at`, `updated_at`) VALUES
(1, 'Nabeel', 'Ahmed', NULL, 'peek@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '03054949010', 'Singapore', 'Singapore', '+65-51-4898947', 'inactive', '524146', '2020-02-05 14:30:40', '2020-02-05 14:30:40'),
(2, 'Nabeel', 'Ahmed', '', 'peek212@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '03054949010', 'Singapore', 'Singapore', '+65-51-4898947', 'inactive', '979126', '2020-02-05 14:59:19', '2020-02-05 14:59:19'),
(3, 'Nabeel', 'Ahmed', '', 'nabeel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6581234567', 'Singapore', 'Singapore', '+65-51-4898947', 'inactive', '418278', '2020-02-06 07:20:26', '2020-02-06 07:20:26'),
(4, 'Nabeel', 'Ahmed', '', 'nabeelirbab@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '923054949010', 'Singapore', 'Singapore', '+65-51-4898947', 'active', '463782', '2020-02-06 07:21:48', '2020-02-06 07:37:53'),
(5, 'zee', 'Ahmed', '', 'zee@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '923487991015', 'Singapore', 'Singapore', '+65-51-4898947', 'active', '283422', '2020-02-06 07:42:37', '2020-02-06 07:43:02'),
(6, 'Nabeel', 'Ahmed', '의 유튜브.', '1313@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '+923475030294', 'Singapore', 'Singapore', '+65-51-4898947', 'inactive', '700407', '2020-02-06 08:55:28', '2020-02-06 08:55:28'),
(7, 'Nabeel', 'Ahmed', '의 유튜브.', '123rbab@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '+923328624840', 'Singapore', 'Singapore', '+65-51-4898947', 'active', '323825', '2020-02-06 09:15:27', '2020-02-06 09:19:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
