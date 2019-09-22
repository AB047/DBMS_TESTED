-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2019 at 01:06 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

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

CREATE TABLE `admin` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `OfficialAdded` varchar(20) NOT NULL,
  `DateTimeAdded` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `OfficialAdded`, `DateTimeAdded`) VALUES
('admin12', '$2y$10$VZzIZJGI8jzyoO5A.xIeuOD2jdKPFzuzueckn.cnvuwMdyCzr27QW', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `policerecord`
--

CREATE TABLE `policerecord` (
  `PSID` varchar(250) NOT NULL,
  `OfficialUsername` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `CopName` varchar(50) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `EmailID` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `PSName` varchar(20) NOT NULL,
  `PSID` int(11) NOT NULL,
  `PSAddress` varchar(50) NOT NULL,
  `PSPhoneNo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useroffence`
--

CREATE TABLE `useroffence` (
  `Offence` varchar(250) NOT NULL,
  `Fine` int(10) NOT NULL,
  `VehicleNo` varchar(250) NOT NULL,
  `Place` varchar(250) NOT NULL,
  `DateTime` date NOT NULL,
  `OfficialUsername` varchar(20) NOT NULL,
  `LicenseNo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(30) DEFAULT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `VehicleNo` int(11) NOT NULL,
  `LicenseNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `policerecord`
--
ALTER TABLE `policerecord`
  ADD PRIMARY KEY (`OfficialUsername`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`PSID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`VehicleNo`,`LicenseNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
