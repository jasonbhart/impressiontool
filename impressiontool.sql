-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2014 at 08:14 PM
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
(2, 'Comcast Cable Communications, Inc.', 0);

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
  `ip_block_owner` text NOT NULL,
  `ip_block_range` text NOT NULL,
  `ip_block_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `lookups`
--

INSERT INTO `lookups` (`id`, `ip`, `ip_block_owner`, `ip_block_range`, `ip_block_name`) VALUES
(1, '23.195.59.29', 'Akamai Technologies, Inc.', '23.192.0.0 - 23.223.255.255', 'AKAMAI'),
(2, '23.195.59.29', 'Akamai International, BV', '23.195.48.0 - 23.195.63.255', 'AIBV'),
(3, '15.58.39.52', 'Hewlett-Packard Company', '15.0.0.0 - 15.255.255.255', 'HP-INTERNET'),
(4, '76.102.19.35', 'Comcast Cable Communications, Inc.', '76.102.0.0 - 76.103.255.255', 'BAYAREA-CPE-23'),
(5, '76.102.19.35', 'Comcast Cable Communications, Inc.', '76.96.0.0 - 76.127.255.255', 'JUMPSTART-5'),
(6, '23.195.59.25', 'Akamai Technologies, Inc.', '23.192.0.0 - 23.223.255.255', 'AKAMAI'),
(7, '23.195.59.25', 'Akamai International, BV', '23.195.48.0 - 23.195.63.255', 'AIBV'),
(8, '12.23.56.77', 'AT&T Services, Inc.', '12.0.0.0 - 12.255.255.255', 'ATT'),
(9, '12.23.56.77', 'SIX CONTINENTS HOTELS', '12.23.56.64 - 12.23.56.95', 'SIX-CONT12-56-64'),
(10, '29.59.39.19', 'DoD Network Information Center', '29.0.0.0 - 29.255.255.255', 'DNIC-RNET-029-000'),
(11, '12.5.5.19', 'AT&T Services, Inc.', '12.0.0.0 - 12.255.255.255', 'ATT'),
(12, '25.192.192.28', 'DINSA, Ministry of Defence', '25.0.0.0 - 25.255.255.255', 'UK-MOD-19850128');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
