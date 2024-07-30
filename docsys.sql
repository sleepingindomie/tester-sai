-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.9.2-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for docsys
CREATE DATABASE IF NOT EXISTS `docsys` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `docsys`;

-- Dumping structure for table docsys.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table docsys.cache: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table docsys.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table docsys.cache_locks: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

-- Dumping structure for table docsys.container
CREATE TABLE IF NOT EXISTS `container` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_no` varchar(255) NOT NULL,
  `seal_no` varchar(255) NOT NULL,
  `outer_quantity` varchar(255) NOT NULL,
  `outer_package_type` varchar(255) NOT NULL,
  `net_weight` float NOT NULL DEFAULT 0,
  `gross_weight` float NOT NULL DEFAULT 0,
  `gross_meas` float NOT NULL DEFAULT 0,
  `bl` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

-- Dumping data for table docsys.container: ~5 rows (approximately)
/*!40000 ALTER TABLE `container` DISABLE KEYS */;
INSERT INTO `container` (`id`, `container_no`, `seal_no`, `outer_quantity`, `outer_package_type`, `net_weight`, `gross_weight`, `gross_meas`, `bl`, `created_at`, `updated_at`) VALUES
	(55, 'SIKU5935851', '0041773', '198', 'BALES', 220, 7154, 27, 'SSLUSUCGPCAD1723', NULL, NULL),
	(56, 'SIKU6007277', '0041246', '213', 'BALES', 333, 6724, 25, 'SSLUSUCGPCAD1723', NULL, NULL),
	(57, 'TCNU5935650', '0041645', '489', 'BALES', 8399, 8644, 60, 'SSLSUCCUCAD1360', NULL, NULL),
	(82, 'CCCCC23910', '3231233', '198', 'BALES', 220, 1500, 25, 'SSLUSUCGPCAD1714', NULL, NULL),
	(155, 'CZZU0019780', '0030227', '1000', 'CARTON BOX', 10000, 10720, 720, 'SSLDSCCOOIY6632', '2024-07-24 02:24:59', '2024-07-24 02:24:59');
/*!40000 ALTER TABLE `container` ENABLE KEYS */;

-- Dumping structure for table docsys.container_corrections
CREATE TABLE IF NOT EXISTS `container_corrections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_container_id` int(11) DEFAULT NULL,
  `bl` varchar(255) DEFAULT NULL,
  `container_no` varchar(255) DEFAULT NULL,
  `seal_no` varchar(255) DEFAULT NULL,
  `outer_quantity` float DEFAULT NULL,
  `outer_package_type` varchar(255) DEFAULT NULL,
  `gross_weight` float DEFAULT NULL,
  `gross_meas` float DEFAULT NULL,
  `net_weight` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `original_container_id` (`original_container_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `container_corrections_ibfk_1` FOREIGN KEY (`original_container_id`) REFERENCES `container` (`id`),
  CONSTRAINT `container_corrections_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table docsys.container_corrections: ~2 rows (approximately)
/*!40000 ALTER TABLE `container_corrections` DISABLE KEYS */;
INSERT INTO `container_corrections` (`id`, `original_container_id`, `bl`, `container_no`, `seal_no`, `outer_quantity`, `outer_package_type`, `gross_weight`, `gross_meas`, `net_weight`, `user_id`, `created_at`) VALUES
	(63, NULL, 'SSLUSUCGPCAD1714', 'CCCCC23910', '3231233', 198, 'BALES', 1500, 25, 220, NULL, '2024-07-22 10:20:27'),
	(64, NULL, 'SSLUSUCGPCAD1714', 'HWQJ3055179', '0030222', 302, 'BALES', 800, 40, 333, NULL, '2024-07-22 10:20:27');
/*!40000 ALTER TABLE `container_corrections` ENABLE KEYS */;

-- Dumping structure for table docsys.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table docsys.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2024_07_18_055210_create_sessions_table', 1),
	(2, '2024_07_19_084823_create_cache_table', 2),
	(3, '2024_07_25_044129_create_completed_shipping_info_table', 3),
	(4, '2024_07_25_044138_create_pending_shipping_info_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table docsys.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table docsys.sessions: ~3 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('49tGDW2WRIxXtMfYL6sxJ3og6RztfvcymN0hdfKb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieGJRY3ZQeHpUcWcyM2RqNmppUjB0RmpCNWNiUTZnTDM5Ykh1YllrbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1722314783),
	('M6F0XohLTKAVpmjrb2l6m57hQnWuW4Gn8kNfTa6E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUE2MEp6SzduTlVDNWhTQXl1NFk4ZTFvWVhkMjF4d0p3OWxNbTNQRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722048351),
	('xlYI3PcddJEl5lIkTXeiqciIKTonOw0Z2j759PKx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmRTVExZRnB6WXUwc1d6aGU1VmYyYVYySk00V3B0SVpmYTB5TDJTNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722186649);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table docsys.shipping_info
CREATE TABLE IF NOT EXISTS `shipping_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bl` varchar(255) NOT NULL,
  `imo_number` varchar(255) NOT NULL,
  `un_number` varchar(255) NOT NULL,
  `shipper` varchar(255) NOT NULL,
  `consignee` varchar(255) NOT NULL,
  `notify_party` varchar(255) NOT NULL,
  `place_of_receipt` varchar(255) NOT NULL,
  `ocean_vessel` varchar(255) NOT NULL,
  `port_of_loading` varchar(255) NOT NULL,
  `port_of_discharge` varchar(255) NOT NULL,
  `place_of_delivery` varchar(255) NOT NULL,
  `final_destination` varchar(255) NOT NULL,
  `attached_sheet_description` text DEFAULT NULL,
  `container_no` varchar(255) NOT NULL,
  `seal_no` varchar(255) NOT NULL,
  `no_of_containers` varchar(255) NOT NULL DEFAULT '0',
  `description_of_goods` varchar(10000) NOT NULL,
  `gross_weight` float NOT NULL DEFAULT 0,
  `net_weight` float NOT NULL DEFAULT 0,
  `measurement` float NOT NULL DEFAULT 0,
  `type` varchar(50) NOT NULL,
  `total_no_of_containers` varchar(255) NOT NULL,
  `freight_and_charges` varchar(255) NOT NULL,
  `place_date_of_issue` varchar(50) NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `hs_code` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `tanggal_peb` date NOT NULL,
  `peb` varchar(255) NOT NULL,
  `vgm` varchar(255) NOT NULL,
  `no_peb` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `locked` tinyint(1) DEFAULT 0,
  `vessel_id` int(11) DEFAULT NULL,
  `progress` varchar(255) NOT NULL DEFAULT 'Pending',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vessel_id` (`vessel_id`),
  CONSTRAINT `fk_vessel_id` FOREIGN KEY (`vessel_id`) REFERENCES `vessels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- Dumping data for table docsys.shipping_info: ~4 rows (approximately)
/*!40000 ALTER TABLE `shipping_info` DISABLE KEYS */;
INSERT INTO `shipping_info` (`id`, `bl`, `imo_number`, `un_number`, `shipper`, `consignee`, `notify_party`, `place_of_receipt`, `ocean_vessel`, `port_of_loading`, `port_of_discharge`, `place_of_delivery`, `final_destination`, `attached_sheet_description`, `container_no`, `seal_no`, `no_of_containers`, `description_of_goods`, `gross_weight`, `net_weight`, `measurement`, `type`, `total_no_of_containers`, `freight_and_charges`, `place_date_of_issue`, `date`, `hs_code`, `npwp`, `tanggal_peb`, `peb`, `vgm`, `no_peb`, `user_id`, `created_at`, `locked`, `vessel_id`, `progress`, `updated_at`) VALUES
	(25, 'SSLUSUCGPCAD1723', '', '', 'PT. DHL GLOBAL FORWARDING INDONESIA GRAHA PENA LT.20 ROOM 2002 JL. A YANI NO.88 KETINTANG GAYUNGAN SURABAYA EAST JAVA 60231 INDONESIA', 'DHL GLOBAL FORWARDING (SINGAPORE) 1 CHANGI SOUTH STREET 2, SINGAPORE SINGAPORE 486760 CONTACT: SIN.OFRDOCALERT@DHL.COM TEL:+6565427668 EMAIL: SIN.OFRDOCALERT@DHL.COM', 'DHL GLOBAL FORWARDING (SINGAPORE) 1 CHANGI SOUTH STREET 2, SINGAPORE SINGAPORE 486760 CONTACT: SIN.OFRDOCALERT@DHL.COM TEL:+6565427668 EMAIL: SIN.OFRDOCALERT@DHL.COM', 'SURABAYA, INDONESIA CY', 'SEVILLIA - 932N', 'SURABAYA, INDONESIA', 'SINGAPORE', 'SINGAPORE CY', 'SINGAPORE', NULL, 'TCNU5935650', '0041645', '213 ROLL', 'SHIPPER&#039;S LOAD AND COUNT\\r\\n\\r\\n2 X 40&#039; HC CONTAINERS STC:\\r\\n581 BALES OR RAW COTTON\\r\\nPROFORMA INVOICE NO.:\\r\\n03EXP2024 (REVISED)\\r\\nDATE : 13.05.2024\\r\\nL/C NO.:0926240010401\\r\\nDATE:20.05.2024\\r\\nH.S CODE:52101.00.00\\r\\nTIN NO.:891033346427\\r\\nIRC NO.:260315110558922', 13878, 553, 52, 'Non-DG', 'FOUR HUNDRED AND ELEVEN BALES ONLY', 'Prepaid', 'SURABAYA JUN, 28 2024', '2024-06-28', '52101.00.00', '11003336654', '2024-06-28', 'uploads/SSLUSUCGPCAD1723/PEB.pdf', 'uploads/SSLUSUCGPCAD1723/SIKU6002296.pdf,uploads/SSLUSUCGPCAD1723/SIKU6007277.pdf', '709710/WBC.11/KPP.MP.01/2024', 24, '2024-07-25 15:32:30', 0, NULL, 'Completed', NULL),
	(26, 'SSLSUCCUCAD1360', '4.1', '3360', 'PT. TRIJAYA FAJAR PERSADA JL. YO SUDARSO NO. 60 BANYUWANGI, JAWA TIMUR, INDONESIA', 'J.J POLYMERS PVT LTD, 29B RABINDRA SARANI, 2ND FLOOR, ROOM NO. 13, KOLKATA, 700073, GST NO. 19AABCJ177B1ZT, IECNO. AABCJ1773B1ZT', 'SAME AS CONSIGNEE', 'SURABAYA, INDONESIA CY', 'SEVILLIA - 933N', 'SURABAYA, INDONESIA', 'KOLKATA, INDIA', 'KOLKATA, INDIA CY', 'KOLKATA, INDIA', NULL, 'HWQJ3055179', '0041645', '198 BALES', 'SHIPPER&#039;S LOAD AND COUNT\\r\\n\\r\\n1 X 40&#039; HC CONTAINER STC :\\r\\n489 BALES OF\\r\\nKAPOK FIBRE GRADE A\\r\\nHS CODE: 1404.90.30\\r\\nIMO: 4.1\\r\\nUNNO: 3360\\r\\nPKG : III\\r\\nSHIPPED ON BOARD ON 25, JUN 2024\\r\\n', 8644, 8399, 60, 'DG', 'FOUR HUNDRED AND EIGHTY-NINE BALES ONLY', 'Prepaid', 'SURABAYA JUN, 25 2024', '2024-06-25', '1404.90.30', '5544132017899', '2024-06-25', 'uploads/SSLSUCCUCAD1360/PEB.pdf', 'uploads/SSLSUCCUCAD1360/SIKU6001860.pdf', '3223003147', 20, '2024-07-25 15:32:21', 1, NULL, 'Completed', NULL),
	(37, 'SSLUSUCGPCAD1714', '', '', 'PT. LOKA FIBER INDONESIA JL. RAYA WENDIT BARAT NO.4 MANGLIAWAN, PAKIS-MALANG, JAWA TIMUR INDONESIA-65154, PH: +62 8121779980', 'TO THE ORDER OF ISLAMI BANK BANGLADESH PLC, (BUSINESS IDENTIFICATION NUMBER-00000124-002) KADAMTOLI BRANCH, CHATTOGRAM, RAHAT, CENTER, HOLDING NO 295, D.T. ROAD', '1. ISLAMI BANK BANGLADESH PLC (BUSINESS IDENTIFICATION NUMBER-00000124-002) KADAMTOLI BRANCH, CHATTOGRAM, RAHAT, CENTER, HOLDING NO 295, D.T. ROAD', 'SURABAYA, INDONESIA CY', 'SINAR SIGLI - 039N', 'SURABAYA, INDONESIA', 'CHATTOGRAM, BANGLADESH', 'CHATTOGRAM, BANGLADESH CY', 'CHATTOGRAM, BANGLADESH', 'SHIPPER&#039;S LOAD AND COUNT\\r\\n\\r\\n2 X 40&#039; HC CONTAINERS STC:\\r\\n581 BALES OR RAW COTTON\\r\\nPROFORMA INVOICE NO.:\\r\\n03EXP2024 (REVISED)\\r\\nDATE : 13.05.2024\\r\\nL/C NO.:0926240010401\\r\\nDATE:20.05.2024\\r\\nH.S CODE:52101.00.00\\r\\nTIN NO.:891033346427\\r\\nIRC NO.:260315110558922', 'CCCCC23910', '3231233', '198 BALES', 'SHIPPER&#039;S LOAD AND COUNT\\r\\n\\r\\n2 X 40&#039; HC CONTAINERS STC:\\r\\n581 BALES OR RAW COTTON\\r\\nPROFORMA INVOICE NO.:\\r\\n03EXP2024 (REVISED)\\r\\nDATE : 13.05.2024\\r\\nL/C NO.:0926240010401\\r\\nDATE:20.05.2024\\r\\nH.S CODE:52101.00.00\\r\\nTIN NO.:891033346427\\r\\nIRC NO.:260315110558922', 1500, 220, 25, 'Non-DG', 'ONE HUNDRED AND NINETY-EIGHT BALES ONLY', 'Prepaid', 'JUL, 04 2024', '2024-07-04', '85182954851', '626565898222', '2024-07-04', 'uploads/SSLUSUCGPCAD1714/PEB.pdf', 'uploads/SSLUSUCGPCAD1714/SIKU5935851.pdf', '0016699', 23, '2024-07-25 11:51:34', 0, NULL, 'Pending', NULL),
	(48, 'SSLDSCCOOIY6632', '2.2', '7214', 'PT. RAJDULAR BROTHERS JLN. GARUDA MUARO KASANG DALAM KORONG SUNGAI PINANG, KEL. KASANG, KEC BATANG ANAI, KAB. PADANG PARIAMAN 25586, PROP. SUMATERA BARAT, INDONESIA', 'NARESH KUMAR TARUN KUMAR 21-A, GADODIA MARKET, KHARI BAOLI DELHI-110006 IEC CODE : 0505004224 GSTIN. : 07AACFN3542J1ZB FSSAI : 10013011000919 EMAIL  NKTK@AOL.IN PAN:AACFN3542J *', 'NARESH KUMAR TARUN KUMAR 21-A, GADODIA MARKET, KHARI BAOLI DELHI-110006 IEC CODE : 0505004224 GSTIN. : 07AACFN3542J1ZB FSSAI : 10013011000919 EMAIL  NKTK@AOL.IN PAN:AACFN3542J *', 'SURABAYA, INDONESIA CY', 'SEVILLIA - 933N', 'SURABAYA, INDONESIA', 'MUNDRA, INDIA', 'MUNDRA, INDIA CY', 'MUNDRA, INDIA', 'TANTENRICH\r\nHS (ID): 210690\r\n\r\n2 PALLET :\r\nTASTENRICH MASTER U5\r\nHS (ID): 210690\r\n\r\n246 CARTON BOXES:\r\nMIU MIU ECOMMERCE PAPER\r\nHS (ID): 481920\r\n\r\n1 PALLET :\r\nPATCHOULI\r\nHS (ID): 330129\r\n\r\n2 PALLETS:\r\nSPEAKERS\r\nHS (ID): 851829\r\n\r\n1 PALLET:\r\nPATCHOULI\r\nHS (ID): 330129\r\n\r\n1 PALLET:\r\nELEVATOR PARTS\r\nHS (ID): 842890\r\n\r\n*\r\nTASTENRICH MASTER U5\r\nSUFFOLK, UNITED KINGDOM\r\nINDONESIA\r\nNET WT: 20 KG\r\n(30 CARTON BOXES)\r\n\r\nMIU MIU ECOMMERCE PAPER BOX\r\nSHANGHAI\r\n\r\nIFF INDIA PRIVATE LIMITED\r\n\r\nGENELEC OY\r\nFINLAND\r\n\r\nIFF INDIA PRIVATE LIMITED\r\n\r\nKONE INDUSTRIAL OY LTD/HGX\r\n\r\nSHIPPED ON BOARD ON 12, JULY 2024', 'CZZU0019780', '0030227', '1000 CARTON BOX', 'SHIPPER\'S LOAD AND COUNT\r\n\r\n1 X 30\' GP CONTAINERS STC:\r\n10 KG NETT IN CARTON BOX\r\n1000 CARTON BOXES OF CLOVE LALPARI\r\nGROSS WEIGHT : 10,720.00 KGS\r\nNET WEIGHT : 10,000.00 KGS\r\n\r\nHS CODE : 0907.10.00\r\nINVOICE NO. : RDB24S179\r\nINVOICE DATE : 29 JUNE 2024\r\nDESCRIPTION AS PER ATTACHED SHEET\r\nAGENT AS PER ATTACHED SHEET', 10720, 10000, 720, 'DG', 'ONE THOUSAND CARTON BOX ONLY', 'Prepaid', 'JUL, 05 2024', '2024-07-05', '0907.10.00', '01010101', '2024-07-05', 'uploads/SSLDSCCOOIY6632/PEB.pdf', 'uploads/SSLDSCCOOIY6632/SIKU6002296.pdf,uploads/SSLDSCCOOIY6632/SIKU6001860.pdf,uploads/SSLDSCCOOIY6632/SIKU6007277.pdf,uploads/SSLDSCCOOIY6632/SIKU5935851.pdf', '01010101', 29, '2024-07-25 15:31:54', 0, NULL, 'Pending', '2024-07-24 02:30:45');
/*!40000 ALTER TABLE `shipping_info` ENABLE KEYS */;

-- Dumping structure for table docsys.shipping_info_corrections
CREATE TABLE IF NOT EXISTS `shipping_info_corrections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_shipping_info_id` int(11) DEFAULT NULL,
  `bl` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `shipper` varchar(255) DEFAULT NULL,
  `consignee` varchar(255) DEFAULT NULL,
  `notify_party` varchar(255) DEFAULT NULL,
  `place_of_receipt` varchar(255) DEFAULT NULL,
  `ocean_vessel` varchar(255) DEFAULT NULL,
  `port_of_loading` varchar(255) DEFAULT NULL,
  `port_of_discharge` varchar(255) DEFAULT NULL,
  `place_of_delivery` varchar(255) DEFAULT NULL,
  `final_destination` varchar(255) DEFAULT NULL,
  `gross_weight` float DEFAULT NULL,
  `net_weight` float DEFAULT NULL,
  `measurement` float DEFAULT NULL,
  `no_of_containers` varchar(255) DEFAULT NULL,
  `freight_and_charges` varchar(255) DEFAULT NULL,
  `place_date_of_issue` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `un_number` varchar(255) DEFAULT NULL,
  `imo_number` varchar(255) DEFAULT NULL,
  `description_of_goods` text DEFAULT NULL,
  `attached_sheet_description` text DEFAULT NULL,
  `container_no` text DEFAULT NULL,
  `seal_no` text DEFAULT NULL,
  `total_no_of_containers` varchar(255) DEFAULT NULL,
  `hs_code` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `no_peb` varchar(255) DEFAULT NULL,
  `tanggal_peb` date DEFAULT NULL,
  `vgm` text DEFAULT NULL,
  `peb` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `locked` tinyint(1) DEFAULT 1,
  `progress` varchar(255) NOT NULL DEFAULT 'Edited',
  PRIMARY KEY (`id`),
  KEY `original_shipping_info_id` (`original_shipping_info_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `shipping_info_corrections_ibfk_1` FOREIGN KEY (`original_shipping_info_id`) REFERENCES `shipping_info` (`id`),
  CONSTRAINT `shipping_info_corrections_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table docsys.shipping_info_corrections: ~1 rows (approximately)
/*!40000 ALTER TABLE `shipping_info_corrections` DISABLE KEYS */;
INSERT INTO `shipping_info_corrections` (`id`, `original_shipping_info_id`, `bl`, `type`, `shipper`, `consignee`, `notify_party`, `place_of_receipt`, `ocean_vessel`, `port_of_loading`, `port_of_discharge`, `place_of_delivery`, `final_destination`, `gross_weight`, `net_weight`, `measurement`, `no_of_containers`, `freight_and_charges`, `place_date_of_issue`, `date`, `user_id`, `un_number`, `imo_number`, `description_of_goods`, `attached_sheet_description`, `container_no`, `seal_no`, `total_no_of_containers`, `hs_code`, `npwp`, `no_peb`, `tanggal_peb`, `vgm`, `peb`, `created_at`, `locked`, `progress`) VALUES
	(20, NULL, 'SSLUSUCGPCAD1714', 'Non-DG', 'PT. LOKA FIBER INDONESIA JL. RAYA WENDIT BARAT NO.4 MANGLIAWAN, PAKIS-MALANG, JAWA TIMUR INDONESIA-65154, PH: +62 8121779980', 'TO THE ORDER OF ISLAMI BANK BANGLADESH PLC, (BUSINESS IDENTIFICATION NUMBER-00000124-002) KADAMTOLI BRANCH, CHATTOGRAM, RAHAT, CENTER, HOLDING NO 295, D.T. ROAD', 'SAME AS CONSIGNEE', 'SURABAYA, INDONESIA CY', 'SINAR SIGLI - 039N', 'SURABAYA, INDONESIA', 'CHATTOGRAM, BANGLADESH', 'CHATTOGRAM, BANGLADESH CY', 'CHATTOGRAM, BANGLADESH', 2300, 553, 65, '500 BALES', 'Prepaid', 'JUL, 04 2024', '2024-07-04', 23, '', '', 'SHIPPER&#039;S LOAD AND COUNT\\r\\n\\r\\n2 X 40&#039; HC CONTAINERS STC:\\r\\n581 BALES OR RAW COTTON\\r\\nPROFORMA INVOICE NO.:\\r\\n03EXP2024 (REVISED)\\r\\nDATE : 13.05.2024\\r\\nL/C NO.:0926240010401\\r\\nDATE:20.05.2024\\r\\nH.S CODE:85182954851\\r\\nTIN NO.:891033346427\\r\\nIRC NO.:260315110558922', NULL, 'CCCCC23910 HWQJ3055179', '3231233 0030222', 'FIVE HUNDRED BALES ONLY', '85182954851', '00231456', '232478741112', '2024-07-04', 'uploads/SSLUSUCGPCAD1714_duplicate/1-s2.0-S2772375523000795-main.pdf', 'uploads/SSLUSUCGPCAD1714_duplicate/16830-44504-1-PB.pdf', '2024-07-22 10:21:24', 1, 'Edited');
/*!40000 ALTER TABLE `shipping_info_corrections` ENABLE KEYS */;

-- Dumping structure for table docsys.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `kode_booking` varchar(50) DEFAULT NULL,
  `kode_bl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table docsys.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `role`, `kode_booking`, `kode_bl`) VALUES
	(1, 'SAI', '$2y$12$00mM48XPix0Xkeroi063t.HnzKhYfld721hQ5WO8YjJtRUPfGw9Yi', 'superadmin', NULL, NULL),
	(20, 'Riduan', '$2y$12$tEVEGm/NfGAu6777L4yzkedEujPAsvPS3.4u08F4AIZJ8jY/t.1.u', 'customer', 'SUDSUCCUCAD1360', 'SSLSUCCUCAD1360'),
	(23, 'Andi', '$2y$12$K.zRMuR2SCpcd4G1n8EPOeLlAa00GY2UFLeeCXIgZaa9GpyQx/0h.', 'customer', 'SUDUSUCGPCAD1714', 'SSLUSUCGPCAD1714'),
	(24, 'Kurnia', '$2y$12$tQ3hE0qUpv/C6N/x.jsK/efWlvLsIVuf1/ms0R5yn84/uYO.pAp1.', 'customer', 'SUDUSUCGPCAD1723', 'SSLUSUCGPCAD1723'),
	(28, 'Silkargo', '$2y$12$MDpeoJWty58mTT0pUVALuuIJeAcxiIg2mOf3J59u.a1oyYSolONre', 'admin', NULL, NULL),
	(29, 'Kogu', '$2y$12$lNWOQfctZU2Sm6asftv46.jLY7RR.tb/8tg3ekIDeaggbCXOABw4u', 'customer', 'BIGDSCCOOIY6632', 'SSLDSCCOOIY6632');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table docsys.vessels
CREATE TABLE IF NOT EXISTS `vessels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vessel_name` varchar(255) NOT NULL,
  `kode_booking` varchar(255) DEFAULT NULL,
  `voyage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- Dumping data for table docsys.vessels: ~4 rows (approximately)
/*!40000 ALTER TABLE `vessels` DISABLE KEYS */;
INSERT INTO `vessels` (`id`, `vessel_name`, `kode_booking`, `voyage`) VALUES
	(52, 'SEVILLIA', '', '932N'),
	(53, 'SINAR SIGLI', '', '040N'),
	(54, 'SINAR SIGLI', '', '039N'),
	(55, 'SEVILLIA', '', '933N');
/*!40000 ALTER TABLE `vessels` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
