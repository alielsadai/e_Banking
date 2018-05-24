-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ebanking.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `account_type_id` int(10) unsigned NOT NULL,
  `balance` double unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`),
  KEY `fk_account_type_id2` (`account_type_id`),
  KEY `fk_user_id2` (`user_id`),
  CONSTRAINT `fk_account_type_id2` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.account: ~13 rows (approximately)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`account_id`, `user_id`, `account_type_id`, `balance`) VALUES
	(28, 16, 5, 100),
	(30, 16, 6, 116.72272727273),
	(31, 16, 7, 545),
	(71, 63, 5, 11),
	(72, 63, 7, 1000),
	(73, 65, 5, 6900),
	(74, 67, 5, 0),
	(75, 68, 5, 0),
	(76, 69, 5, 0),
	(77, 68, 6, 10),
	(78, 66, 6, 1000),
	(79, 65, 6, 10),
	(80, 65, 7, 100),
	(92, 63, 6, 10),
	(93, 66, 5, 10),
	(94, 70, 5, 2),
	(95, 70, 6, 3);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dumping structure for table ebanking.account_type
DROP TABLE IF EXISTS `account_type`;
CREATE TABLE IF NOT EXISTS `account_type` (
  `account_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_type` enum('EUR','USD','RSD') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`account_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.account_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `account_type` DISABLE KEYS */;
INSERT INTO `account_type` (`account_type_id`, `account_type`) VALUES
	(5, 'EUR'),
	(6, 'USD'),
	(7, 'RSD');
/*!40000 ALTER TABLE `account_type` ENABLE KEYS */;

-- Dumping structure for view ebanking.account_view
DROP VIEW IF EXISTS `account_view`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `account_view` (
	`user_id` INT(10) UNSIGNED NOT NULL,
	`account_id` INT(10) UNSIGNED NOT NULL,
	`balance` DOUBLE NOT NULL,
	`account_type` ENUM('EUR','USD','RSD') NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for table ebanking.city
DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_country_id` (`country_id`),
  CONSTRAINT `fk_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.city: ~9 rows (approximately)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`city_id`, `name`, `country_id`) VALUES
	(13, 'Tripoli', 84),
	(14, 'Pancevo', 85),
	(52, 'Belgrade', 85),
	(53, 'Novi Sad', 85),
	(55, 'Misurata', 84),
	(56, 'Zliten', 84),
	(57, 'Barcelona', 151),
	(58, 'Nis', 85),
	(59, 'bbb', 84);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Dumping structure for table ebanking.country
DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.country: ~3 rows (approximately)
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`country_id`, `name`) VALUES
	(84, 'Libya'),
	(85, 'Serbia'),
	(151, 'Spain');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;

-- Dumping structure for table ebanking.exchange_rate
DROP TABLE IF EXISTS `exchange_rate`;
CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `exchange_rate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `currency` varchar(50) NOT NULL DEFAULT '0',
  `buying_rate` float NOT NULL,
  `selling_rate` float NOT NULL,
  `rate_date` date NOT NULL,
  PRIMARY KEY (`exchange_rate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.exchange_rate: ~2 rows (approximately)
/*!40000 ALTER TABLE `exchange_rate` DISABLE KEYS */;
INSERT INTO `exchange_rate` (`exchange_rate_id`, `currency`, `buying_rate`, `selling_rate`, `rate_date`) VALUES
	(1, 'EUR', 119.5, 120, '2017-11-05'),
	(2, 'USD', 109, 110, '0000-00-00');
/*!40000 ALTER TABLE `exchange_rate` ENABLE KEYS */;

