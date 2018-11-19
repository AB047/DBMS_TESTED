-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2018 at 02:32 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin12', '$2y$10$VZzIZJGI8jzyoO5A.xIeuOD2jdKPFzuzueckn.cnvuwMdyCzr27QW');

-- --------------------------------------------------------

--
-- Table structure for table `policerecord`
--

DROP TABLE IF EXISTS `policerecord`;
CREATE TABLE IF NOT EXISTS `policerecord` (
  `booked` varchar(250) NOT NULL,
  `place` varchar(250) NOT NULL,
  `fine` varchar(250) NOT NULL,
  `offence` varchar(250) NOT NULL,
  `policestation` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
CREATE TABLE IF NOT EXISTS `station` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`username`, `password`, `name`, `designation`) VALUES
('station', '$2y$10$F90VGO/zwzjjkNrFTRrHH.KH9tvKFPzr4MTxR9Q3i/R/RYwOsI2xi', 'cop', 'police'),
('yui', '$2y$10$ogLTIC73K4Kw6fD7iNGsMOImk41mcQKb7EXv6jYfelZxx8Cep8fSW', 'yui', 'police'),
('atul', '$2y$10$fXPYY0INScRjG430w/Ih1.dQOfc9iZ.X4O5M/P4nJqWyxuDiRrPxm', 'atul', 'police'),
('atul', '$2y$10$7bKuoso9IZoJtks4RcuSMO792zhq8Ns8SC5hnY7bH814TFz/PE2Q.', 'atul', 'police'),
('atul', '$2y$10$Z3Q.M7wAPBpzWzpTXZ3K0eCdKXx5Ho0DjAEuuS8qI8Q8HPfiw0/aa', 'atul', 'police');

-- --------------------------------------------------------

--
-- Table structure for table `useroffence`
--

DROP TABLE IF EXISTS `useroffence`;
CREATE TABLE IF NOT EXISTS `useroffence` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `offence` varchar(250) NOT NULL,
  `paid` int(10) NOT NULL,
  `vehicleno` varchar(250) NOT NULL,
  `place` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useroffence`
--

INSERT INTO `useroffence` (`id`, `offence`, `paid`, `vehicleno`, `place`) VALUES
(6, 'fghjh', 900, '9128', 'rr nagar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `designation` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `designation`, `name`) VALUES
(1, 'test', '$2y$10$KPqe9AsPV8KlMHsfev98quYqVqJU3yjk.XbqLqhjJqDHt6KWvpS7W', '2018-11-18 20:50:00', 'admin', 'admin'),
(2, '5678', '$2y$10$/LZiHjsAO541gyRecJAMPOGN/.O2pQ4p64/ziQBR7f1U.QZ2ZceaS', '2018-11-18 22:43:57', 'admin', 'admin'),
(3, 'abbas', '$2y$10$a3/ODIsj2f25x1WyXV9vs.7qDpIb/nkjMD1sgY4g8rHzp9X9BAgBG', '2018-11-19 01:57:47', 'police', 'abbas'),
(17, 'atul', '$2y$10$63IGLV6gmoOK7IjkaEZdYeZRA7P28c8UzABWnaFCH0xptg0J10ZGS', '2018-11-19 10:40:02', 'police', 'atul');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
