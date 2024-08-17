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


-- Dumping database structure for e_commerce
DROP DATABASE IF EXISTS `e_commerce`;
CREATE DATABASE IF NOT EXISTS `e_commerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `e_commerce`;

-- Dumping structure for table e_commerce.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table e_commerce.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.migrations: ~5 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(31, '2014_10_12_000000_create_users_table', 1),
	(32, '2014_10_12_100000_create_password_resets_table', 1),
	(33, '2019_08_19_000000_create_failed_jobs_table', 1),
	(34, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(35, '2024_08_16_004054_create_products_table', 1),
	(36, '2024_08_16_031716_create_orders_table', 1),
	(37, '2024_08_16_031859_create_order_items_table', 1),
	(38, '2024_08_17_125727_add_google_id_column', 2);

-- Dumping structure for table e_commerce.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.orders: ~4 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `snap_token`, `note`, `created_at`, `updated_at`) VALUES
	(1, 3, 800000.00, 'completed', '802e11ee-825e-40e8-8691-4d6066740515', 'Lorem ipsum dolor sit amet', '2024-08-17 06:19:57', '2024-08-17 06:19:57'),
	(3, 3, 200000.00, 'cancelled', '5d05bc4f-1ed1-40c3-b491-aac8f1042b22', NULL, '2024-08-17 09:04:34', '2024-08-17 09:14:13'),
	(4, 3, 200000.00, 'completed', '849fca22-7394-41f9-a0f9-1c9951108142', NULL, '2024-08-17 09:06:58', '2024-08-17 09:15:13'),
	(5, 3, 200000.00, 'completed', '72748f5f-12d8-428d-9690-bfe7e039d7af', 'LOREM IPSUM DOLOR SITE AMET', '2024-08-17 09:18:22', '2024-08-17 09:19:03');

-- Dumping structure for table e_commerce.order_items
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.order_items: ~4 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 4, 800000.00, '2024-08-17 06:19:57', '2024-08-17 06:19:57'),
	(3, 3, 1, 1, 200000.00, '2024-08-17 09:04:34', '2024-08-17 09:04:34'),
	(4, 4, 2, 1, 200000.00, '2024-08-17 09:06:58', '2024-08-17 09:06:58'),
	(5, 5, 1, 1, 200000.00, '2024-08-17 09:18:22', '2024-08-17 09:18:22');

-- Dumping structure for table e_commerce.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.password_resets: ~0 rows (approximately)

-- Dumping structure for table e_commerce.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table e_commerce.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.products: ~8 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `status`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'PRODUCT 1', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 200000.00, 99, 'active', 'storage/images/SsmPrjWujxhZ9eVoFNGZMAU38XdUK1ccshdIOuxv.png', '2024-08-17 02:28:39', '2024-08-17 09:18:22'),
	(2, 'PRODUCT 2', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 200000.00, 99, 'active', 'storage/images/AwJ4PpO4aU2hnIaSux9KrdPdmCgPiIpsrFwG5reY.png', '2024-08-17 02:42:36', '2024-08-17 09:06:58'),
	(3, 'PRODUCT 3', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 200000.00, 100, 'active', 'storage/images/nv6BPdONpRtYK9nURsswo3ItBK9Jd0h3bGJVscmO.png', '2024-08-17 02:43:25', '2024-08-17 02:43:25'),
	(4, 'PRODUCT 4', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 200000.00, 96, 'active', 'storage/images/pLzmw2TKtw5gUiKctyDtvhcfTW4eWSIjHJPVKnTq.png', '2024-08-17 02:43:48', '2024-08-17 09:35:50'),
	(5, 'PRODUCT 5', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 100000.00, 100, 'active', 'storage/images/gDzn2CN6RqZj8YqWGJKF1VSxxGDp0Is6ouP30WAL.png', '2024-08-17 10:06:05', '2024-08-17 10:06:41'),
	(6, 'PRODUCT 6', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 100000.00, 100, 'active', 'storage/images/pBMnUxRQVU8f4CwFCACR3Kj7wABzf0XB1r8ne6SI.png', '2024-08-17 10:06:33', '2024-08-17 10:06:33'),
	(7, 'PRODUCT 7', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 120000.00, 100, 'active', 'storage/images/gsnBauKFdKD2mrAKEi5diXJAAc7M68wLMnABAWdW.png', '2024-08-17 10:07:14', '2024-08-17 10:07:14'),
	(8, 'PRODUCT 8', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lectus, sollicitudin eget sagittis sit amet, egestas fringilla nisi. Vivamus vel interdum ipsum, vel ultrices nunc. Nam consequat ullamcorper viverra. Pellentesque neque velit, auctor at vehicula at, dapibus at tortor. Maecenas lobortis lacus dolor, vel elementum erat dictum nec. Mauris pellentesque, augue non finibus cursus, dolor metus blandit velit, congue auctor leo metus eget odio. Mauris mollis venenatis ipsum, non sagittis dolor elementum nec. Suspendisse suscipit tortor ac justo varius, nec ullamcorper risus ultrices.</div>', 130000.00, 100, 'active', 'storage/images/FlCynn7n9i9VIiV3q7PRBNZhN41Ed92Sq4IxOymx.png', '2024-08-17 10:07:54', '2024-08-17 10:07:54');

-- Dumping structure for table e_commerce.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e_commerce.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `google_id`) VALUES
	(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$UyJvduCrNaJEnzYo/8dwrOHht/VhwzIcgwDYrjsIVdLiZFAU.4rOu', 'admin', NULL, '2024-08-17 02:27:29', '2024-08-17 02:27:29', NULL),
	(3, 'Febi Arifin', 'febiarifin0@gmail.com', NULL, 'eyJpdiI6InV4dFF2MlhCbXNYTnlGT2VBbHlyb0E9PSIsInZhbHVlIjoiNHpEOER4MDRXWHNqUk5QYmNWaVk1Zz09IiwibWFjIjoiMmVlMTI2MDE5ZmFkODkzZWJkMTA1MGQ3NDRjMGZhMzIyMDY0Nzc4YzQzNWU1YWRmODg0NTA2Yzc5YmM0OGI4ZCIsInRhZyI6IiJ9', 'customer', NULL, '2024-08-17 06:08:35', '2024-08-17 06:08:35', '108100506266177956543'),
	(4, 'Febi Arifin', 'febiarifin@mhs.fastikom-unsiq.ac.id', NULL, 'eyJpdiI6IlVzSHd1TytoV2lJdk1PdFphTXdPeHc9PSIsInZhbHVlIjoidGtsaWRxRzBOb3JncWRjWFZjcE1idz09IiwibWFjIjoiY2VhMTc4NWQxN2Y4NTFmYjMzNTAxZmJlZmQwMDZhZDZlYzcxNTJkMWIxNTkyNGFkNGU5ZWYxOGI4MmJiNGQwNSIsInRhZyI6IiJ9', 'customer', NULL, '2024-08-17 09:23:02', '2024-08-17 09:23:02', '110425588509628706995');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
