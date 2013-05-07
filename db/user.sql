-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-07 17:00:39
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `fullname`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`, `permission`, `transaction_start`, `transaction_finish`) VALUES
	(9, 'Thu Huyen', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'Hai duong', 2147483647, 'ngoclecong@gmail.com', 2147483647, '12/12/1989', 0, 2, 1, '5609533015', '2013-04-25 16:11:12', '', NULL, NULL),
	(10, 'Lê Công Ngọc', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'Xuân Lộc - Can Lộc - Hà Tĩnh', 978344219, 'congngocvn@gmail.com', 978344219, '10-12-1989', 0, 1, 1, '1436509965', '2013-04-25 17:42:38', 'administrator', '2013-05-06 16:47:12', '2013-06-05 16:47:12'),
	(14, 'fsdfsdf', '96e79218965eb72c92a549dd5a330112', '105 Lang Ha', 234234, 'khiemktqd@gmail.com', 165235952, '1989-05-02', 0, 0, 1, '', '2013-05-03 17:35:13', NULL, NULL, NULL),
	(40, 'Khiem Pham', '7085e6b4fb5bf71436221f6ccd1af40c', '', 0, 'rongandat@gmail.com', 0, '1989-05-02', 10, 2, 1, '', '2013-05-07 14:15:33', NULL, '2013-05-07 14:15:34', '2013-06-06 14:15:34'),
	(41, 'Nguy&#7877;n Thu Huy&#7873;n', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'dsadsa', 978344219, 'bagiahuyen@gmail.com', 978344219, '2013-05-08', 0, 1, 1, '', '0000-00-00 00:00:00', 'administrator', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
