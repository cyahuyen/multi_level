-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-05-02 16:45:35
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- Dumping data for table multi_level.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `username`, `fullname`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`, `permission`) VALUES
	(9, 'thuhuyen', '', 'd2d251e8d263b7adae3c0fdee01ce65b', 'Hai duong', 2147483647, 'ngoclecong@gmail.com', 2147483647, '12/12/1989', 0, 1, 1, '5609533015', '2013-04-25 16:11:12', 'administrator'),
	(10, 'congngocvn', '', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'Xuan loc - Can Loc - ha Tinh', 978344219, 'congngocvn@gmail.com', 978344219, '10-12-1989', 0, 0, 0, '', '2013-04-25 17:42:38', 'administrator');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
