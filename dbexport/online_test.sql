-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Apr 2022 pada 23.41
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `id_administrator` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id_administrator`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_kuis`
--

CREATE TABLE `kelompok_kuis` (
  `id_kelompok_kuis` int(11) NOT NULL,
  `nama_kuis` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelompok_kuis`
--

INSERT INTO `kelompok_kuis` (`id_kelompok_kuis`, `nama_kuis`, `detail`, `waktu_mulai`, `waktu_selesai`) VALUES
(2, 'kuis_1', NULL, '2022-04-29 17:00:00', '2022-04-29 17:00:00'),
(3, 'kuis_2', NULL, '2022-04-29 17:00:00', '2022-04-29 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_peserta`
--

CREATE TABLE `kelompok_peserta` (
  `id_kelompok_peserta` int(11) NOT NULL,
  `nama_kelompok_peserta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelompok_peserta`
--

INSERT INTO `kelompok_peserta` (`id_kelompok_peserta`, `nama_kelompok_peserta`) VALUES
(1, 'Kelas_XA'),
(2, 'Kelas_XB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuis_item`
--

CREATE TABLE `kuis_item` (
  `id_kuis_item` int(11) NOT NULL,
  `id_kelompok_kuis` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `ans_a` varchar(255) NOT NULL,
  `ans_b` varchar(255) NOT NULL,
  `ans_c` varchar(255) NOT NULL,
  `ans_d` varchar(255) NOT NULL,
  `key_ans` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kuis_item`
--

INSERT INTO `kuis_item` (`id_kuis_item`, `id_kelompok_kuis`, `pertanyaan`, `ans_a`, `ans_b`, `ans_c`, `ans_d`, `key_ans`) VALUES
(1, 2, 'pertanyaan bebas dfgdfg', 'ghfgh', 'dfhdfh', 'sdffgsdg', 'sdhdfgdfg', 'c'),
(2, 2, 'sdfsdf', 'asd', 'asda', 'asd', 'asdasd', 'a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuis_selesai`
--

CREATE TABLE `kuis_selesai` (
  `id_kuis_selesai` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_kelompok_kuis` int(11) NOT NULL,
  `id_kuis_item` int(11) NOT NULL,
  `ans` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_kelompok_peserta` varchar(100) DEFAULT NULL,
  `no_induk` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_peserta` varchar(255) NOT NULL,
  `keterangan_lain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_kelompok_peserta`, `no_induk`, `password`, `nama_peserta`, `keterangan_lain`) VALUES
(1, '1', '25005', '74dd517e30be91eccb78698d9e932bca', 'budissasmito', '[]'),
(2, '1', '35227', '57db8b336e426b95a36b0abc8e17f8af', 'dwi yuda', '[]'),
(3, '1', '120056', 'a46eeaddbb55e34e3a5459017ca88dbb', 'edi sasongko', '[]'),
(4, '2', '450089', '57753962585bee5039c276c91a4e153c', 'ahmad hasan', '[]'),
(5, '2', '5600098', '339b96067a1e0249d925f87fa02703ab', 'ahmad bahri', '[]'),
(6, '2', '1200367', 'f1afffc9d34620905218107da718b722', 'hendra subakti', '[]');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_administrator`);

--
-- Indeks untuk tabel `kelompok_kuis`
--
ALTER TABLE `kelompok_kuis`
  ADD PRIMARY KEY (`id_kelompok_kuis`);

--
-- Indeks untuk tabel `kelompok_peserta`
--
ALTER TABLE `kelompok_peserta`
  ADD PRIMARY KEY (`id_kelompok_peserta`);

--
-- Indeks untuk tabel `kuis_item`
--
ALTER TABLE `kuis_item`
  ADD PRIMARY KEY (`id_kuis_item`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `no_induk` (`no_induk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_administrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelompok_kuis`
--
ALTER TABLE `kelompok_kuis`
  MODIFY `id_kelompok_kuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelompok_peserta`
--
ALTER TABLE `kelompok_peserta`
  MODIFY `id_kelompok_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kuis_item`
--
ALTER TABLE `kuis_item`
  MODIFY `id_kuis_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
