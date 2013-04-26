-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 26 Avril 2013 à 10:25
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `chihuyen`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactname` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `created_on` datetime NOT NULL,
  `group_id` int(10) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `contactname`, `username`, `created_on`, `group_id`, `last_login`, `ip_address`) VALUES
(1, 'ngoclecong@gmail.com', '2dcd129bcf58cec2216566d510ecdffa:8b', 'Le Cong Ngoc', 'administrator', '2012-11-21 14:41:21', 1, '2013-04-25 16:26:45', '0.0.0.0'),
(2, 'ngdasd@gmail.com', 'e366dfae7d9a1a60d788e1bd3d45e5ea:d0', 'Le ngoc 3', 'ngocngo312', '2013-04-25 16:10:47', 2, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Structure de la table `groups_admin`
--

CREATE TABLE IF NOT EXISTS `groups_admin` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `groups_admin`
--

INSERT INTO `groups_admin` (`group_id`, `name`, `description`, `permission`) VALUES
(1, 'adminstrator', 'Supper Administrator', 'a:15:{s:7:"account";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:7:"setting";a:3:{s:5:"index";s:1:"1";s:4:"edit";s:1:"1";s:11:"listSetting";s:1:"1";}s:8:"language";a:5:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";s:7:"general";s:1:"1";}s:6:"emails";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:8:"question";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:4:"news";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:3:"faq";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:4:"user";a:4:{s:5:"index";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";s:4:"view";s:1:"1";}s:10:"currencies";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:17:"fees_transactions";a:2:{s:5:"index";s:1:"1";s:6:"update";s:1:"1";}s:5:"funds";a:3:{s:5:"index";s:1:"1";s:7:"confirm";s:1:"1";s:7:"succeed";s:1:"1";}s:8:"transfer";a:2:{s:5:"index";s:1:"1";s:4:"view";s:1:"1";}s:10:"permission";a:2:{s:5:"index";s:1:"1";s:6:"update";s:1:"1";}s:7:"payment";a:4:{s:5:"index";s:1:"1";s:6:"insert";s:1:"1";s:6:"update";s:1:"1";s:6:"delete";s:1:"1";}s:8:"contacts";a:2:{s:5:"index";s:1:"1";s:4:"view";s:1:"1";}}'),
(2, 'moderator', 'Moderator', '');

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` date NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `closed_date` date NOT NULL,
  `closed_by_id` int(11) NOT NULL,
  `status` varchar(8) NOT NULL,
  `title` varchar(200) NOT NULL,
  `customer` varchar(200) NOT NULL,
  `start_date` date DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `loudjob_sessions`
--

CREATE TABLE IF NOT EXISTS `loudjob_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf16_bin NOT NULL,
  `password` varchar(150) COLLATE utf16_bin NOT NULL,
  `address` varchar(150) COLLATE utf16_bin NOT NULL,
  `phone` int(12) NOT NULL,
  `email` varchar(100) COLLATE utf16_bin NOT NULL,
  `fax` int(12) NOT NULL,
  `birthday` varchar(50) COLLATE utf16_bin NOT NULL,
  `referring` int(11) NOT NULL,
  `usertype` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `forgotten_password_code` varchar(255) COLLATE utf16_bin NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_bin AUTO_INCREMENT=11 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `address`, `phone`, `email`, `fax`, `birthday`, `referring`, `usertype`, `status`, `forgotten_password_code`, `created_on`) VALUES
(9, 'thuhuyen', 'd2d251e8d263b7adae3c0fdee01ce65b', 'Hai duong', 2147483647, 'ngoclecong@gmail.com', 2147483647, '12/12/1989', 0, 1, 1, '5609533015', '2013-04-25 16:11:12'),
(10, 'congngocvn', '2a547a7fb83b9922f2dbc6c47b20f8f9', 'Xuan loc - Can Loc - ha Tinh', 978344219, 'congngocvn@gmail.com', 978344219, '10-12-1989', 0, 0, 0, '', '2013-04-25 17:42:38');

-- --------------------------------------------------------

--
-- Structure de la table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `fullname`, `phone`, `mobile`) VALUES
(1, 1, 'Administrator', '', ''),
(2, 2, 'User1 (test)', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
