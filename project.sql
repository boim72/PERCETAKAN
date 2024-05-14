-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2024 at 07:18 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` int NOT NULL,
  `nama_akses` varchar(25) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`, `deskripsi`) VALUES
(1, 'administrator', 'sebagai  pengelola kendali penuh pada sistem aplikasi'),
(2, 'Asisten admin', 'sebagai pengelola sistem stok barang, penjualan dan laporan');

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int NOT NULL,
  `nama_aset` varchar(256) NOT NULL,
  `nama_kategori` varchar(256) NOT NULL,
  `harga` int NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nama_aset`, `nama_kategori`, `harga`, `foto`) VALUES
(1, 'Mobil', 'Kantor', 200000000, '079a66bc5f44264316360348636ba77d.png');

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `deskripsi` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `jumlah`, `deskripsi`, `images`, `harga`) VALUES
(1, 'Cat', 180, 'kaleng', 'b58eb974986ae8ccc503d586658cfc42.jpg', 12000.00),
(4, 'tinta', 88, 'kaleng', '36c174dc0bb6018ca77ce40004c70595.jpg', 13000.00);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int NOT NULL,
  `nama_bank` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`) VALUES
(1, 'MANDIRI'),
(2, 'BNI'),
(3, 'BCA'),
(4, 'BRI'),
(5, 'CIMB Niaga');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `id_kategori` int NOT NULL,
  `ukuran` varchar(5) NOT NULL,
  `harga` int NOT NULL,
  `foto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_kategori`, `ukuran`, `harga`, `foto`) VALUES
(76, 'Banner Toko CV.Makmur', 21, ' 1', 900000, '5ca197217821e5dc287a1006b4ca401e.jpeg'),
(77, 'Desain Logo ', 22, ' 3', 10000, 'cc4e8b19c76a283ec60999be14072b7c.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int NOT NULL,
  `no_trf` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `totalpure` bigint NOT NULL,
  `grand_total` bigint NOT NULL,
  `diskon` int NOT NULL,
  `bayar` bigint NOT NULL,
  `kembalian` bigint NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `tgl_trf` date NOT NULL,
  `jam_trf` time NOT NULL,
  `id_pembayaran` int NOT NULL,
  `no_rek` int DEFAULT NULL,
  `atas_nama` varchar(35) NOT NULL,
  `id_bank` int DEFAULT NULL,
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_trf`, `nama_pelanggan`, `totalpure`, `grand_total`, `diskon`, `bayar`, `kembalian`, `catatan`, `tgl_trf`, `jam_trf`, `id_pembayaran`, `no_rek`, `atas_nama`, `id_bank`, `operator`) VALUES
(15, 'C20240226001', 'Ajik', 900000, 900000, 0, 1000000, 100000, 'Ajik pembelian benner toko ukuran 90x100', '2024-02-26', '12:16:21', 1, 0, '', NULL, 'admin'),
(16, 'C20240226015', 'Joko', 910000, 910000, 0, 1000000, 90000, 'Desain Logo sekaligus cetak benner ukuran 90x100', '2024-02-26', '12:52:17', 1, 0, '', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `inbahan`
--

CREATE TABLE `inbahan` (
  `id_inbahan` int NOT NULL,
  `in_tanggal` date NOT NULL,
  `id_bahan` int NOT NULL,
  `in_jumlah` int NOT NULL,
  `in_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inbahan`
--

INSERT INTO `inbahan` (`id_inbahan`, `in_tanggal`, `id_bahan`, `in_jumlah`, `in_harga`) VALUES
(1, '2024-02-28', 1, 200, 12000.00),
(8, '2024-02-28', 4, 95, 12000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(21, 'Banner Toko'),
(22, 'Jasa Desain'),
(23, 'Cetak Foto'),
(24, 'Print Kertas');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int NOT NULL,
  `nama_operator` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_akses` int NOT NULL,
  `last_login` date NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `nama_operator`, `username`, `password`, `id_akses`, `last_login`, `foto`) VALUES
(9, 'Ismail Surya Putra', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2024-02-29', '4231e5de7901780c334ddf69f709fdb3.jpg'),
(10, 'jeff', 'jeff', '166ee015c0e0934a8781e0c86a197c6e', 1, '0000-00-00', '13005384ce54754b3a763180f2a6c83e.png'),
(13, 'jefri', 'jefri', 'c710857e9b674843afc9b54b7ae2032d', 2, '2019-08-14', 'b0be2fdc90a3b7a0900a81ed8e466af5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `outbahan`
--

CREATE TABLE `outbahan` (
  `id_outbahan` int NOT NULL,
  `out_tanggal` date NOT NULL,
  `id_bahan` int NOT NULL,
  `out_jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outbahan`
--

INSERT INTO `outbahan` (`id_outbahan`, `out_tanggal`, `id_bahan`, `out_jumlah`) VALUES
(1, '2024-02-29', 1, 10),
(2, '2024-02-29', 1, 10),
(4, '2024-02-29', 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_byr` int NOT NULL,
  `metode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_byr`, `metode`) VALUES
(1, 'Cash'),
(2, 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_transaksi` int NOT NULL,
  `id_dtlpen` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah_stok` int NOT NULL,
  `harga_barang` bigint NOT NULL,
  `sub_total` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_transaksi`, `id_dtlpen`, `id_barang`, `jumlah_stok`, `harga_barang`, `sub_total`) VALUES
(43, 11, 61, 1, 120000, 120000),
(44, 11, 62, 1, 135000, 135000),
(45, 11, 66, 1, 90000, 90000),
(46, 11, 72, 1, 90000, 90000),
(47, 12, 73, 1, 43334453, 43334453),
(48, 13, 60, 1, 130000, 130000),
(49, 14, 76, 1, 900000, 900000),
(50, 15, 76, 1, 900000, 900000),
(51, 16, 77, 1, 10000, 10000),
(52, 16, 76, 1, 900000, 900000);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int NOT NULL,
  `id_barang` int NOT NULL,
  `stok_barang` int NOT NULL,
  `tanggal_stok` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `stok_barang`, `tanggal_stok`) VALUES
(58, 76, 97, '2024-02-26'),
(59, 77, 99, '2024-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id_ukuran` int NOT NULL,
  `nama_ukuran` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id_ukuran`, `nama_ukuran`) VALUES
(1, '90X100'),
(2, '200X100'),
(3, '300X150'),
(4, '400X200'),
(5, '500X250'),
(6, 'No Size');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbahan`
--
ALTER TABLE `inbahan`
  ADD PRIMARY KEY (`id_inbahan`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `outbahan`
--
ALTER TABLE `outbahan`
  ADD PRIMARY KEY (`id_outbahan`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_byr`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inbahan`
--
ALTER TABLE `inbahan`
  MODIFY `id_inbahan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `outbahan`
--
ALTER TABLE `outbahan`
  MODIFY `id_outbahan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_byr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id_ukuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inbahan`
--
ALTER TABLE `inbahan`
  ADD CONSTRAINT `inbahan_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`);

--
-- Constraints for table `outbahan`
--
ALTER TABLE `outbahan`
  ADD CONSTRAINT `outbahan_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
