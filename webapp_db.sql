-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 09:38 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `ID` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `Duration` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`ID`, `email`, `username`, `password`, `start_date`, `end_date`, `Duration`) VALUES
(2, 'info@connectsoft.com', 'Krhitah', 'wwww', '2018-11-23', '2018-12-30', '1 Month(s), 37 Day(s)'),
(7, 'info@connectsoftz.com', 'GMT_Developers', 'Eric', '2018-08-21', '2018-09-23', '33 Day(s), 1 Month(s)'),
(8, 'info@connectsoftz.com', 'Krhitah', 'Eric1233', '2018-07-23', '2018-08-25', '33 Day(s),aprox. 1 Month(s)'),
(9, 'erickasakya@yahoo.com', 'Krhitah', 'rtytuyio', '2018-07-24', '2018-08-25', '32 Day(s), aprox. 1 Month(s)'),
(11, 'martin@yahoo.com', 'maiso', 'Mar12%', '2018-12-23', '2018-12-31', '8 Day(s), aprox. 0 Month(s)'),
(12, 'bosco@gmtconsults.com', 'Johnbosco', 'Mukuba122', '2018-08-23', '2018-09-24', '32 Day(s), aprox. 1 Month(s)'),
(13, 'sajjaandrew@gmail.com', 'Andrew', 'sajja11234', '2018-07-23', '2018-09-28', '67 Day(s), aprox. 2 Month(s)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
