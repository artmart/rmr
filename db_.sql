-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.25 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table runmyreports.com.accounts
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `result` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_timezone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_postcode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `business_admin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `currency_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `currency_sign` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `affiliate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_paid` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `param_id` (`param_id`) USING BTREE,
  CONSTRAINT `FK_accounts_params` FOREIGN KEY (`param_id`) REFERENCES `params` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table runmyreports.com.accounts: ~1 rows (approximately)
DELETE FROM `accounts`;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.bookings
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `id` int NOT NULL,
  `created` int DEFAULT NULL,
  `created_iso` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `changed` int DEFAULT NULL,
  `changed_iso` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `staff` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `rep` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `vehicle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assets` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `packages` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `extras` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `event_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `event` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `venue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `signature_required` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `signature` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `travel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `taxjar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ein` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tax_rate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`booking_id`),
  KEY `book_id` (`id`) USING BTREE,
  KEY `booking_param_id` (`param_id`),
  CONSTRAINT `booking_param_id` FOREIGN KEY (`param_id`) REFERENCES `params` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table runmyreports.com.bookings: ~28 rows (approximately)
DELETE FROM `bookings`;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.event_types
DROP TABLE IF EXISTS `event_types`;
CREATE TABLE IF NOT EXISTS `event_types` (
  `event_type_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`event_type_id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.event_types: ~6 rows (approximately)
DELETE FROM `event_types`;
/*!40000 ALTER TABLE `event_types` DISABLE KEYS */;
INSERT INTO `event_types` (`event_type_id`, `id`, `label`) VALUES
	(1, 249, 'Wedding'),
	(2, 468, 'Corporate'),
	(3, 469, 'admin'),
	(4, 773, 'Corporate Net 30'),
	(5, 1052, 'Charity'),
	(6, 1600, 'Admin Only TEST');
/*!40000 ALTER TABLE `event_types` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.extras
DROP TABLE IF EXISTS `extras`;
CREATE TABLE IF NOT EXISTS `extras` (
  `extra_id` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `upsell_price` double DEFAULT '0',
  `upsell_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `unit_types` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `extras_group` int DEFAULT NULL,
  `disabled` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`extra_id`) USING BTREE,
  KEY `extra_id` (`id`) USING BTREE,
  KEY `extra_param_id` (`param_id`) USING BTREE,
  CONSTRAINT `extra_param_id` FOREIGN KEY (`param_id`) REFERENCES `params` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.extras: ~0 rows (approximately)
DELETE FROM `extras`;
/*!40000 ALTER TABLE `extras` DISABLE KEYS */;
/*!40000 ALTER TABLE `extras` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.leads
DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `lead_id` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `id` int NOT NULL,
  `created` int DEFAULT NULL,
  `created_iso` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `changed` int DEFAULT NULL,
  `changed_iso` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `event` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `converted_bookings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`lead_id`),
  KEY `lead_id` (`id`),
  KEY `leads_param_id` (`param_id`),
  CONSTRAINT `leads_param_id` FOREIGN KEY (`param_id`) REFERENCES `params` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=593 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table runmyreports.com.leads: ~117 rows (approximately)
DELETE FROM `leads`;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table runmyreports.com.migration: 3 rows
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1610057878),
	('m130524_201442_init', 1610057886),
	('m190124_110200_add_verification_token_column_to_user_table', 1610057886);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.packages
DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `package_id` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `unit_type` int DEFAULT NULL,
  `time_slot` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `included_extras` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `disabled` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`package_id`) USING BTREE,
  KEY `package_param_id` (`param_id`) USING BTREE,
  KEY `package_id` (`id`) USING BTREE,
  CONSTRAINT `package_param_id` FOREIGN KEY (`param_id`) REFERENCES `params` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.packages: ~0 rows (approximately)
DELETE FROM `packages`;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.params
DROP TABLE IF EXISTS `params`;
CREATE TABLE IF NOT EXISTS `params` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `scope` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'full',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table runmyreports.com.params: ~1 rows (approximately)
DELETE FROM `params`;
/*!40000 ALTER TABLE `params` DISABLE KEYS */;
/*!40000 ALTER TABLE `params` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.payments
DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `param_id` int NOT NULL,
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `transaction_id` int DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created` int DEFAULT NULL,
  `created_iso` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `original_amount` double DEFAULT '0',
  `refunded_amount` double DEFAULT '0',
  `amount` double DEFAULT '0',
  `gratuity` double DEFAULT '0',
  `booking_id` int DEFAULT NULL,
  `source` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `submitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`payment_id`) USING BTREE,
  KEY `payment_id` (`id`) USING BTREE,
  KEY `payment_param_id` (`param_id`) USING BTREE,
  CONSTRAINT `payment_param_id` FOREIGN KEY (`param_id`) REFERENCES `params` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.payments: ~52 rows (approximately)
DELETE FROM `payments`;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.units
DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.units: ~6 rows (approximately)
DELETE FROM `units`;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` (`unit_id`, `id`, `label`) VALUES
	(1, 219, 'Magic Mirror 01'),
	(2, 220, 'Magic Mirror 02'),
	(3, 902, 'DJ 01'),
	(4, 1353, 'Photo Booth 01'),
	(5, 1601, 'Test Unit For Admin Only'),
	(6, 1606, '123');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.unit_types
DROP TABLE IF EXISTS `unit_types`;
CREATE TABLE IF NOT EXISTS `unit_types` (
  `unit_type_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`unit_type_id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table runmyreports.com.unit_types: ~7 rows (approximately)
DELETE FROM `unit_types`;
/*!40000 ALTER TABLE `unit_types` DISABLE KEYS */;
INSERT INTO `unit_types` (`unit_type_id`, `id`, `label`) VALUES
	(1, 218, 'Magic Mirror'),
	(2, 901, 'DJ'),
	(3, 1351, 'Photo Booth'),
	(4, 1401, 'My New Unit'),
	(5, 1402, 'My Other Unit'),
	(6, 1403, 'My Other Unit 3'),
	(7, 1473, 'test1');
