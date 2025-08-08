/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: jcifkgkd_study_center
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES
(1,'Admin','admin','admin@example.com','$2y$12$FR5OjPOsiFWIgNRngidfMejUJ4rbsZpZDid2//gDOjW9Mdek9aRaa',NULL,NULL,'2025-05-06 04:39:08','2025-05-06 04:39:08');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_records`
--

DROP TABLE IF EXISTS `attendance_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `regular_attendance` int(11) NOT NULL DEFAULT 0,
  `css_attendance` int(11) NOT NULL DEFAULT 0,
  `cgg_attendance` int(11) NOT NULL DEFAULT 0,
  `spr_father` int(11) NOT NULL DEFAULT 0,
  `spr_mother` int(11) NOT NULL DEFAULT 0,
  `spr_sibling` int(11) NOT NULL DEFAULT 0,
  `record_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendance_records_user_id_record_date_unique` (`user_id`,`record_date`),
  KEY `attendance_records_user_id_index` (`user_id`),
  KEY `attendance_records_record_date_index` (`record_date`),
  CONSTRAINT `attendance_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_records`
--

LOCK TABLES `attendance_records` WRITE;
/*!40000 ALTER TABLE `attendance_records` DISABLE KEYS */;
INSERT INTO `attendance_records` VALUES
(1,1,1,1,1,1,1,1,'2025-07-31',NULL,'2025-05-06 04:39:08','2025-07-31 04:02:40'),
(4,551,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-10 23:15:00','2025-07-31 04:02:40'),
(5,469,2,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:22:48','2025-08-04 21:22:46'),
(6,471,1,4,4,0,1,0,'2025-07-31',NULL,'2025-07-12 08:23:55','2025-08-04 21:22:46'),
(7,474,2,4,4,0,1,0,'2025-07-31',NULL,'2025-07-12 08:24:41','2025-08-04 21:22:46'),
(8,475,4,4,4,1,4,0,'2025-07-31',NULL,'2025-07-12 08:24:54','2025-08-04 21:22:46'),
(9,476,2,4,3,3,2,0,'2025-07-31',NULL,'2025-07-12 08:25:12','2025-08-04 21:22:46'),
(10,480,1,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:26:31','2025-08-04 21:22:46'),
(11,481,2,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:26:51','2025-08-04 21:22:46'),
(12,484,2,4,4,0,1,0,'2025-07-31',NULL,'2025-07-12 08:27:41','2025-08-04 21:22:46'),
(13,485,2,3,4,0,1,0,'2025-07-31',NULL,'2025-07-12 08:27:59','2025-08-04 21:22:46'),
(14,487,2,3,4,4,0,0,'2025-07-31',NULL,'2025-07-12 08:29:31','2025-08-04 21:22:46'),
(15,489,0,2,4,0,2,0,'2025-07-31',NULL,'2025-07-12 08:29:53','2025-08-04 21:22:46'),
(16,490,1,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:30:04','2025-08-04 21:22:46'),
(17,491,1,3,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:30:15','2025-08-04 21:22:46'),
(18,492,0,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:30:31','2025-08-04 21:22:46'),
(19,494,2,4,4,0,4,0,'2025-07-31',NULL,'2025-07-12 08:32:25','2025-08-04 21:22:46'),
(20,495,1,3,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:32:49','2025-08-04 21:22:46'),
(21,496,2,4,4,0,4,0,'2025-07-31',NULL,'2025-07-12 08:33:09','2025-08-04 21:22:46'),
(22,498,3,4,4,4,0,0,'2025-07-31',NULL,'2025-07-12 08:33:40','2025-08-04 21:22:46'),
(23,499,3,4,2,0,0,0,'2025-07-31',NULL,'2025-07-12 08:33:47','2025-08-04 21:22:46'),
(24,502,2,4,4,1,1,0,'2025-07-31',NULL,'2025-07-12 08:34:11','2025-08-04 21:22:46'),
(25,504,2,4,4,1,0,0,'2025-07-31',NULL,'2025-07-12 08:34:33','2025-08-04 21:22:46'),
(26,505,2,3,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:34:52','2025-08-04 21:22:46'),
(27,506,1,2,3,0,0,0,'2025-07-31',NULL,'2025-07-12 08:35:10','2025-08-04 21:22:46'),
(28,507,3,4,4,4,4,0,'2025-07-31',NULL,'2025-07-12 08:35:18','2025-08-04 21:22:46'),
(29,508,2,4,4,4,4,0,'2025-07-31',NULL,'2025-07-12 08:35:25','2025-08-04 21:22:46'),
(30,510,2,4,3,0,0,0,'2025-07-31',NULL,'2025-07-12 08:35:54','2025-08-04 21:22:46'),
(31,511,0,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:36:03','2025-08-04 21:22:46'),
(32,512,1,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:36:12','2025-08-04 21:22:46'),
(33,513,1,3,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:36:25','2025-08-04 21:22:46'),
(34,514,3,4,4,2,0,0,'2025-07-31',NULL,'2025-07-12 08:36:31','2025-08-04 21:22:46'),
(35,515,1,3,3,0,0,0,'2025-07-31',NULL,'2025-07-12 08:36:37','2025-08-04 21:22:46'),
(36,516,0,2,1,0,1,0,'2025-07-31',NULL,'2025-07-12 08:36:59','2025-07-31 04:02:40'),
(37,517,3,4,4,2,2,0,'2025-07-31',NULL,'2025-07-12 08:37:13','2025-08-04 21:22:46'),
(38,518,1,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:37:33','2025-08-04 21:22:46'),
(39,520,0,3,3,0,0,0,'2025-07-31',NULL,'2025-07-12 08:37:57','2025-08-04 21:22:46'),
(40,521,2,4,3,1,0,0,'2025-07-31',NULL,'2025-07-12 08:38:16','2025-08-04 21:22:46'),
(41,523,1,4,4,0,4,0,'2025-07-31',NULL,'2025-07-12 08:38:56','2025-08-04 21:22:46'),
(42,524,2,2,3,0,2,0,'2025-07-31',NULL,'2025-07-12 08:39:04','2025-08-04 21:22:46'),
(43,525,2,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:39:11','2025-08-04 21:22:46'),
(44,526,3,4,4,0,2,0,'2025-07-31',NULL,'2025-07-12 08:39:18','2025-08-04 21:22:46'),
(45,527,1,3,2,0,0,0,'2025-07-31',NULL,'2025-07-12 08:39:28','2025-08-04 21:22:46'),
(46,528,2,4,4,0,3,0,'2025-07-31',NULL,'2025-07-12 08:40:03','2025-08-04 21:22:46'),
(47,531,2,3,4,0,2,0,'2025-07-31',NULL,'2025-07-12 08:40:32','2025-08-04 21:22:46'),
(48,533,2,3,4,4,0,0,'2025-07-31',NULL,'2025-07-12 08:40:48','2025-08-04 21:22:46'),
(49,537,0,1,0,0,0,0,'2025-07-31',NULL,'2025-07-12 08:43:19','2025-07-31 04:02:40'),
(50,538,2,4,4,1,0,0,'2025-07-31',NULL,'2025-07-12 08:43:27','2025-08-04 21:22:46'),
(51,541,1,3,1,0,0,0,'2025-07-31',NULL,'2025-07-12 08:43:47','2025-07-31 04:02:40'),
(52,546,0,3,4,0,1,0,'2025-07-31',NULL,'2025-07-12 08:44:48','2025-08-04 21:22:46'),
(53,549,0,4,4,0,0,0,'2025-07-31',NULL,'2025-07-12 08:45:21','2025-08-04 21:22:46'),
(54,535,0,3,3,3,1,0,'2025-07-31',NULL,'2025-07-12 10:15:51','2025-08-04 21:22:46'),
(55,536,1,4,3,0,2,0,'2025-07-31',NULL,'2025-07-12 10:16:03','2025-08-04 21:22:46'),
(56,519,2,3,2,0,1,0,'2025-07-31',NULL,'2025-07-12 22:01:44','2025-08-04 21:22:46'),
(57,561,2,2,3,1,0,0,'2025-07-31',NULL,'2025-07-15 21:45:24','2025-08-04 21:22:46'),
(58,562,0,1,4,0,2,0,'2025-07-31',NULL,'2025-07-16 22:34:58','2025-08-04 21:22:46'),
(59,470,0,0,4,0,2,0,'2025-07-31',NULL,'2025-07-16 22:57:03','2025-08-04 21:22:46'),
(60,479,2,3,4,0,0,0,'2025-07-31',NULL,'2025-07-16 23:00:02','2025-08-04 21:22:46'),
(61,483,2,4,3,0,0,0,'2025-07-31',NULL,'2025-07-16 23:02:41','2025-08-04 21:22:46'),
(62,500,2,2,3,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(63,501,0,0,2,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(64,503,4,2,2,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(65,509,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(66,522,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(67,529,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 20:29:20'),
(68,530,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(69,532,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 20:29:20'),
(70,534,6,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-05 19:37:57'),
(71,539,0,1,3,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(72,540,1,1,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(73,542,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(74,543,0,3,2,0,1,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(75,544,5,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-05 19:37:57'),
(76,545,0,0,4,0,3,1,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(77,547,2,0,1,0,0,0,'2025-08-06',NULL,'2025-07-16 23:39:35','2025-08-06 02:24:27'),
(78,548,1,1,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(79,550,0,1,3,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(80,552,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(81,553,0,3,4,4,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(82,554,3,2,4,1,4,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(83,555,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-05 19:37:57'),
(84,556,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(85,557,4,2,3,0,2,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(86,558,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-05 19:37:57'),
(87,559,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-07-31 04:02:40'),
(88,560,1,1,3,0,0,0,'2025-07-31',NULL,'2025-07-16 23:39:35','2025-08-04 21:22:46'),
(89,472,6,2,0,0,0,0,'2025-08-06',NULL,'2025-07-21 23:12:00','2025-08-06 02:22:56'),
(90,473,1,1,1,0,0,0,'2025-07-31',NULL,'2025-07-21 23:12:00','2025-08-04 21:22:46'),
(91,477,3,0,0,0,0,0,'2025-08-06',NULL,'2025-07-21 23:12:00','2025-08-06 02:28:13'),
(92,478,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-21 23:12:00','2025-07-31 04:02:40'),
(93,482,1,3,2,0,0,0,'2025-08-06',NULL,'2025-07-21 23:12:00','2025-08-06 02:27:53'),
(94,486,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-21 23:12:00','2025-08-04 20:29:20'),
(95,488,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-21 23:12:00','2025-08-04 20:29:20'),
(96,493,1,2,1,0,1,0,'2025-07-31',NULL,'2025-07-21 23:12:00','2025-08-04 21:22:46'),
(97,497,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-21 23:12:00','2025-08-04 20:29:20'),
(98,563,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-22 02:02:38','2025-07-31 04:02:40'),
(99,564,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-22 02:06:18','2025-08-04 20:29:20'),
(100,565,1,0,2,0,0,0,'2025-07-31',NULL,'2025-07-23 22:39:37','2025-08-04 21:22:46'),
(101,566,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-23 22:45:39','2025-07-31 04:02:40'),
(102,567,1,1,1,1,0,0,'2025-07-31',NULL,'2025-07-23 22:52:13','2025-08-04 21:22:46'),
(103,568,2,1,1,0,0,0,'2025-07-31',NULL,'2025-07-23 22:59:37','2025-08-04 21:22:46'),
(104,569,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-23 23:21:31','2025-08-04 20:29:20'),
(105,570,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-23 23:24:06','2025-08-04 20:29:20'),
(106,571,1,0,0,0,0,0,'2025-07-31',NULL,'2025-07-24 00:26:25','2025-07-31 04:02:40'),
(107,572,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-24 02:29:08','2025-08-04 20:29:20'),
(108,573,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-24 02:31:28','2025-07-31 04:02:40'),
(109,574,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-24 02:34:51','2025-08-04 20:29:20'),
(110,575,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-24 23:01:10','2025-08-04 20:29:20'),
(111,576,4,2,1,0,0,0,'2025-07-31',NULL,'2025-07-25 00:30:54','2025-08-04 21:22:46'),
(112,577,4,2,1,0,0,0,'2025-07-31',NULL,'2025-07-25 00:33:24','2025-08-04 21:22:46'),
(113,578,0,1,1,0,1,0,'2025-07-31',NULL,'2025-07-25 00:34:52','2025-08-04 21:22:46'),
(114,579,1,1,1,0,1,0,'2025-07-31',NULL,'2025-07-29 19:10:05','2025-08-04 21:22:46'),
(115,580,4,2,0,0,0,0,'2025-07-31',NULL,'2025-07-29 19:12:43','2025-08-04 20:29:20'),
(116,581,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-29 19:47:52','2025-08-04 20:29:20'),
(117,582,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-29 19:49:26','2025-08-04 20:29:20'),
(118,583,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-31 01:01:33','2025-07-31 01:01:33'),
(119,584,1,0,0,0,0,0,'2025-08-06',NULL,'2025-07-31 01:04:56','2025-08-06 02:23:50'),
(120,585,3,0,0,0,0,0,'2025-07-31',NULL,'2025-07-31 01:07:03','2025-08-05 19:37:57'),
(121,586,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-31 01:09:05','2025-07-31 01:09:05'),
(122,587,0,0,0,0,0,0,'2025-07-31',NULL,'2025-07-31 01:18:20','2025-07-31 01:18:20'),
(123,588,2,0,0,0,0,0,'2025-07-31',NULL,'2025-07-31 01:20:00','2025-08-05 19:37:57'),
(124,589,0,0,0,0,0,0,'2025-08-06',NULL,'2025-08-05 23:27:18','2025-08-05 23:27:18'),
(125,590,0,0,0,0,0,0,'2025-08-06',NULL,'2025-08-05 23:30:16','2025-08-05 23:30:16'),
(126,591,0,0,0,0,0,0,'2025-08-06',NULL,'2025-08-05 23:32:34','2025-08-05 23:32:34'),
(127,592,0,0,0,0,0,0,'2025-08-06',NULL,'2025-08-05 23:34:34','2025-08-05 23:34:34'),
(128,593,0,0,0,0,0,0,'2025-08-06',NULL,'2025-08-05 23:49:10','2025-08-05 23:49:10'),
(129,594,0,0,0,0,0,0,'2025-08-06',NULL,'2025-08-06 00:02:30','2025-08-06 00:02:30');
/*!40000 ALTER TABLE `attendance_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `family_members`
--

DROP TABLE IF EXISTS `family_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `family_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `relationship` enum('father','mother','sibling','other') NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `member_ids` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `family_members_user_id_index` (`user_id`),
  KEY `family_members_relationship_index` (`relationship`),
  KEY `family_members_name_index` (`name`),
  CONSTRAINT `family_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1423 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family_members`
--

LOCK TABLES `family_members` WRITE;
/*!40000 ALTER TABLE `family_members` DISABLE KEYS */;
INSERT INTO `family_members` VALUES
(1151,469,'SUHERMAN','father','Tidak terdata','0','jl. lautze no 8.c',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1152,469,'Tidak terdata','mother','Tidak terdata','0','jl. lautze no 8.c',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1153,469,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1154,470,'Seri','father','Tidak terdata','0','jl.ketapang 2',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1155,470,'Melly','mother','Tidak terdata','0','jl.ketapang 2',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1156,470,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1157,471,'Tidak terdata','father','Tidak terdata','0','JL.TUNAS BERINGIN NO.18A',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1158,471,'JULIA EKA AUR SITHA','mother','Tidak terdata','0','JL.TUNAS BERINGIN NO.18A',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1159,471,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1160,472,'Tidak terdata','father','Tidak terdata','0','Jl.rawa selatan 4 no.2',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1161,472,'Tidak terdata','mother','Tidak terdata','0','Jl.rawa selatan 4 no.2',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1162,472,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:20','2025-07-10 23:09:20'),
(1163,473,'Tidak terdata','father','Tidak terdata','0','JL.TUNAS BERINGIN NO 18A',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1164,473,'Tidak terdata','mother','Tidak terdata','0','JL.TUNAS BERINGIN NO 18A',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1165,473,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1166,474,'Tidak terdata','father','Tidak terdata','0','Budirahayu/pangeran Jayakarta',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1167,474,'Meilisa','mother','Tidak terdata','0','Budirahayu/pangeran Jayakarta',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1168,474,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1169,475,'Hendy','father','Tidak terdata','0','Serdang Raya No.23',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1170,475,'Mui Li','mother','Tidak terdata','0','Serdang Raya No.23',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1171,475,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1172,476,'ARIE RUSLI','father','Tidak terdata','0','Jl. Rawa Tengah Gang Delapan C No. 4',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1173,476,'PETTY RIANA','mother','Tidak terdata','0','Jl. Rawa Tengah Gang Delapan C No. 4',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1174,476,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:21','2025-07-10 23:09:21'),
(1175,477,'Tidak terdata','father','Tidak terdata','0','Jalan Kampung Rawa tengah no.28',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1176,477,'Tidak terdata','mother','Tidak terdata','0','Jalan Kampung Rawa tengah no.28',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1177,477,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1178,478,'Tidak terdata','father','Tidak terdata','0','jln kemayoran barat 3',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1179,478,'Tidak terdata','mother','Tidak terdata','0','jln kemayoran barat 3',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1180,478,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1181,479,'Tidak terdata','father','Tidak terdata','0','Sunter bentenggan',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1182,479,'SANGGUL NURSIA S ','mother','Tidak terdata','0','Sunter bentenggan',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1183,479,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1184,480,'ANDRE PAULUS KAUNANG ','father','Tidak terdata','0','Jl.Howitzer Raya No 21',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1185,480,'YANTI LIJU','mother','Tidak terdata','0','Jl.Howitzer Raya No 21',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1186,480,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:22','2025-07-10 23:09:22'),
(1187,481,'BERNAD WIJAYA ','father','Tidak terdata','0','Jln. Angkasa Dalam 1 No 42 A',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1188,481,'FEBRINA','mother','Tidak terdata','0','Jln. Angkasa Dalam 1 No 42 A',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1189,481,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1190,482,'Tidak terdata','father','Tidak terdata','0','Jln Rawa Sengon Gang Mawar No 144b RT.2 RW.22 Kelapa Gading Barat, Kecamatan Kelapa Gading, Kotamadya Jakarta Utara',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1191,482,'Tidak terdata','mother','Tidak terdata','0','Jln Rawa Sengon Gang Mawar No 144b RT.2 RW.22 Kelapa Gading Barat, Kecamatan Kelapa Gading, Kotamadya Jakarta Utara',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1192,482,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1193,483,'MANTO MANURUNG','father','Tidak terdata','0','Jln Rawa Sengon Gang Mawar No 144b',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1194,483,'Tidak terdata','mother','Tidak terdata','0','Jln Rawa Sengon Gang Mawar No 144b',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1195,483,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1196,484,'Tidak terdata','father','Tidak terdata','0','KP. BARU BLOK G NO.106',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1197,484,'CHRISTINE MAILUHU','mother','Tidak terdata','0','KP. BARU BLOK G NO.106',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1198,484,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:23','2025-07-10 23:09:23'),
(1199,485,'Tidak terdata','father','Tidak terdata','0','Jl. C GG.3 NO.38C RT/RW:005/003 KARANG ANYAR JAKARTA PUSAT',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1200,485,'ELNA','mother','Tidak terdata','0','Jl. C GG.3 NO.38C RT/RW:005/003 KARANG ANYAR JAKARTA PUSAT',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1201,485,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1202,486,'Tidak terdata','father','Tidak terdata','0','Jl.h daimun',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1203,486,'Tidak terdata','mother','Tidak terdata','0','Jl.h daimun',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1204,486,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1205,487,'PHANG WIE KHONG','father','Tidak terdata','0','Jalan Gunung sahari 8 dalam No.23A2. Belakang Showroom Honda Motor PT. Wahana, deket Sekolah Pasikin.',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1206,487,'NOVI SUSANTO','mother','Tidak terdata','0','Jalan Gunung sahari 8 dalam No.23A2. Belakang Showroom Honda Motor PT. Wahana, deket Sekolah Pasikin.',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1207,487,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1208,488,'Tidak terdata','father','Tidak terdata','0','Jl Kran 2 No 18',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1209,488,'Tidak terdata','mother','Tidak terdata','0','Jl Kran 2 No 18',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1210,488,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:24','2025-07-10 23:09:24'),
(1211,489,'Tidak terdata','father','Tidak terdata','0','Jln apron blok 1B no 502.kemayoran.jakarta pusat',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1212,489,'ESNITA SIBURIAN','mother','Tidak terdata','0','Jln apron blok 1B no 502.kemayoran.jakarta pusat',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1213,489,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1214,490,'ADAT JUPRI SIAGIAN','father','Tidak terdata','0','Jalan Anyer 14 no 8',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1215,490,'MAMUNGUT M BUTAR BUTAR','mother','Tidak terdata','0','Jalan Anyer 14 no 8',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1216,490,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1217,491,'Tidak terdata','father','Tidak terdata','0','angkasa dalam 1 no 60c',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1218,491,'NATALIA RUSLI','mother','Tidak terdata','0','angkasa dalam 1 no 60c',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1219,491,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1220,492,'Tidak terdata','father','Tidak terdata','0','Jl. Budi Mulia',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1221,492,'YUVENSIA MELY JUITA','mother','Tidak terdata','0','Jl. Budi Mulia',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1222,492,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:25','2025-07-10 23:09:25'),
(1223,493,'Tidak terdata','father','Tidak terdata','0','Jl. Intan I no. 67',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1224,493,'LINDA KARTONO ','mother','Tidak terdata','0','Jl. Intan I no. 67',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1225,493,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1226,494,'Tidak terdata','father','Tidak terdata','0','JL. Cempaka Putih Barat, No. 38.',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1227,494,'SUSAN','mother','Tidak terdata','0','JL. Cempaka Putih Barat, No. 38.',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1228,494,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1229,495,'SADAT IRIANTO','father','Tidak terdata','0','JL. cempaka wangi I',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1230,495,'TJONG LINAWATI','mother','Tidak terdata','0','JL. cempaka wangi I',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1231,495,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1232,496,'Tidak terdata','father','Tidak terdata','0','Kemayoran utan panjang',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1233,496,'SHELLA','mother','Tidak terdata','0','Kemayoran utan panjang',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1234,496,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1235,497,'Tidak terdata','father','Tidak terdata','0','Jl.Pademangan 3 gg 14 no 121',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1236,497,'Tidak terdata','mother','Tidak terdata','0','Jl.Pademangan 3 gg 14 no 121',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1237,497,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:26','2025-07-10 23:09:26'),
(1238,498,'TEKSIN WIJAYA','father','Tidak terdata','0','Pasar Ayam Lokomotif, Jalan Bekasi Barat Dalam I No. 11',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1239,498,'Tidak terdata','mother','Tidak terdata','0','Pasar Ayam Lokomotif, Jalan Bekasi Barat Dalam I No. 11',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1240,498,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1241,499,'Tidak terdata','father','Tidak terdata','0','JL Ampera 4 No 34b',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1242,499,'Tidak terdata','mother','Tidak terdata','0','JL Ampera 4 No 34b',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1243,499,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1244,500,'TIRTA PERDANA PURBA','father','Tidak terdata','0','Jl. Putri no 6',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1245,500,'Ira Ekawati Ginting','mother','Tidak terdata','0','Jl. Putri no 6',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1246,500,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1247,501,'LIE NURJUKI ','father','Tidak terdata','0','Rusunawa KS Tubun lt 10 a 02',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1248,501,'NURAENIH ','mother','Tidak terdata','0','Rusunawa KS Tubun lt 10 a 02',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1249,501,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:27','2025-07-10 23:09:27'),
(1250,502,'SUHANTO','father','Tidak terdata','0','Jl.karang anyar gg no 16',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1251,502,'RINI HARYANTI','mother','Tidak terdata','0','Jl.karang anyar gg no 16',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1252,502,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1253,503,'Tidak terdata','father','Tidak terdata','0','Jl rawa tengah',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1254,503,'Tidak terdata','mother','Tidak terdata','0','Jl rawa tengah',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1255,503,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1256,504,'HERMANTO','father','Tidak terdata','0','sunter jaya 1, 27',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1257,504,'Tidak terdata','mother','Tidak terdata','0','sunter jaya 1, 27',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1258,504,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1259,505,'Tidak terdata','father','Tidak terdata','0','Cempaka wangi I harapan mulia kemayoran',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1260,505,'CHRISELDA','mother','Tidak terdata','0','Cempaka wangi I harapan mulia kemayoran',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1261,505,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:28','2025-07-10 23:09:28'),
(1262,506,'Tidak terdata','father','Tidak terdata','0','Sunter Jaya 6B blok K nomor 4',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1263,506,'Tidak terdata','mother','Tidak terdata','0','Sunter Jaya 6B blok K nomor 4',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1264,506,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1265,507,'RUDY','father','Tidak terdata','0','Jl. Percetakan Negara VIII No.24',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1266,507,'WOEN HUE TJOE','mother','Tidak terdata','0','Jl. Percetakan Negara VIII No.24',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1267,507,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1268,508,'RUDY','father','Tidak terdata','0','Jl. Percetakan Negara VIII No.27',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1269,508,'WOEN HUE TJOE','mother','Tidak terdata','0','Jl. Percetakan Negara VIII No.27',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1270,508,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1271,509,'Tidak terdata','father','Tidak terdata','0','Jl rawa tengah rt013/005',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1272,509,'Tidak terdata','mother','Tidak terdata','0','Jl rawa tengah rt013/005',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1273,509,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:29','2025-07-10 23:09:29'),
(1274,510,'Tidak terdata','father','Tidak terdata','0','GG Mohamad ali IV no 2',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1275,510,'Tidak terdata','mother','Tidak terdata','0','GG Mohamad ali IV no 2',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1276,510,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1277,511,'Tidak terdata','father','Tidak terdata','0','Jl Dwiwarna Raya No.32 A',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1278,511,'Tidak terdata','mother','Tidak terdata','0','Jl Dwiwarna Raya No.32 A',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1279,511,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1280,512,'TJOENG TJEN YUNG','father','Tidak terdata','0','Jl. Dwiwarna Raya no.32 A',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1281,512,'YULIA','mother','Tidak terdata','0','Jl. Dwiwarna Raya no.32 A',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1282,512,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1283,513,'TJOENG TJEN YUNG','father','Tidak terdata','0','Jl. Dwiwarna Raya No.32 A',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1284,513,'YULIA','mother','Tidak terdata','0','Jl. Dwiwarna Raya No.32 A',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1285,513,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:30','2025-07-10 23:09:30'),
(1286,514,'LAURENSIUS SURYANTO','father','Tidak terdata','0','Jalan Gulifer No.29,Rt 04/Rw 010 Cempaka baru, kemayoran, jakarta pusat',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1287,514,'Tidak terdata','mother','Tidak terdata','0','Jalan Gulifer No.29,Rt 04/Rw 010 Cempaka baru, kemayoran, jakarta pusat',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1288,514,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1289,515,'Tidak terdata','father','Tidak terdata','0','Jln. Kran 5 no 22',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1290,515,'NOVIE FARDIANAWATI','mother','Tidak terdata','0','Jln. Kran 5 no 22',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1291,515,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1292,516,'LIMBONG','father','Tidak terdata','0','Jalan Pemuda 1',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1293,516,'TARIDA SAMOSIR','mother','Tidak terdata','0','Jalan Pemuda 1',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1294,516,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1295,517,'SUHANTO','father','Tidak terdata','0','Jl Karang Anyat Gg. I no 16',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1296,517,'RINI HARYANTI','mother','Tidak terdata','0','Jl Karang Anyat Gg. I no 16',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1297,517,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:31','2025-07-10 23:09:31'),
(1298,518,'ADAT JUPRI SIAGIAN','father','Tidak terdata','0','Jl. Anyer no 14 RT 08 RW 09',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1299,518,'MAMUNGUT M BUTAR BUTAR','mother','Tidak terdata','0','Jl. Anyer no 14 RT 08 RW 09',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1300,518,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1301,519,'SADAH SIWOM','father','Tidak terdata','0','jalan Sunter Pulo kecil Blok HR no.7b',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1302,519,'PERAWATI NINGSIH','mother','Tidak terdata','0','jalan Sunter Pulo kecil Blok HR no.7b',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1303,519,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1304,520,'Tidak terdata','father','Tidak terdata','0','jl.kampung rawa no.15 gang permata 6',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1305,520,'SUSANTI MARIANI','mother','Tidak terdata','0','jl.kampung rawa no.15 gang permata 6',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1306,520,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1307,521,'KURNIA DARMAWAN SOEWONDO','father','Tidak terdata','0','Jl. Dwiwarna Gg. 0 No. 34',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1308,521,'LIA YUNITA','mother','Tidak terdata','0','Jl. Dwiwarna Gg. 0 No. 34',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1309,521,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:32','2025-07-10 23:09:32'),
(1310,522,'Tidak terdata','father','Tidak terdata','0','Jln. Swadaya V no. 8A',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1311,522,'Tidak terdata','mother','Tidak terdata','0','Jln. Swadaya V no. 8A',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1312,522,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1313,523,'Tidak terdata','father','Tidak terdata','0','Kemayoran, utan panjang',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1314,523,'SHELLA','mother','Tidak terdata','0','Kemayoran, utan panjang',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1315,523,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1316,524,'Tidak terdata','father','Tidak terdata','0','Jln harapan jaya raya nomor 15',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1317,524,'Tidak terdata','mother','Tidak terdata','0','Jln harapan jaya raya nomor 15',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1318,524,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1319,525,'Tidak terdata','father','Tidak terdata','0','Jl. SAMBILOTO 4',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1320,525,'Tidak terdata','mother','Tidak terdata','0','Jl. SAMBILOTO 4',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1321,525,'Nelis','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:33','2025-07-10 23:09:33'),
(1322,526,'JIMMY IRAWAN','father','Tidak terdata','0','Alamat \nJl. Gang budi rahayu 3 no. 10 rt/w. 002/009 kel. Mangga dua selatan - kec. Sawah besar jakarta pusat 10730',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1323,526,'SUSANA WINATA','mother','Tidak terdata','0','Alamat \nJl. Gang budi rahayu 3 no. 10 rt/w. 002/009 kel. Mangga dua selatan - kec. Sawah besar jakarta pusat 10730',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1324,526,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1325,527,'Tidak terdata','father','Tidak terdata','0','Jl.Kampung Irian Gang 2 no 38A',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1326,527,'Tidak terdata','mother','Tidak terdata','0','Jl.Kampung Irian Gang 2 no 38A',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1327,527,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1328,528,'Tidak terdata','father','Tidak terdata','0','Kp irian 1 GG 12 no 17',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1329,528,'RIA INDRIYANI','mother','Tidak terdata','0','Kp irian 1 GG 12 no 17',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1330,528,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1331,529,'Tidak terdata','father','Tidak terdata','0','Pademangan 8 no 8 RT 7 RW 10',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1332,529,'Tidak terdata','mother','Tidak terdata','0','Pademangan 8 no 8 RT 7 RW 10',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1333,529,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:34','2025-07-10 23:09:34'),
(1334,530,'Tidak terdata','father','Tidak terdata','0','Greend Pramuka square',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1335,530,'Tidak terdata','mother','Tidak terdata','0','Greend Pramuka square',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1336,530,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1337,531,'Tidak terdata','father','Tidak terdata','0','Jl. Harapan Jaya Raya no 15',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1338,531,'Tidak terdata','mother','Tidak terdata','0','Jl. Harapan Jaya Raya no 15',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1339,531,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1340,532,'Tidak terdata','father','Tidak terdata','0','Jl. Budi Mulia No. 15',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1341,532,'Tidak terdata','mother','Tidak terdata','0','Jl. Budi Mulia No. 15',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1342,532,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1343,533,'ANDRIANTO','father','Tidak terdata','0','Jln. EKONOMI No 1',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1344,533,'Tidak terdata','mother','Tidak terdata','0','Jln. EKONOMI No 1',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1345,533,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:35','2025-07-10 23:09:35'),
(1346,534,'Tidak terdata','father','Tidak terdata','0','Serdang Raya no.23',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1347,534,'Tidak terdata','mother','Tidak terdata','0','Serdang Raya no.23',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1348,534,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1349,535,'ROBBIE ','father','Tidak terdata','0','Gading icon',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1350,535,'DIAN RAHMAWATI ','mother','Tidak terdata','0','Gading icon',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1351,535,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1352,536,'Tidak terdata','father','Tidak terdata','0','jl cempaka baru 11',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1353,536,'NURLAILA MAHMUDA','mother','Tidak terdata','0','jl cempaka baru 11',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1354,536,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1355,537,'FRANCISCUS ARIFIN','father','Tidak terdata','0','Gang laggr dalam o 15',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1356,537,'PRIYATI DJAMAN','mother','Tidak terdata','0','Gang laggr dalam o 15',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1357,537,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:36','2025-07-10 23:09:36'),
(1358,538,'Tidak terdata','father','Tidak terdata','0','Jl. Tembaga Dalam 2 No.L123G',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1359,538,'TJIN SIK NGO','mother','Tidak terdata','0','Jl. Tembaga Dalam 2 No.L123G',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1360,538,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1361,539,'Tidak terdata','mother','Tidak terdata','0','Karang anyar a gg 10',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1362,539,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1363,540,'Tidak terdata','father','Tidak terdata','0','Jalan A,gang 6,no.8',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1364,540,'Tidak terdata','mother','Tidak terdata','0','Jalan A,gang 6,no.8',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1365,540,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1366,541,'Tidak terdata','father','Tidak terdata','0','Kp serdang',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1367,541,'Tidak terdata','mother','Tidak terdata','0','Kp serdang',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1368,541,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1369,542,'YUSTINUS','father','Tidak terdata','0','Jl. Cempaka Baru IX No. 70C',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1370,542,'Tidak terdata','mother','Tidak terdata','0','Jl. Cempaka Baru IX No. 70C',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1371,542,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:37','2025-07-10 23:09:37'),
(1372,543,'Tidak terdata','father','Tidak terdata','0','Jl. Lapangan Pors VII No. 1C',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1373,543,'Tidak terdata','mother','Tidak terdata','0','Jl. Lapangan Pors VII No. 1C',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1374,543,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1375,544,'Tidak terdata','father','Tidak terdata','0','Kp Serdang',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1376,544,'Tidak terdata','mother','Tidak terdata','0','Kp Serdang',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1377,544,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1378,545,'Tidak terdata','father','Tidak terdata','0','Sunter Jaya 1',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1379,545,'Tidak terdata','mother','Tidak terdata','0','Sunter Jaya 1',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1380,545,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1381,546,'YULIUS SULAIMAN','father','Tidak terdata','0','Jln.bungur besar raya no 54E',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1382,546,'ALBERTA MANING','mother','Tidak terdata','0','Jln.bungur besar raya no 54E',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1383,546,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:38','2025-07-10 23:09:38'),
(1384,547,'Tidak terdata','father','Tidak terdata','0','Jaln bungur besar Raya no 54E',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1385,547,'Tidak terdata','mother','Tidak terdata','0','Jaln bungur besar Raya no 54E',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1386,547,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1387,548,'Tidak terdata','father','Tidak terdata','0','Jl.kampung iriang gang 2 no 38A',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1388,548,'Tidak terdata','mother','Tidak terdata','0','Jl.kampung iriang gang 2 no 38A',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1389,548,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1390,549,'Tidak terdata','father','Tidak terdata','0','Jl. Kartini XB dalam',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1391,549,'RANI DEWI ASTUTI','mother','Tidak terdata','0','Jl. Kartini XB dalam',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1392,549,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1393,550,'Tidak terdata','father','Tidak terdata','0','Pademangan 2 gg 9 nomor 106A',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1394,550,'Tidak terdata','mother','Tidak terdata','0','Pademangan 2 gg 9 nomor 106A',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1395,550,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-10 23:09:39','2025-07-10 23:09:39'),
(1396,552,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:14','2025-07-14 22:02:14'),
(1397,552,'Tidak terdata','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:14','2025-07-14 22:02:14'),
(1398,552,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:14','2025-07-14 22:02:14'),
(1399,553,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:14','2025-07-14 22:02:14'),
(1400,553,'Tidak terdata','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:14','2025-07-14 22:02:14'),
(1401,553,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:14','2025-07-14 22:02:14'),
(1402,554,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1403,554,'Fitriyani','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1404,554,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1405,555,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1406,555,'Dewielie','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1407,555,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1408,556,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1409,556,'Dewielie','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1410,556,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1411,557,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1412,557,'Nurlaila Mahmuda','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1413,557,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:15','2025-07-14 22:02:15'),
(1414,558,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1415,558,'Tidak terdata','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1416,558,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1417,559,'Tidak terdata','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1418,559,'Tidak terdata','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1419,559,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1420,560,'FREDY INDRA','father','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1421,560,'NURHAYATI','mother','Tidak terdata','0','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16'),
(1422,560,'Tidak terdata','sibling','Tidak terdata','Tidak terdata','Tidak terdata',NULL,'2025-07-14 22:02:16','2025-07-14 22:02:16');
/*!40000 ALTER TABLE `family_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fileable_type` varchar(255) NOT NULL,
  `fileable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `disk` varchar(255) NOT NULL DEFAULT 'local',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `uploaded_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_fileable_type_fileable_id_index` (`fileable_type`,`fileable_id`),
  KEY `files_fileable_type_index` (`fileable_type`),
  KEY `files_fileable_id_index` (`fileable_id`),
  KEY `files_uploaded_by_index` (`uploaded_by`),
  CONSTRAINT `files_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journal_comments`
--

DROP TABLE IF EXISTS `journal_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `journal_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `journal_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_comments_admin_id_foreign` (`admin_id`),
  KEY `journal_comments_journal_id_index` (`journal_id`),
  KEY `journal_comments_user_id_admin_id_index` (`user_id`,`admin_id`),
  CONSTRAINT `journal_comments_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `journal_comments_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `journal_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journal_comments`
--

LOCK TABLES `journal_comments` WRITE;
/*!40000 ALTER TABLE `journal_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `journal_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journals`
--

DROP TABLE IF EXISTS `journals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `journals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `mengawali_hari_dengan_berdoa` tinyint(1) NOT NULL DEFAULT 0,
  `baca_alkitab_pl` tinyint(1) NOT NULL DEFAULT 0,
  `baca_alkitab_pb` tinyint(1) NOT NULL DEFAULT 0,
  `hadir_kelas_sc` tinyint(1) NOT NULL DEFAULT 0,
  `hadir_css` tinyint(1) NOT NULL DEFAULT 0,
  `hadir_cgg` tinyint(1) NOT NULL DEFAULT 0,
  `merapikan_tempat_tidur` tinyint(1) NOT NULL DEFAULT 0,
  `menyapa_orang_tua` tinyint(1) NOT NULL DEFAULT 0,
  `is_submitted` tinyint(1) NOT NULL DEFAULT 0,
  `selfie_image` varchar(255) DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `entry_date` date NOT NULL,
  `status` enum('draft','submitted','reviewed') NOT NULL DEFAULT 'draft',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `journals_user_id_entry_date_unique` (`user_id`,`entry_date`),
  KEY `journals_reviewed_by_foreign` (`reviewed_by`),
  KEY `journals_user_id_index` (`user_id`),
  KEY `journals_entry_date_index` (`entry_date`),
  KEY `journals_status_index` (`status`),
  CONSTRAINT `journals_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `journals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journals`
--

LOCK TABLES `journals` WRITE;
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;
INSERT INTO `journals` VALUES
(2,1,0,0,0,1,1,1,0,0,1,'journals/selfies/KngzY5bPtCdxzTpHk4y0wzfMGwEaYWNQPfN6Y3T0.jpg',NULL,'2025-07-09','draft',NULL,NULL,NULL,'2025-07-08 19:19:16','2025-07-08 19:19:16',NULL),
(3,498,1,1,1,0,0,0,1,1,1,'journals/selfies/8nUxJiZpsMNDm0pFHOE4MZrcj0yIDL4qyV4ec0KM.jpg',NULL,'2025-07-11','draft',NULL,NULL,NULL,'2025-07-11 04:35:59','2025-07-11 04:35:59',NULL),
(4,493,1,1,1,0,0,0,1,1,1,'journals/selfies/NXEdFENzMaWLTsUTCDawIV5knzrEqzuz01k0gyq3.jpg',NULL,'2025-07-11','draft',NULL,NULL,NULL,'2025-07-11 05:00:50','2025-07-11 05:00:50',NULL),
(5,526,1,0,0,0,0,0,1,1,1,'journals/selfies/Xp7DVRP7OkLs468voYUnQ8jmjVIXrEbhvU7uGK64.jpg',NULL,'2025-07-12','draft',NULL,NULL,NULL,'2025-07-11 21:50:21','2025-07-11 21:50:21',NULL),
(6,484,1,1,1,0,1,0,1,1,1,'journals/selfies/LOkRfAX2KLVvndT50XpVwFQvcxY8QLLCJQZJyl5B.jpg',NULL,'2025-07-12','draft',NULL,NULL,NULL,'2025-07-12 06:40:19','2025-07-12 06:40:19',NULL),
(7,475,1,0,1,0,0,0,1,0,1,'journals/selfies/wdY2UaruXu4JfSLiMlIxGnx61NZuiUrHb7iE21gH.jpg',NULL,'2025-07-12','draft',NULL,NULL,NULL,'2025-07-12 08:05:03','2025-07-12 08:05:03',NULL),
(8,1,0,1,0,0,1,0,0,0,1,'journals/selfies/W7IZZlo7qfQZ1Yn1siRq7IInotGeDbDOLUFG3Zg6.jpg',NULL,'2025-07-12','draft',NULL,NULL,NULL,'2025-07-12 08:07:03','2025-07-12 08:07:03',NULL),
(9,525,1,1,1,1,1,1,1,1,1,'journals/selfies/yLHln2jhoswLuyqvzWMo0tUitZXBEvTsAJopJUMC.jpg',NULL,'2025-07-12','draft',NULL,NULL,NULL,'2025-07-12 08:17:47','2025-07-12 08:17:47',NULL),
(11,516,1,1,1,0,1,0,1,1,1,'journals/selfies/U8KVRm1GzeOZzOTdf9DqiQtdUZu2m2aTJWwC62QA.jpg',NULL,'2025-07-12','draft',NULL,NULL,NULL,'2025-07-12 08:51:19','2025-07-12 08:51:19',NULL),
(12,531,1,0,1,1,1,1,1,1,1,'journals/selfies/5xyYrtg3tkpFDIrfA37OXCQTjJ9BXDS2rLOPVTby.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-12 19:50:00','2025-07-12 19:50:00',NULL),
(13,498,1,1,1,0,0,1,1,1,1,'journals/selfies/jeuFZJIvao4RzGQnxtDTV9iB81NvEijpHXP9MQrr.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-12 23:14:56','2025-07-12 23:14:56',NULL),
(14,475,1,1,1,0,0,1,1,1,1,'journals/selfies/ROHApIjMRBXfAUVNuuHVURZwWl70q9DN7fnaaV2w.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-13 01:14:57','2025-07-13 01:14:57',NULL),
(15,484,1,1,1,0,0,1,1,1,1,'journals/selfies/CUUISM9ZNk6eminvwMhEHjrEUqM8b61AmuA9fNZA.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-13 06:04:07','2025-07-13 06:04:07',NULL),
(16,516,1,1,1,0,0,1,1,1,1,'journals/selfies/tJDRToIzAriyk1kQKzqoMS1UnmLcmFzEfPb4klsm.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-13 06:43:44','2025-07-13 06:43:44',NULL),
(17,525,1,1,1,1,1,1,1,1,1,'journals/selfies/bjGCsxl6UtOBOzGO3bdfs2gnYZSRtTv9BrQBjLb6.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-13 06:58:50','2025-07-13 06:58:50',NULL),
(18,526,1,0,0,0,0,0,1,1,1,'journals/selfies/NCwluj1zqPe1Hs7SwnSy76SavjahKKK8uhs65b1l.jpg',NULL,'2025-07-13','draft',NULL,NULL,NULL,'2025-07-13 16:10:44','2025-07-13 16:10:44',NULL),
(19,484,1,0,1,0,0,0,1,1,1,'journals/selfies/OEIrvAaOVdM8S3nEQce0rGoJIRgifYgn1kJd72jA.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 06:04:48','2025-07-14 06:04:48',NULL),
(20,516,1,1,1,0,0,0,1,1,1,'journals/selfies/jZvpAXXKwTo11YIIzcFS42tdP9AX1Q1GGYy2l9xO.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 06:04:57','2025-07-14 06:04:57',NULL),
(21,498,1,1,1,0,0,0,1,1,1,'journals/selfies/5G133ddlMxLpzLZ1k2tnsO9KSxHZxVgr1rDumAIG.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 06:20:43','2025-07-14 06:20:43',NULL),
(22,493,1,1,1,0,0,0,1,1,1,'journals/selfies/xgbxanEfwyGXgGv35x82ksWT9VLxLQLUEXXRQcW1.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 06:23:53','2025-07-14 06:23:53',NULL),
(23,489,1,1,1,0,0,0,1,1,1,'journals/selfies/z6f92TMsFBTxQuEZ3KSEsSASz5nrJZ4vu36JA4Oo.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 07:00:07','2025-07-14 07:00:07',NULL),
(24,526,1,0,0,0,0,1,0,0,1,'journals/selfies/X9FbjOILAhOMOPrwj9vvNq6FjK6qXyZHyPVSqaQ6.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 07:02:02','2025-07-14 07:02:02',NULL),
(25,507,1,1,1,0,0,0,1,1,1,'journals/selfies/o8VhnBdV7rBn8t5mBYOFBhQndtTC0FP3ZMB32zkw.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 07:19:23','2025-07-14 07:19:23',NULL),
(26,475,1,0,1,0,0,0,1,1,1,'journals/selfies/5P4ny4GqLCV9mKO1Qg8gtiQQumsqGC29FXjOy8pj.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 07:22:17','2025-07-14 07:22:17',NULL),
(27,508,1,1,1,0,0,0,1,1,1,'journals/selfies/Nkcf8uCawKNvwkyTwhqrzvkY5ttRz9ZfJQK8XW1j.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 07:24:51','2025-07-14 07:24:51',NULL),
(28,525,1,1,1,1,1,1,1,1,1,'journals/selfies/olkv0AvT7Plvy5LPuInB8OkH1ECZQD0nwDIXo6XM.jpg',NULL,'2025-07-14','draft',NULL,NULL,NULL,'2025-07-14 07:58:33','2025-07-14 07:58:33',NULL),
(29,489,1,1,1,0,0,0,1,1,1,'journals/selfies/Rl51xsWwQIWKDVsyMgsICsIqzB8dOlOgKv0Oz0GX.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 05:28:52','2025-07-15 05:28:52',NULL),
(30,498,1,1,1,0,0,0,1,1,1,'journals/selfies/LCuYCZXfsWOfivMJ1qOwDr6oZjvEeUIqYNnjwfQc.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 05:37:54','2025-07-15 05:37:54',NULL),
(31,524,1,1,1,1,1,1,1,1,1,'journals/selfies/u3EV9sJnCJmc2i70llRRhT2RxZDFgvWWln7URVA5.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 05:49:12','2025-07-15 05:49:12',NULL),
(32,531,1,1,1,0,1,1,1,1,1,'journals/selfies/ohWw8V5lEvo17SiL7f9NTvtlLShRSRCxAhHG6ygt.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 05:49:25','2025-07-15 05:49:25',NULL),
(33,484,1,0,1,0,0,0,1,1,1,'journals/selfies/gHmlayfdrD3g6X1bqdqWYE0h9fw6DNlF1mrEJGgz.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 06:16:15','2025-07-15 06:16:15',NULL),
(34,475,1,1,1,0,0,0,1,0,1,'journals/selfies/n08YejQycxiQccCzg9pCmTYqEmLF8hbxMxly5r9J.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 06:35:43','2025-07-15 06:35:43',NULL),
(35,525,1,1,1,1,1,1,1,1,1,'journals/selfies/aXngZqGZ3pMV0LlVEnbXSHA2nLMWs2EQJh4u31bq.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 06:41:18','2025-07-15 06:41:18',NULL),
(36,526,1,0,0,0,0,0,1,1,1,'journals/selfies/KO1V7kMiwltzkzQeYE7ZsDOdXz7YNmZSe894dVSM.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 07:11:41','2025-07-15 07:11:41',NULL),
(37,508,1,1,1,0,0,0,1,1,1,'journals/selfies/z8cfrg62qQgIQFn7oCDmcy8kQkGIHmcfmGE3dPvk.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 16:03:01','2025-07-15 16:03:01',NULL),
(38,507,1,1,1,0,0,0,1,1,1,'journals/selfies/iaToVXGK9VeHUBqVfU1kiBX1RWBgfDIQHRCNQ8R2.jpg',NULL,'2025-07-15','draft',NULL,NULL,NULL,'2025-07-15 16:26:57','2025-07-15 16:26:57',NULL),
(39,521,1,0,1,0,0,0,1,1,1,'journals/selfies/pCPyyXwgnmIp5mGDQzgzvW7T4k8IjXnkat8OOAQe.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 03:01:36','2025-07-16 03:01:36',NULL),
(41,489,1,1,1,0,0,0,1,1,1,'journals/selfies/k2y59N0Iy4F3yHCHWAJjWrK1CL0nrJ28rRrhdP5t.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 05:00:55','2025-07-16 05:00:55',NULL),
(42,507,1,1,1,0,0,0,1,1,1,'journals/selfies/qnjPb8GilrWNuRBApNlxbdLIuBuUWc6B46A9oe0x.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 05:06:39','2025-07-16 05:06:39',NULL),
(43,508,1,1,1,0,0,0,1,1,1,'journals/selfies/0K4O3yBttNkxGYnZz0ETzUKOhlCOq1u9gy2LKkl1.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 05:09:41','2025-07-16 05:09:41',NULL),
(44,516,1,1,1,1,1,1,1,1,1,'journals/selfies/BgE7hxTBj5z4mfkX4KZBw9Sboli5B2hxfnfHkpMI.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 06:36:27','2025-07-16 06:36:27',NULL),
(45,484,1,0,1,0,0,0,1,1,1,'journals/selfies/ZWbMjd91uhPnURAlr97yMd4tKcFhn0pbJ89UxyUe.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 07:12:09','2025-07-16 07:12:09',NULL),
(50,498,1,1,1,0,0,0,1,1,1,'journals/selfies/Tbh9U82UnObY48zqQeIMIpBTZIPFlEXK6xbYbE8q.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 07:44:40','2025-07-16 07:44:40',NULL),
(51,493,1,1,1,0,0,0,1,1,1,'journals/selfies/pMX3125HXdgJ40ZrHrUEQLGcjvqpVostUlIwLqe6.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 08:07:12','2025-07-16 08:07:12',NULL),
(52,469,1,0,1,0,0,0,1,1,1,'journals/selfies/b02ou9mo4bMYNkQ2ZdIJ4lGriyxkiH9cYJ5o0D1H.jpg',NULL,'2025-07-16','draft',NULL,NULL,NULL,'2025-07-16 09:07:06','2025-07-16 09:07:06',NULL),
(53,508,1,1,1,0,0,0,1,1,1,'journals/selfies/GiMITHPabzZZ24btG97NXySkRWCckbUeknBErxOp.jpg',NULL,'2025-07-17','draft',NULL,NULL,NULL,'2025-07-17 03:53:28','2025-07-17 03:53:28',NULL),
(54,507,1,1,1,0,0,0,1,1,1,'journals/selfies/wuQUDgRP15DciOyKE8Mza7HpNlP1vLxdpMyAvhBz.jpg',NULL,'2025-07-17','draft',NULL,NULL,NULL,'2025-07-17 03:55:49','2025-07-17 03:55:49',NULL),
(55,484,1,0,1,0,0,0,1,1,1,'journals/selfies/ntN2OATfjl18pmnSpcS2ugIe3gZQk72AHPkZOGs6.jpg',NULL,'2025-07-17','draft',NULL,NULL,NULL,'2025-07-17 05:59:14','2025-07-17 05:59:14',NULL),
(56,525,1,1,1,1,1,1,1,1,1,'journals/selfies/JltQdyaJIBvV6ICe6DmyRIiGQ8eNOQ5AsOJCKvcb.jpg',NULL,'2025-07-17','draft',NULL,NULL,NULL,'2025-07-17 06:12:07','2025-07-17 06:12:07',NULL),
(58,489,1,1,1,0,0,0,1,1,1,'journals/selfies/0VZZ0Qrs1MVIyhDYSgPmRs7GyUkYdEOIyhnXevi4.jpg',NULL,'2025-07-17','draft',NULL,NULL,NULL,'2025-07-17 06:30:08','2025-07-17 06:30:08',NULL),
(59,498,1,1,1,0,0,0,1,1,1,'journals/selfies/gfnk0LxaolG5udA5bVtMJ0PoNDF6z8vxgwqKHn3r.jpg',NULL,'2025-07-17','draft',NULL,NULL,NULL,'2025-07-17 07:33:13','2025-07-17 07:33:13',NULL),
(60,526,1,0,0,0,0,0,1,1,1,'journals/selfies/yBuve6L3Znwigeka5n2HnsIidL9fkO2XfMsD1gFU.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 02:51:24','2025-07-18 02:51:24',NULL),
(61,521,1,0,0,0,0,0,1,1,1,'journals/selfies/y7n6wl3XoEJj6YFaE3EigA7c72VHKDTAhMqWhC15.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 04:40:16','2025-07-18 04:40:16',NULL),
(62,507,1,1,1,0,0,0,1,1,1,'journals/selfies/SpK2ZUpcx93TKWp3Ao7i7XU4GkqWYGMPeCUyaSlm.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 06:05:28','2025-07-18 06:05:28',NULL),
(63,508,1,1,1,0,0,0,1,1,1,'journals/selfies/KbzqvUkiJCEh2ckVugb0TKyFG5uZxksmGI8jWlLW.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 06:07:55','2025-07-18 06:07:55',NULL),
(64,484,1,0,1,0,0,0,1,1,1,'journals/selfies/0VN8havOD8LEw0BOYgou1YiWCjk7KmRJgcdPei2y.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 06:41:18','2025-07-18 06:41:18',NULL),
(65,489,1,1,1,0,0,0,1,1,1,'journals/selfies/rgtyWypoBuwZmUw5WVBkFv6IjOHzEI4Y62Fdz35E.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 06:47:25','2025-07-18 06:47:25',NULL),
(66,538,1,0,0,0,0,0,1,1,1,'journals/selfies/WJDNhTwRO88ZMS7lqxlvxhF6dFYZam6DDUwj40LQ.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 07:33:59','2025-07-18 07:33:59',NULL),
(67,498,1,1,1,0,0,0,1,1,1,'journals/selfies/M2ITawKoSn0lP6B0Ug9Wj2nYdK5KwSzf5ePwQseo.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 08:17:04','2025-07-18 08:17:04',NULL),
(68,475,1,1,1,0,0,0,1,1,1,'journals/selfies/kB1pyJCg7J1VX5cQZlRRzKettZ5pICnGSHY42kFF.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 08:35:57','2025-07-18 08:35:57',NULL),
(69,516,1,1,1,0,0,0,1,1,1,'journals/selfies/hXGckXjMlgPV7Uz7cJEf51UT4s7rLATCWnQq3uxF.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 08:50:47','2025-07-18 08:50:47',NULL),
(70,496,1,1,1,0,0,0,1,1,1,'journals/selfies/kN4m2opfRONbA5s1hXUGse5c2mx53oDkXR1f3A9E.jpg',NULL,'2025-07-18','draft',NULL,NULL,NULL,'2025-07-18 09:04:50','2025-07-18 09:04:50',NULL),
(71,484,1,1,1,0,1,0,1,1,1,'journals/selfies/tI21haOlsriHd7KDDiHrTfC31PaCbtPd92XRfPZU.jpg',NULL,'2025-07-19','draft',NULL,NULL,NULL,'2025-07-19 06:21:34','2025-07-19 06:21:34',NULL),
(72,525,1,1,1,1,1,1,1,1,1,'journals/selfies/7JtbFIdmpkHUrLWclzjgv02MYStjRpPGDF3yuNYB.jpg',NULL,'2025-07-19','draft',NULL,NULL,NULL,'2025-07-19 07:05:28','2025-07-19 07:05:28',NULL),
(73,498,1,1,1,0,1,0,1,1,1,'journals/selfies/WAedOVpUvT16aSKTIY8ZbxQpt76g6pXXz9dGBucU.jpg',NULL,'2025-07-19','draft',NULL,NULL,NULL,'2025-07-19 07:30:14','2025-07-19 07:30:14',NULL),
(74,543,1,0,0,0,1,0,1,1,1,'journals/selfies/Xrrjcfjktq7cq5dK7vXYxD81hAqtRyYS6d0HC5uA.jpg',NULL,'2025-07-19','draft',NULL,NULL,NULL,'2025-07-19 08:22:14','2025-07-19 08:22:14',NULL),
(75,526,1,0,0,0,1,0,1,1,1,'journals/selfies/2ZIX1mzenCMGEetwa9o5wmIT59chGlJpuo2K90Sr.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-19 17:41:53','2025-07-19 17:41:53',NULL),
(76,489,1,1,1,0,0,1,1,1,1,'journals/selfies/FUulmLgrw93LYf3kbYlo6J8Up6qA5yJDa4DmLRK9.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-19 23:42:18','2025-07-19 23:42:18',NULL),
(77,508,1,1,1,0,1,0,1,1,1,'journals/selfies/sn2YulBVPTypMaUboI5RraJ5WJlN6AKK0sVXgjuA.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 01:54:42','2025-07-20 01:54:42',NULL),
(78,507,1,1,1,0,0,1,1,1,1,'journals/selfies/0g6BS8HiZeTyBtBbmgChJcFFzKPjDC7PFJhdzdhy.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 01:57:47','2025-07-20 01:57:47',NULL),
(79,533,1,1,0,0,1,1,1,1,1,'journals/selfies/HjipvcGtP5OzXl7VkDW37CGFlMUrSRx4IVeBp6E2.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 03:12:05','2025-07-20 03:12:05',NULL),
(80,484,1,1,1,0,0,1,1,1,1,'journals/selfies/CfvwM0KJUBDw2flQQOu5dGVUxmT1fL9eF1h9uw6f.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 05:56:00','2025-07-20 05:56:00',NULL),
(81,475,1,1,1,0,0,1,1,1,1,'journals/selfies/2PLwka4xrxrHYvgZVqTcDOx7TnnM7q0IARaVYHyr.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 06:40:44','2025-07-20 06:40:44',NULL),
(82,496,1,1,1,0,1,0,1,1,1,'journals/selfies/SrvEcP9AsjpGozF42CJcaNwnhfFyjtodAELRP4p5.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 06:59:43','2025-07-20 06:59:43',NULL),
(83,498,1,1,1,0,0,1,1,1,1,'journals/selfies/VIoDcoHIj2oqfpwhIhGCYgIUYvkUdUP6ogp244hf.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 07:50:14','2025-07-20 07:50:14',NULL),
(84,543,1,1,0,0,0,1,1,1,1,'journals/selfies/Gr9laczpRHAA8SFjbLKiZKVC5h9337ghT5pQYqbC.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 07:58:39','2025-07-20 07:58:39',NULL),
(85,538,1,0,1,0,1,1,1,1,1,'journals/selfies/XKrY52B2bwFRY4WUsANPoEjpDh0tFU9OE8DPKCTg.jpg',NULL,'2025-07-20','draft',NULL,NULL,NULL,'2025-07-20 09:04:32','2025-07-20 09:04:32',NULL),
(86,508,1,1,1,0,0,0,1,1,1,'journals/selfies/uxJMl67fiq1ZjHXxdvuslhqOhf9CTyN4XEY7B54a.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 05:50:39','2025-07-21 05:50:39',NULL),
(87,507,1,1,1,0,0,0,1,1,1,'journals/selfies/S4q3K6uftAjd3wXYVnSvHFjP6fcMsnfsvTH0esgg.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 05:52:24','2025-07-21 05:52:24',NULL),
(88,526,1,0,0,0,0,1,1,1,1,'journals/selfies/RkRhUoOCl2kNbbC8wQb2NAkGehDbYjjikeclw7R6.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 06:08:36','2025-07-21 06:08:36',NULL),
(89,481,1,0,0,0,0,0,1,1,1,'journals/selfies/8xj95qycOblQFrCy2OryRPjZoEzE2kyPtfOFCpFP.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 06:11:18','2025-07-21 06:11:18',NULL),
(90,498,1,1,1,0,0,0,1,1,1,'journals/selfies/vDwICb3Bo1YzxjGF4HT84RnTp8WbNfWSq0hKfWwf.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 06:23:37','2025-07-21 06:23:37',NULL),
(91,489,1,1,1,0,0,0,1,1,1,'journals/selfies/WcgLxGiBhKuHEYL1lLgLihcQ7ceT4QmHm9c5idKk.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 06:27:06','2025-07-21 06:27:06',NULL),
(92,484,1,1,1,0,0,0,1,1,1,'journals/selfies/HrIOjHozigwocu5OOw10UH5zOOhpsNnyzI31mWoH.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 06:46:46','2025-07-21 06:46:46',NULL),
(93,494,1,0,1,0,0,0,1,1,1,'journals/selfies/DhxhFlPt8KNSNGNdW6QkWlmdYQEHcAkwz5PPkb27.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 07:04:35','2025-07-21 07:04:35',NULL),
(94,475,1,1,1,0,0,0,1,1,1,'journals/selfies/SBn1RPNLCiIRxvnU2eZr40lVCYkI7MDQiLYyhX5T.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 08:13:48','2025-07-21 08:13:48',NULL),
(95,543,1,0,1,0,0,0,1,1,1,'journals/selfies/vjz0eBEWqMXjyVsJq7oLiaMssK93obxhesaHXSXL.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 08:24:33','2025-07-21 08:24:33',NULL),
(96,476,1,1,1,0,0,0,1,1,1,'journals/selfies/meED1ZXxp6k71GY4N8hgjU3J9hFdbkUZMcYAXhtF.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 08:28:22','2025-07-21 08:28:22',NULL),
(97,496,1,1,1,0,0,1,1,1,1,'journals/selfies/cmciHzdyDuiDxSgVdqSTcrR1ttqOu68Ef4DqdLEW.jpg',NULL,'2025-07-21','draft',NULL,NULL,NULL,'2025-07-21 08:58:34','2025-07-21 08:58:34',NULL),
(98,484,1,0,1,0,0,0,1,1,1,'journals/selfies/59MNoeA3YP4UizQV00GwpQtDVLcgUWKnRKe7hmXB.jpg',NULL,'2025-07-22','draft',NULL,NULL,NULL,'2025-07-22 06:34:44','2025-07-22 06:34:44',NULL),
(99,554,1,1,1,1,1,1,1,1,1,'journals/selfies/S6nqrpzkbDZJJq0Gr0YFe4QvLCYVQpe9N09Q7PlP.jpg',NULL,'2025-07-22','draft',NULL,NULL,NULL,'2025-07-22 07:04:32','2025-07-22 07:04:32',NULL),
(100,494,1,0,1,0,0,0,1,1,1,'journals/selfies/MMgQfWNh5gYw3KvAODD0sSTftRXtZfWFSwltqfFW.jpg',NULL,'2025-07-22','draft',NULL,NULL,NULL,'2025-07-22 07:33:22','2025-07-22 07:33:22',NULL),
(101,498,1,1,1,0,0,0,1,1,1,'journals/selfies/2i77bBiehyQA7tWTND0z2YarXbHlbBwpYo1ETmhw.jpg',NULL,'2025-07-22','draft',NULL,NULL,NULL,'2025-07-22 07:46:37','2025-07-22 07:46:37',NULL),
(102,496,1,1,1,0,0,0,1,1,1,'journals/selfies/8cjok5syxECPZdfpUtwXMe19unEeQRoVasSKlGMZ.jpg',NULL,'2025-07-22','draft',NULL,NULL,NULL,'2025-07-22 08:20:25','2025-07-22 08:20:25',NULL),
(103,476,1,1,1,0,0,0,1,1,1,'journals/selfies/bqDrDA0ayHPlLvKRkPtBcLgTtmkyvIbgvW5paBzD.jpg',NULL,'2025-07-22','draft',NULL,NULL,NULL,'2025-07-22 08:34:59','2025-07-22 08:34:59',NULL),
(104,508,1,1,1,0,0,0,1,1,1,'journals/selfies/n5Nx32wM1NRVYaJpdvots0Y7JcdUDhSgtcCPVM8X.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 02:00:02','2025-07-23 02:00:02',NULL),
(106,507,1,1,1,0,0,0,1,1,1,'journals/selfies/bHCEz1Ez8SqK66QSF4PSXlVkY1aHFSPs3PYIACtT.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 02:02:28','2025-07-23 02:02:28',NULL),
(107,538,1,0,1,0,0,0,1,1,1,'journals/selfies/V2tb8pXPmLgaWcsSlzc2ZH1AxHDHAjCq7a2pjUEv.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 05:33:53','2025-07-23 05:33:53',NULL),
(108,484,1,0,1,0,0,0,1,1,1,'journals/selfies/Ylq3GBuWB108GoeeT24jEydi0FPT1XQ4Qn48JlQP.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 06:27:21','2025-07-23 06:27:21',NULL),
(109,481,1,0,1,0,0,0,1,1,1,'journals/selfies/wsIvR6Dk2PxnsFMm5f4rtZRwxf5so1wDe80vVi71.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 06:37:07','2025-07-23 06:37:07',NULL),
(110,554,1,1,1,1,1,1,1,1,1,'journals/selfies/tnvrgxbTl0Kwkd6FmCamPEPSoJB1eFHVsaqns5HP.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 06:42:53','2025-07-23 06:42:53',NULL),
(111,498,1,1,1,0,0,0,1,1,1,'journals/selfies/M6BtKucngzyjs0AXMMcleBOuvGgTcJjKjjh4qIIy.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 06:44:24','2025-07-23 06:44:24',NULL),
(112,525,1,1,1,1,1,1,1,1,1,'journals/selfies/Y99KtWQLxAa0TFLABvqO7fONHb7jIVlyF70R8tOl.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 07:40:56','2025-07-23 07:40:56',NULL),
(113,494,1,0,1,0,0,0,1,1,1,'journals/selfies/ihYeBYLgWUoVIa91MJJs61l9A3Iq0g3QmduIaaFW.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 07:44:06','2025-07-23 07:44:06',NULL),
(114,543,1,0,1,0,0,0,1,1,1,'journals/selfies/Ir3Pt6XIAplxxZKLCCXushBDWhA3dIiMtWWQjR0X.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 07:53:25','2025-07-23 07:53:25',NULL),
(115,496,1,1,0,0,0,0,1,1,1,'journals/selfies/eHHCu2gstgMYYu6PSitaveDkjZlSDn8XVRSeZ7sf.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 08:01:48','2025-07-23 08:01:48',NULL),
(116,523,1,0,0,0,0,0,1,1,1,'journals/selfies/WHPYjJaDg7XxfRYjn2HNnDzdOuuRswWWhmibCUcb.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 08:08:52','2025-07-23 08:08:52',NULL),
(117,475,1,1,1,0,0,0,1,1,1,'journals/selfies/qn8VAxzJm3z9W8IZEkt62FnIiSxrdZjFWyF4fkHd.jpg',NULL,'2025-07-23','draft',NULL,NULL,NULL,'2025-07-23 08:22:48','2025-07-23 08:22:48',NULL),
(118,525,1,1,1,1,1,1,1,1,1,'journals/selfies/ahOwLCxzCqgbHkUcALnqgkVDakAqsOYbCm3H6Sk2.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 05:36:06','2025-07-24 05:36:06',NULL),
(119,484,1,0,1,0,0,0,1,1,1,'journals/selfies/knqtMQpXxmzYoqu4XzeQhLuXwevSPBK8S1V4mgF6.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 05:36:36','2025-07-24 05:36:36',NULL),
(120,475,1,1,1,0,0,0,1,1,1,'journals/selfies/9egNUaMXKkc6DsRkT6oyx4IrbgEUduabq95KFaeU.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 05:37:27','2025-07-24 05:37:27',NULL),
(121,496,1,1,0,0,0,0,1,1,1,'journals/selfies/HBMhui3soZDONL0ula6xfzjoeDLpC2wHv1KVtwd3.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 05:44:46','2025-07-24 05:44:46',NULL),
(122,498,1,1,1,0,0,0,1,1,1,'journals/selfies/eqzgwllw3nuM2OKF9od4lsBF4E4L4TNSozaqMZJ8.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 07:02:51','2025-07-24 07:02:51',NULL),
(123,543,1,0,1,0,0,0,1,1,1,'journals/selfies/Xpd8Kqh2Nr5vNnHHWchTGL62PYj3mhmr48NIr6jA.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 07:17:20','2025-07-24 07:17:20',NULL),
(124,494,1,0,1,0,0,0,1,1,1,'journals/selfies/ORrq6dVbEYDw8fRhWhftcfUiqIo1izEup5b3oQ0Z.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 07:31:38','2025-07-24 07:31:38',NULL),
(125,481,1,0,0,0,0,0,0,1,1,'journals/selfies/rFn9xnBa2qSkgj4VNCt44ktiET1UzlM20AvWvxXc.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 07:47:51','2025-07-24 07:47:51',NULL),
(126,554,1,1,1,1,1,1,1,1,1,'journals/selfies/5LiTxw6ZezSdBdXsILzVTW0EptaOPP0v42qFs1Oo.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 07:52:10','2025-07-24 07:52:10',NULL),
(127,476,1,1,1,0,0,0,1,1,1,'journals/selfies/2ADWZEown2NBnx6nfyEHLW8r3hPBZLPWY1ZrPk2R.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 08:20:32','2025-07-24 08:20:32',NULL),
(128,508,1,1,1,0,0,0,1,1,1,'journals/selfies/wj1Uq87pbRViHhpNRuZXWt90glhKc64mKiT4oCsA.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 08:30:13','2025-07-24 08:30:13',NULL),
(129,507,1,1,1,0,0,0,1,1,1,'journals/selfies/L9ZJrvWHZMzWTYQY9b9K7ckedAUUOY3TSYmTGH5t.jpg',NULL,'2025-07-24','draft',NULL,NULL,NULL,'2025-07-24 08:44:46','2025-07-24 08:44:46',NULL),
(130,489,1,1,1,0,0,0,1,1,1,'journals/selfies/7dqAyRrq0jDUgMquWQdBLSNSKyy5WaR7ee85PHdW.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 00:29:46','2025-07-25 00:29:46',NULL),
(131,554,1,1,1,1,1,1,1,1,1,'journals/selfies/Xj04bJ7AcCeuVucEapovnWalfWIbTqo25AdD0W2y.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 05:06:05','2025-07-25 05:06:05',NULL),
(132,525,1,1,1,1,1,1,1,1,1,'journals/selfies/aXj9UjOAL0WC4YWwkE6D5xX3ezguhOJHN4pEzYY8.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 05:15:54','2025-07-25 05:15:54',NULL),
(133,484,1,0,1,0,0,0,1,1,1,'journals/selfies/gtK43eszBbcQNpmQLOHb4X8q0t6dK7hZLnMEZ50B.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 05:24:48','2025-07-25 05:24:48',NULL),
(134,475,1,1,1,0,0,0,1,1,1,'journals/selfies/AFy4feXxbAOYqgjizhN1zo3e5aPJwUq4vk4o2Q5w.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 06:41:47','2025-07-25 06:41:47',NULL),
(135,498,1,1,1,0,0,0,1,1,1,'journals/selfies/W6YUCUv1yJ7lrDYVaaAYoxyTY8Xolz2TIn2Ka8Wh.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 06:42:43','2025-07-25 06:42:43',NULL),
(136,494,1,0,1,0,0,0,1,1,1,'journals/selfies/VQAtcAIwMX2gxLo1x9XmyshzThOVaeSYY6lqlOw7.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 06:58:46','2025-07-25 06:58:46',NULL),
(137,526,1,0,0,0,0,0,1,1,1,'journals/selfies/rNh21au1mwrsL4yBz2n7t2OEqTmnX7G0RlOci7BS.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 07:57:05','2025-07-25 07:57:05',NULL),
(138,543,1,0,0,0,0,0,1,1,1,'journals/selfies/j7xAZTWmA0pJX9VIRdBKANR4XIAM9CKFSoh1fEOj.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 08:19:31','2025-07-25 08:19:31',NULL),
(139,476,1,1,1,0,0,0,1,1,1,'journals/selfies/fWqYG4GCp4GlcjSpLEKdMKZ9dE1XRautvahRJEPR.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 08:20:58','2025-07-25 08:20:58',NULL),
(140,481,1,0,0,0,0,0,0,1,1,'journals/selfies/LVm4ti42OnL2nIvC9A9uXoB9AdUAKkbvVJYOH9ht.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 08:29:52','2025-07-25 08:29:52',NULL),
(141,496,1,1,1,0,0,0,1,1,1,'journals/selfies/XjjN6d8AsW35qK6lxbGGoDxVmukmf81xlVVufJQ5.jpg',NULL,'2025-07-25','draft',NULL,NULL,NULL,'2025-07-25 08:32:58','2025-07-25 08:32:58',NULL),
(142,507,1,1,1,0,1,0,1,1,1,'journals/selfies/DpUXA4KMBCdHGSjQKqd6xfZvaENZMQT9AWVInVBf.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-25 21:10:55','2025-07-25 21:10:55',NULL),
(143,508,1,1,1,1,1,0,1,1,1,'journals/selfies/yM2EZU4dLnt5KVUKYeIBxg2ezQtwdv9rdki5LSKA.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-25 21:12:34','2025-07-25 21:12:34',NULL),
(144,489,1,1,1,0,0,0,1,1,1,'journals/selfies/D9CqNit5mcCTr0GneNH3VkYdFWcXCTGAbNNm5BVr.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 04:07:14','2025-07-26 04:07:14',NULL),
(145,568,1,1,1,1,1,0,1,1,1,'journals/selfies/1y7Tku1M6kztA8ecmcqD7w7h7hH7SvWnIBBMXGAc.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 05:00:37','2025-07-26 05:00:37',NULL),
(146,498,1,1,1,0,1,0,1,1,1,'journals/selfies/JkuLZChD3pxVfsEbMCPfpzW3NG6LGlvTLkSKga29.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 05:41:42','2025-07-26 05:41:42',NULL),
(147,514,1,1,0,1,1,0,1,1,1,'journals/selfies/kDdxF0WlYcefwDLF5XRcEkXkd4jHufee9e7QGAOn.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 06:06:04','2025-07-26 06:06:04',NULL),
(148,554,1,1,1,1,1,1,1,1,1,'journals/selfies/jevbzvCl0UmLEf2R8yy7Kfqox9bzu7MhzHc4GrYj.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 06:07:56','2025-07-26 06:07:56',NULL),
(149,484,1,1,1,0,1,0,1,1,1,'journals/selfies/M3HghymNvQOnZopy1VSlj65m7GqExyqN9Tiqilas.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 06:22:37','2025-07-26 06:22:37',NULL),
(150,475,1,1,1,1,1,0,1,1,1,'journals/selfies/syCdCiTmmuqWT9aUpWgVnKX1k5fzSxWjCZXKjrNw.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 07:00:59','2025-07-26 07:00:59',NULL),
(151,493,1,1,1,0,1,0,1,1,1,'journals/selfies/fdBQ1RW6pFQ2VYjLx4AlEZ1AQXFrBuOT099vaaVq.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 07:12:58','2025-07-26 07:12:58',NULL),
(152,496,1,1,1,0,1,0,1,1,1,'journals/selfies/brBFAopSmd8mr3BYEqWhRMPomE5fclqgJRzlB6fO.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 07:13:52','2025-07-26 07:13:52',NULL),
(153,557,1,0,0,1,1,1,1,1,1,'journals/selfies/uTm096tE14n5YRR7bIet4PiCsXdn6U9iqsQGczTR.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 07:20:41','2025-07-26 07:20:41',NULL),
(154,543,1,0,1,1,1,0,1,1,1,'journals/selfies/L17FfAcTiOsTyWJTqZDLTtoADoZfzSIfQuEgdeYv.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 07:41:47','2025-07-26 07:41:47',NULL),
(155,481,1,0,1,0,1,0,1,1,1,'journals/selfies/CDDgz74pGaZx6g7VoaGrjkyYIIqDcJ4Ws8U2yWse.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 07:53:10','2025-07-26 07:53:10',NULL),
(156,494,1,0,1,0,1,0,1,1,1,'journals/selfies/YqsJACszoJmd5RUlz8w2wWPL9Y8yWvcrFPXFNROg.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 08:34:49','2025-07-26 08:34:49',NULL),
(158,503,1,1,0,1,1,0,1,1,1,'journals/selfies/xluEp7IMMGTh9kYDlLj0Up28kNEamVVV9VpoTpX4.jpg',NULL,'2025-07-26','draft',NULL,NULL,NULL,'2025-07-26 08:37:01','2025-07-26 08:37:01',NULL),
(159,508,1,1,1,0,0,1,1,1,1,'journals/selfies/iVt26t0iEMXo5apGpX2npeKUTU6E1SEI4Zhuu4Va.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-26 19:34:23','2025-07-26 19:34:23',NULL),
(160,507,1,1,1,0,0,1,1,1,1,'journals/selfies/PnUJZX6ZeEGVNPQmJHrzfpxy1A3ObMnP0LabBbwn.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-26 19:35:36','2025-07-26 19:35:36',NULL),
(161,567,1,0,0,1,1,1,1,1,1,'journals/selfies/YNiju1s2uta47KcE3klha64Z5TdS2joZaZaiterD.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-26 21:33:00','2025-07-26 21:33:00',NULL),
(162,538,1,0,1,1,1,1,1,1,1,'journals/selfies/JVcNwil33JYjw0CkTQuIX0TetinvTmJD0qCNrTHK.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 04:15:37','2025-07-27 04:15:37',NULL),
(163,496,1,1,1,1,0,1,1,1,1,'journals/selfies/Y7nJlFWVEp9KCLXbk1RVKSE2LfpCMXYKchHxyUVG.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 04:18:25','2025-07-27 04:18:25',NULL),
(164,554,1,1,1,1,1,1,1,1,1,'journals/selfies/o38rHl3kTuRTCPLpjnRaP9N9S4ycYuccb0zVzapb.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 04:47:40','2025-07-27 04:47:40',NULL),
(165,484,1,1,1,1,0,1,1,1,1,'journals/selfies/MgYEvgcNnLLkTNSpDb5bBzFMbF73If7GbUqe7JZi.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 05:47:03','2025-07-27 05:47:03',NULL),
(166,543,1,0,1,0,0,1,1,1,1,'journals/selfies/DI1vplu1rSXmjaNn9p8yd0BWk39CKb1G6znyesgt.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 06:25:39','2025-07-27 06:25:39',NULL),
(167,489,1,1,1,0,0,1,1,1,1,'journals/selfies/C2UG4i3RVxWH3qLow83s77EkGl9k4AhQioG89rqX.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 06:54:46','2025-07-27 06:54:46',NULL),
(168,557,1,1,0,1,1,1,1,1,1,'journals/selfies/hVhONGkttdtRBGaFPgwLjM04ghPzFtu17ZNjsRPf.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 07:03:02','2025-07-27 07:03:02',NULL),
(169,476,1,1,1,0,0,1,1,1,1,'journals/selfies/5njFVcsCjAeoOLW7nA3PSKCjvP0k24rOTpuvgGFg.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 07:29:42','2025-07-27 07:29:42',NULL),
(170,494,1,0,1,1,0,1,1,1,1,'journals/selfies/i11YNdou9ep6UdSivDU1c8TlY6JMvl47bwgSEfJM.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 07:43:26','2025-07-27 07:43:26',NULL),
(171,503,1,1,0,1,1,0,1,1,1,'journals/selfies/VRZkIK6mkj8Bve8POthjN6qqeKuZk1jz2AbogXjq.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 08:12:51','2025-07-27 08:12:51',NULL),
(172,525,1,1,1,1,1,1,1,1,1,'journals/selfies/LlOLqCwHLJus4UtUzqiUrU3PyBvhJpYF5OrwyiUb.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 08:15:27','2025-07-27 08:15:27',NULL),
(173,481,1,0,0,1,0,1,0,1,1,'journals/selfies/FqZRKbGq9EFd8xfQ1ud1adCj9kMgV9JhxtPRz7nx.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 08:15:39','2025-07-27 08:15:39',NULL),
(174,526,1,0,0,1,0,1,1,1,1,'journals/selfies/ycV2k6XhnYRM2XdSAw3As02zyPdCsI22f50cl8HP.jpg',NULL,'2025-07-27','draft',NULL,NULL,NULL,'2025-07-27 08:30:00','2025-07-27 08:30:00',NULL),
(176,567,1,0,0,0,0,0,1,1,1,'journals/selfies/qgXFuzDmDWuWguosf8K46A0cK9KSfFjjfpdLAbP1.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 01:34:52','2025-07-28 01:34:52',NULL),
(177,554,1,1,1,1,1,1,1,1,1,'journals/selfies/BLAdmtZrPR00MWjj9wvzD60ewT34wmjD3KqRzo6n.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 05:54:00','2025-07-28 05:54:00',NULL),
(178,484,1,0,1,0,0,0,1,1,1,'journals/selfies/qy3yc0ZqkXXcEopwTIuRSUBlYy6XY3slc7Ibbhkz.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 06:30:35','2025-07-28 06:30:35',NULL),
(179,496,1,1,1,0,0,0,1,1,1,'journals/selfies/xw9dIN7TUDj3xzGPwWB4TVZB7h45HRopWjB2GFul.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 06:44:16','2025-07-28 06:44:16',NULL),
(180,481,1,0,0,0,0,0,1,1,1,'journals/selfies/mhBak9svhAZkT2smVYbDIMaylxhOQ374tBEEPQI8.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 06:48:37','2025-07-28 06:48:37',NULL),
(181,489,1,1,1,0,0,0,1,1,1,'journals/selfies/obr6mfL6ajcMw7yxVdTewcYjgSDnUrUkiH5qi81X.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 06:49:48','2025-07-28 06:49:48',NULL),
(182,525,1,1,1,1,1,1,1,1,1,'journals/selfies/CRh5PjRuyhv7aObFj2uXfVlYsDNnjIPm4KWjbpFa.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 06:53:55','2025-07-28 06:53:55',NULL),
(183,526,1,0,0,0,0,0,1,1,1,'journals/selfies/EkcVOr3g5oi51GUl4xe0fbiUpsk6Mz88bKM3p7ed.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 07:38:10','2025-07-28 07:38:10',NULL),
(184,494,1,0,1,0,0,0,1,1,1,'journals/selfies/BdRkQIVTFCrRCmgeBjtOJ9fHoHtM9jVGxQMG6QzM.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 07:50:14','2025-07-28 07:50:14',NULL),
(185,507,1,1,1,0,0,0,1,1,1,'journals/selfies/tvBgV68SeLQbnZsOBCVJYv4SAkxbxzI9cM6vUoVW.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 07:50:51','2025-07-28 07:50:51',NULL),
(186,508,1,1,1,0,0,0,1,1,1,'journals/selfies/l4ZMdxRtzMlWzZWprJRgLsiqjMDs4YOD7PCcmVri.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 07:52:15','2025-07-28 07:52:15',NULL),
(187,498,1,1,1,0,0,0,1,1,1,'journals/selfies/R8RGRYQmhQIP0zMyoDpO36jkdtnuOS6OHM7Yvoi2.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 08:04:58','2025-07-28 08:04:58',NULL),
(188,557,1,0,0,0,0,0,1,1,1,'journals/selfies/SlPEhZlqbheEWsV761dlTPE6T4snZljUQo4eUvFn.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 08:22:01','2025-07-28 08:22:01',NULL),
(189,543,1,0,1,0,0,0,1,1,1,'journals/selfies/40qD0VCANlH8NwWqW6moIq6SZUaq6cWMBwvuQ95g.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 08:22:44','2025-07-28 08:22:44',NULL),
(190,538,1,0,0,0,0,0,1,1,1,'journals/selfies/jgDeBzDvnzs3CQhTykkjYaUz4DYSHqxrJY7NPTR9.jpg',NULL,'2025-07-28','draft',NULL,NULL,NULL,'2025-07-28 08:34:59','2025-07-28 08:34:59',NULL),
(191,470,1,1,1,1,1,1,1,1,1,'journals/selfies/c4YTLjplJRliT6N1IOhfLcFuNM7YEFjC8m4kGggS.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-28 21:18:19','2025-07-28 21:18:19',NULL),
(192,554,1,1,1,1,1,1,1,1,1,'journals/selfies/dbh9tot4Cag14YbW5138EXqbVuJCAkbQZKJ0GKU4.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 04:48:16','2025-07-29 04:48:16',NULL),
(193,568,1,1,1,0,0,0,1,1,1,'journals/selfies/Faee34bj8RajawHgemn6mC1RoBpxanhrFsF2fFHr.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 04:50:59','2025-07-29 04:50:59',NULL),
(194,567,1,0,1,0,0,0,1,1,1,'journals/selfies/co1ypUKIHi9yJ4GXoo0QolHNNHblcDsvmgFpoXh4.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 05:13:24','2025-07-29 05:13:24',NULL),
(195,473,1,1,1,0,0,0,0,1,1,'journals/selfies/dFeUjhozA568lWfcqIWaOqE1OYDtZMDRDIFZpadi.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 07:07:02','2025-07-29 07:07:02',NULL),
(196,498,1,1,1,0,0,0,1,1,1,'journals/selfies/fMEnapyTEs1UivI5qZY9wGeDXUf5s6HKXiwWh0vt.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 07:13:40','2025-07-29 07:13:40',NULL),
(197,543,1,0,1,0,0,0,1,1,1,'journals/selfies/rFdXydreW1f6w3k7tbpLGiNDTNTMBbN8ini27XZG.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 07:27:37','2025-07-29 07:27:37',NULL),
(198,489,1,1,1,0,0,0,1,1,1,'journals/selfies/2fHSwETaQtcThwMbly5fjO2TyCIgJqBAazGwBxmN.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 07:35:36','2025-07-29 07:35:36',NULL),
(199,476,1,1,1,0,0,0,1,1,1,'journals/selfies/gqB7srkZgrVBh8qjLo63skTkHNGpRJj2wMrRFzB9.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 08:03:32','2025-07-29 08:03:32',NULL),
(200,525,1,1,1,1,1,1,1,1,1,'journals/selfies/HHWQ2SOabnhvKFM7ya5Bs7A3KDJWNY89qBYSe0GB.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 08:07:57','2025-07-29 08:07:57',NULL),
(201,494,1,0,1,0,0,0,1,1,1,'journals/selfies/vqwnUWz0lop3Ku1HaIC1GOIjYUxJHiFyxJSd2JOv.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 08:12:09','2025-07-29 08:12:09',NULL),
(202,496,1,1,1,0,0,0,1,1,1,'journals/selfies/TY4atv4uRIhAcDLRNEcG87tB8MU3Iicu7jUGCoCI.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 08:43:58','2025-07-29 08:43:58',NULL),
(203,481,1,0,0,0,0,0,1,1,1,'journals/selfies/U9k26nxUKTo4nLdeEBLa3d3bT41kluhqDR90DLYU.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 08:59:59','2025-07-29 08:59:59',NULL),
(204,557,1,0,0,1,1,1,1,1,1,'journals/selfies/FQo8rBmUPjXEcn4mlLWEbrpeFztDcrUEmWl4uhn5.jpg',NULL,'2025-07-29','draft',NULL,NULL,NULL,'2025-07-29 16:00:36','2025-07-29 16:00:36',NULL),
(205,567,1,0,1,0,0,0,1,1,1,'journals/selfies/rpggdD97Xek21EAI9BEz6gkSXBe3kno6ZJ1P5jXm.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 03:33:44','2025-07-30 03:33:44',NULL),
(206,496,1,1,1,0,0,0,1,1,1,'journals/selfies/GOpBs0FXfQEEtYktVG6UeuzjqtZiWHrCHO6PJCPn.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 04:59:26','2025-07-30 04:59:26',NULL),
(207,484,1,0,1,0,0,0,1,1,1,'journals/selfies/gYciah3kKbelefj05LYcmJNMDUBfKfUbF5ehqB7n.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 06:07:34','2025-07-30 06:07:34',NULL),
(208,554,1,1,1,1,1,1,1,1,1,'journals/selfies/AKiAZunVVT8lz129F27iJPU16H0ST6apsqYNW7bV.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 06:13:46','2025-07-30 06:13:46',NULL),
(210,507,1,1,1,0,0,0,1,1,1,'journals/selfies/isgqGEBWtrc53Wn7CvRoZg1V1Y4wjB4nvBhpQTEp.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 06:18:05','2025-07-30 06:18:05',NULL),
(211,508,1,1,1,0,0,0,1,1,1,'journals/selfies/LFsoAX7NAbzbeV9UQElrr1xmzD1FxXmhAyd5ERRl.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 06:31:14','2025-07-30 06:31:14',NULL),
(212,489,1,1,1,0,0,0,1,1,1,'journals/selfies/xzAnj8IVZtyF4upZY5LL6G3oDmK1rcFRBG0cZwxG.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 07:24:25','2025-07-30 07:24:25',NULL),
(213,526,0,0,0,0,0,0,1,1,1,'journals/selfies/bpgEpx8PjF7gIhInzBo71G0H2EDSi6ZWWIfAiYgy.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 07:46:59','2025-07-30 07:46:59',NULL),
(214,494,1,0,1,0,0,0,1,1,1,'journals/selfies/O070RDU9RBpTFGXpCCgYyWW3RNVnIEt4tqUxPGUf.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 08:13:31','2025-07-30 08:13:31',NULL),
(215,525,1,1,1,1,1,1,1,1,1,'journals/selfies/lAWeigwT2lLr2yzoWm0fKCf3melBdIjZAyfnyCtL.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 08:15:17','2025-07-30 08:15:17',NULL),
(216,498,1,1,1,0,0,0,1,1,1,'journals/selfies/clNQz4kf7VF800FbVEQCfVDz3uDLUopqFUYp2Jnf.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 08:20:42','2025-07-30 08:20:42',NULL),
(217,543,1,1,1,0,0,0,1,1,1,'journals/selfies/sqGByJ8XzhHgCaA8Wg6yd0HfjNpFohUFw0qda45M.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 08:25:45','2025-07-30 08:25:45',NULL),
(218,476,1,1,1,0,0,0,1,1,1,'journals/selfies/YyvN9l1bQqrGQ1OOF1W28ul4aB8gphQq1FvB3uAY.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 08:28:08','2025-07-30 08:28:08',NULL),
(219,475,1,1,1,0,0,0,1,1,1,'journals/selfies/6eIi6zyNhcx9y8FR5gzuLdFOr5XYoflQXyhkqzl1.jpg',NULL,'2025-07-30','draft',NULL,NULL,NULL,'2025-07-30 15:57:56','2025-07-30 15:57:56',NULL),
(220,554,1,1,1,1,1,1,1,1,1,'journals/selfies/RsRYzDslfGEHxAooGAeER1s2lzfBvPKpk3qBFNoU.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 04:45:13','2025-07-31 04:45:13',NULL),
(221,508,1,1,1,0,0,0,1,1,1,'journals/selfies/tmKOrfzRyLpja5M5ILbh6bWHfpBF6MxWbQXscE7q.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 05:10:44','2025-07-31 05:10:44',NULL),
(222,568,1,1,1,0,0,0,1,1,1,'journals/selfies/Hx1Ib0ZlGLGrfqlrB954bSzh3c9HD4gVN55z6Qri.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 05:28:17','2025-07-31 05:28:17',NULL),
(223,507,1,1,1,0,0,0,1,1,1,'journals/selfies/gIdX2bm4nYXrSpRov5xBQIQZ3G5GqIFxzXYdZyKK.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 06:05:00','2025-07-31 06:05:00',NULL),
(224,484,1,0,1,0,0,0,1,1,1,'journals/selfies/CVorbrhNFWTSB6HjTAtEfDpVYiyaVg2tOP8CxW1q.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 06:54:06','2025-07-31 06:54:06',NULL),
(225,567,1,0,0,0,0,0,1,1,1,'journals/selfies/n6ASNroeY61cSwDbsV333R0LUqROg4u7I8TZjuGm.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 07:23:57','2025-07-31 07:23:57',NULL),
(226,489,1,1,1,0,0,0,1,1,1,'journals/selfies/0fcHzE3BrjvKdH0mXfhXSKCqiwqYQtijCDpRjxE5.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 07:40:05','2025-07-31 07:40:05',NULL),
(227,543,1,0,1,0,0,0,1,1,1,'journals/selfies/7E3BbR7LfWC0tnjl2E1nnnAFnWqvUBqESJL6KEAw.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 07:47:09','2025-07-31 07:47:09',NULL),
(228,494,1,0,1,0,0,0,1,1,1,'journals/selfies/ulYw3qzBjhz0293TNnlf0nmGVw9buSZip9vJAnss.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 07:49:05','2025-07-31 07:49:05',NULL),
(229,476,1,1,1,0,0,0,1,1,1,'journals/selfies/xy89NmJhSRpa4Wwx2HxzG6pNrQpkaMr1aZgAbJQO.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 07:59:21','2025-07-31 07:59:21',NULL),
(230,525,1,1,1,1,1,1,1,1,1,'journals/selfies/WGz9SstsCgh0eYrPim5a76GSympljKMxHFctuuLY.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 08:21:25','2025-07-31 08:21:25',NULL),
(231,496,1,1,1,0,0,0,1,1,1,'journals/selfies/KBMCx2BOFtptpN0boz3gxgV82r1dHXfP34QKt053.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 08:57:39','2025-07-31 08:57:39',NULL),
(232,475,1,1,1,0,0,0,1,1,1,'journals/selfies/OeT2uyhf7khpmKVxGbrLeH8uLZk9ZAUIrKHnP7Rl.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 09:07:00','2025-07-31 09:07:00',NULL),
(233,498,1,1,1,0,0,0,1,1,1,'journals/selfies/nf3ZiZ3d2BIkPBKHL4gP5JOdYU6c4fkVIx8TXC4p.jpg',NULL,'2025-07-31','draft',NULL,NULL,NULL,'2025-07-31 09:17:28','2025-07-31 09:17:28',NULL),
(234,576,1,0,0,1,1,1,0,1,1,'journals/selfies/eRzHabZ9Dwb6wydxV27cxiK173EmivbVloq1sHIc.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 01:58:41','2025-08-01 01:58:41',NULL),
(235,554,1,1,1,1,1,1,1,1,1,'journals/selfies/4OHwqmuOyQFqjDpBH7gNHVvpplMpyoHhyDX6qRz3.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 04:52:52','2025-08-01 04:52:52',NULL),
(236,567,1,0,1,0,0,0,1,1,1,'journals/selfies/lv7LKgX0LeZMkgBqXlEoeB1MkcH672YifhqS11U6.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 06:20:18','2025-08-01 06:20:18',NULL),
(237,484,1,0,1,0,0,0,1,1,1,'journals/selfies/hsR5zigSQPDzgPjAiXIxH7Ml66n9iWCPP2DcuRYp.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 06:46:24','2025-08-01 06:46:24',NULL),
(238,489,1,1,1,0,0,0,1,1,1,'journals/selfies/QMblAU29XYs9CPbOUuYtoSRVSCpkRkkpEqgYwQSY.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 07:25:14','2025-08-01 07:25:14',NULL),
(239,481,1,1,1,0,0,0,1,1,1,'journals/selfies/DMXs1UPQIzNUXFEGtLYTSBFgeRRhrsuAiJDHZlvX.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 07:46:18','2025-08-01 07:46:18',NULL),
(240,494,1,0,1,0,0,0,1,1,1,'journals/selfies/pxXCP0lTi2ORtpHepF5wgID055sD8hK8PnWqotCG.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 07:58:17','2025-08-01 07:58:17',NULL),
(241,496,1,1,1,0,0,0,1,1,1,'journals/selfies/lHiYbfTOW43IZcDQpm4b0UE8BioelnHJQod2Q4Wu.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 08:07:22','2025-08-01 08:07:22',NULL),
(242,525,1,1,1,1,1,1,1,1,1,'journals/selfies/u9CoNjbwyyNraJS3vof47wymOJw0Yb4Ml0Ieic7f.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 08:09:20','2025-08-01 08:09:20',NULL),
(243,476,1,1,1,0,0,0,1,1,1,'journals/selfies/q4IOQxNYmvfE1c7BrOTVTpFXuGFLcFbUymnrhenw.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 08:21:48','2025-08-01 08:21:48',NULL),
(244,543,1,0,1,0,0,0,1,1,1,'journals/selfies/JgTTooBccfHPN4sH0tzD6zDSuBQSetBOsWBLHIyo.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 09:08:02','2025-08-01 09:08:02',NULL),
(245,475,1,1,1,0,0,0,1,1,1,'journals/selfies/j56sxyiZyN4c3zT1s3kKNdnDCgiuNg5ePjfoWXhT.jpg',NULL,'2025-08-01','draft',NULL,NULL,NULL,'2025-08-01 09:55:21','2025-08-01 09:55:21',NULL),
(246,507,1,1,1,1,1,0,1,1,1,'journals/selfies/sKKZEWFaqgXnMzvQn5TQoaXSPa7fGDZOipVRWHAo.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-01 17:27:15','2025-08-01 17:27:15',NULL),
(247,508,1,1,1,1,1,0,1,1,1,'journals/selfies/K9enMQN86bhvKPzO3bwNbYYtAgQa6FuUc0Dv1nHj.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-01 18:16:44','2025-08-01 18:16:44',NULL),
(248,554,1,1,1,1,1,1,1,1,1,'journals/selfies/sopajuQTSx0oCF7ejIgsgiA5Lzg7UyvArQrWflpg.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 05:40:47','2025-08-02 05:40:47',NULL),
(249,484,1,1,1,0,1,0,1,1,1,'journals/selfies/7Q6tMs74gr15wHOmificIDIykUh3PY2rSiJCJpeb.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 06:33:26','2025-08-02 06:33:26',NULL),
(250,481,1,0,0,0,1,0,1,1,1,'journals/selfies/lfy8jPe5fgLJtSzILjiOfxjG5dcU04MxO1IQeez1.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 06:38:52','2025-08-02 06:38:52',NULL),
(251,498,1,1,1,1,1,0,1,1,1,'journals/selfies/6lKJWCfoZvpAp7wmPWgAM12brXEHMsHtNMDRKVIN.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 07:10:50','2025-08-02 07:10:50',NULL),
(252,489,1,1,1,0,0,0,1,1,1,'journals/selfies/mDlM84a4dITvSIf9OqH1haw2yVe8D0XrurMsEF7X.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 07:25:13','2025-08-02 07:25:13',NULL),
(253,526,1,0,0,0,1,0,1,1,1,'journals/selfies/IIYZcIujSDSzcxzCZGn28sIUPtvhtbabIUoBQsrY.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 07:36:58','2025-08-02 07:36:58',NULL),
(254,476,1,1,1,1,1,0,1,1,1,'journals/selfies/VkkJyzvZi0rHeUBKgOXmL0V5GNzGeQq75Lly0l0N.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 08:02:31','2025-08-02 08:02:31',NULL),
(255,494,1,0,1,0,1,0,1,1,1,'journals/selfies/dCvJAnMHql1V7lQVS9FmS9pa5zSB4ock1ty0myHz.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 08:36:50','2025-08-02 08:36:50',NULL),
(256,576,1,0,0,1,1,1,0,1,1,'journals/selfies/jH76JwQSuLBIMY5yodUV311SkYCmGlP0lxqWBrLl.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 08:52:26','2025-08-02 08:52:26',NULL),
(257,567,1,0,1,1,1,0,1,1,1,'journals/selfies/HtxWpBUxc05h1qkAJNlGNJPDFCTrXnbAojdjwQSE.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 08:55:16','2025-08-02 08:55:16',NULL),
(258,525,1,1,1,1,1,1,1,1,1,'journals/selfies/sv3h2dyWUeHIfRV0zoyCGux7WvABMGx5FxBYDSPb.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 09:07:56','2025-08-02 09:07:56',NULL),
(259,496,1,1,1,0,1,0,1,1,1,'journals/selfies/KJcugHN9Gq0J7q8lPVBhp1LeHzYDsPsunw7Konyz.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 09:09:00','2025-08-02 09:09:00',NULL),
(260,543,1,0,0,1,1,0,1,1,1,'journals/selfies/EzPlIu8GUYFLs4I5HzoOkbO8G0Z10qmkbz3RMpGY.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 09:20:18','2025-08-02 09:20:18',NULL),
(261,557,1,0,0,1,1,1,1,1,1,'journals/selfies/cpZJmTVI4iiUgtWcehItqugLiNpTl6A0WE1rZPVO.jpg',NULL,'2025-08-02','draft',NULL,NULL,NULL,'2025-08-02 09:58:25','2025-08-02 09:58:25',NULL),
(262,473,1,1,1,1,1,0,1,1,1,'journals/selfies/WkOhSYa0tlV7B7M0qBadpWhEQOGZaPMI2v6sve7F.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-02 18:50:33','2025-08-02 18:50:33',NULL),
(263,508,1,1,1,0,0,1,1,1,1,'journals/selfies/nrYj8OAEEzAgHy3iIfakf5ymv7utzlSZa1NWn3Mc.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-02 19:40:31','2025-08-02 19:40:31',NULL),
(264,507,1,1,1,1,0,1,1,1,1,'journals/selfies/rN4JaVmQ19UlZHszjzcYjSy7f8YSGOAK2r2l3gFm.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-02 19:42:30','2025-08-02 19:42:30',NULL),
(268,489,1,1,1,0,0,1,1,1,1,'journals/selfies/qo4GfEBDAUvtLoJeHTeMNkravsm9Rvq7tj2eFgiV.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-02 22:43:48','2025-08-02 22:43:48',NULL),
(269,503,1,1,1,1,1,0,1,1,1,'journals/selfies/TRNOsd6lHcg3kU3gRw4CiEFmUJiaDI6AvdeeqzZE.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-02 23:31:05','2025-08-02 23:31:05',NULL),
(270,567,1,0,1,0,1,1,1,1,1,'journals/selfies/KNSn3L9qtK8iBk0tGkIychmHN20UGeD24wV2A3qV.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-02 23:44:35','2025-08-02 23:44:35',NULL),
(271,557,1,0,0,1,1,1,1,1,1,'journals/selfies/qMvU3QbuhNDyFeOfjhmZnpOs4wyqOrKBciJ9Qktu.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 04:45:04','2025-08-03 04:45:04',NULL),
(272,554,1,1,1,1,1,1,1,1,1,'journals/selfies/bJhiU7paj5roB0lXlGZf5C8xk2Fc7V8waZZ8Cyn9.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 04:54:32','2025-08-03 04:54:32',NULL),
(273,568,1,1,1,0,0,1,1,1,1,'journals/selfies/OEiOOZiuQCYLH13Hr8hTZzAwxOxOvZA1KbfAwnKC.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 05:14:06','2025-08-03 05:14:06',NULL),
(274,514,1,0,1,1,0,1,1,1,1,'journals/selfies/Hqgq7sqBw6Y6dZg9nvDuqsKWjuMGYYYfrBvZAxkk.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 05:52:10','2025-08-03 05:52:10',NULL),
(275,484,1,1,1,1,0,1,1,1,1,'journals/selfies/EouSBKDVUFEh3II3NxdJEikEc4EDFsvsqqfllr7O.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 05:56:30','2025-08-03 05:56:30',NULL),
(276,553,1,1,1,0,0,1,1,1,1,'journals/selfies/5GCMKhoaC3XTo2j9UxtxPQ3Dho8d341hbaAPyNMX.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 07:00:52','2025-08-03 07:00:52',NULL),
(277,498,1,1,1,1,0,1,1,1,1,'journals/selfies/MbIRnvwiVhoNTkpHhotEsvX34FI73vhlpuIu13HF.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 07:00:59','2025-08-03 07:00:59',NULL),
(278,470,1,1,1,1,1,1,1,1,1,'journals/selfies/9GWeh8fbOWFwzNtRX6iqrhnMF41mEVyPTFp0AkTc.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 07:13:01','2025-08-03 07:13:01',NULL),
(279,576,1,1,1,1,1,1,0,1,1,'journals/selfies/deK7OyaUCjVOlJeK4g4WJRux6La2umVcSOiB71EB.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 07:15:45','2025-08-03 07:15:45',NULL),
(280,494,1,0,1,1,0,1,1,1,1,'journals/selfies/X5dBEJo4I7F2qxZvkgNYiLMOh8TuZKKlqD55F6PL.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 07:28:28','2025-08-03 07:28:28',NULL),
(281,543,1,1,1,1,1,0,1,1,1,'journals/selfies/UooBxNP55Hjc7s6IOmjt1vDRYsFFRmkPn8nna4Qn.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 08:18:30','2025-08-03 08:18:30',NULL),
(282,476,1,1,1,0,0,1,1,1,1,'journals/selfies/omNMf9EM788NDgwOW0LBbNkZ2iVpWZ3PlZNGU9c9.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 08:51:06','2025-08-03 08:51:06',NULL),
(283,496,1,1,1,1,0,1,1,1,1,'journals/selfies/dlP9lDL8UwJxPPypDcEvR8lBXMsrS7YgFo0XqXCn.jpg',NULL,'2025-08-03','draft',NULL,NULL,NULL,'2025-08-03 09:06:35','2025-08-03 09:06:35',NULL),
(284,508,1,1,1,0,0,0,1,1,1,'journals/selfies/Oc1KUEdiqDNThB0T5LYda6Ki6Gf5DHb21qP3wK8H.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 03:52:16','2025-08-04 03:52:16',NULL),
(285,568,1,1,1,0,0,0,1,1,1,'journals/selfies/NWzz0pslHSTzfzg635HmmKZhJxpYp8N1v6ecy7P3.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 04:33:59','2025-08-04 04:33:59',NULL),
(286,514,1,1,0,0,0,0,1,1,1,'journals/selfies/R3h70UeIhsEb4yi6YwC43he3jbdaYSDZuiusLWyB.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 04:38:34','2025-08-04 04:38:34',NULL),
(287,507,1,1,1,0,0,0,1,1,1,'journals/selfies/p5BPWzGHG8xl3suIw1MYsMMbbeeEhhNRO8dcSttg.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 04:39:04','2025-08-04 04:39:04',NULL),
(288,567,1,0,1,0,0,0,0,1,1,'journals/selfies/MXQh1F1Rpxpg500bBOZDH1D4FCm4WRZgH5fC1847.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 05:38:52','2025-08-04 05:38:52',NULL),
(289,554,1,1,1,0,0,0,1,1,1,'journals/selfies/L1ccqaJEohy5s7gPi0scmN6SmVluqMOn4T762hk0.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 05:58:14','2025-08-04 05:58:14',NULL),
(290,484,1,0,1,0,0,0,1,1,1,'journals/selfies/9FWh6nLoyBH3GGVJYpXsrBXR8xnDD16vqFrYfjHY.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 06:47:01','2025-08-04 06:47:01',NULL),
(291,496,1,1,1,0,0,0,1,1,1,'journals/selfies/UNjun5ejXJSyG0GqXZnNpaqMZY93o1q301tOZqKb.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 06:56:29','2025-08-04 06:56:29',NULL),
(292,498,1,1,1,0,0,0,1,1,1,'journals/selfies/kI9kWGk695VdLYv4wfO0izE0HTAIw5tppmnrzWKo.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 07:43:28','2025-08-04 07:43:28',NULL),
(293,553,1,1,1,1,1,1,1,1,1,'journals/selfies/Q6SILIgLQKwPVocfQUPLyp9mYUMdyG7nVcGKsxME.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 07:43:58','2025-08-04 07:43:58',NULL),
(294,494,1,0,1,0,0,0,1,1,1,'journals/selfies/coOFNyHA6tHWAYopDwoEtVezYFWO7B5f4kEQKYKD.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 07:55:57','2025-08-04 07:55:57',NULL),
(295,481,1,1,0,0,0,0,1,1,1,'journals/selfies/sDGryHht9XrI3c7KGz2qYfXDZnBf2ZIKJoLDVliE.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 07:56:02','2025-08-04 07:56:02',NULL),
(296,476,1,1,1,0,0,0,1,1,1,'journals/selfies/K3iIP53eO7CpfrawkScF9lNZkP5UpxUyobWUKdiA.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 08:00:04','2025-08-04 08:00:04',NULL),
(297,543,1,0,1,0,0,0,1,1,1,'journals/selfies/IgnFUF68QKzToAENc74im74dyNxOfTBmLk6yY9Uf.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 08:06:47','2025-08-04 08:06:47',NULL),
(298,576,1,0,0,1,1,1,0,1,1,'journals/selfies/pZX39LGx7EoaHXPHkBzY9IdLNr3bt47Dfz7c1Oy5.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 09:03:25','2025-08-04 09:03:25',NULL),
(299,475,1,1,1,0,0,0,1,1,1,'journals/selfies/7PKqOmiuSM32ZLc7Hbm2caSs3HahzmqsOO0QUooF.jpg',NULL,'2025-08-04','draft',NULL,NULL,NULL,'2025-08-04 09:04:54','2025-08-04 09:04:54',NULL),
(300,508,1,1,1,0,0,0,1,1,1,'journals/selfies/cvcv9PssrA04hIi4dg7olvY4wHfkT1ajd7r7Fte2.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 01:53:33','2025-08-05 01:53:33',NULL),
(301,507,1,1,1,0,0,0,1,1,1,'journals/selfies/oAXyvpP23aMAw3VZUoMe8tDGp7SDzyBsYOLPEdY3.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 01:55:19','2025-08-05 01:55:19',NULL),
(302,568,1,1,1,0,0,0,1,1,1,'journals/selfies/mA16akuD3nnAJRS7BIt4U6yndF1Qx3iLhfXtzrXL.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 03:29:06','2025-08-05 03:29:06',NULL),
(303,538,1,0,1,1,1,1,1,1,1,'journals/selfies/FborAL6dDRWxoZrtttrPJl0Qtg6fiufzIIjy0zBs.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 04:39:03','2025-08-05 04:39:03',NULL),
(304,554,1,1,1,0,0,0,1,1,1,'journals/selfies/YEJ3s9BhZBjCA4yCCMU1FwTqxHuOboeVDR5l9seE.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 06:13:07','2025-08-05 06:13:07',NULL),
(305,496,1,1,1,0,0,0,1,1,1,'journals/selfies/lMXYXV4ncSjLmXOcpAXRa4p7QOUrpNnSuN1tEzD6.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 06:14:44','2025-08-05 06:14:44',NULL),
(306,484,1,0,1,0,0,0,1,1,1,'journals/selfies/pyqXEaSKOHIwHh4cCpoVf3H75CQRkPbUf954UoyQ.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 06:41:23','2025-08-05 06:41:23',NULL),
(307,473,1,1,1,1,1,0,1,1,1,'journals/selfies/qwx1gkmmsDVnMPVWeSosQTgtf9vEqZnf6STMT7ik.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 06:46:56','2025-08-05 06:46:56',NULL),
(308,481,1,0,0,0,0,0,0,1,1,'journals/selfies/KUwIGAozj4RtSKkTZqtt9QEEMRidpFE40ZY6A4Yy.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 07:17:17','2025-08-05 07:17:17',NULL),
(309,525,1,1,1,1,1,1,1,1,1,'journals/selfies/WACRz2e7KSmRkjtYhQcPQdEzbHq3dl6GFudzdzFa.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 07:34:46','2025-08-05 07:34:46',NULL),
(310,498,1,1,1,0,0,0,1,1,1,'journals/selfies/wSgMRl1krrCZY2ODXhcmhhnJRGaPa0W640ibbhYo.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 07:45:19','2025-08-05 07:45:19',NULL),
(311,553,1,1,1,0,0,0,1,1,1,'journals/selfies/yBh1u3KGGhMJKdh70MOLfQ5HhgH3KwJNBMBvVE9L.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 07:46:00','2025-08-05 07:46:00',NULL),
(312,476,1,1,1,0,0,0,1,1,1,'journals/selfies/mUo97ySU5sPpZdJ8UDPc72FBRTerHQ8L5y8aa13z.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 07:55:41','2025-08-05 07:55:41',NULL),
(313,494,1,0,1,0,0,0,1,1,1,'journals/selfies/fgOGPdfh0BhJq5rK11O2MTi1chgbTfvxmJN4U0ih.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 08:28:31','2025-08-05 08:28:31',NULL),
(314,543,1,0,1,0,0,0,1,1,1,'journals/selfies/lMJmHvKjipkv6w4op2pUO2jUkQkTG7QNe6SGNLed.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 08:45:43','2025-08-05 08:45:43',NULL),
(315,475,1,1,1,0,0,0,1,1,1,'journals/selfies/uoIsDxAOzWJspCwDQch5FzNfZpf7Y4B5uXSeTPMm.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 09:12:26','2025-08-05 09:12:26',NULL),
(316,471,1,0,0,0,0,0,1,1,1,'journals/selfies/YDlqQiYM4wEXpDJXwRVWsmAaNuYLFoyJng4X8U10.jpg',NULL,'2025-08-05','draft',NULL,NULL,NULL,'2025-08-05 15:49:46','2025-08-05 15:49:46',NULL),
(317,507,1,1,1,0,0,0,1,1,1,'journals/selfies/UewMcee9DhiOSNI9yb7cLTHnlcFFi1QHqgcPKPO0.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 04:20:33','2025-08-06 04:20:33',NULL),
(318,508,1,1,1,0,0,0,1,1,1,'journals/selfies/Ki6suwJuUerQcB4fVtPYaQmCK5HpKcGveeyEcx9m.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 04:23:57','2025-08-06 04:23:57',NULL),
(319,554,1,1,1,0,0,0,1,1,1,'journals/selfies/0yuz7DwSODtZncxeYJU2HVqQUBmMrP1gWveCIBJ9.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 04:59:24','2025-08-06 04:59:24',NULL),
(320,526,1,0,0,0,0,0,1,1,1,'journals/selfies/isQcH2mfhU4ZxA4i63BW8yzPL8Q6HyBTpeZUn2kJ.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 05:11:30','2025-08-06 05:11:30',NULL),
(321,496,1,1,1,0,0,0,1,1,1,'journals/selfies/qEhJ1yiclZd25ah40e6QKjPZnjhUxGRR8JejNqXC.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 05:21:16','2025-08-06 05:21:16',NULL),
(324,567,1,0,0,0,0,0,1,1,1,'journals/selfies/w5sXLL1pjpSDdzkS5HprTsEOW73LgTiOdOQklEpG.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 05:44:09','2025-08-06 05:44:09',NULL),
(325,484,1,0,1,0,0,0,1,1,1,'journals/selfies/42ofFBtavGwjdkFrEaTjAlnlRcPvNdNhu94BTuWS.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 06:36:11','2025-08-06 06:36:11',NULL),
(326,498,1,1,1,0,0,0,1,1,1,'journals/selfies/qW9PULdRmLV1fvUDJxay1TSm66hbYpjj1shYVPlB.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 07:00:59','2025-08-06 07:00:59',NULL),
(327,494,1,0,1,0,0,0,1,1,1,'journals/selfies/nu2oaGXgUDx8RusivTyMJuc300YQNIk9RQvpRAip.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 07:04:58','2025-08-06 07:04:58',NULL),
(328,476,1,1,1,0,0,0,1,1,1,'journals/selfies/gh2pq8W963EUC4yyLg0va7643pgn2SzdE45i2lhp.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 07:07:33','2025-08-06 07:07:33',NULL),
(329,553,1,1,1,0,0,0,1,1,1,'journals/selfies/SIY7cWjrx8VKlhZLwRIVxKEyQPsSxsKqD7ydmYjT.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 07:24:17','2025-08-06 07:24:17',NULL),
(330,489,1,1,1,0,0,0,1,1,1,'journals/selfies/JVIwEWmFsEyqERVnUb43ot5d6UY67j6Tjz3F4D2s.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 07:24:45','2025-08-06 07:24:45',NULL),
(333,481,1,0,0,0,0,0,1,1,1,'journals/selfies/HEjIsKlqdSYAqzjbtGTPd91LXDxEeZ6sCQRoqkuP.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 07:56:05','2025-08-06 07:56:05',NULL),
(334,473,1,1,1,1,1,0,1,1,1,'journals/selfies/R0WLQEjqpMlk0YdApEUPtk430EpEydaNgpKBroWv.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 08:20:12','2025-08-06 08:20:12',NULL),
(335,543,1,0,1,0,0,0,1,1,1,'journals/selfies/pYEz56JV2itevDJCXRLzAH8FJGImDXJ799zaa7Ra.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 08:38:26','2025-08-06 08:38:26',NULL),
(336,475,1,1,1,0,0,0,1,1,1,'journals/selfies/mKuxjvxZ7ps93n9wONPPhWzYGIovEW5vL2Vof7d4.jpg',NULL,'2025-08-06','draft',NULL,NULL,NULL,'2025-08-06 08:56:11','2025-08-06 08:56:11',NULL),
(337,557,1,1,1,0,0,0,1,1,1,'journals/selfies/hZyigW7b3oSQ8LyDREGNAQjTxZxKlknodVHLjjPs.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 03:23:40','2025-08-07 03:23:40',NULL),
(338,507,1,1,1,0,0,0,1,1,1,'journals/selfies/dqCBBsrObjNmJArhUKcmf8B0UsdMmDNNZzgDPHQl.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 04:31:28','2025-08-07 04:31:28',NULL),
(339,470,1,1,1,1,1,1,1,1,1,'journals/selfies/0sAesCgEypAyh6UrZN29Sg7sXQKD2l0ptUxAk14A.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 04:44:36','2025-08-07 04:44:36',NULL),
(340,484,1,0,1,0,0,0,1,1,1,'journals/selfies/qwwsUlq9wemahNhO8LQnOJhcaav5P7FrtoGtzSTN.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 05:58:43','2025-08-07 05:58:43',NULL),
(341,567,1,0,0,0,0,0,1,1,1,'journals/selfies/CA8v8rFooYkHikhi0HYhtghIQS0X5PBfUnr9SmII.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 06:09:20','2025-08-07 06:09:20',NULL),
(342,554,1,1,1,0,0,0,1,1,1,'journals/selfies/pgPlHf2bgeIvGSaMVHe66QIUGfCkLk55nGYe1G3R.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 06:29:46','2025-08-07 06:29:46',NULL),
(343,476,1,1,1,0,0,0,1,1,1,'journals/selfies/eQbDFw2EqOglz3HHJlO4VSJruSpjy41GjIEdpWSM.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 07:09:46','2025-08-07 07:09:46',NULL),
(344,489,1,1,1,0,0,0,1,1,1,'journals/selfies/NzR1gMpRek8Fpg0IyQvWmKDTTSZv8Pyh99wqsdo7.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 07:24:11','2025-08-07 07:24:11',NULL),
(345,526,1,0,0,0,0,0,1,1,1,'journals/selfies/uiAPe078sHnwqfdRbaMN4p0etPkcvTzCVrPZOGtq.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 07:30:43','2025-08-07 07:30:43',NULL),
(346,494,1,0,1,0,0,0,1,1,1,'journals/selfies/93faDZeR036eMwAKqHRgvNargckCSG9RrNHeK3CX.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 07:32:27','2025-08-07 07:32:27',NULL),
(347,498,1,1,1,0,0,0,1,1,1,'journals/selfies/SuTR2eKFa8oR7mBSVKfGDpQQ2MhYZtWSkyGUsb3B.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 07:50:05','2025-08-07 07:50:05',NULL),
(348,553,1,1,1,0,0,0,1,1,1,'journals/selfies/z6X4yNarXTQebwBVBchdlWp5QI67PtcmwS0lE0R7.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 07:55:46','2025-08-07 07:55:46',NULL),
(349,475,1,1,1,0,0,0,1,1,1,'journals/selfies/bfrydAbw6n4KMnrwl4NpBB41zUAkk10ylwt3mtdk.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 08:14:13','2025-08-07 08:14:13',NULL),
(350,543,1,0,0,0,0,0,1,1,1,'journals/selfies/XIZKt0uopPvYcfvXXv0tE8PIY0Ls53pm3CGboX8s.jpg',NULL,'2025-08-07','draft',NULL,NULL,NULL,'2025-08-07 08:45:27','2025-08-07 08:45:27',NULL),
(351,470,1,0,0,0,0,1,1,1,1,'journals/selfies/xIL6AV53mJ2v4A6C8IKSU3FoYLVOwnajV2Xwnhfq.jpg',NULL,'2025-08-08','draft',NULL,NULL,NULL,'2025-08-07 20:20:27','2025-08-07 20:20:27',NULL);
/*!40000 ALTER TABLE `journals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_setup_core_system',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'2025_03_19_000000_setup_student_system',1),
(4,'2025_03_20_000000_setup_attendance_system',1),
(5,'2025_03_21_000000_remove_journal_and_permission_columns',1),
(6,'2025_03_25_000000_setup_journal_system',1),
(7,'2025_03_26_000000_setup_additional_features',1),
(8,'2025_03_27_000000_create_payment_proofs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_proofs`
--

DROP TABLE IF EXISTS `payment_proofs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_proofs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `period` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_proofs_user_id_foreign` (`user_id`),
  KEY `payment_proofs_period_index` (`period`),
  CONSTRAINT `payment_proofs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_proofs`
--

LOCK TABLES `payment_proofs` WRITE;
/*!40000 ALTER TABLE `payment_proofs` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_proofs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_requests`
--

DROP TABLE IF EXISTS `permission_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `class_type` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `date` date NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_requests_reviewed_by_foreign` (`reviewed_by`),
  KEY `permission_requests_user_id_index` (`user_id`),
  KEY `permission_requests_status_index` (`status`),
  KEY `permission_requests_start_date_end_date_index` (`start_date`,`end_date`),
  CONSTRAINT `permission_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `permission_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_requests`
--

LOCK TABLES `permission_requests` WRITE;
/*!40000 ALTER TABLE `permission_requests` DISABLE KEYS */;
INSERT INTO `permission_requests` VALUES
(1,486,'regular','Hari ini saya ga bisa masuk karena aa urusan keluarga jadi tidak ada yang bisa nganterin saya jadi saya tidak bisa masuk Hari ini','2025-07-26',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-07-25 23:41:24','2025-07-25 23:41:24',NULL),
(2,533,'css','Izin karena mau pergi ke ulang tahun teman terdekat, lokasi nya jauh jadi berangkat nya harus pagian jdi tidak bisa hadir css','2025-07-26',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-07-26 00:31:11','2025-07-26 00:31:11',NULL),
(3,515,'regular','Keluar kota, urusan keluarga','2025-07-26',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-07-26 00:37:43','2025-07-26 00:37:43',NULL),
(4,515,'css','Keluar kota,urusan keluarga','2025-07-26',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-07-26 00:39:16','2025-07-26 00:39:16',NULL),
(5,486,'regular','Hari ini badan saya tidak enak jadi saya ijin tidak masuk hari ini','2025-07-27',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-07-26 21:13:19','2025-07-26 21:13:19',NULL),
(6,489,'css','Dalam keadaan sakit','2025-08-02',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-08-02 07:25:56','2025-08-02 07:25:56',NULL),
(7,491,'regular','Ada keperluan membuat kacamata','2025-08-03',NULL,NULL,NULL,'pending',NULL,NULL,NULL,'2025-08-02 23:00:29','2025-08-02 23:00:29',NULL);
/*!40000 ALTER TABLE `permission_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scholarship_applications`
--

DROP TABLE IF EXISTS `scholarship_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `scholarship_applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `scholarship_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `application_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`application_data`)),
  `notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scholarship_applications_scholarship_id_user_id_unique` (`scholarship_id`,`user_id`),
  KEY `scholarship_applications_user_id_foreign` (`user_id`),
  KEY `scholarship_applications_reviewed_by_foreign` (`reviewed_by`),
  KEY `scholarship_applications_status_index` (`status`),
  CONSTRAINT `scholarship_applications_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `scholarship_applications_scholarship_id_foreign` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarships` (`id`) ON DELETE CASCADE,
  CONSTRAINT `scholarship_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scholarship_applications`
--

LOCK TABLES `scholarship_applications` WRITE;
/*!40000 ALTER TABLE `scholarship_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `scholarship_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scholarships`
--

DROP TABLE IF EXISTS `scholarships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `scholarships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('merit','need-based','special') NOT NULL,
  `criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`criteria`)),
  `application_start` date NOT NULL,
  `application_end` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarships_type_index` (`type`),
  KEY `scholarships_is_active_index` (`is_active`),
  KEY `scholarships_application_start_application_end_index` (`application_start`,`application_end`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scholarships`
--

LOCK TABLES `scholarships` WRITE;
/*!40000 ALTER TABLE `scholarships` DISABLE KEYS */;
/*!40000 ALTER TABLE `scholarships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('3YwMhbtNAJwTgA5adiN8Mje2nyTA5DnfQszApEGi',NULL,'199.45.154.135','Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWk5VaUkzSDM4OGdUdTZ3OHNRZ3h2WXg1TGt0bmx4cUE3TjRyOGdMSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754625731),
('5El61UWUjW0IGonWKRs5x6T1XVptNMbmXEgJJVGb',NULL,'185.177.72.5','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVVqc0ozdFE4MkJWMXpvTEtaWHZPWktZWmE4Mjl4aWZlYXNPVW9xTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9vdmVyY29tZXIubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754614575),
('a11vfP8IavOXdVU1OmymidKrlQmMnctavSyRVfja',NULL,'66.249.73.192','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmVuYUFaR0kzZnZEd25jbjFSWTdJaDN2bjFIY0pnVm5wQ2EyVm9mVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754623639),
('ba3k8Sx2kGJ3U74c0HQk4xjBFEZBYZiESes3NAfY',543,'182.2.133.224','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidUx0ZTlJVHUxMEhwWE1KcElqQzdiTDlWaFJHekVLY2JBOGxjTlJYMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTQzO30=',1754581527),
('DfbPCWILjWM9VheNPwZcFgzyVggPilWxqqS3soUB',476,'180.242.58.172','Mozilla/5.0 (Linux; Android 12; vivo 1920) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/123.0.6312.118 Mobile Safari/537.36 VivoBrowser/14.4.0.4','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVpQVlYzQ0RaMWdHT1ZyS1A5RTJ4YXFwVGlaWXA5RUpxWmF1Mzh0eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDc2O30=',1754575787),
('e5D8ZGEIGJgAFbwnrYHDC2zvsd6wIvX6TOnMtgoI',NULL,'20.191.45.212','DuckDuckBot/1.1; (+http://duckduckgo.com/duckduckbot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoieU84MUJmUk9SeTVteWo4dThjY2VObUVEMUlySUpYa1hpY1I4cjE0VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9vdmVyY29tZXIubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754628110),
('ehzmYP4pmuJWhN7VBcQKkLIs9lKDuTfD5L3lXXo2',554,'103.136.56.223','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiamhxY1hPcUxzdjFFUjl0YWt4TnZHMDZwR09ZVGxRYmgyakhidjk1dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvam91cm5hbHM/cGFnZT0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTU0O30=',1754573428),
('EKSHWbErKi8WxCJ80C4OHZtJKF1tCokp0ljt0B6q',470,'103.138.49.95','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidTBjc2xwdXZCVnBDTVptT0JsNzhNUUdYdlNxN2VZazIyTHg4R1NwWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvam91cm5hbHMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDcwO30=',1754613397),
('I3IGvgYAhAncrByM6a1PUA5hvNaID8PkYDJT2Th7',494,'180.242.56.135','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHFLaDludzFRN0p2N0tHSGxPb1JpMFhqa29zdmREeWtNN3lnMDIzZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvam91cm5hbHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0OTQ7fQ==',1754577154),
('J4Y6Gx0Sw5o7PJOHMPtW8MK8JDSltYGoK06qdK0A',498,'110.138.88.7','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUhQeHQxbWxIeFA4NzRERWFsU0h3a0xLQUppc2czV2VrMFpvZDBudSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDk4O30=',1754578205),
('JtHwlKlAxC7jYqzM9RvJ23UgxxTikaDcYVhUiSvI',NULL,'110.82.85.53','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidjZSRFZWZ1BaRVkxNkJucExhdnFVT0FLRldOYWxobHFBdjZpVGZXSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754609613),
('l3JF6ynmmFcJ9c2bHGOWY8rXGRGb8JZOy7Vakom4',496,'180.242.59.171','Mozilla/5.0 (Linux; Android 12; Redmi Note 9 Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.6312.118 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.39.0-gn','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTWZRNktFU2E3Y1RsZ2tQanVjYWlGaGUzblJkdmhzSG9JYzg4bGh0MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvam91cm5hbHMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDk2O30=',1754579763),
('lC1KxeJiil3oZa4GEf9Q7Hr5ukzRk41u1Vsu6eHs',NULL,'66.249.73.205','Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRldtaUFVM0dwSHFYcGtWU05YSHZydnIya3U0MUZ4Tm53dllKTDZRVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754623646),
('ldHe3Z0BZuDfwtQlxKMJBgvu3Nj0DfnqgDtulz2F',526,'180.242.71.240','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemVRaDg3Z3pHcUNGVE5MRWJiZUJGZ2V0VjBoV0ttYjdvOXRiZllubSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTI2O30=',1754577043),
('mDBQH4Q4yPwGq6LQGlFQeclH1M67N3P2mzjAThvA',470,'103.138.49.95','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3BnWFRQSkE2dElueGxyd1FoUzJsUzE3emd3eWlESUdqSU91b0drZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvam91cm5hbHMvMzUxL2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0NzA7fQ==',1754623247),
('roQrjQfW2JgGX6e0P8StfKU25lXsRHQSYLqbO4lc',NULL,'3.255.150.35','Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoicHh6QXFSWjZNSHVqMDNTZU5lNEhMbmJjUzN4NEVXZUs4Zlg4cXRhdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly93d3cub3ZlcmNvbWVyLm15LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754596934),
('rRE8n5CXBUAOj2QErpopCrVIl8ACQz9A6uOm3RqW',NULL,'27.212.20.28','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHNjT0NhMGJrNlZOYjFRVXFoQUtvVEhXME5kZ0t5MTdPNHdvM3FraSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9vdmVyY29tZXIubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754608107),
('rxmBIZNGxsMsS8EnP5xvYiNnrjLl56379jeskuw0',489,'182.3.46.195','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSzFOcnJQRHdwdVpvbGpPVVhrOHVhZnRhWDRZSUdhN1lLdllVR2JFRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0ODk7fQ==',1754576750),
('sQg7OOh3kmc3FUmzfAPDf8c7qBAHkfCh3NwGzXBV',475,'103.18.34.245','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYk9TbXJRM25rYVppR1VEMHo5QjI2THl1VHNaVk9KNDVSamlWZFgzZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDc1O30=',1754579656),
('u3OxLo3g5JzgwkQqySFbP6dekNU9xKtF8H2YHKrt',NULL,'171.12.143.133','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicmFsMTc5SmtxbHhvZ1hjYVdDemF5Q1FiSzRUdTlYTGxGWFk2c1FKbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9vdmVyY29tZXIubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754609585),
('w3e1yN5K5kBLAJOo1Na1qRGyao2fbNBiGs69S7h9',553,'110.138.88.7','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQmo2MzBHdTBGUEt6RWt5REhSWlJqVDBFNzFOeWxsOXU0dG5NUVVnaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTUzO30=',1754578546),
('WZtj2oRPi88uyNCiK29VnUjE6HhIOhBSiIFGLHZL',NULL,'14.144.12.119','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibEtweXh1M0NrNmx6UHpJQ0hhZVBuU0NxNmF2aTF4ZmtrdTRVZTVUciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754609643),
('XlsMh5lZYJRBfzzmflW8YV6155q87YTsLFCQAmww',NULL,'141.148.153.213','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.4 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoidEtSVmpDNzc2eHpPemJ0a1N3dUdSdmpkY000b2VrNnpZSmN4OHVTUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754621555),
('xpj5iBlSzcgWNIn1YOh57LeTjTcclpzeRTzxSh9J',NULL,'180.242.59.178','Mozilla/5.0 (Linux; Android 14; Infinix X678B Build/UP1A.231005.007) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/138.0.7204.168 Mobile Safari/537.36 XShare/3.7.0.001','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUJZRThoQURsZFdSMm9QWU5EcEFyTHBTRlhiTWV6Zm5ZdGtrTjJnQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkL3N0dWRlbnQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754606456),
('XU1L5kQwoDWTH2j6pmltcqoySILpTaCs27en9fvB',NULL,'42.236.17.11','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36; 360Spider','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUh4WEtzUnZDellPZzFPTXFVNW1nY2xFQ3pOU2l1ZjRMOFBmUE5USyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9vdmVyY29tZXIubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754575843),
('YXAe4ibIPIKOI9RzDfT5ZeltsJPkZWy6BT8VHJeL',NULL,'42.236.17.210','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidlJWc0NXbGt3YWFnYVN6QlA2UEJrMFowNHVVRjJZUkRGQmNlT2dRYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9vdmVyY29tZXIubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754622907),
('Zkavw18GV83W5IL5DGVVFnBVfneTHnMxkTQYwXKc',NULL,'141.148.153.213','Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoidDZUWTlreUh6REVIWFF3S3lTYkkxVVl5NlR6RkRwVHRYbjN2U3YwQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vb3ZlcmNvbWVyLm15LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754621553);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions_attendance`
--

DROP TABLE IF EXISTS `sessions_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions_attendance` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `session_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `type` enum('regular','css','cgg') NOT NULL DEFAULT 'regular',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_attendance_session_date_index` (`session_date`),
  KEY `sessions_attendance_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions_attendance`
--

LOCK TABLES `sessions_attendance` WRITE;
/*!40000 ALTER TABLE `sessions_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_details`
--

DROP TABLE IF EXISTS `student_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `class` int(11) NOT NULL DEFAULT 7,
  `batch` int(11) NOT NULL DEFAULT 1,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `sekolah` varchar(255) DEFAULT NULL,
  `spp` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `cabang_bank` varchar(255) DEFAULT NULL,
  `pemilik_rekening` varchar(255) DEFAULT NULL,
  `tingkat_kelas` varchar(255) DEFAULT NULL,
  `tahun_ajaran` varchar(255) DEFAULT NULL,
  `nominal_spp_default` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_details_user_id_index` (`user_id`),
  KEY `student_details_class_index` (`class`),
  KEY `student_details_batch_index` (`batch`),
  KEY `student_details_gender_index` (`gender`),
  KEY `student_details_is_active_index` (`is_active`),
  CONSTRAINT `student_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_details`
--

LOCK TABLES `student_details` WRITE;
/*!40000 ALTER TABLE `student_details` DISABLE KEYS */;
INSERT INTO `student_details` VALUES
(1,1,7,1,'Sample Address 1','1234567890','2000-01-01','Sample City','male',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-05-06 04:39:08','2025-05-06 04:39:08'),
(389,469,9,1,'jl. lautze no 8.c','08997220802','2025-07-22','Jakarta','female','smp strada mardi utama 1','580','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','580',1,'2025-07-10 23:09:20','2025-07-21 21:21:52'),
(390,470,8,1,'jl.ketapang 2','085691142475','2025-07-22','Jakarta','male','sd mikael','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:20','2025-07-21 23:22:27'),
(391,471,9,1,'JL.TUNAS BERINGIN NO.18A','082123231937','2025-07-22','Jakarta','male','PASKALIS 3','475','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','475',1,'2025-07-10 23:09:20','2025-07-21 23:23:04'),
(392,472,6,1,'Jl.rawa selatan 4 no.2','082163950888','2025-07-22','Jakarta','female','Sd.strada van lith 1','0','0','Tidak ada','Jakarta','Tidak ada','SD','2025/2026','0',1,'2025-07-10 23:09:20','2025-07-21 23:24:37'),
(393,473,7,1,'JL.TUNAS BERINGIN NO 18A','085167083223','2025-07-22','Jakarta','female','STRADA MARDI UTAMA l','0','0','Tidak ada','Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:21','2025-07-21 23:26:25'),
(394,474,9,1,'Budirahayu/pangeran Jayakarta','085710077707','2025-07-22','Jakarta','male','Budi Mulia mangga besar','795','5880 335 261','BCA','Jakarta','Orang Tua','SMP','2025/2026','795',1,'2025-07-10 23:09:21','2025-07-21 23:27:02'),
(395,475,8,1,'Serdang Raya No.23','085772133803','2025-07-22','Jakarta','male','SMP PASKALIS 3','450','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','450',1,'2025-07-10 23:09:21','2025-07-21 21:26:52'),
(396,476,8,1,'Jl. Rawa Tengah Gang Delapan C No. 4','081808441241','2025-07-22','Jakarta','male','SMP Mardi Utama I','770','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','770',1,'2025-07-10 23:09:21','2025-07-21 23:28:04'),
(397,477,6,1,'Jalan Kampung Rawa tengah no.28','088295591772','2025-07-22','Jakarta','male','SD STRADA VAN LITH 1','0','0',NULL,'Jakarta','Tidak ada','SD','2025/2026','0',1,'2025-07-10 23:09:22','2025-07-21 23:28:47'),
(398,478,8,1,'jln kemayoran barat 3','087819223229','2025-07-22','Jakarta','male','strada mardi utama 1','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:22','2025-07-21 23:29:23'),
(399,479,9,1,'Sunter bentenggan','085891502007','2025-07-22','Jakarta','male','SMP paskalis','475','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','475',1,'2025-07-10 23:09:22','2025-07-21 23:30:10'),
(400,480,8,1,'Jl.Howitzer Raya No 21','085846172495','2025-07-22','Jakarta','male','SMP Paskalis 3','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:22','2025-07-21 23:30:49'),
(401,481,10,1,'Jln. Angkasa Dalam 1 No 42 A','081906883884','2025-07-22','Jakarta','female','SMP Strada Mardi Utama 1','450','03350 10009 45306','BRI','Jakarta','Sekolah','SMA/K','2025/2026','450',1,'2025-07-10 23:09:23','2025-07-21 23:31:40'),
(402,482,6,1,'Jln Rawa Sengon Gang Mawar No 144b RT.2 RW.22 Kelapa Gading Barat, Kecamatan Kelapa Gading, Kotamadya Jakarta Utara','085880538559','2025-07-22','Jakarta','female','SD Strada Van Lith 1','0','0',NULL,'Jakarta','Tidak ada','SD','2025/2026','0',1,'2025-07-10 23:09:23','2025-07-21 23:32:14'),
(403,483,9,1,'Jln Rawa Sengon Gang Mawar No 144b','085738586177','2025-07-22','Jakarta','male','SMP Mardi utama 1','575','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','575',1,'2025-07-10 23:09:23','2025-07-21 23:33:08'),
(404,484,11,1,'KP. BARU BLOK G NO.106','085770222455','2025-07-22','Jakarta','female','SMK Strada 1','750','03350 1000 946302','BRI','Jakarta','Sekolah','SMA/K','2025/2026','750',1,'2025-07-10 23:09:23','2025-07-21 23:33:57'),
(405,485,9,1,'Jl. C GG.3 NO.38C RT/RW:005/003 KARANG ANYAR JAKARTA PUSAT','081519828883','2025-07-22','Jakarta','female','SMP Budi Mulia','795','5880 335 261','BCA','Jakarta','Orang Tua','SMP','2025/2026','795',1,'2025-07-10 23:09:24','2025-07-22 01:04:10'),
(406,486,8,1,'Jl.h daimun','082186579253','2025-07-22','Jakarta','male','Smp mardi utama 1','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:24','2025-07-22 01:04:55'),
(407,487,9,1,'Jalan Gunung sahari 8 dalam No.23A2. Belakang Showroom Honda Motor PT. Wahana, deket Sekolah Pasikin.','089507913668','2025-07-22','Jakarta','female','SMP Strada Mardi Utama 1','620','3350 1000 945306','BRI','Jakarta','Sekolah','SMP','2025/2026','620',1,'2025-07-10 23:09:24','2025-07-22 01:41:43'),
(408,488,12,1,'Jl Kran 2 No 18','081290525850','2025-07-22','Jakarta','male','Sekolah Kristen Kanaan Jakarta','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:24','2025-07-22 01:06:41'),
(409,489,8,1,'Jln apron blok 1B no 502.kemayoran.jakarta pusat','082310407946','2025-07-22','Jakarta','male','SMP starada madri utama 1','575','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','575',1,'2025-07-10 23:09:25','2025-07-22 01:14:19'),
(410,490,10,1,'Jalan Anyer 14 no 8','+62 858-1029-8114','2025-07-22','Jakarta','male','SMP Strada Mardi Utama 1','500','03350 10009 45306','BRI','Jakarta','Sekolah','SMA/K','2025/2026','500',1,'2025-07-10 23:09:25','2025-07-22 01:14:49'),
(411,491,11,1,'angkasa dalam 1 no 60c','081283987889','2025-07-22','Jakarta','male','SMK Strada Mardi Utama 1','Rp1,000,000','03350 1000 946302','BRI','Jakarta','Sekolah','SMA/K','2025/2026','Rp1,000,000',1,'2025-07-10 23:09:25','2025-07-22 01:19:17'),
(412,492,10,1,'Jl. Budi Mulia','082112520331','2025-07-22','Jakarta','male','SMK Strada. Jl.Rajawali Selatan 11 jkrta Pusat','450','03350 10009 45306','BRI','Jakarta','Sekolah','SMA/K','2025/2026','450',1,'2025-07-10 23:09:25','2025-07-22 01:20:05'),
(413,493,9,1,'Jl. Intan I no. 67','85186073665','2025-07-22','Jakarta','male','SMP Paskalis 3','475','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','475',1,'2025-07-10 23:09:26','2025-07-22 01:20:37'),
(414,494,11,1,'JL. Cempaka Putih Barat, No. 38.','081295752162','2025-07-22','Jakarta','male','SMK Strada 1','676','03350 1000 946302','BRI','Jakarta','Sekolah','SMA/K','2025/2026','676',1,'2025-07-10 23:09:26','2025-07-22 01:21:33'),
(415,495,7,1,'JL. cempaka wangi I','085288887363','2025-07-22','Jakarta','female','SMP Paskalis 3','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:26','2025-07-22 01:22:22'),
(416,496,9,1,'Kemayoran utan panjang','089516090758','2025-07-22','Jakarta','male','Strada Mardi utama 1','600','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','600',1,'2025-07-10 23:09:26','2025-07-22 01:23:56'),
(417,497,8,1,'Jl.Pademangan 3 gg 14 no 121','081807306569','2025-07-22','Jakarta','female','SDS Budi Mulia','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:26','2025-07-22 01:24:38'),
(418,498,11,1,'Pasar Ayam Lokomotif, Jalan Bekasi Barat Dalam I No. 11','0895326209356','2025-07-22','Jakarta','female','SMK Strada 1','676','03350 1000 946302','BRI','Jakarta',NULL,'SMA/K','2025/2026','676',1,'2025-07-10 23:09:27','2025-07-22 01:25:10'),
(419,499,11,1,'JL Ampera 4 No 34b','087884560615','2025-07-22','Jakarta','male','SMK STRADA 1','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:27','2025-07-22 01:39:14'),
(420,500,8,1,'Jl. Putri no 6','085954638142','2025-07-22','Jakarta','male','SMP Strada','575','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','575',1,'2025-07-10 23:09:27','2025-07-22 01:38:38'),
(421,501,10,1,'Rusunawa KS Tubun lt 10 a 02','081286127557','2025-07-22','Jakarta','male','SMP Strada Mardi utama','500','03350 10009 45306','BRI','Jakarta','Sekolah','SMA/K','2025/2026','500',1,'2025-07-10 23:09:27','2025-07-22 01:38:06'),
(422,502,11,1,'Jl.karang anyar gg no 16','08777235145','2025-07-22','Jakarta','male','SMA Budi Mulia','Rp1,000,000','5880 3352 88','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','Rp1,000,000',1,'2025-07-10 23:09:28','2025-07-22 01:37:23'),
(423,503,7,1,'Jl rawa tengah','085810106304','2025-07-22','Jakarta','male','Strada van lith 1','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:28','2025-07-22 01:36:49'),
(424,504,9,1,'sunter jaya 1, 27','0895384760508','2025-07-22','Jakarta','male','Strada Mardi Utama 1','609','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','609',1,'2025-07-10 23:09:28','2025-07-22 01:36:05'),
(425,505,8,1,'Cempaka wangi I harapan mulia kemayoran','082234070678','2025-07-22','Jakarta','male','SMP Mardhi utama','630','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','630',1,'2025-07-10 23:09:28','2025-07-22 01:35:30'),
(426,506,9,1,'Sunter Jaya 6B blok K nomor 4','087899966574','2025-07-22','Jakarta','female','Paskalis 3','475','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','475',1,'2025-07-10 23:09:29','2025-07-22 01:32:39'),
(427,507,10,1,'Jl. Percetakan Negara VIII No.24','089637376536','2025-07-22','Jakarta','male','SMK Strada I','700','03350 1000 946302','BRI','Jakarta','Sekolah','SMA/K','2025/2026','700',1,'2025-07-10 23:09:29','2025-07-22 01:32:00'),
(428,508,7,1,'Jl. Percetakan Negara VIII No.24','0895610587000','2025-07-22','Jakarta','female','SMP Strada Mardi Utama I','600','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','600',1,'2025-07-10 23:09:29','2025-07-22 01:31:03'),
(429,509,10,1,'Jl rawa tengah rt013/005','085692118932','2025-07-22','Jakarta','female','Smp mardi utama 1','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:29','2025-07-22 01:30:31'),
(430,510,8,1,'GG Mohamad ali IV no 2','085947525265','2025-07-22','Jakarta','male','Smp strada mardi utama','650','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','650',1,'2025-07-10 23:09:30','2025-07-22 01:29:59'),
(431,511,7,1,'0','081381468991','2025-07-22','Jakarta','female','SD Budi Mulia','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:30','2025-07-22 01:29:07'),
(432,512,10,1,'Jl. Dwiwarna Raya no.32 A','081381468991','2025-07-22','Jakarta','male','SMP Budi Mulia','730','5090 3001 1076','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','730',1,'2025-07-10 23:09:30','2025-07-22 01:28:23'),
(433,513,10,1,'Jl. Dwiwarna Raya no.32 A','081292721078','2025-07-22','Jakarta','male','Smp Budi Mulia','730','5090 3001 1077','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','730',1,'2025-07-10 23:09:30','2025-07-22 01:27:35'),
(434,514,8,1,'Jalan Gulifer No.29,Rt 04/Rw 010 Cempaka baru, kemayoran, jakarta pusat','088293786661','2025-07-22','Jakarta','male','SMP Mardi utama 01','600','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','600',1,'2025-07-10 23:09:31','2025-07-22 01:26:50'),
(435,515,9,1,'Jln. Kran 5 no 22','085771472030','2025-07-22','Jakarta','male','SMP BUDI MULIA','815','5880 335 261','BCA','Jakarta','Orang Tua','SMP','2025/2026','815',1,'2025-07-10 23:09:31','2025-07-22 01:26:13'),
(436,516,8,1,'Jalan Pemuda 1','0813-8546-9233','2025-07-22','Jakarta','female','SMP Strada Mardi Utama 1','600','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','600',1,'2025-07-10 23:09:31','2025-07-22 01:25:43'),
(437,517,11,1,'Jl Karang Anyat Gg. I no 16','085864638150','2025-07-22','Jakarta','male','sma budi mulia','Rp1,000,000','5880 3352 88','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','Rp1,000,000',1,'2025-07-10 23:09:31','2025-07-22 01:00:50'),
(438,518,9,1,'Jl. Anyer no 14 RT 08 RW 09','085695416697','2025-07-22','Jakarta','male','SMP Strada Mardi Utama 1','500','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:32','2025-07-22 00:59:54'),
(439,519,8,1,'jalan Sunter Pulo kecil Blok HR no.7b','085883023672','2025-07-22','Jakarta','male','Paskalis 3','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:32','2025-07-22 00:59:28'),
(440,520,9,1,'jl.kampung rawa no.15 gang permata 6','081381102183','2025-07-22','Jakarta','male','SMP Strada mardi utama','500','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:32','2025-07-22 00:58:01'),
(441,521,8,1,'Jl. Dwiwarna Gg. 0 No. 34','08976111127','2025-07-22','Jakarta','female','Strada Mardi Utama 1','650','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','650',1,'2025-07-10 23:09:32','2025-07-22 00:57:25'),
(442,522,9,1,'Jln. Swadaya V no. 8A','08995772702','2025-07-22','Jakarta','female','SMPN 10 Jakarta Pusat','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:33','2025-07-22 00:56:45'),
(443,523,11,1,'Kemayoran, utan panjang','089616464800','2025-07-22','Jakarta','male','SMK Strada Jakarta','800','3910 0584 94','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','800',1,'2025-07-10 23:09:33','2025-07-22 00:56:13'),
(444,524,8,1,'Jln harapan jaya raya nomor 15','085894816770','2025-07-22','Jakarta','male','Smpn 119 jakarta pusat','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:33','2025-07-22 00:55:32'),
(445,525,9,1,'Jl. SAMBILOTO 4','081262682140','2025-07-22','Jakarta','male','MELANIA 2','400','5790 0514 18','BCA','Jakarta','Sekolah','SMP','2025/2026','400',1,'2025-07-10 23:09:33','2025-07-22 00:54:52'),
(446,526,10,1,'\"Alamat  Jl. Gang budi rahayu 3 no. 10 rt/w. 002/009 kel. Mangga dua selatan - kec. Sawah besar jakarta pusat 10730\"','085891357666','2025-07-22','Jakarta','male','SMP Budi Mulia','720','5090 3001 1033','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','720',1,'2025-07-10 23:09:34','2025-07-22 00:53:53'),
(447,527,8,1,'Jl.Kampung Irian Gang 2 no 38A','085281065699','2025-07-22','Jakarta','male','strada','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:34','2025-07-22 00:51:22'),
(448,528,8,1,'Kp irian 1 GG 12 no 17','085813822560','2025-07-22','Jakarta','male','Strada Mardi utama 1','550','3350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','550',1,'2025-07-10 23:09:34','2025-07-22 00:49:01'),
(449,529,9,1,'Pademangan 8 no 8 RT 7 RW 10','085779686553','2025-07-22','Jakarta','female','SMPN 34 JAKARTA','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:34','2025-07-22 00:48:22'),
(450,530,7,1,'Greend Pramuka square','0852-8184-4409','2025-07-22','Jakarta','male','SMP negeri 77 jakarta','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:35','2025-07-22 00:47:30'),
(451,531,11,1,'Jl. Harapan Jaya Raya no 15','085776166786','2025-07-22','Jakarta','male','SMAN 5 JAKARTA','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:35','2025-07-22 00:46:27'),
(452,532,11,1,'Jl. Budi Mulia No. 15','085947175364','2025-07-22','Jakarta','female','SMAN 40 Jakarta','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:35','2025-07-22 00:43:30'),
(453,533,11,1,'Jln. EKONOMI No 1','087771276144','2025-07-22','Jakarta','female','SMA Budi Mulia Mangga Besar','Rp1,000,000','5880 3352 88','BCA','Jakarta','Orang Tua','SMA/K','2025/2026','Rp1,000,000',1,'2025-07-10 23:09:35','2025-07-22 00:42:52'),
(454,534,4,1,'Serdang Raya no.23','0895626296688','2025-07-22','Jakarta','female','SD SANTO MIKAEL','0','0',NULL,'Jakarta','Tidak ada','SD','2025/2026','0',1,'2025-07-10 23:09:36','2025-07-22 00:42:14'),
(455,535,7,1,'Gading icon','082114919605','2025-07-22','Jakarta','female','Paskalis 3','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:36','2025-07-22 00:41:38'),
(456,536,3,1,'jl cempaka baru 11','081219179700','2025-07-22','Jakarta','male','strada mardi utomo 1','600','3350 10009 45306','BRI','Jakarta','Sekolah','SD','2025/2026','600',1,'2025-07-10 23:09:36','2025-07-22 00:40:35'),
(457,537,10,1,'Gang laggr dalam o 15','085770710558','2025-07-22','Jakarta','male','SMP STRADA MARDI UTAMA I','500','3350 10009 45306','BRI','Jakarta','Sekolah','SMA/K','2025/2026','500',1,'2025-07-10 23:09:36','2025-07-22 00:40:01'),
(458,538,9,1,'Jl. Tembaga Dalam 2 No.L123G','085715180317','2025-07-22','Jakarta','male','SMP Strada Mardi Utama 1','600','03350 10009 45306','BRI','Jakarta','Sekolah','SMP','2025/2026','600',1,'2025-07-10 23:09:37','2025-07-22 00:39:18'),
(459,539,9,1,'Jalan A,gang 6,no.8','087878377778','2025-07-22','Jakarta','female','Budi mulia','815','5880 335 261','BCA','Jakarta','BUDI KURNIAWAN','SMP','2025/2026','815',1,'2025-07-10 23:09:37','2025-07-22 00:35:09'),
(460,540,7,1,'Kp serdang','0857 1773 6069','2025-07-22','Jakarta','female','SMP Budi Mulia Mangga Besar','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:37','2025-07-22 00:33:14'),
(461,541,8,1,'Jl. Cempaka Baru IX No. 70C','085855556933','2025-07-22','Jakarta','male','SMP Strada Mardi Utama 1','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:37','2025-07-22 00:31:44'),
(462,542,10,1,'Jl. Lapangan Pors VII No. 1C','085697843324','2025-07-22','Jakarta','female','SMP Paskalis 3','370','8872 0202 5950','Mandiri','Jakarta','Orang Tua','SMA/K','2025/2026','370',1,'2025-07-10 23:09:37','2025-07-22 00:30:57'),
(463,543,7,1,'Kp Serdang','081389529693','2025-07-22','Jakarta','male','SD Santo Mikael','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:38','2025-07-22 00:23:49'),
(464,544,3,1,'Sunter Jaya 1','085755553044','2025-07-22','Jakarta','male','SD Strada Van Lith 1','0','0',NULL,'Jakarta','Tidak ada','SD','2025/2026','0',1,'2025-07-10 23:09:38','2025-07-22 00:22:19'),
(465,545,10,1,'Jln.bungur besar raya no 54E','085211279729','2025-07-22','Jakarta','male','Strada','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:38','2025-07-22 00:21:39'),
(466,546,7,1,'Jaln bungur besar Raya no 54E','0857-6535-7274','2025-07-22','Jakarta','female','SMP PASKALIS 03','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-10 23:09:38','2025-07-22 00:20:56'),
(467,547,6,1,'Jl.kampung iriang gang 2 no 38A','081293050008','2025-07-22','Jakarta','male','Sd Strada Van Lith 1','0','0',NULL,'Jakarta','Tidak ada','SD','2025/2026','0',1,'2025-07-10 23:09:39','2025-07-22 00:19:59'),
(468,548,7,1,'Jl. Kartini XB dalam','081586760687','2025-07-22','Jakarta','male','SMP Vanlith','0','0',NULL,'Jakarta','Tidak ada','SMP','2025/2026','0',1,'2025-07-10 23:09:39','2025-07-22 00:19:08'),
(469,549,10,1,'Jl. Kartini XB dalam','081211364528','2025-07-22','Jakarta','female','SMK FARMASI PENABUR','785000','5090 3001 0998','BRI','Jakarta','Sekolah','SMA/K','2025/2026','785000',1,'2025-07-10 23:09:39','2025-07-22 00:18:20'),
(470,550,11,1,'Pademangan 2 gg 9 nomor 106A','081218657069','2025-07-22','Jakarta','male','SMA Budi Mulia','0','0',NULL,'Jakarta','Tidak ada','SMA/K','2025/2026','0',1,'2025-07-10 23:09:39','2025-07-22 00:16:04'),
(471,551,6,1,'\"Jl.Sunter Indah 2 blok KC1/5 Jakarta Utara \"','082119933092','2025-07-22','Jakarta','female','SD St. Mikael','0',NULL,NULL,NULL,NULL,'SD','2025/2026','0',1,'2025-07-10 23:15:00','2025-07-22 00:15:26'),
(472,552,9,1,'Jl. Johar Baru Utara No.40, RT.15/RW.03, Johar Baru, Seberang jalan Rawa Selatan IV (Seberang Bengkel Bewok, Kyra Laundry) Masuk dari Gang Princess Laundry (RumahPAGAR TEMBAGA), KOTA JAKARTA PUSAT, JOHAR BARU, DKI JAKARTA, ID, 10560','087860418055','2025-07-22','Jakarta','female','SMP Strada Mardi Utama 1','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SMP','2025/2026','0',1,'2025-07-14 22:02:14','2025-07-22 00:02:06'),
(473,553,9,1,'Pasar Ayam Lokomotif, Jalan Bekasi Barat Dalam I No. 11, RT.12/RW.1, Rawa Bunga, Jatinegara, KOTA JAKARTA TIMUR, JATINEGARA, DKI JAKARTA, ID, 13350','0895340931656','2025-07-22','Jakarta','female','SMP Strada mardi utama 1','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SMP','2025/2026','0',1,'2025-07-14 22:02:14','2025-07-22 00:01:21'),
(474,554,7,1,'Jalan sunter mas timur C blok U.selatan no 11D','081281846160','2025-07-22','Jakarta','female','Smp Vanlith 1 (Gunung sahari)','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SMP','2025/2026','0',1,'2025-07-14 22:02:15','2025-07-21 23:59:48'),
(475,555,4,1,'Jl sukamulia 4 RT 9 / RW 6 Harapan Mulya Kemayoran','087891919118','2025-07-22','Jakarta','male','SDK Saint John Bungur','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SD','2025/2026','0',1,'2025-07-14 22:02:15','2025-07-21 23:59:02'),
(476,556,3,1,'Jl sukamulia 4 RT 9 / RW 6 Harapan Mulya Kemayoran','087891919118','2025-07-22','Jakarta','male','SDK Saint John Bungur','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SD','2025/2026','0',1,'2025-07-14 22:02:15','2025-07-21 23:52:59'),
(477,557,7,1,'JL.Cempaka Baru 11 Kemayoran Jakarta Pusat','0812 1917 9700','2025-07-31','Jakarta','female','SMP Strada 1','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SMP','2025/2026','0',1,'2025-07-14 22:02:15','2025-07-31 00:50:07'),
(478,558,4,1,'Gading Griya Lestari Jl. Tanjung III blok A3 no.66','087883903430','2025-07-22','Jakarta','male','Saint John Bungur','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SD','2025/2026','0',1,'2025-07-14 22:02:16','2025-07-21 23:52:00'),
(479,559,6,1,'Gading Griya Lestari Jl. Tanjung III blok A3 no.66','087883903430','0001-01-01','Jakarta','male','Saint John Bungur','0','0','Tidak terdata','Tidak terdata','Tidak terdata','SD','2025/2026','0',1,'2025-07-14 22:02:16','2025-07-14 22:16:13'),
(480,560,8,1,'Jln bakti 3 no 1a sunterjaya','O81387714487','2025-07-22','Jakarta','male','Paskalis','500','1230 0053 19365','Mandiri/Paskalis','Jakarta','Sekolah','SMP','2025/2026','500',1,'2025-07-14 22:02:16','2025-07-21 23:49:49'),
(481,561,8,1,'Jl. Kramat 5 no.24 	005/09	Kenari	Senen	Jakarta Pusat','085939808210','2025-07-22','Jakarta','male','SMP Strada Mardi Utama 1','850','33501000945306','BRI','Jakarta','Orang Tua','SMP','2025/2026','850',1,'2025-07-15 21:45:24','2025-07-21 23:40:19'),
(482,562,11,1,'Jl. Tembaga Dalam 2 No. L123G RT 05/03 Harapan Mulia Kemayoran Jakarta Pusat','081310668038','2025-07-22','JAKARTA','female','SMK STRADA 1',NULL,NULL,NULL,NULL,NULL,'SMA/K','2025/2026',NULL,1,'2025-07-16 22:34:58','2025-07-21 23:34:41'),
(483,563,7,1,'Jalan Percetakan Negara B116','081514765408','2025-07-22','Jakarta','female','SMP Santa Theresia',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-22 02:02:38','2025-07-22 02:02:38'),
(484,564,9,1,'Cempaka Putih Barat I Rumah No. 23A','0812-4966-2310','2025-07-22','Jakarta','male','SMPN 77 Jakarta',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-22 02:06:18','2025-07-22 02:06:18'),
(485,565,11,1,'Jln.kramat kwitang 1 no 7','083806582480','2025-07-24','JAKARTA','female','Sma yapermas',NULL,NULL,NULL,NULL,NULL,'SMA/K','2025/2026',NULL,1,'2025-07-23 22:39:37','2025-07-23 22:39:37'),
(486,566,3,1,'Galur - Johar baru Rt  004/004 Jakpus','088809703664','2025-07-24','Jakarta','male','SD STRADA VAN LITH 1',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-23 22:45:39','2025-07-23 22:45:39'),
(487,567,7,1,'Jl serdang raya no 16','087842907119','2025-07-24','JAKARTA','male','Sd Santo Mikael',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-23 22:52:13','2025-07-23 22:52:13'),
(488,568,7,1,'Ruko cempaka mas blok m no 54','089529893988','2025-07-24','Jakarta','female','Sd Santo Mikael',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-23 22:59:37','2025-07-23 22:59:37'),
(489,569,6,1,'Jln howitzer raya','085219693530','2025-07-24','Jakarta','female','Karmel',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026','002',1,'2025-07-23 23:21:31','2025-07-23 23:21:31'),
(490,570,6,1,'Jln taruna jaya, gg melati 1 no 6b','081211199019','2025-07-24','Jakarta','female','Karmel',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026','002',1,'2025-07-23 23:24:06','2025-07-23 23:24:06'),
(491,571,6,1,'Jln. Krida 6 no. 19c','081296500038','2025-07-24','Jakarta','male','SD Karmel',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-24 00:26:25','2025-07-24 00:26:25'),
(492,572,12,1,'Angkasa, Asrama Polisi Kemayoran','085716065622','2025-07-24','JAKARTA','male','Sekolah Kanaan Jakarta',NULL,NULL,NULL,NULL,NULL,'SMA/K','2025/2026',NULL,1,'2025-07-24 02:29:08','2025-07-24 02:29:08'),
(493,573,9,1,'Jl. Angkasa, Aspol Kemayoran No. 15','0881024597262','2025-07-24','JAKARTA','female','SMP Kanaan Jakarta',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-24 02:31:28','2025-07-24 02:31:28'),
(494,574,4,1,'Jln howitzer raya','085219686519','2025-07-24','JAKARTA','male','SD Karmel',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-24 02:34:51','2025-07-24 02:34:51'),
(495,575,6,1,'Jl Cempaka wangi 2','081808660795','2025-07-25','Jakarta','male','Jl Cempaka wangi 2',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-24 23:01:10','2025-07-24 23:01:10'),
(496,576,7,1,'Kavling DPRD, Jl. Pulo Jahe No.rt. 05/05, RT.5/RW.5, Jatinegara, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13930','085715417560','2025-07-25','Jakarta','female','SMP Melania 2',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-25 00:30:54','2025-07-25 00:30:54'),
(497,577,7,1,'Jl Cempaka Putih Barat XIX No 15','0895351480145','2025-07-25','Jakarta','female','SMP MELANIA 2',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-25 00:33:24','2025-07-25 00:33:24'),
(498,578,7,1,'Jl. Mutiara II no. 13','088975866748','2025-07-25','Jakarta','male','SMP MELA',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-25 00:34:52','2025-07-25 00:34:52'),
(499,579,7,1,'Kp. Baru no 30 A','085894762082','2025-07-30','Jakarta','male','Melania 2',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-29 19:10:05','2025-07-29 19:10:05'),
(500,580,7,1,'JALAN CEMPAKA PUTIH BARAT XI RT.002/RW.008 NO.8 JAKARTA PUSAT','085719485934','2025-07-30','Jakarta','male','SMP MELANIA II',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-29 19:12:43','2025-07-29 19:12:43'),
(501,581,6,1,'Cempaka wangi dua','+62 821-2526-3027','2025-07-30','Jakarta','male','Karmel',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-29 19:47:52','2025-07-29 19:47:52'),
(502,582,6,1,'Cempaka wangi dua','+62 821-2526-3027','2025-07-30','Jakarta','male','Karmel',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-29 19:49:26','2025-07-29 19:49:26'),
(503,583,7,1,'Jl. Kampung Rawa Tengah Gang VIII No. 15 A','081314781473','2025-07-31','Jakarta','female','SMPN 119',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-07-31 01:01:33','2025-07-31 01:01:33'),
(504,584,6,1,'Jl. Mardani raya gang s  no12B','081318005725','2025-07-31','Jakarta','male','Sd strada vanlit I',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-31 01:04:56','2025-07-31 01:04:56'),
(505,585,4,1,'Jl. Mardani raya gang s no.12B','081318005725','2025-07-31','Jakarta','female','Sd strada Vanlit I',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-31 01:07:03','2025-07-31 01:07:03'),
(506,586,12,1,'sunter jaya 7A gang kelapa','081337777098','2025-07-31','Jakarta','male','SMKN 54 JAKARTA',NULL,NULL,NULL,NULL,NULL,'SMA/K','2025/2026',NULL,1,'2025-07-31 01:09:05','2025-07-31 01:09:05'),
(507,587,12,1,'Jl Hidup Baru Gg.Q No.259','081218687466','2025-07-31','Jakarta','male','SMKN 54 JAKARTA',NULL,NULL,NULL,NULL,NULL,'SMA/K','2025/2026',NULL,1,'2025-07-31 01:18:20','2025-07-31 01:18:20'),
(508,588,4,1,'Jl.Kayu manis 4 no.11a','081315341380','2025-07-31','Jakarta','female','SD Strada Vanlith I',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-07-31 01:20:00','2025-07-31 01:20:00'),
(509,589,8,1,'Jln.Gunung Sahari XI/ 32','081617000902','2011-10-10','Jakarta','female','SMP St. Fransiskus 1',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026','004',1,'2025-08-05 23:27:18','2025-08-05 23:27:18'),
(510,590,5,1,'Kp.sukasari no.3','085696283459','2025-08-06','Jakarta','female','SDK 3 Penabur',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-08-05 23:30:16','2025-08-05 23:30:16'),
(511,591,11,1,'Kp Rawa Sawah, No. 13','083873098715','2008-11-10','Jakarta','male','SMAN 5 JAKARTA',NULL,NULL,NULL,NULL,NULL,'SMA/K','2025/2026',NULL,1,'2025-08-05 23:32:34','2025-08-05 23:32:34'),
(512,592,5,1,'Angkasa Dalam 1','081291722324','2015-03-24','Jakarta','female','SD Strada Vanlith 1',NULL,NULL,NULL,NULL,NULL,'SD','2025/2026',NULL,1,'2025-08-05 23:34:34','2025-08-05 23:34:34'),
(513,593,7,1,'JL.Bingkesmas B7 no.6 Sunter Jaya','085882106339','2018-07-18','Jakarta','female','Strada Mardi Utama 1',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-08-05 23:49:10','2025-08-05 23:49:10'),
(514,594,7,1,'Jalan batu amantis no.6','085716370630','2012-10-05','JAKARTA','male','SMP MELANIA II JAKARTA PUSAT',NULL,NULL,NULL,NULL,NULL,'SMP','2025/2026',NULL,1,'2025-08-06 00:02:30','2025-08-06 00:02:30');
/*!40000 ALTER TABLE `student_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_nip_unique` (`nip`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_nama_index` (`nama`),
  KEY `users_username_index` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=595 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'User One','12345678','user1','user1@example.com','$2y$12$G2tRgRGjtwfm8QdwdBnWBeDdx9LEPrhCjitnpVg/4lW6uxWmsh8Ze',NULL,NULL,'2025-05-06 04:39:08','2025-05-06 04:39:08'),
(469,'Virginia Angeline','20226000468','Virginia Angeline','Virginia@StudyCenter','$2y$12$IRPpBxUmpBw1UjxpjZ2J7OIT6NI9vq4UM9255/pweXwf6QIPzY/0u',NULL,NULL,'2025-07-10 23:09:20','2025-07-21 23:21:00'),
(470,'Fernando Chin','20257000023','Fernando Chin','FernandoChin@StudyCenter','$2y$12$HdqKy0sOtr7LQeDBvwsh9.84jIHoJfpvG4j1ifPTydgZ46f4S9JT.',NULL,NULL,'2025-07-10 23:09:20','2025-07-21 23:22:27'),
(471,'JHERICKO OBERLIN STEVEN NAINGGOLAN','20235000511','JHERICKO OBERLIN','JHERICKOOBERLIN@StudyCenter','$2y$12$5GOwVFZ2jk9F2acVDFv/B.AcgR5ogA5PvUirek9QIQDwuLS4N4wOe',NULL,NULL,'2025-07-10 23:09:20','2025-07-21 23:23:04'),
(472,'Eirica gracella','20258000084','Eirica gracella','EiricaGracella@StudyCenter','$2y$12$EwY4QAZ3vGwDbcy9FEvj6.8ROv0jgNYlAHndDUYd0yZpV3Wvo7qTu',NULL,NULL,'2025-07-10 23:09:20','2025-07-21 23:24:37'),
(473,'JENNIFER VIOLA CHRISTABEL NAINGGOLAN','20258000107','JENNIFER VIOLA CHRISTABEL','JENNIFERVIOLACHRISTABEL@StudyCenter','$2y$12$z8XDPY19M6wmPjIxP/kjiOlSR2MQQhJnl3PjvvpfOxHdSseLuZR36',NULL,NULL,'2025-07-10 23:09:21','2025-07-21 23:26:25'),
(474,'Elvander','20235000645','Elvander','Elvander@StudyCenter','$2y$12$nozINIBYDPWhUJh6MpTSFORl5zMaw0HD1dPS8urLby0DDcLkBiTCq',NULL,NULL,'2025-07-10 23:09:21','2025-07-21 23:27:02'),
(475,'AARON BENEDICT BURTON','2012100148','AARON BENEDICT BURTON','AARONBENEDICTBURTON@StudyCenter','$2y$12$DPx/ZFHkZJrgsgLz61ruWOrrCzejcIYP8CYoQ15cQTM7aGDpuocnu',NULL,NULL,'2025-07-10 23:09:21','2025-07-21 21:26:52'),
(476,'Sean Evano Rusli','2012100130','Sean Evano Rusli','SeanEvanoRusli@StudyCenter','$2y$12$hDfPZPAc8PTk8W169PbolOei3Fc8GjM4yOXM2NVYEPlMneBZH40iu',NULL,NULL,'2025-07-10 23:09:21','2025-07-21 23:28:04'),
(477,'Alvaro Yufen Liu','2013100001','Alvaro Yufen Liu','AlvaroYufenLiu@StudyCenter','$2y$12$W1aOk4G5yYtfs7IyMdwX/.ANAWjr5FDqIP60cnLCIIskZLEoaBhnW',NULL,NULL,'2025-07-10 23:09:22','2025-07-21 23:28:47'),
(478,'christofer Junior tutan','20247000205','christofer Junior tutan','christoferJuniortutan@StudyCenter','$2y$12$R6PUiIV69ksRIQnmIpizye08P6bgKmWFZBjlUYwv0jdyhBr3I6CBW',NULL,NULL,'2025-07-10 23:09:22','2025-07-21 23:29:23'),
(479,'Mathius Hadameon Othello Sitompul','20235000568','Mathius Hadameon Othello Sitompul','MathiusHadameonOthello@StudyCenter','$2y$12$Vtvve2Cn5RF1XX2G3wWej.M1cd/s5S2cVqmjatW/ff7z1pS/hdh2G',NULL,NULL,'2025-07-10 23:09:22','2025-07-21 23:30:10'),
(480,'Shalomikha Noel Javier Kaunang','20257000006','Shalomikha Noel Javier Kaunang','ShalomikhaNoelJavier@StudyCenter','$2y$12$wB8FgK63FUrSlwS7lvFCMuM8hdpjwwKZl2vGU234Iy5l4/Ch4pDBW',NULL,NULL,'2025-07-10 23:09:22','2025-07-21 23:30:49'),
(481,'Claudia Chyntia Bella','2008200204','Claudia Chyntia Bella','ClaudiaChyntiaBella@StudyCenter','$2y$12$JrTrDaHTWajwtmE6TUke2.r.ZiwAEYNcTFPFxx39bSUhzait7eZOy',NULL,NULL,'2025-07-10 23:09:23','2025-07-21 23:31:40'),
(482,'Zephaniah Prince Daenles Manurung','20235000666','Zephaniah Prince Daenles Manurung','ZephaniahPrinceDaenles@StudyCenter','$2y$12$PvlWEpHguXa1eJBh0zS4qunefa1AlCeI9V7SoQyUBR6//WhtkHcHC',NULL,NULL,'2025-07-10 23:09:23','2025-07-21 23:32:14'),
(483,'Yehezkiel Excellent Daenles Manurung','2011100211','Yehezkiel Excellent Daenles Manurung','YehezkielExcellentDaenles@StudyCenter','$2y$12$IFZP8uGK19ts.HWjvaprEe8A7PdoDys./X.SbnzYPPpd.EDhibQBm',NULL,NULL,'2025-07-10 23:09:23','2025-07-21 23:33:08'),
(484,'Claryssa Gloria Aurora Mailuhu','20216000012','Claryssa Gloria Aurora Mailuhu','ClaryssaGloriaAurorMailuhu@StudyCenter','$2y$12$fu.1whrGwQCqJJYSjcJ64eUPOso7lWV2JNcW26PC.pLtBYK5VU4mq',NULL,NULL,'2025-07-10 23:09:23','2025-07-21 23:33:57'),
(485,'Phylicia Luella Henel Ho','20236000446','Phylicia Luella Henel Ho','PhyliciaLuellaHenelHo@StudyCenter','$2y$12$TMi6S2ZhL./ee4Umql83ruekNhVpCNq7u2thOA1F312qd.xFBhB7i',NULL,NULL,'2025-07-10 23:09:24','2025-07-22 01:04:10'),
(486,'Rionardy shen lie','20247000228','Rionardy shen lie','RionardyShenLie@StudyCenter','$2y$12$rOUvsdhaczSUYBS50jJ5PO9saqXd8hFzQfeCqqw5PLmRN0/he4S3u',NULL,NULL,'2025-07-10 23:09:24','2025-07-22 01:04:55'),
(487,'Grace Adeline','2011200031','Grace Adeline','GraceAdeline@StudyCenter','$2y$12$qodhOthmqB3rS1SVro6xReQJynvAb3yarWxakatQJBqLxvFfVpDRi',NULL,NULL,'2025-07-10 23:09:24','2025-07-22 01:41:43'),
(488,'Jonathan Budi','20217000008','Jonathan Budi','JonathanBudi@StudyCenter','$2y$12$w4aLOK3VbzDFNc9om5KN0uTOT5OXrwGocd9v5Jq/X3zQXA0HqN3QS',NULL,NULL,'2025-07-10 23:09:24','2025-07-22 01:06:41'),
(489,'NICHOLAS EDWARD DAMANIK','20245000160','NICHOLAS EDWARD DAMANIK','NICHOLASEDWARDDAMANIK@StudyCenter','$2y$12$0Mj4kuDWnWr7hDtyooyHT.IaemReZKnaOglwksAyl4tjhC4NStSSi',NULL,NULL,'2025-07-10 23:09:25','2025-07-22 01:14:19'),
(490,'Matthew Theofilus Abraham Lincoln Siagian','2010100062','Matthew Theofilus Abraham','MatthewTheofilusAbraham@StudyCenter','$2y$12$GAhcxmWrcM.UTXjjgvAO2u8qpxXWbvpBMf.cJFsVIEcPigSIVeWY6',NULL,NULL,'2025-07-10 23:09:25','2025-07-22 01:14:49'),
(491,'Ryu Dennis Susanto','2009100007','Ryu Dennis Susanto','RyuDennisSusanto@StudyCenter','$2y$12$.wZ0EEM4MVg9BhCKQ8MY8e0Ux9geXitUquCpuAwTszrBxjgx/AhJu',NULL,NULL,'2025-07-10 23:09:25','2025-07-22 01:19:17'),
(492,'Yohanes Kheneto Huben','20227000465','Yohanes Kheneto Huben','YohanesKhenetoHuben@StudyCenter','$2y$12$ZcR9oxeCvq7RutpsvyRfE.Ugp.FBVThF4ZWHn5el6XWeZ6Eaf6u5C',NULL,NULL,'2025-07-10 23:09:25','2025-07-22 01:20:05'),
(493,'Anthony Justin','20235000215','Anthony Justin','AnthonyJustin@StudyCenter','$2y$12$2I8i42VnOml/F8MllFG3C.6Gl.c9jZmr0V5aXzbYQAkEZJYV3qKt.',NULL,NULL,'2025-07-10 23:09:26','2025-07-22 01:20:37'),
(494,'Tensen Stand Lee','2009100011','Tensen Stand Lee','TensenStandLee@StudyCenter','$2y$12$Uhhj9GvaY3JWeWadEqMLXefRxKhX3tdhdaCO/KdKhpp.uNtCb2ybG',NULL,NULL,'2025-07-10 23:09:26','2025-07-22 01:21:33'),
(495,'Marcela Aurelia Putri','20258000022','Marcela Aurelia Putri','MarcelaAureliaPutri@StudyCenter','$2y$12$wXl.Epp5KxhZzkv3HXXVluzRUjJwosrz5oaRAnvIRukS.Ph2Mzj06',NULL,NULL,'2025-07-10 23:09:26','2025-07-22 01:22:22'),
(496,'Gabriel Lucas Gunawan','20235000520','Gabriel Lucas Gunawan','GabrielLucasGunawan@StudyCenter','$2y$12$TIkEwtiARfjVa0wyz/B8DuBoBU9CH9BY6bZNc6N7fe6tnQ3DHw6KC',NULL,NULL,'2025-07-10 23:09:26','2025-07-22 01:23:56'),
(497,'Jong natalia veronika','20248000262','Jong natalia veronika','Jongnataliaveronika@StudyCenter','$2y$12$8oNaF6JKeA6384NNALu2tOkq2jHg5ejCEp4YgRqlxNQm2LSMcVTZa',NULL,NULL,'2025-07-10 23:09:26','2025-07-22 01:24:38'),
(498,'Felicia Luciana','20216000020','Felicia Luciana','FeliciaLuciana@StudyCenter','$2y$12$uhihpWqkhp/7zQ0bJGEWK.9rSclnALasTtUmgqqY8f4XXiFTxgBMa',NULL,NULL,'2025-07-10 23:09:27','2025-07-22 01:25:10'),
(499,'DJONG MARTIN MORRIS','20257000001','DJONG MARTIN MORRIS','DJONGMARTINMORRIS@StudyCenter','$2y$12$WW1yveRLkYxE6gd2WyiIHO5PcRdV.0yh6PNBM3M7TxwnA2K2IiMCG',NULL,NULL,'2025-07-10 23:09:27','2025-07-22 01:39:14'),
(500,'Kevin Elnathan Purba','20225000447','Kevin Elnathan Purba','KevinElnathanPurba@StudyCenter','$2y$12$MLDsYGKp9oAQ3ufr18tyb.mwQElu3FVJekOtVhAYBk8SGqEbojzqi',NULL,NULL,'2025-07-10 23:09:27','2025-07-22 01:38:38'),
(501,'Lie Edward imanuel','20227000458','Lie Edward imanuel','LieEdwardimanuel@StudyCenter','$2y$12$6aTURk4q4v6sw0JMms8nzugnEn6EVWHp2dFzbQu7wK2plI/LV.2eu',NULL,NULL,'2025-07-10 23:09:27','2025-07-22 01:38:06'),
(502,'Jonathan Matheus','2009100013','Jonathan Matheus','JonathanMatheus@StudyCenter','$2y$12$5zT8E7uiyInFdgx8b5XuF.ojKlAWiTnul7psBWLFo9r4r6EeqoDke',NULL,NULL,'2025-07-10 23:09:28','2025-07-22 01:37:23'),
(503,'Jonathan ganda Jaya Barasa','20257000098','Jonathan ganda Jaya Barasa.','JonathangandaJayaBarasa@StudyCenter','$2y$12$FDnFWMzxs.uXPrVF778Qleanf2Y9.6hn3z7EeVOoadrK3x8fDswKu',NULL,NULL,'2025-07-10 23:09:28','2025-07-22 01:36:49'),
(504,'Hendy Yanto','20235000333','Hendy Yanto','HendyYanto@StudyCenter','$2y$12$7ezMp3s9XNskFxC8pVlcgOZ9lvCr9M4208msrgiqd7Gnvq78vNVJy',NULL,NULL,'2025-07-10 23:09:28','2025-07-22 01:36:05'),
(505,'Noel christian yohanes','20247000230','Noel christian yohanes','Noelchristianyohanes@StudyCenter','$2y$12$8.7SMu5m4eqIN92PXGHBOOJI4SRv572I8KO8HxNMhH6QZ9/X7SG1i',NULL,NULL,'2025-07-10 23:09:28','2025-07-22 01:35:30'),
(506,'Fionna Erinne Paulina','20236000015','Fionna Erinne Paulina','FionnaErinnePaulina@StudyCenter','$2y$12$UlXyVXjCRVhdlNH8Hh2pg.tgG6qqSBZJyJv9p5zkmgBXPXgkNNuae',NULL,NULL,'2025-07-10 23:09:29','2025-07-22 01:32:39'),
(507,'Richie Sanjaya','2009100009','Richie Sanjaya','RichieSanajaya@StudyCenter','$2y$12$qchujNlAKwyVP91bWJcZJuGX8bPhW8PI141ga5VRtvVu8e/618w8e',NULL,NULL,'2025-07-10 23:09:29','2025-07-22 01:32:00'),
(508,'Michelle Sanjaya','2013200077','Michelle Sanjaya','MichelleSanjaya@StudyCenter','$2y$12$CQuq3v7Pyp2LWEwHyHrMTeOw1Z6d.TCWxxc.S8fgxPYjE9.j7PJYG',NULL,NULL,'2025-07-10 23:09:29','2025-07-22 01:31:03'),
(509,'Immanuel bintang barasa','20257000097','Immanuel bintang barasa','Immanuelbintangbarasa@StudyCenter','$2y$12$C1X5D10qgTVt1IaTG3VfDOBUSt7l3q0ms96pVbyCoXqN4BDJeTS1G',NULL,NULL,'2025-07-10 23:09:29','2025-07-22 01:30:31'),
(510,'Waldo Alfonsus hasugian','20247000328','Waldo Alfonsus hasugian','WaldoAlfonsushasugian@StudyCenter','$2y$12$HnK.8XcE3B61qabEtCmc8.J9WfzfqHSG6vyIYyRD9MgHy27T2WP5i',NULL,NULL,'2025-07-10 23:09:30','2025-07-22 01:29:59'),
(511,'EVELYN','2012200148','EVELYN','EVELYN@StudyCenter','$2y$12$5hQoZdmrD6VJxHcGkov0TuR3E8HrdYYOS/4mcUitK3wsfnQcd7h4u',NULL,NULL,'2025-07-10 23:09:30','2025-07-22 01:29:07'),
(512,'Valentino','2010100155','Valentino','Valentino@StudyCenter','$2y$12$rfglfNVXp5e8M3ag9FhwoucZbNUsrvnXkKdC5oGyX4Fvm3/mdjIjy',NULL,NULL,'2025-07-10 23:09:30','2025-07-22 01:28:23'),
(513,'Valentinus','2010100157','Valentinus','Valentinus@StudyCenter','$2y$12$G.TRr2k1TrMMOiCp5i5bfuXIc7.LlqfvEl4Iv8W6NeXppGGJU7PGO',NULL,NULL,'2025-07-10 23:09:30','2025-07-22 01:27:35'),
(514,'Bryan Christiansen','2011100228','Bryan Christiansen','BryanChristiansen@StudyCenter','$2y$12$.lcvACSnvurY06gKFmCzuuwRn5p9FOtzSB95PoUJN6eHXV/sGk33G',NULL,NULL,'2025-07-10 23:09:31','2025-07-22 01:26:50'),
(515,'Lourentcius Gradciae','20225000331','Lourentcius Gradciae','LourentciusGradciae@StudyCenter','$2y$12$4Nt5pCIui4m1JGBgjkjL..CyBBFOa7wMZu/aJvYSI.vn/i2ygoccu',NULL,NULL,'2025-07-10 23:09:31','2025-07-22 01:26:13'),
(516,'Shanessa Zefanya','20228000702','Shanessa Zefanya','ShanessaZefanya@StudyCenter','$2y$12$K.6KokA1Db.wwu8yz16X6u2CS.oX9FDV3RwPB7UUeIF/S/H9oUmCq',NULL,NULL,'2025-07-10 23:09:31','2025-07-22 01:25:43'),
(517,'Joseph Matheus','2009100005','Joseph Matheus','JosephMatheus@StudyCenter','$2y$12$vLXntHOIXZFHLxiyVYZnXeP9MbypCNDerJFwqwUq3zOfctzsC3Zqi',NULL,NULL,'2025-07-10 23:09:31','2025-07-22 01:00:50'),
(518,'Christian Noel Siagian','2011100110','Christian Noel Siagian','ChristianNoelSiagian@StudyCenter','$2y$12$q5YgDCRBScuilKI76rwwzOX29IZlQIq7tMHo0WYR6bA/q7nAydbgG',NULL,NULL,'2025-07-10 23:09:32','2025-07-22 00:59:54'),
(519,'Ganesh Rhosan','20247000206','Ganesh Rhosan','GaneshRhosan@StudyCenter','$2y$12$vVipyP6YLYfo/sJELG3P9OBxtvw1QKr6nCNv0lk8EU8awT8vSfAd2',NULL,NULL,'2025-07-10 23:09:32','2025-07-22 00:59:28'),
(520,'Cornelius dwitama simbolon','20235000285','Cornelius dwitama simbolon','Corneliusdwitamasimbolon@StudyCenter','$2y$12$AeOdQe6ZwuOK.bHplEsTIetcuGnRYBMg.d.pgTU91/QGth1SWJqYa',NULL,NULL,'2025-07-10 23:09:32','2025-07-22 00:58:01'),
(521,'Pauline Emmanuel Soewondo','20248000263','Pauline Emmanuel Soewondo','PaulineEmmanuelSoewondo@StudyCenter','$2y$12$W3ybfYUMOHcKc5/Zp4txLuN4ExQMpUpArKavkyZkCsmk4Daxnl2bG',NULL,NULL,'2025-07-10 23:09:32','2025-07-22 00:57:25'),
(522,'Odila Levana Kamajaya','20248000238','Odila Levana Kamajaya','OdilaLevanaKamajaya@StudyCenter','$2y$12$Xu3WwjzDn8bJNqQ/miVzveXJ4cQBLcQCnh0w274C4aegyBjD1nf4O',NULL,NULL,'2025-07-10 23:09:33','2025-07-22 00:56:45'),
(523,'Yehezkiel Gunawan','20217000009','Yehezkiel Gunawan','YehezkielGunawan@StudyCenter','$2y$12$QpeEirCYBccM6luoCbb7dOcowPCjTsJFylHRokZzvO8E13LyDpnuq',NULL,NULL,'2025-07-10 23:09:33','2025-07-22 00:56:13'),
(524,'Jose Julius Josua','2011100197','Jose Julius Josua','JoseJuliusJosua@StudyCenter','$2y$12$N/8UYICZM48tj1YcvgAUou9oBL.5um.AwWVMFxNy69UIRohzfoHjS',NULL,NULL,'2025-07-10 23:09:33','2025-07-22 00:55:32'),
(525,'ENJELMAN HULU','20235000448','ENJELMAN HULU','ENJELMANHULU@StudyCenter','$2y$12$neBNjuKsi0NuXI1kuKA4Y.zjjI1T983XKQzv0f1K.pcHMy0vwMs/W',NULL,NULL,'2025-07-10 23:09:33','2025-07-22 00:54:52'),
(526,'Kent Prajna Irawan','20225000323','Kent Prajna Irawan','KentPrajnaIrawan@StudyCenter','$2y$12$Sg79C8NH4xxP7hgGomzd5eHUI4fNcEb1kya2HGn2eDTSY0agDKkva',NULL,NULL,'2025-07-10 23:09:34','2025-07-22 00:53:53'),
(527,'Miquel devan henry','20245000157','Miquel devan henry','Miqueldevanhenry@StudyCenter','$2y$12$KKjw6D6iz74dfsC7D4pG7.ECDSaC1dag0UyUm.uqbF.1CqIM9l4Qe',NULL,NULL,'2025-07-10 23:09:34','2025-07-22 00:51:22'),
(528,'Fabio mikael Chandra','2012100161','Fabio mikael Chandra','FabiomikaelChandra@StudyCenter','$2y$12$KDRcwDNrxicOtsUAlxfcCuPV4xhqpFbcWYoCa4cYPmOqwku49una.',NULL,NULL,'2025-07-10 23:09:34','2025-07-22 00:49:01'),
(529,'Nadine Felicia Caroline Sihombing','20248000194','Nadine Felicia Caroline Sihombing','NadineFeliciaCaroline@StudyCenter','$2y$12$iRfISUvexKzhwnr165MNYub0R7kzWJm2X2DbXPw5W/KEOXLyuNC3O',NULL,NULL,'2025-07-10 23:09:34','2025-07-22 00:48:22'),
(530,'Geoffrey Alexander Siregar','20257000015','Geoffrey Alexander Siregar','GeoffreyAlexanderSiregar@StudyCenter','$2y$12$ng8Chf.qXnpDfCnjTSqe6OJpOgD/uQzg6h4pDqJLIlM.ThThXV9AG',NULL,NULL,'2025-07-10 23:09:35','2025-07-22 00:47:30'),
(531,'Antonius Marthin Salomo','2008100259','Antonius Marthin Salomo','AntoniusMartinSalomo@StudyCenter','$2y$12$OBB7ZCZvZDk5Sea8brNKJ.aBjXvHzYa/0DNeXfaqR1VqcTtt3EXU2',NULL,NULL,'2025-07-10 23:09:35','2025-07-22 00:46:27'),
(532,'Andrea Putri Yemima Lumban Tobing','20216000022','Andrea Putri Yemima','AndreaPutriYemima@StudyCenter','$2y$12$kNJpCCGEUiCa75YrAK2JSOxVJxii7R1BrMRbyNFhrwFRKT6NjDS8.',NULL,NULL,'2025-07-10 23:09:35','2025-07-22 00:43:30'),
(533,'Moza Andrianto','2009200003','Moza Andrianto','MozaAndrianto@StudyCenter','$2y$12$RfbT9kkdQihwh5q8sJSuleKVx3XzF2DRpeZzGhkV0vHworjIquvR2',NULL,NULL,'2025-07-10 23:09:35','2025-07-22 00:42:52'),
(534,'ALICE GABRIEL BURTON','2016400072','ALICE GABRIEL BURTON','ALICEGABRIELBURTON@StudyCenter','$2y$12$EfEKf167QZrbO46xDxE2pu2oZ1zTzMcm/pLmWvTtMmUgCPVym/N2K',NULL,NULL,'2025-07-10 23:09:36','2025-07-22 00:42:14'),
(535,'Ratu Nadia putri sibarani','2011200206','Ratu Nadia putri sibarani','RatuNadiaputrisibarani@StudyCenter','$2y$12$wgzQcuIBrywGvddaEDlVw.AzSp2oTKGBJUOlwNBURE102S/G2dBca',NULL,NULL,'2025-07-10 23:09:36','2025-07-22 00:41:38'),
(536,'raivent Rafael','20245000161','raivent Rafael','raiventRafael@StudyCenter','$2y$12$faIn5FvMzY4vn09ENRIGgOXVv0Q6kcqAdik10vgF0XsfBjfVQI1EO',NULL,NULL,'2025-07-10 23:09:36','2025-07-22 00:40:35'),
(537,'Filipus michael arifin','2009100199','Filipus michael arifin','Filipusmichaelarifin@StudyCenter','$2y$12$nPRTMXTAciZnRW7BIMDane2aAOS06VlXL6tWt.5S5jYLiS6vqkPk.',NULL,NULL,'2025-07-10 23:09:36','2025-07-22 00:40:01'),
(538,'Januar Varen Wijaya','20235000069','Januar Varen Wijaya','JanuarVarenWijaya@StudyCenter','$2y$12$Px8S83zgNDpwg00FikLK5eUGllmklWmBXnVfq7kyYj3f/VC43CS.2',NULL,NULL,'2025-07-10 23:09:37','2025-07-22 00:39:18'),
(539,'Aurel prischillia bong','2011200193','Aurel prischillia bong','AurelPrischilliabong@StudyCenter','$2y$12$V4N0nYo1AstucumTos6JEOPuFIvXO5foWd0aWh6Pg8N4XTlx1ysNa',NULL,NULL,'2025-07-10 23:09:37','2025-07-22 00:35:09'),
(540,'Livelly Brilianna','20258000108','Livelly Brilianna','LivellyBrilianna@StudyCenter','$2y$12$UyYXlhoy5Opjzdy5cAtCi.uFPaZLauCwxPDGby8KLW6RduKUESbLe',NULL,NULL,'2025-07-10 23:09:37','2025-07-22 00:33:14'),
(541,'Yehezkiel Kenny Widjatmoko','20247000211','Yehezkiel Kenny Widjatmoko','YehezkielKennyWidjatmoko@StudyCenter','$2y$12$sbUYMC2rkhFxj0q1U9IM/.bSmeCGvxJ0wlp5WVwCB25ncNOvtBAkK',NULL,NULL,'2025-07-10 23:09:37','2025-07-22 00:31:44'),
(542,'Abella Kaila Bleysisca','20228000467','Abella Kaila Bleysisca','AbellaKailaBleysisca@StudyCenter','$2y$12$LQZCI3p.l2CLDDHNn.lRuORYKNErElHv4XU8rAkYb9JbgQSnE5clq',NULL,NULL,'2025-07-10 23:09:37','2025-07-22 00:30:57'),
(543,'BRAMA HAGA WILWATIKTA','20257000099','BRAMA HAGA WILWATIKTA','BRAMAHAGAWILWATIKTA@StudyCenter','$2y$12$c5vxfEkynKmyjZTVn9JgwueEJInyEiMCPD1btEoN4Y/oE8p.ckli2',NULL,NULL,'2025-07-10 23:09:38','2025-07-22 00:23:49'),
(544,'Yehezkiel Danny Widjatmoko','20257000100','Yehezkiel Danny Widjatmoko','YehezkielDannyWidjatmoko@StudyCenter','$2y$12$qbpG8JxFrF7Ll6OxffkLL./3nn/EQWW34U.Lmju21FIffbU15xzR.',NULL,NULL,'2025-07-10 23:09:38','2025-07-22 00:22:19'),
(545,'Felix juro siswanto','20257000102','Felix juro siswanto','Felixjurosiswanto@StudyCenter','$2y$12$WPDH0ZGMH5lebTuT4OZ4a.Uth9vzJnb0tPt1zHgky4qlG9VWAP5pK',NULL,NULL,'2025-07-10 23:09:38','2025-07-22 00:21:39'),
(546,'Maria Nirmala Limbunai','2011200140','Maria Nirmala Limbunai','MariaNirmalaLimbunai@StudyCenter','$2y$12$28Dj3qvzXC2a9YKmlrWa0umudXuusZ23xgUUPUygsOCFVEMBsP/5W',NULL,NULL,'2025-07-10 23:09:38','2025-07-22 00:20:56'),
(547,'Rafael Abadius Girelli','20257000103','Rafael Abadius Girelli','RafaelAbadiusGirelli@StudyCenter','$2y$12$O/ScRzD2L0/vSplsVHv.pOG87KiMaFpEH0PMphUjcu0QoeKymuwDO',NULL,NULL,'2025-07-10 23:09:39','2025-07-22 00:19:59'),
(548,'HANZEL DAVINNO HENRY','20257000101','HANZEL DAVINNO HENRY','HANZELDAVINNOHENRY@StudyCenter','$2y$12$zrj57PuS9S8EQaThFepNq.ZwNJTVRBH5owIV2Mpit7ARMGiFnDIcC',NULL,NULL,'2025-07-10 23:09:39','2025-07-22 00:19:08'),
(549,'Fiersya','2010200193','Fiersya','Fiersya@StudyCenter','$2y$12$96MaIut6Z5xM4eolc573Q.KfXsj9M/006aQ.4gDuem0Ne8cCvltCO',NULL,NULL,'2025-07-10 23:09:39','2025-07-22 00:18:20'),
(550,'Jessi Ferly Wijaya','20215000016','Jessi Ferly Wijaya','JessiFerlyWijaya@StudyCenter','$2y$12$aLB0jfl3uYC87KaezLRCu.Lzu9hNiCWW8bnjWHxzOdv0.gtBVggUi',NULL,NULL,'2025-07-10 23:09:39','2025-07-22 00:16:04'),
(551,'PATRICIA NOVELLYN JUNATA','20258000110','PATRICIA NOVELLYN JUNATA','PATRICIANOVELLYNJUNATA@StudyCenter','$2y$12$2bkrs9iPkBc2pIzivIyhZ.OUCFfTGVfcwujYMmyY6hODtmvVDWvBu',NULL,NULL,'2025-07-10 23:15:00','2025-07-22 00:15:26'),
(552,'Gladys Makayla Abel','20236000214','Gladys Makayla Abel','GladysMakaylaAbel@StudyCenter','$2y$12$0G.IKiuqAD0WUfmH6yMDAeg0AlT.YKxcp22p/XZRcoVGDpjGpH3Ya',NULL,NULL,'2025-07-14 22:02:14','2025-07-22 00:02:06'),
(553,'Sherly Wijaya','20216000029','Sherly Wijaya','SherlyWijaya@StudyCenter','$2y$12$mdXrseH6NFeQNSTeCHcsGeiGxojHg5J6oqnHHFyFL8RGi7tFiqmli',NULL,NULL,'2025-07-14 22:02:14','2025-07-22 00:01:21'),
(554,'Vanya Aurora','20258000109','Vanya Aurora','VanyaAurora@StudyCenter','$2y$12$AIj9gXBKUZ73osc4.i5k5OX6oQq/mU5YzsoDLOytQRWzDMeaE0GfC',NULL,NULL,'2025-07-14 22:02:15','2025-07-21 23:59:48'),
(555,'Mavis Vermilion Huang','2016300039','Mavis Vermilion Huang','MavisVermilionHuang@StudyCenter','$2y$12$oL22ISNY1E.iZK0QRn8vw.1wB5Sy68Gf44F1V9ruo4T/HcPHQNU/6',NULL,NULL,'2025-07-14 22:02:15','2025-07-21 23:59:02'),
(556,'Aizen Gildarts Huang','2018300060','Aizen Gildarts Huang','AizenGildartsHuang@StudyCenter','$2y$12$IOoHJSqfDpeZXl6JjUJG5eZAa.pDcnQH6yGFHx3I0VcPrLhI8k8B6',NULL,NULL,'2025-07-14 22:02:15','2025-07-21 23:52:59'),
(557,'Theresia Rachel','20248000175','Theresia Rachel','ThresiaRachel@StudyCenter','$2y$12$0psYPxhj0EzJEG.HpVbE.uTBjGo/BLzmq2s2VnrcVwHiTQ0uL6bIK',NULL,NULL,'2025-07-14 22:02:15','2025-07-31 00:50:07'),
(558,'Vanya Denias','2016400048','Vanya Denias','VanyaDenias@StudyCenter','$2y$12$HTSmCv219umHSA65ggbc7.YyYEdG272TtCSYlTgoCGmEHyyXeWkDK',NULL,NULL,'2025-07-14 22:02:16','2025-07-21 23:52:00'),
(559,'Zebudia Denias','12437','Zebudia Denias','ZebudiaDenias@StudyCenter','$2y$12$lNcQLfPkKqbR82bUh/0biOnk6mpWjaCZJ/pIQziSGdkgM0TvlS6Fa',NULL,NULL,'2025-07-14 22:02:16','2025-07-14 22:16:13'),
(560,'Florentcius raphael indra','20255000007','Florentcius raphael indra','Florentciusraphaelindra@StudyCenter','$2y$12$G.BLAvyVm/fnGYe7WHnH3u0TOPEiWrI2DV24YiULhzH1Wa.LKC/RW',NULL,NULL,'2025-07-14 22:02:16','2025-07-21 23:49:49'),
(561,'Rosario Demsie Waleleng','20255000023','Rosario Demsie Waleleng','Rosario@Studycenter','$2y$12$Tdp3Hocgm66IeUYQlMfiSuKt/nVP/T8jbF9VMMx6XaKdfG4FzVggO',NULL,NULL,'2025-07-15 21:45:24','2025-07-21 23:40:19'),
(562,'Maria Estevania','20216000004','Maria Estevania','Maria@Sc','$2y$12$uF.yBfOdZxDvlNM6CBbAY.CLYCXw4WMTZy1kkrbF1jRTwhfJafbTS',NULL,NULL,'2025-07-16 22:34:58','2025-07-21 23:34:41'),
(563,'Bianca Laura Ratno','20236000005','Bianca Laura Ratno','SCGS@BiancaLaura','$2y$12$ZVtZPzxqwrgXcvrSHWKk1uN2fUGDt4AmlHR5lcbnTqRyFyUgaTpGq',NULL,NULL,'2025-07-22 02:02:38','2025-07-22 02:02:38'),
(564,'Hasea Lemuel Sihombing','20257000022','Hasea Lemuel Sihombing','SCGS@Hasea','$2y$12$ZPiUDSXUhl3.AQQZxajDwuiokNEVwnIoZ0rAcJp4SN2GPEamRe7I.',NULL,NULL,'2025-07-22 02:06:18','2025-07-22 02:06:18'),
(565,'Natasya Alia putri','2008200002','Natasya Alia putri','Study@Center','$2y$12$44tk5z.rzkufhSdF8N/ZLuq/iPOsXo3abGfelRNaIjmeGY5AeQDH6',NULL,NULL,'2025-07-23 22:39:37','2025-07-23 22:39:37'),
(566,'Winston Christopher Liu','20257000011','Winston Christopher Liu','WinstonStudy@Center','$2y$12$2eyeceQvTjR0nT0VodhGiuBdgIxgVUBlvZ.o5r77C00N5LxY1KTs.',NULL,NULL,'2025-07-23 22:45:39','2025-07-23 22:45:39'),
(567,'Andrew Forbes Hartoyo','20257000105','Andrew Forbes Hartoyo','AndrewStudy@Center','$2y$12$FP9azVlswXbeg.c3TtFJLeVDp32T2pF68bPfDl/r1zxoOBT3dXF52',NULL,NULL,'2025-07-23 22:52:13','2025-07-23 22:52:13'),
(568,'Sugarilly junalia fernika','20258000116','Sugarilly junalia fernika','SugarillyStudy@center','$2y$12$v2aBF7q8gW5M1WMHMqZwiOEfZi1oGExoYcdvRjqMXSejR0XCBnQQC',NULL,NULL,'2025-07-23 22:59:37','2025-07-23 22:59:37'),
(569,'Chelsea valencia','2014400065','Chelsea valencia','ChelseaStudy@center','$2y$12$Zv1FNYQgYu7YS08nGdNnCeU6cBVILi.nlIcTp4rtHOhn76XeZoGoa',NULL,NULL,'2025-07-23 23:21:31','2025-07-23 23:21:31'),
(570,'Vihelka orzora','20258000033','Vihelka orzora','VihelkaStudy@center','$2y$12$mNcC1CGsSgoCLumpafxFqeYks5Rh./5PTCnFhGheBsLoDN3eC95eO',NULL,NULL,'2025-07-23 23:24:06','2025-07-23 23:24:06'),
(571,'Jerico Young','20257000042','Jerico Young','jericostudy@center','$2y$12$ZG/tAglYPBMPpHEoL8/B9Oyegw7zTKy22d98d9fiSpnnxC07kSTgW',NULL,NULL,'2025-07-24 00:26:25','2025-07-24 00:26:25'),
(572,'Joe Marvelle','20257000106','Joe Marvelle','JoeMarvelle@studycenter','$2y$12$KRO0gY1aLb8qXswjQr4ULODMQvn1MAS0tlc6vGmM9PB5Cxw..O8Vi',NULL,NULL,'2025-07-24 02:29:08','2025-07-24 02:29:08'),
(573,'GIANNA ADELINE','20258000119','GIANNA ADELINE','GIANNaADELINE@sc','$2y$12$uZAlPO3xzBgKUc4rSdsJWu528b5vX4yCx21kzSifIBoaeltJr7ELy',NULL,NULL,'2025-07-24 02:31:28','2025-07-24 02:31:28'),
(574,'Darvin valentino','2016300064','Darvin valentino','Darvin@sc','$2y$12$KMOkN7ezE7cJAQ17i.B.zufLKsXSxIdL/kPMzZ/lTAdJPw/7.0LPS',NULL,NULL,'2025-07-24 02:34:51','2025-07-24 02:34:51'),
(575,'Reynard excellent','2014300056','Reynard excellent','reynard@sc','$2y$12$L6E.8RA7trzt7TEViIh54OVyT5aQLJxAOgIfsUrchowq7o8ywHAg6',NULL,NULL,'2025-07-24 23:01:10','2025-07-24 23:01:10'),
(576,'Shalom Clarissa Giftifany Bulegalangi','20258000121','Shalom Clarissa Giftifany Bulegalangi','shalom@sc','$2y$12$UBEuOyR22UzIAFDJxVafx.qV6iImr.68e8Vn44YraAi.Qi9bBoy4i',NULL,NULL,'2025-07-25 00:30:54','2025-07-25 00:30:54'),
(577,'Marisa Putri','20258000120','Marisa Putri','Marisa@sc','$2y$12$SIThoWoeMFGGfanQlHOSpet8eZx8yQBOS38RTq67q4Z5.7/8z2iWm',NULL,NULL,'2025-07-25 00:33:24','2025-07-25 00:33:24'),
(578,'Wildan Ardiansyah Pratama','20257000107','Wildan Ardiansyah Pratama','Wildan@SC','$2y$12$djtgKJhpgZnBbdOeBM1dVeTJeBUu2xrtV1OFq2KUVzA9Ygk7mTvL2',NULL,NULL,'2025-07-25 00:34:52','2025-07-25 00:34:52'),
(579,'Rodofa Samuel sinaga','20257000112','Rodofa Samuel sinaga','Rodofa@sc','$2y$12$hvjQpkdP8.OP8tCUOpKc2e6zXgj8/B6eQPzXlVu9DmADJbuA9aQM.',NULL,NULL,'2025-07-29 19:10:05','2025-07-29 19:10:05'),
(580,'BRYAN CHRISTIAN NATANAEL','20257000110','BRYAN CHRISTIAN NATANAEL','BRYAN@sc','$2y$12$p4AmBi2cn1LJRY6B92316.oayn11DnAOqq0jkDmyWpYM9DpsODk8O',NULL,NULL,'2025-07-29 19:12:43','2025-07-29 19:12:43'),
(581,'Dennias Putrapratama Ziliwu','2013100003','Dennias Putrapratama Ziliwu','Dennias@sc','$2y$12$FOEhCyncNtkL3puLZl9OSukPI527X1LvL.ncLh.ttf5Xv7v4Hhnwm',NULL,NULL,'2025-07-29 19:47:52','2025-07-29 19:47:52'),
(582,'Dannias Putrapratama Ziliwu','2013300016','Dannias Putrapratama Ziliwu','Dannias@sc','$2y$12$0CWN0/hPdylbs1ZBbEX07e3nPM0fMsbIvJOOE2jWBUCwSpV0I0tP.',NULL,NULL,'2025-07-29 19:49:26','2025-07-29 19:49:26'),
(583,'RIBKA MARLEN SIMAMORA','20258000127','RIBKA MARLEN SIMAMORA','RibkaMarlen@sc','$2y$12$mqkatARPfXE3dp/GrmLRSOmla2QgV3E3HzbqBTAxQ1rBbf76coKGe',NULL,NULL,'2025-07-31 01:01:33','2025-07-31 01:01:33'),
(584,'Hebron Faith P Jemyun silaban','20247000204','Hebron Faith P Jemyun silaban','Hebron@sc','$2y$12$rkBvB3yRUgzRcao5oNneye4rvWDtzT1ZnwINPB3yZd.5mt4iF/WNq',NULL,NULL,'2025-07-31 01:04:56','2025-07-31 01:04:56'),
(585,'Yudea Ezra Jemyun Silaban','20258000129','Yudea Ezra Jemyun Silaban','Yudea@sc','$2y$12$TncaNU7hrIK.E3d/zBg6ZuJQ4TUrlKxdIm11TSzYXWL/BCCk/8VqW',NULL,NULL,'2025-07-31 01:07:03','2025-07-31 01:07:03'),
(586,'El-great Mercy','20257000026','El-great Mercy','ELGreat@sc','$2y$12$Fc7NCUWbZ3jtYDWdpQW3reGHurG72Cjn1X8M7pquXW73ZICC1LQ1q',NULL,NULL,'2025-07-31 01:09:05','2025-07-31 01:09:05'),
(587,'Rosariyadi','20255000020','Rosariyadi','Rosariyadi@SC','$2y$12$4wxgVE28Nx.kK7pmBsBlAOUUUcyBTU5Lk7xbhHHYn5lO6Jy6FKc16',NULL,NULL,'2025-07-31 01:18:20','2025-07-31 01:18:20'),
(588,'Zahra Tesalonika','20258000128','Zahra Tesalonika','Zahratesalonika@sc','$2y$12$ozw8u4yemMPCGl4ikU/vbumrbDKhZZmMpkt89crm7oqb89m7wSure',NULL,NULL,'2025-07-31 01:20:00','2025-07-31 01:20:00'),
(589,'Livya Rafanya Zangtiago','20258000132','Livya Rafanya Zangtiago','Livya@sc','$2y$12$OyO1nIkPqZNbdXVnvZ7lFOv0sykeuGfEnzAyLE/wzlvz/WBoyZvTe',NULL,NULL,'2025-08-05 23:27:18','2025-08-05 23:27:18'),
(590,'Reynata John Liu','2016400070','Reynata John Liu','Reynata@sc','$2y$12$BHwVqL/PzCwykkqYuV9wqOqYdmi.IbP5YrWn4MUjCIjPz0ex7.Q6G',NULL,NULL,'2025-08-05 23:30:16','2025-08-05 23:30:16'),
(591,'Yonatan Noverino','20257000113','Yonatan Noverino','YonatanNoverino@sc','$2y$12$s6u4vvqXQgUpr352MEM0h.j3r2eaJtcsaNO7/koXgG49TetY2jZjC',NULL,NULL,'2025-08-05 23:32:34','2025-08-05 23:32:34'),
(592,'Clara Shane Leander','2015200002','Clara Shane Leander','ClaraShaner@SC','$2y$12$.WP89/Sp/qVCFdmi1B1k1elI2c7ZfVE3zHQTQToIzL069RfHR2cMy',NULL,NULL,'2025-08-05 23:34:34','2025-08-05 23:34:34'),
(593,'William einar tivadar tampubolon','2012400052','William einar tivadar tampubolon','Williameinar@SC','$2y$12$wbvRPZX8FPvhKxEpD3LyV.puRJcHytSmwvqiLHxR/GWzU9KXGdTb2',NULL,NULL,'2025-08-05 23:49:10','2025-08-05 23:49:10'),
(594,'JEREMIAH CRISTOPHER HUTAGALUNG','20257000045','JEREMIAH CRISTOPHER HUTAGALUNG','JEREMIAHCRISTOPHER@SC','$2y$12$JxpMy8rXp92VIES.HEOicu36nJ2R/kXmx058Rh/gDuPzNUv7MQ0wy',NULL,NULL,'2025-08-06 00:02:30','2025-08-06 00:02:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-08 12:05:56
