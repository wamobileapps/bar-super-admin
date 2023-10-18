-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2020 at 01:06 PM
-- Server version: 10.1.46-MariaDB
-- PHP Version: 7.2.30

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
-- Table structure for table `t_ad_banner`
--

CREATE TABLE `t_ad_banner` (
  `id` int(11) NOT NULL,
  `bar_id` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bar`
--

CREATE TABLE `t_bar` (
  `bar_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `people_in` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `close_time` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar`
--

INSERT INTO `t_bar` (`bar_id`, `name`, `address`, `cover_image`, `latitude`, `longitude`, `people_in`, `status`, `close_time`, `open_time`, `updated_at`, `created_at`) VALUES
(2, 'Sake Bar Satsko', '202 E 7th St, New York, NY 10009, United States', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar1.jpg', 222222, 22222, 0, 1, '09 PM', '11 AM', '2020-08-26 11:47:17', '2020-08-26 11:47:17'),
(3, 'McSorley\'s', '15 E 7th St, New York, NY 10003, United States', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar2.jpg', 222222, 22222, 0, 1, '7 PM', '11 AM', '2020-08-26 11:47:27', '2020-08-26 11:47:27'),
(4, 'King Cole Bar', 'Two E 55th St, New York, NY 10022, United States', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar3.jpg', 222222, 22222, 0, 1, '6:30 AM', '6:00 PM', '2020-08-29 19:11:44', '2020-08-29 19:11:44'),
(5, 'The Dead Rabbit Grocery and Grog', '30 Water St, New York, NY 10004, United States', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar4.jpg', 222222, 22222, 0, 1, '9 PM', '10 PM', '2020-08-29 19:14:35', '2020-08-29 19:14:35'),
(6, 'Old Town Bar', '45 E 18th St, New York, NY 10003, United States', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar7.jpg', 222222, 22222, 0, 1, '10 PM', '10 AM', '2020-08-29 19:18:10', '2020-08-29 19:18:10'),
(7, 'Death & Company', '433 E 6th St, New York, NY 10009, United States', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar5.jpg', 222222, 22222, 0, 1, '5 PM', '11 AM', '2020-08-29 19:20:19', '2020-08-29 19:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_event`
--

CREATE TABLE `t_bar_event` (
  `event_id` int(20) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `color` varchar(11) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_event`
--

INSERT INTO `t_bar_event` (`event_id`, `bar_id`, `name`, `description`, `icon`, `image`, `color`, `event_type`, `start_date`, `start_time`, `end_date`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Happy Hours', 'New Year\'s Day, also simply called New Year, is observed on 1 January, ', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barevent/icon1.png', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar1.jpg', '#32a852', 'Week of new year', '2020-10-01', '01:00:00', '2020-10-31', '01:00:00', NULL, '2020-08-31 19:04:16', '2020-08-31 19:04:16'),
(2, 2, 'Dart Challenge', 'alentine\'s Day, also called Saint Valentine\'s Day or the Feast of Saint Valentine, is celebrated annually on February 14.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barevent/icon2.png', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar2.jpg', '#a83289', 'Week of Valentine\'s Day', '2020-10-01', '01:00:00', '2020-10-31', '01:00:00', NULL, '2020-08-31 19:04:16', '2020-08-31 19:04:16'),
(3, 2, 'Open Bar', 'alentine\'s Day, also called Saint Valentine\'s Day or the Feast of Saint Valentine, is celebrated annually on February 14.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barevent/icon3.png', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bar/bar2.jpg', '#a83289', 'Week of Valentine\'s Day', '2020-10-01', '01:00:00', '2020-10-31', '01:00:00', NULL, '2020-08-31 19:04:16', '2020-08-31 19:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_game`
--

CREATE TABLE `t_bar_game` (
  `id` int(11) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_game`
--

INSERT INTO `t_bar_game` (`id`, `bar_id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Beer Pong', 'Beer pong, also known as Beirut, is a drinking game in which players throw a ping pong ball across a table with the intent of landing the ball in a cup of beer on the other end.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game1.jpg', 1, '2020-08-28 20:05:26', '2020-08-28 20:05:26'),
(2, 2, 'Darts', 'Set of 3 darts, dartboard. Glossary. Glossary of darts. Darts is a sport in which two or more players throw small missiles, also known as darts', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game2.jpg', 1, '2020-08-28 20:18:35', '2020-08-28 20:18:35'),
(3, 2, 'Chess', 'Chess is a two-player strategy board game played on a checkered board with 64 squares arranged in an 8×8 square grid.', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game3.jpg', 1, '2020-08-29 20:29:54', '2020-08-29 20:29:54'),
(4, 4, 'Karaoke', 'karaoke app that let you and your friends sing karaoke for free', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game4.jpg', 1, '2020-08-29 20:30:22', '2020-08-29 20:30:22'),
(5, 3, 'Scavenger Hunt', 'A scavenger hunt is a game in which the organizers prepare a list defining specific items', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/bargame/game5.jpg', 1, '2020-08-29 20:31:42', '2020-08-29 20:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_menu`
--

CREATE TABLE `t_bar_menu` (
  `menu_id` int(11) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_menu`
--

INSERT INTO `t_bar_menu` (`menu_id`, `bar_id`, `category_id`, `name`, `description`, `image`, `price`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'Mojito', 'ddfdf', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu1.jpg', 2, 1, '2020-08-29 19:51:55', '2020-08-29 19:51:55'),
(3, 2, 1, 'Beer', 'ddfdf', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu2.jpg', 2, 1, '2020-08-29 20:33:12', '2020-08-29 20:33:12'),
(4, 2, 1, 'Wine', '', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu3.jpg', 0, 1, '2020-09-28 15:45:40', '2020-09-28 15:45:40'),
(5, 2, 1, 'Martini', '', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu4.jpg', 0, 1, '2020-09-28 15:45:52', '2020-09-28 15:45:52'),
(6, 2, 1, 'Moscow Mule', '', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu5.jpg', 0, 1, '2020-09-28 15:46:01', '2020-09-28 15:46:01'),
(7, 2, 1, 'Gine Tonic', '', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barmenu/menu6.jpg', 0, 1, '2020-09-28 15:46:07', '2020-09-28 15:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_menu_category`
--

CREATE TABLE `t_bar_menu_category` (
  `id` int(11) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bar_menu_category`
--

INSERT INTO `t_bar_menu_category` (`id`, `bar_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Liquor', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-26 17:19:32', '2020-08-26 14:28:13'),
(3, 2, 'Beer', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-26 14:15:25', '2020-08-26 14:15:25'),
(4, 2, 'Mixed Drinks', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-29 20:32:31', '2020-08-29 20:32:31'),
(5, 2, 'Food', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-29 20:32:31', '2020-08-29 20:32:31'),
(6, 2, 'Soda', 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/Uploads/barcategory/eb87ea18752364a17e2dd5753280b0c3_barimage.png', 1, '2020-08-29 20:32:31', '2020-08-29 20:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_notification`
--

CREATE TABLE `t_bar_notification` (
  `id` int(40) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bar_photo_wall`
--

CREATE TABLE `t_bar_photo_wall` (
  `id` int(30) NOT NULL,
  `bar_id` int(20) NOT NULL,
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
  `id` int(11) NOT NULL,
  `bar_id` int(11) NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cretaed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_checked_in_user`
--

INSERT INTO `t_checked_in_user` (`id`, `bar_id`, `user_id`, `cretaed_at`) VALUES
(1, 2, '79d9cdb6de69e921e70dc1ddde29e79e', '2020-09-15 21:41:31'),
(2, 2, 'bc3c1127583eaed44e3669dcfccb0b24', '2020-09-15 21:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `t_possible_checked_in`
--

CREATE TABLE `t_possible_checked_in` (
  `id` int(11) NOT NULL,
  `bar_id` int(11) NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cretaed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_possible_checked_in`
--

INSERT INTO `t_possible_checked_in` (`id`, `bar_id`, `user_id`, `cretaed_at`) VALUES
(1, 2, 'e540e075f31e9d979e985b8564322974', '2020-09-15 21:42:33'),
(2, 2, '79d9cdb6de69e921e70dc1ddde29e79e', '2020-09-15 21:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `ageRange` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = +21-25, 2 = +26-31,  3 = +32-40, 4 = +41-55, 5 = +56-75, 6 = +75-100',
  `password` varchar(200) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Male, 0 = Female, Other = 2',
  `relationship_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Single, 2 = Committed, 3 = Merried, 4 = Super Available',
  `age` tinyint(3) DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `paymentMode` enum('Paypal','Credit Card','Net Banking') NOT NULL DEFAULT 'Credit Card',
  `favourite_drink` varchar(255) DEFAULT NULL,
  `payment_gateway_id` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `interests` text,
  `about` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `forgetpassword_link` varchar(255) DEFAULT NULL,
  `is_password_link_valid` datetime DEFAULT NULL,
  `rating` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `user_id`, `username`, `full_name`, `email`, `dob`, `ageRange`, `password`, `gender`, `relationship_status`, `age`, `profileImage`, `paymentMode`, `favourite_drink`, `payment_gateway_id`, `device_type`, `device_token`, `interests`, `about`, `status`, `forgetpassword_link`, `is_password_link_valid`, `rating`, `created_at`, `updated_at`) VALUES
(3, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', '2ww', 'Intjar', 'intjar.khan@canopusinfosystems.in', '0000-00-00', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 18, NULL, 'Credit Card', NULL, NULL, 'ios', 'wwwwww', NULL, NULL, 0, '940e43fc52cf88413b435dcc63094313', '2020-08-29 22:05:28', 0, '2020-08-25 14:41:38', '2020-08-29 21:45:28'),
(17, '979d6a9bea254f9789d65f7d2c845d05', 'Abhishek Chandani', 'Abhishek Chandani', 'Abhishek.chandani@canopusinfosystems.in', '1992-12-28', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 18, NULL, 'Credit Card', 'Cosmopolitan', NULL, 'ios', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-08-30 15:53:56', '2020-08-30 15:53:56'),
(18, 'bc3c1127583eaed44e3669dcfccb0b24', 'Test', 'Test', 'test12@gmail.com', '1986-08-30', 1, 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 2, 18, NULL, 'Credit Card', 'Cosmopolitan', NULL, 'ios', 'dummyToken', NULL, NULL, 0, 'bd4519143ab65f146dfd1c1993501449', '2020-08-30 20:34:34', 0, '2020-08-30 16:58:04', '2020-09-22 13:41:55'),
(19, '99db07ddf170f5711eb172b1a94233f8', 'Feeds', 'Feeds', 'Effef@fefe.com', '1996-08-30', 1, '5c65892744ee1d7dcbffd02159ccbd06', 1, 3, 18, NULL, 'Credit Card', 'Negroni', NULL, 'ios', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-08-30 17:17:36', '2020-08-30 17:17:36'),
(20, '27338af4c76bf696e3851677e375fa79', 'Shree', 'Shree', 'Shree.canopus@gmail.com', '1997-08-30', 1, '0ab93b47f207f5a91fd87992bb368273', 0, 1, 18, NULL, 'Credit Card', 'Cosmopolitan', NULL, 'android', 'dummyToken', NULL, NULL, 0, 'a3f2046dcb47f95514646fd4b43f0d1d', NULL, 0, '2020-08-30 20:32:35', '2020-09-11 20:16:25'),
(21, '994cf571ff784c538651c9f5cfe78944', 'Shree tester', 'Shree tester', 'satambhagyashree175@gmail.com', '2003-08-30', 1, '0ab93b47f207f5a91fd87992bb368273', 0, 4, 18, NULL, 'Credit Card', 'Moscow Mule', NULL, 'android', 'dummyToken', NULL, NULL, 0, 'a993fa63d98199a6625ec489df90d692', NULL, 0, '2020-08-30 20:37:21', '2020-09-11 13:00:36'),
(22, '79d9cdb6de69e921e70dc1ddde29e79e', 'testmm', 'testmm', 'mustafamurabbi@gmail.com', '1981-04-11', 1, '8b3a8057c99cfcda58c7b93b4cea56e1', 1, 3, 18, NULL, 'Credit Card', 'Margarita', NULL, 'ios', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-08-30 23:33:26', '2020-08-30 23:36:58'),
(23, '214379258afa5d4d19b417e46df5aaa8', 'Ashish Agrawal', 'Ashish Agrawal', 'ashishagrawal@gmail.com', '2003-08-31', 1, 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 3, 18, NULL, 'Credit Card', 'Negroni', NULL, 'ios', 'dummyToken', NULL, NULL, 0, '188b6ed6d444befb87a5a57376f2f580', '2020-08-31 02:49:16', 0, '2020-08-31 02:28:19', '2020-08-31 02:29:16'),
(34, '4bd1a3dec171def481a6bb796795b3ec', 'abhishek@chandani.com', 'Intjar Khan', 'abhishek@chandani.com', '1992-12-28', 1, 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 3, 23, 'https://barconnex.canopusinfosystemsportal.com/Barrestaurant/public/imageUpload/1600674155profileImage.jpg', 'Credit Card', 'Rum', NULL, 'ios', 'dummyToken', '2', NULL, 0, NULL, NULL, 0, '2020-09-11 16:48:59', '2020-09-21 13:12:35'),
(36, '83432680932ab0b5f1c6ad82ead5f1c8', 'akash.gupta@canopusinfosystems.in', 'DHHD', 'akash.gupta@canopusinfosystems.in', '1993-08-26', 1, '25d55ad283aa400af464c76d713c07ad', 2, 1, 18, '', 'Credit Card', 'Dfgh', NULL, 'ios', 'dummyToken', NULL, NULL, 0, '86a4c02ff306406fe566b9dc40beea7d', NULL, 0, '2020-09-11 17:04:31', '2020-09-19 15:10:37'),
(37, 'ab6158b802e0de26f3490a40f756d7f6', 'Sff@hh.com', 'Shree satam', 'Sff@hh.com', '1998-09-11', 1, '5f14f041960228bd4b5186edfc99519a', 0, 1, NULL, '', 'Credit Card', 'Coffee', NULL, 'android', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-09-11 20:16:03', '2020-09-11 20:16:03'),
(38, '6218ee15c737cfd4622c40f68ac27b97', 'Jej@kke.com', 'Ueueu', 'Jej@kke.com', '2003-09-11', 1, '0e1579ab83b7adc1f819d11b8e59f24f', 1, 2, NULL, '', 'Credit Card', 'Heheh', NULL, 'android', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-09-11 20:57:29', '2020-09-11 20:57:29'),
(39, 'e540e075f31e9d979e985b8564322974', 'Nai.vazquez@gmail.con', 'Nai', 'Nai.vazquez@gmail.con', '1986-03-25', 1, '2a484c8a671e2969ba7f7bec75987a11', 0, 4, NULL, '', 'Credit Card', 'Coorslite', NULL, 'ios', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-09-13 00:25:50', '2020-09-13 00:25:50'),
(40, 'b8245b00dca6d2a37f1b127383eab59f', 'Nai.vazquez@gmail.com', 'Nai', 'Nai.vazquez@gmail.com', '1986-03-25', 1, '2a484c8a671e2969ba7f7bec75987a11', 0, 4, NULL, '', 'Credit Card', 'Coorslite', NULL, 'android', 'dummyToken', NULL, NULL, 0, 'be6ac1de4e3f5af38c013fd6d1670902', '2020-10-01 07:45:56', 0, '2020-09-13 00:27:03', '2020-10-04 08:06:23'),
(41, 'ec55324cb8115ffa811876184636a4c3', 'Barconnex@gmail.com', 'Nai', 'Barconnex@gmail.com', '1986-03-25', 1, '6948aaf24fccd43859f500ae8b302830', 0, 4, NULL, '', 'Credit Card', 'Coorslite', NULL, 'ios', 'dummyToken', NULL, NULL, 0, NULL, NULL, 0, '2020-09-15 18:32:19', '2020-09-15 18:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_block`
--

CREATE TABLE `t_user_block` (
  `id` int(11) NOT NULL,
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
(2, '4bd1a3dec171def481a6bb796795b3ec', '979d6a9bea254f9789d65f7d2c845d05', 'sss', '2020-09-19 19:25:27', '2020-09-19 19:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_door`
--

CREATE TABLE `t_user_door` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `door_text` varchar(255) NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_event_checkin`
--

CREATE TABLE `t_user_event_checkin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `event_id` int(20) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_event_favourite`
--

CREATE TABLE `t_user_event_favourite` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `favourite_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_favourite`
--

CREATE TABLE `t_user_favourite` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `favourite_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_favourite`
--

INSERT INTO `t_user_favourite` (`id`, `user_id`, `favourite_id`, `created_at`, `updated_at`) VALUES
(4, 'bf873f6d914d6d7f7b7cbb9ec7ce00fe', 2, '2020-09-11 17:54:44', '2020-09-11 17:54:44'),
(5, '4bd1a3dec171def481a6bb796795b3ec', 2, '2020-09-17 20:33:48', '2020-09-17 20:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_game_favourite`
--

CREATE TABLE `t_user_game_favourite` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `favourite_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_game_favourite`
--

INSERT INTO `t_user_game_favourite` (`id`, `user_id`, `favourite_id`, `created_at`, `updated_at`) VALUES
(3, '4bd1a3dec171def481a6bb796795b3ec', 2, '2020-09-17 20:33:09', '2020-09-17 20:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_invite`
--

CREATE TABLE `t_user_invite` (
  `id` int(11) NOT NULL,
  `sender_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `receiver_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bar_id` int(20) NOT NULL,
  `invitation_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Game, Event ,Chat',
  `game_id` int(11) DEFAULT NULL,
  `event_id` int(20) DEFAULT NULL,
  `chat_message` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Pending, 1 = Accept, 2 = Reject',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_user_purchased_details`
--

CREATE TABLE `t_user_purchased_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `bar_id` int(20) NOT NULL,
  `menu_id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `request_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Drink = 1, Game = 2, Chat = 3, Skit = 4, Invite = 5',
  `request_id` int(11) NOT NULL,
  `request_status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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
  ADD KEY `bar_id` (`bar_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_user_game_favourite`
--
ALTER TABLE `t_user_game_favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `t_user_game_favourite_ibfk_2` (`favourite_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_ad_banner`
--
ALTER TABLE `t_ad_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_bar`
--
ALTER TABLE `t_bar`
  MODIFY `bar_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_bar_event`
--
ALTER TABLE `t_bar_event`
  MODIFY `event_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_bar_game`
--
ALTER TABLE `t_bar_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_bar_menu`
--
ALTER TABLE `t_bar_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_bar_menu_category`
--
ALTER TABLE `t_bar_menu_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_bar_notification`
--
ALTER TABLE `t_bar_notification`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_bar_photo_wall`
--
ALTER TABLE `t_bar_photo_wall`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_checked_in_user`
--
ALTER TABLE `t_checked_in_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_possible_checked_in`
--
ALTER TABLE `t_possible_checked_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `t_user_block`
--
ALTER TABLE `t_user_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_user_door`
--
ALTER TABLE `t_user_door`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_event_checkin`
--
ALTER TABLE `t_user_event_checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_event_favourite`
--
ALTER TABLE `t_user_event_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_favourite`
--
ALTER TABLE `t_user_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_user_game_favourite`
--
ALTER TABLE `t_user_game_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_user_invite`
--
ALTER TABLE `t_user_invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_purchased_details`
--
ALTER TABLE `t_user_purchased_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user_request`
--
ALTER TABLE `t_user_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_bar_event`
--
ALTER TABLE `t_bar_event`
  ADD CONSTRAINT `t_bar_event_ibfk_1` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_bar_game`
--
ALTER TABLE `t_bar_game`
  ADD CONSTRAINT `t_bar_game_ibfk_1` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_bar_menu`
--
ALTER TABLE `t_bar_menu`
  ADD CONSTRAINT `t_bar_menu_ibfk_1` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_bar_photo_wall`
--
ALTER TABLE `t_bar_photo_wall`
  ADD CONSTRAINT `t_bar_photo_wall_ibfk_1` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_bar_photo_wall_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_checked_in_user`
--
ALTER TABLE `t_checked_in_user`
  ADD CONSTRAINT `t_checked_in_user_ibfk_1` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_checked_in_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_possible_checked_in`
--
ALTER TABLE `t_possible_checked_in`
  ADD CONSTRAINT `t_possible_checked_in_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_possible_checked_in_ibfk_2` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_block`
--
ALTER TABLE `t_user_block`
  ADD CONSTRAINT `t_user_block_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_block_ibfk_2` FOREIGN KEY (`block_user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_door`
--
ALTER TABLE `t_user_door`
  ADD CONSTRAINT `t_user_door_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_event_checkin`
--
ALTER TABLE `t_user_event_checkin`
  ADD CONSTRAINT `t_user_event_checkin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_event_checkin_ibfk_2` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_event_checkin_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `t_bar_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_event_favourite`
--
ALTER TABLE `t_user_event_favourite`
  ADD CONSTRAINT `t_user_event_favourite_ibfk_1` FOREIGN KEY (`favourite_id`) REFERENCES `t_bar_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_event_favourite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_favourite`
--
ALTER TABLE `t_user_favourite`
  ADD CONSTRAINT `t_user_favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_game_favourite`
--
ALTER TABLE `t_user_game_favourite`
  ADD CONSTRAINT `t_user_game_favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_game_favourite_ibfk_2` FOREIGN KEY (`favourite_id`) REFERENCES `t_bar_game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_invite`
--
ALTER TABLE `t_user_invite`
  ADD CONSTRAINT `t_user_invite_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `t_bar_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_invite_ibfk_2` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_invite_ibfk_3` FOREIGN KEY (`game_id`) REFERENCES `t_bar_game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_purchased_details`
--
ALTER TABLE `t_user_purchased_details`
  ADD CONSTRAINT `t_user_purchased_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_purchased_details_ibfk_2` FOREIGN KEY (`bar_id`) REFERENCES `t_bar` (`bar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_user_purchased_details_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `t_bar_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_user_request`
--
ALTER TABLE `t_user_request`
  ADD CONSTRAINT `t_user_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
