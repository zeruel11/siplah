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
  `kodeGedung` varchar(7) DEFAULT NULL,
  `koordGedung` int(11) NOT NULL DEFAULT '0',
  `namaGedung` varchar(255) NOT NULL,
  `kategoriGedung` int(11) DEFAULT NULL,
  `luasGedung` float DEFAULT NULL,
  `tinggiGedung` float DEFAULT NULL,
  `jumlahLantai` int(11) NOT NULL,
  `jumlahRuang` int(11) DEFAULT NULL,
  `statusPengelola` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idGedung`),
  KEY `koordGedung` (`koordGedung`),
  FULLTEXT KEY `ft_namaGedung` (`namaGedung`),
  CONSTRAINT `gedung_ibfk_1` FOREIGN KEY (`koordGedung`) REFERENCES `koordinat` (`idKoord`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gedung`
--

LOCK TABLES `gedung` WRITE;
/*!40000 ALTER TABLE `gedung` DISABLE KEYS */;
INSERT INTO `gedung` VALUES (1,'A',0,'WORK SHOP FTI',1,2962.13,NULL,2,NULL,NULL),(2,'B',0,'LAB. ELEKTRO',1,736.36,NULL,4,NULL,NULL),(3,'C',24,'KANTOR/PEND. ELEKTRO',1,731.52,NULL,2,NULL,NULL),(4,'C2',0,'KANTOR/PEND. MESIN',1,730.2,NULL,2,NULL,NULL),(5,'C3',0,'KANTOR/PEND. TEKNIK FISIKA',1,676.8,NULL,2,NULL,NULL),(6,'D',0,'LAB. MESIN',1,753.48,NULL,4,NULL,NULL),(7,'E',0,'LAB. TEKNIK FISIKA',1,764.28,NULL,4,NULL,NULL),(8,'F',0,'KANTOR/PEND.F.MIPA',1,1040,NULL,2,NULL,NULL),(9,'G',0,'LAB. F.MIPA',1,758,NULL,4,NULL,NULL),(10,'H1',0,'LAB. BIOLOGI',0,1040,NULL,3,NULL,NULL),(11,'H2',0,'LAB. HIDRODINAMIKA',0,457,NULL,1,NULL,NULL),(12,'I',0,'GEDUNG OLAH RAGA',0,1047,NULL,1,NULL,NULL),(13,'J',0,'KANTOR/PEND. KIMIA',1,942,NULL,2,NULL,NULL),(14,'K',0,'LAB. KIMIA',1,800,NULL,4,NULL,NULL),(15,'L',0,'KANTIN',0,2401,NULL,2,NULL,NULL),(16,'M',0,'LAB. TEKNIK KIMIA',1,789.48,NULL,2,NULL,NULL),(17,'N',0,'LAB. TEKNIK KIMIA',1,783,NULL,4,NULL,NULL),(18,'O',0,'KANTOR/PEND. TEKNIK KIMIA',1,665.28,NULL,2,NULL,NULL),(19,'P',0,'KANTOR/PEND. TEKNIK FISIKA',1,646.56,NULL,2,NULL,NULL),(20,'Q',0,'EX. PERPUSTAKAAN',0,1295,NULL,2,NULL,NULL),(21,'R',0,'K P A',0,1863.36,NULL,3,NULL,NULL),(22,'S',0,'LAB.BAHASA/MKDU',1,820.08,NULL,2,NULL,NULL),(23,'T',0,'KANTOR/PEND. STATISTIKA/ MAT',1,933.12,NULL,2,NULL,NULL),(24,'U',0,'LAB. MAT/ FISIKA/ STATISTIKA',1,739.85,NULL,4,NULL,NULL),(25,'V',0,'EX. MAINT.WS/R.KULIAH S2',0,925.89,NULL,2,NULL,NULL),(26,'W1',0,'KANTOR/PEND. FTK.',0,904,NULL,2,NULL,NULL),(27,'W2',0,'LABORATORIUM FTK.',0,791,NULL,4,NULL,NULL),(28,'X',0,'LECTURE/THEATER (A)',1,613,NULL,1,NULL,NULL),(29,'Y',0,'KOMPUTER /PUSKOM',1,674,NULL,1,NULL,NULL),(30,'Z',0,'THEATER (B)',1,282,NULL,1,NULL,NULL),(31,'Z1',0,'THEATER (C)',1,284,NULL,1,NULL,NULL),(32,NULL,0,'GD.STADION SEPAK BOLA',0,394.64,NULL,2,NULL,NULL),(33,NULL,3,'UPT FASOR',0,158,NULL,1,NULL,NULL),(34,NULL,15,'FUTSAL INDOOR',0,2400,22.7,1,NULL,NULL),(35,'RKT',10,'REKTORAT',0,1532.9,NULL,3,NULL,NULL),(36,NULL,16,'PERPUSTAKAAN',0,1552.8,NULL,6,NULL,NULL),(37,'MSJ',6,'MASJID MANARUL ILMI',0,2458,NULL,1,NULL,NULL),(38,'MSJ1',9,'TAKMIR MASJID MANARUL ILMI',0,247,NULL,1,NULL,NULL),(39,'MSJ2',7,'TEMPAT WUDHU MASJID MANARUL ',0,136,NULL,1,NULL,NULL),(40,'GRH',11,'GRAHA 10 NOPEMBER',0,0,NULL,0,NULL,NULL),(41,'DD',0,'LABORATORIUM BAHASA',0,431,NULL,2,NULL,NULL),(42,NULL,17,'GEDUNG S A C',0,240,NULL,2,NULL,NULL),(43,NULL,13,'MEDICAL CENTER',0,636,NULL,2,NULL,NULL),(44,NULL,0,'ITS PRESS',0,400,NULL,2,NULL,NULL),(45,NULL,23,'ITS MART',0,0,8.8,0,NULL,NULL),(46,'SA',0,'LABORATORIUM ( A )',1,506,NULL,3,NULL,NULL),(47,'SB',0,'LABORATORIUM ( B )',1,339,NULL,3,NULL,NULL),(48,'SC',0,'LABORATORIUM ( C )',1,773,NULL,2,NULL,NULL),(49,'SD',0,'WORK SHOP ( D )',1,207,NULL,1,NULL,NULL),(50,'SE',0,'RUANG KULIAH ( E )',1,553,NULL,2,NULL,NULL),(51,'SF',0,'RUANG KULIAH ( F )',1,354,NULL,2,NULL,NULL),(52,'SG',0,'RUANG KULIAH ( G )',1,500,NULL,2,NULL,NULL),(53,'SH',0,'LABORATORIUM ( H )',1,368,NULL,2,NULL,NULL),(54,'SI',0,'RUANG KULIAH ( I )',1,391,NULL,2,NULL,NULL),(55,'SJ',0,'RUANG KULIAH ( J )',1,393,NULL,2,NULL,NULL),(56,'SK',0,'ADM. /PERPUST ( K )',1,327,NULL,2,NULL,NULL),(57,'SL',0,'WORK SHOP ( L )',1,920,NULL,2,NULL,NULL),(58,'SM',0,'KANTOR/PEND. (M)',1,0,NULL,0,NULL,NULL),(59,'SN',0,'KANTOR/PEND. TEKNIK LINGKUNGAN',1,0,NULL,0,NULL,NULL),(60,'DC',0,'GED. DESIGN CENTER',1,0,NULL,0,NULL,NULL),(61,'H',21,'GED. DESPRO',1,640,NULL,3,NULL,NULL),(62,NULL,0,'GED.DESPRO LAB',1,508,NULL,3,NULL,NULL),(63,'SCI',0,'GED. STUDENT CENTER FTSP',1,0,NULL,0,NULL,NULL),(64,' ',0,'GED. PWK/ PLANOLOGI ',1,449,NULL,4,NULL,NULL),(65,NULL,0,'KANTOR /PEND. PWK',1,506,NULL,4,NULL,NULL),(66,NULL,0,'GED. GEOMATIKA ',1,508,NULL,4,NULL,NULL),(67,NULL,0,'KANTOR /PEND. GEOMATIKA',1,627,NULL,4,NULL,NULL),(68,NULL,0,'ECO HOUSE',0,0,14.1,2,NULL,NULL),(69,NULL,0,'LABORATORIUM ( A )',1,508,NULL,3,NULL,NULL),(70,NULL,0,'LABORATORIUM ( B )',1,439,NULL,3,NULL,NULL),(71,NULL,0,'LABORATORIUM ( C )',1,504,NULL,2,NULL,NULL),(72,NULL,0,'RUANG KULIAH/R. DOSEN',1,1442,NULL,2,NULL,NULL),(73,NULL,0,'WORK SHOP FTK',1,896.4,NULL,1,NULL,NULL),(74,'AA',0,'KANTOR/PENDIDIKAN D3 FTI',1,819.36,NULL,2,NULL,NULL),(75,'BB',0,'LAB. D ( III ) FTI',1,777.72,NULL,3,NULL,NULL),(76,'BB1',5,'WORK SHOP/ LAB D3 FTI',1,933,NULL,2,NULL,NULL),(77,'MT',0,'PEND.TEKNIK MATERIAL METALURGI',1,0,NULL,0,NULL,NULL),(78,NULL,0,'COMMON SUPPORT TEKNIK INDUSTRI',1,1000,NULL,2,NULL,NULL),(79,NULL,0,'LAB. TEKNIK INDUSTRI',1,940,30.5,7,NULL,NULL),(80,NULL,0,'KANTOR/PEND. TITC',1,744.78,NULL,2,NULL,NULL),(81,NULL,0,'LAB. TITC',1,798.48,NULL,3,NULL,NULL),(82,NULL,18,'LAB. FORENSIK',0,1700,NULL,2,NULL,NULL),(83,NULL,19,'ROBOTIKA ARENA',0,3500,15.7,3,NULL,NULL),(84,NULL,0,'ROBOTIKA LAB',0,833,10.3,2,NULL,NULL),(85,NULL,0,'ROBOTIKA PERSIAPAN',0,415,10.2,2,NULL,NULL),(86,NULL,22,'NASDEC',0,1232,16.5,3,NULL,NULL),(87,NULL,8,'ASRAMA MHS ( A s/d E )',0,2595,NULL,2,NULL,NULL),(88,NULL,0,'ASRAMA MAHASISWA ASING',0,542,5.7,1,NULL,NULL),(89,'X1',0,'LECTURE/THEATER',0,627,NULL,1,NULL,NULL),(90,NULL,0,'COMMONT HALL/R. MAKAN',0,982.53,NULL,2,NULL,NULL),(91,'PS',26,'GED. PASCA SARJANA',0,730,27,3,NULL,NULL),(92,NULL,25,'GED. UPMB',0,730,27,4,NULL,NULL),(93,NULL,0,'GED. LPPM',0,560,18.8,3,NULL,NULL),(94,NULL,0,'GED. COE',0,462,18.5,3,NULL,NULL),(95,'EE',0,'RESEARCH CENTRE LAMA 1',0,805,NULL,2,NULL,NULL),(96,NULL,0,'BENGKEL ASBUTON',0,187,13,1,NULL,NULL),(97,NULL,0,'GEDUNG SERBA GUNA',0,4661,NULL,2,NULL,NULL),(98,'TT',0,'I K A  -  I T S ',0,180,NULL,1,NULL,NULL),(99,NULL,0,'U K S / UNIT KEGIATAN ',0,248,NULL,1,NULL,NULL),(100,NULL,20,'MIPA / SCIENCE TOWER',0,2210,52.5,11,NULL,NULL),(101,NULL,14,'RESEARCH CENTER',0,1785,68.5,11,NULL,NULL);
/*!40000 ALTER TABLE `gedung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gedung_bak`
--

DROP TABLE IF EXISTS `gedung_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gedung_bak` (
  `idGedung` int(11) NOT NULL AUTO_INCREMENT,
  `kodeGedung` varchar(7) DEFAULT NULL,
  `koordGedung` int(11) NOT NULL,
  `namaGedung` varchar(255) NOT NULL,
  `kategoriGedung` int(11) DEFAULT NULL,
  `luasGedung` int(11) NOT NULL,
  `tinggiGedung` int(11) DEFAULT NULL,
  `jumlahLantai` int(11) NOT NULL,
  `jumlahRuang` int(11) DEFAULT NULL,
  `statusPengelola` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idGedung`),
  KEY `fk_koordinat_gedung` (`koordGedung`),
  FULLTEXT KEY `ft_namaGedung` (`namaGedung`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gedung_bak`
--

LOCK TABLES `gedung_bak` WRITE;
/*!40000 ALTER TABLE `gedung_bak` DISABLE KEYS */;
INSERT INTO `gedung_bak` VALUES (7,NULL,3,'UPT FASOR',NULL,158,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `gedung_bak` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'PENDIDIKAN');
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
  `x` float DEFAULT NULL,
  `y` float DEFAULT NULL,
  `xy` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`idKoord`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koordinat`
--

LOCK TABLES `koordinat` WRITE;
/*!40000 ALTER TABLE `koordinat` DISABLE KEYS */;
INSERT INTO `koordinat` VALUES (0,'und',NULL,NULL,NULL),(3,'',-165,50.5,NULL),(5,'',-60.2812,35.5,NULL),(6,'',-108.75,50.25,NULL),(7,'',-113.97,50.63,NULL),(8,'',-185.188,26.125,NULL),(9,'',-112.719,45.25,NULL),(10,'',-97.25,69.875,NULL),(11,'',-40.219,33.406,NULL),(13,'medcen',-210.25,47.438,NULL),(14,'rc',-93.188,105.75,NULL),(15,'',-126.75,37.313,NULL),(16,'',-99.563,82.25,NULL),(17,'sac',-124.438,64.875,NULL),(18,'forensik',-37.75,98.188,NULL),(19,'robotika',-44.687,107.063,NULL),(20,'',-142.468,64.375,NULL),(21,'despro',-64.937,93.312,NULL),(22,'nasdec',-63.375,119.625,NULL),(23,'',-163.437,63.125,NULL),(24,'',-144.125,89.25,NULL),(25,'upmb',-85,79.0625,NULL),(26,'',-88.75,82.5625,NULL);
/*!40000 ALTER TABLE `koordinat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pekerjaan`
--

DROP TABLE IF EXISTS `pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pekerjaan` (
  `idPekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `idProposal` int(11) NOT NULL,
  `detailPekerjaan` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPekerjaan`),
  KEY `fk_idProposal` (`idProposal`),
  CONSTRAINT `pekerjaan_ibfk_1` FOREIGN KEY (`idProposal`) REFERENCES `proposal` (`idProposal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pekerjaan`
--

LOCK TABLES `pekerjaan` WRITE;
/*!40000 ALTER TABLE `pekerjaan` DISABLE KEYS */;
INSERT INTO `pekerjaan` VALUES (22,11,'perbaikan pintu depan',0),(23,11,'cek kondisi atap',1),(24,16,'Menambah kapasitas parkiran motor',0),(25,16,'Memperbaiki ruang tengah asrama',1),(26,17,'Pemasangan lantai',0),(27,18,'keruk kolam',0);
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
  `alokasiDana` varchar(10) DEFAULT NULL,
  `dateCreated` date DEFAULT NULL,
  `dateDeleted` date DEFAULT NULL,
  PRIMARY KEY (`idProposal`),
  KEY `fk_idGedung` (`idGedung`),
  FULLTEXT KEY `ft_deskripsiPekerjaan` (`deskripsiProposal`),
  CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`idGedung`) REFERENCES `gedung` (`idGedung`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposal`
