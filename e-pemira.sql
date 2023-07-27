-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jul 2023 pada 07.05
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-pemira`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attempt_count`
--

CREATE TABLE `attempt_count` (
  `id` int(11) NOT NULL,
  `time_count` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `attempt_count`
--

INSERT INTO `attempt_count` (`id`, `time_count`, `ip_address`) VALUES
(33, 1690356201, '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_paslon`
--

CREATE TABLE `data_paslon` (
  `id` int(11) NOT NULL,
  `nim_ketua` varchar(9) NOT NULL,
  `nm_paslon_ketua` varchar(50) NOT NULL,
  `gambar1` varchar(100) NOT NULL,
  `nim_wakil` varchar(9) NOT NULL,
  `nm_paslon_wakil` varchar(50) NOT NULL,
  `gambar2` varchar(100) NOT NULL,
  `no_urut` int(1) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_paslon`
--

INSERT INTO `data_paslon` (`id`, `nim_ketua`, `nm_paslon_ketua`, `gambar1`, `nim_wakil`, `nm_paslon_wakil`, `gambar2`, `no_urut`, `visi`, `misi`) VALUES
(1, '121212', 'Bagas Adji Priantomo', 'paslon-ketua1.jpg', '565656', 'Leliana Eka Fauziah', 'paslon-wakil1.jpg', 1, 'Menjadikan BEM Bina Insani University sebaagai adah bagi mahasiswa untuk mengembangkan segala potensi yang ada sehingga terbentuk mahasiswa yang cerdas,kreatif,berprestasi,dan aktif dalam menjaga nama baik universitas yang unggul ditingkat nasional.', '1. Memfasilitasi ruang kreasi dan inovasi untuk seluruh kegiatan akademik non akademik mahasiswa.<br>\r\n2. Meningkatkan pelayanan aspirasi dan advokasi yang responsif dan solutif bagi mahasiswa dan universitas.'),
(2, '22121', 'Iqbal Maulana Rozak', 'paslon-ketua2.jpg', '21012', 'Jundi Al Hafidz', 'paslon-wakil2.jpg', 2, 'Menjadi katalisator atau wadah inkubasi berkembang bagi mahasiswa agar terciptanya mahasiswa yang adaktif,kreatif dan solutif.', '1. Menjadikan BEM sebagai ladang dalam mengembangkan minat dan bakat mahasiswa. <br> 2. Menciptakan dan mengembangkan nilai pengabdian serta pelayanan mahasiswa terhadap masyarakat luas.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses`
--

CREATE TABLE `tbl_akses` (
  `nim` varchar(10) NOT NULL,
  `kode_akses` varchar(6) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_akses`
--

INSERT INTO `tbl_akses` (`nim`, `kode_akses`, `level`) VALUES
('2019320021', '5LCM6L', 'user'),
('2021310028', '45X1ZG', 'user'),
('BEMBIU', 'QWERTY', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dpt`
--

CREATE TABLE `tbl_dpt` (
  `nim` varchar(10) NOT NULL,
  `nama_mhs` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `waktu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_dpt`
--

INSERT INTO `tbl_dpt` (`nim`, `nama_mhs`, `status`, `email`, `waktu`) VALUES
('2019320021', 'Muhammad Aldisyah Rahman', 'Belum Memilih', 'xbhscbhavd@gmail.com', '-'),
('2021310028', 'Putro Dwi Mulyo', 'Belum Memilih', 'putrodwi31@gmail.com', '15:41:55pm'),
('BEMBIU', 'Administrator', 'Belum Memilih', '', '09:43:35 PM, 26 July 2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paslon`
--

CREATE TABLE `tbl_paslon` (
  `nim` varchar(10) NOT NULL,
  `nomor_paslon` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `level`, `id_menu`) VALUES
(1, 'admin', 1),
(2, 'user', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `nama_menu`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `nim`, `token`) VALUES
(1, 'BEMBIU', '3T7ArfPjnv'),
(2, '2021310028', 'VIfEVrMkX1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attempt_count`
--
ALTER TABLE `attempt_count`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_paslon`
--
ALTER TABLE `data_paslon`
  ADD PRIMARY KEY (`id`,`nim_ketua`);

--
-- Indeks untuk tabel `tbl_akses`
--
ALTER TABLE `tbl_akses`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tbl_dpt`
--
ALTER TABLE `tbl_dpt`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tbl_paslon`
--
ALTER TABLE `tbl_paslon`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attempt_count`
--
ALTER TABLE `attempt_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `data_paslon`
--
ALTER TABLE `data_paslon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
