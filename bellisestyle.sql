-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2018 at 08:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bellisestyle`
--
CREATE DATABASE IF NOT EXISTS `bellisestyle` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bellisestyle`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

INSERT INTO `categories` (`name`, `createdAt`) VALUES ('Sans Categorie', NOW());
-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `in_process`
--

CREATE TABLE IF NOT EXISTS `in_process` (
  `productID` varchar(5) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `ID` varchar(6) NOT NULL,
  `createdAt` date NOT NULL,
  `customerID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `livreurID` int(11) NOT NULL,
  `state` enum('0','1') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `paid` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ID` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` int(3) NOT NULL,
  `price` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_alt`
--

CREATE TABLE IF NOT EXISTS `product_alt` (
  `productID` varchar(5) NOT NULL,
  `altID` varchar(5) NOT NULL,
  `qty` double NOT NULL,
  PRIMARY KEY (`productID`,`altID`,`qty`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_ordered`
--

CREATE TABLE IF NOT EXISTS `product_ordered` (
  `productID` varchar(5) NOT NULL,
  `orderID` varchar(6) NOT NULL,
  `colorID` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `paid` int(11) NOT NULL,
  PRIMARY KEY (`productID`,`orderID`,`colorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quantity`
--

CREATE TABLE IF NOT EXISTS `quantity` (
  `productID` varchar(5) NOT NULL,
  `colorID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`productID`,`colorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `init` varchar(10) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `facebookID` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sex` enum('H','F') DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `usertype` int(1) NOT NULL,
  `createdAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `usertype` (`type`) VALUES('Administrateur');
INSERT INTO `usertype` (`type`) VALUES('Caissiere');
INSERT INTO `usertype` (`type`) VALUES('Livreur');
INSERT INTO `usertype` (`type`) VALUES('Client');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_ordered`
--
ALTER TABLE `product_ordered`
  ADD CONSTRAINT `product_ordered_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
