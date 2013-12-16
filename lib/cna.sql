-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for cna
DROP DATABASE IF EXISTS `cna`;
CREATE DATABASE IF NOT EXISTS `cna` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cna`;


-- Dumping structure for table cna.acos
DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;

-- Dumping data for table cna.acos: ~203 rows (approximately)
DELETE FROM `acos`;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
	(1, NULL, NULL, NULL, 'controllers', 1, 2),
	(2, NULL, NULL, NULL, 'controllers', 3, 376),
	(3, 2, NULL, NULL, 'Errors', 4, 9),
	(4, 3, NULL, NULL, 'index', 5, 6),
	(5, 3, NULL, NULL, 'get_user', 7, 8),
	(6, 2, NULL, NULL, 'Groups', 10, 25),
	(7, 6, NULL, NULL, 'index', 11, 12),
	(8, 6, NULL, NULL, 'view', 13, 14),
	(9, 6, NULL, NULL, 'add', 15, 16),
	(10, 6, NULL, NULL, 'edit', 17, 18),
	(11, 6, NULL, NULL, 'delete', 19, 20),
	(12, 6, NULL, NULL, 'getgroup', 21, 22),
	(13, 6, NULL, NULL, 'get_user', 23, 24),
	(14, 2, NULL, NULL, 'Pages', 26, 31),
	(15, 14, NULL, NULL, 'display', 27, 28),
	(16, 14, NULL, NULL, 'get_user', 29, 30),
	(17, 2, NULL, NULL, 'Post', 32, 37),
	(18, 17, NULL, NULL, 'add', 33, 34),
	(19, 17, NULL, NULL, 'get_user', 35, 36),
	(20, 2, NULL, NULL, 'Posts', 38, 51),
	(21, 20, NULL, NULL, 'index', 39, 40),
	(22, 20, NULL, NULL, 'view', 41, 42),
	(23, 20, NULL, NULL, 'add', 43, 44),
	(24, 20, NULL, NULL, 'edit', 45, 46),
	(25, 20, NULL, NULL, 'delete', 47, 48),
	(26, 20, NULL, NULL, 'get_user', 49, 50),
	(27, 2, NULL, NULL, 'Settings', 52, 67),
	(28, 27, NULL, NULL, 'index', 53, 54),
	(29, 27, NULL, NULL, 'view', 55, 56),
	(30, 27, NULL, NULL, 'add', 57, 58),
	(31, 27, NULL, NULL, 'edit', 59, 60),
	(32, 27, NULL, NULL, 'delete', 61, 62),
	(33, 27, NULL, NULL, 'get_settings', 63, 64),
	(34, 27, NULL, NULL, 'get_user', 65, 66),
	(35, 2, NULL, NULL, 'Users', 68, 93),
	(36, 35, NULL, NULL, 'index', 69, 70),
	(37, 35, NULL, NULL, 'view', 71, 72),
	(38, 35, NULL, NULL, 'add', 73, 74),
	(39, 35, NULL, NULL, 'edit', 75, 76),
	(40, 35, NULL, NULL, 'delete', 77, 78),
	(41, 35, NULL, NULL, 'login', 79, 80),
	(42, 35, NULL, NULL, 'logout', 81, 82),
	(43, 35, NULL, NULL, 'initDB', 83, 84),
	(44, 35, NULL, NULL, 'profile', 85, 86),
	(45, 35, NULL, NULL, 'profile_edit', 87, 88),
	(46, 35, NULL, NULL, 'get_user', 89, 90),
	(47, 2, NULL, NULL, 'Widgets', 94, 107),
	(48, 47, NULL, NULL, 'index', 95, 96),
	(49, 47, NULL, NULL, 'view', 97, 98),
	(50, 47, NULL, NULL, 'add', 99, 100),
	(51, 47, NULL, NULL, 'edit', 101, 102),
	(52, 47, NULL, NULL, 'delete', 103, 104),
	(53, 47, NULL, NULL, 'get_user', 105, 106),
	(54, 2, NULL, NULL, 'AclExtras', 108, 109),
	(55, 2, NULL, NULL, 'DebugKit', 110, 119),
	(56, 55, NULL, NULL, 'ToolbarAccess', 111, 118),
	(57, 56, NULL, NULL, 'history_state', 112, 113),
	(58, 56, NULL, NULL, 'sql_explain', 114, 115),
	(59, 56, NULL, NULL, 'get_user', 116, 117),
	(60, 2, NULL, NULL, 'Phpunit', 120, 121),
	(61, 2, NULL, NULL, 'Businesses', 122, 135),
	(62, 61, NULL, NULL, 'index', 123, 124),
	(63, 61, NULL, NULL, 'view', 125, 126),
	(64, 61, NULL, NULL, 'add', 127, 128),
	(65, 61, NULL, NULL, 'edit', 129, 130),
	(66, 61, NULL, NULL, 'delete', 131, 132),
	(67, 61, NULL, NULL, 'get_user', 133, 134),
	(68, 2, NULL, NULL, 'Products', 136, 151),
	(69, 68, NULL, NULL, 'index', 137, 138),
	(70, 68, NULL, NULL, 'view', 139, 140),
	(71, 68, NULL, NULL, 'add', 141, 142),
	(72, 68, NULL, NULL, 'edit', 143, 144),
	(73, 68, NULL, NULL, 'delete', 145, 146),
	(74, 68, NULL, NULL, 'get_user', 147, 148),
	(75, 2, NULL, NULL, 'Questions', 152, 165),
	(76, 75, NULL, NULL, 'index', 153, 154),
	(77, 75, NULL, NULL, 'view', 155, 156),
	(78, 75, NULL, NULL, 'add', 157, 158),
	(79, 75, NULL, NULL, 'edit', 159, 160),
	(80, 75, NULL, NULL, 'delete', 161, 162),
	(81, 75, NULL, NULL, 'get_user', 163, 164),
	(82, 2, NULL, NULL, 'Responses', 166, 179),
	(83, 82, NULL, NULL, 'index', 167, 168),
	(84, 82, NULL, NULL, 'view', 169, 170),
	(85, 82, NULL, NULL, 'add', 171, 172),
	(86, 82, NULL, NULL, 'edit', 173, 174),
	(87, 82, NULL, NULL, 'delete', 175, 176),
	(88, 82, NULL, NULL, 'get_user', 177, 178),
	(89, 2, NULL, NULL, 'QuestionResponses', 180, 201),
	(90, 89, NULL, NULL, 'index', 181, 182),
	(91, 89, NULL, NULL, 'view', 183, 184),
	(92, 89, NULL, NULL, 'add', 185, 186),
	(93, 89, NULL, NULL, 'edit', 187, 188),
	(94, 89, NULL, NULL, 'delete', 189, 190),
	(95, 89, NULL, NULL, 'get_user', 191, 192),
	(96, 2, NULL, NULL, 'BusinessQuestions', 202, 215),
	(97, 96, NULL, NULL, 'index', 203, 204),
	(98, 96, NULL, NULL, 'view', 205, 206),
	(99, 96, NULL, NULL, 'add', 207, 208),
	(100, 96, NULL, NULL, 'edit', 209, 210),
	(101, 96, NULL, NULL, 'delete', 211, 212),
	(102, 96, NULL, NULL, 'get_user', 213, 214),
	(103, 89, NULL, NULL, 'getqr', 193, 194),
	(104, 89, NULL, NULL, 'wizard', 195, 196),
	(105, 2, NULL, NULL, 'BusinessProducts', 216, 231),
	(106, 105, NULL, NULL, 'index', 217, 218),
	(107, 105, NULL, NULL, 'view', 219, 220),
	(108, 105, NULL, NULL, 'add', 221, 222),
	(109, 105, NULL, NULL, 'edit', 223, 224),
	(110, 105, NULL, NULL, 'delete', 225, 226),
	(111, 105, NULL, NULL, 'get_user', 227, 228),
	(112, 2, NULL, NULL, 'Customs', 232, 245),
	(113, 112, NULL, NULL, 'index', 233, 234),
	(114, 112, NULL, NULL, 'view', 235, 236),
	(115, 112, NULL, NULL, 'add', 237, 238),
	(116, 112, NULL, NULL, 'edit', 239, 240),
	(117, 112, NULL, NULL, 'delete', 241, 242),
	(118, 112, NULL, NULL, 'get_user', 243, 244),
	(120, 89, NULL, NULL, 'getview', 197, 198),
	(121, 105, NULL, NULL, 'get_bp', 229, 230),
	(122, 2, NULL, NULL, 'Prospects', 246, 263),
	(123, 122, NULL, NULL, 'index', 247, 248),
	(124, 122, NULL, NULL, 'view', 249, 250),
	(125, 122, NULL, NULL, 'add', 251, 252),
	(126, 122, NULL, NULL, 'edit', 253, 254),
	(127, 122, NULL, NULL, 'delete', 255, 256),
	(128, 122, NULL, NULL, 'get_user', 257, 258),
	(129, 2, NULL, NULL, 'States', 264, 279),
	(130, 129, NULL, NULL, 'index', 265, 266),
	(131, 129, NULL, NULL, 'view', 267, 268),
	(132, 129, NULL, NULL, 'add', 269, 270),
	(133, 129, NULL, NULL, 'edit', 271, 272),
	(134, 129, NULL, NULL, 'delete', 273, 274),
	(135, 129, NULL, NULL, 'get_user', 275, 276),
	(136, 2, NULL, NULL, 'FrontQuestions', 280, 299),
	(137, 136, NULL, NULL, 'index', 281, 282),
	(138, 136, NULL, NULL, 'view', 283, 284),
	(139, 136, NULL, NULL, 'add', 285, 286),
	(140, 136, NULL, NULL, 'edit', 287, 288),
	(141, 136, NULL, NULL, 'delete', 289, 290),
	(142, 136, NULL, NULL, 'get_questions', 291, 292),
	(143, 136, NULL, NULL, 'get_user', 293, 294),
	(144, 2, NULL, NULL, 'ProspectResponses', 300, 317),
	(145, 144, NULL, NULL, 'index', 301, 302),
	(146, 144, NULL, NULL, 'view', 303, 304),
	(147, 144, NULL, NULL, 'add', 305, 306),
	(148, 144, NULL, NULL, 'edit', 307, 308),
	(149, 144, NULL, NULL, 'delete', 309, 310),
	(150, 144, NULL, NULL, 'get_user', 311, 312),
	(151, 89, NULL, NULL, 'update_other_tables', 199, 200),
	(152, 129, NULL, NULL, 'get_state', 277, 278),
	(153, 2, NULL, NULL, 'HtmlInputs', 318, 331),
	(154, 153, NULL, NULL, 'index', 319, 320),
	(155, 153, NULL, NULL, 'view', 321, 322),
	(156, 153, NULL, NULL, 'add', 323, 324),
	(157, 153, NULL, NULL, 'edit', 325, 326),
	(158, 153, NULL, NULL, 'delete', 327, 328),
	(159, 153, NULL, NULL, 'get_user', 329, 330),
	(160, 2, NULL, NULL, 'ResponseAnswers', 332, 345),
	(161, 160, NULL, NULL, 'index', 333, 334),
	(162, 160, NULL, NULL, 'view', 335, 336),
	(163, 160, NULL, NULL, 'add', 337, 338),
	(164, 160, NULL, NULL, 'edit', 339, 340),
	(165, 160, NULL, NULL, 'delete', 341, 342),
	(166, 160, NULL, NULL, 'get_user', 343, 344),
	(167, 2, NULL, NULL, 'FrontProducts', 346, 361),
	(168, 167, NULL, NULL, 'index', 347, 348),
	(169, 167, NULL, NULL, 'view', 349, 350),
	(170, 167, NULL, NULL, 'add', 351, 352),
	(171, 167, NULL, NULL, 'edit', 353, 354),
	(172, 167, NULL, NULL, 'delete', 355, 356),
	(173, 167, NULL, NULL, 'get_user', 357, 358),
	(174, 167, NULL, NULL, 'get_products', 359, 360),
	(175, 68, NULL, NULL, 'get_products', 149, 150),
	(176, 122, NULL, NULL, 'process', 259, 260),
	(177, 122, NULL, NULL, 'processbyname', 261, 262),
	(178, 2, NULL, NULL, 'SiteSettings', 362, 375),
	(179, 178, NULL, NULL, 'index', 363, 364),
	(180, 178, NULL, NULL, 'view', 365, 366),
	(181, 178, NULL, NULL, 'add', 367, 368),
	(182, 178, NULL, NULL, 'edit', 369, 370),
	(183, 178, NULL, NULL, 'delete', 371, 372),
	(184, 178, NULL, NULL, 'get_user', 373, 374),
	(185, NULL, NULL, NULL, 'controllers', 377, 406),
	(194, 185, NULL, NULL, 'Emaillive', 378, 391),
	(195, 194, NULL, NULL, 'index', 379, 380),
	(196, 194, NULL, NULL, 'initemail', 381, 382),
	(197, 194, NULL, NULL, 'send_to_agent', 383, 384),
	(198, 194, NULL, NULL, 'save', 385, 386),
	(199, 194, NULL, NULL, 'send', 387, 388),
	(200, 194, NULL, NULL, 'get_user', 389, 390),
	(208, 136, NULL, NULL, 'getfacebookagent', 295, 296),
	(209, 136, NULL, NULL, 'getagentbyname', 297, 298),
	(210, 144, NULL, NULL, 'prospect_response_find', 313, 314),
	(211, 144, NULL, NULL, 'prospect_edit', 315, 316),
	(212, 35, NULL, NULL, 'show_message', 91, 92),
	(213, 185, NULL, NULL, 'Crons', 392, 405),
	(214, 213, NULL, NULL, 'index', 393, 394),
	(215, 213, NULL, NULL, 'view', 395, 396),
	(216, 213, NULL, NULL, 'add', 397, 398),
	(217, 213, NULL, NULL, 'edit', 399, 400),
	(218, 213, NULL, NULL, 'delete', 401, 402),
	(219, 213, NULL, NULL, 'get_user', 403, 404);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;


-- Dumping structure for table cna.aros
DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table cna.aros: ~13 rows (approximately)
DELETE FROM `aros`;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
	(1, NULL, NULL, NULL, 'Groups', 1, 2),
	(2, NULL, 'Group', 1, NULL, 3, 4),
	(3, NULL, 'Group', 2, NULL, 5, 6),
	(4, NULL, 'Group', 3, NULL, 7, 10),
	(5, 4, 'User', 13, NULL, 8, 9),
	(6, NULL, 'Group', 1, NULL, 11, 22),
	(7, NULL, 'Group', 2, NULL, 23, 24),
	(8, NULL, 'Group', 3, NULL, 25, 26),
	(9, 6, 'User', 14, NULL, 12, 13),
	(10, 6, 'User', 16, NULL, 14, 15),
	(11, 6, 'User', 17, NULL, 16, 17),
	(12, 6, 'User', 18, NULL, 18, 19),
	(13, 6, 'User', 19, NULL, 20, 21);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;


-- Dumping structure for table cna.aros_acos
DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cna.aros_acos: ~0 rows (approximately)
DELETE FROM `aros_acos`;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;


-- Dumping structure for table cna.businesses
DROP TABLE IF EXISTS `businesses`;
CREATE TABLE IF NOT EXISTS `businesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_name` (`short_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.businesses: ~20 rows (approximately)
DELETE FROM `businesses`;
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` (`id`, `short_name`, `user_id`, `active`, `created`, `modified`) VALUES
	(1, 'Janitorial', 11, 1, '2013-10-29 09:56:12', '2013-11-06 12:42:18'),
	(2, 'Painters', 11, 1, '2013-10-29 09:56:14', '2013-11-01 15:24:37'),
	(3, 'Electricians', 1, 1, NULL, NULL),
	(7, 'Barber/Beauty', 10, 0, '2013-10-29 17:26:47', '2013-10-29 17:26:47'),
	(8, ' Card or Gift Shops', 19, 1, '2013-10-29 17:26:54', '2013-11-12 14:19:46'),
	(9, 'Landscaping or Lawn Service', 10, 0, '2013-10-29 17:27:01', '2013-10-29 17:27:01'),
	(10, 'Dental or Medical Office', 10, 0, '2013-10-29 17:27:11', '2013-10-29 17:27:11'),
	(11, 'Professional Office', 10, 0, '2013-10-29 17:27:18', '2013-10-29 17:27:18'),
	(12, 'Pet Services', 10, 0, '2013-10-29 17:27:24', '2013-10-29 17:27:24'),
	(13, 'Bakeries and Sweet Shops', 10, 0, '2013-10-29 17:27:32', '2013-10-29 17:27:32'),
	(14, 'Auto Service & Repair Shops', 10, 0, '2013-10-29 17:27:41', '2013-10-29 17:27:41'),
	(15, 'Condo Association', 10, 0, '2013-10-29 17:27:48', '2013-10-29 17:27:48'),
	(16, 'Restaurants', 19, 0, '2013-10-29 17:27:55', '2013-11-12 14:13:26'),
	(17, '1-2 Unit Rental Dwelling', 8, 0, '2013-10-29 17:28:02', '2013-10-31 20:40:00'),
	(18, 'Apartments', 10, 0, '2013-10-29 17:28:09', '2013-10-29 17:28:09'),
	(19, 'Grocery Store', 19, 1, '2013-10-31 20:28:55', '2013-11-13 10:55:51'),
	(20, 'Raji\'s Gift shops', 19, 1, '2013-11-12 12:48:27', '2013-11-13 08:53:18'),
	(22, 'Raji\'s Medical Office', 19, 1, '2013-11-12 15:43:47', '2013-11-12 15:43:47'),
	(23, 'Raji\'s Pet Services', 18, 1, '2013-11-12 15:55:34', '2013-12-09 13:12:57'),
	(25, 'Raji\'s Pet Services and care', 18, 0, '2013-11-12 15:59:33', '2013-12-09 13:12:17');
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;


-- Dumping structure for table cna.business_questions
DROP TABLE IF EXISTS `business_questions`;
CREATE TABLE IF NOT EXISTS `business_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `response_id` int(10) unsigned NOT NULL,
  `products` varchar(1000) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_id_question_id` (`business_id`,`question_id`,`response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.business_questions: ~5 rows (approximately)
