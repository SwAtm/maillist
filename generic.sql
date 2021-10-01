-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2021 at 06:15 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `generic`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'BANGALORE');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'INDIA');

-- --------------------------------------------------------

--
-- Table structure for table `daccount`
--

CREATE TABLE IF NOT EXISTS `daccount` (
`id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daccount`
--

INSERT INTO `daccount` (`id`, `name`) VALUES
(1, 'DONATION-GENERAL');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`) VALUES
(1, 'BANGALORE');

-- --------------------------------------------------------

--
-- Table structure for table `id_type`
--

CREATE TABLE IF NOT EXISTS `id_type` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `id_type`
--

INSERT INTO `id_type` (`id`, `name`, `code`) VALUES
(1, 'PAN', '1'),
(2, 'ADHAAR', '2'),
(3, 'PASSPORT', '4'),
(4, 'DRIVING LICENCE', '6'),
(5, 'RATION CARD', '7'),
(6, 'ELECTOR PHOTO ID', '5'),
(7, 'NOT AVAILABLE', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mlist`
--

CREATE TABLE IF NOT EXISTS `mlist` (
`id` int(11) NOT NULL,
  `hon` varchar(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `add1` varchar(35) NOT NULL,
  `add2` varchar(35) NOT NULL,
  `add3` varchar(35) NOT NULL,
  `add4` varchar(35) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pin` varchar(6) DEFAULT NULL,
  `dist` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `phone1` varchar(30) NOT NULL,
  `phone2` varchar(30) NOT NULL,
  `email1` varchar(50) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N',
  `id_name` varchar(30) NOT NULL,
  `id_no` varchar(15) NOT NULL,
  `id_code` varchar(2) NOT NULL,
  `send` varchar(1) NOT NULL DEFAULT 'Y',
  `lang` varchar(1) NOT NULL DEFAULT 'K',
  `initiated` varchar(1) NOT NULL DEFAULT 'N',
  `ref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pmode`
--

CREATE TABLE IF NOT EXISTS `pmode` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sub_series` varchar(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pmode`
--

INSERT INTO `pmode` (`id`, `name`, `sub_series`) VALUES
(1, 'CASH', 'OCS'),
(2, 'CHEQUE', 'OCH');

-- --------------------------------------------------------

--
-- Table structure for table `pwd`
--

CREATE TABLE IF NOT EXISTS `pwd` (
`id` int(11) NOT NULL,
  `user` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `pwd` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pwd`
--

INSERT INTO `pwd` (`id`, `user`, `pwd`) VALUES
(1, 'admin', '$2y$10$TT.btgn5V2c7QvxR8mAaj.XcefQrc2cW4etYarxfcTH/5hKOK7Ft2');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
`id` int(11) NOT NULL,
  `series` varchar(8) NOT NULL,
  `sub_series` varchar(6) NOT NULL,
  `no` int(5) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(35) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city_pin` varchar(35) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `id_name` varchar(30) NOT NULL,
  `id_no` varchar(15) NOT NULL,
  `id_code` varchar(2) NOT NULL,
  `section_code` varchar(5) NOT NULL,
  `amount` decimal(13,2) NOT NULL,
  `purpose` varchar(75) NOT NULL,
  `mode_payment` varchar(25) NOT NULL,
  `ch_no` varchar(6) NOT NULL,
  `tr_date` date DEFAULT NULL,
  `pmt_details` varchar(35) NOT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'KARNATAKA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daccount`
--
ALTER TABLE `daccount`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `id_type`
--
ALTER TABLE `id_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlist`
--
ALTER TABLE `mlist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmode`
--
ALTER TABLE `pmode`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `pwd`
--
ALTER TABLE `pwd`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sr_no` (`series`,`sub_series`,`no`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `daccount`
--
ALTER TABLE `daccount`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `id_type`
--
ALTER TABLE `id_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mlist`
--
ALTER TABLE `mlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pmode`
--
ALTER TABLE `pmode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pwd`
--
ALTER TABLE `pwd`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
