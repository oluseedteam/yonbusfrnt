-- ============================================================
-- YONBUS Tax & Accounting Services — Full Database Export
-- Generated: 2026-08-05 14:30:17
-- Import into phpMyAdmin: select your cPanel DB first,
-- then Import tab → select this file → Go
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET time_zone='+00:00';



-- ──────────────────────────────────────────────────────────
-- Table: `accountants`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `accountants`;
CREATE TABLE `accountants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `hourly_rate` decimal(10,2) NOT NULL DEFAULT '150.00',
  `is_accepting_appointments` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountants_user_id_unique` (`user_id`),
  CONSTRAINT `accountants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in accountants)

-- ──────────────────────────────────────────────────────────
-- Table: `activity_logs`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in activity_logs)

-- ──────────────────────────────────────────────────────────
-- Table: `appointments`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `appointment_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `accountant_id` bigint unsigned DEFAULT NULL,
  `service_id` bigint unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` int NOT NULL DEFAULT '45',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `meeting_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointments_appointment_number_unique` (`appointment_number`),
  KEY `appointments_client_id_foreign` (`client_id`),
  KEY `appointments_accountant_id_foreign` (`accountant_id`),
  KEY `appointments_service_id_foreign` (`service_id`),
  CONSTRAINT `appointments_accountant_id_foreign` FOREIGN KEY (`accountant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `appointments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in appointments)

-- ──────────────────────────────────────────────────────────
-- Table: `availability_slots`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `availability_slots`;
CREATE TABLE `availability_slots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accountant_id` bigint unsigned NOT NULL,
  `day_of_week` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `availability_slots_accountant_id_foreign` (`accountant_id`),
  CONSTRAINT `availability_slots_accountant_id_foreign` FOREIGN KEY (`accountant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in availability_slots)

-- ──────────────────────────────────────────────────────────
-- Table: `blog_categories`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tax Tips', 'tax-tips', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(2, 'Accounting', 'accounting', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(3, 'Payroll', 'payroll', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(4, 'Financial Planning', 'financial-planning', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(5, 'Business Registration', 'business-registration', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48');

-- ──────────────────────────────────────────────────────────
-- Table: `blogs`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` bigint unsigned NOT NULL,
  `author_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`),
  KEY `blogs_blog_category_id_foreign` (`blog_category_id`),
  KEY `blogs_author_id_foreign` (`author_id`),
  CONSTRAINT `blogs_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in blogs)

-- ──────────────────────────────────────────────────────────
-- Table: `cache`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in cache)

-- ──────────────────────────────────────────────────────────
-- Table: `cache_locks`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in cache_locks)

-- ──────────────────────────────────────────────────────────
-- Table: `clients`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `client_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_user_id_unique` (`user_id`),
  UNIQUE KEY `clients_client_number_unique` (`client_number`),
  CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in clients)

-- ──────────────────────────────────────────────────────────
-- Table: `communication_logs`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `communication_logs`;
CREATE TABLE `communication_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned DEFAULT NULL,
  `receiver_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in-app',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `communication_logs_sender_id_foreign` (`sender_id`),
  KEY `communication_logs_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `communication_logs_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `communication_logs_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in communication_logs)

-- ──────────────────────────────────────────────────────────
-- Table: `documents`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `uploaded_by` bigint unsigned NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stored_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint unsigned NOT NULL DEFAULT '0',
  `version` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_client_id_foreign` (`client_id`),
  KEY `documents_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `documents_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in documents)

-- ──────────────────────────────────────────────────────────
-- Table: `failed_jobs`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in failed_jobs)

-- ──────────────────────────────────────────────────────────
-- Table: `holidays`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `holidays`;
CREATE TABLE `holidays` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in holidays)

-- ──────────────────────────────────────────────────────────
-- Table: `invoices`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `accountant_id` bigint unsigned DEFAULT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `due_date` date NOT NULL,
  `issued_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_accountant_id_foreign` (`accountant_id`),
  CONSTRAINT `invoices_accountant_id_foreign` FOREIGN KEY (`accountant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in invoices)

-- ──────────────────────────────────────────────────────────
-- Table: `job_batches`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in job_batches)

-- ──────────────────────────────────────────────────────────
-- Table: `jobs`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in jobs)

-- ──────────────────────────────────────────────────────────
-- Table: `messages`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in messages)

-- ──────────────────────────────────────────────────────────
-- Table: `migrations`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_28_143100_create_permission_tables', 1),
(5, '2026_07_28_143205_create_clients_and_accountants_tables', 1),
(6, '2026_07_28_143210_create_services_table', 1),
(7, '2026_07_28_143211_create_appointments_table', 1),
(8, '2026_07_28_143212_create_documents_table', 1),
(9, '2026_07_28_143213_create_tax_returns_table', 1),
(10, '2026_07_28_143214_create_invoices_table', 1),
(11, '2026_07_28_143215_create_payments_table', 1),
(12, '2026_07_28_143216_create_messages_table', 1),
(13, '2026_07_28_143217_create_reports_table', 1),
(14, '2026_07_28_143218_create_activity_logs_table', 1),
(15, '2026_07_28_143219_create_settings_table', 1),
(16, '2026_07_28_143220_add_profile_fields_to_users_table', 1),
(17, '2026_07_28_143221_create_blog_tables', 1),
(18, '2026_07_28_143223_create_calendar_tables', 1),
(19, '2026_07_28_143224_create_service_requests_and_communication_logs_tables', 1);

-- ──────────────────────────────────────────────────────────
-- Table: `model_has_permissions`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in model_has_permissions)

-- ──────────────────────────────────────────────────────────
-- Table: `model_has_roles`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1);

-- ──────────────────────────────────────────────────────────
-- Table: `password_reset_tokens`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in password_reset_tokens)

-- ──────────────────────────────────────────────────────────
-- Table: `payments`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bank_transfer',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
  `paid_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  KEY `payments_user_id_foreign` (`user_id`),
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in payments)

