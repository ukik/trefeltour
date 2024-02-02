-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for trefeltour
CREATE DATABASE IF NOT EXISTS `trefeltour` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `trefeltour`;

-- Dumping structure for table trefeltour.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_configurations
CREATE TABLE IF NOT EXISTS `badaso_configurations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_configurations_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_data_rows
CREATE TABLE IF NOT EXISTS `badaso_data_rows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` bigint(20) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `relation` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `badaso_data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `badaso_data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `badaso_data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_data_types
CREATE TABLE IF NOT EXISTS `badaso_data_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_display_column` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_direction` enum('ASC','DESC') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `is_maintenance` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `notification` text COLLATE utf8mb4_unicode_ci,
  `is_soft_delete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_data_types_name_unique` (`name`),
  UNIQUE KEY `badaso_data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_email_resets
CREATE TABLE IF NOT EXISTS `badaso_email_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `count_incorrect` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_email_resets_verification_token_unique` (`verification_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_firebase_cloud_messages
CREATE TABLE IF NOT EXISTS `badaso_firebase_cloud_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `token_get_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badaso_firebase_cloud_messages_user_id_foreign` (`user_id`),
  CONSTRAINT `badaso_firebase_cloud_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_menus
CREATE TABLE IF NOT EXISTS `badaso_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_expand` tinyint(1) NOT NULL DEFAULT '1',
  `is_show_header` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_menus_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_menu_items
CREATE TABLE IF NOT EXISTS `badaso_menu_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `is_expand` tinyint(1) NOT NULL DEFAULT '1',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_notifications
CREATE TABLE IF NOT EXISTS `badaso_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `receiver_user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `sender_user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badaso_f_c_m_messages_receiver_user_id_foreign` (`receiver_user_id`),
  KEY `badaso_f_c_m_messages_sender_user_id_foreign` (`sender_user_id`),
  CONSTRAINT `badaso_f_c_m_messages_receiver_user_id_foreign` FOREIGN KEY (`receiver_user_id`) REFERENCES `badaso_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `badaso_f_c_m_messages_sender_user_id_foreign` FOREIGN KEY (`sender_user_id`) REFERENCES `badaso_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_password_resets
CREATE TABLE IF NOT EXISTS `badaso_password_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badaso_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_permissions
CREATE TABLE IF NOT EXISTS `badaso_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `always_allow` tinyint(1) NOT NULL DEFAULT '0',
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `roles_can_see_all_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_identify_related_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badaso_permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_roles
CREATE TABLE IF NOT EXISTS `badaso_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_role_permissions
CREATE TABLE IF NOT EXISTS `badaso_role_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badaso_role_permissions_role_id_foreign` (`role_id`),
  KEY `badaso_role_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `badaso_role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `badaso_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `badaso_role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `badaso_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_users
CREATE TABLE IF NOT EXISTS `badaso_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_info` text COLLATE utf8mb4_unicode_ci,
  `gender` enum('man','woman') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'photos/shares/default-user.png',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_sent_token_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_users_email_unique` (`email`),
  UNIQUE KEY `badaso_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_user_roles
CREATE TABLE IF NOT EXISTS `badaso_user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `badaso_user_roles_user_id_foreign` (`user_id`),
  KEY `badaso_user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `badaso_user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `badaso_roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `badaso_user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.badaso_user_verifications
CREATE TABLE IF NOT EXISTS `badaso_user_verifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `count_incorrect` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badaso_user_verifications_verification_token_unique` (`verification_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.branches
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.campus_bookings
CREATE TABLE IF NOT EXISTS `campus_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint(20) unsigned NOT NULL,
  `lecturer_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('rent','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rent',
  PRIMARY KEY (`id`),
  KEY `campus_bookings_lecturer_id_foreign` (`lecturer_id`),
  KEY `campus_bookings_user_id_foreign` (`user_id`),
  KEY `campus_bookings_room_id_foreign` (`room_id`),
  CONSTRAINT `campus_bookings_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `campus_lecturers` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `campus_bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `campus_rooms` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `campus_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.campus_courses
CREATE TABLE IF NOT EXISTS `campus_courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.campus_lecturers
CREATE TABLE IF NOT EXISTS `campus_lecturers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campus_lectures_course_id_foreign` (`course_id`),
  CONSTRAINT `campus_lectures_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `campus_courses` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.campus_rooms
CREATE TABLE IF NOT EXISTS `campus_rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slot` int(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cars
CREATE TABLE IF NOT EXISTS `cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rental_price` double(100,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` int(11) NOT NULL,
  `is_used` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cars_branch_id_foreign` (`branch_id`),
  CONSTRAINT `cars_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_genres
CREATE TABLE IF NOT EXISTS `cinema_genres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `genre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_movies
CREATE TABLE IF NOT EXISTS `cinema_movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_id` bigint(20) unsigned NOT NULL,
  `duration` time NOT NULL,
  `release_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cinema_movies_genre_id_foreign` (`genre_id`),
  CONSTRAINT `cinema_movies_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `cinema_genres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_payments
CREATE TABLE IF NOT EXISTS `cinema_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) unsigned NOT NULL,
  `payment_date` datetime NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_receipt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','success') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cinema_payments_ticket_id_foreign` (`ticket_id`),
  KEY `cinema_payments_user_id_foreign` (`user_id`),
  CONSTRAINT `cinema_payments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `cinema_tickets` (`id`),
  CONSTRAINT `cinema_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_seats
CREATE TABLE IF NOT EXISTS `cinema_seats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seat_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_status` enum('available','not available') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cinema_seats_show_id_foreign` (`show_id`),
  CONSTRAINT `cinema_seats_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `cinema_shows` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_shows
CREATE TABLE IF NOT EXISTS `cinema_shows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) unsigned NOT NULL,
  `studio_id` bigint(20) unsigned NOT NULL,
  `showtime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cinema_shows_movie_id_foreign` (`movie_id`),
  KEY `cinema_shows_studio_id_foreign` (`studio_id`),
  CONSTRAINT `cinema_shows_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `cinema_movies` (`id`),
  CONSTRAINT `cinema_shows_studio_id_foreign` FOREIGN KEY (`studio_id`) REFERENCES `cinema_studios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_studios
CREATE TABLE IF NOT EXISTS `cinema_studios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `studio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.cinema_tickets
CREATE TABLE IF NOT EXISTS `cinema_tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `seat_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `movie_id` bigint(20) unsigned NOT NULL,
  `code_ticket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_ticket` (`code_ticket`),
  KEY `cinema_tickets_seat_id_foreign` (`seat_id`),
  KEY `cinema_tickets_user_id_foreign` (`user_id`),
  KEY `cinema_tickets_movie_id_foreign` (`movie_id`),
  CONSTRAINT `cinema_tickets_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `cinema_movies` (`id`),
  CONSTRAINT `cinema_tickets_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `cinema_seats` (`id`),
  CONSTRAINT `cinema_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.culinary_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.culinary_booking_items
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_booking_items` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.culinary_buffets
CREATE TABLE IF NOT EXISTS `culinary_buffets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` smallint(6) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_available` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `culinary_buffets_store_id_foreign` (`store_id`),
  CONSTRAINT `culinary_buffets_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `culinary_stores` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.culinary_buffet_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_buffet_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.culinary_buffet_menus
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_buffet_menus` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.culinary_buffet_payments
CREATE TABLE IF NOT EXISTS `culinary_buffet_payments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `buffet_booking_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `validator_id` bigint(20) unsigned NOT NULL,
  `validate_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `culinary_buffet_payments_buffet_booking_id_foreign` (`buffet_booking_id`),
  CONSTRAINT `culinary_buffet_payments_buffet_booking_id_foreign` FOREIGN KEY (`buffet_booking_id`) REFERENCES `culinary_buffets` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.culinary_carts
CREATE TABLE IF NOT EXISTS `culinary_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `culinary_carts_product_id_foreign` (`product_id`),
  CONSTRAINT `culinary_carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `culinary_products` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.culinary_customers___
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_customers___` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.culinary_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_payments` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.culinary_products
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_products` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.culinary_stores
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `culinary_stores` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_member` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` double(10,2) DEFAULT NULL,
  `is_available` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_booking` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_user_id_foreign` (`user_id`),
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_custome_bookings
CREATE TABLE IF NOT EXISTS `event_custome_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  `manual_name` varchar(150) DEFAULT NULL,
  `is_cancelled` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_custome_culinarys
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_custome_culinarys` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.event_custome_lodges
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_custome_lodges` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.event_custome_payments
CREATE TABLE IF NOT EXISTS `event_custome_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `validator_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validate_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_custome_rundowns
CREATE TABLE IF NOT EXISTS `event_custome_rundowns` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `day` smallint(2) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` time DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_custome_souvenirs
CREATE TABLE IF NOT EXISTS `event_custome_souvenirs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `souvenir_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_custome_tourisms
CREATE TABLE IF NOT EXISTS `event_custome_tourisms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tourism_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_custome_tours
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_custome_tours` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.event_custome_transport
CREATE TABLE IF NOT EXISTS `event_custome_transport` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rent_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_package_selected_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_selected_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.event_package_selected_clients
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_selected_clients` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.event_package_selected_culinarys
CREATE TABLE IF NOT EXISTS `event_package_selected_culinarys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `culinary_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_selected_lodges
CREATE TABLE IF NOT EXISTS `event_package_selected_lodges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lodge_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_package_selected_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_selected_payments` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.event_package_selected_prices
CREATE TABLE IF NOT EXISTS `event_package_selected_prices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_client` smallint(3) NOT NULL DEFAULT '0',
  `max_client` smallint(3) NOT NULL DEFAULT '0',
  `class_melati_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_1_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_2_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_3_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_4_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_5_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_other_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_selected_rundowns
CREATE TABLE IF NOT EXISTS `event_package_selected_rundowns` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `day` smallint(2) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` time DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_selected_souvenirs
CREATE TABLE IF NOT EXISTS `event_package_selected_souvenirs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `souvenir_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_package_selected_tourisms
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_selected_tourisms` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.event_package_selected_tours
CREATE TABLE IF NOT EXISTS `event_package_selected_tours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `policy` text,
  `total_day` smallint(2) NOT NULL DEFAULT '0',
  `total_night` smallint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_available` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `image` text,
  `place` varchar(150) DEFAULT NULL COMMENT 'kota',
  `deadline` datetime DEFAULT NULL,
  `include` text,
  `is_private` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_selected_transport
CREATE TABLE IF NOT EXISTS `event_package_selected_transport` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rent_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_template_culinarys
CREATE TABLE IF NOT EXISTS `event_package_template_culinarys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `culinary_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_template_lodges
CREATE TABLE IF NOT EXISTS `event_package_template_lodges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lodge_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_template_prices
CREATE TABLE IF NOT EXISTS `event_package_template_prices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_client` smallint(3) NOT NULL DEFAULT '0',
  `max_client` smallint(3) NOT NULL DEFAULT '0',
  `class_melati_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_1_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_2_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_3_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_4_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_star_5_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `class_other_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.event_package_template_rundowns
CREATE TABLE IF NOT EXISTS `event_package_template_rundowns` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `day` smallint(2) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` time DEFAULT NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_package_template_souvenirs
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_template_souvenirs` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.event_package_template_tourisms
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_template_tourisms` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.event_package_template_tours
CREATE TABLE IF NOT EXISTS `event_package_template_tours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `policy` text,
  `total_day` smallint(2) NOT NULL DEFAULT '0',
  `total_night` smallint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_available` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `image` text,
  `place` varchar(150) DEFAULT NULL COMMENT 'kota',
  `include` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.event_package_template_transport
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `event_package_template_transport` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.lodge
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `lodge` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.lodge_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `lodge_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.lodge_booking_bills
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `lodge_booking_bills` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.lodge_customers___
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `lodge_customers___` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.lodge_payments
CREATE TABLE IF NOT EXISTS `lodge_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `total_amount` int(11) NOT NULL,
  `method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','success') COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `validator_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validate_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lodge_payments_booking_id_foreign` (`booking_id`),
  KEY `lodge_payments_validator_id_foreign` (`validator_id`),
  CONSTRAINT `lodge_payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `lodge_bookings` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `lodge_payments_validator_id_foreign` FOREIGN KEY (`validator_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.lodge_rooms
CREATE TABLE IF NOT EXISTS `lodge_rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `room_type_id` bigint(20) unsigned NOT NULL,
  `lodge_id` bigint(20) unsigned NOT NULL,
  `status` enum('available','not available') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lodge_rooms_room_type_id_foreign` (`room_type_id`),
  CONSTRAINT `lodge_rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `lodge_room_types` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.lodge_room_types
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `lodge_room_types` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.lodge_room_type_facility
CREATE TABLE IF NOT EXISTS `lodge_room_type_facility` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `room_type_id` bigint(20) unsigned NOT NULL,
  `primer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `internet` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `relax` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clean_safety` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `children` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lodge_room_type_facility_room_type_id_foreign` (`room_type_id`),
  CONSTRAINT `lodge_room_type_facility_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `lodge_room_types` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.lodge_staffs
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `lodge_staffs` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.lodge_types
CREATE TABLE IF NOT EXISTS `lodge_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lodge_id` bigint(20) unsigned NOT NULL,
  `hotel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hostel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `boutique_hotel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `resort` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cottage` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `motel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `losmen` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `inn` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `villa` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `homestay` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lodge_types_lodge_id_foreign` (`lodge_id`),
  CONSTRAINT `lodge_types_lodge_id_foreign` FOREIGN KEY (`lodge_id`) REFERENCES `lodge` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rental_id` bigint(20) unsigned NOT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_rental_id_foreign` (`rental_id`),
  CONSTRAINT `payments_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.rentals
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `rental_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_cost` double(100,2) NOT NULL,
  `rental_status` enum('disewa','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentals_car_id_foreign` (`car_id`),
  KEY `rentals_user_id_foreign` (`user_id`),
  KEY `rentals_employee_id_foreign` (`employee_id`),
  CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `rentals_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.rent_bookings
CREATE TABLE IF NOT EXISTS `rent_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `driver_id` bigint(20) unsigned DEFAULT NULL,
  `day_duration` smallint(6) NOT NULL DEFAULT '0',
  `date_rent` datetime NOT NULL,
  `time_depart` datetime NOT NULL,
  `time_arrive` datetime NOT NULL,
  `destination` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rental_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fuel_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `insurance_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `get_daily_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_cancelled` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.rent_customer___
CREATE TABLE IF NOT EXISTS `rent_customer___` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `is_member` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rental_customer_user_id_foreign` (`user_id`),
  CONSTRAINT `rental_customer_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.rent_drivers
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rent_drivers` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.rent_maintenances
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rent_maintenances` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.rent_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rent_payments` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.rent_stores
CREATE TABLE IF NOT EXISTS `rent_stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_available` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `codepos` smallint(6) NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rent_stores_user_id_foreign` (`user_id`),
  CONSTRAINT `rent_stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.rent_units
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rent_units` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.souvenir_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `souvenir_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.souvenir_booking_items
CREATE TABLE IF NOT EXISTS `souvenir_booking_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `souvenir_booking_items_product_id_foreign` (`product_id`),
  KEY `souvenir_booking_items_booking_id_foreign` (`booking_id`),
  CONSTRAINT `souvenir_booking_items_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `culinary_bookings` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `souvenir_booking_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `souvenir_products` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.souvenir_carts
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `souvenir_carts` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.souvenir_customers___
CREATE TABLE IF NOT EXISTS `souvenir_customers___` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_member` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` double(10,2) DEFAULT NULL,
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `souvenir_customers_user_id_foreign` (`user_id`),
  CONSTRAINT `souvenir_customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.souvenir_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `souvenir_payments` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.souvenir_products
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `souvenir_products` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.souvenir_stores
CREATE TABLE IF NOT EXISTS `souvenir_stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_available` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `codepos` smallint(6) NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `souvenir_stores_user_id_foreign` (`user_id`),
  CONSTRAINT `souvenir_stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `badaso_users` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.talents
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `talents` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.talent_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `talent_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.talent_customers___
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `talent_customers___` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.talent_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `talent_payments` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.talent_skills
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `talent_skills` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.tourism
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tourism` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.tourism_bookings
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tourism_bookings` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.tourism_customers___
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tourism_customers___` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.tourism_facilities
CREATE TABLE IF NOT EXISTS `tourism_facilities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tourism_id` bigint(20) unsigned NOT NULL,
  `toilet` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathroom` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mushola` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rest_area` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bar` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cafe_resto` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `souvenir` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `park` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `wifi` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `security` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `medic` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tourism_facilities_tourism_id_foreign` (`tourism_id`),
  CONSTRAINT `tourism_facilities_tourism_id_foreign` FOREIGN KEY (`tourism_id`) REFERENCES `tourism` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.tourism_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tourism_payments` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.tourism_venues
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tourism_venues` 
) ENGINE=MyISAM;

-- Dumping structure for view trefeltour.travel_payments
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `travel_payments` 
) ENGINE=MyISAM;

-- Dumping structure for table trefeltour.travel_reservations
CREATE TABLE IF NOT EXISTS `travel_reservations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `category` enum('plane','ship','train','bus','car','motor') DEFAULT NULL,
  `description` text,
  `starting_time` time DEFAULT NULL,
  `range_budget_from` decimal(10,2) NOT NULL DEFAULT '0.00',
  `range_budget_to` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `starting_date` date DEFAULT NULL,
  `is_reserved` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `starting_location` varchar(150) DEFAULT NULL,
  `arrival_location` varchar(150) DEFAULT NULL,
  `is_cancel` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_reservations_customer_id_foreign` (`customer_id`),
  CONSTRAINT `travel_reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.travel_tickets
CREATE TABLE IF NOT EXISTS `travel_tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint(20) unsigned NOT NULL,
  `seat_no` smallint(6) DEFAULT NULL,
  `ticket_status` varchar(100) DEFAULT NULL,
  `name_unit` varchar(200) NOT NULL DEFAULT '',
  `travel_date` datetime DEFAULT NULL,
  `description` text,
  `ticket_price` decimal(10,2) NOT NULL,
  `departure` tinytext NOT NULL,
  `arrivel` tinytext NOT NULL,
  `code_ticket` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `policy` text,
  `images` text,
  PRIMARY KEY (`id`),
  KEY `travel_tickets_reservation_id_foreign` (`reservation_id`),
  CONSTRAINT `travel_tickets_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `travel_reservations` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table trefeltour.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for view trefeltour.culinary_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_bookings`;
;

-- Dumping structure for view trefeltour.culinary_booking_items
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_booking_items`;
;

-- Dumping structure for view trefeltour.culinary_buffet_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_buffet_bookings`;
;

-- Dumping structure for view trefeltour.culinary_buffet_menus
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_buffet_menus`;
;

-- Dumping structure for view trefeltour.culinary_customers___
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_customers___`;
;

-- Dumping structure for view trefeltour.culinary_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_payments`;
;

-- Dumping structure for view trefeltour.culinary_products
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_products`;
;

-- Dumping structure for view trefeltour.culinary_stores
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `culinary_stores`;
;

-- Dumping structure for view trefeltour.event_custome_culinarys
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_custome_culinarys`;
;

-- Dumping structure for view trefeltour.event_custome_lodges
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_custome_lodges`;
;

-- Dumping structure for view trefeltour.event_custome_tours
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_custome_tours`;
;

-- Dumping structure for view trefeltour.event_package_selected_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_selected_bookings`;
;

-- Dumping structure for view trefeltour.event_package_selected_clients
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_selected_clients`;
;

-- Dumping structure for view trefeltour.event_package_selected_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_selected_payments`;
;

-- Dumping structure for view trefeltour.event_package_selected_tourisms
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_selected_tourisms`;
;

-- Dumping structure for view trefeltour.event_package_template_souvenirs
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_template_souvenirs`;
;

-- Dumping structure for view trefeltour.event_package_template_tourisms
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_template_tourisms`;
;

-- Dumping structure for view trefeltour.event_package_template_transport
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `event_package_template_transport`;
;

-- Dumping structure for view trefeltour.lodge
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `lodge`;
;

-- Dumping structure for view trefeltour.lodge_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `lodge_bookings`;
;

-- Dumping structure for view trefeltour.lodge_booking_bills
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `lodge_booking_bills`;
;

-- Dumping structure for view trefeltour.lodge_customers___
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `lodge_customers___`;
;

-- Dumping structure for view trefeltour.lodge_room_types
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `lodge_room_types`;
;

-- Dumping structure for view trefeltour.lodge_staffs
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `lodge_staffs`;
;

-- Dumping structure for view trefeltour.rent_drivers
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rent_drivers`;
;

-- Dumping structure for view trefeltour.rent_maintenances
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rent_maintenances`;
;

-- Dumping structure for view trefeltour.rent_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rent_payments`;
;

-- Dumping structure for view trefeltour.rent_units
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rent_units`;
;

-- Dumping structure for view trefeltour.souvenir_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `souvenir_bookings`;
;

-- Dumping structure for view trefeltour.souvenir_carts
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `souvenir_carts`;
;

-- Dumping structure for view trefeltour.souvenir_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `souvenir_payments`;
;

-- Dumping structure for view trefeltour.souvenir_products
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `souvenir_products`;
;

-- Dumping structure for view trefeltour.talents
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `talents`;
;

-- Dumping structure for view trefeltour.talent_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `talent_bookings`;
;

-- Dumping structure for view trefeltour.talent_customers___
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `talent_customers___`;
;

-- Dumping structure for view trefeltour.talent_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `talent_payments`;
;

-- Dumping structure for view trefeltour.talent_skills
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `talent_skills`;
;

-- Dumping structure for view trefeltour.tourism
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tourism`;
;

-- Dumping structure for view trefeltour.tourism_bookings
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tourism_bookings`;
;

-- Dumping structure for view trefeltour.tourism_customers___
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tourism_customers___`;
;

-- Dumping structure for view trefeltour.tourism_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tourism_payments`;
;

-- Dumping structure for view trefeltour.tourism_venues
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tourism_venues`;
;

-- Dumping structure for view trefeltour.travel_payments
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `travel_payments`;
;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