-- Dumping structure for table ebanking.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `login_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`login_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.login: ~33 rows (approximately)
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`login_id`, `user_id`, `login_post`) VALUES
	(150, 16, '2017-12-10 02:51:57'),
	(151, 16, '2017-12-11 13:29:54'),
	(152, 16, '2017-12-11 22:41:36'),
	(153, 16, '2017-12-12 00:27:45'),
	(154, 16, '2017-12-12 08:21:17'),
	(155, 16, '2017-12-13 01:40:37'),
	(156, 16, '2017-12-13 11:47:09'),
	(157, 69, '2017-12-13 13:26:39'),
	(158, 16, '2017-12-13 13:27:58'),
	(159, 16, '2017-12-13 13:28:15'),
	(160, 16, '2017-12-14 10:05:13'),
	(161, 16, '2017-12-15 12:23:15'),
	(162, 16, '2017-12-18 08:30:45'),
	(163, 16, '2017-12-18 15:48:19'),
	(164, 16, '2017-12-18 16:03:00'),
	(165, 16, '2017-12-18 16:03:30'),
	(166, 16, '2017-12-18 16:03:56'),
	(167, 16, '2017-12-18 16:04:41'),
	(168, 16, '2017-12-21 14:18:29'),
	(169, 16, '2017-12-22 08:46:09'),
	(170, 16, '2018-01-04 14:22:17'),
	(171, 16, '2018-01-06 15:57:20'),
	(172, 16, '2018-01-06 15:58:57'),
	(173, 16, '2018-01-06 15:59:51'),
	(174, 16, '2018-01-06 16:00:21'),
	(175, 16, '2018-01-06 17:05:20'),
	(176, 16, '2018-01-06 17:05:29'),
	(177, 16, '2018-01-06 17:14:01'),
	(178, 16, '2018-01-06 17:14:10'),
	(179, 16, '2018-01-06 19:23:51'),
	(180, 16, '2018-01-06 20:18:48'),
	(181, 16, '2018-01-06 20:19:07'),
	(182, 16, '2018-01-07 20:10:31'),
	(183, 16, '2018-01-08 15:51:38'),
	(184, 16, '2018-01-08 15:54:13'),
	(185, 16, '2018-01-08 18:12:01'),
	(186, 16, '2018-01-10 13:54:41'),
	(187, 16, '2018-01-10 17:05:08'),
	(188, 65, '2018-01-10 17:08:54');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Dumping structure for table ebanking.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `transaction_type_id` int(10) unsigned NOT NULL,
  `exchange_rate_id` int(10) unsigned DEFAULT '0',
  `purpose` varchar(255) NOT NULL,
  `transaction_amount` double NOT NULL,
  `transaction_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`),
  KEY `fk_account_id` (`account_id`),
  KEY `fk_transaction_type_id` (`transaction_type_id`),
  KEY `exchange_rate_id` (`exchange_rate_id`),
  CONSTRAINT `fk_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_exchange_rate_id` FOREIGN KEY (`exchange_rate_id`) REFERENCES `exchange_rate` (`exchange_rate_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_transaction_type_id` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_type` (`transaction_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.transaction: ~11 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`transaction_id`, `account_id`, `transaction_type_id`, `exchange_rate_id`, `purpose`, `transaction_amount`, `transaction_post`) VALUES
	(220, 28, 1, 1, 'No reason', 10, '2017-12-12 13:24:16'),
	(221, 30, 2, 2, 'No reason', 10.863636363636, '2017-12-12 13:24:16'),
	(222, 28, 1, 1, 'No reason', 5, '2017-12-14 15:17:28'),
	(223, 30, 2, 2, 'No reason', 5.4318181818182, '2017-12-14 15:17:28'),
	(224, 28, 1, 1, 'No reason', 1, '2017-12-15 15:47:39'),
	(225, 31, 2, 1, 'No reason', 119.5, '2017-12-15 15:47:39'),
	(226, 28, 1, 1, 'No reason', 5, '2017-12-15 15:48:27'),
	(227, 31, 2, 1, 'No reason', 597.5, '2017-12-15 15:48:27'),
	(228, 28, 1, 1, 'No reason', 5, '2017-12-15 15:49:56'),
	(229, 31, 2, 1, 'No reason', 597.5, '2017-12-15 15:49:57'),
	(230, 28, 1, NULL, 'No reason', 1, '2017-12-15 15:57:04'),
	(231, 71, 2, NULL, 'No reason', 1, '2017-12-15 15:57:04'),
	(232, 28, 1, 1, 'No reason', 1, '2017-12-18 15:49:25'),
	(233, 30, 2, 2, 'No reason', 1.0863636363636, '2017-12-18 15:49:25'),
	(234, 30, 1, 2, 'test', 5, '2018-01-07 15:52:47'),
	(235, 31, 2, 2, 'test', 545, '2018-01-07 15:52:47'),
	(236, 73, 1, 1, 'No reason', 100, '2018-01-10 17:11:23'),
	(237, 30, 2, 2, 'No reason', 108.63636363636, '2018-01-10 17:11:23');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;

