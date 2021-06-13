-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 08:24 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_quiz_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$kSrb48RfpSvq5aRMhaHP3uWGngDRPMmq8mKzqrBhYT5lgz0dx4pge', 'XMVQeF4uCbya5bsXQZRx3xDuPubg3Re5frZj3dKnRbaQB16saQtboLxPrJkd', '2021-05-06 13:44:29', '2021-05-06 13:44:29', NULL),
(2, 'ITAdmin', 'it@admin.com', '$2y$10$QznToYUY/phjPPSM9Fsn0.PzIrEwbPKj0RbbmG3.HiIu55npcbNJS', NULL, '2021-05-06 13:48:57', '2021-05-06 13:48:57', NULL),
(3, 'Ram Thapa', 'ram@admin.com', '$2y$10$fRNP/G0G7oKy8nnps6Q64e.x5D1RwEQqOEcKVgEzzqyFjLgbay8k.', 'wilfO6bZO1uGo4gZv1gPNJMi2rbnkf8iBwjySUrAMKWi0ZmcS5vLxuBOQMlX', '2021-05-06 13:54:59', '2021-05-06 13:57:21', NULL),
(4, 'Sam Karki', 'sam@admin.com', '$2y$10$/5g0vAzGHCxI9SzQ0WA16enEof1V1pMROa5mQ0mU/5XJnbh.Wi9sS', NULL, '2021-05-06 15:04:23', '2021-05-06 15:08:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins_groups`
--

CREATE TABLE `admins_groups` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins_permissions`
--

CREATE TABLE `admins_permissions` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins_roles`
--

CREATE TABLE `admins_roles` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins_roles`
--

INSERT INTO `admins_roles` (`admin_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `total_marks` double(8,2) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attempt_answers`
--

CREATE TABLE `attempt_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_id` int(10) UNSIGNED DEFAULT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `marks` double(8,2) NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attempt_options`
--

CREATE TABLE `attempt_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_answer_id` int(10) UNSIGNED DEFAULT NULL,
  `option_id` int(10) UNSIGNED DEFAULT NULL,
  `answer_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Science', NULL, '2021-05-06 14:06:17', '2021-05-06 14:06:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `grade_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `grade_id`, `title`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Fundamentals of Science', 'fundamentals-of-science', NULL, '2021-05-06 14:08:41', '2021-05-06 14:08:41', NULL),
(2, 1, 1, 'Fundamentals of Science', 'fundamentals-of-science', NULL, '2021-05-06 15:25:16', '2021-05-06 15:26:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

CREATE TABLE `course_user` (
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`course_id`, `admin_id`) VALUES
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ten', NULL, '2021-05-06 14:06:34', '2021-05-06 14:06:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `slug`, `short_text`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Measurement', 'measurement', NULL, 1, '2021-05-06 14:09:18', '2021-05-06 14:09:18', NULL),
(2, 2, 'Force', 'force', NULL, 1, '2021-05-06 15:29:42', '2021-05-06 15:29:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_student`
--

CREATE TABLE `lesson_student` (
  `lesson_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Course', 1, 'thumbnail', '6093d1bb69c7b_logo_final-01-300x300', '6093d1bb69c7b_logo_final-01-300x300.png', 'image/png', 'public', 15421, '[]', '[]', '[]', 1, '2021-05-06 14:08:42', '2021-05-06 14:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_14_075105_create_admins_table', 1),
(4, '2020_03_15_091331_create_permissions_table', 1),
(5, '2020_03_15_091626_create_roles_table', 1),
(6, '2020_03_15_091858_create_admins_permissions_table', 1),
(7, '2020_03_15_092055_create_admins_roles_table', 1),
(8, '2020_03_15_092224_create_roles_permissions_table', 1),
(9, '2020_04_01_110918_create_group_table', 1),
(10, '2020_04_01_111646_create_admins_groups_table', 1),
(11, '2020_06_23_000004_create_categories_table', 1),
(12, '2020_06_23_000004_create_grades_table', 1),
(13, '2020_06_23_075903_create_courses_table', 1),
(14, '2020_06_23_080223_create_lessons_table', 1),
(15, '2020_06_23_094406_create_course_user_table', 1),
(16, '2020_06_23_094654_create_course_student_table', 1),
(17, '2020_06_23_094846_create_lesson_student_table', 1),
(18, '2020_06_28_065722_create_media_table', 1),
(19, '2020_07_05_091515_create_quiz_table', 1),
(20, '2020_07_06_083106_create_questions_table', 1),
(21, '2020_07_06_091959_create_question_quiz_table', 1),
(22, '2020_07_06_111436_create_options_table', 1),
(23, '2020_07_06_122631_create_quiz_user_table', 1),
(24, '2020_07_06_122712_create_quiz_student_table', 1),
(25, '2020_08_30_050807_add_columns_to_quiz_table', 1),
(26, '2020_10_05_213728_add_columns_to_users_table', 1),
(27, '2020_10_11_142357_create_attempts_table', 1),
(28, '2020_10_11_142513_create_attempt_answers_table', 1),
(29, '2020_10_11_142529_create_attempt_options_table', 1),
(30, '2020_12_14_182817_add_columns_to_quiz_tables', 1),
(31, '2021_03_02_164554_add_columns_to_quiz_tale', 1),
(32, '2021_05_05_201517_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('02b811b9-9e45-45bc-be5e-1b0898731d23', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('033fdf23-d25d-4a04-8b80-c5c266b8274a', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('0a902f06-d0d4-4419-abd7-373c0c55917c', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('1e425a46-7ab1-4eb7-b83e-191b7fdb721a', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('29b381ee-62ca-443d-a191-aa708d84c6af', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('33706b46-072c-4e5b-be13-6222a2ad99d4', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:19:35', '2021-05-10 16:19:24', '2021-05-10 16:19:35'),
('45bf0a33-a98a-4a50-8a88-caa2eee5d1d6', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('51b2585e-2cd6-4c44-9a88-0f299ab7166e', 'App\\Notifications\\QuizNotification', 'App\\User', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('51ede86d-7c63-4658-a176-79b3d741f21a', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('543f5fb1-cefe-4e4b-b742-3e7c7d17f81b', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('549f270b-7d73-426e-852b-8620966bd682', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('5be8f3dc-241b-4f5e-97ee-db4b0cdadb1f', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:40:05', '2021-05-10 16:22:54', '2021-05-10 16:40:05'),
('5d251bd2-316f-47a8-ad02-485dc62f44a5', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('717fbed4-52cc-4aba-b984-4dfd9a0d8547', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('72362b6a-6d0a-4d28-ad63-ba3c8d29d7f9', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('767d417b-9603-4336-bc01-9315dc9fea41', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47'),
('7c02ab4b-029a-4b3b-a4de-542298a15f57', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:07:35', '2021-05-10 16:07:04', '2021-05-10 16:07:35'),
('90563fec-7a33-4308-a257-0231cf248f5e', 'App\\Notifications\\QuizNotification', 'App\\Admin', 4, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('94bf3c63-5a62-4db8-9c79-0dda2c1f6a67', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('95d4e944-4ca2-453b-91ca-ec15cfbd473d', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:22:54', '2021-05-10 16:22:54'),
('997bd457-3f4c-4fd3-9d1c-25e2332e478a', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:40:05', '2021-05-10 16:19:24', '2021-05-10 16:40:05'),
('9c4a48e1-7dee-4567-a275-bbf250849f05', 'App\\Notifications\\QuizNotification', 'App\\Admin', 2, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:09:25', '2021-05-10 16:09:25'),
('ac76a755-b144-4800-9df9-a823361f4891', 'App\\Notifications\\QuizNotification', 'App\\User', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/test\"}', '2021-05-10 16:17:45', '2021-05-10 16:09:25', '2021-05-10 16:17:45'),
('b82d3742-b06f-4b79-b602-fde90c2cc5cb', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('c6d3b2d4-055a-445a-910c-806da5da0927', 'App\\Notifications\\QuizNotification', 'App\\Admin', 1, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('eca37264-0134-41a9-b58a-7e7673f323e6', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice\\\\n was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:07:04', '2021-05-10 16:07:04'),
('f7593ad5-723c-429d-b40f-25ac1a9a7ad6', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:19:24', '2021-05-10 16:19:24'),
('facfc7b2-8adb-4ac1-a814-a23393b45c14', 'App\\Notifications\\QuizNotification', 'App\\Admin', 3, '{\"message\":\"Measurement Practice was added.\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/quizzes\"}', NULL, '2021-05-10 16:40:47', '2021-05-10 16:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `option_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `points`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '<p>kg</p>', 1, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(2, 1, '<p>gram</p>', 0, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(3, 1, '<p>pound</p>', 0, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(4, 2, '<p>kg</p>', 1, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(5, 2, '<p>gram</p>', 0, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(6, 2, '<p>meter</p>', 1, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(7, 2, '<p>second</p>', 1, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(8, 3, 'True', 1, '2021-05-06 14:44:31', '2021-05-06 14:44:31', NULL),
(9, 3, 'False', 0, '2021-05-06 14:44:31', '2021-05-06 14:44:31', NULL),
(10, 4, '<p>Measurement is the process of comparing known quantity with unknown quantity.</p>', NULL, '2021-05-06 14:45:59', '2021-05-06 14:45:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', 'user-management-access', NULL, NULL, NULL),
(2, 'permission_create', 'permission-create', NULL, NULL, NULL),
(3, 'permission_edit', 'permission-edit', NULL, NULL, NULL),
(4, 'permission_show', 'permission-show', NULL, NULL, NULL),
(5, 'permission_delete', 'permission-delete', NULL, NULL, NULL),
(6, 'permission_access', 'permission-access', NULL, NULL, NULL),
(7, 'role_create', 'role-create', NULL, NULL, NULL),
(8, 'role_edit', 'role-edit', NULL, NULL, NULL),
(9, 'role_show', 'role-show', NULL, NULL, NULL),
(10, 'role_delete', 'role-delete', NULL, NULL, NULL),
(11, 'role_access', 'role-access', NULL, NULL, NULL),
(12, 'user_create', 'user-create', NULL, NULL, NULL),
(13, 'user_edit', 'user-edit', NULL, NULL, NULL),
(14, 'user_show', 'user-show', NULL, NULL, NULL),
(15, 'user_delete', 'user-delete', NULL, NULL, NULL),
(16, 'user_access', 'user-access', NULL, NULL, NULL),
(17, 'group_create', 'group-create', NULL, NULL, NULL),
(18, 'group_edit', 'group-edit', NULL, NULL, NULL),
(19, 'group_show', 'group-show', NULL, NULL, NULL),
(20, 'group_delete', 'group-delete', NULL, NULL, NULL),
(21, 'group_access', 'group-access', NULL, NULL, NULL),
(22, 'course_create', 'course-create', NULL, NULL, NULL),
(23, 'course_edit', 'course-edit', NULL, NULL, NULL),
(24, 'course_show', 'course-show', NULL, NULL, NULL),
(25, 'course_delete', 'course-delete', NULL, NULL, NULL),
(26, 'course_access', 'course-access', NULL, NULL, NULL),
(27, 'lesson_create', 'lesson-create', NULL, NULL, NULL),
(28, 'lesson_edit', 'lesson-edit', NULL, NULL, NULL),
(29, 'lesson_show', 'lesson-show', NULL, NULL, NULL),
(30, 'lesson_delete', 'lesson-delete', NULL, NULL, NULL),
(31, 'lesson_access', 'lesson-access', NULL, NULL, NULL),
(32, 'category_create', 'category-create', NULL, NULL, NULL),
(33, 'category_edit', 'category-edit', NULL, NULL, NULL),
(34, 'category_show', 'category-show', NULL, NULL, NULL),
(35, 'category_delete', 'category-delete', NULL, NULL, NULL),
(36, 'category_access', 'category-access', NULL, NULL, NULL),
(37, 'quiz_create', 'quiz-create', NULL, NULL, NULL),
(38, 'quiz_edit', 'quiz-edit', NULL, NULL, NULL),
(39, 'quiz_show', 'quiz-show', NULL, NULL, NULL),
(40, 'quiz_delete', 'quiz-delete', NULL, NULL, NULL),
(41, 'quiz_access', 'quiz-access', NULL, NULL, NULL),
(42, 'question_create', 'question-create', NULL, NULL, NULL),
(43, 'question_edit', 'question-edit', NULL, NULL, NULL),
(44, 'question_show', 'question-show', NULL, NULL, NULL),
(45, 'question_delete', 'question-delete', NULL, NULL, NULL),
(46, 'question_access', 'question-access', NULL, NULL, NULL),
(47, 'grade_create', 'grade-create', NULL, NULL, NULL),
(48, 'grade_edit', 'grade-edit', NULL, NULL, NULL),
(49, 'grade_show', 'grade-show', NULL, NULL, NULL),
(50, 'grade_delete', 'grade-delete', NULL, NULL, NULL),
(51, 'grade_access', 'grade-access', NULL, NULL, NULL),
(52, 'student_create', 'student-create', NULL, NULL, NULL),
(53, 'student_edit', 'student-edit', NULL, NULL, NULL),
(54, 'student_show', 'student-show', NULL, NULL, NULL),
(55, 'student_delete', 'student-delete', NULL, NULL, NULL),
(56, 'student_access', 'student-access', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_hint` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_explanation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Multiple Choices',
  `marks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `question_hint`, `image`, `answer_explanation`, `type`, `marks`, `time`, `time_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<p>What is SI unit of mass?</p>', '<p><strong>SI</strong> is the metric system that is used universally as a standard for measurements.</p>', NULL, '<p>SI unit of mass is kg.</p>', 'Multiple Choices', '10', NULL, NULL, '2021-05-06 14:16:01', '2021-05-06 14:16:01', NULL),
(2, '<p>Which of them listed below are <strong>SI </strong>units?</p>', NULL, NULL, '<p>kg,gram and second are <strong>SI</strong> units.</p>', 'Multiple Answers', '10', '60', NULL, '2021-05-06 14:43:43', '2021-05-06 14:43:43', NULL),
(3, '<p>Is second <strong>SI</strong> unit of time?</p>', NULL, NULL, '<p>Second is SI unit of time.</p>', 'True or False', '10', NULL, NULL, '2021-05-06 14:44:31', '2021-05-06 14:44:31', NULL),
(4, '<p>What is measurement?</p>', NULL, NULL, '<p>Measurement is the process of comparing known quantity with unknown quantity.</p>', 'Short Answer', '10', NULL, NULL, '2021-05-06 14:45:59', '2021-05-06 14:45:59', NULL),
(5, '<p>What is SI?</p>', NULL, NULL, NULL, 'Short Answer', '10', '60', NULL, '2021-05-10 13:50:59', '2021-05-10 13:50:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_quiz`
--

CREATE TABLE `question_quiz` (
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `quiz_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_quiz`
--

INSERT INTO `question_quiz` (`question_id`, `quiz_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `lesson_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(4) DEFAULT 0,
  `attempts_no` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `start_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `time_type` int(11) DEFAULT NULL,
  `pass_marks` double(8,2) DEFAULT NULL,
  `full_marks` double(8,2) DEFAULT NULL,
  `remaining_marks` double(8,2) DEFAULT NULL,
  `quiz_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_view` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_publish` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title`, `description`, `published`, `attempts_no`, `created_at`, `updated_at`, `deleted_at`, `start_at`, `end_at`, `time`, `time_type`, `pass_marks`, `full_marks`, `remaining_marks`, `quiz_type`, `answer_view`, `answer_publish`) VALUES
(1, 1, 1, 'Measurement Practice', NULL, 0, 0, '2021-05-06 14:10:14', '2021-05-06 19:51:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Practice Quiz', 'end_of_quiz', 1),
(2, 2, 2, 'Force Mock Test', NULL, 0, 1, '2021-05-06 15:50:34', '2021-05-06 15:50:34', NULL, NULL, NULL, NULL, NULL, 40.00, 100.00, 100.00, 'Mock Test', 'end_of_quiz', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_student`
--

CREATE TABLE `quiz_student` (
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_user`
--

CREATE TABLE `quiz_user` (
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_user`
--

INSERT INTO `quiz_user` (`quiz_id`, `admin_id`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL, NULL),
(2, 'User', 'user', NULL, NULL, NULL),
(3, 'Teacher', 'teacher', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 44),
(3, 45),
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `address`, `contact`, `school`, `passed`) VALUES
(1, 'Bibek Khatri', 'bibekkhatri81@gmail.com', '$2y$10$/1v4we5IrTfS27XUWis2e.wLiTLpwe1VPZaiZw9pBqfPfyOcwYwJC', NULL, '2021-05-06 16:08:57', '2021-05-06 16:08:57', NULL, NULL, NULL, NULL, NULL),
(2, 'Ram Thapa', 'ram@ram.com', '$2y$10$UfTvfPqVh4vqunSLXOYfn.F7ZR8/V6OYAPxYrVlSn.eEq.QxZDQuq', NULL, '2021-05-10 16:19:09', '2021-05-10 16:19:09', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admins_groups`
--
ALTER TABLE `admins_groups`
  ADD PRIMARY KEY (`admin_id`,`group_id`),
  ADD KEY `admins_groups_group_id_foreign` (`group_id`);

--
-- Indexes for table `admins_permissions`
--
ALTER TABLE `admins_permissions`
  ADD PRIMARY KEY (`admin_id`,`permission_id`),
  ADD KEY `admins_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `admins_roles`
--
ALTER TABLE `admins_roles`
  ADD PRIMARY KEY (`admin_id`,`role_id`),
  ADD KEY `admins_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempts_quiz_id_foreign` (`quiz_id`),
  ADD KEY `attempts_user_id_foreign` (`user_id`),
  ADD KEY `attempts_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_answers_attempt_id_foreign` (`attempt_id`),
  ADD KEY `attempt_answers_question_id_foreign` (`question_id`),
  ADD KEY `attempt_answers_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `attempt_options`
--
ALTER TABLE `attempt_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_options_attempt_answer_id_foreign` (`attempt_answer_id`),
  ADD KEY `attempt_options_option_id_foreign` (`option_id`),
  ADD KEY `attempt_options_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_grade_id_foreign` (`grade_id`),
  ADD KEY `courses_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD KEY `course_student_course_id_foreign` (`course_id`),
  ADD KEY `course_student_user_id_foreign` (`user_id`);

--
-- Indexes for table `course_user`
--
ALTER TABLE `course_user`
  ADD KEY `course_user_course_id_foreign` (`course_id`),
  ADD KEY `course_user_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`),
  ADD KEY `lessons_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `lesson_student`
--
ALTER TABLE `lesson_student`
  ADD KEY `lesson_student_lesson_id_foreign` (`lesson_id`),
  ADD KEY `lesson_student_user_id_foreign` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `question_quiz`
--
ALTER TABLE `question_quiz`
  ADD KEY `question_quiz_question_id_foreign` (`question_id`),
  ADD KEY `question_quiz_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `54422_596eeef514d00` (`course_id`),
  ADD KEY `54422_596eeef53411a` (`lesson_id`),
  ADD KEY `quizzes_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `quiz_student`
--
ALTER TABLE `quiz_student`
  ADD KEY `quiz_student_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_student_user_id_foreign` (`user_id`);

--
-- Indexes for table `quiz_user`
--
ALTER TABLE `quiz_user`
  ADD KEY `quiz_user_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_user_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_unique` (`contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `attempt_options`
--
ALTER TABLE `attempt_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins_groups`
--
ALTER TABLE `admins_groups`
  ADD CONSTRAINT `admins_groups_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admins_permissions`
--
ALTER TABLE `admins_permissions`
  ADD CONSTRAINT `admins_permissions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admins_roles`
--
ALTER TABLE `admins_roles`
  ADD CONSTRAINT `admins_roles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempt_answers`
--
ALTER TABLE `attempt_answers`
  ADD CONSTRAINT `attempt_answers_attempt_id_foreign` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempt_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attempt_options`
--
ALTER TABLE `attempt_options`
  ADD CONSTRAINT `attempt_options_attempt_answer_id_foreign` FOREIGN KEY (`attempt_answer_id`) REFERENCES `attempt_answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempt_options_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_user`
--
ALTER TABLE `course_user`
  ADD CONSTRAINT `course_user_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson_student`
--
ALTER TABLE `lesson_student`
  ADD CONSTRAINT `lesson_student_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_quiz`
--
ALTER TABLE `question_quiz`
  ADD CONSTRAINT `question_quiz_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_quiz_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `54422_596eeef514d00` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `54422_596eeef53411a` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_student`
--
ALTER TABLE `quiz_student`
  ADD CONSTRAINT `quiz_student_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_user`
--
ALTER TABLE `quiz_user`
  ADD CONSTRAINT `quiz_user_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_user_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
