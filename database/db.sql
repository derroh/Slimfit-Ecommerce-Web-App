-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2017 at 02:57 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slimfitshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`Id`, `Name`) VALUES
(1, 'Nike'),
(2, 'Dolce and Gabbana'),
(3, 'GUcci'),
(5, 'Nike'),
(6, 'Dolce and Gabbana'),
(7, 'GUcci'),
(9, 'mamen'),
(10, 'My isht'),
(11, 'Nike'),
(12, 'Nike Sports'),
(13, 'My isht'),
(14, 'Pantiesu'),
(15, 'ii'),
(16, 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Name`) VALUES
(1, 'Slimfit Suits'),
(2, 'Slimfit shirts'),
(3, 'Slimfit Trousers'),
(4, 'Slimfit Dress'),
(5, 'Ladies Tops'),
(6, 'Shoes'),
(7, 'Ankara Clothes');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

DROP TABLE IF EXISTS `customer_orders`;
CREATE TABLE IF NOT EXISTS `customer_orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CartId` text NOT NULL,
  `ItemId` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Image` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `DatePlaced` date NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Destination` text NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`Id`, `CartId`, `ItemId`, `Name`, `Image`, `Price`, `Quantity`, `Total`, `DatePlaced`, `CustomerId`, `Destination`, `Status`) VALUES
(1, '2017070517191', 19, 'Cuffling Shirt', 'assets/uploads/769518.jpg', 450, 4, 1800, '2017-07-05', 1, '1', 1),
(2, '2017070517201', 20, 'Polo Neck T-Shirt', 'assets/uploads/156575.jpg', 250, 2, 500, '2017-07-05', 1, '2', 1),
(3, '2017070517221', 19, 'Cuffling Shirt', 'assets/uploads/769518.jpg', 450, 1, 450, '2017-07-05', 1, '2', 3),
(4, '2017070517281', 20, 'Polo Neck T-Shirt', 'assets/uploads/156575.jpg', 250, 1, 250, '2017-07-05', 1, '3', 2),
(5, '2017070517311', 20, 'Polo Neck T-Shirt', 'assets/uploads/156575.jpg', 250, 1, 250, '2017-07-05', 1, '2', 3),
(6, '2017070517311', 19, 'Cuffling Shirt', 'assets/uploads/769518.jpg', 450, 1, 450, '2017-07-05', 1, '2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `deliverycarts`
--

DROP TABLE IF EXISTS `deliverycarts`;
CREATE TABLE IF NOT EXISTS `deliverycarts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CartId` text NOT NULL,
  `DeliveryCost` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliverycarts`
--

INSERT INTO `deliverycarts` (`Id`, `CartId`, `DeliveryCost`) VALUES
(1, '2017070517191', 400),
(2, '2017070517201', 200),
(3, '2017070517221', 200),
(4, '2017070517281', 150),
(5, '2017070517311', 200),
(6, '2017070517311', 200);

-- --------------------------------------------------------

--
-- Table structure for table `deliverypoints`
--

DROP TABLE IF EXISTS `deliverypoints`;
CREATE TABLE IF NOT EXISTS `deliverypoints` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Amount` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliverypoints`
--

INSERT INTO `deliverypoints` (`Id`, `Name`, `Amount`) VALUES
(1, 'Nairobi', 400),
(2, '', 200),
(3, '', 150),
(4, 'Kitale', 450);

-- --------------------------------------------------------

--
-- Table structure for table `profilemaster`
--

DROP TABLE IF EXISTS `profilemaster`;
CREATE TABLE IF NOT EXISTS `profilemaster` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `PhoneNumber` varchar(200) NOT NULL,
  `IdNumber` int(11) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Role` varchar(200) NOT NULL,
  `Status` varchar(200) NOT NULL,
  `tokenCode` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilemaster`
--

INSERT INTO `profilemaster` (`Id`, `Name`, `Email`, `PhoneNumber`, `IdNumber`, `Password`, `Role`, `Status`, `tokenCode`) VALUES
(1, 'Abucheri Derrick', 'derrickwitness@gmail.com', '(254) 070-196463', 0, '$2y$10$rsSX6LnhI1tojLPEvyyVI.9hWErWxUXwkqyfrL/DMNTSJQyT2mtve', '1', 'Y', 'cc99fcd05b753beda3d123d255ac59d4'),
(25, 'Sarah Cheminingwa', 'cheminingwa@gmail.com', '(254) 711-755788', 0, '$2y$10$rsSX6LnhI1tojLPEvyyVI.9hWErWxUXwkqyfrL/DMNTSJQyT2mtve', '2', 'Y', 'c29f1997098ad28d20c5021375175660'),
(26, 'William Odianga', 'william@gmail.com', '(254) 711-755788', 0, '$2y$10$rsSX6LnhI1tojLPEvyyVI.9hWErWxUXwkqyfrL/DMNTSJQyT2mtve', '3', 'Y', 'f5b156fa63b20bc1f689dd5db109f370'),
(29, 'Attache Profile', 'Attache@gmail.com', '(254) 711-755788', 0, '$2y$10$rsSX6LnhI1tojLPEvyyVI.9hWErWxUXwkqyfrL/DMNTSJQyT2mtve', '5', 'Y', 'f5b156fa63b20bc1f689dd5db109f370');

-- --------------------------------------------------------

--
-- Table structure for table `shop_items`
--

DROP TABLE IF EXISTS `shop_items`;
CREATE TABLE IF NOT EXISTS `shop_items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Category` int(11) NOT NULL,
  `Brand` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Image` text NOT NULL,
  `Colour` text NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SetAsNew` int(11) NOT NULL,
  `FeaturedItem` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`Id`, `Category`, `Brand`, `Name`, `Image`, `Colour`, `Description`, `Price`, `Quantity`, `SetAsNew`, `FeaturedItem`) VALUES
(20, 2, 1, 'Polo Neck T-Shirt', '156575.jpg', 'Blue', 'Cotton Wear', 250, 7, 2, 2),
(19, 1, 2, 'Cuffling Shirt', '769518.jpg', 'White', 'This is a cuffing shirt', 450, 7, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
