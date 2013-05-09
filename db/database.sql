-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             7.0.0.4369
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table multi_level.balance
DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance: ~0 rows (approximately)
DELETE FROM `balance`;
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 1, 73.0000),
	(2, 4, 101.0000),
	(4, 5, 1.0000),
	(5, 6, 0.0000);
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
DELETE FROM `config`;
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
	(158, 'config', 'transaction_fees', 'open_fee', '25', 0),
	(159, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
	(160, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
	(161, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
	(162, 'config', 'transaction_fees', 'max_enrolment_silver_amount', '20', 0),
	(163, 'config', 'transaction_fees', 'group', 'config', 0),
	(164, 'config', 'referral', 'percentage_silver', '2', 0),
	(165, 'config', 'referral', 'percentage_gold', '5', 0),
	(166, 'config', 'referral', 'gold_fees', '2', 0),
	(167, 'config', 'referral', 'silver_fees', '1', 0);
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

-- Dumping data for table multi_level.multilevel_sessions: ~0 rows (approximately)
DELETE FROM `multilevel_sessions`;
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('05b06a4a973fd838e052d0a51ea6dda7', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085700, ''),
	('0e050058e93c52d070c60262146c570e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084411, ''),
	('0f8d754dea31f5c5fc8c7a4d3544635d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085659, ''),
	('11fee78181c37d7e6770d6f40fc1e5f6', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084840, ''),
	('153dad5a7f9831fd8f1e361bb2636762', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085618, 'a:3:{s:9:"user_data";s:0:"";s:4:"user";a:16:{s:7:"user_id";s:1:"1";s:8:"fullname";s:16:"nguyen thu huyen";s:8:"password";s:32:"e10adc3949ba59abbe56e057f20f883e";s:7:"address";N;s:5:"phone";N;s:5:"email";s:22:"thuhuyen1142@gmail.com";s:3:"fax";N;s:8:"birthday";N;s:9:"referring";s:1:"0";s:8:"usertype";s:1:"0";s:6:"status";s:1:"1";s:23:"forgotten_password_code";N;s:10:"created_on";N;s:10:"permission";s:13:"administrator";s:17:"transaction_start";N;s:18:"transaction_finish";N;}s:8:"userlist";a:4:{s:8:"searchby";s:0:"";s:4:"sort";s:8:"fullname";s:4:"page";s:1:"0";s:6:"status";s:1:"1";}}'),
	('154f905b557717ffa014309fc424ded2', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084883, ''),
	('1bec62c150d89f0d336ea1a0f44d20ee', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085456, ''),
	('1eedbfde7b20ae302b2d4c3c4b783717', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084845, ''),
	('1f924673a38d17f520c81dca30483c8c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085661, ''),
	('235ff0459e16344e5cd42e122dd1cb27', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085658, ''),
	('2373b96e27b8f2520e5b7e16bd8e0dc3', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084860, ''),
	('26cdda2b8318b5da69d9fe69a0539eb0', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084912, ''),
	('2b9b63642d777ca63f4afb2eb2322c27', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085659, ''),
	('2bb4346c0a0890bba685b9a8f4aa60a5', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085458, ''),
	('3140feb6c38e7bac7bd9a02f90cf1cd8', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085314, ''),
	('3556277d10f5db9d0e7d508ca7f37c85', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084008, ''),
	('368b44f680eac5a311dd3fc2e62d9685', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085466, ''),
	('36d0f721954746070a4a4c422b2f02b1', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084850, ''),
	('39920a8b1d86524666bad1cbd86e752c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085633, ''),
	('3accab8b4573bc674a87a43491d5dd0f', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084910, ''),
	('3bd2c7586950cfcb1a02544880b1f167', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084842, ''),
	('3ee28671a38c212301e23c6b1cdeb15d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085661, ''),
	('46882f3c702b419a867038d8963812e0', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085493, ''),
	('4691a29ee379f78984b8e77549bc449c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084908, ''),
	('4bcddf44027df9db434e0a7bd90d21b6', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084930, ''),
	('4e025d9e946b68e84020b15d090bf9be', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085649, ''),
	('5833bddcc10a6e76081d3d3700213fea', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084870, ''),
	('590b42b63c21124f060f218612729347', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084911, ''),
	('619c89f2df03b5194c4f3ea246051689', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084440, ''),
	('619f604365a6e8ec287a4a8afa65c902', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085551, ''),
	('647c52bae402e37ced5eb2c2d4144433', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085649, ''),
	('6ff36d7fb75728f3f0c430400a19b31d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084885, ''),
	('7d1db9f7071c1afec4a6ed48c688d56a', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084851, ''),
	('7d722d6fdc277e4d42a0fced01d94686', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084905, ''),
	('85add253296c7475ac79c760c053fe0c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085553, ''),
	('8924fc97b755679dec8220a87bd8178d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085700, ''),
	('8c0fefac49ace9d8313dd0b02d734378', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085658, ''),
	('91b2d500aac69bf961beb085d11f0557', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084857, ''),
	('93fa7310cd03fec66c227897c82cff0a', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084848, ''),
	('98de453b2cac7df23ec4c598b16b3703', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084986, ''),
	('9fffe76900222facf4f9bb398fff9142', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085628, ''),
	('a1742e13e74bb69abd7e031bb816e19f', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084872, ''),
	('a7411cb730374d3938f46b11d8c87721', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084890, ''),
	('a95dd0b58815f57ad4e885403c8682ac', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085638, ''),
	('a9f9952f4046899b9829c892ebbde400', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085633, ''),
	('af31115fe1b80885baf5622dcccb15ca', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084859, ''),
	('b104acdb61f4e25920cdfffeb5febaa2', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084847, ''),
	('b19f8e9df76986d9bd33dd25eea078eb', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084907, ''),
	('b24186bfe6797a8885ba01e253128b6f', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084869, ''),
	('b50d998043d5e9da89ebb263c7c76170', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085638, ''),
	('b8ed7e50ecf70e531030c60adb088f54', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084849, ''),
	('be9640bcff14c831fff8250be3985357', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084858, ''),
	('c8169da63dce9917565f26827df98813', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084929, ''),
	('cb866a762966d270a8c1ec56af88cb4a', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084795, ''),
	('cf18cf59e06d5fb471d311fc757adbba', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084352, ''),
	('e004d7b60d0c4f5393cc204dbec36cf8', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085548, ''),
	('e303be810be0e4d72d37cb46f06ce4c5', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085628, ''),
	('e37326dfc43b435a944f1361743d2dfc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084439, 'a:2:{s:9:"user_data";s:0:"";s:21:"flash:old:usermessage";a:4:{i:0;s:7:"success";i:1;s:5:"green";i:2;s:26:"Thank you for registering!";i:3;s:0:"";}}'),
	('e3868b82e37ea60111d99079a481111b', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084884, ''),
	('e3f3a621ecf722eff8579b81e1e58277', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085520, ''),
	('e67b75b174bb1a9ce28b29befd8e55f1', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085503, ''),
	('e70759d1531b849785e084eed83db696', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084785, ''),
	('edcf681123f6eb563e347c400853ebe8', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084788, ''),
	('ee7ae1423fd1499dae0d71b97abebf38', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084891, ''),
	('f2640c301b4650652962114e4b5b5b9c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084886, ''),
	('f3cee400cb5f33d7b4cd90bb8594b4ec', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084772, ''),
	('f8357f06b56f4cb4dec3c63062cbfc99', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368084892, ''),
	('f8c5e3c5d08838327183d2e25bee8618', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1368085552, '');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.transaction: ~0 rows (approximately)
DELETE FROM `transaction`;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `user_id`, `fees`, `total`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_text`, `transaction_source`, `status`) VALUES
	(1, 4, 25.0000, 25.0000, '2013-05-09 14:21:26', '27L458994S842872A', 'Completed', 'register', '+', 'paypal', 1),
	(2, 5, 25.0000, 25.0000, '2013-05-09 14:24:51', '9RN18296DS761031K', 'Completed', 'register', '+', 'paypal', 1),
	(3, 4, NULL, 1.0000, '2013-05-09 14:25:11', NULL, 'Completed', 'refere', '+', 'system', 0),
	(4, 4, 10.0000, 110.0000, '2013-05-09 14:26:41', '46L81020FF343621M', 'Completed', 'deposit', '+', 'paypal', 1),
	(5, 6, 25.0000, 25.0000, '2013-05-09 14:29:51', '20P38541UT667591H', 'Completed', 'register', '+', 'paypal', 1),
	(6, 5, NULL, 1.0000, '2013-05-09 14:30:11', NULL, 'Completed', 'refere', '+', 'system', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~0 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `fullname`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`, `permission`, `transaction_start`, `transaction_finish`) VALUES
	(1, 'nguyen thu huyen', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'thuhuyen1142@gmail.com', NULL, NULL, 0, 0, 1, NULL, NULL, 'administrator', NULL, NULL),
	(4, 'user 1', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thuhuyen.k@gmail.com', 0, '', 0, 2, 1, NULL, '2013-05-09 14:21:26', NULL, '2013-05-09 14:26:41', '2013-06-08 14:26:41'),
	(5, 'user 2', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'ngoclecong@gmail.com', 0, '', 4, 1, 1, NULL, '2013-05-09 14:24:51', NULL, '2013-05-09 14:30:11', '2013-06-08 14:30:11'),
	(6, 'User 3', 'e10adc3949ba59abbe56e057f20f883e', 'Khuất Duy Tiến - Hà Nội', 978344219, 'congngocvn@gmail.com', 99987897, '03-12-1989', 5, 0, 1, '8601134894', '2013-05-09 14:29:51', NULL, NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table multi_level.users_groups
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) unsigned NOT NULL,
  `permission_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table multi_level.users_groups: ~0 rows (approximately)
DELETE FROM `users_groups`;
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
DELETE FROM `users_permission`;
/*!40000 ALTER TABLE `users_permission` DISABLE KEYS */;
INSERT INTO `users_permission` (`permission_id`, `name`, `description`) VALUES
	(1, 'adminstrator', 'Supper Administrator'),
	(2, 'moderator', 'Moderator');
/*!40000 ALTER TABLE `users_permission` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
