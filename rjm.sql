-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 06:46 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rjm`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
`id` int(11) NOT NULL,
  `nama_area` varchar(25) NOT NULL,
  `kode_area` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `nama_area`, `kode_area`) VALUES
(1, 'Sumbagsel', '02'),
(2, 'Sumbagut', '01');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE IF NOT EXISTS `cabang` (
`id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_kcu` int(11) NOT NULL,
  `id_kso` int(11) NOT NULL,
  `id_pt` int(11) NOT NULL,
  `nama_cabang` varchar(25) NOT NULL,
  `kode_cabang` varchar(25) NOT NULL,
  `perusahaan` varchar(25) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE IF NOT EXISTS `coa` (
`id` int(11) NOT NULL,
  `coa` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id`, `coa`) VALUES
(3, 'fdasd');

-- --------------------------------------------------------

--
-- Table structure for table `historisaldo`
--

CREATE TABLE IF NOT EXISTS `historisaldo` (
`id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `status_deb_kre` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_spd` int(11) NOT NULL,
  `tgl_trx` date NOT NULL,
  `uraian` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

CREATE TABLE IF NOT EXISTS `kapal` (
`id` int(11) NOT NULL,
  `kode_kapal` varchar(25) NOT NULL,
  `nama_kapal` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kapal`
--

INSERT INTO `kapal` (`id`, `kode_kapal`, `nama_kapal`) VALUES
(2, '001', 'Kapal Feri');

-- --------------------------------------------------------

--
-- Table structure for table `kso`
--

CREATE TABLE IF NOT EXISTS `kso` (
`id` int(11) NOT NULL,
  `jenis_kso` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kso`
--

INSERT INTO `kso` (`id`, `jenis_kso`) VALUES
(2, 'sadsa');

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

CREATE TABLE IF NOT EXISTS `kurs` (
`id` int(11) NOT NULL,
  `kode_mata_uang` varchar(25) NOT NULL,
  `nama_mata_uang` varchar(25) NOT NULL,
  `nilai_mata_uang` int(11) NOT NULL,
  `nilai_tukar` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`id`, `kode_mata_uang`, `nama_mata_uang`, `nilai_mata_uang`, `nilai_tukar`) VALUES
(1, 'IDR', 'Rupiah', 10000, 9500);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`id` int(11) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_invoice`
--

CREATE TABLE IF NOT EXISTS `master_invoice` (
`id` int(11) NOT NULL,
  `id_kurs` int(11) NOT NULL,
  `id_jns_bayar` int(11) NOT NULL,
  `id_coa` int(11) NOT NULL,
  `no_voucher` varchar(25) NOT NULL,
  `tgl_input` date NOT NULL,
  `penjelasan` text NOT NULL,
  `status_deb_kre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_kcu`
--

CREATE TABLE IF NOT EXISTS `master_kcu` (
`id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `kode_kcu` varchar(25) NOT NULL,
  `nama_kcu` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `master_kcu`
--

INSERT INTO `master_kcu` (`id`, `id_area`, `kode_kcu`, `nama_kcu`, `alamat`, `saldo`) VALUES
(1, 2, 'asdasd', 'asdsa', 'asdasd', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
`id` int(11) NOT NULL,
  `jenis_pembayaran` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `jenis_pembayaran`) VALUES
(2, 'Kredit');

-- --------------------------------------------------------

--
-- Table structure for table `pt`
--

CREATE TABLE IF NOT EXISTS `pt` (
`id` int(11) NOT NULL,
  `nama_pt` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pt`
--

INSERT INTO `pt` (`id`, `nama_pt`) VALUES
(2, 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(2, 'Request');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_cabang`, `id_level`, `username`, `nama`, `email`, `password`, `no_telp`, `alamat`) VALUES
(1, 1, 1, 'rizkigan', 'rizki', 'rizki@gmail.com', 'rizki', '0932124243', 'palembang'),
(2, 0, 0, 'sadsa', 'dsad', 'adsad', '', '08xxxx', 'asdsa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
 ADD PRIMARY KEY (`id`), ADD KEY `cabang (5)_fk0` (`id_area`), ADD KEY `cabang (5)_fk1` (`id_kcu`), ADD KEY `cabang (5)_fk2` (`id_kso`), ADD KEY `id_pt` (`id_pt`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historisaldo`
--
ALTER TABLE `historisaldo`
 ADD PRIMARY KEY (`id`), ADD KEY `historisaldo_fk0` (`id_invoice`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
 ADD PRIMARY KEY (`id`), ADD KEY `invoice_fk0` (`id_user`), ADD KEY `invoice_fk1` (`id_spd`), ADD KEY `invoice_fk2` (`status`);

--
-- Indexes for table `kapal`
--
ALTER TABLE `kapal`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kso`
--
ALTER TABLE `kso`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurs`
--
ALTER TABLE `kurs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_invoice`
--
ALTER TABLE `master_invoice`
 ADD PRIMARY KEY (`id`), ADD KEY `master_invoice_fk0` (`id_kurs`), ADD KEY `master_invoice_fk1` (`id_jns_bayar`), ADD KEY `master_invoice_fk2` (`id_coa`);

--
-- Indexes for table `master_kcu`
--
ALTER TABLE `master_kcu`
 ADD PRIMARY KEY (`id`), ADD KEY `id_area` (`id_area`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pt`
--
ALTER TABLE `pt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password` (`password`), ADD KEY `users (6)_fk0` (`id_cabang`), ADD KEY `users (6)_fk1` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `historisaldo`
--
ALTER TABLE `historisaldo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapal`
--
ALTER TABLE `kapal`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kso`
--
ALTER TABLE `kso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kurs`
--
ALTER TABLE `kurs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_invoice`
--
ALTER TABLE `master_invoice`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_kcu`
--
ALTER TABLE `master_kcu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pt`
--
ALTER TABLE `pt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cabang`
--
ALTER TABLE `cabang`
ADD CONSTRAINT `cabang (5)_fk0` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`),
ADD CONSTRAINT `cabang (5)_fk1` FOREIGN KEY (`id_kcu`) REFERENCES `master_kcu` (`id`),
ADD CONSTRAINT `cabang (5)_fk2` FOREIGN KEY (`id_kso`) REFERENCES `kso` (`id`);

--
-- Constraints for table `historisaldo`
--
ALTER TABLE `historisaldo`
ADD CONSTRAINT `historisaldo_fk0` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
ADD CONSTRAINT `invoice_fk0` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
ADD CONSTRAINT `invoice_fk1` FOREIGN KEY (`id_spd`) REFERENCES `master_invoice` (`id`),
ADD CONSTRAINT `invoice_fk2` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `master_invoice`
--
ALTER TABLE `master_invoice`
ADD CONSTRAINT `master_invoice_fk0` FOREIGN KEY (`id_kurs`) REFERENCES `kurs` (`id`),
ADD CONSTRAINT `master_invoice_fk1` FOREIGN KEY (`id_jns_bayar`) REFERENCES `pembayaran` (`id`),
ADD CONSTRAINT `master_invoice_fk2` FOREIGN KEY (`id_coa`) REFERENCES `coa` (`id`);

--
-- Constraints for table `master_kcu`
--
ALTER TABLE `master_kcu`
ADD CONSTRAINT `master_kcu_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
