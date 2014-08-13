-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2014 at 09:23 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `list_ip_block_name`
--

INSERT INTO `list_ip_block_name` (`id`, `ip_block_name`, `status`) VALUES
(1, 'BAYAREA-CPE-23', 0),
(2, 'JUMPSTART-5', 0),
(3, 'CCCH3-4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_owner`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_owner` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `list_ip_block_owner`
--

INSERT INTO `list_ip_block_owner` (`id`, `ip_block_owner`, `status`) VALUES
(2, 'Comcast', 1),
(3, 'Cellco Partnership DBA Verizon Wireless', 1),
(4, 'Charter Communications', 0);

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_range`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_range` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `list_ip_block_range`
--

INSERT INTO `list_ip_block_range` (`id`, `ip_block_range`, `status`) VALUES
(1, '76.102.0.0 - 76.103.255.255', 1),
(2, '98.204.0.0 - 98.204.255.255', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=227 ;

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
(65, '96.245.21.165', 'Verizon Online LLC', '96.224.0.0 - 96.255.255.255', 'VIS-BLOCK'),
(66, '23.27.220.22', 'EGIHosting', '23.27.0.0 - 23.27.255.255', 'EGIHOSTING-4'),
(67, '23.27.220.22', 'Detect Network', '23.27.220.0 - 23.27.220.255', 'NET-23-27-220-0'),
(68, '71.162.116.5', 'Verizon Online LLC', '71.161.224.0 - 71.168.63.255', 'VIS-BLOCK'),
(69, '23.242.9.253', 'Time Warner Cable Internet LLC', '23.240.0.0 - 23.243.255.255', 'RRWE'),
(70, '98.168.227.198', 'Cox Communications Inc.', '98.160.0.0 - 98.191.255.255', 'CXA'),
(71, '98.168.227.198', 'Cox Communications', '98.168.192.0 - 98.168.255.255', 'NETBLK-OM-RDC-98-168-192-0'),
(72, '66.188.248.88', 'Charter Communications', '66.188.224.0 - 66.188.255.255', 'EUCLR-WI-66-188-224'),
(73, '66.188.248.88', 'Charter Communications', '66.188.0.0 - 66.191.255.255', 'CHARTER-NET-5BLK'),
(74, '24.137.145.15', 'CableAmerica Corporation', '24.137.128.0 - 24.137.191.255', 'CABLEAZ'),
(75, '71.190.226.245', 'Verizon Online LLC', '71.181.128.0 - 71.191.255.255', 'VIS-BLOCK'),
(76, '108.12.86.75', 'Verizon Online LLC', '108.0.0.0 - 108.57.255.255', 'VIS-BLOCK'),
(77, '75.190.166.148', 'Time Warner Cable Internet LLC', '75.176.0.0 - 75.191.255.255', 'RRMA'),
(78, '68.196.137.39', 'Optimum Online', '68.192.0.0 - 68.199.255.255', 'NETBLK-OOL-5BLK'),
(79, '68.196.137.39', 'Optimum Online (Cablevision Systems)', '68.196.136.0 - 68.196.139.255', 'OOL-CPE-BRFDNJ-68-196-136-0-22'),
(80, '72.89.248.50', 'Verizon Online LLC', '72.87.64.0 - 72.92.127.255', 'VIS-72-64'),
(81, '71.246.66.219', 'Verizon Online LLC', '71.241.224.0 - 71.253.255.255', 'VIS-BLOCK'),
(82, '98.250.146.44', 'Comcast Cable Communications, Inc.', '98.250.0.0 - 98.250.255.255', 'MICHIGAN-38'),
(83, '98.250.146.44', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(84, '98.115.34.106', 'Verizon Online LLC', '98.108.0.0 - 98.119.255.255', 'VIS-BLOCK'),
(85, '169.234.248.88', 'University of California, Irvine', '169.234.0.0 - 169.234.255.255', 'UCI-NET'),
(86, '69.73.42.169', 'KNOLOGY,  Inc.', '69.73.42.0 - 69.73.42.255', 'PANC49'),
(87, '69.73.42.169', 'WideOpenWest Finance LLC', '69.73.0.0 - 69.73.127.255', 'WIDEOPENWEST'),
(88, '32.218.83.133', 'AT&T Global Network Services, LLC', '32.0.0.0 - 32.255.255.255', 'ATT-32-0-0-0-A'),
(89, '24.51.196.144', 'Advanced Cable Communications', '24.51.192.0 - 24.51.223.255', 'MYACC'),
(90, '174.49.216.134', 'Comcast Cable Communications, Inc.', '174.49.128.0 - 174.49.255.255', 'PA-41'),
(91, '174.49.216.134', 'Comcast Cable Communications, Inc.', '174.48.0.0 - 174.63.255.255', 'JUMPSTART-5'),
(92, '24.51.196.144', 'Advanced Cable Communications', '24.51.192.0 - 24.51.223.255', 'MYACC'),
(93, '71.84.0.239', 'Charter Communications', '71.80.0.0 - 71.95.255.255', 'NETBLK-CHARTER-NET'),
(94, '71.84.0.239', 'Charter Communications', '71.84.0.0 - 71.84.31.255', 'TRL-CA-71-84-0'),
(95, '66.65.136.33', 'Time Warner Cable Internet LLC', '66.65.0.0 - 66.65.255.255', 'RR-NYC-1BLK'),
(96, '74.96.219.49', 'Verizon Online LLC', '74.96.0.0 - 74.111.255.255', 'VIS-BLOCK'),
(97, '24.51.196.144', 'Advanced Cable Communications', '24.51.192.0 - 24.51.223.255', 'MYACC'),
(98, '66.65.136.33', 'Time Warner Cable Internet LLC', '66.65.0.0 - 66.65.255.255', 'RR-NYC-1BLK'),
(99, '69.248.156.65', 'Comcast Cable Communications, Inc', '69.248.0.0 - 69.248.255.255', 'PA-27'),
(100, '69.248.156.65', 'Comcast Cable Communications, Inc.', '69.240.0.0 - 69.255.255.255', 'JUMPSTART-4'),
(101, '67.249.3.53', 'Time Warner Cable Internet LLC', '67.240.0.0 - 67.255.255.255', 'RRNY'),
(102, '216.255.163.234', 'Thames Valley Communications, Inc.', '216.255.160.0 - 216.255.175.255', 'TVC-8'),
(103, '24.182.54.176', 'Charter Communications', '24.176.0.0 - 24.183.255.255', 'NETBLK-CHARTER-NET'),
(104, '24.182.54.176', 'Charter Communications', '24.182.48.0 - 24.182.63.255', 'RDW-NV-24-182-48'),
(105, '74.78.92.5', 'Time Warner Cable Internet LLC', '74.64.0.0 - 74.79.255.255', 'RRNY'),
(106, '50.136.173.192', 'Comcast Cable Communications Holdings, Inc', '50.136.128.0 - 50.136.255.255', 'BAYAREA-CPE-32'),
(107, '50.136.173.192', 'Comcast Cable Communications Holdings, Inc', '50.128.0.0 - 50.255.255.255', 'CCCH3-4'),
(108, '72.23.236.150', 'Armstrong Cable Services', '72.23.236.0 - 72.23.236.255', 'ARMC-SOUTHPOINT'),
(109, '72.23.236.150', 'Armstrong Cable Services', '72.23.0.0 - 72.23.255.255', 'ACS-INTERNET'),
(110, '24.7.4.66', 'Comcast Cable Communications', '24.7.0.0 - 24.7.127.255', 'BAYAREA-11'),
(111, '24.7.4.66', 'Comcast Cable Communications, Inc.', '24.0.0.0 - 24.15.255.255', 'EASTERNSHORE-1'),
(112, '70.115.202.153', 'Time Warner Cable Internet LLC', '70.112.0.0 - 70.127.255.255', 'RRSW'),
(113, '99.9.225.19', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(114, '66.25.212.44', 'Time Warner Cable Internet LLC', '66.25.0.0 - 66.25.255.255', 'ROADRUNNER-SOUTHWEST'),
(115, '173.30.1.34', 'iwcia004cm9', '173.30.0.1 - 173.30.3.254', 'MEDIACOMCC-173-30-0-0-IowaCity-IA'),
(116, '99.121.90.167', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(117, '76.107.149.224', 'Comcast Cable Communications, Inc.', '76.107.0.0 - 76.107.255.255', 'MEMPHIS-3'),
(118, '76.107.149.224', 'Comcast Cable Communications, Inc.', '76.96.0.0 - 76.127.255.255', 'JUMPSTART-5'),
(119, '107.146.50.242', 'BRIGHT HOUSE NETWORKS, LLC', '107.144.0.0 - 107.147.255.255', 'BHN-13'),
(120, '107.146.50.242', 'Bright House Networks - CFL Division', '107.146.0.0 - 107.146.127.255', 'COMM-SRVCS-7'),
(121, '99.13.13.53', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(122, '71.192.10.207', 'Comcast Cable Communications, Inc.', '71.192.0.0 - 71.207.255.255', 'ATT-COMCAST'),
(123, '71.192.10.207', 'Comcast Cable Communications, IP Services', '71.192.0.0 - 71.192.255.255', 'BOSTON-11'),
(124, '70.180.150.177', 'Cox Communications Inc.', '70.160.0.0 - 70.191.255.255', 'NETBLK-COX-ATLANTA-10'),
(125, '70.180.150.177', 'Cox Communications', '70.180.128.0 - 70.180.255.255', 'NETBLK-LV-RDC-70-180-128-0'),
(126, '107.147.43.249', 'BRIGHT HOUSE NETWORKS, LLC', '107.144.0.0 - 107.147.255.255', 'BHN-13'),
(127, '107.147.43.249', 'BrightHouse Networks Indianapolis', '107.147.0.0 - 107.147.127.255', 'BHN-INDP-RES-02'),
(128, '71.51.39.7', 'Embarq Corporation', '71.48.0.0 - 71.55.255.255', 'EMBARQ-GLOBAL'),
(129, '76.184.245.10', 'Time Warner Cable Internet LLC', '76.184.0.0 - 76.187.255.255', 'RRACI'),
(130, '174.23.182.172', 'Qwest Communications Company, LLC', '174.16.0.0 - 174.31.255.255', 'QWEST-INET-127'),
(131, '99.124.148.196', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(132, '68.47.168.30', 'Comcast Cable Communications, Inc.', '68.47.160.0 - 68.47.191.255', 'KNOXVILLE-2'),
(133, '68.47.168.30', 'Comcast Cable Communications, Inc.', '68.32.0.0 - 68.63.255.255', 'JUMPSTART-1'),
(134, '66.215.135.194', 'Charter Communications', '66.214.0.0 - 66.215.255.255', 'CHARWR-02'),
(135, '66.215.135.194', 'Hot Spot Broadband', '66.215.135.192 - 66.215.135.195', 'HTSP-66-215-135-192'),
(136, '74.90.112.43', 'Optimum Online', '74.88.0.0 - 74.90.255.255', 'NETBLK-OOL-8BLK'),
(137, '74.90.112.43', 'Optimum Online (Cablevision Systems)', '74.90.112.0 - 74.90.113.255', 'OOL-CPE-NYX1NY-74-90-112-0-23'),
(138, '69.22.169.31', 'nLayer Communications, Inc.', '69.22.128.0 - 69.22.191.255', 'GTT-ARIN-BLK1'),
(139, '69.22.169.31', 'GIGLINX, Inc.', '69.22.169.0 - 69.22.169.255', 'NLYR-69-22-169-0-1'),
(140, '71.83.177.164', 'Charter Communications', '71.80.0.0 - 71.95.255.255', 'NETBLK-CHARTER-NET'),
(141, '71.83.177.164', 'Charter Communications', '71.83.160.0 - 71.83.191.255', 'MNT-CA-71-83-160'),
(142, '96.251.49.8', 'Verizon Online LLC', '96.224.0.0 - 96.255.255.255', 'VIS-BLOCK'),
(143, '206.255.9.104', 'Cablelynx', '206.255.0.0 - 206.255.255.255', 'CABLELYNX'),
(144, '206.255.9.104', 'Longview Cable TV', '206.255.0.0 - 206.255.15.255', 'CABLELYNX'),
(145, '70.199.143.246', 'Cellco Partnership DBA Verizon Wireless', '70.192.0.0 - 70.223.255.255', 'WIRELESSDATANETWORK'),
(146, '108.228.49.72', 'AT&T Internet Services', '108.192.0.0 - 108.255.255.255', 'SBCIS-SBIS'),
(147, '108.52.73.129', 'Verizon Online LLC', '108.0.0.0 - 108.57.255.255', 'VIS-BLOCK'),
(148, '99.66.105.68', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(149, '50.137.4.75', 'Comcast Cable Communications Holdings, Inc', '50.137.0.0 - 50.137.63.255', 'OREGON-26'),
(150, '50.137.4.75', 'Comcast Cable Communications Holdings, Inc', '50.128.0.0 - 50.255.255.255', 'CCCH3-4'),
(151, '98.154.226.195', 'Time Warner Cable Internet LLC', '98.144.0.0 - 98.157.255.255', 'RRWE'),
(152, '76.173.22.121', 'Time Warner Cable Internet LLC', '76.168.0.0 - 76.175.255.255', 'RRACI'),
(153, '173.46.252.253', 'Manifold Services Inc', '173.46.224.0 - 173.46.255.255', 'WAN-01-CC'),
(154, '69.4.125.64', 'Airstream Communications, LLC', '69.4.96.0 - 69.4.127.255', 'AS-BLK-3'),
(155, '69.4.125.64', 'Tri-County Communications Cooperative, INC.', '69.4.125.0 - 69.4.125.255', 'AIRSTREAM-TRICOUNTY-STRUM-BB-OCCAM-001'),
(156, '174.45.99.46', 'Charter Communications', '174.45.0.0 - 174.45.255.255', 'NET-CORE-BB-3'),
(157, '75.70.161.8', 'Comcast Cable Communications Holdings, Inc', '75.64.0.0 - 75.75.191.255', 'CCCH-3-34'),
(158, '75.70.161.8', 'Comcast Cable Communications Holdings, Inc', '75.70.0.0 - 75.71.255.255', 'COLORADO-23'),
(159, '70.16.89.22', 'Verizon Online LLC', '70.16.80.0 - 70.16.95.255', 'VIS-70-16'),
(160, '64.37.11.121', 'AWI Networks', '64.37.0.0 - 64.37.15.255', 'SKY-VIEW'),
(161, '97.122.113.239', 'Qwest Communications Company, LLC', '97.112.0.0 - 97.127.255.255', 'QWEST-INET-125'),
(162, '68.96.172.61', 'Cox Communications Inc.', '68.96.160.0 - 68.96.191.255', 'NETBLK-LV-RDC-68-96-160-0'),
(163, '68.96.172.61', 'Cox Communications Inc.', '68.96.0.0 - 68.111.255.255', 'COX-ATLANTA-2'),
(164, '24.210.229.51', 'Time Warner Cable Internet LLC', '24.208.0.0 - 24.211.255.255', 'RR-CENTRAL-3BLK'),
(165, '98.160.234.185', 'Cox Communications Inc.', '98.160.0.0 - 98.191.255.255', 'CXA'),
(166, '98.160.234.185', 'Cox Communications', '98.160.128.0 - 98.160.255.255', 'NETBLK-LV-RDC-98-160-128-0'),
(167, '71.23.64.196', 'CLEAR WIRELESS LLC', '71.20.0.0 - 71.23.255.255', 'CLEARWIRE-DNS-NET'),
(168, '108.200.77.120', 'AT&T Internet Services', '108.192.0.0 - 108.255.255.255', 'SBCIS-SBIS'),
(169, '68.184.152.202', 'Charter Communications', '68.184.0.0 - 68.191.255.255', 'CHARTER-NET-7BLK'),
(170, '68.184.152.202', 'Charter Communications', '68.184.128.0 - 68.184.159.255', 'SKBRG-GA-68-184-128'),
(171, '71.168.157.96', 'Verizon Online LLC', '71.168.128.0 - 71.169.127.255', 'VIS-BLOCK'),
(172, '73.54.139.81', 'Comcast IP Services, L.L.C.', '73.54.128.0 - 73.54.255.255', 'ATLANTA-CPE-23'),
(173, '73.54.139.81', 'Comcast IP Services, L.L.C.', '73.0.0.0 - 73.255.255.255', 'CABLE-1'),
(174, '75.142.220.158', 'Charter Communications', '75.142.192.0 - 75.142.223.255', 'RVR-CA-75-142-192'),
(175, '75.142.220.158', 'Charter Communications', '75.128.0.0 - 75.143.255.255', 'NETBLK-CHARTER-NET'),
(176, '173.80.10.238', 'Suddenlink Communications', '173.80.0.0 - 173.81.255.255', 'SUDDE'),
(177, '162.197.105.172', 'AT&T Internet Services', '162.192.0.0 - 162.207.255.255', 'SIS-80-8-3-13'),
(178, '98.243.213.195', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(179, '98.243.213.195', 'Comcast Cable Communications, Inc.', '98.243.0.0 - 98.243.255.255', 'MICHIGAN-37'),
(180, '71.163.232.114', 'Verizon Online LLC', '71.161.224.0 - 71.168.63.255', 'VIS-BLOCK'),
(181, '71.211.103.164', 'Qwest Communications Company, LLC', '71.208.0.0 - 71.223.255.255', 'QWEST-INET-118'),
(182, '24.159.99.170', 'Charter Communications', '24.159.96.0 - 24.159.111.255', 'GWIN-GA-24-159-96'),
(183, '24.159.99.170', 'Charter Communications', '24.159.0.0 - 24.159.255.255', 'CHARTER-NET'),
(184, '73.178.38.90', 'Comcast IP Services, L.L.C.', '73.178.0.0 - 73.178.255.255', 'NJ-CPE-3'),
(185, '73.178.38.90', 'Comcast IP Services, L.L.C.', '73.0.0.0 - 73.255.255.255', 'CABLE-1'),
(186, '50.243.16.198', 'Comcast Cable Communications Holdings, Inc', '50.128.0.0 - 50.255.255.255', 'CCCH3-4'),
(187, '50.243.16.198', 'Comcast Cable Communications Holdings, Inc', '50.243.16.0 - 50.243.31.255', 'CBC-ALBUQUERQUE-18'),
(188, '74.60.210.255', 'CLEAR WIRELESS LLC', '74.60.0.0 - 74.61.255.255', 'CLEARWIRE-DNS-NET'),
(189, '50.121.250.53', 'Frontier Communications of America, Inc.', '50.120.0.0 - 50.127.255.255', 'FRTR-LEGACY-FTR13'),
(190, '76.175.0.20', 'Time Warner Cable Internet LLC', '76.168.0.0 - 76.175.255.255', 'RRACI'),
(191, '74.108.141.137', 'Verizon Online LLC', '74.96.0.0 - 74.111.255.255', 'VIS-BLOCK'),
(192, '24.11.57.47', 'Comcast Cable Communications', '24.11.0.0 - 24.11.127.255', 'MICHIGAN-G-4'),
(193, '24.11.57.47', 'Comcast Cable Communications, Inc.', '24.0.0.0 - 24.15.255.255', 'EASTERNSHORE-1'),
(194, '99.52.189.177', 'AT&T Internet Services', '99.0.0.0 - 99.127.255.255', 'SBCIS-SBIS'),
(195, '50.150.164.169', 'Comcast Cable Communications Holdings, Inc', '50.150.128.0 - 50.150.255.255', 'MIAMI-31'),
(196, '50.150.164.169', 'Comcast Cable Communications Holdings, Inc', '50.128.0.0 - 50.255.255.255', 'CCCH3-4'),
(197, '73.49.188.251', 'Comcast IP Services, L.L.C.', '73.49.0.0 - 73.49.255.255', 'POMPANO-3'),
(198, '73.49.188.251', 'Comcast IP Services, L.L.C.', '73.0.0.0 - 73.255.255.255', 'CABLE-1'),
(199, '160.39.41.233', 'Columbia University', '160.39.0.0 - 160.39.255.255', 'CU-NET-160-39'),
(200, '23.115.34.222', 'AT&T Internet Services', '23.112.0.0 - 23.127.255.255', 'SIS-80-7-23-2013'),
(201, '66.162.182.188', 'f124d2fe-ca66-11db-ad69-0015c5e45005', '66.162.182.160/27', 'Schenectady-International--Inc--66-162-182-160'),
(202, '75.194.22.23', 'Cellco Partnership DBA Verizon Wireless', '75.192.0.0 - 75.255.255.255', 'WIRELESSDATANEWORK'),
(203, '108.39.233.124', 'Verizon Online LLC', '108.0.0.0 - 108.57.255.255', 'VIS-BLOCK'),
(204, '50.12.248.214', 'CLEAR WIRELESS LLC', '50.8.0.0 - 50.15.255.255', 'CLEARWIRE-DNS-NET'),
(205, '67.189.202.85', 'Comcast Cable Communications, Inc.', '67.189.128.0 - 67.189.255.255', 'BOSTON-9'),
(206, '67.189.202.85', 'Comcast Cable Communications, Inc.', '67.160.0.0 - 67.191.255.255', 'COMCAST'),
(207, '98.197.55.124', 'Comcast Cable Communications, Inc.', '98.196.0.0 - 98.199.255.255', 'HOUSTON-4'),
(208, '98.197.55.124', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(209, '67.189.202.85', 'Comcast Cable Communications, Inc.', '67.189.128.0 - 67.189.255.255', 'BOSTON-9'),
(210, '67.189.202.85', 'Comcast Cable Communications, Inc.', '67.160.0.0 - 67.191.255.255', 'COMCAST'),
(211, '216.38.34.26', 'Hector Communications Corp.', '216.38.32.0 - 216.38.47.255', 'HCCTEL-BLK-2'),
(212, '216.38.34.26', 'Indianhead Telephone Company', '216.38.34.0 - 216.38.34.127', 'IND-WEY-CALIX-DSL-01'),
(213, '66.65.106.121', 'Time Warner Cable Internet LLC', '66.65.0.0 - 66.65.255.255', 'RR-NYC-1BLK'),
(214, '173.79.21.43', 'Verizon Online LLC', '173.64.0.0 - 173.79.255.255', 'VIS-BLOCK'),
(215, '69.115.77.111', 'Optimum Online', '69.112.0.0 - 69.127.255.255', 'NETBLK-OOL-6BLK'),
(216, '69.115.77.111', 'Optimum Online (Cablevision Systems)', '69.115.64.0 - 69.115.79.255', 'OOL-CPE-SYRVNJ-69-115-64-0-20'),
(217, '98.243.9.86', 'Comcast Cable Communications, Inc.', '98.192.0.0 - 98.255.255.255', 'JUMPSTART-5'),
(218, '98.243.9.86', 'Comcast Cable Communications, Inc.', '98.243.0.0 - 98.243.255.255', 'MICHIGAN-37'),
(219, '173.60.93.113', 'Verizon Online LLC', '173.48.0.0 - 173.63.255.255', 'VIS-BLOCK'),
(220, '184.6.181.223', 'Embarq Corporation', '184.0.0.0 - 184.7.255.255', 'EMBARQ-GLOBAL'),
(221, '173.216.124.27', 'Suddenlink Communications', '173.216.0.0 - 173.219.255.255', 'SUDDE'),
(222, '63.138.247.2', 'PaeTec Communications, Inc.', '63.138.0.0 - 63.139.255.255', 'PAETECCOMM'),
(223, '63.138.247.2', 'SOUTHERN NEW HAMPSHIRE UNIVERSITY', '63.138.247.0 - 63.138.247.255', 'PAET-BO-SOUTH-1'),
(224, '50.105.248.178', 'Frontier Communications of America, Inc.', '50.102.0.0 - 50.111.255.255', 'FRONTIER-COMMUNICATIONS'),
(225, '50.162.77.73', 'Comcast Cable Communications Holdings, Inc', '50.162.0.0 - 50.162.127.255', 'HOUSTON-6'),
(226, '50.162.77.73', 'Comcast Cable Communications Holdings, Inc', '50.128.0.0 - 50.255.255.255', 'CCCH3-4');

-- --------------------------------------------------------

--
-- Table structure for table `user_exports`
--

CREATE TABLE IF NOT EXISTS `user_exports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `ips` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_exports`
--

INSERT INTO `user_exports` (`id`, `email`, `ips`, `status`) VALUES
(2, 'ndtuan89@gmail.com', '98.204.106.27\n76.99.165.8\n142.129.243.254\n71.146.74.8\n73.44.253.130\n98.86.119.216\n99.44.112.202\n69.114.103.19\n75.136.10.0\n76.114.134.124\n24.160.86.144\n72.199.187.191\n174.134.72.159\n67.233.171.21', 1),
(3, 'ndtuan89@gmail.com', '98.204.106.27\n76.99.165.8\n142.129.243.254\n71.146.74.8\n73.44.253.130\n98.86.119.216\n99.44.112.202\n69.114.103.19\n75.136.10.0\n76.114.134.124\n24.160.86.144\n72.199.187.191\n174.134.72.159\n67.233.171.21', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
