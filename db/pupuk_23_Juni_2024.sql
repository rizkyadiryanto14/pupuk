-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2024 pada 22.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pupuk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal_lahir` datetime NOT NULL,
  `id_usaha_dagang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama`, `nik`, `alamat`, `tempat`, `tanggal_lahir`, `id_usaha_dagang`) VALUES
(1, 'ABDURRAHMAN MS', '5204220501540002', 'RT 001 RW 003 Dusun Nijang Tengah', 'SUMBAWA', '2024-06-14 18:22:55', 2),
(2, 'AMINOLLAH', '5204222102710001', 'Dusun Nijang Tengah RT001 Rw003 Nijang', 'Sumbawa', '1971-02-21 00:00:00', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `status_pengiriman` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `id_pupuk` int(11) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_penduduk`, `id_pupuk`, `jumlah`, `timestamp`) VALUES
(7, 1, 3, '2', '2024-06-22 11:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pupuk`
--

CREATE TABLE `pupuk` (
  `id_pupuk` int(11) NOT NULL,
  `nama_pupuk` varchar(255) NOT NULL,
  `jenis_pupuk` varchar(50) NOT NULL,
  `harga_pupuk` double NOT NULL,
  `status_pupuk` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pupuk`
--

INSERT INTO `pupuk` (`id_pupuk`, `nama_pupuk`, `jenis_pupuk`, `harga_pupuk`, `status_pupuk`, `timestamp`) VALUES
(2, 'Pupuk NPK', ' NPK', 60000, 'Masuk', '2024-06-02 17:55:27'),
(3, 'Pupuk Urea', 'Urea', 75000, 'Masuk', '2024-06-02 17:55:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usaha_dagang`
--

CREATE TABLE `usaha_dagang` (
  `id_usaha_dagang` int(11) NOT NULL,
  `nama_kios` varchar(30) NOT NULL,
  `kode_kios` varchar(20) NOT NULL,
  `subsektor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `usaha_dagang`
--

INSERT INTO `usaha_dagang` (`id_usaha_dagang`, `nama_kios`, `kode_kios`, `subsektor`) VALUES
(2, 'SUMBER TANI, UD', 'RT0000032515', 'TANAMAN PANGAN'),
(3, 'CAHAYA PUTRA, UD', 'RT0000032510', 'TANAMAN PANGAN'),
(4, 'KAROMAH, UD', 'RT0000086955', 'TANAMAN PANGAN'),
(5, 'DUA DARA, UD', 'RT0000032511', 'TANAMAN PANGAN'),
(6, 'WAHYU, UD', 'RT0000032517', 'TANAMAN PANGAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','owner') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `nama`, `username`, `password`, `role`, `timestamp`) VALUES
(1, 'arif', 'arifanursida', '$2y$10$ab4QssdxhcjNZZ5cH1PVd.jvl1PglifC94SsoI5SueE0vt9jlu0fe', 'admin', '2024-05-12 13:03:15'),
(2, 'user', 'user', '$2y$10$BuKy6Rugm43ScCV8q5M4Y.JXzgs4Y1rD4sDWvtA8BQFM5YiYhL9XW', 'user', '2024-06-02 14:40:59'),
(3, 'ABDURRAHMAN MS', '5204220501540002', '$2y$10$BYrzJ20ORMq7pvLWkAJPROiyVxPBIt7BSFclEDfVicBLozooegxRW', 'user', '2024-06-22 09:39:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `pupuk`
--
ALTER TABLE `pupuk`
  ADD PRIMARY KEY (`id_pupuk`);

--
-- Indeks untuk tabel `usaha_dagang`
--
ALTER TABLE `usaha_dagang`
  ADD PRIMARY KEY (`id_usaha_dagang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pupuk`
--
ALTER TABLE `pupuk`
  MODIFY `id_pupuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `usaha_dagang`
--
ALTER TABLE `usaha_dagang`
  MODIFY `id_usaha_dagang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
