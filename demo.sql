-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 12:17 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `before_offence` (IN `username` VARCHAR(50), IN `licno` VARCHAR(50), IN `vhno` VARCHAR(50))  MODIFIES SQL DATA
IF ((SELECT COUNT(*) FROM users WHERE name = username) = 0) THEN
	INSERT INTO users(name,vehicleno,licenseno) VALUES (username,vhno,licno) ;
END IF$$

DELIMITER ;

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
('admin12', '$2y$10$VZzIZJGI8jzyoO5A.xIeuOD2jdKPFzuzueckn.cnvuwMdyCzr27QW', '', '0000-00-00'),
('joe', '$2y$10$REsb4pxNFSwBm1o/F4a62uvzP06vztWPK68YVdZpBpAJVSAFuW1lW', '', '0000-00-00'),
('atul', '$2y$10$1oW/.aW.JjKdX96.lCEPQOq0HMQHMecqu/SFlJZ6Pd1AhU5mmOlza', '', '0000-00-00'),
('passwordispassword', '$2y$10$FW5mu8icZXsOdbc8FfPCE.c87BfVNz2d5naCB8wX.QP7Nx16kn3s.', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `policerecord`
--

CREATE TABLE `policerecord` (
  `PSID` varchar(250) NOT NULL,
  `OfficialUsername` varchar(20) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `CopName` varchar(50) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `EmailID` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policerecord`
--

INSERT INTO `policerecord` (`PSID`, `OfficialUsername`, `Password`, `CopName`, `Designation`, `PhoneNo`, `Address`, `EmailID`) VALUES
('2', 'cop', '$2y$10$1FiCjN/bDgb.lOO8HcdECuXljdMJCjebR.XV0lOYd5wPUO3/l6hMe', 'XYZ', 'police', '97827541', 'Ullal Main Road', 'abcd@gmail.com'),
('1', 'police', '$2y$10$HjTtA2.IycomH5hYzC5Q8eaplcuSVWJkKm9scCVLNpTSvxKI1lHla', 'Sachin', 'police', '555555', 'Bangalore', 'lkmn@gmail.com'),
('3', 'efgh', '$2y$10$r5JBCksbXOn8vaRkyPvnke5N6pBBoJYciYhMHqZM/gGccehMYDmCm', 'efgh', 'police', '555555', 'Bangalore', 'deekshaarun1523@gmai'),
('3', 'passwordispassword', '$2y$10$B/.mKTsQwm2PeuH6hDkkl.2tYP0NvYkizld9tTwhFaTUsWbRr6c9i', 'password', 'police', '987654', 'Bangalore', 'allenabraham505@gmai');

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

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`PSName`, `PSID`, `PSAddress`, `PSPhoneNo`) VALUES
('Kengeri PS', 1, 'Kengeri', 988877665),
('Jnanabharati PS', 2, 'Ullal', 99998877),
('RR PS', 3, 'RRNagar', 88899976),
('Jayanagar PS', 4, 'Jayanagar', 77788898);

-- --------------------------------------------------------

--
-- Table structure for table `useroffence`
--

CREATE TABLE `useroffence` (
  `Offence` varchar(30) NOT NULL,
  `Fine` int(50) NOT NULL,
  `VehicleNo` varchar(16) NOT NULL,
  `Place` varchar(30) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OfficialUsername` varchar(30) NOT NULL,
  `LicenseNo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useroffence`
--

INSERT INTO `useroffence` (`Offence`, `Fine`, `VehicleNo`, `Place`, `DateTime`, `OfficialUsername`, `LicenseNo`) VALUES
('No helmet', 2000, '1918', 'Kengeri', '2019-11-14 00:03:20', 'police', '414'),
('Drunk driving', 2000, '9999', 'Jnanabharati', '2019-11-14 00:28:30', 'cop', '8987'),
('Extra pillion', 3000, '1915', 'Jayanagar', '2019-11-14 00:29:24', 'police', '777'),
('No helmet', 1000, '1915', 'Jayanagar', '2019-11-14 00:29:55', 'cop', '777'),
('No seetbelt', 500, '1915', 'Jayanagar', '2019-11-14 00:30:52', 'cop', '777'),
('No helmet', 1212, '6666', 'Jnanabharati', '2019-11-14 10:04:59', 'police', '6666'),
('Drunk', 1500, '7777', 'Jayanagar', '2019-11-14 10:33:58', 'police', '7777'),
('Exceeding permissable weight', 1000, '6543', 'Kengeri', '2019-11-14 10:44:53', 'police', '6543');

--
-- Triggers `useroffence`
--
DELIMITER $$
CREATE TRIGGER `trig1` BEFORE INSERT ON `useroffence` FOR EACH ROW CALL before_offence('',new.vehicleno,new.licenseno)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `phno` int(50) NOT NULL,
  `vehicleno` varchar(16) NOT NULL,
  `licenseno` varchar(30) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `phno`, `vehicleno`, `licenseno`, `emailid`, `password`) VALUES
('Vineela', 99988765, '1918', '414', 'bhoomavineela@gmail.com', '$2y$10$9Nt6fYxU8gCNr671iGpT2uy7Fi40mwS9dPO6YBNR2UotepmRM7gdK'),
('Atul', 98765, '1915', '777', 'atulmb99@gmail.com', '$2y$10$/x973HA/0hYEqBPVW2kw/e5edI8f.pxZ4IiHIXeF20jK18RcivmZe'),
('Abbas', 6665432, '9999', '8987', 'abbask.51tr@gmail.com', '$2y$10$5TUKFOPpv18HK7LoSGPq8O28ZiBGg8votuJ5QrOY6ooKxQaRxz9oy'),
('Deeksha', 675432, '6543', '6543', 'deekshaarun1523@gmail.com', '$2y$10$n0tGyQ8An8TsVg0MN3Fx.OxRPt6NpJwhBqjdd/Q4fXFPwr589UX1G');

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
-- Indexes for table `useroffence`
--
ALTER TABLE `useroffence`
  ADD KEY `VehicleNo` (`VehicleNo`,`LicenseNo`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`licenseno`,`vehicleno`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