-- ──────────────────────────────────────────────────────────
-- Table: `permissions`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view-users', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(2, 'create-users', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(3, 'edit-users', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(4, 'delete-users', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(5, 'toggle-user-status', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(6, 'view-clients', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(7, 'create-clients', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(8, 'edit-clients', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(9, 'delete-clients', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(10, 'view-accountants', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(11, 'create-accountants', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(12, 'edit-accountants', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(13, 'delete-accountants', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(14, 'view-services', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(15, 'create-services', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(16, 'edit-services', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(17, 'delete-services', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(18, 'toggle-services', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(19, 'view-appointments', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(20, 'create-appointments', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(21, 'edit-appointments', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(22, 'cancel-appointments', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(23, 'complete-appointments', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(24, 'view-documents', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(25, 'upload-documents', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(26, 'delete-documents', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(27, 'download-documents', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(28, 'view-reports', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(29, 'export-reports', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(30, 'view-activity-logs', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(31, 'manage-settings', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(32, 'view-blogs', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(33, 'create-blogs', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(34, 'edit-blogs', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(35, 'delete-blogs', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(36, 'publish-blogs', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47');

-- ──────────────────────────────────────────────────────────
-- Table: `reports`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `accountant_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_client_id_foreign` (`client_id`),
  KEY `reports_accountant_id_foreign` (`accountant_id`),
  CONSTRAINT `reports_accountant_id_foreign` FOREIGN KEY (`accountant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reports_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in reports)

-- ──────────────────────────────────────────────────────────
-- Table: `role_has_permissions`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2);

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(6, 3),
(14, 3),
(19, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(27, 3),
(28, 3),
(14, 4),
(19, 4),
(20, 4),
(22, 4),
(24, 4),
(25, 4),
(27, 4);

-- ──────────────────────────────────────────────────────────
-- Table: `roles`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(2, 'admin', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(3, 'accountant', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47'),
(4, 'client', 'web', '2026-08-05 14:21:47', '2026-08-05 14:21:47');

-- ──────────────────────────────────────────────────────────
-- Table: `service_requests`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `service_requests`;
CREATE TABLE `service_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `preferred_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_requests_client_id_foreign` (`client_id`),
  KEY `service_requests_service_id_foreign` (`service_id`),
  CONSTRAINT `service_requests_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_requests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in service_requests)

-- ──────────────────────────────────────────────────────────
-- Table: `services`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration` int NOT NULL DEFAULT '60',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in services)

-- ──────────────────────────────────────────────────────────
-- Table: `sessions`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in sessions)

-- ──────────────────────────────────────────────────────────
-- Table: `settings`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'YONBUS Tax & Accounting Services Inc.', 'string', 'general', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(2, 'company_email', 'info@yonbus.com', 'string', 'general', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(3, 'company_phone', '+1 (800) 555-YONBUS', 'string', 'general', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(4, 'company_address', '100 Financial Plaza, Suite 800, Toronto, ON M5H 2N2', 'string', 'general', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(5, 'tax_rate', '13.00', 'string', 'financial', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(6, 'currency', 'CAD', 'string', 'financial', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48'),
(7, 'appointment_duration_default', '45', 'string', 'appointments', NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48');

-- ──────────────────────────────────────────────────────────
-- Table: `tax_returns`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `tax_returns`;
CREATE TABLE `tax_returns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `accountant_id` bigint unsigned DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(12,2) DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tax_returns_client_id_foreign` (`client_id`),
  KEY `tax_returns_accountant_id_foreign` (`accountant_id`),
  CONSTRAINT `tax_returns_accountant_id_foreign` FOREIGN KEY (`accountant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tax_returns_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- (no data in tax_returns)

-- ──────────────────────────────────────────────────────────
-- Table: `users`
-- ──────────────────────────────────────────────────────────
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_identification_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `notification_email` tinyint(1) NOT NULL DEFAULT '1',
  `notification_database` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `company_name`, `tax_identification_number`, `address`, `avatar`, `dark_mode`, `is_active`, `notification_email`, `notification_database`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'System', 'Administrator', 'admin@admin.com', '2026-08-05 14:21:48', '$2y$12$KiyKLVWM8E3n7ePVBDe31u3eyBrPawAsN.u7wd3hcGTFllSVlZF4y', 'admin', '+1 (800) 555-YONBUS', NULL, NULL, NULL, NULL, 0, 1, 1, 1, NULL, '2026-08-05 14:21:48', '2026-08-05 14:21:48');


SET FOREIGN_KEY_CHECKS=1;

-- ============================================================
-- Export complete.
-- Admin login: admin@admin.com  |  password: admin
-- !! Change the password immediately after your first login !!
-- ============================================================