DELETE FROM `business_questions`;
/*!40000 ALTER TABLE `business_questions` DISABLE KEYS */;
INSERT INTO `business_questions` (`id`, `business_id`, `question_id`, `response_id`, `products`, `active`, `created`, `modified`) VALUES
	(1, 1, 1, 1, '3', 1, '2013-12-09 14:32:33', '2013-12-09 16:52:49'),
	(2, 1, 3, 3, '21', 1, '2013-12-09 15:11:59', '2013-12-09 17:10:20'),
	(3, 1, 9, 2, '', 1, '2013-12-09 16:24:35', '2013-12-10 08:19:29'),
	(4, 3, 3, 3, '4', 1, '2013-12-09 17:00:18', '2013-12-09 17:00:54'),
	(5, 2, 6, 1, '2;3;4', 1, '2013-12-11 10:56:03', '2013-12-11 10:56:30');
/*!40000 ALTER TABLE `business_questions` ENABLE KEYS */;


-- Dumping structure for view cna.crons
DROP VIEW IF EXISTS `crons`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `crons` (
	`id` INT(11) NOT NULL,
	`business_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`business_id` INT(11) NULL,
	`first_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`last_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`address` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`address2` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`city` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`state_id` SMALLINT(6) NOT NULL,
	`zip_code` VARCHAR(5) NOT NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`phone` VARCHAR(11) NOT NULL COLLATE 'latin1_swedish_ci',
	`best_time_to_call` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`website` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`comefrom` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(1) NOT NULL,
	`agent` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`modified` DATETIME NULL,
	`pr_id` INT(10) UNSIGNED NOT NULL,
	`pr_prospect_id` INT(10) NOT NULL,
	`products` VARCHAR(500) NULL COLLATE 'latin1_swedish_ci',
	`business` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`pr_business_id` INT(11) NULL,
	`question` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`pr_question_id` INT(11) NULL,
	`responseid` INT(11) NULL,
	`prospect_answer` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`run_time` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view cna.customs
DROP VIEW IF EXISTS `customs`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `customs` (
	`Business` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`Question` VARCHAR(500) NOT NULL COLLATE 'utf8_general_ci',
	`Response` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`Products` VARCHAR(1000) NULL COLLATE 'latin1_swedish_ci',
	`id` INT(10) UNSIGNED NOT NULL,
	`business_id` INT(10) UNSIGNED NOT NULL,
	`question_id` INT(10) UNSIGNED NOT NULL,
	`response_id` INT(10) UNSIGNED NOT NULL,
	`status` TINYINT(1) NOT NULL,
	`qid` INT(10) UNSIGNED NOT NULL,
	`qrsid` INT(10) UNSIGNED NOT NULL,
	`resid` INT(10) UNSIGNED NOT NULL,
	`bid` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM;


-- Dumping structure for view cna.front_products
DROP VIEW IF EXISTS `front_products`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `front_products` (
	`id` INT(10) UNSIGNED NOT NULL,
	`prospect_id` INT(10) NOT NULL,
	`products` VARCHAR(500) NULL COLLATE 'latin1_swedish_ci',
	`business` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`business_id` INT(11) NULL,
	`question` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`question_id` INT(11) NULL,
	`responseid` INT(11) NULL,
	`prospect_answer` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`active` TINYINT(1) NOT NULL COMMENT '0 or 1',
	`created` DATETIME NULL,
	`modified` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view cna.front_questions
DROP VIEW IF EXISTS `front_questions`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `front_questions` (
	`id` INT(10) UNSIGNED NOT NULL,
	`Business` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`Question` VARCHAR(500) NOT NULL COLLATE 'utf8_general_ci',
	`Response` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`Html` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`responseanswer` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`business_id` INT(10) UNSIGNED NOT NULL,
	`question_id` INT(10) UNSIGNED NOT NULL,
	`response_id` INT(10) UNSIGNED NOT NULL,
	`products` VARCHAR(1000) NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(1) NOT NULL
) ENGINE=MyISAM;


-- Dumping structure for table cna.groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cna.groups: ~3 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
	(1, 'superadmin', '2013-10-15 19:30:11', '2013-10-15 19:30:11'),
	(2, 'sta', '2013-10-15 19:30:27', '2013-10-15 19:30:27'),
	(3, 'report', '2013-10-15 19:30:38', '2013-10-15 19:30:38');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table cna.html_inputs
DROP TABLE IF EXISTS `html_inputs`;
CREATE TABLE IF NOT EXISTS `html_inputs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.html_inputs: ~3 rows (approximately)
DELETE FROM `html_inputs`;
/*!40000 ALTER TABLE `html_inputs` DISABLE KEYS */;
INSERT INTO `html_inputs` (`id`, `short_name`, `user_id`, `active`, `created`, `modified`) VALUES
	(1, 'radio', 11, 1, '2013-11-01 19:58:58', '2013-11-01 19:58:58'),
	(2, 'select', 11, 1, '2013-11-01 19:59:10', '2013-11-01 19:59:10'),
	(3, 'text', 11, 1, '2013-11-01 19:59:21', '2013-11-01 19:59:21');
/*!40000 ALTER TABLE `html_inputs` ENABLE KEYS */;


-- Dumping structure for table cna.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cna.posts: ~0 rows (approximately)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Dumping structure for table cna.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.products: ~21 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `short_name`, `description`, `user_id`, `active`, `created`, `modified`) VALUES
	(2, 'Businessowners Policy', 'Combines property, liability and loss-of-income coverage into a simple package that\'s customizable to meet your small business needs.', 11, 1, '2013-10-29 20:26:47', '2013-11-06 18:03:20'),
	(3, 'Business Key Policy', 'Allows you to pick and choose from property, general liability, inland marine and crime coverages as well as many additional options.', 18, 1, '2013-10-29 20:27:06', '2013-11-06 15:02:11'),
	(4, 'Contractors Package Program', 'Specially designed for contractors with 10 or fewer employees. This package combines the two most-needed coverages - commercial general liability and contractors equipment - with the flexibility to add other coverages.', 14, 1, '2013-10-29 20:28:07', '2013-11-07 14:00:43'),
	(5, 'Business Auto Policy', ' Provides liability, collision and comprehensive coverage for your business vehicles, and also covers any auto being used to conduct business for you.', 10, 0, '2013-10-29 20:28:30', '2013-10-29 20:28:30'),
	(6, 'Workers Compensation and Employers Liability Policy', 'Combines these two important coverages to meet the insurance needs created by workers compensation laws and regulations in individual states. (not available in all states)', 8, 0, '2013-10-29 20:28:43', '2013-11-05 23:56:19'),
	(7, 'Commercial Liability Umbrella Policy', 'Picks up where your underlying business insurance liability coverage ends, giving you added protection against the financial consequences of major accidents or incidents.', 10, 0, '2013-10-29 20:37:27', '2013-10-29 20:37:27'),
	(8, 'Nonprofit Directors and Officers Liability', 'Protects directors and officers from liability claims arising out of alleged errors in judgment, breaches of duty, and wrongful acts related to their service to the organization.', 10, 0, '2013-10-29 20:37:54', '2013-10-29 20:37:54'),
	(10, 'Inland Marine', 'Provides coverage for your mobile machinery and equipment used away from your premises.', 8, 0, '2013-10-29 21:49:44', '2013-11-05 23:51:27'),
	(11, 'Property & General Liability', 'still need', 10, 0, '2013-10-29 21:49:57', '2013-10-29 21:49:57'),
	(12, 'Non Owned & Hired Auto', 'Hired Auto Liability provides coverage for any losses that may occur if you need to lease, hire or borrow an auto in the course of your business. Non-Owned Auto liability provides similar coverage when another person is using their personal auto on behalf of your business.', 8, 0, '2013-10-29 21:50:09', '2013-11-06 00:30:00'),
	(13, 'Employment Practices Liability', 'Pays for damages you are responsible for if you are found liable for a wrongful employment practice under the terms of the policy. Also provides for your legal defense if an allegation is made or legal action is taken against you. ', 10, 0, '2013-10-29 21:50:21', '2013-11-06 12:34:15'),
	(14, 'Data Breach', 'Coverage is provided for the cost of replacing or restoring electronic data which has been destroyed or corrupted by a covered cause of loss. This additional coverage is subject to a $10,000 \r\nannual aggregate limit.', 8, 0, '2013-10-29 21:50:34', '2013-11-06 00:37:24'),
	(15, 'Crime and Fidelity', 'Protects your business from loss of money, securities or inventory resulting from acts committed by your employees and non-employees. This covers activities such as employee dishonesty, embezzlement, forgery, robbery and burglary.', 8, 0, '2013-10-29 21:50:53', '2013-11-05 23:47:13'),
	(16, 'Inland Marine - Valuable Papers and Records', 'Pays for the cost of reconstructing valuable records that have been damaged or destroyed by a covered loss. The limit for on-premises loss is $10,000 while the off-premises limit is $5,000.', 18, 1, '2013-10-29 21:51:03', '2013-12-09 16:32:50'),
	(17, 'Professional Liability', 'Coverage applies to bodily injury, property damage and personal and advertising injury arising out of rendering or failure to render professional services for barbers, beauticians, funeral directors, manicurists, optical and hearing aid services, opticians, limited pharmacists, printers or veterinarians (domestic animals only).', 8, 0, '2013-10-29 21:51:17', '2013-11-06 00:33:07'),
	(18, 'Liquor Liability', 'Coverage for serving liquor as a social host. This coverage does not apply to insureds who are in the business of manufacturing, distributing, selling, serving  or furnishing alcoholic beverages.', 8, 0, '2013-10-29 21:51:27', '2013-11-06 00:10:50'),
	(19, 'Rental Dwelling Protection Program', 'need full name and description', 14, 0, '2013-10-29 21:51:40', '2013-11-06 12:46:09'),
	(20, 'General Liability', 'Insures against damages for bodily injury or property damage arising out of your business premises or operations.', 14, 0, '2013-11-06 12:54:16', '2013-11-06 12:54:16'),
	(21, 'AFI Home Policy', 'Needs text', 14, 0, '2013-11-06 12:57:04', '2013-11-06 12:57:04'),
	(22, 'Business Personal Property', 'Provides Replacement Cost coverage for personal property (including \r\ncomputers) used in your business, and leased business personal property \r\nyou have a contractual responsibility to insure.', 14, 0, '2013-11-06 13:02:15', '2013-11-06 13:02:15'),
	(23, 'CNA Testing', 'Test', 19, 1, '2013-11-13 16:31:05', '2013-11-13 16:53:38');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table cna.prospects