-- Dumping structure for table ebanking.transaction_type
DROP TABLE IF EXISTS `transaction_type`;
CREATE TABLE IF NOT EXISTS `transaction_type` (
  `transaction_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transaction_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table ebanking.transaction_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` (`transaction_type_id`, `transaction_type`) VALUES
	(1, 'Withdrawal'),
	(2, 'Deposite');
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;

-- Dumping structure for view ebanking.transaction_view
DROP VIEW IF EXISTS `transaction_view`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `transaction_view` (
	`account_id` INT(10) UNSIGNED NOT NULL,
	`transaction_id` INT(10) UNSIGNED NOT NULL,
	`account_type` ENUM('EUR','USD','RSD') NOT NULL COLLATE 'utf8_unicode_ci',
	`balance` DOUBLE NOT NULL,
	`transaction_type` VARCHAR(10) NOT NULL COLLATE 'utf8_unicode_ci',
	`transaction_amount` DOUBLE NOT NULL,
	`purpose` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`transaction_post` TIMESTAMP NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for table ebanking.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` enum('Client','Admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Single','Married','Divorced') COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_registration` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `birth_city_id` int(10) unsigned DEFAULT NULL,
  `residence_city_id` int(10) unsigned DEFAULT NULL,
  `active` enum('True','False') COLLATE utf8_unicode_ci DEFAULT 'True',
  PRIMARY KEY (`user_id`),
  KEY `fk_birth_city_id` (`birth_city_id`),
  KEY `fk_residence_city_id` (`residence_city_id`),
  CONSTRAINT `fk_birth_city_id` FOREIGN KEY (`birth_city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_residence_city_id` FOREIGN KEY (`residence_city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ebanking.user: ~7 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `user_type`, `gender`, `status`, `mobile_no`, `address`, `date_of_birth`, `date_of_registration`, `birth_city_id`, `residence_city_id`, `active`) VALUES
	(16, 'Ali', 'Elsadai', 'admin@admin.com', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Admin', 'Male', 'Single', '0612067070', 'Zarka Zrenjanina 3/20', '1996-02-20', '2017-11-05 15:38:37', 55, 14, 'True'),
	(63, 'Zoran', 'Nenadic', 'Zoran@gmail.com', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Client', 'Male', 'Single', '0610000000', 'Jadranska', '1996-02-20', '2017-12-09 11:56:01', 55, 53, 'True'),
	(65, 'Ahmed', 'Essdai', 'essdai64@hotmail.com', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Client', 'Male', 'Married', '0611454343', 'Zarka Zrenjanina 3/20', '1964-04-24', '2017-12-10 02:57:51', 56, 14, 'True'),
	(66, 'Peter', 'Petroovic', 'ppeter@peter.rs', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Admin', 'Male', 'Single', '0666666666', 'Test address 5', '1988-04-24', '2017-12-13 11:18:13', 55, 52, 'True'),
	(67, 'Stefana', 'Lakic', 'nedzmedins@outlook.com', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Client', 'Male', 'Single', '12333', 'Jadranska 4', '1964-04-24', '2017-12-13 11:19:33', 59, 58, 'True'),
	(68, 'Test', 'Tester', 'test@test.rs', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Client', 'Male', 'Married', '0622222222', 'Trudnicka 2', '1996-02-20', '2017-12-13 11:20:33', 52, 58, 'True'),
	(69, 'test', 'test', 'testpassword@test.com', 'a325311afdadbcd83491408a5ee023830ab37f447449bb7f485f7c149462e052dd26e59c7ca9706cc33258f2099798e31c7b56b8ec3f6e2e2e336dfdbeb14cfb', 'Admin', 'Male', 'Single', '0610000000', 'Jadranska', '1996-02-20', '2017-12-13 13:25:30', 55, 58, 'True'),
	(70, 'Stefan1', 'Lakic1', 'aliahmed9621111@hotmail.com', '059605f372534ee5b818f50beda95a28f62214720c8526c32da3311962033c74f55d7dac05196affa57716e5d43bce8b91df62543632637a8c11de5faa6a8852', 'Client', 'Male', 'Single', '0610000000', 'Jadranska', '1996-02-21', '2018-01-10 17:05:48', 55, 58, 'True');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for view ebanking.user_view
DROP VIEW IF EXISTS `user_view`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `user_view` (
	`user_id` INT(10) UNSIGNED NOT NULL,
	`first_name` VARCHAR(255) NULL COLLATE 'utf8_unicode_ci',
	`last_name` VARCHAR(255) NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(255) NULL COLLATE 'utf8_unicode_ci',
	`user_type` ENUM('Client','Admin') NULL COLLATE 'utf8_unicode_ci',
	`gender` ENUM('Male','Female') NULL COLLATE 'utf8_unicode_ci',
	`status` ENUM('Single','Married','Divorced') NULL COLLATE 'utf8_unicode_ci',
	`date_of_birth` DATE NULL,
	`address` VARCHAR(255) NULL COLLATE 'utf8_unicode_ci',
	`mobile_no` VARCHAR(20) NULL COLLATE 'utf8_unicode_ci',
	`date_of_registration` TIMESTAMP NULL,
	`birth_city` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`birth_country` VARCHAR(255) NULL COLLATE 'utf8_unicode_ci',
	`residence_city` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`residence_country` VARCHAR(255) NULL COLLATE 'utf8_unicode_ci',
	`active` ENUM('True','False') NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Dumping structure for view ebanking.account_view
DROP VIEW IF EXISTS `account_view`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `account_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `account_view` AS SELECT u.user_id, a.account_id, a.balance, at.account_type From `user` u
                INNER JOIN `account` a ON u.user_id = a.user_id
                INNER JOIN `account_type` at ON a.account_type_id = at.account_type_id ;

-- Dumping structure for view ebanking.transaction_view
DROP VIEW IF EXISTS `transaction_view`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `transaction_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaction_view` AS SELECT ac.account_id, t.transaction_id,  act.account_type, ac.balance, tt.transaction_type, t.transaction_amount, t.purpose, t.transaction_post 
                    FROM `user` u
                        INNER JOIN `account` ac ON u.user_id = ac.user_id
                        INNER JOIN `account_type` act ON ac.account_type_id = act.account_type_id
                        INNER JOIN `transaction` t ON ac.account_id = t.account_id
                        INNER JOIN `transaction_type` tt ON t.transaction_type_id = tt.transaction_type_id
                     ORDER BY t.transaction_post ASC ;

-- Dumping structure for view ebanking.user_view
DROP VIEW IF EXISTS `user_view`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `user_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_view` AS SELECT u.user_id, u.first_name, u.last_name, u.email, u.user_type, gender, status, u.date_of_birth, u.address, u.mobile_no, u.date_of_registration, ci1.name AS "birth_city",
				(select co.name from country co inner join city ci on co.country_id = ci.country_id where ci.name Like ci1.name) AS "birth_country",
				ci2.name AS "residence_city",
				(select co.name from country co inner join city ci on co.country_id = ci.country_id where ci.name Like ci2.name) AS "residence_country",
				u.active
			  From `user` u
				INNER JOIN `city` ci1 ON ci1.city_id = u.birth_city_id
				INNER JOIN `city` ci2 ON ci2.city_id = u.residence_city_id
				INNER JOIN `country` co ON co.country_id = ci1.country_id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
ebankingtransaction_type