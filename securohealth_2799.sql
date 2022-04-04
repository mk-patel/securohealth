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

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `bill_order_id`, `bill_txn_id`, `bill_amount`, `bill_trt_id`, `bill_user_id`, `bill_hp_id`, `bill_date`, `bill_status`) VALUES
(1, 'WY2Oax+cvpKC5XGKSZMl', 'rrvvv', 'JA==', 3, 1, 1, 'JO/6Cm2f0IyK52mPSJ4kUrNyag==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blocked_hospital`
--

CREATE TABLE `blocked_hospital` (
  `bkh_id` int(10) NOT NULL,
  `bkh_hp_id` int(20) NOT NULL,
  `bkh_user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocked_hospital`
--

INSERT INTO `blocked_hospital` (`bkh_id`, `bkh_hp_id`, `bkh_user_id`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `card_scanned`
--

CREATE TABLE `card_scanned` (
  `cs_id` int(20) NOT NULL,
  `cs_user_id` int(20) NOT NULL,
  `cs_hp_id` int(20) NOT NULL,
  `cs_date` varchar(200) NOT NULL,
  `cs_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_scanned`
--

INSERT INTO `card_scanned` (`cs_id`, `cs_user_id`, `cs_hp_id`, `cs_date`, `cs_time`) VALUES
(1, 0, 0, '2002-01-01', '05:40 AM'),
(2, 1, 1, '2022-04-02', '07:45 AM'),
(3, 2, 1, '2022-04-02', '08:57 AM');

-- --------------------------------------------------------

--
-- Table structure for table `forget_pass`
--

CREATE TABLE `forget_pass` (
  `fp_id` int(20) NOT NULL,
  `fp_user_id` int(20) NOT NULL,
  `fp_hp_id` int(20) NOT NULL,
  `fp_tokan` varchar(200) NOT NULL
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

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hp_id`, `hp_email`, `hp_password`, `hp_name`, `hp_type`, `hp_speciality`, `hp_license`, `hp_address`, `hp_state`, `hp_district`, `hp_city`, `hp_pincode`, `hp_desc`, `hp_files`, `hp_date`, `hp_time`, `hp_status`) VALUES
(1, 'e5+nFi0=', 'c514e10ab5bcfa0dcac130d2277d4ce344d2390a', 'dLKh', 'dbw=', 'fLU=', 'Jev+DA==', 'Q6+rSmD/gNPb+mnxH8VmRMBQT+21kA==', 'VberTDTGksbbpCE=', 'cQ==', 'XberUTLFicjOv2nUG8h1Cg==', 0, 'cbg=', 'frC5SCnbgM2XuiDcH8pnAeAcFOHpzIESUJltqupET31HEhUNQEatHgvo1zES', 'JO/6Cm2f0IyK5w==', 'Ju7wDXaPoOw=', 2);

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
(1, 2, '1EcgzFkGMI0=', '1EcgzA==', 'nA4=', '438=', 'yFs=', 1, 'nw5phx5ca8qxgm5AD03Yyynynio='),
(2, 3, 'y1g=', 'z1w=', 'nw==', '438=', 'xVY=', 1, 'nw5phx5ca8qxgm5AD03Yyyrynio='),
(3, 4, 'Wws=', 'XQ0=', 'Dg==', 'cC8=bb', 'Wws=', 1, 'DF7mKRaRnmm81lokzCHDMpx0Ssg=');

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

--
-- Dumping data for table `treatment_session`
--

INSERT INTO `treatment_session` (`trt_id`, `trt_name`, `trt_inf`, `trt_dis`, `trt_srt`, `trt_corm`, `trt_date`, `trt_closing_date`, `trt_user_id`, `trt_hp_id`, `trt_completed`, `trt_ref_id`) VALUES
(1, 'UZyIe3Ga0uY=', '0', '0', '0', '0', 'JO/6Cm2f0IyK52mPS54kULNyag==', 'JO/6Cm2f0IyK52mPS54mXbNyag==', 1, 0, 1, 0),
(2, 'V+34CnHu1ec=', 'VL6pTCXdiMDW', 'VbCmXA==', 'WrC9', 'WLA=', 'JO/6Cm2f0IyK52mPS54gVLNyag==', 'NA', 1, 0, 0, 0),
(3, 'JJj5CnKdpJQ=', 'VL6pTCXdiMDW', '0', '0', '0', 'JO/6Cm2f0IyK52mPS54hU7Nyag==', 'JO/6Cm2f0IyK52mPSJ4kU7Nyag==', 1, 1, 1, 0),
(4, 'VJ2OfgGbppQ=', 'VL6pTCXdiMDW', '0', '0', '0', 'JO/6Cm2f0IyK52mPSJ4mXLNyag==', 'NA', 1, 1, 1, 0),
(5, 'JO2NDnTo1eI=', '0', '0', '0', '0', 'JO/4Cm2f1YyK5GmPQp4hUbNyag==', 'NA', 2, 1, 0, 0),
(6, 'V5j7eQeZ15U=', 'VL6pTCXdiMDW', 'ULq8XTI=', 'W7quUTXC', 'WLA=', 'JO/4Cm2f1YyK5GmPQp4hU7Nyag==', 'NA', 2, 1, 0, 0);

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
  `user_district` varchar(500) NOT NULL,
  `user_state` varchar(500) NOT NULL,
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

INSERT INTO `user` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `password`, `user_gender`, `user_dob`, `user_address`, `user_city`, `user_district`, `user_state`, `user_status`, `user_pincode`, `user_otp`, `user_verified`, `user_image`, `user_qrcode`, `user_card`, `user_card_status`, `user_date`, `user_time`, `user_govt`) VALUES
(1, 'W76kUTPH', 'Rr6+XSw=', 'e76kUTPHitGJ73D/Hcl1Df8dRO23', 'c514e10ab5bcfa0dcac130d2277d4ce344d2390a', 'e76mXQ==', 'JO/6Cm2f0IyK5A==', 'Q6+rSmD/gNPb+mnxH8VmRMBQT+21kA==', 'XberUTLFicjOv2nUG8h1Cg==', '', 'VbeiWTTbiNLdtzvX', '1', 'Iub7C3OX', 482061, 1, 'f7KrXyXczpLZ5XndSZIlB6tWRLvi0tNLU8lu/7pOUDQHQQ==', 'Z62pVyTKko6L+DnRHQ==', 'Iub5DnmX1pGN5ng=', 0, '2002-01-01', '12:20 AM', 1),
(2, 'W76kUTPH', 'Rr6+XSw=', 'Y5+/FjU=', '405bef64f90e39ddc8f8c9655f480e82dfddd60c', 'e76mXQ==', 'JO/4Cm2f1YyK5w==', 'Q6+rSmD/gNPb+mnxH8VmRMBQT+21kA==', 'XberUTLFicjOv2nUG8h1Cg==', 'VbeiWTTbiNLdtzvX', 'VbeiWTTbiNLdtzvX', '3', 'Iub7C3OX', 944630, 1, 'f7KrXyXczpeI4n7cS8chVqJXQrPr0tJAWcxq8b9OUDQHQQ==', 'Z62pVyTKko6I+DnRHQ==', 'Iub7CXiZ05aM4X4=', 0, '2022-04-02', '08:53 AM', 1);

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
-- Indexes for table `card_scanned`
--
ALTER TABLE `card_scanned`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `forget_pass`
--
ALTER TABLE `forget_pass`
  ADD PRIMARY KEY (`fp_id`);

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
  MODIFY `bill_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocked_hospital`
--
ALTER TABLE `blocked_hospital`
  MODIFY `bkh_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `card_scanned`
--
ALTER TABLE `card_scanned`
  MODIFY `cs_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forget_pass`
--
ALTER TABLE `forget_pass`
  MODIFY `fp_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatment_record`
--
ALTER TABLE `treatment_record`
  MODIFY `tr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `treatment_session`
--
ALTER TABLE `treatment_session`
  MODIFY `trt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
