-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 12:26 PM
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
  `hp_name` mediumtext NOT NULL,
  `hp_type` varchar(500) NOT NULL,
  `hp_speciality` mediumtext NOT NULL,
  `hp_license` varchar(200) NOT NULL,
  `hp_address` mediumtext NOT NULL,
  `hp_state` varchar(200) NOT NULL,
  `hp_district` varchar(200) NOT NULL,
  `hp_city` varchar(200) NOT NULL,
  `hp_pincode` int(100) NOT NULL,
  `hp_desc` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hp_id`, `hp_name`, `hp_type`, `hp_speciality`, `hp_license`, `hp_address`, `hp_state`, `hp_district`, `hp_city`, `hp_pincode`, `hp_desc`) VALUES
(1, 'fry', '1', 'd', '1', 'c', '1', '1', '1', 3333, 'x');

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

--
-- Dumping data for table `treatment_record`
--

INSERT INTO `treatment_record` (`tr_id`, `tr_trt_id`, `tr_title`, `tr_desc`, `tr_cost`, `tr_files`, `tr_doctor`, `tr_type`, `tr_date`) VALUES
(1, 2, 'ttttt', '667', '400', '0', 'ghuu', 1, ''),
(2, 2, 'NA', '  rr', '0', '', 'dd', 1, ''),
(3, 2, 'NA', '  rr', '0', '', 'dd', 1, '2022-03-19, 06:51 PM'),
(4, 2, 'NA', '  dd', '0', '', 'ff', 1, '2022-03-19, 06:51 PM'),
(5, 2, 'WJ4=', 'Nv/7CQ==', 'Jg==', '', 'fbQ=', 1, 'JO/4Cm2f0oyL72WfSpMuVKQTd88='),
(6, 2, 'WJ4=', 'Nv+uXA==', 'Jg==', 'WJ4=', 'c7o=', 1, 'JO/4Cm2f0oyL72WfSpMuVacTd88=');

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
  `trt_completed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_session`
--

INSERT INTO `treatment_session` (`trt_id`, `trt_name`, `trt_inf`, `trt_dis`, `trt_srt`, `trt_corm`, `trt_date`, `trt_closing_date`, `trt_user_id`, `trt_hp_id`, `trt_completed`) VALUES
(1, 'abcd', '1', '1', '1', '1', 'f4g', 'f4g', 1, 1, 0),
(2, 'ttt', 'VL6pTCXdiMDW', 'VbCmXA==', 'WrC9', 'WLA=', 't4', 't4', 1, 1, 1);

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `password`, `user_gender`, `user_dob`, `user_address`, `user_city`, `user_status`, `user_pincode`, `user_otp`, `user_verified`, `user_image`, `user_qrcode`, `user_card`, `user_card_status`, `user_date`, `user_time`, `user_govt`) VALUES
(1, 'W76kUTPH', 'Rr6+XSw=', 'e76kUTPHitGJ73D/Hcl1Df8dRO23', 'c514e10ab5bcfa0dcac130d2277d4ce344d2390a', 'e76mXQ==', 'JO/6Cm2f0IyK4g==', 'Q6+rSmD/gNPb+mnxH8VmRMBQT+21kA==', 'XberUTLFicjOv2nUG8h1Cg==', '1', 'Iub7C3OX', 361158, 1, 'f7KrXyXczpLZ5XndTZEkVPZQFrrq0tFHVs1v+71GUC4ZQ0o=', 'Z62pVyTKko6L+DnRHQ==', 'Iej9D3iY05eO73k=', 0, '2002-01-01', '12:36 AM', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `blocked_hospital`
--
ALTER TABLE `blocked_hospital`
  MODIFY `bkh_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatment_record`
--
ALTER TABLE `treatment_record`
  MODIFY `tr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `treatment_session`
--
ALTER TABLE `treatment_session`
  MODIFY `trt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
