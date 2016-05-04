-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2016 at 08:36 PM
-- Server version: 5.6.26-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`) VALUES
(33, 'cvas22', 'cvas22@gmail.com', '9616c95e17211e04a129789ef3490f44f8265b46', '8018566430'),
(20, 'sumit', 'cvas22@gmail.com', 'c63da39ed13090239f702c236d56fdbe77e99b03', '8018566430'),
(19, 'gmail.com', 'cvas22@gmail.com', '416f8f6e105370e7b9d0fd983141f00b613477f8', '8018566430'),
(21, 'cvas22', 'cvas22@gmail.com', 'cbcb38a477928689a538fdb30e6401c6024d9c28', '8018566430'),
(30, 'srini', 'srini@gmail.com', 'ec07b3b274801afbac2df90e7e35f6c67d593c58', '8018566430'),
(31, 'anshul', 'anshul@anshul.com', 'd911b83e8b2006ca86a092000225a8f6e30c81ca', '8014531237'),
(32, 'testuser', 'testmail@mail.com', '45c571a156ddcef41351a713bcddee5ba7e95460', '1801213456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
