-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 28, 2017 at 01:17 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `Discounts`
--

CREATE TABLE IF NOT EXISTS `Discounts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Product_id` int(11) NOT NULL,
  `Minimum_items` int(11) NOT NULL,
  `Discount_percentage` int(11) NOT NULL,
  `Created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Discounts`
--

INSERT INTO `Discounts` (`Id`, `Product_id`, `Minimum_items`, `Discount_percentage`, `Created_date`) VALUES
(1, 2, 3, 20, '2017-06-25 12:29:38'),
(2, 2, 5, 30, '2017-06-26 05:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE IF NOT EXISTS `Orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Price` float DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` float DEFAULT NULL,
  `Is_cancel` tinyint(1) NOT NULL DEFAULT '0',
  `Created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `Product_id` (`Product_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`Id`, `User_id`, `Product_id`, `Price`, `Quantity`, `Total`, `Is_cancel`, `Created_date`) VALUES
(2, 1, 4, NULL, 5, NULL, 1, '2017-06-22 18:11:59'),
(3, 5, 5, 2.1, 2, 4.2, 1, '2017-06-19 18:28:32'),
(4, 2, 3, NULL, 8, NULL, 1, '2017-06-17 18:36:13'),
(5, 2, 3, 1.4, 8, 11.2, 0, '2017-06-21 18:38:28'),
(6, 2, 3, 1.4, 8, 11.2, 0, '2017-06-05 18:40:40'),
(7, 2, 3, NULL, 8, NULL, 1, '2017-06-05 18:40:53'),
(8, 2, 3, 1.4, 8, 11.2, 0, '2017-06-08 18:41:31'),
(9, 2, 3, NULL, 8, NULL, 1, '2017-06-16 18:45:41'),
(10, 1, 2, 1.6, 4, 5.12, 0, '2017-06-11 05:33:36'),
(11, 1, 2, 1.6, 7, 7.84, 0, '2017-06-01 05:35:23'),
(12, 1, 2, 1.6, 3, 3.84, 0, '2017-06-02 05:37:41'),
(13, 3, 2, 1.6, 7, 7.84, 0, '2017-06-27 05:47:53'),
(14, 1, 1, 1.8, 9, 16.2, 0, '2017-06-27 09:51:57'),
(15, 3, 2, 1.6, 7, 7.84, 0, '2017-06-19 10:17:19'),
(16, 3, 2, 1.6, 7, 7.84, 0, '2017-06-26 10:24:31'),
(17, 3, 2, 1.6, 7, 7.84, 1, '2017-06-26 10:25:01'),
(18, 5, 2, 1.6, 2, 3.2, 1, '2017-06-26 12:14:03'),
(19, 4, 5, 2.1, 2, 4.2, 0, '2017-06-26 19:47:51'),
(20, 4, 1, 1.8, 2, 3.6, 0, '2017-06-27 18:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Product` varchar(225) NOT NULL,
  `Price` float NOT NULL,
  `Created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`Id`, `Product`, `Price`, `Created_date`) VALUES
(1, 'Coca cola', 1.8, '2017-06-25 12:03:27'),
(2, 'Pepsi cola', 1.6, '2017-06-25 12:03:27'),
(3, 'Fanta', 1.4, '2017-06-25 12:03:27'),
(4, '7Up', 2, '2017-06-25 12:03:27'),
(5, 'Red bull', 2.1, '2017-06-25 12:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(225) NOT NULL,
  `Last_name` varchar(225) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Id`, `First_name`, `Last_name`, `Email`, `Created_date`) VALUES
(1, 'Jhon', 'Smith', 'jhon@gmail.com', '2017-06-25 12:13:18'),
(2, 'Laura', 'Stone', 's.laura@gmail.com', '2017-06-25 12:13:18'),
(3, 'Jon', 'Oliver', 'j.oliver@gmail.com', '2017-06-25 12:13:18'),
(4, 'Aleksandra', 'klentsistseva', 'aleksandra@adcash.com', '2017-06-25 12:13:18'),
(5, 'Keshav', 'Sharma', 'k.sharma@adcash.com', '2017-06-25 12:13:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `Products` (`Id`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `Users` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
