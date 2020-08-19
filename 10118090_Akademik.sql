-- MySQL dump 10.13  Distrib 5.7.20, for Win32 (AMD64)
--
-- Host: localhost    Database: db_akademik
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_dosen`
--

DROP TABLE IF EXISTS `tbl_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dosen` (
  `nip` bigint(18) NOT NULL,
  `nama_dosen` varchar(40) DEFAULT NULL,
  `id_mk` int(8) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `id_mk` (`id_mk`),
  CONSTRAINT `tbl_dosen_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `tbl_mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dosen`
--

LOCK TABLES `tbl_dosen` WRITE;
/*!40000 ALTER TABLE `tbl_dosen` DISABLE KEYS */;
INSERT INTO `tbl_dosen` VALUES (7282,'GEO SEPTIAN',123123,'081578695667','geoseptian@gmail.com');
/*!40000 ALTER TABLE `tbl_dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jadwal_kuliah`
--

DROP TABLE IF EXISTS `tbl_jadwal_kuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jadwal_kuliah` (
  `id_jk` int(8) NOT NULL,
  `nim` int(8) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `id_mk` int(8) DEFAULT NULL,
  `waktu` varchar(20) DEFAULT NULL,
  `ruangan` varchar(20) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `nip` bigint(18) DEFAULT NULL,
  PRIMARY KEY (`id_jk`),
  KEY `nim` (`nim`),
  KEY `id_mk` (`id_mk`),
  KEY `nip` (`nip`),
  CONSTRAINT `tbl_jadwal_kuliah_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tbl_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_jadwal_kuliah_ibfk_2` FOREIGN KEY (`id_mk`) REFERENCES `tbl_mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_jadwal_kuliah_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `tbl_dosen` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jadwal_kuliah`
--

LOCK TABLES `tbl_jadwal_kuliah` WRITE;
/*!40000 ALTER TABLE `tbl_jadwal_kuliah` DISABLE KEYS */;
INSERT INTO `tbl_jadwal_kuliah` VALUES (1234,10118090,'4',123123,'07.30','R.5506','IF3',7282);
/*!40000 ALTER TABLE `tbl_jadwal_kuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mahasiswa`
--

DROP TABLE IF EXISTS `tbl_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mahasiswa` (
  `nim` int(8) NOT NULL,
  `nama_mhs` varchar(40) DEFAULT NULL,
  `jurusan` varchar(40) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mahasiswa`
--

LOCK TABLES `tbl_mahasiswa` WRITE;
/*!40000 ALTER TABLE `tbl_mahasiswa` DISABLE KEYS */;
INSERT INTO `tbl_mahasiswa` VALUES (10118090,'SAINT FREDLY','Teknik Informatika','IF3','2018','4');
/*!40000 ALTER TABLE `tbl_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mata_kuliah`
--

DROP TABLE IF EXISTS `tbl_mata_kuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mata_kuliah` (
  `id_mk` int(8) NOT NULL,
  `nama_mk` varchar(40) DEFAULT NULL,
  `sks` int(4) DEFAULT NULL,
  `jurusan` varchar(40) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mata_kuliah`
--

LOCK TABLES `tbl_mata_kuliah` WRITE;
/*!40000 ALTER TABLE `tbl_mata_kuliah` DISABLE KEYS */;
INSERT INTO `tbl_mata_kuliah` VALUES (123123,'SISTEM INFORMASI',3,'Teknik Informatika','4');
/*!40000 ALTER TABLE `tbl_mata_kuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai`
--

DROP TABLE IF EXISTS `tbl_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nilai` (
  `id_nilai` int(8) NOT NULL,
  `nim` int(8) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `id_mk` int(8) DEFAULT NULL,
  `sks` int(4) DEFAULT NULL,
  `nilai` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `nim` (`nim`),
  KEY `id_mk` (`id_mk`),
  CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tbl_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_nilai_ibfk_2` FOREIGN KEY (`id_mk`) REFERENCES `tbl_mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai`
--

LOCK TABLES `tbl_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_nilai` DISABLE KEYS */;
INSERT INTO `tbl_nilai` VALUES (23848,10118090,'4',123123,3,'A');
/*!40000 ALTER TABLE `tbl_nilai` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-19 18:34:38
