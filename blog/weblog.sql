-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2013 at 07:44 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `weblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `passwd`) VALUES
(1, 'admin', 'admin'),
(2, 'test', 'test'),
(9, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cmnt_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `cmnt_date` date DEFAULT NULL,
  `msg` varchar(200) DEFAULT NULL,
  `entry_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cmnt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmnt_id`, `name`, `email`, `cmnt_date`, `msg`, `entry_id`, `timestamp`) VALUES
(1, 'Test', 'test@test', '0000-00-00', 'This is test comment.', 1, '0000-00-00 00:00:00'),
(2, 'Test', 'test@test', '0000-00-00', 'This is test comment.', 1, '2013-02-25 07:25:29'),
(3, 'Test', 'test@test', '0000-00-00', 'This is test comment.', 1, '2013-02-25 07:27:33'),
(4, 'Test', 'test@test.com', '2013-02-25', 'THis is test', 1, '2013-02-25 07:30:22'),
(5, 'LOL', 'LOL@LOL', '2013-02-25', 'LOL.\r\nIt''s working fine.', 5, '2013-02-25 07:47:03'),
(6, 'comment', 'comment@pop', '2013-02-25', 'comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment ', 1, '2013-02-25 15:14:46'),
(7, 'qwerty', 'qwerty@qw', '2013-03-01', 'hooray!!!!!\r\nit''s working', 19, '2013-03-01 07:12:08'),
(8, 'yoho', 'yoho@yoho', '2013-03-01', 'yoho yoho\r\nkam kar raha hai :)', 19, '2013-03-01 07:19:38'),
(9, 'comment!!!!', 'yup@oiu', '2013-03-02', 'commentsssssssssssssss', 19, '2013-03-02 16:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_posted` date DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `entry` text,
  `cat_id` tinyint(4) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`entry_id`, `date_posted`, `title`, `entry`, `cat_id`, `timestamp`) VALUES
(1, '2013-03-02', 'Test Entry', 'Hello world!!<br /> This is an test entry to test web application.', 1, NULL),
(4, '2013-03-02', 'Test', 'yet another test.\\n\r\nhnaaaaa :/', 1, 1359884470),
(5, '2013-11-02', 'Test', 'sjkkkkkkkkkkkkkkkkkkz;/xc', NULL, 1360568251),
(6, '2013-11-02', 'asdfzssssssssss', 'asdfzssssssssss', NULL, 1360568266),
(7, '2013-11-02', 'CXxzddzszas', 'asdfdgfhjhf', NULL, 1360568273),
(9, '2013-11-02', 'dszvgVDVS', 'RaFZrjh\r\nJg\r\n/', NULL, 1360569987),
(10, '2013-11-02', '&lt;?php phpinfo() ?&gt;', '&lt;?php phpinfo() ?&gt;', NULL, 1360570007),
(11, '2013-11-02', 'sca', 'saa', NULL, 1360570012),
(17, '0000-00-00', 'OLA', 'ALO', NULL, 1360736269),
(18, '2013-02-13', 'Edit', 'This post has been edited successfully. :)', NULL, 1360736321),
(19, '2013-02-13', 'Hooray!!!!', 'lol,It''s working fine hooray!!!!!  ;)', NULL, 1360736835),
(20, '2013-03-02', 'qwertyui', 'edited', NULL, 1362242699);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `size` decimal(10,0) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `name`, `size`, `type`) VALUES
(7, 'lol.jpg', 441399, 'image/jpeg'),
(11, '5cm.jpg', 201720, 'image/jpeg'),
(12, 'avatar_1181919.jpg', 5202, 'image/jpeg'),
(13, 'Desert.jpg', 845941, 'image/jpeg'),
(14, 'Koala.jpg', 780831, 'image/jpeg'),
(15, 'enma_ai_1.png', 329630, 'image/png'),
(16, 'lol.jpg', 441399, 'image/jpeg'),
(17, 'lol.jpg', 441399, 'image/jpeg'),
(18, 'anime_girl_212-wide.jpg', 795882, 'image/jpeg'),
(19, 'love-anime-anime-24597221-1280-1024.jpg', 317136, 'image/jpeg'),
(20, 'anime_girls_30-normal.jpg', 441762, 'image/jpeg'),
(21, 'Capture.JPG', 16550, 'image/jpeg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
