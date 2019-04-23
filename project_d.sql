-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2019 at 09:50 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_d`
--

-- --------------------------------------------------------

--
-- Table structure for table `blg_tag`
--

CREATE TABLE IF NOT EXISTS `blg_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(25) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `blg_tag`
--

INSERT INTO `blg_tag` (`tag_id`, `tag_name`) VALUES
(1, 'Mobile'),
(2, 'Life'),
(3, 'Coding'),
(4, 'Technology'),
(5, 'Dota 2'),
(6, 'Idle Heroes'),
(7, 'Food'),
(8, 'Science'),
(9, 'Indonesia'),
(10, 'Tutorial'),
(11, 'CodeIgniter'),
(12, 'Dota 2'),
(13, 'Idle Heroes'),
(14, 'Food'),
(15, 'Science'),
(16, 'Indonesia'),
(17, 'Tutorial'),
(18, 'CodeIgniter');

-- --------------------------------------------------------

--
-- Table structure for table `sso_application`
--

CREATE TABLE IF NOT EXISTS `sso_application` (
  `application_id` varchar(20) NOT NULL,
  `application_name` varchar(25) NOT NULL,
  `description` int(100) NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_goup_module`
--

CREATE TABLE IF NOT EXISTS `sso_goup_module` (
  `group_id` varchar(10) NOT NULL,
  `module_id` varchar(20) NOT NULL,
  PRIMARY KEY (`group_id`,`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_group`
--

CREATE TABLE IF NOT EXISTS `sso_group` (
  `group_id` varchar(10) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `description` int(150) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_module`
--

CREATE TABLE IF NOT EXISTS `sso_module` (
  `module_id` varchar(20) NOT NULL,
  `module_name` varchar(25) NOT NULL,
  `parent_module` varchar(20) NOT NULL,
  `application_id` varchar(20) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `controller` varchar(50) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_user`
--

CREATE TABLE IF NOT EXISTS `sso_user` (
  `username` varchar(25) NOT NULL,
  `user_fullname` varchar(99) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `regis_date` date NOT NULL,
  `last_active` date NOT NULL,
  `image` varchar(30) NOT NULL,
  `status` varchar(3) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_user_group`
--

CREATE TABLE IF NOT EXISTS `sso_user_group` (
  `username` varchar(25) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  PRIMARY KEY (`username`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
