-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_fm
CREATE DATABASE IF NOT EXISTS `db_fm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_fm`;

-- Dumping structure for table db_fm.bencana
DROP TABLE IF EXISTS `bencana`;
CREATE TABLE IF NOT EXISTS `bencana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_bencana` int(11) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `luas_ancaman` double DEFAULT NULL,
  `kep_pend_terpapar` double DEFAULT NULL,
  `jum_pend_terpapar` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_bencana` (`id_bencana`),
  KEY `id_kelurahan` (`id_kelurahan`),
  KEY `tahun` (`tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.bencana: ~5 rows (approximately)
DELETE FROM `bencana`;
/*!40000 ALTER TABLE `bencana` DISABLE KEYS */;
INSERT INTO `bencana` (`id`, `tahun`, `id_bencana`, `id_kelurahan`, `luas_ancaman`, `kep_pend_terpapar`, `jum_pend_terpapar`) VALUES
	(1, '2020', 1, 29, 0.08, 6.53, NULL),
	(3, '2020', 2, 29, NULL, NULL, NULL),
	(4, '2020', 3, 29, NULL, NULL, NULL),
	(5, '2020', 1, 36, NULL, NULL, NULL),
	(6, '2020', 1, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `bencana` ENABLE KEYS */;

-- Dumping structure for table db_fm.fuzzy_himpunan
DROP TABLE IF EXISTS `fuzzy_himpunan`;
CREATE TABLE IF NOT EXISTS `fuzzy_himpunan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable_id` int(11) DEFAULT NULL,
  `nilai` enum('Rendah','Sedang','Tinggi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` double DEFAULT '0',
  `max` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.fuzzy_himpunan: ~2 rows (approximately)
DELETE FROM `fuzzy_himpunan`;
/*!40000 ALTER TABLE `fuzzy_himpunan` DISABLE KEYS */;
INSERT INTO `fuzzy_himpunan` (`id`, `variable_id`, `nilai`, `min`, `max`) VALUES
	(1, 1, 'Rendah', 0, 4),
	(2, 2, 'Sedang', 1, 8),
	(3, 3, 'Tinggi', 0, 0);
/*!40000 ALTER TABLE `fuzzy_himpunan` ENABLE KEYS */;

-- Dumping structure for table db_fm.fuzzy_results
DROP TABLE IF EXISTS `fuzzy_results`;
CREATE TABLE IF NOT EXISTS `fuzzy_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.fuzzy_results: ~0 rows (approximately)
DELETE FROM `fuzzy_results`;
/*!40000 ALTER TABLE `fuzzy_results` DISABLE KEYS */;
INSERT INTO `fuzzy_results` (`id`, `tahun`, `id_kelurahan`) VALUES
	(1, '2020', 29);
/*!40000 ALTER TABLE `fuzzy_results` ENABLE KEYS */;

-- Dumping structure for table db_fm.fuzzy_result_details
DROP TABLE IF EXISTS `fuzzy_result_details`;
CREATE TABLE IF NOT EXISTS `fuzzy_result_details` (
  `fuzzy_id` int(11) DEFAULT NULL,
  `id_bencana` int(11) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `fuzzy_id` (`fuzzy_id`),
  KEY `id_bencana` (`id_bencana`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.fuzzy_result_details: ~4 rows (approximately)
DELETE FROM `fuzzy_result_details`;
/*!40000 ALTER TABLE `fuzzy_result_details` DISABLE KEYS */;
INSERT INTO `fuzzy_result_details` (`fuzzy_id`, `id_bencana`, `status`) VALUES
	(1, 5, 'Rendah'),
	(1, 4, 'Rendah'),
	(1, 1, 'Tinggi'),
	(1, 3, 'Sedang'),
	(1, 2, 'Tinggi');
/*!40000 ALTER TABLE `fuzzy_result_details` ENABLE KEYS */;

-- Dumping structure for table db_fm.fuzzy_variables
DROP TABLE IF EXISTS `fuzzy_variables`;
CREATE TABLE IF NOT EXISTS `fuzzy_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.fuzzy_variables: ~2 rows (approximately)
DELETE FROM `fuzzy_variables`;
/*!40000 ALTER TABLE `fuzzy_variables` DISABLE KEYS */;
INSERT INTO `fuzzy_variables` (`id`, `name`) VALUES
	(1, 'Bencana'),
	(2, 'Penduduk Terpapar');
/*!40000 ALTER TABLE `fuzzy_variables` ENABLE KEYS */;

-- Dumping structure for table db_fm.m_bencana
DROP TABLE IF EXISTS `m_bencana`;
CREATE TABLE IF NOT EXISTS `m_bencana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.m_bencana: ~4 rows (approximately)
DELETE FROM `m_bencana`;
/*!40000 ALTER TABLE `m_bencana` DISABLE KEYS */;
INSERT INTO `m_bencana` (`id`, `nama`) VALUES
	(1, 'Banjir'),
	(2, 'Cuaca Ekstrim'),
	(3, 'Gempa Bumi'),
	(4, 'Kekeringan'),
	(5, 'Tanah Longsor');
/*!40000 ALTER TABLE `m_bencana` ENABLE KEYS */;

-- Dumping structure for table db_fm.m_kecamatan
DROP TABLE IF EXISTS `m_kecamatan`;
CREATE TABLE IF NOT EXISTS `m_kecamatan` (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.m_kecamatan: ~2 rows (approximately)
DELETE FROM `m_kecamatan`;
/*!40000 ALTER TABLE `m_kecamatan` DISABLE KEYS */;
INSERT INTO `m_kecamatan` (`id_kecamatan`, `nama`) VALUES
	(1, 'Kecamatan Mojoroto'),
	(2, 'Kecamatan Kota'),
	(3, 'Kecamatan Pesantren');
/*!40000 ALTER TABLE `m_kecamatan` ENABLE KEYS */;

-- Dumping structure for table db_fm.m_kelurahan
DROP TABLE IF EXISTS `m_kelurahan`;
CREATE TABLE IF NOT EXISTS `m_kelurahan` (
  `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(11) DEFAULT NULL,
  `nama` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas` double DEFAULT NULL COMMENT 'km',
  `lat` double DEFAULT NULL,
  `long` double DEFAULT NULL,
  `coordinate` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id_kelurahan`),
  KEY `id_kecamatan` (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.m_kelurahan: ~46 rows (approximately)
DELETE FROM `m_kelurahan`;
/*!40000 ALTER TABLE `m_kelurahan` DISABLE KEYS */;
INSERT INTO `m_kelurahan` (`id_kelurahan`, `id_kecamatan`, `nama`, `luas`, `lat`, `long`, `coordinate`) VALUES
	(1, 1, 'Pojok', 5.153, -7.8147029, 111.9634142, '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"stroke":"#555555","stroke-width":2,"stroke-opacity":1,"fill":"#555555","fill-opacity":0.5},"geometry":{"type":"Polygon","coordinates":[[[111.98801994323733,-7.813533713148333],[111.9879770278931,-7.812874700558924],[111.98668956756593,-7.812895959045777],[111.98542356491092,-7.8125558231261385],[111.98475837707522,-7.81183303337704],[111.98441505432132,-7.810429967351968],[111.98392152786256,-7.809494587383599],[111.98327779769897,-7.809048155296714],[111.98244094848633,-7.8083678769136355],[111.97952270507815,-7.80894186187234],[111.97737693786621,-7.807687597422961],[111.97600364685061,-7.80562549345044],[111.97471618652342,-7.806837246502183],[111.97239875793456,-7.807092351960118],[111.97162628173828,-7.809303259404757],[111.97334289550781,-7.808708016243618],[111.97463035583496,-7.809388294072834],[111.97214126586914,-7.811684223567514],[111.96965217590332,-7.813214836218813],[111.97025299072266,-7.814660409682149],[111.96879386901854,-7.817041343297891],[111.96407318115234,-7.816871277061468],[111.96055412292479,-7.817041343297891],[111.95815086364746,-7.816786243917258],[111.95634841918945,-7.817126376390131],[111.95926666259764,-7.819507295937695],[111.95883750915527,-7.820952847605745],[111.95986747741699,-7.821803169776357],[111.96072578430176,-7.823333745314806],[111.96355819702148,-7.823333745314819],[111.96630477905273,-7.824524189071976],[111.9741153717041,-7.824524189071976],[111.9752311706543,-7.822398394264358],[111.97626113891603,-7.821633105480924],[111.97720527648926,-7.8214630411161306],[111.9796085357666,-7.821888201898094],[111.98235511779785,-7.820782782963606],[111.98347091674805,-7.819932458712962],[111.98370695114137,-7.819953716840362],[111.98467254638673,-7.820102523701756],[111.98501586914068,-7.8187420018504055],[111.98547720909123,-7.817126376390117],[111.98592782020572,-7.815532003028005],[111.98645353317262,-7.814862364399876],[111.98785901069645,-7.81423524153603],[111.98801994323733,-7.813533713148333]]]}}]}'),
	(2, 1, 'Campurejo', 1.409, -7.8213929, 111.9776156, NULL),
	(3, 1, 'Tamanan', 1.077, -7.8319885, 111.9789158, NULL),
	(4, 1, 'Banjarmlati', 0.954, -7.8364838, 111.9942186, NULL),
	(5, 1, 'Bandar Kidul', 1.299, -7.8287519, 111.9947831, NULL),
	(6, 1, 'Lirboyo', 1.037, -7.8219404, 111.9875506, NULL),
	(7, 1, 'Bandar Lor', 1.113, -7.8193884, 111.9967401, NULL),
	(8, 1, 'Mojoroto', 2.13, 7.8067896, 111.9471999, NULL),
	(9, 1, 'Sukorame', 4.302, -7.8041199, 111.9764482, NULL),
	(10, 1, 'Bujel', 1.59, -7.8020177, 111.9805372, NULL),
	(11, 1, 'Ngampel', 1.468, -7.7956635, 111.9950276, NULL),
	(12, 1, 'Gayam', 1.296, -7.789659, 111.9765507, NULL),
	(13, 1, 'Mrican', 1.109, -7.785485, 111.9953551, NULL),
	(14, 1, 'Dermo', 0.657, -7.776957, 111.9944361, NULL),
	(15, 2, 'Manisrenggo', 1.764, -7.8528874, 112.0000432, NULL),
	(16, 2, 'Rejomulyo', 1.67, -7.8559764, 112.0135947, NULL),
	(17, 2, 'Ngronggo', 2.585, -7.8434304, 112.0118592, NULL),
	(18, 2, 'Kaliombo', 0.958, -7.8338395, 112.0127606, NULL),
	(19, 2, 'Kampungdalem', 0.332, -7.8265535, 112.0113433, NULL),
	(20, 2, 'Setonopande', 0.383, -7.8240365, 112.0127888, NULL),
	(21, 2, 'Ringinanom', 0.05, -7.822169, 112.0092462, NULL),
	(22, 2, 'Pakelan', 0.214, -7.8171645, 112.0068816, NULL),
	(23, 2, 'Setonogedong', 0.059, -7.8167804, 112.0111042, NULL),
	(24, 2, 'Kemasan', 0.228, -7.818918, 112.0138383, NULL),
	(25, 2, 'Jagalan', 0.043, -7.8207049, 112.0134309, NULL),
	(26, 2, 'Banjaran', 1.209, -7.8175133, 112.0230906, NULL),
	(27, 2, 'Ngadirejo', 1.47, -7.8107375, 112.0209237, NULL),
	(28, 2, 'Dandangan', 1.1, -7.8080724, 112.0120147, NULL),
	(29, 2, 'Balowerti', 0.83, -7.8067817, 112.0067677, NULL),
	(30, 2, 'Pocanan', 0.214, -7.8126155, 112.0095544, NULL),
	(31, 2, 'Semampir', 1.791, -7.8004249, 112.0036392, NULL),
	(32, 3, 'Blabak', 3.354, -7.8784027, 112.0193351, NULL),
	(33, 3, 'Bawang', 3.449, -7.8618311, 112.0530077, NULL),
	(34, 3, 'Betet', 1.691, -7.8516151, 112.0340143, NULL),
	(35, 3, 'Tosaren', 1.361, -7.8437189, 112.0181998, NULL),
	(36, 3, 'Banaran', 0.974, -7.8341272, 112.0332002, NULL),
	(37, 3, 'Ngletih', 1.237, -7.8471835, 112.0545366, NULL),
	(38, 3, 'Tempurejo', 1.864, -7.8428354, 112.0603746, NULL),
	(39, 3, 'Ketami', 1.894, -7.838079, 112.0586436, NULL),
	(40, 3, 'Pesantren', 1.356, -7.8468841, 112.0315204, NULL),
	(41, 3, 'Bangsal', 1.029, -7.8285488, 112.0345286, NULL),
	(42, 3, 'Burengan', 1.283, -7.823018, 112.0298127, NULL),
	(43, 3, 'Tinalan', 0.926, -7.8405127, 112.0215983, NULL),
	(44, 3, 'Pakunden', 1.024, -7.8381259, 112.0229733, NULL),
	(45, 3, 'Singonegaran', 0.99, -7.8331075, 112.0165802, NULL),
	(46, 3, 'Jamsaren', 1.471, -7.8337409, 112.0259812, NULL);
/*!40000 ALTER TABLE `m_kelurahan` ENABLE KEYS */;

-- Dumping structure for table db_fm.pemetaan_bencana
DROP TABLE IF EXISTS `pemetaan_bencana`;
CREATE TABLE IF NOT EXISTS `pemetaan_bencana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `kelurahan_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.pemetaan_bencana: ~0 rows (approximately)
DELETE FROM `pemetaan_bencana`;
/*!40000 ALTER TABLE `pemetaan_bencana` DISABLE KEYS */;
INSERT INTO `pemetaan_bencana` (`id`, `year`, `kelurahan_id`, `created_at`, `updated_at`) VALUES
	(1, '2020', 1, '2022-06-21 09:07:37', NULL),
	(2, '2020', 2, '2022-06-21 09:07:37', NULL),
	(3, '2020', 3, '2022-06-21 09:07:37', NULL),
	(4, '2020', 4, '2022-06-21 09:07:37', NULL),
	(5, '2020', 5, '2022-06-21 09:07:37', NULL),
	(6, '2020', 6, '2022-06-21 09:07:37', NULL),
	(7, '2020', 7, '2022-06-21 09:07:37', NULL),
	(8, '2020', 8, '2022-06-21 09:07:37', NULL),
	(9, '2020', 9, '2022-06-21 09:07:37', NULL),
	(10, '2020', 10, '2022-06-21 09:07:37', NULL),
	(11, '2020', 11, '2022-06-21 09:07:37', NULL),
	(12, '2020', 12, '2022-06-21 09:07:37', NULL),
	(13, '2020', 13, '2022-06-21 09:07:37', NULL),
	(14, '2020', 14, '2022-06-21 09:07:37', NULL),
	(15, '2020', 15, '2022-06-21 09:07:37', NULL),
	(16, '2020', 16, '2022-06-21 09:07:37', NULL),
	(17, '2020', 17, '2022-06-21 09:07:37', NULL),
	(18, '2020', 18, '2022-06-21 09:07:37', NULL),
	(19, '2020', 19, '2022-06-21 09:07:37', NULL),
	(20, '2020', 20, '2022-06-21 09:07:37', NULL),
	(21, '2020', 21, '2022-06-21 09:07:37', NULL),
	(22, '2020', 22, '2022-06-21 09:07:37', NULL),
	(23, '2020', 23, '2022-06-21 09:07:37', NULL),
	(24, '2020', 24, '2022-06-21 09:07:37', NULL),
	(25, '2020', 25, '2022-06-21 09:07:37', NULL),
	(26, '2020', 26, '2022-06-21 09:07:37', NULL),
	(27, '2020', 27, '2022-06-21 09:07:37', NULL),
	(28, '2020', 28, '2022-06-21 09:07:37', NULL),
	(29, '2020', 29, '2022-06-21 09:07:37', NULL),
	(30, '2020', 30, '2022-06-21 09:07:37', NULL),
	(31, '2020', 31, '2022-06-21 09:07:37', NULL),
	(32, '2020', 32, '2022-06-21 09:07:37', NULL),
	(33, '2020', 33, '2022-06-21 09:07:37', NULL),
	(34, '2020', 34, '2022-06-21 09:07:37', NULL),
	(35, '2020', 35, '2022-06-21 09:07:37', NULL),
	(36, '2020', 36, '2022-06-21 09:07:37', NULL),
	(37, '2020', 37, '2022-06-21 09:07:37', NULL),
	(38, '2020', 38, '2022-06-21 09:07:37', NULL),
	(39, '2020', 39, '2022-06-21 09:07:37', NULL),
	(40, '2020', 40, '2022-06-21 09:07:37', NULL),
	(41, '2020', 41, '2022-06-21 09:07:37', NULL),
	(42, '2020', 42, '2022-06-21 09:07:37', NULL),
	(43, '2020', 43, '2022-06-21 09:07:37', NULL),
	(44, '2020', 44, '2022-06-21 09:07:38', NULL),
	(45, '2020', 45, '2022-06-21 09:07:38', NULL),
	(46, '2020', 46, '2022-06-21 09:07:38', NULL);
/*!40000 ALTER TABLE `pemetaan_bencana` ENABLE KEYS */;

-- Dumping structure for table db_fm.pemetaan_bencana_detail
DROP TABLE IF EXISTS `pemetaan_bencana_detail`;
CREATE TABLE IF NOT EXISTS `pemetaan_bencana_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemetaan_id` int(11) DEFAULT NULL,
  `bencana_id` int(11) DEFAULT NULL,
  `bencana` float NOT NULL DEFAULT '0',
  `populasi` float NOT NULL DEFAULT '0',
  `bangunan` float NOT NULL DEFAULT '0',
  `faskes` float NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemetaan_id` (`pemetaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.pemetaan_bencana_detail: ~0 rows (approximately)
DELETE FROM `pemetaan_bencana_detail`;
/*!40000 ALTER TABLE `pemetaan_bencana_detail` DISABLE KEYS */;
INSERT INTO `pemetaan_bencana_detail` (`id`, `pemetaan_id`, `bencana_id`, `bencana`, `populasi`, `bangunan`, `faskes`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 6, 1960, 4924, 103, '2022-06-21 09:07:37', NULL),
	(2, 1, 2, 5, 3391, 1752, 49, '2022-06-21 09:07:37', NULL),
	(3, 1, 3, 5, 4608, 4889, 149, '2022-06-21 09:07:37', NULL),
	(4, 1, 4, 1, 1590, 3818, 106, '2022-06-21 09:07:37', NULL),
	(5, 1, 5, 3, 4466, 4793, 93, '2022-06-21 09:07:37', NULL),
	(6, 2, 1, 10, 1358, 3946, 85, '2022-06-21 09:07:37', NULL),
	(7, 2, 2, 2, 3008, 2019, 33, '2022-06-21 09:07:37', NULL),
	(8, 2, 3, 9, 2448, 2095, 125, '2022-06-21 09:07:37', NULL),
	(9, 2, 4, 7, 3745, 2803, 185, '2022-06-21 09:07:37', NULL),
	(10, 2, 5, 6, 2230, 2864, 96, '2022-06-21 09:07:37', NULL),
	(11, 3, 1, 4, 2945, 1907, 176, '2022-06-21 09:07:37', NULL),
	(12, 3, 2, 1, 3511, 1701, 199, '2022-06-21 09:07:37', NULL),
	(13, 3, 3, 9, 1932, 3378, 23, '2022-06-21 09:07:37', NULL),
	(14, 3, 4, 7, 2620, 3976, 41, '2022-06-21 09:07:37', NULL),
	(15, 3, 5, 1, 3919, 3846, 36, '2022-06-21 09:07:37', NULL),
	(16, 4, 1, 9, 2037, 3559, 164, '2022-06-21 09:07:37', NULL),
	(17, 4, 2, 1, 2941, 1460, 123, '2022-06-21 09:07:37', NULL),
	(18, 4, 3, 0, 2462, 3980, 29, '2022-06-21 09:07:37', NULL),
	(19, 4, 4, 2, 4664, 4714, 182, '2022-06-21 09:07:37', NULL),
	(20, 4, 5, 6, 3041, 3810, 34, '2022-06-21 09:07:37', NULL),
	(21, 5, 1, 7, 2739, 2324, 128, '2022-06-21 09:07:37', NULL),
	(22, 5, 2, 0, 4285, 2402, 153, '2022-06-21 09:07:37', NULL),
	(23, 5, 3, 10, 1855, 4431, 156, '2022-06-21 09:07:37', NULL),
	(24, 5, 4, 0, 3021, 1770, 129, '2022-06-21 09:07:37', NULL),
	(25, 5, 5, 8, 3589, 1686, 22, '2022-06-21 09:07:37', NULL),
	(26, 6, 1, 8, 4476, 4550, 43, '2022-06-21 09:07:37', NULL),
	(27, 6, 2, 9, 4017, 2468, 199, '2022-06-21 09:07:37', NULL),
	(28, 6, 3, 4, 4133, 2822, 178, '2022-06-21 09:07:37', NULL),
	(29, 6, 4, 6, 2468, 4761, 26, '2022-06-21 09:07:37', NULL),
	(30, 6, 5, 4, 2817, 4408, 172, '2022-06-21 09:07:37', NULL),
	(31, 7, 1, 1, 3205, 1712, 98, '2022-06-21 09:07:37', NULL),
	(32, 7, 2, 2, 2782, 1331, 54, '2022-06-21 09:07:37', NULL),
	(33, 7, 3, 2, 1757, 1617, 197, '2022-06-21 09:07:37', NULL),
	(34, 7, 4, 0, 4192, 2131, 160, '2022-06-21 09:07:37', NULL),
	(35, 7, 5, 0, 1028, 4117, 38, '2022-06-21 09:07:37', NULL),
	(36, 8, 1, 5, 2352, 3693, 97, '2022-06-21 09:07:37', NULL),
	(37, 8, 2, 2, 3040, 2288, 174, '2022-06-21 09:07:37', NULL),
	(38, 8, 3, 8, 2136, 3780, 177, '2022-06-21 09:07:37', NULL),
	(39, 8, 4, 0, 3788, 4846, 190, '2022-06-21 09:07:37', NULL),
	(40, 8, 5, 9, 2779, 2170, 149, '2022-06-21 09:07:37', NULL),
	(41, 9, 1, 0, 3652, 3047, 200, '2022-06-21 09:07:37', NULL),
	(42, 9, 2, 9, 2212, 4439, 54, '2022-06-21 09:07:37', NULL),
	(43, 9, 3, 4, 1295, 1434, 76, '2022-06-21 09:07:37', NULL),
	(44, 9, 4, 10, 4457, 1849, 164, '2022-06-21 09:07:37', NULL),
	(45, 9, 5, 8, 3933, 2570, 47, '2022-06-21 09:07:37', NULL),
	(46, 10, 1, 5, 1457, 2647, 65, '2022-06-21 09:07:37', NULL),
	(47, 10, 2, 3, 4144, 2229, 89, '2022-06-21 09:07:37', NULL),
	(48, 10, 3, 6, 1603, 1533, 163, '2022-06-21 09:07:37', NULL),
	(49, 10, 4, 3, 4480, 2285, 99, '2022-06-21 09:07:37', NULL),
	(50, 10, 5, 10, 1294, 4418, 187, '2022-06-21 09:07:37', NULL),
	(51, 11, 1, 0, 2835, 1701, 38, '2022-06-21 09:07:37', NULL),
	(52, 11, 2, 1, 4979, 3279, 45, '2022-06-21 09:07:37', NULL),
	(53, 11, 3, 6, 1647, 1573, 167, '2022-06-21 09:07:37', NULL),
	(54, 11, 4, 4, 1216, 2406, 71, '2022-06-21 09:07:37', NULL),
	(55, 11, 5, 4, 2029, 3407, 81, '2022-06-21 09:07:37', NULL),
	(56, 12, 1, 6, 2947, 1088, 135, '2022-06-21 09:07:37', NULL),
	(57, 12, 2, 1, 4545, 1888, 102, '2022-06-21 09:07:37', NULL),
	(58, 12, 3, 2, 4048, 3715, 15, '2022-06-21 09:07:37', NULL),
	(59, 12, 4, 0, 1328, 4171, 36, '2022-06-21 09:07:37', NULL),
	(60, 12, 5, 5, 3147, 3200, 196, '2022-06-21 09:07:37', NULL),
	(61, 13, 1, 2, 2267, 3384, 85, '2022-06-21 09:07:37', NULL),
	(62, 13, 2, 6, 3504, 4081, 88, '2022-06-21 09:07:37', NULL),
	(63, 13, 3, 8, 1045, 4301, 104, '2022-06-21 09:07:37', NULL),
	(64, 13, 4, 8, 2417, 4179, 144, '2022-06-21 09:07:37', NULL),
	(65, 13, 5, 1, 2478, 2728, 63, '2022-06-21 09:07:37', NULL),
	(66, 14, 1, 9, 1778, 1867, 177, '2022-06-21 09:07:37', NULL),
	(67, 14, 2, 5, 3598, 2086, 66, '2022-06-21 09:07:37', NULL),
	(68, 14, 3, 0, 3383, 4650, 164, '2022-06-21 09:07:37', NULL),
	(69, 14, 4, 1, 1599, 2416, 199, '2022-06-21 09:07:37', NULL),
	(70, 14, 5, 8, 4669, 3209, 69, '2022-06-21 09:07:37', NULL),
	(71, 15, 1, 8, 1879, 4863, 183, '2022-06-21 09:07:37', NULL),
	(72, 15, 2, 1, 4309, 4161, 56, '2022-06-21 09:07:37', NULL),
	(73, 15, 3, 9, 2807, 4008, 70, '2022-06-21 09:07:37', NULL),
	(74, 15, 4, 3, 2367, 2748, 57, '2022-06-21 09:07:37', NULL),
	(75, 15, 5, 6, 2108, 2040, 147, '2022-06-21 09:07:37', NULL),
	(76, 16, 1, 6, 3748, 4744, 120, '2022-06-21 09:07:37', NULL),
	(77, 16, 2, 10, 3085, 2276, 136, '2022-06-21 09:07:37', NULL),
	(78, 16, 3, 8, 1458, 2536, 48, '2022-06-21 09:07:37', NULL),
	(79, 16, 4, 5, 4350, 3783, 42, '2022-06-21 09:07:37', NULL),
	(80, 16, 5, 1, 1263, 4621, 61, '2022-06-21 09:07:37', NULL),
	(81, 17, 1, 5, 2167, 2901, 37, '2022-06-21 09:07:37', NULL),
	(82, 17, 2, 8, 2038, 4275, 54, '2022-06-21 09:07:37', NULL),
	(83, 17, 3, 7, 4657, 3964, 128, '2022-06-21 09:07:37', NULL),
	(84, 17, 4, 1, 1514, 2671, 82, '2022-06-21 09:07:37', NULL),
	(85, 17, 5, 2, 4510, 2725, 158, '2022-06-21 09:07:37', NULL),
	(86, 18, 1, 9, 1625, 1970, 125, '2022-06-21 09:07:37', NULL),
	(87, 18, 2, 4, 3618, 4317, 25, '2022-06-21 09:07:37', NULL),
	(88, 18, 3, 2, 4807, 1624, 13, '2022-06-21 09:07:37', NULL),
	(89, 18, 4, 1, 4927, 4004, 153, '2022-06-21 09:07:37', NULL),
	(90, 18, 5, 5, 3210, 4956, 23, '2022-06-21 09:07:37', NULL),
	(91, 19, 1, 6, 3044, 2221, 27, '2022-06-21 09:07:37', NULL),
	(92, 19, 2, 1, 3269, 4271, 150, '2022-06-21 09:07:37', NULL),
	(93, 19, 3, 3, 1162, 4935, 97, '2022-06-21 09:07:37', NULL),
	(94, 19, 4, 7, 4959, 3934, 193, '2022-06-21 09:07:37', NULL),
	(95, 19, 5, 7, 2268, 1244, 80, '2022-06-21 09:07:37', NULL),
	(96, 20, 1, 6, 1400, 2168, 26, '2022-06-21 09:07:37', NULL),
	(97, 20, 2, 3, 4999, 4771, 185, '2022-06-21 09:07:37', NULL),
	(98, 20, 3, 7, 2848, 4475, 72, '2022-06-21 09:07:37', NULL),
	(99, 20, 4, 10, 2301, 2766, 97, '2022-06-21 09:07:37', NULL),
	(100, 20, 5, 7, 4690, 2209, 139, '2022-06-21 09:07:37', NULL),
	(101, 21, 1, 8, 2735, 3354, 118, '2022-06-21 09:07:37', NULL),
	(102, 21, 2, 2, 1150, 2407, 32, '2022-06-21 09:07:37', NULL),
	(103, 21, 3, 9, 3446, 3196, 21, '2022-06-21 09:07:37', NULL),
	(104, 21, 4, 7, 4251, 1448, 21, '2022-06-21 09:07:37', NULL),
	(105, 21, 5, 3, 3260, 4389, 182, '2022-06-21 09:07:37', NULL),
	(106, 22, 1, 2, 1242, 2479, 51, '2022-06-21 09:07:37', NULL),
	(107, 22, 2, 4, 3416, 3626, 131, '2022-06-21 09:07:37', NULL),
	(108, 22, 3, 7, 4262, 1263, 57, '2022-06-21 09:07:37', NULL),
	(109, 22, 4, 8, 3569, 2109, 24, '2022-06-21 09:07:37', NULL),
	(110, 22, 5, 0, 1290, 2935, 197, '2022-06-21 09:07:37', NULL),
	(111, 23, 1, 3, 4808, 3381, 81, '2022-06-21 09:07:37', NULL),
	(112, 23, 2, 0, 4521, 4987, 164, '2022-06-21 09:07:37', NULL),
	(113, 23, 3, 7, 4822, 2129, 99, '2022-06-21 09:07:37', NULL),
	(114, 23, 4, 0, 1433, 3845, 136, '2022-06-21 09:07:37', NULL),
	(115, 23, 5, 1, 3584, 3260, 141, '2022-06-21 09:07:37', NULL),
	(116, 24, 1, 1, 1885, 2454, 65, '2022-06-21 09:07:37', NULL),
	(117, 24, 2, 6, 4584, 4604, 91, '2022-06-21 09:07:37', NULL),
	(118, 24, 3, 6, 1787, 2699, 12, '2022-06-21 09:07:37', NULL),
	(119, 24, 4, 1, 3592, 1520, 79, '2022-06-21 09:07:37', NULL),
	(120, 24, 5, 1, 4067, 1318, 94, '2022-06-21 09:07:37', NULL),
	(121, 25, 1, 0, 1186, 2617, 107, '2022-06-21 09:07:37', NULL),
	(122, 25, 2, 0, 4068, 4901, 128, '2022-06-21 09:07:37', NULL),
	(123, 25, 3, 1, 2128, 2035, 154, '2022-06-21 09:07:37', NULL),
	(124, 25, 4, 6, 2075, 4286, 12, '2022-06-21 09:07:37', NULL),
	(125, 25, 5, 1, 3342, 4885, 27, '2022-06-21 09:07:37', NULL),
	(126, 26, 1, 1, 1788, 4894, 49, '2022-06-21 09:07:37', NULL),
	(127, 26, 2, 1, 1398, 2101, 174, '2022-06-21 09:07:37', NULL),
	(128, 26, 3, 8, 4060, 4820, 132, '2022-06-21 09:07:37', NULL),
	(129, 26, 4, 5, 4441, 1553, 23, '2022-06-21 09:07:37', NULL),
	(130, 26, 5, 2, 3634, 3669, 147, '2022-06-21 09:07:37', NULL),
	(131, 27, 1, 0, 4509, 2992, 173, '2022-06-21 09:07:37', NULL),
	(132, 27, 2, 6, 4224, 2240, 59, '2022-06-21 09:07:37', NULL),
	(133, 27, 3, 8, 2233, 4815, 36, '2022-06-21 09:07:37', NULL),
	(134, 27, 4, 2, 4844, 3368, 186, '2022-06-21 09:07:37', NULL),
	(135, 27, 5, 3, 3579, 2649, 180, '2022-06-21 09:07:37', NULL),
	(136, 28, 1, 10, 2787, 1381, 134, '2022-06-21 09:07:37', NULL),
	(137, 28, 2, 10, 3877, 1654, 73, '2022-06-21 09:07:37', NULL),
	(138, 28, 3, 10, 3467, 4515, 102, '2022-06-21 09:07:37', NULL),
	(139, 28, 4, 6, 2749, 4055, 37, '2022-06-21 09:07:37', NULL),
	(140, 28, 5, 9, 2533, 1803, 127, '2022-06-21 09:07:37', NULL),
	(141, 29, 1, 5, 2869, 3057, 139, '2022-06-21 09:07:37', NULL),
	(142, 29, 2, 0, 4786, 4348, 145, '2022-06-21 09:07:37', NULL),
	(143, 29, 3, 9, 2938, 1202, 56, '2022-06-21 09:07:37', NULL),
	(144, 29, 4, 6, 3550, 3334, 78, '2022-06-21 09:07:37', NULL),
	(145, 29, 5, 7, 2780, 2866, 149, '2022-06-21 09:07:37', NULL),
	(146, 30, 1, 10, 2884, 4440, 24, '2022-06-21 09:07:37', NULL),
	(147, 30, 2, 5, 2051, 1420, 42, '2022-06-21 09:07:37', NULL),
	(148, 30, 3, 7, 3527, 1403, 193, '2022-06-21 09:07:37', NULL),
	(149, 30, 4, 8, 2192, 1096, 172, '2022-06-21 09:07:37', NULL),
	(150, 30, 5, 7, 4499, 4548, 87, '2022-06-21 09:07:37', NULL),
	(151, 31, 1, 3, 2808, 1884, 152, '2022-06-21 09:07:37', NULL),
	(152, 31, 2, 3, 4727, 2433, 92, '2022-06-21 09:07:37', NULL),
	(153, 31, 3, 2, 1084, 2137, 106, '2022-06-21 09:07:37', NULL),
	(154, 31, 4, 2, 2978, 2302, 148, '2022-06-21 09:07:37', NULL),
	(155, 31, 5, 8, 3212, 4107, 197, '2022-06-21 09:07:37', NULL),
	(156, 32, 1, 2, 2416, 1298, 118, '2022-06-21 09:07:37', NULL),
	(157, 32, 2, 5, 4101, 2035, 88, '2022-06-21 09:07:37', NULL),
	(158, 32, 3, 9, 1755, 4812, 68, '2022-06-21 09:07:37', NULL),
	(159, 32, 4, 6, 2683, 3497, 96, '2022-06-21 09:07:37', NULL),
	(160, 32, 5, 2, 4516, 1703, 196, '2022-06-21 09:07:37', NULL),
	(161, 33, 1, 1, 4457, 3356, 12, '2022-06-21 09:07:37', NULL),
	(162, 33, 2, 6, 4787, 2104, 182, '2022-06-21 09:07:37', NULL),
	(163, 33, 3, 7, 3703, 3095, 178, '2022-06-21 09:07:37', NULL),
	(164, 33, 4, 10, 4290, 3065, 60, '2022-06-21 09:07:37', NULL),
	(165, 33, 5, 5, 2055, 3641, 128, '2022-06-21 09:07:37', NULL),
	(166, 34, 1, 10, 2471, 3523, 83, '2022-06-21 09:07:37', NULL),
	(167, 34, 2, 5, 3762, 2541, 36, '2022-06-21 09:07:37', NULL),
	(168, 34, 3, 10, 4648, 3066, 13, '2022-06-21 09:07:37', NULL),
	(169, 34, 4, 0, 3930, 4589, 65, '2022-06-21 09:07:37', NULL),
	(170, 34, 5, 5, 2323, 2618, 48, '2022-06-21 09:07:37', NULL),
	(171, 35, 1, 7, 2309, 1434, 32, '2022-06-21 09:07:37', NULL),
	(172, 35, 2, 5, 4925, 1058, 48, '2022-06-21 09:07:37', NULL),
	(173, 35, 3, 3, 3675, 4086, 48, '2022-06-21 09:07:37', NULL),
	(174, 35, 4, 6, 1390, 3296, 117, '2022-06-21 09:07:37', NULL),
	(175, 35, 5, 5, 1353, 2108, 94, '2022-06-21 09:07:37', NULL),
	(176, 36, 1, 7, 1891, 4876, 128, '2022-06-21 09:07:37', NULL),
	(177, 36, 2, 1, 3489, 4703, 61, '2022-06-21 09:07:37', NULL),
	(178, 36, 3, 10, 3459, 2444, 99, '2022-06-21 09:07:37', NULL),
	(179, 36, 4, 8, 4063, 3956, 82, '2022-06-21 09:07:37', NULL),
	(180, 36, 5, 9, 2758, 1466, 123, '2022-06-21 09:07:37', NULL),
	(181, 37, 1, 3, 3697, 2607, 32, '2022-06-21 09:07:37', NULL),
	(182, 37, 2, 9, 3227, 1227, 39, '2022-06-21 09:07:37', NULL),
	(183, 37, 3, 8, 4902, 1278, 10, '2022-06-21 09:07:37', NULL),
	(184, 37, 4, 1, 4410, 1671, 76, '2022-06-21 09:07:37', NULL),
	(185, 37, 5, 3, 4971, 4828, 68, '2022-06-21 09:07:37', NULL),
	(186, 38, 1, 4, 3271, 4963, 191, '2022-06-21 09:07:37', NULL),
	(187, 38, 2, 9, 1566, 2612, 134, '2022-06-21 09:07:37', NULL),
	(188, 38, 3, 5, 1115, 3245, 31, '2022-06-21 09:07:37', NULL),
	(189, 38, 4, 4, 1355, 1064, 97, '2022-06-21 09:07:37', NULL),
	(190, 38, 5, 5, 4409, 2928, 91, '2022-06-21 09:07:37', NULL),
	(191, 39, 1, 8, 2775, 2236, 67, '2022-06-21 09:07:37', NULL),
	(192, 39, 2, 7, 3909, 4593, 157, '2022-06-21 09:07:37', NULL),
	(193, 39, 3, 2, 3651, 2684, 178, '2022-06-21 09:07:37', NULL),
	(194, 39, 4, 4, 3680, 3910, 117, '2022-06-21 09:07:37', NULL),
	(195, 39, 5, 2, 3929, 3266, 159, '2022-06-21 09:07:37', NULL),
	(196, 40, 1, 1, 3219, 2571, 165, '2022-06-21 09:07:37', NULL),
	(197, 40, 2, 0, 2450, 4809, 11, '2022-06-21 09:07:37', NULL),
	(198, 40, 3, 7, 1203, 1773, 43, '2022-06-21 09:07:37', NULL),
	(199, 40, 4, 9, 3714, 2493, 149, '2022-06-21 09:07:37', NULL),
	(200, 40, 5, 6, 4679, 4298, 34, '2022-06-21 09:07:37', NULL),
	(201, 41, 1, 2, 4226, 2729, 133, '2022-06-21 09:07:37', NULL),
	(202, 41, 2, 3, 3828, 4379, 147, '2022-06-21 09:07:37', NULL),
	(203, 41, 3, 10, 1109, 2872, 197, '2022-06-21 09:07:37', NULL),
	(204, 41, 4, 5, 4508, 1800, 181, '2022-06-21 09:07:37', NULL),
	(205, 41, 5, 5, 4321, 1423, 163, '2022-06-21 09:07:37', NULL),
	(206, 42, 1, 5, 3989, 4891, 37, '2022-06-21 09:07:37', NULL),
	(207, 42, 2, 5, 2095, 4942, 108, '2022-06-21 09:07:37', NULL),
	(208, 42, 3, 0, 4830, 3087, 193, '2022-06-21 09:07:37', NULL),
	(209, 42, 4, 5, 2944, 2764, 42, '2022-06-21 09:07:37', NULL),
	(210, 42, 5, 3, 1028, 1868, 49, '2022-06-21 09:07:37', NULL),
	(211, 43, 1, 3, 4744, 3502, 55, '2022-06-21 09:07:37', NULL),
	(212, 43, 2, 4, 4336, 4841, 75, '2022-06-21 09:07:38', NULL),
	(213, 43, 3, 2, 1646, 3487, 190, '2022-06-21 09:07:38', NULL),
	(214, 43, 4, 5, 2275, 3119, 77, '2022-06-21 09:07:38', NULL),
	(215, 43, 5, 1, 4032, 2132, 61, '2022-06-21 09:07:38', NULL),
	(216, 44, 1, 10, 1669, 1778, 14, '2022-06-21 09:07:38', NULL),
	(217, 44, 2, 6, 4640, 4223, 47, '2022-06-21 09:07:38', NULL),
	(218, 44, 3, 10, 3436, 2843, 48, '2022-06-21 09:07:38', NULL),
	(219, 44, 4, 1, 2468, 1578, 94, '2022-06-21 09:07:38', NULL),
	(220, 44, 5, 5, 4816, 2157, 61, '2022-06-21 09:07:38', NULL),
	(221, 45, 1, 0, 4682, 3595, 14, '2022-06-21 09:07:38', NULL),
	(222, 45, 2, 4, 2817, 3411, 143, '2022-06-21 09:07:38', NULL),
	(223, 45, 3, 5, 4111, 3691, 53, '2022-06-21 09:07:38', NULL),
	(224, 45, 4, 5, 1736, 4283, 165, '2022-06-21 09:07:38', NULL),
	(225, 45, 5, 2, 2237, 1608, 150, '2022-06-21 09:07:38', NULL),
	(226, 46, 1, 0, 1211, 3671, 139, '2022-06-21 09:07:38', NULL),
	(227, 46, 2, 8, 3660, 3319, 146, '2022-06-21 09:07:38', NULL),
	(228, 46, 3, 2, 2214, 2905, 132, '2022-06-21 09:07:38', NULL),
	(229, 46, 4, 5, 3703, 2581, 61, '2022-06-21 09:07:38', NULL),
	(230, 46, 5, 2, 4898, 2196, 51, '2022-06-21 09:07:38', NULL);
/*!40000 ALTER TABLE `pemetaan_bencana_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