DROP TABLE IF EXISTS `prospects`;
CREATE TABLE IF NOT EXISTS `prospects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) NOT NULL,
  `business_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `best_time_to_call` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `comefrom` varchar(255) DEFAULT NULL,
  `browser_info` varchar(1000) DEFAULT NULL,
  `agent` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table cna.prospects: ~2 rows (approximately)
DELETE FROM `prospects`;
/*!40000 ALTER TABLE `prospects` DISABLE KEYS */;
INSERT INTO `prospects` (`id`, `business_name`, `business_id`, `first_name`, `last_name`, `address`, `address2`, `city`, `state_id`, `zip_code`, `email`, `phone`, `best_time_to_call`, `website`, `ip_address`, `ref`, `comefrom`, `browser_info`, `agent`, `status`, `created`, `modified`) VALUES
	(1, 'TOSHMATOV.US', 1, 'JON', 'Jon', '', 'iug', '', 10, '52001', 'jtoshmat@amfam.com', '', '', '', '::1', '', 'direct', NULL, 'agentid = null&fullname = Roger Schuster&address = 2300 John F Kennedy RdDubuque IA 52002-2843&image = undefined&email = undefined&phone = undefined', 0, '2013-12-13 11:17:23', '2013-12-13 10:17:23'),
	(8, 'Jon ', 1, 'EVE and Camilla', 'EVE and Camilla', 'iugiuh', 'iugiugh', 'oiughiugh', 12, '52001', 'jontoshmatov@amfam.com', '', '', '', '::1', '', '', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0', '', 0, '2013-12-13 11:17:23', '2013-12-13 13:46:39'),
	(10, 'IEIEIEIEIE', 1, 'efwefwe', 'fwefw', 'efwef', 'wefwef', 'wefw', 35, '52001', 'wefwef@dqd.com', '', '', '', '::1', '', '', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; InfoPath.3)', '', 0, '2013-12-13 14:04:34', '2013-12-13 14:04:34');
/*!40000 ALTER TABLE `prospects` ENABLE KEYS */;


-- Dumping structure for table cna.prospect_responses
DROP TABLE IF EXISTS `prospect_responses`;
CREATE TABLE IF NOT EXISTS `prospect_responses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prospect_id` int(10) NOT NULL DEFAULT '0',
  `products` varchar(500) DEFAULT '0',
  `business` varchar(255) DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `responseid` int(11) DEFAULT NULL,
  `prospect_answer` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 or 1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.prospect_responses: ~6 rows (approximately)
DELETE FROM `prospect_responses`;
/*!40000 ALTER TABLE `prospect_responses` DISABLE KEYS */;
INSERT INTO `prospect_responses` (`id`, `prospect_id`, `products`, `business`, `business_id`, `question`, `question_id`, `responseid`, `prospect_answer`, `active`, `created`, `modified`) VALUES
	(1, 1, '3', 'Janitorial', 1, 'Do you operate your business from your home?', 1, 1, 'Yes', 0, '2013-12-13 10:27:14', '2013-12-13 10:07:14'),
	(2, 1, '21', 'Janitorial', 1, 'Do you have employees?', 3, 1, '1', 0, '2013-12-13 10:27:14', '2013-12-13 10:11:14'),
	(3, 1, '', 'Janitorial', 1, 'Do you serve alcohol?', 9, 1, 'Yes', 0, '2013-12-13 10:27:14', '2013-12-13 10:10:14'),
	(4, 8, '3', 'Janitorial', 1, 'Question 48', 1, 0, NULL, 0, '2013-12-13 11:17:29', '2013-12-13 11:17:29'),
	(5, 8, '21', 'Janitorial', 1, 'Question 58', 3, 0, '0', 0, '2013-12-13 11:17:29', '2013-12-13 11:17:29'),
	(6, 8, '', 'Janitorial', 1, 'Question 68', 9, 0, NULL, 0, '2013-12-13 11:17:29', '2013-12-13 11:17:29'),
	(7, 8, '3', 'Janitorial', 1, 'Do you operate your business from your home?', 1, 0, 'Yes', 0, '2013-12-13 13:46:50', '2013-12-13 13:46:50'),
	(8, 8, '21', 'Janitorial', 1, 'Do you have employees?', 3, 0, '0', 0, '2013-12-13 13:46:50', '2013-12-13 13:46:50'),
	(9, 8, '', 'Janitorial', 1, 'Do you serve alcohol?', 9, 0, 'Yes', 0, '2013-12-13 13:46:50', '2013-12-13 13:46:50'),
	(10, 10, '3', 'Janitorial', 1, 'Do you operate your business from your home?', 1, 0, 'No', 0, '2013-12-13 14:02:45', '2013-12-13 14:04:43'),
	(11, 10, '21', 'Janitorial', 1, 'Do you have employees?', 3, 0, '0', 0, '2013-12-13 14:02:45', '2013-12-13 14:04:43'),
	(12, 10, '', 'Janitorial', 1, 'Do you serve alcohol?', 9, 0, 'No', 0, '2013-12-13 14:02:45', '2013-12-13 14:04:43');
/*!40000 ALTER TABLE `prospect_responses` ENABLE KEYS */;


-- Dumping structure for table cna.questions
DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(500) NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.questions: ~13 rows (approximately)
DELETE FROM `questions`;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `short_name`, `user_id`, `active`, `created`, `modified`) VALUES
	(1, 'Do you operate your business from your home?', 10, 0, '2013-10-29 17:41:20', '2013-11-05 23:27:01'),
	(2, 'Do you use autos for your business?', 10, 0, '2013-10-29 17:41:30', '2013-11-05 23:27:17'),
	(3, 'Do you have employees?', 10, 0, '2013-10-29 17:41:40', '2013-10-29 21:52:57'),
	(4, 'Do you have client data stored electronically?', 10, 0, '2013-10-29 17:42:01', '2013-11-05 23:27:33'),
	(5, 'Do you have mobile equipment that is used away from the insured or primary residence?', 10, 0, '2013-10-29 17:42:14', '2013-11-05 23:28:27'),
	(6, 'Do you keep cash on premises?', 10, 0, '2013-10-29 17:42:30', '2013-10-29 17:42:30'),
	(7, 'Damage to Accounts Receivable', 10, 0, '2013-10-29 17:42:37', '2013-10-29 17:42:37'),
	(8, 'Do you retain valuable papers?', 10, 0, '2013-10-29 17:42:44', '2013-11-05 23:27:55'),
	(9, 'Do you serve alcohol?', 10, 0, '2013-10-29 17:42:52', '2013-10-29 17:42:52'),
	(10, 'Do you have Gift Card Sale in your Premises?', 19, 0, '2013-11-12 13:44:35', '2013-11-12 13:46:22'),
	(11, 'Do you have Wireless available in your premises?', 19, 0, '2013-11-12 13:46:08', '2013-11-12 13:46:08'),
	(12, 'Do you have fitness equipments in your premises?', 19, 1, '2013-11-12 15:29:00', '2013-11-12 15:29:00'),
	(13, 'Do you have spa in your salon/beauty shop?', 19, 0, '2013-11-13 09:02:18', '2013-11-13 09:02:18');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;


