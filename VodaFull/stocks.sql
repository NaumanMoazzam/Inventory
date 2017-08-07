-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 10:41 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT '0',
  `brand_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, '', 0, 2),
(2, 'Forever 21', 1, 2),
(3, 'Gap', 1, 2),
(4, 'Forever 21', 1, 2),
(5, 'Adidas', 1, 2),
(6, 'Gap', 1, 2),
(7, 'Forever 21', 1, 2),
(8, 'Adidas', 1, 2),
(9, 'Gap', 1, 2),
(10, 'Forever 21', 1, 2),
(11, 'Adidass', 1, 1),
(12, 'Gap', 1, 1),
(13, 'Forever 21', 1, 1),
(14, 'Nike', 1, 1),
(15, 'asas', 1, 1),
(16, 'Khaddi', 1, 1),
(17, 'Threadz', 1, 1),
(18, 'JafferJ', 1, 1),
(19, 'Gul Ahmed', 1, 1),
(20, 'Gul', 1, 1),
(21, 'Al Karam', 1, 1),
(22, 'qwerq', 1, 1),
(23, 'YKY', 1, 1),
(24, 'fujfuyfy', 1, 1),
(25, 'asasas', 1, 1),
(26, 'asasas', 1, 1),
(27, 'asasasfdfdf', 1, 1),
(28, 'afdfdf', 1, 1),
(29, 'asasasas', 1, 1),
(30, 'iiii', 1, 1),
(31, 'wetrfgf', 1, 1),
(32, 'asasas', 1, 1),
(33, 'asasa', 1, 1),
(34, 'hghghgh', 1, 1),
(35, 'dfgdfg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL,
  `prd_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `prd_code`) VALUES
(9, '77777'),
(10, '777777'),
(11, '777777'),
(12, '777777'),
(13, '777777');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT '0',
  `categories_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'Sports ', 1, 2),
(2, 'Casual', 1, 2),
(3, 'Casual', 1, 2),
(4, 'Sport', 1, 2),
(5, 'Casual', 1, 2),
(6, 'Sport wear', 1, 2),
(7, 'Casual wear', 1, 1),
(8, 'Sports ', 1, 1),
(9, 'Formal', 1, 1),
(10, 'Party wear', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `exp_id` int(11) NOT NULL,
  `exp_amount` int(11) NOT NULL,
  `exp_purpose` varchar(150) NOT NULL,
  `exp_date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`exp_id`, `exp_amount`, `exp_purpose`, `exp_date`) VALUES
