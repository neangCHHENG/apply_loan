-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 14, 2022 at 05:37 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aistakeo`
--

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

DROP TABLE IF EXISTS `infos`;
CREATE TABLE IF NOT EXISTS `infos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `key`, `type`, `value`, `description`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Tel0', 'phone', '(855) 23 223 295', 'Tel for call', 1, '2022-08-30 16:43:34', '2022-09-05 11:58:19'),
(2, 'Tel1', 'phone', '(855) 23 221 222', 'Tel1 for call1', 1, '2022-08-30 16:44:12', '2022-09-05 11:58:25'),
(3, 'Tel2', 'phone', '(855) 11 388 868', 'Tel2 for call2', 1, '2022-08-30 16:44:49', '2022-09-05 11:58:31'),
(4, 'Tel3', 'phone', '(855) 93 217 217', 'Tel3 for call3', 1, '2022-08-30 16:45:19', '2022-09-05 11:58:37'),
(5, 'Email0', 'email', 'info@ais.edu.kh', 'Email for mail1', 1, '2022-08-30 16:46:35', '2022-09-05 11:56:44'),
(6, 'Email1', 'email', 'info@mjqeducation.edu.kh', 'Email1 for mail1', 1, '2022-08-30 16:47:17', '2022-09-05 11:57:12'),
(7, 'facebook', 'socailMedia', 'https://www.facebook.com/ais.mjqeducation/', 'link to face book', 1, '2022-08-31 18:41:19', '2022-09-05 11:57:36'),
(8, 'twitter', 'socailMedia', 'https://twitter.com/ais_mjqe', 'link to twitter', 1, '2022-08-31 18:41:53', '2022-09-05 11:59:05'),
(9, 'youtube', 'socailMedia', 'https://www.youtube.com/user/MJQGROUP', 'link to youtube', 1, '2022-08-31 18:42:25', '2022-09-05 11:59:11'),
(10, 'linkedin', 'socailMedia', 'https://www.linkedin.com/company/americaninterconschool/', 'link to linkedin', 1, '2022-08-31 18:42:56', '2022-09-05 11:57:53'),
(11, 'tiktok', 'socailMedia', 'https://www.tiktok.com/@americaninterconschool', 'link to tiktok', 1, '2022-08-31 18:43:24', '2022-09-05 11:58:56'),
(12, 'instagram', 'socailMedia', 'https://www.instagram.com/americaninterconschool/?igshid=YmMyMTA2M2Y%3D', 'link to instagram', 1, '2022-08-31 18:43:50', '2022-09-05 11:57:42'),
(13, 'telegram', 'socailMedia', 'https://t.me/AmericanInterconSchool', 'link to telegram', 1, '2022-08-31 18:44:19', '2022-09-05 11:58:48'),
(14, 'copyright', 'copyright', 'Copyright © 2022 American Intercon School', 'copyright', 1, '2022-08-31 20:52:48', '2022-09-05 11:55:34'),
(15, 'latitude', 'map', '11.547523350383157', NULL, 1, '2022-09-14 05:00:37', '2022-09-14 05:00:37'),
(16, 'longitude', 'map', '104.90835479629283', NULL, 1, '2022-09-14 05:33:11', '2022-09-14 05:33:11'),
(17, 'title-tap', 'map', 'Moa Tse Tong Campus (MTT) (Head Office)', NULL, 1, '2022-09-14 05:34:04', '2022-09-14 05:34:04'),
(18, 'content-map', 'map', '#223 & 227, Mao Tse Tong Blvd., Sangkat Toul Svay Prey I, Khan Boeung Keng Kang, Phnom Penh', NULL, 1, '2022-09-14 05:34:34', '2022-09-14 05:34:34'),
(19, 'website-aismtt', 'website', 'www.aismtt.edu.kh', NULL, 1, '2022-09-14 05:35:53', '2022-09-14 05:35:53'),
(20, 'website-mjqeducation', 'website', 'www.mjqeducation.edu.kh', NULL, 1, '2022-09-14 05:36:30', '2022-09-14 05:36:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
