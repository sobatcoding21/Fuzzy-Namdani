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
DROP DATABASE IF EXISTS `db_fm`;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.bencana: ~5 rows (approximately)
DELETE FROM `bencana`;
/*!40000 ALTER TABLE `bencana` DISABLE KEYS */;
INSERT INTO `bencana` (`id`, `tahun`, `id_bencana`, `id_kelurahan`, `luas_ancaman`, `kep_pend_terpapar`, `jum_pend_terpapar`) VALUES
	(1, '2020', 1, 29, 0.08, 6.53, NULL),
	(3, '2020', 2, 29, NULL, NULL, NULL),
	(4, '2020', 3, 29, NULL, NULL, NULL);
/*!40000 ALTER TABLE `bencana` ENABLE KEYS */;

-- Dumping structure for table db_fm.capacity
DROP TABLE IF EXISTS `capacity`;
CREATE TABLE IF NOT EXISTS `capacity` (
  `id_kapasitas` int(11) NOT NULL AUTO_INCREMENT,
  `indeks_kapasitas` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_kapasitas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.capacity: ~0 rows (approximately)
DELETE FROM `capacity`;
/*!40000 ALTER TABLE `capacity` DISABLE KEYS */;
/*!40000 ALTER TABLE `capacity` ENABLE KEYS */;

-- Dumping structure for table db_fm.himpunan_fuzzy
DROP TABLE IF EXISTS `himpunan_fuzzy`;
CREATE TABLE IF NOT EXISTS `himpunan_fuzzy` (
  `id_himpunan_fuzzy` int(11) NOT NULL AUTO_INCREMENT,
  `id_bencana` int(11) DEFAULT NULL,
  `id_vulnerability` int(11) DEFAULT NULL,
  `id_kapasitas` int(11) DEFAULT NULL,
  `nilai_min` double DEFAULT NULL,
  `nilai_max` double DEFAULT NULL,
  PRIMARY KEY (`id_himpunan_fuzzy`),
  KEY `id_bencana` (`id_bencana`),
  KEY `id_vulnerability` (`id_vulnerability`),
  KEY `id_kapasitas` (`id_kapasitas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.himpunan_fuzzy: ~0 rows (approximately)
DELETE FROM `himpunan_fuzzy`;
/*!40000 ALTER TABLE `himpunan_fuzzy` DISABLE KEYS */;
/*!40000 ALTER TABLE `himpunan_fuzzy` ENABLE KEYS */;

-- Dumping structure for table db_fm.m_bencana
DROP TABLE IF EXISTS `m_bencana`;
CREATE TABLE IF NOT EXISTS `m_bencana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.m_bencana: ~0 rows (approximately)
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

-- Dumping data for table db_fm.m_kecamatan: ~3 rows (approximately)
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
  PRIMARY KEY (`id_kelurahan`),
  KEY `id_kecamatan` (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.m_kelurahan: ~46 rows (approximately)
DELETE FROM `m_kelurahan`;
/*!40000 ALTER TABLE `m_kelurahan` DISABLE KEYS */;
INSERT INTO `m_kelurahan` (`id_kelurahan`, `id_kecamatan`, `nama`, `luas`) VALUES
	(1, 1, 'Pojok', 5.153),
	(2, 1, 'Campurejo', 1.409),
	(3, 1, 'Tamanan', 1.077),
	(4, 1, 'Banjarmlati', 0.954),
	(5, 1, 'Bandar Kidul', 1.299),
	(6, 1, 'Lirboyo', 1.037),
	(7, 1, 'Bandar Lor', 1.113),
	(8, 1, 'Mojoroto', 2.13),
	(9, 1, 'Sukorame', 4.302),
	(10, 1, 'Bujel', 1.59),
	(11, 1, 'Ngampel', 1.468),
	(12, 1, 'Gayam', 1.296),
	(13, 1, 'Mrican', 1.109),
	(14, 1, 'Dermo', 0.657),
	(15, 2, 'Manisrenggo', 1.764),
	(16, 2, 'Rejomulyo', 1.67),
	(17, 2, 'Ngronggo', 2.585),
	(18, 2, 'Kaliombo', 0.958),
	(19, 2, 'Kampungdalem', 0.332),
	(20, 2, 'Setonopande', 0.383),
	(21, 2, 'Ringinanom', 0.05),
	(22, 2, 'Pakelan', 0.214),
	(23, 2, 'Setonogedong', 0.059),
	(24, 2, 'Kemasan', 0.228),
	(25, 2, 'Jagalan', 0.043),
	(26, 2, 'Banjaran', 1.209),
	(27, 2, 'Ngadirejo', 1.47),
	(28, 2, 'Dandangan', 1.1),
	(29, 2, 'Balowerti', 0.83),
	(30, 2, 'Pocanan', 0.214),
	(31, 2, 'Semampir', 1.791),
	(32, 3, 'Blabak', 3.354),
	(33, 3, 'Bawang', 3.449),
	(34, 3, 'Betet', 1.691),
	(35, 3, 'Tosaren', 1.361),
	(36, 3, 'Banaran', 0.974),
	(37, 3, 'Ngletih', 1.237),
	(38, 3, 'Tempurejo', 1.864),
	(39, 3, 'Ketami', 1.894),
	(40, 3, 'Pesantren', 1.356),
	(41, 3, 'Bangsal', 1.029),
	(42, 3, 'Burengan', 1.283),
	(43, 3, 'Tinalan', 0.926),
	(44, 3, 'Pakunden', 1.024),
	(45, 3, 'Singonegaran', 0.99),
	(46, 3, 'Jamsaren', 1.471);
/*!40000 ALTER TABLE `m_kelurahan` ENABLE KEYS */;

-- Dumping structure for table db_fm.vulnerability
DROP TABLE IF EXISTS `vulnerability`;
CREATE TABLE IF NOT EXISTS `vulnerability` (
  `id_vulnerability` int(11) NOT NULL AUTO_INCREMENT,
  `id_bencana` int(11) DEFAULT NULL,
  `jenis_vulnerability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potensi_kerugian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_vulnerability`),
  KEY `id_bencana` (`id_bencana`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_fm.vulnerability: ~0 rows (approximately)
DELETE FROM `vulnerability`;
/*!40000 ALTER TABLE `vulnerability` DISABLE KEYS */;
/*!40000 ALTER TABLE `vulnerability` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
