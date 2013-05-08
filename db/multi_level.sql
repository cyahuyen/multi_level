-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2013 at 02:50 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `multi_level`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
(1, 1, 0.0000),
(2, 2, 1.0000),
(9, 6, 0.0000);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text,
  `serialized` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=158 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `group`, `code`, `key`, `value`, `serialized`) VALUES
(65, 'config', 'transaction_fees', 'open_fee', '25', 0),
(66, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
(67, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
(68, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
(69, 'config', 'transaction_fees', 'group', 'config', 0),
(126, 'payment', 'paypal', 'business', 'thuhuy_1317911597_per@gmail.com', 0),
(127, 'payment', 'paypal', 'item_name', 'CYA Game payment', 0),
(128, 'payment', 'paypal', 'currency_code', 'USD', 0),
(129, 'payment', 'paypal', 'sandbox', '1', 0),
(130, 'payment', 'paypal', 'active', '1', 0),
(140, 'config', 'timeconfig', 'time_format', '30', 0),
(145, 'config', 'referral', 'referring_percentage', '1', 0),
(146, 'config', 'referral', 'interest_race', '1', 0),
(147, 'config', 'referral', 'gold_fees', '2', 0),
(148, 'config', 'referral', 'silver_fees', '1', 0),
(149, 'config', 'emails', 'protocol', 'smtp', 0),
(150, 'config', 'emails', 'mail_parameter', '', 0),
(151, 'config', 'emails', 'smtp_host', 'ssl://smtp.googlemail.com', 0),
(152, 'config', 'emails', 'smtp_user', 'rongandat@gmail.com', 0),
(153, 'config', 'emails', 'smtp_pass', 'anhyeuem123', 0),
(154, 'config', 'emails', 'smtp_port', '465', 0),
(155, 'config', 'emails', 'smtp_timeout', '30', 0),
(156, 'config', 'emails', 'email_admin', 'admin@gmail.com', 0),
(157, 'config', 'emails', 'group', 'config', 0);

-- --------------------------------------------------------

--
-- Table structure for table `multilevel_sessions`
--

CREATE TABLE IF NOT EXISTS `multilevel_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multilevel_sessions`
--

INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('038dd317b0770261ce20ea16bb98d20c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917976, ''),
('04ca128bf5868195316d973f135672cb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367919874, ''),
('05f379a7c27e85b50d2e6ce41fed6f32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920507, ''),
('07d43b8c9ef50f6b65ce0fac75ace0d8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367923358, 'a:1:{s:4:"user";a:16:{s:7:"user_id";s:1:"2";s:8:"fullname";s:6:"user 1";s:8:"password";s:32:"e10adc3949ba59abbe56e057f20f883e";s:7:"address";s:0:"";s:5:"phone";s:1:"0";s:5:"email";s:22:"thuhuyen1142@gmail.com";s:3:"fax";s:1:"0";s:8:"birthday";s:0:"";s:9:"referring";s:1:"0";s:8:"usertype";s:1:"1";s:6:"status";s:1:"1";s:23:"forgotten_password_code";N;s:10:"created_on";s:19:"2013-05-07 17:05:54";s:10:"permission";N;s:17:"transaction_start";N;s:18:"transaction_finish";N;}}'),
('17b6c021a667a995c9c9b7c0424d9031', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917884, ''),
('1994c69d871b201b26941fe3f8051b05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917981, ''),
('21c7b371385bec8a32c4ec1c63f071de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917429, ''),
('223723bb461e2b4ca93b766be54c52b8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920460, ''),
('2247fb1f21db90a8a54145112e140ab3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367923057, ''),
('24c3b1921da76e8945f15da7d16b5ccd', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367922307, ''),
('297c5b933bb3794214651eb83cb5ce78', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920030, ''),
('29accd109e19f5f9982361489e8491fe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920447, ''),
('2adcae2dac958f4d98f353e7f8c07df5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920056, ''),
('350b4cd1ee0c8c004e66ef6590104d19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917881, ''),
('37d83f2ad63ff87ca434c4615057d5be', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367978874, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:16:{s:7:"user_id";s:1:"6";s:8:"fullname";s:6:"user 2";s:8:"password";s:32:"e10adc3949ba59abbe56e057f20f883e";s:7:"address";s:0:"";s:5:"phone";s:1:"0";s:5:"email";s:20:"thuhuyen.k@gmail.com";s:3:"fax";s:1:"0";s:8:"birthday";s:0:"";s:9:"referring";s:1:"2";s:8:"usertype";s:1:"0";s:6:"status";s:1:"1";s:23:"forgotten_password_code";N;s:10:"created_on";s:19:"2013-05-07 17:45:54";s:10:"permission";N;s:17:"transaction_start";N;s:18:"transaction_finish";N;}}'),
('3859d7b8643cdcd8e00f4202da935819', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917980, ''),
('397abbb8750dc000d670e38b42b7059b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917981, ''),
('438195b41b964fb5fd91981172306452', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:21.0) Gecko/20100101 Firefox/21.0', 1367922144, 'a:1:{s:4:"user";a:16:{s:7:"user_id";s:1:"1";s:8:"fullname";s:16:"nguyen thu huyen";s:8:"password";s:32:"e10adc3949ba59abbe56e057f20f883e";s:7:"address";N;s:5:"phone";N;s:5:"email";s:15:"admin@gmail.com";s:3:"fax";N;s:8:"birthday";N;s:9:"referring";s:1:"0";s:8:"usertype";s:1:"0";s:6:"status";s:1:"1";s:23:"forgotten_password_code";N;s:10:"created_on";N;s:10:"permission";s:13:"administrator";s:17:"transaction_start";N;s:18:"transaction_finish";N;}}'),
('45ef6d1664a1acef3bbf5adc93b1a329', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920029, ''),
('4924fbfc0ed4bba3ee372b88738e2d11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917872, ''),
('582684f08a0d1217d2d4f9371c37e4f2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367922824, ''),
('5a9a2d3e95c3f725bd0c6ed14a9ddbd4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917879, ''),
('62464c59e9a640f6245d448d7fb671bb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367918668, ''),
('74c863af85b8d3aa9bc8967ce8f6e1e7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917883, ''),
('83d1498ca289c05432e9978fd6a07a1a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917913, ''),
('8bcee81a5f7b5d92975dc6e9044f6b4e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367923605, ''),
('a6fca1e6d83bd48a2513c05ae244092b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367923499, ''),
('aa44d0e4a6a8c1445d5bca87928abaa8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920034, ''),
('ab5f221512de405cb2cf999992d74b2b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367922895, ''),
('ba6209c32a5d03d49befb45f06399fcf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367918795, ''),
('bab3832dbd3b9f730da37279e230884b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367921247, ''),
('bee58ca4a558dd0000e937376c624420', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367918000, ''),
('c65755aba77ba3e1f05f626679d1bab6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917853, ''),
('cb66efc13ff14684441b6272299432b2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367918041, ''),
('d5e59a02f915344bcfd9279f29153ba2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367917979, ''),
('d620c1e111eda834b508bb8b92e79ef8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920485, ''),
('dd54fa06862c9f942c5f3d98d6f6eb42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920426, ''),
('f31892a876b7a36ffc5cf2249c0b038d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367921075, ''),
('f31bd1dfcc57aa44cc8d557c2d42932b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367922758, ''),
('fe94d8f9df44ef9cc38b44d84a0d73f4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1367920028, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `open_fees` double(10,4) DEFAULT NULL,
  `total_fees` double(10,4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `transaction_type` varchar(5) DEFAULT '+',
  `transaction_source` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `open_fees`, `total_fees`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_source`, `status`) VALUES
(1, 40, 25.0000, 225.0000, '2013-05-07 14:15:34', '2EF04233UR447472D', 'Completed', '+', 'paypal', 1),
(2, 10, NULL, 10.0000, '2013-05-07 14:15:44', NULL, 'Completed', '+', 'system', 0),
(6, 40, 0.0000, 100.0000, '2013-05-07 14:19:36', '2V924964HJ6515339', 'Completed', '+', 'paypal', 1),
(7, 41, 25.0000, 25.0000, '2013-05-07 15:37:48', '6FD65114U7464171S', 'Completed', '+', 'paypal', 1),
(8, 42, 25.0000, 25.0000, '2013-05-07 15:46:03', '4MC08012H3404961F', 'Completed', '+', 'paypal', 1),
(9, 43, 25.0000, 25.0000, '2013-05-07 15:50:11', '4MC08012H3404961F', 'Completed', '+', 'paypal', 1),
(10, 44, 25.0000, 25.0000, '2013-05-07 15:52:24', '4MC08012H3404961F', 'Completed', '+', 'paypal', 1),
(11, 9, NULL, 20.0000, '2013-05-07 15:52:35', NULL, 'Completed', '+', 'system', 0),
(12, 45, 25.0000, 25.0000, '2013-05-07 16:06:20', '4DE89983C1106743N', 'Completed', '+', 'paypal', 1),
(13, 9, NULL, 2.0000, '2013-05-07 16:06:31', NULL, 'Completed', '+', 'system', 0),
(14, 48, 25.0000, 25.0000, '2013-05-07 16:50:43', '94W16152V58029547', 'Completed', '+', 'paypal', 1),
(15, 3, 25.0000, 25.0000, '2013-05-07 17:05:54', '1TB417712Y2376307', 'Completed', '+', 'paypal', 1),
(16, 4, 25.0000, 25.0000, '2013-05-07 17:08:32', '42W447847Y785481X', 'Completed', '+', 'paypal', 1),
(17, 5, 25.0000, 25.0000, '2013-05-07 17:09:17', '42W447847Y785481X', 'Completed', '+', 'paypal', 1),
(18, 6, 25.0000, 25.0000, '2013-05-07 17:11:00', '3L9912643H777504A', 'Completed', '+', 'paypal', 1),
(19, 7, 25.0000, 25.0000, '2013-05-07 17:14:18', '3L9912643H777504A', 'Completed', '+', 'paypal', 1),
(20, 4, 25.0000, 25.0000, '2013-05-07 17:15:52', '1A170319DJ891874E', 'Completed', '+', 'paypal', 1),
(21, 3, 25.0000, 25.0000, '2013-05-07 17:21:07', '05A1662742621405M', 'Completed', '+', 'paypal', 1),
(22, 4, 25.0000, 25.0000, '2013-05-07 17:22:32', '05A1662742621405M', 'Completed', '+', 'paypal', 1),
(23, 5, 25.0000, 25.0000, '2013-05-07 17:24:17', '05A1662742621405M', 'Completed', '+', 'paypal', 1),
(24, 3, NULL, 1.0000, '2013-05-07 17:24:28', NULL, 'Completed', '+', 'system', 0),
(25, 3, 25.0000, 25.0000, '2013-05-07 17:33:25', '3WL62598YH2519412', 'Completed', '+', 'paypal', 1),
(26, 3, NULL, 1.0000, '2013-05-07 17:33:36', NULL, 'Completed', '+', 'system', 0),
(27, 4, 25.0000, 25.0000, '2013-05-07 17:43:30', '7P3289317P0368828', 'Completed', '+', 'paypal', 1),
(28, 5, 25.0000, 25.0000, '2013-05-07 17:43:34', '7P3289317P0368828', 'Completed', '+', 'paypal', 1),
(29, 2, NULL, 1.0000, '2013-05-07 17:43:41', NULL, 'Completed', '+', 'system', 0),
(30, 2, NULL, 1.0000, '2013-05-07 17:43:45', NULL, 'Completed', '+', 'system', 0),
(31, 6, 25.0000, 25.0000, '2013-05-07 17:45:54', '7C638580AY339563V', 'Completed', '+', 'paypal', 1),
(32, 2, NULL, 1.0000, '2013-05-07 17:46:05', NULL, 'Completed', '+', 'system', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) COLLATE utf16_bin NOT NULL,
  `password` varchar(150) COLLATE utf16_bin NOT NULL,
  `address` varchar(150) COLLATE utf16_bin DEFAULT NULL,
  `phone` int(12) DEFAULT NULL,
  `email` varchar(100) COLLATE utf16_bin NOT NULL,
  `fax` int(12) DEFAULT NULL,
  `birthday` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `referring` int(11) DEFAULT '0',
  `usertype` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `forgotten_password_code` varchar(255) COLLATE utf16_bin DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `permission` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `transaction_start` datetime DEFAULT NULL,
  `transaction_finish` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`, `permission`, `transaction_start`, `transaction_finish`) VALUES
(1, 'nguyen thu huyen', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'admin@gmail.com', NULL, NULL, 0, 0, 1, NULL, NULL, 'administrator', NULL, NULL),
(2, 'user 1', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thuhuyen1142@gmail.com', 0, '', 0, 1, 1, NULL, '2013-05-07 17:05:54', NULL, NULL, NULL),
(6, 'user 2', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thuhuyen.k@gmail.com', 0, '', 2, 0, 1, NULL, '2013-05-07 17:45:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) unsigned NOT NULL,
  `permission_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_permission`
--

CREATE TABLE IF NOT EXISTS `users_permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_permission`
--

INSERT INTO `users_permission` (`permission_id`, `name`, `description`) VALUES
(1, 'adminstrator', 'Supper Administrator'),
(2, 'moderator', 'Moderator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
