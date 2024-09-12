-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table smartacc.apbyr
CREATE TABLE IF NOT EXISTS `apbyr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodesup` varchar(10) DEFAULT NULL,
  `kodebyr` varchar(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` double DEFAULT 0,
  `sisa` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.apbyr: ~0 rows (approximately)

-- Dumping structure for table smartacc.aptrn
CREATE TABLE IF NOT EXISTS `aptrn` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodesup` varchar(10) DEFAULT NULL,
  `kodepu` varchar(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tgljthtempo` date DEFAULT NULL,
  `jumlah` double DEFAULT 0,
  `bayar1` double DEFAULT 0,
  `kodebyr1` varchar(11) DEFAULT NULL,
  `bayar2` double DEFAULT 0,
  `kodebyr2` varchar(11) DEFAULT NULL,
  `bayar3` double DEFAULT 0,
  `kodebyr3` varchar(11) DEFAULT NULL,
  `bayar4` double DEFAULT 0,
  `kodebyr4` varchar(11) DEFAULT NULL,
  `outstanding` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.aptrn: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_bayar
CREATE TABLE IF NOT EXISTS `ap_bayar` (
  `idbayar` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodesup` varchar(10) DEFAULT NULL,
  `kodebank` varchar(20) DEFAULT NULL,
  `tglbayar` date DEFAULT NULL,
  `kodebyr` varchar(20) DEFAULT NULL,
  `metodebayar` char(1) DEFAULT NULL,
  `jumlahbayar` double DEFAULT 0,
  `nomorcek` varchar(20) DEFAULT NULL,
  `tglcek` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `pph23` double DEFAULT 0,
  `statusid` int(11) DEFAULT 0,
  `matauang` varchar(50) DEFAULT NULL,
  `kurs` double DEFAULT 0,
  PRIMARY KEY (`idbayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_bayar: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_bayardetil
CREATE TABLE IF NOT EXISTS `ap_bayardetil` (
  `iddetil` int(10) NOT NULL AUTO_INCREMENT,
  `kodebyr` varchar(20) NOT NULL,
  `nomorfaktur` varchar(20) NOT NULL,
  `totalfaktur` double NOT NULL DEFAULT 0,
  `tglfaktur` date NOT NULL,
  `terhutang` double NOT NULL DEFAULT 0,
  `bayar` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `kurs` double NOT NULL DEFAULT 1,
  `akundiskon` varchar(20) NOT NULL,
  `jenisfaktur` char(1) NOT NULL COMMENT 'U= Uang Muka, F= Faktur',
  `uangmuka` double DEFAULT 0,
  PRIMARY KEY (`iddetil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_bayardetil: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_lpb
CREATE TABLE IF NOT EXISTS `ap_lpb` (
  `nolpb` varchar(20) NOT NULL,
  `kodecbg` varchar(2) DEFAULT NULL,
  `tgllpb` date DEFAULT NULL,
  `noterima` varchar(20) DEFAULT NULL,
  `kodesup` varchar(10) DEFAULT NULL,
  `kodepo` varchar(20) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `statusid` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tglkirim` date DEFAULT NULL,
  `gudang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nolpb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_lpb: ~1 rows (approximately)
INSERT INTO `ap_lpb` (`nolpb`, `kodecbg`, `tgllpb`, `noterima`, `kodesup`, `kodepo`, `kodeuser`, `tglrekam`, `statusid`, `keterangan`, `alamat`, `tglkirim`, `gudang`) VALUES
	('PB.2024.09.00001', '01', '2024-09-10', 'sj-001', 'S-01', 'PO.2024.09.00001', 'admin', '2024-09-10 15:30:24', 1, '', '', '2024-09-10', '1');

-- Dumping structure for table smartacc.ap_lpbdetil
CREATE TABLE IF NOT EXISTS `ap_lpbdetil` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nolpb` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(11) DEFAULT NULL,
  `qtyterima` float DEFAULT 0,
  `satuan` varchar(5) DEFAULT NULL,
  `gudang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_lpbdetil: ~1 rows (approximately)
INSERT INTO `ap_lpbdetil` (`id`, `nolpb`, `kodeitem`, `qtyterima`, `satuan`, `gudang`) VALUES
	(1, 'PB.2024.09.00001', 'HRDS-001', 1, 'Buah', '1');

-- Dumping structure for table smartacc.ap_pobiaya
CREATE TABLE IF NOT EXISTS `ap_pobiaya` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodepo` varchar(20) NOT NULL,
  `kodeakun` varchar(20) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_pobiaya: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_podetail
CREATE TABLE IF NOT EXISTS `ap_podetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodepo` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(10) DEFAULT NULL,
  `qtyorder` float DEFAULT 0,
  `satuan` varchar(4) DEFAULT NULL,
  `hargabeli` float DEFAULT 0,
  `qtykirim` float DEFAULT 0,
  `bof` char(1) DEFAULT NULL,
  `disc` float DEFAULT 0,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_podetail: ~1 rows (approximately)
INSERT INTO `ap_podetail` (`id`, `kodepo`, `kodeitem`, `qtyorder`, `satuan`, `hargabeli`, `qtykirim`, `bof`, `disc`, `kurs`) VALUES
	(2, 'PO.2024.09.00001', 'HRDS-001', 1, 'Buah', 300, 1, NULL, 0, 16000);

-- Dumping structure for table smartacc.ap_pofile
CREATE TABLE IF NOT EXISTS `ap_pofile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodesup` varchar(10) DEFAULT NULL,
  `tglpo` date DEFAULT NULL,
  `kodepo` varchar(20) DEFAULT NULL,
  `tgljatuhtempo` date DEFAULT NULL,
  `namakirim` varchar(40) DEFAULT NULL,
  `alamat1` varchar(40) DEFAULT NULL,
  `alamat2` varchar(40) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `dpp` double DEFAULT 0,
  `typeppn` char(1) DEFAULT NULL,
  `ppn` double DEFAULT 0,
  `ongkir` double DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `tgluangmuka` date DEFAULT NULL,
  `ketuangmuka` varchar(30) DEFAULT NULL,
  `uangmuka` double DEFAULT NULL,
  `kodetrans` varchar(10) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `statusid` int(11) DEFAULT 1,
  `tglkirim` date DEFAULT NULL,
  `sppn` char(1) DEFAULT NULL,
  `diskon` double DEFAULT 0,
  `biayalain` double DEFAULT 0,
  `totalpo` double DEFAULT 0,
  `matauang` varchar(50) DEFAULT NULL,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_pofile: ~1 rows (approximately)
INSERT INTO `ap_pofile` (`id`, `kodecbg`, `kodesup`, `tglpo`, `kodepo`, `tgljatuhtempo`, `namakirim`, `alamat1`, `alamat2`, `kota`, `kodepos`, `telp`, `hp`, `dpp`, `typeppn`, `ppn`, `ongkir`, `ket`, `tgluangmuka`, `ketuangmuka`, `uangmuka`, `kodetrans`, `kodeuser`, `tglentry`, `statusid`, `tglkirim`, `sppn`, `diskon`, `biayalain`, `totalpo`, `matauang`, `kurs`) VALUES
	(1, '01', 'S-01', '2024-09-10', 'PO.2024.09.00001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 300, NULL, 0, NULL, '-', NULL, NULL, NULL, NULL, 'admin', '2024-09-10 15:17:35', 2, '2024-09-10', 'T', 0, 0, 300, 'USD', 16000);

-- Dumping structure for table smartacc.ap_pubiaya
CREATE TABLE IF NOT EXISTS `ap_pubiaya` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodepu` varchar(20) NOT NULL,
  `kodeakun` varchar(20) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ap_pubiaya: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_pudetail
CREATE TABLE IF NOT EXISTS `ap_pudetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodepu` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(10) DEFAULT NULL,
  `qtypu` float DEFAULT NULL,
  `satuan` char(4) DEFAULT NULL,
  `hargabeli` double DEFAULT 0,
  `disc` double DEFAULT 0,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='purchasing detail';

-- Dumping data for table smartacc.ap_pudetail: ~1 rows (approximately)
INSERT INTO `ap_pudetail` (`id`, `kodepu`, `kodeitem`, `qtypu`, `satuan`, `hargabeli`, `disc`, `kurs`) VALUES
	(2, 'PU.2024.09.00001', 'HRDS-001', 1, 'Buah', 300, 0, 1);

-- Dumping structure for table smartacc.ap_pufile
CREATE TABLE IF NOT EXISTS `ap_pufile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodesup` char(10) DEFAULT NULL,
  `tglpu` date DEFAULT NULL,
  `kodepu` varchar(20) DEFAULT NULL,
  `kodepo` varchar(20) DEFAULT NULL,
  `kodepb` varchar(20) DEFAULT NULL,
  `tgljthtempo` date DEFAULT NULL,
  `namakirim` varchar(40) DEFAULT NULL,
  `tglkirim` date DEFAULT NULL,
  `alamat1` varchar(40) DEFAULT NULL,
  `alamat2` varchar(40) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `dpp` double DEFAULT 0,
  `typeppn` char(1) DEFAULT NULL,
  `ppn` double DEFAULT 0,
  `ongkir` double DEFAULT 0,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `disc` double DEFAULT 0,
  `biayalain` double DEFAULT 0,
  `nomorfaktur` varchar(20) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `statusid` int(11) DEFAULT 1,
  `pembayaran` char(1) DEFAULT 'T',
  `diskon` double DEFAULT 1,
  `sppn` char(1) DEFAULT NULL,
  `jumlahbayar` double DEFAULT 0,
  `totalpu` double DEFAULT 0,
  `uangmuka` double DEFAULT 0,
  `ppnbayar` double DEFAULT 0,
  `matauang` varchar(50) DEFAULT NULL,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='purchasing';

-- Dumping data for table smartacc.ap_pufile: ~1 rows (approximately)
INSERT INTO `ap_pufile` (`id`, `kodecbg`, `kodesup`, `tglpu`, `kodepu`, `kodepo`, `kodepb`, `tgljthtempo`, `namakirim`, `tglkirim`, `alamat1`, `alamat2`, `kota`, `kodepos`, `telp`, `dpp`, `typeppn`, `ppn`, `ongkir`, `kodeuser`, `tglentry`, `disc`, `biayalain`, `nomorfaktur`, `ket`, `statusid`, `pembayaran`, `diskon`, `sppn`, `jumlahbayar`, `totalpu`, `uangmuka`, `ppnbayar`, `matauang`, `kurs`) VALUES
	(1, '01', 'S-01', '2024-09-10', 'PU.2024.09.00001', 'PO.2024.09.00001', 'PB.2024.09.00001', '2024-09-10', NULL, '2024-09-10', '', NULL, NULL, NULL, NULL, 300, NULL, 0, 0, 'admin', '2024-09-10 15:49:52', 0, 0, 'f1', '-', 1, 'K', 0, 'T', 0, 300, 0, 0, 'USD', 16000);

-- Dumping structure for table smartacc.ap_retur
CREATE TABLE IF NOT EXISTS `ap_retur` (
  `idretur` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodesup` varchar(10) DEFAULT NULL,
  `kodepu` varchar(20) DEFAULT NULL,
  `koderetur` varchar(20) DEFAULT NULL,
  `tglretur` date DEFAULT NULL,
  `kodeuser` varchar(12) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `keterangan` varchar(100) DEFAULT NULL,
  `statusid` int(11) DEFAULT 1,
  `totalretur` double DEFAULT 0,
  `sppn` char(1) DEFAULT NULL,
  `ppn` double DEFAULT 0,
  `diskon` double DEFAULT 0,
  `dpp` double DEFAULT 0,
  `matauang` varchar(50) DEFAULT NULL,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`idretur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_retur: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_returdetil
CREATE TABLE IF NOT EXISTS `ap_returdetil` (
  `idreturdet` int(10) NOT NULL AUTO_INCREMENT,
  `koderetur` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(12) DEFAULT NULL,
  `qtyretur` float DEFAULT 0,
  `satuan` varchar(5) DEFAULT NULL,
  `hargabeli` float DEFAULT 0,
  `disc` float DEFAULT 0,
  `kodegudang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idreturdet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_returdetil: ~0 rows (approximately)

-- Dumping structure for table smartacc.ap_supplier
CREATE TABLE IF NOT EXISTS `ap_supplier` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat1` varchar(50) DEFAULT NULL,
  `alamat2` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `pkp` varchar(5) DEFAULT 'Y',
  `telp` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `contactname` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `top` double DEFAULT 0,
  `saldoawal` double DEFAULT 0,
  `saldojln` double DEFAULT 0,
  `jmlbelithn` double DEFAULT 0,
  `jmlbelithn1` double DEFAULT 0,
  `jmlbelithn2` double DEFAULT 0,
  `jmlbelithn3` double DEFAULT 0,
  `jmlbelithn4` double DEFAULT 0,
  `jmlbelithn5` double DEFAULT 0,
  `tglbeliakhir` date DEFAULT NULL,
  `jmlpo` double DEFAULT 0,
  `kode_user` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `kredit` char(1) DEFAULT 'T',
  `bataskredit` double DEFAULT 0,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_supplier: 0 rows
/*!40000 ALTER TABLE `ap_supplier` DISABLE KEYS */;
INSERT INTO `ap_supplier` (`kode`, `nama`, `alamat1`, `alamat2`, `kota`, `kodepos`, `pkp`, `telp`, `fax`, `hp`, `contactname`, `email`, `top`, `saldoawal`, `saldojln`, `jmlbelithn`, `jmlbelithn1`, `jmlbelithn2`, `jmlbelithn3`, `jmlbelithn4`, `jmlbelithn5`, `tglbeliakhir`, `jmlpo`, `kode_user`, `tglentry`, `kredit`, `bataskredit`) VALUES
	('S-01', 'SUPPLIER -1', '', '', '', '', 'T', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'admin', '2024-09-10 15:15:30', 'T', 0);
/*!40000 ALTER TABLE `ap_supplier` ENABLE KEYS */;

-- Dumping structure for table smartacc.ap_uangmuka
CREATE TABLE IF NOT EXISTS `ap_uangmuka` (
  `idum` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` varchar(2) DEFAULT NULL,
  `kodesup` varchar(10) DEFAULT NULL,
  `kodeum` varchar(20) DEFAULT NULL,
  `kodepo` varchar(20) DEFAULT NULL,
  `tglum` date DEFAULT NULL,
  `nomorfaktur` varchar(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `statusid` int(11) DEFAULT NULL,
  `kodeuser` varchar(20) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `jumlahum` double DEFAULT 0,
  `tgljthtempo` date DEFAULT NULL,
  `pembayaran` char(1) DEFAULT NULL,
  `kodebank` varchar(20) DEFAULT NULL,
  `norektujuan` varchar(20) DEFAULT NULL,
  `jumlahpo` double DEFAULT 0,
  `jumlahbayar` double DEFAULT 0,
  PRIMARY KEY (`idum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ap_uangmuka: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_customer
CREATE TABLE IF NOT EXISTS `ar_customer` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kode_cabang` int(11) DEFAULT NULL,
  `alamat1` varchar(50) DEFAULT NULL,
  `alamat2` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `contactname` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `top` double DEFAULT NULL,
  `saldoawal` double DEFAULT NULL,
  `saldojln` double DEFAULT NULL,
  `jmljualthn` double DEFAULT 0,
  `jmljualthn1` double DEFAULT 0,
  `jmljualthn2` double DEFAULT 0,
  `jmljualthn3` double DEFAULT 0,
  `jmljualthn4` double DEFAULT 0,
  `jmljualthn5` double DEFAULT 0,
  `tgljualakhir` date DEFAULT NULL,
  `jmlso` double DEFAULT NULL,
  `kode_user` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `npwp` varchar(20) DEFAULT NULL,
  `ktp` varchar(16) DEFAULT NULL,
  `tipe` char(1) DEFAULT NULL,
  `kredit` char(1) DEFAULT NULL,
  `bataskredit` double DEFAULT 0,
  `kodesales` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table smartacc.ar_customer: 0 rows
/*!40000 ALTER TABLE `ar_customer` DISABLE KEYS */;
INSERT INTO `ar_customer` (`kode`, `nama`, `kode_cabang`, `alamat1`, `alamat2`, `kota`, `kodepos`, `telp`, `fax`, `hp`, `contactname`, `email`, `top`, `saldoawal`, `saldojln`, `jmljualthn`, `jmljualthn1`, `jmljualthn2`, `jmljualthn3`, `jmljualthn4`, `jmljualthn5`, `tgljualakhir`, `jmlso`, `kode_user`, `tglentry`, `npwp`, `ktp`, `tipe`, `kredit`, `bataskredit`, `kodesales`) VALUES
	('ER', 'ER', NULL, '', '', '', '', '', '', '111', '', '', 0, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, 'admin', '2024-09-10 16:02:34', '', '123', '1', 'T', 0, '');
/*!40000 ALTER TABLE `ar_customer` ENABLE KEYS */;

-- Dumping structure for table smartacc.ar_kirim
CREATE TABLE IF NOT EXISTS `ar_kirim` (
  `kodekirim` varchar(20) NOT NULL,
  `kodecbg` varchar(2) DEFAULT NULL,
  `tglkirim` date DEFAULT NULL,
  `kodecust` varchar(10) DEFAULT NULL,
  `kodeso` varchar(20) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `statusid` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `gudang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kodekirim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_kirim: ~1 rows (approximately)
INSERT INTO `ar_kirim` (`kodekirim`, `kodecbg`, `tglkirim`, `kodecust`, `kodeso`, `kodeuser`, `tglrekam`, `statusid`, `keterangan`, `alamat`, `gudang`) VALUES
	('SD.2024.09.00001', '01', '2024-09-10', 'ER', 'SO.2024.09.00001', 'admin', '2024-09-10 16:11:39', 1, '', '', '1');

-- Dumping structure for table smartacc.ar_kirimdetil
CREATE TABLE IF NOT EXISTS `ar_kirimdetil` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodekirim` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(11) DEFAULT NULL,
  `qtykirim` float DEFAULT 0,
  `satuan` varchar(5) DEFAULT NULL,
  `gudang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_kirimdetil: ~0 rows (approximately)
INSERT INTO `ar_kirimdetil` (`id`, `kodekirim`, `kodeitem`, `qtykirim`, `satuan`, `gudang`) VALUES
	(1, 'SD.2024.09.00001', 'HRDS-001', 1, 'Buah', '1');

-- Dumping structure for table smartacc.ar_penerimaan
CREATE TABLE IF NOT EXISTS `ar_penerimaan` (
  `idterima` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodecust` varchar(10) DEFAULT NULL,
  `kodebank` varchar(20) DEFAULT NULL,
  `tglbayar` date DEFAULT NULL,
  `kodebyr` varchar(20) DEFAULT NULL,
  `metodebayar` char(1) DEFAULT NULL,
  `jumlahbayar` double DEFAULT 0,
  `nomorcek` varchar(20) DEFAULT NULL,
  `tglcek` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `pph23` double DEFAULT 0,
  `statusid` int(11) DEFAULT 0,
  PRIMARY KEY (`idterima`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_penerimaan: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_penerimaandetil
CREATE TABLE IF NOT EXISTS `ar_penerimaandetil` (
  `iddetil` int(10) NOT NULL AUTO_INCREMENT,
  `kodebyr` varchar(20) NOT NULL,
  `nomorfaktur` varchar(20) NOT NULL,
  `totalfaktur` double NOT NULL DEFAULT 0,
  `tglfaktur` date NOT NULL,
  `terhutang` double NOT NULL DEFAULT 0,
  `bayar` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `akundiskon` varchar(20) NOT NULL,
  `jenisfaktur` char(1) NOT NULL COMMENT 'U= Uang Muka, F= Faktur',
  `uangmuka` double DEFAULT 0,
  PRIMARY KEY (`iddetil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_penerimaandetil: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_retur
CREATE TABLE IF NOT EXISTS `ar_retur` (
  `idretur` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodecust` varchar(10) DEFAULT NULL,
  `kodesi` varchar(20) DEFAULT NULL,
  `koderetur` varchar(20) DEFAULT NULL,
  `tglretur` date DEFAULT NULL,
  `kodeuser` varchar(12) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `keterangan` varchar(100) DEFAULT NULL,
  `statusid` int(11) DEFAULT 1,
  `totalretur` double DEFAULT 0,
  `sppn` char(1) DEFAULT NULL,
  `ppn` double DEFAULT 0,
  `diskon` double DEFAULT 0,
  `dpp` double DEFAULT 0,
  PRIMARY KEY (`idretur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_retur: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_returdetil
CREATE TABLE IF NOT EXISTS `ar_returdetil` (
  `idreturdet` int(10) NOT NULL AUTO_INCREMENT,
  `koderetur` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(12) DEFAULT NULL,
  `qtyretur` float DEFAULT 0,
  `satuan` varchar(5) DEFAULT NULL,
  `hargajual` float DEFAULT 0,
  `disc` float DEFAULT 0,
  `kodegudang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idreturdet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_returdetil: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_sibiaya
CREATE TABLE IF NOT EXISTS `ar_sibiaya` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodesi` varchar(20) NOT NULL,
  `kodeakun` varchar(20) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_sibiaya: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_sidetail
CREATE TABLE IF NOT EXISTS `ar_sidetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodesi` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(12) DEFAULT NULL,
  `qtysi` double DEFAULT 0,
  `satuan` varchar(4) DEFAULT NULL,
  `hpp` double DEFAULT 0,
  `hargajual` double DEFAULT 0,
  `disc` double DEFAULT 0,
  `kurs` double DEFAULT 1,
  `kirim` char(1) DEFAULT '0',
  `kasirflag` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ar_sidetail: ~0 rows (approximately)
INSERT INTO `ar_sidetail` (`id`, `kodesi`, `kodeitem`, `qtysi`, `satuan`, `hpp`, `hargajual`, `disc`, `kurs`, `kirim`, `kasirflag`) VALUES
	(2, 'SI.2024.09.00001', 'HRDS-001', 1, 'Buah', 225, 400, 0, 1, '0', '0');

-- Dumping structure for table smartacc.ar_sifile
CREATE TABLE IF NOT EXISTS `ar_sifile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` varchar(2) DEFAULT NULL,
  `kodecust` varchar(10) DEFAULT NULL,
  `tglsi` date DEFAULT NULL,
  `kodesi` varchar(20) DEFAULT NULL,
  `tglkirim` date DEFAULT NULL,
  `kodeso` varchar(20) DEFAULT NULL,
  `kodesd` varchar(20) DEFAULT NULL,
  `tgljthtempo` date DEFAULT NULL,
  `namakirim` varchar(50) DEFAULT NULL,
  `alamat1` varchar(50) DEFAULT NULL,
  `alamat2` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` char(5) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `subtotal` double DEFAULT 0,
  `discperc` double DEFAULT 0,
  `discamount` double DEFAULT 0,
  `dpp` double DEFAULT 0,
  `typeppn` char(1) DEFAULT '0',
  `ppn` double DEFAULT 0,
  `ongkir` double DEFAULT 0,
  `uangmuka` double DEFAULT 0,
  `point` double DEFAULT 0,
  `kasirflag` char(1) DEFAULT 'N',
  `kodeuser` varchar(11) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `biayalain` double DEFAULT 0,
  `diskon` double DEFAULT 0,
  `totalsi` double DEFAULT 0,
  `ket` varchar(100) DEFAULT NULL,
  `statusid` int(11) DEFAULT 1,
  `alamat` varchar(100) DEFAULT NULL,
  `pembayaran` char(1) DEFAULT NULL,
  `sppn` char(1) DEFAULT NULL,
  `jumlahbayar` double DEFAULT 0,
  `matauang` varchar(50) DEFAULT NULL,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ar_sifile: ~1 rows (approximately)
INSERT INTO `ar_sifile` (`id`, `kodecbg`, `kodecust`, `tglsi`, `kodesi`, `tglkirim`, `kodeso`, `kodesd`, `tgljthtempo`, `namakirim`, `alamat1`, `alamat2`, `kota`, `kodepos`, `telp`, `hp`, `npwp`, `subtotal`, `discperc`, `discamount`, `dpp`, `typeppn`, `ppn`, `ongkir`, `uangmuka`, `point`, `kasirflag`, `kodeuser`, `tglentry`, `biayalain`, `diskon`, `totalsi`, `ket`, `statusid`, `alamat`, `pembayaran`, `sppn`, `jumlahbayar`, `matauang`, `kurs`) VALUES
	(1, '01', 'ER', '2024-09-10', 'SI.2024.09.00001', '2024-09-10', 'SO.2024.09.00001', 'SD.2024.09.00001', '2024-09-10', '', '', '', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 400, '0', 0, 0, 0, 0, 'N', 'admin', '2024-09-10 16:22:43', 0, 0, 400, '', 1, '', 'K', 'T', 0, 'USD', 16000);

-- Dumping structure for table smartacc.ar_sobiaya
CREATE TABLE IF NOT EXISTS `ar_sobiaya` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodeso` varchar(20) NOT NULL,
  `kodeakun` varchar(20) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_sobiaya: ~0 rows (approximately)

-- Dumping structure for table smartacc.ar_sodetail
CREATE TABLE IF NOT EXISTS `ar_sodetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodeso` varchar(20) DEFAULT NULL,
  `kodeitem` varchar(10) DEFAULT NULL,
  `qtyorder` float DEFAULT 0,
  `satuan` varchar(4) DEFAULT NULL,
  `hargajual` float DEFAULT 0,
  `qtykirim` float DEFAULT 0,
  `bof` char(1) DEFAULT NULL,
  `disc` float DEFAULT 0,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_sodetail: ~0 rows (approximately)
INSERT INTO `ar_sodetail` (`id`, `kodeso`, `kodeitem`, `qtyorder`, `satuan`, `hargajual`, `qtykirim`, `bof`, `disc`, `kurs`) VALUES
	(51, 'SO.2024.09.00001', 'HRDS-001', 1, 'Buah', 400, 1, NULL, 0, 1);

-- Dumping structure for table smartacc.ar_sofile
CREATE TABLE IF NOT EXISTS `ar_sofile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodecust` varchar(10) DEFAULT NULL,
  `tglso` date DEFAULT NULL,
  `kodeso` varchar(20) DEFAULT NULL,
  `tgljatuhtempo` date DEFAULT NULL,
  `namakirim` varchar(40) DEFAULT NULL,
  `alamat1` varchar(40) DEFAULT NULL,
  `alamat2` varchar(40) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `dpp` double DEFAULT 0,
  `typeppn` char(1) DEFAULT NULL,
  `ppn` double DEFAULT 0,
  `ongkir` double DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `tgluangmuka` date DEFAULT NULL,
  `ketuangmuka` varchar(30) DEFAULT NULL,
  `uangmuka` double DEFAULT NULL,
  `kodetrans` varchar(10) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `statusid` int(11) DEFAULT 1,
  `tglkirim` date DEFAULT NULL,
  `sppn` char(1) DEFAULT NULL,
  `diskon` double DEFAULT 0,
  `biayalain` double DEFAULT 0,
  `pembayaran` char(1) DEFAULT NULL,
  `totalso` double DEFAULT 0,
  `alamat` varchar(200) DEFAULT NULL,
  `matauang` varchar(20) DEFAULT NULL,
  `kurs` double DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_sofile: ~1 rows (approximately)
INSERT INTO `ar_sofile` (`id`, `kodecbg`, `kodecust`, `tglso`, `kodeso`, `tgljatuhtempo`, `namakirim`, `alamat1`, `alamat2`, `kota`, `kodepos`, `telp`, `hp`, `dpp`, `typeppn`, `ppn`, `ongkir`, `ket`, `tgluangmuka`, `ketuangmuka`, `uangmuka`, `kodetrans`, `kodeuser`, `tglentry`, `statusid`, `tglkirim`, `sppn`, `diskon`, `biayalain`, `pembayaran`, `totalso`, `alamat`, `matauang`, `kurs`) VALUES
	(1, '01', 'ER', '2024-09-10', 'SO.2024.09.00001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 400, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, 'admin', '2024-09-10 16:03:35', 2, '2024-09-10', 'T', 0, 0, 'K', 400, '', 'USD', 16000);

-- Dumping structure for table smartacc.ar_uangmuka
CREATE TABLE IF NOT EXISTS `ar_uangmuka` (
  `idum` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` varchar(2) DEFAULT NULL,
  `kodecust` varchar(10) DEFAULT NULL,
  `kodeum` varchar(20) DEFAULT NULL,
  `kodeso` varchar(20) DEFAULT NULL,
  `tglum` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `statusid` int(11) DEFAULT NULL,
  `kodeuser` varchar(20) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `jumlahum` double DEFAULT 0,
  `tgljthtempo` date DEFAULT NULL,
  `pembayaran` char(1) DEFAULT NULL,
  `kodebank` varchar(20) DEFAULT NULL,
  `nomorkartu` varchar(20) DEFAULT NULL,
  `jumlahso` double DEFAULT 0,
  `jumlahbayar` double DEFAULT 0,
  `sppn` char(1) DEFAULT NULL,
  `ppn` double DEFAULT 0,
  PRIMARY KEY (`idum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ar_uangmuka: ~0 rows (approximately)

-- Dumping structure for table smartacc.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ci_sessions: ~0 rows (approximately)

-- Dumping structure for table smartacc.hrd_absen
CREATE TABLE IF NOT EXISTS `hrd_absen` (
  `kode` char(1) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `potongan` float DEFAULT 0,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_absen: 4 rows
/*!40000 ALTER TABLE `hrd_absen` DISABLE KEYS */;
INSERT INTO `hrd_absen` (`kode`, `nama`, `potongan`) VALUES
	('I', 'IJIN', 0),
	('S', 'SAKIT', 0),
	('M', 'MANGKIR', 0),
	('C', 'CUTI', 0);
/*!40000 ALTER TABLE `hrd_absen` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_absensi
CREATE TABLE IF NOT EXISTS `hrd_absensi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(10) DEFAULT 0,
  `tanggal` date DEFAULT NULL,
  `id_unit` int(11) DEFAULT 0,
  `jenisabsen` char(1) DEFAULT NULL,
  `potongan` float DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_absensi: 0 rows
/*!40000 ALTER TABLE `hrd_absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_absensi` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_agama
CREATE TABLE IF NOT EXISTS `hrd_agama` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_agama: 1 rows
/*!40000 ALTER TABLE `hrd_agama` DISABLE KEYS */;
INSERT INTO `hrd_agama` (`kode`, `nama`) VALUES
	(1, 'Islam');
/*!40000 ALTER TABLE `hrd_agama` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_departemen
CREATE TABLE IF NOT EXISTS `hrd_departemen` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_departemen: 4 rows
/*!40000 ALTER TABLE `hrd_departemen` DISABLE KEYS */;
INSERT INTO `hrd_departemen` (`kode`, `nama`) VALUES
	(1, 'Pembelian'),
	(2, 'Penjualan'),
	(3, 'Gudang'),
	(4, 'Keuangan');
/*!40000 ALTER TABLE `hrd_departemen` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_jabatan
CREATE TABLE IF NOT EXISTS `hrd_jabatan` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_jabatan: 2 rows
/*!40000 ALTER TABLE `hrd_jabatan` DISABLE KEYS */;
INSERT INTO `hrd_jabatan` (`kode`, `nama`) VALUES
	(4, 'Kepala Toko'),
	(5, 'Kasir');
/*!40000 ALTER TABLE `hrd_jabatan` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_karyawan
CREATE TABLE IF NOT EXISTS `hrd_karyawan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_id` varchar(5) DEFAULT '0',
  `user_id` int(10) DEFAULT 0,
  `nama` varchar(100) DEFAULT NULL,
  `noktp` varchar(16) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `ptkp_id` int(11) DEFAULT NULL,
  `grossup` char(1) DEFAULT NULL,
  `departemen_id` int(11) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `alamat1` varchar(50) DEFAULT NULL,
  `alamat2` varchar(50) DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `referensi` varchar(50) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `tglmasuk` date DEFAULT NULL,
  `tglkeluar` date DEFAULT NULL,
  `fotokaryawan` varchar(50) DEFAULT NULL,
  `fotoktp` varchar(50) DEFAULT NULL,
  `fotoperjanjian` varchar(50) DEFAULT NULL,
  `kelamin` char(1) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `nip` varchar(10) DEFAULT NULL,
  `warganegara` varchar(10) DEFAULT NULL,
  `alasanberhenti` char(1) DEFAULT NULL,
  `gapok` double DEFAULT 0,
  `tunjanganpph` double DEFAULT 0,
  `uanglembur` double DEFAULT 0,
  `uangtransport` double DEFAULT 0,
  `uangmakan` double DEFAULT 0,
  `uangpulsa` double DEFAULT 0,
  `jkm` double DEFAULT 0,
  `jkk` double DEFAULT 0,
  `askes` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_karyawan: ~1 rows (approximately)
INSERT INTO `hrd_karyawan` (`id`, `unit_id`, `user_id`, `nama`, `noktp`, `jabatan_id`, `ptkp_id`, `grossup`, `departemen_id`, `agama_id`, `alamat1`, `alamat2`, `rt`, `rw`, `kelurahan`, `kota`, `hp`, `referensi`, `tgllahir`, `tglmasuk`, `tglkeluar`, `fotokaryawan`, `fotoktp`, `fotoperjanjian`, `kelamin`, `tglentry`, `nip`, `warganegara`, `alasanberhenti`, `gapok`, `tunjanganpph`, `uanglembur`, `uangtransport`, `uangmakan`, `uangpulsa`, `jkm`, `jkk`, `askes`) VALUES
	(1, NULL, 0, 'KARYAWAN 1', '', 0, 1, 'Y', 1, 0, '', '', '', '', '', '', '', '', '1970-01-01', '1970-01-01', '1970-01-01', NULL, NULL, NULL, 'L', '2024-09-10 14:39:40', '001', NULL, 'A', 5000000, 0, 0, 0, 0, 0, 0, 0, 0);

-- Dumping structure for table smartacc.hrd_mstpayroll
CREATE TABLE IF NOT EXISTS `hrd_mstpayroll` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(10) DEFAULT 0,
  `nip` varchar(10) DEFAULT NULL,
  `gajipokok` float DEFAULT 0,
  `uangmakan` float DEFAULT 0,
  `tunjangan` float DEFAULT 0,
  `bpjspt` float DEFAULT 0,
  `bpjsuser` float DEFAULT 0,
  `potongan` float DEFAULT 0,
  `pph` float DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_mstpayroll: 0 rows
/*!40000 ALTER TABLE `hrd_mstpayroll` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_mstpayroll` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_mstpinjaman
CREATE TABLE IF NOT EXISTS `hrd_mstpinjaman` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_unit` int(10) DEFAULT 0,
  `id_karyawan` int(10) DEFAULT 0,
  `nik` varchar(10) DEFAULT '0',
  `tglpinjam` date DEFAULT NULL,
  `jumlah` float DEFAULT 0,
  `potongan` float DEFAULT 0,
  `kali` float DEFAULT 0,
  `sisa` float DEFAULT 0,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_mstpinjaman: 0 rows
/*!40000 ALTER TABLE `hrd_mstpinjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrd_mstpinjaman` ENABLE KEYS */;

-- Dumping structure for table smartacc.hrd_transpayroll
CREATE TABLE IF NOT EXISTS `hrd_transpayroll` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bulan` int(10) DEFAULT 0,
  `tahun` int(10) DEFAULT 0,
  `tglpay` date DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT 0,
  `gapok` double DEFAULT 0,
  `tunjanganpph` double DEFAULT 0,
  `uanglembur` double DEFAULT 0,
  `uangtransport` double DEFAULT 0,
  `uangpulsa` double DEFAULT 0,
  `uangmakan` double DEFAULT 0,
  `jkm` double DEFAULT 0,
  `jkk` double DEFAULT 0,
  `askes` double DEFAULT 0,
  `potongan` double DEFAULT 0,
  `bonus` double DEFAULT 0,
  `pph` double DEFAULT 0,
  `thp` double DEFAULT 0,
  `userid` varchar(20) DEFAULT '0',
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.hrd_transpayroll: ~1 rows (approximately)
INSERT INTO `hrd_transpayroll` (`id`, `bulan`, `tahun`, `tglpay`, `id_karyawan`, `gapok`, `tunjanganpph`, `uanglembur`, `uangtransport`, `uangpulsa`, `uangmakan`, `jkm`, `jkk`, `askes`, `potongan`, `bonus`, `pph`, `thp`, `userid`, `tglentry`) VALUES
	(1, 9, 2024, '2024-09-10', 1, 5000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000000, '', '2024-09-09 17:00:00');

-- Dumping structure for table smartacc.inv_adj
CREATE TABLE IF NOT EXISTS `inv_adj` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `kodetrn` varchar(11) DEFAULT NULL,
  `kodeitem` varchar(12) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `satuan` varchar(4) DEFAULT NULL,
  `hargabeli` double DEFAULT NULL,
  `hpp` double DEFAULT NULL,
  `hargajual` double DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_adj: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_barang
CREATE TABLE IF NOT EXISTS `inv_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeitem` varchar(12) NOT NULL DEFAULT '',
  `kdcbg` char(2) DEFAULT NULL,
  `kdkategori` int(11) DEFAULT NULL,
  `namabarang` varchar(50) DEFAULT NULL,
  `hargabeli` double DEFAULT 0,
  `tglbeliakhir` date DEFAULT NULL,
  `stok` double DEFAULT 0,
  `stok_min` double DEFAULT 0,
  `stok_max` double DEFAULT 0,
  `satuan` varchar(20) DEFAULT NULL,
  `kdgudang` int(11) DEFAULT NULL,
  `kdrak` int(11) DEFAULT NULL,
  `hargajual` double DEFAULT 0,
  `tgljualakhir` date DEFAULT NULL,
  `kode_user` varchar(15) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `ppn` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_barang: 1 rows
/*!40000 ALTER TABLE `inv_barang` DISABLE KEYS */;
INSERT INTO `inv_barang` (`id`, `kodeitem`, `kdcbg`, `kdkategori`, `namabarang`, `hargabeli`, `tglbeliakhir`, `stok`, `stok_min`, `stok_max`, `satuan`, `kdgudang`, `kdrak`, `hargajual`, `tgljualakhir`, `kode_user`, `tglentry`, `ppn`) VALUES
	(1, 'HRDS-001', '01', 4, 'HARDDISK SERVER', 225, NULL, 0, 0, 0, 'Buah', 0, 0, 0, NULL, 'admin', '2024-09-10 15:16:18', 'Y');
/*!40000 ALTER TABLE `inv_barang` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_barang_gudang
CREATE TABLE IF NOT EXISTS `inv_barang_gudang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodeitem` varchar(10) DEFAULT NULL,
  `gudang` varchar(10) DEFAULT NULL,
  `qty` float DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_barang_gudang: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_discp3
CREATE TABLE IF NOT EXISTS `inv_discp3` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tglberlaku` date DEFAULT NULL,
  `kodeitem` varchar(10) DEFAULT NULL,
  `satuan` varchar(4) DEFAULT NULL,
  `pricelist` decimal(11,2) DEFAULT NULL,
  `disc11` decimal(11,2) DEFAULT NULL,
  `disc12` decimal(11,2) DEFAULT NULL,
  `disc13` decimal(11,2) DEFAULT NULL,
  `disc21` decimal(11,2) DEFAULT NULL,
  `disc22` decimal(11,2) DEFAULT NULL,
  `disc23` decimal(11,2) DEFAULT NULL,
  `disc31` decimal(11,2) DEFAULT NULL,
  `disc32` decimal(11,2) DEFAULT NULL,
  `disc33` decimal(11,2) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `kodeuser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_discp3: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_gudang
CREATE TABLE IF NOT EXISTS `inv_gudang` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_gudang: 1 rows
/*!40000 ALTER TABLE `inv_gudang` DISABLE KEYS */;
INSERT INTO `inv_gudang` (`kode`, `nama`) VALUES
	(1, 'GUDANG - 11');
/*!40000 ALTER TABLE `inv_gudang` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_hrgjualm
CREATE TABLE IF NOT EXISTS `inv_hrgjualm` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tglhrgjualm` date DEFAULT NULL,
  `kodeitem` varchar(10) DEFAULT NULL,
  `satuan` varchar(4) DEFAULT NULL,
  `pricelist` decimal(11,2) DEFAULT NULL,
  `hargajual1` decimal(11,2) DEFAULT NULL,
  `hargajual2` decimal(11,2) DEFAULT NULL,
  `hargajual3` decimal(11,2) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `kodeuser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_hrgjualm: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_import
CREATE TABLE IF NOT EXISTS `inv_import` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT '0',
  `nama` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_import: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_kategori
CREATE TABLE IF NOT EXISTS `inv_kategori` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_kategori: 1 rows
/*!40000 ALTER TABLE `inv_kategori` DISABLE KEYS */;
INSERT INTO `inv_kategori` (`kode`, `nama`) VALUES
	(4, 'KOMPUTER');
/*!40000 ALTER TABLE `inv_kategori` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_konversi
CREATE TABLE IF NOT EXISTS `inv_konversi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodeitem1` varchar(12) DEFAULT NULL,
  `kodeitem2` varchar(12) DEFAULT NULL,
  `satuan1` varchar(4) DEFAULT NULL,
  `satuan2` varchar(4) DEFAULT NULL,
  `qty1` decimal(11,2) DEFAULT NULL,
  `qty2` decimal(11,2) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `userid` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_konversi: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_merk
CREATE TABLE IF NOT EXISTS `inv_merk` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_merk: 1 rows
/*!40000 ALTER TABLE `inv_merk` DISABLE KEYS */;
INSERT INTO `inv_merk` (`kode`, `nama`) VALUES
	(2, 'GENIUS');
/*!40000 ALTER TABLE `inv_merk` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_mutasi
CREATE TABLE IF NOT EXISTS `inv_mutasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodeitem1` varchar(12) NOT NULL,
  `kodeitem2` varchar(12) NOT NULL,
  `qty1` double NOT NULL,
  `qty2` double NOT NULL,
  `satuan1` varchar(4) NOT NULL,
  `satuan2` varchar(4) NOT NULL,
  `konversi` double NOT NULL,
  `tglentry` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_mutasi: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_promo
CREATE TABLE IF NOT EXISTS `inv_promo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tglawal` date DEFAULT NULL,
  `tglakhir` date DEFAULT NULL,
  `kodeitem` varchar(12) DEFAULT NULL,
  `qty` double DEFAULT 0,
  `satuan` varchar(4) DEFAULT NULL,
  `hrg1` double DEFAULT 0,
  `hrg2` double DEFAULT 0,
  `hrg3` double DEFAULT 0,
  `bnsitem` varchar(12) DEFAULT NULL,
  `bnsqty` double DEFAULT 0,
  `bnssat` varchar(4) DEFAULT NULL,
  `bnshrg1` double DEFAULT 0,
  `bnshrg2` double DEFAULT 0,
  `bnshrg3` double DEFAULT 0,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `kodeuser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_promo: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_rak
CREATE TABLE IF NOT EXISTS `inv_rak` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_rak: 2 rows
/*!40000 ALTER TABLE `inv_rak` DISABLE KEYS */;
INSERT INTO `inv_rak` (`kode`, `nama`) VALUES
	(1, 'rak-11'),
	(2, 'rak-2');
/*!40000 ALTER TABLE `inv_rak` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_satuan
CREATE TABLE IF NOT EXISTS `inv_satuan` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_satuan: 3 rows
/*!40000 ALTER TABLE `inv_satuan` DISABLE KEYS */;
INSERT INTO `inv_satuan` (`kode`, `nama`) VALUES
	(4, 'Buah'),
	(5, 'drum'),
	(6, 'liter');
/*!40000 ALTER TABLE `inv_satuan` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_stockopname
CREATE TABLE IF NOT EXISTS `inv_stockopname` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `koderak` varchar(5) DEFAULT NULL,
  `kdsubkat` varchar(4) DEFAULT NULL,
  `kodemerk` varchar(4) DEFAULT NULL,
  `kodeitem` varchar(12) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `sat` varchar(4) DEFAULT NULL,
  `qty_opname` double DEFAULT NULL,
  `hpp` double DEFAULT NULL,
  `selisih` double DEFAULT NULL,
  `nilai_selisih` double DEFAULT NULL,
  `pic` varchar(10) DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_stockopname: ~0 rows (approximately)

-- Dumping structure for table smartacc.inv_subkategori
CREATE TABLE IF NOT EXISTS `inv_subkategori` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `kode_kateg` int(10) DEFAULT 0,
  `nama` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_subkategori: 0 rows
/*!40000 ALTER TABLE `inv_subkategori` DISABLE KEYS */;
/*!40000 ALTER TABLE `inv_subkategori` ENABLE KEYS */;

-- Dumping structure for table smartacc.inv_transaksi
CREATE TABLE IF NOT EXISTS `inv_transaksi` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `kodeitem` varchar(12) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `penerimaan` float NOT NULL,
  `pengeluaran` float NOT NULL,
  `userid` varchar(50) NOT NULL,
  `hpp` float NOT NULL,
  `hargajual` float NOT NULL,
  `nobukti` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `tglrekam` timestamp NOT NULL DEFAULT current_timestamp(),
  `ket` varchar(200) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.inv_transaksi: ~0 rows (approximately)
INSERT INTO `inv_transaksi` (`nomor`, `tanggal`, `kodeitem`, `jenis`, `penerimaan`, `pengeluaran`, `userid`, `hpp`, `hargajual`, `nobukti`, `satuan`, `tglrekam`, `ket`) VALUES
	(1, '2024-09-10', 'HRDS-001', 'Pembelian', 1, 0, '', 300, 0, 'PU.2024.09.00001', 'Buah', '2024-09-10 10:49:51', ''),
	(2, '2024-09-10', 'HRDS-001', 'Pembelian', 1, 0, '', 300, 0, 'PU.2024.09.00001', 'Buah', '2024-09-10 10:54:24', ''),
	(3, '2024-09-10', 'HRDS-001', 'Penjualan', 0, 1, '', 225, 0, 'SD.2024.09.00001', 'Buah', '2024-09-10 11:11:38', '');

-- Dumping structure for table smartacc.kasirtrn
CREATE TABLE IF NOT EXISTS `kasirtrn` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kodesumber` varchar(11) DEFAULT NULL,
  `kodetrans` varchar(11) DEFAULT NULL,
  `kodekasbank` varchar(11) DEFAULT NULL,
  `tglbayar` date DEFAULT NULL,
  `dbcr` char(1) DEFAULT NULL,
  `jumlah` double DEFAULT 0,
  `jmlbayar` double DEFAULT 0,
  `kodekasbank1` varchar(11) DEFAULT NULL,
  `jmlbayar1` double DEFAULT 0,
  `nokartu` varchar(20) DEFAULT NULL,
  `kembali` double DEFAULT 0,
  `ket` varchar(40) DEFAULT NULL,
  `closedate` char(1) DEFAULT NULL,
  `jamclosed` time DEFAULT NULL,
  `kodeuser` varchar(10) DEFAULT NULL,
  `tglentry` timestamp NULL DEFAULT current_timestamp(),
  `kode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.kasirtrn: ~0 rows (approximately)

-- Dumping structure for table smartacc.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.logs: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_akun
CREATE TABLE IF NOT EXISTS `ms_akun` (
  `kodeakun` varchar(20) NOT NULL,
  `namaakun` varchar(100) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT 'A',
  `kelompok` varchar(4) DEFAULT NULL,
  `akuninduk` varchar(20) DEFAULT NULL,
  `saldoawal` double DEFAULT 0,
  `saldoawal_tgl` date DEFAULT NULL,
  `kodecab` char(2) DEFAULT NULL,
  `tx` char(1) DEFAULT NULL,
  `kodem` varchar(10) DEFAULT NULL,
  `kodek` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kodeakun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_akun: ~96 rows (approximately)
INSERT INTO `ms_akun` (`kodeakun`, `namaakun`, `jenis`, `status`, `kelompok`, `akuninduk`, `saldoawal`, `saldoawal_tgl`, `kodecab`, `tx`, `kodem`, `kodek`) VALUES
	('101', 'BANK', NULL, 'A', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
	('1101', 'Kas & Bank', NULL, 'A', 'BANK', NULL, 0, NULL, NULL, 'T', '', ''),
	('110101', 'Kas Kecil', NULL, 'A', 'BANK', '1101', 0, NULL, 'KK', 'Y', 'KM', 'KK'),
	('110102', 'Bank', NULL, 'A', 'BANK', '1101', 0, NULL, NULL, 'Y', NULL, NULL),
	('1102', 'Setara Kas', NULL, 'A', 'BANK', '', 0, NULL, NULL, 'T', '', ''),
	('110201', 'Deposito Bank', NULL, 'A', 'BANK', '1102', 0, NULL, NULL, 'Y', NULL, NULL),
	('110202', 'BRI', NULL, 'A', 'BANK', '1102', 0, NULL, NULL, 'Y', 'BRIM', 'BRIK'),
	('1103', 'Piutang Usaha', NULL, 'A', 'AREC', '', 0, NULL, NULL, 'T', '', ''),
	('110301', 'Piutang Usaha IDR', NULL, 'A', 'AREC', '1103', 0, NULL, NULL, 'Y', NULL, NULL),
	('110302', 'Uang Muka Pembelian IDR', NULL, 'A', 'AREC', '1103', 0, NULL, NULL, 'Y', NULL, NULL),
	('1104', 'Persediaan', NULL, 'A', 'INTR', '', 0, NULL, NULL, 'T', '', ''),
	('110401', 'Persediaan', NULL, 'A', 'INTR', '1104', 0, NULL, NULL, 'Y', NULL, NULL),
	('110402', 'Persediaan Terkirim', NULL, 'A', 'INTR', '1104', 0, NULL, NULL, 'Y', NULL, NULL),
	('1105', 'Aset Lancar Lainnya', NULL, 'A', 'OCAS', '', 0, NULL, NULL, 'T', '', ''),
	('110501', 'Perlengkapan Kantor', NULL, 'A', 'OCAS', '1105', 0, NULL, NULL, 'Y', NULL, NULL),
	('110502', 'Sewa Gedung Dibayar Dimuka', NULL, 'A', 'OCAS', '1105', 0, NULL, NULL, 'Y', NULL, NULL),
	('110503', 'Asuransi Dibayar Dimuka', NULL, 'A', 'OCAS', '1105', 0, NULL, NULL, 'Y', NULL, NULL),
	('110504', 'PPN Masukan', NULL, 'A', 'OCAS', '1105', 0, NULL, NULL, 'Y', NULL, NULL),
	('110505', 'PPh 23 Penjualan', NULL, 'A', 'OCAS', '1105', 0, NULL, NULL, 'Y', NULL, NULL),
	('110506', 'PPh Ps.4(2) Penjualan', NULL, 'A', 'OCAS', '', 0, NULL, NULL, 'Y', NULL, NULL),
	('1200', 'Aset Tetap', NULL, 'A', 'FASS', '', 0, NULL, NULL, 'T', '', ''),
	('120001', 'Tanah', NULL, 'A', 'FASS', '1200', 0, NULL, NULL, 'Y', NULL, NULL),
	('120002', 'Gedung', NULL, 'A', 'FASS', '1200', 0, NULL, NULL, 'Y', NULL, NULL),
	('120003', 'Kendaraan', NULL, 'A', 'FASS', '1200', 0, NULL, NULL, 'Y', NULL, NULL),
	('120004', 'Peralatan', NULL, 'A', 'FASS', '1200', 0, NULL, NULL, 'Y', NULL, NULL),
	('120005', 'Inventaris Kantor', NULL, 'A', 'FASS', '1200', 0, NULL, NULL, 'Y', NULL, NULL),
	('120006', 'Akumulasi Depresiasi Aset Tetap', NULL, 'A', 'DEPR', '', 0, NULL, NULL, 'T', '', ''),
	('12000601', 'Akumulasi Penyusutan Gedung', NULL, 'A', 'DEPR', '120006', 0, NULL, NULL, 'Y', NULL, NULL),
	('12000602', 'Akumulasi Penyusutan Kendaraan', NULL, 'A', 'DEPR', '120006', 0, NULL, NULL, 'Y', NULL, NULL),
	('12000603', 'Akumulasi Penyusutan Peralatan', NULL, 'A', 'DEPR', '120006', 0, NULL, NULL, 'Y', NULL, NULL),
	('12000604', 'Akumulasi Penyusutan Inventaris Kantor', NULL, 'A', 'DEPR', '120006', 0, NULL, NULL, 'Y', NULL, NULL),
	('2101', 'Hutang Usaha', NULL, 'A', 'APAY', '', 0, NULL, NULL, 'T', '', ''),
	('210101', 'Hutang Usaha IDR', NULL, 'A', 'APAY', '2101', 0, NULL, NULL, 'Y', NULL, NULL),
	('210102', 'Uang Muka Penjualan IDR', NULL, 'A', 'APAY', '2101', 0, NULL, NULL, 'Y', NULL, NULL),
	('2102', 'Kewajiban Jangka Pendek Lainnya', NULL, 'A', 'OCLY', '', 0, NULL, NULL, 'T', '', ''),
	('210201', 'PPN Keluaran', NULL, 'A', 'OCLY', '2102', 0, NULL, NULL, 'Y', NULL, NULL),
	('210202', 'PPh 23 Pembelian', NULL, 'A', 'OCLY', '2102', 0, NULL, NULL, 'Y', NULL, NULL),
	('210203', 'Hutang Pembelian Belum Ditagih', NULL, 'A', 'OCLY', '2102', 0, NULL, NULL, 'Y', NULL, NULL),
	('210204', 'PPh Ps.4(2) Pembelian', NULL, 'A', 'OCLY', '', 0, NULL, NULL, 'Y', NULL, NULL),
	('2201', 'Hutang Jangka Panjang', NULL, 'A', 'LTLY', '', 0, NULL, NULL, 'Y', '', ''),
	('3000', 'Modal', NULL, 'A', 'EQTY', '', 0, NULL, NULL, 'T', '', ''),
	('300001', 'Equitas Saldo Awal', NULL, 'A', 'EQTY', '3000', 0, NULL, NULL, 'Y', NULL, NULL),
	('300002', 'Laba Ditahan', NULL, 'A', 'EQTY', '3000', 0, NULL, NULL, 'Y', NULL, NULL),
	('300003', 'Modal Saham', NULL, 'A', 'EQTY', '3000', 0, NULL, NULL, 'Y', NULL, NULL),
	('300009', 'Laba Tahun Ini', NULL, 'A', 'EQTY', '3000', 0, NULL, NULL, 'Y', NULL, NULL),
	('4000', 'Pendapatan Operasional', NULL, 'A', 'REVE', '', 0, NULL, NULL, 'T', '', ''),
	('400001', 'Penjualan', NULL, 'A', 'REVE', '4000', 0, NULL, NULL, 'Y', NULL, NULL),
	('400002', 'Pendapatan Jasa', NULL, 'A', 'REVE', '4000', 0, NULL, NULL, 'Y', NULL, NULL),
	('400003', 'Retur Penjualan', NULL, 'A', 'REVE', '4000', 0, NULL, NULL, 'Y', NULL, NULL),
	('400004', 'Diskon Penjualan', NULL, 'A', 'REVE', '4000', 0, NULL, NULL, 'Y', NULL, NULL),
	('4401', 'Diskon Penjualan', NULL, 'A', 'REVE', '', 0, NULL, NULL, 'T', '', ''),
	('440101', 'Diskon Penjualan IDR', NULL, 'A', 'REVE', '4401', 0, NULL, NULL, 'Y', NULL, NULL),
	('5101', 'Beban Pokok Penjualan', NULL, 'A', 'COGS', '', 0, NULL, NULL, 'Y', NULL, NULL),
	('6000', 'Beban Operasional', NULL, 'A', 'EXPS', '', 0, NULL, NULL, 'T', '', ''),
	('600001', 'Beban Iklan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600002', 'Beban Komisi', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600003', 'Beban Bensin, Parkir, Tol Kendaraan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600004', 'Beban Gaji, Upah & Honorer', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600005', 'Beban Bonus, Pesangon & Kompensasi', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600006', 'Beban Transportasi Karyawan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600007', 'Beban Katering & Makan Karyawan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600008', 'Beban Tunjangan Kesehatan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600009', 'Beban Asuransi Karyawan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600010', 'Beban THR', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600011', 'Beban Listrik', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600012', 'Beban PAM', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600013', 'Beban Telekomunikasi', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600014', 'Beban Ekspedisi, Pos & Materai', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600015', 'Beban Perjalanan Dinas', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600016', 'Beban Perlengkapan Kantor', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600017', 'Beban Pajak Penghasilan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600018', 'Beban Retribusi & Sumbangan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600019', 'Beban Sewa Gedung', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600020', 'Beban Operasional Lainnya', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600021', 'Beban Penyusutan Gedung', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600022', 'Beban Penyusutan Kendaraan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600023', 'Beban Penyusutan Peralatan', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('600024', 'Beban Penyusutan Inventaris Kantor', NULL, 'A', 'EXPS', '6000', 0, NULL, NULL, 'Y', NULL, NULL),
	('7100', 'Pendapatan Diluar Usaha', NULL, 'A', 'OINC', '', 0, NULL, NULL, 'T', '', ''),
	('710001', 'Pendapatan Jasa Giro', NULL, 'A', 'OINC', '7100', 0, NULL, NULL, 'Y', NULL, NULL),
	('710002', 'Pendapatan Bunga Deposito', NULL, 'A', 'OINC', '7100', 0, NULL, NULL, 'Y', NULL, NULL),
	('710003', 'Penjualan Persediaan / Perlengkapan', NULL, 'A', 'OINC', '7100', 0, NULL, NULL, 'Y', NULL, NULL),
	('710004', 'Laba/Rugi Revaluasi Aset', NULL, 'A', 'OINC', '7100', 0, NULL, NULL, 'Y', NULL, NULL),
	('710005', 'Pendapatan Diluar Usaha Lainnya', NULL, 'A', 'OINC', '7100', 0, NULL, NULL, 'Y', NULL, NULL),
	('7200', 'Beban Diluar Usaha', NULL, 'A', 'OEXP', '', 0, NULL, NULL, 'T', '', ''),
	('720001', 'Beban Bunga Pinjaman', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('720002', 'Beban Adm. Bank & Buku Cek/Giro', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('720003', 'Pajak Jasa Giro', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('720004', 'Laba/Rugi Terealisasi', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('720005', 'Laba/Rugi Belum Terealisasi', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('720006', 'Laba/Rugi Disposisi Aset', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('720007', 'Beban Diluar Usaha Lainnya', NULL, 'A', 'OEXP', '7200', 0, NULL, NULL, 'Y', NULL, NULL),
	('7201', 'Laba/Rugi Terealisasi', NULL, 'A', 'OEXP', '', 0, NULL, NULL, 'T', '', ''),
	('720101', 'Laba/Rugi Terealisasi IDR', NULL, 'A', 'OEXP', '7201', 0, NULL, NULL, 'Y', NULL, NULL),
	('7202', 'Laba/Rugi Belum Terealisasi', NULL, 'A', 'OEXP', '', 0, NULL, NULL, 'T', '', ''),
	('720201', 'Laba/Rugi Belum Terealisasi IDR', NULL, 'A', 'OEXP', '7202', 0, NULL, NULL, 'Y', NULL, NULL);

-- Dumping structure for table smartacc.ms_akunsaldo
CREATE TABLE IF NOT EXISTS `ms_akunsaldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeakun` varchar(20) NOT NULL,
  `tahun` char(4) NOT NULL,
  `bulan` smallint(2) NOT NULL,
  `debet` double DEFAULT 0,
  `kredit` double DEFAULT 0,
  `debetm` double DEFAULT 0,
  `kreditm` double DEFAULT 0,
  `userid` varchar(15) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `anggaran` double DEFAULT 0,
  `cabang` varchar(4) DEFAULT '0',
  `tglrekam` timestamp NULL DEFAULT current_timestamp(),
  `debet1` double DEFAULT 0,
  `debet2` double DEFAULT 0,
  `debet3` double DEFAULT 0,
  `debet4` double DEFAULT 0,
  `debet5` double DEFAULT 0,
  `debet6` double DEFAULT 0,
  `debet7` double DEFAULT 0,
  `debet8` double DEFAULT 0,
  `debet9` double DEFAULT 0,
  `debet10` double DEFAULT 0,
  `debet11` double DEFAULT 0,
  `debet12` double DEFAULT 0,
  `kredit1` double DEFAULT 0,
  `kredit2` double DEFAULT 0,
  `kredit3` double DEFAULT 0,
  `kredit4` double DEFAULT 0,
  `kredit5` double DEFAULT 0,
  `kredit6` double DEFAULT 0,
  `kredit7` double DEFAULT 0,
  `kredit8` double DEFAULT 0,
  `kredit9` double DEFAULT 0,
  `kredit10` double DEFAULT 0,
  `kredit11` double DEFAULT 0,
  `kredit12` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_akunsaldo: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_akun_import
CREATE TABLE IF NOT EXISTS `ms_akun_import` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT '0',
  `nama` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table smartacc.ms_akun_import: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_akun_kelompok
CREATE TABLE IF NOT EXISTS `ms_akun_kelompok` (
  `kode` char(4) NOT NULL DEFAULT '0',
  `nama` varchar(100) DEFAULT NULL,
  `lap` char(1) DEFAULT NULL,
  `tipe` char(1) DEFAULT NULL,
  `sn` char(1) DEFAULT NULL,
  `nu` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `kelompok` varchar(50) DEFAULT NULL,
  `kelompok1` varchar(50) DEFAULT NULL,
  `nokel1` int(11) DEFAULT NULL,
  `nokel` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_akun_kelompok: ~15 rows (approximately)
INSERT INTO `ms_akun_kelompok` (`kode`, `nama`, `lap`, `tipe`, `sn`, `nu`, `nomor`, `kelompok`, `kelompok1`, `nokel1`, `nokel`) VALUES
	('APAY', 'Hutang Usaha', 'N', 'R', 'K', 1, 7, 'KEWAJIBAN JANGKA PENDEK', 'KEWAJIBAN', 2, 1),
	('AREC', 'Piutang Usaha', 'N', 'L', 'D', 2, 2, 'ASET LANCAR', 'ASET', 1, 1),
	('BANK', 'Kas & Bank', 'N', 'L', 'D', 1, 1, 'ASET LANCAR', 'ASET', 1, 1),
	('COGS', 'Beban Pokok Penjualan', 'L', '1', 'D', 2, 12, 'BEBAN POKOK PENJUALAN', 'BEBAN POKOK PENJUALAN', 5, 1),
	('DEPR', 'Akumulasi Depresiasi Aset Tetap', 'N', 'L', 'K', 6, 6, 'ASET TIDAK LANCAR', 'ASET', 1, 2),
	('EQTY', 'Modal', 'N', 'R', 'K', 4, 10, 'EKUITAS', 'EKUITAS', 3, 1),
	('EXPS', 'Beban', 'L', '1', 'D', 3, 13, 'BEBAN OPERASIONAL', 'BEBAN OPERASIONAL', 6, 2),
	('FASS', 'Aset Tetap', 'N', 'L', 'D', 5, 5, 'ASET TIDAK LANCAR', 'ASET', 1, 2),
	('INTR', 'Persediaan', 'N', 'L', 'D', 3, 3, 'ASET LANCAR', 'ASET', 1, 1),
	('LTLY', 'Kewajiban Jangka Panjang', 'N', 'R', 'K', 3, 9, 'KEWAJIBAN JANGKA PANJANG', 'KEWAJIBAN', 2, 3),
	('OCAS', 'Aset Lancar Lainnya', 'N', 'L', 'D', 4, 4, 'ASET LANCAR', 'ASET', 1, 1),
	('OCLY', 'Kewajiban Jangka Pendek Lainnya', 'N', 'R', 'K', 2, 8, 'KEWAJIBAN JANGKA PENDEK', 'KEWAJIBAN', 2, 2),
	('OEXP', 'Beban Lainnya', 'L', '2', 'D', 2, 15, 'BEBAN NON OPERASIONAL', 'PENDAPATAN DAN BEBAN NON OPERASIONAL', 7, 2),
	('OINC', 'Pendapatan Lainnya', 'L', '2', 'K', 1, 14, 'PENDAPATAN NON OPERASIONAL', 'PENDAPATAN DAN BEBAN NON OPERASIONAL', 7, 1),
	('REVE', 'Pendapatan', 'L', '1', 'K', 1, 11, 'PENDAPATAN USAHA', 'PENDAPATAN', 4, 1);

-- Dumping structure for table smartacc.ms_anggaran
CREATE TABLE IF NOT EXISTS `ms_anggaran` (
  `kode` varchar(20) NOT NULL DEFAULT '',
  `nama` varchar(50) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_anggaran: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_anggaran_pagu
CREATE TABLE IF NOT EXISTS `ms_anggaran_pagu` (
  `nomor` int(4) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) NOT NULL,
  `kodeakun` varchar(20) NOT NULL,
  `pagu` double DEFAULT 0,
  `pagu1` double DEFAULT 0,
  `pagu2` double DEFAULT 0,
  `pagu3` double DEFAULT 0,
  `pagu4` double DEFAULT 0,
  `pagu5` double DEFAULT 0,
  `pagu6` double DEFAULT 0,
  `pagu7` double DEFAULT 0,
  `pagu8` double DEFAULT 0,
  `pagu9` double DEFAULT 0,
  `pagu10` double DEFAULT 0,
  `pagu11` double DEFAULT 0,
  `pagu12` double DEFAULT 0,
  PRIMARY KEY (`nomor`),
  KEY `FK_ms_anggaran_pagu_ms_anggaran` (`kodeakun`),
  KEY `tahun` (`tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_anggaran_pagu: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_at
CREATE TABLE IF NOT EXISTS `ms_at` (
  `nomor` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `jenis` int(2) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tanggalbeli` date DEFAULT NULL,
  `hargaperolehan` double DEFAULT 0,
  `akumpenyusutan` double DEFAULT 0,
  `penyusutan` double DEFAULT 0,
  `mutasi` double DEFAULT 0,
  `nilairesidu` double DEFAULT 0,
  `umurekonomis` double DEFAULT 0,
  `qty` int(11) DEFAULT 1,
  `satuan` varchar(10) DEFAULT NULL,
  `tarif` float DEFAULT 0,
  `kode_unit` varchar(4) DEFAULT '0',
  `luas` float DEFAULT 0,
  `subjenis` int(11) DEFAULT 0,
  `penambahan` double DEFAULT 0,
  `pengurangan` double DEFAULT 0,
  `norefjurnal` varchar(20) DEFAULT '0',
  `pembelian` varchar(20) DEFAULT '0',
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ms_at: ~1 rows (approximately)
INSERT INTO `ms_at` (`nomor`, `kode`, `jenis`, `nama`, `tanggalbeli`, `hargaperolehan`, `akumpenyusutan`, `penyusutan`, `mutasi`, `nilairesidu`, `umurekonomis`, `qty`, `satuan`, `tarif`, `kode_unit`, `luas`, `subjenis`, `penambahan`, `pengurangan`, `norefjurnal`, `pembelian`) VALUES
	(00000000001, 'AT-01', 4, 'MOBIL AVANZA 2023', '2023-11-01', 150000000, 0, 0, 0, 0, 0, 1, NULL, 0, '0', 0, 0, 0, 0, '0', '0');

-- Dumping structure for table smartacc.ms_atjenis
CREATE TABLE IF NOT EXISTS `ms_atjenis` (
  `kode` char(2) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `akun_aktiva` varchar(20) DEFAULT NULL,
  `akun_penyusutan` varchar(20) DEFAULT NULL,
  `akun_biaya` varchar(20) DEFAULT NULL,
  `umurekonomis` int(11) DEFAULT NULL,
  `kelompok` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_atjenis: ~10 rows (approximately)
INSERT INTO `ms_atjenis` (`kode`, `nama`, `akun_aktiva`, `akun_penyusutan`, `akun_biaya`, `umurekonomis`, `kelompok`) VALUES
	('1', 'TANAH', '', '', '', 0, 'BANGUNAN GEDUNG'),
	('10', 'AKTIVA LAINNYA', '', '', '', 0, 'AKTIVA LAIN'),
	('2', 'BANGUNAN GEDUNG', '', '1020501', '5010401', 20, 'BANGUNAN GEDUNG '),
	('3', 'BANGUNAN KANTOR', '', '1020502', '5020601', 20, 'BANGUNAN GEDUNG '),
	('4', 'KENDARAAN RODA EMPAT', '', '102050303', '5020604', 8, 'KENDARAAN'),
	('5', 'KENDARAAN RODA DUA', '', '102050303', '5020604', 4, 'KENDARAAN'),
	('6', 'INV. KANTOR GOL I', '', '102050301', '5020602', 4, 'PERALATAN DAN INVENTARIS KANTOR'),
	('7', 'INV. KANTOR GOL II', '', '102050301', '5020602', 8, 'PERALATAN DAN INVENTARIS KANTOR'),
	('8', 'AKTIVA TETAP TAK BERWUJUD', '', '10207', '5020605', 4, 'AKTIVA LAIN'),
	('9', 'BEBAN YANG DITANGGUHKAN', '', '', '', 0, 'AKTIVA LAIN');

-- Dumping structure for table smartacc.ms_at_his
CREATE TABLE IF NOT EXISTS `ms_at_his` (
  `nomor` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `jenis` int(2) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tanggalbeli` date DEFAULT NULL,
  `hargaperolehan` double DEFAULT 0,
  `akumpenyusutan` double DEFAULT 0,
  `penyusutan` double DEFAULT 0,
  `mutasi` double DEFAULT 0,
  `nilairesidu` double DEFAULT 0,
  `umurekonomis` double DEFAULT 0,
  `qty` int(11) DEFAULT 1,
  `satuan` varchar(10) DEFAULT NULL,
  `tarif` float DEFAULT 0,
  `kode_unit` varchar(4) DEFAULT '0',
  `luas` float DEFAULT 0,
  `subjenis` int(11) DEFAULT 0,
  `penambahan` double DEFAULT 0,
  `pengurangan` double DEFAULT 0,
  `norefjurnal` varchar(20) DEFAULT '0',
  `pembelian` varchar(20) DEFAULT '0',
  `bulan` int(11) DEFAULT 0,
  `tahun` int(11) DEFAULT 0,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table smartacc.ms_at_his: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_at_subjenis
CREATE TABLE IF NOT EXISTS `ms_at_subjenis` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `jenis` int(10) DEFAULT 0,
  `subjenis` int(10) DEFAULT 0,
  `nama` varchar(50) DEFAULT '0',
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_at_subjenis: ~46 rows (approximately)
INSERT INTO `ms_at_subjenis` (`nomor`, `jenis`, `subjenis`, `nama`) VALUES
	(1, 1, 101, 'Dikerjasamakan dengan Pihak Ke-3'),
	(2, 1, 102, 'Dikelola Sendiri'),
	(3, 2, 201, 'Dikerjasamakan dengan Pihak Ke 3'),
	(4, 2, 202, 'Dikelola sendiri'),
	(5, 3, 301, 'Bangunan Kantor'),
	(6, 4, 401, 'RODA EMPAT ATAU LEBIH'),
	(7, 5, 501, 'RODA DUA'),
	(8, 6, 601, 'a. Alat Pemadam Kebakaran (APK)'),
	(9, 6, 602, 'b. Dispenser Set'),
	(10, 6, 603, 'c. Flashdisk / Data Traveler'),
	(11, 6, 604, 'd. Handy Talkie'),
	(12, 6, 605, 'e. Handy Camera'),
	(13, 6, 606, 'f. Jam Dinding'),
	(14, 6, 607, 'g. Kamera Digital'),
	(15, 6, 608, 'h. Komputer Set'),
	(16, 6, 609, 'i. Lemari Es'),
	(17, 6, 610, 'j. Sound Set'),
	(18, 6, 611, 'k. Alat Hitung'),
	(19, 6, 612, 'l. Mesin Tik'),
	(20, 6, 613, 'm. Komputer Lipat'),
	(21, 6, 614, 'n. Telepon, Faximile, Repeater (Comunication Set)'),
	(22, 6, 615, 'o. Printer Set'),
	(23, 6, 616, 'p. Scanner Set'),
	(24, 6, 617, 'q. Televisi'),
	(25, 6, 618, 'r. Tiang Bendera'),
	(26, 6, 619, 's. Proyektor Set'),
	(27, 6, 620, 't. Alat/Elektronik Kebersihan'),
	(28, 6, 621, 'u. Mesin Lainnya'),
	(29, 6, 622, 'u. Lain - lain'),
	(30, 6, 623, 'v. Bangku/Kursi/Sico'),
	(31, 6, 624, 'w. Lemari'),
	(32, 6, 625, 'x. Meja/Mebeulair'),
	(33, 6, 626, 'y. Mesin Kecil'),
	(34, 6, 627, 'Z. Meteran Digital'),
	(35, 6, 628, 'AA. Plang Unit Pasar'),
	(36, 6, 629, 'AB. TPPS'),
	(37, 7, 701, 'a. Air Conditioner (AC)'),
	(38, 7, 702, 'b. Alat Pemadam (besar)'),
	(39, 7, 703, 'c. Alat Perlegkapan Kantor (Besi)'),
	(40, 7, 704, 'd. Brankas'),
	(41, 7, 705, 'e.Filling Besi/Kabinet'),
	(42, 7, 706, 'f. Kursi Besi/Lipat/Putar'),
	(43, 7, 707, 'g. White Board'),
	(44, 8, 801, 'AKTIVA TETAP TAK BERWUJUD'),
	(45, 9, 901, 'b. Pekerjaan Dalam Proses'),
	(46, 10, 1001, 'AKTIVA LAIN-LAIN');

-- Dumping structure for table smartacc.ms_bank
CREATE TABLE IF NOT EXISTS `ms_bank` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_kode` char(6) DEFAULT NULL,
  `bank_nama` varchar(30) DEFAULT NULL,
  `bank_jenis` char(1) DEFAULT NULL,
  `bank_kodeakun` varchar(20) DEFAULT NULL,
  `bank_norek` varchar(20) DEFAULT NULL,
  `bank_deposito` varchar(1) DEFAULT '0',
  `bank_akunpajakbunga` varchar(20) DEFAULT NULL,
  `bank_akunpendapatanbunga` varchar(20) DEFAULT NULL,
  `bank_pasar` varchar(5) DEFAULT NULL,
  `nmpasar` varchar(50) DEFAULT NULL,
  `penanggungjawab` varchar(50) DEFAULT NULL,
  `pemegangkas` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `ket1` varchar(50) DEFAULT NULL,
  `bank_kode_pasar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_kode` (`bank_kode`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_bank: ~4 rows (approximately)
INSERT INTO `ms_bank` (`id`, `bank_kode`, `bank_nama`, `bank_jenis`, `bank_kodeakun`, `bank_norek`, `bank_deposito`, `bank_akunpajakbunga`, `bank_akunpendapatanbunga`, `bank_pasar`, `nmpasar`, `penanggungjawab`, `pemegangkas`, `ket`, `ket1`, `bank_kode_pasar`) VALUES
	(1, 'K-01', 'KAS', 'K', '2', '-', '0', NULL, NULL, '01', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'B-01', 'BCA', 'B', '1010201', '1234', '0', NULL, NULL, '01', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'B-02', 'MANDIRI', 'B', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'B-03', 'BRI', 'B', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table smartacc.ms_banksaldo
CREATE TABLE IF NOT EXISTS `ms_banksaldo` (
  `tahun` char(4) NOT NULL,
  `bulan` varchar(2) NOT NULL DEFAULT '',
  `bank_kode` char(6) NOT NULL,
  `saldo_awal` double DEFAULT 0,
  `penerimaan` double DEFAULT 0,
  `pengeluaran` double DEFAULT 0,
  `sop` double DEFAULT 0,
  `pasar` varchar(5) DEFAULT '0',
  PRIMARY KEY (`tahun`,`bank_kode`,`bulan`),
  KEY `bank_kode` (`bank_kode`),
  CONSTRAINT `ms_banksaldo_fk` FOREIGN KEY (`bank_kode`) REFERENCES `ms_bank` (`bank_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_banksaldo: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_counter1
CREATE TABLE IF NOT EXISTS `ms_counter1` (
  `kdtr` char(2) NOT NULL,
  `cdno` int(5) unsigned zerofill DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kdtr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_counter1: ~18 rows (approximately)
INSERT INTO `ms_counter1` (`kdtr`, `cdno`, `ket`) VALUES
	('IN', 00001, NULL),
	('JU', 00001, 'Jurnal Umum'),
	('KK', 00001, 'Kas Keluar'),
	('KM', 00001, 'Kas Masuk'),
	('KT', 00001, 'Kas Transfer Bank'),
	('PB', 00002, 'Pembelian - Penerimaan Barang'),
	('PM', 00001, 'Pembelian - Uang Muka'),
	('PO', 00002, 'Pembelian - Order'),
	('PP', 00001, 'Pembelian - Pembayaran'),
	('PR', 00001, 'Pembelian - Retur'),
	('PU', 00002, 'Pembelian - Faktur'),
	('SD', 00002, 'Penjualan - Pengiriman'),
	('SI', 00002, 'Sales Invoice'),
	('SM', 00001, 'Penjualan - Uangmuka'),
	('SO', 00002, 'Penjualan - Pesanan'),
	('SQ', 00001, 'Penjualan - Penawaran'),
	('SR', 00001, 'Penjualan - Retur'),
	('ST', 00001, 'Penjualan - Penerimaan Uang');

-- Dumping structure for table smartacc.ms_currency
CREATE TABLE IF NOT EXISTS `ms_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `kurs` double DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `kode` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `currency` (`nama`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table smartacc.ms_currency: ~7 rows (approximately)
INSERT INTO `ms_currency` (`id`, `nama`, `kurs`, `last_update`, `kode`, `user_id`) VALUES
	(1, 'IDR', 1, '2022-09-02', 'IDR', '4'),
	(2, 'USD', 14969, '2023-06-04', 'USD', '4'),
	(4, 'SGD', 11052.53, '2023-06-04', 'SGD', '4'),
	(8, 'EURO', 16003.37, '2023-06-04', 'EUR', '4'),
	(12, 'JPY', 106.72, '2023-06-04', 'JPY', '4'),
	(13, 'HKD', 1911.17, '2023-06-04', 'HKD', '4'),
	(15, 'GBP', 18498.7, '2023-06-04', 'GBP', '4');

-- Dumping structure for table smartacc.ms_format
CREATE TABLE IF NOT EXISTS `ms_format` (
  `kode` varchar(5) NOT NULL DEFAULT '',
  `nama` varchar(50) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_format: ~2 rows (approximately)
INSERT INTO `ms_format` (`kode`, `nama`, `jenis`) VALUES
	('L1', 'RUGI LABA', 'R'),
	('N1', 'NERACA', 'N');

-- Dumping structure for table smartacc.ms_formatd
CREATE TABLE IF NOT EXISTS `ms_formatd` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) DEFAULT NULL,
  `nourut` int(11) DEFAULT NULL,
  `judul_lap` varchar(100) DEFAULT NULL,
  `judul_cf` varchar(100) DEFAULT NULL,
  `sign` char(1) DEFAULT NULL,
  `cf` char(1) DEFAULT 'T',
  `jenis` varchar(2) DEFAULT NULL,
  `kelompok` int(11) DEFAULT NULL,
  `ebit` char(1) DEFAULT NULL,
  `akunebit` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_formatd: ~80 rows (approximately)
INSERT INTO `ms_formatd` (`nomor`, `kode`, `nourut`, `judul_lap`, `judul_cf`, `sign`, `cf`, `jenis`, `kelompok`, `ebit`, `akunebit`) VALUES
	(1, 'N1', 1, 'Kas dan Setara Kas (Bank)', 'Kas dan Setara Kas (Bank)', NULL, 'T', NULL, 11, NULL, NULL),
	(2, 'N1', 2, 'Piutang Usaha', 'Piutang Usaha', NULL, 'Y', NULL, 11, NULL, NULL),
	(3, 'N1', 3, 'Piutang Mitra Kerja', 'Piutang Mitra Kerja', NULL, 'Y', NULL, 11, NULL, NULL),
	(4, 'N1', 4, 'Uang Muka', 'Uang Muka', NULL, 'Y', NULL, 11, NULL, NULL),
	(5, 'N1', 5, 'Biaya Dibayar Dimuka', 'Biaya Dibayar Dimuka', NULL, 'Y', NULL, 11, NULL, NULL),
	(6, 'N1', 6, 'PPN Masukan', 'PPN Masukan', NULL, 'Y', NULL, 11, NULL, NULL),
	(7, 'N1', 1, 'Tanah', 'Tanah', NULL, 'Y', NULL, 12, NULL, NULL),
	(8, 'N1', 2, 'Bangunan Pasar', 'Bangunan Pasar', NULL, 'Y', NULL, 12, NULL, NULL),
	(9, 'N1', 3, 'Bangunan Kantor', 'Bangunan Kantor', NULL, 'Y', NULL, 12, NULL, NULL),
	(10, 'N1', 4, 'Inventaris Kantor', 'Inventaris Kantor', NULL, 'Y', NULL, 12, NULL, NULL),
	(11, 'N1', 1, 'Hutang Usaha', 'Hutang Usaha', NULL, 'Y', NULL, 21, NULL, NULL),
	(12, 'N1', 2, 'Biaya Ymh Dibayar', 'Biaya Ymh Dibayar', NULL, 'Y', NULL, 21, NULL, NULL),
	(13, 'N1', 3, 'PPN Keluaran', 'PPN Keluaran', NULL, 'Y', NULL, 21, NULL, NULL),
	(14, 'N1', 4, 'Hutang Pajak', 'Hutang Pajak', NULL, 'Y', NULL, 21, NULL, NULL),
	(15, 'N1', 5, 'Bagian Hutang Bank Jk Pjg Yg Jth Tempo', 'Bagian Hutang Bank Jk Pjg Yg Jth Tempo', NULL, 'Y', NULL, 21, NULL, NULL),
	(16, 'N1', 6, 'Hutang Bunga', 'Hutang Bunga', NULL, 'T', NULL, 21, NULL, NULL),
	(17, 'N1', 1, 'Hutang Bank Jangka Panjang', 'Hutang Bank Jangka Panjang', NULL, 'Y', NULL, 22, NULL, NULL),
	(18, 'N1', 2, 'Hutang Bunga Bank Jangka Panjang', 'Hutang Bunga Bank Jangka Panjang', NULL, 'Y', NULL, 22, NULL, NULL),
	(19, 'N1', 3, 'Pendapatan Ditangguhkan', 'Pendapatan Ditangguhkan', NULL, 'Y', NULL, 22, NULL, NULL),
	(20, 'N1', 1, 'Laba (Rugi) Tahun Berjalan', 'Laba (Rugi) Tahun Berjalan', NULL, 'Y', NULL, 31, NULL, NULL),
	(21, 'N1', 2, 'Laba (Rugi) Tahun Lalu', 'Laba (Rugi) Tahun Lalu', NULL, 'Y', NULL, 31, NULL, NULL),
	(22, 'N1', 3, 'Cadangan', 'Cadangan', NULL, 'Y', NULL, 31, NULL, NULL),
	(23, 'N1', 4, 'Modal ', 'Modal ', NULL, 'Y', NULL, 31, NULL, NULL),
	(24, 'N1', 5, 'Bagian Laba Pemerintah Kota Bandung', 'Bagian Laba Pemerintah Kota Bandung', NULL, 'Y', NULL, 31, NULL, NULL),
	(25, 'L1', 1, 'Permohonan SSTU/SPTB', 'Permohonan SSTU/SPTB', NULL, 'Y', NULL, 41, NULL, NULL),
	(26, 'L1', 2, 'Perpanjangan SSTU/SPTB', 'Perpanjangan SSTU/SPTB', NULL, 'Y', NULL, 41, 'Y', '1010302'),
	(27, 'L1', 3, 'Pendapatan BBN Hak SSTU/SPTB', 'Pendapatan BBN Hak SSTU/SPTB', NULL, 'Y', NULL, 41, NULL, NULL),
	(28, 'L1', 4, 'JPF Harian Pasar', 'JPF Harian Pasar', NULL, 'Y', NULL, 41, 'Y', '1010304'),
	(29, 'L1', 5, 'JPF Kebersihan', 'JPF Kebersihan', NULL, 'Y', NULL, 41, 'Y', '1010305'),
	(30, 'L1', 6, 'JF Ketertiban', 'JF Ketertiban', NULL, 'Y', NULL, 41, 'Y', '1010306'),
	(31, 'N1', 1, 'Pendapatan Diterima Dimuka', 'Pendapatan Diterima Dimuka', NULL, 'Y', NULL, 23, NULL, NULL),
	(32, 'N1', 2, 'Penerimaan Yang Belum Teridentifikasi', 'Penerimaan Yang Belum Teridentifikasi', NULL, 'Y', NULL, 23, 'Y', '20302'),
	(33, 'N1', 3, 'Kewajiban Kepada Pemerintah Kota Bandung', 'Kewajiban Kepada Pemerintah Kota Bandung', NULL, 'Y', NULL, 23, NULL, NULL),
	(34, 'N1', 7, 'Uang Muka Pajak', 'Uang Muka Pajak', NULL, 'Y', NULL, 11, NULL, NULL),
	(35, 'N1', 8, 'Pendapatan Ymg Diterima', 'Pendapatan Ymg Diterima', NULL, 'Y', NULL, 11, NULL, NULL),
	(36, 'N1', 9, 'Persediaan', 'Persediaan', NULL, 'Y', NULL, 11, NULL, NULL),
	(37, 'N1', 5, 'Aktiva Tetap Tak Berwujud', 'Aktiva Tetap Tak Berwujud', NULL, 'Y', NULL, 12, NULL, NULL),
	(38, 'N1', 6, 'Properti Investasi', 'Properti Investasi', NULL, 'Y', NULL, 12, NULL, NULL),
	(39, 'N1', 1, 'Penyertaan Modal Pemda Ymh Disetor', 'Penyertaan Modal Pemda Ymh Disetor', NULL, 'Y', NULL, 13, NULL, NULL),
	(40, 'N1', 2, 'Piutang Lain-lain', 'Piutang Lain-lain', NULL, 'Y', NULL, 13, NULL, NULL),
	(41, 'N1', 3, 'Beban Ditangguhkan', 'Beban Ditangguhkan', NULL, 'Y', NULL, 13, NULL, NULL),
	(42, 'N1', 4, 'Pekerjaan Dalam Proses', 'Pekerjaan Dalam Proses', NULL, 'Y', NULL, 13, NULL, NULL),
	(43, 'N1', 5, 'Aktiva KSO', 'Aktiva KSO', NULL, 'Y', NULL, 13, NULL, NULL),
	(44, 'L1', 7, 'JPF Listrik Dan/Atau Air', 'JPF Listrik Dan/Atau Air', NULL, 'Y', NULL, 41, NULL, NULL),
	(45, 'L1', 8, 'JF MCK', 'JF MCK', NULL, 'Y', NULL, 41, 'Y', '1010308'),
	(46, 'L1', 9, 'JPF Parkir', 'JPF Parkir', NULL, 'Y', NULL, 41, 'Y', '1010309'),
	(47, 'L1', 10, 'JPF Bongkar Muat', 'JPF Bongkar Muat', NULL, 'Y', NULL, 41, NULL, NULL),
	(48, 'L1', 11, 'JPF Reklame', 'JPF Reklame', NULL, 'Y', NULL, 41, NULL, NULL),
	(49, 'L1', 12, 'Pendapatan Usaha Lainnya', 'Pendapatan Usaha Lainnya', NULL, 'Y', NULL, 41, NULL, NULL),
	(50, 'L1', 1, 'Pendapatan Kompensasi Pasar', 'Pendapatan Kompensasi Pasar', NULL, 'Y', NULL, 42, NULL, NULL),
	(51, 'L1', 2, 'Pendapatan Konstribusi Pasar', 'Pendapatan Konstribusi Pasar', NULL, 'Y', NULL, 42, NULL, NULL),
	(52, 'L1', 3, 'Pendapatan Sewa Lahan Pasar', 'Pendapatan Sewa Lahan Pasar', NULL, 'Y', NULL, 42, NULL, NULL),
	(53, 'L1', 1, 'Beban Pegawai', 'Beban Pegawai', NULL, 'Y', NULL, 51, NULL, NULL),
	(54, 'L1', 2, 'Beban Operasional, Peralatan Dan Perlengkapan Kerja', 'Beban Operasional, Peralatan Dan Perlengkapan Kerja', NULL, 'Y', NULL, 51, NULL, NULL),
	(55, 'L1', 3, 'Beban Pemeliharaan Aktiva Tetap', 'Beban Pemeliharaan Aktiva Tetap', NULL, 'Y', NULL, 51, NULL, NULL),
	(56, 'L1', 4, 'Beban Penyusutan Aktiva Tetap', 'Beban Penyusutan Aktiva Tetap', NULL, 'Y', NULL, 51, 'Y', NULL),
	(57, 'L1', 5, 'Beban Penyisihan Piutang Usaha', 'Beban Penyisihan Piutang Usaha', NULL, 'Y', NULL, 51, NULL, NULL),
	(58, 'L1', 6, 'Beban Usaha Langsung Lainnya', 'Beban Usaha Langsung Lainnya', NULL, 'Y', NULL, 51, NULL, NULL),
	(59, 'L1', 1, 'Beban Pegawai', 'Beban Pegawai', NULL, 'Y', NULL, 52, NULL, NULL),
	(60, 'L1', 2, 'Beban Administrasi Kantor', 'Beban Administrasi Kantor', NULL, 'Y', NULL, 52, NULL, NULL),
	(61, 'L1', 3, 'Beban Pemeliharaan Aktiva Tetap', 'Beban Pemeliharaan Aktiva Tetap', NULL, 'Y', NULL, 52, NULL, NULL),
	(62, 'L1', 4, 'Beban Kendaraan Dinas', 'Beban Kendaraan Dinas', NULL, 'Y', NULL, 52, NULL, NULL),
	(63, 'L1', 5, 'Beban Hubungan Masyarakat', 'Beban Hubungan Masyarakat', NULL, 'Y', NULL, 52, NULL, NULL),
	(64, 'L1', 6, 'Beban Penyusutan Aktiva Tetap', 'Beban Penyusutan Aktiva Tetap', NULL, 'Y', NULL, 52, 'Y', NULL),
	(65, 'L1', 7, 'Beban Amortisasi Beban Ditangguhkan', 'Beban Amortisasi Beban Ditangguhkan', NULL, 'Y', NULL, 52, NULL, NULL),
	(66, 'L1', 8, 'Beban Pengembangan SDM', 'Beban Pengembangan SDM', NULL, 'Y', NULL, 52, NULL, NULL),
	(67, 'L1', 9, 'Beban Manajemen', 'Beban Manajemen', NULL, 'Y', NULL, 52, NULL, NULL),
	(68, 'L1', 10, 'Beban Penelitian Dan Pengembangan', 'Beban Penelitian Dan Pengembangan', NULL, 'Y', NULL, 52, NULL, NULL),
	(69, 'L1', 11, 'Beban Pelestarian Lingkungan', 'Beban Pelestarian Lingkungan', NULL, 'Y', NULL, 52, NULL, NULL),
	(70, 'L1', 12, 'Rupa-Rupa Biaya Umum', 'Rupa-Rupa Biaya Umum', NULL, 'Y', NULL, 52, NULL, NULL),
	(71, 'L1', 1, 'Pendapatan Subsidi', 'Pendapatan Subsidi', NULL, 'Y', NULL, 49, NULL, NULL),
	(72, 'L1', 2, 'Pendapatan Lainnya', 'Pendapatan Lainnya', NULL, 'Y', NULL, 49, NULL, NULL),
	(73, 'L1', 1, 'Beban Sumbangan', 'Beban Sumbangan', NULL, 'Y', NULL, 59, NULL, NULL),
	(74, 'L1', 2, 'Amortisasi Beban Ditangguhkan', 'Amortisasi Beban Ditangguhkan', NULL, 'Y', NULL, 59, NULL, NULL),
	(75, 'L1', 3, 'Beban/Biaya Bank', 'Beban/Biaya Bank', NULL, 'Y', NULL, 59, NULL, NULL),
	(76, 'L1', 4, 'Gaji PNS', 'Gaji PNS', NULL, 'Y', NULL, 59, NULL, NULL),
	(77, 'L1', 5, 'Beban Lainnya', 'Beban Lainnya', NULL, 'Y', NULL, 59, NULL, NULL),
	(78, 'N1', 7, 'Hutang Lain-Lain', 'Hutang Lain-Lain', NULL, 'Y', NULL, 21, NULL, NULL),
	(79, 'N1', 4, 'Hutang Deviden', 'Hutang Deviden', NULL, 'Y', NULL, 22, NULL, NULL),
	(81, 'N1', 2, 'Hutang Imbal Kerja', 'Hutang Imbal Kerja', NULL, 'Y', NULL, 21, NULL, NULL);

-- Dumping structure for table smartacc.ms_formatdd
CREATE TABLE IF NOT EXISTS `ms_formatdd` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `nomorlap` int(10) DEFAULT NULL,
  `akun` varchar(20) DEFAULT NULL,
  `cfd` char(1) DEFAULT 'Y',
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=3274 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_formatdd: ~1.075 rows (approximately)
INSERT INTO `ms_formatdd` (`nomor`, `nomorlap`, `akun`, `cfd`) VALUES
	(3, 1, '1010101', 'Y'),
	(9, 20, '301', 'Y'),
	(10, 1, '1010102', 'Y'),
	(11, 1, '1010103', 'Y'),
	(12, 1, '1010201', 'Y'),
	(13, 1, '1010202', 'Y'),
	(14, 1, '1010203', 'Y'),
	(15, 1, '1010204', 'Y'),
	(16, 1, '1010205', 'Y'),
	(17, 1, '1010206', 'Y'),
	(18, 1, '1010207', 'Y'),
	(19, 1, '1010208', 'Y'),
	(20, 2, '1010301', 'Y'),
	(21, 2, '1010302', 'Y'),
	(22, 2, '1010303', 'Y'),
	(23, 2, '1010304', 'Y'),
	(24, 2, '1010305', 'Y'),
	(25, 2, '1010306', 'Y'),
	(26, 2, '1010307', 'Y'),
	(27, 2, '1010308', 'Y'),
	(28, 2, '1010309', 'Y'),
	(29, 2, '1010310', 'Y'),
	(30, 2, '1010311', 'Y'),
	(35, 2, '1010401', 'Y'),
	(36, 2, '1010402', 'Y'),
	(37, 2, '1010403', 'Y'),
	(38, 2, '1010404', 'Y'),
	(39, 2, '1010405', 'Y'),
	(40, 2, '1010406', 'Y'),
	(41, 2, '1010407', 'Y'),
	(42, 2, '1010408', 'Y'),
	(43, 2, '1010409', 'Y'),
	(44, 2, '1010410', 'Y'),
	(45, 2, '1010411', 'Y'),
	(47, 3, '101031201', 'Y'),
	(48, 3, '101031202', 'Y'),
	(49, 3, '101031203', 'Y'),
	(51, 4, '10105', 'Y'),
	(52, 5, '10106', 'Y'),
	(53, 6, '10107', 'Y'),
	(54, 34, '10108', 'Y'),
	(55, 35, '10109', 'Y'),
	(56, 36, '1011001', 'Y'),
	(57, 36, '1011002', 'Y'),
	(58, 36, '1011003', 'Y'),
	(59, 7, '10201', 'Y'),
	(60, 8, '10202', 'Y'),
	(61, 8, '1020501', 'Y'),
	(62, 9, '10203', 'Y'),
	(63, 9, '1020502', 'Y'),
	(64, 10, '1020401', 'Y'),
	(65, 10, '102050301', 'Y'),
	(66, 10, '1020402', 'Y'),
	(67, 10, '102050302', 'Y'),
	(68, 37, '10206', 'Y'),
	(69, 37, '10207', 'Y'),
	(70, 38, '1020801', 'Y'),
	(71, 38, '1020802', 'Y'),
	(72, 38, '102050401', 'Y'),
	(73, 39, '10301', 'Y'),
	(74, 40, '1030201', 'Y'),
	(75, 40, '1030202', 'Y'),
	(76, 40, '1030203', 'Y'),
	(77, 40, '1030204', 'Y'),
	(78, 40, '1030205', 'Y'),
	(79, 41, '10303', 'Y'),
	(80, 42, '10304', 'Y'),
	(81, 43, '1030501', 'Y'),
	(82, 43, '1030502', 'Y'),
	(83, 43, '1030503', 'Y'),
	(84, 43, '1030504', 'Y'),
	(85, 43, '1030505', 'Y'),
	(86, 43, '1030506', 'Y'),
	(87, 11, '20101', 'Y'),
	(88, 12, '20102', 'Y'),
	(89, 13, '20103', 'Y'),
	(91, 15, '20105', 'Y'),
	(92, 16, '20106', 'Y'),
	(93, 17, '20201', 'Y'),
	(94, 17, '20202', 'Y'),
	(96, 31, '2030101', 'Y'),
	(97, 31, '2030102', 'Y'),
	(98, 31, '2030103', 'Y'),
	(99, 31, '2030104', 'Y'),
	(100, 31, '2030105', 'Y'),
	(101, 31, '2030106', 'Y'),
	(102, 31, '2030107', 'Y'),
	(103, 31, '2030108', 'Y'),
	(104, 31, '2030109', 'Y'),
	(105, 31, '2030110', 'Y'),
	(106, 31, '2030111', 'Y'),
	(107, 31, '2030112', 'Y'),
	(108, 32, '20302', 'Y'),
	(109, 33, '20303', 'Y'),
	(111, 21, '302', 'Y'),
	(112, 22, '303', 'Y'),
	(113, 23, '30401', 'Y'),
	(114, 23, '30402', 'Y'),
	(115, 24, '305', 'Y'),
	(116, 10, '1020403', 'Y'),
	(117, 10, '102050303', 'Y'),
	(120, 1, '1010209', 'Y'),
	(121, 73, '50301', 'Y'),
	(122, 75, '50303', 'Y'),
	(123, 71, '40301', 'Y'),
	(124, 72, '40310', 'Y'),
	(126, 1, '1010210', 'Y'),
	(139, 49, '40120', 'Y'),
	(140, 50, '40201', 'Y'),
	(141, 51, '40202', 'Y'),
	(142, 52, '40203', 'Y'),
	(151, 65, '50207', 'Y'),
	(160, 77, '50309', 'Y'),
	(2211, 25, '4010101', 'Y'),
	(2212, 25, '4010102', 'Y'),
	(2213, 25, '4010103', 'Y'),
	(2214, 25, '4010104', 'Y'),
	(2215, 25, '4010105', 'Y'),
	(2216, 25, '4010106', 'Y'),
	(2217, 25, '4010107', 'Y'),
	(2218, 25, '4010108', 'Y'),
	(2219, 25, '4010109', 'Y'),
	(2220, 25, '4010110', 'Y'),
	(2221, 25, '4010111', 'Y'),
	(2222, 25, '4010112', 'Y'),
	(2223, 25, '4010113', 'Y'),
	(2224, 25, '4010114', 'Y'),
	(2225, 25, '4010115', 'Y'),
	(2226, 25, '4010116', 'Y'),
	(2227, 25, '4010117', 'Y'),
	(2228, 25, '4010118', 'Y'),
	(2229, 25, '4010119', 'Y'),
	(2230, 25, '4010120', 'Y'),
	(2231, 25, '4010121', 'Y'),
	(2232, 25, '4010122', 'Y'),
	(2233, 25, '4010123', 'Y'),
	(2234, 25, '4010124', 'Y'),
	(2235, 25, '4010125', 'Y'),
	(2236, 25, '4010126', 'Y'),
	(2237, 25, '4010127', 'Y'),
	(2238, 25, '4010128', 'Y'),
	(2239, 25, '4010129', 'Y'),
	(2240, 25, '4010130', 'Y'),
	(2241, 25, '4010131', 'Y'),
	(2242, 25, '4010132', 'Y'),
	(2243, 25, '4010133', 'Y'),
	(2244, 25, '4010134', 'Y'),
	(2245, 25, '4010135', 'Y'),
	(2246, 25, '4010136', 'Y'),
	(2247, 25, '4010137', 'Y'),
	(2248, 25, '4010138', 'Y'),
	(2249, 25, '4010139', 'Y'),
	(2250, 26, '4010201', 'Y'),
	(2251, 26, '4010202', 'Y'),
	(2252, 26, '4010203', 'Y'),
	(2253, 26, '4010204', 'Y'),
	(2254, 26, '4010205', 'Y'),
	(2255, 26, '4010206', 'Y'),
	(2256, 26, '4010207', 'Y'),
	(2257, 26, '4010208', 'Y'),
	(2258, 26, '4010209', 'Y'),
	(2259, 26, '4010210', 'Y'),
	(2260, 26, '4010211', 'Y'),
	(2261, 26, '4010212', 'Y'),
	(2262, 26, '4010213', 'Y'),
	(2263, 26, '4010214', 'Y'),
	(2264, 26, '4010215', 'Y'),
	(2265, 26, '4010216', 'Y'),
	(2266, 26, '4010217', 'Y'),
	(2267, 26, '4010218', 'Y'),
	(2268, 26, '4010219', 'Y'),
	(2269, 26, '4010220', 'Y'),
	(2270, 26, '4010221', 'Y'),
	(2271, 26, '4010222', 'Y'),
	(2272, 26, '4010223', 'Y'),
	(2273, 26, '4010224', 'Y'),
	(2274, 26, '4010225', 'Y'),
	(2275, 26, '4010226', 'Y'),
	(2276, 26, '4010227', 'Y'),
	(2277, 26, '4010228', 'Y'),
	(2278, 26, '4010229', 'Y'),
	(2279, 26, '4010230', 'Y'),
	(2280, 26, '4010231', 'Y'),
	(2281, 26, '4010232', 'Y'),
	(2282, 26, '4010233', 'Y'),
	(2283, 26, '4010234', 'Y'),
	(2284, 26, '4010235', 'Y'),
	(2285, 26, '4010236', 'Y'),
	(2286, 26, '4010237', 'Y'),
	(2287, 26, '4010238', 'Y'),
	(2288, 26, '4010239', 'Y'),
	(2289, 27, '4010301', 'Y'),
	(2290, 27, '4010302', 'Y'),
	(2291, 27, '4010303', 'Y'),
	(2292, 27, '4010304', 'Y'),
	(2293, 27, '4010305', 'Y'),
	(2294, 27, '4010306', 'Y'),
	(2295, 27, '4010307', 'Y'),
	(2296, 27, '4010308', 'Y'),
	(2297, 27, '4010309', 'Y'),
	(2298, 27, '4010310', 'Y'),
	(2299, 27, '4010311', 'Y'),
	(2300, 27, '4010312', 'Y'),
	(2301, 27, '4010313', 'Y'),
	(2302, 27, '4010314', 'Y'),
	(2303, 27, '4010315', 'Y'),
	(2304, 27, '4010316', 'Y'),
	(2305, 27, '4010317', 'Y'),
	(2306, 27, '4010318', 'Y'),
	(2307, 27, '4010319', 'Y'),
	(2308, 27, '4010320', 'Y'),
	(2309, 27, '4010321', 'Y'),
	(2310, 27, '4010322', 'Y'),
	(2311, 27, '4010323', 'Y'),
	(2312, 27, '4010324', 'Y'),
	(2313, 27, '4010325', 'Y'),
	(2314, 27, '4010326', 'Y'),
	(2315, 27, '4010327', 'Y'),
	(2316, 27, '4010328', 'Y'),
	(2317, 27, '4010329', 'Y'),
	(2318, 27, '4010330', 'Y'),
	(2319, 27, '4010331', 'Y'),
	(2320, 27, '4010332', 'Y'),
	(2321, 27, '4010333', 'Y'),
	(2322, 27, '4010334', 'Y'),
	(2323, 27, '4010335', 'Y'),
	(2324, 27, '4010336', 'Y'),
	(2325, 27, '4010337', 'Y'),
	(2326, 27, '4010338', 'Y'),
	(2327, 27, '4010339', 'Y'),
	(2328, 28, '4010401', 'Y'),
	(2329, 28, '4010402', 'Y'),
	(2330, 28, '4010403', 'Y'),
	(2331, 28, '4010404', 'Y'),
	(2332, 28, '4010405', 'Y'),
	(2333, 28, '4010406', 'Y'),
	(2334, 28, '4010407', 'Y'),
	(2335, 28, '4010408', 'Y'),
	(2336, 28, '4010409', 'Y'),
	(2337, 28, '4010410', 'Y'),
	(2338, 28, '4010411', 'Y'),
	(2339, 28, '4010412', 'Y'),
	(2340, 28, '4010413', 'Y'),
	(2341, 28, '4010414', 'Y'),
	(2342, 28, '4010415', 'Y'),
	(2343, 28, '4010416', 'Y'),
	(2344, 28, '4010417', 'Y'),
	(2345, 28, '4010418', 'Y'),
	(2346, 28, '4010419', 'Y'),
	(2347, 28, '4010420', 'Y'),
	(2348, 28, '4010421', 'Y'),
	(2349, 28, '4010422', 'Y'),
	(2350, 28, '4010423', 'Y'),
	(2351, 28, '4010424', 'Y'),
	(2352, 28, '4010425', 'Y'),
	(2353, 28, '4010426', 'Y'),
	(2354, 28, '4010427', 'Y'),
	(2355, 28, '4010428', 'Y'),
	(2356, 28, '4010429', 'Y'),
	(2357, 28, '4010430', 'Y'),
	(2358, 28, '4010431', 'Y'),
	(2359, 28, '4010432', 'Y'),
	(2360, 28, '4010433', 'Y'),
	(2361, 28, '4010434', 'Y'),
	(2362, 28, '4010435', 'Y'),
	(2363, 28, '4010436', 'Y'),
	(2364, 28, '4010437', 'Y'),
	(2365, 28, '4010438', 'Y'),
	(2366, 28, '4010439', 'Y'),
	(2367, 29, '4010501', 'Y'),
	(2368, 29, '4010502', 'Y'),
	(2369, 29, '4010503', 'Y'),
	(2370, 29, '4010504', 'Y'),
	(2371, 29, '4010505', 'Y'),
	(2372, 29, '4010506', 'Y'),
	(2373, 29, '4010507', 'Y'),
	(2374, 29, '4010508', 'Y'),
	(2375, 29, '4010509', 'Y'),
	(2376, 29, '4010510', 'Y'),
	(2377, 29, '4010511', 'Y'),
	(2378, 29, '4010512', 'Y'),
	(2379, 29, '4010513', 'Y'),
	(2380, 29, '4010514', 'Y'),
	(2381, 29, '4010515', 'Y'),
	(2382, 29, '4010516', 'Y'),
	(2383, 29, '4010517', 'Y'),
	(2384, 29, '4010518', 'Y'),
	(2385, 29, '4010519', 'Y'),
	(2386, 29, '4010520', 'Y'),
	(2387, 29, '4010521', 'Y'),
	(2388, 29, '4010522', 'Y'),
	(2389, 29, '4010523', 'Y'),
	(2390, 29, '4010524', 'Y'),
	(2391, 29, '4010525', 'Y'),
	(2392, 29, '4010526', 'Y'),
	(2393, 29, '4010527', 'Y'),
	(2394, 29, '4010528', 'Y'),
	(2395, 29, '4010529', 'Y'),
	(2396, 29, '4010530', 'Y'),
	(2397, 29, '4010531', 'Y'),
	(2398, 29, '4010532', 'Y'),
	(2399, 29, '4010533', 'Y'),
	(2400, 29, '4010534', 'Y'),
	(2401, 29, '4010535', 'Y'),
	(2402, 29, '4010536', 'Y'),
	(2403, 29, '4010537', 'Y'),
	(2404, 29, '4010538', 'Y'),
	(2405, 29, '4010539', 'Y'),
	(2406, 30, '4010601', 'Y'),
	(2407, 30, '4010602', 'Y'),
	(2408, 30, '4010603', 'Y'),
	(2409, 30, '4010604', 'Y'),
	(2410, 30, '4010605', 'Y'),
	(2411, 30, '4010606', 'Y'),
	(2412, 30, '4010607', 'Y'),
	(2413, 30, '4010608', 'Y'),
	(2414, 30, '4010609', 'Y'),
	(2415, 30, '4010610', 'Y'),
	(2416, 30, '4010611', 'Y'),
	(2417, 30, '4010612', 'Y'),
	(2418, 30, '4010613', 'Y'),
	(2419, 30, '4010614', 'Y'),
	(2420, 30, '4010615', 'Y'),
	(2421, 30, '4010616', 'Y'),
	(2422, 30, '4010617', 'Y'),
	(2423, 30, '4010618', 'Y'),
	(2424, 30, '4010619', 'Y'),
	(2425, 30, '4010620', 'Y'),
	(2426, 30, '4010621', 'Y'),
	(2427, 30, '4010622', 'Y'),
	(2428, 30, '4010623', 'Y'),
	(2429, 30, '4010624', 'Y'),
	(2430, 30, '4010625', 'Y'),
	(2431, 30, '4010626', 'Y'),
	(2432, 30, '4010627', 'Y'),
	(2433, 30, '4010628', 'Y'),
	(2434, 30, '4010629', 'Y'),
	(2435, 30, '4010630', 'Y'),
	(2436, 30, '4010631', 'Y'),
	(2437, 30, '4010632', 'Y'),
	(2438, 30, '4010633', 'Y'),
	(2439, 30, '4010634', 'Y'),
	(2440, 30, '4010635', 'Y'),
	(2441, 30, '4010636', 'Y'),
	(2442, 30, '4010637', 'Y'),
	(2443, 30, '4010638', 'Y'),
	(2444, 30, '4010639', 'Y'),
	(2445, 44, '4010701', 'Y'),
	(2446, 44, '4010702', 'Y'),
	(2447, 44, '4010703', 'Y'),
	(2448, 44, '4010704', 'Y'),
	(2449, 44, '4010705', 'Y'),
	(2450, 44, '4010706', 'Y'),
	(2451, 44, '4010707', 'Y'),
	(2452, 44, '4010708', 'Y'),
	(2453, 44, '4010709', 'Y'),
	(2454, 44, '4010710', 'Y'),
	(2455, 44, '4010711', 'Y'),
	(2456, 44, '4010712', 'Y'),
	(2457, 44, '4010713', 'Y'),
	(2458, 44, '4010714', 'Y'),
	(2459, 44, '4010715', 'Y'),
	(2460, 44, '4010716', 'Y'),
	(2461, 44, '4010717', 'Y'),
	(2462, 44, '4010718', 'Y'),
	(2463, 44, '4010719', 'Y'),
	(2464, 44, '4010720', 'Y'),
	(2465, 44, '4010721', 'Y'),
	(2466, 44, '4010722', 'Y'),
	(2467, 44, '4010723', 'Y'),
	(2468, 44, '4010724', 'Y'),
	(2469, 44, '4010725', 'Y'),
	(2470, 44, '4010726', 'Y'),
	(2471, 44, '4010727', 'Y'),
	(2472, 44, '4010728', 'Y'),
	(2473, 44, '4010729', 'Y'),
	(2474, 44, '4010730', 'Y'),
	(2475, 44, '4010731', 'Y'),
	(2476, 44, '4010732', 'Y'),
	(2477, 44, '4010733', 'Y'),
	(2478, 44, '4010734', 'Y'),
	(2479, 44, '4010735', 'Y'),
	(2480, 44, '4010736', 'Y'),
	(2481, 44, '4010737', 'Y'),
	(2482, 44, '4010738', 'Y'),
	(2483, 44, '4010739', 'Y'),
	(2484, 45, '4010801', 'Y'),
	(2485, 45, '4010802', 'Y'),
	(2486, 45, '4010803', 'Y'),
	(2487, 45, '4010804', 'Y'),
	(2488, 45, '4010805', 'Y'),
	(2489, 45, '4010806', 'Y'),
	(2490, 45, '4010807', 'Y'),
	(2491, 45, '4010808', 'Y'),
	(2492, 45, '4010809', 'Y'),
	(2493, 45, '4010810', 'Y'),
	(2494, 45, '4010811', 'Y'),
	(2495, 45, '4010812', 'Y'),
	(2496, 45, '4010813', 'Y'),
	(2497, 45, '4010814', 'Y'),
	(2498, 45, '4010815', 'Y'),
	(2499, 45, '4010816', 'Y'),
	(2500, 45, '4010817', 'Y'),
	(2501, 45, '4010818', 'Y'),
	(2502, 45, '4010819', 'Y'),
	(2503, 45, '4010820', 'Y'),
	(2504, 45, '4010821', 'Y'),
	(2505, 45, '4010822', 'Y'),
	(2506, 45, '4010823', 'Y'),
	(2507, 45, '4010824', 'Y'),
	(2508, 45, '4010825', 'Y'),
	(2509, 45, '4010826', 'Y'),
	(2510, 45, '4010827', 'Y'),
	(2511, 45, '4010828', 'Y'),
	(2512, 45, '4010829', 'Y'),
	(2513, 45, '4010830', 'Y'),
	(2514, 45, '4010831', 'Y'),
	(2515, 45, '4010832', 'Y'),
	(2516, 45, '4010833', 'Y'),
	(2517, 45, '4010834', 'Y'),
	(2518, 45, '4010835', 'Y'),
	(2519, 45, '4010836', 'Y'),
	(2520, 45, '4010837', 'Y'),
	(2521, 45, '4010838', 'Y'),
	(2522, 45, '4010839', 'Y'),
	(2523, 46, '4010901', 'Y'),
	(2524, 46, '4010902', 'Y'),
	(2525, 46, '4010903', 'Y'),
	(2526, 46, '4010904', 'Y'),
	(2527, 46, '4010905', 'Y'),
	(2528, 46, '4010906', 'Y'),
	(2529, 46, '4010907', 'Y'),
	(2530, 46, '4010908', 'Y'),
	(2531, 46, '4010909', 'Y'),
	(2532, 46, '4010910', 'Y'),
	(2533, 46, '4010911', 'Y'),
	(2534, 46, '4010912', 'Y'),
	(2535, 46, '4010913', 'Y'),
	(2536, 46, '4010914', 'Y'),
	(2537, 46, '4010915', 'Y'),
	(2538, 46, '4010916', 'Y'),
	(2539, 46, '4010917', 'Y'),
	(2540, 46, '4010918', 'Y'),
	(2541, 46, '4010919', 'Y'),
	(2542, 46, '4010920', 'Y'),
	(2543, 46, '4010921', 'Y'),
	(2544, 46, '4010922', 'Y'),
	(2545, 46, '4010923', 'Y'),
	(2546, 46, '4010924', 'Y'),
	(2547, 46, '4010925', 'Y'),
	(2548, 46, '4010926', 'Y'),
	(2549, 46, '4010927', 'Y'),
	(2550, 46, '4010928', 'Y'),
	(2551, 46, '4010929', 'Y'),
	(2552, 46, '4010930', 'Y'),
	(2553, 46, '4010931', 'Y'),
	(2554, 46, '4010932', 'Y'),
	(2555, 46, '4010933', 'Y'),
	(2556, 46, '4010934', 'Y'),
	(2557, 46, '4010935', 'Y'),
	(2558, 46, '4010936', 'Y'),
	(2559, 46, '4010937', 'Y'),
	(2560, 46, '4010938', 'Y'),
	(2561, 46, '4010939', 'Y'),
	(2562, 47, '4011001', 'Y'),
	(2563, 47, '4011002', 'Y'),
	(2564, 47, '4011003', 'Y'),
	(2565, 47, '4011004', 'Y'),
	(2566, 47, '4011005', 'Y'),
	(2567, 47, '4011006', 'Y'),
	(2568, 47, '4011007', 'Y'),
	(2569, 47, '4011008', 'Y'),
	(2570, 47, '4011009', 'Y'),
	(2571, 47, '4011010', 'Y'),
	(2572, 47, '4011011', 'Y'),
	(2573, 47, '4011012', 'Y'),
	(2574, 47, '4011013', 'Y'),
	(2575, 47, '4011014', 'Y'),
	(2576, 47, '4011015', 'Y'),
	(2577, 47, '4011016', 'Y'),
	(2578, 47, '4011017', 'Y'),
	(2579, 47, '4011018', 'Y'),
	(2580, 47, '4011019', 'Y'),
	(2581, 47, '4011020', 'Y'),
	(2582, 47, '4011021', 'Y'),
	(2583, 47, '4011022', 'Y'),
	(2584, 47, '4011023', 'Y'),
	(2585, 47, '4011024', 'Y'),
	(2586, 47, '4011025', 'Y'),
	(2587, 47, '4011026', 'Y'),
	(2588, 47, '4011027', 'Y'),
	(2589, 47, '4011028', 'Y'),
	(2590, 47, '4011029', 'Y'),
	(2591, 47, '4011030', 'Y'),
	(2592, 47, '4011031', 'Y'),
	(2593, 47, '4011032', 'Y'),
	(2594, 47, '4011033', 'Y'),
	(2595, 47, '4011034', 'Y'),
	(2596, 47, '4011035', 'Y'),
	(2597, 47, '4011036', 'Y'),
	(2598, 47, '4011037', 'Y'),
	(2599, 47, '4011038', 'Y'),
	(2600, 47, '4011039', 'Y'),
	(2601, 48, '4011101', 'Y'),
	(2602, 48, '4011102', 'Y'),
	(2603, 48, '4011103', 'Y'),
	(2604, 48, '4011104', 'Y'),
	(2605, 48, '4011105', 'Y'),
	(2606, 48, '4011106', 'Y'),
	(2607, 48, '4011107', 'Y'),
	(2608, 48, '4011108', 'Y'),
	(2609, 48, '4011109', 'Y'),
	(2610, 48, '4011110', 'Y'),
	(2611, 48, '4011111', 'Y'),
	(2612, 48, '4011112', 'Y'),
	(2613, 48, '4011113', 'Y'),
	(2614, 48, '4011114', 'Y'),
	(2615, 48, '4011115', 'Y'),
	(2616, 48, '4011116', 'Y'),
	(2617, 48, '4011117', 'Y'),
	(2618, 48, '4011118', 'Y'),
	(2619, 48, '4011119', 'Y'),
	(2620, 48, '4011120', 'Y'),
	(2621, 48, '4011121', 'Y'),
	(2622, 48, '4011122', 'Y'),
	(2623, 48, '4011123', 'Y'),
	(2624, 48, '4011124', 'Y'),
	(2625, 48, '4011125', 'Y'),
	(2626, 48, '4011126', 'Y'),
	(2627, 48, '4011127', 'Y'),
	(2628, 48, '4011128', 'Y'),
	(2629, 48, '4011129', 'Y'),
	(2630, 48, '4011130', 'Y'),
	(2631, 48, '4011131', 'Y'),
	(2632, 48, '4011132', 'Y'),
	(2633, 48, '4011133', 'Y'),
	(2634, 48, '4011134', 'Y'),
	(2635, 48, '4011135', 'Y'),
	(2636, 48, '4011136', 'Y'),
	(2637, 48, '4011137', 'Y'),
	(2638, 48, '4011138', 'Y'),
	(2639, 48, '4011139', 'Y'),
	(2647, 53, '5010101', 'Y'),
	(2648, 53, '5010102', 'Y'),
	(2649, 53, '5010103', 'Y'),
	(2650, 53, '5010104', 'Y'),
	(2651, 53, '5010105', 'Y'),
	(2652, 53, '5010106', 'Y'),
	(2653, 53, '5010107', 'Y'),
	(2654, 53, '5010108', 'Y'),
	(2655, 53, '5010109', 'Y'),
	(2657, 54, '501020102', 'Y'),
	(2658, 54, '501020103', 'Y'),
	(2659, 54, '501020104', 'Y'),
	(2660, 54, '501020105', 'Y'),
	(2661, 54, '501020106', 'Y'),
	(2662, 54, '501020107', 'Y'),
	(2663, 54, '501020108', 'Y'),
	(2664, 54, '501020109', 'Y'),
	(2665, 54, '501020110', 'Y'),
	(2666, 54, '501020111', 'Y'),
	(2667, 54, '501020112', 'Y'),
	(2668, 54, '501020113', 'Y'),
	(2669, 54, '501020114', 'Y'),
	(2670, 54, '501020115', 'Y'),
	(2671, 54, '501020116', 'Y'),
	(2672, 54, '501020117', 'Y'),
	(2673, 54, '501020118', 'Y'),
	(2674, 54, '501020119', 'Y'),
	(2675, 54, '501020120', 'Y'),
	(2676, 54, '501020121', 'Y'),
	(2677, 54, '501020122', 'Y'),
	(2678, 54, '501020123', 'Y'),
	(2679, 54, '501020124', 'Y'),
	(2680, 54, '501020125', 'Y'),
	(2681, 54, '501020126', 'Y'),
	(2682, 54, '501020127', 'Y'),
	(2683, 54, '501020128', 'Y'),
	(2684, 54, '501020129', 'Y'),
	(2685, 54, '501020130', 'Y'),
	(2686, 54, '501020131', 'Y'),
	(2687, 54, '501020132', 'Y'),
	(2688, 54, '501020133', 'Y'),
	(2689, 54, '501020134', 'Y'),
	(2690, 54, '501020135', 'Y'),
	(2691, 54, '501020136', 'Y'),
	(2692, 54, '501020137', 'Y'),
	(2693, 54, '501020138', 'Y'),
	(2694, 54, '501020139', 'Y'),
	(2696, 54, '501020202', 'Y'),
	(2697, 54, '501020203', 'Y'),
	(2698, 54, '501020204', 'Y'),
	(2699, 54, '501020205', 'Y'),
	(2700, 54, '501020206', 'Y'),
	(2701, 54, '501020207', 'Y'),
	(2702, 54, '501020208', 'Y'),
	(2703, 54, '501020209', 'Y'),
	(2704, 54, '501020210', 'Y'),
	(2705, 54, '501020211', 'Y'),
	(2706, 54, '501020212', 'Y'),
	(2707, 54, '501020213', 'Y'),
	(2708, 54, '501020214', 'Y'),
	(2709, 54, '501020215', 'Y'),
	(2710, 54, '501020216', 'Y'),
	(2711, 54, '501020217', 'Y'),
	(2712, 54, '501020218', 'Y'),
	(2713, 54, '501020219', 'Y'),
	(2714, 54, '501020220', 'Y'),
	(2715, 54, '501020221', 'Y'),
	(2716, 54, '501020222', 'Y'),
	(2717, 54, '501020223', 'Y'),
	(2718, 54, '501020224', 'Y'),
	(2719, 54, '501020225', 'Y'),
	(2720, 54, '501020226', 'Y'),
	(2721, 54, '501020227', 'Y'),
	(2722, 54, '501020228', 'Y'),
	(2723, 54, '501020229', 'Y'),
	(2724, 54, '501020230', 'Y'),
	(2725, 54, '501020231', 'Y'),
	(2726, 54, '501020232', 'Y'),
	(2727, 54, '501020233', 'Y'),
	(2728, 54, '501020234', 'Y'),
	(2729, 54, '501020235', 'Y'),
	(2730, 54, '501020236', 'Y'),
	(2731, 54, '501020237', 'Y'),
	(2732, 54, '501020238', 'Y'),
	(2733, 54, '501020239', 'Y'),
	(2735, 54, '501020302', 'Y'),
	(2736, 54, '501020303', 'Y'),
	(2737, 54, '501020304', 'Y'),
	(2738, 54, '501020305', 'Y'),
	(2739, 54, '501020306', 'Y'),
	(2740, 54, '501020307', 'Y'),
	(2741, 54, '501020308', 'Y'),
	(2742, 54, '501020309', 'Y'),
	(2743, 54, '501020310', 'Y'),
	(2744, 54, '501020311', 'Y'),
	(2745, 54, '501020312', 'Y'),
	(2746, 54, '501020313', 'Y'),
	(2747, 54, '501020314', 'Y'),
	(2748, 54, '501020315', 'Y'),
	(2749, 54, '501020316', 'Y'),
	(2750, 54, '501020317', 'Y'),
	(2751, 54, '501020318', 'Y'),
	(2752, 54, '501020319', 'Y'),
	(2753, 54, '501020320', 'Y'),
	(2754, 54, '501020321', 'Y'),
	(2755, 54, '501020322', 'Y'),
	(2756, 54, '501020323', 'Y'),
	(2757, 54, '501020324', 'Y'),
	(2758, 54, '501020325', 'Y'),
	(2759, 54, '501020326', 'Y'),
	(2760, 54, '501020327', 'Y'),
	(2761, 54, '501020328', 'Y'),
	(2762, 54, '501020329', 'Y'),
	(2763, 54, '501020330', 'Y'),
	(2764, 54, '501020331', 'Y'),
	(2765, 54, '501020332', 'Y'),
	(2766, 54, '501020333', 'Y'),
	(2767, 54, '501020334', 'Y'),
	(2768, 54, '501020335', 'Y'),
	(2769, 54, '501020336', 'Y'),
	(2770, 54, '501020337', 'Y'),
	(2771, 54, '501020338', 'Y'),
	(2772, 54, '501020339', 'Y'),
	(2774, 54, '501020402', 'Y'),
	(2775, 54, '501020403', 'Y'),
	(2776, 54, '501020404', 'Y'),
	(2777, 54, '501020405', 'Y'),
	(2778, 54, '501020406', 'Y'),
	(2779, 54, '501020407', 'Y'),
	(2780, 54, '501020408', 'Y'),
	(2781, 54, '501020409', 'Y'),
	(2782, 54, '501020410', 'Y'),
	(2783, 54, '501020411', 'Y'),
	(2784, 54, '501020412', 'Y'),
	(2785, 54, '501020413', 'Y'),
	(2786, 54, '501020414', 'Y'),
	(2787, 54, '501020415', 'Y'),
	(2788, 54, '501020416', 'Y'),
	(2789, 54, '501020417', 'Y'),
	(2790, 54, '501020418', 'Y'),
	(2791, 54, '501020419', 'Y'),
	(2792, 54, '501020420', 'Y'),
	(2793, 54, '501020421', 'Y'),
	(2794, 54, '501020422', 'Y'),
	(2795, 54, '501020423', 'Y'),
	(2796, 54, '501020424', 'Y'),
	(2797, 54, '501020425', 'Y'),
	(2798, 54, '501020426', 'Y'),
	(2799, 54, '501020427', 'Y'),
	(2800, 54, '501020428', 'Y'),
	(2801, 54, '501020429', 'Y'),
	(2802, 54, '501020430', 'Y'),
	(2803, 54, '501020431', 'Y'),
	(2804, 54, '501020432', 'Y'),
	(2805, 54, '501020433', 'Y'),
	(2806, 54, '501020434', 'Y'),
	(2807, 54, '501020435', 'Y'),
	(2808, 54, '501020436', 'Y'),
	(2809, 54, '501020437', 'Y'),
	(2810, 54, '501020438', 'Y'),
	(2811, 54, '501020439', 'Y'),
	(2812, 54, '5010205', 'Y'),
	(2814, 54, '501020602', 'Y'),
	(2815, 54, '501020603', 'Y'),
	(2816, 54, '501020604', 'Y'),
	(2817, 54, '501020605', 'Y'),
	(2818, 54, '501020606', 'Y'),
	(2819, 54, '501020607', 'Y'),
	(2820, 54, '501020608', 'Y'),
	(2821, 54, '501020609', 'Y'),
	(2822, 54, '501020610', 'Y'),
	(2823, 54, '501020611', 'Y'),
	(2824, 54, '501020612', 'Y'),
	(2825, 54, '501020613', 'Y'),
	(2826, 54, '501020614', 'Y'),
	(2827, 54, '501020615', 'Y'),
	(2828, 54, '501020616', 'Y'),
	(2829, 54, '501020617', 'Y'),
	(2830, 54, '501020618', 'Y'),
	(2831, 54, '501020619', 'Y'),
	(2832, 54, '501020620', 'Y'),
	(2833, 54, '501020621', 'Y'),
	(2834, 54, '501020622', 'Y'),
	(2835, 54, '501020623', 'Y'),
	(2836, 54, '501020624', 'Y'),
	(2837, 54, '501020625', 'Y'),
	(2838, 54, '501020626', 'Y'),
	(2839, 54, '501020627', 'Y'),
	(2840, 54, '501020628', 'Y'),
	(2841, 54, '501020629', 'Y'),
	(2842, 54, '501020630', 'Y'),
	(2843, 54, '501020631', 'Y'),
	(2844, 54, '501020632', 'Y'),
	(2845, 54, '501020633', 'Y'),
	(2846, 54, '501020634', 'Y'),
	(2847, 54, '501020635', 'Y'),
	(2848, 54, '501020636', 'Y'),
	(2849, 54, '501020637', 'Y'),
	(2850, 54, '501020638', 'Y'),
	(2851, 54, '501020639', 'Y'),
	(2852, 54, '5010207', 'Y'),
	(2853, 54, '5010208', 'Y'),
	(2854, 54, '5010209', 'Y'),
	(2856, 54, '501021002', 'Y'),
	(2857, 54, '501021003', 'Y'),
	(2858, 54, '501021004', 'Y'),
	(2859, 54, '501021005', 'Y'),
	(2860, 54, '501021006', 'Y'),
	(2861, 54, '501021007', 'Y'),
	(2862, 54, '501021008', 'Y'),
	(2863, 54, '501021009', 'Y'),
	(2864, 54, '501021010', 'Y'),
	(2865, 54, '501021011', 'Y'),
	(2866, 54, '501021012', 'Y'),
	(2867, 54, '501021013', 'Y'),
	(2868, 54, '501021014', 'Y'),
	(2869, 54, '501021015', 'Y'),
	(2870, 54, '501021016', 'Y'),
	(2871, 54, '501021017', 'Y'),
	(2872, 54, '501021018', 'Y'),
	(2873, 54, '501021019', 'Y'),
	(2874, 54, '501021020', 'Y'),
	(2875, 54, '501021021', 'Y'),
	(2876, 54, '501021022', 'Y'),
	(2877, 54, '501021023', 'Y'),
	(2878, 54, '501021024', 'Y'),
	(2879, 54, '501021025', 'Y'),
	(2880, 54, '501021026', 'Y'),
	(2881, 54, '501021027', 'Y'),
	(2882, 54, '501021028', 'Y'),
	(2883, 54, '501021029', 'Y'),
	(2884, 54, '501021030', 'Y'),
	(2885, 54, '501021031', 'Y'),
	(2886, 54, '501021032', 'Y'),
	(2887, 54, '501021033', 'Y'),
	(2888, 54, '501021034', 'Y'),
	(2889, 54, '501021035', 'Y'),
	(2890, 54, '501021036', 'Y'),
	(2891, 54, '501021037', 'Y'),
	(2892, 54, '501021038', 'Y'),
	(2893, 54, '501021039', 'Y'),
	(2895, 54, '501021102', 'Y'),
	(2896, 54, '501021103', 'Y'),
	(2897, 54, '501021104', 'Y'),
	(2898, 54, '501021105', 'Y'),
	(2899, 54, '501021106', 'Y'),
	(2900, 54, '501021107', 'Y'),
	(2901, 54, '501021108', 'Y'),
	(2902, 54, '501021109', 'Y'),
	(2903, 54, '501021110', 'Y'),
	(2904, 54, '501021111', 'Y'),
	(2905, 54, '501021112', 'Y'),
	(2906, 54, '501021113', 'Y'),
	(2907, 54, '501021114', 'Y'),
	(2908, 54, '501021115', 'Y'),
	(2909, 54, '501021116', 'Y'),
	(2910, 54, '501021117', 'Y'),
	(2911, 54, '501021118', 'Y'),
	(2912, 54, '501021119', 'Y'),
	(2913, 54, '501021120', 'Y'),
	(2914, 54, '501021121', 'Y'),
	(2915, 54, '501021122', 'Y'),
	(2916, 54, '501021123', 'Y'),
	(2917, 54, '501021124', 'Y'),
	(2918, 54, '501021125', 'Y'),
	(2919, 54, '501021126', 'Y'),
	(2920, 54, '501021127', 'Y'),
	(2921, 54, '501021128', 'Y'),
	(2922, 54, '501021129', 'Y'),
	(2923, 54, '501021130', 'Y'),
	(2924, 54, '501021131', 'Y'),
	(2925, 54, '501021132', 'Y'),
	(2926, 54, '501021133', 'Y'),
	(2927, 54, '501021134', 'Y'),
	(2928, 54, '501021135', 'Y'),
	(2929, 54, '501021136', 'Y'),
	(2930, 54, '501021137', 'Y'),
	(2931, 54, '501021138', 'Y'),
	(2932, 54, '501021139', 'Y'),
	(2934, 54, '501021202', 'Y'),
	(2935, 54, '501021203', 'Y'),
	(2936, 54, '501021204', 'Y'),
	(2937, 54, '501021205', 'Y'),
	(2938, 54, '501021206', 'Y'),
	(2939, 54, '501021207', 'Y'),
	(2940, 54, '501021208', 'Y'),
	(2941, 54, '501021209', 'Y'),
	(2942, 54, '501021210', 'Y'),
	(2943, 54, '501021211', 'Y'),
	(2944, 54, '501021212', 'Y'),
	(2945, 54, '501021213', 'Y'),
	(2946, 54, '501021214', 'Y'),
	(2947, 54, '501021215', 'Y'),
	(2948, 54, '501021216', 'Y'),
	(2949, 54, '501021217', 'Y'),
	(2950, 54, '501021218', 'Y'),
	(2951, 54, '501021219', 'Y'),
	(2952, 54, '501021220', 'Y'),
	(2953, 54, '501021221', 'Y'),
	(2954, 54, '501021222', 'Y'),
	(2955, 54, '501021223', 'Y'),
	(2956, 54, '501021224', 'Y'),
	(2957, 54, '501021225', 'Y'),
	(2958, 54, '501021226', 'Y'),
	(2959, 54, '501021227', 'Y'),
	(2960, 54, '501021228', 'Y'),
	(2961, 54, '501021229', 'Y'),
	(2962, 54, '501021230', 'Y'),
	(2963, 54, '501021231', 'Y'),
	(2964, 54, '501021232', 'Y'),
	(2965, 54, '501021233', 'Y'),
	(2966, 54, '501021234', 'Y'),
	(2967, 54, '501021235', 'Y'),
	(2968, 54, '501021236', 'Y'),
	(2969, 54, '501021237', 'Y'),
	(2970, 54, '501021238', 'Y'),
	(2971, 54, '501021239', 'Y'),
	(2973, 54, '501021302', 'Y'),
	(2974, 54, '501021303', 'Y'),
	(2975, 54, '501021304', 'Y'),
	(2976, 54, '501021305', 'Y'),
	(2977, 54, '501021306', 'Y'),
	(2978, 54, '501021307', 'Y'),
	(2979, 54, '501021308', 'Y'),
	(2980, 54, '501021309', 'Y'),
	(2981, 54, '501021310', 'Y'),
	(2982, 54, '501021311', 'Y'),
	(2983, 54, '501021312', 'Y'),
	(2984, 54, '501021313', 'Y'),
	(2985, 54, '501021314', 'Y'),
	(2986, 54, '501021315', 'Y'),
	(2987, 54, '501021316', 'Y'),
	(2988, 54, '501021317', 'Y'),
	(2989, 54, '501021318', 'Y'),
	(2990, 54, '501021319', 'Y'),
	(2991, 54, '501021320', 'Y'),
	(2992, 54, '501021321', 'Y'),
	(2993, 54, '501021322', 'Y'),
	(2994, 54, '501021323', 'Y'),
	(2995, 54, '501021324', 'Y'),
	(2996, 54, '501021325', 'Y'),
	(2997, 54, '501021326', 'Y'),
	(2998, 54, '501021327', 'Y'),
	(2999, 54, '501021328', 'Y'),
	(3000, 54, '501021329', 'Y'),
	(3001, 54, '501021330', 'Y'),
	(3002, 54, '501021331', 'Y'),
	(3003, 54, '501021332', 'Y'),
	(3004, 54, '501021333', 'Y'),
	(3005, 54, '501021334', 'Y'),
	(3006, 54, '501021335', 'Y'),
	(3007, 54, '501021336', 'Y'),
	(3008, 54, '501021337', 'Y'),
	(3009, 54, '501021338', 'Y'),
	(3010, 54, '501021339', 'Y'),
	(3012, 54, '501021402', 'Y'),
	(3013, 54, '501021403', 'Y'),
	(3014, 54, '501021404', 'Y'),
	(3015, 54, '501021405', 'Y'),
	(3016, 54, '501021406', 'Y'),
	(3017, 54, '501021407', 'Y'),
	(3018, 54, '501021408', 'Y'),
	(3019, 54, '501021409', 'Y'),
	(3020, 54, '501021410', 'Y'),
	(3021, 54, '501021411', 'Y'),
	(3022, 54, '501021412', 'Y'),
	(3023, 54, '501021413', 'Y'),
	(3024, 54, '501021414', 'Y'),
	(3025, 54, '501021415', 'Y'),
	(3026, 54, '501021416', 'Y'),
	(3027, 54, '501021417', 'Y'),
	(3028, 54, '501021418', 'Y'),
	(3029, 54, '501021419', 'Y'),
	(3030, 54, '501021420', 'Y'),
	(3031, 54, '501021421', 'Y'),
	(3032, 54, '501021422', 'Y'),
	(3033, 54, '501021423', 'Y'),
	(3034, 54, '501021424', 'Y'),
	(3035, 54, '501021425', 'Y'),
	(3036, 54, '501021426', 'Y'),
	(3037, 54, '501021427', 'Y'),
	(3038, 54, '501021428', 'Y'),
	(3039, 54, '501021429', 'Y'),
	(3040, 54, '501021430', 'Y'),
	(3041, 54, '501021431', 'Y'),
	(3042, 54, '501021432', 'Y'),
	(3043, 54, '501021433', 'Y'),
	(3044, 54, '501021434', 'Y'),
	(3045, 54, '501021435', 'Y'),
	(3046, 54, '501021436', 'Y'),
	(3047, 54, '501021437', 'Y'),
	(3048, 54, '501021438', 'Y'),
	(3049, 54, '501021439', 'Y'),
	(3050, 55, '5010301', 'Y'),
	(3051, 55, '5010302', 'Y'),
	(3052, 55, '5010303', 'Y'),
	(3053, 55, '5010304', 'Y'),
	(3054, 56, '5010401', 'Y'),
	(3055, 56, '5010402', 'Y'),
	(3056, 56, '5010403', 'Y'),
	(3057, 56, '5010404', 'Y'),
	(3058, 57, '5010501', 'Y'),
	(3059, 57, '5010502', 'Y'),
	(3060, 57, '5010503', 'Y'),
	(3061, 57, '5010504', 'Y'),
	(3062, 57, '5010505', 'Y'),
	(3063, 57, '5010506', 'Y'),
	(3064, 57, '5010507', 'Y'),
	(3065, 57, '5010508', 'Y'),
	(3066, 57, '5010509', 'Y'),
	(3067, 57, '5010510', 'Y'),
	(3068, 57, '5010511', 'Y'),
	(3069, 57, '5010512', 'Y'),
	(3070, 58, '5010601', 'Y'),
	(3071, 58, '5010602', 'Y'),
	(3072, 58, '5010603', 'Y'),
	(3073, 59, '5020101', 'Y'),
	(3074, 59, '5020102', 'Y'),
	(3075, 59, '5020103', 'Y'),
	(3076, 59, '5020104', 'Y'),
	(3077, 59, '5020105', 'Y'),
	(3078, 59, '5020106', 'Y'),
	(3079, 59, '5020107', 'Y'),
	(3080, 59, '5020108', 'Y'),
	(3081, 59, '5020109', 'Y'),
	(3082, 59, '5020110', 'Y'),
	(3083, 59, '5020111', 'Y'),
	(3084, 59, '5020112', 'Y'),
	(3085, 59, '5020113', 'Y'),
	(3086, 59, '5020114', 'Y'),
	(3087, 59, '5020115', 'Y'),
	(3088, 59, '5020116', 'Y'),
	(3089, 59, '5020117', 'Y'),
	(3090, 60, '5020201', 'Y'),
	(3091, 60, '5020202', 'Y'),
	(3092, 60, '5020203', 'Y'),
	(3093, 60, '5020204', 'Y'),
	(3094, 60, '5020205', 'Y'),
	(3095, 60, '5020206', 'Y'),
	(3096, 60, '5020207', 'Y'),
	(3097, 60, '5020208', 'Y'),
	(3098, 60, '5020209', 'Y'),
	(3099, 60, '5020210', 'Y'),
	(3100, 60, '5020211', 'Y'),
	(3101, 61, '5020301', 'Y'),
	(3102, 61, '5020302', 'Y'),
	(3103, 61, '5020303', 'Y'),
	(3104, 61, '5020304', 'Y'),
	(3105, 62, '5020401', 'Y'),
	(3106, 62, '5020402', 'Y'),
	(3107, 62, '5020403', 'Y'),
	(3108, 62, '5020404', 'Y'),
	(3109, 63, '5020501', 'Y'),
	(3110, 63, '5020502', 'Y'),
	(3111, 63, '5020503', 'Y'),
	(3112, 63, '5020504', 'Y'),
	(3113, 63, '5020505', 'Y'),
	(3114, 63, '5020506', 'Y'),
	(3115, 63, '5020507', 'Y'),
	(3116, 63, '5020508', 'Y'),
	(3117, 63, '5020509', 'Y'),
	(3118, 64, '5020601', 'Y'),
	(3119, 64, '5020602', 'Y'),
	(3120, 64, '5020603', 'Y'),
	(3121, 64, '5020604', 'Y'),
	(3122, 64, '5020605', 'Y'),
	(3124, 66, '5020801', 'Y'),
	(3125, 66, '5020802', 'Y'),
	(3126, 66, '5020803', 'Y'),
	(3127, 66, '5020804', 'Y'),
	(3128, 67, '5020901', 'Y'),
	(3129, 67, '5020902', 'Y'),
	(3130, 67, '5020903', 'Y'),
	(3131, 67, '5020904', 'Y'),
	(3132, 67, '5020905', 'Y'),
	(3133, 67, '5020906', 'Y'),
	(3134, 68, '5021001', 'Y'),
	(3135, 68, '5021002', 'Y'),
	(3136, 68, '5021003', 'Y'),
	(3137, 69, '5021101', 'Y'),
	(3138, 69, '5021102', 'Y'),
	(3139, 69, '5021103', 'Y'),
	(3140, 69, '5021104', 'Y'),
	(3141, 69, '5021105', 'Y'),
	(3142, 69, '5021106', 'Y'),
	(3143, 70, '5021201', 'Y'),
	(3144, 70, '5021202', 'Y'),
	(3145, 70, '5021203', 'Y'),
	(3146, 70, '5021204', 'Y'),
	(3147, 70, '5021205', 'Y'),
	(3148, 70, '5021206', 'Y'),
	(3149, 70, '5021207', 'Y'),
	(3150, 70, '5021208', 'Y'),
	(3234, 54, '5010210', 'Y'),
	(3235, 54, '5010211', 'Y'),
	(3236, 54, '5010212', 'Y'),
	(3237, 54, '5010201', 'Y'),
	(3238, 54, '5010202', 'Y'),
	(3239, 54, '5010203', 'Y'),
	(3240, 54, '5010204', 'Y'),
	(3241, 54, '5010206', 'Y'),
	(3242, 54, '5010213', 'Y'),
	(3243, 54, '5010214', 'Y'),
	(3244, 79, '20204', 'Y'),
	(3245, 78, '20107', 'Y'),
	(3246, 19, '20203', 'Y'),
	(3247, 59, '5020118', 'Y'),
	(3248, 14, '2010401', 'Y'),
	(3249, 14, '2010402', 'Y'),
	(3250, 14, '2010403', 'Y'),
	(3251, 14, '2010404', 'Y'),
	(3252, 44, '40107', 'Y'),
	(3253, 52, '401206', 'Y'),
	(3254, 49, '401207', 'Y'),
	(3255, 14, '2010405', 'Y'),
	(3256, 49, '401201', 'Y'),
	(3257, 49, '401202', 'Y'),
	(3258, 49, '401203', 'Y'),
	(3259, 49, '401204', 'Y'),
	(3260, 49, '401205', 'Y'),
	(3261, 58, '5010604', 'Y'),
	(3262, 58, '5010605', 'Y'),
	(3263, 58, '5010606', 'Y'),
	(3264, 58, '5010607', 'Y'),
	(3265, 1, '1010211', 'Y'),
	(3266, 1, '1010212', 'Y'),
	(3267, 1, '1010213', 'Y'),
	(3268, 61, '5010305', 'Y'),
	(3269, 58, '5010608', 'Y'),
	(3270, 40, '1030206', 'Y'),
	(3271, 81, '20205', 'Y'),
	(3272, 53, '5010110', 'Y'),
	(3273, 47, '40110', 'Y');

-- Dumping structure for table smartacc.ms_format_clk
CREATE TABLE IF NOT EXISTS `ms_format_clk` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) DEFAULT NULL,
  `nomorlap` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_format_clk: ~2 rows (approximately)
INSERT INTO `ms_format_clk` (`nomor`, `tahun`, `nomorlap`, `catatan`) VALUES
	(5, '2017', 1, 'Kas Kecil Unit Pasar adalah kas kecil yang disiapkan untuk operasional kantor unit pasar, adapun minus adalah perbedaan antara pengajuan dengan pembayaran kas kecil unit pasar'),
	(7, '2017', 2, 'Ini adalah catatan piutang\n1. piutang usaha\n2. piutang lain-lain\n3. piutang karyawan');

-- Dumping structure for table smartacc.ms_identity
CREATE TABLE IF NOT EXISTS `ms_identity` (
  `kodecbg` char(2) NOT NULL,
  `nama_usaha` varchar(65) NOT NULL,
  `alamat1` varchar(255) DEFAULT NULL,
  `alamat2` varchar(255) DEFAULT NULL,
  `telpon` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `chstore` varchar(20) DEFAULT NULL,
  `kasir` varchar(20) DEFAULT NULL,
  `periode_tahun` char(4) DEFAULT NULL,
  `periode_bulan` int(2) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `akunlrberjalan` varchar(20) DEFAULT NULL,
  `akunlrlalu` varchar(20) DEFAULT NULL,
  `akun_aktivalancar` varchar(20) DEFAULT NULL,
  `akun_hutanglancar` varchar(20) DEFAULT NULL,
  `akun_hutang` varchar(20) DEFAULT NULL,
  `akun_aktiva` varchar(20) DEFAULT NULL,
  `motto` varchar(50) DEFAULT NULL,
  `rubahhrg` char(1) DEFAULT NULL,
  `rubahhrgm` char(1) DEFAULT NULL,
  `tglpro` date DEFAULT NULL,
  `tglhargajualm` date DEFAULT NULL,
  `margin1` decimal(11,2) DEFAULT NULL,
  `margin2` decimal(11,2) DEFAULT NULL,
  `margin3` decimal(11,2) DEFAULT NULL,
  `typeppn` char(1) DEFAULT NULL,
  `akun_persediaan_transit` varchar(20) DEFAULT NULL,
  `akun_persediaan` varchar(20) DEFAULT NULL,
  `akun_biaya_kerugian_lain` varchar(20) DEFAULT NULL,
  `akun_pendapatan_lain` varchar(20) DEFAULT NULL,
  `akun_penjualan` varchar(20) DEFAULT NULL,
  `akun_ppn` varchar(20) DEFAULT NULL,
  `akun_ongkir` varchar(20) DEFAULT NULL,
  `akun_uangmuka` varchar(20) DEFAULT NULL,
  `akun_hpp` varchar(20) DEFAULT NULL,
  `akun_kas` varchar(20) DEFAULT NULL,
  `akun_uangmukajual` varchar(20) DEFAULT NULL,
  `akun_piutang` varchar(20) DEFAULT NULL,
  `akun_ongkirjual` varchar(20) DEFAULT NULL,
  `akun_retjual` varchar(20) DEFAULT NULL,
  `akun_hutangbeli` varchar(20) DEFAULT NULL,
  `pwdemail` varchar(50) DEFAULT NULL,
  `smtp_host` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kodecbg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_identity: ~1 rows (approximately)
INSERT INTO `ms_identity` (`kodecbg`, `nama_usaha`, `alamat1`, `alamat2`, `telpon`, `kota`, `kodepos`, `fax`, `hp`, `email`, `chstore`, `kasir`, `periode_tahun`, `periode_bulan`, `website`, `akunlrberjalan`, `akunlrlalu`, `akun_aktivalancar`, `akun_hutanglancar`, `akun_hutang`, `akun_aktiva`, `motto`, `rubahhrg`, `rubahhrgm`, `tglpro`, `tglhargajualm`, `margin1`, `margin2`, `margin3`, `typeppn`, `akun_persediaan_transit`, `akun_persediaan`, `akun_biaya_kerugian_lain`, `akun_pendapatan_lain`, `akun_penjualan`, `akun_ppn`, `akun_ongkir`, `akun_uangmuka`, `akun_hpp`, `akun_kas`, `akun_uangmukajual`, `akun_piutang`, `akun_ongkirjual`, `akun_retjual`, `akun_hutangbeli`, `pwdemail`, `smtp_host`, `smtp_port`) VALUES
	('Ca', 'DEMO', 'Jl. ABC', '', '', 'Bandung', '', '', '', 'support@demo.megahperkasa.com', '', 'kasir', '2024', 9, '', '300009', '300002', NULL, NULL, '210101', NULL, 'SANTUN, AKUNTABEL DAN EFISIEN', 'T', 'T', '2018-09-24', '2018-09-24', 10.00, 20.00, 30.00, 'I', '110401', '110401', '1101', '1101', '400001', '110504', '1101', '110302', '5101', '110101', '210102', '110301', '600014', '400003', '210203', '', 'smtp.gmail.com', '587');

-- Dumping structure for table smartacc.ms_jurnal
CREATE TABLE IF NOT EXISTS `ms_jurnal` (
  `jurnal_kode` char(5) NOT NULL,
  `jurnal_nama` varchar(50) DEFAULT NULL,
  `jurnal_jenis` char(1) DEFAULT NULL,
  PRIMARY KEY (`jurnal_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_jurnal: ~8 rows (approximately)
INSERT INTO `ms_jurnal` (`jurnal_kode`, `jurnal_nama`, `jurnal_jenis`) VALUES
	('JB', 'JURNAL KAS . BANK', '7'),
	('JJ', 'JURNAL PENJUALAN', NULL),
	('JK', 'JURNAL KAS', '4'),
	('JP', 'JURNAL PEMBELIAN', '2'),
	('JR', 'JURNAL RKM', '5'),
	('JS', 'JURNAL PENYUSUTAN', '3'),
	('JU', 'JURNAL UMUM', '1'),
	('KT', 'JURNAL TRANSFER', '9');

-- Dumping structure for table smartacc.ms_jurnalrinci
CREATE TABLE IF NOT EXISTS `ms_jurnalrinci` (
  `jurnal_nomor` char(5) NOT NULL,
  `jurnal_nourut` int(11) NOT NULL,
  `jurnal_posisi` char(1) DEFAULT NULL,
  `jurnal_kodeakun` varchar(20) DEFAULT NULL,
  `jurnal_uraian` varchar(50) DEFAULT NULL,
  `jurnal_jumlah` double(15,3) DEFAULT NULL,
  PRIMARY KEY (`jurnal_nomor`,`jurnal_nourut`),
  KEY `jurnal_kodeakun` (`jurnal_kodeakun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_jurnalrinci: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_kasir
CREATE TABLE IF NOT EXISTS `ms_kasir` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `kodecbg` char(2) DEFAULT NULL,
  `kdkas` varchar(10) DEFAULT NULL,
  `namakas` varchar(20) DEFAULT NULL,
  `saldoawal` double DEFAULT 0,
  `saldojln` double DEFAULT 0,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_kasir: ~0 rows (approximately)

-- Dumping structure for table smartacc.ms_kelakun
CREATE TABLE IF NOT EXISTS `ms_kelakun` (
  `kode` varchar(2) NOT NULL,
  `namakelompok` varchar(50) DEFAULT NULL,
  `akunawal` varchar(20) DEFAULT NULL,
  `akunakhir` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_kelakun: ~16 rows (approximately)
INSERT INTO `ms_kelakun` (`kode`, `namakelompok`, `akunawal`, `akunakhir`) VALUES
	('A', 'Aktiva', '100000000000', '199999999999'),
	('B', 'Hutang', '200000000000', '299999999999'),
	('C', 'Modal', '300000000000', '399999999999'),
	('D', 'Penjualan', '400000000000', '499999999999'),
	('E', 'Harga Pokok Penjualan', '51000000000', '519999999999'),
	('F', 'Biaya', '500000000000', '533011999999'),
	('G', 'Pendapatan Lain-lain', '611011010100', '921011010100'),
	('H', 'Biaya Lain-lain', '650000000000', '659999999999'),
	('K', 'Laba Ditahan Tahun Lalu', '391011010100', '391011010999'),
	('K1', 'Laba Ditahan Awal Tahun s/d Bulan Lalu Entry', '391012010100', '391012010999'),
	('L', 'Laba Ditahan Awal Bulan Entry s/d Bulan Lalu', '391013010100', '391013010999'),
	('M', 'Laba Berjalan', '391013999999', '391013999999'),
	('N', 'Total Aktiva', '199999999999', '199999999999'),
	('O', 'Total Passiva', '299999999999', '299999999999'),
	('X', 'Cash dan Bank', '111010000000', '111999999999'),
	('Y', 'Total Pendapatan Lain Dan Biaya Lain', '611011010100', '999999999999');

-- Dumping structure for table smartacc.ms_modul
CREATE TABLE IF NOT EXISTS `ms_modul` (
  `kode` int(10) NOT NULL DEFAULT 0,
  `nama` varchar(100) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `main_menu` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_modul: ~78 rows (approximately)
INSERT INTO `ms_modul` (`kode`, `nama`, `kel`, `main_menu`, `url`, `icon`) VALUES
	(100, 'KASBANK', NULL, 0, NULL, NULL),
	(110, 'KASBANK - MASTER', NULL, 100, NULL, NULL),
	(120, 'KASBANK - TRANSAKSI', NULL, 100, NULL, NULL),
	(121, 'KASBANK - TRANSAKSI - PENERIMAAN', NULL, 120, NULL, NULL),
	(122, 'KASBANK - TRANSAKSI - PENGELUARAN', NULL, 120, NULL, NULL),
	(123, 'KASBANK - TRANSAKSI - TRANSFER', NULL, 120, NULL, NULL),
	(130, 'KASBANK - LAPORAN', NULL, 100, NULL, NULL),
	(200, 'GL', NULL, 0, NULL, NULL),
	(210, 'GL - MASTER', NULL, 200, NULL, NULL),
	(211, 'GL - MASTER - AKUN', NULL, 210, NULL, NULL),
	(212, 'GL - MASTER - SALDO AWAL', NULL, 210, NULL, NULL),
	(220, 'GL - TRANSAKSI', NULL, 200, NULL, NULL),
	(221, 'GL - TRANSAKSI - ENTRI JURNAL', NULL, 220, NULL, NULL),
	(222, 'GL - TRANSAKSI - DAFTAR JURNAL', NULL, 220, NULL, NULL),
	(223, 'GL - TRANSAKSI - TUTUP BUKU', NULL, 220, NULL, NULL),
	(224, 'GL - TUTUP BUKU', NULL, NULL, NULL, NULL),
	(230, 'GL - LAPORAN', NULL, 200, NULL, NULL),
	(239, 'GL - IMPORT KODE AKUN', NULL, 200, NULL, NULL),
	(300, 'PEMBELIAN', NULL, 0, NULL, NULL),
	(310, 'PEMBELIAN - MASTER', NULL, 300, NULL, NULL),
	(311, 'PEMBELIAN - MASTER - SUPLIER', NULL, 310, NULL, NULL),
	(320, 'PEMBELIAN - TRANSAKSI', NULL, 300, NULL, NULL),
	(321, 'PEMBELIAN - TRANSAKSI - PESANAN PEMBELIAN', NULL, 320, NULL, NULL),
	(322, 'PEMBELIAN - TRANSAKSI - PENERIMAAN', NULL, 320, NULL, NULL),
	(323, 'PEMBELIAN - TRANSAKSI - FAKTUR', NULL, 320, NULL, NULL),
	(324, 'PEMBELIAN - TRANSAKSI - UANGMUKA', NULL, 320, NULL, NULL),
	(325, 'PEMBELIAN - TRANSAKSI - BAYAR', NULL, 320, NULL, NULL),
	(326, 'PEMBELIAN - TRANSAKSI - RETUR', NULL, 320, NULL, NULL),
	(330, 'PEMBELIAN - LAPORAN', NULL, 300, NULL, NULL),
	(400, 'PENJUALAN', NULL, 0, NULL, NULL),
	(410, 'PENJUALAN - MASTER - CUSTOMER', NULL, 400, NULL, NULL),
	(420, 'PENJUALAN - TRANSAKSI', NULL, 400, NULL, NULL),
	(421, 'PENJUALAN - TRANSAKSI - PESANAN', NULL, 420, NULL, NULL),
	(422, 'PENJUALAN - TRANSAKSI - PENGIRIMAN', NULL, 420, NULL, NULL),
	(423, 'PENJUALAN - TRANSAKSI - FAKTUR', NULL, 420, NULL, NULL),
	(424, 'PENJUALAN - TRANSAKSI - UANGMUKA', NULL, 420, NULL, NULL),
	(425, 'PENJUALAN - TRANSAKSI - BAYAR', NULL, 420, NULL, NULL),
	(426, 'PENJUALAN - TRANSAKSI - RETUR', NULL, 420, NULL, NULL),
	(430, 'PENJUALAN - LAPORAN', NULL, 400, NULL, NULL),
	(490, 'PENJUALAN - POS', NULL, 400, NULL, NULL),
	(500, 'INVENTORY', NULL, 0, NULL, NULL),
	(510, 'INVENTORY - MASTER', NULL, 500, NULL, NULL),
	(511, 'INVENTORY - MASTER - KATEGORI', NULL, 510, NULL, NULL),
	(512, 'INVENTORY - MASTER - SUB KATEGGORI', NULL, 510, NULL, NULL),
	(513, 'INVENTORY - MASTER - MERK', NULL, 510, NULL, NULL),
	(514, 'INVENTORY - MASTER - RAK', NULL, 510, NULL, NULL),
	(515, 'INVENTORY - MASTER - GUDANG', NULL, NULL, NULL, NULL),
	(516, 'INVENTORY - MASTER - SATUAN', NULL, NULL, NULL, NULL),
	(517, 'INVENTORY - MASTER - PROMO', NULL, NULL, NULL, NULL),
	(518, 'INVENTORY - MASTER - MUTASI SATUAN', NULL, NULL, NULL, NULL),
	(519, 'INVENTORY - MASTER - BARANG', NULL, NULL, NULL, NULL),
	(520, 'INVENTORY - TRANSAKSI', NULL, 500, NULL, NULL),
	(521, 'INVENTORY - TRANSAKSI - KONVERSI SATUAN', NULL, 520, NULL, NULL),
	(522, 'INVENTORY - TRANSAKSI - SETING HARGA JUAL MANUAL', NULL, 520, NULL, NULL),
	(523, 'INVENTORY - TRANSAKSI - SETING HARGA JUAL PROGRESIF', NULL, 520, NULL, NULL),
	(525, 'INVENTORY - STOK OPNAME', NULL, NULL, NULL, NULL),
	(526, 'INVENTORY - ADJUSMENT INVENTORY', NULL, NULL, NULL, NULL),
	(527, 'INVENTORY - MUTASI SATUAN', NULL, 500, NULL, NULL),
	(530, 'INVENTORY - LAPORAN', NULL, 500, NULL, NULL),
	(539, 'INVENTORY - IMPORT DATA BARANG', NULL, NULL, NULL, NULL),
	(600, 'AKTIVA TETAP', NULL, NULL, NULL, NULL),
	(611, 'AKTIVA TETAP - JENIS', NULL, NULL, NULL, NULL),
	(612, 'AKTIVA TETAP - DAFTAR AKTIVA TETAP', NULL, NULL, NULL, NULL),
	(630, 'AKTIVA TETAP - LAPORAN', NULL, NULL, NULL, NULL),
	(700, 'PAYROLL', NULL, NULL, NULL, NULL),
	(701, 'PEGAWAI', NULL, NULL, NULL, NULL),
	(702, 'JABATAN', NULL, NULL, NULL, NULL),
	(703, 'DEPARTEMEN', NULL, NULL, NULL, NULL),
	(704, 'PTKP', NULL, NULL, NULL, NULL),
	(709, 'GAJI KARYAWAN', NULL, NULL, NULL, NULL),
	(730, 'LAPORAN PAYROLL', NULL, NULL, NULL, NULL),
	(900, 'UTILITAS', NULL, 0, NULL, NULL),
	(901, 'UTILITAS - USER', NULL, 900, NULL, NULL),
	(902, 'UTITITAS - GRUP USER', NULL, 900, NULL, NULL),
	(903, 'UTILITAS - UNIT', NULL, 900, NULL, NULL),
	(904, 'UTILITAS - PARAMETER APP', NULL, 900, NULL, NULL),
	(905, 'UTILITAS - NOMOR URUT', NULL, 900, NULL, NULL),
	(906, 'UTILITAS - MATA UANG', NULL, NULL, NULL, NULL);

-- Dumping structure for table smartacc.ms_modul_grup
CREATE TABLE IF NOT EXISTS `ms_modul_grup` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `nmgrup` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_modul_grup: ~4 rows (approximately)
INSERT INTO `ms_modul_grup` (`nomor`, `nmgrup`) VALUES
	(1, 'ADMINISTRATOR'),
	(2, 'User'),
	(3, 'Supervisor'),
	(4, 'admin gudang');

-- Dumping structure for table smartacc.ms_modul_grupd
CREATE TABLE IF NOT EXISTS `ms_modul_grupd` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_grup` int(10) DEFAULT NULL,
  `nomor_modul` int(10) DEFAULT NULL,
  `uadd` char(1) DEFAULT '1',
  `uedit` char(1) DEFAULT '1',
  `udel` char(1) DEFAULT '1',
  `ucetak` char(1) DEFAULT '1',
  PRIMARY KEY (`nomor`),
  KEY `nomor_grup` (`nomor_grup`),
  KEY `nomor_modul` (`nomor_modul`),
  CONSTRAINT `FK_ms_modul_grupd_ms_modul` FOREIGN KEY (`nomor_modul`) REFERENCES `ms_modul` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ms_modul_grupd_ms_modul_grup` FOREIGN KEY (`nomor_grup`) REFERENCES `ms_modul_grup` (`nomor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_modul_grupd: ~122 rows (approximately)
INSERT INTO `ms_modul_grupd` (`nomor`, `nomor_grup`, `nomor_modul`, `uadd`, `uedit`, `udel`, `ucetak`) VALUES
	(1, 1, 100, '1', '1', '1', '1'),
	(2, 1, 110, '1', '1', '1', '1'),
	(5, 1, 120, '1', '1', '1', '1'),
	(6, 1, 121, '1', '1', '1', '1'),
	(7, 1, 122, '1', '1', '1', '1'),
	(8, 1, 123, '1', '1', '1', '1'),
	(9, 1, 130, '1', '1', '1', '1'),
	(10, 1, 200, '1', '1', '1', '1'),
	(11, 1, 210, '1', '1', '1', '1'),
	(12, 1, 211, '1', '1', '1', '1'),
	(13, 1, 212, '1', '1', '0', '1'),
	(15, 1, 220, '1', '1', '1', '1'),
	(16, 1, 221, '1', '1', '1', '1'),
	(17, 1, 222, '1', '1', '1', '1'),
	(18, 1, 223, '1', '1', '1', '1'),
	(19, 1, 224, '1', '1', '1', '1'),
	(20, 1, 230, '1', '1', '1', '1'),
	(21, 1, 300, '1', '1', '1', '1'),
	(22, 1, 310, '1', '1', '1', '1'),
	(23, 1, 311, '1', '1', '1', '1'),
	(24, 1, 320, '1', '1', '1', '1'),
	(25, 1, 321, '1', '1', '1', '1'),
	(26, 1, 322, '1', '1', '1', '1'),
	(27, 1, 323, '1', '1', '1', '1'),
	(28, 1, 324, '1', '1', '1', '1'),
	(29, 1, 325, '1', '1', '1', '1'),
	(30, 1, 326, '1', '1', '1', '1'),
	(31, 1, 330, '1', '1', '1', '1'),
	(32, 1, 400, '1', '1', '1', '1'),
	(33, 1, 410, '1', '1', '1', '1'),
	(34, 1, 420, '1', '1', '1', '1'),
	(35, 1, 421, '1', '1', '1', '1'),
	(36, 1, 422, '1', '1', '1', '1'),
	(37, 1, 423, '1', '1', '1', '1'),
	(38, 1, 424, '1', '1', '1', '1'),
	(39, 1, 425, '1', '1', '1', '1'),
	(40, 1, 426, '1', '1', '1', '1'),
	(41, 1, 430, '1', '1', '1', '1'),
	(42, 1, 490, '1', '1', '1', '1'),
	(43, 1, 500, '1', '1', '1', '1'),
	(44, 1, 510, '1', '1', '1', '1'),
	(45, 1, 511, '1', '1', '1', '1'),
	(46, 1, 512, '1', '1', '1', '1'),
	(47, 1, 513, '1', '1', '1', '1'),
	(48, 1, 514, '1', '1', '1', '1'),
	(49, 1, 515, '1', '1', '1', '1'),
	(50, 1, 516, '1', '1', '1', '1'),
	(51, 1, 517, '1', '1', '1', '1'),
	(52, 1, 518, '1', '1', '1', '1'),
	(53, 1, 519, '1', '1', '1', '1'),
	(54, 1, 520, '1', '1', '1', '1'),
	(55, 1, 521, '1', '1', '1', '1'),
	(56, 1, 522, '1', '1', '1', '1'),
	(57, 1, 523, '1', '1', '1', '1'),
	(58, 1, 525, '1', '1', '1', '1'),
	(59, 1, 526, '1', '1', '1', '1'),
	(60, 1, 527, '1', '1', '1', '1'),
	(61, 1, 530, '1', '1', '1', '1'),
	(71, 1, 900, '1', '1', '1', '1'),
	(72, 1, 901, '1', '1', '1', '1'),
	(73, 1, 902, '1', '1', '1', '1'),
	(74, 1, 903, '1', '1', '1', '1'),
	(75, 1, 904, '1', '1', '1', '1'),
	(76, 1, 905, '1', '1', '1', '1'),
	(77, 1, 539, '1', '1', '1', '1'),
	(78, 1, 700, '1', '1', '1', '1'),
	(79, 1, 701, '1', '1', '1', '1'),
	(80, 1, 702, '1', '1', '1', '1'),
	(81, 1, 703, '1', '1', '1', '1'),
	(82, 1, 704, '1', '1', '1', '1'),
	(83, 1, 709, '1', '1', '1', '1'),
	(84, 1, 730, '1', '1', '1', '1'),
	(85, 4, 322, '1', '1', '1', '1'),
	(86, 4, 326, '1', '1', '1', '1'),
	(87, 4, 421, '1', '1', '1', '1'),
	(88, 4, 422, '1', '1', '1', '1'),
	(89, 4, 423, '1', '1', '1', '1'),
	(90, 4, 424, '1', '1', '1', '1'),
	(91, 4, 425, '1', '1', '1', '1'),
	(92, 4, 426, '1', '1', '1', '1'),
	(93, 4, 430, '1', '1', '1', '1'),
	(94, 4, 510, '1', '1', '1', '1'),
	(95, 4, 511, '1', '1', '1', '1'),
	(96, 4, 512, '1', '1', '1', '1'),
	(97, 4, 513, '1', '1', '1', '1'),
	(98, 4, 516, '1', '1', '1', '1'),
	(99, 4, 518, '1', '1', '1', '1'),
	(100, 4, 519, '1', '1', '1', '1'),
	(101, 4, 521, '1', '1', '1', '1'),
	(102, 4, 522, '1', '1', '1', '1'),
	(103, 4, 523, '1', '1', '1', '1'),
	(104, 4, 525, '1', '1', '1', '1'),
	(105, 4, 526, '1', '1', '1', '1'),
	(106, 4, 527, '1', '1', '1', '1'),
	(107, 4, 322, '1', '1', '1', '1'),
	(108, 4, 326, '1', '1', '1', '1'),
	(109, 4, 421, '1', '1', '1', '1'),
	(110, 4, 422, '1', '1', '1', '1'),
	(111, 4, 423, '1', '1', '1', '1'),
	(112, 4, 424, '1', '1', '1', '1'),
	(113, 4, 425, '1', '1', '1', '1'),
	(114, 4, 426, '1', '1', '1', '1'),
	(115, 4, 430, '1', '1', '1', '1'),
	(116, 4, 510, '1', '1', '1', '1'),
	(117, 4, 511, '1', '1', '1', '1'),
	(118, 4, 512, '1', '1', '1', '1'),
	(119, 4, 513, '1', '1', '1', '1'),
	(120, 4, 516, '1', '1', '1', '1'),
	(121, 4, 518, '1', '1', '1', '1'),
	(122, 4, 519, '1', '1', '1', '1'),
	(123, 4, 521, '1', '1', '1', '1'),
	(124, 4, 522, '1', '1', '1', '1'),
	(125, 4, 523, '1', '1', '1', '1'),
	(126, 4, 525, '1', '1', '1', '1'),
	(127, 4, 526, '1', '1', '1', '1'),
	(128, 4, 527, '1', '1', '1', '1'),
	(129, 1, 239, '1', '1', '1', '1'),
	(130, 1, 600, '1', '1', '1', '1'),
	(132, 1, 612, '1', '1', '1', '1'),
	(133, 1, 630, '1', '1', '1', '1'),
	(134, 1, 611, '1', '1', '1', '1'),
	(135, 1, 906, '1', '1', '1', '1');

-- Dumping structure for table smartacc.ms_nobukti
CREATE TABLE IF NOT EXISTS `ms_nobukti` (
  `NOJURNAL` int(11) DEFAULT NULL,
  `NOPENERIMAAN` int(11) DEFAULT NULL,
  `NOPENERIMAANKAS` int(11) DEFAULT NULL,
  `NOPENGELUARANKAS` int(11) DEFAULT NULL,
  `NOJURNALPENERIMAAN` int(11) DEFAULT 0,
  `NOJURNALPENERIMAANKAS` int(11) DEFAULT 0,
  `NOJURNALPENGELUARANKAS` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_nobukti: ~1 rows (approximately)
INSERT INTO `ms_nobukti` (`NOJURNAL`, `NOPENERIMAAN`, `NOPENERIMAANKAS`, `NOPENGELUARANKAS`, `NOJURNALPENERIMAAN`, `NOJURNALPENERIMAANKAS`, `NOJURNALPENGELUARANKAS`) VALUES
	(1, 1, 1, 1, 1, 0, 7);

-- Dumping structure for table smartacc.ms_ptkp
CREATE TABLE IF NOT EXISTS `ms_ptkp` (
  `id_ptkp` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) NOT NULL,
  `kode` varchar(5) NOT NULL DEFAULT '',
  `ptkp` double DEFAULT NULL,
  PRIMARY KEY (`id_ptkp`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_ptkp: ~8 rows (approximately)
INSERT INTO `ms_ptkp` (`id_ptkp`, `tahun`, `kode`, `ptkp`) VALUES
	(1, '2021', 'K0', 4875000),
	(2, '2021', 'K1', 54000000),
	(3, '2021', 'K2', 5625000),
	(4, '2021', 'K3', 6000000),
	(5, '2021', 'T0', 4500000),
	(6, '2021', 'T1', 4875000),
	(7, '2021', 'T2', 5250000),
	(8, '2021', 'T3', 5625000);

-- Dumping structure for table smartacc.ms_unit
CREATE TABLE IF NOT EXISTS `ms_unit` (
  `kode` char(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pimpinan` varchar(100) DEFAULT NULL,
  `telpon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.ms_unit: ~2 rows (approximately)
INSERT INTO `ms_unit` (`kode`, `nama`, `alamat`, `pimpinan`, `telpon`) VALUES
	('01', 'Cabang 1', '', '', ''),
	('02', 'cabang 2', 'bandung', '', '');

-- Dumping structure for table smartacc.nomor_auto
CREATE TABLE IF NOT EXISTS `nomor_auto` (
  `id` int(10) NOT NULL DEFAULT 0,
  `nilai` int(10) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.nomor_auto: ~9 rows (approximately)
INSERT INTO `nomor_auto` (`id`, `nilai`, `tahun`, `bulan`, `ket`) VALUES
	(1, 201700662, NULL, NULL, 'jurnal umum'),
	(2, 201710221, NULL, NULL, 'penerimaan kas'),
	(3, 201711473, NULL, NULL, 'pengeluaran kas'),
	(4, NULL, NULL, NULL, 'pendapatan pasar'),
	(5, 201700005, NULL, NULL, 'transfer kas/bank'),
	(6, 201270008, NULL, NULL, 'penerimaan bank'),
	(7, 201720194, NULL, NULL, 'pengeluaran bank'),
	(8, NULL, NULL, NULL, 'biaya dibayar dimuka'),
	(9, NULL, NULL, NULL, 'repre');

-- Dumping structure for table smartacc.tr_atmutasi
CREATE TABLE IF NOT EXISTS `tr_atmutasi` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `kodeat` varchar(10) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `akun_kas` varchar(20) DEFAULT NULL,
  `akun_at` char(1) DEFAULT NULL,
  `no_jurnal` varchar(20) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_atmutasi: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_atposting
CREATE TABLE IF NOT EXISTS `tr_atposting` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `kodeat` varchar(10) DEFAULT NULL,
  `hargaperolehan` double DEFAULT NULL,
  `penambahan` double DEFAULT NULL,
  `akumulasipenyusutan` double DEFAULT NULL,
  `penyusutan` double DEFAULT NULL,
  `nilaibuku` double DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `userid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_atposting: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_atposting_log
CREATE TABLE IF NOT EXISTS `tr_atposting_log` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `jenis` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_atposting_log: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_jurnal
CREATE TABLE IF NOT EXISTS `tr_jurnal` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `noref` varchar(20) DEFAULT NULL,
  `novoucher` varchar(20) DEFAULT NULL,
  `nourut` int(11) DEFAULT NULL,
  `kodeakun` varchar(20) DEFAULT NULL,
  `debet` double(15,2) DEFAULT 0.00,
  `kredit` double(15,2) DEFAULT 0.00,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` char(2) DEFAULT NULL,
  `posted` char(1) DEFAULT 'T',
  `kodecbg` char(2) DEFAULT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `tglrekam` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `wbs` varchar(10) DEFAULT NULL,
  `useredit` varchar(20) DEFAULT NULL,
  `tgledit` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `statusid` int(11) DEFAULT 0,
  `ket` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`),
  KEY `kodeakun` (`kodeakun`),
  KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_jurnal: ~8 rows (approximately)
INSERT INTO `tr_jurnal` (`nomor`, `noref`, `novoucher`, `nourut`, `kodeakun`, `debet`, `kredit`, `keterangan`, `tanggal`, `jenis`, `posted`, `kodecbg`, `userid`, `tglrekam`, `wbs`, `useredit`, `tgledit`, `statusid`, `ket`) VALUES
	(1, 'PO.2024.09.00001', 'PB.2024.09.00001', 1, '110401', 0.00, 0.00, 'Penerimaan Barang', '2024-09-10', 'JP', 'T', '01', 'admin', '2024-09-10 15:30:23', '', NULL, '2024-09-10 10:30:23', 0, 'Penerimaan Barang'),
	(2, 'PO.2024.09.00001', 'PB.2024.09.00001', 2, '210203', 0.00, 0.00, 'Penerimaan Barang', '2024-09-10', 'JP', 'T', '01', 'admin', '2024-09-10 15:30:23', '', NULL, '2024-09-10 10:30:23', 0, 'Penerimaan Barang'),
	(5, 'PB.2024.09.00001', 'PU.2024.09.00001', 1, '210203', 4800000.00, 0.00, 'Faktur Pembelian', '2024-09-10', 'JP', 'T', '01', 'admin', '2024-09-10 15:54:24', '', NULL, '2024-09-10 10:54:24', 0, 'Faktur Pembelian'),
	(6, 'PB.2024.09.00001', 'PU.2024.09.00001', 2, '210101', 0.00, 4800000.00, 'Faktur Pembelian', '2024-09-10', 'JP', 'T', '01', 'admin', '2024-09-10 15:54:24', '', NULL, '2024-09-10 10:54:24', 0, 'Faktur Pembelian'),
	(11, 'SD.2024.09.00001', 'SI.2024.09.00001', 1, '110301', 6400000.00, 0.00, 'Penjualan', '2024-09-10', 'JJ', 'T', '01', 'admin', '2024-09-10 16:23:53', '', NULL, '2024-09-10 11:23:53', 0, 'Penjualan'),
	(12, 'SD.2024.09.00001', 'SI.2024.09.00001', 2, '400001', 0.00, 6400000.00, 'Penjualan', '2024-09-10', 'JJ', 'T', '01', 'admin', '2024-09-10 16:23:53', '', NULL, '2024-09-10 11:23:53', 0, 'Penjualan'),
	(13, 'SD.2024.09.00001', 'SI.2024.09.00001', 3, '5101', 3600000.00, 0.00, 'HPP Penjualan', '2024-09-10', 'JJ', 'T', '01', 'admin', '2024-09-10 16:23:53', '', NULL, '2024-09-10 11:23:53', 0, 'Penjualan'),
	(14, 'SD.2024.09.00001', 'SI.2024.09.00001', 4, '110401', 0.00, 3600000.00, 'HPP Penjualan', '2024-09-10', 'JJ', 'T', '01', 'admin', '2024-09-10 16:23:54', '', NULL, '2024-09-10 11:23:54', 0, 'Penjualan');

-- Dumping structure for table smartacc.tr_penerimaan
CREATE TABLE IF NOT EXISTS `tr_penerimaan` (
  `terima_register` int(11) NOT NULL AUTO_INCREMENT,
  `terima_nomor` varchar(20) NOT NULL,
  `terima_tanggal` date NOT NULL DEFAULT '0000-00-00',
  `terima_uraian` varchar(255) DEFAULT NULL,
  `terima_kasbank` varchar(20) DEFAULT NULL,
  `terima_userentry` varchar(12) DEFAULT NULL,
  `terima_posted` char(1) DEFAULT NULL,
  `terima_userposted` varchar(12) DEFAULT NULL,
  `terima_tanggalposted` date DEFAULT NULL,
  `terima_useredit` varchar(12) DEFAULT NULL,
  `terima_tanggaledit` date DEFAULT NULL,
  `terima_acc1` date DEFAULT NULL,
  `terima_acc2` date DEFAULT NULL,
  `terima_status` char(1) DEFAULT '1',
  `terima_acc1_user` varchar(20) DEFAULT NULL,
  `terima_acc2_user` varchar(20) DEFAULT NULL,
  `terima_penerima` varchar(20) DEFAULT NULL,
  `terima_penerima1` varchar(30) DEFAULT NULL,
  `terima_kodecbg` varchar(4) DEFAULT NULL,
  `terima_tglentry` timestamp NULL DEFAULT current_timestamp(),
  `terima_bidang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`terima_register`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_penerimaan: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_penerimaand
CREATE TABLE IF NOT EXISTS `tr_penerimaand` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `terimad_register` int(10) NOT NULL DEFAULT 0,
  `terimad_nomor` varchar(20) NOT NULL,
  `terimad_nourut` smallint(6) NOT NULL,
  `terimad_akun` varchar(20) DEFAULT NULL,
  `terimad_uraian` varchar(255) DEFAULT NULL,
  `terimad_jumlah` double DEFAULT 0,
  `terimad_nobdd` int(11) DEFAULT 0,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_penerimaand: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_pengeluaran
CREATE TABLE IF NOT EXISTS `tr_pengeluaran` (
  `keluar_register` int(11) NOT NULL AUTO_INCREMENT,
  `keluar_nomor` varchar(20) DEFAULT NULL,
  `keluar_tanggal` date DEFAULT '0000-00-00',
  `keluar_uraian` varchar(255) DEFAULT NULL,
  `keluar_kasbank` varchar(20) DEFAULT NULL,
  `keluar_userentry` varchar(12) DEFAULT NULL,
  `keluar_posted` char(1) DEFAULT NULL,
  `keluar_tanggalposted` date DEFAULT NULL,
  `keluar_userposted` varchar(12) DEFAULT NULL,
  `keluar_useredit` varchar(12) DEFAULT NULL,
  `keluar_tanggaledit` date DEFAULT NULL,
  `keluar_cekgironomor` varchar(20) DEFAULT NULL,
  `keluar_cekgirotanggal` date DEFAULT NULL,
  `keluar_cekgiro` char(1) DEFAULT NULL,
  `keluar_tglkwitansi` date DEFAULT NULL,
  `keluar_kodebank` char(3) DEFAULT NULL,
  `keluar_acc1` date DEFAULT NULL,
  `keluar_acc2` date DEFAULT NULL,
  `keluar_penerima` varchar(20) DEFAULT NULL,
  `keluar_kodecbg` varchar(4) DEFAULT NULL,
  `keluar_status` char(1) DEFAULT '1',
  `keluar_acc1_user` varchar(15) DEFAULT NULL,
  `keluar_acc2_user` varchar(15) DEFAULT NULL,
  `keluar_tglentry` timestamp NULL DEFAULT current_timestamp(),
  `keluar_bdd` int(11) DEFAULT NULL,
  `keluar_bidang` varchar(100) DEFAULT NULL,
  `keluar_nd` varchar(50) DEFAULT NULL,
  `tgl_pencairan` date DEFAULT NULL,
  PRIMARY KEY (`keluar_register`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_pengeluaran: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_pengeluarand
CREATE TABLE IF NOT EXISTS `tr_pengeluarand` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `keluard_register` int(11) NOT NULL,
  `keluard_nomor` varchar(20) NOT NULL,
  `keluard_nourut` smallint(6) NOT NULL,
  `keluard_akun` varchar(20) DEFAULT NULL,
  `keluard_uraian` varchar(255) DEFAULT NULL,
  `keluard_jumlah` double(15,2) DEFAULT NULL,
  `keluard_kodeab` varchar(20) DEFAULT NULL,
  `keluard_nobdd` int(11) DEFAULT 0,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_pengeluarand: ~0 rows (approximately)

-- Dumping structure for table smartacc.tr_transfer
CREATE TABLE IF NOT EXISTS `tr_transfer` (
  `nomor` varchar(20) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `bank_sumber` varchar(20) DEFAULT NULL,
  `bank_tujuan` varchar(20) DEFAULT NULL,
  `uraian` varchar(100) DEFAULT NULL,
  `jumlah` double DEFAULT 0,
  `userid` varchar(20) DEFAULT NULL,
  `status` char(1) DEFAULT '0',
  `cabang` varchar(5) DEFAULT '0',
  `bidang` varchar(50) DEFAULT '0',
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.tr_transfer: ~0 rows (approximately)

-- Dumping structure for table smartacc.userlogin
CREATE TABLE IF NOT EXISTS `userlogin` (
  `uidlogin` varchar(128) NOT NULL,
  `pwdlogin` varchar(128) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `insertdate` datetime DEFAULT NULL,
  `insertby` varchar(128) NOT NULL DEFAULT 'SYSTEM',
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(128) NOT NULL DEFAULT 'SYSTEM',
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `level` int(10) unsigned NOT NULL DEFAULT 99,
  `mobilephone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `descs` text DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'foto.jpg',
  `cabang` varchar(4) DEFAULT NULL,
  `pegawai_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`uidlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table smartacc.userlogin: ~1 rows (approximately)
INSERT INTO `userlogin` (`uidlogin`, `pwdlogin`, `username`, `insertdate`, `insertby`, `updatedate`, `updateby`, `locked`, `level`, `mobilephone`, `email`, `website`, `descs`, `avatar`, `cabang`, `pegawai_id`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 'SYSTEM', NULL, 'SYSTEM', 0, 1, NULL, NULL, NULL, NULL, 'foto.jpg', '01', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
