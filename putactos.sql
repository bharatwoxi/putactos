-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2015 at 03:29 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `putactos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cup_size_master`
--

CREATE TABLE IF NOT EXISTS `cup_size_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cup_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cup_size_master`
--

INSERT INTO `cup_size_master` (`id`, `cup_size`, `created_at`, `updated_at`) VALUES
(1, 'A', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(2, 'B', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(3, 'C', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(4, 'D', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(5, 'E', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(6, 'AA', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(7, 'BB', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(8, 'CC', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(9, 'DD', '2015-02-28 05:54:04', '2015-02-28 05:54:04'),
(10, 'EE', '2015-02-28 05:54:04', '2015-02-28 05:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `looking_for` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_id_unique` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `looking_for`, `created_at`, `updated_at`) VALUES
(1, 'female', '2014-12-29 18:42:41', '2015-05-17 09:35:13'),
(2, 'male', '2015-01-05 06:31:37', '2015-01-05 06:31:37'),
(3, 'male', '2015-01-08 05:31:10', '2015-01-08 05:31:10'),
(4, 'male', '2015-01-08 05:31:39', '2015-01-08 05:31:39'),
(5, 'male', '2015-01-08 05:31:52', '2015-01-08 05:31:52'),
(6, 'male', '2015-02-08 14:32:26', '2015-02-08 14:32:26'),
(7, 'male', '2015-02-11 12:32:25', '2015-02-11 12:32:25'),
(8, 'male', '2015-03-26 13:33:53', '2015-03-26 13:33:53'),
(9, 'male', '2015-03-30 16:33:00', '2015-03-30 16:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_additional_photos`
--

CREATE TABLE IF NOT EXISTS `customer_additional_photos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `system_user_id` bigint(20) unsigned NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_additional_photos_id_unique` (`id`),
  KEY `customer_additional_photos_system_user_id_foreign` (`system_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer_additional_photos`
--

INSERT INTO `customer_additional_photos` (`id`, `system_user_id`, `image_name`, `original_name`, `file_size`, `created_at`, `updated_at`) VALUES
(2, 1, 'download.png', 'download.png', '123', '2015-05-18 06:22:58', '2015-05-18 06:22:58'),
(3, 1, 'Happy Birthday Swapnali.jpg', 'Happy Birthday Swapnali.jpg', '123', '2015-05-18 06:23:03', '2015-05-18 06:23:03'),
(4, 1, 'hrithik-roshan-workout1.jpg', 'hrithik-roshan-workout1.jpg', '123', '2015-05-18 06:23:04', '2015-05-18 06:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedbacks`
--

CREATE TABLE IF NOT EXISTS `customer_feedbacks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_provider_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `feedback` longtext COLLATE utf8_unicode_ci NOT NULL,
  `rating` float(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_feedbacks_id_unique` (`id`),
  KEY `customer_feedbacks_service_provider_id_foreign` (`service_provider_id`),
  KEY `customer_feedbacks_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `customer_feedbacks`
--

INSERT INTO `customer_feedbacks` (`id`, `service_provider_id`, `customer_id`, `feedback`, `rating`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'dsfdsfs dfssdfs dsfdsfdsf', 1.50, '2015-02-07 15:34:38', '2015-02-07 15:34:38'),
(3, 2, 1, 'i like you', 3.50, '2015-02-07 17:59:23', '2015-02-07 17:59:23'),
(4, 2, 1, 'i don''t know you', 0.50, '2015-02-07 17:59:57', '2015-02-07 17:59:57'),
(5, 2, 1, 'dshfs kljflk ;l;lk;lk;', 2.50, '2015-02-07 18:10:56', '2015-02-07 18:10:56'),
(6, 2, 1, 'dsfsfdsfdsf sdsf ccvvbbbewr', 3.50, '2015-02-07 18:11:45', '2015-02-07 18:11:45'),
(7, 2, 1, 'dd fvrr bbbbbbbbbbbbbb bbbbewrewr ytryutrum yukiuyoiykyreg retret ewrete\r\nwejrelwrj lejrlwelrewr', 0.50, '2015-02-07 18:12:14', '2015-02-07 18:12:14'),
(8, 2, 1, 'ghjghgjhg hgjghj jkhjk ghjhg ghjgh', 1.50, '2015-02-07 18:12:49', '2015-02-07 18:12:49'),
(9, 2, 1, 'i like you!! will see you soon', 4.00, '2015-02-08 09:08:21', '2015-02-08 09:08:21'),
(10, 3, 1, 'hey looking sweet!!', 2.50, '2015-02-08 14:48:57', '2015-02-08 14:48:57'),
(11, 7, 1, 'You Are Looking gr8', 3.50, '2015-03-24 17:00:31', '2015-03-24 17:00:31'),
(12, 12, 1, 'Hella Bella', 4.00, '2015-03-30 19:45:15', '2015-03-30 19:45:15'),
(13, 12, 1, 'Hella Bella', 4.00, '2015-03-30 19:45:41', '2015-03-30 19:45:41'),
(14, 10, 1, 'Hello How r u?', 3.50, '2015-04-01 07:20:39', '2015-04-01 07:20:39'),
(15, 10, 1, 'Hello How r u?', 3.50, '2015-04-01 07:21:01', '2015-04-01 07:21:01'),
(16, 10, 1, 'Hello World', 5.00, '2015-04-01 07:34:32', '2015-04-01 07:34:32'),
(17, 10, 1, 'how r u dng today?', 4.00, '2015-04-01 07:36:14', '2015-04-01 07:36:14'),
(18, 10, 1, 'hello World \r\nLife ho to aisi', 4.50, '2015-04-01 07:38:23', '2015-04-01 07:38:23'),
(19, 10, 1, 'qweert ertyy', 2.00, '2015-04-01 07:39:02', '2015-04-01 07:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `ethnicity_master`
--

CREATE TABLE IF NOT EXISTS `ethnicity_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ethnicity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ethnicity_master`
--

INSERT INTO `ethnicity_master` (`id`, `ethnicity`, `created_at`, `updated_at`) VALUES
(1, 'BLACK', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'WHITE', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(3, 'ASIAN', '2014-12-29 18:14:05', '2014-12-29 18:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `eye_color_master`
--

CREATE TABLE IF NOT EXISTS `eye_color_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eye_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `eye_color_master`
--

INSERT INTO `eye_color_master` (`id`, `eye_color`, `created_at`, `updated_at`) VALUES
(1, 'BLACK', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'BROWN', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(3, 'BLUE', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(4, 'GREEN', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(5, 'GREY', '2014-12-29 18:14:05', '2014-12-29 18:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `gender_master`
--

CREATE TABLE IF NOT EXISTS `gender_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gender_master`
--

INSERT INTO `gender_master` (`id`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'MALE', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'FEMALE', '2014-12-29 18:14:05', '2014-12-29 18:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `hair_color_master`
--

CREATE TABLE IF NOT EXISTS `hair_color_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hair_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hair_color_master`
--

INSERT INTO `hair_color_master` (`id`, `hair_color`, `created_at`, `updated_at`) VALUES
(1, 'BLACK', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'BROWN', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(3, 'WHITE', '2014-12-29 18:14:05', '2014-12-29 18:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `known_languages_master`
--

CREATE TABLE IF NOT EXISTS `known_languages_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `known_languages_master_id_unique` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `known_languages_master`
--

INSERT INTO `known_languages_master` (`id`, `language_name`, `created_at`, `updated_at`) VALUES
(1, 'ENGLISH', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'SPANISH', '2014-12-29 18:14:05', '2014-12-29 18:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_11_29_105352_create_system_users_table', 1),
('2014_11_29_105451_create_service_providers_table', 1),
('2014_11_29_110552_create_customers_table', 1),
('2014_11_29_110652_create_customer_additional_photos_table', 1),
('2014_11_29_110756_create_system_user_ip_logs_table', 1),
('2014_11_29_110841_create_known_languages_table', 1),
('2014_11_29_110936_create_service_provider_languages_table', 1),
('2014_11_29_111014_create_customer_feedbacks_table', 1),
('2014_11_29_111058_create_service_provider_availabilities_table', 1),
('2014_11_29_111148_create_user_messages_table', 1),
('2014_11_29_111248_create_user_role_table', 1),
('2014_11_29_111456_add_fk_system_user_ip_logs_table', 1),
('2014_11_29_112031_add_fk_customer_additional_photos_table', 1),
('2014_11_29_113200_add_fk_system_users_table', 1),
('2014_11_29_114445_add_fk_service_provider_languages_table', 1),
('2014_11_29_121654_add_fk_customer_feedbacks_table', 1),
('2014_11_29_122114_add_fk_service_provider_availabilities_table', 1),
('2014_11_29_123013_add_fk_user_messages_table', 1),
('2014_12_09_085547_add_remember_token_to_system_users_table', 1),
('2014_12_27_170100_add_birth_year_to_system_users_table', 1),
('2014_12_29_221044_create_ethnicity_master_table', 1),
('2014_12_29_221316_create_eye_color_master_table', 1),
('2014_12_29_221401_create_hair_color_master_table', 1),
('2014_12_29_221508_create_week_day_master_table', 1),
('2014_12_29_221542_create_gender_master_table', 1),
('2015_01_09_120140_add_is_new_flag_to_user_message', 2),
('2015_01_29_113406_create_cache_table', 3),
('2015_01_29_160605_create_password_reminders_table', 3),
('2015_02_08_224632_create_cache_table', 4),
('2015_02_28_104020_cup_size_master', 4),
('2015_02_28_174128_add_penis_size_to_service_provider_table', 5),
('2015_03_02_230859_add_toastr_notification_to_user_messages_table', 6),
('2015_04_09_200229_add_image_by_ratio_to_system_users_table', 7),
('2015_04_09_232241_add_image_by_ratio_62_by_54_to_system_users_table', 7),
('2015_05_14_235251_add_original_name_to_customer_additional_photos_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reminders`
--

INSERT INTO `password_reminders` (`email`, `token`, `created_at`) VALUES
('aaaaaa@gmail.com', 'a1d4605eea043f072daf2e51595b249e3e7e1fe3', '2015-01-29 12:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE IF NOT EXISTS `service_providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `riseme_up` int(11) NOT NULL DEFAULT '0',
  `profile_completeness` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visit_frequency` int(11) DEFAULT NULL,
  `turns_me_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pubic_hair` tinyint(4) DEFAULT NULL,
  `bust` int(11) DEFAULT NULL,
  `cup_size` int(11) DEFAULT NULL,
  `penis_size` int(11) DEFAULT NULL,
  `waist` int(11) DEFAULT NULL,
  `hips` int(11) DEFAULT NULL,
  `ethnicity` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `eye_color` int(11) DEFAULT NULL,
  `hair_color` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_providers_id_unique` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `riseme_up`, `profile_completeness`, `visit_frequency`, `turns_me_on`, `expertise`, `pubic_hair`, `bust`, `cup_size`, `penis_size`, `waist`, `hips`, `ethnicity`, `weight`, `height`, `eye_color`, `hair_color`, `created_at`, `updated_at`) VALUES
(1, 1, '87.5', 81, 'havSHKCvK>JDB bkjb lknl kdnblk  hslkdvnlk', NULL, 1, 80, 6, 25, 65, 80, 3, 67, 178, 4, 3, '2014-12-29 18:42:36', '2015-05-18 05:35:42'),
(2, 0, '89.47', 6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 1, 60, NULL, NULL, 55, 80, 1, 55, 165, 1, 1, '2014-12-29 18:42:35', '2014-12-29 19:02:46'),
(3, 0, '84.21', 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 0, 60, NULL, NULL, 60, 80, 1, 60, 160, 1, 1, '2014-12-30 13:42:44', '2014-12-30 14:50:23'),
(4, 0, '52.63', 8, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, '2014-12-30 13:42:13', '2014-12-30 14:50:23'),
(5, 0, '84.21', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 1, 60, NULL, NULL, 55, 80, 1, 60, 160, 1, 1, '2014-12-30 13:42:33', '2014-12-30 14:50:23'),
(6, 0, '84.21', 7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 1, 70, NULL, NULL, 55, 65, 1, 60, 160, 1, 1, '2014-12-30 13:42:06', '2014-12-30 14:50:23'),
(7, 0, '89.47', 6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 0, 70, NULL, NULL, 65, 80, 1, 55, 165, 1, 1, '2014-12-30 14:42:19', '2014-12-30 14:57:45'),
(8, 0, '89.47', 7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 0, 50, NULL, NULL, 55, 65, 1, 55, 165, 1, 1, '2014-12-30 14:42:06', '2014-12-30 15:00:10'),
(9, 0, '89.47', 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 0, 50, NULL, NULL, 55, 80, 1, 70, 165, 1, 1, '2014-12-30 17:42:30', '2014-12-30 17:43:33'),
(10, 0, '84.21', 8, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 1, 60, NULL, NULL, 55, 65, 1, 60, 160, 1, 1, '2014-12-30 17:42:40', '2014-12-30 17:43:33'),
(11, 0, '89.47', 8, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 0, 70, NULL, NULL, 55, 65, 1, 60, 170, 1, 1, '2014-12-30 17:42:45', '2014-12-30 17:43:33'),
(12, 0, '89.47', 11, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, 0, 60, NULL, NULL, 70, 80, 1, 70, 160, 1, 1, '2014-12-30 17:42:25', '2014-12-30 17:43:33'),
(13, 0, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-01-05 06:31:22', '2015-01-05 06:31:22'),
(14, 0, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-01-05 06:31:44', '2015-01-05 06:31:44'),
(15, 0, '10.53', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2015-01-27 11:31:28', '2015-01-27 13:30:51'),
(16, 0, NULL, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-08 14:32:32', '2015-02-08 15:22:40'),
(17, 0, NULL, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-10 12:32:00', '2015-02-10 12:32:37'),
(18, 0, '10.53', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-27 08:32:28', '2015-02-27 09:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_availabilities`
--

CREATE TABLE IF NOT EXISTS `service_provider_availabilities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_provider_id` bigint(20) unsigned NOT NULL,
  `week_day` int(11) NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_provider_availabilities_id_unique` (`id`),
  KEY `service_provider_availabilities_service_provider_id_foreign` (`service_provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `service_provider_availabilities`
--

INSERT INTO `service_provider_availabilities` (`id`, `service_provider_id`, `week_day`, `from_time`, `to_time`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '11:00:00', '18:00:00', '2014-12-29 18:42:35', '2014-12-29 18:42:35'),
(2, 2, 3, '01:00:00', '18:00:00', '2014-12-29 18:42:35', '2014-12-29 18:42:35'),
(3, 2, 6, '11:00:00', '18:00:00', '2014-12-29 18:42:35', '2014-12-29 18:42:35'),
(4, 3, 1, '11:00:00', '13:00:00', '2014-12-30 13:42:44', '2014-12-30 13:42:44'),
(5, 3, 3, '01:00:00', '13:00:00', '2014-12-30 13:42:44', '2014-12-30 13:42:44'),
(6, 3, 6, '11:00:00', '13:00:00', '2014-12-30 13:42:45', '2014-12-30 13:42:45'),
(7, 4, 6, '00:00:00', '00:00:00', '2014-12-30 13:42:14', '2014-12-30 13:42:14'),
(8, 5, 1, '11:00:00', '13:00:00', '2014-12-30 13:42:34', '2014-12-30 13:42:34'),
(9, 5, 3, '01:00:00', '13:00:00', '2014-12-30 13:42:34', '2014-12-30 13:42:34'),
(10, 5, 5, '11:00:00', '18:00:00', '2014-12-30 13:42:34', '2014-12-30 13:42:34'),
(11, 6, 1, '11:00:00', '13:00:00', '2014-12-30 13:42:07', '2014-12-30 13:42:07'),
(12, 6, 3, '01:00:00', '13:00:00', '2014-12-30 13:42:07', '2014-12-30 13:42:07'),
(13, 6, 5, '11:00:00', '18:00:00', '2014-12-30 13:42:07', '2014-12-30 13:42:07'),
(14, 7, 1, '11:00:00', '18:00:00', '2014-12-30 14:42:19', '2014-12-30 14:42:19'),
(15, 7, 3, '01:00:00', '18:00:00', '2014-12-30 14:42:19', '2014-12-30 14:42:19'),
(16, 7, 6, '11:00:00', '18:00:00', '2014-12-30 14:42:19', '2014-12-30 14:42:19'),
(17, 8, 1, '11:00:00', '18:00:00', '2014-12-30 14:42:06', '2014-12-30 14:42:06'),
(18, 8, 3, '01:00:00', '18:00:00', '2014-12-30 14:42:06', '2014-12-30 14:42:06'),
(19, 8, 6, '11:00:00', '18:00:00', '2014-12-30 14:42:06', '2014-12-30 14:42:06'),
(20, 9, 1, '11:00:00', '18:00:00', '2014-12-30 17:42:30', '2014-12-30 17:42:30'),
(21, 9, 3, '01:00:00', '18:00:00', '2014-12-30 17:42:30', '2014-12-30 17:42:30'),
(22, 9, 6, '11:00:00', '18:00:00', '2014-12-30 17:42:30', '2014-12-30 17:42:30'),
(23, 10, 1, '11:00:00', '18:00:00', '2014-12-30 17:42:41', '2014-12-30 17:42:41'),
(24, 10, 3, '01:00:00', '18:00:00', '2014-12-30 17:42:41', '2014-12-30 17:42:41'),
(25, 10, 6, '11:00:00', '18:00:00', '2014-12-30 17:42:41', '2014-12-30 17:42:41'),
(26, 11, 1, '11:00:00', '18:00:00', '2014-12-30 17:42:45', '2014-12-30 17:42:45'),
(27, 11, 3, '01:00:00', '18:00:00', '2014-12-30 17:42:45', '2014-12-30 17:42:45'),
(28, 11, 6, '11:00:00', '18:00:00', '2014-12-30 17:42:45', '2014-12-30 17:42:45'),
(29, 12, 1, '11:00:00', '18:00:00', '2014-12-30 17:42:25', '2014-12-30 17:42:25'),
(30, 12, 3, '01:00:00', '18:00:00', '2014-12-30 17:42:25', '2014-12-30 17:42:25'),
(31, 12, 6, '11:00:00', '18:00:00', '2014-12-30 17:42:25', '2014-12-30 17:42:25'),
(32, 1, 4, '15:00:00', '14:00:00', '2015-04-08 13:36:26', '2015-05-18 06:18:42'),
(33, 1, 5, '16:00:00', '00:00:00', '2015-04-08 13:44:52', '2015-05-18 06:18:42'),
(36, 1, 1, '02:00:00', '00:00:00', '2015-05-17 13:42:30', '2015-05-18 06:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_languages`
--

CREATE TABLE IF NOT EXISTS `service_provider_languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `known_languages_id` bigint(20) unsigned NOT NULL,
  `service_provider_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_provider_languages_id_unique` (`id`),
  KEY `service_provider_languages_known_languages_id_foreign` (`known_languages_id`),
  KEY `service_provider_languages_service_provider_id_foreign` (`service_provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `service_provider_languages`
--

INSERT INTO `service_provider_languages` (`id`, `known_languages_id`, `service_provider_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2014-12-29 18:42:36', '2014-12-29 18:42:36'),
(2, 2, 1, '2014-12-29 18:42:36', '2014-12-29 18:42:36'),
(3, 1, 2, '2014-12-29 18:42:35', '2014-12-29 18:42:35'),
(4, 2, 2, '2014-12-29 18:42:35', '2014-12-29 18:42:35'),
(5, 1, 3, '2014-12-30 13:42:44', '2014-12-30 13:42:44'),
(6, 2, 3, '2014-12-30 13:42:44', '2014-12-30 13:42:44'),
(7, 1, 4, '2014-12-30 13:42:13', '2014-12-30 13:42:13'),
(8, 2, 4, '2014-12-30 13:42:14', '2014-12-30 13:42:14'),
(9, 1, 5, '2014-12-30 13:42:33', '2014-12-30 13:42:33'),
(10, 2, 5, '2014-12-30 13:42:34', '2014-12-30 13:42:34'),
(11, 1, 6, '2014-12-30 13:42:07', '2014-12-30 13:42:07'),
(12, 2, 6, '2014-12-30 13:42:07', '2014-12-30 13:42:07'),
(13, 1, 7, '2014-12-30 14:42:19', '2014-12-30 14:42:19'),
(14, 2, 7, '2014-12-30 14:42:19', '2014-12-30 14:42:19'),
(15, 1, 8, '2014-12-30 14:42:06', '2014-12-30 14:42:06'),
(16, 2, 8, '2014-12-30 14:42:06', '2014-12-30 14:42:06'),
(17, 1, 9, '2014-12-30 17:42:30', '2014-12-30 17:42:30'),
(18, 2, 9, '2014-12-30 17:42:30', '2014-12-30 17:42:30'),
(19, 1, 10, '2014-12-30 17:42:40', '2014-12-30 17:42:40'),
(20, 2, 10, '2014-12-30 17:42:40', '2014-12-30 17:42:40'),
(21, 1, 11, '2014-12-30 17:42:45', '2014-12-30 17:42:45'),
(22, 2, 11, '2014-12-30 17:42:45', '2014-12-30 17:42:45'),
(23, 1, 12, '2014-12-30 17:42:25', '2014-12-30 17:42:25'),
(24, 2, 12, '2014-12-30 17:42:25', '2014-12-30 17:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE IF NOT EXISTS `system_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `current_age` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `user_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_330by220` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_250by180` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_62by54` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_role_id` bigint(20) unsigned NOT NULL,
  `service_provider_id` bigint(20) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `from_age` bigint(20) DEFAULT NULL,
  `to_age` bigint(20) DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_users_id_unique` (`id`),
  UNIQUE KEY `system_users_username_unique` (`username`),
  UNIQUE KEY `system_users_email_unique` (`email`),
  KEY `system_users_user_role_id_foreign` (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `username`, `password`, `email`, `contact_no`, `birth_date`, `current_age`, `gender`, `is_active`, `user_first_name`, `user_last_name`, `profile_image`, `image_330by220`, `image_250by180`, `image_62by54`, `user_role_id`, `service_provider_id`, `customer_id`, `from_age`, `to_age`, `latitude`, `longitude`, `city`, `country`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abcdxyz', '$2y$10$jYDJyxWLnFQTDFrPYAGyHemybD2o1liBqh6yfJ/ByB19s1epYIQHi', 'abcdxyz@gmail.com', NULL, '1988-01-16', 26, 1, 1, 'rocky', 'balbova', '90c27e16538df0e44488994acb84ff31a4d5f50c.jpg', '11431857243_330x220.jpg', '11431857243_250x180.jpg', '11431857243_62x54.jpg', 1, NULL, 1, 18, 73, '19.0759837', '72.87765590000004', 'Mumbai', 'India', 'sXYXEjQsqDQnOhhwMj5VN2Wi8YDxWCaGDNNEqywAO8SSe7qaMdJ6hdW4kPos', '2014-12-29 18:42:41', '2015-05-18 06:23:44'),
(2, 'aaaaaa', '$2y$10$9RIqowJfwAZScdtEJia/k.NzB0INviL7C8.fZAR1q6RdzRYHptw9e', 'aaaaaa@gmail.com', NULL, '1989-09-14', 25, 1, 1, 'sandeep', 'sennnn', 'd6a59156e6eda0752e6b18cd01437236d2ccab39.jpg', '21431866892_330x220.jpg', '21431866892_250x180.jpg', '21431866892_62x54.jpg', 2, 1, NULL, 18, 75, '19.0759837', '72.87765590000004', 'Mumbai', 'India', 'qSMdB5zcQWIPheAK5TMpnO4jVM7E7Vuvwx0heMFUcHle0DORsDoMBed46rc1', '2014-12-29 18:42:36', '2015-05-18 05:35:42'),
(3, 'gggggg', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'gggggg@gmail.com', NULL, '1989-09-20', 25, 2, 1, 'emma', 'watson', '0d196747156e6318206c29e78d1c710eafb6475f.jpg', NULL, NULL, NULL, 2, 2, NULL, 22, 28, '18.567929', '73.91431790000001', 'Pune', '', 'n2r122cP0aKCb58giLXSNMUTXtuHh0GfBOzUMmgS', '2014-12-29 18:42:35', '2014-12-29 18:42:35'),
(6, 'vvvvvv', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'vvvvvv@gmail.com', NULL, '1989-09-20', 25, 2, 1, 'vvvvvv', 'vvvvvv', '187f492174103802037e0149e6cd093b5b98737c.jpg', NULL, NULL, NULL, 2, 3, NULL, 22, 30, '18.4498697', '73.87528120000002', 'Pune', '', '9vME3zxiC1mpf5aHp3psZtV8Z4UZdaF9Ru8Tbj0A', '2014-12-30 13:42:44', '2014-12-30 13:42:44'),
(7, 'mmmmmm', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'mmmmmm@gmail.com', NULL, '1988-09-20', 26, 2, 1, 'mmmmmm', 'mmmmmm', '3920a2a0262a8045084f12c45d1b49a02b5216fc.jpg', NULL, NULL, NULL, 2, 4, NULL, 20, 25, '18.5245967', '73.84105840000007', 'Shivajinagar', 'India', '9vME3zxiC1mpf5aHp3psZtV8Z4UZdaF9Ru8Tbj0A', '2014-12-30 13:42:13', '2014-12-30 13:42:13'),
(8, 'cccccc', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'cccccc@gmail.com', NULL, '1990-01-19', 24, 1, 1, 'cccccc', 'cccccc', '2f5354247cee33958aaa0f93e6bcf1af7c145dde.jpg', NULL, NULL, NULL, 2, 5, NULL, 22, 30, '18.5073985', '73.80765040000006', 'Pune', '', '9vME3zxiC1mpf5aHp3psZtV8Z4UZdaF9Ru8Tbj0A', '2014-12-30 13:42:33', '2014-12-30 13:42:33'),
(9, 'ffffff', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'ffffff@gmail.com', NULL, '1991-09-20', 23, 2, 1, 'ffffff', 'ffffff', '7fe7e2b0f5aa016332059b4e6e687a3880c57090.jpg', NULL, NULL, NULL, 2, 6, NULL, 20, 30, '18.4908277', '73.82025599999997', 'Pune', '', '9vME3zxiC1mpf5aHp3psZtV8Z4UZdaF9Ru8Tbj0A', '2014-12-30 13:42:06', '2014-12-30 13:42:07'),
(10, 'oooooo', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'oooooo@gmail.com', NULL, '1991-01-19', 23, 2, 1, 'oooooo', 'oooooo', '300ee0b72891065b5f1c9e9574ead9ae9f4c03d0.jpg', NULL, NULL, NULL, 2, 7, NULL, 20, 30, '18.5073985', '73.80765040000006', 'Pune', '', '9vME3zxiC1mpf5aHp3psZtV8Z4UZdaF9Ru8Tbj0A', '2014-12-30 14:42:18', '2014-12-30 14:42:19'),
(11, 'llllll', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'llllll@gmail.com', NULL, '1988-01-19', 26, 2, 1, 'llllll', 'llllll', 'fac4c4e80a6f8a9d45bb8352463555c82dc455f2.jpg', NULL, NULL, NULL, 2, 8, NULL, 0, 0, '18.505915', '73.79503499999998', 'Pune', 'India', '9vME3zxiC1mpf5aHp3psZtV8Z4UZdaF9Ru8Tbj0A', '2014-12-30 14:42:06', '2014-12-30 14:42:06'),
(12, 'tttttt', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'tttttt@gmail.com', NULL, '1988-01-19', 26, 2, 1, 'tttttt', 'tttttt', 'f9eddd454cabecba132d752769b104c303c1f744.jpg', NULL, NULL, NULL, 2, 9, NULL, 22, 30, '18.4908277', '73.82025599999997', 'Pune', '', 'Gtuv6xBMI4MEhXTu5ZXSTtuHhHIufC60f1JKBCTV', '2014-12-30 17:42:30', '2014-12-30 17:42:30'),
(13, 'eeeeee', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'eeeeee@gmail.com', NULL, '1989-09-20', 25, 2, 1, 'eeeeee', 'eeeeee', 'e1915c9c127a795f3604bd2a075856d148a9d5f0.jpg', NULL, NULL, NULL, 2, 10, NULL, 20, 30, '18.497484', '73.81349', 'Kothrud', 'India', 'Gtuv6xBMI4MEhXTu5ZXSTtuHhHIufC60f1JKBCTV', '2014-12-30 17:42:40', '2014-12-30 17:42:40'),
(14, 'wwwwww', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'wwwwww@gmail.com', NULL, '1988-01-19', 26, 2, 1, 'wwwwww', 'wwwwww', '8fe08938911ecc5f7943fc5d7754a1f69ee39e99.jpg', NULL, NULL, NULL, 2, 11, NULL, 20, 30, '18.509258', '73.83162800000002', 'Erandwane', 'India', 'Gtuv6xBMI4MEhXTu5ZXSTtuHhHIufC60f1JKBCTV', '2014-12-30 17:42:44', '2014-12-30 17:42:45'),
(15, 'ssssss', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'ssssss@gmail.com', NULL, '1991-01-19', 23, 2, 1, 'ssssss', 'ssssss', '5bea98ec8db56166f97065a23be72ba0abfeef30.jpg', NULL, NULL, NULL, 2, 12, NULL, 20, 30, '18.5175566', '73.84166000000005', 'Pune', 'India', 'Gtuv6xBMI4MEhXTu5ZXSTtuHhHIufC60f1JKBCTV', '2014-12-30 17:42:25', '2014-12-30 17:42:25'),
(16, 'uuuuuuu', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'uuuuuuu@gmail.com', NULL, NULL, NULL, NULL, 0, 'uuuuuuu', 'uuuuuuu', '37bd61b13365dab9748b872107807f0c1605d204.jpg', NULL, NULL, NULL, 1, NULL, 2, 25, 45, '18.528801', '73.87447299999997', 'Pune', 'India', 'bYa12AFDg4c04rjBdYwzuOzR99ReGBCeWDcGrW3b', '2015-01-05 06:31:37', '2015-01-05 06:31:37'),
(17, 'iiiiii', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'iiiiii@gmail.com', NULL, NULL, NULL, NULL, 0, 'iiiiii', 'iiiiii', '3cbcdfc9207df826426b010f006f5e59e5a2cd34.jpg', NULL, NULL, NULL, 2, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bYa12AFDg4c04rjBdYwzuOzR99ReGBCeWDcGrW3b', '2015-01-05 06:31:21', '2015-01-05 06:31:22'),
(18, 'jjjkkk', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'jjjkkk@gmail.com', NULL, NULL, NULL, NULL, 0, 'jjjkkk', 'jjjkkk', '8b5b23848d68c14d7aa3d859326688190c897bb9.jpg', NULL, NULL, NULL, 2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bYa12AFDg4c04rjBdYwzuOzR99ReGBCeWDcGrW3b', '2015-01-05 06:31:43', '2015-01-05 06:31:44'),
(19, 'sagar.woxi@gmail.com', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'sagar.woxi@gmail.com', NULL, NULL, NULL, NULL, 0, 'sagar', 'acharya', '8b5b23848d68c14d7aa3d859326688190c897bb9.jpg', NULL, NULL, NULL, 1, NULL, NULL, 15, 45, '18.4908277', '73.82025599999997', 'Pune', 'India', 'GgDpHEOUqMF9WYR0XtvJPRXun3sL9i2EYCcRuz6f', '2015-01-08 05:31:40', '2015-01-08 05:31:40'),
(20, 'sagar.woxi1@gmail.com', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'sagar.woxi1@gmail.com', NULL, NULL, NULL, NULL, 0, 'sagar', 'acharya', '141b3cc53f05c152439f9ccb3c69e046baeb0b3e.jpg', NULL, NULL, NULL, 1, NULL, 3, 15, 45, '18.497484', '73.81349', 'Pune', 'India', 'GgDpHEOUqMF9WYR0XtvJPRXun3sL9i2EYCcRuz6f', '2015-01-08 05:31:10', '2015-01-08 05:31:10'),
(21, 'sagara', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'sagar.woxi22@gmail.com', NULL, NULL, NULL, NULL, 0, 'sagar', 'acharya', '80ed456cc2780d3c0b5853bb0789f63e90fdbfd5.jpg', NULL, NULL, NULL, 1, NULL, 4, 16, 60, '18.4908277', '73.82025599999997', 'Pune', 'India', 'GgDpHEOUqMF9WYR0XtvJPRXun3sL9i2EYCcRuz6f', '2015-01-08 05:31:38', '2015-01-08 05:31:39'),
(22, 'sagaraa', '$2y$10$TDnLdhwd1s3ax7UXgOOEUeb2KHF//1IJAPbo48VGu8qU/dj.Zehyi', 'sagar.woxi3@gmail.com', NULL, NULL, NULL, NULL, 0, 'sagar', 'acharya', '78ac38d749a20230dfb265530f8153399d7ad46e.jpg', NULL, NULL, NULL, 1, NULL, 5, 16, 60, '18.4908277', '73.82025599999997', 'Pune', 'India', 'GgDpHEOUqMF9WYR0XtvJPRXun3sL9i2EYCcRuz6f', '2015-01-08 05:31:52', '2015-01-08 05:31:52'),
(23, 'ragini', '$2y$10$UJ3utKzONVuwl0BgnBIiluNEeyxXKoJZMS58.XMgjPeE6x493NRYe', 'ragini@gmail.com', NULL, NULL, NULL, NULL, 1, 'ragini', 'sharma', 'c1799fd75256d40f2947fb30c9a559f2f9ee39a7.jpg', NULL, NULL, NULL, 2, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EBfPXHkq868ts3LxA1dIZMoYquMw8CHSFItE9X2Hxoy7xUj103XB4UDkvGBZd', '2015-01-27 11:31:27', '2015-01-27 13:31:27'),
(25, 'admin', '$2y$10$NajyvxgEHOvoL62TmmDhieZB1oWIr4dW5cYuM00wh1Y7pih1Xi97G', 'admin@gmail.com', NULL, NULL, NULL, NULL, 1, 'sagar', 'acharya', 'no_image.jpg', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gDykWPGvbkkM3iwg4l4fXKqIbmmYCOQSMPy1L9FCcGmw6yZUU8wBnngEKQ1M', '2015-01-31 12:16:00', '2015-05-18 06:18:50'),
(26, 'xxxxxxx', '$2y$10$MXo4diH9NrmqLLeYvVfwU.la.4l8wqxt5GZySCFx6ur9dyffZzE4W', 'xxxxxx@gmail.com', NULL, NULL, NULL, NULL, 1, 'xxxxdd', 'sssssdd', '51ce76365db30b710aca96386eab8b133cd7d4cd.png', NULL, NULL, NULL, 1, NULL, 6, 16, 60, '18.4897587', '73.82029620000003', 'Pune', 'India', 'csBhZ8Hxsp4w9ltFbrF7WQcN2Sbq8hIg441YiZl41PoL9A7Ylf5LsHa7qoSX', '2015-02-08 14:32:26', '2015-02-08 15:20:37'),
(27, 'aaaccc', '$2y$10$nuTvKNkYRKACpx7QFAFlsei.HApZI9DwavfPaXUhFBRYvUzQ7Znha', 'aaaccc@gmail.com', NULL, NULL, NULL, NULL, 1, 'aaaccc', 'cccaaa', '73c38d12b7892096f0496f5b4f8f0bc796d6fefc.png', NULL, NULL, NULL, 2, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yCSkezbTYN6bvMXBybEe2AfRBGZt7iUKrsqu7ndYsCHrYYTN3OH5kqFNhVCm', '2015-02-08 14:32:32', '2015-02-08 15:22:53'),
(28, 'fffddd', '$2y$10$wVlznfE99F4DgWyGerTVouhDtPQv6PdmD8mp5qVIs8WOFMulsJorC', 'fffddd@gmail.com', NULL, NULL, NULL, NULL, 1, 'fffddd', 'fffddd', '582c42ac5a25136c5e30411feea4ef235d2fad89.png', NULL, NULL, NULL, 2, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ziX27VUWrhZikqTK6sfG41qULBSlumso5JxAAPzQioXfnf0eG93lFgkqpZux', '2015-02-10 12:32:00', '2015-02-10 12:52:37'),
(29, 'cvcvcv', '$2y$10$SgR2asQNUd7THDsfDW3FFe64CNc4EDcfrdZQwqji0.41SU9xAvpbC', 'cvcvcv@gmail.com', NULL, NULL, NULL, NULL, 1, 'cvcvcv', 'cvcvcv', '5234ba309a8944917d4921572870a8c872cf85dd.png', NULL, NULL, NULL, 1, NULL, 7, 16, 60, '18.5204303', '73.85674369999992', 'Pune', 'India', 'Vj4Gqlbao2s2nmzSJLzguDBvvUyejAdHKapdDNIJ0udIQbspuImSNgVT6oyJ', '2015-02-11 12:32:24', '2015-02-21 10:58:09'),
(30, 'shyam.joshi', '$2y$10$AoShV5epUoqQBgtmTk9iheJWakOvQWtE3N/JdNhOi9hKBfTYQFyEO', 'shyam@gmail.com', NULL, NULL, NULL, NULL, 1, 'shyam', 'joshi', 'a5bd5652330e66877683fb9292a08c5627c51dba.jpg', NULL, NULL, NULL, 2, 18, NULL, NULL, NULL, '18.4897587', '73.82029620000003', 'Pune', 'India', '7c3UHjBjdoZxvhr7lN2GixFJ39L3mvvnlmgCqaFb', '2015-02-27 08:32:28', '2015-02-27 08:32:29'),
(31, 'bharatmak7', '$2y$10$VK65mzDHYwD.ZxCgJjbq3e2po8DYGNKb91Mj4lkI9opUF2PHj6yRy', 'mak13hp@yahoo.com', NULL, NULL, NULL, NULL, 0, 'Bharat', 'Makwana', '5a93b2a6b5fd64e14afce8a24cf41a4100650101.jpg', NULL, NULL, NULL, 1, NULL, 8, 31, 99, '18.5204303', '73.85674369999992', 'Pune', 'India', '1MSIjuj9z2sZ6kvUcfZHJdgsiR7MNirgVcAyo9VM', '2015-03-26 13:33:53', '2015-03-26 13:33:54'),
(32, 'mak123456', '$2y$10$YBXGaSprrzHTYJSnQCBTs.C69mlZ7/eiHmn7XIjk3Utqgn6OZBIY.', 'bharat.makwana@woxiprogrammers.com', NULL, NULL, NULL, NULL, 0, 'Bharat', 'Makwana', '86c5e47ccad7310d5af31af85139cd1a6d268bad.jpg', NULL, NULL, NULL, 1, NULL, 9, 33, 62, '18.5204303', '73.85674369999992', 'Pune', 'India', 'rmBDOl4mB9oeNnTErpBXGMXaAnrETIZAuKlLfeG5oG8dcxZG7jc86eLXoHGG', '2015-03-30 16:33:00', '2015-03-30 16:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `system_user_ip_logs`
--

CREATE TABLE IF NOT EXISTS `system_user_ip_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `system_user_id` bigint(20) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_user_ip_logs_id_unique` (`id`),
  KEY `system_user_ip_logs_system_user_id_foreign` (`system_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=205 ;

--
-- Dumping data for table `system_user_ip_logs`
--

INSERT INTO `system_user_ip_logs` (`id`, `system_user_id`, `ip_address`, `browser`, `os`, `login_time`, `created_at`, `updated_at`) VALUES
(1, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-07 08:31:02', '2015-01-07 08:31:02', '2015-01-07 08:31:02'),
(2, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-07 08:31:46', '2015-01-07 08:31:46', '2015-01-07 08:31:46'),
(3, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-07 08:31:44', '2015-01-07 08:31:44', '2015-01-07 08:31:44'),
(4, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-07 11:31:29', '2015-01-07 11:31:29', '2015-01-07 11:31:29'),
(5, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-07 13:31:06', '2015-01-07 13:31:06', '2015-01-07 13:31:06'),
(6, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-07 14:31:05', '2015-01-07 14:31:05', '2015-01-07 14:31:05'),
(7, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-08 06:31:13', '2015-01-08 06:31:13', '2015-01-08 06:31:13'),
(8, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-09 06:31:03', '2015-01-09 06:31:03', '2015-01-09 06:31:03'),
(9, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-09 09:31:37', '2015-01-09 09:31:37', '2015-01-09 09:31:37'),
(10, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-10 04:31:56', '2015-01-10 04:31:56', '2015-01-10 04:31:56'),
(11, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-10 07:31:38', '2015-01-10 07:31:38', '2015-01-10 07:31:38'),
(12, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-12 05:31:26', '2015-01-12 05:31:26', '2015-01-12 05:31:26'),
(13, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-12 07:31:56', '2015-01-12 07:31:56', '2015-01-12 07:31:56'),
(14, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-12 11:31:39', '2015-01-12 11:31:39', '2015-01-12 11:31:39'),
(15, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-12 11:31:26', '2015-01-12 11:31:26', '2015-01-12 11:31:26'),
(16, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-12 16:31:44', '2015-01-12 16:31:44', '2015-01-12 16:31:44'),
(17, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-13 08:31:14', '2015-01-13 08:31:14', '2015-01-13 08:31:14'),
(18, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-14 08:31:51', '2015-01-14 08:31:51', '2015-01-14 08:31:51'),
(19, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-17 06:31:20', '2015-01-17 06:31:20', '2015-01-17 06:31:20'),
(20, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.95', 'name:Linux version:unknown', '2015-01-17 06:31:37', '2015-01-17 06:31:37', '2015-01-17 06:31:37'),
(21, 1, '127.0.0.1', 'name:Firefox version:34.0', 'name:Linux version:unknown', '2015-01-17 07:31:17', '2015-01-17 07:31:17', '2015-01-17 07:31:17'),
(22, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-18 17:31:06', '2015-01-18 17:31:06', '2015-01-18 17:31:06'),
(23, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-20 05:31:33', '2015-01-20 05:31:33', '2015-01-20 05:31:33'),
(24, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-20 05:31:31', '2015-01-20 05:31:31', '2015-01-20 05:31:31'),
(25, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-21 06:31:01', '2015-01-21 06:31:01', '2015-01-21 06:31:01'),
(26, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-21 06:31:58', '2015-01-21 06:31:58', '2015-01-21 06:31:58'),
(27, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-23 09:31:38', '2015-01-23 09:31:38', '2015-01-23 09:31:38'),
(28, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-23 10:31:44', '2015-01-23 10:31:44', '2015-01-23 10:31:44'),
(29, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-23 10:31:31', '2015-01-23 10:31:31', '2015-01-23 10:31:31'),
(30, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-26 13:31:21', '2015-01-26 13:31:21', '2015-01-26 13:31:21'),
(31, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 04:31:55', '2015-01-27 04:31:55', '2015-01-27 04:31:55'),
(32, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 07:31:47', '2015-01-27 07:31:47', '2015-01-27 07:31:47'),
(33, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 07:31:58', '2015-01-27 07:31:58', '2015-01-27 07:31:58'),
(34, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 07:31:27', '2015-01-27 07:31:27', '2015-01-27 07:31:27'),
(35, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 07:31:42', '2015-01-27 07:31:42', '2015-01-27 07:31:42'),
(36, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 07:31:04', '2015-01-27 07:31:04', '2015-01-27 07:31:04'),
(37, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-27 07:31:20', '2015-01-27 07:31:20', '2015-01-27 07:31:20'),
(38, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-27 07:31:14', '2015-01-27 07:31:14', '2015-01-27 07:31:14'),
(39, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-27 08:31:14', '2015-01-27 08:31:14', '2015-01-27 08:31:14'),
(40, 23, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 11:31:57', '2015-01-27 11:31:57', '2015-01-27 11:31:57'),
(41, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-27 13:31:52', '2015-01-27 13:31:52', '2015-01-27 13:31:52'),
(42, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-29 04:31:51', '2015-01-29 04:31:51', '2015-01-29 04:31:51'),
(43, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-29 04:31:25', '2015-01-29 04:31:25', '2015-01-29 04:31:25'),
(44, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-29 04:31:29', '2015-01-29 04:31:29', '2015-01-29 04:31:29'),
(45, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-29 05:31:14', '2015-01-29 05:31:14', '2015-01-29 05:31:14'),
(46, 2, '127.0.0.1', 'name:Firefox version:31.0', 'name:Linux version:unknown', '2015-01-29 05:31:08', '2015-01-29 05:31:08', '2015-01-29 05:31:08'),
(47, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-29 08:31:33', '2015-01-29 08:31:33', '2015-01-29 08:31:33'),
(48, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-29 09:31:21', '2015-01-29 09:31:21', '2015-01-29 09:31:21'),
(49, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-29 09:31:17', '2015-01-29 09:31:17', '2015-01-29 09:31:17'),
(50, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-29 10:31:42', '2015-01-29 10:31:42', '2015-01-29 10:31:42'),
(51, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 06:31:16', '2015-01-30 06:31:16', '2015-01-30 06:31:16'),
(52, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 06:31:47', '2015-01-30 06:31:47', '2015-01-30 06:31:47'),
(53, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 06:31:15', '2015-01-30 06:31:15', '2015-01-30 06:31:15'),
(54, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 10:31:38', '2015-01-30 10:31:38', '2015-01-30 10:31:38'),
(55, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 10:31:55', '2015-01-30 10:31:55', '2015-01-30 10:31:55'),
(56, 2, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 10:31:01', '2015-01-30 10:31:01', '2015-01-30 10:31:01'),
(57, 1, '127.0.0.1', 'name:Chrome version:39.0.2171.99', 'name:Linux version:unknown', '2015-01-30 10:31:17', '2015-01-30 10:31:17', '2015-01-30 10:31:17'),
(58, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-01-31 06:31:15', '2015-01-31 06:31:15', '2015-01-31 06:31:15'),
(59, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-01-31 08:31:45', '2015-01-31 08:31:45', '2015-01-31 08:31:45'),
(60, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-02 05:32:08', '2015-02-02 05:32:08', '2015-02-02 05:32:08'),
(61, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-02 05:32:09', '2015-02-02 05:32:09', '2015-02-02 05:32:09'),
(62, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-02 05:32:10', '2015-02-02 05:32:10', '2015-02-02 05:32:10'),
(63, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-03 05:32:32', '2015-02-03 05:32:32', '2015-02-03 05:32:32'),
(64, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-03 05:32:46', '2015-02-03 05:32:46', '2015-02-03 05:32:46'),
(65, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-03 05:32:53', '2015-02-03 05:32:53', '2015-02-03 05:32:53'),
(66, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-03 06:32:04', '2015-02-03 06:32:04', '2015-02-03 06:32:04'),
(67, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-03 06:32:30', '2015-02-03 06:32:30', '2015-02-03 06:32:30'),
(68, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-03 09:32:41', '2015-02-03 09:32:41', '2015-02-03 09:32:41'),
(69, 1, '127.0.0.1', 'name:Firefox version:35.0', 'name:Linux version:unknown', '2015-02-03 09:32:11', '2015-02-03 09:32:11', '2015-02-03 09:32:11'),
(70, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-04 04:32:32', '2015-02-04 04:32:32', '2015-02-04 04:32:32'),
(71, 25, '127.0.0.1', 'name:Chrome version:40.0.2214.94', 'name:Linux version:unknown', '2015-02-04 06:32:05', '2015-02-04 06:32:05', '2015-02-04 06:32:05'),
(72, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-07 09:32:37', '2015-02-07 09:32:37', '2015-02-07 09:32:37'),
(73, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-07 09:32:01', '2015-02-07 09:32:01', '2015-02-07 09:32:01'),
(74, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-07 11:32:12', '2015-02-07 11:32:12', '2015-02-07 11:32:12'),
(75, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-07 13:32:54', '2015-02-07 13:32:54', '2015-02-07 13:32:54'),
(76, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-07 19:32:12', '2015-02-07 19:32:12', '2015-02-07 19:32:12'),
(77, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 05:32:14', '2015-02-08 05:32:14', '2015-02-08 05:32:14'),
(78, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 05:32:02', '2015-02-08 05:32:02', '2015-02-08 05:32:02'),
(79, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 08:32:09', '2015-02-08 08:32:09', '2015-02-08 08:32:09'),
(80, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 10:32:00', '2015-02-08 10:32:00', '2015-02-08 10:32:00'),
(81, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 14:32:32', '2015-02-08 14:32:32', '2015-02-08 14:32:32'),
(82, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 14:32:43', '2015-02-08 14:32:43', '2015-02-08 14:32:43'),
(83, 26, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 14:32:34', '2015-02-08 14:32:34', '2015-02-08 14:32:34'),
(84, 27, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 14:32:17', '2015-02-08 14:32:17', '2015-02-08 14:32:17'),
(85, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 14:32:35', '2015-02-08 14:32:35', '2015-02-08 14:32:35'),
(86, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 14:32:49', '2015-02-08 14:32:49', '2015-02-08 14:32:49'),
(87, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 16:32:21', '2015-02-08 16:32:21', '2015-02-08 16:32:21'),
(88, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 16:32:12', '2015-02-08 16:32:12', '2015-02-08 16:32:12'),
(89, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-08 17:32:10', '2015-02-08 17:32:10', '2015-02-08 17:32:10'),
(90, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-09 06:32:02', '2015-02-09 06:32:02', '2015-02-09 06:32:02'),
(91, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-09 06:32:26', '2015-02-09 06:32:26', '2015-02-09 06:32:26'),
(92, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.95', 'name:Linux version:unknown', '2015-02-09 07:32:30', '2015-02-09 07:32:30', '2015-02-09 07:32:30'),
(93, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 09:32:22', '2015-02-10 09:32:22', '2015-02-10 09:32:22'),
(94, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 09:32:12', '2015-02-10 09:32:12', '2015-02-10 09:32:12'),
(95, 28, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 12:32:37', '2015-02-10 12:32:37', '2015-02-10 12:32:37'),
(96, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 12:32:57', '2015-02-10 12:32:57', '2015-02-10 12:32:57'),
(97, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 12:32:44', '2015-02-10 12:32:44', '2015-02-10 12:32:44'),
(98, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 13:32:21', '2015-02-10 13:32:21', '2015-02-10 13:32:21'),
(99, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 13:32:02', '2015-02-10 13:32:02', '2015-02-10 13:32:02'),
(100, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 13:32:33', '2015-02-10 13:32:33', '2015-02-10 13:32:33'),
(101, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-10 13:32:52', '2015-02-10 13:32:52', '2015-02-10 13:32:52'),
(102, 29, '127.0.0.1', 'name:Chrome version:40.0.2214.111', 'name:Linux version:unknown', '2015-02-11 12:32:14', '2015-02-11 12:32:14', '2015-02-11 12:32:14'),
(103, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 08:32:11', '2015-02-21 08:32:11', '2015-02-21 08:32:11'),
(104, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 08:32:46', '2015-02-21 08:32:46', '2015-02-21 08:32:46'),
(105, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 08:32:12', '2015-02-21 08:32:12', '2015-02-21 08:32:12'),
(106, 1, '127.0.0.1', 'name:Firefox version:35.0', 'name:Linux version:unknown', '2015-02-21 08:32:37', '2015-02-21 08:32:37', '2015-02-21 08:32:37'),
(107, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 10:32:34', '2015-02-21 10:32:34', '2015-02-21 10:32:34'),
(108, 29, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 10:32:32', '2015-02-21 10:32:32', '2015-02-21 10:32:32'),
(109, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 11:32:28', '2015-02-21 11:32:28', '2015-02-21 11:32:28'),
(110, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 11:32:02', '2015-02-21 11:32:02', '2015-02-21 11:32:02'),
(111, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 11:32:34', '2015-02-21 11:32:34', '2015-02-21 11:32:34'),
(112, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-21 11:32:24', '2015-02-21 11:32:24', '2015-02-21 11:32:24'),
(113, 30, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 08:32:06', '2015-02-27 08:32:06', '2015-02-27 08:32:06'),
(114, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 11:32:26', '2015-02-27 11:32:26', '2015-02-27 11:32:26'),
(115, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 11:32:27', '2015-02-27 11:32:27', '2015-02-27 11:32:27'),
(116, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 13:32:49', '2015-02-27 13:32:49', '2015-02-27 13:32:49'),
(117, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 13:32:20', '2015-02-27 13:32:20', '2015-02-27 13:32:20'),
(118, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 13:32:09', '2015-02-27 13:32:09', '2015-02-27 13:32:09'),
(119, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 14:32:37', '2015-02-27 14:32:37', '2015-02-27 14:32:37'),
(120, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 15:32:32', '2015-02-27 15:32:32', '2015-02-27 15:32:32'),
(121, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 15:32:01', '2015-02-27 15:32:01', '2015-02-27 15:32:01'),
(122, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-27 17:32:09', '2015-02-27 17:32:09', '2015-02-27 17:32:09'),
(123, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 07:32:05', '2015-02-28 07:32:05', '2015-02-28 07:32:05'),
(124, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 11:32:40', '2015-02-28 11:32:40', '2015-02-28 11:32:40'),
(125, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 15:32:01', '2015-02-28 15:32:01', '2015-02-28 15:32:01'),
(126, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 15:32:14', '2015-02-28 15:32:14', '2015-02-28 15:32:14'),
(127, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 17:32:21', '2015-02-28 17:32:21', '2015-02-28 17:32:21'),
(128, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 17:32:47', '2015-02-28 17:32:47', '2015-02-28 17:32:47'),
(129, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 17:32:32', '2015-02-28 17:32:32', '2015-02-28 17:32:32'),
(130, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 17:32:19', '2015-02-28 17:32:19', '2015-02-28 17:32:19'),
(131, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 17:32:52', '2015-02-28 17:32:52', '2015-02-28 17:32:52'),
(132, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-02-28 17:32:52', '2015-02-28 17:32:52', '2015-02-28 17:32:52'),
(133, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-03-02 16:33:41', '2015-03-02 16:33:41', '2015-03-02 16:33:41'),
(134, 1, '127.0.0.1', 'name:Firefox version:35.0', 'name:Linux version:unknown', '2015-03-02 19:33:19', '2015-03-02 19:33:19', '2015-03-02 19:33:19'),
(135, 1, '127.0.0.1', 'name:Firefox version:35.0', 'name:Linux version:unknown', '2015-03-02 19:33:18', '2015-03-02 19:33:18', '2015-03-02 19:33:18'),
(136, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-03-02 19:33:31', '2015-03-02 19:33:31', '2015-03-02 19:33:31'),
(137, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-03-03 04:33:27', '2015-03-03 04:33:27', '2015-03-03 04:33:27'),
(138, 1, '127.0.0.1', 'name:Firefox version:35.0', 'name:Linux version:unknown', '2015-03-03 04:33:06', '2015-03-03 04:33:06', '2015-03-03 04:33:06'),
(139, 1, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-03-06 06:33:13', '2015-03-06 06:33:13', '2015-03-06 06:33:13'),
(140, 2, '127.0.0.1', 'name:Chrome version:40.0.2214.115', 'name:Linux version:unknown', '2015-03-06 06:33:24', '2015-03-06 06:33:24', '2015-03-06 06:33:24'),
(141, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 11:33:06', '2015-03-24 11:33:06', '2015-03-24 11:33:06'),
(142, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 11:33:12', '2015-03-24 11:33:12', '2015-03-24 11:33:12'),
(143, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 11:33:22', '2015-03-24 11:33:22', '2015-03-24 11:33:22'),
(144, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 11:33:07', '2015-03-24 11:33:07', '2015-03-24 11:33:07'),
(145, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 16:33:29', '2015-03-24 16:33:29', '2015-03-24 16:33:29'),
(146, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 16:33:15', '2015-03-24 16:33:15', '2015-03-24 16:33:15'),
(147, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 18:33:19', '2015-03-24 18:33:19', '2015-03-24 18:33:19'),
(148, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 18:33:39', '2015-03-24 18:33:39', '2015-03-24 18:33:39'),
(149, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 18:33:19', '2015-03-24 18:33:19', '2015-03-24 18:33:19'),
(150, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 19:33:56', '2015-03-24 19:33:56', '2015-03-24 19:33:56'),
(151, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-24 19:33:10', '2015-03-24 19:33:10', '2015-03-24 19:33:10'),
(152, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-03-25 06:33:25', '2015-03-25 06:33:25', '2015-03-25 06:33:25'),
(153, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-25 06:33:36', '2015-03-25 06:33:36', '2015-03-25 06:33:36'),
(154, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-25 06:33:18', '2015-03-25 06:33:18', '2015-03-25 06:33:18'),
(155, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-25 06:33:27', '2015-03-25 06:33:27', '2015-03-25 06:33:27'),
(156, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-25 09:33:29', '2015-03-25 09:33:29', '2015-03-25 09:33:29'),
(157, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-26 08:33:05', '2015-03-26 08:33:05', '2015-03-26 08:33:05'),
(158, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-26 08:33:54', '2015-03-26 08:33:54', '2015-03-26 08:33:54'),
(159, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-26 11:33:27', '2015-03-26 11:33:27', '2015-03-26 11:33:27'),
(160, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-26 13:33:11', '2015-03-26 13:33:11', '2015-03-26 13:33:11'),
(161, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-26 13:33:50', '2015-03-26 13:33:50', '2015-03-26 13:33:50'),
(162, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-27 15:33:43', '2015-03-27 15:33:43', '2015-03-27 15:33:43'),
(163, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-27 15:33:15', '2015-03-27 15:33:15', '2015-03-27 15:33:15'),
(164, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-27 15:33:36', '2015-03-27 15:33:36', '2015-03-27 15:33:36'),
(165, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-27 16:33:12', '2015-03-27 16:33:12', '2015-03-27 16:33:12'),
(166, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-28 12:33:34', '2015-03-28 12:33:34', '2015-03-28 12:33:34'),
(167, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 04:33:19', '2015-03-30 04:33:19', '2015-03-30 04:33:19'),
(168, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 05:33:27', '2015-03-30 05:33:27', '2015-03-30 05:33:27'),
(169, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 05:33:22', '2015-03-30 05:33:22', '2015-03-30 05:33:22'),
(170, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 16:33:39', '2015-03-30 16:33:39', '2015-03-30 16:33:39'),
(171, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 16:33:12', '2015-03-30 16:33:12', '2015-03-30 16:33:12'),
(172, 32, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 16:33:22', '2015-03-30 16:33:22', '2015-03-30 16:33:22'),
(173, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 17:33:01', '2015-03-30 17:33:01', '2015-03-30 17:33:01'),
(174, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 18:33:50', '2015-03-30 18:33:50', '2015-03-30 18:33:50'),
(175, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 18:33:12', '2015-03-30 18:33:12', '2015-03-30 18:33:12'),
(176, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 19:33:52', '2015-03-30 19:33:52', '2015-03-30 19:33:52'),
(177, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 19:33:20', '2015-03-30 19:33:20', '2015-03-30 19:33:20'),
(178, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-03-30 19:33:49', '2015-03-30 19:33:49', '2015-03-30 19:33:49'),
(179, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-01 05:34:38', '2015-04-01 05:34:38', '2015-04-01 05:34:38'),
(180, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-06 08:34:46', '2015-04-06 08:34:46', '2015-04-06 08:34:46'),
(181, 2, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-06 08:34:31', '2015-04-06 08:34:31', '2015-04-06 08:34:31'),
(182, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-08 11:34:26', '2015-04-08 11:34:26', '2015-04-08 11:34:26'),
(183, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-08 15:34:36', '2015-04-08 15:34:36', '2015-04-08 15:34:36'),
(184, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-08 15:34:01', '2015-04-08 15:34:01', '2015-04-08 15:34:01'),
(185, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-08 15:34:27', '2015-04-08 15:34:27', '2015-04-08 15:34:27'),
(186, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-11 05:34:29', '2015-04-11 05:34:29', '2015-04-11 05:34:29'),
(187, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-11 05:34:54', '2015-04-11 05:34:54', '2015-04-11 05:34:54'),
(188, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 10:34:55', '2015-04-13 10:34:55', '2015-04-13 10:34:55'),
(189, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 11:34:25', '2015-04-13 11:34:25', '2015-04-13 11:34:25'),
(190, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 11:34:55', '2015-04-13 11:34:55', '2015-04-13 11:34:55'),
(191, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 12:34:26', '2015-04-13 12:34:26', '2015-04-13 12:34:26'),
(192, 2, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 13:34:19', '2015-04-13 13:34:19', '2015-04-13 13:34:19'),
(193, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 13:34:05', '2015-04-13 13:34:05', '2015-04-13 13:34:05'),
(194, 1, '127.0.0.1', 'name:Firefox version:36.0', 'name:Linux version:unknown', '2015-04-13 13:34:53', '2015-04-13 13:34:53', '2015-04-13 13:34:53'),
(195, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-04-13 13:34:46', '2015-04-13 13:34:46', '2015-04-13 13:34:46'),
(196, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 07:35:05', '2015-05-10 07:35:05', '2015-05-10 07:35:05'),
(197, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 07:35:46', '2015-05-10 07:35:46', '2015-05-10 07:35:46'),
(198, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 07:35:28', '2015-05-10 07:35:28', '2015-05-10 07:35:28'),
(199, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 08:35:09', '2015-05-10 08:35:09', '2015-05-10 08:35:09'),
(200, 2, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 08:35:26', '2015-05-10 08:35:26', '2015-05-10 08:35:26'),
(201, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 08:35:37', '2015-05-10 08:35:37', '2015-05-10 08:35:37'),
(202, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-10 09:35:57', '2015-05-10 09:35:57', '2015-05-10 09:35:57'),
(203, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-18 05:35:16', '2015-05-18 05:35:16', '2015-05-18 05:35:16'),
(204, 1, '127.0.0.1', 'name:Chrome version:41.0.2272.89', 'name:Linux version:unknown', '2015-05-18 05:35:18', '2015-05-18 05:35:18', '2015-05-18 05:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE IF NOT EXISTS `user_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint(20) unsigned NOT NULL,
  `to_user_id` bigint(20) unsigned NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_new` tinyint(4) NOT NULL DEFAULT '1',
  `toastr_notification` tinyint(4) NOT NULL DEFAULT '1',
  `sent_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_messages_id_unique` (`id`),
  KEY `user_messages_from_user_id_foreign` (`from_user_id`),
  KEY `user_messages_to_user_id_foreign` (`to_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=204 ;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `from_user_id`, `to_user_id`, `message`, `is_new`, `toastr_notification`, `sent_time`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, '2015-01-08 23:48:33', '2015-01-08 23:48:33', '2015-01-08 23:48:33'),
(2, 1, 11, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 0, 0, '2015-01-08 01:54:11', '2015-01-08 01:54:11', '2015-01-08 01:54:11'),
(3, 2, 1, 'Hello', 0, 0, '2015-01-11 00:48:33', '2015-01-09 00:48:33', '2015-01-09 00:48:33'),
(4, 2, 1, 'dfgdfdsfdsf', 0, 0, '2015-01-10 05:35:06', '2015-01-09 22:35:06', '2015-01-09 22:35:06'),
(5, 1, 2, 'fdsfdsfdssf', 0, 0, '2015-01-10 01:40:11', '2015-01-10 01:40:11', '2015-01-10 01:40:11'),
(6, 1, 3, 'Deseruisse inciderint nec et. Feugait repudiandae his eu, debet saepe delectus sit te, ad graeci adipisci sadipscing duo. Duo id primis detracto. Viderer assueverit ea pro.', 0, 0, '2015-01-10 23:54:11', '2015-01-10 23:54:11', '2015-01-10 23:54:11'),
(7, 1, 6, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage ', 0, 0, '2015-01-10 02:36:02', '2015-01-10 02:36:02', '2015-01-10 02:36:02'),
(8, 1, 7, 'Decore cetero epicurei sea ex. Usu et porro offendit lucilius. Feugait facilisi constituam ea cum, alienum adipiscing cu per, id duo vitae menandri constituam. Exerci voluptatibus sea eu, persius detracto ut eam, ad sed putant volutpat. An timeam nominavi accommodare sit, postea incorrupte sit ei.', 0, 0, '2015-01-11 22:32:16', '2015-01-11 22:32:16', '2015-01-11 22:32:16'),
(9, 1, 8, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 0, 0, '2015-01-06 23:43:14', '2015-01-06 23:43:14', '2015-01-06 23:43:14'),
(10, 1, 10, 'Lorem ipsum dolor sit amet, quot nihil quidam mel an, in dico cetero dignissim sit. An sea alii eligendi. Dicat omnes nec in. Ea eos quod tempor debitis, integre democritum incorrupte pri ut.', 0, 0, '2015-01-08 00:48:17', '2015-01-08 00:48:17', '2015-01-08 00:48:17'),
(11, 1, 13, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 0, 0, '2015-01-06 23:36:08', '2015-01-06 23:36:08', '2015-01-06 23:36:08'),
(12, 1, 14, 'hgfhgfhgfhgfh', 0, 0, '2015-01-12 00:52:00', '2015-01-12 00:52:00', '2015-03-02 17:33:06'),
(13, 1, 15, 'gdfgfdgfdgfdg', 0, 0, '2015-01-10 21:52:09', '2015-01-10 21:52:09', '2015-01-10 21:52:09'),
(14, 1, 17, 'sdfdsfdsdsfdsfdsfds', 0, 0, '2015-01-11 04:10:00', '2015-01-11 04:10:00', '2015-01-11 04:10:00'),
(15, 1, 18, 'vbcbvcbgfhhf', 0, 0, '2015-01-12 03:34:10', '2015-01-12 03:34:10', '2015-03-02 16:33:12'),
(16, 1, 2, 'fhgfhnvmnhkhk', 0, 0, '2015-01-09 21:33:05', '2015-01-09 21:33:05', '2015-01-09 21:33:05'),
(17, 2, 1, 'hgjhgjhgjhgh', 0, 0, '2015-01-10 00:37:13', '2015-01-10 00:37:13', '2015-01-10 00:37:13'),
(18, 1, 2, 'uytuhjmhjm', 0, 0, '2015-01-10 22:44:08', '2015-01-10 22:44:08', '2015-01-10 22:44:08'),
(19, 2, 1, 'hmjhgjhgjhgjhg', 0, 0, '2015-01-11 05:57:20', '2015-01-11 05:57:20', '2015-01-11 05:57:20'),
(20, 1, 2, 'ghgfhggjhgjgjg', 0, 0, '2015-01-12 00:47:15', '2015-01-12 00:47:15', '2015-01-12 00:47:15'),
(21, 2, 1, 'tryytujygjhg', 0, 0, '2015-01-12 07:58:24', '2015-01-12 07:58:24', '2015-01-12 07:58:24'),
(22, 1, 2, 'dfgfdgfdgdgf', 0, 0, '2015-01-12 00:38:00', '2015-01-12 00:38:00', '2015-01-12 00:38:00'),
(23, 2, 1, 'qweretruytuytu', 0, 0, '2015-01-12 02:30:00', '2015-01-12 02:30:00', '2015-01-12 02:30:00'),
(24, 1, 2, 'dfgfdg', 0, 0, '2015-01-12 01:38:00', '2015-01-12 01:38:00', '2015-01-12 01:38:00'),
(25, 2, 1, 'fdsfdsf', 0, 0, '2015-01-12 03:30:00', '2015-01-12 03:30:00', '2015-01-12 03:30:00'),
(26, 1, 2, 'klhklklkll', 0, 0, '2015-01-13 01:38:00', '2015-01-13 01:38:00', '2015-01-13 01:38:00'),
(27, 2, 1, 'iitirpperptrep', 0, 0, '2015-01-13 03:30:00', '2015-01-12 03:30:00', '2015-01-12 03:30:00'),
(28, 1, 2, 'lksfdsklflds', 0, 0, '2015-01-13 02:38:00', '2015-01-13 02:38:00', '2015-01-13 02:38:00'),
(29, 2, 1, 'flksdjfljdslf', 0, 0, '2015-01-13 04:30:00', '2015-01-12 04:30:00', '2015-01-12 04:30:00'),
(30, 1, 14, 'yyyyy', 0, 0, '2015-01-14 11:31:37', '2015-01-14 11:31:37', '2015-03-02 17:33:06'),
(31, 1, 14, 'ffff', 0, 0, '2015-01-14 11:31:10', '2015-01-14 11:31:10', '2015-03-02 17:33:06'),
(32, 1, 18, 'hello', 0, 0, '2015-01-14 11:31:56', '2015-01-14 11:31:56', '2015-03-02 16:33:11'),
(33, 1, 18, 'xxxx', 0, 0, '2015-01-14 11:31:35', '2015-01-14 11:31:35', '2015-03-02 16:33:12'),
(34, 1, 18, 'ffff', 0, 0, '2015-01-14 11:31:22', '2015-01-14 11:31:22', '2015-03-02 16:33:12'),
(35, 1, 18, 'hello', 0, 0, '2015-01-14 11:31:43', '2015-01-14 11:31:43', '2015-03-02 16:33:11'),
(36, 1, 3, 'ggggg', 0, 0, '2015-01-14 11:31:58', '2015-01-14 11:31:58', '2015-01-14 11:31:58'),
(37, 1, 17, 'hello', 0, 0, '2015-01-14 11:31:27', '2015-01-14 11:31:27', '2015-01-14 11:31:27'),
(38, 1, 3, 'hell', 0, 0, '2015-01-14 11:31:54', '2015-01-14 11:31:54', '2015-01-14 11:31:54'),
(39, 1, 6, 'kkk', 0, 0, '2015-01-14 12:31:49', '2015-01-14 12:31:49', '2015-01-14 12:31:49'),
(40, 1, 6, 'fffff', 0, 0, '2015-01-14 12:31:55', '2015-01-14 12:31:55', '2015-01-14 12:31:55'),
(41, 1, 10, 'hell', 0, 0, '2015-01-14 12:31:07', '2015-01-14 12:31:08', '2015-01-14 12:31:08'),
(42, 1, 7, 'hell', 0, 0, '2015-01-14 12:31:41', '2015-01-14 12:31:41', '2015-01-14 12:31:41'),
(43, 1, 8, 'hellppppp', 0, 0, '2015-01-14 12:31:18', '2015-01-14 12:31:18', '2015-01-14 12:31:18'),
(44, 1, 8, 'jjjj', 0, 0, '2015-01-14 12:31:55', '2015-01-14 12:31:55', '2015-01-14 12:31:55'),
(45, 1, 8, 'sdjfklsdflkdsf', 0, 0, '2015-01-14 12:31:02', '2015-01-14 12:31:02', '2015-01-14 12:31:02'),
(46, 1, 14, 'hhhh', 0, 0, '2015-01-14 12:31:43', '2015-01-14 12:31:43', '2015-03-02 17:33:06'),
(47, 1, 7, 'gggg', 0, 0, '2015-01-14 12:31:11', '2015-01-14 12:31:11', '2015-01-14 12:31:11'),
(48, 1, 13, 'hell no!!!!!', 0, 0, '2015-01-14 12:31:23', '2015-01-14 12:31:23', '2015-01-14 12:31:23'),
(49, 1, 15, 'sagar', 0, 0, '2015-01-14 12:31:35', '2015-01-14 12:31:35', '2015-01-14 12:31:35'),
(50, 1, 15, 'wat bout u?', 0, 0, '2015-01-14 12:31:48', '2015-01-14 12:31:48', '2015-01-14 12:31:48'),
(51, 1, 2, 'hello', 0, 0, '2015-01-14 12:31:39', '2015-01-14 12:31:39', '2015-01-14 12:31:39'),
(52, 1, 15, 'sagar', 0, 0, '2015-01-14 12:31:00', '2015-01-14 12:31:00', '2015-01-14 12:31:00'),
(53, 1, 13, 'oooo', 0, 0, '2015-01-14 12:31:34', '2015-01-14 12:31:34', '2015-01-14 12:31:34'),
(54, 1, 15, 'jjjjj', 0, 0, '2015-01-14 12:31:53', '2015-01-14 12:31:53', '2015-01-14 12:31:53'),
(55, 1, 18, 'dfds', 0, 0, '2015-01-14 12:31:38', '2015-01-14 12:31:38', '2015-03-02 16:33:24'),
(56, 1, 18, 'g', 0, 0, '2015-01-14 12:31:37', '2015-01-14 12:31:37', '2015-03-02 16:33:11'),
(57, 1, 2, 'Hell no!', 0, 0, '2015-01-14 13:31:04', '2015-01-14 13:31:04', '2015-01-14 13:31:04'),
(58, 1, 2, 'I''m sagar', 0, 0, '2015-01-14 13:31:18', '2015-01-14 13:31:18', '2015-01-14 13:31:18'),
(59, 1, 18, 'dfdsf dsfd sdfgre', 0, 0, '2015-01-14 13:31:11', '2015-01-14 13:31:11', '2015-03-02 16:33:24'),
(60, 1, 15, 'hello', 0, 0, '2015-01-14 13:31:01', '2015-01-14 13:31:01', '2015-01-14 13:31:01'),
(61, 1, 8, 'i''m sagar', 0, 0, '2015-01-14 13:31:29', '2015-01-14 13:31:29', '2015-01-14 13:31:29'),
(62, 1, 2, 'welcome', 0, 0, '2015-01-14 13:31:41', '2015-01-14 13:31:41', '2015-01-14 13:31:41'),
(63, 2, 1, 'hello', 0, 1, '2015-01-17 06:31:23', '2015-01-17 06:31:23', '2015-03-02 19:33:31'),
(64, 2, 1, 'hi', 0, 1, '2015-01-17 07:31:10', '2015-01-17 07:31:10', '2015-03-02 19:33:31'),
(65, 1, 2, 'welcome', 0, 1, '2015-01-17 07:31:47', '2015-01-17 07:31:47', '2015-03-02 19:33:31'),
(66, 1, 2, 'gfdhgf\nfhgfhgf', 0, 0, '2015-01-17 07:31:42', '2015-01-17 07:31:42', '2015-01-17 07:31:42'),
(67, 2, 1, 'dfdsfsdfd fsdf dfs', 0, 0, '2015-01-20 05:31:17', '2015-01-20 05:31:17', '2015-01-20 05:31:17'),
(68, 2, 1, 'hello how are you!!', 0, 0, '2015-01-23 11:31:49', '2015-01-23 11:31:49', '2015-01-23 11:31:49'),
(69, 2, 1, 'hey', 0, 0, '2015-01-29 08:31:51', '2015-01-29 08:31:51', '2015-01-29 08:31:51'),
(70, 1, 18, 'hey', 0, 0, '2015-02-03 09:32:33', '2015-02-03 09:32:33', '2015-03-02 16:33:24'),
(71, 1, 18, 'dfhhhhhdhghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 0, 0, '2015-02-21 09:32:45', '2015-02-21 09:32:45', '2015-03-02 16:33:23'),
(72, 1, 18, 'ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum', 0, 0, '2015-02-21 09:32:31', '2015-02-21 09:32:31', '2015-03-02 16:33:23'),
(73, 1, 18, 'asssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 0, 1, '2015-02-21 09:32:53', '2015-02-21 09:32:53', '2015-03-02 19:33:16'),
(74, 1, 18, 'a a aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0, 0, '2015-02-21 09:32:51', '2015-02-21 09:32:51', '2015-03-02 16:33:23'),
(75, 1, 18, 'Lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum loremaaaaaaa', 0, 0, '2015-02-21 09:32:19', '2015-02-21 09:32:19', '2015-03-02 16:33:24'),
(76, 1, 2, 'hey', 0, 1, '2015-03-02 19:33:51', '2015-03-02 19:33:51', '2015-03-02 19:33:52'),
(77, 2, 1, 'hello', 0, 0, '2015-03-02 19:33:09', '2015-03-02 19:33:09', '2015-03-02 19:33:47'),
(78, 1, 2, 'lol', 0, 0, '2015-03-02 19:33:53', '2015-03-02 19:33:53', '2015-03-02 20:33:20'),
(79, 1, 2, 'lol', 0, 0, '2015-03-02 19:33:12', '2015-03-02 19:33:12', '2015-03-02 20:33:21'),
(80, 1, 2, 'd', 0, 0, '2015-03-02 19:33:36', '2015-03-02 19:33:36', '2015-03-02 20:33:20'),
(81, 1, 2, 'e', 0, 0, '2015-03-02 19:33:57', '2015-03-02 19:33:57', '2015-03-02 20:33:20'),
(82, 1, 2, 'e', 0, 0, '2015-03-02 19:33:21', '2015-03-02 19:33:21', '2015-03-02 20:33:20'),
(83, 1, 2, 'hey', 0, 0, '2015-03-02 20:33:39', '2015-03-02 20:33:39', '2015-03-02 20:33:58'),
(84, 1, 2, 'lol', 0, 0, '2015-03-02 20:33:11', '2015-03-02 20:33:11', '2015-03-02 20:33:45'),
(85, 1, 2, 'lol', 0, 0, '2015-03-02 20:33:24', '2015-03-02 20:33:24', '2015-03-02 20:33:44'),
(86, 1, 2, 'll', 0, 0, '2015-03-02 20:33:51', '2015-03-02 20:33:51', '2015-03-02 20:33:44'),
(87, 1, 2, 'l', 0, 0, '2015-03-02 20:33:16', '2015-03-02 20:33:16', '2015-03-02 20:33:44'),
(88, 1, 2, 'llt', 0, 0, '2015-03-02 20:33:25', '2015-03-02 20:33:25', '2015-03-02 20:33:44'),
(89, 2, 1, 'll', 0, 0, '2015-03-02 20:33:49', '2015-03-02 20:33:49', '2015-03-03 04:33:22'),
(90, 1, 2, 'hey', 0, 0, '2015-03-03 04:33:26', '2015-03-03 04:33:26', '2015-03-03 05:33:18'),
(91, 1, 2, 'hey', 0, 0, '2015-03-03 04:33:05', '2015-03-03 04:33:05', '2015-03-03 05:33:18'),
(92, 1, 2, 'f\nh\nj\nh', 0, 0, '2015-03-03 04:33:27', '2015-03-03 04:33:27', '2015-03-03 05:33:18'),
(93, 1, 2, 'fdgd', 0, 0, '2015-03-03 04:33:43', '2015-03-03 04:33:43', '2015-03-03 05:33:18'),
(94, 1, 2, 'fdgd', 0, 0, '2015-03-03 04:33:46', '2015-03-03 04:33:46', '2015-03-03 05:33:17'),
(95, 1, 2, 'hey', 0, 0, '2015-03-03 05:33:12', '2015-03-03 05:33:12', '2015-03-03 05:33:22'),
(96, 2, 1, 'hey hello', 0, 0, '2015-03-03 05:33:29', '2015-03-03 05:33:29', '2015-03-03 05:33:41'),
(97, 2, 1, 'hello', 0, 0, '2015-03-24 16:33:51', '2015-03-24 16:33:51', '2015-03-24 18:33:25'),
(98, 1, 18, 'hello', 0, 1, '2015-03-24 16:33:50', '2015-03-24 16:33:50', '2015-03-24 16:33:04'),
(99, 1, 7, 'hi', 0, 1, '2015-03-24 16:33:10', '2015-03-24 16:33:10', '2015-03-24 18:33:11'),
(100, 1, 18, 'hi', 0, 1, '2015-03-24 16:33:01', '2015-03-24 16:33:01', '2015-03-24 16:33:38'),
(101, 1, 17, 'hello', 0, 1, '2015-03-24 17:33:29', '2015-03-24 17:33:29', '2015-03-24 18:33:08'),
(102, 1, 18, 'h', 0, 1, '2015-03-24 17:33:20', '2015-03-24 17:33:20', '2015-03-24 17:33:47'),
(103, 1, 14, 'hello', 0, 1, '2015-03-24 17:33:31', '2015-03-24 17:33:31', '2015-03-24 18:33:41'),
(104, 1, 14, 'How r u?', 0, 1, '2015-03-24 17:33:27', '2015-03-24 17:33:27', '2015-03-24 18:33:41'),
(105, 1, 18, 'bharat makwana', 0, 1, '2015-03-24 17:33:13', '2015-03-24 17:33:13', '2015-03-24 18:33:02'),
(106, 1, 14, 'hello hella bella', 0, 1, '2015-03-24 18:33:51', '2015-03-24 18:33:51', '2015-03-24 18:33:09'),
(107, 1, 14, 'hi', 0, 1, '2015-03-24 18:33:19', '2015-03-24 18:33:19', '2015-03-24 18:33:09'),
(108, 1, 18, 'bharat mak', 0, 1, '2015-03-24 18:33:17', '2015-03-24 18:33:17', '2015-03-24 18:33:00'),
(109, 1, 18, 'hi\nhello', 0, 1, '2015-03-24 18:33:39', '2015-03-24 18:33:39', '2015-03-24 18:33:00'),
(110, 1, 7, 'hello', 0, 1, '2015-03-24 18:33:17', '2015-03-24 18:33:17', '2015-03-24 18:33:39'),
(111, 1, 7, 'hi', 0, 1, '2015-03-24 18:33:21', '2015-03-24 18:33:21', '2015-03-24 18:33:39'),
(112, 1, 7, 'how are you?', 0, 1, '2015-03-24 18:33:32', '2015-03-24 18:33:32', '2015-03-24 18:33:39'),
(113, 1, 11, 'I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount of text', 1, 1, '2015-03-24 18:33:20', '2015-03-24 18:33:20', '2015-03-24 18:33:20'),
(114, 1, 11, 'I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount of text', 1, 1, '2015-03-24 18:33:23', '2015-03-24 18:33:23', '2015-03-24 18:33:23'),
(115, 1, 11, 'I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount of text', 1, 1, '2015-03-24 18:33:25', '2015-03-24 18:33:25', '2015-03-24 18:33:25'),
(116, 1, 11, 'I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount of text', 1, 1, '2015-03-24 18:33:31', '2015-03-24 18:33:31', '2015-03-24 18:33:31'),
(117, 1, 11, 'I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount of text', 1, 1, '2015-03-24 18:33:33', '2015-03-24 18:33:33', '2015-03-24 18:33:33'),
(118, 1, 11, 'I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount of text', 1, 1, '2015-03-24 18:33:36', '2015-03-24 18:33:36', '2015-03-24 18:33:36'),
(119, 1, 11, 'hi', 1, 1, '2015-03-24 18:33:42', '2015-03-24 18:33:42', '2015-03-24 18:33:42'),
(120, 1, 11, 'gr', 1, 1, '2015-03-24 18:33:03', '2015-03-24 18:33:03', '2015-03-24 18:33:03'),
(121, 1, 11, 'afsdfzh I have a textarea that is being dynamically reloaded as user input is being sent in. It refreshes itself every couple seconds. When the amount', 1, 1, '2015-03-24 18:33:07', '2015-03-24 18:33:07', '2015-03-24 18:33:07'),
(122, 1, 11, '34', 1, 1, '2015-03-24 18:33:13', '2015-03-24 18:33:13', '2015-03-24 18:33:13'),
(123, 1, 11, 'dvvvvvvvvvvvvvvvv', 1, 1, '2015-03-24 18:33:19', '2015-03-24 18:33:19', '2015-03-24 18:33:19'),
(124, 1, 11, 'asfrshzrt', 1, 1, '2015-03-24 18:33:24', '2015-03-24 18:33:24', '2015-03-24 18:33:24'),
(125, 1, 11, 'hrtjtdcm', 1, 1, '2015-03-24 18:33:31', '2015-03-24 18:33:31', '2015-03-24 18:33:31'),
(126, 1, 11, 'hu\n,nbackjSB\nZNcbSC\n'',nCAM CKA', 1, 1, '2015-03-24 18:33:39', '2015-03-24 18:33:39', '2015-03-24 18:33:39'),
(127, 1, 14, 'hella bella', 0, 1, '2015-03-24 18:33:37', '2015-03-24 18:33:37', '2015-03-24 18:33:09'),
(128, 1, 14, 'hey sandeep hw r u?', 0, 1, '2015-03-24 18:33:51', '2015-03-24 18:33:51', '2015-03-24 18:33:09'),
(129, 1, 14, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 0, 1, '2015-03-24 18:33:16', '2015-03-24 18:33:16', '2015-03-24 18:33:09'),
(130, 1, 17, 'Hey', 0, 1, '2015-03-24 18:33:13', '2015-03-24 18:33:13', '2015-03-24 18:33:36'),
(131, 1, 17, 'how r u', 0, 1, '2015-03-24 18:33:40', '2015-03-24 18:33:40', '2015-03-24 18:33:25'),
(132, 1, 17, 'sgdh', 0, 1, '2015-03-24 18:33:43', '2015-03-24 18:33:43', '2015-03-24 18:33:25'),
(133, 1, 17, 'Helo', 0, 1, '2015-03-24 18:33:50', '2015-03-24 18:33:50', '2015-03-24 18:33:25'),
(134, 1, 17, 'FDWg', 0, 1, '2015-03-24 18:33:28', '2015-03-24 18:33:28', '2015-03-24 18:33:06'),
(135, 1, 17, 'afwgr', 0, 1, '2015-03-24 18:33:31', '2015-03-24 18:33:31', '2015-03-24 18:33:06'),
(136, 1, 17, 'array', 0, 1, '2015-03-24 18:33:34', '2015-03-24 18:33:34', '2015-03-24 18:33:06'),
(137, 1, 17, 'fffffffffffff', 1, 1, '2015-03-24 18:33:13', '2015-03-24 18:33:13', '2015-03-24 18:33:13'),
(138, 1, 17, 'dddddd', 0, 1, '2015-03-24 18:33:18', '2015-03-24 18:33:18', '2015-03-24 18:33:32'),
(139, 1, 14, 'hella', 0, 1, '2015-03-24 18:33:16', '2015-03-24 18:33:16', '2015-03-24 18:33:08'),
(140, 1, 18, 'heya', 0, 1, '2015-03-24 18:33:06', '2015-03-24 18:33:06', '2015-03-24 18:33:07'),
(141, 1, 18, 'hella', 0, 1, '2015-03-24 18:33:14', '2015-03-24 18:33:14', '2015-03-24 18:33:41'),
(142, 1, 7, 'heya', 0, 1, '2015-03-24 18:33:43', '2015-03-24 18:33:43', '2015-03-24 18:33:48'),
(143, 1, 6, 'ffffffffffff', 0, 1, '2015-03-24 18:33:34', '2015-03-24 18:33:34', '2015-03-30 05:33:59'),
(144, 1, 18, 'haya', 0, 1, '2015-03-24 18:33:46', '2015-03-24 18:33:46', '2015-03-24 18:33:20'),
(145, 1, 18, 'home', 0, 1, '2015-03-24 18:33:35', '2015-03-24 18:33:35', '2015-03-24 18:33:39'),
(146, 1, 18, 'fdsbdfg', 0, 1, '2015-03-24 18:33:31', '2015-03-24 18:33:31', '2015-03-24 18:33:43'),
(147, 1, 18, 'roza', 0, 1, '2015-03-24 18:33:53', '2015-03-24 18:33:53', '2015-03-24 18:33:17'),
(148, 2, 1, 'hello sagar', 0, 1, '2015-03-24 18:33:35', '2015-03-24 18:33:35', '2015-03-24 18:33:38'),
(149, 2, 1, 'how r u?', 0, 1, '2015-03-24 18:33:46', '2015-03-24 18:33:46', '2015-03-24 18:33:54'),
(150, 2, 1, 'hella bella', 0, 1, '2015-03-24 18:33:10', '2015-03-24 18:33:10', '2015-03-24 18:33:53'),
(151, 1, 3, 'Hella Bella', 0, 1, '2015-03-24 18:33:33', '2015-03-24 18:33:33', '2015-03-30 18:33:43'),
(152, 1, 18, 'hi', 0, 1, '2015-03-25 06:33:38', '2015-03-25 06:33:38', '2015-03-27 16:33:40'),
(153, 2, 1, 'hella', 0, 0, '2015-03-25 06:33:41', '2015-03-25 06:33:41', '2015-03-30 05:33:16'),
(154, 1, 18, 'Why this kolaveri di', 0, 1, '2015-03-27 16:33:55', '2015-03-27 16:33:55', '2015-03-27 16:33:50'),
(155, 1, 18, 'hello', 0, 1, '2015-03-27 16:33:57', '2015-03-27 16:33:57', '2015-03-30 05:33:23'),
(156, 1, 18, 'hello', 0, 1, '2015-03-30 05:33:28', '2015-03-30 05:33:28', '2015-03-30 05:33:53'),
(157, 1, 6, 'hi', 1, 1, '2015-03-30 05:33:04', '2015-03-30 05:33:04', '2015-03-30 05:33:04'),
(158, 2, 1, 'Hella', 0, 0, '2015-03-30 05:33:20', '2015-03-30 05:33:20', '2015-03-30 18:33:07'),
(159, 1, 14, 'hellwa', 0, 1, '2015-03-30 16:33:05', '2015-03-30 16:33:05', '2015-04-01 05:34:59'),
(160, 1, 15, 'Song', 0, 1, '2015-03-30 17:33:23', '2015-03-30 17:33:23', '2015-04-01 06:34:22'),
(161, 1, 2, 'Hi', 0, 0, '2015-03-30 18:33:14', '2015-03-30 18:33:14', '2015-04-08 15:34:48'),
(162, 1, 2, 'Hello', 0, 0, '2015-03-30 18:33:23', '2015-03-30 18:33:23', '2015-04-08 15:34:48'),
(163, 1, 3, 'hella', 1, 1, '2015-03-30 18:33:46', '2015-03-30 18:33:46', '2015-03-30 18:33:46'),
(164, 1, 3, 'bella', 1, 1, '2015-03-30 18:33:56', '2015-03-30 18:33:56', '2015-03-30 18:33:56'),
(165, 1, 18, 'hello', 0, 1, '2015-04-01 05:34:28', '2015-04-01 05:34:28', '2015-04-01 05:34:24'),
(166, 1, 18, 'hi', 0, 1, '2015-04-01 05:34:51', '2015-04-01 05:34:51', '2015-04-01 05:34:24'),
(167, 1, 14, 'hella', 0, 1, '2015-04-01 05:34:05', '2015-04-01 05:34:05', '2015-04-01 05:34:01'),
(168, 1, 14, 'hi', 0, 1, '2015-04-01 05:34:11', '2015-04-01 05:34:11', '2015-04-01 05:34:01'),
(169, 1, 18, 'Hello', 0, 1, '2015-04-01 05:34:30', '2015-04-01 05:34:30', '2015-04-01 05:34:40'),
(170, 1, 18, 'hela', 0, 1, '2015-04-01 05:34:52', '2015-04-01 05:34:52', '2015-04-01 05:34:02'),
(171, 1, 18, 'hello', 0, 1, '2015-04-01 06:34:02', '2015-04-01 06:34:02', '2015-04-01 06:34:33'),
(172, 1, 18, 'ggggggggggg', 0, 1, '2015-04-01 06:34:35', '2015-04-01 06:34:35', '2015-04-01 06:34:33'),
(173, 1, 18, '111111111', 0, 1, '2015-04-01 06:34:38', '2015-04-01 06:34:38', '2015-04-01 06:34:43'),
(174, 1, 18, 'qqqqqqqqqqq', 0, 1, '2015-04-01 06:34:23', '2015-04-01 06:34:23', '2015-04-01 06:34:43'),
(175, 1, 18, 'aaa', 0, 1, '2015-04-01 06:34:45', '2015-04-01 06:34:45', '2015-04-01 06:34:02'),
(176, 1, 18, '1234', 0, 1, '2015-04-01 06:34:49', '2015-04-01 06:34:49', '2015-04-01 06:34:02'),
(177, 1, 18, 'Hello World', 0, 1, '2015-04-01 06:34:07', '2015-04-01 06:34:07', '2015-04-01 06:34:02'),
(178, 1, 18, 'Hello World', 0, 1, '2015-04-01 06:34:50', '2015-04-01 06:34:50', '2015-04-01 06:34:02'),
(179, 1, 18, 'Bharat Makwana', 0, 1, '2015-04-01 06:34:13', '2015-04-01 06:34:13', '2015-04-01 06:34:18'),
(180, 1, 10, 'hello', 1, 1, '2015-04-01 06:34:15', '2015-04-01 06:34:15', '2015-04-01 06:34:15'),
(181, 1, 10, 'marvel', 1, 1, '2015-04-01 06:34:20', '2015-04-01 06:34:20', '2015-04-01 06:34:20'),
(182, 1, 10, 'masti', 1, 1, '2015-04-01 06:34:15', '2015-04-01 06:34:15', '2015-04-01 06:34:15'),
(183, 1, 10, 'to bahot hai', 1, 1, '2015-04-01 06:34:21', '2015-04-01 06:34:21', '2015-04-01 06:34:21'),
(184, 1, 10, 'hella bella', 1, 1, '2015-04-01 07:34:57', '2015-04-01 07:34:57', '2015-04-01 07:34:57'),
(185, 2, 1, 'Hella Bella', 0, 1, '2015-04-13 13:34:45', '2015-04-13 13:34:45', '2015-04-13 13:34:03'),
(186, 2, 1, 'hi', 0, 1, '2015-04-13 13:34:55', '2015-04-13 13:34:55', '2015-04-13 13:34:02'),
(187, 2, 1, 'gggggggggggg', 0, 1, '2015-04-13 13:34:06', '2015-04-13 13:34:06', '2015-04-13 13:34:26'),
(188, 2, 1, 'hhhhhhhhh', 0, 1, '2015-04-13 13:34:10', '2015-04-13 13:34:10', '2015-04-13 13:34:26'),
(189, 2, 1, '1234', 0, 1, '2015-04-13 13:34:14', '2015-04-13 13:34:14', '2015-04-13 13:34:26'),
(190, 1, 18, 'hella bella', 0, 1, '2015-04-13 13:34:26', '2015-04-13 13:34:26', '2015-04-13 13:34:58'),
(191, 1, 7, 'gggggggggg', 0, 1, '2015-04-13 13:34:34', '2015-04-13 13:34:34', '2015-04-13 13:34:06'),
(192, 1, 7, 'hhhhhhhhhhhh', 0, 1, '2015-04-13 13:34:37', '2015-04-13 13:34:37', '2015-04-13 13:34:06'),
(193, 1, 7, 'eer', 0, 1, '2015-04-13 13:34:41', '2015-04-13 13:34:41', '2015-04-13 13:34:06'),
(194, 1, 14, 'dddddddddddddddddddddd', 1, 1, '2015-04-13 13:34:55', '2015-04-13 13:34:55', '2015-04-13 13:34:55'),
(195, 1, 18, 'd', 1, 1, '2015-04-13 13:34:00', '2015-04-13 13:34:00', '2015-04-13 13:34:00'),
(196, 1, 7, 'dddddddd', 1, 1, '2015-04-13 13:34:09', '2015-04-13 13:34:09', '2015-04-13 13:34:09'),
(197, 1, 7, 'qqqqqqqqqqqq', 1, 1, '2015-04-13 13:34:12', '2015-04-13 13:34:12', '2015-04-13 13:34:12'),
(198, 1, 7, '123', 1, 1, '2015-04-13 13:34:16', '2015-04-13 13:34:16', '2015-04-13 13:34:16'),
(199, 1, 7, 'sssss', 1, 1, '2015-04-13 13:34:22', '2015-04-13 13:34:22', '2015-04-13 13:34:22'),
(200, 2, 1, 'ffffffffffffff', 0, 1, '2015-04-13 13:34:54', '2015-04-13 13:34:54', '2015-04-13 13:34:01'),
(201, 2, 1, 'cccccccccc', 0, 1, '2015-04-13 13:34:58', '2015-04-13 13:34:58', '2015-04-13 13:34:01'),
(202, 2, 1, '1234', 0, 0, '2015-04-13 13:34:05', '2015-04-13 13:34:05', '2015-05-10 08:35:49'),
(203, 1, 18, 'Hello World', 1, 1, '2015-05-18 05:35:22', '2015-05-18 05:35:22', '2015-05-18 05:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_role_id_unique` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'CUSTOMER', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'SERVICE PROVIDER', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(3, 'ADMIN', '2015-01-30 21:09:00', '2015-01-30 21:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `week_day_master`
--

CREATE TABLE IF NOT EXISTS `week_day_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `week_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `week_day_master`
--

INSERT INTO `week_day_master` (`id`, `week_day`, `created_at`, `updated_at`) VALUES
(1, 'MONDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(2, 'TUESDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(3, 'WEDNESDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(4, 'THURSDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(5, 'FRIDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(6, 'SATURDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05'),
(7, 'SUNDAY', '2014-12-29 18:14:05', '2014-12-29 18:14:05');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_additional_photos`
--
ALTER TABLE `customer_additional_photos`
  ADD CONSTRAINT `customer_additional_photos_system_user_id_foreign` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_feedbacks`
--
ALTER TABLE `customer_feedbacks`
  ADD CONSTRAINT `customer_feedbacks_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `system_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_feedbacks_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `system_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_provider_availabilities`
--
ALTER TABLE `service_provider_availabilities`
  ADD CONSTRAINT `service_provider_availabilities_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_provider_languages`
--
ALTER TABLE `service_provider_languages`
  ADD CONSTRAINT `service_provider_languages_known_languages_id_foreign` FOREIGN KEY (`known_languages_id`) REFERENCES `known_languages_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_provider_languages_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `system_users`
--
ALTER TABLE `system_users`
  ADD CONSTRAINT `system_users_user_role_id_foreign` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `system_user_ip_logs`
--
ALTER TABLE `system_user_ip_logs`
  ADD CONSTRAINT `system_user_ip_logs_system_user_id_foreign` FOREIGN KEY (`system_user_id`) REFERENCES `system_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD CONSTRAINT `user_messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `system_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `system_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
