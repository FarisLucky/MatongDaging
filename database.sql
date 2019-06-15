-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2019 at 09:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tempatin`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `data_perusahaan_update` (IN `siupp` VARCHAR(255), IN `tdpp` VARCHAR(255), IN `namap` VARCHAR(255), IN `alamatp` VARCHAR(255), IN `emailp` VARCHAR(255), IN `telpp` VARCHAR(255), IN `logop` VARCHAR(255))  BEGIN
	DECLARE siup,tdp,nama,alamat,email,telp,logo varchar(255);
    SET siup = siupp;SET tdp = tdpp;SET nama = namap;SET alamat = alamatp;SET email = emailp;SET telp = telpp;SET logo = logop;
    INSERT INTO data_perusahaan VALUES(null,siup,tdp,nama,alamat,email,telp,logo,null);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getBayarUm` (IN `id` INT(11), IN `jenis` TINYINT(2))  BEGIN
	SELECT SUM(pembayaran_transaksi.jumlah_bayar) as ttl_bayar from pembayaran_transaksi WHERE pembayaran_transaksi.id_transaksi = id AND pembayaran_transaksi.id_jenis = jenis;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getHutangUm` (IN `id` INT(11), IN `jenis` TINYINT(2))  BEGIN
	SELECT SUM(hutang) as hutang from pembayaran_transaksi WHERE pembayaran_transaksi.id_transaksi = id AND pembayaran_transaksi.id_jenis = jenis;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getJumlahProperti` (IN `properti` INT(3), OUT `hasil` INT(3))  BEGIN
	SELECT jumlah_unit into hasil FROM properti WHERE id_properti = properti;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getJumlahUnit` (IN `properti` INT(3), OUT `jml_properti` INT(3))  BEGIN
	SELECT COUNT(id_properti) INTO jml_properti FROM unit_properti WHERE id_properti = properti;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user` (IN `nama` VARCHAR(100), IN `jk` ENUM('laki-laki','perempuan'), IN `alamat` TEXT, IN `telp` VARCHAR(15), IN `email` VARCHAR(100), IN `users` VARCHAR(255), IN `pass` VARCHAR(255), IN `akses` TINYINT(3), IN `foto` VARCHAR(255), IN `statuss` ENUM('aktif','nonaktif'))  BEGIN
	INSERT INTO user VALUES(null,nama,jk,alamat,email,telp,users,pass,akses,foto,CURRENT_DATE(),statuss);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blok`
--

CREATE TABLE `blok` (
  `id_blok` smallint(4) NOT NULL,
  `nama_blok` varchar(15) NOT NULL,
  `id_properti` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blok`
--

