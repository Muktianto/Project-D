-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2019 at 10:28 AM
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
-- Table structure for table `blg_menu`
--

CREATE TABLE IF NOT EXISTS `blg_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int(11) DEFAULT NULL,
  `menu_name` varchar(25) DEFAULT NULL,
  `is_main_menu` int(11) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blg_soc_med`
--

CREATE TABLE IF NOT EXISTS `blg_soc_med` (
  `soc_med_id` int(11) NOT NULL AUTO_INCREMENT,
  `soc_med_name` varchar(30) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `fa_icon` varchar(25) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`soc_med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blg_tag`
--

CREATE TABLE IF NOT EXISTS `blg_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(25) NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `blg_tag`
--

INSERT INTO `blg_tag` (`tag_id`, `tag_name`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Mobile', NULL, NULL, NULL, NULL),
(2, 'Life', NULL, NULL, NULL, NULL),
(3, 'Coding', NULL, NULL, NULL, NULL),
(4, 'Technology', NULL, NULL, NULL, NULL),
(5, 'Dota 2', NULL, NULL, NULL, NULL),
(6, 'Idle Heroes', NULL, NULL, NULL, NULL),
(7, 'Food', NULL, NULL, NULL, NULL),
(8, 'Science', NULL, NULL, NULL, NULL),
(9, 'Indonesia', NULL, NULL, NULL, NULL),
(10, 'Tutorial', NULL, NULL, NULL, NULL),
(11, 'CodeIgniter', NULL, NULL, NULL, NULL),
(12, 'Dota 2', NULL, NULL, NULL, NULL),
(13, 'Idle Heroes', NULL, NULL, NULL, NULL),
(14, 'Food', NULL, NULL, NULL, NULL),
(15, 'Science', NULL, NULL, NULL, NULL),
(16, 'Indonesia', NULL, NULL, NULL, NULL),
(17, 'Tutorial', NULL, NULL, NULL, NULL),
(18, 'CodeIgniter', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sso_access`
--

CREATE TABLE IF NOT EXISTS `sso_access` (
  `access_id` varchar(5) NOT NULL,
  `access_name` varchar(30) NOT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_action_log`
--

CREATE TABLE IF NOT EXISTS `sso_action_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `object_data` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `ip_address` int(11) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sso_application`
--

CREATE TABLE IF NOT EXISTS `sso_application` (
  `application_id` varchar(20) NOT NULL,
  `application_name` varchar(25) NOT NULL,
  `description` int(100) DEFAULT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_config`
--

CREATE TABLE IF NOT EXISTS `sso_config` (
  `config_id` varchar(30) NOT NULL,
  `config_value` text NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `crate_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_group`
--

CREATE TABLE IF NOT EXISTS `sso_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sso_group_access`
--

CREATE TABLE IF NOT EXISTS `sso_group_access` (
  `group_id` int(11) NOT NULL,
  `module_id` varchar(20) NOT NULL,
  `group_access` varchar(250) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`group_id`,`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_menu`
--

CREATE TABLE IF NOT EXISTS `sso_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_parent_id` int(11) DEFAULT NULL,
  `module_id` varchar(20) DEFAULT NULL,
  `menu_name` varchar(30) NOT NULL,
  `fa_icon` varchar(30) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_module`
--

CREATE TABLE IF NOT EXISTS `sso_module` (
  `module_id` varchar(20) NOT NULL,
  `application_id` varchar(20) NOT NULL,
  `module_name` varchar(30) NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`module_id`,`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_notification`
--

CREATE TABLE IF NOT EXISTS `sso_notification` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(50) DEFAULT NULL,
  `detail` varchar(150) DEFAULT NULL,
  `fa_icon` varchar(25) DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `status_read` int(11) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sso_user`
--

CREATE TABLE IF NOT EXISTS `sso_user` (
  `user_id` varchar(25) NOT NULL,
  `user_fullname` varchar(99) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `regis_date` date NOT NULL,
  `last_active` date NOT NULL,
  `image` varchar(30) NOT NULL,
  `status` varchar(5) NOT NULL,
  `is_user_login` int(11) DEFAULT NULL,
  `wrong_pass_count` int(11) DEFAULT NULL,
  `ip_address` varchar(35) DEFAULT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_user_application`
--

CREATE TABLE IF NOT EXISTS `sso_user_application` (
  `user_id` varchar(25) NOT NULL,
  `application_id` varchar(20) NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`,`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sso_user_group`
--

CREATE TABLE IF NOT EXISTS `sso_user_group` (
  `user_id` varchar(25) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  `create_by` varchar(25) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_by` varchar(25) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
