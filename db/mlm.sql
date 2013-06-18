-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-06-18 17:29:39
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for multi_level
DROP DATABASE IF EXISTS `multi_level`;
CREATE DATABASE IF NOT EXISTS `multi_level` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `multi_level`;


-- Dumping structure for table multi_level.activity
DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.activity: ~0 rows (approximately)
DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `main_user_id`, `created`, `status`, `amount`, `description`) VALUES
	(1, 26, '2013-06-18 17:26:33', NULL, NULL, 'Registed'),
	(2, 26, '2013-06-18 17:26:33', NULL, NULL, 'Created gold account number G1371551193'),
	(3, 26, '2013-06-18 17:26:33', '+', 400.00, 'Add Deposit to your acount G1371551193 with amount : $400'),
	(4, 27, '2013-06-18 17:27:14', NULL, NULL, 'Registed'),
	(5, 27, '2013-06-18 17:27:14', NULL, NULL, 'Created gold account number G1371551234'),
	(6, 27, '2013-06-18 17:27:14', '+', 200.00, 'Add Deposit to your acount G1371551234 with amount : $200'),
	(7, 26, '2013-06-18 17:27:14', NULL, NULL, 'Created silver account number S1371551234'),
	(8, 26, '2013-06-18 17:27:15', '+', 5.00, 'Add refere fees your acount S1371551234 with amount : $5'),
	(9, 26, '2013-06-18 17:27:15', '+', 10.00, 'Add refere fees your acount G1371551193 with amount : $10'),
	(10, 28, '2013-06-18 17:29:04', NULL, NULL, 'Registed'),
	(11, 26, '2013-06-18 17:29:04', '+', 5.00, 'Add refere fees your acount S1371551234 with amount : $5');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- Dumping structure for table multi_level.balance
DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance: ~0 rows (approximately)
DELETE FROM `balance`;
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 1, 650.00),
	(2, 9, 410.00),
	(3, 10, 200.00),
	(4, 11, 10.00);
/*!40000 ALTER TABLE `balance` ENABLE KEYS */;


