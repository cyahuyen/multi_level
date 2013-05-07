-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-07 14:59:26
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance: ~2 rows (approximately)
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 40, 300.0000),
	(2, 10, 10.0000);
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
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.config: ~24 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
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
	(131, 'config', 'emails', 'protocol', 'smtp', 0),
	(132, 'config', 'emails', 'mail_parameter', '', 0),
	(133, 'config', 'emails', 'smtp_host', 'ssl://smtp.googlemail.com', 0),
	(134, 'config', 'emails', 'smtp_user', 'rongandat@gmail.com', 0),
	(135, 'config', 'emails', 'smtp_pass', 'anhyeuem123', 0),
	(136, 'config', 'emails', 'smtp_port', '465', 0),
	(137, 'config', 'emails', 'smtp_timeout', '30', 0),
	(138, 'config', 'emails', 'email_admin', 'rongandat@gmail.com', 0),
	(139, 'config', 'emails', 'group', 'config', 0),
	(140, 'config', 'timeconfig', 'time_format', '30', 0),
	(141, 'config', 'referral', 'referring_percentage', '1', 0),
	(142, 'config', 'referral', 'interest_race', '1', 0),
	(143, 'config', 'referral', 'gold_fees', '20', 0),
	(144, 'config', 'referral', 'silver_fees', '10', 0);
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

-- Dumping data for table multi_level.multilevel_sessions: ~9 rows (approximately)
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('c6bfa3deaad65b5a03b0f1c973e9ff89', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0', 1367912617, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:17:{s:7:"user_id";s:2:"40";s:8:"username";s:9:"rongandat";s:8:"fullname";s:10:"Khiem Pham";s:8:"password";s:32:"7085e6b4fb5bf71436221f6ccd1af40c";s:7:"address";s:0:"";s:5:"phone";s:1:"0";s:5:"email";s:19:"rongandat@gmail.com";s:3:"fax";s:1:"0";s:8:"birthday";s:10:"1989-05-02";s:9:"referring";s:2:"10";s:8:"usertype";s:1:"2";s:6:"status";s:1:"0";s:23:"forgotten_password_code";s:0:"";s:10:"created_on";s:19:"2013-05-07 14:15:33";s:10:"permission";N;s:17:"transaction_start";s:19:"2013-05-07 14:15:34";s:18:"transaction_finish";s:19:"2013-06-06 14:15:34";}}');
/*!40000 ALTER TABLE `multilevel_sessions` ENABLE KEYS */;


-- Dumping structure for table multi_level.transaction
DROP TABLE IF EXISTS `transaction`;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.transaction: ~3 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `user_id`, `open_fees`, `total_fees`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_source`, `status`) VALUES
	(1, 40, 25.0000, 225.0000, '2013-05-07 14:15:34', '2EF04233UR447472D', 'Completed', '+', 'paypal', 1),
	(2, 10, NULL, 10.0000, '2013-05-07 14:15:44', NULL, 'Completed', '+', 'system', 0),
	(6, 40, 0.0000, 100.0000, '2013-05-07 14:19:36', '2V924964HJ6515339', 'Completed', '+', 'paypal', 1);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table multi_level.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf16_bin NOT NULL,
  `fullname` varchar(200) COLLATE utf16_bin NOT NULL,
  `password` varchar(150) COLLATE utf16_bin NOT NULL,
  `address` varchar(150) COLLATE utf16_bin NOT NULL,
  `phone` int(12) NOT NULL,
  `email` varchar(100) COLLATE utf16_bin NOT NULL,
  `fax` int(12) NOT NULL,
  `birthday` varchar(50) COLLATE utf16_bin NOT NULL,
  `referring` int(11) DEFAULT NULL,
  `usertype` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `forgotten_password_code` varchar(255) COLLATE utf16_bin NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `permission` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `transaction_start` datetime DEFAULT NULL,
  `transaction_finish` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `username`, `fullname`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`, `permission`, `transaction_start`, `transaction_finish`) VALUES
	(9, 'thuhuyen', 'Thu Huyen', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'Hai duong', 2147483647, 'ngoclecong@gmail.com', 2147483647, '12/12/1989', 0, 2, 1, '5609533015', '2013-04-25 16:11:12', '', NULL, NULL),
	(10, 'congngocvn', '', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'Xuan loc - Can Loc - ha Tinh', 978344219, 'congngocvn@gmail.com', 978344219, '10-12-1989', 0, 1, 0, '', '2013-04-25 17:42:38', 'administrator', '2013-05-06 16:47:12', '2013-06-05 16:47:12'),
	(14, 'administrator', 'fsdfsdf', '96e79218965eb72c92a549dd5a330112', '105 Lang Ha', 234234, 'khiemktqd@gmail.com', 165235952, '1989-05-02', 0, 0, 0, '', '2013-05-03 17:35:13', NULL, NULL, NULL),
	(40, 'rongandat', 'Khiem Pham', '7085e6b4fb5bf71436221f6ccd1af40c', '', 0, 'rongandat@gmail.com', 0, '1989-05-02', 10, 2, 0, '', '2013-05-07 14:15:33', NULL, '2013-05-07 14:15:34', '2013-06-06 14:15:34');
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
