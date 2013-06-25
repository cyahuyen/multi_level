-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-06-25 09:31:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.activity: ~14 rows (approximately)
DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `main_user_id`, `created`, `status`, `amount`, `description`) VALUES
	(1, 43, '2013-06-24 14:10:43', NULL, NULL, 'Registed'),
	(2, 43, '2013-06-24 14:10:43', NULL, NULL, 'Created gold account number G1372057843'),
	(3, 43, '2013-06-24 14:10:43', '+', 100.00, 'Add Deposit to your acount G1372057843 with amount : $100'),
	(4, 44, '2013-06-24 14:11:34', NULL, NULL, 'Registed'),
	(5, 44, '2013-06-24 14:11:34', NULL, NULL, 'Created gold account number G1372057894'),
	(6, 44, '2013-06-24 14:11:34', '+', 300.00, 'Add Deposit to your acount G1372057894 with amount : $300'),
	(7, 43, '2013-06-24 14:11:34', NULL, NULL, 'Created silver account number S1372057894'),
	(8, 43, '2013-06-24 14:11:34', '+', 5.00, 'Add refere fees your acount S1372057894 with amount : $5'),
	(9, 43, '2013-06-24 14:11:34', '+', 15.00, 'Add refere fees your acount G1372057843 with amount : $15'),
	(10, 44, '2013-06-24 14:16:06', '+', 200.00, 'Add deposit amount your acount G1372057894 with amount : $200'),
	(11, 43, '2013-06-24 14:16:06', '+', 10.00, 'Add refere fees your acount G1372057843 with amount : $10'),
	(12, 43, '2013-06-24 14:56:46', NULL, NULL, 'Sent a question: "Minimum and Maximum distance between any two occurrences of the word in the file"'),
	(13, 43, '2013-06-24 14:57:07', NULL, NULL, 'Sent a question: "ambiguos variant and boost spirit x3"'),
	(14, 43, '2013-06-24 14:57:27', NULL, NULL, 'Sent a question: "ambiguos variant and boost spirit x3"');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- Dumping structure for table multi_level.answer
DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_id` int(10) NOT NULL,
  `answer_content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.answer: ~1 rows (approximately)
