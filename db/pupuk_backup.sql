-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2024 pada 17.57
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
  `id_users` int(11) NOT NULL,
  `id_pupuk` int(11) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_users`, `id_pupuk`, `jumlah`, `timestamp`) VALUES
(4, 1, 2, '2', '2024-06-14 08:19:50');

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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','owner') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `nama`, `email`, `username`, `password`, `role`, `timestamp`) VALUES
(1, 'arif', 'arif@gmail.com', 'arifanursida', '$2y$10$ab4QssdxhcjNZZ5cH1PVd.jvl1PglifC94SsoI5SueE0vt9jlu0fe', 'admin', '2024-05-12 13:03:15'),
(2, 'user', 'user@gmail.com', 'user', '$2y$10$BuKy6Rugm43ScCV8q5M4Y.JXzgs4Y1rD4sDWvtA8BQFM5YiYhL9XW', 'user', '2024-06-02 14:40:59');

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pupuk`
--
ALTER TABLE `pupuk`
  MODIFY `id_pupuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
