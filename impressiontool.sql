-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2014 at 08:23 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `impressiontool`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_name`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_name` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `list_ip_block_name`
--

INSERT INTO `list_ip_block_name` (`id`, `ip_block_name`, `status`) VALUES
(1, 'BAYAREA-CPE-23', 0),
(2, 'JUMPSTART-5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_owner`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_owner` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `list_ip_block_owner`
--

INSERT INTO `list_ip_block_owner` (`id`, `ip_block_owner`, `status`) VALUES
(2, 'Comcast Cable Communications, Inc.', 1),
(3, 'Cellco Partnership DBA Verizon Wireless', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_range`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_range` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `list_ip_block_range`
--

INSERT INTO `list_ip_block_range` (`id`, `ip_block_range`, `status`) VALUES
(1, '76.102.0.0 - 76.103.255.255', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE IF NOT EXISTS `lookups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `ip_block_owner` text,
  `ip_block_range` text,
  `ip_block_name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `lookups`
--

INSERT INTO `lookups` (`id`, `ip`, `ip_block_owner`, `ip_block_range`, `ip_block_name`) VALUES
(1, '98.204.106.27', 'Comcast Cable Communications, Inc.', '98.204.0.0 - 98.204.255.255', 'DC-CPE-29'),
(2, '98.204.106.27', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(3, '76.99.165.8', 'Comcast Cable Communications, Inc.', '76.98.0.0 - 76.99.255.255', 'PA-CPE-33'),
(4, '76.99.165.8', 'Comcast Cable Communications, Inc.', '76.96.0.0 - 76.127.255.255', 'JUMPSTART-5'),
(5, '142.129.243.254', 'Time Warner Cable Internet LLC', '142.129.0.0 - 142.129.255.255', 'RRWE'),
(6, '71.146.74.8', 'AT&T Internet Services', '71.128.0.0 - 71.159.255.255', 'SBCIS-SIS80'),
(7, '73.44.253.130', 'Comcast IP Services, L.L.C.', '73.44.0.0 - 73.45.255.255', 'CHICAGO-CPE-6'),
(8, '73.44.253.130', 'Comcast IP Services, L.L.C.', '73.0.0.0 - 73.255.255.255', 'CABLE-1'),
(9, '98.86.119.216', 'BellSouth.net Inc.', '98.64.0.0 - 98.95.255.255', 'BELLSNET-BLK19'),
(10, '98.86.119.216', 'TYS ADSL CBB', '98.86.0.0 - 98.86.127.255', 'BLS-98-86-0-0-1003020951'),
(11, '99.44.112.202', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(12, '69.114.103.19', 'Optimum Online', '69.112.0.0 - 69.127.255.255', 'NETBLK-OOL-6BLK'),
(13, '69.114.103.19', 'Optimum Online (Cablevision Systems)', '69.114.100.0 - 69.114.103.255', 'OOL-CPE-NYK4NY-69-114-100-0-22'),
(14, '75.136.10.0', 'Charter Communications', '75.136.0.0 - 75.136.31.255', 'KNG-TN-75-136-0'),
(15, '75.136.10.0', 'Charter Communications', '75.128.0.0 - 75.143.255.255', 'NETBLK-CHARTER-NET'),
(16, '76.114.134.124', 'Comcast Cable Communications, Inc.', '76.96.0.0 - 76.127.255.255', 'JUMPSTART-5'),
(17, '76.114.134.124', 'Comcast Cable Communications, Inc.', '76.114.128.0 - 76.114.255.255', 'DC-CPE-28'),
(18, '24.160.86.144', 'Time Warner Cable Internet LLC', '24.160.0.0 - 24.170.127.255', 'ROAD-RUNNER-5'),
(19, '72.199.187.191', 'Cox Communications', '72.199.0.0 - 72.199.255.255', 'NETBLK-SD-RDC-72-199-0-0'),
(20, '72.199.187.191', 'Cox Communications Inc.', '72.192.0.0 - 72.223.255.255', 'NETBLK-COX-ATLANTA-11'),
(21, '174.134.72.159', 'BRIGHT HOUSE NETWORKS, LLC', '174.134.0.0 - 174.135.255.255', 'MTA-10'),
(22, '174.134.72.159', 'BrightHouse Networks Bakersfield', '174.134.0.0 - 174.134.255.255', 'BHN-BKFD-RES-8'),
(23, '67.233.171.21', 'Embarq Corporation', '67.232.0.0 - 67.239.255.255', 'EMBARQ-GLOBAL'),
(24, '63.155.50.119', 'Qwest Communications Company, LLC', '63.152.0.0 - 63.159.255.255', 'QWEST-INET-16'),
(25, '166.182.82.86', 'Service Provider Corporation', '166.128.0.0 - 166.255.255.255', 'NETBLK-CDPD-B'),
(26, '68.51.140.122', 'Comcast Cable Communications, Inc.', '68.51.128.0 - 68.51.143.255', 'SAVANNAH-1'),
(27, '68.51.140.122', 'Comcast Cable Communications, Inc.', '68.32.0.0 - 68.63.255.255', 'JUMPSTART-1'),
(28, '70.196.8.93', 'Cellco Partnership DBA Verizon Wireless', '70.192.0.0 - 70.223.255.255', 'WIRELESSDATANETWORK'),
(29, '71.71.17.198', 'Time Warner Cable Internet LLC', '71.64.0.0 - 71.79.255.255', 'RRMA'),
(30, '150.70.173.42', 'Japan Network Information Center', '150.26.0.0 - 150.100.255.255', 'JAPAN150'),
(31, '70.184.105.6', 'Cox Communications Inc.', '70.160.0.0 - 70.191.255.255', 'NETBLK-COX-ATLANTA-10'),
(32, '70.184.105.6', 'Cox Communications', '70.184.96.0 - 70.184.127.255', 'NETBLK-PH-CBS-70-184-96-0'),
(33, '184.3.201.154', 'Embarq Corporation', '184.0.0.0 - 184.7.255.255', 'EMBARQ-GLOBAL'),
(34, '72.128.125.27', 'Time Warner Cable Internet LLC', '72.128.0.0 - 72.135.255.255', 'RRWE'),
(35, '72.229.17.180', 'Time Warner Cable Internet LLC', '72.224.0.0 - 72.231.255.255', 'RRNY'),
(36, '68.185.179.132', 'Charter Communications', '68.185.160.0 - 68.185.191.255', 'MDSN-WI-68-185-160'),
(37, '68.185.179.132', 'Charter Communications', '68.184.0.0 - 68.191.255.255', 'CHARTER-NET-7BLK'),
(38, '74.73.16.111', 'Time Warner Cable Internet LLC', '74.64.0.0 - 74.79.255.255', 'RRNY'),
(39, '174.62.210.59', 'Comcast Cable Communications, Inc.', '174.62.128.0 - 174.62.255.255', 'NEW-ENGLAND-1'),
(40, '174.62.210.59', 'Comcast Cable Communications, Inc.', '174.48.0.0 - 174.63.255.255', 'JUMPSTART-5'),
(41, '71.233.87.56', 'Comcast Cable Communications, Inc.', '71.232.0.0 - 71.233.255.255', 'BOSTON-13'),
(42, '71.233.87.56', 'Comcast Cable Communications, Inc.', '71.224.0.0 - 71.239.255.255', 'JUMPSTART-5'),
(43, '75.137.161.89', 'Charter Communications', '75.137.160.0 - 75.137.191.255', 'GWN-GA-75-137-160'),
(44, '75.137.161.89', 'Charter Communications', '75.128.0.0 - 75.143.255.255', 'NETBLK-CHARTER-NET'),
(45, '71.127.41.66', 'Verizon Online LLC', '71.96.0.0 - 71.127.255.255', 'VIS-71-96'),
(46, '98.218.93.20', 'Comcast Cable Communications, Inc.', '98.218.0.0 - 98.218.255.255', 'DC-CPE-30'),
(47, '98.218.93.20', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(48, '68.95.161.236', 'AT&T Internet Services', '68.88.0.0 - 68.95.255.255', 'SBCIS-SBIS-6BLK'),
(49, '68.95.161.236', 'BRAS7 PPPOX POOL RCSNTX', '68.95.160.0 - 68.95.163.255', 'SBC068095160000040123'),
(50, '67.48.19.106', 'Time Warner Cable Internet LLC', '67.48.0.0 - 67.49.255.255', 'RRWE'),
(51, '68.114.135.52', 'Charter Communications', '68.114.128.0 - 68.114.143.255', 'CLMBIA-TN-68-114-128'),
(52, '68.114.135.52', 'Charter Communications', '68.112.0.0 - 68.119.255.255', 'CHARTER-NET-6BLK'),
(53, '173.169.109.17', 'Time Warner Cable Internet LLC', '173.168.0.0 - 173.175.255.255', 'RRSW'),
(54, '98.201.69.129', 'Comcast Cable Communications, Inc.', '98.201.0.0 - 98.201.255.255', 'HOUSTON-5'),
(55, '98.201.69.129', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(56, '184.58.166.115', 'Time Warner Cable Internet LLC', '184.54.0.0 - 184.59.255.255', 'RRMA'),
(57, '150.70.173.54', 'Japan Network Information Center', '150.26.0.0 - 150.100.255.255', 'JAPAN150'),
(58, '172.6.24.208', 'AT&T Internet Services', '172.0.0.0 - 172.15.255.255', 'SIS-80-8-2012'),
(59, '73.179.127.102', 'Comcast IP Services, L.L.C.', '73.179.0.0 - 73.179.255.255', 'POMPANO-4'),
(60, '73.179.127.102', 'Comcast IP Services, L.L.C.', '73.0.0.0 - 73.255.255.255', 'CABLE-1'),
(61, '71.223.99.36', 'Qwest Communications Company, LLC', '71.208.0.0 - 71.223.255.255', 'QWEST-INET-118'),
(62, '184.158.3.212', 'CenturyTel Internet Holdings, Inc.', '184.156.0.0 - 184.159.255.255', 'NETBLK-CENTURYTEL16'),
(63, '50.14.138.29', 'CLEAR WIRELESS LLC', '50.8.0.0 - 50.15.255.255', 'CLEARWIRE-DNS-NET'),
(64, '166.147.120.25', 'Service Provider Corporation', '166.128.0.0 - 166.255.255.255', 'NETBLK-CDPD-B'),
(65, '96.245.21.165', 'Verizon Online LLC', '96.224.0.0 - 96.255.255.255', 'VIS-BLOCK');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
