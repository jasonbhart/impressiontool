-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2014 at 02:25 PM
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
(1, 'BAYAREA-CPE-23', 1),
(2, 'JUMPSTART-5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_owner`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_owner` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `list_ip_block_owner`
--

INSERT INTO `list_ip_block_owner` (`id`, `ip_block_owner`, `status`) VALUES
(2, 'Comcast Cable Communications, Inc.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_ip_block_range`
--

CREATE TABLE IF NOT EXISTS `list_ip_block_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_block_range` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE IF NOT EXISTS `lookups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `ip_block_name` text NOT NULL,
  `ip_block_range` text NOT NULL,
  `ip_block_owner` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