/*!40000 ALTER TABLE `unit_types` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_group` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- Dumping data for table runmyreports.com.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `firstname`, `lastname`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `phone_number`, `status`, `created_at`, `updated_at`, `verification_token`, `user_group`) VALUES
	(1, 'admin', 'admin', 'kAkN4H87BnXNH-Dxtta20T-tP17cN5-j', '$2y$13$4TIXcVp6GTlbV4t1Y9clk.X3LAZVgl.3ELFn8BfGnkjogMKRZoeUS', NULL, 'artrmart@gmail.com', '555555555', 10, 1610058395, 1610058395, 'H-p5k5P-uwHCKt1ZNSD7sGWd5iH5Rnqg_1610058395', 1),
	(2, 'demo', 'demo1', 'FOuEPX3kgxQu-WJapV_h3fdDYRYBt_sL', '$2y$13$TaXVL.MwY.RY4SrgNIDMXuD/HGSlgxJsSwqkiIEaeVHZ2NJ4G5O4K', NULL, 'demo@gmail.com', '1234567891', 10, 1614674322, 1614703817, 'inXVKzWI4RmSZ8YelXnJAZoRyAgNrgay_1614674322', 2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.user_groups
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table runmyreports.com.user_groups: ~2 rows (approximately)
DELETE FROM `user_groups`;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`id`, `group_name`) VALUES
	(1, 'Administrator'),
	(2, 'User');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com._booking_customers
DROP TABLE IF EXISTS `_booking_customers`;
CREATE TABLE IF NOT EXISTS `_booking_customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_street_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_country` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_postcode` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_booking_id` (`booking_id`),
  CONSTRAINT `customer_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table runmyreports.com._booking_customers: ~0 rows (approximately)
DELETE FROM `_booking_customers`;
/*!40000 ALTER TABLE `_booking_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `_booking_customers` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.__event_types_copy
DROP TABLE IF EXISTS `__event_types_copy`;
CREATE TABLE IF NOT EXISTS `__event_types_copy` (
  `event_type_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `param_id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`event_type_id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `param_id` (`param_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.__event_types_copy: ~0 rows (approximately)
DELETE FROM `__event_types_copy`;
/*!40000 ALTER TABLE `__event_types_copy` DISABLE KEYS */;
/*!40000 ALTER TABLE `__event_types_copy` ENABLE KEYS */;

-- Dumping structure for table runmyreports.com.__unit_types_copy
DROP TABLE IF EXISTS `__unit_types_copy`;
CREATE TABLE IF NOT EXISTS `__unit_types_copy` (
  `unit_type_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `param_id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`unit_type_id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `unit_type_param_id` (`param_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table runmyreports.com.__unit_types_copy: ~0 rows (approximately)
DELETE FROM `__unit_types_copy`;
/*!40000 ALTER TABLE `__unit_types_copy` DISABLE KEYS */;
/*!40000 ALTER TABLE `__unit_types_copy` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
