-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2019 at 11:45 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashiondemand`
--

-- --------------------------------------------------------

--
-- Table structure for table `dress`
--

DROP TABLE IF EXISTS `dress`;
CREATE TABLE IF NOT EXISTS `dress` (
  `dressId` int(11) NOT NULL AUTO_INCREMENT,
  `uploadOn` datetime NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `shopId` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`dressId`),
  KEY `shopId` (`shopId`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dress`
--

INSERT INTO `dress` (`dressId`, `uploadOn`, `file_name`, `type`, `gender`, `size`, `price`, `shopId`, `quantity`) VALUES
(181, '2019-08-06 21:33:53', '2.jpg', 'T-shirt', 'F', 'S', 1000, 55, 2),
(182, '2019-08-06 21:33:53', '3.jpg', 'T-shirt', 'F', 'M', 1200, 55, 3),
(183, '2019-08-06 21:33:53', '4.jpg', 'T-shirt', 'F', 'M', 1300, 55, 3),
(184, '2019-08-06 21:33:53', '5.jpg', 'T-shirt', 'F', 'XL', 500, 55, 6),
(185, '2019-08-06 21:33:53', '6.jpg', 'T-shirt', 'F', 'XXL', 600, 55, 5),
(186, '2019-08-06 21:33:53', '7.jpg', 'T-shirt', 'F', 'XXXL', 700, 55, 7),
(187, '2019-08-06 21:36:14', '16.jpg', 'T-shirt', 'M', 'S', 1500, 55, 11),
(188, '2019-08-06 21:36:14', '17.jpg', 'T-shirt', 'M', 'M', 1200, 55, 7),
(189, '2019-08-06 21:36:14', '18.jpg', 'T-shirt', 'M', 'L', 500, 55, 4),
(190, '2019-08-06 21:36:15', '19.jpg', 'T-shirt', 'M', 'XL', 770, 55, 10),
(191, '2019-08-06 21:36:15', '20.jpg', 'T-shirt', 'M', 'XXL', 1000, 55, 20),
(192, '2019-08-06 21:36:15', '21.jpg', 'T-shirt', 'M', 'XL', 800, 55, 5),
(193, '2019-08-06 21:36:15', '22.jpg', 'T-shirt', 'M', 'XXXL', 600, 55, 4),
(194, '2019-08-06 21:48:54', '9.jpg', 'Blouse', 'F', 'S', 1200, 53, 6),
(195, '2019-08-06 21:39:13', '10.jpg', 'Blouse', 'F', 'M', 1200, 53, 5),
(196, '2019-08-06 21:39:14', '11.jpg', 'Blouse', 'F', 'L', 500, 53, 4),
(197, '2019-08-06 21:39:14', '12.jpg', 'Blouse', 'F', 'XXL', 700, 53, 5),
(198, '2019-08-06 21:39:14', '13.jpg', 'Blouse', 'F', 'M', 1000, 53, 10),
(199, '2019-08-06 21:39:14', '14.jpg', 'Blouse', 'F', 'XL', 600, 53, 5),
(200, '2019-08-06 21:40:02', '26.jpg', 'T-shirt', 'M', 'S', 400, 53, 5),
(201, '2019-08-06 21:41:12', '27.jpg', 'T-shirt', 'M', 'M', 1000, 53, 5),
(202, '2019-08-06 21:41:12', '28.jpg', 'T-shirt', 'M', 'M', 1500, 53, 4),
(203, '2019-08-06 21:41:12', '29.jpg', 'T-shirt', 'M', 'XXL', 700, 53, 5),
(204, '2019-08-06 21:41:12', '30.jpg', 'T-shirt', 'M', 'XXXL', 1000, 53, 6);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `shopId` int(11) NOT NULL AUTO_INCREMENT,
  `registerOn` datetime NOT NULL,
  `shopName` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `ownerId` int(11) NOT NULL,
  PRIMARY KEY (`shopId`),
  KEY `ownerId` (`ownerId`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopId`, `registerOn`, `shopName`, `location`, `ownerId`) VALUES
(53, '2019-08-06 02:05:19', 'Kandy', 'Dehiwala', 98),
(55, '2019-08-06 21:16:21', 'Nolimit', 'Dehiwala', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registerOn` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `registerOn`, `email`, `firstName`, `lastName`, `password`, `address`) VALUES
(97, '2019-08-06 01:57:27', 'manojjayasinghe43@gmail.com', 'manoj', 'jaye', '0768281a05da9f27df178b5c39a51263', 'kalutara'),
(98, '2019-08-06 02:05:18', 'www.anuhasr@gmail.com', 'piyumi', 'roy', '0768281a05da9f27df178b5c39a51263', 'colombo'),
(100, '2019-08-06 21:16:21', 'abc@gmail.com', 'Anuhas', 'Perera', '0768281a05da9f27df178b5c39a51263', 'No06,galewele Rd, Pitipana');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dress`
--
ALTER TABLE `dress`
  ADD CONSTRAINT `dress_ibfk_1` FOREIGN KEY (`shopId`) REFERENCES `shops` (`shopId`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
