-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2025 at 05:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambulance`
--

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `id_armada` int(55) NOT NULL,
  `nama_armada` varchar(55) NOT NULL,
  `plat` varchar(55) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `armada`
--

INSERT INTO `armada` (`id_armada`, `nama_armada`, `plat`, `status`) VALUES
(2, 'APV', 'AD 4545 CD', 'Aktif'),
(3, 'LUXIO ', 'AD 23223 S', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `operasional`
--

CREATE TABLE `operasional` (
  `id_operasional` int(55) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran','','') NOT NULL,
  `nominal` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operasional`
--

INSERT INTO `operasional` (`id_operasional`, `tanggal`, `keterangan`, `jenis`, `nominal`) VALUES
(1, '2025-10-09', 'Donasi ', 'Pemasukan', '500000'),
(2, '2022-01-31', 'Donasi Sapi Tumpak', 'Pemasukan', '8815000'),
(3, '2022-01-01', 'NN ', 'Pemasukan', '50000'),
(4, '2022-03-01', 'Kotak Infaq', 'Pemasukan', '1429000'),
(6, '2022-08-01', 'Jimpitan Relawan', 'Pemasukan', '830000'),
(7, '2022-03-01', 'BBM', 'Pengeluaran', '3278000'),
(8, '2022-02-01', 'Perawatan', 'Pengeluaran', '9705000'),
(9, '2022-01-01', 'Pembelian Kerenda', 'Pengeluaran', '1500000'),
(10, '2022-05-01', 'Wifi', 'Pengeluaran', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(55) NOT NULL,
  `nama_pasien` varchar(55) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `umur` char(55) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` char(55) NOT NULL,
  `diagnosa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jenis_kelamin`, `umur`, `alamat`, `no_hp`, `diagnosa`) VALUES
(1, 'Usman S', 'Laki-laki', '35', 'Besuki RT 02 RW 03, Tanduk', '08643242413', 'Gagal Ginjal Kronis, Stadium 5, DM2'),
(8, 'Lutfy Zaini Al Fathonid', 'Laki-laki', '19', 'Rejosari A', '086523231231', 'Dislokasi tulang bahu'),
(9, 'Karimah', 'Perempuan', '0', 'Sengon', '0858323123123', '-'),
(10, 'Toin', 'Laki-laki', '0', 'Rejosari B', '0', '-'),
(11, 'Narmi', 'Perempuan', '0', 'Sambirejo', '0', '-'),
(12, 'Sudadi', 'Laki-laki', '0', 'Karang Kepoh, Boyolali', '087654321213', 'Cuci darah'),
(13, 'Muslimin', 'Laki-laki', '0', 'CANDIKIDUL', '0', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` int(55) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pasien` int(55) NOT NULL,
  `id_relawan` int(55) NOT NULL,
  `id_armada` int(55) NOT NULL,
  `dari_lokasi` text NOT NULL,
  `ke_lokasi` text NOT NULL,
  `jenis_pelayanan` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `tanggal`, `id_pasien`, `id_relawan`, `id_armada`, `dari_lokasi`, `ke_lokasi`, `jenis_pelayanan`, `keterangan`) VALUES
(2, '2025-12-09', 1, 44, 3, 'Rejosari A', 'RS PKU Aisyah', 'Non darurat control antar jemput', 'penanganan DR AGUS NUROHMAN '),
(3, '2025-07-04', 8, 45, 3, 'Rejosari A', 'PKU SINGKIL', 'control antar', 'Antar kebutuhuan oksigen\r\n'),
(4, '2022-02-07', 13, 44, 2, 'Candikidul', 'RSUD SIMO', 'Control antar jemput', 'GIAT MELATI RSUD SIMO'),
(5, '2022-12-12', 10, 45, 2, 'Rejosari B', 'RS PKU', 'Control antar jemput', 'GIAT MELATI KONTROL'),
(6, '2022-02-06', 11, 44, 3, 'Sambirejo', 'RS SIMO', 'Control Antar Jemput', 'GIAT MELATI RSPA Boyolali'),
(7, '2022-12-12', 12, 46, 2, 'KARANGKEPOH', 'RS KASIH IBU', 'Antar Jemput', 'GIAT MELATI KARANGKEPOH - RS KASIH IBU'),
(8, '2021-11-12', 9, 46, 3, 'TANDUK', 'RS KASIH IBU', 'Control antar jemput', 'Cuci darah RS KASIH IBU');

-- --------------------------------------------------------

--
-- Table structure for table `relawan`
--

CREATE TABLE `relawan` (
  `id_relawan` int(55) NOT NULL,
  `nama_relawan` varchar(55) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `no_hp` varchar(55) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relawan`
--

INSERT INTO `relawan` (`id_relawan`, `nama_relawan`, `jenis_kelamin`, `no_hp`, `alamat`) VALUES
(44, 'Khomarudin Zaini', 'Laki-laki', '085727254908', 'Rejosari A'),
(45, 'Nanang Triyani', 'Laki-laki', '081277612133', 'Rejosari A'),
(46, 'Chouirudin', 'Laki-laki', '08767656543', 'Rejosari A'),
(47, 'Suwardi', 'Laki-laki', '0821535463434', 'Rejosari A'),
(48, 'Mbah Jie', 'Laki-laki', '0897766354234', 'Cepogo'),
(49, 'Munaryo', 'Laki-laki', '08366452341132', 'Rejosari A'),
(50, 'Fauzan Febriyanto', 'Laki-laki', '0897766233242', 'Rejosari A'),
(51, 'Rudi Irawan', 'Laki-laki', '0857762361233', 'Rejosari A'),
(52, 'Aziz', 'Laki-laki', '086653423443434', 'Cabeankunti'),
(53, 'Jihad', 'Laki-laki', '089834834234445', 'Rejosari A');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(55) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`id_armada`);

--
-- Indexes for table `operasional`
--
ALTER TABLE `operasional`
  ADD PRIMARY KEY (`id_operasional`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`),
  ADD KEY `fk_relawan` (`id_relawan`),
  ADD KEY `fk_armada` (`id_armada`),
  ADD KEY `fk_pasien` (`id_pasien`);

--
-- Indexes for table `relawan`
--
ALTER TABLE `relawan`
  ADD PRIMARY KEY (`id_relawan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `id_armada` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `operasional`
--
ALTER TABLE `operasional`
  MODIFY `id_operasional` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `relawan`
--
ALTER TABLE `relawan`
  MODIFY `id_relawan` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD CONSTRAINT `fk_armada` FOREIGN KEY (`id_armada`) REFERENCES `armada` (`id_armada`),
  ADD CONSTRAINT `fk_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `fk_relawan` FOREIGN KEY (`id_relawan`) REFERENCES `relawan` (`id_relawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
