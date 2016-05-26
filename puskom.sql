-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 25, 2016 at 07:56 PM
-- Server version: 5.7.10-log
-- PHP Version: 5.6.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskom`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_point`
--

CREATE TABLE IF NOT EXISTS `access_point` (
  `idAP` varchar(15) NOT NULL,
  `fk_hub` varchar(15) NOT NULL,
  `namaAp` varchar(20) NOT NULL,
  `fk_merekAp` varchar(15) NOT NULL,
  `ipAp` varchar(15) NOT NULL,
  `fk_kondisiAP` varchar(15) NOT NULL,
  `api_ruangAP` varchar(15) DEFAULT NULL COMMENT 'api.polinema.ac.id: daftar ruang',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='\r\n';

-- --------------------------------------------------------

--
-- Table structure for table `agenda_kerja`
--

CREATE TABLE IF NOT EXISTS `agenda_kerja` (
  `idAgendaKerja` varchar(15) NOT NULL,
  `api_uker` varchar(15) DEFAULT NULL,
  `api_pegawai` varchar(20) NOT NULL COMMENT 'api.polinema.ac.id: pegawai',
  `tglAgenda` varchar(50) NOT NULL,
  `rekapAgenda` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda_kerja`
--

INSERT INTO `agenda_kerja` (`idAgendaKerja`, `api_uker`, `api_pegawai`, `tglAgenda`, `rekapAgenda`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('', '3', '3', 'Pengembangan Webservice Puskom', '', 1, 'Dana Irwanda', '2016-04-27 00:00:00', 'Dana Irwanda', '2016-04-27 00:00:00'),
('201604000000004', '1', '101', '04/25/2016', 'Pengembangan Jaringan Puskom', 1, '', '0000-00-00 00:00:00', NULL, NULL),
('201604000000005', '2', '2', '27/04/2016', 'Pengembangan Website', 1, 'Dana', '2016-04-27 00:00:00', 'Dana', '2016-04-27 00:00:00'),
('201604000000006', '2', '2', '27/04/2016', 'Pengembangan Web Service Puskom', 1, 'Dana Irwanda', '2016-04-27 00:00:00', 'Dana Irwanda', '2016-04-27 00:00:00'),
('201604000000007', '1', '1', '04/29/2016', 'Pengembangan Jaringan Puskom', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('201604000000008', '1', '1', '04/29/2016', 'pengembangan website puskom', 1, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_inven`
--

CREATE TABLE IF NOT EXISTS `barang_inven` (
  `idBarang` varchar(15) NOT NULL,
  `kodeBarang` varchar(50) NOT NULL,
  `namaBarang` varchar(100) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_inven`
--

INSERT INTO `barang_inven` (`idBarang`, `kodeBarang`, `namaBarang`, `keterangan`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', 'BR001', 'Access Point', 'Baru', 0, 'nova', '0000-00-00 00:00:00', NULL, NULL),
('201604000000001', '2016042', 'Laptop', 'samsung', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coba`
--

CREATE TABLE IF NOT EXISTS `coba` (
  `id` varchar(15) NOT NULL,
  `test` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_agenda_kerja`
--

CREATE TABLE IF NOT EXISTS `detil_agenda_kerja` (
  `idDetilAgenda` varchar(15) NOT NULL,
  `fk_rekapAgenda` varchar(15) NOT NULL,
  `detilAgenda` varchar(255) NOT NULL,
  `screenshot` varchar(50) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `firewall`
--

CREATE TABLE IF NOT EXISTS `firewall` (
  `idFirewall` varchar(15) NOT NULL,
  `fk_provider` varchar(15) NOT NULL,
  `namaFirewall` varchar(50) NOT NULL,
  `ipFirewall` varchar(15) NOT NULL,
  `fk_merekFW` varchar(15) NOT NULL,
  `api_ruangFW` varchar(15) DEFAULT NULL COMMENT 'dari api ruang',
  `fk_kondisiFW` varchar(15) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `firewall`
--

INSERT INTO `firewall` (`idFirewall`, `fk_provider`, `namaFirewall`, `ipFirewall`, `fk_merekFW`, `api_ruangFW`, `fk_kondisiFW`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '3', 'sonic wall', '192.168.1.1', '1', '1', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gangguan`
--

CREATE TABLE IF NOT EXISTS `gangguan` (
  `idGangguan` varchar(15) NOT NULL,
  `fk_jenisForm` varchar(15) NOT NULL,
  `tglMasukLaporan` date NOT NULL,
  `namaPelapor` varchar(50) NOT NULL,
  `api_pelapor` varchar(50) DEFAULT NULL COMMENT 'api noPeg',
  `api_fkRuang` varchar(50) DEFAULT NULL COMMENT 'api: fkRuang',
  `penerimaLaporan` varchar(15) NOT NULL COMMENT 'api noPeg',
  `uraianGangguan` text NOT NULL,
  `sudahDitangani` tinyint(1) NOT NULL DEFAULT '0',
  `cetakGangguan` varchar(25) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gangguan`
--

INSERT INTO `gangguan` (`idGangguan`, `fk_jenisForm`, `tglMasukLaporan`, `namaPelapor`, `api_pelapor`, `api_fkRuang`, `penerimaLaporan`, `uraianGangguan`, `sudahDitangani`, `cetakGangguan`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '1', '2016-02-20', 'sukun', '12', '12', 'admin112', '', 0, NULL, 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hub`
--

CREATE TABLE IF NOT EXISTS `hub` (
  `idHub` varchar(15) NOT NULL,
  `fk_SS` varchar(15) DEFAULT NULL,
  `parentHub` varchar(15) DEFAULT NULL,
  `namaHub` varchar(20) NOT NULL,
  `fk_merekHub` varchar(15) NOT NULL,
  `api_ruangHub` varchar(15) DEFAULT NULL COMMENT 'dari api ruang',
  `fk_kondisiHub` varchar(15) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hub`
--

INSERT INTO `hub` (`idHub`, `fk_SS`, `parentHub`, `namaHub`, `fk_merekHub`, `api_ruangHub`, `fk_kondisiHub`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '1', '1', 'hub 1', '1', '1', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inven_masuk`
--

CREATE TABLE IF NOT EXISTS `inven_masuk` (
  `idInvenMasuk` varchar(15) NOT NULL,
  `fk_form` varchar(15) NOT NULL,
  `api_uker` varchar(15) NOT NULL COMMENT 'api.polinema.ac.id: Daftar Unit Kerja',
  `fk_barang` varchar(15) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `api_penJawab` varchar(20) NOT NULL COMMENT 'api.polinema.ac.id: Daftar Pegawai\npegawai yang menyerahkan',
  `api_penerima` varchar(20) DEFAULT NULL COMMENT 'api.polinema.ac.id: Daftar Pegawai\npegawai yang menerima',
  `nomor` varchar(30) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inven_masuk`
--

INSERT INTO `inven_masuk` (`idInvenMasuk`, `fk_form`, `api_uker`, `fk_barang`, `jumlah`, `api_penJawab`, `api_penerima`, `nomor`, `keterangan`, `isDelete`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '1', '1', '1', 20, '2', '3', '1224', '', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('2', '1', '1', '1', 10, '4', '12', 'ng88231234', '', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inven_status`
--

CREATE TABLE IF NOT EXISTS `inven_status` (
  `idInvenStatus` varchar(15) NOT NULL,
  `fk_invenMasuk` varchar(15) NOT NULL,
  `kodeItem` varchar(50) NOT NULL,
  `tglPemeriksaan` date DEFAULT NULL,
  `api_pemeriksa` varchar(20) DEFAULT NULL COMMENT 'api.polinema.ac.id: Daftar Pegawai - login',
  `statusPeriksa` enum('baik','rusak','hilang') DEFAULT 'baik',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_alat`
--

CREATE TABLE IF NOT EXISTS `kondisi_alat` (
  `idKondisiAlat` varchar(15) NOT NULL,
  `kondisi` varchar(15) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi_alat`
--

INSERT INTO `kondisi_alat` (`idKondisiAlat`, `kondisi`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', 'baik', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('2', 'rusak', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('3', 'perbaikan', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('4', 'sipqwe', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merek_alat`
--

CREATE TABLE IF NOT EXISTS `merek_alat` (
  `idMerekAlat` varchar(15) NOT NULL,
  `namaMerek` varchar(50) NOT NULL,
  `singkatanMerek` varchar(15) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merek_alat`
--

INSERT INTO `merek_alat` (`idMerekAlat`, `namaMerek`, `singkatanMerek`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', 'TP-Link', 'TPL', 0, '', '0000-00-00 00:00:00', NULL, '2016-04-28 03:11:32'),
('2', 'TP-link-2', 'TPL2', 0, 'nova', '0000-00-00 00:00:00', NULL, NULL),
('201604000000001', 'SAMSUNG', 'SM', 1, '', '0000-00-00 00:00:00', NULL, NULL),
('201604000000002', 'DELL', 'DE', 1, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nama_form`
--

CREATE TABLE IF NOT EXISTS `nama_form` (
  `idNamaForm` varchar(15) NOT NULL,
  `api_uker` varchar(15) NOT NULL COMMENT 'api.polinema.ac.id: Daftar Unit Kerja;default puskom',
  `nomerForm` varchar(20) NOT NULL,
  `namaForm` varchar(30) NOT NULL,
  `template` varchar(30) DEFAULT NULL COMMENT 'assets/form_inventaris',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nama_form`
--

INSERT INTO `nama_form` (`idNamaForm`, `api_uker`, `nomerForm`, `namaForm`, `template`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '1', '1', 'from satu', 'sf', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('2', '2', '2', 'form 2', NULL, 0, '', '0000-00-00 00:00:00', NULL, NULL),
('3 ', '3', '4', 'form 3', NULL, 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdd_buffer`
--

CREATE TABLE IF NOT EXISTS `pdd_buffer` (
  `idBuffer` varchar(15) NOT NULL,
  `namaPdd` varchar(20) NOT NULL,
  `tglBuffer` datetime NOT NULL,
  `remoteAddress` varchar(15) DEFAULT NULL,
  `fileBuffer` varchar(50) NOT NULL,
  `indexAwal` int(11) NOT NULL,
  `indexAkhir` int(11) NOT NULL,
  `jmlDataBuffer` int(11) NOT NULL,
  `indexBuffer` int(11) DEFAULT NULL,
  `totalLogAkhir` int(11) NOT NULL,
  `tglIntegrasi1` datetime DEFAULT NULL,
  `tglIntegrasi2` datetime DEFAULT NULL,
  `totalIntegrasi` int(2) DEFAULT NULL,
  `caraKirim` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=sistem,2=manual',
  `caraIntegrasi` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=sistem,2=manual',
  `statusIntegrasi` tinyint(1) NOT NULL DEFAULT '0',
  `ketBuffer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdd_error`
--

CREATE TABLE IF NOT EXISTS `pdd_error` (
  `idErrPdd` varchar(15) NOT NULL,
  `tglErrPdd` datetime NOT NULL,
  `namaPdd` varchar(20) DEFAULT NULL,
  `ketErrPdd` text NOT NULL,
  `diSelesaikan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penanganan`
--

CREATE TABLE IF NOT EXISTS `penanganan` (
  `idPenanganan` varchar(15) NOT NULL,
  `fk_gangguan` varchar(15) NOT NULL,
  `fk_jenisForm` varchar(15) NOT NULL,
  `tglPenanganan` date NOT NULL,
  `api_teknisi` varchar(20) NOT NULL COMMENT 'api.polinema.ac.id: Daftar Pegawai',
  `uraianPenanganan` text NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='pengangan gangguan';

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE IF NOT EXISTS `provider` (
  `idProvider` varchar(15) NOT NULL,
  `namaProvider` varchar(20) NOT NULL COMMENT 'contoh: sony,dell,mikrotik',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`idProvider`, `namaProvider`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', 'Indosat', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('2', 'indosat2', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('3', 'speedy', 1, '', '0000-00-00 00:00:00', NULL, NULL),
('4', 'XL', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `switch_core`
--

CREATE TABLE IF NOT EXISTS `switch_core` (
  `idSC` varchar(15) NOT NULL,
  `fk_firewall` varchar(15) DEFAULT NULL,
  `namaSC` varchar(50) NOT NULL,
  `ipSC` varchar(15) NOT NULL,
  `fk_merekSC` varchar(15) NOT NULL,
  `api_ruangSC` varchar(15) DEFAULT NULL COMMENT 'dari api ruang',
  `fk_kondisiSC` varchar(15) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `switch_core`
--

INSERT INTO `switch_core` (`idSC`, `fk_firewall`, `namaSC`, `ipSC`, `fk_merekSC`, `api_ruangSC`, `fk_kondisiSC`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '1', 'Switch 1', '18798', '1', '1', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('2', '1', 'switch 2', '97', '1', '1', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('23', NULL, '121', '1231', '1', '12', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL),
('3', NULL, 'switch 3', '192.168.1.1', '1', '1', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `switch_sub`
--

CREATE TABLE IF NOT EXISTS `switch_sub` (
  `idSubSwitch` varchar(15) NOT NULL,
  `fk_SC` varchar(15) DEFAULT NULL,
  `fk_switchSub` varchar(15) DEFAULT NULL,
  `namaSS` varchar(20) NOT NULL,
  `ipSS` varchar(15) NOT NULL,
  `fk_merekSS` varchar(15) NOT NULL,
  `api_ruangSS` varchar(15) DEFAULT NULL COMMENT 'dari api ruang',
  `fk_kondisiSS` varchar(15) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(15) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` varchar(15) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `switch_sub`
--

INSERT INTO `switch_sub` (`idSubSwitch`, `fk_SC`, `fk_switchSub`, `namaSS`, `ipSS`, `fk_merekSS`, `api_ruangSS`, `fk_kondisiSS`, `isDeleted`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
('1', '1', '1', 'Ah 1', '9879', '1', '133', '1', 0, '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`) VALUES
(1, 'Dana Eka Irwanda', 'danaekairwanda@gmail.com', '$2y$10$QaU2z2ta3CSmQt.CltVGJ.1AbAM2DVOeMmky5tIUpIph1Vk1d/hLe', NULL, '2016-04-04 15:31:40', '2016-04-04 15:31:40', 1),
(2, 'Chris Sevilleja', 'chris@scotch.io', '$2y$10$CA1sHBEi9rgeV0OSkZkVYOhi59oz1CUQuXDFGP8gZvlEayDO3j2vq', NULL, '2016-04-04 15:31:40', '2016-04-04 15:31:40', 1),
(3, 'Holly Lloyd', 'holly@scotch.io', '$2y$10$8lGwkhq8vnX9MOWMuZdbseqqwJISSinzBDZNzDt3uhOx0w2OhZddK', NULL, '2016-04-04 15:31:40', '2016-04-04 15:31:40', 0),
(4, 'Adnan Kukic', 'adnan@scotch.io', '$2y$10$iaX1le0eW67.4riWj04BOOMFt4ibJJYJB2Z0VctsXCGVC5EWBin5S', NULL, '2016-04-04 15:31:40', '2016-04-04 15:31:40', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_point`
--
ALTER TABLE `access_point`
  ADD PRIMARY KEY (`idAP`),
  ADD KEY `fk_access_point_hub1_idx` (`fk_hub`),
  ADD KEY `fk_access_point_kondisi_alat1_idx` (`fk_kondisiAP`),
  ADD KEY `fk_access_point_merek_alat1_idx` (`fk_merekAp`);

--
-- Indexes for table `agenda_kerja`
--
ALTER TABLE `agenda_kerja`
  ADD PRIMARY KEY (`idAgendaKerja`);

--
-- Indexes for table `barang_inven`
--
ALTER TABLE `barang_inven`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indexes for table `coba`
--
ALTER TABLE `coba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_agenda_kerja`
--
ALTER TABLE `detil_agenda_kerja`
  ADD PRIMARY KEY (`idDetilAgenda`),
  ADD KEY `fk_detil_agenda_kerja_rekap_agenda_kerja1_idx` (`fk_rekapAgenda`);

--
-- Indexes for table `firewall`
--
ALTER TABLE `firewall`
  ADD PRIMARY KEY (`idFirewall`),
  ADD KEY `fk_firewall_provider1_idx` (`fk_provider`),
  ADD KEY `fk_firewall_kondisi_alat1_idx` (`fk_kondisiFW`),
  ADD KEY `fk_firewall_merek_alat1_idx` (`fk_merekFW`);

--
-- Indexes for table `gangguan`
--
ALTER TABLE `gangguan`
  ADD PRIMARY KEY (`idGangguan`),
  ADD KEY `fk_form_gangguan_jenis_form1_idx` (`fk_jenisForm`);

--
-- Indexes for table `hub`
--
ALTER TABLE `hub`
  ADD PRIMARY KEY (`idHub`),
  ADD KEY `fk_hub_hub1_idx` (`parentHub`),
  ADD KEY `fk_hub_switch_sub1_idx` (`fk_SS`),
  ADD KEY `fk_hub_kondisi_alat1_idx` (`fk_kondisiHub`),
  ADD KEY `fk_hub_merek_alat1_idx` (`fk_merekHub`);

--
-- Indexes for table `inven_masuk`
--
ALTER TABLE `inven_masuk`
  ADD PRIMARY KEY (`idInvenMasuk`),
  ADD KEY `fk_pengajuan_inventaris_nama_form1_idx` (`fk_form`),
  ADD KEY `fk_inven_masuk_barang_inventaris1_idx` (`fk_barang`);

--
-- Indexes for table `inven_status`
--
ALTER TABLE `inven_status`
  ADD PRIMARY KEY (`idInvenStatus`),
  ADD KEY `fk_detil_pengajuan_pengajuan_inventaris1_idx` (`fk_invenMasuk`);

--
-- Indexes for table `kondisi_alat`
--
ALTER TABLE `kondisi_alat`
  ADD PRIMARY KEY (`idKondisiAlat`);

--
-- Indexes for table `merek_alat`
--
ALTER TABLE `merek_alat`
  ADD PRIMARY KEY (`idMerekAlat`);

--
-- Indexes for table `nama_form`
--
ALTER TABLE `nama_form`
  ADD PRIMARY KEY (`idNamaForm`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pdd_buffer`
--
ALTER TABLE `pdd_buffer`
  ADD PRIMARY KEY (`idBuffer`);

--
-- Indexes for table `pdd_error`
--
ALTER TABLE `pdd_error`
  ADD PRIMARY KEY (`idErrPdd`);

--
-- Indexes for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD PRIMARY KEY (`idPenanganan`),
  ADD KEY `fk_penanganan_gangguan1_idx` (`fk_gangguan`),
  ADD KEY `fk_penanganan_jenis_form1_idx` (`fk_jenisForm`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`idProvider`);

--
-- Indexes for table `switch_core`
--
ALTER TABLE `switch_core`
  ADD PRIMARY KEY (`idSC`),
  ADD KEY `fk_switch_firewall1_idx` (`fk_firewall`),
  ADD KEY `fk_switch_core_kondisi_alat1_idx` (`fk_kondisiSC`),
  ADD KEY `fk_switch_core_merek_alat1_idx` (`fk_merekSC`);

--
-- Indexes for table `switch_sub`
--
ALTER TABLE `switch_sub`
  ADD PRIMARY KEY (`idSubSwitch`),
  ADD KEY `fk_sub_switch_core_switch1_idx` (`fk_SC`),
  ADD KEY `fk_switch_sub_switch_sub1_idx` (`fk_switchSub`),
  ADD KEY `fk_switch_sub_kondisi_alat1_idx` (`fk_kondisiSS`),
  ADD KEY `fk_switch_sub_merek_alat1_idx` (`fk_merekSS`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_point`
--
ALTER TABLE `access_point`
  ADD CONSTRAINT `fk_access_point_hub1` FOREIGN KEY (`fk_hub`) REFERENCES `hub` (`idHub`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_access_point_kondisi_alat1` FOREIGN KEY (`fk_kondisiAP`) REFERENCES `kondisi_alat` (`idKondisiAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_access_point_merek_alat1` FOREIGN KEY (`fk_merekAp`) REFERENCES `merek_alat` (`idMerekAlat`) ON UPDATE CASCADE;

--
-- Constraints for table `detil_agenda_kerja`
--
ALTER TABLE `detil_agenda_kerja`
  ADD CONSTRAINT `fk_detil_agenda_kerja_rekap_agenda_kerja1` FOREIGN KEY (`fk_rekapAgenda`) REFERENCES `agenda_kerja` (`idAgendaKerja`) ON UPDATE CASCADE;

--
-- Constraints for table `firewall`
--
ALTER TABLE `firewall`
  ADD CONSTRAINT `fk_firewall_kondisi_alat1` FOREIGN KEY (`fk_kondisiFW`) REFERENCES `kondisi_alat` (`idKondisiAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_firewall_merek_alat1` FOREIGN KEY (`fk_merekFW`) REFERENCES `merek_alat` (`idMerekAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_firewall_provider1` FOREIGN KEY (`fk_provider`) REFERENCES `provider` (`idProvider`) ON UPDATE CASCADE;

--
-- Constraints for table `gangguan`
--
ALTER TABLE `gangguan`
  ADD CONSTRAINT `fk_form_gangguan_jenis_form1` FOREIGN KEY (`fk_jenisForm`) REFERENCES `nama_form` (`idNamaForm`) ON UPDATE CASCADE;

--
-- Constraints for table `hub`
--
ALTER TABLE `hub`
  ADD CONSTRAINT `fk_hub_hub1` FOREIGN KEY (`parentHub`) REFERENCES `hub` (`idHub`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hub_kondisi_alat1` FOREIGN KEY (`fk_kondisiHub`) REFERENCES `kondisi_alat` (`idKondisiAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hub_merek_alat1` FOREIGN KEY (`fk_merekHub`) REFERENCES `merek_alat` (`idMerekAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hub_switch_sub1` FOREIGN KEY (`fk_SS`) REFERENCES `switch_sub` (`idSubSwitch`) ON UPDATE CASCADE;

--
-- Constraints for table `inven_masuk`
--
ALTER TABLE `inven_masuk`
  ADD CONSTRAINT `fk_inven_masuk_barang_inventaris1` FOREIGN KEY (`fk_barang`) REFERENCES `barang_inven` (`idBarang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajuan_inventaris_nama_form1` FOREIGN KEY (`fk_form`) REFERENCES `nama_form` (`idNamaForm`) ON UPDATE CASCADE;

--
-- Constraints for table `inven_status`
--
ALTER TABLE `inven_status`
  ADD CONSTRAINT `fk_detil_pengajuan_pengajuan_inventaris1` FOREIGN KEY (`fk_invenMasuk`) REFERENCES `inven_masuk` (`idInvenMasuk`) ON UPDATE CASCADE;

--
-- Constraints for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD CONSTRAINT `fk_penanganan_gangguan1` FOREIGN KEY (`fk_gangguan`) REFERENCES `gangguan` (`idGangguan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penanganan_jenis_form1` FOREIGN KEY (`fk_jenisForm`) REFERENCES `nama_form` (`idNamaForm`) ON UPDATE CASCADE;

--
-- Constraints for table `switch_core`
--
ALTER TABLE `switch_core`
  ADD CONSTRAINT `fk_switch_core_kondisi_alat1` FOREIGN KEY (`fk_kondisiSC`) REFERENCES `kondisi_alat` (`idKondisiAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_switch_core_merek_alat1` FOREIGN KEY (`fk_merekSC`) REFERENCES `merek_alat` (`idMerekAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_switch_firewall1` FOREIGN KEY (`fk_firewall`) REFERENCES `firewall` (`idFirewall`) ON UPDATE CASCADE;

--
-- Constraints for table `switch_sub`
--
ALTER TABLE `switch_sub`
  ADD CONSTRAINT `fk_sub_switch_core_switch1` FOREIGN KEY (`fk_SC`) REFERENCES `switch_core` (`idSC`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_switch_sub_kondisi_alat1` FOREIGN KEY (`fk_kondisiSS`) REFERENCES `kondisi_alat` (`idKondisiAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_switch_sub_merek_alat1` FOREIGN KEY (`fk_merekSS`) REFERENCES `merek_alat` (`idMerekAlat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_switch_sub_switch_sub1` FOREIGN KEY (`fk_switchSub`) REFERENCES `switch_sub` (`idSubSwitch`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
