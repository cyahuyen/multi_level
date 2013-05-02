-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-02 13:33:54
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for multi_level
DROP DATABASE IF EXISTS `multi_level`;
CREATE DATABASE IF NOT EXISTS `multi_level` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `multi_level`;


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

-- Dumping data for table multi_level.multilevel_sessions: ~2 rows (approximately)
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('812ddf9dd519cd4bf19de25f3feb386e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0', 1366972335, 'a:33:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:8:"username";s:13:"administrator";s:8:"password";s:33:"e10adc3949ba59abbe56e057f20f883e ";s:5:"email";s:20:"ngoclecong@gmail.com";s:8:"usertype";s:13:"administrator";s:10:"first_name";s:4:"Ngoc";s:9:"last_name";s:7:"Le Cong";s:7:"company";s:0:"";s:5:"phone";s:11:"84-87951545";s:6:"mobile";s:14:"84-84934476889";s:8:"group_id";s:1:"1";s:14:"account_number";s:8:"88888888";s:10:"master_key";s:3:"678";s:15:"activation_code";N;s:23:"forgotten_password_code";s:10:"9929858278";s:13:"remember_code";N;s:6:"active";s:1:"1";s:3:"dob";s:10:"1989-11-06";s:5:"state";s:1:"0";s:7:"country";s:1:"1";s:4:"city";s:7:"Ha Tinh";s:15:"welcome_message";s:25:"Xin chao ban Le Cong Ngoc";s:17:"security_question";s:25:"Mother&#039;s Maiden Name";s:15:"security_answer";s:6:"Nguyen";s:9:"login_pin";s:5:"56789";s:12:"account_type";s:0:"";s:14:"referral_count";s:1:"0";s:7:"address";s:8:"Xuan Loc";s:8:"postcode";s:5:"10000";s:16:"additional_infor";s:5:"Tesst";s:10:"created_on";s:10:"1351667119";s:10:"last_login";s:10:"1353486745";}'),
	('91bc5535cdfbde021274596342ada93d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0', 1367305204, 'a:33:{s:9:"user_data";s:0:"";s:2:"id";s:1:"2";s:8:"username";s:10:"congngocvn";s:8:"password";s:33:"96e79218965eb72c92a549dd5a330112 ";s:5:"email";s:23:"lecongngoc_vn@yahoo.com";s:8:"usertype";s:4:"user";s:10:"first_name";s:4:"Ngoc";s:9:"last_name";s:3:"Ngo";s:7:"company";s:0:"";s:5:"phone";s:14:"84-84934476889";s:6:"mobile";s:14:"84-84934476889";s:8:"group_id";s:1:"2";s:14:"account_number";s:8:"33333333";s:10:"master_key";s:3:"123";s:15:"activation_code";N;s:23:"forgotten_password_code";N;s:13:"remember_code";N;s:6:"active";s:1:"1";s:3:"dob";s:10:"1989-11-06";s:5:"state";s:1:"0";s:7:"country";s:3:"230";s:4:"city";s:11:"Tuyen Quang";s:15:"welcome_message";s:2:"Hi";s:17:"security_question";s:25:"Mother&#039;s Maiden Name";s:15:"security_answer";s:3:"oke";s:9:"login_pin";s:5:"12345";s:12:"account_type";s:0:"";s:14:"referral_count";s:1:"0";s:7:"address";s:8:"Viet Nam";s:8:"postcode";s:2:"84";s:16:"additional_infor";s:0:"";s:10:"created_on";s:1:"0";s:10:"last_login";s:10:"1353480462";}');
/*!40000 ALTER TABLE `multilevel_sessions` ENABLE KEYS */;


-- Dumping structure for table multi_level.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '2',
  `account_number` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `master_key` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `dob` date NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `welcome_message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `security_question` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `security_answer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `login_pin` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `account_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `referral_count` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `additional_infor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` int(10) unsigned NOT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table multi_level.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `usertype`, `first_name`, `last_name`, `company`, `phone`, `mobile`, `group_id`, `account_number`, `master_key`, `activation_code`, `forgotten_password_code`, `remember_code`, `active`, `dob`, `state`, `country`, `city`, `welcome_message`, `security_question`, `security_answer`, `login_pin`, `account_type`, `referral_count`, `address`, `postcode`, `additional_infor`, `ip_address`, `created_on`, `last_login`) VALUES
	(1, 'administrator', '96e79218965eb72c92a549dd5a330112 ', 'ngoclecong@gmail.com', 'administrator', 'Ngoc', 'Le Cong', '', '84-87951545', '84-84934476889', 1, '88888888', '678', NULL, '9929858278', NULL, 1, '1989-11-06', 0, 1, 'Ha Tinh', 'Xin chao ban Le Cong Ngoc', 'Mother&#039;s Maiden Name', 'Nguyen', '56789', '', 0, 'Xuan Loc', '10000', 'Tesst', 0, 1351667119, 1353486745),
	(2, 'congngocvn', '96e79218965eb72c92a549dd5a330112 ', 'lecongngoc_vn@yahoo.com', 'user', 'Ngoc', 'Ngo', '', '84-84934476889', '84-84934476889', 2, '33333333', '123', NULL, NULL, NULL, 1, '1989-11-06', 0, 230, 'Tuyen Quang', 'Hi', 'Mother&#039;s Maiden Name', 'oke', '12345', '', 0, 'Viet Nam', '84', '', 0, 0, 1353480462),
	(3, 'ngocngovn', '96e79218965eb72c92a549dd5a330112 ', 'congngocvn@gmail.com', 'user', 'Ngoc', 'Le', 'Cyasoft', '84-0983008234', '84-0934476889', 2, '11111111', '111', NULL, NULL, NULL, 1, '1989-11-06', 3778, 230, 'Tuyen Quang', 'Hi', 'Mother&#039;s Maiden Name', 'Hic', '11111', '', 0, 'Viet Nam', '84', '    Luuu', 0, 0, 1352273025);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


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
