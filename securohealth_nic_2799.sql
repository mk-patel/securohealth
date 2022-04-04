-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 01:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securohealth_nic_2799`
--

-- --------------------------------------------------------

--
-- Table structure for table `secure_keys`
--

CREATE TABLE `secure_keys` (
  `sk_id` int(20) NOT NULL,
  `sk_uid` int(20) NOT NULL,
  `sk_keys` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secure_keys`
--

INSERT INTO `secure_keys` (`sk_id`, `sk_uid`, `sk_keys`) VALUES
(6, 2, 'fY6wXBmbtO7PnhnMKg==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `secure_keys`
--
ALTER TABLE `secure_keys`
  ADD PRIMARY KEY (`sk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `secure_keys`
--
ALTER TABLE `secure_keys`
  MODIFY `sk_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