--

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;
INSERT INTO `proposal` VALUES (11,33,'renovasi fasor ruang 1','Ruangan UPT FASOR telah banyak mengalami degradasi struktur karena sangat sering digunakan namun jarang dilakukan perawatan. Diperlukan peninjauan ulang dan perbaikan terhadap struktur bangunan',6,NULL,'2018-01-21','2018-01-31'),(16,87,'Uplift asrama','Mengingat makin dekatnya masa penerimaan mahasiswa baru, maka perlu dilakukan beberapa renovasi terhadap asrama agar dapat menarik mahasiswa baru untuk tinggal di asrama',2,NULL,'2018-01-24',NULL),(17,101,'Improvement RC','Perbaikan lantai 10',0,NULL,'2018-01-25',NULL),(18,87,'renovasi kolam asrama','perlu melakukan renovasi kolam',0,NULL,'2018-01-28',NULL),(19,33,'renovasi fasor parkiran','memperluas',0,NULL,'2018-01-31',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','ca9820427073d97200124dae537ff784',1,'w sakti'),(2,'pegawai1','46f94c8de14fb36680850768ff1b7f2a',2,'pegawai no 1'),(3,'wr2','78042aaf99ab008f4799649aa171b9ae',3,'Bpk. Wakil Rektor II'),(4,'sarpras1','379563d4cc020b27338863c063b9368d',4,'SARPRAS unit FTI'),(5,'pegawai2','9e014682c94e0f2cc834bf7348bda428',2,'pegawai simri 2'),(6,'sisfor','d7a454d8c4be3b87aed0b28b4327a3d1',5,'Unit Sistem Informasi');
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

-- Dump completed on 2018-02-01  0:50:18