(1, 500, 'Lunch', '2017-05-29'),
(2, 1000, 'Purchases', '2017-05-29'),
(3, 0, '4500', '2017-05-29'),
(4, 0, '4500', '2017-05-29'),
(5, 5900, 'Dinner', '2017-05-29'),
(6, 5900, 'Dinner', '2017-05-29'),
(7, 1000, 'Checking', '2017-05-29'),
(8, 6000, 'Testing', '2017-05-29'),
(9, 500, 'Tea', '2017-05-29'),
(10, 5000, 'Sehri', '2017-05-30'),
(11, 500, 'Tea', '2017-05-30'),
(12, 546, 'sdf', '2017-05-30'),
(13, 345, 'asdfds', '2017-05-30'),
(14, 356, 'rtyhtryh', '2017-05-30'),
(15, 5000, 'Shoaib', '2017-05-30'),
(16, 452, 'sgsdfg', '2017-05-30'),
(17, 1000, 'Service Charges', '2017-05-30'),
(18, 500, 'BreakFast', '2017-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `expense_range`
--

CREATE TABLE IF NOT EXISTS `expense_range` (
  `id` int(11) NOT NULL,
  `exp_rg_min` int(11) NOT NULL,
  `exp_rg_max` int(11) NOT NULL,
  `exp_rg_date` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_range`
--

INSERT INTO `expense_range` (`id`, `exp_rg_min`, `exp_rg_max`, `exp_rg_date`) VALUES
(1, 50000, 100000, '2017-05-29'),
(3, 0, 150000, '2017-06-01'),
(4, 0, 160000, '2017-06-01'),
(5, 0, 165000, '2017-06-01'),
(6, 0, 200000, '2017-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` text,
  `log_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `activity`, `log_date`) VALUES
(1, 2, 'Login By User Name: Nauman', '2017-05-30'),
(2, 2, 'Login By User Name: Nauman', '2017-05-30'),
(21, 2, 'Vendor Name:  addedd by user name: Nauman', '2017-05-30'),
(22, 2, 'Vendor Name:  addedd by user name: Nauman', '2017-05-30'),
(23, 2, 'Vendor Name: asasa addedd by user name: Nauman', '2017-05-30'),
(24, 2, 'Vendor Name: asasa addedd by user name: Nauman', '2017-05-30'),
(25, 2, 'Vendor Name: fdsfsd addedd by user name: Nauman', '2017-05-30'),
(26, 2, 'Login By User Name: Nauman', '2017-05-30'),
(27, 2, 'Brand Name: hghghgh addedd by user name: Nauman', '2017-05-30'),
(28, 2, 'Brand Name: dfgdfg addedd by user name: Nauman', '2017-05-30'),
(29, 2, 'Vendor Name: dfgdfgdf addedd by user name: Nauman', '2017-05-30'),
(30, 2, 'Category Name: Party wear addedd by user name: Nauman', '2017-05-30'),
(32, 2, 'Product Name: Denizen Shirt addedd by user name: Nauman', '2017-05-30'),
(33, 2, 'Expense Title/Purpose is: Tea and Amount is: 500addedd by user name: Nauman', '0000-00-00'),
(34, 2, 'Expense Title/Purpose is: sdf and Amount is: 546addedd by user name: Nauman', '0000-00-00'),
(35, 2, 'Expense Title/Purpose is: asdfds and Amount is: 345addedd by user name: Nauman', '0000-00-00'),
(36, 2, 'Expense Title/Purpose is: rtyhtryh and Amount is: 356addedd by user name: Nauman', '0000-00-00'),
(37, 2, 'Expense Title/Purpose is: Shoaib and Amount is: 5000addedd by user name: Nauman', '0000-00-00'),
(38, 2, 'Expense Title/Purpose is: sgsdfg and Amount is: 452addedd by user name: Nauman', '0000-00-00'),
(39, 2, 'Expense Title/Purpose is: Service Charges and Amount is: 1000addedd by user name: Nauman', '2017-05-30'),
(40, 1, 'Expense Title/Purpose is: BreakFast and Amount is: 500addedd by user name: admin', '2017-06-01'),
(41, 1, 'Vendor Name:  addedd by user name: admin', '2017-06-04'),
(42, 1, 'Vendor Name: Ali addedd by user name: admin', '2017-06-04'),
(43, 1, 'Order By Client Name: Total Amount:  Amount Paid:  Payment Type is: addedd by user name: admin', '2017-06-04'),
(44, 1, 'Order By Client Name: Total Amount:  Amount Paid:  Payment Type is: addedd by user name: admin', '2017-06-04'),
(45, 1, 'Order By Client Name: AbdullahTotal Amount: 15512.00 Amount Paid: 10000 Payment Type is: 3addedd by user name: admin', '2017-06-05'),
(46, 1, 'Sale ID: 73 to Client Name: Shumail addedd by user name: admin', '2017-06-05'),
(47, 1, 'Sale ID:  to Client Name: Shayan addedd by user name: admin', '2017-06-06'),
(48, 1, 'Sale ID: 74 to Client Name: Saad addedd by user name: admin', '2017-06-06'),
(49, 1, 'Sale ID: 75 to Client Name: Hashir addedd by user name: admin', '2017-06-06'),
(50, 1, 'Sale ID:  to Client Name: Saad edited by user name: admin', '2017-06-06'),
(51, 1, 'Sale ID:  to Client Name: Saad edited by user name: admin', '2017-06-06'),
(52, 1, 'Sale ID:  to Client Name: Saad edited by user name: admin', '2017-06-06'),
(53, 1, 'Sale ID:  to Client Name: Saad edited by user name: admin', '2017-06-06'),
(54, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06'),
(55, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06'),
(56, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06'),
(57, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06'),
(58, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06'),
(59, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06'),
(60, 1, 'Sale ID: 74 to Client Name: Saad edited by user name: admin', '2017-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `order_status`) VALUES
(1, '2016-07-15', 'John Doe', '9807867564', '2700.00', '351.00', '3051.00', '1000.00', '2051.00', '1000.00', '1051.00', 2, 2, 2),
(2, '2016-07-15', 'John Doe', '9808746573', '3400.00', '442.00', '3842.00', '500.00', '3342.00', '3342', '0', 2, 1, 2),
(3, '2016-07-16', 'John Doe', '9809876758', '3600.00', '468.00', '4068.00', '568.00', '3500.00', '3500', '0', 2, 1, 2),
(4, '2016-08-01', 'Indra', '19208130', '1200.00', '156.00', '1356.00', '1000.00', '356.00', '356', '0.00', 2, 1, 2),
(5, '2016-07-16', 'John Doe', '9808767689', '3600.00', '468.00', '4068.00', '500.00', '3568.00', '3568', '0', 2, 1, 1),
(6, '2017-06-05', 'Abdullah', '76869869', '13850.00', '1662', '15512.00', '0', '15512.00', '10000', '5512.00', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 1, 1, '1', '1500', '1500.00', 2),
(2, 1, 2, '1', '1200', '1200.00', 2),
(3, 2, 3, '2', '1200', '2400.00', 2),
(4, 2, 4, '1', '1000', '1000.00', 2),
(5, 3, 5, '2', '1200', '2400.00', 2),
(6, 3, 6, '1', '1200', '1200.00', 2),
(7, 4, 5, '1', '1200', '1200.00', 2),
(8, 5, 7, '2', '1200', '2400.00', 1),
(9, 5, 8, '1', '1200', '1200.00', 1),
(10, 6, 7, '10', '1200', '12000.00', 1),
(11, 6, 8, '1', '1200', '1200.00', 1),
(12, 6, 9, '1', '650', '650.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`, `status`, `vendor_id`) VALUES
(1, 'Half pant', '../assests/images/stock/2847957892502c7200.jpg', 1, 2, '19', '1500', 2, 2, 1),
(2, 'T-Shirt', '../assests/images/stock/163965789252551575.jpg', 2, 2, '9', '1200', 2, 2, 1),
(3, 'Half Pant', '../assests/images/stock/13274578927924974b.jpg', 5, 3, '18', '1200', 2, 2, 1),
(4, 'T-Shirt', '../assests/images/stock/12299578927ace94c5.jpg', 6, 3, '29', '1000', 2, 2, 1),
(5, 'Half Pant', '../assests/images/stock/24937578929c13532e.jpg', 8, 5, '17', '1200', 2, 2, 1),
(6, 'Polo T-Shirt', '../assests/images/stock/10222578929f733dbf.jpg', 9, 5, '29', '1200', 2, 2, 1),
(7, 'Half Pant', '../assests/images/stock/1770257893463579bf.jpg', 11, 7, '48', '1200', 1, 1, 1),
(8, 'Polo T-shirt', '../assests/images/stock/136715789347d1aea6.jpg', 12, 7, '80', '1200', 1, 1, 1),
(9, 'T-Shirt', '../assests/images/stock/177385929664d796af.jpg', 11, 7, '49', '650', 1, 1, 1),
(10, 'Shirt', '../assests/images/stock/11320592bfcc1a343c.jpg', 13, 7, '40', '900', 1, 1, 2),
(11, 'Paint', '../assests/images/stock/4038592d1bc0c7fee.jpg', 14, 10, '50', '550', 1, 1, 4),
(12, 'Denizen Shirt', '../assests/images/stock/14045592d1bff0097b.jpg', 11, 8, '50', '600', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE IF NOT EXISTS `product_detail` (
  `prd_id` int(11) DEFAULT NULL,
  `prd_code` varchar(20) DEFAULT NULL,
  `add_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`prd_id`, `prd_code`, `add_date`) VALUES
(7, '999999', '2017-05-13'),
(8, '111111', '2017-05-13'),
(7, '222222', '2017-05-13'),
(7, '333333', '2017-05-13'),
(10, '352746062107877', '2017-05-29'),
(1, '34343434', '2017-05-30'),
(3, 'sdsdsddsd', '2017-05-30'),
(2, 'asasasa', '2017-05-30'),
(2, 'asas', '2017-05-30'),
(2, 'rtrtrt', '2017-05-30'),
(3, 'wwewewe', '2017-05-30'),
(4, 'asasa', '2017-05-30'),
(4, 'afdghgh', '2017-05-30'),
(10, '555555', '2017-06-05'),
(10, '777777', '2017-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `sale_id` int(11) NOT NULL,
  `client_name` varchar(250) DEFAULT NULL,
  `client_nic` varchar(20) DEFAULT NULL,
  `client_address` varchar(500) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `grand_total` int(11) DEFAULT '0',
  `paid` int(11) DEFAULT '0',
  `due` int(11) DEFAULT '0',
  `payment_type` varchar(20) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `client_name`, `client_nic`, `client_address`, `sale_date`, `grand_total`, `paid`, `due`, `payment_type`) VALUES
(37, 'Nauman', '09836546', '44444-4444444-4', '2017-06-05', 0, 0, 0, '0'),
(38, 'Nauman', '0947345665', '44444-4444444-4', '2017-06-05', 0, 0, 0, '0'),
(39, 'Daniyal', '09764886', '44444-4444444-4', '2017-06-05', 0, 0, 0, '0'),
(40, 'dsfgdsafg', '345645', '6578', '2017-06-05', 0, 0, 0, '0'),
(41, 'dsfdsag', 'dsgdfg', 'dhgfhfg', '2017-06-05', 0, 0, 0, '0'),
(42, 'sdfgdsgdsf', 'gdfgdfgdf', 'dsfgdsydfhggfh', '2017-06-05', 0, 0, 0, '0'),
(43, 'dfhgdfh', '457657657', '57657', '2017-06-05', 0, 0, 0, '0'),
(44, 'sdfgfd', 'gdfgdf', '4567', '2017-06-05', 0, 0, 0, '0'),
(45, 'rfghytuyti', 'ytiuyi', 'uyiyuiyt', '2017-06-05', 0, 0, 0, '0'),
(46, 'fghfghfg', 'hfhfgh', '67657856', '2017-06-05', 0, 0, 0, '0'),
(47, 'User', '079868', '3535434535', '2017-06-05', 0, 0, 0, '0'),
(48, 'Dani', '090078601', '44444-4444444-4', '2017-06-05', 0, 0, 0, '0'),
(49, 'Nomi', '090078601', '44444-444444-44', '2017-06-05', 0, 0, 0, '0'),
(50, 'eytytr', 'rtyrt', '456', '2017-06-05', 0, 0, 0, '0'),
(51, '', '', '', '2017-06-05', 0, 0, 0, '0'),
(52, '', '', '', '2017-06-05', 0, 0, 0, '0'),
(53, '', '', '', '2017-06-05', 0, 0, 0, '0'),
(54, '', '', '', '2017-06-05', 0, 0, 0, '0'),
(55, 'vcbcb', 'hddfhfgh', '456546', '2017-06-05', 0, 0, 0, '0'),
(56, 'dfgdgdfh', 'fghfgh', 'fghfgh', '2017-06-05', 0, 0, 0, '0'),
(57, 'fdtye', '457647476', '45676568', '2017-06-05', 0, 0, 0, '0'),
(58, 'er', 'eryrty', 'rtyrty', '2017-06-05', 0, 0, 0, '0'),
(59, 'fdhj', 'fdjfgj', 'ghjgh', '2017-06-05', 0, 0, 0, '0'),
(60, 'fdgd', 'hgfhfg', 'fgfgh', '2017-06-05', 0, 0, 0, '0'),
(61, 'dsfgds', 'fgsdh', 'dshsdf', '2017-06-05', 0, 0, 0, '0'),
(62, 'dshfg', 'fdhfh', 'fhfd', '2017-06-05', 0, 0, 0, '0'),
(63, 'dfgfdh', 'fghj', '67567', '2017-06-05', 0, 0, 0, '0'),
(64, 'dfgfdg', 'dfhgdfhg', 'dfhfdg', '2017-06-05', 0, 0, 0, '0'),
(65, 'dsfgfd', 'gsdsfh', 'gdhgfhg', '2017-06-05', 0, 0, 0, '0'),
(66, 'sdfg', 'sdfgdfg', '5676', '2017-06-05', 0, 0, 0, '0'),
(67, 'sdgsfd', '56756765', '876787', '2017-06-05', 0, 0, 0, '0'),
(68, 'dfgdsf', 'gdsgdsg', 'ddgdsg', '2017-06-05', 0, 0, 0, '0'),
(69, 'fghfg', 'hfhfghj', 'gjghjhg', '2017-06-05', 0, 0, 0, '0'),
(70, 'iopoip', '6757567', '6575785', '2017-06-05', 0, 0, 0, '0'),
(71, 'Abdullah', '098675', '3423543543544', '2017-06-05', 0, 0, 0, '0'),
(72, 'Rashid', '090078601', '44444-4444444-4', '2017-06-05', 0, 0, 0, '0'),
(73, 'Shumail', '090078601', '44444-4444444-4', '2017-06-05', 0, 0, 0, '0'),
(74, 'Saad', '44444-4444444-4', '0300222222', '2017-06-06', 3000, 1700, 1300, '2'),
(75, 'Hashir', '42222-2222222-2', '0330333333', '2017-06-06', 3000, 1350, 1650, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE IF NOT EXISTS `sale_details` (
  `sale_id` int(11) DEFAULT NULL,
  `prd_code` varchar(20) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`sale_id`, `prd_code`, `rate`) VALUES
(37, '222222', 1200),
(37, '111111', 1200),
(38, '222222', 1200),
(38, '222222', 1200),
(38, '999999', 1200),
(47, '777777', 900),
(47, '555555', 900),
(48, '777777', 900),
(48, '555555', 900),
(49, '777777', 900),
(49, '555555', 900),
(50, '555555', 900),
(50, '777777', 900),
(51, '777777', 900),
(51, '555555', 900),
(52, '555555', 900),
(52, '777777', 900),
(53, '555555', 900),
(53, '777777', 900),
(54, '555555', 900),
(54, '777777', 900),
(55, '777777', 900),
(55, '555555', 900),
(56, '777777', 900),
(56, '555555', 900),
(57, '777777', 900),
(57, '555555', 900),
(58, '555555', 900),
(59, '777777', 900),
(60, '555555', 900),
(61, '777777', 900),
(62, '555555', 900),
(63, '555555', 900),
(64, '555555', 900),
(65, '555555', 900),
(66, '777777', 900),
(67, '555555', 900),
(67, '777777', 900),
(68, '555555', 900),
(69, '777777', 900),
(70, '555555', 900),
(71, '777777', 900),
(72, '352746062107877', 900),
(72, '555555', 900),
(72, '777777', 900),
(73, '555555', 900),
(73, '777777', 900),
(75, '333333', 1200),
(75, '555555', 900),
(75, '777777', 900),
(74, '333333', 1200),
(74, '555555', 900),
(74, '777777', 900);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(2, 'Nauman', 'e10adc3949ba59abbe56e057f20f883e', 'nauman@gmail.com'),
(3, 'taha', '5eac43aceba42c8757b54003a58277b5', 'taha@gmail.com'),
(4, 'danish', 'e10adc3949ba59abbe56e057f20f883e', 'danish@gmail.com'),
(5, 'Daniyal', 'e10adc3949ba59abbe56e057f20f883e', 'dani@ymail.com'),
(6, 'ali', 'e10adc3949ba59abbe56e057f20f883e', 'ali@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(200) NOT NULL,
  `vendor_address` varchar(500) NOT NULL,
  `vendor_cell` varchar(18) NOT NULL,
  `cnic` varchar(20) DEFAULT '43333-3333333-3'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `vendor_address`, `vendor_cell`, `cnic`) VALUES
(1, 'Aslam', 'UP Nagan', '0325544894', '43333-3333333-3'),
(2, 'Ali', 'Nagan', '03548646', '43333-3333333-3'),
(3, 'Shayan', 'Willayatabad', '32654484', '43333-3333333-3'),
(4, 'Taha', 'Nazimabad', '03169549', '43333-3333333-3'),
(5, 'Haider', 'UP', '035485464', '43333-3333333-3'),
(6, 'Saad', 'guvu', '61651', '43333-3333333-3'),
(7, 'ROky', 'aaf', '36436', '43333-3333333-3'),
(8, 'testing', 'jhbhubu', '876567', '43333-3333333-3'),
(9, 'agf', 'uuugu', '876876', '43333-3333333-3'),
(10, 'John', 'hguhgug', '87678', '43333-3333333-3'),
(11, 'dfdf', 'dfdf', '4545', '43333-3333333-3'),
(12, 'sas', 'asas', '34343434', '43333-3333333-3'),
(13, 'asasas', 'asasas', '5645454', '43333-3333333-3'),
(14, 'wewe', 'wewewewe', '454545', '43333-3333333-3'),
(15, 'dfdf', 'dfdfdfd', '454545', '43333-3333333-3'),
(16, 'asasasa', 'aasasas', '4343434', '43333-3333333-3'),
(17, 'sadasdas', 'asdasdas', '45345345', '43333-3333333-3'),
(18, 'ewrwerwe', 'eewrwer', '4454545', '43333-3333333-3'),
(19, 'sdfsdf', 'sdsdfsdf', '45545', '43333-3333333-3'),
(20, 'wewe', 'wewe', '43434', '43333-3333333-3'),
(21, 'asas', 'asasas', '3434', '43333-3333333-3'),
(22, 'asasas', 'asassas', '34343', '43333-3333333-3'),
(23, 'asas', 'asasa', '433434', '43333-3333333-3'),
(28, 'asasa', 'asassasas', '343434', '43333-3333333-3'),
(29, 'asasa', 'asassasas', '343434', '43333-3333333-3'),
(30, 'fdsfsd', 'sdfsdf', '5345345', '43333-3333333-3'),
(31, 'asasas', 'asasas', '23232323', '43333-3333333-3'),
(32, 'asasas', 'asasas', '23232323', '43333-3333333-3'),
(33, 'dsdsdsd', 'sdsdsd', '343434', '43333-3333333-3'),
(34, 'asas', 'asasa', '3434', '43333-3333333-3'),
(35, 'fjhfj', 'fhjgh', '546757', '43333-3333333-3'),
(36, 'Amjad', 'Banaras', '6574587', '43333-3333333-3'),
(37, 'Ali', 'nabibi', '89679689', '43333-3333333-3'),
(38, 'Sami', 'vu', '8t87876', '43333-3333333-3'),
(39, 'dfgdfgdf', 'fdgdfgdf', '5654756', '43333-3333333-3'),
(41, 'Ali', 'Nazimabad', '090078601', '42222-2222222-2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`exp_id`);

--
-- Indexes for table `expense_range`
--
ALTER TABLE `expense_range`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD KEY `prd_id` (`prd_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `expense_range`
--
ALTER TABLE `expense_range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_ibfk_1` FOREIGN KEY (`prd_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
