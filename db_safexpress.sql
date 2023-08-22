-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2023 at 01:26 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_safexpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

DROP TABLE IF EXISTS `app`;
CREATE TABLE IF NOT EXISTS `app` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_icon` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `status_message` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`id`, `app_code`, `app_name`, `description`, `app_icon`, `is_active`, `status_message`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'Admin', 'Core Admin', 'default', 1, 'Welcome', 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(2, 'SLI', 'Safexpress Express', 'Logistics Company', 'default', 1, 'Welcome', 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `site` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT '0',
  `sitehead` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int NOT NULL DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branches_branch_index` (`branch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posts_id` bigint UNSIGNED NOT NULL,
  `is_publish` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_posts_id_foreign` (`posts_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `gurec` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foldername` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT '0',
  `sort` int DEFAULT '100',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int NOT NULL DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_filename_index` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `gurec`, `foldername`, `filename`, `image`, `caption`, `parent_id`, `sort`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'GL001', 'SYSU DAVAO', '', '', '', 0, 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(2, 'GL002', 'SYSU CEBU', '', '', '', 0, 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_id` int UNSIGNED NOT NULL,
  `menu_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NONE',
  `menu_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `menu_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_route` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '100',
  `is_active` tinyint(1) DEFAULT '1',
  `created_by` int NOT NULL DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_app_id_foreign` (`app_id`),
  KEY `menus_uuid_index` (`uuid`),
  KEY `menus_menu_code_index` (`menu_code`),
  KEY `menus_menu_title_index` (`menu_title`),
  KEY `menus_menu_route_index` (`menu_route`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `uuid`, `app_id`, `menu_code`, `menu_title`, `description`, `parent_id`, `menu_icon`, `menu_route`, `sort_order`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'SA', 'Dashboard', 'System Administration', 0, 'fas fa-tachometer-alt', '/admin/dashboard', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(2, NULL, 1, 'SA', 'Activity', 'System Administration', 0, 'fas fa-th', '/admin/activity', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(3, NULL, 1, 'SA', 'maintenance', 'System Administration', 0, 'fas fa-th', '/admin/maintenance', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(4, NULL, 1, 'SA', 'Setting', 'System Administration', 0, 'fas fa-tools', '/admin/setting', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(5, NULL, 2, 'SFEX', 'Home', 'SLI', 0, 'default', '/', 50, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(6, NULL, 2, 'SFEX', 'About', 'SLI', 0, 'default', '/about', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(7, NULL, 2, 'SFEX', 'Services', 'SLI', 0, 'default', '/services', 150, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(8, NULL, 2, 'SFEX', 'Teams', 'SLI', 0, 'default', '/teams', 200, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(9, NULL, 2, 'SFEX', 'Support', 'SLI', 0, 'default', '#', 300, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(10, NULL, 2, 'SFEX', 'Branch Locator', 'SLI', 9, 'default', '/branch', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(11, NULL, 2, 'SA', 'Application', 'System Administration', 2, 'fas fa-book', '/admin/apps', 200, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(12, NULL, 2, 'SA', 'Menu', 'System Administration', 2, 'fas fa-window-restore', '/admin/menu', 200, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(13, NULL, 2, 'SA', 'User', 'System Administration', 2, 'fas fa-user-alt', '/admin/user', 200, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(14, NULL, 2, 'SA', 'Gallery', 'System Administration', 2, 'fas fa-image', '/admin/gallery', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(15, NULL, 2, 'SFEX', 'Contact', 'Contact us', 9, '', '/contact', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(16, NULL, 2, 'SFEX', 'Blog', 'blog', 0, '', '/blog', 250, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(17, NULL, 1, 'SA', 'Post', 'post', 2, 'far fa-sticky-note', '/admin/post', 200, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(18, NULL, 1, 'SA', 'Categories', 'categories', 2, 'fa fa-list-alt', '/admin/categorie', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(19, NULL, 1, 'SA', 'Branch Setup', 'Branch Setup', 3, 'fa fa-building-o', '/admin/branch', 100, 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_06_055322_create_apps_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int UNSIGNED NOT NULL,
  `permission_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `is_publish` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_category_id_foreign` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `replies_comment_id_foreign` (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_by` int NOT NULL DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_code`, `description`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43'),
(2, 'user', 'Standard User', 1, 0, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_change_date` date DEFAULT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int UNSIGNED DEFAULT NULL,
  `first_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_change_password` int NOT NULL DEFAULT '0',
  `last_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `incorrect_logins` int DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EN',
  `is_active` tinyint(1) DEFAULT '1',
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `password_change_date`, `user_type`, `role_id`, `first_name`, `last_name`, `is_change_password`, `last_ip_address`, `last_session_id`, `last_activity`, `incorrect_logins`, `photo`, `language`, `is_active`, `google_id`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'System Administrator', 'admin@admin.com', '2019-10-26 12:38:09', '$2y$10$3iawNUjMxLKF5tmHhkPhOuKD/LvCPYdZ9xFqZ9R.ReAYRfl25ymNW', NULL, 'admin', 1, 'System', 'Administrator', 0, NULL, NULL, NULL, NULL, NULL, 'EN', 1, NULL, 0, NULL, NULL, '2023-07-28 17:20:43', '2023-07-28 17:20:43');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `app` (`id`);

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
