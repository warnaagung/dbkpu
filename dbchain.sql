-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.2.32-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk dbchain
CREATE DATABASE IF NOT EXISTS `dbchain` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbchain`;

-- membuang struktur untuk table dbchain.chain
CREATE TABLE IF NOT EXISTS `chain` (
  `id` varchar(20) NOT NULL,
  `previd` varchar(20) DEFAULT NULL,
  `prevhash` varchar(128) DEFAULT NULL,
  `nonce` int(11) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `idpengguna` varchar(15) DEFAULT NULL,
  `idtps` varchar(20) DEFAULT NULL,
  `hashnow` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.


-- Membuang struktur basisdata untuk dbmasuk
CREATE DATABASE IF NOT EXISTS `dbmasuk` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbmasuk`;

-- membuang struktur untuk table dbmasuk.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.calon
CREATE TABLE IF NOT EXISTS `calon` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `gambar` mediumblob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.desa
CREATE TABLE IF NOT EXISTS `desa` (
  `kode` varchar(8) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kodekec` varchar(6) DEFAULT NULL,
  `kodedes` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `FK_desa_kec` (`kodekec`),
  CONSTRAINT `FK_desa_kec` FOREIGN KEY (`kodekec`) REFERENCES `kec` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.formc1
CREATE TABLE IF NOT EXISTS `formc1` (
  `id` varchar(20) NOT NULL,
  `idpetugas` varchar(15) DEFAULT NULL,
  `pilih1` int(11) DEFAULT NULL,
  `pilih2` int(11) DEFAULT NULL,
  `tdksah` int(11) DEFAULT NULL,
  `hptlk` int(11) DEFAULT NULL,
  `hptpr` int(11) DEFAULT NULL,
  `hptblk` int(11) DEFAULT NULL,
  `hptbpr` int(11) DEFAULT NULL,
  `hpklk` int(11) DEFAULT NULL,
  `hpkpr` int(11) DEFAULT NULL,
  `hpdislk` int(11) DEFAULT NULL,
  `hpdispr` int(11) DEFAULT NULL,
  `suararusak` int(11) DEFAULT NULL,
  `dptlk` int(11) DEFAULT NULL,
  `dptpr` int(11) DEFAULT NULL,
  `dptblk` int(11) DEFAULT NULL,
  `dptbpr` int(11) DEFAULT NULL,
  `dpklk` int(11) DEFAULT NULL,
  `dpkpr` int(11) DEFAULT NULL,
  `dpdislk` int(11) DEFAULT abs(0),
  `dpdispr` int(11) DEFAULT abs(0),
  `suara` text DEFAULT NULL,
  `pathfile` varchar(1000) DEFAULT NULL,
  `tglupload` datetime DEFAULT current_timestamp(),
  `tglchain_go` datetime DEFAULT NULL,
  `tglchainend` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.kec
CREATE TABLE IF NOT EXISTS `kec` (
  `kode` varchar(6) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kodekec` varchar(2) DEFAULT NULL,
  `kodekota` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `FK_kec_kota` (`kodekota`),
  CONSTRAINT `FK_kec_kota` FOREIGN KEY (`kodekota`) REFERENCES `kota` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.kota
CREATE TABLE IF NOT EXISTS `kota` (
  `kode` varchar(4) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kodeprop` varchar(2) DEFAULT NULL,
  `kodekota` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `FK_kota_prop` (`kodeprop`),
  CONSTRAINT `FK_kota_prop` FOREIGN KEY (`kodeprop`) REFERENCES `prop` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `idpetugas` varchar(15) NOT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kodetps_sta` varchar(12) DEFAULT NULL,
  `kodetps` varchar(12) DEFAULT NULL,
  `kodebelakang` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`idpetugas`) USING BTREE,
  KEY `FK_pengguna_tps` (`kodetps`),
  CONSTRAINT `FK_pengguna_tps` FOREIGN KEY (`kodetps`) REFERENCES `tps` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.prop
CREATE TABLE IF NOT EXISTS `prop` (
  `kode` varchar(2) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.suara
CREATE TABLE IF NOT EXISTS `suara` (
  `id` int(11) DEFAULT NULL,
  `id_c1` int(11) DEFAULT NULL,
  `id_calon` varchar(10) DEFAULT NULL,
  `suara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table dbmasuk.tps
CREATE TABLE IF NOT EXISTS `tps` (
  `kode` varchar(12) NOT NULL,
  `namatps` varchar(20) NOT NULL,
  `rt` int(11) DEFAULT NULL,
  `rw` int(11) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kodetps` varchar(4) DEFAULT NULL,
  `kodedesa` varchar(8) DEFAULT NULL,
  `dummy_pil_joko` int(11) DEFAULT NULL,
  `dummy_pil_prab` int(11) DEFAULT NULL,
  `dummy_pil_tdksah` int(11) DEFAULT NULL,
  `dummy_hakdpt_lk` int(11) DEFAULT NULL,
  `dummy_hakdpt_pr` int(11) DEFAULT NULL,
  `dummy_hakdptb_lk` int(11) DEFAULT NULL,
  `dummy_hakdptb_pr` int(11) DEFAULT NULL,
  `dummy_hakdpk_lk` int(11) DEFAULT NULL,
  `dummy_hakdpk_pr` int(11) DEFAULT NULL,
  `dummy_disab_hak_lk` int(11) DEFAULT NULL,
  `dummy_disab_hak_pr` int(11) DEFAULT NULL,
  `dummy_suararusak` int(11) DEFAULT NULL,
  `dummy_pildpt_lk` int(11) DEFAULT NULL,
  `dummy_pildpt_pr` int(11) DEFAULT NULL,
  `dummy_pildptb_lk` int(11) DEFAULT NULL,
  `dummy_pildptb_pr` int(11) DEFAULT NULL,
  `dummy_pildpk_lk` int(11) NOT NULL,
  `dummy_pildpk_pr` int(11) DEFAULT NULL,
  `dummy_disab_data_lk` int(11) DEFAULT NULL,
  `dummy_disab_data_pr` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`) USING BTREE,
  KEY `FK_tps_desa` (`kodedesa`),
  CONSTRAINT `FK_tps_desa` FOREIGN KEY (`kodedesa`) REFERENCES `desa` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk trigger dbmasuk.desa_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `desa_before_insert` BEFORE INSERT ON `desa` FOR EACH ROW BEGIN
	SET NEW.kode = CONCAT(NEW.kodekec, NEW.kodedes);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.desa_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `desa_before_update` BEFORE UPDATE ON `desa` FOR EACH ROW BEGIN
	SET NEW.kode = CONCAT(NEW.kodekec, NEW.kodedes);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.kec_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `kec_before_insert` BEFORE INSERT ON `kec` FOR EACH ROW BEGIN
	SET NEW.kode = CONCAT(NEW.kodekota, NEW.kodekec);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.kec_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `kec_before_update` BEFORE UPDATE ON `kec` FOR EACH ROW BEGIN
	SET NEW.kode = CONCAT(NEW.kodekota, NEW.kodekec);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.kota_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `kota_before_insert` BEFORE INSERT ON `kota` FOR EACH ROW BEGIN
	SET NEW.kode = concat(new.kodeprop, new.kodekota);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.kota_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `kota_before_update` BEFORE UPDATE ON `kota` FOR EACH ROW BEGIN
	SET new.kode = CONCAT(new.kodeprop, new.kodekota);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.pengguna_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `pengguna_before_insert` BEFORE INSERT ON `pengguna` FOR EACH ROW BEGIN
	SET NEW.idpetugas = CONCAT(NEW.kodetps, NEW.kodebelakang);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.pengguna_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `pengguna_before_update` BEFORE UPDATE ON `pengguna` FOR EACH ROW BEGIN
	SET NEW.idpetugas = CONCAT(NEW.kodetps, NEW.kodebelakang);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.tps_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tps_before_insert` BEFORE INSERT ON `tps` FOR EACH ROW BEGIN
	SET NEW.kode = CONCAT(NEW.kodedesa, NEW.kodetps);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger dbmasuk.tps_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tps_before_update` BEFORE UPDATE ON `tps` FOR EACH ROW BEGIN
	SET NEW.kode = CONCAT(NEW.kodedesa, NEW.kodetps);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
