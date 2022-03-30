-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 03:18 PM
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
-- Database: `securohealth_2799`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_id` int(10) NOT NULL,
  `bill_order_id` varchar(200) NOT NULL,
  `bill_txn_id` varchar(500) NOT NULL,
  `bill_amount` varchar(500) NOT NULL,
  `bill_trt_id` int(20) NOT NULL,
  `bill_user_id` int(20) NOT NULL,
  `bill_hp_id` int(10) NOT NULL,
  `bill_date` varchar(200) NOT NULL,
  `bill_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_hospital`
--

CREATE TABLE `blocked_hospital` (
  `bkh_id` int(10) NOT NULL,
  `bkh_hp_id` int(20) NOT NULL,
  `bkh_user_id` int(20) NOT NULL,
  `bkh_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hp_id` int(20) NOT NULL,
  `hp_email` varchar(200) NOT NULL,
  `hp_password` varchar(500) NOT NULL,
  `hp_name` mediumtext NOT NULL,
  `hp_type` varchar(500) NOT NULL,
  `hp_speciality` mediumtext NOT NULL,
  `hp_license` varchar(200) NOT NULL,
  `hp_address` mediumtext NOT NULL,
  `hp_state` varchar(200) NOT NULL,
  `hp_district` varchar(200) NOT NULL,
  `hp_city` varchar(200) NOT NULL,
  `hp_pincode` int(100) NOT NULL,
  `hp_desc` mediumtext NOT NULL,
  `hp_files` varchar(500) NOT NULL,
  `hp_date` varchar(200) NOT NULL,
  `hp_time` varchar(200) NOT NULL,
  `hp_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_record`
--

CREATE TABLE `treatment_record` (
  `tr_id` int(20) NOT NULL,
  `tr_trt_id` int(20) NOT NULL,
  `tr_title` mediumtext NOT NULL,
  `tr_desc` mediumtext NOT NULL,
  `tr_cost` mediumtext NOT NULL,
  `tr_files` mediumtext NOT NULL,
  `tr_doctor` mediumtext NOT NULL,
  `tr_type` int(2) NOT NULL,
  `tr_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_session`
--

CREATE TABLE `treatment_session` (
  `trt_id` int(20) NOT NULL,
  `trt_name` varchar(500) NOT NULL,
  `trt_inf` varchar(500) NOT NULL,
  `trt_dis` varchar(500) NOT NULL,
  `trt_srt` varchar(500) NOT NULL,
  `trt_corm` varchar(500) NOT NULL,
  `trt_date` varchar(200) NOT NULL,
  `trt_closing_date` varchar(200) NOT NULL,
  `trt_user_id` int(10) NOT NULL,
  `trt_hp_id` int(10) NOT NULL,
  `trt_completed` int(1) NOT NULL,
  `trt_ref_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `user_first_name` mediumtext NOT NULL,
  `user_last_name` mediumtext NOT NULL,
  `user_email` mediumtext NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_gender` mediumtext NOT NULL,
  `user_dob` mediumtext NOT NULL,
  `user_address` mediumtext NOT NULL,
  `user_city` mediumtext NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_pincode` mediumtext NOT NULL,
  `user_otp` int(6) NOT NULL,
  `user_verified` int(1) NOT NULL,
  `user_image` mediumtext NOT NULL,
  `user_qrcode` mediumtext NOT NULL,
  `user_card` mediumtext NOT NULL,
  `user_card_status` int(1) NOT NULL,
  `user_date` mediumtext NOT NULL,
  `user_time` mediumtext NOT NULL,
  `user_govt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `blocked_hospital`
--
ALTER TABLE `blocked_hospital`
  ADD PRIMARY KEY (`bkh_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hp_id`);

--
-- Indexes for table `treatment_record`
--
ALTER TABLE `treatment_record`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `treatment_session`
--
ALTER TABLE `treatment_session`
  ADD PRIMARY KEY (`trt_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blocked_hospital`
--
ALTER TABLE `blocked_hospital`
  MODIFY `bkh_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hp_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_record`
--
ALTER TABLE `treatment_record`
  MODIFY `tr_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_session`
--
ALTER TABLE `treatment_session`
  MODIFY `trt_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
