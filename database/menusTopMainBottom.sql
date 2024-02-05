-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 14, 2022 at 04:49 AM
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
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `menu_kh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `left` int(11) NOT NULL DEFAULT '0',
  `right` int(11) NOT NULL DEFAULT '0',
  `is_root` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `reference_id` int(11) DEFAULT NULL,
  `param1` text COLLATE utf8mb4_unicode_ci,
  `param2` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu_kh`, `menu_en`, `slug`, `menu_type`, `type`, `position`, `link`, `left`, `right`, `is_root`, `level`, `reference_id`, `param1`, `param2`, `created_by`, `updated_by`, `state`, `created_at`, `updated_at`) VALUES
(1, 0, 'ROOT', 'ROOT', 'root-20', NULL, 'Top', NULL, NULL, 0, 19, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(2, 0, 'ROOT', 'ROOT', 'root-7', NULL, 'Main', NULL, NULL, 0, 107, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(3, 0, 'ROOT', 'ROOT', 'root-6', NULL, 'Bottom', NULL, NULL, 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(4, 1, 'ទម្រង់ពាក្យសុំតាមអ៊ីនធឺណិត', 'online application form', 'online-application-form', 'external_url', 'Top', '0', 'https://registration.ais.edu.kh/en', 1, 2, 0, 1, NULL, '{\n                                        \"param1\":\"select\",\n                                        \"param1List\":[\n                                            {\n                                                \"value\":\"external_url\",\n                                                \"title\":\"External URL\"\n                                            }\n                                        ]\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:45:04', '2022-09-14 04:16:59'),
(5, 1, 'គ្រូបង្រៀន', 'teachers', 'teachers', 'single_article', 'Top', '0', NULL, 3, 4, 0, 1, 1, '{\n                                        \"action\":\"selectArticle\",\n                                        \"referenceId\":\"id\"\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:45:34', '2022-09-14 04:24:39'),
(6, 1, 'ក្រុមប្រឹក្សាសិស្ស', 'student council', 'student-council', 'single_article', 'Top', '0', NULL, 5, 6, 0, 1, 2, '{\n                                        \"action\":\"selectArticle\",\n                                        \"referenceId\":\"id\"\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:46:02', '2022-09-14 04:29:23'),
(7, 1, 'ថ្លៃ​សិក្សា', 'tuition fee', 'tuition-fee', 'single_article', 'Top', '0', NULL, 7, 8, 0, 1, 3, '{\n                                        \"action\":\"selectArticle\",\n                                        \"referenceId\":\"id\"\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:46:27', '2022-09-14 04:31:58'),
(8, 1, 'ទំនាក់ទំនង', 'contact', 'contact', 'contact_form', 'Top', '0', NULL, 9, 10, 0, 1, NULL, NULL, '', 'Administrator', 'Administrator', 1, '2022-08-28 19:46:46', '2022-09-14 04:34:06'),
(9, 1, 'ការងារ', 'Job', 'job', 'external_url', 'Top', '0', 'https://mjqjobs.com', 11, 12, 0, 1, NULL, '{\n                                        \"param1\":\"select\",\n                                        \"param1List\":[\n                                            {\n                                                \"value\":\"external_url\",\n                                                \"title\":\"External URL\"\n                                            }\n                                        ]\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:47:27', '2022-09-14 04:34:59'),
(10, 1, 'សមាគមអតីតនិស្សិត', 'alumni association', 'alumni-association', 'single_article', 'Top', '0', NULL, 13, 14, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:48:21', NULL),
(11, 1, 'ភាសាអង់គ្លេស', 'English', 'english', 'change_language', 'Top', '0', NULL, 15, 16, 0, 1, NULL, '{\n                                        \"khmer\":{\n                                            \"font_icon\":\"kh\",\n                                            \"file_icon\":\"http://10.15.60.21:8000/FrontEnd/Image/flag_khmer.png\"\n                                        },\n                                        \"english\":{\n                                            \"font_icon\":\"en\",\n                                            \"file_icon\":\"http://10.15.60.21:8000/FrontEnd/Image/flag_english.png\"\n                                        }\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:49:13', '2022-09-14 03:52:04'),
(12, 1, 'ខ្មែរ', 'Khmer', 'khmer', 'change_language', 'Top', '0', NULL, 17, 18, 0, 1, NULL, '{\n                                        \"khmer\":{\n                                            \"font_icon\":\"kh\",\n                                            \"file_icon\":\"http://10.15.60.21:8000/FrontEnd/Image/flag_khmer.png\"\n                                        },\n                                        \"english\":{\n                                            \"font_icon\":\"en\",\n                                            \"file_icon\":\"http://10.15.60.21:8000/FrontEnd/Image/flag_english.png\"\n                                        }\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:49:47', '2022-09-14 03:52:19'),
(13, 2, 'អំពី​ពួក​យើង', 'About Us', 'About-Us', 'feature_article', 'Main', '0', NULL, 1, 28, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:50:20', NULL),
(14, 2, 'រចនាសម្ព័ន្ធ', 'Structure', 'Structure', 'feature_article', 'Main', '0', NULL, 29, 38, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:51:06', NULL),
(15, 2, 'សាលា', 'School', 'School', 'single_article', 'Main', '0', NULL, 39, 50, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:51:46', NULL),
(16, 2, 'កម្មវិធី', 'Programs', 'Programs', 'single_article', 'Main', '0', NULL, 51, 64, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:52:20', NULL),
(17, 2, 'បុគ្គលិក', 'Staffs', 'Staffs', 'feature_article', 'Main', '0', NULL, 65, 82, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:53:00', NULL),
(18, 2, 'ជីវិត​នៅ​សាលា', 'School Life', 'School-Life', 'feature_article', 'Main', '0', NULL, 83, 98, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:53:37', NULL),
(19, 2, 'ការចុះឈ្មោះ', 'Enrollment', 'Enrollment', 'feature_article', 'Main', '0', NULL, 99, 104, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:54:10', NULL),
(20, 2, 'ព័ត៌មាន', 'news', 'news', 'feature_article', 'Main', '0', NULL, 105, 106, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:54:38', NULL),
(21, 13, 'សាលាអន្តរទ្វីបអាមេរិកាំង តាកែវ', 'american intercon school, takéo', 'american-intercon-school--takéo', 'single_article', 'Main', '0', NULL, 2, 3, 0, 2, 4, '{\n                                        \"action\":\"selectArticle\",\n                                        \"referenceId\":\"id\"\n                                    }', '', 'Administrator', 'Administrator', 1, '2022-08-28 19:55:38', '2022-09-14 04:44:49'),
(22, 13, 'ហេតុអ្វីត្រូវសិក្សានៅអាមេរិកសាលាអន្តរទ្វីប (AIS)', 'why study at american intercon school (AIS)', 'why-study-at-american-intercon-school-(AIS)', 'feature_article', 'Main', '0', NULL, 4, 5, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:56:21', NULL),
(23, 13, 'ចក្ខុវិស័យ និងបេសកកម្ម', 'vision and mission', 'vision-and-mission', 'feature_article', 'Main', '0', NULL, 6, 7, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:56:53', NULL),
(24, 13, 'ឧបករណ៍', 'equipment', 'equipment', 'feature_article', 'Main', '0', NULL, 8, 9, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:57:20', NULL),
(25, 13, 'បណ្ណាល័យ​ ​ម៉េងលី ជេ​ គួច', 'mengly j. quach library', 'mengly-j.-quach-library', 'feature_article', 'Main', '0', NULL, 10, 11, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:58:06', NULL),
(26, 13, 'សេវាកម្មផ្សេងទៀត។', 'other services', 'other-services', 'feature_article', 'Main', '0', NULL, 12, 19, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:58:35', NULL),
(27, 13, 'សមិទ្ធិផលរបស់យើង។', 'our achievement', 'our-achievement', 'feature_article', 'Main', '0', NULL, 20, 21, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:59:12', NULL),
(28, 13, 'ពានរង្វាន់ និងវិញ្ញាបនបត្រ', 'awards and certificates', 'awards-and-certificates', 'feature_article', 'Main', '0', NULL, 22, 23, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 19:59:35', NULL),
(29, 13, 'events', 'events', 'events', 'feature_article', 'Main', '0', NULL, 24, 25, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:01:52', NULL),
(30, 13, 'ប្រតិទិនសាលា', 'school calendar', 'school-calendar', 'feature_article', 'Main', '0', NULL, 26, 27, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:03:57', NULL),
(31, 14, 'ក្រុមប្រឹក្សាភិបាល', 'board of trustees', 'board-of-trustees', 'feature_article', 'Main', '0', NULL, 30, 31, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:07:21', NULL),
(32, 14, 'ស្ថាបនិក ប្រធាន និងនាយកប្រតិបត្តិ', 'founder, chairman and CEO', 'founder,-chairman-and-CEO', 'feature_article', 'Main', '0', NULL, 32, 33, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:07:57', NULL),
(33, 14, 'ប្រធានសាលាអន្តរទ្វីបអាមេរិកាំង', 'president, american intercon school', 'president,-american-intercon-school', 'feature_article', 'Main', '0', NULL, 34, 35, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:08:30', NULL),
(34, 14, 'គណៈកម្មាធិការសាលា', 'school committee', 'school-committee', 'feature_article', 'Main', '0', NULL, 36, 37, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:10:46', NULL),
(35, 15, 'មត្តេយ្យសិក្សា', 'preschool', 'preschool', 'feature_article', 'Main', '0', NULL, 40, 41, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:11:57', NULL),
(36, 15, 'សាលាមត្តេយ្យ', 'kindergarten school', 'kindergarten-school', 'feature_article', 'Main', '0', NULL, 42, 43, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:12:27', NULL),
(37, 15, 'បឋមសិក្សា', 'elementary school', 'elementary-school', 'feature_article', 'Main', '0', NULL, 44, 45, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:13:04', NULL),
(38, 15, 'អនុវិទ្យាល័យ', 'junior high school', 'junior-high-school', 'feature_article', 'Main', '0', NULL, 46, 47, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:13:33', NULL),
(39, 15, 'វិទ្យាល័យ', 'high school', 'high-school', 'feature_article', 'Main', '0', NULL, 48, 49, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:14:06', NULL),
(40, 16, 'កម្មវិធី ESL', 'ESL program', 'ESL-program', 'feature_article', 'Main', '0', NULL, 52, 53, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:16:10', NULL),
(41, 16, 'ជំនាញ', 'skills', 'skills', 'feature_article', 'Main', '0', NULL, 54, 55, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:16:47', NULL),
(42, 16, 'កម្មវិធីចម្លងវេនសិក្សា', 'bridging program', 'bridging-program', 'feature_article', 'Main', '0', NULL, 56, 57, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:18:16', NULL),
(43, 16, 'កីឡា', 'sports', 'sports', 'feature_article', 'Main', '0', NULL, 58, 59, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:18:53', NULL),
(44, 16, 'កម្មវិធីត្រៀមរដូវក្តៅ', 'summer preparation program', 'summer-preparation-program', 'feature_article', 'Main', '0', NULL, 60, 61, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:19:45', NULL),
(45, 16, 'កម្មវិធីរដូវក្តៅ', 'summer program', 'summer-program', 'feature_article', 'Main', '0', NULL, 62, 63, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:20:53', NULL),
(46, 17, 'គ្រូមត្តេយ្យ និងមត្តេយ្យ', 'preschool and kindergarten teachers', 'preschool-and-kindergarten-teachers', 'feature_article', 'Main', '0', NULL, 66, 67, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:34:02', NULL),
(47, 17, 'គ្រូបឋមសិក្សា', 'elementary school teachers', 'elementary-school-teachers', 'feature_article', 'Main', '0', NULL, 68, 69, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:34:35', NULL),
(48, 17, 'គ្រូបង្រៀននៅវិទ្យាល័យ', 'junior high school teachers', 'junior-high-school-teachers', 'feature_article', 'Main', '0', NULL, 70, 71, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:35:16', NULL),
(49, 17, 'គ្រូបង្រៀនវិទ្យាល័យ', 'high school teachers', 'high-school-teachers', 'feature_article', 'Main', '0', NULL, 72, 73, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:35:56', NULL),
(50, 17, 'គ្រូបង្រៀនភាសាអង់គ្លេស', 'english teachers', 'english-teachers', 'feature_article', 'Main', '0', NULL, 74, 75, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:36:33', NULL),
(51, 17, 'គ្រូជំនាញ', 'skill teachers', 'skill-teachers', 'feature_article', 'Main', '0', NULL, 76, 77, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:37:12', NULL),
(52, 17, 'ទីប្រឹក្សាសាលា', 'school counselor', 'school-counselor', 'feature_article', 'Main', '0', NULL, 78, 79, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:37:44', NULL),
(53, 17, 'ផ្នែករដ្ឋបាល', 'AIS administration department', 'AIS-administration-department', 'feature_article', 'Main', '0', NULL, 80, 81, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:38:39', NULL),
(54, 18, 'សកម្មភាពសិក្សា', 'learning activities', 'learning-activities', 'feature_article', 'Main', '0', NULL, 84, 85, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:45:05', NULL),
(55, 18, 'សិល្បៈ', 'art', 'art', 'feature_article', 'Main', '0', NULL, 86, 87, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:45:45', NULL),
(56, 18, 'បំណិន​ជីវិត', 'life skills', 'life-skills', 'feature_article', 'Main', '0', NULL, 88, 89, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:58:17', NULL),
(57, 18, 'ដំណើរ​កំសាន្ត', 'field trip', 'field-trip', 'feature_article', 'Main', '0', NULL, 90, 91, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:59:05', NULL),
(58, 18, 'ការប្រកួតប្រជែង', 'competitions', 'competitions', 'feature_article', 'Main', '0', NULL, 92, 93, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 20:59:41', NULL),
(59, 18, 'ព្រឹត្តិការណ៍សប្បុរសធម៌', 'charity events', 'charity-events', 'feature_article', 'Main', '0', NULL, 94, 95, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:00:28', NULL),
(60, 18, 'ការពិសោធន៍របស់សិស្ស', 'student experiment', 'student-experiment', 'feature_article', 'Main', '0', NULL, 96, 97, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:01:04', NULL),
(61, 19, 'តម្រូវការចូលរៀន', 'admission requirement', 'admission-requirement', 'feature_article', 'Main', '0', NULL, 100, 101, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:01:54', NULL),
(62, 19, 'ដំណើរការចូលរៀនសម្រាប់និស្សិតថ្មី។', 'admission process for new students', 'admission-process-for-new-students', 'feature_article', 'Main', '0', NULL, 102, 103, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:02:27', NULL),
(63, 26, 'សោរសិស្ស', 'student locker', 'student-locker', 'feature_article', 'Main', '0', NULL, 13, 14, 0, 3, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:31:58', NULL),
(64, 26, 'ហាងលក់សៀវភៅ intercon', 'intercon book store', 'intercon-book-store', 'feature_article', 'Main', '0', NULL, 15, 16, 0, 3, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:32:29', NULL),
(65, 26, 'សេវាកម្មដឹកជញ្ជូនអន្តរ', 'intercon transportation services', 'intercon-transportation-services', 'feature_article', 'Main', '0', NULL, 17, 18, 0, 3, NULL, '', '', 'Administrator', NULL, 1, '2022-08-28 21:33:05', NULL),
(66, 3, 'អំពីយើងបាតកថា', 'About Us Footer', 'About-Us-Footer', 'feature_article', 'Bottom', '0', NULL, 1, 22, 0, 1, NULL, '', '', 'Administrator', 'Administrator', 1, '2022-08-29 16:17:31', '2022-08-30 11:33:21'),
(67, 3, 'រចនាសម្ព័ន្ធបាតកថា', 'Structure Footer', 'Structure-Footer', 'feature_article', 'Bottom', '0', NULL, 23, 28, 0, 1, NULL, '', '', 'Administrator', 'Administrator', 1, '2022-08-29 16:19:20', '2022-08-30 11:34:06'),
(68, 3, 'សាខា', 'Campuses', 'Campuses', 'feature_article', 'Bottom', '0', NULL, 29, 44, 0, 1, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:34:50', NULL),
(69, 66, 'សាលា អន្តរទ្វីប អាមេរិកាំង តាកែវ', 'American Intercon School, Takéo footer', 'American-Intercon-School,-Takéo-footer', 'feature_article', 'Bottom', '0', NULL, 2, 3, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:37:02', NULL),
(70, 67, 'ស្ថាបនិក ប្រធាន និងនាយកប្រតិបត្តិ', 'Founder, Chairman And CEO footer', 'Founder,-Chairman-And-CEO-footer', 'feature_article', 'Bottom', '0', NULL, 24, 25, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:37:43', NULL),
(71, 68, 'សាខា AIS Moa Tse Tong (MTT)', 'AIS Moa Tse Tong Campus (MTT)', 'AIS-Moa-Tse-Tong-Campus-(MTT)', 'feature_article', 'Bottom', '0', NULL, 30, 31, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:38:18', NULL),
(72, 66, 'ហេតុអ្វីត្រូវសិក្សានៅសាលា Intercon (AIS) បាតកថា', 'Why Study At Intercon School (AIS) footer', 'Why-Study-At-Intercon-School-(AIS)-footer', 'feature_article', 'Bottom', '0', NULL, 4, 5, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:43:21', NULL),
(73, 66, 'បាតកថាចក្ខុវិស័យ និងបេសកកម្ម', 'Vision And Mission footer', 'Vision-And-Mission-footer', 'feature_article', 'Bottom', '0', NULL, 6, 7, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:43:49', NULL),
(74, 66, 'បរិក្ខារ', 'Equipment footer', 'Equipment-footer', 'feature_article', 'Bottom', '0', NULL, 8, 9, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:51:01', NULL),
(75, 66, 'បណ្ណាល័យ ម៉េងលី ជេ.គួច', 'Mengly J. Quach Library footer', 'Mengly-J.-Quach-Library-footer', 'feature_article', 'Bottom', '0', NULL, 10, 11, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:51:38', NULL),
(76, 66, 'សមិទ្ធិផលរបស់យើង', 'Our Achievement footer', 'Our-Achievement-footer', 'feature_article', 'Bottom', '0', NULL, 12, 13, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:52:10', NULL),
(77, 66, 'រង្វាន់ និងវិញ្ញាបនបត្រ បាតកថា', 'Awards And Certificates footer', 'Awards-And-Certificates-footer', 'feature_article', 'Bottom', '0', NULL, 14, 15, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:53:10', NULL),
(78, 66, 'ព័ត៌មាន', 'News footer', 'News-footer', 'feature_article', 'Bottom', '0', NULL, 16, 17, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:53:37', NULL),
(79, 66, 'ព្រឹត្តិការណ៍', 'Events footer', 'Events-footer', 'feature_article', 'Bottom', '0', NULL, 18, 19, 0, 2, NULL, '', '', 'Administrator', 'Administrator', 1, '2022-08-30 11:54:04', '2022-09-01 13:29:28'),
(80, 66, 'ប្រតិទិនសាលា', 'School Calendar footer', 'School-Calendar-footer', 'feature_article', 'Bottom', '0', NULL, 20, 21, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:54:30', NULL),
(81, 67, 'គណៈកម្មាធិការសាលា', 'School Committee footer', 'School-Committee-footer', 'feature_article', 'Bottom', '0', NULL, 26, 27, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:55:07', NULL),
(82, 68, 'សាខា AIS ទួលគោក (TK)', 'AISToul Kork Campus (TK)', 'AISToul-Kork-Campus-(TK)', 'feature_article', 'Bottom', '0', NULL, 32, 33, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:55:34', NULL),
(83, 68, 'AIS សាខាចាក់អង្រែ (CA)', 'AIS Chak Angre Campus (CA)', 'AIS-Chak-Angre-Campus-(CA)', 'feature_article', 'Bottom', '0', NULL, 34, 35, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:56:11', NULL),
(84, 68, 'AIS សាខាចោមចៅ (CC)', 'AIS Choam Chao Campus (CC)', 'AIS-Choam-Chao-Campus-(CC)', 'feature_article', 'Bottom', '0', NULL, 36, 37, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:56:38', NULL),
(85, 68, 'AIS សាខាផ្សារថ្មី (PT)', 'AIS Phsar Thmey Campus (PT)', 'AIS-Phsar-Thmey-Campus-(PT)', 'feature_article', 'Bottom', '0', NULL, 38, 39, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:57:01', NULL),
(86, 68, 'AIS សាខាជ្រោយចង្វារ (CCV)', 'AIS Chroy Changva Campus (CCV)', 'AIS-Chroy-Changva-Campus-(CCV)', 'feature_article', 'Bottom', '0', NULL, 40, 41, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:57:24', NULL),
(87, 68, 'AIS សាខាខេត្តសៀមរាប (SR)', 'AIS Siem Reap Campus (SR)', 'AIS-Siem-Reap-Campus-(SR)', 'feature_article', 'Bottom', '0', NULL, 42, 43, 0, 2, NULL, '', '', 'Administrator', NULL, 1, '2022-08-30 11:57:49', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