DELETE FROM `answer`;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` (`id`, `question_id`, `answer_content`, `status`) VALUES
	(1, 3, '<p>Now I have:</p>\r\n<p>1st word: This 2nd word: Overflow</p>\r\n<p>Now I want the Minimum Distance count to be displayed as 2 (Since there is \'is Stack\' in between) and the Maximum Distance count to be displayed as 5 (Since there is \'is Stack Overflow + Enter + Stack\' in between)</p>\r\n<p>Need this in Shell/ Bash.</p>', 0);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;


-- Dumping structure for table multi_level.balance
DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance: ~4 rows (approximately)
DELETE FROM `balance`;
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 1, 650.00),
	(2, 26, 125.00),
	(3, 27, 500.00),
	(4, 28, 5.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;

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
	(223, 'payment', 'creditcard', 'login_id', '6Z2Kgs6W7m', 0),
	(224, 'payment', 'creditcard', 'transaction', '49yh68ESgd4Sd2Mw', 0),
	(225, 'payment', 'creditcard', 'authorizenet_aim_method', 'authorization', 0),
	(226, 'payment', 'creditcard', 'sandbox', '1', 0),
	(227, 'payment', 'creditcard', 'active', '1', 0),
	(228, 'config', 'transaction_fees', 'open_fee', '25', 0),
	(229, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
	(230, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
	(231, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
	(232, 'config', 'transaction_fees', 'max_enrolment_silver_amount', '90', 0),
	(233, 'config', 'transaction_fees', 'group', 'config', 0),
	(234, 'config', 'referraldefault', 'default_referral_user', 'U1369627271', 0),
	(235, 'config', 'timeconfig', 'time_format', '30', 0),
	(242, 'config', 'referral', 'percentage_silver', '2', 0),
	(243, 'config', 'referral', 'percentage_gold', '5', 0),
	(244, 'config', 'referral', 'bonus_percentage_silver', '2', 0),
	(245, 'config', 'referral', 'bonus_percentage_gold', '5', 0),
	(246, 'config', 'referral', 'referral_fees', '5', 0),
	(247, 'config', 'withdrawal', 'days_space_gold', '365', 0),
	(248, 'config', 'withdrawal', 'days_space_silver', '60', 0),
	(249, 'config', 'withdrawal', 'min_of_gold', '50', 0),
	(250, 'config', 'withdrawal', 'min_of_silver', '20', 0),
	(251, 'config', 'withdrawal', 'group', 'config', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.email_template: ~33 rows (approximately)
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
	(8, 'profit', 'Profit month {{month}}', '<p>You have just received: {{blance_fees}} month {{month}}</p>\r\n<p>Acount number: {{acount_number}}</p>', '<p>{{month}}: month</p>\r\n<p>{{blance_fees}}: Blance Fees</p>\r\n<p>{{acount_number}}: acount number</p>'),
	(9, 'admin_withdrawal', 'Withdrawal', '<p><strong>Fullname:&nbsp;</strong>{{fullname}}</p>\r\n<p><strong>AcountNumber:&nbsp;</strong>{{username}}</p>\r\n<p><strong>Email:&nbsp;</strong>{{email}}</p>\r\n<p><strong>Email paypal:&nbsp;</strong>{{email_paypal}}</p>\r\n<p><strong>Amount:&nbsp;</strong>{{amount}}</p>', '<p>{{fullname}} : Fullname</p>\r\n<p>{{username}}: AcountNumber</p>\r\n<p>{{email}}: Email</p>\r\n<p>{{email_paypal}}: Email paypal</p>\r\n<p>{{amount}}: Amount</p>'),
	(10, 'payment_sucess', 'Payment Success', '<p>Hi {{fullname}}</p>\r\n<p>Amount: {{amount}}</p>', '<p>{{amount}}: Amount</p>\r\n<p>{{fullname}}: Fullname</p>'),
	(11, 'referring_deposit', 'You have just referring deposit', '<p>hi {{fullname}}!</p>\r\n<p>You have just ${{amount}} from {{user_fullname}}</p>', '<p>{{fullname}} : Fullname referring user</p>\r\n<p>{{user_fullname}} : Deposit user</p>'),
	(12, 'user_withdrawal', 'Withdrawal', '<p>Hi<strong>&nbsp;</strong>{{fullname}}!</p>\r\n<p><strong>Email paypal:&nbsp;</strong>{{email_paypal}}</p>\r\n<p><strong>Amount: $</strong>{{amount}}</p>\r\n<p><strong>Fees</strong>: ${{fees}}</p>\r\n<p><strong>Total</strong>: ${{total}}</p>', '<p>{{email_paypal}}: Email paypal</p>\r\n<p>{{amount}}: Amount</p>\r\n<p>{{fees}}:Fees</p>\r\n<p>{{total}} : Total</p>'),
	(13, 'payment_cancel', 'Withdrawal Cancel', '<p><strong><br /></strong>Hi {{fullname}}!</p>\r\n<p><strong>Amount</strong> :{{amount}}</p>', '<p>{{fullname}}:Full name</p>\r\n<p>{{amount}} : Amount</p>'),
	(14, 'admin_profit', 'Profit', '<p>{{content}}</p>', '<p>{{content}} :Content Email</p>'),
	(15, 'update_question', 'Update Question', '<p>Hi {{fullname}}!</p>\r\n<p>You have just updated question "{{question}}"</p>', '<p>{{fullname}} : Fullname</p>\r\n<p>{{question}} : Question name</p>'),
	(16, 'add_question', 'Add question', '<p>Hi {{fullname}}!</p>\r\n<p>You have just add question "{{question}}"</p>\r\n<p>We will reply you as soon as possible</p>', '<p>{{fullname}} : Fullname</p>\r\n<p>{{question}} : Question name</p>'),
	(17, 'admin_add_question', 'Question "{{question}}"', '<p>{{fullname}} have just sent you a question "{{question}}"</p>', '<p>{{fullname}} : Fullname</p>\r\n<p>{{question}} : Question name</p>'),
	(18, 'add_answer_admin', 'Answer of question {{question}}', '<p>hi {{fullname}}</p>\r\n<p>Admin answered "{{question}}"</p>\r\n<p>&nbsp;</p>', '<p>{{fullname}} : Fullname</p>\r\n<p>{{question}}: Question</p>');
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


-- Dumping structure for table multi_level.question
DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `admin_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.question: ~3 rows (approximately)
DELETE FROM `question`;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id`, `main_user_id`, `title`, `content`, `created`, `status`, `admin_status`, `user_status`) VALUES
	(1, 43, 'Minimum and Maximum distance between any two occurrences of the word in the file', '<p>Now I have:</p>\r\n<p>1st word: This 2nd word: Overflow</p>\r\n<p>Now I want the Minimum Distance count to be displayed as 2 (Since there is \'is Stack\' in between) and the Maximum Distance count to be displayed as 5 (Since there is \'is Stack Overflow + Enter + Stack\' in between)</p>\r\n<p>Need this in Shell/ Bash.</p>', '2013-06-24 14:56:46', 0, 0, 0),
	(2, 43, 'ambiguos variant and boost spirit x3', '<p>trying to tweak the boost spirit x3 calc example to parse functions that can take functions as arguments. however it does not compile.</p>', '2013-06-24 14:57:07', 0, 0, 0),
	(3, 43, 'ambiguos variant and boost spirit x3', '<p>trying to tweak the boost spirit x3 calc example to parse functions that can take functions as arguments. however it does not compile.</p>', '2013-06-24 14:57:27', 0, 1, 0);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


-- Dumping structure for table multi_level.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `main_user_id` int(10) NOT NULL,
  `fees` double(10,2) NOT NULL DEFAULT '0.00',
  `total` double(10,2) NOT NULL DEFAULT '0.00',
  `created` datetime DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `transaction_type` varchar(500) DEFAULT NULL,
  `transaction_text` varchar(5) DEFAULT '+',
  `transaction_source` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.transaction: ~6 rows (approximately)
DELETE FROM `transaction`;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `user_id`, `main_user_id`, `fees`, `total`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_text`, `transaction_source`, `status`, `description`) VALUES
	(1, 26, 43, 35.00, 135.00, '2013-06-24 14:10:43', '2194793156', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(2, 27, 44, 35.00, 335.00, '2013-06-24 14:11:34', '2194793172', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(3, 28, 43, 0.00, 5.00, '2013-06-24 14:11:34', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem " succesfull'),
	(4, 26, 43, 0.00, 15.00, '2013-06-24 14:11:34', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(5, 27, 44, 10.00, 210.00, '2013-06-24 14:16:06', '2194793236', 'Completed', 'deposit', '+', 'creditcard', 1, ''),
	(6, 26, 43, 0.00, 10.00, '2013-06-24 14:16:06', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~4 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `main_user_id`, `acount_number`, `usertype`, `withdrawal_date`) VALUES
	(1, 1, '', -1, NULL),
	(26, 43, 'G1372057843', 2, '2013-06-24'),
	(27, 44, 'G1372057894', 2, '2013-06-24'),
	(28, 43, 'S1372057894', 1, '2013-06-24');
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.user_main: ~3 rows (approximately)
DELETE FROM `user_main`;
/*!40000 ALTER TABLE `user_main` DISABLE KEYS */;
INSERT INTO `user_main` (`main_id`, `firstname`, `lastname`, `email`, `password`, `address`, `referring`, `phone`, `status`, `forgotten_password_code`, `created_on`, `permission`) VALUES
	(1, 'admn', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', 'administrator'),
	(43, 'Khiem', 'Pham', 'khiemktqd@gmail.com', 'f0d15c5b747bd80cbaffd9ab3b85b8f9', 'Ha Noi', NULL, '01694046627', 1, NULL, '2013-06-24 14:10:42', NULL),
	(44, 'Khiem', 'Pham', 'rongandat@gmail.com', '747586ad523aa1d79c7a350ba0f5e946', '', 43, '', 1, NULL, '2013-06-24 14:11:34', NULL);
/*!40000 ALTER TABLE `user_main` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
