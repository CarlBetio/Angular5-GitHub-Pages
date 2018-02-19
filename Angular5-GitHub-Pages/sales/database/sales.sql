-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2018 at 10:31 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `prod_name` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `code`, `prod_name`, `description`, `supplier`, `price`) VALUES
(7, '1001', 'Mouse', 'Nice Mouse', 'UNOR', '600'),
(8, '1002', 'Laptop', 'Nic Laptop', 'UNOR', '20000'),
(9, '1003', 'Shoes', 'Cool Shoes', 'UNOR', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `method` varchar(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `prod_name`, `price`, `quantity`, `method`, `user_id`, `status`) VALUES
(4, 'Laptop', 20000.00, 3, '', 5, 'Pending'),
(6, 'Mouse', 600.00, 5, '', 5, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `address`, `contactno`) VALUES
(3, 'UNOR', 'Bacolod City', '4332449'),
(4, 'Proctor and Gamble', 'Bacolod City', '4332449'),
(5, 'Uniliver', 'Bacolod City', '4342324');

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE IF NOT EXISTS `temp_trans` (
  `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`temp_trans_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `temp_trans`
--

INSERT INTO `temp_trans` (`temp_trans_id`, `prod_name`, `price`, `quantity`, `user_id`, `status`) VALUES
(27, 'Bag', 2000.00, 55, 4, 'Confirmed'),
(48, 'Laptop', 30000.00, 100, 4, 'Confirmed'),
(50, 'Acer Mouse', 600.00, 255, 4, 'Confirmed'),
(54, 'Acer Mouse', 600.00, 200, 1, 'Confirmed'),
(57, 'Bag', 2000.00, 49, 1, 'Confirmed'),
(59, 'Slippers', 100.00, 195, 1, 'Confirmed'),
(60, 'Laptop', 30000.00, 95, 1, 'Confirmed'),
(82, 'Laptop', 20000.00, 2, 5, 'Confirmed'),
(83, 'Mouse', 600.00, 4, 5, 'Confirmed'),
(84, 'Shoes', 5000.00, 2, 5, 'Confirmed'),
(85, 'Mouse', 600.00, 3, 5, 'Confirmed'),
(86, 'Laptop', 20000.00, 1, 5, 'Confirmed'),
(87, 'Mouse', 600.00, 58, 5, 'Confirmed'),
(88, 'Shoes', 5000.00, 45, 5, 'Confirmed'),
(89, 'Mouse', 600.00, 4, 4, 'Confirmed'),
(90, 'Laptop', 20000.00, 5, 4, 'Confirmed'),
(91, 'Shoes', 5000.00, 12, 4, 'Confirmed'),
(93, 'Mouse', 600.00, 2, 5, 'Confirmed'),
(94, 'Shoes', 5000.00, 45, 4, 'Pending'),
(95, 'Laptop', 20000.00, 2, 5, 'Confirmed'),
(96, 'Mouse', 600.00, 2, 5, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `login` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `contact_no`, `username`, `password`, `type`, `login`) VALUES
(1, 'Alvin Yanson', '09952784676', 'alvin', 'alvin', 'Customer', 'February 13, 2018, 2:21 pm'),
(2, 'Sample Employee', '433-2449', 'employee', 'employee', 'Employee', 'February 13, 2018, 5:16 pm'),
(4, 'Sample Customer', '4335123', 'customer', 'customer', 'Customer', 'February 13, 2018, 4:00 pm'),
(5, 'Mark Jagonoy', '4332449', 'mark', 'mark', 'Customer', 'February 13, 2018, 5:29 pm');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