-- Dumping structure for table cna.responses
DROP TABLE IF EXISTS `responses`;
CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) NOT NULL,
  `html_input_id` int(10) DEFAULT NULL,
  `response_answer_id` int(10) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.responses: ~5 rows (approximately)
DELETE FROM `responses`;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
INSERT INTO `responses` (`id`, `short_name`, `html_input_id`, `response_answer_id`, `user_id`, `active`, `created`, `modified`) VALUES
	(1, 'Yes', 1, 1, 11, 1, '2013-11-01 20:03:07', '2013-11-01 20:03:07'),
	(2, 'No', 1, 1, 11, 1, '2013-11-01 20:04:40', '2013-11-01 20:04:40'),
	(3, 'howmany', 2, 2, 11, 1, '2013-11-01 20:05:15', '2013-11-06 18:01:18'),
	(4, 'Colors', 2, 4, 19, 1, '2013-11-12 12:54:04', '2013-11-13 16:18:59'),
	(5, 'SIZE', 2, 6, 19, 1, '2013-11-14 10:56:23', '2013-11-14 10:56:23');
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;


-- Dumping structure for table cna.response_answers
DROP TABLE IF EXISTS `response_answers`;
CREATE TABLE IF NOT EXISTS `response_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.response_answers: ~6 rows (approximately)
DELETE FROM `response_answers`;
/*!40000 ALTER TABLE `response_answers` DISABLE KEYS */;
INSERT INTO `response_answers` (`id`, `short_name`, `user_id`, `active`, `created`, `modified`) VALUES
	(1, 'Yes;No', 18, 1, '2013-11-01 19:59:49', '2013-11-06 15:06:19'),
	(2, '0;1', 11, 1, '2013-11-01 20:01:56', '2013-11-01 21:23:41'),
	(3, 'cold;warm;hot', 11, 1, '2013-11-01 20:02:24', '2013-11-06 18:04:52'),
	(4, 'Red;White;Blue', 19, 1, '2013-11-12 12:53:14', '2013-11-12 12:53:14'),
	(5, 'Answer Yes;No', 19, 1, '2013-11-12 16:09:16', '2013-11-14 10:54:24'),
	(6, 'Short;Medium;Long', 19, 1, '2013-11-14 10:55:30', '2013-11-14 10:55:30');
/*!40000 ALTER TABLE `response_answers` ENABLE KEYS */;


-- Dumping structure for table cna.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.roles: ~3 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
	(1, 'superadmin', '2013-10-15 19:30:11', '2013-10-15 19:30:11'),
	(2, 'sta', '2013-10-15 19:30:27', '2013-10-15 19:30:27'),
	(3, 'report', '2013-10-15 19:30:38', '2013-10-15 19:30:38');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table cna.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(1000) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table cna.settings: ~2 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `message`, `status`, `user_id`, `created`, `modified`) VALUES
	(1, 'Raji is testing CNA ADMIN TOOL', 0, 0, '2013-11-12 13:00:55', '2013-11-12 16:15:13'),
	(2, 'Jon is showing Raji a rope', 0, 0, '2013-11-12 13:03:49', '2013-11-12 13:09:12');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table cna.site_settings
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) NOT NULL,
  `value1` varchar(255) NOT NULL,
  `value2` varchar(255) NOT NULL,
  `value3` varchar(255) NOT NULL,
  `value4` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_name` (`short_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.site_settings: ~1 rows (approximately)
DELETE FROM `site_settings`;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` (`id`, `short_name`, `value1`, `value2`, `value3`, `value4`, `user_id`, `active`, `created`, `modified`) VALUES
	(1, 'responsys', 'amfam_quote_api7;amfam_quote_api7', '', '', '', 18, 1, '2013-11-06 12:19:33', '2013-11-06 14:39:25');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;


-- Dumping structure for table cna.states
DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(2) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `footprint` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table cna.states: ~51 rows (approximately)
DELETE FROM `states`;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id`, `short_name`, `full_name`, `footprint`, `created`, `modified`) VALUES
	(1, 'AZ', 'Arizona', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(2, 'AL', 'Alabama', 0, '2013-10-29 10:12:46', '2013-10-31 22:28:22'),
	(3, 'AR', 'Arkansas', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(4, 'AK', 'Alaska', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(5, 'CA', 'California', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(6, 'CO', 'Colorado', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(7, 'CT', 'Connecticut', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(8, 'DE', 'Delaware', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(9, 'FL', 'Florida', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(10, 'GA', 'Georgia', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(11, 'HI', 'Hawaii', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(12, 'ID', 'Idaho', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(13, 'IL', 'Illinois', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(14, 'IN', 'Indiana', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(15, 'IA', 'Iowa', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(16, 'KS', 'Kansas', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(17, 'KY', 'Kentucky', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(18, 'LA', 'Louisiana', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(19, 'ME', 'Maine', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(20, 'MD', 'Maryland', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(21, 'MA', 'Massachusetts', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(22, 'MI', 'Michigan', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(23, 'MN', 'Minnesota', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(24, 'MS', 'Mississippi', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(25, 'MO', 'Missouri', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(26, 'MT', 'Montana', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(27, 'NE', 'Nebraska', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(28, 'NV', 'Nevada', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(29, 'NH', 'New Hampshire', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(30, 'NJ', 'New Jersey', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(31, 'NM', 'New Mexico', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(32, 'NY', 'New York', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(33, 'NC', 'North Carolina', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(34, 'ND', 'North Dakota', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(35, 'OH', 'Ohio', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(36, 'OR', 'Oregon', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(37, 'PA', 'Pennsylvania', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(38, 'RI', 'Rhode Island', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(39, 'SC', 'South Carolina', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(40, 'SD', 'South Dakota', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(41, 'TN', 'Tennessee', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(42, 'TX', 'Texas', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(43, 'UT', 'Utah', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(44, 'VT', 'Vermont', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(45, 'VA', 'Virginia', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(46, 'WA', 'Washington', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(47, 'WV', 'West Virginia', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(48, 'WI', 'Wisconsin', 1, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(49, 'WY', 'Wyoming', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(50, 'DC', 'Washington, D.C.', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46'),
	(51, 'PR', 'Puerto Rico', 0, '2013-10-29 10:12:46', '2013-10-29 10:12:46');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;


-- Dumping structure for table cna.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table cna.users: ~5 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `group_id`, `created`, `modified`) VALUES
	(14, 'dpage', '8901b790b83edef93964048e6d3f24e614c7ade5', 1, '2013-11-06 12:36:54', '2013-11-06 12:36:54'),
	(16, 'rchase', '8901b790b83edef93964048e6d3f24e614c7ade5', 1, '2013-11-06 13:08:23', '2013-11-06 13:08:23'),
	(17, 'jengle', '8901b790b83edef93964048e6d3f24e614c7ade5', 1, '2013-11-06 13:08:36', '2013-11-06 13:08:36'),
	(18, 'jtoshmat', '7c2fcf2457d3c553e9192fcd86d087dcaf93ef99', 1, '2013-11-06 13:08:48', '2013-11-06 13:08:48'),
	(19, 'raji', '8901b790b83edef93964048e6d3f24e614c7ade5', 1, '2013-11-12 12:46:18', '2013-11-12 12:46:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table cna.widgets
DROP TABLE IF EXISTS `widgets`;
CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `part_no` varchar(12) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cna.widgets: ~0 rows (approximately)
DELETE FROM `widgets`;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;


-- Dumping structure for view cna.crons
DROP VIEW IF EXISTS `crons`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `crons`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `crons` AS #Cron sql written by Jon Toshmatov
#Dec 13, 2013 at 11:19 AM
SELECT 
prospects.id, prospects.business_name,prospects.business_id,prospects.first_name,
prospects.last_name,prospects.address,prospects.address2,prospects.city,prospects.state_id,
prospects.zip_code,prospects.email,prospects.phone,prospects.best_time_to_call,
prospects.website,prospects.comefrom,prospects.`status`,prospects.agent,prospects.modified,
prospect_responses.id as pr_id,prospect_responses.prospect_id as pr_prospect_id,prospect_responses.products,
prospect_responses.business,prospect_responses.business_id as pr_business_id,
prospect_responses.question,prospect_responses.question_id as pr_question_id,prospect_responses.responseid,
prospect_responses.prospect_answer,
DATE_SUB(NOW(), INTERVAL 16 MINUTE) as run_time
FROM prospects, prospect_responses
WHERE prospects.`status` = 0 AND
prospects.id = prospect_responses.prospect_id
AND prospects.modified <= DATE_SUB(NOW(), INTERVAL 20 MINUTE) ;


-- Dumping structure for view cna.customs
DROP VIEW IF EXISTS `customs`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `customs`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `customs` AS SELECT
businesses.short_name as 'Business',
questions.short_name as Question,
responses.short_name as Response,
business_questions.products as Products,
business_questions.id, business_id, business_questions.question_id, response_id, business_questions.active as status,
questions.id as qid,
business_questions.id as qrsid,
responses.id as resid,
businesses.id as bid

FROM  business_questions, businesses, questions, responses
WHERE
business_questions.business_id = businesses.id
AND business_questions.question_id = questions.id
AND business_questions.response_id = responses.id 
GROUP BY businesses.id, questions.id,responses.id ;


-- Dumping structure for view cna.front_products
DROP VIEW IF EXISTS `front_products`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `front_products`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `front_products` AS select * from prospect_responses where products !='' order by id desc ;


-- Dumping structure for view cna.front_questions
DROP VIEW IF EXISTS `front_questions`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `front_questions`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `front_questions` AS #front_questions
SELECT 
#Text fields
business_questions.id,
businesses.short_name AS Business,
questions.short_name AS Question,
responses.short_name AS Response,
html_inputs.short_name AS Html,
response_answers.short_name AS responseanswer,

#misc numbers
business_questions.business_id, business_questions.question_id, 
business_questions.response_id,business_questions.products,
business_questions.active AS status

FROM business_questions, businesses, questions, responses, html_inputs, response_answers
WHERE business_questions.business_id = businesses.id
AND business_questions.question_id = questions.id
AND business_questions.response_id = responses.id 
AND responses.html_input_id = html_inputs.id 
AND responses.response_answer_id = response_answers.id ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
