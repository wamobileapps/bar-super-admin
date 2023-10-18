-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2022 at 12:49 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barcon_barconn`
--

-- --------------------------------------------------------

--
-- Table structure for table `doors`
--

CREATE TABLE `doors` (
  `id` int UNSIGNED NOT NULL,
  `door_name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doors`
--

INSERT INTO `doors` (`id`, `door_name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'First Door', 10, NULL, NULL),
(2, 'Second Door', 11, NULL, NULL),
(3, 'Third Door', 12, NULL, NULL),
(4, 'Home Door', 13, NULL, NULL),
(5, 'Grand Door', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_02_01_191808_create_questions_table', 1),
(4, '2021_02_02_121658_create_never_have_evers_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `never_have_evers`
--

CREATE TABLE `never_have_evers` (
  `id` int UNSIGNED NOT NULL,
  `questions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `never_have_evers`
--

INSERT INTO `never_have_evers` (`id`, `questions`, `created_at`, `updated_at`) VALUES
(3, 'NEVER HAVE I EVER BEEN ON A BLIND DATE', '2021-02-02 21:21:07', '2021-04-03 12:18:18'),
(5, 'NEVER HAVE I EVER BEEN FIRED FROM A JOB', '2021-02-03 06:27:37', '2021-04-03 12:18:44'),
(6, 'NEVER HAVE I EVER PEED IN THE STREET', '2021-02-26 02:40:36', '2021-04-03 12:19:12'),
(7, 'NEVER HAVE I EVER BEEN OUT OF THE COUNTRY', '2021-03-13 15:35:38', '2021-04-03 12:19:36'),
(8, 'NEVER HAVE I EVER BROUGHT A BRAND NEW CAR', '2021-03-13 15:39:05', '2021-04-03 12:19:59'),
(9, 'NEVER HAVE I EVER GRADUATED COLLEGE', '2021-03-13 15:40:46', '2021-04-03 12:20:20'),
(10, 'NEVER HAVE I EVER ATE A LIME WHOLE', '2021-04-03 12:17:40', '2021-04-03 12:17:40'),
(11, 'NEVER HAVE I EVER GONE FISHING', '2021-04-03 12:20:44', '2021-04-03 12:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `never_have_ever__answers`
--

CREATE TABLE `never_have_ever__answers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `never_have_ever_id` int NOT NULL,
  `answer` enum('YES','NO') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `never_have_ever__answers`
--

INSERT INTO `never_have_ever__answers` (`id`, `user_id`, `never_have_ever_id`, `answer`) VALUES
(1, 9, 1, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int UNSIGNED NOT NULL,
  `bar_id` int NOT NULL,
  `questionnaire_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `bar_id`, `questionnaire_title`, `first_question`, `sec_question`, `created_at`, `updated_at`) VALUES
(3, 0, 'tests', 'Do you think i am cute?', '\'Do you read?', '2021-02-02 15:03:57', '2021-02-23 07:42:21'),
(4, 0, 'QA team', 'What is software testing life cycle?', 'What is Agile model?', '2021-02-03 05:22:49', '2021-02-03 05:22:49'),
(6, 0, 'slot 2', 'Do your wear jordans', 'Are you into my looks', '2021-02-26 02:37:16', '2021-02-26 02:37:16'),
(7, 0, 'test', 'how are u', 'how old are u', '2021-04-14 09:04:36', '2021-04-14 09:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `request_drink`
--

CREATE TABLE `request_drink` (
  `id` int UNSIGNED NOT NULL,
  `from_user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `drink_id` int NOT NULL,
  `to_user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_drink`
--

INSERT INTO `request_drink` (`id`, `from_user_id`, `drink_id`, `to_user_id`, `status`, `created_at`) VALUES
(1, 'ae97274d50d1775c1b4089359644b503', 1, 'ae97274d50d1775c1b4089359644b503', 1, '2021-03-25 08:14:52'),
(2, 'ae97274d50d1775c1b4089359644b503', 1, 'ae97274d50d1775c1b4089359644b503', 0, '2021-03-25 08:34:11'),
(3, 'ae97274d50d1775c1b4089359644b503', 7, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 0, '2021-03-25 08:47:34'),
(4, 'ae97274d50d1775c1b4089359644b503', 65, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 0, '2021-03-25 08:48:15'),
(5, 'ae97274d50d1775c1b4089359644b503', 65, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 0, '2021-03-25 08:49:51'),
(6, 'ae97274d50d1775c1b4089359644b503', 7, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 0, '2021-03-25 09:07:25'),
(7, 'b8245b00dca6d2a37f1b127383eab59f', 7, '1d1ea9623dbcafd48a89f05e5a8a670a', 0, '2021-04-12 23:38:51'),
(8, 'b8245b00dca6d2a37f1b127383eab59f', 104, '1d1ea9623dbcafd48a89f05e5a8a670a', 0, '2021-04-12 23:39:00'),
(9, 'b8245b00dca6d2a37f1b127383eab59f', 7, '1d1ea9623dbcafd48a89f05e5a8a670a', 0, '2021-05-26 01:26:27'),
(10, 'dfe13424956effda6f2bc424df005397', 104, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 0, '2021-07-17 05:13:33'),
(11, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'a97f81ac1e54c7e775771aacc3a49357', 0, '2021-12-27 09:44:42'),
(14, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:05:14'),
(15, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:05:54'),
(16, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:07:29'),
(17, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:07:33'),
(18, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:08:22'),
(19, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:12:49'),
(20, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:14:57'),
(21, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:15:01'),
(22, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:15:03'),
(23, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:18'),
(24, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:20'),
(25, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:21'),
(26, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:23'),
(27, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:24'),
(28, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:25'),
(29, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:26'),
(30, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:26'),
(31, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:27'),
(32, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:28'),
(33, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:19:29'),
(34, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:20:22'),
(35, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:25:31'),
(36, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:25:38'),
(37, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:25:42'),
(38, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:25:43'),
(39, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:25:44'),
(40, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:25:45'),
(41, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:26:29'),
(42, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:26:33'),
(43, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:26:37'),
(44, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:34:02'),
(45, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:34:10'),
(46, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:36:07'),
(47, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:36:30'),
(48, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:37:48'),
(49, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:37:50'),
(50, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:37:52'),
(51, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:40:12'),
(52, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:41:10'),
(53, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:42:37'),
(54, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:43:06'),
(55, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:43:08'),
(56, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:49:35'),
(57, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:51:55'),
(58, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:55:49'),
(59, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:56:33'),
(60, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 10:59:18'),
(61, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 11:59:53'),
(62, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:00:56'),
(63, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:01:00'),
(64, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:01:22'),
(65, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:02:23'),
(66, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:02:43'),
(67, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:05:45'),
(68, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:06:08'),
(69, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 0, '2021-12-27 12:06:32'),
(70, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 1, '2021-12-27 12:07:37'),
(71, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 1, '2021-12-28 11:45:31'),
(72, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 1, '2021-12-28 11:45:34'),
(73, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 1, '2021-12-28 11:46:39'),
(74, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'a97f81ac1e54c7e775771aacc3a49357', 2, '2021-12-28 11:56:58'),
(75, 'a97f81ac1e54c7e775771aacc3a49357', 119, '4b4b7165a47354b45dfc42f2a4f20c71', 2, '2021-12-29 06:32:34'),
(76, 'a97f81ac1e54c7e775771aacc3a49357', 122, '4b4b7165a47354b45dfc42f2a4f20c71', 1, '2021-12-29 13:03:56'),
(77, '4b4b7165a47354b45dfc42f2a4f20c71', 122, '9bd0eb91c37cece5133ccdced7b62759', 0, '2022-01-04 14:41:55'),
(78, '4b4b7165a47354b45dfc42f2a4f20c71', 119, '9bd0eb91c37cece5133ccdced7b62759', 0, '2022-01-06 06:51:16'),
(79, '4b4b7165a47354b45dfc42f2a4f20c71', 119, '9bd0eb91c37cece5133ccdced7b62759', 0, '2022-01-06 14:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `t_add_user_event`
--

CREATE TABLE `t_add_user_event` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int NOT NULL,
  `event_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_add_user_event`
--

INSERT INTO `t_add_user_event` (`id`, `user_id`, `bar_id`, `event_id`, `created_at`, `updated_at`) VALUES
(3, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, 1, '2020-12-29 18:59:58', '2020-12-29 18:59:58'),
(4, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, 2, '2020-12-29 19:00:06', '2020-12-29 19:00:06'),
(5, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, 3, '2020-12-29 19:00:12', '2020-12-29 19:00:12'),
(10, 'ae97274d50d1775c1b4089359644b503', 2, 5, '2020-12-29 20:01:58', '2020-12-29 20:01:58'),
(12, 'ae97274d50d1775c1b4089359644b503', 2, 2, '2021-02-19 20:05:13', '2021-02-19 20:05:13'),
(13, 'ae97274d50d1775c1b4089359644b503', 2, 6, '2021-02-19 20:05:22', '2021-02-19 20:05:22'),
(15, 'b8245b00dca6d2a37f1b127383eab59f', 2, 1, '2021-03-05 03:08:53', '2021-03-05 03:08:53'),
(16, 'b8245b00dca6d2a37f1b127383eab59f', 2, 2, '2021-03-05 03:10:48', '2021-03-05 03:10:48'),
(18, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-20 13:41:38', '2021-03-20 13:41:38'),
(20, 'ec55324cb8115ffa811876184636a4c3', 2, 1, '2021-03-31 20:09:02', '2021-03-31 20:09:02'),
(21, 'ec55324cb8115ffa811876184636a4c3', 2, 2, '2021-03-31 20:09:05', '2021-03-31 20:09:05'),
(22, 'ec55324cb8115ffa811876184636a4c3', 2, 3, '2021-03-31 20:09:08', '2021-03-31 20:09:08'),
(23, '96992bb4290476b37a2f161dc259c8b2', 2, 1, '2021-04-02 01:09:04', '2021-04-02 01:09:04'),
(24, '96992bb4290476b37a2f161dc259c8b2', 2, 2, '2021-04-02 01:09:07', '2021-04-02 01:09:07'),
(26, '96992bb4290476b37a2f161dc259c8b2', 2, 5, '2021-04-02 01:09:16', '2021-04-02 01:09:16'),
(27, '96992bb4290476b37a2f161dc259c8b2', 2, 7, '2021-04-02 01:09:19', '2021-04-02 01:09:19'),
(28, 'rwf4t364tgege5', 2, 3, '2021-05-07 15:27:53', '2021-05-07 15:27:53'),
(29, 'd6530465201d4ab86f911671203cf466', 2, 2, '2021-05-18 13:46:46', '2021-05-18 13:46:46'),
(31, 'a97f81ac1e54c7e775771aacc3a49357', 566, 16, '2021-12-27 17:50:19', '2021-12-27 17:50:19'),
(32, '4b4b7165a47354b45dfc42f2a4f20c71', 566, 16, '2021-12-27 17:56:34', '2021-12-27 17:56:34'),
(33, 'a97f81ac1e54c7e775771aacc3a49357', 566, 17, '2021-12-27 18:37:59', '2021-12-27 18:37:59'),
(34, 'a97f81ac1e54c7e775771aacc3a49357', 572, 19, '2021-12-29 11:41:29', '2021-12-29 11:41:29'),
(35, 'a97f81ac1e54c7e775771aacc3a49357', 572, 18, '2021-12-29 11:54:47', '2021-12-29 11:54:47'),
(36, '9bd0eb91c37cece5133ccdced7b62759', 574, 21, '2022-01-05 14:46:24', '2022-01-05 14:46:24'),
(37, '4b4b7165a47354b45dfc42f2a4f20c71', 574, 32, '2022-01-14 11:59:23', '2022-01-14 11:59:23'),
(38, 'b8245b00dca6d2a37f1b127383eab59f', 574, 34, '2022-01-27 21:50:30', '2022-01-27 21:50:30'),
(39, 'b8245b00dca6d2a37f1b127383eab59f', 574, 36, '2022-02-02 16:35:56', '2022-02-02 16:35:56'),
(40, '95d3cabe3fb6bcd7ac88146e05e32463', 576, 42, '2022-02-09 04:04:18', '2022-02-09 04:04:18'),
(41, '95d3cabe3fb6bcd7ac88146e05e32463', 576, 53, '2022-02-13 02:26:03', '2022-02-13 02:26:03'),
(42, '1889dec542525bc1b7732016faa5f8ae', 578, 84, '2022-02-15 21:19:56', '2022-02-15 21:19:56'),
(43, '79041e11f05c4c76cbe9f5e0206ff705', 579, 44, '2022-02-24 08:06:17', '2022-02-24 08:06:17'),
(44, '79041e11f05c4c76cbe9f5e0206ff705', 576, 52, '2022-02-24 09:38:30', '2022-02-24 09:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `t_add_user_event_possible`
--

CREATE TABLE `t_add_user_event_possible` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int NOT NULL,
  `event_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_add_user_event_possible`
--

INSERT INTO `t_add_user_event_possible` (`id`, `user_id`, `bar_id`, `event_id`, `created_at`, `updated_at`) VALUES
(1, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, 1, '2020-10-20 12:01:07', '2020-10-20 12:01:07'),
(2, 'rwf4t364tgege5', 2, 2, '2020-10-20 16:05:58', '2020-10-20 16:05:58'),
(3, 'rwf4t364tgege5', 2, 3, '2020-10-20 16:06:40', '2020-10-20 16:06:40'),
(4, 'rwf4t364tgege5', 2, 3, '2020-10-20 16:07:25', '2020-10-20 16:07:25'),
(5, '45614827eccf3d9025113d1e921ed6b3', 2, 1, '2020-10-21 13:39:08', '2020-10-21 13:39:08'),
(6, 'rwf4t364tgege5', 2, 2, '2020-10-31 04:05:27', '2020-10-31 04:05:27'),
(7, '45614827eccf3d9025113d1e921ed6b3', 2, 1, '2020-10-31 19:25:13', '2020-10-31 19:25:13'),
(8, '45614827eccf3d9025113d1e921ed6b3', 2, 2, '2020-10-31 19:26:49', '2020-10-31 19:26:49'),
(9, '45614827eccf3d9025113d1e921ed6b3', 2, 2, '2020-10-31 19:26:51', '2020-10-31 19:26:51'),
(10, 'a97f81ac1e54c7e775771aacc3a49357', 566, 16, '2021-12-28 17:51:23', '2021-12-28 17:51:23'),
(11, 'a97f81ac1e54c7e775771aacc3a49357', 572, 19, '2021-12-29 11:41:38', '2021-12-29 11:41:38'),
(12, 'a97f81ac1e54c7e775771aacc3a49357', 572, 18, '2021-12-29 11:54:56', '2021-12-29 11:54:56'),
(13, '9bd0eb91c37cece5133ccdced7b62759', 574, 21, '2022-01-05 14:46:29', '2022-01-05 14:46:29'),
(14, '4b4b7165a47354b45dfc42f2a4f20c71', 574, 32, '2022-01-14 11:59:25', '2022-01-14 11:59:25'),
(15, 'b8245b00dca6d2a37f1b127383eab59f', 574, 34, '2022-01-27 21:50:27', '2022-01-27 21:50:27'),
(16, 'b8245b00dca6d2a37f1b127383eab59f', 574, 36, '2022-02-02 16:35:54', '2022-02-02 16:35:54'),
(17, '95d3cabe3fb6bcd7ac88146e05e32463', 576, 42, '2022-02-09 04:04:15', '2022-02-09 04:04:15'),
(18, '95d3cabe3fb6bcd7ac88146e05e32463', 576, 53, '2022-02-13 02:26:05', '2022-02-13 02:26:05'),
(19, '1889dec542525bc1b7732016faa5f8ae', 578, 84, '2022-02-15 21:19:59', '2022-02-15 21:19:59'),
(20, '79041e11f05c4c76cbe9f5e0206ff705', 579, 44, '2022-02-24 08:06:13', '2022-02-24 08:06:13'),
(21, '79041e11f05c4c76cbe9f5e0206ff705', 576, 52, '2022-02-24 09:38:33', '2022-02-24 09:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-12-18 22:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `t_ad_banner`
--

CREATE TABLE `t_ad_banner` (
  `id` int NOT NULL,
  `bar_id` int NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_ad_banner`
--

INSERT INTO `t_ad_banner` (`id`, `bar_id`, `banner_image`, `start_date`, `expiry_date`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/banner/16103594645ffc22a8205eb_barimage.png', '2021-01-11', '2021-01-29', '', NULL, '2021-01-11 15:34:24', '2021-01-11 15:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar`
--

CREATE TABLE `t_bar` (
  `bar_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_second` varchar(255) DEFAULT NULL,
  `email_third` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text,
  `bar_type` varchar(255) DEFAULT NULL,
  `bar_hours` time DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `people_in` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `close_time` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `forgetpassword_link` varchar(255) DEFAULT NULL,
  `is_password_link_valid` datetime DEFAULT NULL,
  `is_add_game` tinyint(1) DEFAULT '0' COMMENT 'o= no, 1= yes',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar`
--

INSERT INTO `t_bar` (`bar_id`, `name`, `email`, `email_second`, `email_third`, `password`, `address`, `cover_image`, `description`, `bar_type`, `bar_hours`, `latitude`, `longitude`, `people_in`, `status`, `close_time`, `open_time`, `forgetpassword_link`, `is_password_link_valid`, `is_add_game`, `updated_at`, `created_at`) VALUES
(576, 'Bay Ridge', 'bayridge@1.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '7902 5th Ave, Brooklyn, NY 11209', 'http://18.116.154.137/public/Uploads/bar/164405948261fe5b5acaf5e_barimage.jpeg', NULL, NULL, NULL, 40.626549, -74.024139, 0, 1, '23:59', '11:00', NULL, NULL, 0, '2022-02-21 00:03:35', '2022-02-05 16:41:22'),
(577, 'Park Slope', 'parkslope@1.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '577 5th Ave NY 11215', 'http://18.116.154.137/public/Uploads/bar/164405972361fe5c4befdea_barimage.jpeg', NULL, NULL, NULL, 40.66474, -73.989639, 0, 1, '23:00', '11:00', NULL, NULL, 0, '2022-02-05 16:45:23', '2022-02-05 16:45:23'),
(578, 'Staten Island', 'statenisland@1.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '24 Navy Pier Ct, Staten Island, NY 10304', 'http://18.116.154.137/public/Uploads/bar/164405988161fe5ce949b2c_barimage.jpeg', NULL, NULL, NULL, 40.628731, -74.074219, 0, 1, '23:59', '11:00', NULL, NULL, 0, '2022-02-21 00:03:24', '2022-02-05 16:48:01'),
(579, 'Boro Park', 'boropark@1.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '106 Beverley Rd, Brooklyn, NY 11218', 'http://18.116.154.137/public/Uploads/bar/bf4968f1d7485af0a7d313ffb09fbe1f_barimage.png', 'good', 'good', '00:00:00', 40.642738, -73.979179, 0, 1, '23:59', '11:00', NULL, NULL, 0, '2022-02-15 22:10:47', '2022-02-05 16:51:52'),
(580, 'BARCLAY', 'BARCLAY@1.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '620 Atlantic Ave', 'http://18.116.154.137/public/Uploads/bar/16444338196204119b1cada_barimage.jpeg', NULL, NULL, NULL, 40.68307, -73.97604, 0, 1, '23:59', '11:00', NULL, NULL, 0, '2022-02-10 00:40:19', '2022-02-10 00:40:19'),
(581, 'Sun Set Park', 'sunsetpark@1.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '7217 8th Ave Brooklyn, NY 11228', 'http://18.116.154.137/public/Uploads/bar/1644434082620412a2ae89d_barimage.jpeg', NULL, NULL, NULL, 40.62812, -74.01683, 0, 1, '23:59', '11:00', NULL, NULL, 0, '2022-02-10 00:44:42', '2022-02-10 00:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_event`
--

CREATE TABLE `t_bar_event` (
  `event_id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `bar_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(11) DEFAULT NULL,
  `event_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_event`
--

INSERT INTO `t_bar_event` (`event_id`, `url`, `bar_id`, `name`, `description`, `icon`, `image`, `color`, `event_type`, `start_date`, `start_time`, `end_date`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(14, NULL, 566, 'Christmas', 'It is the time of the year to spread cheer and good tidings. The Christmas Season is here once again for laughter, joy, and reflection.', NULL, 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barevent/Christmas.jpg', NULL, 'Christmas', '2021-12-22', '01:00:00', '2021-12-25', '24:00:00', NULL, '2021-12-20 17:13:40', '2021-12-20 17:13:40'),
(15, NULL, 566, 'New Year', 'New Year is the time or day at which a new calendar year begins and the calendar\'s year count increments by one.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barevent/164018570261c33f661f8c2_eventicon.jpeg', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barevent/164018570261c33f661f686_eventimage.jpeg', 'red', 'New Year 2022', '2021-12-25', '01:00:00', '2022-01-05', '12:39:00', NULL, '2021-12-20 19:01:01', '2021-12-22 20:38:22'),
(16, NULL, 566, 'event 1', 'hello', NULL, 'http://18.116.154.137/public/Uploads/barevent/164060213061c99a12b2cea_eventimage.jpeg', NULL, 'dfd', '2021-12-28', '18:16:00', '2022-01-18', '19:16:00', NULL, '2021-12-27 16:18:50', '2021-12-27 16:18:50'),
(17, NULL, 566, 'event 2', 'hello', NULL, 'http://18.116.154.137/public/Uploads/barevent/164061045561c9ba975c6c4_eventimage.jpeg', NULL, 'dance', '2021-12-27', '18:36:00', '2022-01-28', '20:36:00', NULL, '2021-12-27 18:37:35', '2021-12-27 18:37:35'),
(18, NULL, 572, 'new year', 'xyz', 'http://18.116.154.137/public/Uploads/barevent/164068297961cad5e33d7ed_eventicon.jpeg', 'http://18.116.154.137/public/Uploads/barevent/164068297961cad5e33d556_eventimage.jpeg', 'red', 'xyz', '2021-12-29', '16:46:00', '2022-01-09', '18:48:00', NULL, '2021-12-28 14:44:57', '2021-12-28 14:46:19'),
(19, NULL, 572, 'xyz', 'xyz', NULL, 'http://18.116.154.137/public/Uploads/barevent/833ce240223aa28feb63cbffe0b3bb2c_eventimage.png', NULL, 'xyz', '2021-12-29', '21:09:00', '2022-01-08', '19:07:00', NULL, '2021-12-28 16:05:11', '2021-12-28 16:05:11'),
(20, NULL, 572, 'trh', 'fghbf', NULL, 'http://18.116.154.137/public/Uploads/barevent/c6935f72053ba7f47b57a3750f7154c3_eventimage.png', NULL, 'gnfgh', '2022-01-06', '20:44:00', '2022-02-06', '22:44:00', NULL, '2021-12-28 16:45:02', '2021-12-28 16:45:02'),
(36, NULL, 574, 'Beer pong', 'open tables first come first serve', NULL, 'http://18.116.154.137/public/Uploads/barevent/c3d9501801f089f2a81e1b4152ee55c1_eventimage.png', NULL, 'beer pong', '2022-02-02', '19:00:00', '2022-02-03', '02:00:00', NULL, '2022-02-02 16:33:04', '2022-02-02 16:33:04'),
(37, NULL, 574, 'live music', '2 bands will be playing (alternative rock)', NULL, 'http://18.116.154.137/public/Uploads/barevent/7ae117518aeb48223bea64694f4fc194_eventimage.png', NULL, 'live music', '2022-02-03', '18:00:00', '2022-02-04', '02:00:00', NULL, '2022-02-02 16:35:36', '2022-02-02 16:35:36'),
(38, NULL, 574, 'Happy hour', 'Drinks half off (some items are excluded)', NULL, 'http://18.116.154.137/public/Uploads/barevent/439714fb9b51eaa31c9560eb6c462a68_eventimage.png', NULL, 'Happy hour', '2022-02-02', '12:00:00', '2022-02-02', '19:00:00', NULL, '2022-02-02 16:43:02', '2022-02-02 16:43:02'),
(39, NULL, 579, 'Happy Hour', 'drinks will be half price from 11am to 7pm', NULL, 'http://18.116.154.137/public/Uploads/barevent/e1e05867f4c8d4697c1a791521b707a5_eventimage.png', NULL, 'Happy Hour', '2022-02-21', '11:00:00', '2022-02-21', '19:00:00', NULL, '2022-02-09 02:24:16', '2022-02-21 21:51:41'),
(40, NULL, 579, 'Trivia Night', 'Groups will play against each other. If you do not have a group do not worry we will add you to a group .', NULL, 'http://18.116.154.137/public/Uploads/barevent/d63cfe9d658a403de1dd1b25082c97a8_eventimage.png', NULL, 'Trivia Night/ Things to do', '2022-02-22', '19:04:00', '2022-02-22', '23:59:00', NULL, '2022-02-09 02:35:27', '2022-02-21 21:52:00'),
(41, NULL, 576, 'Sip and Paint', 'Sip and Paint night. We will provide all supplies for $25 this also includes 1 free drink', NULL, 'http://18.116.154.137/public/Uploads/barevent/c52995f8096c8a8f44be2d437acc0003_eventimage.png', NULL, 'sip and paint', '2022-02-21', '17:28:00', '2022-02-21', '23:59:00', NULL, '2022-02-09 03:56:24', '2022-02-21 21:31:14'),
(42, NULL, 576, 'Beer pong tournament', '3 tables available. Table 1 is for 1 on 1. Table 2 and 3 are for 2 on 2 . Winner stays on table until they choose to end their turn. If you win 3 in a row a pitcher of beer is on us', NULL, 'http://18.116.154.137/public/Uploads/barevent/6463ec0d7bac885684798167654e9853_eventimage.png', NULL, 'tournament', '2022-02-22', '19:30:00', '2022-02-22', '23:59:00', NULL, '2022-02-09 04:03:06', '2022-02-21 21:31:25'),
(43, NULL, 579, 'Beer Pong Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/e64dbc772c972eb5bace04a096a7e5b4_eventimage.png', NULL, 'Beer Pong Tournament', '2022-02-23', '11:00:00', '2022-02-23', '23:59:00', NULL, '2022-02-09 18:07:48', '2022-02-21 21:57:08'),
(44, NULL, 579, 'Darts Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/501452f4438f7ac736508bb631b008a9_eventimage.png', NULL, 'Darts Tournament', '2022-02-24', '11:00:00', '2022-02-24', '23:59:00', NULL, '2022-02-09 18:08:54', '2022-02-21 21:57:43'),
(45, NULL, 579, 'Billiards Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/6fe32f348a6c084b6dcafe8dc750f793_eventimage.png', NULL, 'Billiards Tournament', '2022-02-25', '11:00:00', '2022-02-25', '23:59:00', NULL, '2022-02-09 18:11:04', '2022-02-21 21:58:25'),
(46, NULL, 579, 'Live Music', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/a5d44a9f7bca5647ff6ccaddbfbcb1c0_eventimage.png', NULL, 'Live Music', '2022-02-26', '11:00:00', '2022-02-26', '23:59:00', NULL, '2022-02-09 18:14:48', '2022-02-21 21:58:39'),
(47, NULL, 579, 'Reggie Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/788f5e08617649fdf9c98f6084844d1a_eventimage.png', NULL, 'Reggie Night', '2022-02-27', '11:00:00', '2022-02-27', '23:59:00', NULL, '2022-02-09 18:15:55', '2022-02-21 21:58:53'),
(48, NULL, 579, 'Ladies Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/1d921a1e60fe88f2b6dd571607cdfd14_eventimage.png', NULL, 'Ladies Night', '2022-02-28', '11:00:00', '2022-02-28', '23:59:00', NULL, '2022-02-09 18:16:54', '2022-02-21 21:59:05'),
(49, NULL, 579, 'Karaoke', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/7852874187ece9c2382fccbc131a4e2c_eventimage.png', NULL, 'Karaoke', '2022-03-01', '11:00:00', '2022-03-01', '23:59:00', NULL, '2022-02-09 18:17:35', '2022-02-21 21:59:19'),
(51, NULL, 576, 'Happy Hours', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/9906e3e4932d7817c6b88d11d22986ed_eventimage.png', NULL, 'Happy Hours', '2022-02-23', '11:00:00', '2022-02-23', '23:59:00', NULL, '2022-02-09 22:17:58', '2022-02-21 21:31:38'),
(52, NULL, 576, 'Trivia Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/4946c04994273ec565d1937176ea4379_eventimage.png', NULL, 'Trivia Night', '2022-02-24', '11:00:00', '2022-02-24', '23:59:00', NULL, '2022-02-09 22:18:51', '2022-02-21 21:31:51'),
(53, NULL, 576, 'Darts Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/dd739c4f2040ec4c36a78c66de7552fe_eventimage.png', NULL, 'Darts Tournament', '2022-02-25', '11:00:00', '2022-02-25', '23:59:00', NULL, '2022-02-09 22:20:06', '2022-02-21 21:32:07'),
(54, NULL, 576, 'Billiards Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/e670fdb29181ca9e760e50cee5c87b0a_eventimage.png', NULL, 'Billiards Tournament', '2022-02-26', '11:00:00', '2022-02-26', '23:59:00', NULL, '2022-02-09 22:21:01', '2022-02-21 21:32:21'),
(55, NULL, 576, 'Live Music', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/d7eb7df62460e11a29d41d5fb07b6be2_eventimage.png', NULL, 'Live Music', '2022-02-27', '11:00:00', '2022-02-27', '23:59:00', NULL, '2022-02-09 22:22:15', '2022-02-21 21:32:35'),
(56, NULL, 576, 'Reggie Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/3c2951bbff1717c6ab426a9c49661a22_eventimage.png', NULL, 'Reggie Night', '2022-02-28', '11:00:00', '2022-02-28', '23:59:00', NULL, '2022-02-09 22:25:00', '2022-02-21 21:32:46'),
(57, NULL, 576, 'Ladies Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/8b6ad5d17c3a54c9ec1b5ce22c3a3201_eventimage.png', NULL, 'Ladies Night', '2022-03-01', '11:00:00', '2022-03-01', '23:59:00', NULL, '2022-02-09 22:25:58', '2022-02-21 21:32:59'),
(58, NULL, 576, 'Karaoke', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/7bb4964bac2062d74bfec634a223c6e9_eventimage.png', NULL, 'Karaoke', '2022-03-02', '11:00:00', '2022-03-02', '23:59:00', NULL, '2022-02-09 22:55:05', '2022-02-21 21:33:13'),
(59, NULL, 577, 'Happy Hours', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/0535b83d699a4f4628c086986e6772e8_eventimage.png', NULL, 'Happy Hours', '2022-02-21', '11:00:00', '2022-02-21', '23:59:00', NULL, '2022-02-11 01:58:07', '2022-02-21 21:34:21'),
(60, NULL, 577, 'Trivia Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/48077d7fd7745af497aa2ad8ccddd6f7_eventimage.png', NULL, 'Trivia Night', '2022-02-22', '11:00:00', '2022-02-22', '23:59:00', NULL, '2022-02-11 01:58:51', '2022-02-21 21:36:53'),
(61, NULL, 577, 'Beer Pong Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/aef861af87de928ad179faa07d542d7a_eventimage.png', NULL, 'Beer Pong Tournament', '2022-02-23', '11:00:00', '2022-02-23', '23:59:00', NULL, '2022-02-11 01:59:44', '2022-02-21 21:39:02'),
(62, NULL, 577, 'Darts Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/5cfb620f0fe421d8568143bee86ddada_eventimage.png', NULL, 'Darts Tournament', '2022-02-24', '11:00:00', '2022-02-24', '23:59:00', NULL, '2022-02-11 02:00:38', '2022-02-21 21:40:06'),
(63, NULL, 577, 'Billiards Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/2e2832043d5e6aabd6f2ffd660812564_eventimage.png', NULL, 'Billiards Tournament', '2022-02-25', '11:00:00', '2022-02-25', '23:59:00', NULL, '2022-02-11 02:01:30', '2022-02-21 21:41:07'),
(64, NULL, 577, 'Live Music', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/aab712283f13bfd5299ad5ee07165a77_eventimage.png', NULL, 'Live Music', '2022-02-26', '11:00:00', '2022-02-26', '23:59:00', NULL, '2022-02-11 02:02:35', '2022-02-21 21:43:41'),
(65, NULL, 577, 'Ladies Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/74a9f90bb5ae68ef190eb85f5e7bb2a4_eventimage.png', NULL, 'Ladies Night', '2022-02-27', '11:00:00', '2022-02-27', '23:59:00', NULL, '2022-02-11 02:04:19', '2022-02-21 21:45:11'),
(66, NULL, 577, 'Reggie Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/9356e52fc6d55aef3697a844d533c6f3_eventimage.png', NULL, 'Reggie Night', '2022-02-28', '11:00:00', '2022-02-28', '23:59:00', NULL, '2022-02-11 02:05:37', '2022-02-21 21:47:00'),
(67, NULL, 577, 'Karaoke', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/44aab30e8c489d558b0e3ea449f66fe5_eventimage.png', NULL, 'Karaoke', '2022-03-01', '11:00:00', '2022-03-01', '23:59:00', NULL, '2022-02-11 02:07:43', '2022-02-21 21:47:23'),
(68, NULL, 581, 'Happy Hours', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/b2fb90f1e25423d09e8d211e07db90bc_eventimage.png', NULL, 'Happy Hours', '2022-02-21', '11:00:00', '2022-02-21', '23:59:00', NULL, '2022-02-11 02:31:00', '2022-02-21 22:01:22'),
(69, NULL, 581, 'Trivia Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/25ad7207853bc0a7477749af236317c9_eventimage.png', NULL, 'Trivia Night', '2022-02-22', '11:00:00', '2022-02-22', '23:59:00', NULL, '2022-02-11 02:31:48', '2022-02-21 22:10:16'),
(70, NULL, 581, 'Beer Pong Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/1fda9d39e56e7e76dd198bbde4fbcdcf_eventimage.png', NULL, 'Beer Pong Tournament', '2022-02-23', '11:00:00', '2022-02-23', '23:59:00', NULL, '2022-02-11 02:32:37', '2022-02-21 22:10:29'),
(71, NULL, 581, 'Darts Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/b9a44d0177980754bafa108178ded3b5_eventimage.png', NULL, 'Darts Tournament', '2022-02-24', '11:00:00', '2022-02-24', '23:59:00', NULL, '2022-02-11 02:33:23', '2022-02-21 22:10:45'),
(72, NULL, 581, 'Billiards Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/11b6422dd3041ccdf7fc328339bb5a41_eventimage.png', NULL, 'Billiards Tournament', '2022-02-25', '11:00:00', '2022-02-25', '23:59:00', NULL, '2022-02-11 02:34:06', '2022-02-21 22:11:02'),
(73, NULL, 581, 'Live Music', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/df57bd4157e1798d8a08bde2daa034a1_eventimage.png', NULL, 'Live Music', '2022-02-26', '11:00:00', '2022-02-26', '23:59:00', NULL, '2022-02-11 02:35:09', '2022-02-21 22:11:17'),
(74, NULL, 581, 'Reggie Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/50aff38e43e71c60ddb73d4186144a15_eventimage.png', NULL, 'Reggie Night', '2022-02-27', '11:00:00', '2022-02-27', '23:59:00', NULL, '2022-02-11 02:35:55', '2022-02-21 22:11:31'),
(75, NULL, 581, 'Ladies Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/7ddb07913baed5bdaca356b727d7637a_eventimage.png', NULL, 'Ladies Night', '2022-02-28', '11:00:00', '2022-02-28', '23:59:00', NULL, '2022-02-11 02:36:52', '2022-02-21 22:11:50'),
(76, NULL, 581, 'Karaoke', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/ce029887108f4f9dd7eb858ba5f7502e_eventimage.png', NULL, 'Karaoke', '2022-03-01', '11:00:00', '2022-03-01', '23:59:00', NULL, '2022-02-11 02:37:43', '2022-02-21 22:12:07'),
(77, NULL, 578, 'Happy Hours', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/daf8676f546d028d5e25986002d3806e_eventimage.png', NULL, 'Happy Hours', '2022-02-21', '11:00:00', '2022-02-21', '23:59:00', NULL, '2022-02-11 03:02:24', '2022-02-21 21:27:04'),
(78, NULL, 578, 'Trivia Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/082d1a4f26efbdd3591c3c0a2c9472a3_eventimage.png', NULL, 'Trivia Night', '2022-02-22', '11:00:00', '2022-02-22', '23:59:00', NULL, '2022-02-11 03:03:17', '2022-02-21 21:27:18'),
(79, NULL, 578, 'Beer Pong Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/6ea348dbba9b2acaa0aaa50a64dbc32a_eventimage.png', NULL, 'Beer Pong Tournament', '2022-02-23', '11:00:00', '2022-02-23', '23:59:00', NULL, '2022-02-11 03:04:01', '2022-02-21 21:27:35'),
(80, NULL, 578, 'Darts Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/b78bd77236ad8dd28d7fde8d1125982d_eventimage.png', NULL, 'Darts Tournament', '2022-02-24', '11:00:00', '2022-02-24', '23:59:00', NULL, '2022-02-11 03:29:24', '2022-02-21 21:29:05'),
(81, NULL, 578, 'Billiards Tournament', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/a44abb9ba1681c79d7495a84bd68dff9_eventimage.png', NULL, 'Billiards Tournament', '2022-02-25', '11:00:00', '2022-02-25', '23:59:00', NULL, '2022-02-11 03:30:09', '2022-02-21 21:29:29'),
(82, NULL, 578, 'Live Music', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/343d7b526e10edc1fc39b98ee3d3029b_eventimage.png', NULL, 'Live Music', '2022-02-26', '11:00:00', '2022-02-26', '23:59:00', NULL, '2022-02-11 03:32:47', '2022-02-21 21:29:45'),
(83, NULL, 578, 'Reggie Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/d0a7b45847a9209ac3f34566bf445126_eventimage.png', NULL, 'Reggie Night', '2022-02-27', '11:00:00', '2022-02-27', '23:59:00', NULL, '2022-02-11 03:34:23', '2022-02-21 21:29:59'),
(84, NULL, 578, 'Ladies Night', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/b2c1a61d16368b57d4fa7a305bbcba67_eventimage.png', NULL, 'Ladies Night', '2022-02-28', '11:00:00', '2022-02-28', '23:59:00', NULL, '2022-02-11 03:35:09', '2022-02-21 21:30:13'),
(85, NULL, 578, 'Karaoke', 'N/a', NULL, 'http://18.116.154.137/public/Uploads/barevent/aeff3e00993061c232160a6dc0a1104d_eventimage.png', NULL, 'Karaoke', '2022-03-01', '11:00:00', '2022-03-01', '23:59:00', NULL, '2022-02-11 03:36:05', '2022-02-21 21:30:29'),
(86, NULL, 579, 'player', 'nvnsi', NULL, 'http://18.116.154.137/public/Uploads/barevent/3b4ceee4e7342a17c9537752a0af8a4e_eventimage.png', NULL, 'fjisp', '2022-03-02', '11:13:00', '2022-03-02', '00:16:00', NULL, '2022-02-15 21:44:04', '2022-02-21 22:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_game`
--

CREATE TABLE `t_bar_game` (
  `id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `bar_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `no_of_players` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_game`
--

INSERT INTO `t_bar_game` (`id`, `url`, `bar_id`, `name`, `description`, `image`, `no_of_players`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 571, '21 Questions', 'Set of 3 darts, dartboard. Glossary. Glossary of darts. Darts is a sport in which two or more players throw small missiles, also known as darts', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game2.jpg', '', 1, '2020-08-28 20:18:35', '2020-08-28 20:18:35'),
(2, NULL, 571, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.jpg', '', 1, '2020-08-29 20:29:54', '2020-08-29 20:29:54'),
(3, NULL, 571, 'Scavenger Hunt', 'karaoke app that let you and your friends sing karaoke for free', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game4.jpg', '', 1, '2020-08-29 20:30:22', '2020-08-29 20:30:22'),
(76, NULL, 566, 'kabbadi', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/a7600318aa5cb450074b49933be1a94d_barimage.png', '2 Players', 1, '2020-12-17 13:48:49', '2020-12-17 13:48:49'),
(77, NULL, 566, 'Trivia', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/fff7358ecf490a97c71d8665d5824f63_barimage.png', '4 Players', 1, '2020-12-21 00:46:40', '2020-12-21 00:46:40'),
(79, NULL, 567, 'testserver', 'ksjhjkshjhsjkh', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/33435740b1d44ec20b6110b2eeae73ce_barimage.png', '4 Players', 1, '2020-12-24 13:55:32', '2020-12-24 13:55:32'),
(80, NULL, 567, 'NEVER HAVE I EVER', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/f6c36263c4e3f8f2d5a29a64570cb45a_barimage.png', '2 Players', 1, '2021-04-18 00:56:48', '2021-04-18 00:56:48'),
(81, NULL, 571, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.png', NULL, 1, '2021-08-11 13:21:14', '2021-08-11 13:21:14'),
(82, NULL, 566, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.png', NULL, 1, '2021-08-11 13:22:20', '2021-08-11 13:22:20'),
(83, NULL, 566, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.png', '4', 1, '2021-08-11 13:22:57', '2021-12-22 20:40:20'),
(84, NULL, 567, '21 Questions', 'Set of 3 darts, dartboard. Glossary. Glossary of darts. Darts is a sport in which two or more players throw small missiles, also known as darts', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game2.png', NULL, 1, '2021-08-11 13:23:43', '2021-08-11 13:23:43'),
(85, NULL, 567, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.png', NULL, 1, '2021-08-11 13:23:43', '2021-08-11 13:23:43'),
(86, NULL, 567, '21 Questions', 'Set of 3 darts, dartboard. Glossary. Glossary of darts. Darts is a sport in which two or more players throw small missiles, also known as darts', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game2.png', NULL, 1, '2021-08-11 13:33:18', '2021-08-11 13:33:18'),
(87, NULL, 571, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.png', NULL, 1, '2021-08-11 13:33:18', '2021-08-11 13:33:18'),
(99, NULL, 574, 'chess nt', 'test', NULL, '2 Players', 1, '2022-01-12 11:55:14', '2022-01-25 13:52:38'),
(107, NULL, 574, 'beer pong', 'test', NULL, '4 Players', 1, '2022-02-02 17:18:06', '2022-02-02 17:18:06'),
(108, NULL, 579, 'Billards', 'test', NULL, '4 Players', 1, '2022-02-09 02:29:16', '2022-02-09 02:29:16'),
(109, NULL, 579, 'Trivia', 'test', NULL, '4 Players', 1, '2022-02-09 02:29:51', '2022-02-09 02:29:51'),
(110, NULL, 579, 'Arcade Games', 'test', NULL, '4 Players', 1, '2022-02-09 02:30:45', '2022-02-09 02:30:45'),
(111, NULL, 579, 'Beer Pong', 'test', NULL, '4 Players', 1, '2022-02-09 02:31:00', '2022-02-09 02:31:00'),
(112, NULL, 579, 'Shuffle Board', 'test', NULL, '4 Players', 1, '2022-02-09 02:31:26', '2022-02-09 02:31:26'),
(113, NULL, 579, 'Darts', 'test', NULL, '4 Players', 1, '2022-02-09 02:31:41', '2022-02-09 02:31:41'),
(114, NULL, 577, 'Beer Pong', 'test', NULL, '4 Players', 1, '2022-02-11 02:19:08', '2022-02-11 02:19:08'),
(115, NULL, 577, 'Darts', 'test', NULL, '4 Players', 1, '2022-02-11 02:19:19', '2022-02-11 02:19:19'),
(116, NULL, 577, 'Billiards', 'test', NULL, '4 Players', 1, '2022-02-11 02:19:29', '2022-02-11 02:19:29'),
(117, NULL, 577, 'Trivia', 'test', NULL, '4 Players', 1, '2022-02-11 02:19:36', '2022-02-11 02:19:36'),
(118, NULL, 577, 'Shuffle Board', 'test', NULL, '4 Players', 1, '2022-02-11 02:19:50', '2022-02-11 02:19:50'),
(119, NULL, 577, 'Arcade', 'test', NULL, '4 Players', 1, '2022-02-11 02:19:57', '2022-02-11 02:19:57'),
(120, NULL, 581, 'Darts', 'test', NULL, '4 Players', 1, '2022-02-11 02:38:04', '2022-02-11 02:38:04'),
(121, NULL, 581, 'Beer Pong', 'test', NULL, '4 Players', 1, '2022-02-11 02:38:11', '2022-02-11 02:38:11'),
(122, NULL, 581, 'Billiards', 'test', NULL, '4 Players', 1, '2022-02-11 02:38:38', '2022-02-11 02:38:38'),
(123, NULL, 581, 'Trivia', 'test', NULL, '4 Players', 1, '2022-02-11 02:38:48', '2022-02-11 02:38:48'),
(124, NULL, 581, 'Shuffle Board', 'test', NULL, '4 Players', 1, '2022-02-11 02:38:57', '2022-02-11 02:38:57'),
(125, NULL, 581, 'Arcade', 'test', NULL, '4 Players', 1, '2022-02-11 02:40:29', '2022-02-11 02:40:29'),
(126, NULL, 576, 'Darts', 'test', NULL, '4 Players', 1, '2022-02-11 02:42:01', '2022-02-11 02:42:01'),
(127, NULL, 576, 'Trivia', 'test', NULL, '4 Players', 1, '2022-02-11 02:42:58', '2022-02-11 02:42:58'),
(128, NULL, 576, 'Shuffle Board', 'test', NULL, '4 Players', 1, '2022-02-11 02:43:07', '2022-02-11 02:43:07'),
(129, NULL, 576, 'Beer Pong', 'test', NULL, '4 Players', 1, '2022-02-11 02:44:38', '2022-02-11 02:44:38'),
(130, NULL, 576, 'Billiards', 'test', NULL, '4 Players', 1, '2022-02-11 02:44:47', '2022-02-11 02:44:47'),
(131, NULL, 576, 'Arcade', 'test', NULL, '4 Players', 1, '2022-02-11 02:45:42', '2022-02-11 02:45:42'),
(132, NULL, 578, 'Darts', 'test', NULL, '4 Players', 1, '2022-02-11 02:59:40', '2022-02-11 02:59:40'),
(133, NULL, 578, 'Trivia', 'test', NULL, '4 Players', 1, '2022-02-11 03:00:37', '2022-02-11 03:00:37'),
(134, NULL, 578, 'Shuffle Board', 'test', NULL, '4 Players', 1, '2022-02-11 03:00:48', '2022-02-11 03:00:48'),
(135, NULL, 578, 'Beer Pong', 'test', NULL, '4 Players', 1, '2022-02-11 03:01:00', '2022-02-11 03:01:00'),
(136, NULL, 578, 'Billiards', 'test', NULL, '4 Players', 1, '2022-02-11 03:01:09', '2022-02-11 03:01:09'),
(137, NULL, 578, 'Arcade', 'test', NULL, '4 Players', 1, '2022-02-11 03:01:21', '2022-02-11 03:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_menu`
--

CREATE TABLE `t_bar_menu` (
  `menu_id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `bar_id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_menu`
--

INSERT INTO `t_bar_menu` (`menu_id`, `url`, `bar_id`, `category_id`, `name`, `description`, `image`, `price`, `status`, `created_at`, `updated_at`) VALUES
(3, NULL, 2, 18, 'Demo 2', 'ddfdf', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/1f7a4ff68a3a232a2abb0811b6b98c27_barimage.png', 17, 1, '2020-08-29 20:33:12', '2020-12-05 14:56:41'),
(4, NULL, 2, 5, 'Wines', 'sample', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu3.jpg', 8, 1, '2020-09-28 15:45:40', '2020-12-18 11:56:19'),
(7, NULL, 2, 1, 'Gine Tonic', 'house liq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/1ccc9814f95f5ae6f57c1d19dccbbb07_barimage.png', 7, 1, '2020-09-28 15:46:07', '2021-05-22 07:42:31'),
(8, NULL, 2, 3, 'bacardi', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu6.jpg', 2, 1, '2020-11-24 13:16:53', '2020-11-24 13:16:53'),
(9, NULL, 2, 3, 'corona3', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/9992bb11c2cd1c40bf5c917546c055fd_barimage.png', 3, 1, '2020-11-24 13:16:53', '2021-07-19 12:39:56'),
(15, NULL, 2, 6, 'lemon soda', 'good', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/a6cb7abab08ce3dae4a98979e9796f82_barimage.png', 1, 1, '2020-11-24 19:33:12', '2020-11-27 17:06:05'),
(29, NULL, 2, 12, 'new drink', 'abc', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/2fef32b1d49d2b4d8b95326f89425140_barimage.png', 11, 1, '2020-11-26 13:53:14', '2020-12-21 18:59:55'),
(35, NULL, 2, 4, 'pasta', 'qqqqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/09dca80c87e776295da206d5468c6fd8_barimage.png', 8, 1, '2020-11-26 19:58:10', '2020-11-30 21:00:55'),
(39, NULL, 2, 15, 'Kingfisher', 'i am zmr', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/f02454a9050aea1fda1cb034d717be98_barimage.png', 4, 1, '2020-11-26 20:23:32', '2020-11-30 19:55:17'),
(40, NULL, 2, 3, 'Budwiser', 'qqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/ca5f9957510d87479637189605e629db_barimage.png', 5, 1, '2020-11-26 20:24:35', '2020-12-08 17:00:07'),
(41, NULL, 2, 15, 'Hunter', 'qqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/a2bfecfcd0f2e678ff00f4e7a060b432_barimage.png', 3, 1, '2020-11-26 20:24:48', '2020-11-26 20:24:48'),
(43, NULL, 2, 15, 'Beer Tower', 'eeeee', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/d209564cde164da1c9f27b532d1ebca4_barimage.png', 5, 1, '2020-11-26 21:30:52', '2020-11-27 11:53:12'),
(45, NULL, 2, 16, 'Spicy Chicken Pizza', 'tasty pizza', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/05581f044a2c15899d3da8658cf17539_barimage.png', 4, 1, '2020-11-27 11:41:46', '2020-11-27 15:53:35'),
(46, NULL, 2, 16, 'Giant  Pizza with Chicken', 'tasty pizza', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/a49296a898f12a20514236bb879627e2_barimage.png', 5, 1, '2020-11-27 11:42:25', '2020-11-27 16:48:58'),
(47, NULL, 2, 17, 'Fruit Beer', 'neat', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/3ea1c24205aa71bd2c8c73a6d14e7967_barimage.png', 7, 1, '2020-11-27 12:01:23', '2020-11-27 12:01:23'),
(48, NULL, 2, 17, 'Beera', 'neat', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/1bffbe04ab24b4dfa2d3f01a8de46acd_barimage.png', 2, 1, '2020-11-27 12:01:41', '2020-11-27 12:01:41'),
(53, NULL, 2, 6, 'Kinley', 'qqqqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/c45ace18c075af2f65f92530784775e5_barimage.png', 1, 1, '2020-11-27 12:29:11', '2020-11-27 17:06:47'),
(54, NULL, 2, 17, 'Cola', 'qqqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/2a8591e6031ed6521c94e33066759452_barimage.png', 1, 1, '2020-11-27 12:38:39', '2020-11-27 12:38:39'),
(56, NULL, 2, 10, 'Soup', 'qqqqqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/60a2fa37b8a41c02cf38cc35f12ce506_barimage.png', 6, 1, '2020-11-27 17:19:41', '2020-11-27 17:19:41'),
(61, NULL, 2, 17, 'Lemon Juice', 'its craving', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/d1acf1f6707ba757e2356c86aaf7b8e4_barimage.png', 2, 1, '2020-11-27 19:01:58', '2020-11-30 16:47:56'),
(65, NULL, 2, 1, 'Martini 2', 'good 1', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/67dd2ee16fa24888fd9978899fb414c3_barimage.png', 6, 1, '2020-11-30 16:58:58', '2020-12-21 14:52:20'),
(66, NULL, 2, 23, 'Burger King', 'delicious yummy', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/8520cf36c2c038acfe13e5f02bf73186_barimage.png', 7, 1, '2020-11-30 18:10:15', '2020-12-03 15:10:52'),
(68, NULL, 2, 23, 'Burger & Fries', 'qqqq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/28b93855cf74f9defe9900dd3aef2f8c_barimage.png', 8, 1, '2020-11-30 19:40:13', '2020-11-30 19:40:40'),
(79, NULL, 2, 13, 'qwerty', 'jhcjniinnnnnnnnijijikpplokoi', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/e1921662c7e13fb2705021a7f8a66681_barimage.png', 9, 1, '2020-12-05 11:26:47', '2020-12-07 13:21:46'),
(82, NULL, 2, 5, 'menu 3', '222222', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/25832b66b386c6f3d2792f4453bb4417_barimage.png', 17, 1, '2020-12-05 14:24:09', '2020-12-23 18:32:54'),
(94, NULL, 2, 20, 'qwqwerer', 'regrgeg', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/d53e90adb954a4225433d092b9f8c6cf_barimage.png', 9, 1, '2020-12-09 18:35:19', '2020-12-09 18:35:19'),
(95, NULL, 2, 21, 'Test item 1', 'gg66vt6crctdcduc6f f', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/de3d6a14843d72dc7ec237a1e9ca9a77_barimage.png', 40, 1, '2020-12-10 16:16:48', '2020-12-14 16:08:45'),
(96, NULL, 2, 14, 'Cold coffee', 'cold coffee, with kitket', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/d6ec86abe6b3d8c75a474aa1ddcd4a60_barimage.png', 11, 1, '2020-12-17 13:24:14', '2020-12-23 12:09:01'),
(97, NULL, 2, 6, 'cheese sandwitch', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/f8938edf99e299349535587bc954b687_barimage.png', 11, 1, '2020-12-17 13:31:45', '2020-12-17 13:31:45'),
(98, NULL, 2, 25, 'Hot coffee free', 'hot coffee', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/92e4cd3ee706e9114a94d7615959bdbe_barimage.png', 12, 1, '2020-12-17 13:39:24', '2020-12-17 13:41:37'),
(99, NULL, 2, 26, 'Cheese burger with sause', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/a90e457923e392f0547189a85edb0b02_barimage.png', 10, 1, '2020-12-17 13:40:47', '2020-12-17 13:40:47'),
(100, NULL, 2, 25, 'Cappuccino', 'Good', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/6c3d4929ae55bea404fc5af2bb8cfe86_barimage.png', 20, 1, '2020-12-17 15:52:00', '2020-12-17 15:56:08'),
(102, NULL, 2, 1, 'Martini 3', 'opopop', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/617c847b247ae7b123265c28717a74a3_barimage.png', 8, 1, '2020-12-22 13:42:00', '2020-12-24 18:30:35'),
(104, NULL, 2, 1, 'testserver', 'testserver', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/781b852392d3a6aa007672d0c2e211e0_barimage.png', 2, 1, '2020-12-24 17:34:18', '2020-12-24 17:34:18'),
(109, NULL, 2, 1, 'Drink 1234', '123', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/6e7f5e9cf7d00dedc838985371d507d7_barimage.png', 14, 1, '2021-01-06 17:54:26', '2021-01-06 17:54:47'),
(110, NULL, 3, 1, 'Vodka ', '123', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/6e7f5e9cf7d00dedc838985371d507d7_barimage.png', 14, 1, '2021-01-06 17:54:26', '2021-01-06 17:54:47'),
(111, NULL, 3, 4, 'Chicken Fry', '123', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/6e7f5e9cf7d00dedc838985371d507d7_barimage.png', 14, 1, '2021-01-06 17:54:26', '2021-01-06 17:54:47'),
(113, NULL, 3, 30, 'Chicken Fry', '123', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/6e7f5e9cf7d00dedc838985371d507d7_barimage.png', 14, 1, '2021-01-06 17:54:26', '2021-01-06 17:54:47'),
(114, NULL, 2, 15, 'coorslite', 'ice cold rocky mountain', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/069170885270f244c079ba69a780e636_barimage.png', 10, 1, '2021-04-18 02:35:49', '2021-04-18 02:35:49'),
(115, NULL, 2, 12, 'qwe', 'asdadsasd', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/7dd084025d1946efdbb9b7969d22d4d7_barimage.png', 10, 1, '2021-07-09 16:35:25', '2021-07-09 16:35:25'),
(116, NULL, 2, 32, 'Mojito', 'Mojito blue', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/1c4b2baad2148320c29b192b3ad2f76f_barimage.png', 10, 1, '2021-07-19 13:06:02', '2021-07-19 13:06:02'),
(119, NULL, 566, 34, 'Vodka', 'Russian Polar Bear vodka is a Russian product made with what they describe as the \"finest winter grain\" from Moldova and blended down with \"ancient glacier water.\"', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000438661c07b225ca33_barimage.jpeg', 10, 1, '2021-12-20 18:16:26', '2021-12-20 18:16:26'),
(121, NULL, 566, 33, 'Pizza', 'Pizza is a dish of Italian origin consisting of a usually round, flat base of leavened wheat-based dough topped with tomatoes, cheese, and often various other ingredients, which is then baked at a high', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000450561c07b9959e15_barimage.jpeg', 20, 1, '2021-12-20 18:18:25', '2021-12-20 18:18:25'),
(122, NULL, 566, 34, 'Russian bear', 'Russian Polar Bear vodka is a Russian product made with what they describe as the \"finest winter grain\" from Moldova and blended down with \"ancient glacier water.\"', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000466561c07c39e7eae_barimage.jpeg', 10, 1, '2021-12-20 18:21:05', '2021-12-20 18:21:05'),
(123, NULL, 566, 33, 'Homemade Pizza', 'Nothing beats a fresh-out-of-the-oven pizza, and once you see how easy it is to make for yourself, you\'ll never order delivery again. Switch up the toppings and add your favorites to make it your own. Pepperoni, mushrooms, bell peppers, pineapple? You can have it all! We can\'t get enough of Bacon Pickle Pizza, personally.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000475261c07c90c83cb_barimage.png', 5, 1, '2021-12-20 18:22:32', '2021-12-20 18:22:32'),
(125, NULL, 566, 35, 'Veg Sandwich', 'Whether you\'re looking for a grab-and-go lunch or a light supper, Sagar Gaire Fast Food Corner (Cycle Soupwala) Vegetarian Sandwiches offer a quick-and-easy solution with endless variations and flavors.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000495961c07d5fceddc_barimage.png', 10, 1, '2021-12-20 18:25:59', '2021-12-20 18:25:59'),
(126, NULL, 566, 35, 'Veg Grilled Sandwich', 'asdasdasdasdasdasdasd', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000500861c07d904ea62_barimage.png', 14, 1, '2021-12-20 18:26:48', '2021-12-20 18:26:48'),
(127, NULL, 566, 36, 'world bottled beer', 'Buy World Bottled Beers: 50 Classic Brews to Sip and Savour Book Online at Low Prices in India.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000516761c07e2fbe000_barimage.jpeg', 20, 1, '2021-12-20 18:29:27', '2021-12-20 18:29:27'),
(137, NULL, 572, 41, 'gthyfghj', 'ghjghjghj', 'http://18.116.154.137/public/Uploads/barmenu/b40a77ed1e44d006798aba3491922c0a_barimage.png', 13, 1, '2021-12-29 19:43:09', '2021-12-29 19:43:09'),
(138, NULL, 572, 39, 'gjgujgju', 'hjghjgj', 'http://18.116.154.137/public/Uploads/barmenu/17c920cfd8aeeb29328113c8cd99a3fa_barimage.png', 10, 1, '2021-12-29 19:43:34', '2021-12-29 19:43:34'),
(139, NULL, 572, 39, 'wisky', 'wisky with 3 cube', 'http://18.116.154.137/public/Uploads/barmenu/daa19857ff87f03af732225d3352c628_barimage.png', 12, 1, '2021-12-30 11:08:15', '2021-12-30 11:08:15'),
(140, NULL, 572, 41, 'wiskyfgd', 'fbfbf', 'http://18.116.154.137/public/Uploads/barmenu/f5ad9160e3a2f10d358c2831b00f7a53_barimage.png', 11, 1, '2021-12-30 11:11:49', '2021-12-30 11:11:49'),
(141, NULL, 572, 39, 'fhf', 'fgdfbhdf', 'http://18.116.154.137/public/Uploads/barmenu/d504ac8efaf66e418ce57f0945b6641a_barimage.png', 10, 1, '2021-12-30 11:12:07', '2021-12-30 11:12:07'),
(143, NULL, 572, 39, 'sdff', 'adsad', 'http://18.116.154.137/public/Uploads/barmenu/60c4296416eaa3e54e2a4df1661bd4e1_barimage.png', 10, 1, '2021-12-30 11:34:04', '2021-12-30 11:34:04'),
(144, NULL, 572, 38, 'pizza', 'efef', 'http://18.116.154.137/public/Uploads/barmenu/a9d8c63c2250f9cc753c329b18261452_barimage.png', 10, 1, '2021-12-30 12:43:49', '2021-12-30 12:43:49'),
(145, NULL, 572, 38, 'pasta', 'thtrh', 'http://18.116.154.137/public/Uploads/barmenu/6ae526eb468fe9f48f15d68fd4a4537b_barimage.png', 10, 1, '2021-12-30 12:44:05', '2021-12-30 12:44:05'),
(146, NULL, 572, 38, 'fbfhg', 'fghjfghngh', 'http://18.116.154.137/public/Uploads/barmenu/8530a107c6d85b0b5928bfb8a37853fc_barimage.png', 10, 1, '2021-12-30 12:44:21', '2021-12-30 12:44:21'),
(147, NULL, 572, 40, 'yjnghng', 'ngfhngn', 'http://18.116.154.137/public/Uploads/barmenu/a0d51446553370d7ae5a2be6336687a3_barimage.png', 10, 1, '2021-12-30 12:44:37', '2021-12-30 12:44:37'),
(148, NULL, 572, 38, 'mnghnm', 'hnfghng', 'http://18.116.154.137/public/Uploads/barmenu/d3204d2f5478696a8385c7ca905ffd87_barimage.png', 10, 1, '2021-12-30 12:44:51', '2021-12-30 12:44:51'),
(149, NULL, 572, 38, 'sendwitchvd', 'dvdvdfv', 'http://18.116.154.137/public/Uploads/barmenu/2f6289d0453ab57677132396d31f1f21_barimage.png', 10, 1, '2021-12-30 14:43:39', '2021-12-30 14:43:39'),
(151, NULL, 574, 43, 'kkkk', 'mmmm', 'http://18.116.154.137/public/Uploads/barmenu/52bc7b90193fc53f8fe9b06f353ab387_barimage.png', 14, 1, '2021-12-30 19:24:05', '2022-01-25 15:44:43'),
(152, NULL, 574, 43, 'vdvsdb', 'fbgjnfgn', 'http://18.116.154.137/public/Uploads/barmenu/2c9420ad0cfcb38e98f4fad5a77fb93f_barimage.png', 10, 1, '2021-12-30 19:24:15', '2021-12-30 19:24:15'),
(153, NULL, 574, 44, 'pasta', 'white sauce chips with chij garlic bread', 'http://18.116.154.137/public/Uploads/barmenu/5f47dc5c5401ecc04080d221a3b7bb23_barimage.png', 13, 1, '2022-01-03 11:27:02', '2022-01-03 11:27:02'),
(154, NULL, 574, 44, 'garlic bread toast', 'food', 'http://18.116.154.137/public/Uploads/barmenu/3444cd01f4b7a66ecd716b20252c6661_barimage.png', 10, 1, '2022-01-03 18:09:23', '2022-01-03 18:09:23'),
(155, NULL, 574, 43, 'coca', 'coca with three ice cubes', 'http://18.116.154.137/public/Uploads/barmenu/698126ed29e1d16df3a3173345e82026_barimage.png', 13, 1, '2022-01-04 10:50:28', '2022-01-04 10:50:28'),
(156, NULL, 574, 44, 'dgdg', 'xfbdfxbxd', 'http://18.116.154.137/public/Uploads/barmenu/4ed76b4d09234c6fb522eaff2d4e87ee_barimage.png', 12, 1, '2022-01-05 14:47:34', '2022-01-05 14:47:34'),
(157, NULL, 574, 43, 'reges', 'fersf', 'http://18.116.154.137/public/Uploads/barmenu/edbcce0f67e8d1bfb9ac771981866e82_barimage.png', 13, 1, '2022-01-05 14:52:18', '2022-01-05 14:52:18'),
(158, NULL, 574, 44, 'vbfdv', 'fvsdfbd', 'http://18.116.154.137/public/Uploads/barmenu/f0561e5e9bea299598d2bfc1552e9acf_barimage.png', 10, 1, '2022-01-05 16:24:25', '2022-01-05 16:24:25'),
(160, NULL, 574, 43, 'cdfvd', 'f vfdv', 'http://18.116.154.137/public/Uploads/barmenu/bd3d82ce4d6996fbd20dc10a2c208690_barimage.png', 12, 1, '2022-01-05 17:54:26', '2022-01-05 17:54:26'),
(163, NULL, 574, 52, 'g', 'vbb', 'http://18.116.154.137/public/Uploads/barmenu/2ccb9cd44334a7b4152d7483e0dc3866_barimage.png', 11, 1, '2022-01-25 19:11:12', '2022-01-25 19:11:12'),
(164, NULL, 574, 43, 'jamo', 'fdsa', 'http://18.116.154.137/public/Uploads/barmenu/7774e183cecb4e498c8207409ca741da_barimage.png', 11.25, 1, '2022-02-03 08:34:54', '2022-02-03 08:34:54'),
(165, NULL, 574, 44, 'ham', 'dsfsd', 'http://18.116.154.137/public/Uploads/barmenu/2882f312b1e5f4faf6024ef1205a99d8_barimage.png', 10, 1, '2022-02-03 08:37:04', '2022-02-03 08:37:04'),
(166, NULL, 576, 53, 'Long Island', 'Ice tea', 'http://18.116.154.137/public/Uploads/barmenu/4d29f1cbb1a15318d6733133b8026a7c_barimage.png', 10, 1, '2022-02-06 23:16:09', '2022-02-06 23:16:09'),
(167, NULL, 576, 54, 'Corona', 'Cold', 'http://18.116.154.137/public/Uploads/barmenu/52226970e094e588ac4d607603347970_barimage.png', 10, 1, '2022-02-06 23:17:11', '2022-02-06 23:17:11'),
(168, NULL, 576, 54, 'Coors lite', 'Cold', 'http://18.116.154.137/public/Uploads/barmenu/571874a72c76e0ca975bb6347d5747ef_barimage.png', 10, 1, '2022-02-06 23:17:32', '2022-02-06 23:17:32'),
(169, NULL, 576, 55, 'Pepsi', 'Cold', 'http://18.116.154.137/public/Uploads/barmenu/725c847a1fce749ef778f5dd25d86074_barimage.png', 4, 1, '2022-02-06 23:18:09', '2022-02-06 23:18:09'),
(170, NULL, 576, 55, 'Sprite', 'Cold', 'http://18.116.154.137/public/Uploads/barmenu/436c28170759f35ca25fd4d25d0c67bb_barimage.png', 5, 1, '2022-02-06 23:18:27', '2022-02-06 23:18:27'),
(171, NULL, 576, 53, 'Mojito', 'Cold', 'http://18.116.154.137/public/Uploads/barmenu/5979e6731772ee7bf38d280f06e54946_barimage.png', 10, 1, '2022-02-06 23:18:56', '2022-02-06 23:18:56'),
(172, NULL, 579, 59, 'Mojito', 'cold', 'http://18.116.154.137/public/Uploads/barmenu/5de2e968d67ba7341d0745dcf5dae48d_barimage.png', 10, 1, '2022-02-08 16:07:33', '2022-02-08 16:07:33'),
(173, NULL, 579, 59, 'Old Fashion', 'l', 'http://18.116.154.137/public/Uploads/barmenu/672c6f240080138688ec975ada7fe124_barimage.png', 10, 1, '2022-02-08 16:10:57', '2022-02-08 16:10:57'),
(174, NULL, 579, 59, 'Sidecar', 'o', 'http://18.116.154.137/public/Uploads/barmenu/1e142497948233f93efa37560202539d_barimage.png', 10, 1, '2022-02-08 16:12:25', '2022-02-08 16:12:25'),
(175, NULL, 579, 59, 'Mai Tai', 'o', 'http://18.116.154.137/public/Uploads/barmenu/f7db2dd4877152fa9e157a8f1111ffcc_barimage.png', 10, 1, '2022-02-08 16:12:46', '2022-02-08 16:12:46'),
(176, NULL, 579, 59, 'Bloody Mary', '0', 'http://18.116.154.137/public/Uploads/barmenu/7cb635052c4db64007a9279c2a99154e_barimage.png', 10, 1, '2022-02-08 16:13:06', '2022-02-08 16:13:06'),
(177, NULL, 579, 59, 'Tom Collins', '0', 'http://18.116.154.137/public/Uploads/barmenu/2090ff8398f6fa7420ecc4e282dbecd8_barimage.png', 10, 1, '2022-02-08 16:13:50', '2022-02-08 16:22:03'),
(178, NULL, 579, 56, 'Corona', '0', 'http://18.116.154.137/public/Uploads/barmenu/d7ea9f08bd3f2a6f6516873c8cf10142_barimage.png', 10, 1, '2022-02-08 21:19:01', '2022-02-08 21:19:01'),
(179, NULL, 579, 56, 'Budweiser', '0', 'http://18.116.154.137/public/Uploads/barmenu/d9e7d91f9df8d33bc50beab34f6bb8b0_barimage.png', 10, 1, '2022-02-08 21:20:03', '2022-02-08 21:20:03'),
(180, NULL, 579, 56, 'Heineken', '0', 'http://18.116.154.137/public/Uploads/barmenu/a4a3b1c06a4a832f5f73a5a4d7484f3e_barimage.png', 10, 1, '2022-02-08 21:20:30', '2022-02-08 21:20:30'),
(181, NULL, 579, 56, 'Bud Light', '0', 'http://18.116.154.137/public/Uploads/barmenu/92eeeb46f2ebf69ca530a07e1641f6fe_barimage.png', 10, 1, '2022-02-08 21:20:53', '2022-02-08 21:20:53'),
(182, NULL, 579, 56, 'Stella Artois', '0', 'http://18.116.154.137/public/Uploads/barmenu/119c123e71baf749f58419665cc3a2e5_barimage.png', 10, 1, '2022-02-08 21:21:33', '2022-02-08 21:21:33'),
(183, NULL, 579, 56, 'Guinness', '0', 'http://18.116.154.137/public/Uploads/barmenu/2bad7bc7afcc1dfea236fc111ef51f66_barimage.png', 10, 1, '2022-02-08 21:22:48', '2022-02-08 21:22:48'),
(184, NULL, 579, 56, 'Miller Lite', '0', 'http://18.116.154.137/public/Uploads/barmenu/1dafe994db94b3a5872d64d65051f89b_barimage.png', 10, 1, '2022-02-08 21:23:23', '2022-02-08 21:23:23'),
(185, NULL, 579, 56, 'Dos Equis', '0', 'http://18.116.154.137/public/Uploads/barmenu/05af9e9034f61f2c7e8a425724caddd4_barimage.png', 10, 1, '2022-02-08 21:24:38', '2022-02-08 21:24:38'),
(186, NULL, 579, 57, 'Hennessy + Red Bull', '0', 'http://18.116.154.137/public/Uploads/barmenu/a8526246b6cd43405cba132465261a05_barimage.png', 12, 1, '2022-02-08 21:26:38', '2022-02-08 21:26:38'),
(187, NULL, 579, 57, 'Hennessy + Hpnotiq', '0', 'http://18.116.154.137/public/Uploads/barmenu/f48be7b124b4b9e7e53a7ca8160acad8_barimage.png', 12, 1, '2022-02-08 21:28:43', '2022-02-08 21:30:33'),
(188, NULL, 579, 57, 'Hennessy + Tonic Water', '0', 'http://18.116.154.137/public/Uploads/barmenu/d999e0fec035121386b663470ff1e3e2_barimage.png', 12, 1, '2022-02-08 21:29:40', '2022-02-08 21:30:18'),
(189, NULL, 579, 57, 'Smirnoff + Orange Juice', '0', 'http://18.116.154.137/public/Uploads/barmenu/f20511383c6c468e292e909710e3d10d_barimage.png', 8, 1, '2022-02-08 21:36:20', '2022-02-08 21:36:20'),
(190, NULL, 579, 58, 'Pepsi', 'na', 'http://18.116.154.137/public/Uploads/barmenu/17f9407dea8978e18e2c537d5488c784_barimage.png', 4, 1, '2022-02-09 02:18:26', '2022-02-09 02:18:26'),
(191, NULL, 579, 58, 'Sprite', 'na', 'http://18.116.154.137/public/Uploads/barmenu/1b6284539c0009c2f011bd1dc2d7c93e_barimage.png', 4, 1, '2022-02-09 02:18:49', '2022-02-09 02:18:49'),
(192, NULL, 579, 58, 'Gingerale', 'na', 'http://18.116.154.137/public/Uploads/barmenu/192fdfb57a8d7d0b79c9780bcab6b5ee_barimage.png', 4, 1, '2022-02-09 02:21:56', '2022-02-09 20:33:48'),
(193, NULL, 576, 54, 'Bud light', 'na', 'http://18.116.154.137/public/Uploads/barmenu/e5461f3777c0530fd9225b1fba06ce0a_barimage.png', 10, 1, '2022-02-09 03:50:11', '2022-02-09 03:50:11'),
(194, NULL, 576, 54, 'Stella Artois', 'na', 'http://18.116.154.137/public/Uploads/barmenu/60965b1579b2ac0c155e9bddd1216b7a_barimage.png', 10, 1, '2022-02-09 03:50:37', '2022-02-09 03:50:37'),
(195, NULL, 576, 54, 'Modelo', 'na', 'http://18.116.154.137/public/Uploads/barmenu/6b7cf20479880dc72a517ae1021a7b3a_barimage.png', 10, 1, '2022-02-09 03:50:56', '2022-02-09 03:50:56'),
(196, NULL, 579, 59, 'Moscow Mule', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/5965acc41577c918d9c688bd44079a50_barimage.png', 10, 1, '2022-02-09 20:14:49', '2022-02-09 20:14:49'),
(197, NULL, 579, 59, 'Bellini', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/787ddbc16f60e92c6255011cad7917e1_barimage.png', 10, 1, '2022-02-09 20:15:11', '2022-02-09 20:15:11'),
(198, NULL, 579, 59, 'Classic Margarita', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/6ead91d2a621d674ab22c7eeafcd140a_barimage.png', 10, 1, '2022-02-09 20:15:41', '2022-02-09 20:15:41'),
(199, NULL, 579, 59, 'Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/1b9cd40df739726fb5825eaa02fdc165_barimage.png', 10, 1, '2022-02-09 20:16:19', '2022-02-09 20:16:19'),
(200, NULL, 579, 59, 'Mint Julep', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/406b071ad9a791172293b791a43603fa_barimage.png', 10, 1, '2022-02-09 20:16:46', '2022-02-09 20:16:46'),
(201, NULL, 579, 59, 'Negroni', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/50861dc9d6f2b4e5f8dd77f58fd02404_barimage.png', 10, 1, '2022-02-09 20:17:19', '2022-02-09 20:17:19'),
(202, NULL, 579, 59, 'Cosmopolitan', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/305c1bc2d6869dc71841c00fb6f2e2e4_barimage.png', 10, 1, '2022-02-09 20:18:01', '2022-02-09 20:18:01'),
(203, NULL, 579, 59, 'Hemingway Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/6ecb7d2b1921baf0700074f538c3f7c9_barimage.png', 10, 1, '2022-02-09 20:18:45', '2022-02-09 20:18:45'),
(204, NULL, 579, 59, 'Old Fashioned', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/3a7383fb2921939ff47f12d94d802636_barimage.png', 10, 1, '2022-02-09 20:19:11', '2022-02-09 20:19:11'),
(205, NULL, 579, 59, 'Cucumber Gin & Tonic', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/a6739337fcdfd8b28648111892f4e9ef_barimage.png', 10, 1, '2022-02-09 20:19:48', '2022-02-09 20:19:48'),
(206, NULL, 579, 58, 'Apple Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/f7153b19a04cb34c0689f560caee8655_barimage.png', 4, 1, '2022-02-09 20:21:21', '2022-02-09 20:21:51'),
(207, NULL, 579, 58, 'Cranberry Juice', 'Na', 'http://18.116.154.137/public/Uploads/barmenu/8a35c15f07ad44c2cda12945407f9167_barimage.png', 4, 1, '2022-02-09 20:29:30', '2022-02-09 20:29:30'),
(208, NULL, 579, 58, 'Milk Shake', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/e3d063203b446f34cc812f73e4c53a1e_barimage.png', 4, 1, '2022-02-09 20:32:18', '2022-02-09 20:32:18'),
(209, NULL, 579, 58, '7Up', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/4b8a4840ef1c931f40e5e0daaae02b8e_barimage.png', 4, 1, '2022-02-09 20:32:40', '2022-02-09 20:32:40'),
(210, NULL, 579, 58, 'Root Beer', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/082812cbde72a068a13e844de40f9013_barimage.png', 4, 1, '2022-02-09 20:33:21', '2022-02-09 20:33:21'),
(211, NULL, 579, 58, 'Grape Soda', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/2162cdbb1d5891938d0f08aa916e8508_barimage.png', 4, 1, '2022-02-09 20:34:30', '2022-02-09 20:34:30'),
(212, NULL, 579, 58, 'Mountain Dew', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/b176a0c856be0d29ae14ec98d9a97210_barimage.png', 4, 1, '2022-02-09 20:35:10', '2022-02-09 20:35:10'),
(213, NULL, 576, 66, 'Moscow Mule', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/027b8bc92b3a92d5329b820bc4d0b49d_barimage.png', 10, 1, '2022-02-09 21:34:28', '2022-02-09 21:34:28'),
(214, NULL, 576, 66, 'Bellini', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/13d0647c30e3de2e34235bced3acb056_barimage.png', 10, 1, '2022-02-09 21:34:51', '2022-02-09 21:34:51'),
(215, NULL, 576, 66, 'Classic Margarita', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/cdbe10364327deb7c832af5f9b7ef4b6_barimage.png', 10, 1, '2022-02-09 21:35:26', '2022-02-09 21:35:26'),
(216, NULL, 576, 66, 'Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/47ac8fecef610f84ed9bf5d2b3783cf6_barimage.png', 10, 1, '2022-02-09 21:35:55', '2022-02-09 21:35:55'),
(217, NULL, 576, 66, 'Mint Julep', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/d631bd463e10b44ac92fd2a7dec2d472_barimage.png', 10, 1, '2022-02-09 21:36:22', '2022-02-09 21:36:22'),
(218, NULL, 576, 66, 'Negroni', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/ac39a49812bc8e12a8b0cbf9b3435223_barimage.png', 10, 1, '2022-02-09 21:36:47', '2022-02-09 21:36:47'),
(219, NULL, 576, 66, 'Cosmopolitan', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/503d081ee74e3772ee6b00f5871f42b3_barimage.png', 10, 1, '2022-02-09 21:37:11', '2022-02-09 21:37:11'),
(220, NULL, 576, 66, 'Hemingway Diaquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/321e7c5392b8a95a7d6769eb49f67fae_barimage.png', 10, 1, '2022-02-09 21:52:36', '2022-02-09 21:52:36'),
(221, NULL, 576, 66, 'Old Fashioned', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/1bab76be01cdb6d9fe45c99dafa8cd1e_barimage.png', 10, 1, '2022-02-09 21:55:42', '2022-02-09 21:55:42'),
(222, NULL, 576, 66, 'Cucumber Gin & Tonic', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/89026ac4ac465a77a34e738343e3e896_barimage.png', 10, 1, '2022-02-09 21:56:06', '2022-02-09 21:56:06'),
(223, NULL, 576, 55, 'Apple Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/02dbba77c74b2a0fb79376cd46254ec6_barimage.png', 4, 1, '2022-02-09 22:04:00', '2022-02-09 22:04:00'),
(224, NULL, 576, 55, 'Cranberry Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/66ffd47bd15dd9adbccc070100905cbd_barimage.png', 4, 1, '2022-02-09 22:04:33', '2022-02-09 22:04:33'),
(225, NULL, 576, 55, 'Milk Shake', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/1230c90e0c8db6b25f16537d91430946_barimage.png', 4, 1, '2022-02-09 22:05:07', '2022-02-09 22:05:07'),
(226, NULL, 576, 55, '7Up', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/f938d50da9d4c56cdbd96eba6ce3b7d0_barimage.png', 4, 1, '2022-02-09 22:06:45', '2022-02-09 22:06:45'),
(227, NULL, 576, 55, 'Gingerale', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/3aec7e51fad431efb20b0340c5a3fdcc_barimage.png', 4, 1, '2022-02-09 22:07:33', '2022-02-09 22:07:33'),
(228, NULL, 576, 55, 'Root Bear', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/1ad9c989d04e0cbef9788d7229f30e41_barimage.png', 4, 1, '2022-02-09 22:07:55', '2022-02-09 22:07:55'),
(229, NULL, 576, 55, 'Grape Soda', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/fa008549bbbf868d30ad101c4272bc14_barimage.png', 4, 1, '2022-02-09 22:09:33', '2022-02-09 22:09:33'),
(230, NULL, 576, 55, 'Mountain Dew', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/5616133ef7f0c0eed159b777a325d891_barimage.png', 4, 1, '2022-02-09 22:10:41', '2022-02-09 22:10:41'),
(231, NULL, 577, 67, 'Moscow Mule', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/90999c1351b9fb7446c50e3949c53b3b_barimage.png', 10, 1, '2022-02-09 22:59:34', '2022-02-09 22:59:34'),
(232, NULL, 577, 67, 'Bellini', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/350e48e5c09ac4ef5b8e57f4b70553ab_barimage.png', 10, 1, '2022-02-09 22:59:59', '2022-02-09 22:59:59'),
(233, NULL, 577, 67, 'Classic Margarita', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/8918efd53d0665004c3182b1241b72f5_barimage.png', 10, 1, '2022-02-09 23:01:48', '2022-02-09 23:01:48'),
(234, NULL, 577, 67, 'Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/d27cbc77f89af08b28344154a38633df_barimage.png', 10, 1, '2022-02-09 23:03:22', '2022-02-09 23:03:22'),
(235, NULL, 577, 67, 'Mint Julep', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/bd52ed9b8e70fefdc2d3d34b55500194_barimage.png', 10, 1, '2022-02-09 23:03:41', '2022-02-09 23:03:41'),
(236, NULL, 577, 67, 'Negroni', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/b68408d062e8b7905d600c53952cc5d5_barimage.png', 10, 1, '2022-02-09 23:04:06', '2022-02-09 23:04:06'),
(237, NULL, 577, 67, 'Cosmopolitan', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/2d57f973580e0a27befb98550ee42b9d_barimage.png', 10, 1, '2022-02-09 23:04:31', '2022-02-09 23:04:31'),
(238, NULL, 577, 67, 'Hemingway Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/320244c68a4948fa970ee4fc578bb0ec_barimage.png', 10, 1, '2022-02-09 23:05:09', '2022-02-09 23:05:09'),
(239, NULL, 577, 67, 'Old Fashioned', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/2344dfc8652676697c6549b7ae955ecd_barimage.png', 10, 1, '2022-02-09 23:05:27', '2022-02-09 23:05:27'),
(240, NULL, 577, 67, 'Cucumber Gin & Tonic', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/de55e8ceee08063852080a503b4449e1_barimage.png', 10, 1, '2022-02-09 23:07:45', '2022-02-09 23:07:45'),
(241, NULL, 577, 68, 'Pepsi', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/e2a8726d1abbbaadcf4b7a1346000ba3_barimage.png', 4, 1, '2022-02-09 23:09:34', '2022-02-09 23:09:34'),
(242, NULL, 577, 68, 'Sprite', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/de9eff377f45bfba91835c156fa3068a_barimage.png', 4, 1, '2022-02-09 23:09:50', '2022-02-09 23:09:50'),
(243, NULL, 577, 68, 'Apple Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/7c5a0dbd0cabf801e013cca4c0269705_barimage.png', 4, 1, '2022-02-09 23:10:12', '2022-02-09 23:10:12'),
(244, NULL, 577, 68, 'Cranberry Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/7a8226eee9271264140e089dcbf2fdeb_barimage.png', 4, 1, '2022-02-09 23:10:35', '2022-02-09 23:10:35'),
(245, NULL, 577, 68, 'Milk Shake', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/00c20186be717aa858db08b31e2bd48b_barimage.png', 10, 1, '2022-02-09 23:24:34', '2022-02-09 23:24:34'),
(246, NULL, 577, 68, '7Up', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/eb6ccb66d01928f823b6d81cd9d4ec54_barimage.png', 10, 1, '2022-02-09 23:24:52', '2022-02-09 23:24:52'),
(247, NULL, 577, 68, 'Gingerale', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/0fda2c3260bdc61d2cb5730a24e05c5a_barimage.png', 10, 1, '2022-02-09 23:25:12', '2022-02-09 23:25:12'),
(248, NULL, 577, 68, 'Root Bear', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/cdd53808fbe4d3896d6a94a4c53fdd43_barimage.png', 10, 1, '2022-02-09 23:25:30', '2022-02-09 23:25:30'),
(249, NULL, 577, 68, 'Grape Soda', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/5696fded36bbab8ee6502a7816516680_barimage.png', 10, 1, '2022-02-09 23:26:30', '2022-02-09 23:26:30'),
(250, NULL, 577, 68, 'Mountain Dew', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/11bf94147f8e7a07263a4be13a6612b7_barimage.png', 10, 1, '2022-02-09 23:27:26', '2022-02-09 23:27:26'),
(251, NULL, 581, 69, 'Moscow Mule', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/23f0f6510bdcefddb74f0c80dd0bff8a_barimage.png', 10, 1, '2022-02-11 02:21:30', '2022-02-11 02:21:30'),
(252, NULL, 581, 69, 'Bellini', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/5bd4e38a7c05126b2b747d1f435fb485_barimage.png', 10, 1, '2022-02-11 02:21:49', '2022-02-11 02:21:49'),
(253, NULL, 581, 69, 'Classic Margarita', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/b172fc6b36e145fec2387b5b6b9d9cd9_barimage.png', 10, 1, '2022-02-11 02:22:20', '2022-02-11 02:22:20'),
(254, NULL, 581, 69, 'Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/a74b7c0305951ed89bf0469241bc1096_barimage.png', 10, 1, '2022-02-11 02:22:48', '2022-02-11 02:22:48'),
(255, NULL, 581, 69, 'Mint Julep', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/7ef516aeac890c7937832fdcf9b03113_barimage.png', 10, 1, '2022-02-11 02:23:04', '2022-02-11 02:23:04'),
(256, NULL, 581, 69, 'Negroni', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/12db151d81f59e9433cd732ebd01c9dd_barimage.png', 10, 1, '2022-02-11 02:23:18', '2022-02-11 02:23:18'),
(257, NULL, 581, 69, 'Cosmopolitan', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/4622efff7c2d86bd4fb51c0ed49e42f9_barimage.png', 10, 1, '2022-02-11 02:23:38', '2022-02-11 02:23:38'),
(258, NULL, 581, 69, 'Hemingway Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/6222cd4ad6ad491ce9e787da07f3aa16_barimage.png', 10, 1, '2022-02-11 02:23:54', '2022-02-11 02:23:54'),
(259, NULL, 581, 69, 'Old Fashioned', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/66f573d7d1347548baa579455b54595b_barimage.png', 10, 1, '2022-02-11 02:24:12', '2022-02-11 02:24:12'),
(260, NULL, 581, 69, 'Cucumber Gin & Tonic', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/42368c8c1949da872fd8f3b413c94e1c_barimage.png', 10, 1, '2022-02-11 02:24:35', '2022-02-11 02:24:35'),
(261, NULL, 581, 70, 'Pepsi', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/d26d62c78982578f2a1396524c7cb0ec_barimage.png', 4, 1, '2022-02-11 02:25:38', '2022-02-11 02:25:38'),
(262, NULL, 581, 70, 'Sprite', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/88fa6e92be8c8c840cd3d56cedfa6da8_barimage.png', 4, 1, '2022-02-11 02:25:54', '2022-02-11 02:25:54'),
(263, NULL, 581, 70, 'Gingerale', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/9582f6d7e46488dcd6fb28662ba3de88_barimage.png', 4, 1, '2022-02-11 02:26:15', '2022-02-11 02:26:15'),
(264, NULL, 581, 70, 'Apple Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/7ba8e0a7ec84580005ee37d62e89ecbf_barimage.png', 4, 1, '2022-02-11 02:26:37', '2022-02-11 02:26:37'),
(265, NULL, 581, 70, 'Cranberry Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/c496b66b5516cc6ff23fd3c795a7c96e_barimage.png', 4, 1, '2022-02-11 02:26:49', '2022-02-11 02:26:49'),
(266, NULL, 581, 70, 'Milk Shake', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/f778d9e6ca3f365339ede15eb320503d_barimage.png', 4, 1, '2022-02-11 02:27:06', '2022-02-11 02:27:06'),
(267, NULL, 581, 70, '7Up', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/2221e7d1d081345a15facdb74e200b26_barimage.png', 4, 1, '2022-02-11 02:28:52', '2022-02-11 02:28:52'),
(268, NULL, 581, 70, 'Root Bear', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/b0519f0b5b10ee2145b4ffa519205103_barimage.png', 4, 1, '2022-02-11 02:29:06', '2022-02-11 02:29:06'),
(269, NULL, 581, 70, 'Grape Soda', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/dc5ad83d8e9cb83e42a34932066ce697_barimage.png', 4, 1, '2022-02-11 02:29:24', '2022-02-11 02:29:24'),
(270, NULL, 581, 70, 'Mountain Dew', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/fc4617f439f80f5c1a47875d7d0724a7_barimage.png', 4, 1, '2022-02-11 02:29:46', '2022-02-11 02:29:46'),
(271, NULL, 578, 71, 'Moscow Mule', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/0a83a346297560ee18103cb32aa18eca_barimage.png', 10, 1, '2022-02-11 02:47:22', '2022-02-11 02:47:22'),
(272, NULL, 578, 71, 'Bellini', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/a9e47aa182d76d47a79fcabb73a00c43_barimage.png', 10, 1, '2022-02-11 02:47:41', '2022-02-11 02:47:41'),
(273, NULL, 578, 71, 'Classic Margarita', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/83cf186af736658b238afd6b4317ab39_barimage.png', 10, 1, '2022-02-11 02:48:06', '2022-02-11 02:48:06'),
(274, NULL, 578, 71, 'Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/07d245386d91a7b8374dcdc6982a4cc9_barimage.png', 10, 1, '2022-02-11 02:48:24', '2022-02-11 02:48:24'),
(275, NULL, 578, 71, 'Mint Julep', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/6be3d010c8eb7bd687e7141440330595_barimage.png', 10, 1, '2022-02-11 02:48:45', '2022-02-11 02:48:45'),
(276, NULL, 578, 71, 'Negroni', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/706c31a88db3e58940ee692668165d3b_barimage.png', 10, 1, '2022-02-11 02:49:09', '2022-02-11 02:49:09'),
(277, NULL, 578, 71, 'Cosmopolitan', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/4f56657d67ae93b5f942ddb2575e1790_barimage.png', 10, 1, '2022-02-11 02:49:26', '2022-02-11 02:49:26'),
(278, NULL, 578, 71, 'Hemingway Daiquiri', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/e163ce5773fa2050902252e453fc347f_barimage.png', 10, 1, '2022-02-11 02:49:42', '2022-02-11 02:49:42'),
(279, NULL, 578, 71, 'Old Fashioned', 'N.a', 'http://18.116.154.137/public/Uploads/barmenu/c4173012338b5d10a7b6a13d3697b825_barimage.png', 10, 1, '2022-02-11 02:49:54', '2022-02-11 02:49:54'),
(280, NULL, 578, 71, 'Cucumber Gin & Tonic', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/c8290a8b21ebc916eaadeb398f9449dc_barimage.png', 10, 1, '2022-02-11 02:50:08', '2022-02-11 02:50:08'),
(281, NULL, 578, 72, 'Pepsi', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/76fc6a24fd5fcd84c60cc797c2362923_barimage.png', 4, 1, '2022-02-11 02:52:24', '2022-02-11 02:52:24'),
(282, NULL, 578, 72, 'Sprite', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/dc33d48d6dd2005d89f231772c3bba3c_barimage.png', 4, 1, '2022-02-11 02:52:44', '2022-02-11 02:52:44'),
(283, NULL, 578, 72, 'Gingerale', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/280ad4dd95942266baee0c99c2dfba86_barimage.png', 4, 1, '2022-02-11 02:55:55', '2022-02-11 02:55:55'),
(284, NULL, 578, 72, 'Apple Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/d11ea2215f6b56d60660f5df955e8270_barimage.png', 4, 1, '2022-02-11 02:56:42', '2022-02-11 02:56:42'),
(285, NULL, 578, 72, 'Cranberry Juice', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/8e53630b709393214d6583fc49655847_barimage.png', 4, 1, '2022-02-11 02:57:07', '2022-02-11 02:57:07'),
(286, NULL, 578, 72, 'Milk Shake', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/7df379271e1efdfd5638e36f41e5f2aa_barimage.png', 4, 1, '2022-02-11 02:57:34', '2022-02-11 02:57:34'),
(287, NULL, 578, 72, '7Up', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/e342d0d260957cc05a372951c47678c6_barimage.png', 4, 1, '2022-02-11 02:58:00', '2022-02-11 02:58:00'),
(288, NULL, 578, 72, 'Root Bear', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/39b0cf9b03bd2a018b01cd764ea6977f_barimage.png', 4, 1, '2022-02-11 02:58:42', '2022-02-11 02:58:42'),
(289, NULL, 578, 72, 'Grape Soda', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/ff0707d7bde303f2ddd65a8e977544e7_barimage.png', 4, 1, '2022-02-11 02:59:00', '2022-02-11 02:59:00'),
(290, NULL, 578, 72, 'Mountain Dew', 'N/a', 'http://18.116.154.137/public/Uploads/barmenu/7c3048851118ac3f47d506ddc2031d95_barimage.png', 4, 1, '2022-02-11 02:59:18', '2022-02-11 02:59:18'),
(291, NULL, 579, 56, 'dulce', 'jnh', 'http://18.116.154.137/public/Uploads/barmenu/eb4ef706ef6a8e60c4f9ea9fe08b4b98_barimage.png', 10.25, 1, '2022-02-15 21:39:18', '2022-02-15 21:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_menu_category`
--

CREATE TABLE `t_bar_menu_category` (
  `id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `bar_id` int NOT NULL,
  `menu_type` enum('food','drink') NOT NULL DEFAULT 'food' COMMENT 'food,drink',
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_menu_category`
--

INSERT INTO `t_bar_menu_category` (`id`, `url`, `bar_id`, `menu_type`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, '', 2, 'drink', 'Lqu3', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-26 17:19:32', '2020-12-24 17:23:22'),
(3, '', 2, 'food', 'Beer', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-26 14:15:25', '2020-08-26 14:15:25'),
(4, '', 2, 'food', 'Mixed Drinks', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-29 20:32:31', '2020-08-29 20:32:31'),
(5, '', 2, 'food', 'Food', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-29 20:32:31', '2020-08-29 20:32:31'),
(6, '', 2, 'food', 'Soda', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-29 20:32:31', '2020-08-29 20:32:31'),
(7, '', 2, 'food', 'ww', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/1c9c105b2b59c8d1a8b718bf3c38f059_barimage.png', 1, '2020-11-25 15:14:37', '2020-11-25 15:14:37'),
(8, '', 2, 'food', 'Lq', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/ab9391ff389c96293701fabb54dd0b39_barimage.png', 1, '2020-11-25 15:15:20', '2020-11-25 15:15:20'),
(9, '', 2, 'food', 'Lqu', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/60f0094fe426fb11c671baaa434ee59a_barimage.png', 1, '2020-11-25 15:17:40', '2020-11-25 15:17:40'),
(10, '', 2, 'food', 'Lqu1', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/67726bad38560a730f18527d40a9c6ce_barimage.png', 1, '2020-11-25 15:19:59', '2020-11-25 15:19:59'),
(11, '', 2, 'food', 'Lqu2', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/28d783187318acda6c371860c087f659_barimage.png', 1, '2020-11-25 15:23:31', '2020-11-25 15:23:31'),
(12, '', 2, 'drink', 'Lqu4', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/077416abf88d62bd7f2a79f3aa07ab77_barimage.png', 1, '2020-11-25 15:25:04', '2020-11-25 15:25:04'),
(13, '', 2, 'drink', 'sdsd', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/132f21b95da5a131df7279e2fa8dc1ba_barimage.png', 1, '2020-11-26 16:14:02', '2020-11-26 16:14:02'),
(14, '', 2, 'drink', 'test drink', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/69fe2b7eae6650c350276647ab7bb34a_barimage.png', 1, '2020-11-26 19:19:38', '2020-11-26 19:19:38'),
(15, '', 2, 'drink', 'Beer1', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/302000e7e564a5d7d38f6eda7e47f736_barimage.png', 1, '2020-11-26 20:22:49', '2020-11-26 20:22:49'),
(16, '', 2, 'food', 'Pizza', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/0e5f2220cb3f6e1a0324abebf81e5039_barimage.png', 1, '2020-11-27 11:37:18', '2020-11-27 11:37:18'),
(17, '', 2, 'drink', 'Non-alchoholic', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/f92e24bbfc096b6462b867daad4d5b9c_barimage.png', 1, '2020-11-27 12:00:12', '2020-11-27 12:00:12'),
(18, '', 2, 'drink', 'xzX', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/68add89c160686610b34aac0addfd461_barimage.png', 1, '2020-11-27 19:01:12', '2020-11-27 19:01:12'),
(19, '', 2, 'food', 'cxZXX', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/bc61ea96f825a9b6c49eba1b1115f512_barimage.png', 1, '2020-11-27 20:39:52', '2020-11-27 20:39:52'),
(20, '', 2, 'food', 'aaahhhhhhhhhhhh', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/0c615c4245ff823ecf1a28efcb0ecf39_barimage.png', 1, '2020-11-27 20:41:13', '2020-11-27 20:41:13'),
(21, '', 2, 'drink', 'new category', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/6ca4cb99c3640ec8252d585dbf743090_barimage.png', 1, '2020-11-30 17:34:32', '2020-11-30 17:34:32'),
(22, '', 2, 'drink', 'zczxczxczz', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164f8f7a02cbb0bb13a2dcc77d9de74e_barimage.png', 1, '2020-11-30 17:40:49', '2020-11-30 17:40:49'),
(23, '', 2, 'food', 'Junk Food', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/e9f89afb9aae59580def37a569dbf7aa_barimage.png', 1, '2020-11-30 17:44:13', '2020-11-30 17:44:13'),
(24, '', 2, 'drink', 'Special', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eceb07e406679fd2ef2822a44d049a50_barimage.png', 1, '2020-12-04 18:28:12', '2020-12-04 18:28:12'),
(25, '', 2, 'drink', 'Drink-coffee', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/f3ad8d2acf4c3795ae514842edd4afbb_barimage.png', 1, '2020-12-17 13:34:39', '2020-12-17 13:34:39'),
(26, '', 2, 'food', 'Cheese burger', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/cffccb800b8f13054c8400576466fe8e_barimage.png', 1, '2020-12-17 13:40:11', '2020-12-17 13:40:11'),
(27, '', 2, 'food', 'Love', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/57c3506706bd8c5c9d9ffa339a11da6b_barimage.png', 1, '2020-12-17 16:51:40', '2020-12-17 16:51:40'),
(29, '', 2, 'drink', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/3271ccb7adb2bd14a4af8bf0c3211c44_barimage.png', 1, '2020-12-24 17:24:50', '2020-12-24 17:29:25'),
(30, '', 3, 'food', 'Love', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/57c3506706bd8c5c9d9ffa339a11da6b_barimage.png', 1, '2020-12-17 16:51:40', '2020-12-17 16:51:40'),
(31, '', 3, 'drink', 'test', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/3271ccb7adb2bd14a4af8bf0c3211c44_barimage.png', 1, '2020-12-24 17:24:50', '2020-12-24 17:29:25'),
(32, '', 2, 'drink', 'New', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/8cf28aa196e3373332050e27be8536d8_barimage.png', 1, '2021-07-19 12:36:49', '2021-07-19 12:36:49'),
(33, '', 566, 'food', 'pizza', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000343261c07768ca4e0_barimage.jpeg', 1, '2021-12-20 18:00:32', '2021-12-20 18:00:32'),
(34, '', 566, 'drink', 'bear vadka', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000357161c077f389031_barimage.jpeg', 1, '2021-12-20 18:02:51', '2021-12-20 18:02:51'),
(35, '', 566, 'food', 'Sandwich', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000491661c07d342db65_barimage.png', 1, '2021-12-20 18:25:16', '2021-12-20 18:25:16'),
(36, '', 566, 'drink', 'Bear', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164000507461c07dd26adef_barimage.jpeg', 1, '2021-12-20 18:27:54', '2021-12-20 18:27:54'),
(37, NULL, 566, 'food', 'car', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/164018152561c32f15b11e1_barimage.jpeg', 1, '2021-12-22 19:28:46', '2021-12-22 19:28:46'),
(38, NULL, 572, 'food', 'pasta', 'http://18.116.154.137/public/Uploads/barcategory/c4e960b0d238c53b73e109e5d5d5c62c_barimage.png', 1, '2021-12-28 15:11:22', '2021-12-28 15:11:22'),
(39, NULL, 572, 'drink', 'bear', 'http://18.116.154.137/public/Uploads/barcategory/42032b098f175d606105e2e519ddd6fd_barimage.png', 1, '2021-12-28 15:12:28', '2021-12-28 15:12:28'),
(40, NULL, 572, 'food', 'rum', 'http://18.116.154.137/public/Uploads/barcategory/9a40464ccb2962235e9ef8c7115586b8_barimage.png', 1, '2021-12-29 15:58:57', '2021-12-29 15:58:57'),
(41, NULL, 572, 'drink', 'water', 'http://18.116.154.137/public/Uploads/barcategory/52e78fbc3cf693ccacca15ce995142bc_barimage.png', 1, '2021-12-29 16:03:00', '2021-12-29 16:03:00'),
(42, NULL, 572, 'food', 'startup', 'http://18.116.154.137/public/Uploads/barcategory/f46049e8164a6431f39041b1e0edcc49_barimage.png', 1, '2021-12-30 12:45:24', '2021-12-30 12:45:24'),
(43, NULL, 574, 'drink', 'wisky', 'http://18.116.154.137/public/Uploads/barcategory/895096ed0b7e8af97938c99e6c5cee1a_barimage.png', 1, '2021-12-30 19:23:42', '2021-12-30 19:23:42'),
(44, NULL, 574, 'food', 'startup', 'http://18.116.154.137/public/Uploads/barcategory/f4f1d1096a69d972709b50d3f66f984d_barimage.png', 1, '2022-01-03 11:26:08', '2022-01-03 11:26:08'),
(45, NULL, 574, 'drink', 'coca', 'http://18.116.154.137/public/Uploads/barcategory/258cf7c1acdab1a6fc49e15181916fca_barimage.png', 1, '2022-01-25 15:47:04', '2022-01-25 15:47:04'),
(46, NULL, 574, 'drink', 'happy', 'http://18.116.154.137/public/Uploads/barcategory/3ead5a421259859c177071e17d184c6a_barimage.png', 1, '2022-01-25 15:47:31', '2022-01-25 15:47:31'),
(47, NULL, 574, 'drink', 'df d c', 'http://18.116.154.137/public/Uploads/barcategory/88fbbd39e953d55daf1feb4ea13c8aa9_barimage.png', 1, '2022-01-25 15:47:42', '2022-01-25 15:47:42'),
(48, NULL, 574, 'drink', '100p', 'http://18.116.154.137/public/Uploads/barcategory/610c06e9051f88623e6d5d356e4af9d0_barimage.png', 1, '2022-01-25 15:52:55', '2022-01-25 15:52:55'),
(49, NULL, 574, 'drink', 'jhmhm', 'http://18.116.154.137/public/Uploads/barcategory/8e148a21373b116231defaad7e3e3f3d_barimage.png', 1, '2022-01-25 15:53:07', '2022-01-25 15:53:07'),
(50, NULL, 574, 'drink', 'slice', 'http://18.116.154.137/public/Uploads/barcategory/5744a5868cd8552396751e644f278c45_barimage.png', 1, '2022-01-25 15:53:25', '2022-01-25 15:53:25'),
(51, NULL, 574, 'drink', 'sprite', 'http://18.116.154.137/public/Uploads/barcategory/8dc4da5fdcf3ce046115f94a65a31150_barimage.png', 1, '2022-01-25 15:53:45', '2022-01-25 15:53:45'),
(52, NULL, 574, 'food', 'snacksssssssss', 'http://18.116.154.137/public/Uploads/barcategory/0c09d5026b0910a1b9ce1c15b057ee6e_barimage.png', 1, '2022-01-25 19:10:54', '2022-01-25 19:10:54'),
(53, NULL, 576, 'drink', 'Mixed', 'http://18.116.154.137/public/Uploads/barcategory/7ae5d6ad60eee11ba3ea4629ed65c8e8_barimage.png', 1, '2022-02-06 23:14:51', '2022-02-06 23:14:51'),
(54, NULL, 576, 'drink', 'Beer', 'http://18.116.154.137/public/Uploads/barcategory/46592cfe0ba39181a046306af61c3df6_barimage.png', 1, '2022-02-06 23:15:02', '2022-02-06 23:15:02'),
(55, NULL, 576, 'drink', 'Soda', 'http://18.116.154.137/public/Uploads/barcategory/4add89a7d15b80c322c82e2800cca255_barimage.png', 1, '2022-02-06 23:15:27', '2022-02-06 23:15:27'),
(56, NULL, 579, 'drink', 'Beer', 'http://18.116.154.137/public/Uploads/barcategory/b2fff8fa87c4aa03d8712f51562b5260_barimage.png', 1, '2022-02-08 16:02:10', '2022-02-08 16:02:10'),
(57, NULL, 579, 'drink', 'Mixed', 'http://18.116.154.137/public/Uploads/barcategory/9849b4f87b3e93d009f918496714340f_barimage.png', 1, '2022-02-08 16:03:21', '2022-02-08 16:03:21'),
(58, NULL, 579, 'drink', 'Non-Alcoholic', 'http://18.116.154.137/public/Uploads/barcategory/2dfdb7236ffbf936fc7810f93ca6ae6d_barimage.png', 1, '2022-02-08 16:04:37', '2022-02-08 16:04:37'),
(59, NULL, 579, 'drink', 'classic Coctail', 'http://18.116.154.137/public/Uploads/barcategory/aefe3f228d49619d26e82798a355b581_barimage.png', 1, '2022-02-08 16:06:30', '2022-02-08 16:06:30'),
(60, NULL, 579, 'food', 'Pasta', 'http://18.116.154.137/public/Uploads/barcategory/ab4e3cfb7590896768f523ff23891c47_barimage.png', 1, '2022-02-08 22:18:04', '2022-02-08 22:18:04'),
(61, NULL, 579, 'food', 'Sea food', 'http://18.116.154.137/public/Uploads/barcategory/71bdab053cd14f144af9fb4392dd713e_barimage.png', 1, '2022-02-08 22:18:23', '2022-02-08 22:18:23'),
(62, NULL, 579, 'food', 'Soup', 'http://18.116.154.137/public/Uploads/barcategory/ab297f13fd032315feef9a5a73e229b1_barimage.png', 1, '2022-02-08 22:18:44', '2022-02-08 22:18:44'),
(63, NULL, 579, 'food', 'Sides', 'http://18.116.154.137/public/Uploads/barcategory/97dbdd89b4e31628ff7911faeed9d018_barimage.png', 1, '2022-02-08 22:19:10', '2022-02-08 22:19:10'),
(64, NULL, 576, 'food', 'Pasta', 'http://18.116.154.137/public/Uploads/barcategory/7eef8446ad94fad7c611591403cbd7e2_barimage.png', 1, '2022-02-09 03:52:07', '2022-02-09 03:52:07'),
(65, NULL, 576, 'food', 'Soup', 'http://18.116.154.137/public/Uploads/barcategory/58bd72a3da62f280927fbf07834754e0_barimage.png', 1, '2022-02-09 03:52:19', '2022-02-09 03:52:19'),
(66, NULL, 576, 'drink', 'Classic Cocktails', 'http://18.116.154.137/public/Uploads/barcategory/e33f92b617cae35acb50b2f5f2c8473e_barimage.png', 1, '2022-02-09 03:54:03', '2022-02-09 03:54:03'),
(67, NULL, 577, 'drink', 'Classic Cocktails', 'http://18.116.154.137/public/Uploads/barcategory/e0a6e2633fdca5b77ac07f211a495d74_barimage.png', 1, '2022-02-09 22:58:12', '2022-02-09 22:58:12'),
(68, NULL, 577, 'drink', 'Non Alcoholic', 'http://18.116.154.137/public/Uploads/barcategory/70a719f3f5aa0e3b4bace40fe43265df_barimage.png', 1, '2022-02-09 23:08:38', '2022-02-09 23:08:38'),
(69, NULL, 581, 'drink', 'Classic Cocktails', 'http://18.116.154.137/public/Uploads/barcategory/ad36c5f3e4c8f0e5e74df56cbe5cafab_barimage.png', 1, '2022-02-11 02:20:50', '2022-02-11 02:20:50'),
(70, NULL, 581, 'drink', 'Non-Alcoholic', 'http://18.116.154.137/public/Uploads/barcategory/7c065f81227ba8532d5f60c0e234372c_barimage.png', 1, '2022-02-11 02:24:54', '2022-02-11 02:24:54'),
(71, NULL, 578, 'drink', 'Classic Cocktails', 'http://18.116.154.137/public/Uploads/barcategory/8d12a10f8ef3ad9d0209bfdf01a0aad2_barimage.png', 1, '2022-02-11 02:47:06', '2022-02-11 02:47:06'),
(72, NULL, 578, 'drink', 'Non-Alcoholic', 'http://18.116.154.137/public/Uploads/barcategory/d0171ddaff2591c5de7471a8a2b548df_barimage.png', 1, '2022-02-11 02:50:25', '2022-02-11 02:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_notification`
--

CREATE TABLE `t_bar_notification` (
  `id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `request_drink_id` int DEFAULT NULL,
  `bar_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `notification_type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `frined_request_id` int DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `accepte_by` varchar(255) DEFAULT NULL,
  `gift_sender_id` varchar(50) DEFAULT NULL,
  `game_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_notification`
--

INSERT INTO `t_bar_notification` (`id`, `url`, `title`, `request_drink_id`, `bar_id`, `event_id`, `notification_type`, `frined_request_id`, `user_id`, `description`, `accepte_by`, `gift_sender_id`, `game_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 16:08:36', '2021-02-03 16:08:36', NULL),
(2, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 16:08:36', '2021-02-03 16:08:36', NULL),
(3, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 16:11:12', '2021-02-03 16:11:12', NULL),
(4, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 16:11:12', '2021-02-03 16:11:12', NULL),
(5, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 16:14:40', '2021-02-03 16:14:40', NULL),
(6, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 16:14:41', '2021-02-03 16:14:41', NULL),
(7, NULL, 'event test', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Testing Notification', NULL, NULL, NULL, '2021-02-03 16:23:07', '2021-02-03 16:23:07', NULL),
(8, NULL, 'event test', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Testing Notification', NULL, NULL, NULL, '2021-02-03 16:23:08', '2021-02-03 16:23:08', NULL),
(9, NULL, 'Gift ', NULL, 3, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-03 20:53:56', '2021-02-03 20:53:56', NULL),
(10, NULL, 'Gift ', NULL, 3, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Vodka  at McSorley\'s', NULL, NULL, NULL, '2021-02-04 12:23:42', '2021-02-04 12:23:42', NULL),
(11, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 14:44:54', '2021-02-04 14:44:54', NULL),
(12, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 14:44:54', '2021-02-04 14:44:54', NULL),
(13, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 14:44:54', '2021-02-04 14:44:54', NULL),
(14, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 16:01:43', '2021-02-04 16:01:43', NULL),
(15, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 16:01:44', '2021-02-04 16:01:44', NULL),
(16, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 16:01:44', '2021-02-04 16:01:44', NULL),
(17, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:26:26', '2021-02-04 19:26:26', NULL),
(18, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:26:26', '2021-02-04 19:26:26', NULL),
(19, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:27:24', '2021-02-04 19:27:24', NULL),
(20, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:27:24', '2021-02-04 19:27:24', NULL),
(21, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:27:42', '2021-02-04 19:27:42', NULL),
(22, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:27:42', '2021-02-04 19:27:42', NULL),
(23, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:27:42', '2021-02-04 19:27:42', NULL),
(24, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:27:43', '2021-02-04 19:27:43', NULL),
(25, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:27:43', '2021-02-04 19:27:43', NULL),
(26, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:27:43', '2021-02-04 19:27:43', NULL),
(27, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:30:31', '2021-02-04 19:30:31', NULL),
(28, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:30:31', '2021-02-04 19:30:31', NULL),
(29, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:30:32', '2021-02-04 19:30:32', NULL),
(30, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:30:46', '2021-02-04 19:30:46', NULL),
(31, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:30:47', '2021-02-04 19:30:47', NULL),
(32, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:30:47', '2021-02-04 19:30:47', NULL),
(33, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:30:56', '2021-02-04 19:30:56', NULL),
(34, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:30:57', '2021-02-04 19:30:57', NULL),
(35, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:30:57', '2021-02-04 19:30:57', NULL),
(36, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:32:14', '2021-02-04 19:32:14', NULL),
(37, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:32:14', '2021-02-04 19:32:14', NULL),
(38, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:33:26', '2021-02-04 19:33:26', NULL),
(39, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:33:48', '2021-02-04 19:33:48', NULL),
(40, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:33:49', '2021-02-04 19:33:49', NULL),
(41, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:33:49', '2021-02-04 19:33:49', NULL),
(42, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:03', '2021-02-04 19:38:03', NULL),
(43, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:03', '2021-02-04 19:38:03', NULL),
(44, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:03', '2021-02-04 19:38:03', NULL),
(45, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:03', '2021-02-04 19:38:03', NULL),
(46, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:03', '2021-02-04 19:38:03', NULL),
(47, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:03', '2021-02-04 19:38:03', NULL),
(48, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:04', '2021-02-04 19:38:04', NULL),
(49, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:04', '2021-02-04 19:38:04', NULL),
(50, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:04', '2021-02-04 19:38:04', NULL),
(51, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:22', '2021-02-04 19:38:22', NULL),
(52, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:22', '2021-02-04 19:38:22', NULL),
(53, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:22', '2021-02-04 19:38:22', NULL),
(54, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:23', '2021-02-04 19:38:23', NULL),
(55, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:23', '2021-02-04 19:38:23', NULL),
(56, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:23', '2021-02-04 19:38:23', NULL),
(57, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:23', '2021-02-04 19:38:23', NULL),
(58, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:23', '2021-02-04 19:38:23', NULL),
(59, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:23', '2021-02-04 19:38:23', NULL),
(60, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:24', '2021-02-04 19:38:24', NULL),
(61, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:24', '2021-02-04 19:38:24', NULL),
(62, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:25', '2021-02-04 19:38:25', NULL),
(63, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:33', '2021-02-04 19:38:33', NULL),
(64, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:33', '2021-02-04 19:38:33', NULL),
(65, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:34', '2021-02-04 19:38:34', NULL),
(66, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(67, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(68, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(69, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(70, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(71, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(72, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:35', '2021-02-04 19:38:35', NULL),
(73, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:36', '2021-02-04 19:38:36', NULL),
(74, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:36', '2021-02-04 19:38:36', NULL),
(75, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:36', '2021-02-04 19:38:36', NULL),
(76, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:36', '2021-02-04 19:38:36', NULL),
(77, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:36', '2021-02-04 19:38:36', NULL),
(78, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:36', '2021-02-04 19:38:36', NULL),
(79, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:37', '2021-02-04 19:38:37', NULL),
(80, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:37', '2021-02-04 19:38:37', NULL),
(81, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:37', '2021-02-04 19:38:37', NULL),
(82, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:37', '2021-02-04 19:38:37', NULL),
(83, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:37', '2021-02-04 19:38:37', NULL),
(84, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:38:37', '2021-02-04 19:38:37', NULL),
(85, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:38:38', '2021-02-04 19:38:38', NULL),
(86, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:38:38', '2021-02-04 19:38:38', NULL),
(87, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:12', '2021-02-04 19:39:12', NULL),
(88, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:12', '2021-02-04 19:39:12', NULL),
(89, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:13', '2021-02-04 19:39:13', NULL),
(90, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:13', '2021-02-04 19:39:13', NULL),
(91, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:13', '2021-02-04 19:39:13', NULL),
(92, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(93, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(94, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(95, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(96, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(97, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(98, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:14', '2021-02-04 19:39:14', NULL),
(99, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:15', '2021-02-04 19:39:15', NULL),
(100, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:15', '2021-02-04 19:39:15', NULL),
(101, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:16', '2021-02-04 19:39:16', NULL),
(102, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:39:16', '2021-02-04 19:39:16', NULL),
(103, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:39:21', '2021-02-04 19:39:21', NULL),
(104, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:39:21', '2021-02-04 19:39:21', NULL),
(105, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:39:22', '2021-02-04 19:39:22', NULL),
(106, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:40:43', '2021-02-04 19:40:43', NULL),
(107, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:40:43', '2021-02-04 19:40:43', NULL),
(108, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:40:44', '2021-02-04 19:40:44', NULL),
(109, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:40:49', '2021-02-04 19:40:49', NULL),
(110, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:40:50', '2021-02-04 19:40:50', NULL),
(111, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:40:50', '2021-02-04 19:40:50', NULL),
(112, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:40:51', '2021-02-04 19:40:51', NULL),
(113, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:40:51', '2021-02-04 19:40:51', NULL),
(114, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:40:52', '2021-02-04 19:40:52', NULL),
(115, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:40:52', '2021-02-04 19:40:52', NULL),
(116, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:40:52', '2021-02-04 19:40:52', NULL),
(117, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:40:52', '2021-02-04 19:40:52', NULL),
(118, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:40:52', '2021-02-04 19:40:52', NULL),
(119, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:40:52', '2021-02-04 19:40:52', NULL),
(120, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:40:53', '2021-02-04 19:40:53', NULL),
(121, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:41:29', '2021-02-04 19:41:29', NULL),
(122, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:41:29', '2021-02-04 19:41:29', NULL),
(123, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:41:30', '2021-02-04 19:41:30', NULL),
(124, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:41:30', '2021-02-04 19:41:30', NULL),
(125, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:41:31', '2021-02-04 19:41:31', NULL),
(126, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:41:31', '2021-02-04 19:41:31', NULL),
(127, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:41:31', '2021-02-04 19:41:31', NULL),
(128, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:41:31', '2021-02-04 19:41:31', NULL),
(129, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:41:31', '2021-02-04 19:41:31', NULL),
(130, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:41:31', '2021-02-04 19:41:31', NULL),
(131, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:41:32', '2021-02-04 19:41:32', NULL),
(132, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:41:32', '2021-02-04 19:41:32', NULL),
(133, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:41:34', '2021-02-04 19:41:34', NULL),
(134, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:41:35', '2021-02-04 19:41:35', NULL),
(135, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:41:35', '2021-02-04 19:41:35', NULL),
(136, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:41:42', '2021-02-04 19:41:42', NULL),
(137, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:41:42', '2021-02-04 19:41:42', NULL),
(138, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:41:42', '2021-02-04 19:41:42', NULL),
(139, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 1', NULL, NULL, NULL, '2021-02-04 19:42:50', '2021-02-04 19:42:50', NULL),
(140, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 2', NULL, NULL, NULL, '2021-02-04 19:42:50', '2021-02-04 19:42:50', NULL),
(141, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test msg 3', NULL, NULL, NULL, '2021-02-04 19:42:50', '2021-02-04 19:42:50', NULL),
(142, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:02', '2021-02-04 19:44:02', NULL),
(143, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:02', '2021-02-04 19:44:02', NULL),
(144, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:02', '2021-02-04 19:44:02', NULL),
(145, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:02', '2021-02-04 19:44:02', NULL),
(146, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:03', '2021-02-04 19:44:03', NULL),
(147, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:03', '2021-02-04 19:44:03', NULL),
(148, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:04', '2021-02-04 19:44:04', NULL),
(149, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:04', '2021-02-04 19:44:04', NULL),
(150, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:04', '2021-02-04 19:44:04', NULL),
(151, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(152, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(153, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(154, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(155, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(156, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(157, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(158, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(159, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:05', '2021-02-04 19:44:05', NULL),
(160, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:06', '2021-02-04 19:44:06', NULL),
(161, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:06', '2021-02-04 19:44:06', NULL),
(162, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:07', '2021-02-04 19:44:07', NULL),
(163, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:07', '2021-02-04 19:44:07', NULL),
(164, NULL, 'Cano birthday', NULL, 2, 5, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:07', '2021-02-04 19:44:07', NULL),
(165, NULL, 'Event 250', NULL, 2, 6, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Next purchase,', NULL, NULL, NULL, '2021-02-04 19:44:08', '2021-02-04 19:44:08', NULL),
(166, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:52:40', '2021-02-04 19:52:40', NULL),
(167, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:52:40', '2021-02-04 19:52:40', NULL),
(168, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:52:40', '2021-02-04 19:52:40', NULL),
(169, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:52:41', '2021-02-04 19:52:41', NULL),
(170, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:54:35', '2021-02-04 19:54:35', NULL),
(171, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:54:36', '2021-02-04 19:54:36', NULL),
(172, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:54:36', '2021-02-04 19:54:36', NULL),
(173, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:54:36', '2021-02-04 19:54:36', NULL),
(174, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:55:18', '2021-02-04 19:55:18', NULL),
(175, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:56:00', '2021-02-04 19:56:00', NULL),
(176, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item,', NULL, NULL, NULL, '2021-02-04 19:56:00', '2021-02-04 19:56:00', NULL),
(177, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:48', '2021-02-04 20:32:48', NULL),
(178, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(179, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(180, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(181, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(182, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(183, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(184, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:49', '2021-02-04 20:32:49', NULL),
(185, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:50', '2021-02-04 20:32:50', NULL),
(186, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:50', '2021-02-04 20:32:50', NULL),
(187, NULL, 'Open Bar', NULL, 2, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:51', '2021-02-04 20:32:51', NULL),
(188, NULL, 'Diwali', NULL, 2, 4, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 20:32:51', '2021-02-04 20:32:51', NULL),
(189, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:40', '2021-02-04 21:06:40', NULL),
(190, NULL, 'Test', NULL, 2, 7, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:40', '2021-02-04 21:06:40', NULL),
(191, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:41', '2021-02-04 21:06:41', NULL),
(192, NULL, 'Test', NULL, 2, 7, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:41', '2021-02-04 21:06:41', NULL),
(193, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:41', '2021-02-04 21:06:41', NULL),
(194, NULL, 'Test', NULL, 2, 7, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:41', '2021-02-04 21:06:41', NULL),
(195, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:41', '2021-02-04 21:06:41', NULL),
(196, NULL, 'Test', NULL, 2, 7, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-04 21:06:42', '2021-02-04 21:06:42', NULL),
(197, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item', NULL, NULL, NULL, '2021-02-05 12:12:43', '2021-02-05 12:12:43', NULL),
(198, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item', NULL, NULL, NULL, '2021-02-05 12:12:43', '2021-02-05 12:12:43', NULL),
(199, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-05 12:35:30', '2021-02-05 12:35:30', NULL),
(200, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-05 12:35:30', '2021-02-05 12:35:30', NULL),
(201, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-05 12:35:30', '2021-02-05 12:35:30', NULL),
(202, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-05 12:35:31', '2021-02-05 12:35:31', NULL),
(203, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-05 12:56:38', '2021-02-05 12:56:38', NULL),
(204, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-02-05 12:56:39', '2021-02-05 12:56:39', NULL),
(205, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '13,$,off,Next purchase', NULL, NULL, NULL, '2021-02-05 13:37:35', '2021-02-05 13:37:35', NULL),
(206, NULL, 'Dart Challenge', NULL, 2, 2, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '13,$,off,Next purchase', NULL, NULL, NULL, '2021-02-05 13:37:35', '2021-02-05 13:37:35', NULL),
(207, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, '5561e975241669938ac63b0b1f8abe64', '10,$,off,One item', NULL, NULL, NULL, '2021-02-05 14:52:32', '2021-02-05 14:52:32', NULL),
(208, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,One item', NULL, NULL, NULL, '2021-02-05 14:52:32', '2021-02-05 14:52:32', NULL),
(209, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '10,$,off,One item', NULL, NULL, NULL, '2021-02-05 14:52:32', '2021-02-05 14:52:32', NULL),
(210, NULL, 'Happy Hours', NULL, 2, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', '10,$,off,One item', NULL, NULL, NULL, '2021-02-05 14:52:33', '2021-02-05 14:52:33', NULL),
(211, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-08 21:28:56', '2021-02-08 21:28:56', NULL),
(212, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-08 21:29:09', '2021-02-08 21:29:09', NULL),
(213, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-08 21:30:13', '2021-02-08 21:30:13', NULL),
(214, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-08 21:31:38', '2021-02-08 21:31:38', NULL),
(215, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Martini 2 at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-15 15:15:45', '2021-02-15 15:15:45', NULL),
(216, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', NULL, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-02-15 15:27:16', '2021-02-15 15:27:16', NULL),
(217, NULL, 'event test 1', NULL, 2, 1, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 1', NULL, NULL, NULL, '2021-02-24 17:07:55', '2021-02-24 17:07:55', NULL),
(218, NULL, 'event test 2', NULL, 2, 2, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 2', NULL, NULL, NULL, '2021-02-24 17:07:55', '2021-02-24 17:07:55', NULL),
(219, NULL, 'event test 3', NULL, 2, 3, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 3', NULL, NULL, NULL, '2021-02-24 17:07:55', '2021-02-24 17:07:55', NULL),
(221, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 5, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a friend request.', NULL, NULL, NULL, '2021-03-01 19:13:22', '2021-03-01 19:13:22', NULL),
(222, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 6, 'ae97274d50d1775c1b4089359644b503', 'Shree Canopus has sent you a friend request.', NULL, NULL, NULL, '2021-03-01 19:32:01', '2021-03-01 19:32:01', NULL),
(223, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 7, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Shree Canopus has sent you a friend request.', NULL, NULL, NULL, '2021-03-01 19:33:56', '2021-03-01 19:33:56', NULL),
(224, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 8, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Test Android12 has sent you a friend request.', NULL, NULL, NULL, '2021-03-02 20:55:01', '2021-03-02 20:55:01', NULL),
(225, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 9, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Nai has sent you a friend request.', NULL, NULL, NULL, '2021-03-07 00:39:35', '2021-03-07 00:39:35', NULL),
(226, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'ae97274d50d1775c1b4089359644b503', 'Shree Canopus has sent you a testserver at Sake Bar Satsko', NULL, NULL, NULL, '2021-03-17 16:30:26', '2021-03-17 16:30:26', NULL),
(227, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 10, 'd6530465201d4ab86f911671203cf466', 'Test Android12 has sent you a friend request.', NULL, NULL, NULL, '2021-03-17 19:21:27', '2021-03-17 19:21:27', NULL),
(228, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 11, 'b8245b00dca6d2a37f1b127383eab59f', 'Vanessa has sent you a friend request.', NULL, NULL, NULL, '2021-04-02 01:09:32', '2021-04-02 01:09:32', NULL),
(229, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'e540e075f31e9d979e985b8564322974', 'Vanessa has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-02 01:13:28', '2021-04-02 01:13:28', NULL),
(230, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'e540e075f31e9d979e985b8564322974', 'Nai has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-02 03:08:12', '2021-04-02 03:08:12', NULL),
(231, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'e540e075f31e9d979e985b8564322974', 'Nai has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-02 03:08:15', '2021-04-02 03:08:15', NULL),
(232, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Vanessa has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-05 19:25:20', '2021-04-05 19:25:20', NULL),
(233, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'e540e075f31e9d979e985b8564322974', 'Bar Connex has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-14 01:32:31', '2021-04-14 01:32:31', NULL),
(234, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'e540e075f31e9d979e985b8564322974', 'Bar Connex has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-14 01:32:32', '2021-04-14 01:32:32', NULL),
(235, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'e540e075f31e9d979e985b8564322974', 'Bar Connex has sent you a Burger & Fries at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-15 07:07:02', '2021-04-15 07:07:02', NULL),
(236, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '1d1ea9623dbcafd48a89f05e5a8a670a', 'Bar Connex has sent you a testserver at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-16 21:52:53', '2021-04-16 21:52:53', NULL),
(237, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '1d1ea9623dbcafd48a89f05e5a8a670a', 'Bar Connex has sent you a Budwiser at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-16 21:53:14', '2021-04-16 21:53:14', NULL),
(238, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '1d1ea9623dbcafd48a89f05e5a8a670a', 'Bar Connex has sent you a Budwiser at Sake Bar Satsko', NULL, NULL, NULL, '2021-04-16 21:53:17', '2021-04-16 21:53:17', NULL),
(239, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 12, 'ae97274d50d1775c1b4089359644b503', 'Shree Canopus has sent you a friend request.', NULL, NULL, NULL, '2021-05-06 18:50:18', '2021-05-06 18:50:18', NULL),
(240, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Shree Canopus has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-05-18 17:14:32', '2021-05-18 17:14:32', NULL),
(241, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Soup at Sake Bar Satsko', NULL, NULL, NULL, '2021-05-20 23:55:07', '2021-05-20 23:55:07', NULL),
(242, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 13, '1d1ea9623dbcafd48a89f05e5a8a670a', 'Nai has sent you a friend request.', NULL, NULL, NULL, '2021-05-26 07:00:45', '2021-05-26 07:00:45', NULL),
(243, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Corinne has sent you a testserver at Sake Bar Satsko', NULL, NULL, NULL, '2021-05-26 07:04:21', '2021-05-26 07:04:21', NULL),
(244, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Corinne has sent you a testserver at Sake Bar Satsko', NULL, NULL, NULL, '2021-05-26 07:04:22', '2021-05-26 07:04:22', NULL),
(245, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 14, '89bccbbe030f4a7d6644e3573125c96c', 'Ali has sent you a friend request.', NULL, NULL, NULL, '2021-06-02 02:58:17', '2021-06-02 02:58:17', NULL),
(246, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 15, '89bccbbe030f4a7d6644e3573125c96c', 'Ali tester has sent you a friend request.', NULL, NULL, NULL, '2021-06-02 03:03:25', '2021-06-02 03:03:25', NULL),
(247, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Burger King at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-02 07:21:42', '2021-06-02 07:21:42', NULL),
(248, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 16, '1d1ea9623dbcafd48a89f05e5a8a670a', 'Ali tester has sent you a friend request.', NULL, NULL, NULL, '2021-06-04 03:05:21', '2021-06-04 03:05:21', NULL),
(249, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 17, '3f1ce0faf37cc0273223ee3075640af1', 'Ali tester has sent you a friend request.', NULL, NULL, NULL, '2021-06-07 05:00:16', '2021-06-07 05:00:16', NULL),
(250, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 18, 'ae97274d50d1775c1b4089359644b503', 'aaditya jain has sent you a friend request.', NULL, NULL, NULL, '2021-06-15 20:01:24', '2021-06-15 20:01:24', NULL),
(251, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 19, 'd6530465201d4ab86f911671203cf466', 'aaditya jain has sent you a friend request.', NULL, NULL, NULL, '2021-06-17 13:35:57', '2021-06-17 13:35:57', NULL),
(252, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 20, 'd6530465201d4ab86f911671203cf466', 'aaditya has sent you a friend request.', NULL, NULL, NULL, '2021-06-17 14:13:32', '2021-06-17 14:13:32', NULL),
(253, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 21, 'dfe13424956effda6f2bc424df005397', 'aaditya jain has sent you a friend request.', NULL, NULL, NULL, '2021-06-17 17:42:39', '2021-06-17 17:42:39', NULL),
(254, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 22, 'dfe13424956effda6f2bc424df005397', 'aaditya has sent you a friend request.', NULL, NULL, NULL, '2021-06-18 18:30:10', '2021-06-18 18:30:10', NULL),
(255, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 23, '5561e975241669938ac63b0b1f8abe64', 'Test Android12 has sent you a friend request.', NULL, NULL, NULL, '2021-06-22 17:09:22', '2021-06-22 17:09:22', NULL),
(256, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 24, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'aaditya jain has sent you a friend request.', NULL, NULL, NULL, '2021-06-22 17:20:16', '2021-06-22 17:20:16', NULL),
(257, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 25, 'b8245b00dca6d2a37f1b127383eab59f', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-22 23:14:01', '2021-06-22 23:14:01', NULL),
(258, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 26, '8c1519ee4d3ab2f2ca0268b416165f76', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-22 23:14:23', '2021-06-22 23:14:23', NULL),
(259, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 27, '96992bb4290476b37a2f161dc259c8b2', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-22 23:14:45', '2021-06-22 23:14:45', NULL),
(260, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Drink 1234 at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-23 07:17:48', '2021-06-23 07:17:48', NULL),
(261, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 28, 'db787a8de3cc9a73d9b24fb8cbe6c209', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-23 15:57:28', '2021-06-23 15:57:28', NULL),
(262, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 29, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-23 15:58:11', '2021-06-23 15:58:11', NULL),
(263, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 30, '1d1ea9623dbcafd48a89f05e5a8a670a', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-23 15:58:54', '2021-06-23 15:58:54', NULL),
(264, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 31, 'b28bf5b1753a96abce3cd2bd6d853779', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-06-23 15:59:44', '2021-06-23 15:59:44', NULL);
INSERT INTO `t_bar_notification` (`id`, `url`, `title`, `request_drink_id`, `bar_id`, `event_id`, `notification_type`, `frined_request_id`, `user_id`, `description`, `accepte_by`, `gift_sender_id`, `game_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(265, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:48:16', '2021-06-30 00:48:16', NULL),
(266, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:48:16', '2021-06-30 00:48:16', NULL),
(267, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:48:16', '2021-06-30 00:48:16', NULL),
(268, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:48:58', '2021-06-30 00:48:58', NULL),
(269, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:49:01', '2021-06-30 00:49:01', NULL),
(270, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:49:28', '2021-06-30 00:49:28', NULL),
(271, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:49:43', '2021-06-30 00:49:43', NULL),
(272, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:49:43', '2021-06-30 00:49:43', NULL),
(273, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-06-30 00:49:46', '2021-06-30 00:49:46', NULL),
(274, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-01 14:33:11', '2021-07-01 14:33:11', NULL),
(275, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Martini 2 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-01 14:40:14', '2021-07-01 14:40:14', NULL),
(276, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-01 14:40:33', '2021-07-01 14:40:33', NULL),
(277, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a testserver at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-02 17:05:05', '2021-07-02 17:05:05', NULL),
(278, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Martini 2 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-03 16:39:58', '2021-07-03 16:39:58', NULL),
(279, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-03 16:40:31', '2021-07-03 16:40:31', NULL),
(280, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-03 16:40:44', '2021-07-03 16:40:44', NULL),
(281, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 12:44:58', '2021-07-05 12:44:58', NULL),
(282, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'dfe13424956effda6f2bc424df005397', 'Bittu has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:09:41', '2021-07-05 13:09:41', NULL),
(283, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'dfe13424956effda6f2bc424df005397', 'Bittu has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:22:02', '2021-07-05 13:22:02', NULL),
(284, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'dfe13424956effda6f2bc424df005397', 'Bittu has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:22:02', '2021-07-05 13:22:02', NULL),
(285, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'dfe13424956effda6f2bc424df005397', 'aaditya has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:33:34', '2021-07-05 13:33:34', NULL),
(286, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'd6530465201d4ab86f911671203cf466', 'Bittu has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:34:55', '2021-07-05 13:34:55', NULL),
(287, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'd6530465201d4ab86f911671203cf466', 'Bittu has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:35:58', '2021-07-05 13:35:58', NULL),
(288, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'd6530465201d4ab86f911671203cf466', 'Bittu has sent you a Martini 3 at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-05 13:35:58', '2021-07-05 13:35:58', NULL),
(289, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 32, '646a2c2e03321404e8a605d969788a06', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-07-07 14:52:15', '2021-07-07 14:52:15', NULL),
(290, NULL, 'Gift ', NULL, 2, NULL, 'gift_request', 0, 'b8245b00dca6d2a37f1b127383eab59f', 'Bar Connex has sent you a Gine Tonic at Sake Bar Satsko', NULL, NULL, NULL, '2021-07-14 01:08:40', '2021-07-14 01:08:40', NULL),
(291, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:28:04', '2021-07-21 17:28:04', NULL),
(292, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:28:05', '2021-07-21 17:28:05', NULL),
(293, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:28:05', '2021-07-21 17:28:05', NULL),
(294, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:28:07', '2021-07-21 17:28:07', NULL),
(295, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:28:07', '2021-07-21 17:28:07', NULL),
(296, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:28:09', '2021-07-21 17:28:09', NULL),
(297, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:28:09', '2021-07-21 17:28:09', NULL),
(298, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:28:09', '2021-07-21 17:28:09', NULL),
(299, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:28:10', '2021-07-21 17:28:10', NULL),
(300, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:28:50', '2021-07-21 17:28:50', NULL),
(301, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:28:50', '2021-07-21 17:28:50', NULL),
(302, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:28:51', '2021-07-21 17:28:51', NULL),
(303, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:28:52', '2021-07-21 17:28:52', NULL),
(304, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:24', '2021-07-21 17:30:24', NULL),
(305, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:30:25', '2021-07-21 17:30:25', NULL),
(306, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:30:25', '2021-07-21 17:30:25', NULL),
(307, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:26', '2021-07-21 17:30:26', NULL),
(308, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:30:26', '2021-07-21 17:30:26', NULL),
(309, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'ae97274d50d1775c1b4089359644b503', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:30:26', '2021-07-21 17:30:26', NULL),
(310, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:33', '2021-07-21 17:30:33', NULL),
(311, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:30:35', '2021-07-21 17:30:35', NULL),
(312, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:30:36', '2021-07-21 17:30:36', NULL),
(313, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '96992bb4290476b37a2f161dc259c8b2', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:37', '2021-07-21 17:30:37', NULL),
(314, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '96992bb4290476b37a2f161dc259c8b2', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:30:38', '2021-07-21 17:30:38', NULL),
(315, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '96992bb4290476b37a2f161dc259c8b2', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:30:40', '2021-07-21 17:30:40', NULL),
(316, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '96992bb4290476b37a2f161dc259c8b2', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:42', '2021-07-21 17:30:42', NULL),
(317, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '96992bb4290476b37a2f161dc259c8b2', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:30:42', '2021-07-21 17:30:42', NULL),
(318, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '96992bb4290476b37a2f161dc259c8b2', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:30:44', '2021-07-21 17:30:44', NULL),
(319, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:45', '2021-07-21 17:30:45', NULL),
(320, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:30:52', '2021-07-21 17:30:52', NULL),
(321, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:30:56', '2021-07-21 17:30:56', NULL),
(322, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:30:57', '2021-07-21 17:30:57', NULL),
(323, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:04', '2021-07-21 17:31:04', NULL),
(324, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'b8245b00dca6d2a37f1b127383eab59f', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:05', '2021-07-21 17:31:05', NULL),
(325, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:06', '2021-07-21 17:31:06', NULL),
(326, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:07', '2021-07-21 17:31:07', NULL),
(327, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'd6530465201d4ab86f911671203cf466', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:08', '2021-07-21 17:31:08', NULL),
(328, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:08', '2021-07-21 17:31:08', NULL),
(329, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:08', '2021-07-21 17:31:08', NULL),
(330, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:09', '2021-07-21 17:31:09', NULL),
(331, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:09', '2021-07-21 17:31:09', NULL),
(332, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:09', '2021-07-21 17:31:09', NULL),
(333, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:11', '2021-07-21 17:31:11', NULL),
(334, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:12', '2021-07-21 17:31:12', NULL),
(335, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:13', '2021-07-21 17:31:13', NULL),
(336, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:17', '2021-07-21 17:31:17', NULL),
(337, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:17', '2021-07-21 17:31:17', NULL),
(338, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:18', '2021-07-21 17:31:18', NULL),
(339, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:20', '2021-07-21 17:31:20', NULL),
(340, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:20', '2021-07-21 17:31:20', NULL),
(341, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:21', '2021-07-21 17:31:21', NULL),
(342, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '3f1ce0faf37cc0273223ee3075640af1', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:21', '2021-07-21 17:31:21', NULL),
(343, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:22', '2021-07-21 17:31:22', NULL),
(344, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:23', '2021-07-21 17:31:23', NULL),
(345, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '646a2c2e03321404e8a605d969788a06', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:23', '2021-07-21 17:31:23', NULL),
(346, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, 'dfe13424956effda6f2bc424df005397', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:31:23', '2021-07-21 17:31:23', NULL),
(347, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, 'dfe13424956effda6f2bc424df005397', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:31:24', '2021-07-21 17:31:24', NULL),
(348, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, 'dfe13424956effda6f2bc424df005397', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:31:24', '2021-07-21 17:31:24', NULL),
(349, NULL, 'event test 1', NULL, 566, 1, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 1', NULL, NULL, NULL, '2021-07-21 17:36:39', '2021-07-21 17:36:39', NULL),
(350, NULL, 'event test 2', NULL, 566, 2, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 2', NULL, NULL, NULL, '2021-07-21 17:36:40', '2021-07-21 17:36:40', NULL),
(351, NULL, 'event test 3', NULL, 566, 3, 'Event', NULL, '89bccbbe030f4a7d6644e3573125c96c', 'Test msg 3', NULL, NULL, NULL, '2021-07-21 17:36:42', '2021-07-21 17:36:42', NULL),
(352, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', NULL, 'b728489d78e11542c2fef872c72df11d', 'Abhishek Chandani has sent you a friend request.', NULL, NULL, NULL, '2021-08-09 13:41:34', '2021-08-09 13:41:34', NULL),
(354, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 45, '89c8977dfc5e7d75101aa66a41c39b2e', 'Bittu has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 15:11:09', '2021-12-20 15:11:09', NULL),
(355, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 46, '55f7d789affebb28dac7d173281e9765', 'User1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 15:45:28', '2021-12-20 15:45:28', NULL),
(356, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 47, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 16:19:13', '2021-12-20 16:19:31', '2021-12-20 10:49:31'),
(357, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 48, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 16:22:36', '2021-12-20 16:22:42', '2021-12-20 10:52:42'),
(358, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 49, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 16:26:32', '2021-12-20 16:27:16', '2021-12-20 10:57:16'),
(359, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 50, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 16:38:17', '2021-12-20 16:38:30', '2021-12-20 11:08:30'),
(360, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 16:38:31', '2021-12-20 16:38:31', NULL),
(361, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 51, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 16:54:13', '2021-12-20 16:56:44', '2021-12-20 11:26:44'),
(362, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 16:56:46', '2021-12-20 16:56:46', NULL),
(363, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 52, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:00:50', '2021-12-20 17:01:50', '2021-12-20 11:31:50'),
(364, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:01:50', '2021-12-20 17:01:50', NULL),
(365, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 53, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:02:24', '2021-12-20 17:02:54', '2021-12-20 11:32:54'),
(366, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:02:54', '2021-12-20 17:02:54', NULL),
(367, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:03:00', '2021-12-20 17:03:00', NULL),
(368, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:03:10', '2021-12-20 17:03:10', NULL),
(369, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:03:13', '2021-12-20 17:03:13', NULL),
(370, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:03:25', '2021-12-20 17:03:25', NULL),
(371, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:04:41', '2021-12-20 17:04:41', NULL),
(372, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 54, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:07:11', '2021-12-20 17:07:27', '2021-12-20 11:37:27'),
(373, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has Accepted your friend request.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-20 17:07:28', '2021-12-20 17:07:28', NULL),
(374, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 55, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:08:59', '2021-12-20 17:09:15', '2021-12-20 11:39:15'),
(375, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has Accepted your friend request.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-20 17:09:16', '2021-12-20 17:09:16', NULL),
(376, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 56, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:09:28', '2021-12-20 17:09:35', '2021-12-20 11:39:35'),
(377, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 57, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:09:43', '2021-12-20 17:09:49', '2021-12-20 11:39:49'),
(378, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 58, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a friend request.', NULL, NULL, NULL, '2021-12-20 17:10:16', '2021-12-20 17:10:24', '2021-12-20 11:40:24'),
(379, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-20 17:10:24', '2021-12-20 17:10:24', NULL),
(380, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 60, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:28:58', '2021-12-20 17:33:48', '2021-12-20 12:03:48'),
(381, NULL, 'user1 Invite you to play Game', NULL, 571, NULL, 'Game', 61, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:34:24', '2021-12-20 17:35:36', '2021-12-20 12:05:36'),
(382, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 62, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:35:54', '2021-12-20 17:36:19', '2021-12-20 12:06:19'),
(383, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 63, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:36:39', '2021-12-20 17:36:46', '2021-12-20 12:06:46'),
(384, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 64, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:37:02', '2021-12-20 17:37:13', '2021-12-20 12:07:13'),
(385, NULL, 'Game Request Accepted', NULL, NULL, NULL, 'Game', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has Accepted your game request.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, 87, '2021-12-20 17:37:13', '2021-12-20 17:37:13', NULL),
(386, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 65, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:37:27', '2021-12-20 17:38:01', '2021-12-20 12:08:01'),
(387, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 66, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-20 17:38:12', '2021-12-20 17:39:30', '2021-12-20 12:09:30'),
(388, NULL, 'Game Request Accepted', NULL, NULL, NULL, 'Game', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has Accepted your game request.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, 87, '2021-12-20 17:39:30', '2021-12-20 17:39:30', NULL),
(389, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 67, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play Trivia', NULL, NULL, 77, '2021-12-20 18:06:28', '2021-12-20 18:06:41', '2021-12-20 12:36:41'),
(390, NULL, 'Game Request Accepted', NULL, NULL, NULL, 'Game', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your game request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, 77, '2021-12-20 18:06:41', '2021-12-20 18:06:41', NULL),
(391, NULL, 'nitesh Invite you to play Game', NULL, 566, NULL, 'Game', 68, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2021-12-20 18:07:16', '2021-12-23 19:31:10', '2021-12-23 19:31:10'),
(392, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 69, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-23 19:31:10', '2021-12-23 19:33:39', '2021-12-23 19:33:39'),
(393, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 70, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-23 19:33:39', '2021-12-27 14:57:05', '2021-12-27 14:57:05'),
(394, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 71, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-27 14:57:05', '2021-12-27 15:01:02', '2021-12-27 15:01:02'),
(395, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 72, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-27 15:01:02', '2021-12-27 15:02:08', '2021-12-27 15:02:08'),
(396, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 73, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play Never I Have Ever', NULL, NULL, 87, '2021-12-27 15:02:08', '2021-12-27 15:04:29', '2021-12-27 15:04:29'),
(397, NULL, 'nitesh Invite you to play Game', NULL, 566, NULL, 'Game', 74, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2021-12-27 15:04:29', '2021-12-27 15:05:13', '2021-12-27 15:05:13'),
(398, NULL, 'nitesh Invite you to play Game', NULL, 566, NULL, 'Game', 75, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2021-12-27 15:05:13', '2021-12-29 12:12:49', '2021-12-29 12:12:49'),
(399, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-27 15:46:36', '2021-12-27 15:46:36', NULL),
(400, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-27 15:49:08', '2021-12-27 15:49:08', NULL),
(401, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has Accepted your friend request.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-27 16:25:29', '2021-12-27 16:25:29', NULL),
(405, NULL, 'Request for a drink', 70, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh Request for a drink', NULL, NULL, NULL, '2021-12-27 17:37:37', '2021-12-29 14:32:28', '2021-12-29 14:32:28'),
(406, NULL, 'Request for a drink', 71, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh is asking for drink. Prashant What drink is being requested @bar', NULL, NULL, NULL, '2021-12-28 17:15:31', '2021-12-29 14:32:22', '2021-12-29 14:32:22'),
(407, NULL, 'Request for a drink', 72, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh is asking for drink. Prashant What drink is being requested @bar', NULL, NULL, NULL, '2021-12-28 17:15:34', '2021-12-29 14:32:16', '2021-12-29 14:32:16'),
(408, NULL, 'Request for a drink', 73, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh is asking for drink. Vodka What drink is being requested Prashant', NULL, NULL, NULL, '2021-12-28 17:16:39', '2021-12-28 17:27:55', '2021-12-28 17:27:55'),
(409, NULL, 'Request for a drink', 74, NULL, NULL, 'Drink', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 is asking for drink. Vodka drink is being requested Prashant', NULL, NULL, NULL, '2021-12-28 17:26:59', '2021-12-29 14:55:36', '2021-12-29 14:55:36'),
(410, NULL, 'Drink Request Accepted', NULL, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has accepted your drink request. It will not be sent until the person has regifted the item to you.', 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, '2021-12-28 17:27:56', '2021-12-28 17:27:56', NULL),
(411, NULL, 'Request for a drink', 75, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh is asking for drink. Vodka drink is being requested Prashant', NULL, NULL, NULL, '2021-12-29 12:02:34', '2021-12-29 14:30:35', '2021-12-29 14:30:35'),
(412, NULL, 'Game Request Accepted', NULL, NULL, NULL, 'Game', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has Accepted your game request.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, 76, '2021-12-29 12:12:49', '2021-12-29 12:12:49', NULL),
(413, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 76, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play 21 Questions', NULL, NULL, 1, '2021-12-29 12:16:52', '2021-12-29 12:17:12', '2021-12-29 12:17:12'),
(414, NULL, 'Drink Request Accepted', NULL, NULL, NULL, 'Drink', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has accepted your drink request. It will not be sent until the person has regifted the item to you.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-29 14:32:16', '2021-12-29 14:32:16', NULL),
(415, NULL, 'Drink Request Accepted', NULL, NULL, NULL, 'Drink', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has accepted your drink request. It will not be sent until the person has regifted the item to you.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-29 14:32:24', '2021-12-29 14:32:24', NULL),
(416, NULL, 'Drink Request Accepted', NULL, NULL, NULL, 'Drink', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has accepted your drink request. It will not be sent until the person has regifted the item to you.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-29 14:32:31', '2021-12-29 14:32:31', NULL),
(417, NULL, 'Request for a drink', 76, NULL, NULL, 'Drink', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh is asking for drink. Russian bear drink is being requested Prashant', NULL, NULL, NULL, '2021-12-29 18:33:56', '2021-12-30 19:07:32', '2021-12-30 19:07:32'),
(418, NULL, 'nitesh Invite you to play Game', NULL, 571, NULL, 'Game', 77, '4b4b7165a47354b45dfc42f2a4f20c71', 'nitesh has send you an invite Prashantsss to play 21 Questions', NULL, NULL, 1, '2021-12-29 18:38:11', '2021-12-30 14:36:11', '2021-12-30 14:36:11'),
(419, NULL, 'Drink Request Accepted', NULL, NULL, NULL, 'Drink', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has accepted your drink request. It will not be sent until the person has regifted the item to you.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-30 14:36:06', '2021-12-30 14:36:06', NULL),
(420, NULL, 'Game Request Accepted', NULL, NULL, NULL, 'Game', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has Accepted your game request.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, 1, '2021-12-30 14:36:11', '2021-12-30 14:36:11', NULL),
(421, NULL, 'new year', NULL, 572, 18, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '14,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-12-30 14:36:12', '2021-12-30 14:36:12', NULL),
(422, NULL, 'new year', NULL, 572, 18, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '14,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2021-12-30 14:36:13', '2021-12-30 14:36:13', NULL),
(423, NULL, 'Drink Request Accepted', NULL, NULL, NULL, 'Drink', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has accepted your drink request. It will not be sent until the person has regifted the item to you.', '4b4b7165a47354b45dfc42f2a4f20c71', NULL, NULL, '2021-12-30 19:07:32', '2021-12-30 19:07:32', NULL),
(424, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Vodka at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2021-12-30 20:12:26', '2021-12-30 20:12:26', NULL),
(425, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Vodka at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 12:05:36', '2022-01-03 12:05:36', NULL),
(426, NULL, 'Gift ', NULL, 574, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a vdvsdb at mahima Prajapat', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 12:08:31', '2022-01-03 12:08:31', NULL),
(427, NULL, 'Gift ', NULL, 574, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a vdvsdb at mahima Prajapat', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 14:16:35', '2022-01-03 14:16:35', NULL),
(428, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 14:17:18', '2022-01-03 14:17:18', NULL),
(429, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 14:17:43', '2022-01-03 14:17:43', NULL),
(430, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 18:23:19', '2022-01-03 18:23:19', NULL),
(431, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 18:27:38', '2022-01-03 18:27:38', NULL),
(432, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 18:27:58', '2022-01-03 18:27:58', NULL),
(433, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 18:51:50', '2022-01-03 18:51:50', NULL),
(434, NULL, 'Gift ', NULL, 566, NULL, 'gift_request', NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has sent you a Russian bear at Prashant', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', NULL, '2022-01-03 18:57:18', '2022-01-03 18:57:18', NULL),
(435, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 78, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2022-01-04 14:05:44', '2022-01-04 14:10:15', '2022-01-04 14:10:15'),
(436, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 79, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2022-01-04 14:10:15', '2022-01-04 14:16:20', '2022-01-04 14:16:20'),
(437, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 80, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2022-01-04 14:16:20', '2022-01-04 14:17:03', '2022-01-04 14:17:03'),
(438, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 81, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play Trivia', NULL, NULL, 77, '2022-01-04 14:17:03', '2022-01-04 14:25:05', '2022-01-04 14:25:05'),
(439, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 82, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2022-01-04 14:25:05', '2022-01-04 14:25:56', '2022-01-04 14:25:56'),
(440, NULL, 'user1 Invite you to play Game', NULL, 566, NULL, 'Game', 83, 'a97f81ac1e54c7e775771aacc3a49357', 'user1 has send you an invite Prashant to play kabbadi', NULL, NULL, 76, '2022-01-04 14:25:56', '2022-01-04 14:25:56', NULL),
(441, NULL, 'Request for a drink', 77, NULL, NULL, 'Drink', NULL, '9bd0eb91c37cece5133ccdced7b62759', 'user1 is asking for drink. Russian bear drink is being requested Prashant', NULL, NULL, NULL, '2022-01-04 20:11:56', '2022-01-04 20:11:56', NULL),
(442, NULL, 'Request for a drink', 78, NULL, NULL, 'Drink', NULL, '9bd0eb91c37cece5133ccdced7b62759', 'user1 is asking for drink. Vodka drink is being requested Prashant', NULL, NULL, NULL, '2022-01-06 12:21:16', '2022-01-06 12:21:16', NULL),
(443, NULL, 'Request for a drink', 79, NULL, NULL, 'Drink', NULL, '9bd0eb91c37cece5133ccdced7b62759', 'user1 is asking for drink. Vodka drink is being requested Prashant', NULL, NULL, NULL, '2022-01-06 20:12:47', '2022-01-06 20:12:47', NULL),
(444, NULL, 'erdc', NULL, 574, 25, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,One item', NULL, NULL, NULL, '2022-01-10 12:56:50', '2022-01-10 12:56:50', NULL),
(445, NULL, 'Foo Invite you to play Game', NULL, 566, NULL, 'Game', 84, '4b4b7165a47354b45dfc42f2a4f20c71', 'Foo has send you an invite Prashant to play Never I Have Ever', NULL, NULL, 82, '2022-01-19 20:50:58', '2022-01-19 20:50:58', NULL),
(446, NULL, 'partyfbgh', NULL, 574, 32, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Next purchase', NULL, NULL, NULL, '2022-01-25 18:57:32', '2022-01-25 18:57:32', NULL),
(447, NULL, 'partyfbgh', NULL, 574, 32, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Next purchase', NULL, NULL, NULL, '2022-01-25 18:57:33', '2022-01-25 18:57:33', NULL),
(448, NULL, 'partyfbgh', NULL, 574, 32, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Next purchase', NULL, NULL, NULL, '2022-01-25 18:57:33', '2022-01-25 18:57:33', NULL),
(449, NULL, 'partyfbgh', NULL, 574, 32, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Next purchase', NULL, NULL, NULL, '2022-01-25 18:57:33', '2022-01-25 18:57:33', NULL),
(450, NULL, 'partyfbgh', NULL, 574, 32, 'Event', NULL, '9bd0eb91c37cece5133ccdced7b62759', '10,$,off,Next purchase', NULL, NULL, NULL, '2022-01-25 18:57:33', '2022-01-25 18:57:33', NULL),
(451, NULL, 'mn', NULL, 574, 34, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2022-01-25 19:00:18', '2022-01-25 19:00:18', NULL),
(452, NULL, 'mn', NULL, 574, 34, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2022-01-25 19:00:18', '2022-01-25 19:00:18', NULL),
(453, NULL, 'mn', NULL, 574, 34, 'Event', NULL, '4b4b7165a47354b45dfc42f2a4f20c71', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2022-01-25 19:00:18', '2022-01-25 19:00:18', NULL),
(454, NULL, 'mn', NULL, 574, 34, 'Event', NULL, '9bd0eb91c37cece5133ccdced7b62759', '10,$,off,Buy one get one 1/2 off', NULL, NULL, NULL, '2022-01-25 19:00:19', '2022-01-25 19:00:19', NULL),
(455, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 85, '95d3cabe3fb6bcd7ac88146e05e32463', 'Nai has sent you a friend request.', NULL, NULL, NULL, '2022-02-09 16:15:56', '2022-02-09 16:16:51', '2022-02-09 16:16:51'),
(456, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '1889dec542525bc1b7732016faa5f8ae', 'Bar Connex has Accepted your friend request.', '95d3cabe3fb6bcd7ac88146e05e32463', NULL, NULL, '2022-02-09 16:16:51', '2022-02-09 16:16:51', NULL),
(457, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, '1889dec542525bc1b7732016faa5f8ae', 'Bar Connex has Accepted your friend request.', '95d3cabe3fb6bcd7ac88146e05e32463', NULL, NULL, '2022-02-09 16:16:56', '2022-02-09 16:16:56', NULL),
(458, NULL, 'Gift ', NULL, 579, NULL, 'gift_request', NULL, '1889dec542525bc1b7732016faa5f8ae', 'Bar Connex has sent you a Budweiser at Boro Park', NULL, '95d3cabe3fb6bcd7ac88146e05e32463', NULL, '2022-02-09 16:19:16', '2022-02-09 16:19:16', NULL),
(459, NULL, 'Gift ', NULL, 576, NULL, 'gift_request', NULL, 'c937098d2434c68801c94376c45638ad', 'Bar Connex has sent you a Long Island at Bay Ridge', NULL, '95d3cabe3fb6bcd7ac88146e05e32463', NULL, '2022-02-13 02:22:23', '2022-02-13 02:22:23', NULL),
(460, NULL, 'Gift ', NULL, 579, NULL, 'gift_request', NULL, '1889dec542525bc1b7732016faa5f8ae', 'Bar Connex has sent you a Corona at Boro Park', NULL, '95d3cabe3fb6bcd7ac88146e05e32463', NULL, '2022-02-13 02:22:42', '2022-02-13 02:22:42', NULL),
(461, NULL, 'Nai Invite you to play Game', NULL, 576, NULL, 'Game', 86, '95d3cabe3fb6bcd7ac88146e05e32463', 'Nai has send you an invite Bay Ridge to play Darts', NULL, NULL, 126, '2022-02-18 09:12:08', '2022-02-20 23:56:21', '2022-02-20 23:56:21'),
(462, NULL, 'Game Request Accepted', NULL, NULL, NULL, 'Game', NULL, '1889dec542525bc1b7732016faa5f8ae', 'Bar Connex has Accepted your game request.', '95d3cabe3fb6bcd7ac88146e05e32463', NULL, 126, '2022-02-20 23:56:21', '2022-02-20 23:56:21', NULL),
(463, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 87, '577e514e6d0eea75d8810171f71fa896', 'nishantqa541 has sent you a friend request.', NULL, NULL, NULL, '2022-02-24 09:53:19', '2022-02-24 09:53:19', NULL),
(464, NULL, 'Friend Request ', NULL, NULL, NULL, 'friend_request', 88, '79041e11f05c4c76cbe9f5e0206ff705', 'mayankqa541 has sent you a friend request.', NULL, NULL, NULL, '2022-02-24 10:02:56', '2022-02-24 15:03:03', '2022-02-24 15:03:03'),
(465, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:03', '2022-02-24 15:03:03', NULL),
(466, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:07', '2022-02-24 15:03:07', NULL),
(467, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:09', '2022-02-24 15:03:09', NULL),
(468, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:11', '2022-02-24 15:03:11', NULL),
(469, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:13', '2022-02-24 15:03:13', NULL),
(470, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:16', '2022-02-24 15:03:16', NULL),
(471, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:18', '2022-02-24 15:03:18', NULL),
(472, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:19', '2022-02-24 15:03:19', NULL),
(473, NULL, 'Friend Request Accepted', NULL, NULL, NULL, 'accepte_request', NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'nishantqa541 has Accepted your friend request.', '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, '2022-02-24 15:03:20', '2022-02-24 15:03:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_photowall`
--

CREATE TABLE `t_bar_photowall` (
  `id` int NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bar_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_bar_photowall`
--

INSERT INTO `t_bar_photowall` (`id`, `user_id`, `bar_id`, `photo`, `title`, `description`, `created_at`) VALUES
(2, '79041e11f05c4c76cbe9f5e0206ff705', '580', 'http://18.116.154.137/public/imageUpload/1645676211profileImage.jpg', 'Title', 'Test', '2022-02-24 09:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_photo_wall`
--

CREATE TABLE `t_bar_photo_wall` (
  `id` int NOT NULL,
  `bar_id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_photo_wall`
--

INSERT INTO `t_bar_photo_wall` (`id`, `bar_id`, `user_id`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '4bd1a3dec171def481a6bb796795b3ec', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/wallimage/wall.jpg', '', 0, '2020-09-16 11:50:39', '2020-09-16 11:50:39'),
(2, 2, '99db07ddf170f5711eb172b1a94233f8', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/wallimage/wall1.jpg', '', 0, '2020-09-16 11:51:01', '2020-09-16 11:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `t_checked_in_user`
--

CREATE TABLE `t_checked_in_user` (
  `id` int NOT NULL,
  `bar_id` int NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_checked_in_user`
--

INSERT INTO `t_checked_in_user` (`id`, `bar_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 2, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '2021-02-19 19:18:20', '2021-02-19 19:18:20'),
(32, 2, 'ae97274d50d1775c1b4089359644b503', '2021-03-25 19:54:18', '2021-03-25 19:54:18'),
(42, 2, '96992bb4290476b37a2f161dc259c8b2', '2021-04-09 03:36:51', '2021-04-09 03:36:51'),
(43, 2, '1d1ea9623dbcafd48a89f05e5a8a670a', '2021-04-12 16:48:18', '2021-04-12 16:48:18'),
(44, 2, 'b28bf5b1753a96abce3cd2bd6d853779', '2021-04-12 20:28:09', '2021-04-12 20:28:09'),
(47, 2, 'db787a8de3cc9a73d9b24fb8cbe6c209', '2021-04-18 02:02:21', '2021-04-18 02:02:21'),
(48, 13, 'rwf4t364tgege5', '2021-04-19 23:00:10', '2021-04-19 23:00:10'),
(59, 2, '646a2c2e03321404e8a605d969788a06', '2021-06-02 07:22:19', '2021-06-02 07:22:19'),
(60, 234, '89bccbbe030f4a7d6644e3573125c96c', '2021-06-04 03:01:44', '2021-06-04 03:01:44'),
(61, 48, '3f1ce0faf37cc0273223ee3075640af1', '2021-06-04 03:06:02', '2021-06-04 03:06:02'),
(64, 16, '3f1ce0faf37cc0273223ee3075640af1', '2021-06-07 22:49:59', '2021-06-07 22:49:59'),
(65, 2, 'd6530465201d4ab86f911671203cf466', '2021-06-15 17:01:56', '2021-06-15 17:01:56'),
(68, 2, '8c1519ee4d3ab2f2ca0268b416165f76', '2021-06-21 04:58:20', '2021-06-21 04:58:20'),
(72, 16, '89bccbbe030f4a7d6644e3573125c96c', '2021-06-28 05:15:24', '2021-06-28 05:15:24'),
(73, 39, 'dfe13424956effda6f2bc424df005397', '2021-07-07 12:38:58', '2021-07-07 12:38:58'),
(75, 32, 'rwf4t364tgege5', '2021-07-14 20:37:35', '2021-07-14 20:37:35'),
(86, 578, '95d3cabe3fb6bcd7ac88146e05e32463', '2022-02-09 01:04:52', '2022-02-09 01:04:52'),
(88, 578, 'b8245b00dca6d2a37f1b127383eab59f', '2022-02-09 04:26:04', '2022-02-09 04:26:04'),
(91, 580, '577e514e6d0eea75d8810171f71fa896', '2022-02-18 08:36:43', '2022-02-18 08:36:43'),
(92, 578, '1889dec542525bc1b7732016faa5f8ae', '2022-02-21 00:07:52', '2022-02-21 00:07:52'),
(93, 578, 'ec55324cb8115ffa811876184636a4c3', '2022-02-21 00:22:08', '2022-02-21 00:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `t_game`
--

CREATE TABLE `t_game` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_game`
--

INSERT INTO `t_game` (`id`, `name`, `description`, `image`, `updated_at`) VALUES
(1, '21 Questions', 'Set of 3 darts, dartboard. Glossary. Glossary of darts. Darts is a sport in which two or more players throw small missiles, also known as darts', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game2.png', '0000-00-00 00:00:00'),
(2, 'Never I Have Ever', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_order`
--

CREATE TABLE `t_order` (
  `order_id` bigint NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_id` int NOT NULL,
  `drink_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  `bar_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bar_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `order_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0-Pending,1-Success',
  `order_pin` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_redeemed` tinyint NOT NULL DEFAULT '0' COMMENT '0 or 1',
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `redeemQuantity` int NOT NULL,
  `tip` int NOT NULL,
  `is_regifted` tinyint NOT NULL DEFAULT '0' COMMENT '0 or 1',
  `senders_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_order`
--

INSERT INTO `t_order` (`order_id`, `user_id`, `menu_id`, `drink_name`, `category_name`, `price`, `quantity`, `bar_name`, `bar_id`, `payment_id`, `order_status`, `order_pin`, `is_redeemed`, `details`, `redeemQuantity`, `tip`, `is_regifted`, `senders_id`, `created_at`, `updated_at`) VALUES
(1, 'b728489d78e11542c2fef872c72df11d', 5, 'Gine Tonic', 'Lqu3', 56, 20, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 18:24:14', '2021-03-02 18:49:23'),
(2, 'b728489d78e11542c2fef872c72df11d', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 18:14:34', '2021-03-02 18:49:23'),
(3, 'b728489d78e11542c2fef872c72df11d', 4, 'Wine', '2', 2, 2, 'Sake Bar Satsko', 2, 1, '1', '1554', 0, '', 0, 0, 0, NULL, '2020-12-11 15:20:23', '2021-03-02 18:49:40'),
(4, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 18:26:36', '2021-03-02 18:49:23'),
(12, 'ae97274d50d1775c1b4089359644b503', 35, 'pasta', 'Mixed Drinks', 8, 1, 'Sake Bar Satsko', 2, 23, '1', '3535', 1, '', 0, 0, 0, NULL, '2020-12-11 20:44:55', '2021-03-02 18:49:33'),
(13, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 3, 24, '0', '9331', 0, '', 0, 0, 1, NULL, '2020-12-26 21:09:33', '2021-02-03 20:53:54'),
(14, 'ae97274d50d1775c1b4089359644b503', 8, 'bacardi', 'Beer', 2, 1, 'Sake Bar Satsko', 2, 25, '1', '0865', 1, '', 0, 0, 0, NULL, '2020-12-29 15:24:00', '2021-03-02 18:49:33'),
(15, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 1, 'sdfsdf', 1, 0, 1, NULL, '2020-12-29 20:33:19', '2021-05-17 18:32:26'),
(16, 'ae97274d50d1775c1b4089359644b503', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 1, NULL, '2020-12-29 20:34:02', '2021-03-02 18:49:33'),
(18, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 3, 'Sake Bar Satsko', 2, 29, '1', '1094', 1, '', 0, 0, 0, NULL, '2021-01-18 19:53:44', '2021-03-02 18:49:33'),
(19, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 29, '1', '1094', 0, '', 0, 0, 1, NULL, '2021-01-18 19:53:44', '2021-03-02 18:49:33'),
(20, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 3, 'Sake Bar Satsko', 2, 30, '1', '1401', 0, '', 0, 0, 1, NULL, '2021-01-18 20:01:12', '2021-03-02 18:49:33'),
(21, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 30, '1', '1401', 0, '', 0, 0, 1, NULL, '2021-01-18 20:01:12', '2021-03-02 18:49:33'),
(22, 'ae97274d50d1775c1b4089359644b503', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 1, NULL, '2021-01-18 20:14:02', '2021-03-02 18:49:33'),
(23, 'ae97274d50d1775c1b4089359644b503', 47, 'Fruit Beer', 'Non-alchoholic', 7, 0, 'Sake Bar Satsko', 2, 32, '1', '5083', 1, '', 0, 0, 0, NULL, '2021-01-18 20:40:04', '2021-03-02 18:49:33'),
(24, '27338af4c76bf696e3851677e375fa79', 8, 'bacardi', 'Beer', 2, 3, 'Sake Bar Satsko', 2, 33, '0', '5572', 0, '', 0, 0, 0, NULL, '2021-01-19 12:13:09', '2021-01-19 12:13:09'),
(25, 'b728489d78e11542c2fef872c72df11d', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-01 12:34:22', '2021-03-02 18:49:23'),
(26, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-01 12:34:23', '2021-03-02 18:49:23'),
(27, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-01 12:35:11', '2021-03-02 18:49:23'),
(28, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-01 12:35:13', '2021-03-02 18:49:23'),
(29, 'b728489d78e11542c2fef872c72df11d', 7, 'Gine Tonic k', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 18:31:55', '2021-03-02 18:49:23'),
(30, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 18:32:26', '2021-03-02 18:49:23'),
(31, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:32:28', '2021-03-02 18:49:23'),
(32, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:32:29', '2021-03-02 18:49:23'),
(33, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:40:46', '2021-03-02 18:49:23'),
(34, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:40:47', '2021-03-02 18:49:23'),
(35, '5561e975241669938ac63b0b1f8abe64', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 29, '1', '1094', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:51:56', '2021-03-02 18:49:23'),
(36, '5561e975241669938ac63b0b1f8abe64', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 29, '1', '1094', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:53:33', '2021-03-02 18:49:23'),
(37, '5561e975241669938ac63b0b1f8abe64', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 30, '1', '1401', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:54:03', '2021-03-02 18:49:23'),
(38, '5561e975241669938ac63b0b1f8abe64', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 30, '1', '1401', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:54:16', '2021-03-02 18:49:23'),
(39, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 3, 'Sake Bar Satsko', 2, 30, '1', '1401', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:55:09', '2021-03-02 18:49:23'),
(40, '5561e975241669938ac63b0b1f8abe64', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 29, '1', '1094', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 19:59:28', '2021-03-02 18:49:23'),
(41, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:17:38', '2021-03-02 18:49:23'),
(42, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:18:31', '2021-03-02 18:49:23'),
(43, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:19:37', '2021-03-02 18:49:23'),
(44, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:20:18', '2021-03-02 18:49:23'),
(45, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:21:03', '2021-03-02 18:49:23'),
(46, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:22:17', '2021-03-02 18:49:23'),
(47, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:22:21', '2021-03-02 18:49:23'),
(48, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:22:43', '2021-03-02 18:49:23'),
(49, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:23:19', '2021-03-02 18:49:23'),
(50, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:23:48', '2021-03-02 18:49:23'),
(51, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:24:05', '2021-03-02 18:49:23'),
(52, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 31, '1', '5266', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-02 21:24:45', '2021-03-02 18:49:23'),
(55, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 13:10:39', '2021-03-02 18:49:23'),
(56, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 13:14:28', '2021-03-02 18:49:23'),
(57, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 1, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 15:57:48', '2021-03-02 18:49:23'),
(58, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 1, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 15:57:49', '2021-03-02 18:49:23'),
(59, 'b01a8e93973c44dbbf34dc3668483964', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '0', '2630', 0, '', 0, 0, 0, '5561e975241669938ac63b0b1f8abe64', '2021-02-03 16:03:59', '2021-02-03 16:03:59'),
(60, 'b01a8e93973c44dbbf34dc3668483964', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '0', '5331', 0, '', 0, 0, 0, '5561e975241669938ac63b0b1f8abe64', '2021-02-03 16:04:01', '2021-02-03 16:04:01'),
(61, 'b01a8e93973c44dbbf34dc3668483964', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '0', '2630', 0, '', 0, 0, 0, '5561e975241669938ac63b0b1f8abe64', '2021-02-03 16:04:29', '2021-02-03 16:04:29'),
(62, 'b01a8e93973c44dbbf34dc3668483964', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '0', '5331', 0, '', 0, 0, 0, '5561e975241669938ac63b0b1f8abe64', '2021-02-03 16:04:31', '2021-02-03 16:04:31'),
(63, 'b01a8e93973c44dbbf34dc3668483964', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '0', '2630', 0, '', 0, 0, 0, '5561e975241669938ac63b0b1f8abe64', '2021-02-03 16:08:19', '2021-02-03 16:08:19'),
(64, 'b01a8e93973c44dbbf34dc3668483964', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '0', '5331', 0, '', 0, 0, 0, '5561e975241669938ac63b0b1f8abe64', '2021-02-03 16:08:21', '2021-02-03 16:08:21'),
(65, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 16:08:36', '2021-03-02 18:49:23'),
(66, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 16:08:36', '2021-03-02 18:49:23'),
(67, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 16:11:10', '2021-03-02 18:49:23'),
(68, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 16:11:12', '2021-03-02 18:49:23'),
(69, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 26, '1', '2630', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 16:14:39', '2021-03-02 18:49:23'),
(70, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 27, '1', '5331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 16:14:40', '2021-03-02 18:49:23'),
(71, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 3, 24, '0', '9331', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-03 20:53:54', '2021-02-03 20:53:54'),
(72, 'ae97274d50d1775c1b4089359644b503', 112, 'Vodka ', 'test', 14, 15, 'McSorley\'s', 3, 34, '0', '6210', 0, '', 0, 0, 1, NULL, '2021-02-03 20:55:00', '2021-02-04 12:23:40'),
(73, '5561e975241669938ac63b0b1f8abe64', 112, 'Vodka ', 'test', 14, 15, 'McSorley\'s', 3, 34, '0', '6210', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-04 12:23:40', '2021-02-04 12:23:40'),
(74, 'ae97274d50d1775c1b4089359644b503', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 1, NULL, '2021-02-04 12:25:05', '2021-03-02 18:49:33'),
(75, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 1, NULL, '2021-02-04 12:25:05', '2021-03-02 18:49:33'),
(76, 'ae97274d50d1775c1b4089359644b503', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 1, '', 0, 0, 1, NULL, '2021-02-04 12:25:05', '2021-03-02 18:49:33'),
(77, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 1, NULL, '2021-02-04 12:25:05', '2021-03-02 18:49:33'),
(78, 'ae97274d50d1775c1b4089359644b503', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 0, NULL, '2021-02-04 12:25:05', '2021-03-02 18:49:33'),
(79, 'ae97274d50d1775c1b4089359644b503', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, NULL, '2021-02-04 12:25:28', '2021-03-02 18:49:33'),
(80, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, NULL, '2021-02-04 12:25:28', '2021-03-02 18:49:33'),
(81, 'ae97274d50d1775c1b4089359644b503', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, NULL, '2021-02-04 12:25:28', '2021-03-02 18:49:33'),
(82, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, NULL, '2021-02-04 12:25:28', '2021-03-02 18:49:33'),
(83, 'ae97274d50d1775c1b4089359644b503', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 1, NULL, '2021-02-04 12:25:28', '2021-03-02 18:49:33'),
(84, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-08 21:28:54', '2021-03-02 18:49:23'),
(85, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-08 21:29:09', '2021-03-02 18:49:23'),
(86, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-08 21:30:12', '2021-03-02 18:49:23'),
(87, '5561e975241669938ac63b0b1f8abe64', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 36, '1', '2574', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-08 21:31:36', '2021-03-02 18:49:23'),
(88, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 37, '0', '3980', 1, '', 0, 0, 0, NULL, '2021-02-15 11:46:55', '2021-02-15 11:47:42'),
(89, 'd6530465201d4ab86f911671203cf466', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 38, '0', '5855', 0, '', 0, 0, 1, NULL, '2021-02-15 11:48:46', '2021-03-17 16:30:26'),
(90, 'd6530465201d4ab86f911671203cf466', 112, 'Vodka ', 'test', 14, 1, 'McSorley\'s', 3, 39, '0', '6485', 0, '', 0, 0, 1, NULL, '2021-02-15 11:50:48', '2021-02-15 16:17:50'),
(91, '5561e975241669938ac63b0b1f8abe64', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-15 15:15:44', '2021-03-02 18:49:23'),
(92, '5561e975241669938ac63b0b1f8abe64', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-15 15:27:16', '2021-03-02 18:49:23'),
(93, 'd6530465201d4ab86f911671203cf466', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 40, '0', '4856', 1, '', 0, 0, 0, NULL, '2021-02-15 16:17:28', '2021-02-24 13:31:18'),
(94, 'ae97274d50d1775c1b4089359644b503', 112, 'Vodka ', 'test', 14, 1, 'McSorley\'s', 3, 39, '0', '6485', 1, '', 0, 0, 0, 'd6530465201d4ab86f911671203cf466', '2021-02-15 16:17:50', '2021-02-26 19:48:44'),
(95, '5561e975241669938ac63b0b1f8abe64', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-20 14:20:58', '2021-03-02 18:49:23'),
(96, '5561e975241669938ac63b0b1f8abe64', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 35, '1', '1836', 0, '', 0, 0, 0, 'ae97274d50d1775c1b4089359644b503', '2021-02-22 16:02:39', '2021-03-02 18:49:23'),
(97, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 2, 'Sake Bar Satsko', 2, 41, '1', '0878', 0, '', 0, 0, 0, NULL, '2021-02-22 16:59:46', '2021-03-02 18:49:33'),
(98, 'ae97274d50d1775c1b4089359644b503', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 41, '1', '0878', 0, '', 0, 0, 0, NULL, '2021-02-22 16:59:46', '2021-03-02 18:49:33'),
(99, 'ae97274d50d1775c1b4089359644b503', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 41, '1', '0878', 0, '', 0, 0, 0, NULL, '2021-02-22 16:59:46', '2021-03-02 18:49:33'),
(100, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 41, '1', '0878', 0, '', 0, 0, 0, NULL, '2021-02-22 16:59:46', '2021-03-02 18:49:33'),
(101, 'ae97274d50d1775c1b4089359644b503', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 41, '1', '0878', 0, '', 0, 0, 0, NULL, '2021-02-22 16:59:46', '2021-03-02 18:49:33'),
(102, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 42, '0', '5784', 0, '', 0, 0, 1, NULL, '2021-02-23 14:08:39', '2021-02-24 13:30:55'),
(103, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 43, '1', '2411', 0, '', 0, 0, 0, NULL, '2021-02-23 14:27:42', '2021-03-02 18:49:33'),
(104, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 44, '1', '6874', 0, '', 0, 0, 0, NULL, '2021-02-23 16:58:45', '2021-03-02 18:49:33'),
(105, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 2, 'Sake Bar Satsko', 2, 45, '1', '9843', 0, '', 0, 0, 0, NULL, '2021-02-23 17:15:51', '2021-03-02 18:49:33'),
(106, 'rwf4t364tgege5', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 46, '0', '6441', 1, '', 0, 0, 0, NULL, '2021-02-23 18:03:36', '2021-02-25 04:28:51'),
(107, 'rwf4t364tgege5', 7, 'Gine Tonic', 'Lqu3', 56, 3, 'Sake Bar Satsko', 2, 47, '0', '2218', 1, '', 0, 0, 0, NULL, '2021-02-23 20:45:41', '2021-02-24 20:28:46'),
(108, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 48, '0', '7801', 1, '', 0, 0, 0, NULL, '2021-02-24 13:29:20', '2021-02-24 13:31:29'),
(109, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 42, '1', '5784', 0, '', 0, 0, 0, 'd6530465201d4ab86f911671203cf466', '2021-02-24 13:30:55', '2021-03-02 18:49:33'),
(110, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 2, 'Sake Bar Satsko', 2, 49, '0', '4933', 0, '', 0, 0, 0, NULL, '2021-03-08 15:48:34', '2021-03-08 15:48:34'),
(111, 'ae97274d50d1775c1b4089359644b503', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 38, '0', '5855', 0, '', 0, 0, 0, 'd6530465201d4ab86f911671203cf466', '2021-03-17 16:30:26', '2021-03-17 16:30:26'),
(112, 'ae97274d50d1775c1b4089359644b503', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 58, '0', '8275', 0, '', 0, 0, 0, NULL, '2021-03-25 16:03:10', '2021-03-25 16:03:10'),
(113, 'rwf4t364tgege5', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 60, '0', '6781', 1, 'Xxx', 2, 3, 0, NULL, '2021-03-31 20:57:42', '2021-06-06 02:12:59'),
(114, 'rwf4t364tgege5', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 61, '0', '2048', 0, '', 0, 0, 1, NULL, '2021-03-31 21:21:17', '2021-03-31 21:23:46'),
(115, 'rwf4t364tgege5', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 61, '0', '2048', 1, '', 0, 0, 0, NULL, '2021-03-31 21:21:17', '2021-03-31 21:32:34'),
(116, 'rwf4t364tgege5', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 61, '0', '2048', 1, '', 0, 0, 0, NULL, '2021-03-31 21:21:17', '2021-04-12 16:40:43'),
(117, 'rwf4t364tgege5', 112, 'Vodka ', 'test', 14, 4, 'McSorley\'s', 3, 62, '0', '7879', 0, '', 0, 0, 0, NULL, '2021-03-31 21:22:43', '2021-03-31 21:22:43'),
(118, 'b8245b00dca6d2a37f1b127383eab59f', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 61, '0', '2048', 0, '', 0, 0, 0, 'rwf4t364tgege5', '2021-03-31 21:23:46', '2021-03-31 21:23:46'),
(119, 'ec55324cb8115ffa811876184636a4c3', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 63, '0', '6981', 1, '', 0, 0, 0, NULL, '2021-03-31 21:28:12', '2021-04-01 04:08:53'),
(120, 'ec55324cb8115ffa811876184636a4c3', 65, 'Martini 2', 'Lqu3', 6, 4, 'Sake Bar Satsko', 2, 63, '0', '6981', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:12', '2021-03-31 21:28:12'),
(121, 'ec55324cb8115ffa811876184636a4c3', 102, 'Martini 3', 'Lqu3', 8, 3, 'Sake Bar Satsko', 2, 63, '0', '6981', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:12', '2021-03-31 21:28:12'),
(122, 'ec55324cb8115ffa811876184636a4c3', 104, 'testserver', 'Lqu3', 2, 3, 'Sake Bar Satsko', 2, 63, '0', '6981', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:12', '2021-03-31 21:28:12'),
(123, 'ec55324cb8115ffa811876184636a4c3', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 64, '0', '3736', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:33', '2021-03-31 21:28:33'),
(124, 'ec55324cb8115ffa811876184636a4c3', 65, 'Martini 2', 'Lqu3', 6, 4, 'Sake Bar Satsko', 2, 64, '0', '3736', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:33', '2021-03-31 21:28:33'),
(125, 'ec55324cb8115ffa811876184636a4c3', 102, 'Martini 3', 'Lqu3', 8, 3, 'Sake Bar Satsko', 2, 64, '0', '3736', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:33', '2021-03-31 21:28:33'),
(126, 'ec55324cb8115ffa811876184636a4c3', 104, 'testserver', 'Lqu3', 2, 3, 'Sake Bar Satsko', 2, 64, '0', '3736', 0, '', 0, 0, 0, NULL, '2021-03-31 21:28:33', '2021-03-31 21:28:33'),
(127, 'ec55324cb8115ffa811876184636a4c3', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 65, '0', '8049', 0, '', 0, 0, 1, NULL, '2021-03-31 21:29:09', '2021-04-02 03:08:13'),
(128, 'ec55324cb8115ffa811876184636a4c3', 65, 'Martini 2', 'Lqu3', 6, 4, 'Sake Bar Satsko', 2, 65, '0', '8049', 1, '', 0, 0, 0, NULL, '2021-03-31 21:29:09', '2021-04-02 04:09:45'),
(129, 'ec55324cb8115ffa811876184636a4c3', 102, 'Martini 3', 'Lqu3', 8, 3, 'Sake Bar Satsko', 2, 65, '0', '8049', 0, '', 0, 0, 0, NULL, '2021-03-31 21:29:09', '2021-03-31 21:29:09'),
(130, 'ec55324cb8115ffa811876184636a4c3', 104, 'testserver', 'Lqu3', 2, 3, 'Sake Bar Satsko', 2, 65, '0', '8049', 0, '', 0, 0, 0, NULL, '2021-03-31 21:29:09', '2021-03-31 21:29:09'),
(131, 'ec55324cb8115ffa811876184636a4c3', 112, 'Vodka ', 'test', 14, 10, 'McSorley\'s', 3, 66, '0', '6341', 1, '', 0, 0, 0, NULL, '2021-03-31 21:31:10', '2021-04-02 03:48:13'),
(132, 'rwf4t364tgege5', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 67, '0', '6828', 1, 'Yes sir have a meeting with this', 1, 7, 0, NULL, '2021-04-01 16:24:49', '2021-07-14 20:39:03'),
(133, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 68, '0', '6387', 0, '', 0, 0, 0, NULL, '2021-04-01 19:42:51', '2021-04-01 19:42:51'),
(134, '96992bb4290476b37a2f161dc259c8b2', 7, 'Gine Tonic', 'Lqu3', 56, 24, 'Sake Bar Satsko', 2, 69, '1', '2034', 0, '', 0, 0, 1, NULL, '2021-04-02 01:06:36', '2021-04-20 09:28:14'),
(135, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 70, '0', '7589', 0, '', 0, 0, 0, NULL, '2021-04-02 01:11:32', '2021-04-02 01:11:32'),
(136, 'e540e075f31e9d979e985b8564322974', 7, 'Gine Tonic', 'Lqu3', 56, 24, 'Sake Bar Satsko', 2, 69, '0', '2034', 0, '', 0, 0, 0, '96992bb4290476b37a2f161dc259c8b2', '2021-04-02 01:13:27', '2021-04-02 01:13:27'),
(137, 'e540e075f31e9d979e985b8564322974', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 65, '0', '8049', 0, '', 0, 0, 0, 'ec55324cb8115ffa811876184636a4c3', '2021-04-02 03:08:12', '2021-04-02 03:08:12'),
(138, 'e540e075f31e9d979e985b8564322974', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 65, '0', '8049', 0, '', 0, 0, 0, 'ec55324cb8115ffa811876184636a4c3', '2021-04-02 03:08:13', '2021-04-02 03:08:13'),
(139, 'ec55324cb8115ffa811876184636a4c3', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 71, '0', '5485', 0, '', 0, 0, 0, NULL, '2021-04-03 05:35:48', '2021-04-03 05:35:48'),
(140, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 72, '0', '1593', 0, '', 0, 0, 0, NULL, '2021-04-05 04:38:14', '2021-04-05 04:38:14'),
(141, '96992bb4290476b37a2f161dc259c8b2', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 73, '1', '6318', 0, '', 0, 0, 1, NULL, '2021-04-05 17:34:54', '2021-04-20 09:28:14'),
(142, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 73, '0', '6318', 0, '', 0, 0, 0, '96992bb4290476b37a2f161dc259c8b2', '2021-04-05 19:25:19', '2021-04-05 19:25:19'),
(143, '1d1ea9623dbcafd48a89f05e5a8a670a', 41, 'Hunter', 'Beer1', 3, 0, 'Sake Bar Satsko', 2, 74, '1', '8531', 0, '', 0, 0, 0, NULL, '2021-04-12 16:48:59', '2021-07-19 13:23:47'),
(144, '646a2c2e03321404e8a605d969788a06', 104, 'testserver', 'Lqu3', 2, 0, 'Sake Bar Satsko', 2, 75, '1', '1509', 1, '', 0, 0, 0, NULL, '2021-04-13 05:05:47', '2021-04-20 09:28:09'),
(145, '646a2c2e03321404e8a605d969788a06', 109, 'Drink 1234', 'Lqu3', 14, 0, 'Sake Bar Satsko', 2, 76, '1', '2701', 0, '', 0, 0, 1, NULL, '2021-04-13 05:06:12', '2021-04-20 09:28:09'),
(146, 'b8245b00dca6d2a37f1b127383eab59f', 65, 'Martini 2', 'Lqu3', 6, 5, 'Sake Bar Satsko', 2, 80, '0', '6659', 0, '', 0, 0, 0, NULL, '2021-04-13 05:11:05', '2021-04-13 05:11:05'),
(147, 'b8245b00dca6d2a37f1b127383eab59f', 102, 'Martini 3', 'Lqu3', 8, 0, 'Sake Bar Satsko', 2, 81, '0', '1227', 0, '', 0, 0, 0, NULL, '2021-04-14 01:31:21', '2021-04-14 01:31:21'),
(148, 'e540e075f31e9d979e985b8564322974', 109, 'Drink 1234', 'Lqu3', 14, 0, 'Sake Bar Satsko', 2, 76, '0', '2701', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-04-14 01:32:31', '2021-04-14 01:32:31'),
(149, 'e540e075f31e9d979e985b8564322974', 109, 'Drink 1234', 'Lqu3', 14, 0, 'Sake Bar Satsko', 2, 76, '0', '2701', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-04-14 01:32:31', '2021-04-14 01:32:31'),
(150, '646a2c2e03321404e8a605d969788a06', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 1, NULL, '2021-04-14 06:00:39', '2021-04-20 09:28:09'),
(151, '646a2c2e03321404e8a605d969788a06', 40, 'Budwiser', 'Beer', 5, 2, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 1, NULL, '2021-04-14 06:00:39', '2021-04-20 09:28:09'),
(152, '646a2c2e03321404e8a605d969788a06', 9, 'corona3', 'Beer', 2, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 1, '', 0, 0, 0, NULL, '2021-04-14 06:00:39', '2021-04-20 09:28:09'),
(153, '646a2c2e03321404e8a605d969788a06', 56, 'Soup', 'Lqu1', 6, 3, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 1, NULL, '2021-04-14 06:00:39', '2021-05-20 23:55:04'),
(154, '646a2c2e03321404e8a605d969788a06', 66, 'Burger King', 'Junk Food', 7, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 1, NULL, '2021-04-14 06:00:39', '2021-06-02 07:21:41'),
(155, '646a2c2e03321404e8a605d969788a06', 68, 'Burger & Fries', 'Junk Food', 8, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 1, NULL, '2021-04-14 06:00:39', '2021-04-20 09:28:09'),
(156, '646a2c2e03321404e8a605d969788a06', 104, 'testserver', 'Lqu3', 2, 8, 'Sake Bar Satsko', 2, 83, '1', '8839', 1, 'As is', 1, 3, 0, NULL, '2021-04-15 07:02:57', '2021-06-15 08:46:09'),
(157, 'e540e075f31e9d979e985b8564322974', 68, 'Burger & Fries', 'Junk Food', 8, 1, 'Sake Bar Satsko', 2, 82, '0', '0653', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-04-15 07:07:01', '2021-04-15 07:07:01'),
(158, 'b8245b00dca6d2a37f1b127383eab59f', 112, 'Vodka ', 'test', 14, 4, 'McSorley\'s', 3, 85, '0', '3539', 0, '', 0, 0, 0, NULL, '2021-04-15 07:16:57', '2021-04-15 07:16:57'),
(159, '1d1ea9623dbcafd48a89f05e5a8a670a', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 1, '646a2c2e03321404e8a605d969788a06', '2021-04-16 21:52:52', '2021-07-19 13:23:47'),
(160, '1d1ea9623dbcafd48a89f05e5a8a670a', 40, 'Budwiser', 'Beer', 5, 2, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-04-16 21:53:14', '2021-07-19 13:23:47'),
(161, '1d1ea9623dbcafd48a89f05e5a8a670a', 40, 'Budwiser', 'Beer', 5, 2, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-04-16 21:53:16', '2021-07-19 13:23:47'),
(162, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 3, 'Sake Bar Satsko', 2, 86, '0', '4911', 1, '', 0, 0, 0, NULL, '2021-04-17 18:16:43', '2021-04-17 18:20:49'),
(163, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 87, '1', '2331', 1, '', 0, 0, 0, NULL, '2021-04-18 00:46:19', '2021-04-20 09:28:09'),
(164, 'b8245b00dca6d2a37f1b127383eab59f', 102, 'Martini 3', 'Lqu3', 8, 5, 'Sake Bar Satsko', 2, 88, '0', '2596', 0, '', 0, 0, 0, NULL, '2021-04-18 00:51:55', '2021-04-18 00:51:55'),
(165, 'b8245b00dca6d2a37f1b127383eab59f', 104, 'testserver', 'Lqu3', 2, 4, 'Sake Bar Satsko', 2, 88, '0', '2596', 0, '', 0, 0, 0, NULL, '2021-04-18 00:51:55', '2021-04-18 00:51:55'),
(166, '646a2c2e03321404e8a605d969788a06', 114, 'coorslite', 'Beer1', 10, 5, 'Sake Bar Satsko', 2, 89, '1', '7576', 1, '', 0, 0, 0, NULL, '2021-04-18 02:38:01', '2021-04-20 09:28:09'),
(167, '646a2c2e03321404e8a605d969788a06', 109, 'Drink 1234', 'Lqu3', 14, 0, 'Sake Bar Satsko', 2, 90, '1', '9921', 0, '', 0, 0, 1, NULL, '2021-04-18 06:03:47', '2021-06-23 07:17:48'),
(168, 'rwf4t364tgege5', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 91, '0', '6567', 0, '', 0, 0, 0, NULL, '2021-04-25 23:26:50', '2021-04-25 23:26:50'),
(169, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 2, 'Sake Bar Satsko', 2, 92, '0', '7637', 1, '', 0, 0, 0, NULL, '2021-05-11 12:45:01', '2021-05-11 12:45:28'),
(170, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 93, '0', '0707', 1, '', 0, 0, 0, NULL, '2021-05-11 14:33:33', '2021-05-11 15:18:16'),
(171, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 93, '0', '0707', 1, '', 0, 0, 0, NULL, '2021-05-11 14:33:33', '2021-05-11 14:34:25'),
(172, 'd6530465201d4ab86f911671203cf466', 29, 'new drink', 'Lqu4', 11, 1, 'Sake Bar Satsko', 2, 93, '0', '0707', 1, '', 0, 0, 0, NULL, '2021-05-11 14:33:33', '2021-05-11 15:36:30'),
(173, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 94, '0', '2184', 1, '', 0, 0, 0, NULL, '2021-05-11 14:43:13', '2021-05-11 15:50:39'),
(174, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 94, '0', '2184', 1, '', 0, 0, 0, NULL, '2021-05-11 14:43:13', '2021-05-11 16:18:44'),
(175, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 94, '0', '2184', 1, '', 0, 0, 0, NULL, '2021-05-11 14:43:13', '2021-05-11 16:34:37'),
(176, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 95, '0', '1306', 1, '', 0, 0, 0, NULL, '2021-05-11 16:39:22', '2021-05-11 16:39:39'),
(177, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 95, '0', '1306', 1, '', 0, 0, 0, NULL, '2021-05-11 16:39:22', '2021-05-11 16:46:07'),
(178, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 95, '0', '1306', 1, '', 0, 0, 0, NULL, '2021-05-11 16:39:22', '2021-05-11 16:46:30'),
(179, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 96, '0', '9987', 1, '', 0, 0, 0, NULL, '2021-05-11 16:50:19', '2021-05-11 16:50:33'),
(180, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 96, '0', '9987', 1, '', 0, 0, 0, NULL, '2021-05-11 16:50:19', '2021-05-11 17:01:18'),
(181, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 96, '0', '9987', 1, '', 0, 0, 0, NULL, '2021-05-11 16:50:19', '2021-05-11 18:08:36'),
(182, 'd6530465201d4ab86f911671203cf466', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 96, '0', '9987', 1, '', 0, 0, 0, NULL, '2021-05-11 16:50:19', '2021-05-12 10:39:00'),
(183, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 97, '0', '5621', 1, '', 0, 0, 0, NULL, '2021-05-12 11:32:22', '2021-05-12 11:33:12'),
(184, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 97, '0', '5621', 1, '', 0, 0, 0, NULL, '2021-05-12 11:32:22', '2021-05-12 11:32:34'),
(185, 'd6530465201d4ab86f911671203cf466', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 97, '0', '5621', 1, '', 0, 0, 0, NULL, '2021-05-12 11:32:22', '2021-05-12 11:34:23'),
(186, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 97, '0', '5621', 1, '', 0, 0, 0, NULL, '2021-05-12 11:32:22', '2021-05-12 12:18:40'),
(187, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 98, '0', '9786', 1, '', 0, 0, 0, NULL, '2021-05-12 12:41:42', '2021-05-12 12:42:05'),
(188, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 98, '0', '9786', 1, '', 0, 0, 0, NULL, '2021-05-12 12:41:42', '2021-05-17 15:48:47'),
(189, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 98, '0', '9786', 1, 'fghdfgfdg', 1, 1, 0, NULL, '2021-05-12 12:41:42', '2021-05-17 19:49:13'),
(190, 'd6530465201d4ab86f911671203cf466', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 98, '0', '9786', 1, 'dfgf', 1, 1, 0, NULL, '2021-05-12 12:41:42', '2021-05-17 20:33:59'),
(191, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 99, '0', '4501', 1, 'dfgh', 1, 2, 0, NULL, '2021-05-17 20:37:11', '2021-05-17 20:37:33'),
(192, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 100, '0', '5586', 1, 'gfgdfg', 1, 1, 0, NULL, '2021-05-17 20:38:36', '2021-05-17 20:39:00'),
(193, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 100, '0', '5586', 1, 'hjghj', 1, 1, 0, NULL, '2021-05-17 20:38:36', '2021-05-17 20:42:22'),
(194, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 101, '0', '0651', 0, '', 0, 0, 1, NULL, '2021-05-18 12:38:23', '2021-05-18 17:14:32'),
(195, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 102, '0', '0790', 0, '', 0, 0, 1, NULL, '2021-05-18 12:41:10', '2021-07-05 13:33:33'),
(196, 'd6530465201d4ab86f911671203cf466', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 102, '0', '0790', 0, '', 0, 0, 0, NULL, '2021-05-18 12:41:10', '2021-05-18 12:41:10'),
(197, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 102, '0', '0790', 0, '', 0, 0, 0, NULL, '2021-05-18 12:41:10', '2021-05-18 12:41:10'),
(198, 'd6530465201d4ab86f911671203cf466', 109, 'Drink 1234', 'Lqu3', 14, 1, 'Sake Bar Satsko', 2, 103, '0', '8775', 0, '', 0, 0, 0, NULL, '2021-05-18 12:49:45', '2021-05-18 12:49:45'),
(199, 'd6530465201d4ab86f911671203cf466', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 103, '0', '8775', 0, '', 0, 0, 0, NULL, '2021-05-18 12:49:45', '2021-05-18 12:49:45'),
(200, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 101, '0', '0651', 0, '', 0, 0, 0, 'd6530465201d4ab86f911671203cf466', '2021-05-18 17:14:32', '2021-05-18 17:14:32'),
(201, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 56, 0, 'Sake Bar Satsko', 2, 104, '0', '7061', 1, 'Min', 5, 1, 0, NULL, '2021-05-20 05:38:10', '2021-06-30 00:50:11'),
(202, '646a2c2e03321404e8a605d969788a06', 102, 'Martini 3', 'Lqu3', 8, 0, 'Sake Bar Satsko', 2, 105, '0', '4892', 0, '', 0, 0, 1, NULL, '2021-05-20 05:38:55', '2021-06-30 00:49:44'),
(203, 'b8245b00dca6d2a37f1b127383eab59f', 56, 'Soup', 'Lqu1', 6, 3, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-05-20 23:55:04', '2021-05-20 23:55:04'),
(204, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 106, '0', '9066', 0, '', 0, 0, 0, NULL, '2021-05-26 06:56:15', '2021-05-26 06:56:15'),
(205, '1d1ea9623dbcafd48a89f05e5a8a670a', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 107, '1', '5711', 0, '', 0, 0, 0, NULL, '2021-05-26 06:59:51', '2021-07-19 13:23:47'),
(206, 'b8245b00dca6d2a37f1b127383eab59f', 104, 'testserver', 'Lqu3', 2, 0, 'Sake Bar Satsko', 2, 108, '0', '2079', 0, '', 0, 0, 0, NULL, '2021-05-26 07:02:14', '2021-05-26 07:02:14'),
(207, 'b8245b00dca6d2a37f1b127383eab59f', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 0, '1d1ea9623dbcafd48a89f05e5a8a670a', '2021-05-26 07:04:20', '2021-05-26 07:04:20'),
(208, 'b8245b00dca6d2a37f1b127383eab59f', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 0, '1d1ea9623dbcafd48a89f05e5a8a670a', '2021-05-26 07:04:21', '2021-05-26 07:04:21'),
(209, 'b8245b00dca6d2a37f1b127383eab59f', 66, 'Burger King', 'Junk Food', 7, 1, 'Sake Bar Satsko', 2, 82, '1', '0653', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-02 07:21:41', '2021-06-02 07:21:41'),
(210, '89bccbbe030f4a7d6644e3573125c96c', 65, 'Martini 2', 'Lqu3', 6, 0, 'Sake Bar Satsko', 2, 110, '0', '8770', 0, '', 0, 0, 0, NULL, '2021-06-04 03:00:32', '2021-06-04 03:00:32'),
(211, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 112, '0', '5997', 0, '', 0, 0, 1, NULL, '2021-06-23 02:17:55', '2021-06-30 00:48:16'),
(212, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 113, '0', '2427', 0, '', 0, 0, 1, NULL, '2021-06-23 02:18:23', '2021-06-30 00:48:59'),
(213, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 114, '0', '1227', 0, '', 0, 0, 1, NULL, '2021-06-23 02:20:37', '2021-06-30 00:49:28'),
(214, 'b8245b00dca6d2a37f1b127383eab59f', 109, 'Drink 1234', 'Lqu3', 14, 0, 'Sake Bar Satsko', 2, 90, '1', '9921', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-23 07:17:48', '2021-06-23 07:17:48'),
(215, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 112, '0', '5997', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:48:15', '2021-06-30 00:48:15'),
(216, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 112, '0', '5997', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:48:15', '2021-06-30 00:48:15'),
(217, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 112, '0', '5997', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:48:16', '2021-06-30 00:48:16'),
(218, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 113, '0', '2427', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:48:58', '2021-06-30 00:48:58'),
(219, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 113, '0', '2427', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:48:59', '2021-06-30 00:48:59'),
(220, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 0, 'Sake Bar Satsko', 2, 114, '0', '1227', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:49:28', '2021-06-30 00:49:28'),
(221, 'b8245b00dca6d2a37f1b127383eab59f', 102, 'Martini 3', 'Lqu3', 8, 0, 'Sake Bar Satsko', 2, 105, '0', '4892', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:49:43', '2021-06-30 00:49:43'),
(222, 'b8245b00dca6d2a37f1b127383eab59f', 102, 'Martini 3', 'Lqu3', 8, 0, 'Sake Bar Satsko', 2, 105, '0', '4892', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:49:43', '2021-06-30 00:49:43'),
(223, 'b8245b00dca6d2a37f1b127383eab59f', 102, 'Martini 3', 'Lqu3', 8, 0, 'Sake Bar Satsko', 2, 105, '0', '4892', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-06-30 00:49:44', '2021-06-30 00:49:44'),
(224, 'dfe13424956effda6f2bc424df005397', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 1, NULL, '2021-07-01 14:32:23', '2021-07-01 14:33:11'),
(225, 'dfe13424956effda6f2bc424df005397', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 1, NULL, '2021-07-01 14:32:23', '2021-07-01 14:40:14'),
(226, 'dfe13424956effda6f2bc424df005397', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 1, NULL, '2021-07-01 14:32:23', '2021-07-01 14:40:31'),
(227, 'dfe13424956effda6f2bc424df005397', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 1, NULL, '2021-07-01 14:32:23', '2021-07-02 17:05:05'),
(228, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 1, 'dfe13424956effda6f2bc424df005397', '2021-07-01 14:33:11', '2021-07-14 01:08:38'),
(229, 'dfe13424956effda6f2bc424df005397', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 116, '0', '9676', 0, '', 0, 0, 1, NULL, '2021-07-01 14:37:08', '2021-07-03 16:40:31'),
(230, 'dfe13424956effda6f2bc424df005397', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 116, '0', '9676', 1, 'Ggg', 1, 2, 0, NULL, '2021-07-01 14:37:08', '2021-07-03 14:04:54'),
(231, '646a2c2e03321404e8a605d969788a06', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-01 14:40:14', '2021-07-01 14:40:14'),
(232, '646a2c2e03321404e8a605d969788a06', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-01 14:40:31', '2021-07-01 14:40:31'),
(233, 'dfe13424956effda6f2bc424df005397', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 1, NULL, '2021-07-02 14:53:31', '2021-07-03 16:39:58'),
(234, 'dfe13424956effda6f2bc424df005397', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 1, NULL, '2021-07-02 14:53:31', '2021-07-05 13:22:02'),
(235, 'dfe13424956effda6f2bc424df005397', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 1, NULL, '2021-07-02 14:53:31', '2021-07-03 16:40:42'),
(236, '646a2c2e03321404e8a605d969788a06', 104, 'testserver', 'Lqu3', 2, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-02 17:05:05', '2021-07-02 17:05:05'),
(237, 'dfe13424956effda6f2bc424df005397', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 118, '0', '8505', 0, '', 0, 0, 1, NULL, '2021-07-03 12:03:05', '2021-07-05 13:09:40'),
(238, '646a2c2e03321404e8a605d969788a06', 65, 'Martini 2', 'Lqu3', 6, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-03 16:39:58', '2021-07-03 16:39:58'),
(239, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 116, '0', '9676', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-03 16:40:31', '2021-07-03 16:40:31'),
(240, '646a2c2e03321404e8a605d969788a06', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-03 16:40:42', '2021-07-03 16:40:42'),
(241, '646a2c2e03321404e8a605d969788a06', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-05 12:44:56', '2021-07-05 12:44:56'),
(242, 'dfe13424956effda6f2bc424df005397', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 118, '0', '8505', 0, '', 0, 0, 1, 'dfe13424956effda6f2bc424df005397', '2021-07-05 13:09:40', '2021-07-05 13:34:54'),
(243, 'dfe13424956effda6f2bc424df005397', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 1, 'dfe13424956effda6f2bc424df005397', '2021-07-05 13:22:02', '2021-07-05 13:35:58'),
(244, 'dfe13424956effda6f2bc424df005397', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-05 13:22:02', '2021-07-05 13:22:02'),
(245, 'dfe13424956effda6f2bc424df005397', 7, 'Gine Tonic', 'Lqu3', 56, 1, 'Sake Bar Satsko', 2, 102, '0', '0790', 0, '', 0, 0, 0, 'd6530465201d4ab86f911671203cf466', '2021-07-05 13:33:33', '2021-07-05 13:33:33'),
(246, 'd6530465201d4ab86f911671203cf466', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 118, '0', '8505', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-05 13:34:54', '2021-07-05 13:34:54'),
(247, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-05 13:35:58', '2021-07-05 13:35:58'),
(248, 'd6530465201d4ab86f911671203cf466', 102, 'Martini 3', 'Lqu3', 8, 1, 'Sake Bar Satsko', 2, 117, '0', '4923', 0, '', 0, 0, 0, 'dfe13424956effda6f2bc424df005397', '2021-07-05 13:35:58', '2021-07-05 13:35:58'),
(249, 'b8245b00dca6d2a37f1b127383eab59f', 7, 'Gine Tonic', 'Lqu3', 7, 1, 'Sake Bar Satsko', 2, 115, '0', '3547', 0, '', 0, 0, 0, '646a2c2e03321404e8a605d969788a06', '2021-07-14 01:08:38', '2021-07-14 01:08:38'),
(250, 'a97f81ac1e54c7e775771aacc3a49357', 119, 'Vodka', 'bear vadka', 10, 2, 'Prashant', 566, 119, '0', '5691', 1, '', 2, 0, 0, NULL, '2021-12-20 18:49:42', '2021-12-21 15:51:26'),
(251, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 0, 'Prashant', 566, 119, '0', '5691', 1, '', 1, 0, 0, NULL, '2021-12-20 18:49:42', '2021-12-21 18:44:26'),
(252, '4b4b7165a47354b45dfc42f2a4f20c71', 122, 'Russian bear', 'bear vadka', 10, 0, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 1, NULL, '2021-12-20 18:52:34', '2022-01-03 18:57:18'),
(253, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 22, 'Prashant', 566, 120, '0', '3082', 0, 'fcgdfgdg', -18, 0, 0, NULL, '2021-12-20 18:52:34', '2021-12-22 19:01:54'),
(254, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 43, 'Prashant', 566, 121, '0', '6923', 0, 'fcgdfgdg', -36, 0, 0, NULL, '2021-12-20 19:25:26', '2021-12-22 19:01:54'),
(255, '4b4b7165a47354b45dfc42f2a4f20c71', 122, 'Russian bear', 'bear vadka', 10, 4, 'Prashant', 566, 121, '0', '6923', 0, 'fcgdfgdg', 0, 0, 0, NULL, '2021-12-20 19:25:26', '2021-12-22 19:03:40'),
(256, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 4, 'Prashant', 566, 122, '0', '1963', 0, '', 0, 0, 0, NULL, '2021-12-20 20:34:29', '2021-12-22 19:21:18'),
(257, '4b4b7165a47354b45dfc42f2a4f20c71', 122, 'Russian bear', 'bear vadka', 10, 0, 'Prashant', 566, 122, '0', '1963', 1, '', 5, 5, 0, NULL, '2021-12-20 20:34:29', '2021-12-27 13:53:31'),
(258, 'a97f81ac1e54c7e775771aacc3a49357', 119, 'Vodka', 'bear vadka', 10, 3, 'Prashant', 566, 123, '0', '7353', 0, '', 31, 0, 0, NULL, '2021-12-21 15:43:17', '2021-12-22 11:16:15'),
(260, 'a97f81ac1e54c7e775771aacc3a49357', 127, 'world bottled beer', 'Bear', 20, 29, 'Prashant', 566, 124, '0', '9657', 0, '', 10, 0, 0, NULL, '2021-12-21 15:44:34', '2021-12-22 11:16:15'),
(261, 'a97f81ac1e54c7e775771aacc3a49357', 128, 'Kati Patand', 'Bear', 50, 29, 'Prashant', 566, 124, '0', '9657', 0, '', 10, 0, 0, NULL, '2021-12-21 15:44:34', '2021-12-22 11:16:15'),
(262, 'a97f81ac1e54c7e775771aacc3a49357', 119, 'Vodka', 'bear vadka', 10, 9, 'Prashant', 566, 124, '0', '9657', 0, '', 11, 0, 0, NULL, '2021-12-21 15:44:34', '2021-12-21 18:43:32'),
(263, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 10, 'Prashant', 566, 124, '0', '9657', 0, '', 13, 0, 0, NULL, '2021-12-21 15:44:34', '2021-12-21 18:43:32'),
(264, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 4, 'Prashant', 566, 125, '0', '0705', 0, '', 0, 0, 0, NULL, '2021-12-27 15:14:04', '2022-01-03 12:05:36'),
(265, 'a97f81ac1e54c7e775771aacc3a49357', 138, 'gjgujgju', 'bear', 10, 2, 'mahima Prajapat', 572, 126, '0', '2441', 0, '', 0, 0, 0, NULL, '2021-12-30 17:49:08', '2021-12-30 17:49:08'),
(266, 'a97f81ac1e54c7e775771aacc3a49357', 139, 'wisky', 'bear', 12, 1, 'mahima Prajapat', 572, 126, '0', '2441', 0, '', 0, 0, 0, NULL, '2021-12-30 17:49:08', '2021-12-30 17:49:08'),
(267, 'a97f81ac1e54c7e775771aacc3a49357', 119, 'Vodka', 'bear vadka', 10, 1, 'Prashant', 566, 125, '0', '0705', 0, '', 0, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2021-12-30 20:12:26', '2021-12-30 20:12:26'),
(268, '4b4b7165a47354b45dfc42f2a4f20c71', 151, 'dvsdv', 'wisky', 11, 1, 'mahima Prajapat', 574, 127, '1', '9132', 0, '', 0, 0, 0, NULL, '2021-12-31 16:07:18', '2022-01-03 15:55:37'),
(269, '4b4b7165a47354b45dfc42f2a4f20c71', 150, 'dfs', 'wisky', 11, 1, 'mahima Prajapat', 574, 127, '1', '9132', 0, '', 0, 0, 0, NULL, '2021-12-31 16:07:18', '2022-01-03 15:55:37'),
(270, '4b4b7165a47354b45dfc42f2a4f20c71', 152, 'vdvsdb', 'wisky', 10, 13, 'mahima Prajapat', 574, 128, '1', '2636', 0, '', 0, 0, 0, NULL, '2022-01-03 12:00:51', '2022-01-03 15:55:37');
INSERT INTO `t_order` (`order_id`, `user_id`, `menu_id`, `drink_name`, `category_name`, `price`, `quantity`, `bar_name`, `bar_id`, `payment_id`, `order_status`, `order_pin`, `is_redeemed`, `details`, `redeemQuantity`, `tip`, `is_regifted`, `senders_id`, `created_at`, `updated_at`) VALUES
(271, 'a97f81ac1e54c7e775771aacc3a49357', 119, 'Vodka', 'bear vadka', 10, 1, 'Prashant', 566, 125, '0', '0705', 0, '', 0, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 12:05:36', '2022-01-03 12:05:36'),
(272, 'a97f81ac1e54c7e775771aacc3a49357', 152, 'vdvsdb', 'wisky', 10, 4, 'mahima Prajapat', 574, 128, '1', '2636', 0, '', 0, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 12:08:31', '2022-01-25 19:11:59'),
(273, 'a97f81ac1e54c7e775771aacc3a49357', 152, 'vdvsdb', 'wisky', 10, 1, 'mahima Prajapat', 574, 128, '1', '2636', 0, '', 0, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 14:16:34', '2022-01-25 19:11:59'),
(274, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 1, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 14:17:18', '2022-01-03 14:17:18'),
(275, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 1, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 14:17:43', '2022-01-03 14:17:43'),
(276, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 1, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 18:23:18', '2022-01-03 18:23:18'),
(277, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 1, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 18:27:38', '2022-01-03 18:27:38'),
(278, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 1, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 18:27:58', '2022-01-03 18:27:58'),
(279, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 14, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 18:51:50', '2022-01-03 18:51:50'),
(280, 'a97f81ac1e54c7e775771aacc3a49357', 122, 'Russian bear', 'bear vadka', 10, 20, 'Prashant', 566, 120, '0', '3082', 0, '', -36, 0, 0, '4b4b7165a47354b45dfc42f2a4f20c71', '2022-01-03 18:57:18', '2022-01-03 18:57:18'),
(281, '4b4b7165a47354b45dfc42f2a4f20c71', 121, 'Pizza', 'pizza', 20, 1, 'Prashant', 566, 129, '0', '0650', 0, '', 0, 0, 0, NULL, '2022-01-06 16:49:38', '2022-01-06 16:49:38'),
(282, '4b4b7165a47354b45dfc42f2a4f20c71', 123, 'Homemade Pizza', 'pizza', 5, 1, 'Prashant', 566, 129, '0', '0650', 0, '', 0, 0, 0, NULL, '2022-01-06 16:49:38', '2022-01-06 16:49:38'),
(283, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 2, 'Prashant', 566, 130, '0', '2161', 0, '', 0, 0, 0, NULL, '2022-01-12 11:51:01', '2022-01-12 11:51:01'),
(284, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 1, 'Prashant', 566, 131, '0', '2369', 0, '', 0, 0, 0, NULL, '2022-02-02 13:34:53', '2022-02-02 13:34:53'),
(285, '4b4b7165a47354b45dfc42f2a4f20c71', 119, 'Vodka', 'bear vadka', 10, 2, 'Prashant', 566, 132, '0', '7930', 0, '', 0, 0, 0, NULL, '2022-02-02 13:37:02', '2022-02-02 13:37:02'),
(286, '4b4b7165a47354b45dfc42f2a4f20c71', 122, 'Russian bear', 'bear vadka', 10, 1, 'Prashant', 566, 132, '0', '7930', 0, '', 0, 0, 0, NULL, '2022-02-02 13:37:02', '2022-02-02 13:37:02'),
(287, '95d3cabe3fb6bcd7ac88146e05e32463', 166, 'Long Island', 'Mixed', 10, 0, 'Bay Ridge', 576, 133, '0', '0729', 0, '', 0, 0, 1, NULL, '2022-02-07 18:51:45', '2022-02-13 02:22:23'),
(288, '95d3cabe3fb6bcd7ac88146e05e32463', 178, 'Corona', 'Beer', 10, 0, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 1, NULL, '2022-02-09 01:03:33', '2022-02-13 02:22:41'),
(289, '95d3cabe3fb6bcd7ac88146e05e32463', 179, 'Budweiser', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 16:19:16'),
(290, '95d3cabe3fb6bcd7ac88146e05e32463', 180, 'Heineken', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(291, '95d3cabe3fb6bcd7ac88146e05e32463', 181, 'Bud Light', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(292, '95d3cabe3fb6bcd7ac88146e05e32463', 182, 'Stella Artois', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(293, '95d3cabe3fb6bcd7ac88146e05e32463', 183, 'Guinness', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(294, '95d3cabe3fb6bcd7ac88146e05e32463', 185, 'Dos Equis', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(295, '95d3cabe3fb6bcd7ac88146e05e32463', 184, 'Miller Lite', 'Beer', 10, 1, 'Boro Park', 579, 134, '0', '4567', 0, '', 0, 0, 0, NULL, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(296, '95d3cabe3fb6bcd7ac88146e05e32463', 166, 'Long Island', 'Mixed', 10, 1, 'Bay Ridge', 576, 135, '0', '3121', 0, '', 0, 0, 0, NULL, '2022-02-09 04:05:09', '2022-02-09 04:05:09'),
(297, '95d3cabe3fb6bcd7ac88146e05e32463', 171, 'Mojito', 'Mixed', 10, 1, 'Bay Ridge', 576, 135, '0', '3121', 0, '', 0, 0, 0, NULL, '2022-02-09 04:05:09', '2022-02-09 04:05:09'),
(298, '95d3cabe3fb6bcd7ac88146e05e32463', 176, 'Bloody Mary', 'classic Coctail', 10, 1, 'Boro Park', 579, 136, '0', '5243', 0, '', 0, 0, 0, NULL, '2022-02-09 04:18:57', '2022-02-09 04:18:57'),
(299, '95d3cabe3fb6bcd7ac88146e05e32463', 177, 'Tom Collins', 'classic Coctail', 10, 1, 'Boro Park', 579, 136, '0', '5243', 0, '', 0, 0, 0, NULL, '2022-02-09 04:18:57', '2022-02-09 04:18:57'),
(300, '95d3cabe3fb6bcd7ac88146e05e32463', 178, 'Corona', 'Beer', 10, 2, 'Boro Park', 579, 137, '0', '7237', 0, '', 0, 0, 0, NULL, '2022-02-09 16:18:10', '2022-02-09 16:18:10'),
(301, '95d3cabe3fb6bcd7ac88146e05e32463', 179, 'Budweiser', 'Beer', 10, 2, 'Boro Park', 579, 137, '0', '7237', 0, '', 0, 0, 0, NULL, '2022-02-09 16:18:10', '2022-02-09 16:18:10'),
(302, '95d3cabe3fb6bcd7ac88146e05e32463', 180, 'Heineken', 'Beer', 10, 2, 'Boro Park', 579, 137, '0', '7237', 0, '', 0, 0, 0, NULL, '2022-02-09 16:18:10', '2022-02-09 16:18:10'),
(303, '1889dec542525bc1b7732016faa5f8ae', 179, 'Budweiser', 'Beer', 10, 0, 'Boro Park', 579, 134, '0', '4567', 1, '', 1, 2, 0, '95d3cabe3fb6bcd7ac88146e05e32463', '2022-02-09 16:19:16', '2022-02-09 16:19:59'),
(304, 'c937098d2434c68801c94376c45638ad', 166, 'Long Island', 'Mixed', 10, 1, 'Bay Ridge', 576, 133, '0', '0729', 0, '', 0, 0, 0, '95d3cabe3fb6bcd7ac88146e05e32463', '2022-02-13 02:22:23', '2022-02-13 02:22:23'),
(305, '1889dec542525bc1b7732016faa5f8ae', 178, 'Corona', 'Beer', 10, 0, 'Boro Park', 579, 134, '0', '4567', 1, '', 1, 2, 0, '95d3cabe3fb6bcd7ac88146e05e32463', '2022-02-13 02:22:41', '2022-02-15 21:36:05'),
(306, '1889dec542525bc1b7732016faa5f8ae', 271, 'Moscow Mule', 'Classic Cocktails', 10, 2, 'Staten Island', 578, 138, '0', '0518', 0, '', 0, 0, 0, NULL, '2022-02-15 21:20:44', '2022-02-15 21:20:44'),
(307, '1889dec542525bc1b7732016faa5f8ae', 178, 'Corona', 'Beer', 10, 0, 'Boro Park', 579, 139, '0', '9231', 1, '', 4, 0, 0, NULL, '2022-02-15 21:35:30', '2022-02-15 21:46:42'),
(308, '1889dec542525bc1b7732016faa5f8ae', 178, 'Corona', 'Beer', 10, 7, 'Boro Park', 579, 140, '0', '5602', 0, '', 2, 0, 0, NULL, '2022-02-15 21:47:22', '2022-02-15 21:47:43'),
(309, '1889dec542525bc1b7732016faa5f8ae', 178, 'Corona', 'Beer', 10, 1, 'Boro Park', 579, 143, '0', '1199', 0, '', 0, 0, 0, NULL, '2022-02-25 01:37:06', '2022-02-25 01:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `t_panding_order`
--

CREATE TABLE `t_panding_order` (
  `id` bigint NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `order_id` bigint NOT NULL,
  `bar_id` int NOT NULL,
  `quantity` int NOT NULL,
  `menu_id` int DEFAULT NULL,
  `drink_name` varchar(100) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0-Panding, 1-Complete, 2-Cancelled',
  `code` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_panding_order`
--

INSERT INTO `t_panding_order` (`id`, `user_id`, `order_id`, `bar_id`, `quantity`, `menu_id`, `drink_name`, `category_name`, `status`, `code`, `created_at`, `updated_at`) VALUES
(20, '1889dec542525bc1b7732016faa5f8ae', 303, 579, 1, 179, 'Budweiser', 'Beer', '0', 487, '2022-02-09 16:19:59', '2022-02-09 16:19:59'),
(21, '1889dec542525bc1b7732016faa5f8ae', 305, 579, 1, 178, 'Corona', 'Beer', '0', 9870, '2022-02-15 21:36:05', '2022-02-15 21:36:05'),
(22, '1889dec542525bc1b7732016faa5f8ae', 307, 579, 1, 178, 'Corona', 'Beer', '0', 557, '2022-02-15 21:36:56', '2022-02-15 21:36:56'),
(23, '1889dec542525bc1b7732016faa5f8ae', 307, 579, 3, 178, 'Corona', 'Beer', '0', 1832, '2022-02-15 21:46:42', '2022-02-15 21:46:42'),
(24, '1889dec542525bc1b7732016faa5f8ae', 308, 579, 2, 178, 'Corona', 'Beer', '0', 9228, '2022-02-15 21:47:43', '2022-02-15 21:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `t_payment`
--

CREATE TABLE `t_payment` (
  `payment_id` int NOT NULL,
  `bar_id` int NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_payment`
--

INSERT INTO `t_payment` (`payment_id`, `bar_id`, `user_id`, `transaction_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'txn_1Hx8FuItWqDMUx2bx4lwxGDI', 5, '2020-12-01 15:20:23', '2020-12-01 15:20:23'),
(2, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1Hx9GtItWqDMUx2biBctu17j', 8, '2020-12-11 16:25:28', '2020-12-11 16:25:28'),
(3, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1Hx9MEItWqDMUx2bV5gggVqs', 8, '2020-12-11 16:30:58', '2020-12-11 16:30:58'),
(4, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1Hx9PNItWqDMUx2b5CObinEz', 8, '2020-12-11 16:34:13', '2020-12-11 16:34:13'),
(5, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBLVItWqDMUx2bXykAyBDR', 8, '2020-12-11 18:38:22', '2020-12-11 18:38:22'),
(6, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBMvItWqDMUx2bcJaJ2gqf', 8, '2020-12-11 18:39:50', '2020-12-11 18:39:50'),
(7, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBNpItWqDMUx2btdT0ARsP', 8, '2020-12-11 18:40:46', '2020-12-11 18:40:46'),
(8, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBSeItWqDMUx2bqrVVOxG2', 8, '2020-12-11 18:45:45', '2020-12-11 18:45:45'),
(9, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBTwItWqDMUx2bOVEXX2M8', 8, '2020-12-11 18:47:04', '2020-12-11 18:47:04'),
(10, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBUvItWqDMUx2ba3UrFOwh', 8, '2020-12-11 18:48:06', '2020-12-11 18:48:06'),
(11, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBVuItWqDMUx2b6xQSOAFR', 8, '2020-12-11 18:49:06', '2020-12-11 18:49:06'),
(12, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBc9ItWqDMUx2bTcuGImKz', 8, '2020-12-11 18:55:34', '2020-12-11 18:55:34'),
(13, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBcjItWqDMUx2bxpIFpCgc', 8, '2020-12-11 18:56:09', '2020-12-11 18:56:09'),
(14, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBeDItWqDMUx2bZIwcq6dZ', 10, '2020-12-11 18:57:42', '2020-12-11 18:57:42'),
(15, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxBtFItWqDMUx2bGddr5Lv0', 6, '2020-12-11 19:13:14', '2020-12-11 19:13:14'),
(16, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxC8fItWqDMUx2by4vecpjz', 10, '2020-12-11 19:29:09', '2020-12-11 19:29:09'),
(17, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxC9EItWqDMUx2bL80OACco', 10, '2020-12-11 19:29:45', '2020-12-11 19:29:45'),
(18, 2, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'txn_1HxCMaItWqDMUx2bOe4p7csV', 5, '2020-12-11 19:43:33', '2020-12-11 19:43:33'),
(19, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxCZIItWqDMUx2bDv7rqBXp', 7, '2020-12-11 19:56:41', '2020-12-11 19:56:41'),
(20, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxD8eItWqDMUx2bttiNIeuz', 6, '2020-12-11 20:33:12', '2020-12-11 20:33:12'),
(21, 2, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'txn_1HxDFHItWqDMUx2bdiebWnAj', 10, '2020-12-14 20:40:03', '2020-12-11 20:40:03'),
(22, 2, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'txn_1HxDGnItWqDMUx2buWZ7lcd4', 10, '2020-12-15 20:41:37', '2020-12-11 20:41:37'),
(23, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1HxDJzItWqDMUx2bVGoKn7f5', 8, '2020-12-18 20:44:55', '2020-12-14 20:44:55'),
(24, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1I2eqmItWqDMUx2bMloThcXz', 56, '2020-12-26 21:09:33', '2020-12-26 21:09:33'),
(25, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1I3eszItWqDMUx2bMLy8ivrQ', 2, '2020-12-29 15:24:00', '2020-12-29 15:24:00'),
(26, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1I3jiJItWqDMUx2bZM1j09aQ', 56, '2020-12-29 20:33:19', '2020-12-29 20:33:19'),
(27, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1I3jj1ItWqDMUx2bC0KiI2dF', 8, '2020-12-29 20:34:02', '2020-12-29 20:34:02'),
(28, 2, 'rwf4t364tgege5', 'txn_1I7hnmItWqDMUx2bDp4XhvbK', 8, '2021-01-09 19:19:33', '2021-01-09 19:19:33'),
(29, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IAyceItWqDMUx2byyFnIIaQ', 170, '2021-01-18 19:53:44', '2021-01-18 19:53:44'),
(30, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IAyjsItWqDMUx2b6LEJKaxC', 170, '2021-01-18 20:01:12', '2021-01-18 20:01:12'),
(31, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IAywIItWqDMUx2bE7sjkk3k', 14, '2021-01-18 20:14:02', '2021-01-18 20:14:02'),
(32, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IAzLUItWqDMUx2bYMm9yfgB', 7, '2021-01-18 20:40:04', '2021-01-18 20:40:04'),
(33, 2, '27338af4c76bf696e3851677e375fa79', 'txn_1IBDuTItWqDMUx2bihzNLoOH', 6, '2021-01-19 12:13:09', '2021-01-19 12:13:09'),
(34, 3, 'ae97274d50d1775c1b4089359644b503', 'txn_1IGnDoItWqDMUx2b8Ox2KZHQ', 210, '2021-02-03 20:55:00', '2021-02-03 20:55:00'),
(35, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IH1jrItWqDMUx2bPMuSoh07', 100, '2021-02-04 12:25:05', '2021-02-04 12:25:05'),
(36, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IH1kFItWqDMUx2bdlgnpYwF', 100, '2021-02-04 12:25:28', '2021-02-04 12:25:28'),
(37, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IL0NnItWqDMUx2bSZSOf9s4', 56, '2021-02-15 11:46:55', '2021-02-15 11:46:55'),
(38, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IL0PaItWqDMUx2bRNFwdsdp', 2, '2021-02-15 11:48:46', '2021-02-15 11:48:46'),
(39, 3, 'd6530465201d4ab86f911671203cf466', 'txn_1IL0RYItWqDMUx2b9fxNMbA2', 14, '2021-02-15 11:50:48', '2021-02-15 11:50:48'),
(40, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IL4bbItWqDMUx2bN87PgCbA', 14, '2021-02-15 16:17:28', '2021-02-15 16:17:28'),
(41, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1INcbeItWqDMUx2b7jrJxuCR', 156, '2021-02-22 16:59:46', '2021-02-22 16:59:46'),
(42, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1INwPaItWqDMUx2blDi2dSr2', 56, '2021-02-23 14:08:39', '2021-02-23 14:08:39'),
(43, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1INwi1ItWqDMUx2bslmaLBD6', 56, '2021-02-23 14:27:42', '2021-02-23 14:27:42'),
(44, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1INz4BItWqDMUx2bpy0RRKp3', 56, '2021-02-23 16:58:45', '2021-02-23 16:58:45'),
(45, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1INzKkItWqDMUx2bC4x5zxfP', 112, '2021-02-23 17:15:51', '2021-02-23 17:15:51'),
(46, 2, 'rwf4t364tgege5', 'txn_1IO04xItWqDMUx2bUYzjyNTI', 56, '2021-02-23 18:03:36', '2021-02-23 18:03:36'),
(47, 2, 'rwf4t364tgege5', 'txn_1IO2boItWqDMUx2bxZfDtJ0O', 168, '2021-02-23 20:45:41', '2021-02-23 20:45:41'),
(48, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IOIH4ItWqDMUx2bh4UaUd9w', 8, '2021-02-24 13:29:20', '2021-02-24 13:29:20'),
(49, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1ISgANItWqDMUx2bwAo3Umh2', 4, '2021-03-08 15:48:34', '2021-03-08 15:48:34'),
(50, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWkgOItWqDMUx2b1Km0jlCL', 10, '2021-03-19 21:26:39', '2021-03-19 21:26:39'),
(51, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWyjPItWqDMUx2bnNMX4me7', 10, '2021-03-20 12:26:41', '2021-03-20 12:26:41'),
(52, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWywMItWqDMUx2bkqGe7SC0', 10, '2021-03-20 12:40:05', '2021-03-20 12:40:05'),
(53, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWz2YItWqDMUx2biIpelq9V', 14, '2021-03-20 12:46:29', '2021-03-20 12:46:29'),
(54, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWz2uItWqDMUx2bqSKxQYVA', 14, '2021-03-20 12:46:51', '2021-03-20 12:46:51'),
(55, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWzILItWqDMUx2boNCeSPrW', 14, '2021-03-20 13:02:48', '2021-03-20 13:02:48'),
(56, 5, 'ae97274d50d1775c1b4089359644b503', 'txn_1IWzIsItWqDMUx2bLW9ZIFOY', 14, '2021-03-20 13:03:21', '2021-03-20 13:03:21'),
(57, 4, 'ae97274d50d1775c1b4089359644b503', 'txn_1IYV4sItWqDMUx2baiHASMrs', 13, '2021-03-24 17:11:13', '2021-03-24 17:11:13'),
(58, 2, 'ae97274d50d1775c1b4089359644b503', 'txn_1IYqV4ItWqDMUx2b5CW9jhOP', 56, '2021-03-25 16:03:10', '2021-03-25 16:03:10'),
(59, 4, 'ae97274d50d1775c1b4089359644b503', 'txn_1IYqZ9ItWqDMUx2bAg5e3GOI', 13, '2021-03-25 16:07:23', '2021-03-25 16:07:23'),
(60, 2, 'rwf4t364tgege5', 'txn_1Ib5xIItWqDMUx2bUF6LyEO2', 56, '2021-03-31 20:57:42', '2021-03-31 20:57:42'),
(61, 2, 'rwf4t364tgege5', 'txn_1Ib6K8ItWqDMUx2bTlVkn5He', 16, '2021-03-31 21:21:17', '2021-03-31 21:21:17'),
(62, 3, 'rwf4t364tgege5', 'txn_1Ib6LVItWqDMUx2bpvEq06O2', 56, '2021-03-31 21:22:43', '2021-03-31 21:22:43'),
(63, 2, 'ec55324cb8115ffa811876184636a4c3', 'txn_1Ib6QoItWqDMUx2bSPKzrDMa', 152, '2021-03-31 21:28:12', '2021-03-31 21:28:12'),
(64, 2, 'ec55324cb8115ffa811876184636a4c3', 'txn_1Ib6R9ItWqDMUx2bBHXDounY', 152, '2021-03-31 21:28:33', '2021-03-31 21:28:33'),
(65, 2, 'ec55324cb8115ffa811876184636a4c3', 'txn_1Ib6RjItWqDMUx2bctgo91Pw', 152, '2021-03-31 21:29:09', '2021-03-31 21:29:09'),
(66, 3, 'ec55324cb8115ffa811876184636a4c3', 'txn_1Ib6TgItWqDMUx2bzswWmTy3', 140, '2021-03-31 21:31:10', '2021-03-31 21:31:10'),
(67, 2, 'rwf4t364tgege5', 'txn_1IbOAkItWqDMUx2baV3pXbsS', 56, '2021-04-01 16:24:49', '2021-04-01 16:24:49'),
(68, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IbRGOItWqDMUx2bAOowkRFo', 56, '2021-04-01 19:42:51', '2021-04-01 19:42:51'),
(69, 2, '96992bb4290476b37a2f161dc259c8b2', 'txn_1IbWJhItWqDMUx2bgkFTtPri', 1344, '2021-04-02 01:06:36', '2021-04-02 01:06:36'),
(70, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IbWOTItWqDMUx2biOm588Ov', 56, '2021-04-02 01:11:32', '2021-04-02 01:11:32'),
(71, 2, 'ec55324cb8115ffa811876184636a4c3', 'txn_1IbwzjItWqDMUx2bn3mIGFSS', 56, '2021-04-03 05:35:48', '2021-04-03 05:35:48'),
(72, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1Icf36ItWqDMUx2bWzhzSLhf', 56, '2021-04-05 04:38:14', '2021-04-05 04:38:14'),
(73, 2, '96992bb4290476b37a2f161dc259c8b2', 'txn_1IcrAhItWqDMUx2bPvrrb5QG', 56, '2021-04-05 17:34:54', '2021-04-05 17:34:54'),
(74, 2, '1d1ea9623dbcafd48a89f05e5a8a670a', 'txn_1IfNnOItWqDMUx2bJ3kbmtw5', 3, '2021-04-12 16:48:59', '2021-04-12 16:48:59'),
(75, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IfZIQItWqDMUx2bkawF3Bj9', 2, '2021-04-13 05:05:47', '2021-04-13 05:05:47'),
(76, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IfZIoItWqDMUx2b0dXqWOhb', 14, '2021-04-13 05:06:12', '2021-04-13 05:06:12'),
(77, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IfZK5ItWqDMUx2bfza6Nvom', 14, '2021-04-13 05:07:31', '2021-04-13 05:07:31'),
(78, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IfZKQItWqDMUx2bGBNnj3Yg', 14, '2021-04-13 05:07:51', '2021-04-13 05:07:51'),
(79, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IfZL1ItWqDMUx2b1N5FrMOE', 14, '2021-04-13 05:08:29', '2021-04-13 05:08:29'),
(80, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IfZNXItWqDMUx2bFPMixVf2', 30, '2021-04-13 05:11:05', '2021-04-13 05:11:05'),
(81, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IfsQRItWqDMUx2bsUXVdiob', 8, '2021-04-14 01:31:21', '2021-04-14 01:31:21'),
(82, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1Ifwd2ItWqDMUx2bOTSoXkz5', 47, '2021-04-14 06:00:39', '2021-04-14 06:00:39'),
(83, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IgK4rItWqDMUx2bC18DQZge', 16, '2021-04-15 07:02:57', '2021-04-15 07:02:57'),
(84, 1, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IgKC0ItWqDMUx2bP7bE4pVY', 10, '2021-04-15 07:10:20', '2021-04-15 07:10:20'),
(85, 3, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IgKIPItWqDMUx2bqbajMzL2', 56, '2021-04-15 07:16:57', '2021-04-15 07:16:57'),
(86, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IhDXxItWqDMUx2b5kJmt5ET', 168, '2021-04-17 18:16:43', '2021-04-17 18:16:43'),
(87, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IhJcyItWqDMUx2btOwI9x6M', 56, '2021-04-18 00:46:19', '2021-04-18 00:46:19'),
(88, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IhJiPItWqDMUx2bSvojhtsn', 48, '2021-04-18 00:51:55', '2021-04-18 00:51:55'),
(89, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IhLN5ItWqDMUx2bYrxn9Aif', 50, '2021-04-18 02:38:01', '2021-04-18 02:38:01'),
(90, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IhOaCItWqDMUx2bXb1KFIpd', 14, '2021-04-18 06:03:47', '2021-04-18 06:03:47'),
(91, 2, 'rwf4t364tgege5', 'txn_1IkCCKItWqDMUx2bUi8olx1H', 56, '2021-04-25 23:26:50', '2021-04-25 23:26:50'),
(92, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IppnkItWqDMUx2bKQk2iZuo', 112, '2021-05-11 12:45:01', '2021-05-11 12:45:01'),
(93, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IprUlItWqDMUx2bwT2trDWD', 75, '2021-05-11 14:33:33', '2021-05-11 14:33:33'),
(94, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1Ipre7ItWqDMUx2bShmtCAIP', 70, '2021-05-11 14:43:13', '2021-05-11 14:43:13'),
(95, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IptSVItWqDMUx2bMEWSX4OE', 70, '2021-05-11 16:39:22', '2021-05-11 16:39:22'),
(96, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1Iptd7ItWqDMUx2bZM0nHjyz', 72, '2021-05-11 16:50:19', '2021-05-11 16:50:19'),
(97, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IqB8yItWqDMUx2bfUm5ydCY', 72, '2021-05-12 11:32:22', '2021-05-12 11:32:22'),
(98, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IqCE3ItWqDMUx2bHJ0SCw5h', 72, '2021-05-12 12:41:42', '2021-05-12 12:41:42'),
(99, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1Is81rItWqDMUx2bdOS12wRu', 56, '2021-05-17 20:37:11', '2021-05-17 20:37:11'),
(100, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1Is83FItWqDMUx2bKhwymcWU', 62, '2021-05-17 20:38:36', '2021-05-17 20:38:36'),
(101, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IsN23ItWqDMUx2byWf8NDlB', 56, '2021-05-18 12:38:23', '2021-05-18 12:38:23'),
(102, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IsN4jItWqDMUx2b4eVfYhoX', 70, '2021-05-18 12:41:10', '2021-05-18 12:41:10'),
(103, 2, 'd6530465201d4ab86f911671203cf466', 'txn_1IsND3ItWqDMUx2bkVPbAlxL', 16, '2021-05-18 12:49:45', '2021-05-18 12:49:45'),
(104, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IszQSItWqDMUx2bDoZpHenS', 56, '2021-05-20 05:38:10', '2021-05-20 05:38:10'),
(105, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1IszRAItWqDMUx2bG5UxiTZK', 8, '2021-05-20 05:38:55', '2021-05-20 05:38:55'),
(106, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IvBVDItWqDMUx2bNqmhTUf7', 7, '2021-05-26 06:56:15', '2021-05-26 06:56:15'),
(107, 2, '1d1ea9623dbcafd48a89f05e5a8a670a', 'txn_1IvBYhItWqDMUx2bqUx0Zdza', 7, '2021-05-26 06:59:51', '2021-05-26 06:59:51'),
(108, 2, 'b8245b00dca6d2a37f1b127383eab59f', 'txn_1IvBb0ItWqDMUx2b5IQl5RBU', 2, '2021-05-26 07:02:14', '2021-05-26 07:02:14'),
(109, 1, '1d1ea9623dbcafd48a89f05e5a8a670a', 'txn_1IvBbvItWqDMUx2bRhyCHDuw', 10, '2021-05-26 07:03:11', '2021-05-26 07:03:11'),
(110, 2, '89bccbbe030f4a7d6644e3573125c96c', 'txn_1IyO8FItWqDMUx2b1io2rFdS', 6, '2021-06-04 03:00:32', '2021-06-04 03:00:32'),
(111, 2, '89bccbbe030f4a7d6644e3573125c96c', 'txn_1IyO8xItWqDMUx2bli0G4t7e', 14, '2021-06-04 03:01:16', '2021-06-04 03:01:16'),
(112, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1J5GWaItWqDMUx2btjY871q6', 7, '2021-06-23 02:17:55', '2021-06-23 02:17:55'),
(113, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1J5GX2ItWqDMUx2bi0ruceUB', 7, '2021-06-23 02:18:23', '2021-06-23 02:18:23'),
(114, 2, '646a2c2e03321404e8a605d969788a06', 'txn_1J5GZBItWqDMUx2bRIZb5nfM', 7, '2021-06-23 02:20:37', '2021-06-23 02:20:37'),
(115, 2, 'dfe13424956effda6f2bc424df005397', 'txn_1J8LnlItWqDMUx2b1ZunSTD1', 23, '2021-07-01 14:32:23', '2021-07-01 14:32:23'),
(116, 2, 'dfe13424956effda6f2bc424df005397', 'txn_1J8LsMItWqDMUx2bhQcInLGc', 8, '2021-07-01 14:37:08', '2021-07-01 14:37:08'),
(117, 2, 'dfe13424956effda6f2bc424df005397', 'txn_1J8ibkItWqDMUx2bOWP0vFUI', 21, '2021-07-02 14:53:31', '2021-07-02 14:53:31'),
(118, 2, 'dfe13424956effda6f2bc424df005397', 'txn_1J92QLItWqDMUx2bVhAMixFb', 7, '2021-07-03 12:03:05', '2021-07-03 12:03:05'),
(119, 566, 'a97f81ac1e54c7e775771aacc3a49357', 'txn_3K8lnGItWqDMUx2b2CX7RJEx', 30, '2021-12-20 18:49:42', '2021-12-20 18:49:42'),
(120, 566, 'a97f81ac1e54c7e775771aacc3a49357', 'txn_3K8lq1ItWqDMUx2b1GY6Ct8w', 20, '2021-12-20 18:52:34', '2021-12-20 18:52:34'),
(121, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3K8mLpItWqDMUx2b1wFCgewW', 40, '2021-12-20 19:25:26', '2021-12-20 19:25:26'),
(122, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3K8nQeItWqDMUx2b1aJWSHaz', 40, '2021-12-20 20:34:29', '2021-12-20 20:34:29'),
(123, 566, 'a97f81ac1e54c7e775771aacc3a49357', 'txn_3K95MOItWqDMUx2b2tsZdw3T', 680, '2021-12-21 15:43:17', '2021-12-21 15:43:17'),
(124, 566, 'a97f81ac1e54c7e775771aacc3a49357', 'txn_3K95NdItWqDMUx2b1nwvT7p9', 3160, '2021-12-21 15:44:34', '2021-12-21 15:44:34'),
(125, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KBFkNItWqDMUx2b2UMJ9SPS', 10, '2021-12-27 15:14:04', '2021-12-27 15:14:04'),
(126, 572, 'a97f81ac1e54c7e775771aacc3a49357', 'txn_3KCNb5ItWqDMUx2b0q8kPk7o', 32, '2021-12-30 17:49:08', '2021-12-30 17:49:08'),
(127, 574, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KCiU5ItWqDMUx2b0x0Y3w8q', 22, '2021-12-31 16:07:18', '2021-12-31 16:07:18'),
(128, 574, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KDk4EItWqDMUx2b00jYWpUI', 180, '2022-01-03 12:00:51', '2022-01-03 12:00:51'),
(129, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KEu0LItWqDMUx2b1o0P4V40', 25, '2022-01-06 16:49:38', '2022-01-06 16:49:38'),
(130, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KH0CeItWqDMUx2b1LFVK6z0', 20, '2022-01-12 11:51:01', '2022-01-12 11:51:01'),
(131, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KOdpgItWqDMUx2b0h3vdNXD', 10, '2022-02-02 13:34:53', '2022-02-02 13:34:53'),
(132, 566, '4b4b7165a47354b45dfc42f2a4f20c71', 'txn_3KOdrlItWqDMUx2b0DsjZNtK', 30, '2022-02-02 13:37:02', '2022-02-02 13:37:02'),
(133, 576, '95d3cabe3fb6bcd7ac88146e05e32463', 'txn_3KQXA4ItWqDMUx2b09M0i1VT', 10, '2022-02-07 18:51:45', '2022-02-07 18:51:45'),
(134, 579, '95d3cabe3fb6bcd7ac88146e05e32463', 'txn_3KQzRQItWqDMUx2b1JsLVUIH', 90, '2022-02-09 01:03:33', '2022-02-09 01:03:33'),
(135, 576, '95d3cabe3fb6bcd7ac88146e05e32463', 'txn_3KR2HAItWqDMUx2b2mRUg8ww', 20, '2022-02-09 04:05:09', '2022-02-09 04:05:09'),
(136, 579, '95d3cabe3fb6bcd7ac88146e05e32463', 'txn_3KR2UWItWqDMUx2b2p3bjGJ6', 20, '2022-02-09 04:18:57', '2022-02-09 04:18:57'),
(137, 579, '95d3cabe3fb6bcd7ac88146e05e32463', 'txn_3KRDiXItWqDMUx2b1Alez0Ds', 60, '2022-02-09 16:18:10', '2022-02-09 16:18:10'),
(138, 578, '1889dec542525bc1b7732016faa5f8ae', 'txn_3KTTIdItWqDMUx2b1dF6jvQd', 20, '2022-02-15 21:20:44', '2022-02-15 21:20:44'),
(139, 579, '1889dec542525bc1b7732016faa5f8ae', 'txn_3KTTWwItWqDMUx2b1L5I1XVx', 40, '2022-02-15 21:35:30', '2022-02-15 21:35:30'),
(140, 579, '1889dec542525bc1b7732016faa5f8ae', 'txn_3KTTiPItWqDMUx2b2n8FK11h', 90, '2022-02-15 21:47:22', '2022-02-15 21:47:22'),
(141, 1, 'f4513d7b71e9217190cf539ad9a5991b', 'txn_3KTYyWItWqDMUx2b27nrEDyq', 10, '2022-02-16 03:24:20', '2022-02-16 03:24:20'),
(142, 5, 'f4513d7b71e9217190cf539ad9a5991b', 'txn_3KTZ03ItWqDMUx2b0Wiqya5L', 14, '2022-02-16 03:25:56', '2022-02-16 03:25:56'),
(143, 579, '1889dec542525bc1b7732016faa5f8ae', 'txn_3KWnafItWqDMUx2b0uqbI8JY', 10, '2022-02-25 01:37:06', '2022-02-25 01:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `t_payment_details`
--

CREATE TABLE `t_payment_details` (
  `id` int NOT NULL,
  `payment_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `price` double NOT NULL,
  `bar_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_possible_checked_in`
--

CREATE TABLE `t_possible_checked_in` (
  `id` int NOT NULL,
  `bar_id` int NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cretaed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_possible_checked_in`
--

INSERT INTO `t_possible_checked_in` (`id`, `bar_id`, `user_id`, `cretaed_at`, `updated_at`) VALUES
(1, 2, '83432680932ab0b5f1c6ad82ead5f1c8', '2021-02-03 16:22:43', '2021-02-03 16:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `ageRange` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = +21-25, 2 = +26-31,  3 = +32-40, 4 = +41-55, 5 = +56-75, 6 = +75-100',
  `password` varchar(200) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Male, 0 = Female, Other = 2',
  `relationship_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Single, 2 = Committed, 3 = Merried, 4 = Super Available',
  `age` tinyint DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `paymentMode` enum('Paypal','Credit Card','Net Banking') NOT NULL DEFAULT 'Credit Card',
  `favourite_drink` varchar(255) DEFAULT NULL,
  `payment_gateway_id` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `login_signup_type` enum('normal','google','facebook','twitter') NOT NULL,
  `social_id` varchar(255) DEFAULT NULL,
  `interests` text,
  `about` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `forgetpassword_link` varchar(255) DEFAULT NULL,
  `is_password_link_valid` datetime DEFAULT NULL,
  `rating` double NOT NULL DEFAULT '0',
  `mood_at_bar` varchar(255) NOT NULL,
  `drunk_level` varchar(50) NOT NULL,
  `orientation` varchar(255) NOT NULL,
  `profile_completed` tinyint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `url`, `user_id`, `username`, `full_name`, `email`, `email_verified_at`, `dob`, `ageRange`, `password`, `gender`, `relationship_status`, `age`, `profileImage`, `paymentMode`, `favourite_drink`, `payment_gateway_id`, `device_type`, `device_token`, `login_signup_type`, `social_id`, `interests`, `about`, `status`, `forgetpassword_link`, `is_password_link_valid`, `rating`, `mood_at_bar`, `drunk_level`, `orientation`, `profile_completed`, `created_at`, `updated_at`) VALUES
(89, NULL, '4b4b7165a47354b45dfc42f2a4f20c71', 'aadityajain545@gmail.com', 'user1', 'aadityajain545@gmail.com', NULL, '2021-12-20', 1, '2c60a417c3a826627d19e33c52409aff', 1, 1, 0, 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/profile/163999603961c05a877e021profileImage.png', 'Credit Card', 'dud', NULL, 'android', 'edPE1ZilRomBI0svjHDD1Y:APA91bFIz6aViji-orc1EHDYoc7J2g2Qzk8W0exQbt-7Bo_G9SODsmrCdELyv7QBsgiGV111VPSM-LrRuODmR-vMVrUxSHpMdMQTxve-zDdC_OeOCwqSEvB8roE9jleKY-K-bKhKKuv3', 'normal', NULL, 'ghgfh', 'ghgfgh', 0, NULL, NULL, 2, 'Hello', 'Buzzed', 'Straight', 0, '2021-12-20 15:57:19', '2022-01-19 16:02:48'),
(90, NULL, 'a97f81ac1e54c7e775771aacc3a49357', 'neet@gmail.com', 'nitesh', 'neet@gmail.com', NULL, '1998-10-16', 1, 'e12c4fdc97e71dba3c40797fde3e7f49', 0, 2, 23, 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/profile/163999617161c05b0bd56e1profileImage.jpeg', 'Credit Card', 'dud', NULL, 'ios', 'dummy_token_#####', 'normal', NULL, 'ghgfh', 'ghgfgh', 0, NULL, NULL, 2, 'Hello', '', 'Other', 0, '2021-12-20 15:59:31', '2021-12-30 19:57:54'),
(91, NULL, '8e97dd021681beb8ac309bfda8b0a0bd', 'nitesh1998@gmail.com', 'Nitesh Prajapati', 'nitesh1998@gmail.com', NULL, '1998-01-01', 1, '4b9734d7eb8098107aaa9e676d57cbc0', 1, 1, NULL, '', 'Credit Card', 'Rum', NULL, 'IOS', '676s67868', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', '5asd', 0, '2021-12-21 14:10:44', '2021-12-21 14:10:44'),
(92, NULL, '9bd0eb91c37cece5133ccdced7b62759', 'Bittujain545@gmail.com', 'Sanity’s', 'Bittujain545@gmail.com', NULL, '1986-01-04', 1, '598d6e154dd07b5230730a249885f7f3', 0, 0, 36, '', 'Credit Card', 'Milk', NULL, 'android', 'edPE1ZilRomBI0svjHDD1Y:APA91bFIz6aViji-orc1EHDYoc7J2g2Qzk8W0exQbt-7Bo_G9SODsmrCdELyv7QBsgiGV111VPSM-LrRuODmR-vMVrUxSHpMdMQTxve-zDdC_OeOCwqSEvB8roE9jleKY-K-bKhKKuv3', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', 'Straight', 0, '2022-01-04 11:52:50', '2022-01-19 16:02:10'),
(93, NULL, '95d3cabe3fb6bcd7ac88146e05e32463', 'Barconnex@gmail.com', 'Bar Connex', 'Barconnex@gmail.com', NULL, '1986-03-25', 1, '2a484c8a671e2969ba7f7bec75987a11', 2, 2, NULL, '', 'Credit Card', 'Water', NULL, 'ios', '0bbd9582524e238498391bc8973a7a74b51e1c6f38b42c4d304ee78f3a21b012', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, 'To enhance the night', 'Sober', 'Other', 0, '2022-01-04 21:32:13', '2022-02-20 23:55:53'),
(94, NULL, '50a0b723b099f39789967978dcc29c50', 'Foo@test.com', 'Foo', 'Foo@test.com', NULL, '1992-06-14', 1, '4ce8571bb876ae255725d18a61713788', 1, 1, NULL, '', 'Credit Card', 'Foo', NULL, 'ios', 'c0b05ce341964ea5967965862701c2304054f0f61f895e02234d9b551f16cb79', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', 'Lesbian', 0, '2022-01-19 20:49:43', '2022-01-19 20:49:59'),
(95, NULL, '1889dec542525bc1b7732016faa5f8ae', 'nai.vazquez@gmail.com', 'Nai', 'nai.vazquez@gmail.com', NULL, '1986-03-25', 3, 'e10adc3949ba59abbe56e057f20f883e', 0, 3, 35, 'http://18.116.154.137/public/imageUpload/1644403324profileImage.jpg', 'Credit Card', 'Corona', NULL, 'android', 'cLSqCG_qQZKxVAHWUwj0L6:APA91bEx2dCYIQaD_0eifWyjKU0yiYZayiwDa-Yty31ra-v77yvrm5kczQQnLwX_SnRmCIwMarCAXLRg3sVpmRFizFrt9Cx6SQiymwTwNU0c8BdC2lbMYjVMvsdhdQbbAY6nmf0JuDZI', 'normal', NULL, 'n/a', 'a bit crazy', 0, NULL, NULL, 10, 'to chill', 'Sober', 'Lesbian', 1, '2022-02-09 16:04:29', '2022-02-24 04:03:53'),
(96, NULL, 'c937098d2434c68801c94376c45638ad', 'Jonacupa@yahoo.com', 'Ihona', 'Jonacupa@yahoo.com', NULL, '1985-12-06', 1, '6df1328354b39b3dfb504df187fe4016', 1, 3, NULL, 'http://18.116.154.137/public/imageUpload/1644699401profileImage.jpg', 'Credit Card', 'Spicy margarita', NULL, 'ios', '282b9c1cf145d37e1449b93fa985a8522c47bc62e0612732f6ab68b634cf07d8', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', 'Sober', 'Straight', 0, '2022-02-13 02:17:52', '2022-02-13 20:11:41'),
(97, NULL, 'f4513d7b71e9217190cf539ad9a5991b', 'peter.parker@email.ghostinspector.com', 'peter', 'peter.parker@email.ghostinspector.com', NULL, '1991-02-16', 1, '7a973876b02978f708bc79f9c6e856f3', 0, 1, 31, 'http://18.116.154.137/public/imageUpload/1644961846profileImage.jpg', 'Credit Card', 'Wine', NULL, 'ios', 'da6d77d8f81ccc5f9e48b879569eea867384fa7f627ec3a765cf93a99529e953', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, 'Party! Party!', 'Sober', 'Straight', 0, '2022-02-16 03:18:00', '2022-02-16 03:32:32'),
(98, NULL, '577e514e6d0eea75d8810171f71fa896', 'Biqatest01@gmail.com', 'Biqatest01', 'Biqatest01@gmail.com', NULL, '1994-02-18', 1, 'a40178aa27eb3d560679b642900ee10d', 0, 1, NULL, '', 'Credit Card', 'Vodka', NULL, 'ios', '64d352ec0ea643d9564a3f0bbd264eb9cba240facd7471d7218558d458e588b3', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', 'Straight', 0, '2022-02-18 08:35:29', '2022-02-18 08:35:57'),
(99, NULL, '322a019d38da7a30f1374472069d5cf5', 'Fozzyburg@aol.com', 'Moshuloo', 'Fozzyburg@aol.com', NULL, '1970-11-16', 1, 'e4f0deeffeaa284af61fecf8bf915ae9', 0, 3, NULL, '', 'Credit Card', 'Pina Colada', NULL, 'ios', 'b3e73f594ef31735751603f94b99ffaf79aa5084e676ce532052577aece070a7', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', 'Straight', 0, '2022-02-23 08:42:30', '2022-02-23 08:42:30'),
(100, NULL, '79041e11f05c4c76cbe9f5e0206ff705', 'nishantqa541@gmail.com', 'nishantqa541', 'nishantqa541@gmail.com', NULL, '1996-01-24', 1, '12bce374e7be15142e8172f668da00d8', 0, 1, 26, 'http://18.116.154.137/public/imageUpload/1645670054profileImage.jpg', 'Credit Card', 'Block', NULL, 'ios', '27426a5a36c31985b6549faac55bbf8b0780c91f947986ee502086fa9894de77', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', 'Overlimit', 'Straight', 0, '2022-02-24 07:59:34', '2022-02-25 13:35:42'),
(101, NULL, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'mayankqa541@gmail.com', 'mayankqa541', 'mayankqa541@gmail.com', NULL, '1988-02-24', 1, '12bce374e7be15142e8172f668da00d8', 0, 1, NULL, 'http://18.116.154.137/public/imageUpload/1645683162profileImage.jpg', 'Credit Card', 'Vodka', NULL, 'ios', '372fec4a57dc896f24048c70effe5f23e79b4aa3f0b0b12a13f9319c278c99fa', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, 'Y', '', 'Straight', 0, '2022-02-24 10:01:38', '2022-02-24 11:42:42'),
(102, NULL, 'c8236e0f5e73fe62d05c3be70d418f1a', 'nishantqa542@yopmail.com', 'nishantqa542', 'nishantqa542@yopmail.com', NULL, '2022-02-24', 1, '12bce374e7be15142e8172f668da00d8', 0, 2, NULL, '', 'Credit Card', 'Vodka', NULL, 'ios', '27426a5a36c31985b6549faac55bbf8b0780c91f947986ee502086fa9894de77', 'normal', NULL, NULL, NULL, 0, NULL, NULL, 0, '', '', 'Straight', 0, '2022-02-24 14:22:57', '2022-02-24 14:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_block`
--

CREATE TABLE `t_user_block` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `block_user_id` varchar(50) NOT NULL,
  `block_reason` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_block`
--

INSERT INTO `t_user_block` (`id`, `user_id`, `block_user_id`, `block_reason`, `created_at`, `updated_at`) VALUES
(1, '4bd1a3dec171def481a6bb796795b3ec', '79d9cdb6de69e921e70dc1ddde29e79e', 'ss', '2020-09-19 19:25:27', '2020-09-19 19:25:27'),
(2, '4bd1a3dec171def481a6bb796795b3ec', '979d6a9bea254f9789d65f7d2c845d05', 'sss', '2020-09-19 19:25:27', '2020-09-19 19:25:27'),
(63, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '0c4d9efd7381605c346b77a6f0ea6955', 'vgfdg', '2020-12-21 13:56:13', '2020-12-21 13:56:13'),
(65, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'c55ded365739ac1e28a24bd7efef3d8a', 'Inappropriate activity', '2020-12-22 16:46:14', '2020-12-22 16:46:14'),
(67, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'ae97274d50d1775c1b4089359644b503', 'none', '2020-12-23 16:36:18', '2020-12-23 16:36:18'),
(73, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '5561e975241669938ac63b0b1f8abe64', 'vbcvb', '2020-12-24 15:08:21', '2020-12-24 15:08:21'),
(84, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'ec55324cb8115ffa811876184636a4c3', 'sscsdcdscdscdsccd', '2020-12-24 17:12:36', '2020-12-24 17:12:36'),
(85, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'b8245b00dca6d2a37f1b127383eab59f', 'sssssss', '2020-12-24 19:15:14', '2020-12-24 19:15:14'),
(86, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '83432680932ab0b5f1c6ad82ead5f1c8', 'sfdaf', '2020-12-24 19:51:47', '2020-12-24 19:51:47'),
(102, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '79d9cdb6de69e921e70dc1ddde29e79e', 'Excessive drinking', '2020-12-31 12:32:46', '2020-12-31 12:32:46'),
(105, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 'Inappropriate activity', '2021-01-06 17:48:51', '2021-01-06 17:48:51'),
(106, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '6218ee15c737cfd4622c40f68ac27b97', 'Excessive drinking', '2021-02-05 15:04:01', '2021-02-05 15:04:01'),
(107, 'b8245b00dca6d2a37f1b127383eab59f', 'd6530465201d4ab86f911671203cf466', 'none', '2021-03-05 02:20:13', '2021-03-05 02:20:13'),
(108, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '95a66417e56ae91beb3e9c6429ba2125', 'Suspicious account', '2021-03-09 07:36:52', '2021-03-09 07:36:52'),
(113, 'ec55324cb8115ffa811876184636a4c3', '1889dec542525bc1b7732016faa5f8ae', 'none', '2022-02-28 01:20:29', '2022-02-28 01:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_door`
--

CREATE TABLE `t_user_door` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `door_text` varchar(255) NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_drink_favourite`
--

CREATE TABLE `t_user_drink_favourite` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_drink_favourite`
--

INSERT INTO `t_user_drink_favourite` (`id`, `user_id`, `bar_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(2, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, 3, '2021-01-29 16:24:14', '2021-01-29 16:24:14'),
(3, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, 35, '2021-01-29 16:55:58', '2021-01-29 16:55:58'),
(6, '5561e975241669938ac63b0b1f8abe64', 2, 109, '2021-03-02 12:09:03', '2021-03-02 12:09:03'),
(13, 'ae97274d50d1775c1b4089359644b503', 2, 7, '2021-03-04 14:42:56', '2021-03-04 14:42:56'),
(19, 'rwf4t364tgege5', 2, 110, '2021-03-09 08:10:04', '2021-03-09 08:10:04'),
(21, 'rwf4t364tgege5', 3, 110, '2021-03-09 08:10:27', '2021-03-09 08:10:27'),
(22, '96992bb4290476b37a2f161dc259c8b2', 3, 112, '2021-04-02 01:10:26', '2021-04-02 01:10:26'),
(23, 'ec55324cb8115ffa811876184636a4c3', 2, 7, '2021-04-02 05:04:53', '2021-04-02 05:04:53'),
(24, 'ec55324cb8115ffa811876184636a4c3', 2, 65, '2021-04-02 05:04:54', '2021-04-02 05:04:54'),
(25, '646a2c2e03321404e8a605d969788a06', 2, 7, '2021-04-14 05:58:33', '2021-04-14 05:58:33'),
(26, '646a2c2e03321404e8a605d969788a06', 2, 102, '2021-04-14 05:58:33', '2021-04-14 05:58:33'),
(27, '646a2c2e03321404e8a605d969788a06', 2, 104, '2021-04-14 05:58:34', '2021-04-14 05:58:34'),
(28, '646a2c2e03321404e8a605d969788a06', 2, 65, '2021-04-14 05:58:34', '2021-04-14 05:58:34'),
(29, '646a2c2e03321404e8a605d969788a06', 2, 109, '2021-04-14 05:58:37', '2021-04-14 05:58:37'),
(30, '646a2c2e03321404e8a605d969788a06', 2, 41, '2021-04-14 05:58:41', '2021-04-14 05:58:41'),
(31, '646a2c2e03321404e8a605d969788a06', 2, 43, '2021-04-14 05:58:42', '2021-04-14 05:58:42'),
(32, '646a2c2e03321404e8a605d969788a06', 2, 39, '2021-04-14 05:58:43', '2021-04-14 05:58:43'),
(33, '646a2c2e03321404e8a605d969788a06', 2, 110, '2021-04-15 07:02:24', '2021-04-15 07:02:24'),
(34, 'b8245b00dca6d2a37f1b127383eab59f', 3, 112, '2021-04-15 07:16:27', '2021-04-15 07:16:27'),
(35, '646a2c2e03321404e8a605d969788a06', 2, 114, '2021-04-18 02:37:27', '2021-04-18 02:37:27'),
(36, 'd6530465201d4ab86f911671203cf466', 2, 8, '2021-05-18 12:49:59', '2021-05-18 12:49:59'),
(52, '95d3cabe3fb6bcd7ac88146e05e32463', 579, 178, '2022-02-09 01:04:20', '2022-02-09 01:04:20'),
(53, '95d3cabe3fb6bcd7ac88146e05e32463', 579, 179, '2022-02-09 01:04:20', '2022-02-09 01:04:20'),
(54, '95d3cabe3fb6bcd7ac88146e05e32463', 579, 180, '2022-02-09 01:04:21', '2022-02-09 01:04:21'),
(55, '95d3cabe3fb6bcd7ac88146e05e32463', 579, 181, '2022-02-09 01:04:21', '2022-02-09 01:04:21'),
(56, '1889dec542525bc1b7732016faa5f8ae', 576, 171, '2022-02-09 16:15:39', '2022-02-09 16:15:39'),
(57, '1889dec542525bc1b7732016faa5f8ae', 576, 166, '2022-02-09 16:15:40', '2022-02-09 16:15:40'),
(58, '79041e11f05c4c76cbe9f5e0206ff705', 579, 178, '2022-02-24 09:51:21', '2022-02-24 09:51:21'),
(59, '79041e11f05c4c76cbe9f5e0206ff705', 579, 179, '2022-02-24 09:51:22', '2022-02-24 09:51:22'),
(60, '79041e11f05c4c76cbe9f5e0206ff705', 579, 180, '2022-02-24 09:51:24', '2022-02-24 09:51:24'),
(61, '79041e11f05c4c76cbe9f5e0206ff705', 579, 172, '2022-02-24 09:51:31', '2022-02-24 09:51:31'),
(62, '79041e11f05c4c76cbe9f5e0206ff705', 577, 231, '2022-02-24 15:10:46', '2022-02-24 15:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_event_checkin`
--

CREATE TABLE `t_user_event_checkin` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int NOT NULL,
  `event_id` int NOT NULL,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_event_checkin`
--

INSERT INTO `t_user_event_checkin` (`id`, `user_id`, `bar_id`, `event_id`, `checkin_date`, `checkin_time`, `created_at`, `updated_at`) VALUES
(1, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-02', '14:21:43', 0, 0),
(2, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '14:23:04', 0, 0),
(3, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '14:23:18', 0, 0),
(4, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '15:47:23', 0, 0),
(5, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '15:47:27', 0, 0),
(6, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '15:55:50', 0, 0),
(7, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '16:00:49', 0, 0),
(8, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '16:03:30', 0, 0),
(9, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '16:03:38', 0, 0),
(10, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '16:03:45', 0, 0),
(11, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '16:04:00', 0, 0),
(12, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-06', '16:04:35', 0, 0),
(13, 'rwf4t364tgege5', 2, 1, '2021-03-09', '07:57:53', 0, 0),
(14, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-24', '15:02:45', 0, 0),
(15, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-24', '18:56:17', 0, 0),
(16, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-24', '18:56:47', 0, 0),
(17, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-24', '18:57:04', 0, 0),
(18, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-24', '18:58:56', 0, 0),
(19, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-24', '19:33:40', 0, 0),
(20, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-25', '15:59:56', 0, 0),
(21, 'ae97274d50d1775c1b4089359644b503', 2, 1, '2021-03-25', '19:54:18', 0, 0),
(22, 'rwf4t364tgege5', 2, 1, '2021-03-26', '23:02:53', 0, 0),
(23, 'ec55324cb8115ffa811876184636a4c3', 2, 1, '2021-03-31', '20:09:54', 0, 0),
(24, 'b8245b00dca6d2a37f1b127383eab59f', 2, 1, '2021-03-31', '20:43:56', 0, 0),
(25, 'rwf4t364tgege5', 2, 1, '2021-03-31', '21:26:53', 0, 0),
(26, '96992bb4290476b37a2f161dc259c8b2', 2, 1, '2021-04-02', '01:07:43', 0, 0),
(27, 'rwf4t364tgege5', 2, 1, '2021-04-03', '17:59:49', 0, 0),
(28, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-04-05', '15:24:46', 0, 0),
(29, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-04-05', '15:24:56', 0, 0),
(30, '96992bb4290476b37a2f161dc259c8b2', 2, 1, '2021-04-05', '17:34:09', 0, 0),
(31, '96992bb4290476b37a2f161dc259c8b2', 2, 1, '2021-04-09', '03:36:51', 0, 0),
(32, '1d1ea9623dbcafd48a89f05e5a8a670a', 2, 1, '2021-04-12', '16:48:18', 0, 0),
(33, 'b28bf5b1753a96abce3cd2bd6d853779', 2, 1, '2021-04-12', '20:28:09', 0, 0),
(34, '646a2c2e03321404e8a605d969788a06', 2, 1, '2021-04-13', '05:57:23', 0, 0),
(35, '646a2c2e03321404e8a605d969788a06', 2, 1, '2021-04-14', '05:58:22', 0, 0),
(36, 'db787a8de3cc9a73d9b24fb8cbe6c209', 2, 1, '2021-04-18', '02:02:21', 0, 0),
(37, 'rwf4t364tgege5', 2, 1, '2021-04-28', '07:27:20', 0, 0),
(38, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-05-06', '11:58:15', 0, 0),
(39, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-05-11', '14:41:03', 0, 0),
(40, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-05-17', '14:16:30', 0, 0),
(41, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-05-17', '14:21:27', 0, 0),
(42, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-05-18', '12:35:28', 0, 0),
(43, '646a2c2e03321404e8a605d969788a06', 2, 1, '2021-06-02', '07:22:19', 0, 0),
(44, 'd6530465201d4ab86f911671203cf466', 2, 1, '2021-06-15', '17:01:56', 0, 0),
(45, 'dfe13424956effda6f2bc424df005397', 2, 1, '2021-06-17', '17:30:54', 0, 0),
(46, 'dfe13424956effda6f2bc424df005397', 2, 1, '2021-06-17', '17:44:14', 0, 0),
(47, '8c1519ee4d3ab2f2ca0268b416165f76', 2, 1, '2021-06-21', '04:58:20', 0, 0),
(48, 'dfe13424956effda6f2bc424df005397', 2, 1, '2021-06-21', '17:42:41', 0, 0),
(49, 'dfe13424956effda6f2bc424df005397', 2, 1, '2021-06-21', '17:42:42', 0, 0),
(50, 'dfe13424956effda6f2bc424df005397', 2, 1, '2021-06-21', '20:40:44', 0, 0),
(51, 'dfe13424956effda6f2bc424df005397', 2, 1, '2021-07-01', '19:54:06', 0, 0),
(52, '9bd0eb91c37cece5133ccdced7b62759', 566, 14, '2022-01-04', '11:54:15', 0, 0),
(53, '4b4b7165a47354b45dfc42f2a4f20c71', 566, 14, '2022-01-04', '14:16:43', 0, 0),
(54, '95d3cabe3fb6bcd7ac88146e05e32463', 566, 14, '2022-01-04', '21:33:08', 0, 0),
(55, '50a0b723b099f39789967978dcc29c50', 574, 32, '2022-01-19', '20:51:09', 0, 0),
(56, '1889dec542525bc1b7732016faa5f8ae', 579, 39, '2022-02-15', '22:08:03', 0, 0),
(57, '1889dec542525bc1b7732016faa5f8ae', 578, 77, '2022-02-21', '00:07:52', 0, 0),
(58, 'ec55324cb8115ffa811876184636a4c3', 578, 77, '2022-02-21', '00:22:08', 0, 0),
(59, '79041e11f05c4c76cbe9f5e0206ff705', 578, 77, '2022-02-24', '12:23:02', 0, 0),
(60, '79041e11f05c4c76cbe9f5e0206ff705', 581, 68, '2022-02-24', '15:09:40', 0, 0),
(61, '79041e11f05c4c76cbe9f5e0206ff705', 579, 39, '2022-02-24', '15:14:38', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_event_favourite`
--

CREATE TABLE `t_user_event_favourite` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `favourite_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_event_favourite`
--

INSERT INTO `t_user_event_favourite` (`id`, `user_id`, `favourite_id`, `created_at`, `updated_at`) VALUES
(1, 'ae97274d50d1775c1b4089359644b503', 2, '2020-12-24 15:01:58', '2020-12-24 15:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_favourite`
--

CREATE TABLE `t_user_favourite` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `favourite_bar_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_favourite`
--

INSERT INTO `t_user_favourite` (`id`, `user_id`, `favourite_bar_id`, `created_at`, `updated_at`) VALUES
(30, 'ae97274d50d1775c1b4089359644b503', 566, '2020-12-28 13:02:37', '2020-12-28 13:02:37'),
(32, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, '2020-12-29 20:59:05', '2020-12-29 20:59:05'),
(33, 'ae97274d50d1775c1b4089359644b503', 2, '2021-02-03 11:06:09', '2021-02-03 11:06:09'),
(35, 'b8245b00dca6d2a37f1b127383eab59f', 2, '2021-03-05 02:19:55', '2021-03-05 02:19:55'),
(36, '96992bb4290476b37a2f161dc259c8b2', 2, '2021-04-02 01:10:11', '2021-04-02 01:10:11'),
(37, '96992bb4290476b37a2f161dc259c8b2', 3, '2021-04-02 01:10:20', '2021-04-02 01:10:20'),
(39, 'b8245b00dca6d2a37f1b127383eab59f', 3, '2021-04-15 07:17:08', '2021-04-15 07:17:08'),
(40, 'b8245b00dca6d2a37f1b127383eab59f', 13, '2021-04-15 07:17:20', '2021-04-15 07:17:20'),
(50, 'd6530465201d4ab86f911671203cf466', 2, '2021-05-18 12:37:51', '2021-05-18 12:37:51'),
(51, '646a2c2e03321404e8a605d969788a06', 14, '2021-05-20 05:36:58', '2021-05-20 05:36:58'),
(53, '89bccbbe030f4a7d6644e3573125c96c', 16, '2021-06-02 03:01:36', '2021-06-02 03:01:36'),
(55, '3f1ce0faf37cc0273223ee3075640af1', 2, '2021-06-04 03:07:11', '2021-06-04 03:07:11'),
(56, '3f1ce0faf37cc0273223ee3075640af1', 174, '2021-06-07 04:57:03', '2021-06-07 04:57:03'),
(57, '3f1ce0faf37cc0273223ee3075640af1', 234, '2021-06-07 04:59:42', '2021-06-07 04:59:42'),
(59, '646a2c2e03321404e8a605d969788a06', 2, '2021-06-23 02:06:24', '2021-06-23 02:06:24'),
(60, 'dfe13424956effda6f2bc424df005397', 566, '2021-07-01 14:41:16', '2021-07-01 14:41:16'),
(63, '7df340c16c2e92f5c1a872cbc49fe9e4', 566, '2021-07-22 18:25:02', '2021-07-22 18:25:02'),
(64, '979d6a9bea254f9789d65f7d2c845d05', 14, '2021-07-22 18:25:46', '2021-07-22 18:25:46'),
(65, 'a97f81ac1e54c7e775771aacc3a49357', 566, '2021-12-29 18:32:37', '2021-12-29 18:32:37'),
(67, '9bd0eb91c37cece5133ccdced7b62759', 566, '2022-01-04 11:54:04', '2022-01-04 11:54:04'),
(88, '4b4b7165a47354b45dfc42f2a4f20c71', 574, '2022-01-07 14:49:34', '2022-01-07 14:49:34'),
(89, '4b4b7165a47354b45dfc42f2a4f20c71', 571, '2022-01-07 14:49:35', '2022-01-07 14:49:35'),
(90, '4b4b7165a47354b45dfc42f2a4f20c71', 566, '2022-01-07 14:49:36', '2022-01-07 14:49:36'),
(91, 'b8245b00dca6d2a37f1b127383eab59f', 574, '2022-02-02 16:29:48', '2022-02-02 16:29:48'),
(92, 'b8245b00dca6d2a37f1b127383eab59f', 571, '2022-02-02 16:30:12', '2022-02-02 16:30:12'),
(93, 'b8245b00dca6d2a37f1b127383eab59f', 566, '2022-02-02 16:30:25', '2022-02-02 16:30:25'),
(94, 'b8245b00dca6d2a37f1b127383eab59f', 578, '2022-02-09 04:28:20', '2022-02-09 04:28:20'),
(95, 'c937098d2434c68801c94376c45638ad', 578, '2022-02-13 03:09:12', '2022-02-13 03:09:12'),
(96, '1889dec542525bc1b7732016faa5f8ae', 578, '2022-02-15 21:18:53', '2022-02-15 21:18:53'),
(97, '1889dec542525bc1b7732016faa5f8ae', 576, '2022-02-15 21:18:55', '2022-02-15 21:18:55'),
(98, '1889dec542525bc1b7732016faa5f8ae', 581, '2022-02-15 21:19:00', '2022-02-15 21:19:00'),
(99, '1889dec542525bc1b7732016faa5f8ae', 579, '2022-02-15 21:19:11', '2022-02-15 21:19:11'),
(100, '1889dec542525bc1b7732016faa5f8ae', 577, '2022-02-15 21:19:22', '2022-02-15 21:19:22'),
(101, '1889dec542525bc1b7732016faa5f8ae', 580, '2022-02-15 21:19:28', '2022-02-15 21:19:28'),
(108, '79041e11f05c4c76cbe9f5e0206ff705', 581, '2022-02-24 15:15:00', '2022-02-24 15:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_favourite_user`
--

CREATE TABLE `t_user_favourite_user` (
  `id` int NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `favourite_user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_user_favourite_user`
--

INSERT INTO `t_user_favourite_user` (`id`, `user_id`, `favourite_user_id`, `created_at`, `updated_at`) VALUES
(4, '5561e975241669938ac63b0b1f8abe64', 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '2021-03-02 10:10:51', '2021-03-02 10:10:51'),
(11, 'ae97274d50d1775c1b4089359644b503', 'ae97274d50d1775c1b4089359644b503', '2021-03-22 07:17:17', '2021-03-22 07:17:17'),
(12, 'ae97274d50d1775c1b4089359644b503', 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '2021-03-25 10:37:34', '2021-03-25 10:37:34'),
(13, 'rwf4t364tgege5', 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '2021-03-30 15:03:00', '2021-03-30 15:03:00'),
(14, 'rwf4t364tgege5', 'd6530465201d4ab86f911671203cf466', '2021-03-31 09:29:51', '2021-03-31 09:29:51'),
(15, '646a2c2e03321404e8a605d969788a06', '646a2c2e03321404e8a605d969788a06', '2021-04-14 00:28:07', '2021-04-14 00:28:07'),
(16, '646a2c2e03321404e8a605d969788a06', 'b8245b00dca6d2a37f1b127383eab59f', '2021-04-17 19:16:26', '2021-04-17 19:16:26'),
(17, '646a2c2e03321404e8a605d969788a06', '1d1ea9623dbcafd48a89f05e5a8a670a', '2021-04-17 19:16:29', '2021-04-17 19:16:29'),
(18, '646a2c2e03321404e8a605d969788a06', 'b28bf5b1753a96abce3cd2bd6d853779', '2021-05-20 00:08:26', '2021-05-20 00:08:26'),
(19, '646a2c2e03321404e8a605d969788a06', '96992bb4290476b37a2f161dc259c8b2', '2021-06-22 20:48:49', '2021-06-22 20:48:49'),
(20, 'b8245b00dca6d2a37f1b127383eab59f', '646a2c2e03321404e8a605d969788a06', '2021-06-22 20:52:41', '2021-06-22 20:52:41'),
(21, '646a2c2e03321404e8a605d969788a06', '8c1519ee4d3ab2f2ca0268b416165f76', '2021-06-23 00:05:28', '2021-06-23 00:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_friends`
--

CREATE TABLE `t_user_friends` (
  `id` bigint NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `friend_user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `request_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '0-Pending,1-Accept',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_user_friends`
--

INSERT INTO `t_user_friends` (`id`, `user_id`, `friend_user_id`, `request_status`, `created_at`, `updated_at`) VALUES
(2, '3f1ce0faf37cc0273223ee3075640af1', '89bccbbe030f4a7d6644e3573125c96c', '1', '2021-06-07 04:29:12', '2021-06-07 04:29:12'),
(3, '89bccbbe030f4a7d6644e3573125c96c', '89bccbbe030f4a7d6644e3573125c96c', '1', '2021-06-07 04:29:16', '2021-06-07 04:29:16'),
(10, '4b4b7165a47354b45dfc42f2a4f20c71', 'a97f81ac1e54c7e775771aacc3a49357', '1', '2021-12-20 17:10:24', '2021-12-20 17:10:24'),
(11, '1889dec542525bc1b7732016faa5f8ae', '95d3cabe3fb6bcd7ac88146e05e32463', '1', '2022-02-09 16:16:51', '2022-02-09 16:16:51'),
(12, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', '79041e11f05c4c76cbe9f5e0206ff705', '1', '2022-02-24 15:03:03', '2022-02-24 15:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_game_favourite`
--

CREATE TABLE `t_user_game_favourite` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `favourite_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_game_favourite`
--

INSERT INTO `t_user_game_favourite` (`id`, `user_id`, `favourite_id`, `created_at`, `updated_at`) VALUES
(3, '4bd1a3dec171def481a6bb796795b3ec', 2, '2020-09-17 20:33:09', '2020-09-17 20:33:09'),
(4, 'a97f81ac1e54c7e775771aacc3a49357', 86, '2021-12-20 16:05:32', '2021-12-20 16:05:32'),
(5, 'a97f81ac1e54c7e775771aacc3a49357', 1, '2021-12-20 16:06:07', '2021-12-20 16:06:07'),
(6, 'a97f81ac1e54c7e775771aacc3a49357', 2, '2021-12-20 16:06:08', '2021-12-20 16:06:08'),
(7, 'a97f81ac1e54c7e775771aacc3a49357', 3, '2021-12-20 16:06:09', '2021-12-20 16:06:09'),
(8, 'a97f81ac1e54c7e775771aacc3a49357', 81, '2021-12-20 16:06:09', '2021-12-20 16:06:09'),
(9, '4b4b7165a47354b45dfc42f2a4f20c71', 76, '2021-12-29 14:55:26', '2021-12-29 14:55:26'),
(10, '4b4b7165a47354b45dfc42f2a4f20c71', 77, '2021-12-29 14:55:26', '2021-12-29 14:55:26'),
(11, '4b4b7165a47354b45dfc42f2a4f20c71', 82, '2021-12-29 14:55:28', '2021-12-29 14:55:28'),
(12, 'a97f81ac1e54c7e775771aacc3a49357', 76, '2021-12-29 14:56:13', '2021-12-29 14:56:13'),
(13, 'a97f81ac1e54c7e775771aacc3a49357', 77, '2021-12-29 14:56:14', '2021-12-29 14:56:14'),
(14, 'a97f81ac1e54c7e775771aacc3a49357', 82, '2021-12-29 14:56:14', '2021-12-29 14:56:14'),
(15, '9bd0eb91c37cece5133ccdced7b62759', 76, '2022-01-04 11:54:09', '2022-01-04 11:54:09'),
(16, '9bd0eb91c37cece5133ccdced7b62759', 77, '2022-01-04 11:54:09', '2022-01-04 11:54:09'),
(17, '9bd0eb91c37cece5133ccdced7b62759', 82, '2022-01-04 11:54:10', '2022-01-04 11:54:10'),
(18, '9bd0eb91c37cece5133ccdced7b62759', 83, '2022-01-04 11:54:10', '2022-01-04 11:54:10'),
(19, 'b8245b00dca6d2a37f1b127383eab59f', 99, '2022-02-02 16:49:35', '2022-02-02 16:49:35'),
(20, 'b8245b00dca6d2a37f1b127383eab59f', 77, '2022-02-02 16:49:44', '2022-02-02 16:49:44'),
(21, 'b8245b00dca6d2a37f1b127383eab59f', 76, '2022-02-02 16:49:45', '2022-02-02 16:49:45'),
(22, 'b8245b00dca6d2a37f1b127383eab59f', 82, '2022-02-02 16:49:46', '2022-02-02 16:49:46'),
(23, 'b8245b00dca6d2a37f1b127383eab59f', 108, '2022-02-09 02:32:16', '2022-02-09 02:32:16'),
(24, 'b8245b00dca6d2a37f1b127383eab59f', 109, '2022-02-09 02:32:17', '2022-02-09 02:32:17'),
(25, 'b8245b00dca6d2a37f1b127383eab59f', 110, '2022-02-09 02:32:17', '2022-02-09 02:32:17'),
(26, 'b8245b00dca6d2a37f1b127383eab59f', 111, '2022-02-09 02:32:18', '2022-02-09 02:32:18'),
(27, 'b8245b00dca6d2a37f1b127383eab59f', 112, '2022-02-09 02:32:18', '2022-02-09 02:32:18'),
(28, 'b8245b00dca6d2a37f1b127383eab59f', 113, '2022-02-09 02:32:18', '2022-02-09 02:32:18'),
(29, 'ec55324cb8115ffa811876184636a4c3', 132, '2022-02-28 01:17:52', '2022-02-28 01:17:52'),
(30, 'ec55324cb8115ffa811876184636a4c3', 133, '2022-02-28 01:17:53', '2022-02-28 01:17:53'),
(31, 'ec55324cb8115ffa811876184636a4c3', 134, '2022-02-28 01:17:53', '2022-02-28 01:17:53'),
(32, '1889dec542525bc1b7732016faa5f8ae', 132, '2022-02-28 01:18:46', '2022-02-28 01:18:46'),
(33, '1889dec542525bc1b7732016faa5f8ae', 133, '2022-02-28 01:18:46', '2022-02-28 01:18:46'),
(34, '1889dec542525bc1b7732016faa5f8ae', 134, '2022-02-28 01:18:47', '2022-02-28 01:18:47'),
(35, '1889dec542525bc1b7732016faa5f8ae', 135, '2022-02-28 01:18:47', '2022-02-28 01:18:47'),
(36, '1889dec542525bc1b7732016faa5f8ae', 136, '2022-02-28 01:18:48', '2022-02-28 01:18:48'),
(37, '1889dec542525bc1b7732016faa5f8ae', 137, '2022-02-28 01:18:48', '2022-02-28 01:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_images`
--

CREATE TABLE `t_user_images` (
  `id` int NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_user_images`
--

INSERT INTO `t_user_images` (`id`, `user_id`, `image`, `updated_at`) VALUES
(9, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1616577398profileImage.jpg', '0000-00-00 00:00:00'),
(11, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1616578243profileImage.jpg', '0000-00-00 00:00:00'),
(12, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1616668818profileImage.jpg', '0000-00-00 00:00:00'),
(13, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1616674454profileImage.jpg', '0000-00-00 00:00:00'),
(14, 'ec55324cb8115ffa811876184636a4c3', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1617201660profileImage.jpg', '0000-00-00 00:00:00'),
(15, '1d1ea9623dbcafd48a89f05e5a8a670a', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1618226107profileImage.jpg', '0000-00-00 00:00:00'),
(16, '29c68fa8b40c5e883836a65684867996', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1618335780profileImage.jpg', '0000-00-00 00:00:00'),
(17, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1620226303profileImage.jpg', '0000-00-00 00:00:00'),
(18, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1620226372profileImage.jpg', '0000-00-00 00:00:00'),
(19, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1620226548profileImage.jpg', '0000-00-00 00:00:00'),
(20, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1620297219profileImage.jpg', '0000-00-00 00:00:00'),
(22, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1621076795profileImage.jpg', '0000-00-00 00:00:00'),
(23, 'ae97274d50d1775c1b4089359644b503', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1621076874profileImage.jpg', '0000-00-00 00:00:00'),
(24, 'd6530465201d4ab86f911671203cf466', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1621078892profileImage.jpg', '0000-00-00 00:00:00'),
(25, 'd6530465201d4ab86f911671203cf466', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1621078917profileImage.jpg', '0000-00-00 00:00:00'),
(26, '1d1ea9623dbcafd48a89f05e5a8a670a', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1622166169profileImage.jpg', '0000-00-00 00:00:00'),
(27, 'dd70ceba05eb965ff902502ef5a276b6', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1625229812profileImage.jpg', '0000-00-00 00:00:00'),
(30, 'd6530465201d4ab86f911671203cf466', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1626420920profileImage.jpg', '0000-00-00 00:00:00'),
(32, 'dfe13424956effda6f2bc424df005397', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1626609158profileImage.jpg', '0000-00-00 00:00:00'),
(33, 'dfe13424956effda6f2bc424df005397', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1626609167profileImage.jpg', '0000-00-00 00:00:00'),
(34, '1889dec542525bc1b7732016faa5f8ae', 'http://18.116.154.137/public/imageUpload/1644403324profileImage.jpg', '0000-00-00 00:00:00'),
(35, 'c937098d2434c68801c94376c45638ad', 'http://18.116.154.137/public/imageUpload/1644699401profileImage.jpg', '0000-00-00 00:00:00'),
(36, 'f4513d7b71e9217190cf539ad9a5991b', 'http://18.116.154.137/public/imageUpload/1644961846profileImage.jpg', '0000-00-00 00:00:00'),
(37, '79041e11f05c4c76cbe9f5e0206ff705', 'http://18.116.154.137/public/imageUpload/1645670030profileImage.jpg', '0000-00-00 00:00:00'),
(38, '79041e11f05c4c76cbe9f5e0206ff705', 'http://18.116.154.137/public/imageUpload/1645670054profileImage.jpg', '0000-00-00 00:00:00'),
(39, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'http://18.116.154.137/public/imageUpload/1645677806profileImage.jpg', '0000-00-00 00:00:00'),
(40, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'http://18.116.154.137/public/imageUpload/1645677818profileImage.jpg', '0000-00-00 00:00:00'),
(41, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 'http://18.116.154.137/public/imageUpload/1645683162profileImage.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_invite`
--

CREATE TABLE `t_user_invite` (
  `id` int NOT NULL,
  `sender_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receiver_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bar_id` int NOT NULL,
  `invitation_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Game, Event ,Chat',
  `game_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `chat_message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 = Pending, 1 = Accept, 2 = Reject',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_purchased_details`
--

CREATE TABLE `t_user_purchased_details` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `price` double NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_time` time NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_request`
--

CREATE TABLE `t_user_request` (
  `request_id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `request_type` tinyint NOT NULL DEFAULT '1' COMMENT 'Drink = 1, Game = 2, Chat = 3, Skit = 4, Invite = 5 , Friend Request = 6',
  `request_user_id` varchar(50) NOT NULL,
  `bar_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `drink_id` bigint DEFAULT NULL,
  `request_status` tinyint NOT NULL COMMENT '0-Pending,1-Accept,2-Reject',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_request`
--

INSERT INTO `t_user_request` (`request_id`, `user_id`, `request_type`, `request_user_id`, `bar_id`, `order_id`, `drink_id`, `request_status`, `created_at`, `updated_at`) VALUES
(7, 'd6530465201d4ab86f911671203cf466', 6, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', NULL, NULL, NULL, 0, '2021-03-01 19:33:56', '2021-03-01 19:33:56'),
(8, 'ae97274d50d1775c1b4089359644b503', 6, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', NULL, NULL, NULL, 0, '2021-03-02 20:55:01', '2021-03-02 20:55:01'),
(9, 'b8245b00dca6d2a37f1b127383eab59f', 6, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', NULL, NULL, NULL, 0, '2021-03-07 00:39:35', '2021-03-07 00:39:35'),
(10, 'ae97274d50d1775c1b4089359644b503', 6, 'd6530465201d4ab86f911671203cf466', NULL, NULL, NULL, 1, '2021-03-17 19:21:27', '2021-05-04 19:07:06'),
(11, '96992bb4290476b37a2f161dc259c8b2', 6, 'b8245b00dca6d2a37f1b127383eab59f', NULL, NULL, NULL, 1, '2021-04-02 01:09:32', '2021-04-02 01:14:12'),
(12, 'd6530465201d4ab86f911671203cf466', 6, 'ae97274d50d1775c1b4089359644b503', NULL, NULL, NULL, 0, '2021-05-06 18:50:18', '2021-05-06 18:50:18'),
(13, 'b8245b00dca6d2a37f1b127383eab59f', 6, '1d1ea9623dbcafd48a89f05e5a8a670a', NULL, NULL, NULL, 0, '2021-05-26 07:00:45', '2021-05-26 07:00:45'),
(14, '89bccbbe030f4a7d6644e3573125c96c', 6, '89bccbbe030f4a7d6644e3573125c96c', NULL, NULL, NULL, 1, '2021-06-02 02:58:17', '2021-06-07 04:29:16'),
(15, '3f1ce0faf37cc0273223ee3075640af1', 6, '89bccbbe030f4a7d6644e3573125c96c', NULL, NULL, NULL, 1, '2021-06-02 03:03:25', '2021-06-07 04:29:12'),
(16, '3f1ce0faf37cc0273223ee3075640af1', 6, '1d1ea9623dbcafd48a89f05e5a8a670a', NULL, NULL, NULL, 0, '2021-06-04 03:05:21', '2021-06-04 03:05:21'),
(17, '3f1ce0faf37cc0273223ee3075640af1', 6, '3f1ce0faf37cc0273223ee3075640af1', NULL, NULL, NULL, 1, '2021-06-07 05:00:16', '2021-06-07 05:00:51'),
(18, 'dfe13424956effda6f2bc424df005397', 6, 'ae97274d50d1775c1b4089359644b503', NULL, NULL, NULL, 0, '2021-06-15 20:01:24', '2021-06-15 20:01:24'),
(19, 'dfe13424956effda6f2bc424df005397', 6, 'd6530465201d4ab86f911671203cf466', NULL, NULL, NULL, 1, '2021-06-17 13:35:57', '2021-06-17 13:36:44'),
(20, 'd6530465201d4ab86f911671203cf466', 6, 'd6530465201d4ab86f911671203cf466', NULL, NULL, NULL, 1, '2021-06-17 14:13:32', '2021-06-17 14:14:18'),
(21, 'dfe13424956effda6f2bc424df005397', 6, 'dfe13424956effda6f2bc424df005397', NULL, NULL, NULL, 1, '2021-06-17 17:42:39', '2021-06-17 17:42:52'),
(22, 'd6530465201d4ab86f911671203cf466', 6, 'dfe13424956effda6f2bc424df005397', NULL, NULL, NULL, 1, '2021-06-18 18:30:10', '2021-06-18 18:32:01'),
(23, 'ae97274d50d1775c1b4089359644b503', 6, '5561e975241669938ac63b0b1f8abe64', NULL, NULL, NULL, 0, '2021-06-22 17:09:22', '2021-06-22 17:09:22'),
(24, 'dfe13424956effda6f2bc424df005397', 6, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', NULL, NULL, NULL, 0, '2021-06-22 17:20:16', '2021-06-22 17:20:16'),
(25, 'dfe13424956effda6f2bc424df005397', 6, 'b8245b00dca6d2a37f1b127383eab59f', NULL, NULL, NULL, 0, '2021-06-22 23:14:01', '2021-06-22 23:14:01'),
(26, 'dfe13424956effda6f2bc424df005397', 6, '8c1519ee4d3ab2f2ca0268b416165f76', NULL, NULL, NULL, 0, '2021-06-22 23:14:23', '2021-06-22 23:14:23'),
(27, 'dfe13424956effda6f2bc424df005397', 6, '96992bb4290476b37a2f161dc259c8b2', NULL, NULL, NULL, 0, '2021-06-22 23:14:45', '2021-06-22 23:14:45'),
(28, 'dfe13424956effda6f2bc424df005397', 6, 'db787a8de3cc9a73d9b24fb8cbe6c209', NULL, NULL, NULL, 0, '2021-06-23 15:57:28', '2021-06-23 15:57:28'),
(30, 'dfe13424956effda6f2bc424df005397', 6, '1d1ea9623dbcafd48a89f05e5a8a670a', NULL, NULL, NULL, 0, '2021-06-23 15:58:54', '2021-06-23 15:58:54'),
(31, 'dfe13424956effda6f2bc424df005397', 6, 'b28bf5b1753a96abce3cd2bd6d853779', NULL, NULL, NULL, 0, '2021-06-23 15:59:44', '2021-06-23 15:59:44'),
(32, 'dfe13424956effda6f2bc424df005397', 6, '646a2c2e03321404e8a605d969788a06', NULL, NULL, NULL, 0, '2021-07-07 14:52:15', '2021-07-07 14:52:15'),
(33, 'b728489d78e11542c2fef872c72df11d', 6, 'b728489d78e11542c2fef872c72df11d', NULL, NULL, NULL, 0, '2021-08-09 13:41:34', '2021-08-09 13:41:34'),
(45, 'dfe13424956effda6f2bc424df005397', 6, '89c8977dfc5e7d75101aa66a41c39b2e', NULL, NULL, NULL, 0, '2021-12-20 15:11:09', '2021-12-20 15:11:09'),
(46, '2266be7f8cc9fabf3bafa5f5d5afe58f', 6, '55f7d789affebb28dac7d173281e9765', NULL, NULL, NULL, 0, '2021-12-20 15:45:28', '2021-12-20 15:45:28'),
(58, '4b4b7165a47354b45dfc42f2a4f20c71', 6, 'a97f81ac1e54c7e775771aacc3a49357', NULL, NULL, NULL, 1, '2021-12-20 17:10:16', '2021-12-27 16:25:29'),
(83, '4b4b7165a47354b45dfc42f2a4f20c71', 2, 'a97f81ac1e54c7e775771aacc3a49357', 566, NULL, NULL, 0, '2022-01-04 14:25:56', '2022-01-04 14:25:56'),
(84, '50a0b723b099f39789967978dcc29c50', 2, '4b4b7165a47354b45dfc42f2a4f20c71', 566, NULL, NULL, 0, '2022-01-19 20:50:58', '2022-01-19 20:50:58'),
(85, '1889dec542525bc1b7732016faa5f8ae', 6, '95d3cabe3fb6bcd7ac88146e05e32463', NULL, NULL, NULL, 1, '2022-02-09 16:15:56', '2022-02-09 16:16:56'),
(87, '79041e11f05c4c76cbe9f5e0206ff705', 6, '577e514e6d0eea75d8810171f71fa896', NULL, NULL, NULL, 0, '2022-02-24 09:53:19', '2022-02-24 09:53:19'),
(88, 'c16bf237a09f97ad3fd0e1b6f1bb19c0', 6, '79041e11f05c4c76cbe9f5e0206ff705', NULL, NULL, NULL, 1, '2022-02-24 10:02:56', '2022-02-24 15:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_doors`
--

CREATE TABLE `user_doors` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `door_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_doors`
--

INSERT INTO `user_doors` (`id`, `user_id`, `door_id`, `created_at`, `updated_at`) VALUES
(15, 60, 1, '2021-05-26 01:33:11', '2021-05-26 01:33:11'),
(16, 97, 1, '2022-02-16 03:24:20', '2022-02-16 03:24:20'),
(17, 97, 5, '2022-02-16 03:25:56', '2022-02-16 03:25:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doors`
--
ALTER TABLE `doors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `never_have_evers`
--
ALTER TABLE `never_have_evers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `never_have_ever__answers`
--
ALTER TABLE `never_have_ever__answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_drink`
--
ALTER TABLE `request_drink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_add_user_event`
--
ALTER TABLE `t_add_user_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `t_add_user_event_possible`
--
ALTER TABLE `t_add_user_event_possible`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_ad_banner`
--
ALTER TABLE `t_ad_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_bar`
--
ALTER TABLE `t_bar`
  ADD PRIMARY KEY (`bar_id`);

--
-- Indexes for table `t_bar_event`
--
ALTER TABLE `t_bar_event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `bar_id` (`bar_id`);

--
-- Indexes for table `t_bar_game`
--
ALTER TABLE `t_bar_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_id` (`bar_id`);

--
-- Indexes for table `t_bar_menu`
--
ALTER TABLE `t_bar_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `t_bar_menu_ibfk_2` (`category_id`);

--
-- Indexes for table `t_bar_menu_category`
--
ALTER TABLE `t_bar_menu_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_bar_notification`
--
ALTER TABLE `t_bar_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_bar_photowall`
--
ALTER TABLE `t_bar_photowall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_bar_photo_wall`
--
ALTER TABLE `t_bar_photo_wall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `t_bar_photo_wall_ibfk_2` (`user_id`);

--
-- Indexes for table `t_checked_in_user`
--
ALTER TABLE `t_checked_in_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checked_in_user_ibfk_1` (`bar_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_game`
--
ALTER TABLE `t_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `t_panding_order`
--
ALTER TABLE `t_panding_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `t_payment`
--
ALTER TABLE `t_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `t_payment_details`
--
ALTER TABLE `t_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_possible_checked_in`
--
ALTER TABLE `t_possible_checked_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bar_id` (`bar_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_user_block`
--
ALTER TABLE `t_user_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `block_user_id` (`block_user_id`);

--
-- Indexes for table `t_user_door`
--
ALTER TABLE `t_user_door`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_user_drink_favourite`
--
ALTER TABLE `t_user_drink_favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_user_event_checkin`
--
ALTER TABLE `t_user_event_checkin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `t_user_event_favourite`
--
ALTER TABLE `t_user_event_favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `favourite_id` (`favourite_id`);

--
-- Indexes for table `t_user_favourite`
--
ALTER TABLE `t_user_favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `favourite_bar_id` (`favourite_bar_id`);

--
-- Indexes for table `t_user_favourite_user`
--
ALTER TABLE `t_user_favourite_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_friends`
--
ALTER TABLE `t_user_friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_user_id` (`friend_user_id`);

--
-- Indexes for table `t_user_game_favourite`
--
ALTER TABLE `t_user_game_favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `t_user_game_favourite_ibfk_2` (`favourite_id`);

--
-- Indexes for table `t_user_images`
--
ALTER TABLE `t_user_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_invite`
--
ALTER TABLE `t_user_invite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `t_user_purchased_details`
--
ALTER TABLE `t_user_purchased_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bar_id` (`bar_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `t_user_request`
--
ALTER TABLE `t_user_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `request_user_id` (`request_user_id`);

--
-- Indexes for table `user_doors`
--
ALTER TABLE `user_doors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_doors_user_id_foreign` (`user_id`),
  ADD KEY `user_doors_door_id_foreign` (`door_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doors`
--
ALTER TABLE `doors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `never_have_evers`
--
ALTER TABLE `never_have_evers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `never_have_ever__answers`
--
ALTER TABLE `never_have_ever__answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_drink`
--
ALTER TABLE `request_drink`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `t_add_user_event`
--
ALTER TABLE `t_add_user_event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `t_add_user_event_possible`
--
ALTER TABLE `t_add_user_event_possible`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_ad_banner`
--
ALTER TABLE `t_ad_banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_bar`
--
ALTER TABLE `t_bar`
  MODIFY `bar_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=582;

--
-- AUTO_INCREMENT for table `t_bar_event`
--
ALTER TABLE `t_bar_event`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `t_bar_game`
--
ALTER TABLE `t_bar_game`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `t_bar_menu`
--
ALTER TABLE `t_bar_menu`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `t_bar_menu_category`
--
ALTER TABLE `t_bar_menu_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `t_bar_notification`
--
ALTER TABLE `t_bar_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT for table `t_bar_photowall`
--
ALTER TABLE `t_bar_photowall`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_bar_photo_wall`
--
ALTER TABLE `t_bar_photo_wall`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_checked_in_user`
--
ALTER TABLE `t_checked_in_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `t_game`
--
ALTER TABLE `t_game`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_order`
--
ALTER TABLE `t_order`
  MODIFY `order_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `t_panding_order`
--
ALTER TABLE `t_panding_order`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_payment`
--
ALTER TABLE `t_payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `t_payment_details`
--
ALTER TABLE `t_payment_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_possible_checked_in`
--
ALTER TABLE `t_possible_checked_in`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `t_user_block`
--
ALTER TABLE `t_user_block`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `t_user_door`
--
ALTER TABLE `t_user_door`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_drink_favourite`
--
ALTER TABLE `t_user_drink_favourite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `t_user_event_checkin`
--
ALTER TABLE `t_user_event_checkin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `t_user_event_favourite`
--
ALTER TABLE `t_user_event_favourite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_user_favourite`
--
ALTER TABLE `t_user_favourite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `t_user_favourite_user`
--
ALTER TABLE `t_user_favourite_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_user_friends`
--
ALTER TABLE `t_user_friends`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_user_game_favourite`
--
ALTER TABLE `t_user_game_favourite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `t_user_images`
--
ALTER TABLE `t_user_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `t_user_invite`
--
ALTER TABLE `t_user_invite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_purchased_details`
--
ALTER TABLE `t_user_purchased_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_request`
--
ALTER TABLE `t_user_request`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `user_doors`
--
ALTER TABLE `user_doors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_panding_order`
--
ALTER TABLE `t_panding_order`
  ADD CONSTRAINT `t_panding_order_ibfk_1` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_panding_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
