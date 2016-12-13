-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2015 at 12:55 PM
-- Server version: 5.5.25-log
-- PHP Version: 5.5.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `framework`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`ID`, `title`, `message`) VALUES
(1, 'Forgot Your Password', 'Dear [NAME],\r\n<br /><br />\r\nSomeone (hopefully you) requested a password reset at [SITE_URL].\r\n<br /><br />\r\nTo reset your password, please follow the following link: [EMAIL_LINK]\r\n<br /><br />\r\nIf you did not reset your password, please kindly ignore  this email.\r\n<br /><br />\r\nYours, <br />\r\n[SITE_NAME]');

-- --------------------------------------------------------

--
-- Table structure for table `home_stats`
--

CREATE TABLE IF NOT EXISTS `home_stats` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `google_members` int(11) NOT NULL,
  `facebook_members` int(11) NOT NULL,
  `twitter_members` int(11) NOT NULL,
  `total_members` int(11) NOT NULL,
  `new_members` int(11) NOT NULL,
  `active_today` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `home_stats`
--

INSERT INTO `home_stats` (`ID`, `google_members`, `facebook_members`, `twitter_members`, `total_members`, `new_members`, `active_today`, `timestamp`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ip_block`
--

CREATE TABLE IF NOT EXISTS `ip_block` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(500) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE IF NOT EXISTS `password_reset` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `IP` varchar(500) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reset_log`
--

CREATE TABLE IF NOT EXISTS `reset_log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(500) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(500) NOT NULL,
  `site_desc` varchar(500) NOT NULL,
  `upload_path` varchar(500) NOT NULL,
  `upload_path_relative` varchar(500) NOT NULL,
  `site_email` varchar(500) NOT NULL,
  `site_logo` varchar(1000) NOT NULL DEFAULT 'logo.png',
  `register` int(11) NOT NULL,
  `disable_captcha` int(11) NOT NULL,
  `date_format` varchar(25) NOT NULL,
  `avatar_upload` int(11) NOT NULL DEFAULT '1',
  `file_types` varchar(500) NOT NULL,
  `twitter_consumer_key` varchar(255) NOT NULL,
  `twitter_consumer_secret` varchar(255) NOT NULL,
  `disable_social_login` int(11) NOT NULL,
  `facebook_app_id` varchar(255) NOT NULL,
  `facebook_app_secret` varchar(255) NOT NULL,
  `google_client_id` varchar(255) NOT NULL,
  `google_client_secret` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`ID`, `site_name`, `site_desc`, `upload_path`, `upload_path_relative`, `site_email`, `site_logo`, `register`, `disable_captcha`, `date_format`, `avatar_upload`, `file_types`, `twitter_consumer_key`, `twitter_consumer_secret`, `disable_social_login`, `facebook_app_id`, `facebook_app_secret`, `google_client_id`, `google_client_secret`, `file_size`) VALUES
(1, 'ProLogin', 'Welcome to ProLogin', '/home/www/public_html/uploads', 'uploads', 'test@test.com', 'logo.png', 0, 0, 'd/m/Y', 1, 'gif|png|jpg|jpeg', '', '', 1, '', '', '', '', 1028);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `token` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_level` int(11) NOT NULL DEFAULT '0',
  `IP` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `username` varchar(25) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(1000) NOT NULL DEFAULT 'default.png',
  `joined` int(11) NOT NULL,
  `joined_date` varchar(10) NOT NULL,
  `online_timestamp` int(11) NOT NULL,
  `oauth_provider` varchar(40) NOT NULL,
  `oauth_id` varchar(1000) NOT NULL,
  `oauth_token` varchar(1500) NOT NULL,
  `oauth_secret` varchar(500) NOT NULL,
  `email_notification` int(11) NOT NULL DEFAULT '1',
  `aboutme` varchar(1000) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `default` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`ID`, `name`, `default`) VALUES
(1, 'Default Group', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_users`
--

CREATE TABLE IF NOT EXISTS `user_group_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
