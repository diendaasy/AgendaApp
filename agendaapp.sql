-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Apr 2025 pada 08.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agendaapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_agenda`
--

CREATE TABLE `tbl_agenda` (
  `agenda_id` int(11) NOT NULL,
  `jenis_agenda_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('created','approved','rejected','done') NOT NULL DEFAULT 'created',
  `keterangan` text DEFAULT NULL,
  `assign_at` date NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `reject_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_agenda`
--

INSERT INTO `tbl_agenda` (`agenda_id`, `jenis_agenda_id`, `user_id`, `status`, `keterangan`, `assign_at`, `read_at`, `created_at`, `updated_at`, `updated_by`, `approved_at`, `approved_by`, `created_by`, `reject_reason`) VALUES
(8, NULL, NULL, 'approved', 'Presentasi', '2025-04-15', NULL, '2025-04-15 06:35:27', '2025-04-15 06:35:27', NULL, '2025-04-15 06:35:27', 2, 2, ''),
(9, 1, 5, 'approved', 'tepat waktu!', '2025-04-15', NULL, '2025-04-15 06:35:52', '2025-04-15 06:35:52', NULL, '2025-04-15 06:37:51', 4, 2, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_agenda`
--

CREATE TABLE `tbl_jenis_agenda` (
  `jenis_agenda_id` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jenis_agenda`
--

INSERT INTO `tbl_jenis_agenda` (`jenis_agenda_id`, `nama_jenis`) VALUES
(1, 'HK 1.1'),
(2, 'HK 1.2'),
(3, 'HK 2.1'),
(4, 'HK 2.2'),
(5, 'HK 3'),
(6, 'HK 6'),
(7, 'HK 5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_role` enum('admin','karyawan','approver') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_role`, `username`, `password`, `nama_karyawan`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'karyawan', 'Lola', 'Bps3276', 'Lola Dwi Ferbyanti', 'Statistisi Ahli Muda', '2025-03-29 07:22:48', '2025-03-29 07:22:48'),
(2, 'admin', 'Perdi', 'Bps3276', 'Perdi irmawan p', 'Statistisi Ahli Muda', '2025-03-29 07:25:08', '2025-03-29 07:25:08'),
(3, 'karyawan', 'jati', 'Bps3276', 'Djati', 'Ahli muda', '2025-04-05 07:59:05', '2025-04-05 07:59:05'),
(4, 'approver', 'nisa', 'Bps3276', 'Anissa', 'Ahli muda', '2025-04-05 07:59:41', '2025-04-05 07:59:41'),
(5, 'karyawan', 'duyi', 'bps123', 'dinda', 'pelajar', '2025-04-15 06:34:30', '2025-04-15 06:34:30'),
(6, 'karyawan', 'wahyu', 'vospid', 'wahyudi', 'guru', '2025-04-15 06:34:56', '2025-04-15 06:34:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `jenis_agenda_id` (`jenis_agenda_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `tbl_jenis_agenda`
--
ALTER TABLE `tbl_jenis_agenda`
  ADD PRIMARY KEY (`jenis_agenda_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
