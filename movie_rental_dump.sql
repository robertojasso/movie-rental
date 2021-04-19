# ************************************************************
# Sequel Ace SQL dump
# Version 3028
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.14-MariaDB)
# Database: movie_rental
# Generation Time: 2021-04-19 09:51:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_movie_id_foreign` (`movie_id`),
  CONSTRAINT `images_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_movie_id_foreign` (`movie_id`),
  CONSTRAINT `likes_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2021_04_12_191830_create_movies_table',1),
	(5,'2021_04_12_211653_create_updates_log_table',1),
	(6,'2021_04_13_001342_create_sales_table',1),
	(7,'2021_04_13_033407_create_rentals_table',1),
	(8,'2021_04_13_033753_create_likes_table',1),
	(9,'2021_04_13_040656_create_images_table',1),
	(10,'2021_04_13_044838_add_user_id_to_updates_log',2),
	(11,'2021_04_13_224049_change_floats_to_decimals',3),
	(13,'2021_04_16_002407_change_return_date_rentals_table',4),
	(14,'2021_04_16_193218_add_soft_deletes_to_movies',5),
	(15,'2021_04_16_235014_remove_quantity_from_rentals',6);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table movies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `movies`;

CREATE TABLE `movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(10) unsigned NOT NULL,
  `rental_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;

INSERT INTO `movies` (`id`, `title`, `description`, `stock`, `rental_price`, `sale_price`, `available`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'star wars','starships, lightsabers, the force.',20,1.99,9.99,1,'2021-04-13 22:26:41','2021-04-16 18:34:36',NULL),
	(2,'star wars 2.0: return of the larry king','now there\'s a host king',10,5.99,10.99,0,'2021-04-13 22:49:38','2021-04-16 02:12:18',NULL),
	(3,'isle of dogs','dogs in an isle because of cats',1,2.00,8.50,1,'2021-04-16 04:21:17','2021-04-16 04:21:17',NULL),
	(10,'mr. nobody','guy goes back and forth between his different possibilities of lives',20,1.99,19.99,1,'2021-04-16 19:12:33','2021-04-16 19:37:05',NULL),
	(11,'mr. nobody','guy goes back and forth between his different possibilities of lives',6,9.99,19.99,0,'2021-04-16 19:39:56','2021-04-17 06:15:22',NULL);

/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table rentals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rentals`;

CREATE TABLE `rentals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `return_by` datetime NOT NULL,
  `returned_on` datetime DEFAULT NULL,
  `penalty` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentals_user_id_foreign` (`user_id`),
  KEY `rentals_movie_id_foreign` (`movie_id`),
  CONSTRAINT `rentals_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rentals` WRITE;
/*!40000 ALTER TABLE `rentals` DISABLE KEYS */;

INSERT INTO `rentals` (`id`, `user_id`, `movie_id`, `price`, `return_by`, `returned_on`, `penalty`, `created_at`, `updated_at`)
VALUES
	(1,3,11,9.99,'2021-04-14 23:15:33','2021-04-17 01:42:00',20.81,'2021-04-16 23:15:33','2021-04-17 01:42:00'),
	(2,3,11,9.99,'2021-04-15 23:15:51','2021-04-17 01:41:52',10.82,'2021-04-16 23:15:51','2021-04-17 01:41:52'),
	(3,3,11,9.99,'2021-04-16 23:19:53','2021-04-17 01:41:46',0.83,'2021-04-16 23:19:53','2021-04-17 01:41:46'),
	(4,3,11,9.99,'2021-04-18 23:34:17','2021-04-17 01:41:13',NULL,'2021-04-16 23:34:17','2021-04-17 01:41:13'),
	(5,4,11,9.99,'2021-04-15 23:36:51','2021-04-17 01:35:33',10.41,'2021-04-16 23:36:51','2021-04-17 01:35:33'),
	(6,4,11,9.99,'2021-04-18 23:37:08','2021-04-17 01:35:14',NULL,'2021-04-16 23:37:08','2021-04-17 01:35:14'),
	(7,4,11,9.99,'2021-04-18 23:37:13','2021-04-17 01:34:02',NULL,'2021-04-16 23:37:13','2021-04-17 01:34:02'),
	(8,3,11,9.99,'2021-04-19 06:15:22',NULL,NULL,'2021-04-17 06:15:22','2021-04-17 06:15:22');

