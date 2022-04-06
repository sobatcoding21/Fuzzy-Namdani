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

-- Dumping data for table db_fm.bencana: ~3 rows (approximately)
DELETE FROM `bencana`;
/*!40000 ALTER TABLE `bencana` DISABLE KEYS */;
INSERT INTO `bencana` (`id`, `tahun`, `id_bencana`, `id_kelurahan`, `luas_ancaman`, `kep_pend_terpapar`, `jum_pend_terpapar`) VALUES
	(1, '2020', 1, 29, 0.08, 6.53, NULL),
	(3, '2020', 2, 29, NULL, NULL, NULL),
	(4, '2020', 3, 29, NULL, NULL, NULL),
	(5, '2020', 1, 36, NULL, NULL, NULL),
	(6, '2020', 1, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `bencana` ENABLE KEYS */;

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
  PRIMARY KEY (`id_kelurahan`),
  KEY `id_kecamatan` (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.m_kelurahan: ~46 rows (approximately)
DELETE FROM `m_kelurahan`;
/*!40000 ALTER TABLE `m_kelurahan` DISABLE KEYS */;
INSERT INTO `m_kelurahan` (`id_kelurahan`, `id_kecamatan`, `nama`, `luas`, `lat`, `long`) VALUES
	(1, 1, 'Pojok', 5.153, -7.8147029, 111.9634142),
	(2, 1, 'Campurejo', 1.409, -7.8213929, 111.9776156),
	(3, 1, 'Tamanan', 1.077, -7.8319885, 111.9789158),
	(4, 1, 'Banjarmlati', 0.954, -7.8364838, 111.9942186),
	(5, 1, 'Bandar Kidul', 1.299, -7.8287519, 111.9947831),
	(6, 1, 'Lirboyo', 1.037, -7.8219404, 111.9875506),
	(7, 1, 'Bandar Lor', 1.113, -7.8193884, 111.9967401),
	(8, 1, 'Mojoroto', 2.13, 7.8067896, 111.9471999),
	(9, 1, 'Sukorame', 4.302, -7.8041199, 111.9764482),
	(10, 1, 'Bujel', 1.59, -7.8020177, 111.9805372),
	(11, 1, 'Ngampel', 1.468, -7.7956635, 111.9950276),
	(12, 1, 'Gayam', 1.296, -7.789659, 111.9765507),
	(13, 1, 'Mrican', 1.109, -7.785485, 111.9953551),
	(14, 1, 'Dermo', 0.657, -7.776957, 111.9944361),
	(15, 2, 'Manisrenggo', 1.764, -7.8528874, 112.0000432),
	(16, 2, 'Rejomulyo', 1.67, -7.8559764, 112.0135947),
	(17, 2, 'Ngronggo', 2.585, -7.8434304, 112.0118592),
	(18, 2, 'Kaliombo', 0.958, -7.8338395, 112.0127606),
	(19, 2, 'Kampungdalem', 0.332, -7.8265535, 112.0113433),
	(20, 2, 'Setonopande', 0.383, -7.8240365, 112.0127888),
	(21, 2, 'Ringinanom', 0.05, -7.822169, 112.0092462),
	(22, 2, 'Pakelan', 0.214, -7.8171645, 112.0068816),
	(23, 2, 'Setonogedong', 0.059, -7.8167804, 112.0111042),
	(24, 2, 'Kemasan', 0.228, -7.818918, 112.0138383),
	(25, 2, 'Jagalan', 0.043, -7.8207049, 112.0134309),
	(26, 2, 'Banjaran', 1.209, -7.8175133, 112.0230906),
	(27, 2, 'Ngadirejo', 1.47, -7.8107375, 112.0209237),
	(28, 2, 'Dandangan', 1.1, -7.8080724, 112.0120147),
	(29, 2, 'Balowerti', 0.83, -7.8067817, 112.0067677),
	(30, 2, 'Pocanan', 0.214, -7.8126155, 112.0095544),
	(31, 2, 'Semampir', 1.791, -7.8004249, 112.0036392),
	(32, 3, 'Blabak', 3.354, -7.8784027, 112.0193351),
	(33, 3, 'Bawang', 3.449, -7.8618311, 112.0530077),
	(34, 3, 'Betet', 1.691, -7.8516151, 112.0340143),
	(35, 3, 'Tosaren', 1.361, -7.8437189, 112.0181998),
	(36, 3, 'Banaran', 0.974, -7.8341272, 112.0332002),
	(37, 3, 'Ngletih', 1.237, -7.8471835, 112.0545366),
	(38, 3, 'Tempurejo', 1.864, -7.8428354, 112.0603746),
	(39, 3, 'Ketami', 1.894, -7.838079, 112.0586436),
	(40, 3, 'Pesantren', 1.356, -7.8468841, 112.0315204),
	(41, 3, 'Bangsal', 1.029, -7.8285488, 112.0345286),
	(42, 3, 'Burengan', 1.283, -7.823018, 112.0298127),
	(43, 3, 'Tinalan', 0.926, -7.8405127, 112.0215983),
	(44, 3, 'Pakunden', 1.024, -7.8381259, 112.0229733),
	(45, 3, 'Singonegaran', 0.99, -7.8331075, 112.0165802),
	(46, 3, 'Jamsaren', 1.471, -7.8337409, 112.0259812);
/*!40000 ALTER TABLE `m_kelurahan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
