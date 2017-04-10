-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2017 at 01:55 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siplah`
--
DROP DATABASE IF EXISTS `siplah`;
CREATE DATABASE `siplah` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `siplah`;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--
-- Creation: Apr 10, 2017 at 09:04 AM
--

DROP TABLE IF EXISTS `fasilitas`;
CREATE TABLE `fasilitas` (
  `idFasilitas` int(11) NOT NULL,
  `namaFasilitas` varchar(255) NOT NULL,
  `jumlahFasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `fasilitas`:
--

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--
-- Creation: Apr 10, 2017 at 11:05 AM
--

DROP TABLE IF EXISTS `gedung`;
CREATE TABLE `gedung` (
  `idGedung` int(11) NOT NULL,
  `namaGedung` varchar(255) NOT NULL,
  `kategoriGedung` varchar(25) NOT NULL,
  `luasTanah` int(11) NOT NULL,
  `jumlahLantai` int(11) NOT NULL,
  `jumlahRuang` int(11) NOT NULL,
  `statusPengelola` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `gedung`:
--

-- --------------------------------------------------------

--
-- Table structure for table `history_record`
--
-- Creation: Apr 10, 2017 at 11:52 AM
--

DROP TABLE IF EXISTS `history_record`;
CREATE TABLE `history_record` (
  `idRecord` int(11) NOT NULL,
  `idRumah` int(11) NOT NULL,
  `keteranganPerawatan` varchar(125) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `fotoPerawatan` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='anak tabel perumdos';

--
-- RELATIONS FOR TABLE `history_record`:
--   `idRumah`
--       `perumdos` -> `idRumah`
--

--
-- Dumping data for table `history_record`
--

INSERT INTO `history_record` (`idRecord`, `idRumah`, `keteranganPerawatan`, `tanggal`, `fotoPerawatan`) VALUES
(1, 1, 'pembangunan rumah', '2017-04-10', NULL),
(3, 1, 'pembangunan lantai 2', '2017-04-12', NULL),
(4, 2, 'pembangunan pos satpam', '2017-04-08', NULL),
(5, 1, 'penambahan gerbang', '2017-04-20', NULL),
(6, 2, 'renovasi gedung lama', '2017-04-30', NULL),
(9, 2, 'tebang pohon', '2017-04-10', NULL),
(10, 2, 'renovasi RTH', '2017-04-30', NULL),
(14, 1, 'aaaaa', '2017-04-10', NULL),
(15, 2, 'cccccc', '2017-04-18', NULL);

--
-- Triggers `history_record`
--
DROP TRIGGER IF EXISTS `tanggal_record`;
DELIMITER $$
CREATE TRIGGER `tanggal_record` BEFORE INSERT ON `history_record` FOR EACH ROW if ( isnull(new.tanggal) ) then
 set new.tanggal=curdate();
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `perumdos`
--
-- Creation: Apr 10, 2017 at 10:00 AM
--

DROP TABLE IF EXISTS `perumdos`;
CREATE TABLE `perumdos` (
  `idRumah` int(11) NOT NULL,
  `noRumah` int(11) NOT NULL,
  `namaPenghuni` varchar(125) DEFAULT NULL,
  `statusRumah` varchar(25) NOT NULL DEFAULT 'Kosong',
  `fotoRumah` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `perumdos`:
--

--
-- Dumping data for table `perumdos`
--

INSERT INTO `perumdos` (`idRumah`, `noRumah`, `namaPenghuni`, `statusRumah`, `fotoRumah`) VALUES
(1, 123, 'pak ABC', 'Berpenghuni', NULL),
(2, 111, NULL, 'Kosong', NULL),
(3, 108, 'Aku', 'Rusak', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--
-- Creation: Apr 10, 2017 at 11:06 AM
--

DROP TABLE IF EXISTS `ruang`;
CREATE TABLE `ruang` (
  `idRuang` int(11) NOT NULL,
  `idGedung` int(11) NOT NULL,
  `namaRuang` varchar(255) NOT NULL,
  `statusPengelola` varchar(255) DEFAULT NULL,
  `inventarisRuang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `ruang`:
--   `idGedung`
--       `gedung` -> `idGedung`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Apr 10, 2017 at 09:10 AM
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(12) NOT NULL,
  `user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `user`:
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`idFasilitas`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`idGedung`);

--
-- Indexes for table `history_record`
--
ALTER TABLE `history_record`
  ADD PRIMARY KEY (`idRecord`),
  ADD KEY `fk_idRumah` (`idRumah`);

--
-- Indexes for table `perumdos`
--
ALTER TABLE `perumdos`
  ADD PRIMARY KEY (`idRumah`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`idRuang`),
  ADD KEY `fk_idGedung` (`idGedung`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `idFasilitas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `idGedung` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history_record`
--
ALTER TABLE `history_record`
  MODIFY `idRecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `perumdos`
--
ALTER TABLE `perumdos`
  MODIFY `idRumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `idRuang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_record`
--
ALTER TABLE `history_record`
  ADD CONSTRAINT `history_record_ibfk_1` FOREIGN KEY (`idRumah`) REFERENCES `perumdos` (`idRumah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruang`
--
ALTER TABLE `ruang`
  ADD CONSTRAINT `ruang_ibfk_1` FOREIGN KEY (`idGedung`) REFERENCES `gedung` (`idGedung`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for fasilitas
--

--
-- Metadata for gedung
--

--
-- Metadata for history_record
--

--
-- Metadata for perumdos
--

--
-- Metadata for ruang
--

--
-- Metadata for user
--

--
-- Metadata for siplah
--

--
-- Dumping data for table `pma__bookmark`
--

INSERT INTO `pma__bookmark` (`dbase`, `user`, `label`, `query`) VALUES
('siplah', 'root', 'cari_perawatan_rumah', 'SELECT * FROM `history_record`\r\nJOIN `perumdos_history` ON history_record.idRecord = perumdos_history.idRecord\r\nWHERE perumdos_history.idRumah = 1');

--
-- Dumping data for table `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES
('siplah', 'siplah main DB');

SET @LAST_PAGE = LAST_INSERT_ID();

--
-- Dumping data for table `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('siplah', 'fasilitas', @LAST_PAGE, 810, 20),
('siplah', 'gedung', @LAST_PAGE, 350, 20),
('siplah', 'history_record', @LAST_PAGE, 680, 230),
('siplah', 'perumdos', @LAST_PAGE, 350, 230),
('siplah', 'ruang', @LAST_PAGE, 580, 20),
('siplah', 'user', @LAST_PAGE, 50, 190);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