/*!40000 ALTER TABLE `rentals` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_movie_id_foreign` (`movie_id`),
  CONSTRAINT `sales_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;

INSERT INTO `sales` (`id`, `user_id`, `movie_id`, `quantity`, `unit_price`, `created_at`, `updated_at`)
VALUES
	(1,3,11,1,19.99,'2021-04-17 06:03:30','2021-04-17 06:03:30'),
	(2,3,11,1,19.99,'2021-04-17 06:03:58','2021-04-17 06:03:58'),
	(3,3,10,1,19.99,'2021-04-17 19:31:43','2021-04-17 19:31:43');

/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table updates_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `updates_log`;

CREATE TABLE `updates_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `updated_field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `updates_log_movie_id_foreign` (`movie_id`),
  KEY `updates_log_user_id_foreign` (`user_id`),
  CONSTRAINT `updates_log_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  CONSTRAINT `updates_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `updates_log` WRITE;
/*!40000 ALTER TABLE `updates_log` DISABLE KEYS */;

INSERT INTO `updates_log` (`id`, `user_id`, `movie_id`, `updated_field`, `old_value`, `new_value`, `created_at`, `updated_at`)
VALUES
	(1,1,2,'title','star wars 2: return of the lightsaber king','star wars 2: return of the lightsaber king','2021-04-16 01:08:17','2021-04-16 01:08:17'),
	(2,1,2,'description','now there\'s a king too','now there\'s a king too','2021-04-16 01:08:17','2021-04-16 01:08:17'),
	(3,1,2,'updated_at','2021-04-16 01:08:17','2021-04-16 01:08:17','2021-04-16 01:08:17','2021-04-16 01:08:17'),
	(4,1,2,'title','star wars 2.0: return of the digital king','star wars 2.0: return of the digital king','2021-04-16 01:09:52','2021-04-16 01:09:52'),
	(5,1,2,'description','now there\'s a king two','now there\'s a king two','2021-04-16 01:09:52','2021-04-16 01:09:52'),
	(6,1,2,'title','star wars 2.0: return of the king','star wars 2.0: return of the larry king','2021-04-16 01:14:37','2021-04-16 01:14:37'),
	(7,1,2,'description','now there\'s a king','now there\'s a host king','2021-04-16 01:14:37','2021-04-16 01:14:37'),
	(8,1,2,'available','1','0','2021-04-16 02:12:18','2021-04-16 02:12:18'),
	(9,4,1,'stock','10','20','2021-04-16 18:34:36','2021-04-16 18:34:36'),
	(10,4,1,'rental_price','4.99','1.99','2021-04-16 18:34:36','2021-04-16 18:34:36'),
	(11,4,10,'stock','5','20','2021-04-16 19:13:16','2021-04-16 19:13:16'),
	(12,4,10,'rental_price','9.99','1.99','2021-04-16 19:13:16','2021-04-16 19:13:16'),
	(13,4,11,'available','1','0','2021-04-16 19:40:58','2021-04-16 19:40:58');

/*!40000 ALTER TABLE `updates_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'roberto','rujp.90@gmail.com',NULL,'$2y$10$WT/czEHjIKIghhRap/kG4.MwlwADco5pDEuy4LwrO6Jp82i8Yxtcy','admin',NULL,'2021-04-13 19:38:42','2021-04-13 19:38:42'),
	(2,'roberto2','rujp.90+2@gmail.com',NULL,'$2y$10$FsYOAF5ypr0PBsaXcrcM5Og3qthpIyAc/7zlVaxX74CMLn.fdXnd.','user',NULL,'2021-04-13 19:44:05','2021-04-13 19:44:05'),
	(3,'User','user@email.com',NULL,'$2y$10$zQeADH4Ii8fU4r5OO3PCS.6P132hKNcfcEcI.ToX2F9IZI7R6pX2K','user',NULL,'2021-04-16 17:54:20','2021-04-16 17:54:20'),
	(4,'Admin','admin@email.com',NULL,'$2y$10$Hhp4fDxptUX2dD/LG1sGpeaSH5KwuNTX0Kv5BDIDMoxaTsX3HDHVW','admin',NULL,'2021-04-16 18:00:54','2021-04-16 18:00:54');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