-- Dumping structure for table multi_level.balance_history
DROP TABLE IF EXISTS `balance_history`;
CREATE TABLE IF NOT EXISTS `balance_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `balance` double(10,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance_history: ~0 rows (approximately)
DELETE FROM `balance_history`;
/*!40000 ALTER TABLE `balance_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `balance_history` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.config: ~37 rows (approximately)
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `group`, `code`, `key`, `value`, `serialized`) VALUES
	(126, 'payment', 'paypal', 'business', 'thuhuy_1317911597_per@gmail.com', 0),
	(127, 'payment', 'paypal', 'item_name', 'CYA Game payment', 0),
	(128, 'payment', 'paypal', 'currency_code', 'USD', 0),
	(129, 'payment', 'paypal', 'sandbox', '1', 0),
	(130, 'payment', 'paypal', 'active', '1', 0),
	(203, 'config', 'emails', 'protocol', 'mail', 0),
	(204, 'config', 'emails', 'mail_parameter', '', 0),
	(205, 'config', 'emails', 'smtp_host', 'ssl://smtp.googlemail.com', 0),
	(206, 'config', 'emails', 'smtp_user', 'rongandat@gmail.com', 0),
	(207, 'config', 'emails', 'smtp_pass', 'anhyeuem123', 0),
	(208, 'config', 'emails', 'smtp_port', '465', 0),
	(209, 'config', 'emails', 'smtp_timeout', '30', 0),
	(210, 'config', 'emails', 'email_admin', 'admin@gmail.com', 0),
	(211, 'config', 'emails', 'group', 'config', 0),
	(218, 'config', 'withdrawal', 'days_space_gold', '365', 0),
	(219, 'config', 'withdrawal', 'days_space_silver', '60', 0),
	(220, 'config', 'withdrawal', 'min_of_gold', '100', 0),
	(221, 'config', 'withdrawal', 'min_of_silver', '20', 0),
	(222, 'config', 'withdrawal', 'group', 'config', 0),
	(223, 'payment', 'creditcard', 'login_id', '6Z2Kgs6W7m', 0),
	(224, 'payment', 'creditcard', 'transaction', '49yh68ESgd4Sd2Mw', 0),
	(225, 'payment', 'creditcard', 'authorizenet_aim_method', 'authorization', 0),
	(226, 'payment', 'creditcard', 'sandbox', '1', 0),
	(227, 'payment', 'creditcard', 'active', '1', 0),
	(228, 'config', 'transaction_fees', 'open_fee', '25', 0),
	(229, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
	(230, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
	(231, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
	(232, 'config', 'transaction_fees', 'max_enrolment_silver_amount', '100', 0),
	(233, 'config', 'transaction_fees', 'group', 'config', 0),
	(234, 'config', 'referraldefault', 'default_referral_user', 'U1369627271', 0),
	(235, 'config', 'timeconfig', 'time_format', '30', 0),
	(242, 'config', 'referral', 'percentage_silver', '2', 0),
	(243, 'config', 'referral', 'percentage_gold', '5', 0),
	(244, 'config', 'referral', 'bonus_percentage_silver', '2', 0),
	(245, 'config', 'referral', 'bonus_percentage_gold', '5', 0),
	(246, 'config', 'referral', 'referral_fees', '5', 0);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;


-- Dumping structure for table multi_level.email_template
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `subject` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.email_template: ~23 rows (approximately)
DELETE FROM `email_template`;
/*!40000 ALTER TABLE `email_template` DISABLE KEYS */;
INSERT INTO `email_template` (`id`, `code`, `subject`, `content`, `slug`) VALUES
	(1, 'deposite', 'Have just new member deposite', '<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><strong>Full Name</strong>: {{full_name}}</span></p>\r\n<p><strong>Email</strong>: {{email}}</p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><strong>Amount</strong>: {{amount}}<br /></span></p>', '<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">{{</span><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">full_name</span>}}: Full name<br /></span></p>\r\n<p>{{email}}: Email</p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">{{</span><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">amount</span>}}: Amount<br /></span></p>'),
	(2, 'register', 'Thank you for registering', '<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Thank you for registering.</span><br style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;" /><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">You just sign up at. Please login to check your account.<br /></span></p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Payment :{{entry_amount}}</span></p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Fees: {{fees}}</span></p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">password: {{password}}</span></p>', '<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">{{</span><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">entry_amount</span>}}: Amount Register</span></p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">{{password}}: Password</span></p>\r\n<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">{{fees}} :Fees</span></p>'),
	(3, 'admin_register', 'Have just new member register', '<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Have just new member register</span><br style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;" /><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Full name: {{fullname}}</span><br style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;" /><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Address:</span>{{address}}<br style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;" /><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Phone:</span>{{phone}}<br style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;" /><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Email:<span class="Apple-converted-space"> {{email}}</span></span><br style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;" /><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">payment: {{payment}}</span></p>', '<p><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">{{</span><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">fullname</span>}} : Fullname<br /></span></p>\r\n<p>{{address}} :Adress</p>\r\n<p>{{phone}}: Phone</p>\r\n<p>{{<span style="color: #222222; font-family: arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"><span class="Apple-converted-space">email</span></span>}}<span class="Apple-converted-space">: Email</span></p>\r\n<p>{{payment}}: Payment</p>\r\n<p>&nbsp;</p>'),
	(4, 'referring', 'Your referring member', '<p>Your referring member {{fullname}} just sign up at.</p>', '<p>{{fullname}} : Fullname</p>'),
	(5, 'forgot_password', 'Forgot Password', '<p>Code forget Password: {{forget_code}}</p>', '<p>{{forget_code}} : Code</p>'),
	(6, 'user_expiration', 'Users Expiration!', '<p>Gold account {{fullname}}&nbsp; has expired.</p>', '<p>{{fullname}} : Fullname</p>'),
	(7, 'acount_expiration', 'Account Expiration!', '<p>Your Gold account has expired. Your current account type is {{user_type}}. Please log in and deposite to be Gold again.</p>', '<p>{{user_type}} : User Type</p>'),
	(8, 'profit', 'Profit month {{month}}', '<p>You have just received: {{blance_fees}} month {{month}}</p>', '<p>{{month}}: month</p>\r\n<p>{{blance_fees}}: Blance Fees</p>'),
	(9, 'admin_withdrawal', 'Withdrawal', '<p><strong>Fullname:&nbsp;</strong>{{fullname}}</p>\r\n<p><strong>AcountNumber:&nbsp;</strong>{{username}}</p>\r\n<p><strong>Email:&nbsp;</strong>{{email}}</p>\r\n<p><strong>Email paypal:&nbsp;</strong>{{email_paypal}}</p>\r\n<p><strong>Amount:&nbsp;</strong>{{amount}}</p>', '<p>{{fullname}} : Fullname</p>\r\n<p>{{username}}: AcountNumber</p>\r\n<p>{{email}}: Email</p>\r\n<p>{{email_paypal}}: Email paypal</p>\r\n<p>{{amount}}: Amount</p>'),
	(10, 'payment_sucess', 'Payment Success', '<p>Hi {{fullname}}</p>\r\n<p>Amount: {{amount}}</p>', '<p>{{amount}}: Amount</p>\r\n<p>{{fullname}}: Fullname</p>'),
	(11, 'referring_deposit', 'You have just referring deposit', '<p>hi {{fullname}}!</p>\r\n<p>You have just ${{amount}} from {{user_fullname}}</p>', '<p>{{fullname}} : Fullname referring user</p>\r\n<p>{{user_fullname}} : Deposit user</p>'),
	(12, 'user_withdrawal', 'Withdrawal', '<p>Hi<strong>&nbsp;</strong>{{fullname}}!</p>\r\n<p><strong>Email paypal:&nbsp;</strong>{{email_paypal}}</p>\r\n<p><strong>Amount: $</strong>{{amount}}</p>\r\n<p><strong>Fees</strong>: ${{fees}}</p>\r\n<p><strong>Total</strong>: ${{total}}</p>', '<p>{{email_paypal}}: Email paypal</p>\r\n<p>{{amount}}: Amount</p>\r\n<p>{{fees}}:Fees</p>\r\n<p>{{total}} : Total</p>'),
	(13, 'payment_cancel', 'Withdrawal Cancel', '<p><strong><br /></strong>Hi {{fullname}}!</p>\r\n<p><strong>Amount</strong> :{{amount}}</p>', '<p>{{fullname}}:Full name</p>\r\n<p>{{amount}} : Amount</p>');
/*!40000 ALTER TABLE `email_template` ENABLE KEYS */;


-- Dumping structure for table multi_level.multilevel_sessions
DROP TABLE IF EXISTS `multilevel_sessions`;
CREATE TABLE IF NOT EXISTS `multilevel_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.multilevel_sessions: ~3 rows (approximately)
DELETE FROM `multilevel_sessions`;
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `created`) VALUES
	('1d9869b5fdc6e6a397e7f30c63f26279', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1369799565, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:5:{s:7:"user_id";s:1:"8";s:5:"email";s:19:"rongandat@gmail.com";s:8:"usertype";s:1:"1";s:6:"status";s:1:"1";s:10:"permission";N;}}', '0000-00-00 00:00:00'),
	('cb50f26bc362c6fa8e0ef391252e6430', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1369799455, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:5:{s:7:"user_id";s:1:"8";s:5:"email";s:19:"rongandat@gmail.com";s:8:"usertype";s:1:"1";s:6:"status";s:1:"1";s:10:"permission";N;}}', '0000-00-00 00:00:00'),
	('fb004ac14adf29da987df488fb45c457', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1369799495, '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `multilevel_sessions` ENABLE KEYS */;


-- Dumping structure for table multi_level.payment_history
DROP TABLE IF EXISTS `payment_history`;
CREATE TABLE IF NOT EXISTS `payment_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `total` double(10,4) NOT NULL,
  `fees` double(10,4) NOT NULL,
  `email_paypal` varchar(200) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `confirm_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.payment_history: ~0 rows (approximately)
DELETE FROM `payment_history`;
/*!40000 ALTER TABLE `payment_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_history` ENABLE KEYS */;


-- Dumping structure for table multi_level.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `main_user_id` int(10) NOT NULL,
  `fees` double(10,4) NOT NULL DEFAULT '0.0000',
  `total` double(10,4) NOT NULL DEFAULT '0.0000',
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
INSERT INTO `transaction` (`id`, `user_id`, `main_user_id`, `fees`, `total`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_text`, `transaction_source`, `status`) VALUES
	(1, 9, 26, 35.0000, 435.0000, '2013-06-18 17:26:33', '2194575055', 'Completed', 'register', '+', 'creditcard', 1),
	(2, 10, 27, 35.0000, 235.0000, '2013-06-18 17:27:14', '2194575064', 'Completed', 'register', '+', 'creditcard', 1),
	(3, 11, 26, 0.0000, 5.0000, '2013-06-18 17:27:15', NULL, 'Completed', 'refere', '+', 'system', 0),
	(4, 9, 26, 0.0000, 10.0000, '2013-06-18 17:27:15', NULL, 'Completed', 'refere', '+', 'system', 0),
	(5, NULL, 28, 25.0000, 25.0000, '2013-06-18 17:29:04', '2194575089', 'Completed', 'register', '+', 'creditcard', 1),
	(6, 11, 26, 0.0000, 5.0000, '2013-06-18 17:29:04', NULL, 'Completed', 'refere', '+', 'system', 0);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table multi_level.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL DEFAULT '0',
  `acount_number` varchar(200) COLLATE utf16_bin NOT NULL,
  `usertype` int(11) DEFAULT NULL,
  `withdrawal_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~4 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `main_user_id`, `acount_number`, `usertype`, `withdrawal_date`) VALUES
	(1, 1, '', -1, NULL),
	(9, 26, 'G1371551193', 2, NULL),
	(10, 27, 'G1371551234', 2, NULL),
	(11, 26, 'S1371551234', 1, NULL);
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


-- Dumping structure for table multi_level.user_main
DROP TABLE IF EXISTS `user_main`;
CREATE TABLE IF NOT EXISTS `user_main` (
  `main_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text,
  `referring` int(10) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `forgotten_password_code` varchar(300) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `permission` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.user_main: ~3 rows (approximately)
DELETE FROM `user_main`;
/*!40000 ALTER TABLE `user_main` DISABLE KEYS */;
INSERT INTO `user_main` (`main_id`, `firstname`, `lastname`, `email`, `password`, `address`, `referring`, `phone`, `status`, `forgotten_password_code`, `created_on`, `permission`) VALUES
	(1, 'admn', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', 'administrator'),
	(26, 'Khiemu', 'Pham', 'rongandat@gmail.com', '68c8d853531ef53cfdb2b549b9eb90dc', 'Ha Noi', NULL, '01694046627', 1, NULL, '2013-06-18 17:26:33', NULL),
	(27, 'Khiemu', 'Pham', 'rongand4at@gmail.com', '5dd075517b102590ffb39cbd590beeea', 'Ha Noi', 26, '01694046627', 1, NULL, '2013-06-18 17:27:14', NULL),
	(28, 'Khiemu', 'Pham', 'rongand4sat@gmail.com', '860ac72675691831132ec91933fa65b3', 'Ha Noi', 26, '01694046627', 1, NULL, '2013-06-18 17:29:04', NULL);
/*!40000 ALTER TABLE `user_main` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
