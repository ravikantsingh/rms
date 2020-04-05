-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2019 at 05:14 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rstm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivered` int(5) NOT NULL,
  `p_time` int(5) NOT NULL DEFAULT '20',
  `date` datetime NOT NULL,
  `price` double NOT NULL,
  `mode` set('Dine-in','Delivery') NOT NULL DEFAULT 'Dine-in',
  `customer_id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `order_id`, `product_id`, `quantity`, `delivered`, `p_time`, `date`, `price`, `mode`, `customer_id`, `table_no`) VALUES
(36, '0NRE-D802T8-3V8', 23, 1, 0, 20, '2019-12-04 00:12:04', 300, 'Dine-in', 0, 10),
(35, '0NRE-D802T8-3V8', 2, 1, 0, 20, '2019-12-04 00:12:04', 199, 'Dine-in', 0, 10),
(32, '6UW0-22F8SN-R50', 1, 1, 0, 20, '2019-12-04 00:01:04', 125, 'Dine-in', 0, 1),
(33, '0NRE-D802T8-3V8', 4, 1, 0, 20, '2019-12-04 00:12:04', 125, 'Dine-in', 0, 10),
(34, '0NRE-D802T8-3V8', 5, 1, 0, 20, '2019-12-04 00:12:04', 199, 'Dine-in', 0, 10),
(25, '0NRE-D802T8-3V8', 1, 2, 0, 20, '2019-12-03 22:52:52', 125, 'Dine-in', 14, 2),
(39, '8GC5-H6E7G6-1ZR', 15, 1, 0, 20, '2019-12-06 13:17:15', 210, 'Dine-in', 0, 6),
(38, 'G08S-6S12J5-V6E', 1, 1, 0, 20, '2019-12-04 02:07:39', 125, 'Dine-in', 0, 1),
(37, '6B4E-1J18NV-3X3', 1, 2, 0, 20, '2019-12-04 02:07:16', 125, 'Dine-in', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `parent` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `slug`, `active`, `parent`, `date`, `update_date`, `deleted`) VALUES
(1, 'VEGGIE DELIGHT', 'delight', 1, 0, '2019-10-01 19:07:04', '0000-00-00 00:00:00', 0),
(2, 'VEGGIE TREAT', 'treat', 1, 0, '2019-10-01 19:08:16', '0000-00-00 00:00:00', 0),
(3, 'VEG FEAST PIZZA', 'veg_feast_pizza', 1, 0, '2019-10-01 19:08:24', '0000-00-00 00:00:00', 0),
(4, 'PIZZA COMBOT SET', 'pizza_combo_set', 1, 0, '2019-10-01 19:08:51', '0000-00-00 00:00:00', 0),
(5, 'XYZ', 'xyz', 1, 0, '2019-12-14 19:48:48', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE IF NOT EXISTS `combo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `slug` varchar(25) NOT NULL,
  `items` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `offer` double NOT NULL,
  `tax` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `activation_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `discountable` tinyint(1) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `combo`
--

INSERT INTO `combo` (`id`, `name`, `slug`, `items`, `price`, `offer`, `tax`, `date`, `activation_date`, `expiry_date`, `active`, `discountable`, `discount`, `sale`) VALUES
(1, 'Hot Pizza', 'hotpizza', '', 220, 210, '1 2', '2019-12-15 08:45:34', '2019-12-15 00:00:00', '2019-12-17 00:00:00', 1, 1, 1, 0),
(2, 'Great Combo', 'greatcombo', '', 440, 410, '1 2', '2019-12-15 08:46:23', '2019-12-15 00:00:00', '2019-12-17 23:00:00', 1, 1, 2, 0),
(3, 'Final Combo', 'finalcombo', '', 550, 520, '1 2', '2019-12-15 08:47:58', '2019-12-15 00:00:00', '2019-12-20 23:59:59', 1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `combo_items`
--

DROP TABLE IF EXISTS `combo_items`;
CREATE TABLE IF NOT EXISTS `combo_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `combo_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

DROP TABLE IF EXISTS `customer_details`;
CREATE TABLE IF NOT EXISTS `customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `wallet` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `name`, `mobile`, `address`, `wallet`, `date`) VALUES
(1, 'Alpha', '08318340095', '', 0, '2019-11-27 20:41:38'),
(2, 'Ravi Kant', '09695090904', '', 0, '2019-11-27 20:44:27'),
(3, 'Ravi Kant D.cdd ds', '7388418366', '', 0, '2019-11-27 20:50:44'),
(4, 'Bindeshwari Singh D. sss', '8318340096', '', 0, '2019-11-27 20:59:32'),
(5, 'Joseph', '8765944208', '', 0, '2019-11-28 10:15:34'),
(6, 'Alpha G', '1234567891', '', 0, '2019-11-28 10:23:28'),
(7, 'Bindeshwari Singh D. sss', '08318340096', '', 0, '2019-11-28 14:32:28'),
(8, 'Alpha Roger', '8529637410', '', 0, '2019-11-29 18:25:54'),
(9, 'roger', '9876543210', '', 0, '2019-11-29 19:20:55'),
(10, 'adasjdlj', '8529330120', '', 0, '2019-11-29 20:20:18'),
(11, 'ALOK PANDEY', '09140922631', '', 0, '2019-11-30 09:25:08'),
(12, 'alok', '9876543211', '', 0, '2019-12-01 09:23:15'),
(13, 'Laxman prasad kharwar Hemlata kharwar', '8932003481', '', 0, '2019-12-03 12:24:47'),
(14, 'suresh', '9918475609', '', 0, '2019-12-03 22:53:21'),
(15, 'Ravi Kant D. singh', '07388418366', '', 0, '2019-12-14 14:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `daily_expense`
--

DROP TABLE IF EXISTS `daily_expense`;
CREATE TABLE IF NOT EXISTS `daily_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(3) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_expense`
--

INSERT INTO `daily_expense` (`id`, `expense`, `amount`, `date`, `user_id`, `deleted`) VALUES
(1, 'paneer', 460, '2019-11-24 07:25:21', '2', 0),
(2, 'paneer', 452, '2019-12-02 10:12:05', '1', 0),
(3, 'alpha', 520, '2019-12-04 00:31:06', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `rate` float NOT NULL,
  `type` enum('Flat','Percentage') NOT NULL DEFAULT 'Percentage',
  `criteria` enum('Flat','MCV') NOT NULL DEFAULT 'Flat',
  `cart_value` float NOT NULL,
  `active_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `rate`, `type`, `criteria`, `cart_value`, `active_date`, `expire_date`, `date`, `update_date`, `active`, `deleted`) VALUES
(1, 'Diwali Discount', 10, 'Percentage', 'MCV', 199, '2019-10-05 00:00:00', '2019-12-17 23:59:59', '2019-10-01 14:05:35', '0000-00-00 00:00:00', 1, 0),
(2, 'Dasahara', 150, 'Flat', 'MCV', 550, '2019-10-02 00:00:00', '2019-12-16 23:00:00', '2019-10-01 14:08:06', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_code`
--

DROP TABLE IF EXISTS `member_code`;
CREATE TABLE IF NOT EXISTS `member_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(4) NOT NULL,
  `code` text NOT NULL,
  `used` tinyint(1) NOT NULL,
  `use_date` datetime NOT NULL,
  `user_id` int(4) NOT NULL,
  `value` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_code`
--

INSERT INTO `member_code` (`id`, `member_id`, `code`, `used`, `use_date`, `user_id`, `value`) VALUES
(1, 'm1', '$2y$10$YE9vFDLlCg8uJIQGnpII5OdG2/S/xBdwgFDgmNvZsUOmXmYn2Wkge', 0, '0000-00-00 00:00:00', 0, 'WFBEV080'),
(2, 'm1', '$2y$10$CWXcn8purc33n/Sd6rUzuuYR0SnjBrj4kTCsVFLauZ5nqpIKDQcNy', 0, '0000-00-00 00:00:00', 0, 'RzUyQ0Y3'),
(3, 'm1', '$2y$10$oR/KO54UV5YLVeAmj7wm/OUoOG0PzquT4vM86HLIZQ14GDVtam69m', 0, '0000-00-00 00:00:00', 0, 'V0ZSTk9J'),
(4, 'm1', '$2y$10$Gk0m9gDMds1GXu4C6E8vNeeTBKYEUSo4sWcdmXZ9QLDZgDrorovD6', 0, '0000-00-00 00:00:00', 0, 'WEtXOFhU'),
(5, 'm1', '$2y$10$kV629arcGRLHz4nrvxAbgurDhzMQULR.kAmjkghSEJxF0b/1myEhG', 0, '0000-00-00 00:00:00', 0, 'SldBUDgx'),
(6, 'm1', '$2y$10$5tl3aCDR1KZH2DOt9LRbleMQRuk9yoZbdgZaPF3.iJMaqHRWYibdK', 0, '0000-00-00 00:00:00', 0, 'WjREU1VT'),
(7, 'm1', '$2y$10$p6EJ.Vlp575S2v71le7TT.vub8peMwOMjnB4Se4G5Ufa0Eyv4gk/S', 0, '0000-00-00 00:00:00', 0, 'M1dDS0FR'),
(8, 'm1', '$2y$10$mE.JdHEcyqNnWvZRDDR0Wey6ST27mJl7HdMk2K9jdEMRG5l3OGVTm', 0, '0000-00-00 00:00:00', 0, 'WFowQUhK'),
(9, 'm1', '$2y$10$ePfgmc0ZOP2.HFm1EoiVrOZ6zcfsDAUnljHUWcnkQLx0JTh4ANP6i', 0, '0000-00-00 00:00:00', 0, 'TDVPWkFN'),
(10, 'm1', '$2y$10$G0xsmHR9RSzGEKYXyjKHrOfOPmqdlOSngRn9w3f0CmwvDPRRQZ9le', 0, '0000-00-00 00:00:00', 0, 'T1VKODJW'),
(11, 'm1', '$2y$10$/u.zodNGC0fhg8K60FGgOeFjA7tEdDzKwd6kmdNAsxunQUjb2HsEi', 1, '0000-00-00 00:00:00', 0, 'UFUxUzBV'),
(12, 'm1', '$2y$10$9l2z3cvlRmmbSb8Yd0eubu31TNPFJeAxsU.KRpWFozWlwSsr2FYXe', 0, '0000-00-00 00:00:00', 0, 'NjNDTzE5'),
(13, 'm1', '$2y$10$wVO.ncLzT4hrK9x1SnzKJe1q7ZrfxaMaZAKmiO.69dbpo0z2NCyiq', 0, '0000-00-00 00:00:00', 0, 'R1MxNTBM'),
(14, 'm1', '$2y$10$FF7BjNJ6eaoj0TH8PJF4jOHJ6cxe4Pg3/p/zce.xE341pA7JWTeby', 1, '2019-10-29 12:42:23', 0, 'MVEzNDJE'),
(15, 'm1', '$2y$10$kTdcp7v0.svD02b02FEk8OUdX8isKr1jr.6iT2rzLUaFUzOmDtC9y', 0, '0000-00-00 00:00:00', 0, 'RzFXUVVX'),
(16, 'm1', '$2y$10$2faSMxU0kMcXQcc5RGw2iemvusQedBi3GOo7b.14WNQNxtSHbRJ8e', 0, '0000-00-00 00:00:00', 0, 'U1dENjNL'),
(17, 'm1', '$2y$10$aIVUD/gd/vnYZ/29DFqFTOyehRWW1UaMueHNxxxtk4MfazsuvUVh6', 0, '0000-00-00 00:00:00', 0, 'VDdFTlNG'),
(18, 'm1', '$2y$10$vo45.fuyhM4GMm1Whs8sZeh4R8Ejlk.8w1pQqfHlLknUWzoy4JCPq', 0, '0000-00-00 00:00:00', 0, 'WThWSEJV'),
(19, 'm1', '$2y$10$vnIhm2IAcARGcT6NyJz1vOAJJ00ksSb8iJBKzp7hwCX4ffiEvZJPq', 0, '0000-00-00 00:00:00', 0, 'WEFDN0U1'),
(20, 'm1', '$2y$10$KKC8nwHlwvIqne/BlWKaLu37/USB8noBcpLoxcPdm7ZaB454urCti', 0, '0000-00-00 00:00:00', 0, 'T0wzWjZF');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(25) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_amount` double NOT NULL,
  `order_discount` double NOT NULL,
  `order_tax` double NOT NULL,
  `order_total` double NOT NULL,
  `order_rounded` double NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `p_time` int(11) NOT NULL,
  `token` int(11) NOT NULL,
  `status` enum('0','1','2','3','4','5','6','7','8') NOT NULL DEFAULT '0',
  `mode` set('Dine-In','Delivery') NOT NULL DEFAULT 'Dine-In',
  `canceled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `customer_id`, `order_amount`, `order_discount`, `order_tax`, `order_total`, `order_rounded`, `date`, `user_id`, `p_time`, `token`, `status`, `mode`, `canceled`) VALUES
(1, 'KNNL-0ODJZ3-RKH', 0, 125, 0, 5.625, 130.625, 131, '2019-11-28 10:35:24', 2, 20, 1911280001, '2', '', 0),
(2, 'NTV5-5J6C6H-ADM', 3, 250, 0, 11.25, 261.25, 261, '2019-11-28 10:41:10', 2, 20, 1911280002, '2', 'Dine-In', 0),
(3, '1BHQ-48PR78-6IY', 1, 995, 0, 44.775, 1039.775, 1040, '2019-11-28 10:42:50', 2, 20, 1911280003, '1', 'Delivery', 1),
(4, 'GGBC-ULPZUF-WQC', 2, 324, 0, 14.58, 338.58, 339, '2019-11-28 11:10:46', 2, 20, 1911280004, '1', 'Dine-In', 0),
(5, 'UQD7-PZEBP5-G6Z', 7, 449, 0, 20.205, 469.205, 469, '2019-11-28 14:34:03', 2, 20, 1911280005, '1', 'Dine-In', 0),
(6, '8M88-E37EE0-EAF', 5, 460, 0, 20.7, 480.7, 481, '2019-11-29 18:24:55', 2, 20, 1911290001, '1', 'Dine-In', 0),
(7, 'XX0S-3EBG9H-7S9', 8, 523, 0, 23.535, 546.535, 547, '2019-11-29 18:26:07', 2, 20, 1911290002, '1', 'Dine-In', 0),
(8, 'B7EM-2QYISM-FU6', 9, 998, 0, 44.91, 1042.91, 1043, '2019-11-29 19:21:13', 2, 20, 1911290003, '1', 'Dine-In', 0),
(9, '28H9-B47GCE-3D9', 10, 4462, 0, 200.79, 4662.79, 4663, '2019-11-29 20:20:47', 2, 20, 1911290004, '1', 'Dine-In', 0),
(10, '46MD-KBAVHP-3X6', 11, 1620, 0, 72.9, 1692.9, 1693, '2019-11-30 09:26:06', 2, 20, 1911300001, '1', 'Dine-In', 0),
(11, '594N-M7N65G-DWA', 3, 1505, 0, 67.725, 1572.725, 1573, '2019-11-30 13:15:15', 2, 20, 1911300002, '1', 'Dine-In', 0),
(12, 'ERGV-3RC3RN-3TL', 4, 499, 0, 22.455, 521.455, 521, '2019-11-30 16:56:46', 2, 20, 1911300003, '1', 'Dine-In', 0),
(13, 'JZ60-I02AV7-1D4', 5, 375, 0, 16.875, 391.875, 392, '2019-11-30 20:00:11', 2, 20, 1911300004, '2', 'Dine-In', 0),
(14, '3V5N-RWVXKY-3QZ', 12, 385, 0, 17.325, 402.325, 402, '2019-12-01 09:25:17', 2, 20, 1912010001, '1', 'Dine-In', 0),
(15, 'UW6E-3AVS5W-TB5', 11, 1096, 0, 49.32, 1145.32, 1145, '2019-12-02 20:51:16', 2, 20, 1912020001, '1', 'Dine-In', 0),
(16, '9VGB-WT03IO-BJ8', 2, 250, 0, 11.25, 261.25, 261, '2019-12-03 13:25:39', 2, 20, 1912030001, '1', 'Dine-In', 0),
(17, '4UME-ABYGCY-SL1', 2, 324, 0, 14.58, 338.58, 339, '2019-12-03 13:32:45', 2, 20, 1912030002, '1', 'Dine-In', 1),
(18, 'PT70-ZVSPY1-GOG', 2, 972, 0, 43.74, 1015.74, 1016, '2019-12-03 13:39:06', 2, 20, 1912030003, '1', 'Delivery', 0),
(19, 'BDO1-7ZCC43-UKG', 13, 1947, 0, 87.615, 2034.615, 2035, '2019-12-03 13:42:28', 2, 20, 1912030004, '2', 'Dine-In', 0),
(20, 'LOG4-A5VREI-3XW', 11, 2092, 0, 94.14, 2186.14, 2186, '2019-12-03 13:45:13', 2, 20, 1912030005, '3', 'Dine-In', 0),
(21, 'M2TA-T1S2FZ-RPX', 2, 324, 0, 14.58, 338.58, 339, '2019-12-03 13:51:29', 2, 20, 1912030006, '3', 'Dine-In', 0),
(22, 'O90X-0P13LD-0AI', 1, 449, 0, 20.205, 469.205, 469, '2019-12-03 21:27:15', 2, 20, 1912030007, '3', 'Dine-In', 0),
(23, '0TS3-90DC3H-VUJ', 11, 1296, 0, 58.32, 1354.32, 1354, '2019-12-03 23:23:52', 2, 20, 1912030008, '3', 'Dine-In', 0),
(24, 'HKFF-CBO2T7-2TG', 11, 1097, 0, 49.365, 1146.365, 1146, '2019-12-03 23:29:14', 2, 20, 1912030009, '1', 'Dine-In', 0),
(25, 'Z2NB-UXA31M-AZW', 2, 624, 0, 28.08, 652.08, 652, '2019-12-03 23:56:48', 2, 20, 1912030010, '3', 'Dine-In', 0),
(26, 'N3FW-RCX46L-0NJ', 2, 250, 0, 10.125, 235.125, 235, '2019-12-14 14:18:12', 2, 20, 1912140001, '1', 'Dine-In', 0),
(27, 'KTXO-WSN4XU-XIO', 15, 750, 0, 30.375, 705.375, 705, '2019-12-14 14:22:03', 2, 20, 1912140002, '1', 'Dine-In', 0),
(28, '4MBN-EUZJTY-20J', 1, 898, 50, 38.16, 886.16, 886, '2019-12-14 14:25:34', 2, 20, 1912140003, '1', 'Dine-In', 0),
(29, '60X6-9GR1WY-VAQ', 1, 240, 24, 9.72, 225.72, 226, '2019-12-14 19:00:50', 2, 20, 1912140004, '1', 'Dine-In', 0),
(30, 'LX35-LKODPI-PLO', 1, 319, 12, 13.815, 320.815, 321, '2019-12-14 19:28:02', 2, 20, 1912140005, '1', 'Dine-In', 0),
(31, 'E0ZD-2TPQ0Q-51S', 1, 439, 24, 18.675, 433.675, 434, '2019-12-14 19:29:53', 2, 25, 1912140006, '1', 'Dine-In', 0),
(32, '2U9K-0RHOVI-DH1', 15, 240, 24, 9.72, 225.72, 226, '2019-12-14 20:00:16', 2, 25, 1912140007, '1', 'Dine-In', 0),
(33, '718Q-HEG0OC-9JR', 1, 518, 0, 23.31, 541.31, 541, '2019-12-15 07:31:49', 2, 20, 1912150001, '1', 'Dine-In', 0),
(34, 'NH6N-VT6QXH-8BD', 1, 564, 36.5, 23.7375, 551.2375, 551, '2019-12-15 07:35:20', 2, 20, 1912150002, '1', 'Dine-In', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(25) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `item_id` int(5) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` double NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_subTotal` double NOT NULL,
  `item_tax` double NOT NULL,
  `item_discount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `customer_id`, `date`, `item_id`, `item_name`, `item_price`, `item_qty`, `item_subTotal`, `item_tax`, `item_discount`) VALUES
(1, 'KNNL-0ODJZ3-RKH', 0, '2019-11-28 10:35:24', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(2, 'NTV5-5J6C6H-ADM', 0, '2019-11-28 10:41:10', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(3, 'NTV5-5J6C6H-ADM', 0, '2019-11-28 10:41:10', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 1, 125, 5.625, 0),
(4, '1BHQ-48PR78-6IY', 0, '2019-11-28 10:42:50', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 5, 995, 44.775, 0),
(5, 'GGBC-ULPZUF-WQC', 0, '2019-11-28 11:10:46', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(6, 'GGBC-ULPZUF-WQC', 0, '2019-11-28 11:10:46', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(7, 'UQD7-PZEBP5-G6Z', 0, '2019-11-28 14:34:03', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(8, 'UQD7-PZEBP5-G6Z', 0, '2019-11-28 14:34:03', 1, 'CHEESE & CORN REG', 125, 2, 250, 11.25, 0),
(9, '8M88-E37EE0-EAF', 0, '2019-11-29 18:24:55', 17, 'PAPPY PANEER LAR', 460, 1, 460, 20.7, 0),
(10, 'XX0S-3EBG9H-7S9', 0, '2019-11-29 18:26:07', 2, 'CHEESE & CORN MED', 199, 2, 398, 17.91, 0),
(11, 'XX0S-3EBG9H-7S9', 0, '2019-11-29 18:26:07', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(12, 'B7EM-2QYISM-FU6', 0, '2019-11-29 19:21:13', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(13, 'B7EM-2QYISM-FU6', 0, '2019-11-29 19:21:13', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 1, 199, 8.955, 0),
(14, 'B7EM-2QYISM-FU6', 0, '2019-11-29 19:21:13', 3, 'CHEESE & CORN LAR', 300, 1, 300, 13.5, 0),
(15, 'B7EM-2QYISM-FU6', 0, '2019-11-29 19:21:13', 6, 'DOUBLE CHEESE MARGHERITA LAR', 300, 1, 300, 13.5, 0),
(16, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 2, 250, 11.25, 0),
(17, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 3, 'CHEESE & CORN LAR', 300, 2, 600, 27, 0),
(18, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(19, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(20, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 2, 398, 17.91, 0),
(21, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 6, 'DOUBLE CHEESE MARGHERITA LAR', 300, 1, 300, 13.5, 0),
(22, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 14, 'FARMHOUSE LAR', 350, 2, 700, 31.5, 0),
(23, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 13, 'FARMHOUSE MED', 250, 1, 250, 11.25, 0),
(24, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 17, 'PAPPY PANEER LAR', 460, 1, 460, 20.7, 0),
(25, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 16, 'PAPPY PANEER MED', 310, 2, 620, 27.9, 0),
(26, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 7, 'ONION SINGLE', 70, 2, 140, 6.3, 0),
(27, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 8, 'CAPSICUM SINGLE', 70, 2, 140, 6.3, 0),
(28, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 9, 'TOMATO SINGLE', 70, 2, 140, 6.3, 0),
(29, '28H9-B47GCE-3D9', 0, '2019-11-29 20:20:47', 10, 'GOLDEN CORN SINGLE', 70, 2, 140, 6.3, 0),
(30, '46MD-KBAVHP-3X6', 0, '2019-11-30 09:26:06', 16, 'PAPPY PANEER MED', 310, 1, 310, 13.95, 0),
(31, '46MD-KBAVHP-3X6', 0, '2019-11-30 09:26:06', 15, 'PAPPY PANEER REG', 210, 1, 210, 9.45, 0),
(32, '46MD-KBAVHP-3X6', 0, '2019-11-30 09:26:06', 14, 'FARMHOUSE LAR', 350, 1, 350, 15.75, 0),
(33, '46MD-KBAVHP-3X6', 0, '2019-11-30 09:26:06', 13, 'FARMHOUSE MED', 250, 3, 750, 33.75, 0),
(34, '594N-M7N65G-DWA', 0, '2019-11-30 13:15:15', 17, 'PAPPY PANEER LAR', 460, 3, 1380, 62.1, 0),
(35, '594N-M7N65G-DWA', 0, '2019-11-30 13:15:15', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(36, 'ERGV-3RC3RN-3TL', 0, '2019-11-30 16:56:47', 3, 'CHEESE & CORN LAR', 300, 1, 300, 13.5, 0),
(37, 'ERGV-3RC3RN-3TL', 0, '2019-11-30 16:56:47', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(38, 'JZ60-I02AV7-1D4', 0, '2019-11-30 20:00:11', 1, 'CHEESE & CORN REG', 125, 3, 375, 16.875, 0),
(39, '3V5N-RWVXKY-3QZ', 0, '2019-12-01 09:25:17', 12, 'FARMHOUSE REG', 175, 1, 175, 7.875, 0),
(40, '3V5N-RWVXKY-3QZ', 0, '2019-12-01 09:25:17', 8, 'CAPSICUM SINGLE', 70, 1, 70, 3.15, 0),
(41, '3V5N-RWVXKY-3QZ', 0, '2019-12-01 09:25:17', 7, 'ONION SINGLE', 70, 2, 140, 6.3, 0),
(42, 'UW6E-3AVS5W-TB5', 0, '2019-12-02 20:51:16', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 2, 398, 17.91, 0),
(43, 'UW6E-3AVS5W-TB5', 0, '2019-12-02 20:51:16', 2, 'CHEESE & CORN MED', 199, 2, 398, 17.91, 0),
(44, 'UW6E-3AVS5W-TB5', 0, '2019-12-02 20:51:16', 3, 'CHEESE & CORN LAR', 300, 1, 300, 13.5, 0),
(45, '9VGB-WT03IO-BJ8', 0, '2019-12-03 13:25:39', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 1, 125, 5.625, 0),
(46, '9VGB-WT03IO-BJ8', 0, '2019-12-03 13:25:39', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(47, '4UME-ABYGCY-SL1', 0, '2019-12-03 13:32:45', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(48, '4UME-ABYGCY-SL1', 0, '2019-12-03 13:32:45', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(49, 'PT70-ZVSPY1-GOG', 0, '2019-12-03 13:39:06', 1, 'CHEESE & CORN REG', 125, 3, 375, 16.875, 0),
(50, 'PT70-ZVSPY1-GOG', 0, '2019-12-03 13:39:06', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(51, 'PT70-ZVSPY1-GOG', 0, '2019-12-03 13:39:06', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 2, 398, 17.91, 0),
(52, 'BDO1-7ZCC43-UKG', 0, '2019-12-03 13:42:28', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 1, 125, 5.625, 0),
(53, 'BDO1-7ZCC43-UKG', 0, '2019-12-03 13:42:28', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 3, 597, 26.865, 0),
(54, 'BDO1-7ZCC43-UKG', 0, '2019-12-03 13:42:28', 6, 'DOUBLE CHEESE MARGHERITA LAR', 300, 2, 600, 27, 0),
(55, 'BDO1-7ZCC43-UKG', 0, '2019-12-03 13:42:28', 1, 'CHEESE & CORN REG', 125, 5, 625, 28.125, 0),
(56, 'LOG4-A5VREI-3XW', 0, '2019-12-03 13:45:13', 2, 'CHEESE & CORN MED', 199, 8, 1592, 71.64, 0),
(57, 'LOG4-A5VREI-3XW', 0, '2019-12-03 13:45:13', 1, 'CHEESE & CORN REG', 125, 2, 250, 11.25, 0),
(58, 'LOG4-A5VREI-3XW', 0, '2019-12-03 13:45:13', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 2, 250, 11.25, 0),
(59, 'M2TA-T1S2FZ-RPX', 0, '2019-12-03 13:51:29', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(60, 'M2TA-T1S2FZ-RPX', 0, '2019-12-03 13:51:29', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(61, 'O90X-0P13LD-0AI', 0, '2019-12-03 21:27:15', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(62, 'O90X-0P13LD-0AI', 0, '2019-12-03 21:27:15', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(63, 'O90X-0P13LD-0AI', 0, '2019-12-03 21:27:15', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 1, 125, 5.625, 0),
(64, '0TS3-90DC3H-VUJ', 0, '2019-12-03 23:23:52', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 2, 398, 17.91, 0),
(65, '0TS3-90DC3H-VUJ', 0, '2019-12-03 23:23:52', 1, 'CHEESE & CORN REG', 125, 4, 500, 22.5, 0),
(66, '0TS3-90DC3H-VUJ', 0, '2019-12-03 23:23:52', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(67, '0TS3-90DC3H-VUJ', 0, '2019-12-03 23:23:52', 19, 'FRIESH VEGGIE MED', 199, 1, 199, 8.955, 0),
(68, 'HKFF-CBO2T7-2TG', 0, '2019-12-03 23:29:14', 1, 'CHEESE & CORN REG', 125, 4, 500, 22.5, 0),
(69, 'HKFF-CBO2T7-2TG', 0, '2019-12-03 23:29:14', 2, 'CHEESE & CORN MED', 199, 3, 597, 26.865, 0),
(70, 'Z2NB-UXA31M-AZW', 0, '2019-12-03 23:56:48', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(71, 'Z2NB-UXA31M-AZW', 0, '2019-12-03 23:56:48', 12, 'FARMHOUSE REG', 175, 1, 175, 7.875, 0),
(72, 'Z2NB-UXA31M-AZW', 0, '2019-12-03 23:56:48', 1, 'CHEESE & CORN REG', 125, 2, 250, 11.25, 0),
(73, 'N3FW-RCX46L-0NJ', 0, '2019-12-14 14:18:12', 1, 'CHEESE & CORN REG', 125, 1, 125, 5.625, 0),
(74, 'N3FW-RCX46L-0NJ', 0, '2019-12-14 14:18:12', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 1, 125, 5.625, 0),
(75, 'KTXO-WSN4XU-XIO', 0, '2019-12-14 14:22:03', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 4, 500, 22.5, 0),
(76, 'KTXO-WSN4XU-XIO', 0, '2019-12-14 14:22:03', 1, 'CHEESE & CORN REG', 125, 2, 250, 11.25, 0),
(77, '4MBN-EUZJTY-20J', 0, '2019-12-14 14:25:34', 5, 'DOUBLE CHEESE MARGHERITA MED', 199, 2, 398, 17.91, 0),
(78, '4MBN-EUZJTY-20J', 0, '2019-12-14 14:25:34', 1, 'CHEESE & CORN REG', 125, 4, 500, 22.5, 0),
(79, '60X6-9GR1WY-VAQ', 0, '2019-12-14 19:00:50', 1, 'CHEESE amp; CORN REG', 120, 2, 240, 10.8, 0),
(80, 'LX35-LKODPI-PLO', 0, '2019-12-14 19:28:02', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(81, 'LX35-LKODPI-PLO', 0, '2019-12-14 19:28:02', 1, 'CHEESE amp; CORN REG', 120, 1, 120, 5.4, 0),
(82, 'E0ZD-2TPQ0Q-51S', 0, '2019-12-14 19:29:53', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(83, 'E0ZD-2TPQ0Q-51S', 0, '2019-12-14 19:29:53', 1, 'CHEESE amp; CORN REG', 120, 2, 240, 10.8, 24),
(84, '2U9K-0RHOVI-DH1', 0, '2019-12-14 20:00:16', 1, 'CHEESE & CORN REG', 120, 2, 240, 10.8, 24),
(85, '718Q-HEG0OC-9JR', 0, '2019-12-15 07:31:49', 2, 'CHEESE & CORN MED', 199, 2, 398, 17.91, 0),
(86, '718Q-HEG0OC-9JR', 0, '2019-12-15 07:31:49', 1, 'CHEESE & CORN REG', 120, 1, 120, 5.4, 0),
(87, 'NH6N-VT6QXH-8BD', 0, '2019-12-15 07:35:20', 2, 'CHEESE & CORN MED', 199, 1, 199, 8.955, 0),
(88, 'NH6N-VT6QXH-8BD', 0, '2019-12-15 07:35:20', 1, 'CHEESE & CORN REG', 120, 2, 240, 10.8, 24),
(89, 'NH6N-VT6QXH-8BD', 0, '2019-12-15 07:35:20', 4, 'DOUBLE CHEESE MARGHERITA REG', 125, 1, 125, 5.625, 12.5);

-- --------------------------------------------------------

--
-- Table structure for table `order_ledger`
--

DROP TABLE IF EXISTS `order_ledger`;
CREATE TABLE IF NOT EXISTS `order_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(25) NOT NULL,
  `mode` varchar(25) NOT NULL,
  `amount` double NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `refunded` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_ledger`
--

INSERT INTO `order_ledger` (`id`, `order_id`, `mode`, `amount`, `customer_id`, `date`, `refunded`) VALUES
(1, 'KNNL-0ODJZ3-RKH', 'cash', 131, 0, '2019-11-28 10:35:13', 0),
(2, 'NTV5-5J6C6H-ADM', 'cash', 261, 0, '2019-11-28 10:40:58', 0),
(3, '1BHQ-48PR78-6IY', 'member', 1040, 0, '2019-11-28 10:42:37', 0),
(4, 'GGBC-ULPZUF-WQC', 'cash', 339, 0, '2019-11-28 11:10:36', 0),
(5, 'UQD7-PZEBP5-G6Z', 'member', 469, 0, '2019-11-28 14:32:28', 0),
(6, '8M88-E37EE0-EAF', 'cash', 481, 0, '2019-11-29 18:24:13', 0),
(7, 'XX0S-3EBG9H-7S9', 'cash', 200, 0, '2019-11-29 18:25:54', 0),
(8, 'XX0S-3EBG9H-7S9', 'phonepe', 347, 0, '2019-11-29 18:25:54', 0),
(9, 'B7EM-2QYISM-FU6', 'cash', 343, 0, '2019-11-29 19:20:55', 0),
(10, 'B7EM-2QYISM-FU6', 'card', 200, 0, '2019-11-29 19:20:55', 0),
(11, 'B7EM-2QYISM-FU6', 'paytm', 500, 0, '2019-11-29 19:20:55', 0),
(12, '28H9-B47GCE-3D9', 'cash', 1000, 0, '2019-11-29 20:20:18', 0),
(13, '28H9-B47GCE-3D9', 'card', 1000, 0, '2019-11-29 20:20:18', 0),
(14, '28H9-B47GCE-3D9', 'paytm', 1000, 0, '2019-11-29 20:20:18', 0),
(15, '28H9-B47GCE-3D9', 'phonepe', 1000, 0, '2019-11-29 20:20:18', 0),
(16, '28H9-B47GCE-3D9', 'bhim', 500, 0, '2019-11-29 20:20:18', 0),
(17, '28H9-B47GCE-3D9', 'member', 163, 0, '2019-11-29 20:20:18', 0),
(18, '46MD-KBAVHP-3X6', 'cash', 193, 0, '2019-11-30 09:25:09', 0),
(19, '46MD-KBAVHP-3X6', 'card', 500, 0, '2019-11-30 09:25:09', 0),
(20, '46MD-KBAVHP-3X6', 'paytm', 500, 0, '2019-11-30 09:25:09', 0),
(21, '46MD-KBAVHP-3X6', 'phonepe', 500, 0, '2019-11-30 09:25:09', 0),
(22, '594N-M7N65G-DWA', 'cash', 1573, 0, '2019-11-30 13:15:03', 0),
(23, 'ERGV-3RC3RN-3TL', 'cash', 521, 0, '2019-11-30 16:56:20', 0),
(24, 'JZ60-I02AV7-1D4', 'cash', 392, 0, '2019-11-30 20:00:03', 0),
(25, '3V5N-RWVXKY-3QZ', 'cash', 102, 0, '2019-12-01 09:23:15', 0),
(26, '3V5N-RWVXKY-3QZ', 'card', 100, 0, '2019-12-01 09:23:15', 0),
(27, '3V5N-RWVXKY-3QZ', 'paytm', 200, 0, '2019-12-01 09:23:15', 0),
(28, 'UW6E-3AVS5W-TB5', 'cash', 1145, 0, '2019-12-02 20:50:44', 0),
(29, '9VGB-WT03IO-BJ8', 'cash', 261, 0, '2019-12-03 13:25:27', 0),
(30, '4UME-ABYGCY-SL1', 'cash', 339, 0, '2019-12-03 13:32:10', 0),
(31, 'PT70-ZVSPY1-GOG', 'paytm', 1016, 0, '2019-12-03 13:38:54', 0),
(32, 'BDO1-7ZCC43-UKG', 'bhim', 2035, 0, '2019-12-03 13:42:17', 0),
(33, 'LOG4-A5VREI-3XW', 'member', 2186, 0, '2019-12-03 13:43:35', 0),
(34, 'M2TA-T1S2FZ-RPX', 'bhim', 339, 0, '2019-12-03 13:51:17', 0),
(35, 'O90X-0P13LD-0AI', 'bhim', 469, 0, '2019-12-03 21:27:06', 0),
(36, '0TS3-90DC3H-VUJ', 'cash', 1354, 0, '2019-12-03 23:23:32', 0),
(37, 'HKFF-CBO2T7-2TG', 'cash', 1146, 0, '2019-12-03 23:29:01', 0),
(38, 'Z2NB-UXA31M-AZW', 'cash', 500, 0, '2019-12-03 23:56:36', 0),
(39, 'Z2NB-UXA31M-AZW', 'card', 152, 0, '2019-12-03 23:56:36', 0),
(40, 'N3FW-RCX46L-0NJ', 'cash', 235, 0, '2019-12-14 14:17:40', 0),
(41, 'KTXO-WSN4XU-XIO', 'cash', 705, 0, '2019-12-14 14:21:43', 0),
(42, '4MBN-EUZJTY-20J', 'cash', 886, 0, '2019-12-14 14:25:08', 0),
(43, '60X6-9GR1WY-VAQ', 'cash', 226, 0, '2019-12-14 18:57:28', 0),
(44, 'LX35-LKODPI-PLO', 'cash', 321, 0, '2019-12-14 19:27:34', 0),
(45, 'E0ZD-2TPQ0Q-51S', 'cash', 434, 0, '2019-12-14 19:29:37', 0),
(46, '2U9K-0RHOVI-DH1', 'cash', 226, 0, '2019-12-14 20:00:07', 0),
(47, '718Q-HEG0OC-9JR', 'cash', 541, 0, '2019-12-15 07:30:59', 0),
(48, 'NH6N-VT6QXH-8BD', 'cash', 551, 0, '2019-12-15 07:35:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

DROP TABLE IF EXISTS `payment_mode`;
CREATE TABLE IF NOT EXISTS `payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(20) NOT NULL,
  `slug` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `mode`, `slug`, `active`, `deleted`) VALUES
(1, 'CASH', 'cash', 1, 0),
(2, 'CARD', 'card', 1, 0),
(3, 'PAYTM', 'paytm', 1, 0),
(4, 'Phone PE', 'phonepe', 1, 0),
(5, 'BHIM', 'bhim', 1, 0),
(6, 'MEMBER', 'member', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
CREATE TABLE IF NOT EXISTS `product_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `offer` float NOT NULL,
  `date` datetime NOT NULL,
  `tax` varchar(55) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `discountable` enum('0','1') NOT NULL DEFAULT '0',
  `quantity` int(5) NOT NULL DEFAULT '-1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `category_id`, `name`, `slug`, `price`, `offer`, `date`, `tax`, `active`, `discountable`, `quantity`, `deleted`, `discount`, `sale`) VALUES
(1, 1, 'CHEESE & CORN REG', 'cheesecornreg', 125, 120, '2019-12-14 19:42:57', '1 2', 1, '1', 0, 0, 1, 5),
(2, 1, 'CHEESE & CORN MED', 'cheesecornmed', 199, 0, '2019-10-01 19:10:38', '1 2', 1, '0', 0, 0, 0, 3),
(3, 1, 'CHEESE & CORN LAR', 'cheesecornlar', 300, 0, '2019-10-01 19:11:09', '1 2', 1, '0', 0, 0, 0, 0),
(4, 1, 'DOUBLE CHEESE MARGHERITA REG', 'doublecheesemargheritareg', 125, 0, '2019-10-01 19:14:06', '1 2', 1, '1', 0, 0, 1, 1),
(5, 1, 'DOUBLE CHEESE MARGHERITA MED', 'doublecheesemargheritamed', 199, 0, '2019-10-01 19:13:03', '1 2', 1, '0', 0, 0, 0, 0),
(6, 1, 'DOUBLE CHEESE MARGHERITA LAR', 'doublecheesemargheritalar', 300, 0, '2019-10-01 19:14:18', '1 2', 1, '0', 0, 0, 0, 0),
(7, 4, 'ONION SINGLE', 'onionsingle', 70, 0, '2019-10-01 19:15:14', '1 2', 1, '0', 0, 0, 0, 0),
(8, 4, 'CAPSICUM SINGLE', 'capsicumsingle', 70, 0, '2019-10-01 19:16:27', '1 2', 1, '0', 0, 0, 0, 0),
(9, 4, 'TOMATO SINGLE', 'tomatosingle', 70, 0, '2019-10-01 19:17:11', '1 2', 1, '0', 0, 0, 0, 0),
(10, 4, 'GOLDEN CORN SINGLE', 'goldencornsingle', 70, 0, '2019-10-01 19:17:36', '1 2', 1, '0', 0, 0, 0, 0),
(11, 4, 'ALL 4 SET SINGLE', 'all4setsingle', 260, 0, '2019-10-01 19:18:12', '1 2', 1, '0', 0, 0, 0, 0),
(12, 2, 'FARMHOUSE REG', 'farmhousereg', 175, 0, '2019-10-01 19:18:43', '1 2', 1, '0', 0, 0, 0, 0),
(13, 2, 'FARMHOUSE MED', 'farmhousemed', 250, 0, '2019-10-01 19:19:50', '1 2', 1, '0', 0, 0, 0, 0),
(14, 2, 'FARMHOUSE LAR', 'farmhouselar', 350, 0, '2019-10-01 19:20:18', '1 2', 1, '0', 0, 0, 0, 0),
(15, 3, 'PAPPY PANEER REG', 'pappypaneerreg', 210, 0, '2019-10-01 19:20:38', '1 2', 1, '0', 0, 0, 0, 0),
(16, 3, 'PAPPY PANEER MED', 'pappypaneermed', 310, 0, '2019-10-01 19:22:14', '1 2', 1, '0', 0, 0, 0, 0),
(17, 3, 'PAPPY PANEER LAR', 'pappypaneerlar', 460, 0, '2019-10-01 19:22:37', '1 2', 1, '0', 0, 0, 0, 0),
(18, 1, 'FRESH VEGGIE REG', 'freshveggiereg', 125, 0, '2019-12-01 17:26:45', '1 2', 1, '1', 0, 0, 0, 0),
(19, 1, 'FRIESH VEGGIE MED', 'freshveggiemed', 199, 0, '2019-12-01 17:28:15', '1 2', 1, '1', 0, 0, 0, 0),
(20, 1, 'FRIESH VEGGIE LAR', 'freshveggielar', 300, 0, '2019-12-01 17:29:07', '1 2', 1, '', 0, 0, 0, 0),
(21, 1, 'PANEER & ONION REG', 'paneeronionreg', 125, 0, '2019-12-01 17:31:45', '1 2', 1, '', 0, 0, 0, 0),
(22, 1, 'PANEER & ONION MED', 'paneeronionmed', 199, 0, '2019-12-01 17:31:10', '1 2', 1, '', 0, 0, 0, 0),
(23, 1, 'PANEER & ONION LAR', 'paneeronionlar', 300, 0, '2019-12-01 17:38:44', '1 2', 1, '', 0, 0, 0, 0),
(24, 4, 'ONION & PANEER', 'onionpaneer', 119, 0, '2019-12-01 17:36:01', '1 2', 1, '', 0, 0, 0, 0),
(25, 4, 'CAPSICUM & ONION', 'capsicumonion', 119, 0, '2019-12-01 17:36:23', '1 2', 1, '', 0, 0, 0, 0),
(26, 4, 'TOMATO & GOLDEN CORN', 'tomatogoldencorn', 119, 0, '2019-12-01 17:36:48', '1 2', 1, '', 0, 0, 0, 0),
(27, 4, 'PINEAPPLE & JALAPENO', 'pineapplejalapeno', 119, 0, '2019-12-01 17:37:21', '1 2', 1, '', 0, 0, 0, 0),
(28, 4, 'ALL 4 DOUBLES', 'all4doubles', 440, 0, '2019-12-01 17:37:59', '1 2', 1, '', 0, 0, 0, 0),
(29, 1, 'SPICY DOUBLE TANGO REG', 'spicydoubletangoreg', 125, 0, '2019-12-01 17:44:35', '1 2', 1, '', 0, 0, 0, 0),
(30, 1, 'SPICY DOUBLE TANGO MED', 'spicydoubletangomed', 199, 0, '2019-12-01 17:45:23', '1 2', 1, '', 0, 0, 0, 0),
(31, 1, 'SPICY DOUBLE TANGO LAR', 'spicydoubletangolar', 300, 0, '2019-12-01 17:45:45', '1 2', 1, '', 0, 0, 0, 0),
(32, 2, 'COUNTRY SPECIAL REG', 'countryspecialreg', 175, 0, '2019-12-01 17:46:10', '1 2', 1, '', 0, 0, 0, 0),
(33, 2, 'COUNTRY SPECIAL MED', 'countryspecilemed', 250, 0, '2019-12-01 18:07:46', '1 2', 1, '', 0, 0, 0, 0),
(34, 2, 'COUNTRY SPECIAL LAR', 'countryspeciallar', 350, 0, '2019-12-01 18:02:14', '1 2', 1, '', 0, 0, 0, 0),
(35, 2, 'MIX GREEN WAVE REG', 'mixgreenwavereg', 175, 0, '2019-12-01 18:08:21', '1 2', 1, '', 0, 0, 0, 0),
(36, 2, 'MIX GREEN WAVE MED', 'mixgreenwavemed', 250, 0, '2019-12-01 18:11:24', '1 2', 1, '', 0, 0, 0, 0),
(37, 2, 'MIX GREEN WAVE LAR', 'mixgreenwavelar', 350, 0, '2019-12-01 19:41:03', '1 2', 1, '', 0, 0, 0, 0),
(38, 2, 'PANEER MAKHANI REG', 'paneermakhanireg', 175, 0, '2019-12-01 18:15:11', '1 2', 1, '', 0, 0, 0, 0),
(39, 2, 'PANEER MAKHANI MED', 'paneermakhanimed', 250, 0, '2019-12-01 18:18:15', '1 2', 1, '', 0, 0, 0, 0),
(40, 2, 'PANEER MAKHANI LAR', 'paneermakhanilar', 350, 0, '2019-12-01 18:19:47', '1 2', 1, '', 0, 0, 0, 0),
(41, 2, 'HAWAIIAN PIZZA REG', 'hawaiianpizzareg', 175, 0, '2019-12-01 18:21:29', '1 2', 1, '', 0, 0, 0, 0),
(42, 2, 'HAWAIIN PIZZA MED', 'hawaiianpizzamed', 250, 0, '2019-12-01 18:30:29', '1 2', 1, '', 0, 0, 0, 0),
(43, 2, 'HAWAIIN PIZZA LAR', 'hawaiinpizzalar', 350, 0, '2019-12-01 18:31:11', '1 2', 1, '', 0, 0, 0, 0),
(44, 2, 'KIDS DELIGT REG', 'kidsdelightreg', 175, 0, '2019-12-01 18:37:35', '1 2', 1, '', 0, 0, 0, 0),
(45, 2, 'KIDS DELIGHT MED', 'kidsdelightmed', 250, 0, '2019-12-01 18:39:00', '1 2', 1, '', 0, 0, 0, 0),
(46, 2, 'KIDS DELIGHT LAR', 'kidsdelightlar', 350, 0, '2019-12-01 18:40:59', '1 2', 1, '', 0, 0, 0, 0),
(47, 2, 'CLASSIC VEG REG', 'classicvegreg', 175, 0, '2019-12-01 18:42:19', '1 2', 1, '', 0, 0, 0, 0),
(48, 2, 'CLASSIC VEG MED', 'classicvegmed', 250, 0, '2019-12-01 18:45:10', '1 2', 1, '', 0, 0, 0, 0),
(49, 2, 'CLASSIC VEG LAR', 'classicveglar', 350, 0, '2019-12-01 18:46:09', '1 2', 1, '', 0, 0, 0, 0),
(50, 2, 'CHILLI PANEER PIZZA REG', 'chillipaneerpizzareg', 175, 0, '2019-12-01 18:47:43', '1 2', 1, '', 0, 0, 0, 0),
(51, 2, 'CHILLI PANEER PIZZA  MED', 'chillipaneerpizzamed', 250, 0, '2019-12-01 18:49:41', '1 2', 1, '', 0, 0, 0, 0),
(52, 2, 'CHILLI PANEER PIZZA LAR', 'chillipaneerpizzalar', 350, 0, '2019-12-01 18:55:51', '1 2', 1, '', 0, 0, 0, 0),
(53, 2, 'TANDOORI PIZZA REG', 'tadooripizzareg', 175, 0, '2019-12-01 18:58:00', '1 2', 1, '', 0, 0, 0, 0),
(54, 2, 'TANDOORI PIZZA MED', 'tandooripizzamed', 250, 0, '2019-12-01 19:01:23', '1 2', 1, '', 0, 0, 0, 0),
(55, 2, 'TANDOORI PIZZA LAR', 'tandooripizzalar', 350, 0, '2019-12-01 19:03:06', '1 2', 1, '', 0, 0, 0, 0),
(56, 3, 'PAPPY PANEER REG', 'pappypaneerreg', 210, 0, '2019-12-01 19:04:51', '1 2', 1, '', 0, 0, 0, 0),
(57, 3, 'PAPPY PANEER MED', 'pappypaneermed', 310, 0, '2019-12-01 19:07:49', '1 2', 1, '', 0, 0, 0, 0),
(58, 3, 'PAPPY PANEER LAR', 'pappypaneerlar', 460, 0, '2019-12-01 19:08:57', '1 2', 1, '', 0, 0, 0, 0),
(59, 3, 'VEGGIE PARADISE REG', 'veggieparadisereg', 210, 0, '2019-12-01 19:11:08', '1 2', 1, '', 0, 0, 0, 0),
(60, 3, 'VEGGIE PARADISE MED', 'veggieparadisemed', 310, 0, '2019-12-01 19:29:11', '1 2', 1, '', 0, 0, 0, 0),
(61, 3, 'VEGGIE PARADISE LAR', 'veggieparadiselar', 460, 0, '2019-12-01 19:37:20', '1 2', 1, '', 0, 0, 0, 0),
(62, 3, '5 PEPPER PIZZA REG', '5pepperpizzareg', 210, 0, '2019-12-01 19:41:37', '1 2', 1, '', 0, 0, 0, 0),
(63, 3, '5 PEPPER PIZZA MED', '5pepperpizzamed', 310, 0, '2019-12-01 19:43:28', '1 2', 1, '', 0, 0, 0, 0),
(64, 3, '5 PEPPER PIZZA LAR', '5pepperpizzalar', 460, 0, '2019-12-01 19:45:19', '1 2', 1, '', 0, 0, 0, 0),
(65, 3, 'DELUXE VEGGIE REG', 'deluxeveggiereg', 210, 0, '2019-12-01 19:46:45', '1 2', 1, '', 0, 0, 0, 0),
(66, 3, 'DELUXE VEGGIE MED', 'deluxeveggiemed', 310, 0, '2019-12-01 19:48:45', '1 2', 1, '', 0, 0, 0, 0),
(67, 3, 'DELUXE VEGGIE LAR', 'deluxeveggielar', 460, 0, '2019-12-01 19:50:16', '1 2', 1, '', 0, 0, 0, 0),
(68, 3, 'ROMAN VEG REG', 'romanvegreg', 210, 0, '2019-12-01 19:51:26', '1 2', 1, '', 0, 0, 0, 0),
(69, 3, 'ROMAN VEG MED', 'romanvegmed', 310, 0, '2019-12-01 19:53:22', '1 2', 1, '', 0, 0, 0, 0),
(70, 3, 'ROMAN VEG  LAR', 'romanveglar', 460, 0, '2019-12-01 19:54:53', '1 2', 1, '', 0, 0, 0, 0),
(71, 3, 'PANEER PERI PERI VEG REG', 'paneerperiperivegreg', 210, 0, '2019-12-01 19:55:48', '1 2', 1, '', 0, 0, 0, 0),
(72, 3, 'PANEER PERI PERI VEG MED', 'paneerperiperivegmed', 310, 0, '2019-12-01 19:58:06', '1 2', 1, '', 0, 0, 0, 0),
(73, 3, 'PANEER PERI PERI VEG LAR', 'paneerperiperiveglar', 460, 0, '2019-12-01 19:59:34', '1 2', 1, '', 0, 0, 0, 0),
(74, 3, 'PERI PERI VEG REG', 'periperivegreg', 210, 0, '2019-12-01 20:01:41', '1 2', 1, '', 0, 0, 0, 0),
(75, 3, 'PERI PERI VEG MED', 'periperivegmed', 310, 0, '2019-12-01 20:03:23', '1 2', 1, '', 0, 0, 0, 0),
(76, 3, 'PERI PERI VEG LAR', 'periperiveglar', 460, 0, '2019-12-01 20:04:48', '1 2', 1, '', 0, 0, 0, 0),
(77, 3, 'SOYA MASALA REG', 'soyamasalareg', 210, 0, '2019-12-01 20:05:54', '1 2', 1, '', 0, 0, 0, 0),
(78, 3, 'SOYA MASALA MED', 'soyamasalamed', 310, 0, '2019-12-01 20:07:14', '1 2', 1, '', 0, 0, 0, 0),
(79, 3, 'SOYA MASALA LAR', 'soyamasalalar', 460, 0, '2019-12-01 20:09:05', '1 2', 1, '', 0, 0, 0, 0),
(80, 3, 'VEG EXOTICA REG', 'vegexoticareg', 210, 0, '2019-12-01 20:10:24', '1 2', 1, '', 0, 0, 0, 0),
(81, 3, 'VEG EXOTICA MED', 'vegexoticamed', 310, 0, '2019-12-01 20:15:32', '1 2', 1, '', 0, 0, 0, 0),
(82, 3, 'VEG EXOTICA LAR', 'vegexoticalar', 460, 0, '2019-12-01 20:15:48', '1 2', 1, '', 0, 0, 0, 0),
(83, 4, 'CHEESE PIZZA', 'cheesepizza', 119, 0, '2019-12-01 20:31:12', '1 2', 1, '', 0, 0, 0, 0),
(84, 4, 'VEG LOADED', 'vegloaded', 119, 0, '2019-12-01 20:35:35', '1 2', 1, '', 0, 0, 0, 0),
(85, 4, 'VEG HERBAX', 'vegherbax', 119, 0, '2019-12-01 20:33:27', '1 2', 1, '', 0, 0, 0, 0),
(86, 4, 'VEG SPICY', 'vegspicy', 119, 0, '2019-12-01 20:36:11', '1 2', 1, '', 0, 0, 0, 0),
(87, 5, 'VEG EXTRAVAGANZA REG', 'vegextravaganzareg', 250, 0, '2019-12-01 20:37:11', '1 2', 1, '', 0, 0, 0, 0),
(88, 5, 'VEG EXTRAVAGANZA MED', 'vegextravaganzamed', 385, 0, '2019-12-01 20:40:45', '1 2', 1, '', 0, 0, 0, 0),
(89, 5, 'VEG EXTRAVAGANZA LAR', 'vegextravaganzalar', 650, 0, '2019-12-01 20:43:22', '1 2', 1, '', 0, 0, 0, 0),
(90, 5, 'CLOUD 9 REG', 'cloud9ninereg', 250, 0, '2019-12-02 13:42:24', '1 2', 1, '', 0, 0, 0, 0),
(91, 5, 'CLOUD 9 MED', 'cloud9ninemed`', 385, 0, '2019-12-01 21:35:37', '1 2', 1, '', 0, 0, 0, 0),
(92, 5, 'CLOUD 9 LAR', 'cloud9ninelar', 650, 0, '2019-12-02 13:43:12', '1 2', 1, '', 0, 0, 0, 0),
(93, 5, '5 STAR PIZZA REG', '5starpizzareg', 250, 0, '2019-12-01 20:57:15', '1 2', 1, '', 0, 0, 0, 0),
(94, 5, '5 STAR PIZZA MED', '5starpizzamed', 385, 0, '2019-12-02 13:41:30', '1 2', 1, '', 0, 0, 0, 0),
(95, 5, '5 STAR PIZZA LAR', '5starpizzalar', 650, 0, '2019-12-01 20:54:21', '1 2', 1, '', 0, 0, 0, 0),
(96, 5, 'CHEFS VEG WONDER REG', 'chefsvegwonderreg', 250, 0, '2019-12-01 21:59:15', '1 2', 1, '', 0, 0, 0, 0),
(97, 5, 'CHEFS VEG WONDER MED', 'chefsvegwondermed', 385, 0, '2019-12-01 21:58:34', '1 2', 1, '', 0, 0, 0, 0),
(98, 4, 'CHEFS VEG WONDER LAR', 'chefsvegwonderlar', 650, 0, '2019-12-01 21:58:03', '1 2', 1, '', 0, 0, 0, 0),
(99, 5, 'VEG SUPREME REG', 'vegsupremereg', 250, 0, '2019-12-01 21:57:33', '1 2', 1, '', 0, 0, 0, 0),
(100, 5, 'VEG SUPREME MED', 'vegsuprememed', 385, 0, '2019-12-01 21:57:00', '1 2', 1, '', 0, 0, 0, 0),
(101, 5, 'VEG SUPREME LAR', 'vegsupremelar', 650, 0, '2019-12-01 21:56:23', '1 2', 1, '', 0, 0, 0, 0),
(102, 5, 'SCHEZWAN PANEER REG', 'schzwanpaneerreg', 250, 0, '2019-12-01 22:05:06', '1 2', 1, '', 0, 0, 0, 0),
(103, 5, 'SCHEZWAN PANEER MED', 'schezwanpaneermed', 385, 0, '2019-12-01 22:04:39', '1 2', 1, '', 0, 0, 0, 0),
(104, 5, 'SCHEZWAN PANEER LAR', 'schezwanpaneerlar', 650, 0, '2019-12-01 22:05:17', '1 2', 1, '', 0, 0, 0, 0),
(105, 5, 'BARBECUE VEG REG', 'barbecuevegreg', 250, 0, '2019-12-01 22:06:29', '1 2', 1, '', 0, 0, 0, 0),
(106, 5, 'BARBECUE VEG MED', 'barbecuevegmed', 385, 0, '2019-12-01 22:10:48', '1 2', 1, '', 0, 0, 0, 0),
(107, 5, 'BARBECUE VEG LAR', 'barbecueveglar', 650, 0, '2019-12-01 22:09:24', '1 2', 1, '', 0, 0, 0, 0),
(108, 5, 'PANEER SOYA REG', 'paneersoyareg', 250, 0, '2019-12-01 22:11:13', '1 2', 1, '', 0, 0, 0, 0),
(109, 5, 'PANEER SOYA MED', 'paneersoyamed', 385, 0, '2019-12-01 22:14:32', '1 2', 1, '', 0, 0, 0, 0),
(110, 5, 'PANEER SOYA LAR', 'paneersoyalar', 650, 0, '2019-12-01 22:13:05', '1 2', 1, '', 0, 0, 0, 0),
(111, 6, 'VEG PARCEL', 'vegparcel', 35, 0, '2019-12-01 22:14:48', '1 2', 1, '', 0, 0, 0, 0),
(112, 6, 'FRENCH FRIES', 'frenchfries', 45, 0, '2019-12-01 22:17:11', '1 2', 1, '', 0, 0, 0, 0),
(113, 6, 'CREAMY GARLIC BRED STICK', 'creamygarlicbredstick', 59, 0, '2019-12-01 22:18:48', '1 2', 1, '', 0, 0, 0, 0),
(114, 6, 'PASTA ITALIANO WHITE', 'pastaintalinowhite', 89, 0, '2019-12-01 22:22:55', '1 2', 1, '', 0, 0, 0, 0),
(115, 6, 'PASTA ITALIANO RED', 'pastaitalianored', 99, 0, '2019-12-01 22:25:21', '1 2', 1, '', 0, 0, 0, 0),
(116, 6, 'STUFF GARLIC BRED', 'stuffgarlicbred', 99, 0, '2019-12-01 22:27:15', '1 2', 1, '', 0, 0, 0, 0),
(117, 6, 'CALZONE POCKETS', 'clozonepockets', 99, 0, '2019-12-01 22:31:47', '1 2', 1, '', 0, 0, 0, 0),
(118, 7, 'CHEESE BURGER', 'cheeseburger', 49, 0, '2019-12-01 22:43:19', '1 2', 1, '', 0, 0, 0, 0),
(119, 7, 'PANEER BURGER', 'paneerburger', 59, 0, '2019-12-01 22:42:46', '1 2', 1, '', 0, 0, 0, 0),
(120, 7, 'ALOO PATTY BURGER', 'aloopattyburger', 59, 0, '2019-12-01 22:41:54', '1 2', 1, '', 0, 0, 0, 0),
(121, 7, 'SPICY VEG BURGER', 'spicyvegburger', 69, 0, '2019-12-01 22:36:48', '1 2', 1, '', 0, 0, 0, 0),
(122, 7, 'MEXICAN BURGER', 'mexicanburger', 69, 0, '2019-12-01 22:43:41', '1 2', 1, '', 0, 0, 0, 0),
(123, 7, 'VEG CHILLI CHEESE BURGER', 'vegchillicheeseburger', 69, 0, '2019-12-01 22:46:04', '1 2', 1, '', 0, 0, 0, 0),
(124, 8, 'BLACK COFFEE', 'blackcoffee', 29, 0, '2019-12-01 22:49:03', '1 2', 1, '', 0, 0, 0, 0),
(125, 8, 'COFFEE', 'coffee', 39, 0, '2019-12-01 22:50:31', '1 2', 1, '', 0, 0, 0, 0),
(126, 8, 'GOLD COFFEE', 'goldcoffee', 69, 0, '2019-12-01 22:51:22', '1 2', 1, '', 0, 0, 0, 0),
(127, 9, 'SWEET LIME SODA', 'sweetlimesoda', 29, 0, '2019-12-01 22:53:14', '1 2', 1, '', 0, 0, 0, 0),
(128, 7, 'GREEN APPLE MOJITO', 'greenapplemojito', 39, 0, '2019-12-01 22:54:54', '1 2', 1, '', 0, 0, 0, 0),
(129, 9, 'BLUE CURACAO MOJITO', 'bluecuracaomojito', 39, 0, '2019-12-01 22:56:44', '1 2', 1, '', 0, 0, 0, 0),
(130, 9, 'PAAN  MOJITO', 'paanmojito', 39, 0, '2019-12-01 22:58:29', '1 2', 1, '', 0, 0, 0, 0),
(131, 9, 'PINA COLADA MOJITO', 'pinacoladamojito', 39, 0, '2019-12-01 22:59:58', '1 2', 1, '', 0, 0, 0, 0),
(132, 9, 'ICE TEA', 'icetea', 39, 0, '2019-12-01 23:01:50', '1 2', 1, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rst_info`
--

DROP TABLE IF EXISTS `rst_info`;
CREATE TABLE IF NOT EXISTS `rst_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `sms_name` varchar(100) NOT NULL,
  `reCaptcha` tinyint(1) NOT NULL DEFAULT '1',
  `reCaptchaSiteKey` varchar(255) NOT NULL,
  `reCaptchaSecretKey` varchar(255) NOT NULL,
  `analyticsTrackerId` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rst_info`
--

INSERT INTO `rst_info` (`id`, `name`, `logo`, `favicon`, `address`, `contact`, `sms_name`, `reCaptcha`, `reCaptchaSiteKey`, `reCaptchaSecretKey`, `analyticsTrackerId`) VALUES
(1, 'RST mgmt', 'http://pizzapoint.ga/img/logo.jpg', 'http://pizzapoint.ga/img/favicon.ico', 'Deoria,\r\nUttar Pradesh,\r\nPin 277001', 'me@ravikantsingh.tk', 'XYZ', 1, '6Lfe9aIUAAAAAFfEwT9rsQlmDgNN60O39gwGfKTI', '6Lfe9aIUAAAAAEc7Yvp3de8nsCh60gG6WkdA9NTg', 'UA-139967074-1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyname` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `keyname`, `value`) VALUES
(1, 'table_mode', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tax_details`
--

DROP TABLE IF EXISTS `tax_details`;
CREATE TABLE IF NOT EXISTS `tax_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `rate` float NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_details`
--

INSERT INTO `tax_details` (`id`, `name`, `slug`, `rate`, `active`, `date`, `update_date`, `deleted`) VALUES
(1, 'sgst', 'cash-1', 2, 1, '2019-09-21 12:03:32', '2019-10-28 20:35:11', 0),
(2, 'CGST', 'cgst', 2.5, 1, '2019-09-24 00:00:00', '2019-10-01 19:06:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `name`, `mobile`, `username`, `password`, `role`, `status`, `date`, `update_date`) VALUES
(1, 'Alpha Delta', '9876543211', 'admin', 'c1e4273fbb7883dacdb72764f395cdc3', 'admin', 1, '2019-09-21 12:03:32', '2019-10-01 10:57:16'),
(2, 'Beeta Gamma', '9695090900', 'beeta', 'c1e4273fbb7883dacdb72764f395cdc3', 'pos', 1, '2019-09-22 07:47:00', '2019-10-01 14:49:21'),
(5, 'Beeta Gamma', '9695090900', 'cook', 'c1e4273fbb7883dacdb72764f395cdc3', 'cook', 1, '2019-09-22 07:47:00', '2019-10-01 14:49:21'),
(6, 'kappa Gamma', '9695090900', 'display', 'c1e4273fbb7883dacdb72764f395cdc3', 'display', 1, '2019-09-22 07:47:00', '2019-10-01 14:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `balance` double NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `date` datetime NOT NULL,
  `exp_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
