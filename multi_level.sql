
DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.activity: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- Dumping structure for table multi_level.answer
DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_id` int(10) NOT NULL,
  `answer_content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.answer: ~0 rows (approximately)
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;


-- Dumping structure for table multi_level.balance
DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.balance: ~8 rows (approximately)
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`id`, `user_id`, `balance`) VALUES
	(1, 1, -37420.00),
	(2, 7, 1500.00),
	(3, 8, 500.00),
	(4, 9, 115.00),
	(5, 12, 5.00),
	(6, 11, 300.00),
	(7, 10, 41975.00),
	(8, 13, 200.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=362 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.config: ~45 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `group`, `code`, `key`, `value`, `serialized`) VALUES
	(234, 'config', 'referraldefault', 'default_referral_user', 'U1369627271', 0),
	(235, 'config', 'timeconfig', 'time_format', '30', 0),
	(263, 'config', 'emails', 'protocol', 'mail', 0),
	(264, 'config', 'emails', 'mail_parameter', '', 0),
	(265, 'config', 'emails', 'smtp_host', 'ssl://smtp.googlemail.com', 0),
	(266, 'config', 'emails', 'smtp_user', 'rongandat@gmail.com', 0),
	(267, 'config', 'emails', 'smtp_pass', 'anhyeuem123', 0),
	(268, 'config', 'emails', 'smtp_port', '465', 0),
	(269, 'config', 'emails', 'smtp_timeout', '30', 0),
	(270, 'config', 'emails', 'email_admin', 'admin@gmail.com', 0),
	(271, 'config', 'emails', 'group', 'config', 0),
	(272, 'config', 'withdrawal', 'days_space_gold', '365', 0),
	(273, 'config', 'withdrawal', 'days_space_silver', '60', 0),
	(274, 'config', 'withdrawal', 'min_of_gold', '50', 0),
	(275, 'config', 'withdrawal', 'min_of_silver', '20', 0),
	(276, 'config', 'withdrawal', 'group', 'config', 0),
	(279, 'config', 'levelupdate', 'level_update', '6', 0),
	(321, 'config', 'transaction_fees', 'open_fee', '25', 0),
	(322, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
	(323, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
	(324, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
	(325, 'config', 'transaction_fees', 'max_enrolment_silver_amount', '100', 0),
	(326, 'config', 'transaction_fees', 'group', 'config', 0),
	(327, 'config', 'referral', 'percentage_gold', '5', 0),
	(328, 'config', 'referral', 'bonus_percentage_silver', '2', 0),
	(329, 'config', 'referral', 'bonus_percentage_gold', '5', 0),
	(330, 'config', 'referral', 'percent_referral_fees', '15', 0),
	(331, 'config', 'referral', 'referral_fees', '5', 0),
	(332, 'config', 'referral', 'referral_bonus_default', '25', 0),
	(333, 'config', 'referral', 'referral_bonus', 'a:6:{i:1;a:3:{s:3:"min";s:1:"1";s:3:"max";s:1:"5";s:6:"refere";s:2:"50";}i:2;a:3:{s:3:"min";s:1:"6";s:3:"max";s:2:"10";s:6:"refere";s:2:"55";}i:3;a:3:{s:3:"min";s:2:"11";s:3:"max";s:2:"15";s:6:"refere";s:2:"60";}i:4;a:3:{s:3:"min";s:2:"16";s:3:"max";s:2:"20";s:6:"refere";s:2:"65";}i:5;a:3:{s:3:"min";s:2:"21";s:3:"max";s:2:"25";s:6:"refere";s:2:"70";}i:6;a:3:{s:3:"min";s:2:"25";s:3:"max";s:0:"";s:6:"refere";s:3:"100";}}', 1),
	(334, 'payment', 'paypal', 'business', 'thuhuy_1317911597_per@gmail.com', 0),
	(335, 'payment', 'paypal', 'item_name', 'CYA Game payment', 0),
	(336, 'payment', 'paypal', 'currency_code', 'USD', 0),
	(337, 'payment', 'paypal', 'sandbox', '1', 0),
	(351, 'payment', 'creditcard', 'title', 'Credit Card', 0),
	(352, 'payment', 'creditcard', 'login_id', '6Z2Kgs6W7m', 0),
	(353, 'payment', 'creditcard', 'transaction', '49yh68ESgd4Sd2Mw', 0),
	(354, 'payment', 'creditcard', 'authorizenet_aim_method', 'authorization', 0),
	(355, 'payment', 'creditcard', 'sandbox', '1', 0),
	(356, 'payment', 'creditcard', 'active', '1', 0),
	(357, 'payment', 'aw_quickpay', 'title', 'Allied Wallet QuickPay', 0),
	(358, 'payment', 'aw_quickpay', 'MerchantID', 'c22d8c35-0af6-463b-9180-c57642039e88', 0),
	(359, 'payment', 'aw_quickpay', 'SiteID', 'a3d993b1-b997-4f66-90a5-79ff2240815f', 0),
	(360, 'payment', 'aw_quickpay', 'aw_currency', 'USD', 0),
	(361, 'payment', 'aw_quickpay', 'active', '1', 0);
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

-- Dumping data for table multi_level.email_template: ~25 rows (approximately)
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

-- Dumping data for table multi_level.multilevel_sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `multilevel_sessions` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.question: ~0 rows (approximately)
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.transaction: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


-- Dumping structure for table multi_level.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `main_user_id` int(10) NOT NULL DEFAULT '0',
  `acount_number` varchar(200) COLLATE utf16_bin NOT NULL,
  `usertype` int(11) DEFAULT NULL,
  `withdrawal_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `main_user_id`, `acount_number`, `usertype`, `withdrawal_date`, `created`) VALUES
	(1, 1, '', -1, NULL, '2013-08-22 00:00:00');
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


-- Dumping structure for table multi_level.user_main
DROP TABLE IF EXISTS `user_main`;
CREATE TABLE IF NOT EXISTS `user_main` (
  `main_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `main_account_number` varchar(200) NOT NULL,
  `address` text,
  `referring` int(10) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `forgotten_password_code` varchar(300) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `permission` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.user_main: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_main` DISABLE KEYS */;
INSERT INTO `user_main` (`main_id`, `username`, `firstname`, `lastname`, `email`, `password`, `main_account_number`, `address`, `referring`, `phone`, `status`, `forgotten_password_code`, `created_on`, `permission`) VALUES
	(1, 'administrator', 'admn', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, '', 1, NULL, '0000-00-00 00:00:00', 'administrator');
/*!40000 ALTER TABLE `user_main` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
