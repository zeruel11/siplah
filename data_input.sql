-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: siplah
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB

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
-- Current Database: `siplah`
--

/*!40000 DROP DATABASE IF EXISTS `siplah`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `siplah` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `siplah`;

--
-- Table structure for table `fasilitas`
--

DROP TABLE IF EXISTS `fasilitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fasilitas` (
  `idFasilitas` int(11) NOT NULL AUTO_INCREMENT,
  `namaFasilitas` varchar(255) NOT NULL,
  `jumlahFasilitas` int(11) NOT NULL,
  PRIMARY KEY (`idFasilitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fasilitas`
--

LOCK TABLES `fasilitas` WRITE;
/*!40000 ALTER TABLE `fasilitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fasilitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gedung`
--

DROP TABLE IF EXISTS `gedung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gedung` (
  `idGedung` int(11) NOT NULL AUTO_INCREMENT,
  `kodeGedung` varchar(7) NOT NULL,
  `koordGedung` int(11) NOT NULL,
  `namaGedung` varchar(255) NOT NULL,
  `kategoriGedung` int(11) DEFAULT NULL,
  `luasGedung` int(11) NOT NULL,
  `jumlahLantai` int(11) NOT NULL,
  `jumlahRuang` int(11) NOT NULL,
  `statusPengelola` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idGedung`),
  KEY `fk_koordinat_gedung` (`koordGedung`),
  FULLTEXT KEY `ft_namaGedung` (`namaGedung`),
  CONSTRAINT `gedung_ibfk_2` FOREIGN KEY (`koordGedung`) REFERENCES `koordinat` (`idKoord`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gedung`
--

LOCK TABLES `gedung` WRITE;
/*!40000 ALTER TABLE `gedung` DISABLE KEYS */;
INSERT INTO `gedung` VALUES (7,'11',3,'fasor',1,22,1,0,NULL),(8,'9',4,'asrama',1,35,2,0,NULL);
/*!40000 ALTER TABLE `gedung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_record`
--

DROP TABLE IF EXISTS `history_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history_record` (
  `idRecord` int(11) NOT NULL AUTO_INCREMENT,
  `idRumah` int(11) NOT NULL,
  `keteranganPerawatan` varchar(125) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `fotoPerawatan` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`idRecord`),
  KEY `fk_idRumah` (`idRumah`),
  CONSTRAINT `history_record_ibfk_1` FOREIGN KEY (`idRumah`) REFERENCES `perumdos` (`idRumah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='anak tabel perumdos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_record`
--

LOCK TABLES `history_record` WRITE;
/*!40000 ALTER TABLE `history_record` DISABLE KEYS */;
INSERT INTO `history_record` VALUES (1,1,'pembangunan rumah','2017-04-10',NULL),(3,1,'pembangunan lantai 2','2017-04-12',NULL),(4,2,'pembangunan pos satpam','2017-04-08',NULL),(5,1,'penambahan gerbang','2017-04-20',NULL),(6,2,'renovasi gedung lama','2017-04-30',NULL),(9,2,'tebang pohon','2017-04-10',NULL),(10,2,'renovasi RTH','2017-04-30',NULL),(14,1,'aaaaa','2017-04-10',NULL),(15,2,'cccccc','2017-04-18',NULL);
/*!40000 ALTER TABLE `history_record` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tanggal_record` BEFORE INSERT ON `history_record` FOR EACH ROW if ( isnull(new.tanggal) ) then
 set new.tanggal=curdate();
end if */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `idKategori` int(11) NOT NULL AUTO_INCREMENT,
  `namaKategori` varchar(25) NOT NULL DEFAULT 'DefaultCategory',
  PRIMARY KEY (`idKategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (2,'DefaultCategory');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koordinat`
--

DROP TABLE IF EXISTS `koordinat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koordinat` (
  `idKoord` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `xy` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`idKoord`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koordinat`
--

LOCK TABLES `koordinat` WRITE;
/*!40000 ALTER TABLE `koordinat` DISABLE KEYS */;
INSERT INTO `koordinat` VALUES (3,'a1',26,24,NULL),(4,'trial2',33,15,NULL);
/*!40000 ALTER TABLE `koordinat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pekerjaan`
--

DROP TABLE IF EXISTS `pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pekerjaan` (
  `idPekerjaan` int(11) NOT NULL,
  `idProposal` int(11) NOT NULL,
  `detailPekerjaan` varchar(250) NOT NULL,
  PRIMARY KEY (`idPekerjaan`),
  KEY `fk_idProposal` (`idProposal`),
  CONSTRAINT `pekerjaan_ibfk_1` FOREIGN KEY (`idProposal`) REFERENCES `proposal` (`idProposal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pekerjaan`
--

LOCK TABLES `pekerjaan` WRITE;
/*!40000 ALTER TABLE `pekerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perumdos`
--

DROP TABLE IF EXISTS `perumdos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perumdos` (
  `idRumah` int(11) NOT NULL AUTO_INCREMENT,
  `noRumah` int(11) NOT NULL,
  `namaPenghuni` varchar(125) DEFAULT NULL,
  `statusRumah` varchar(25) NOT NULL DEFAULT 'Kosong',
  `fotoRumah` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`idRumah`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perumdos`
--

LOCK TABLES `perumdos` WRITE;
/*!40000 ALTER TABLE `perumdos` DISABLE KEYS */;
INSERT INTO `perumdos` VALUES (1,123,'pak ABC','Berpenghuni',NULL),(2,111,NULL,'Kosong',NULL),(3,108,'Aku','Rusak',NULL);
/*!40000 ALTER TABLE `perumdos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposal` (
  `idProposal` int(11) NOT NULL AUTO_INCREMENT,
  `idGedung` int(11) NOT NULL,
  `judulProposal` varchar(255) NOT NULL,
  `deskripsiProposal` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `alokasiDana` varchar(10) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateDeleted` date NOT NULL,
  PRIMARY KEY (`idProposal`),
  KEY `fk_idGedung` (`idGedung`),
  FULLTEXT KEY `ft_deskripsiPekerjaan` (`deskripsiProposal`),
  CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`idGedung`) REFERENCES `gedung` (`idGedung`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruang`
--

DROP TABLE IF EXISTS `ruang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruang` (
  `idRuang` int(11) NOT NULL AUTO_INCREMENT,
  `idGedung` int(11) NOT NULL,
  `namaRuang` varchar(255) NOT NULL,
  `statusPengelola` varchar(255) DEFAULT NULL,
  `inventarisRuang` int(11) NOT NULL,
  PRIMARY KEY (`idRuang`),
  KEY `fk_idGedung` (`idGedung`),
  CONSTRAINT `ruang_ibfk_1` FOREIGN KEY (`idGedung`) REFERENCES `gedung` (`idGedung`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruang`
--

LOCK TABLES `ruang` WRITE;
/*!40000 ALTER TABLE `ruang` DISABLE KEYS */;
/*!40000 ALTER TABLE `ruang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_level` int(11) NOT NULL,
  `namaLengkap` varchar(225) NOT NULL DEFAULT 'User',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','ca9820427073d97200124dae537ff784',1,'w sakti'),(2,'pegawai1','6b7330782b2feb4924020cc4a57782a9',2,'pegawai no 1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'siplah'
--

--
-- Dumping routines for database 'siplah'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-17  9:43:45
