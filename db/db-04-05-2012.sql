-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-04 13:55:41
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

-- Dumping data for table multi_level.config: ~19 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `group`, `code`, `key`, `value`, `serialized`) VALUES
	(65, 'config', 'transaction_fees', 'open_fee', '25', 0),
	(66, 'config', 'transaction_fees', 'transaction_fee', '10', 0),
	(67, 'config', 'transaction_fees', 'min_enrolment_entry_amount', '100', 0),
	(68, 'config', 'transaction_fees', 'max_enrolment_entry_amount', '500', 0),
	(69, 'config', 'transaction_fees', 'group', 'config', 0),
	(78, 'config', 'referral', 'referring_percentage', '1', 0),
	(79, 'config', 'referral', 'interest_race', '', 0),
	(96, 'config', 'emails', 'protocol', 'mail', 0),
	(97, 'config', 'emails', 'mail_parameter', '', 0),
	(98, 'config', 'emails', 'smtp_host', '', 0),
	(99, 'config', 'emails', 'smtp_user', '', 0),
	(100, 'config', 'emails', 'smtp_pass', '', 0),
	(101, 'config', 'emails', 'smtp_port', '25', 0),
	(102, 'config', 'emails', 'smtp_timeout', '', 0),
	(103, 'config', 'emails', 'group', 'config', 0),
	(121, 'payment', 'paypal', 'business', 'hungnm.ceo@gmail.com', 0),
	(122, 'payment', 'paypal', 'item_name', 'CYA Game payment', 0),
	(123, 'payment', 'paypal', 'currency_code', 'USD', 0),
	(124, 'payment', 'paypal', 'sandbox', '1', 0),
	(125, 'payment', 'paypal', 'active', '1', 0);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;



-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-06 09:59:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user`
	ADD COLUMN `transaction_start` DATE NULL DEFAULT NULL AFTER `permission`,
	ADD COLUMN `transaction_finish` DATE NULL DEFAULT NULL AFTER `transaction_start`;

ALTER TABLE `user`
	CHANGE COLUMN `transaction_start` `transaction_start` DATETIME NULL DEFAULT NULL AFTER `permission`,
	CHANGE COLUMN `transaction_finish` `transaction_finish` DATETIME NULL DEFAULT NULL AFTER `transaction_start`;