INSERT INTO `blok` (`id_blok`, `nama_blok`, `id_properti`) VALUES
(1, 'HI', 1),
(3, 'Hello', 1),
(9, 'asdsdd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_perusahaan`
--

CREATE TABLE `data_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `siup` varchar(50) NOT NULL,
  `tanda_daftar_perusahaan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `logo_perusahaan` varchar(255) NOT NULL,
  `file_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_perusahaan`
--

INSERT INTO `data_perusahaan` (`id_perusahaan`, `siup`, `tanda_daftar_perusahaan`, `nama`, `alamat`, `email`, `telepon`, `logo_perusahaan`, `file_profile`) VALUES
(1, 'Nomor. 511.3 / 437 / 411.306 / 2019', 'Nomor. 13.29.1.43.002726', 'PT. ABADI ANUGERAH ALAM SEJAHTERA', 'Jl. Dipoyono  Kabupaten Nganjuks', 'pt.abadianugerahalam@gmail.com', '0813901488896', 'f06ed9f7032267c401a3562592117469.png', 'd9aeafc4cf1eb738ceddd9a4bc901caa'),
(3, 'Nomor. 511.3 / 437 / 411.306 / 2016', 'Nomor. 13.29.1.43.00272', 'PT. ABADI ANUGERAH ALAMs', 'Jl. Dipoyono  Kabupaten Nganjuk', 'pt.abadianugerahalam@gmail.com', '081390148889', '10b18d3e21ee375f2e2e1929af685dc5.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_rab`
--

CREATE TABLE `detail_rab` (
  `id_detail` mediumint(9) NOT NULL,
  `nama_detail` varchar(255) NOT NULL,
  `id_rab` smallint(6) NOT NULL,
  `volume` float NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_kelompok` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_rab`
--

INSERT INTO `detail_rab` (`id_detail`, `nama_detail`, `id_rab`, `volume`, `satuan`, `harga_satuan`, `total_harga`, `id_kelompok`) VALUES
(1, 'Pembersihan Lapangan', 1, 124.2, 'M2', 3871, 0, 9),
(2, 'Pasangan Bouwplank / Pengukuran', 1, 26.4, 'M', 19470, 0, 9),
(3, 'Galian Tanah Pondasi', 2, 30, 'M2', 37812, 0, 8),
(4, 'Urugan Pasir Bawah Pondasi', 1, 4.844, 'M3', 129125, 0, 4),
(5, 'sdafasd', 1, 234, 'asdf', 23423423, 0, 9),
(8, 'asd', 1, 2, 'asdf2', 1231, 0, 5),
(9, 'sdafasd', 1, 30, 'asdf2', 3454, 0, 6),
(10, 'Tukang ', 4, 20, 'HOK', 70000, 1400000, 9),
(20, 'Peralatan Paku', 4, 5, 'm2', 20000, 100000, 9),
(30, 'hai', 5, 30, 'M2', 200000, 6000000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `penambahan` varchar(150) NOT NULL,
  `volume` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `penambahan`, `volume`, `satuan`, `harga`, `total_harga`, `id_transaksi`) VALUES
(10, 'tanah', 20, 'm2', 1200, 0, 4),
(11, 'tanah', 20, 'm2', 1200, 0, 5),
(16, 'tanah', 24, 'm2', 1200, 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `follow_calon_konsumen`
--

CREATE TABLE `follow_calon_konsumen` (
  `id_follow` int(11) NOT NULL,
  `id_konsumen` mediumint(9) NOT NULL,
  `tgl_follow` date NOT NULL,
  `media` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `hasil_follow` varchar(20) NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis` tinyint(2) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis`, `jenis_pembayaran`) VALUES
(1, 'Tanda Jadi'),
(2, 'Uang Muka'),
(3, 'Transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kelompok`
--

CREATE TABLE `kategori_kelompok` (
  `id_kategori` tinyint(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_kelompok`
--

INSERT INTO `kategori_kelompok` (`id_kategori`, `nama_kategori`) VALUES
(1, 'RAB BANGUNAN'),
(2, 'Pemasukan'),
(3, 'Pengeluaran'),
(4, 'RAB PERUMAHAN');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_item`
--

CREATE TABLE `kelompok_item` (
  `id_kelompok` smallint(5) NOT NULL,
  `nama_kelompok` varchar(50) NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `id_kategori` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_item`
--

INSERT INTO `kelompok_item` (`id_kelompok`, `nama_kelompok`, `id_user`, `id_kategori`) VALUES
(1, 'biaya rumah', 1, 3),
(2, 'biaya tukang', 1, 3),
(3, 'PEKERJAAN PESIAPAN', 1, 1),
(4, 'PEKERJAAN PONDASI', 1, 1),
(5, 'PEK. BETON BERTULANG Ad. 1:2:3', 1, 1),
(6, 'PEK. DINDING DAN PLESTERAN', 1, 1),
(7, 'PEKERJAAN ATAP', 1, 1),
(8, 'PEKERJAAN LANTAI', 1, 1),
(9, 'PEKERJAAN SUMUR', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kerja_sama_bank`
--

CREATE TABLE `kerja_sama_bank` (
  `id_bank` tinyint(3) NOT NULL,
  `no_perusahaan` varchar(25) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `alamat_bank` text NOT NULL,
  `telp_bank` varchar(25) NOT NULL,
  `email_bank` varchar(50) NOT NULL,
  `foto_bank` varchar(255) NOT NULL,
  `nama_direktur` varchar(100) NOT NULL,
  `no_telp_direktur` int(25) NOT NULL,
  `email_direktur` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` mediumint(9) NOT NULL,
  `id_type` tinyint(2) NOT NULL,
  `id_card` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `alamat_kantor` text,
  `telp_kantor` varchar(35) DEFAULT NULL,
  `status_konsumen` enum('calon konsumen','konsumen') NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `tgl_buat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `id_type`, `id_card`, `nama_lengkap`, `alamat`, `telp`, `email`, `foto_ktp`, `npwp`, `pekerjaan`, `alamat_kantor`, `telp_kantor`, `status_konsumen`, `id_user`, `tgl_buat`) VALUES
(1, 2, '35181402098800099', 'Lampi Pijar', 'Jl. Riau No.10-A, Krajan Barat, Sumbersari, Kabupaten Jember, Jawa Timur 68121', '082997387997', 'percobaan@gmail.com', 'ceaeb8dd60ef69d9b8851850ee568506.jpg', '97897987', 'Guru', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', NULL, 'konsumen', 15, '2019-04-11 14:38:48'),
(2, 2, '35181402098800099', 'Pias Pijar', 'Jl. Riau No.10-A, Krajan Barat, Sumbersari, Kabupaten Jember, Jawa Timur 68121', '081988468997', 'percobaanlagi@gmail.com', 'a5b95d19bfdcb1e2390c1b97acccec1dsfsd', NULL, NULL, NULL, NULL, 'calon konsumen', 3, '2019-04-11 14:38:48'),
(4, 2, '35181402098800099', 'Roni', 'Jl. Riau No.10-A, Krajan Barat, Sumbersari, Kabupaten Jember, Jawa Timur 68121', '081988468932', 'percobaanlagiin@gmail.com', 'a35756f29757ee9fd6965839de73b6ab.png', '435345', 'Petani', 'asdasd', NULL, 'calon konsumen', 15, '2019-04-11 14:38:48'),
(5, 2, '35181402098800099', 'Ronis', 'Jl. Riau No.10-A, Krajan Barat, Sumbersari, Kabupaten Jember, Jawa Timur 68121', '081988468939', 'percobaanlagii@gmail.com', '5e31edeba7884319fff2bee7ebcbb273.png', '435345', 'Petani', '       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '435345', 'konsumen', 15, '2019-04-11 14:38:48'),
(7, 2, '23213', 'Sulaiman', 'asd', '23433', 'asdas@gmail.com', '6b7288d44a5d944d5fffbc1d4732746d.png', '9789798748', 'Guru', '  sdas', '0839176868', 'calon konsumen', 15, '2019-05-29 22:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pengeluaran` mediumint(9) NOT NULL,
  `nama_pengeluaran` text NOT NULL,
  `volume` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `tgl_buat` date NOT NULL,
  `bukti_kwitansi` varchar(255) DEFAULT NULL,
  `id_user` tinyint(4) NOT NULL,
  `id_properti` smallint(6) NOT NULL,
  `id_kelompok` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_transaksi`
--

CREATE TABLE `pembayaran_transaksi` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `nama_pembayaran` varchar(255) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `hutang` int(11) NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` enum('belum bayar','pending','selesai') NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `id_jenis` tinyint(2) NOT NULL,
  `id_type_bayar` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran_transaksi`
--

INSERT INTO `pembayaran_transaksi` (`id_pembayaran`, `id_transaksi`, `nama_pembayaran`, `total_tagihan`, `tgl_jatuh_tempo`, `tgl_bayar`, `jumlah_bayar`, `hutang`, `bukti_bayar`, `status`, `id_user`, `id_jenis`, `id_type_bayar`) VALUES
(126, 10, 'Angsuran 1', 10000000, '2019-05-15', '2019-05-11', 10000000, 0, 'f48067386590373670c03ba0cb24bfee.png', 'selesai', 15, 2, NULL),
(127, 10, 'Angsuran 2', 10000000, '2019-05-15', '2019-05-10', 10000000, 0, '2e0b0166f0563e085083e0048e834737.png', 'pending', 15, 2, NULL),
(128, 10, 'Angsuran 3', 10000000, '2019-05-15', '2019-05-14', 0, 10000000, '', 'belum bayar', 15, 2, NULL),
(129, 10, 'Tanda Jadi Unit SF01', 5000, '2019-05-09', '2019-05-08', 5, 5000, 'a66f60949898abfa0de62d54c4443f31.png', 'belum bayar', 15, 1, NULL),
(130, 10, 'Tunai ', 250000000, '2019-05-16', '2019-05-14', 0, 250000000, '', 'belum bayar', 15, 3, 2),
(131, 11, 'Angsuran 1', 10000000, '2019-05-20', '2019-05-14', 10000000, 0, '', 'belum bayar', 15, 2, NULL),
(132, 11, 'Angsuran 2', 10000000, '2019-05-20', '2019-05-14', 10000000, 0, '', 'belum bayar', 15, 2, NULL),
(133, 11, 'Angsuran 3', 10000000, '2019-05-20', '2019-05-14', 10000000, 0, '', 'belum bayar', 15, 2, NULL),
(134, 11, 'Tanda Jadi Unit SF02', 5000000, '2019-05-19', '2019-06-21', 5000000, 0, 'e6b7232844a76500c0c90dc103aa8588.png', 'selesai', 15, 1, NULL),
(135, 11, 'Tunai ', 435000000, '2019-05-21', '2019-05-14', 435000000, 0, 'sanfklkj', 'belum bayar', 15, 3, 2),
(146, 0, 'Cicilan 1', 83000000, '2019-06-30', NULL, NULL, 83000000, NULL, 'belum bayar', 15, 3, 3),
(147, 0, 'Cicilan 2', 83000000, '2019-07-31', NULL, NULL, 83000000, NULL, 'belum bayar', 15, 3, 3),
(148, 0, 'Cicilan 3', 83000000, '2019-08-31', NULL, NULL, 83000000, NULL, 'belum bayar', 15, 3, 3),
(149, 0, 'Cicilan 4', 83000000, '2019-09-30', NULL, NULL, 83000000, NULL, 'belum bayar', 15, 3, 3),
(150, 0, 'Cicilan 5', 83000000, '2019-10-31', NULL, NULL, 83000000, NULL, 'belum bayar', 15, 3, 3),
(151, 0, 'Cicilan 6', 83000000, '2019-11-30', NULL, NULL, 83000000, NULL, 'belum bayar', 15, 3, 3),
(159, 15, 'Angsuran 1', 1, '2019-06-22', NULL, NULL, 1, NULL, 'belum bayar', 15, 2, NULL),
(160, 15, 'Angsuran 2', 1, '2019-07-22', NULL, NULL, 1, NULL, 'belum bayar', 15, 2, NULL),
(161, 15, 'Tanda Jadi Unit perumahan tegal', 2000, '2019-05-17', NULL, NULL, 2000, NULL, 'belum bayar', 15, 1, NULL),
(162, 15, 'Cicilan 1', 248999997, '2019-06-23', NULL, NULL, 248999997, NULL, 'belum bayar', 15, 3, 3),
(163, 15, 'Cicilan 2', 248999997, '2019-07-23', NULL, NULL, 248999997, NULL, 'belum bayar', 15, 3, 3),
(180, 16, 'Angsuran 1', 50000000, '2019-06-01', NULL, NULL, 50000000, NULL, 'belum bayar', 15, 2, NULL),
(181, 16, 'Angsuran 2', 50000000, '2019-07-01', NULL, NULL, 50000000, NULL, 'belum bayar', 15, 2, NULL),
(182, 16, 'Tanda Jadi Unit 312', 2000, '2019-05-09', NULL, NULL, 2000, NULL, 'belum bayar', 15, 1, NULL),
(183, 16, 'Cicilan 1', 175500000, '2019-06-13', NULL, NULL, 175500000, NULL, 'belum bayar', 15, 3, 3),
(184, 16, 'Cicilan 2', 175500000, '2019-07-13', NULL, NULL, 175500000, NULL, 'belum bayar', 15, 3, 3),
(190, 17, 'Angsuran 1', 10000000, '2019-06-14', '2019-06-05', 10000000, 0, '410561dba4ec7d5699cbf76c78dcb405.jpg', 'selesai', 15, 2, NULL),
(191, 17, 'Tanda Jadi Unit perumahan tegal', 5000000, '2019-05-15', '2019-05-15', 5000000, 5000000, '65bd9c072790102389156bcf98a66485.png', 'selesai', 15, 1, NULL),
(192, 17, 'Cicilan 1', 227500000, '2019-06-07', NULL, NULL, 227500000, NULL, 'belum bayar', 15, 3, 3),
(193, 17, 'Cicilan 2', 227500000, '2019-07-07', NULL, NULL, 227500000, NULL, 'belum bayar', 15, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` mediumint(9) NOT NULL,
  `nama_pengeluaran` varchar(255) NOT NULL,
  `volume` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `bukti_kwitansi` varchar(255) DEFAULT NULL,
  `id_user` tinyint(4) NOT NULL,
  `id_properti` smallint(6) NOT NULL,
  `id_kelompok` smallint(5) NOT NULL,
  `created_at` date NOT NULL,
  `status_manager` enum('pending','selesai') NOT NULL,
  `update_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `nama_pengeluaran`, `volume`, `satuan`, `harga_satuan`, `total_harga`, `bukti_kwitansi`, `id_user`, `id_properti`, `id_kelompok`, `created_at`, `status_manager`, `update_by`) VALUES
(1, 'Bon tukang rumah\r\n', 1, 'orang', 3500000, 3500000, NULL, 3, 1, 2, '2019-04-12', 'pending', 0),
(2, 'paku usuk', 1, 'kg', 13000, 13000, NULL, 3, 1, 1, '2019-04-12', 'selesai', 19);

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_kategori`
--

CREATE TABLE `persyaratan_kategori` (
  `id_kategori` tinyint(3) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persyaratan_kategori`
--

INSERT INTO `persyaratan_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'konsumen'),
(2, 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_kelompok_sasaran`
--

CREATE TABLE `persyaratan_kelompok_sasaran` (
  `id_persyaratan` int(11) NOT NULL,
  `id_sasaran` tinyint(3) NOT NULL,
  `id_konsumen` mediumint(9) NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persyaratan_kelompok_sasaran`
--

INSERT INTO `persyaratan_kelompok_sasaran` (`id_persyaratan`, `id_sasaran`, `id_konsumen`, `id_user`) VALUES
(1, 1, 2, 4),
(17, 1, 5, 15),
(18, 2, 5, 15),
(19, 4, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_sasaran`
--

CREATE TABLE `persyaratan_sasaran` (
  `id_sasaran` tinyint(3) NOT NULL,
  `nama_persyaratan` text NOT NULL,
  `poin_penting` varchar(5) NOT NULL,
  `keterangan` text NOT NULL,
  `id_kategori_persyaratan` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persyaratan_sasaran`
--

INSERT INTO `persyaratan_sasaran` (`id_sasaran`, `nama_persyaratan`, `poin_penting`, `keterangan`, `id_kategori_persyaratan`) VALUES
(1, 'Kartu Tanda Penduduk', '', 'Wajib di isi', 0),
(2, 'Kartu Keluarga', '', 'Wajib di isi', 0),
(3, 'Akta Nikah', '', 'Wajib di isi', 0),
(4, 'Tidak Memiliki rumah', '*', 'dikecualikan untuk PNS / TNI yang pindah domisili karena kepentingan dinas  dan berlaku hany sekali', 0),
(5, 'Nomor Pokok Wajib Pajak(NPWP)', '**', 'Berstatus kawin hanya dipersyaratkan suami/istri', 0),
(6, 'SPT Tahunan Pph Orang Pribadi sesuai peraturan perundang - undangan', '***', 'dikecualikan untuk penghasilan dibawah PTKP', 0),
(7, 'Penghasilan tidak melebihi batas penghasilan yang ditentukan ', '**', 'berstatus kawin hanya dipersyaratkan suami/istri', 0);

-- --------------------------------------------------------

--
-- Table structure for table `properti`
--

CREATE TABLE `properti` (
  `id_properti` smallint(6) NOT NULL,
  `nama_properti` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `luas_tanah` varchar(50) NOT NULL,
  `jumlah_unit` int(11) NOT NULL,
  `rekening` varchar(50) NOT NULL,
  `logo_properti` varchar(255) DEFAULT NULL,
  `foto_properti` varchar(255) DEFAULT NULL,
  `tgl_buat` date NOT NULL,
  `status` enum('publish','non-publish') DEFAULT NULL,
  `setting_spr` text,
  `id_user` tinyint(4) NOT NULL,
  `id_rab` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properti`
--

INSERT INTO `properti` (`id_properti`, `nama_properti`, `alamat`, `luas_tanah`, `jumlah_unit`, `rekening`, `logo_properti`, `foto_properti`, `tgl_buat`, `status`, `setting_spr`, `id_user`, `id_rab`) VALUES
(1, 'PERUMAHAN SUFAH PERMAI', 'Lokasi di Guyangan bagor Nganjuk - Lingkungan asri dan sejuk - 5 menit ke terminal - 5 menit ke pom bensin - 10 menit ke pusat kota dan stasiun - dekat dengan minimarket dan pasar - dekat dengan jalan raya surabaya - madiun', '1.965 m2', 6, 'BCA MAndiri 878455', 'afd2dd7c8232279c3b4d22ef2eb8b068.png', '21bba11673944884ca888cc69df249ed.jpg', '2019-05-03', 'publish', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, NULL),
(9, 'PERUMAHAN GELORA HENING', 'Jl. A Yani No. 2A, Jl. Letjend S. Parman, Blimbing, Kota Malang, Jawa Timur 65125', '34', 20, 'BCA 23342 Salman Al Farisi', '38a483b687aba2afbd9b20e6467fde24.png', '88466ae1d27d9e707d4d33ceeba68a57.png', '2019-05-15', 'publish', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, NULL),
(11, 'sdf', 'asfd', 'sfd1', 1, 'dsaf', '', '008868cf22d64a0dbd9fde200ceea43a.jpg', '2019-05-03', 'publish', 'sdafasdf', 0, NULL),
(12, 'Perumahan coba', 'Perumahan coba', '65 m2', 12, 'rekening', 'e1d56f41635edb0c78e7651d67f74296.png', 'ed6531c1ddfc54c4d212e9d5b4f6d238.png', '2019-05-08', 'publish', 'Perumahan coba', 0, NULL),
(13, 'PERUMAHAN SUFAH PERMAIS', 'nganjuk', '20', 22, '849203', '9e0d35d59ae42e8471ef57f3faf1398e.png', '583fd1ae705758151d0bc684403c65c9.png', '2019-05-29', 'publish', 'surat', 0, NULL),
(14, 'Perumahan permai', 'Lumajang', '10', 12, 'BCA 23342 Cobain Terserah', '6f2ba2014f04f9be08d30f96bfefc5cc.jpg', '5b1455b45dbd10dc0a2663209b7e63a6.png', '2019-06-13', 'publish', 'surat', 0, NULL),
(15, 'perumahan tegal gede', 'jember', '36', 2, '423423424', '4fd1bfa8e555d7a9806fbd56998e0cdf.jpg', 'e4d7756b4e42c5bfaa3351c9158f0969.jpg', '2019-05-29', 'publish', 'surat', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rab_properti`
--

CREATE TABLE `rab_properti` (
  `id_rab` smallint(6) NOT NULL,
  `nama_rab` varchar(50) NOT NULL,
  `type` enum('properti','unit') NOT NULL,
  `tgl_buat` date NOT NULL,
  `total_anggaran` int(11) NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `id_properti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rab_properti`
--

INSERT INTO `rab_properti` (`id_rab`, `nama_rab`, `type`, `tgl_buat`, `total_anggaran`, `id_user`, `id_properti`) VALUES
(1, 'SUFAH PERMAI', 'properti', '2019-04-11', 200000000, 1, 1),
(2, 'Rumah Sufah Permai', 'unit', '2019-04-11', 57600000, 1, 1),
(4, 'Perumahan Coba', 'properti', '2019-05-26', 1500000, 14, 12),
(5, 'RAB RUmah (Perumahan Coba)', 'unit', '2019-05-26', 6060000, 14, 12),
(6, 'RAB RUmah (Perumahan Coba)', 'properti', '2019-05-29', 0, 14, 13),
(7, 'kamprte', 'properti', '2019-05-29', 0, 14, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rekening_properti`
--

CREATE TABLE `rekening_properti` (
  `id_rekening` tinyint(2) NOT NULL,
  `no_rekening` varchar(15) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening_properti`
--

INSERT INTO `rekening_properti` (`id_rekening`, `no_rekening`, `bank`, `pemilik`, `deskripsi`) VALUES
(1, '6860148755.', 'BRI', 'Nama Pemilik', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

-- --------------------------------------------------------

--
-- Table structure for table `surat_akta_rumah`
--

CREATE TABLE `surat_akta_rumah` (
  `id_akta` tinyint(2) NOT NULL,
  `nama_akta` varchar(25) NOT NULL,
  `isi_akta` text NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_berita_acara`
--

CREATE TABLE `surat_berita_acara` (
  `id_berita_acara` smallint(6) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_surat` tinyint(4) NOT NULL,
  `tgl_buat` date NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_konsumen`
--

CREATE TABLE `surat_konsumen` (
  `id_surat_konsumen` int(11) NOT NULL,
  `id_surat` tinyint(3) NOT NULL,
  `isi_surat` int(11) NOT NULL,
  `id_konsumen` mediumint(9) NOT NULL,
  `tambahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_perumahan`
--

CREATE TABLE `surat_perumahan` (
  `id_surat_perumahan` tinyint(2) NOT NULL,
  `id_surat` tinyint(3) NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `tgl_buat` date NOT NULL,
  `id_properti` smallint(6) NOT NULL,
  `tambahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_surat`
--

CREATE TABLE `surat_surat` (
  `id_surat` tinyint(3) NOT NULL,
  `nama_surat` varchar(100) NOT NULL,
  `sifat` varchar(25) NOT NULL,
  `hal` varchar(255) NOT NULL,
  `isi_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_follow`
-- (See below for the actual view)
--
CREATE TABLE `tbl_follow` (
`id_follow` int(11)
,`id_konsumen` mediumint(9)
,`tgl_follow` date
,`media` varchar(50)
,`keterangan` text
,`hasil_follow` varchar(20)
,`id_user` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_kelompok_item`
-- (See below for the actual view)
--
CREATE TABLE `tbl_kelompok_item` (
`id_kelompok` smallint(5)
,`nama_kelompok` varchar(50)
,`id_user` tinyint(4)
,`id_kategori` tinyint(2)
,`kategori_pengeluaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_konsumen`
-- (See below for the actual view)
--
CREATE TABLE `tbl_konsumen` (
`id_konsumen` mediumint(9)
,`id_type` tinyint(2)
,`nama_type` varchar(50)
,`id_card` varchar(20)
,`nama_konsumen` varchar(50)
,`alamat` text
,`telp` varchar(15)
,`email` varchar(25)
,`foto_ktp` varchar(255)
,`npwp` varchar(30)
,`pekerjaan` varchar(50)
,`alamat_kantor` text
,`telp_kantor` varchar(35)
,`status_konsumen` enum('calon konsumen','konsumen')
,`id_user` tinyint(4)
,`nama_pembuat` varchar(100)
,`tgl_buat` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `tbl_pembayaran` (
`id_pembayaran` int(11)
,`id_transaksi` int(11)
,`id_properti` smallint(6)
,`nama_properti` varchar(150)
,`nama_unit` varchar(15)
,`nama_pembayaran` varchar(255)
,`total_tagihan` int(11)
,`tgl_jatuh_tempo` date
,`tgl_bayar` date
,`jumlah_bayar` int(11)
,`hutang` int(11)
,`bukti_bayar` varchar(255)
,`status` enum('belum bayar','pending','selesai')
,`id_user` tinyint(4)
,`pembuat` varchar(100)
,`id_jenis` tinyint(2)
,`jenis_pembayaran` varchar(255)
,`id_type_bayar` tinyint(2)
,`type_bayar` varchar(25)
,`nama_lengkap` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_pengeluaran`
-- (See below for the actual view)
--
CREATE TABLE `tbl_pengeluaran` (
`id_pengeluaran` mediumint(9)
,`nama_pengeluaran` varchar(255)
,`volume` int(11)
,`satuan` varchar(50)
,`harga_satuan` int(11)
,`total_harga` int(11)
,`bukti_kwitansi` varchar(255)
,`id_user` tinyint(4)
,`nama_lengkap` varchar(100)
,`id_properti` smallint(6)
,`nama_properti` varchar(150)
,`id_kelompok` smallint(5)
,`nama_kelompok` varchar(50)
,`created_at` date
,`status_manager` enum('pending','selesai')
,`update_by` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_profil`
-- (See below for the actual view)
--
CREATE TABLE `tbl_profil` (
`id_perusahaan` int(11)
,`siup` varchar(50)
,`tanda_daftar_perusahaan` varchar(50)
,`nama` varchar(50)
,`alamat` varchar(255)
,`email` varchar(50)
,`telepon` varchar(15)
,`logo_perusahaan` varchar(255)
,`file_profile` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_properti`
-- (See below for the actual view)
--
CREATE TABLE `tbl_properti` (
`id_properti` smallint(6)
,`nama_properti` varchar(150)
,`alamat` text
,`luas_tanah` varchar(50)
,`jumlah_unit` int(11)
,`rekening` varchar(50)
,`logo_properti` varchar(255)
,`foto_properti` varchar(255)
,`tgl_buat` date
,`status` enum('publish','non-publish')
,`id_user` tinyint(4)
,`setting_spr` text
,`id_rab` smallint(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_rab`
-- (See below for the actual view)
--
CREATE TABLE `tbl_rab` (
`id_detail` mediumint(9)
,`nama_detail` varchar(255)
,`id_rab` smallint(6)
,`volume` float
,`satuan` varchar(25)
,`harga_satuan` int(11)
,`total_harga` int(11)
,`id_kelompok` smallint(5)
,`kelompok_pengeluaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_role_menu`
-- (See below for the actual view)
--
CREATE TABLE `tbl_role_menu` (
`id_menu_role` tinyint(3)
,`id_menu` tinyint(2)
,`menu` varchar(50)
,`url` varchar(25)
,`icon` varchar(100)
,`javascript` varchar(50)
,`id_akses` tinyint(3)
,`akses` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `tbl_transaksi` (
`id_transaksi` int(11)
,`no_ppjb` varchar(25)
,`id_konsumen` mediumint(9)
,`nama_lengkap` varchar(50)
,`id_unit` mediumint(9)
,`nama_unit` varchar(15)
,`id_properti` smallint(6)
,`nama_properti` varchar(150)
,`tgl_transaksi` date
,`total_transaksi` int(11)
,`tanda_jadi` int(11)
,`periode_uang_muka` int(4)
,`id_type_bayar` tinyint(2)
,`type_pembayaran` varchar(25)
,`kunci` enum('default','lock','unlock')
,`id_user` tinyint(4)
,`nama_pembuat` varchar(100)
,`status_transaksi` enum('sementara','pending','progress','selesai','lunas')
,`status_um` enum('progress','selesai')
,`status_cicilan` enum('progress','selesai')
,`tempo_tanda_jadi` date
,`tempo_uang_muka` date
,`tempo_bayar` date
,`total_kesepakatan` int(11)
,`bayar_periode` tinyint(2)
,`pembayaran` int(11)
,`total_tambahan` int(11)
,`total_akhir` int(11)
,`uang_muka` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_type_bayar`
-- (See below for the actual view)
--
CREATE TABLE `tbl_type_bayar` (
`id_type_bayar` tinyint(2)
,`type_bayar` varchar(25)
,`id_jenis` tinyint(2)
,`jenis_pembayaran` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_unit_properti`
-- (See below for the actual view)
--
CREATE TABLE `tbl_unit_properti` (
`id_unit` mediumint(9)
,`nama_unit` varchar(15)
,`id_properti` smallint(6)
,`nama_properti` varchar(150)
,`type` varchar(15)
,`luas_tanah` varchar(15)
,`luas_bangunan` varchar(15)
,`harga_unit` int(11)
,`foto_unit` varchar(255)
,`alamat_unit` text
,`tgl_insert` date
,`status_unit` enum('sudah terjual','booking','belum terjual')
,`id_user` tinyint(4)
,`nama_lengkap` varchar(100)
,`deskripsi` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_users`
-- (See below for the actual view)
--
CREATE TABLE `tbl_users` (
`id_user` tinyint(4)
,`nama_lengkap` varchar(100)
,`jenis_kelamin` enum('laki-laki','perempuan')
,`alamat` text
,`Email` varchar(100)
,`no_hp` varchar(15)
,`username` varchar(255)
,`password` varchar(255)
,`id_akses` tinyint(3)
,`foto_user` varchar(255)
,`tanggal_buat` date
,`status_user` enum('aktif','nonaktif')
,`akses` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_user_assign_properti`
-- (See below for the actual view)
--
CREATE TABLE `tbl_user_assign_properti` (
`id_assign` mediumint(9)
,`id_properti` smallint(6)
,`nama_properti` varchar(150)
,`foto_properti` varchar(255)
,`alamat` text
,`id_user` tinyint(4)
,`nama_lengkap` varchar(100)
,`akses` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_unit`
--

CREATE TABLE `transaksi_unit` (
  `id_transaksi` int(11) NOT NULL,
  `no_ppjb` varchar(25) NOT NULL,
  `id_konsumen` mediumint(9) NOT NULL,
  `id_unit` mediumint(9) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_kesepakatan` int(11) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `tanda_jadi` int(11) NOT NULL,
  `uang_muka` int(11) NOT NULL,
  `periode_uang_muka` int(4) NOT NULL,
  `id_type_bayar` tinyint(2) NOT NULL,
  `bayar_periode` tinyint(2) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kunci` enum('default','lock','unlock') NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `status_transaksi` enum('sementara','pending','progress','selesai','lunas') NOT NULL,
  `status_um` enum('progress','selesai') NOT NULL,
  `status_cicilan` enum('progress','selesai') NOT NULL,
  `tempo_tanda_jadi` date NOT NULL,
  `tempo_uang_muka` date NOT NULL,
  `tempo_bayar` date NOT NULL,
  `total_tambahan` int(11) NOT NULL,
  `total_akhir` int(11) NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_unit`
--

INSERT INTO `transaksi_unit` (`id_transaksi`, `no_ppjb`, `id_konsumen`, `id_unit`, `tgl_transaksi`, `total_kesepakatan`, `total_transaksi`, `tanda_jadi`, `uang_muka`, `periode_uang_muka`, `id_type_bayar`, `bayar_periode`, `pembayaran`, `kunci`, `id_user`, `status_transaksi`, `status_um`, `status_cicilan`, `tempo_tanda_jadi`, `tempo_uang_muka`, `tempo_bayar`, `total_tambahan`, `total_akhir`, `update_at`) VALUES
(10, '200927-38974-56', 1, 2, '2019-05-14', 500000000, 501200000, 5000000, 30000000, 3, 2, 1, 127, 'lock', 15, 'progress', 'progress', 'progress', '2019-05-09', '2019-05-15', '2019-05-16', 1200000, 436200000, '0000-00-00'),
(11, '200927-38974-76', 1, 3, '2019-05-14', 500000000, 500000000, 5000000, 30000000, 3, 2, 1, 435000000, 'lock', 15, 'progress', 'progress', 'progress', '2019-05-19', '2019-05-20', '2019-05-21', 0, 435000000, '0000-00-00'),
(15, '200927-38974-23', 1, 7, '2019-05-29', 500000000, 500000000, 2000000, 2, 2, 3, 2, 248999997, 'default', 15, 'sementara', 'progress', 'progress', '2019-05-17', '2019-05-22', '2019-05-23', 0, 497999995, '0000-00-00'),
(16, '200927-38974-23', 2, 6, '2019-05-29', 500000000, 503000000, 2000000, 100000000, 2, 3, 2, 175500000, 'default', 15, 'sementara', 'progress', 'progress', '2019-05-09', '2019-05-01', '2019-05-13', 3000000, 351000000, '0000-00-00'),
(17, '200927-38974-76', 7, 7, '2019-05-29', 500000000, 500000000, 5000000, 10000000, 1, 3, 2, 227500000, 'unlock', 15, 'progress', 'selesai', 'progress', '2019-05-15', '2019-05-14', '2019-05-07', 0, 465000000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `type_bayar`
--

CREATE TABLE `type_bayar` (
  `id_type_bayar` tinyint(2) NOT NULL,
  `type_bayar` varchar(25) NOT NULL,
  `id_jenis` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_bayar`
--

INSERT INTO `type_bayar` (`id_type_bayar`, `type_bayar`, `id_jenis`) VALUES
(1, 'cicilan', 3),
(2, 'tunai', 3),
(3, 'kpr', 3);

-- --------------------------------------------------------

--
-- Table structure for table `type_id_card`
--

CREATE TABLE `type_id_card` (
  `id_type` tinyint(2) NOT NULL,
  `nama_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_id_card`
--

INSERT INTO `type_id_card` (`id_type`, `nama_type`) VALUES
(1, 'KTP'),
(2, 'SIM');

-- --------------------------------------------------------

--
-- Table structure for table `unit_properti`
--

CREATE TABLE `unit_properti` (
  `id_unit` mediumint(9) NOT NULL,
  `nama_unit` varchar(15) NOT NULL,
  `id_properti` smallint(6) NOT NULL,
  `type` varchar(15) NOT NULL,
  `luas_tanah` varchar(15) NOT NULL,
  `luas_bangunan` varchar(15) NOT NULL,
  `harga_unit` int(11) NOT NULL,
  `foto_unit` varchar(255) NOT NULL,
  `alamat_unit` text NOT NULL,
  `tgl_insert` date NOT NULL,
  `status_unit` enum('sudah terjual','booking','belum terjual') NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_properti`
--

INSERT INTO `unit_properti` (`id_unit`, `nama_unit`, `id_properti`, `type`, `luas_tanah`, `luas_bangunan`, `harga_unit`, `foto_unit`, `alamat_unit`, `tgl_insert`, `status_unit`, `id_user`, `deskripsi`) VALUES
(2, 'SF01', 1, '36/60', '36', '60', 500000000, 'de7340c4c6faab83542b00b5dcfd2110.png', 'Lokasi proyek cukup strategis di bandingkan dengan proyek-proyek perumahan lain di sekitarnya karena posisinya hanya _+ 100m dari jalan raya propinsi dan berdekatan dengan pabrik , klinik kesehatan, pasar hewan, terminal bus, kantor pemerintahan, bank, minimarket, dealer motor, area terminal truk, sarana pendidikan.', '2019-04-10', 'sudah terjual', 14, 'Pondasi \r\nBatu kali\r\nDinding\r\nBatu bata merah di plester\r\nAtap\r\nBaja ringan \r\nPlafon\r\nEnternit\r\nLantai\r\nKramik\r\nKusain\r\nKayu\r\nPintu\r\nKayu\r\nJendela\r\nKayu dan kaca\r\nSanitasi\r\nClosed jongkok, bak mandi \r\nAir bersih\r\nPDAM \r\nListrik \r\n900 watt'),
(3, 'SF02', 1, '36/60', '36', '60', 130000000, 'cf51fef7bb3a3bfdfd4b2e768fbba0b9.png', 'Lokasi proyek cukup strategis di bandingkan dengan proyek-proyek perumahan lain di sekitarnya karena posisinya hanya _+ 100m dari jalan raya propinsi dan berdekatan dengan pabrik , klinik kesehatan, pasar hewan, terminal bus, kantor pemerintahan, bank, minimarket, dealer motor, area terminal truk, sarana pendidikan.', '2019-04-10', 'booking', 14, 'Pondasi \r\nBatu kali\r\nDinding\r\nBatu bata merah di plester\r\nAtap\r\nBaja ringan \r\nPlafon\r\nEnternit\r\nLantai\r\nKramik\r\nKusain\r\nKayu\r\nPintu\r\nKayu\r\nJendela\r\nKayu dan kaca\r\nSanitasi\r\nClosed jongkok, bak mandi \r\nAir bersih\r\nPDAM \r\nListrik \r\n900 watt'),
(5, 'A21', 1, '36/34', '32 M2', '32', 500000000, '6c75c9c80b2334e85bcc733034c60667.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '0000-00-00', 'belum terjual', 19, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(6, '312', 1, '312', '312', '312', 500000000, 'b89ddd7227c93dfd50ac070423ef6024.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, ad. Accusantium, inventore. Earum repellat numquam cupiditate, ad, nostrum commodi minima itaque magni iure nobis fuga accusamus molestias eligendi minus est.', '2019-05-08', 'belum terjual', 14, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, ad. Accusantium, inventore. Earum repellat numquam cupiditate, ad, nostrum commodi minima itaque magni iure nobis fuga accusamus molestias eligendi minus est.'),
(7, 'perumahan tegal', 1, '36x60', '34', '56', 450000, '0502e66814d972d2f2c8cf7368bb76c6.jpg', 'lumajang', '2019-05-29', 'belum terjual', 19, 'perumahan'),
(9, 'perumahan', 15, '36/34', '45', '34', 210000, 'b4c1940d866b3079fd5211fede59c4e4.png', 'jember', '2019-05-29', 'belum terjual', 19, 'ada kamar mandi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(4) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `Email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_akses` tinyint(3) NOT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  `tanggal_buat` date NOT NULL,
  `status_user` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `Email`, `no_hp`, `username`, `password`, `id_akses`, `foto_user`, `tanggal_buat`, `status_user`) VALUES
(3, 'Mika Tambayong', 'perempuan', 'Jl. Jawa No.74, Gumuk Kerang, Sumbersari, Kabupaten Jember, Jawa Timur 68121', 'mikarid1@gmail.com', '089775338764', 'mikain', 'password123s', 3, 'foto211', '2019-04-12', 'nonaktif'),
(14, 'Salman Al Farisi', 'laki-laki', 'Jl.Pakuniran hehe', 'farisdev@gmail.com', '082334676890', 'Salman', '$2y$10$uvAUUpZ6F5A4wavpyMvBXenOLZnemCig8uCR1vo.CC3JES7xqDHf.', 1, '', '2019-05-04', 'aktif'),
(15, 'Marketing', 'laki-laki', 'sd', 'fasss@gmail.com', '085344873008', 'Marketing', '$2y$10$TZJzVZme756tsRk3whlohOtjshh8sPVfSphXLGSlHKPtOBs8qo5NC', 4, '5b42cb47c2b1ee3cde6f2c314af06431.png', '2019-05-06', 'aktif'),
(16, 'terserah', 'laki-laki', 'terserah', 'farisdevs@gmail.com', '0876752323', 'terserah', '$2y$10$YSuAJWcBX5NNmwegyjviJelyPO/dMn1.yNRO295CO1g5uEQiJoTA2', 5, '380f714943698ce55dcb378e4f5148b4.png', '2019-05-08', 'aktif'),
(19, 'elsa manora', 'perempuan', 'jember', 'elsa@gmail.com', '0876544567890', 'elsa', '$2y$10$68a.jkptklAX5HT35d5SsurawAbA3lxBD.X9L87g5/p3AjUH/VVI2', 2, 'f0f03c08e781828fe15d13f2c01e0d13.png', '2019-05-29', 'aktif'),
(20, 'Bendahara', 'perempuan', 'Jl Pakuniran', 'bendahara@gmail.com', '082334678997', 'bendahara', '$2y$10$ee7rSHX4Mpqg8.yQ4vD/6u47QQYbhOmOw0lhp1kUDpR.7Dr3uYwqm', 5, '9268ded5e1507a0a9c06b53d3c014fe9.jpg', '2019-06-07', 'aktif'),
(21, 'sekretaris', 'perempuan', 'slafjldskf', 'sekretaris@gmail.com', '082213034543', 'sekretaris', '$2y$10$12tMASJqt/OoMZd.KtnMt.ZMbUhU/bAXqP6wNAu2T6/SI0mhS09wS', 3, '7edea68ba17267c9b56179bc61f95f25.png', '2019-06-13', 'nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id_activity` int(11) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_assign_properti`
--

CREATE TABLE `user_assign_properti` (
  `id_assign` mediumint(9) NOT NULL,
  `id_properti` smallint(6) NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_assign_properti`
--

INSERT INTO `user_assign_properti` (`id_assign`, `id_properti`, `id_user`) VALUES
(1, 1, 2),
(2, 1, 1),
(8, 1, 4),
(30, 9, 12),
(31, 1, 14),
(36, 1, 15),
(38, 1, 3),
(39, 9, 3),
(40, 1, 16),
(41, 9, 16),
(42, 12, 16),
(44, 9, 18),
(48, 1, 19),
(49, 14, 19),
(50, 15, 19),
(51, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user_controller`
--

CREATE TABLE `user_controller` (
  `id` smallint(6) NOT NULL,
  `id_akses` smallint(6) DEFAULT NULL,
  `controller` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_controller`
--

INSERT INTO `user_controller` (`id`, `id_akses`, `controller`) VALUES
(1, 1, 'profilperusahaan'),
(2, 1, 'kelolausers'),
(3, 1, 'properti'),
(4, 1, 'rab'),
(5, 1, 'approve'),
(6, 1, 'laporankonsumen'),
(7, 1, 'laporanunit'),
(8, 1, 'kartukontrol'),
(9, 1, 'laporantransaksi'),
(10, 2, 'unitproperti'),
(11, 2, 'laporankonsumen'),
(12, 2, 'laporantransaksi'),
(13, 2, 'approvelist'),
(14, 3, 'laporanunit'),
(15, 4, 'transaksi'),
(16, 4, 'konsumen'),
(17, 4, 'laporanunit'),
(18, 4, 'laporankonsumen'),
(19, 5, 'pembayaran'),
(20, 5, 'item'),
(21, 5, 'pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` tinyint(2) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `url` varchar(25) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `javascript` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`, `url`, `icon`, `javascript`) VALUES
(1, 'Dashboard', 'dashboard/owner', 'menu-icon mdi mdi-television', 'dashboard'),
(2, 'Setting Data Master', '#setting', 'menu-icon mdi mdi-briefcase-check', NULL),
(4, 'Data Master', '#master', 'menu-icon mdi mdi-briefcase-check', NULL),
(5, 'Transaksi', 'transaksi', 'menu-icon mdi mdi-cart-outline', 'custom_transaksi'),
(6, 'Pembayaran', '#pembayaran', 'menu-icon mdi mdi-briefcase-check', NULL),
(7, 'Approve', '#approve', 'menu-icon mdi mdi-television', NULL),
(8, 'Data Konsumen', '#konsumen', 'menu-icon mdi mdi-account-switch', NULL),
(9, 'Master Item', '#item', 'menu-icon mdi mdi-dns', NULL),
(10, 'Dashboard', 'dashboard/marketing', 'menu-icon mdi mdi-television', 'dashboard'),
(11, 'Dashboard', 'dashboard/manager', 'menu-icon mdi mdi-television', 'dashboard'),
(12, 'Dashboard', 'dashboard/sekretaris', 'menu-icon mdi mdi-television', 'dashboard'),
(13, 'Laporan', '#laporan', 'menu-icon mdi mdi-chart-areaspline', NULL),
(14, 'Dashboard', 'dashboard/bendahara', 'menu-icon mdi mdi-television', 'dashboard'),
(15, 'Laporan Konsumen', '#laporan_kons', 'menu-icon mdi mdi-chart-areaspline', NULL),
(16, 'Data Master', '#master_item', 'menu-icon mdi mdi-briefcase-check', NULL),
(17, 'Laporan Properti', '#laporan_kontrol', 'menu-icon mdi mdi-briefcase-check', NULL),
(18, 'Laporan Transaksi', '#laporan_transaksi', 'menu-icon mdi mdi-briefcase-check', NULL),
(19, 'Approve', '#approve_list', 'menu-icon mdi mdi-briefcase-check', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_akses` tinyint(3) NOT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_akses`, `akses`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'Sekretaris'),
(4, 'marketing'),
(5, 'Bendahara');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_menu`
--

CREATE TABLE `user_role_menu` (
  `id_menu_role` tinyint(3) NOT NULL,
  `id_menu` tinyint(2) NOT NULL,
  `id_akses` tinyint(3) NOT NULL,
  `id_sub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role_menu`
--

INSERT INTO `user_role_menu` (`id_menu_role`, `id_menu`, `id_akses`, `id_sub`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 3),
(5, 11, 2, 4),
(6, 4, 2, NULL),
(7, 10, 4, NULL),
(8, 5, 4, NULL),
(10, 7, 1, NULL),
(11, 8, 4, NULL),
(13, 14, 5, NULL),
(14, 9, 5, NULL),
(16, 6, 5, NULL),
(17, 13, 4, NULL),
(18, 15, 1, NULL),
(19, 16, 5, NULL),
(20, 17, 1, NULL),
(21, 18, 1, NULL),
(22, 19, 2, NULL),
(23, 15, 2, NULL),
(24, 18, 2, NULL),
(25, 13, 3, NULL),
(26, 2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub` tinyint(3) NOT NULL,
  `nama_sub` varchar(50) NOT NULL,
  `sub_url` varchar(50) NOT NULL,
  `javascript` varchar(50) NOT NULL,
  `id_menu` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub`, `nama_sub`, `sub_url`, `javascript`, `id_menu`) VALUES
(2, 'Profil Perusahaan', 'profilperusahaan', 'custom_js', 2),
(4, 'Kelola User', 'kelolausers', 'custom_user', 2),
(5, 'Properti', 'properti', 'custom_properti', 2),
(6, 'Unit Properti', 'unitproperti', 'custom_unit', 4),
(7, 'Tanda Jadi', 'pembayaran/tandajadi', 'custom_pembayaran', 6),
(8, 'Uang Muka', 'pembayaran/uangmuka', 'custom_pembayaran', 6),
(9, 'Cicilan', 'pembayaran/cicilan', 'custom_pembayaran', 6),
(10, 'Approve Pembayaran', 'approve/kwitansi', 'custom_approve', 7),
(12, 'Approve Final ', 'approve/penjualan', 'custom_approve', 7),
(13, 'Calon Konsumen', 'konsumen/calonkonsumen', 'custom_konsumen', 8),
(14, 'Konsumen', 'konsumen/datakonsumen', 'custom_konsumen', 8),
(15, 'Kelompok Item', 'item', '', 9),
(16, '', '', 'custom_rab', 2),
(17, 'List Unit', 'laporanunit', 'custom_laporan', 13),
(18, 'List Konsumen', 'laporankonsumen/konsumen', 'custom_laporan', 15),
(19, 'List Calon Konsumen', 'laporankonsumen/calon', 'custom_laporan', 15),
(20, 'Pengeluaran', 'pengeluaran', 'custom_pengeluaran', 16),
(21, 'Kartu Kontrol', 'kartukontrol', 'custom_laporan', 17),
(22, 'Transaksi Unit', 'laporantransaksi', 'custom_laporan', 18),
(23, 'Transaksi', 'approvelist/transaksi', 'custom_approve', 19),
(24, 'List Unit', 'laporanunit', 'custom_laporan', 17);

-- --------------------------------------------------------

--
-- Structure for view `tbl_follow`
--
DROP TABLE IF EXISTS `tbl_follow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_follow`  AS  select `follow_calon_konsumen`.`id_follow` AS `id_follow`,`follow_calon_konsumen`.`id_konsumen` AS `id_konsumen`,`follow_calon_konsumen`.`tgl_follow` AS `tgl_follow`,`follow_calon_konsumen`.`media` AS `media`,`follow_calon_konsumen`.`keterangan` AS `keterangan`,`follow_calon_konsumen`.`hasil_follow` AS `hasil_follow`,`users`.`id_user` AS `id_user` from ((`follow_calon_konsumen` join `tbl_konsumen` on((`tbl_konsumen`.`id_konsumen` = `follow_calon_konsumen`.`id_konsumen`))) join `user` `users` on((`users`.`id_user` = `follow_calon_konsumen`.`id_konsumen`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_kelompok_item`
--
DROP TABLE IF EXISTS `tbl_kelompok_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_kelompok_item`  AS  select `kelompok_item`.`id_kelompok` AS `id_kelompok`,`kelompok_item`.`nama_kelompok` AS `nama_kelompok`,`kelompok_item`.`id_user` AS `id_user`,`cat`.`id_kategori` AS `id_kategori`,`cat`.`nama_kategori` AS `kategori_pengeluaran` from (`kelompok_item` join `kategori_kelompok` `cat` on((`cat`.`id_kategori` = `kelompok_item`.`id_kategori`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_konsumen`
--
DROP TABLE IF EXISTS `tbl_konsumen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_konsumen`  AS  select `konsumen`.`id_konsumen` AS `id_konsumen`,`konsumen`.`id_type` AS `id_type`,`type`.`nama_type` AS `nama_type`,`konsumen`.`id_card` AS `id_card`,`konsumen`.`nama_lengkap` AS `nama_konsumen`,`konsumen`.`alamat` AS `alamat`,`konsumen`.`telp` AS `telp`,`konsumen`.`email` AS `email`,`konsumen`.`foto_ktp` AS `foto_ktp`,`konsumen`.`npwp` AS `npwp`,`konsumen`.`pekerjaan` AS `pekerjaan`,`konsumen`.`alamat_kantor` AS `alamat_kantor`,`konsumen`.`telp_kantor` AS `telp_kantor`,`konsumen`.`status_konsumen` AS `status_konsumen`,`konsumen`.`id_user` AS `id_user`,`users`.`nama_lengkap` AS `nama_pembuat`,`konsumen`.`tgl_buat` AS `tgl_buat` from ((`konsumen` join `type_id_card` `type` on((`type`.`id_type` = `konsumen`.`id_type`))) join `user` `users` on((`users`.`id_user` = `konsumen`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_pembayaran`
--
DROP TABLE IF EXISTS `tbl_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pembayaran`  AS  select `pembayaran_transaksi`.`id_pembayaran` AS `id_pembayaran`,`pembayaran_transaksi`.`id_transaksi` AS `id_transaksi`,`tbl_transaksi`.`id_properti` AS `id_properti`,`tbl_transaksi`.`nama_properti` AS `nama_properti`,`tbl_transaksi`.`nama_unit` AS `nama_unit`,`pembayaran_transaksi`.`nama_pembayaran` AS `nama_pembayaran`,`pembayaran_transaksi`.`total_tagihan` AS `total_tagihan`,`pembayaran_transaksi`.`tgl_jatuh_tempo` AS `tgl_jatuh_tempo`,`pembayaran_transaksi`.`tgl_bayar` AS `tgl_bayar`,`pembayaran_transaksi`.`jumlah_bayar` AS `jumlah_bayar`,`pembayaran_transaksi`.`hutang` AS `hutang`,`pembayaran_transaksi`.`bukti_bayar` AS `bukti_bayar`,`pembayaran_transaksi`.`status` AS `status`,`pembayaran_transaksi`.`id_user` AS `id_user`,`us`.`nama_lengkap` AS `pembuat`,`pembayaran_transaksi`.`id_jenis` AS `id_jenis`,`jenis_pembayaran`.`jenis_pembayaran` AS `jenis_pembayaran`,`pembayaran_transaksi`.`id_type_bayar` AS `id_type_bayar`,`type_bayar`.`type_bayar` AS `type_bayar`,`tbl_transaksi`.`nama_lengkap` AS `nama_lengkap` from ((((`pembayaran_transaksi` join `tbl_transaksi` on((`tbl_transaksi`.`id_transaksi` = `pembayaran_transaksi`.`id_transaksi`))) left join `type_bayar` on((`type_bayar`.`id_type_bayar` = `pembayaran_transaksi`.`id_type_bayar`))) join `jenis_pembayaran` on((`jenis_pembayaran`.`id_jenis` = `pembayaran_transaksi`.`id_jenis`))) join `user` `us` on((`pembayaran_transaksi`.`id_user` = `us`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_pengeluaran`
--
DROP TABLE IF EXISTS `tbl_pengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pengeluaran`  AS  select `pengeluaran`.`id_pengeluaran` AS `id_pengeluaran`,`pengeluaran`.`nama_pengeluaran` AS `nama_pengeluaran`,`pengeluaran`.`volume` AS `volume`,`pengeluaran`.`satuan` AS `satuan`,`pengeluaran`.`harga_satuan` AS `harga_satuan`,`pengeluaran`.`total_harga` AS `total_harga`,`pengeluaran`.`bukti_kwitansi` AS `bukti_kwitansi`,`user`.`id_user` AS `id_user`,`user`.`nama_lengkap` AS `nama_lengkap`,`pengeluaran`.`id_properti` AS `id_properti`,`properti`.`nama_properti` AS `nama_properti`,`pengeluaran`.`id_kelompok` AS `id_kelompok`,`kelompok_item`.`nama_kelompok` AS `nama_kelompok`,`pengeluaran`.`created_at` AS `created_at`,`pengeluaran`.`status_manager` AS `status_manager`,`pengeluaran`.`update_by` AS `update_by` from (((`pengeluaran` join `user` on((`user`.`id_user` = `pengeluaran`.`id_user`))) join `properti` on((`properti`.`id_properti` = `pengeluaran`.`id_properti`))) join `kelompok_item` on((`kelompok_item`.`id_kelompok` = `pengeluaran`.`id_kelompok`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_profil`
--
DROP TABLE IF EXISTS `tbl_profil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_profil`  AS  select `data_perusahaan`.`id_perusahaan` AS `id_perusahaan`,`data_perusahaan`.`siup` AS `siup`,`data_perusahaan`.`tanda_daftar_perusahaan` AS `tanda_daftar_perusahaan`,`data_perusahaan`.`nama` AS `nama`,`data_perusahaan`.`alamat` AS `alamat`,`data_perusahaan`.`email` AS `email`,`data_perusahaan`.`telepon` AS `telepon`,`data_perusahaan`.`logo_perusahaan` AS `logo_perusahaan`,`data_perusahaan`.`file_profile` AS `file_profile` from `data_perusahaan` ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_properti`
--
DROP TABLE IF EXISTS `tbl_properti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_properti`  AS  select `properti`.`id_properti` AS `id_properti`,`properti`.`nama_properti` AS `nama_properti`,`properti`.`alamat` AS `alamat`,`properti`.`luas_tanah` AS `luas_tanah`,`properti`.`jumlah_unit` AS `jumlah_unit`,`properti`.`rekening` AS `rekening`,`properti`.`logo_properti` AS `logo_properti`,`properti`.`foto_properti` AS `foto_properti`,`properti`.`tgl_buat` AS `tgl_buat`,`properti`.`status` AS `status`,`properti`.`id_user` AS `id_user`,`properti`.`setting_spr` AS `setting_spr`,`properti`.`id_rab` AS `id_rab` from `properti` ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_rab`
--
DROP TABLE IF EXISTS `tbl_rab`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_rab`  AS  select `detail_rab`.`id_detail` AS `id_detail`,`detail_rab`.`nama_detail` AS `nama_detail`,`detail_rab`.`id_rab` AS `id_rab`,`detail_rab`.`volume` AS `volume`,`detail_rab`.`satuan` AS `satuan`,`detail_rab`.`harga_satuan` AS `harga_satuan`,`detail_rab`.`total_harga` AS `total_harga`,`ki`.`id_kelompok` AS `id_kelompok`,`ki`.`nama_kelompok` AS `kelompok_pengeluaran` from ((`detail_rab` join `rab_properti` `rap` on((`rap`.`id_rab` = `detail_rab`.`id_rab`))) join `kelompok_item` `ki` on((`ki`.`id_kelompok` = `detail_rab`.`id_kelompok`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_role_menu`
--
DROP TABLE IF EXISTS `tbl_role_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_role_menu`  AS  select `user_role_menu`.`id_menu_role` AS `id_menu_role`,`user_menu`.`id_menu` AS `id_menu`,`user_menu`.`menu` AS `menu`,`user_menu`.`url` AS `url`,`user_menu`.`icon` AS `icon`,`user_menu`.`javascript` AS `javascript`,`user_role`.`id_akses` AS `id_akses`,`user_role`.`akses` AS `akses` from ((`user_role_menu` join `user_menu` on((`user_menu`.`id_menu` = `user_role_menu`.`id_menu`))) join `user_role` on((`user_role`.`id_akses` = `user_role_menu`.`id_akses`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_transaksi`
--
DROP TABLE IF EXISTS `tbl_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_transaksi`  AS  select `transaksi_unit`.`id_transaksi` AS `id_transaksi`,`transaksi_unit`.`no_ppjb` AS `no_ppjb`,`transaksi_unit`.`id_konsumen` AS `id_konsumen`,`konsumen`.`nama_lengkap` AS `nama_lengkap`,`transaksi_unit`.`id_unit` AS `id_unit`,`tbl_unit_properti`.`nama_unit` AS `nama_unit`,`tbl_unit_properti`.`id_properti` AS `id_properti`,`tbl_unit_properti`.`nama_properti` AS `nama_properti`,`transaksi_unit`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi_unit`.`total_transaksi` AS `total_transaksi`,`transaksi_unit`.`tanda_jadi` AS `tanda_jadi`,`transaksi_unit`.`periode_uang_muka` AS `periode_uang_muka`,`type_bayar`.`id_type_bayar` AS `id_type_bayar`,`type_bayar`.`type_bayar` AS `type_pembayaran`,`transaksi_unit`.`kunci` AS `kunci`,`transaksi_unit`.`id_user` AS `id_user`,`users`.`nama_lengkap` AS `nama_pembuat`,`transaksi_unit`.`status_transaksi` AS `status_transaksi`,`transaksi_unit`.`status_um` AS `status_um`,`transaksi_unit`.`status_cicilan` AS `status_cicilan`,`transaksi_unit`.`tempo_tanda_jadi` AS `tempo_tanda_jadi`,`transaksi_unit`.`tempo_uang_muka` AS `tempo_uang_muka`,`transaksi_unit`.`tempo_bayar` AS `tempo_bayar`,`transaksi_unit`.`total_kesepakatan` AS `total_kesepakatan`,`transaksi_unit`.`bayar_periode` AS `bayar_periode`,`transaksi_unit`.`pembayaran` AS `pembayaran`,`transaksi_unit`.`total_tambahan` AS `total_tambahan`,`transaksi_unit`.`total_akhir` AS `total_akhir`,`transaksi_unit`.`uang_muka` AS `uang_muka` from ((((`transaksi_unit` join `konsumen` on((`konsumen`.`id_konsumen` = `transaksi_unit`.`id_konsumen`))) join `tbl_unit_properti` on((`tbl_unit_properti`.`id_unit` = `transaksi_unit`.`id_unit`))) join `user` `users` on((`users`.`id_user` = `transaksi_unit`.`id_user`))) join `type_bayar` on((`type_bayar`.`id_type_bayar` = `transaksi_unit`.`id_type_bayar`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_type_bayar`
--
DROP TABLE IF EXISTS `tbl_type_bayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_type_bayar`  AS  select `tb`.`id_type_bayar` AS `id_type_bayar`,`tb`.`type_bayar` AS `type_bayar`,`tb`.`id_jenis` AS `id_jenis`,`jp`.`jenis_pembayaran` AS `jenis_pembayaran` from (`type_bayar` `tb` join `jenis_pembayaran` `jp` on((`tb`.`id_jenis` = `jp`.`id_jenis`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_unit_properti`
--
DROP TABLE IF EXISTS `tbl_unit_properti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_unit_properti`  AS  select `up`.`id_unit` AS `id_unit`,`up`.`nama_unit` AS `nama_unit`,`up`.`id_properti` AS `id_properti`,`p`.`nama_properti` AS `nama_properti`,`up`.`type` AS `type`,`up`.`luas_tanah` AS `luas_tanah`,`up`.`luas_bangunan` AS `luas_bangunan`,`up`.`harga_unit` AS `harga_unit`,`up`.`foto_unit` AS `foto_unit`,`up`.`alamat_unit` AS `alamat_unit`,`up`.`tgl_insert` AS `tgl_insert`,`up`.`status_unit` AS `status_unit`,`up`.`id_user` AS `id_user`,`us`.`nama_lengkap` AS `nama_lengkap`,`up`.`deskripsi` AS `deskripsi` from ((`unit_properti` `up` left join `properti` `p` on((`up`.`id_properti` = `p`.`id_properti`))) left join `user` `us` on((`up`.`id_user` = `us`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_users`
--
DROP TABLE IF EXISTS `tbl_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_users`  AS  select `users`.`id_user` AS `id_user`,`users`.`nama_lengkap` AS `nama_lengkap`,`users`.`jenis_kelamin` AS `jenis_kelamin`,`users`.`alamat` AS `alamat`,`users`.`Email` AS `Email`,`users`.`no_hp` AS `no_hp`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`id_akses` AS `id_akses`,`users`.`foto_user` AS `foto_user`,`users`.`tanggal_buat` AS `tanggal_buat`,`users`.`status_user` AS `status_user`,`user_role`.`akses` AS `akses` from (`user` `users` join `user_role` on((`users`.`id_akses` = `user_role`.`id_akses`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_user_assign_properti`
--
DROP TABLE IF EXISTS `tbl_user_assign_properti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_user_assign_properti`  AS  select `up`.`id_assign` AS `id_assign`,`up`.`id_properti` AS `id_properti`,`p`.`nama_properti` AS `nama_properti`,`p`.`foto_properti` AS `foto_properti`,`p`.`alamat` AS `alamat`,`up`.`id_user` AS `id_user`,`us`.`nama_lengkap` AS `nama_lengkap`,`us`.`akses` AS `akses` from ((`user_assign_properti` `up` join `tbl_users` `us` on((`us`.`id_user` = `up`.`id_user`))) join `properti` `p` on((`p`.`id_properti` = `up`.`id_properti`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blok`
--
ALTER TABLE `blok`
  ADD PRIMARY KEY (`id_blok`),
  ADD KEY `id_properti` (`id_properti`);

--
-- Indexes for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_rab` (`id_rab`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kd_transaksi` (`id_transaksi`);

--
-- Indexes for table `follow_calon_konsumen`
--
ALTER TABLE `follow_calon_konsumen`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_konsumen` (`id_konsumen`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kategori_kelompok`
--
ALTER TABLE `kategori_kelompok`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelompok_item`
--
ALTER TABLE `kelompok_item`
  ADD PRIMARY KEY (`id_kelompok`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kerja_sama_bank`
--
ALTER TABLE `kerja_sama_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`),
  ADD UNIQUE KEY `telp` (`telp`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telp_kantor` (`telp_kantor`),
  ADD KEY `type_id_card` (`id_type`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `pembayaran_transaksi`
--
ALTER TABLE `pembayaran_transaksi`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `persyaratan_kategori`
--
ALTER TABLE `persyaratan_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `persyaratan_kelompok_sasaran`
--
ALTER TABLE `persyaratan_kelompok_sasaran`
  ADD PRIMARY KEY (`id_persyaratan`);

--
-- Indexes for table `persyaratan_sasaran`
--
ALTER TABLE `persyaratan_sasaran`
  ADD PRIMARY KEY (`id_sasaran`),
  ADD KEY `id_kategori_persyaratan` (`id_kategori_persyaratan`);

--
-- Indexes for table `properti`
--
ALTER TABLE `properti`
  ADD PRIMARY KEY (`id_properti`),
  ADD KEY `id_rekening` (`rekening`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_rab` (`id_rab`);

--
-- Indexes for table `rab_properti`
--
ALTER TABLE `rab_properti`
  ADD PRIMARY KEY (`id_rab`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rekening_properti`
--
ALTER TABLE `rekening_properti`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `surat_akta_rumah`
--
ALTER TABLE `surat_akta_rumah`
  ADD PRIMARY KEY (`id_akta`);

--
-- Indexes for table `surat_berita_acara`
--
ALTER TABLE `surat_berita_acara`
  ADD PRIMARY KEY (`id_berita_acara`);

--
-- Indexes for table `surat_konsumen`
--
ALTER TABLE `surat_konsumen`
  ADD PRIMARY KEY (`id_surat_konsumen`);

--
-- Indexes for table `surat_perumahan`
--
ALTER TABLE `surat_perumahan`
  ADD PRIMARY KEY (`id_surat_perumahan`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_surat`
--
ALTER TABLE `surat_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `transaksi_unit`
--
ALTER TABLE `transaksi_unit`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_konsumen` (`id_konsumen`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `id_type_bayar` (`id_type_bayar`);

--
-- Indexes for table `type_bayar`
--
ALTER TABLE `type_bayar`
  ADD PRIMARY KEY (`id_type_bayar`);

--
-- Indexes for table `type_id_card`
--
ALTER TABLE `type_id_card`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `unit_properti`
--
ALTER TABLE `unit_properti`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `user_id` (`id_user`),
  ADD KEY `id_properti` (`id_properti`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`),
  ADD KEY `akses_id` (`id_akses`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id_activity`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_assign_properti`
--
ALTER TABLE `user_assign_properti`
  ADD PRIMARY KEY (`id_assign`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_controller`
--
ALTER TABLE `user_controller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `user_role_menu`
--
ALTER TABLE `user_role_menu`
  ADD PRIMARY KEY (`id_menu_role`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blok`
--
ALTER TABLE `blok`
  MODIFY `id_blok` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_rab`
--
ALTER TABLE `detail_rab`
  MODIFY `id_detail` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `follow_calon_konsumen`
--
ALTER TABLE `follow_calon_konsumen`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_kelompok`
--
ALTER TABLE `kategori_kelompok`
  MODIFY `id_kategori` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelompok_item`
--
ALTER TABLE `kelompok_item`
  MODIFY `id_kelompok` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kerja_sama_bank`
--
ALTER TABLE `kerja_sama_bank`
  MODIFY `id_bank` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pengeluaran` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran_transaksi`
--
ALTER TABLE `pembayaran_transaksi`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `persyaratan_kategori`
--
ALTER TABLE `persyaratan_kategori`
  MODIFY `id_kategori` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `persyaratan_kelompok_sasaran`
--
ALTER TABLE `persyaratan_kelompok_sasaran`
  MODIFY `id_persyaratan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `persyaratan_sasaran`
--
ALTER TABLE `persyaratan_sasaran`
  MODIFY `id_sasaran` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `properti`
--
ALTER TABLE `properti`
  MODIFY `id_properti` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rab_properti`
--
ALTER TABLE `rab_properti`
  MODIFY `id_rab` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rekening_properti`
--
ALTER TABLE `rekening_properti`
  MODIFY `id_rekening` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_akta_rumah`
--
ALTER TABLE `surat_akta_rumah`
  MODIFY `id_akta` tinyint(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_berita_acara`
--
ALTER TABLE `surat_berita_acara`
  MODIFY `id_berita_acara` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_surat`
--
ALTER TABLE `surat_surat`
  MODIFY `id_surat` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_unit`
--
ALTER TABLE `transaksi_unit`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `type_bayar`
--
ALTER TABLE `type_bayar`
  MODIFY `id_type_bayar` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_id_card`
--
ALTER TABLE `type_id_card`
  MODIFY `id_type` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_properti`
--
ALTER TABLE `unit_properti`
  MODIFY `id_unit` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_assign_properti`
--
ALTER TABLE `user_assign_properti`
  MODIFY `id_assign` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_controller`
--
ALTER TABLE `user_controller`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_akses` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role_menu`
--
ALTER TABLE `user_role_menu`
  MODIFY `id_menu_role` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;