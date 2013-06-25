-- --------------------------------------------------------
-- Host:                         mlm.cyahost.com
-- Server version:               5.5.23-55 - Percona Server (GPL), Release rel25.3, Revision 2
-- Server OS:                    Linux
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-06-25 11:27:04
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table mlmcyaho_mlm.activity
DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.activity: ~39 rows (approximately)
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
	(14, 43, '2013-06-24 14:57:27', NULL, NULL, 'Sent a question: "ambiguos variant and boost spirit x3"'),
	(15, 45, '2013-06-24 22:14:52', NULL, NULL, 'Registed'),
	(16, 45, '2013-06-24 22:14:52', NULL, NULL, 'Created gold account number G1372130092'),
	(17, 45, '2013-06-24 22:14:52', '+', 100.00, 'Deposited to your acount G1372130092 with amount : $100'),
	(18, 46, '2013-06-24 22:17:06', NULL, NULL, 'Registed'),
	(19, 46, '2013-06-24 22:17:06', NULL, NULL, 'Created gold account number G1372130226'),
	(20, 46, '2013-06-24 22:17:06', '+', NULL, 'Deposited to the acount G1372130226 with amount : $100'),
	(21, 47, '2013-06-24 22:21:48', NULL, NULL, 'Registed'),
	(22, 47, '2013-06-24 22:21:48', NULL, NULL, 'Created gold account number G1372130508'),
	(23, 47, '2013-06-24 22:21:48', '+', 200.00, 'Deposited to the acount G1372130508 with amount : $200'),
	(24, 43, '2013-06-24 22:21:48', '+', 5.00, 'Your Silver account S1372057894  received a referral fee with amount : $5'),
	(25, 48, '2013-06-24 22:31:22', NULL, NULL, 'Registed'),
	(26, 48, '2013-06-24 22:31:22', NULL, NULL, 'Created gold account number G1372131082'),
	(27, 48, '2013-06-24 22:31:22', '+', 200.00, 'Deposited to the acount G1372131082 with amount : $200'),
	(28, 43, '2013-06-24 22:31:22', '+', 5.00, 'Your Silver account S1372057894  received a referral fee with amount : $5'),
	(29, 43, '2013-06-24 22:31:22', '+', 10.00, 'Your Gold account S1372057894  received a referral fee with amount: $10'),
	(30, 49, '2013-06-24 22:35:09', NULL, NULL, 'Registed'),
	(31, 49, '2013-06-24 22:35:09', NULL, NULL, 'Created gold account number G1372131309'),
	(32, 49, '2013-06-24 22:35:09', '+', 200.00, 'Deposited to the acount G1372131309 with amount : $200'),
	(33, 43, '2013-06-24 22:35:09', '+', 5.00, 'Your Silver account S1372057894  received a referral fee with amount : $5'),
	(34, 43, '2013-06-24 22:35:09', '+', 10.00, 'Your Gold account S1372057894  received a referral fee with amount: $10'),
	(35, 50, '2013-06-24 22:35:46', NULL, NULL, 'Registed'),
	(36, 50, '2013-06-24 22:35:46', NULL, NULL, 'Created gold account number G1372131346'),
	(37, 50, '2013-06-24 22:35:46', '+', 100.00, 'Deposited to your acount G1372131346 with amount : $100'),
	(38, 43, '2013-06-24 22:35:47', '+', 5.00, 'Your Silver account S1372057894 receiced a referral fee with amount : $5'),
	(39, 43, '2013-06-24 22:35:47', '+', 5.00, 'Your Gold Account G1372057843 received a  referral fee with amount : $5'),
	(40, 51, '2013-06-24 22:39:46', NULL, NULL, 'Registed'),
	(41, 51, '2013-06-24 22:39:46', NULL, NULL, 'Created gold account number G1372131586'),
	(42, 51, '2013-06-24 22:39:46', '+', 200.00, 'Deposited to the acount G1372131586 with amount : $200'),
	(43, 43, '2013-06-24 22:39:46', '+', 5.00, 'Your Silver account S1372057894  received a referral fee with amount : $5'),
	(44, 43, '2013-06-24 22:39:46', '+', 10.00, 'Your Gold account S1372057894  received a referral fee with amount: $10'),
	(45, 43, '2013-06-24 22:42:24', '+', 200.00, 'Deposited to the account G1372057843 with amount : $200'),
	(46, 43, '2013-06-24 22:46:09', '+', 100.00, 'Deposited to the account G1372057843 with amount : $100'),
	(47, 52, '2013-06-24 22:48:56', NULL, NULL, 'Registed'),
	(48, 52, '2013-06-24 22:48:56', NULL, NULL, 'Created gold account number G1372132136'),
	(49, 45, '2013-06-24 22:48:56', NULL, NULL, 'Created silver account number S1372132136'),
	(50, 45, '2013-06-24 22:48:56', '+', 5.00, 'Your Silver account S1372132136 receiced a referral fee with amount : $5');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.answer
DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_id` int(10) NOT NULL,
  `answer_content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.answer: ~1 rows (approximately)
DELETE FROM `answer`;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` (`id`, `question_id`, `answer_content`, `status`) VALUES
	(1, 3, '<p>Now I have:</p>\r\n<p>1st word: This 2nd word: Overflow</p>\r\n<p>Now I want the Minimum Distance count to be displayed as 2 (Since there is \'is Stack\' in between) and the Maximum Distance count to be displayed as 5 (Since there is \'is Stack Overflow + Enter + Stack\' in between)</p>\r\n<p>Need this in Shell/ Bash.</p>', 0);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.balance
DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.balance: ~10 rows (approximately)
DELETE FROM `balance`;
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 1, 2275.00),
	(2, 26, 460.00),
	(3, 27, 500.00),
	(4, 28, 30.00),
	(5, 29, 100.00),
	(6, 30, 100.00),
	(7, 31, 200.00),
	(8, 32, 200.00),
	(9, 33, 200.00),
	(10, 34, 100.00),
	(11, 35, 200.00),
	(12, 37, 5.00);
/*!40000 ALTER TABLE `balance` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.balance_history
DROP TABLE IF EXISTS `balance_history`;
CREATE TABLE IF NOT EXISTS `balance_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `balance` double(10,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.balance_history: ~0 rows (approximately)
DELETE FROM `balance_history`;
/*!40000 ALTER TABLE `balance_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `balance_history` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text,
  `serialized` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.config: ~38 rows (approximately)
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `group`, `code`, `key`, `value`, `serialized`) VALUES
	(126, 'payment', 'paypal', 'business', 'thuhuy_1317911597_per@gmail.com', 0),
	(127, 'payment', 'paypal', 'item_name', 'CYA Game payment', 0),
	(128, 'payment', 'paypal', 'currency_code', 'USD', 0),
	(129, 'payment', 'paypal', 'sandbox', '1', 0),
	(130, 'payment', 'paypal', 'active', '1', 0),
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
	(251, 'config', 'withdrawal', 'group', 'config', 0),
	(252, 'config', 'emails', 'protocol', 'smtp', 0),
	(253, 'config', 'emails', 'mail_parameter', '', 0),
	(254, 'config', 'emails', 'smtp_host', 'ssl://smtp.googlemail.com', 0),
	(255, 'config', 'emails', 'smtp_user', 'rongandat@gmail.com', 0),
	(256, 'config', 'emails', 'smtp_pass', 'anhyeuem123', 0),
	(257, 'config', 'emails', 'smtp_port', '465', 0),
	(258, 'config', 'emails', 'smtp_timeout', '30', 0),
	(259, 'config', 'emails', 'email_admin', 'admin@gmail.com', 0),
	(260, 'config', 'emails', 'group', 'config', 0),
	(262, 'config', 'levelupdate', 'level_update', '5', 0);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.email_template
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `subject` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.email_template: ~15 rows (approximately)
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


-- Dumping structure for table mlmcyaho_mlm.multilevel_sessions
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

-- Dumping data for table mlmcyaho_mlm.multilevel_sessions: ~13 rows (approximately)
DELETE FROM `multilevel_sessions`;
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
INSERT INTO `multilevel_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `created`) VALUES
	('1dbde9b50f7b422f9b542e433172c4ef', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0', 1372132316, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:6:{s:7:"main_id";s:1:"1";s:9:"firstname";s:4:"admn";s:8:"lastname";s:5:"admin";s:5:"email";s:15:"admin@gmail.com";s:6:"status";s:1:"1";s:10:"permission";s:13:"administrator";}}', '0000-00-00 00:00:00'),
	('233b31964f9ee7b4044ead31a58126fd', '173.0.82.126', '0', 1372131701, '', '0000-00-00 00:00:00'),
	('252db069f801f33a9f716475360d0305', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1372131658, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:6:{s:7:"main_id";s:2:"43";s:9:"firstname";s:5:"Khiem";s:8:"lastname";s:4:"Pham";s:5:"email";s:19:"khiemktqd@gmail.com";s:6:"status";s:1:"1";s:10:"permission";N;}}', '0000-00-00 00:00:00'),
	('3153775cfb5dc62c0eb56277aca0da26', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372131586, 'a:2:{s:9:"user_data";s:0:"";s:21:"flash:old:usermessage";a:4:{i:0;s:7:"success";i:1;s:5:"green";i:2;s:26:"Thank you for registering!";i:3;s:0:"";}}', '0000-00-00 00:00:00'),
	('3ae07cf6321133fca535e12b0c250b05', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372130508, 'a:2:{s:9:"user_data";s:0:"";s:21:"flash:new:usermessage";a:4:{i:0;s:7:"success";i:1;s:5:"green";i:2;s:26:"Thank you for registering!";i:3;s:0:"";}}', '0000-00-00 00:00:00'),
	('4accff36f90ed60233aece10e7366271', '173.0.82.126', '0', 1372131583, '', '0000-00-00 00:00:00'),
	('50e5c506a98a864bbc7262fc8608591f', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1372131023, '', '0000-00-00 00:00:00'),
	('5245ae53b4be6fa255c88ebb38718d43', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1372131257, '', '0000-00-00 00:00:00'),
	('533d2bb93bca9b1939efbe7e26bdcbd0', '173.0.82.126', '0', 1372131073, '', '0000-00-00 00:00:00'),
	('8c9fc07c4c6fad9a8ae464d732fc6e01', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', 1372132869, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:6:{s:7:"main_id";s:1:"1";s:9:"firstname";s:4:"admn";s:8:"lastname";s:5:"admin";s:5:"email";s:15:"admin@gmail.com";s:6:"status";s:1:"1";s:10:"permission";s:13:"administrator";}}', '0000-00-00 00:00:00'),
	('8fda5ca3a02353d6ead322bdd2e91a60', '173.0.82.126', '0', 1372131305, '', '0000-00-00 00:00:00'),
	('93433433c9a8d90fac7af0ac28608a52', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372131309, 'a:2:{s:9:"user_data";s:0:"";s:21:"flash:old:usermessage";a:4:{i:0;s:7:"success";i:1;s:5:"green";i:2;s:26:"Thank you for registering!";i:3;s:0:"";}}', '0000-00-00 00:00:00'),
	('93f3362add8d6ab9c52755ecf2309fad', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372131082, 'a:2:{s:9:"user_data";s:0:"";s:21:"flash:old:usermessage";a:4:{i:0;s:7:"success";i:1;s:5:"green";i:2;s:26:"Thank you for registering!";i:3;s:0:"";}}', '0000-00-00 00:00:00'),
	('afc7032db2e3cc2a5a6b2412bed4f6b7', '173.0.82.126', '0', 1372130221, '', '0000-00-00 00:00:00'),
	('b0bd4ef3cf7097d3173a286c022421ed', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1372134113, 'a:3:{s:9:"user_data";s:0:"";s:4:"user";a:6:{s:7:"main_id";s:1:"1";s:9:"firstname";s:4:"admn";s:8:"lastname";s:5:"admin";s:5:"email";s:15:"admin@gmail.com";s:6:"status";s:1:"1";s:10:"permission";s:13:"administrator";}s:8:"userlist";b:0;}', '0000-00-00 00:00:00'),
	('b222f02943280409b57b6d9991737345', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1372130250, '', '0000-00-00 00:00:00'),
	('c004d46ff3868c0bffafe46768ce2c53', '173.0.82.126', '0', 1372130504, '', '0000-00-00 00:00:00'),
	('c30f770eb01a86d168e734c0fb9832e5', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', 1372131934, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:6:{s:7:"main_id";s:2:"45";s:9:"firstname";s:5:"huyen";s:8:"lastname";s:6:"nguyen";s:5:"email";s:22:"thuhuyen1142@gmail.com";s:6:"status";s:1:"1";s:10:"permission";N;}}', '0000-00-00 00:00:00'),
	('c56d695962eabe5297f26bde7fb4eaab', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372128796, 'a:2:{s:9:"user_data";s:0:"";s:4:"user";a:6:{s:7:"main_id";s:2:"43";s:9:"firstname";s:5:"Khiem";s:8:"lastname";s:4:"Pham";s:5:"email";s:19:"khiemktqd@gmail.com";s:6:"status";s:1:"1";s:10:"permission";N;}}', '0000-00-00 00:00:00'),
	('ea4b702729abd0b687d0c4fcb566bea3', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372131706, '', '0000-00-00 00:00:00'),
	('ea5f61c146e1ea0d519c25884160e9c7', '173.0.82.126', '0', 1372131962, '', '0000-00-00 00:00:00'),
	('f544e519eafadbe53b8bbc5edab58782', '117.6.79.96', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0 FirePHP/0.7.2', 1372131319, 'a:1:{s:9:"user_data";s:0:"";}', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `multilevel_sessions` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.payment_history
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

-- Dumping data for table mlmcyaho_mlm.payment_history: ~0 rows (approximately)
DELETE FROM `payment_history`;
/*!40000 ALTER TABLE `payment_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_history` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.question
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

-- Dumping data for table mlmcyaho_mlm.question: ~3 rows (approximately)
DELETE FROM `question`;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id`, `main_user_id`, `title`, `content`, `created`, `status`, `admin_status`, `user_status`) VALUES
	(1, 43, 'Minimum and Maximum distance between any two occurrences of the word in the file', '<p>Now I have:</p>\r\n<p>1st word: This 2nd word: Overflow</p>\r\n<p>Now I want the Minimum Distance count to be displayed as 2 (Since there is \'is Stack\' in between) and the Maximum Distance count to be displayed as 5 (Since there is \'is Stack Overflow + Enter + Stack\' in between)</p>\r\n<p>Need this in Shell/ Bash.</p>', '2013-06-24 14:56:46', 0, 0, 0),
	(2, 43, 'ambiguos variant and boost spirit x3', '<p>trying to tweak the boost spirit x3 calc example to parse functions that can take functions as arguments. however it does not compile.</p>', '2013-06-24 14:57:07', 0, 0, 0),
	(3, 43, 'ambiguos variant and boost spirit x3', '<p>trying to tweak the boost spirit x3 calc example to parse functions that can take functions as arguments. however it does not compile.</p>', '2013-06-24 14:57:27', 0, 1, 0);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.transaction
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.transaction: ~19 rows (approximately)
DELETE FROM `transaction`;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `user_id`, `main_user_id`, `fees`, `total`, `created`, `transaction_id`, `payment_status`, `transaction_type`, `transaction_text`, `transaction_source`, `status`, `description`) VALUES
	(1, 26, 43, 35.00, 135.00, '2013-06-24 14:10:43', '2194793156', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(2, 27, 44, 35.00, 335.00, '2013-06-24 14:11:34', '2194793172', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(3, 28, 43, 0.00, 5.00, '2013-06-24 14:11:34', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem " succesfull'),
	(4, 26, 43, 0.00, 15.00, '2013-06-24 14:11:34', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(5, 27, 44, 10.00, 210.00, '2013-06-24 14:16:06', '2194793236', 'Completed', 'deposit', '+', 'creditcard', 1, ''),
	(6, 26, 43, 0.00, 10.00, '2013-06-24 14:16:06', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(7, 29, 45, 35.00, 135.00, '2013-06-24 22:14:52', '2194828310', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(8, 30, 46, 35.00, 135.00, '2013-06-24 22:17:06', '5L4301449W871543A', 'Completed', 'register', '+', 'paypal', 1, ''),
	(9, 31, 47, 35.00, 235.00, '2013-06-24 22:21:48', '40380914UV060072Y', 'Completed', 'register', '+', 'paypal', 1, ''),
	(10, 28, 43, 0.00, 5.00, '2013-06-24 22:21:48', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem " succesfull'),
	(11, 32, 48, 35.00, 235.00, '2013-06-24 22:31:22', '2R616074TE382740B', 'Completed', 'register', '+', 'paypal', 1, ''),
	(12, 28, 43, 0.00, 5.00, '2013-06-24 22:31:22', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem Pham" succesfull'),
	(13, 26, 43, 0.00, 10.00, '2013-06-24 22:31:22', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(14, 33, 49, 35.00, 235.00, '2013-06-24 22:35:09', '0RC1589710349920F', 'Completed', 'register', '+', 'paypal', 1, ''),
	(15, 28, 43, 0.00, 5.00, '2013-06-24 22:35:09', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem Pham" succesfull'),
	(16, 26, 43, 0.00, 10.00, '2013-06-24 22:35:09', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(17, 34, 50, 35.00, 135.00, '2013-06-24 22:35:46', '2194828611', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(18, 28, 43, 0.00, 5.00, '2013-06-24 22:35:47', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem " succesfull'),
	(19, 26, 43, 0.00, 5.00, '2013-06-24 22:35:47', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(20, 35, 51, 35.00, 235.00, '2013-06-24 22:39:46', '7U81787110876431G', 'Completed', 'register', '+', 'paypal', 1, ''),
	(21, 28, 43, 0.00, 5.00, '2013-06-24 22:39:46', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "Khiem Pham" succesfull'),
	(22, 26, 43, 0.00, 10.00, '2013-06-24 22:39:46', NULL, 'Completed', 'refere', '+', 'system', 0, 'The user "Khiem " deposited $100'),
	(23, 26, 43, 10.00, 210.00, '2013-06-24 22:42:24', '2194828739', 'Completed', 'deposit', '+', 'creditcard', 1, ''),
	(24, 26, 43, 10.00, 110.00, '2013-06-24 22:46:09', '1X529083GT0129814', 'Completed', 'deposit', '+', 'paypal', 1, ''),
	(25, 36, 52, 25.00, 25.00, '2013-06-24 22:48:56', '2194828929', 'Completed', 'register', '+', 'creditcard', 1, ''),
	(26, 37, 45, 0.00, 5.00, '2013-06-24 22:48:56', NULL, 'Completed', 'refere', '+', 'system', 0, 'User reffered the user "huyen " succesfull');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL DEFAULT '0',
  `acount_number` varchar(200) COLLATE utf16_bin NOT NULL,
  `usertype` int(11) DEFAULT NULL,
  `withdrawal_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table mlmcyaho_mlm.user: ~10 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `main_user_id`, `acount_number`, `usertype`, `withdrawal_date`) VALUES
	(1, 1, '', -1, NULL),
	(26, 43, 'G1372057843', 2, '2013-06-24'),
	(28, 43, 'S1372057894', 1, '2013-06-24'),
	(29, 45, 'G1372130092', 2, '2013-06-24'),
	(30, 46, 'G1372130226', 2, '2013-06-24'),
	(31, 47, 'G1372130508', 2, '2013-06-24'),
	(32, 48, 'G1372131082', 2, '2013-06-24'),
	(33, 49, 'G1372131309', 2, '2013-06-24'),
	(34, 50, 'G1372131346', 2, '2013-06-24'),
	(35, 51, 'G1372131586', 2, '2013-06-24'),
	(36, 52, 'G1372132136', 2, '2013-06-24'),
	(37, 45, 'S1372132136', 1, '2013-06-24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.users_groups
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) unsigned NOT NULL,
  `permission_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mlmcyaho_mlm.users_groups: ~3 rows (approximately)
DELETE FROM `users_groups`;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `permission_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.users_permission
DROP TABLE IF EXISTS `users_permission`;
CREATE TABLE IF NOT EXISTS `users_permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mlmcyaho_mlm.users_permission: ~2 rows (approximately)
DELETE FROM `users_permission`;
/*!40000 ALTER TABLE `users_permission` DISABLE KEYS */;
INSERT INTO `users_permission` (`permission_id`, `name`, `description`) VALUES
	(1, 'adminstrator', 'Supper Administrator'),
	(2, 'moderator', 'Moderator');
/*!40000 ALTER TABLE `users_permission` ENABLE KEYS */;


-- Dumping structure for table mlmcyaho_mlm.user_main
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table mlmcyaho_mlm.user_main: ~9 rows (approximately)
DELETE FROM `user_main`;
/*!40000 ALTER TABLE `user_main` DISABLE KEYS */;
INSERT INTO `user_main` (`main_id`, `firstname`, `lastname`, `email`, `password`, `address`, `referring`, `phone`, `status`, `forgotten_password_code`, `created_on`, `permission`) VALUES
	(1, 'admn', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 1, NULL, '0000-00-00 00:00:00', 'administrator'),
	(43, 'Khiem', 'Pham', 'khiemktqd@gmail.com', 'f0d15c5b747bd80cbaffd9ab3b85b8f9', 'Ha Noi', NULL, '01694046627', 1, NULL, '2013-06-24 14:10:42', NULL),
	(45, 'huyen', 'nguyen', 'thuhuyen1142@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'fhdsjfhs', NULL, '84942600100', 1, NULL, '2013-06-24 22:14:52', NULL),
	(46, 'huyen', '1', 'thuhuyen.k@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL, '', 1, NULL, '2013-06-24 22:17:06', NULL),
	(47, 'Khiem', 'Pham', 'khiesmktqd@gmail.com', 'cca36ce7fecd30e65744af60658e3615', 'Ha Noi', 43, '01694046627', 1, NULL, '2013-06-24 22:21:48', NULL),
	(48, 'Khiem', 'Pham', 'ronganldat@gmail.com', 'a125df34b9672894c18f220202d1164f', 'Ha Noi', 43, '32423', 1, NULL, '2013-06-24 22:31:22', NULL),
	(49, 'Khiem', 'Pham', 'ronfsfsgandat@gmail.com', 'ed03e1b15dcce2ff5b1ebddf27695fc4', 'Ha Noi', 43, '01694046627', 1, NULL, '2013-06-24 22:35:09', NULL),
	(50, 'Khiem', 'Pham', 'khiedmktqd@gmail.com', '1f1a12242dc581a47aee7024a20afc14', 'Ha Noi', 43, '01694046627', 1, NULL, '2013-06-24 22:35:46', NULL),
	(51, 'Khiem', 'Pham', 'rongandat@gmail.com', '2e0486addec269c0b3ffed69aa28dfb8', 'Ha Noi', 43, '01694046627', 1, NULL, '2013-06-24 22:39:46', NULL),
	(52, 'huyen', '2', 'huyen2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 45, '', 1, NULL, '2013-06-24 22:48:56', NULL);
/*!40000 ALTER TABLE `user_main` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
