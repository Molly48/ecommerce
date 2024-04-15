-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for fypdiploma
CREATE DATABASE IF NOT EXISTS `fypdiploma` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fypdiploma`;

-- Dumping structure for table fypdiploma.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table fypdiploma.admin: ~2 rows (approximately)
INSERT IGNORE INTO `admin` (`id`, `username`, `password`) VALUES
	(1, 'sitiraudah', 'raudah123'),
	(2, 'nurulamirah', 'amirah456');

-- Dumping structure for table fypdiploma.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table fypdiploma.products: ~5 rows (approximately)
INSERT IGNORE INTO `products` (`id`, `productName`, `price`, `color`, `description`, `image`, `created_by`, `created_at`) VALUES
	(34, 'Oversized printed T-shirt', 10.00, 'Cream', 'fhgfhhjhj', 'uploads/boxy2.png', NULL, '2024-01-01 07:53:48'),
	(50, 'fgjhjhg', 80.00, 'fdf', 'tghhfg', 'uploads/motif tshirt1.png', NULL, '2024-01-05 16:25:23'),
	(63, 'xcbxb', 33.00, 'fgf', 'fdgfdg', 'uploads/Picture4.png', NULL, '2024-01-07 01:50:18'),
	(79, 'fdgfdg', 43543.00, 'rergr', 'gfdg', 'uploads/Picture6.png', NULL, '2024-01-09 07:41:51'),
	(82, 'Baju Molly', 42.00, 'Merah', 'adasd', 'uploads/CELCOMADDON.png', 10, '2024-01-12 14:32:25'),
	(83, 'test protected', 32.00, 'merah', 'asdadad', 'uploads/digi-logo-1203C8EB36-seeklogo.com.png', 10, '2024-01-12 15:47:10');

-- Dumping structure for table fypdiploma.product_size_quantify
CREATE TABLE IF NOT EXISTS `product_size_quantify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table fypdiploma.product_size_quantify: ~16 rows (approximately)
INSERT IGNORE INTO `product_size_quantify` (`id`, `product_id`, `size`, `quantity`) VALUES
	(11, 82, 'XS', 4),
	(12, 82, 'S', 6),
	(13, 82, 'M', 2),
	(14, 82, 'L', 1),
	(15, 82, 'XL', 3),
	(16, 82, 'XXL', 6),
	(17, 82, '3XL', 2),
	(18, 82, '4XL', 4),
	(19, 83, 'XS', 4),
	(20, 83, 'S', 6),
	(21, 83, 'M', 72),
	(22, 83, 'L', 34),
	(23, 83, 'XL', 2),
	(24, 83, 'XXL', 7),
	(25, 83, '3XL', 5),
	(26, 83, '4XL', 2);

-- Dumping structure for table fypdiploma.seller
CREATE TABLE IF NOT EXISTS `seller` (
  `seller_id` int NOT NULL AUTO_INCREMENT,
  `seller_name` varchar(200) NOT NULL,
  `ssm_number` varchar(200) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `ic_number` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `shop_address` varchar(200) NOT NULL,
  `verify_token` varchar(200) NOT NULL,
  `verify_status` tinyint NOT NULL COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table fypdiploma.seller: ~0 rows (approximately)
INSERT IGNORE INTO `seller` (`seller_id`, `seller_name`, `ssm_number`, `shop_name`, `email_address`, `ic_number`, `phone_number`, `shop_address`, `verify_token`, `verify_status`, `created_at`) VALUES
	(10, 'mil', 'as12313', 'adadad', 'asdad@gmail.com', '1313', '12313', 'adad', '', 1, '2024-01-12 15:34:11');

-- Dumping structure for table fypdiploma.shopper
CREATE TABLE IF NOT EXISTS `shopper` (
  `shopper_id` int NOT NULL AUTO_INCREMENT,
  `shopper_username` varchar(200) NOT NULL,
  `shopper_password` varchar(200) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `shopper_address` varchar(200) NOT NULL,
  `verify_token` varchar(200) NOT NULL,
  `verify_status` tinyint NOT NULL COMMENT '0=no , 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shopper_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table fypdiploma.shopper: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
