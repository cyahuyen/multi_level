-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-08 14:16:46
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table multi_level.balance
DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance: ~4 rows (approximately)
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 1, 275.0000),
	(2, 2, 32.0000),
	(9, 6, 0.0000),
	(10, 7, 200.0000);
/*!40000 ALTER TABLE `balance` ENABLE KEYS */;


-- Dumping structure for table multi_level.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text,
  `serialized` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.config: ~25 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `group`, `code`, `key`, `value`, `serialized`) VALUES
	(126, 'payment', 'paypal', 'business', 'thuhuy_1317911597_per@gmail.com', 0),
	(127, 'payment', 'paypal', 'item_name', 'CYA Game payment', 0),
	(128, 'payment', 'paypal', 'currency_code', 'USD', 0),
	(129, 'payment', 'paypal', 'sandbox', '1', 0),
	(130, 'payment', 'paypal', 'active', '1', 0),
	(140, 'config', 'timeconfig', 'time_format', '30', 0),
	(149, 'config', 'emails', 'protocol', 'smtp', 0),
	(150, 'config', 'emails', 'mail_parameter', '', 0),
	(151, 'config', 'emails', 'smtp_host', 'ssl://smtp.googlemail.com', 0),
	(152, 'config', 'emails', 'smtp_user', 'rongandat@gmail.com', 0),
	(153, 'config', 'emails', 'smtp_pass', 'anhyeuem123', 0),
	(154, 'config', 'emails', 'smtp_port', '465', 0),
	(155, 'config', 'emails', 'smtp_timeout', '30', 0),
	(156, 'config', 'emails', 'email_admin', 'admin@gmail.com', 0),
	(157, 'config', 'emails', 'group', 'config', 0),
	(158, 'config', 'referral', 'percentage_silver', '20', 0),
	(159, 'config', 'referral', 'percentage_gold', '10', 0),
	(160, 'config', 'referral', 'gold_fees', '2', 0),
	(161, 'config', 'referral', 'silver_fees', '1', 0),
	(162, 'config', 'transaction_fees', 'open_fee', '25', 0),
	(163, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
	(164, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
	(165, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
	(166, 'config', 'transaction_fees', 'max_enrolment_silver_amount', '80', 0),
	(167, 'config', 'transaction_fees', 'group', 'config', 0);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;


-- Dumping structure for table multi_level.multilevel_sessions
DROP TABLE IF EXISTS `multilevel_sessions`;
CREATE TABLE IF NOT EXISTS `multilevel_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.multilevel_sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('64a92269498f4ebaf2aa9c504ef4bb3e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0', 1367995366, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:16:{s:7:"user_id";s:1:"1";s:8:"fullname";s:16:"nguyen thu huyen";s:8:"password";s:32:"e10adc3949ba59abbe56e057f20f883e";s:7:"address";N;s:5:"phone";N;s:5:"email";s:15:"admin@gmail.com";s:3:"fax";N;s:8:"birthday";N;s:9:"referring";s:1:"0";s:8:"usertype";s:1:"0";s:6:"status";s:1:"1";s:23:"forgotten_password_code";N;s:10:"created_on";N;s:10:"permission";s:13:"administrator";s:17:"transaction_start";N;s:18:"transaction_finish";N;}}');
/*!40000 ALTER TABLE `multilevel_sessions` ENABLE KEYS */;


-- Dumping structure for table multi_level.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `fees` double(10,4) DEFAULT NULL,
  `total` double(10,4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `transaction_type` varchar(500) DEFAULT NULL,
  `transaction_text` varchar(5) DEFAULT '+',
  `transaction_source` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.transaction: ~33 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `user_id`, `fees`, `total`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_text`, `transaction_source`, `status`) VALUES
	(1, 40, 25.0000, 225.0000, '2013-05-07 14:15:34', '2EF04233UR447472D', 'Completed', '+', '+', 'paypal', 1),
	(2, 10, NULL, 10.0000, '2013-05-07 14:15:44', NULL, 'Completed', '+', '+', 'system', 0),
	(6, 40, 0.0000, 100.0000, '2013-05-07 14:19:36', '2V924964HJ6515339', 'Completed', '+', '+', 'paypal', 1),
	(7, 41, 25.0000, 25.0000, '2013-05-07 15:37:48', '6FD65114U7464171S', 'Completed', '+', '+', 'paypal', 1),
	(8, 42, 25.0000, 25.0000, '2013-05-07 15:46:03', '4MC08012H3404961F', 'Completed', '+', '+', 'paypal', 1),
	(9, 43, 25.0000, 25.0000, '2013-05-07 15:50:11', '4MC08012H3404961F', 'Completed', '+', '+', 'paypal', 1),
	(10, 44, 25.0000, 25.0000, '2013-05-07 15:52:24', '4MC08012H3404961F', 'Completed', '+', '+', 'paypal', 1),
	(11, 9, NULL, 20.0000, '2013-05-07 15:52:35', NULL, 'Completed', '+', '+', 'system', 0),
	(12, 45, 25.0000, 25.0000, '2013-05-07 16:06:20', '4DE89983C1106743N', 'Completed', '+', '+', 'paypal', 1),
	(13, 9, NULL, 2.0000, '2013-05-07 16:06:31', NULL, 'Completed', '+', '+', 'system', 0),
	(14, 48, 25.0000, 25.0000, '2013-05-07 16:50:43', '94W16152V58029547', 'Completed', '+', '+', 'paypal', 1),
	(15, 3, 25.0000, 25.0000, '2013-05-07 17:05:54', '1TB417712Y2376307', 'Completed', '+', '+', 'paypal', 1),
	(16, 4, 25.0000, 25.0000, '2013-05-07 17:08:32', '42W447847Y785481X', 'Completed', '+', '+', 'paypal', 1),
	(17, 5, 25.0000, 25.0000, '2013-05-07 17:09:17', '42W447847Y785481X', 'Completed', '+', '+', 'paypal', 1),
	(18, 6, 25.0000, 25.0000, '2013-05-07 17:11:00', '3L9912643H777504A', 'Completed', '+', '+', 'paypal', 1),
	(19, 7, 25.0000, 25.0000, '2013-05-07 17:14:18', '3L9912643H777504A', 'Completed', '+', '+', 'paypal', 1),
	(20, 4, 25.0000, 25.0000, '2013-05-07 17:15:52', '1A170319DJ891874E', 'Completed', '+', '+', 'paypal', 1),
	(21, 3, 25.0000, 25.0000, '2013-05-07 17:21:07', '05A1662742621405M', 'Completed', '+', '+', 'paypal', 1),
	(22, 4, 25.0000, 25.0000, '2013-05-07 17:22:32', '05A1662742621405M', 'Completed', '+', '+', 'paypal', 1),
	(23, 5, 25.0000, 25.0000, '2013-05-07 17:24:17', '05A1662742621405M', 'Completed', '+', '+', 'paypal', 1),
	(24, 3, NULL, 1.0000, '2013-05-07 17:24:28', NULL, 'Completed', '+', '+', 'system', 0),
	(25, 3, 25.0000, 25.0000, '2013-05-07 17:33:25', '3WL62598YH2519412', 'Completed', '+', '+', 'paypal', 1),
	(26, 3, NULL, 1.0000, '2013-05-07 17:33:36', NULL, 'Completed', '+', '+', 'system', 0),
	(27, 4, 25.0000, 25.0000, '2013-05-07 17:43:30', '7P3289317P0368828', 'Completed', '+', '+', 'paypal', 1),
	(28, 5, 25.0000, 25.0000, '2013-05-07 17:43:34', '7P3289317P0368828', 'Completed', '+', '+', 'paypal', 1),
	(29, 2, NULL, 1.0000, '2013-05-07 17:43:41', NULL, 'Completed', '+', '+', 'system', 0),
	(30, 2, NULL, 1.0000, '2013-05-07 17:43:45', NULL, 'Completed', '+', '+', 'system', 0),
	(31, 6, 25.0000, 25.0000, '2013-05-07 17:45:54', '7C638580AY339563V', 'Completed', '+', '+', 'paypal', 1),
	(32, 2, NULL, 1.0000, '2013-05-07 17:46:05', NULL, 'Completed', '+', '+', 'system', 0),
	(33, 7, 25.0000, 125.0000, '2013-05-08 10:06:41', '3L238798TT9780620', 'Completed', '+', '+', 'paypal', 1),
	(34, 2, NULL, 1.0000, '2013-05-08 10:06:52', NULL, 'Completed', '+', '+', 'system', 0),
	(35, 7, 10.0000, 110.0000, '2013-05-08 10:08:18', '08E895570U929633N', 'Completed', '+', '+', 'paypal', 1),
	(36, 2, 10.0000, 40.0000, '2013-05-08 11:41:10', '0CX699261X756122N', 'Completed', '+', '+', 'paypal', 1);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table multi_level.user
DROP TABLE IF EXISTS `user`;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `fullname`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`, `permission`, `transaction_start`, `transaction_finish`) VALUES
	(1, 'nguyen thu huyen', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'admin@gmail.com', NULL, NULL, 0, 0, 1, NULL, NULL, 'administrator', NULL, NULL),
	(2, 'user 1', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thuhuyen1142@gmail.com', 0, '', 1, 1, 1, NULL, '2013-05-07 17:05:54', NULL, '2013-05-08 11:41:10', '2013-06-07 11:41:10'),
	(6, 'user 2', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thuhuyen.k@gmail.com', 0, '', 2, 0, 1, NULL, '2013-05-07 17:45:54', NULL, NULL, NULL),
	(7, 'Khiem Pham', '96e79218965eb72c92a549dd5a330112', '', 0, 'rongandat@gmail.com', 0, '', 2, 2, 1, NULL, '2013-05-08 10:06:41', NULL, '2013-05-08 10:06:41', '2013-06-07 10:06:41');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table multi_level.users_groups
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) unsigned NOT NULL,
  `permission_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table multi_level.users_groups: ~3 rows (approximately)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `permission_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;


-- Dumping structure for table multi_level.users_permission
DROP TABLE IF EXISTS `users_permission`;
CREATE TABLE IF NOT EXISTS `users_permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table multi_level.users_permission: ~2 rows (approximately)
/*!40000 ALTER TABLE `users_permission` DISABLE KEYS */;
INSERT INTO `users_permission` (`permission_id`, `name`, `description`) VALUES
	(1, 'adminstrator', 'Supper Administrator'),
	(2, 'moderator', 'Moderator');
/*!40000 ALTER TABLE `users_permission` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
