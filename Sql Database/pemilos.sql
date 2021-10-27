-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Okt 2021 pada 10.27
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemilos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_ipm`
--

CREATE TABLE `admin_ipm` (
  `id_ipm` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin_ipm`
--

INSERT INTO `admin_ipm` (`id_ipm`, `username`, `password`) VALUES
(1, 'ipm', '36df931ba9c9d7abb4302559c13c7ae8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'pak guru', '175d3c91af3e52487ca1fa69551d1ce6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_calon`
--

CREATE TABLE `data_calon` (
  `id_calon` int(11) NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `jumlah_vote` int(11) NOT NULL,
  `gambar_calon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_calon`
--

INSERT INTO `data_calon` (`id_calon`, `nama_calon`, `visi`, `misi`, `jumlah_vote`, `gambar_calon`) VALUES
(9, 'Udin Saputra', '<ol><li>dfdfafafafasf</li><li>afsafa</li><li>af</li><li>af</li><li>f</li></ol>', '<ul><li>asffaafafafsfsafsaasfaf</li><li>asfasf</li><li>asf</li><li>af</li><li>af</li></ul>', 3, '6166d2c154313.jpg'),
(10, 'boboiboy', '<ol><li>dasdadaasdadsas</li></ol>', '<p>asdsadsad</p>', 2, '6166d2dd44933.jpg'),
(11, 'Calon Pertama', '<p>ini visi</p>', '<p>ini misi</p>', 0, '616799d2a9120.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `no_induk_siswa` char(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `pemilos` enum('belum memilih','sudah memilih') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `no_induk_siswa`, `nama`, `kelas`, `pemilos`) VALUES
(1094, '12529', 'AHMAD SHOLEH', 'X TAV', 'sudah memilih'),
(1095, '12530', 'ALIVIA MARETYA PUTRI', 'X TAV', 'sudah memilih'),
(1096, '12531', 'CANDRA TRI ADITIYA', 'X TAV', 'belum memilih'),
(1097, '12532', 'DERICK AJI PRASETYA', 'X TAV', 'belum memilih'),
(1098, '12533', 'DHIMAS RICHARD APTA ALFREDA NURWANTO', 'X TAV', 'belum memilih'),
(1099, '21313', 'asdad', 'XII RPL 2', 'belum memilih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chart`
--

CREATE TABLE `tb_chart` (
  `id` int(11) NOT NULL,
  `status` enum('disable','enable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_chart`
--

INSERT INTO `tb_chart` (`id`, `status`) VALUES
(1, 'disable');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `kelas` enum('X','XI','XII') NOT NULL,
  `jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `kelas`, `jurusan`) VALUES
(1, 'X TAV ', 'X', 'TAV'),
(2, 'X TPM 1', 'X', 'TPM'),
(3, 'X TPM 2', 'X', 'TPM'),
(4, 'X TKRO 1', 'X', 'TKRO'),
(5, 'X TKRO 2', 'X', 'TKRO'),
(6, 'X TKRO 3', 'X', 'TKRO'),
(7, 'X TKRO 4', 'X', 'TKRO'),
(8, 'X TBSM 1', 'X', 'TBSM'),
(9, 'X TBSM 2', 'X', 'TBSM'),
(10, 'X TBSM 3', 'X', 'TBSM'),
(11, 'X TBSM 4', 'X', 'TBSM'),
(12, 'X RPL 1', 'X', 'RPL'),
(13, 'X RPL 2', 'X', 'RPL'),
(14, 'XI TAV ', 'XI', 'TAV'),
(15, 'XI TPM 1', 'XI', 'TPM'),
(16, 'XI TPM 2', 'XI', 'TPM'),
(17, 'XI TKRO 1', 'XI', 'TKRO'),
(18, 'XI TKRO 2', 'XI', 'TKRO'),
(19, 'XI TKRO 3', 'XI', 'TKRO'),
(20, 'XI TKRO 4', 'XI', 'TKRO'),
(21, 'XI TBSM 1', 'XI', 'TBSM'),
(22, 'XI TBSM 2', 'XI', 'TBSM'),
(23, 'XI TBSM 3', 'XI', 'TBSM'),
(24, 'XI RPL 1', 'XI', 'RPL'),
(25, 'XI RPL 2', 'XI', 'RPL'),
(26, 'XII TAV ', 'XII', 'TAV'),
(27, 'XII TPM 1', 'XII', 'TPM'),
(28, 'XII TPM 2', 'XII', 'TPM'),
(29, 'XII TKRO 1', 'XII', 'TKRO'),
(30, 'XII TKRO 2', 'XII', 'TKRO'),
(31, 'XII TKRO 3', 'XII', 'TKRO'),
(32, 'XII TKRO 4', 'XII', 'TKRO'),
(33, 'XII TKRO 5', 'XII', 'TKRO'),
(34, 'XII TBSM 1', 'XII', 'TBSM'),
(35, 'XII TBSM 2', 'XII', 'TBSM'),
(36, 'XII RPL 1', 'XII', 'RPL'),
(37, 'XII RPL 2', 'XII', 'RPL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `no_induk_siswa` char(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `aktif` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `no_induk_siswa`, `password`, `aktif`) VALUES
(35, '12529', 'NMPmM', '1'),
(36, '12530', '4ztrU', '0'),
(37, '12531', 'B7wQw', '0'),
(38, '12532', '2Pu0T', '0'),
(39, '12533', 'ZFJIG', '0'),
(40, '21313', 'DNX78', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vote`
--

CREATE TABLE `tb_vote` (
  `id` int(11) NOT NULL,
  `class` varchar(3) NOT NULL,
  `status` enum('enable','disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_vote`
--

INSERT INTO `tb_vote` (`id`, `class`, `status`) VALUES
(3, 'X', 'disable'),
(4, 'XI', 'disable'),
(5, 'XII', 'disable');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_ipm`
--
ALTER TABLE `admin_ipm`
  ADD PRIMARY KEY (`id_ipm`);

--
-- Indeks untuk tabel `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_calon`
--
ALTER TABLE `data_calon`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tb_chart`
--
ALTER TABLE `tb_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `tb_vote`
--
ALTER TABLE `tb_vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_ipm`
--
ALTER TABLE `admin_ipm`
  MODIFY `id_ipm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_calon`
--
ALTER TABLE `data_calon`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1100;

--
-- AUTO_INCREMENT untuk tabel `tb_chart`
--
ALTER TABLE `tb_chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_vote`
--
ALTER TABLE `tb_vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
