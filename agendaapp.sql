-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Apr 2025 pada 10.12
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
  `jenis_agenda_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('created','approved','rejected','done') NOT NULL DEFAULT 'created',
  `keterangan` text DEFAULT NULL,
  `assign_at` date NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `reject_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_agenda`
--

INSERT INTO `tbl_agenda` (`agenda_id`, `jenis_agenda_id`, `user_id`, `status`, `keterangan`, `assign_at`, `read_at`, `created_at`, `updated_at`, `approved_at`, `approved_by`, `created_by`, `reject_reason`) VALUES
(1, 3, 1, 'created', '', '2025-04-14', NULL, '2025-04-05 07:16:58', '2025-04-05 07:16:58', '2025-04-07 07:36:16', 4, 2, ''),
(2, 1, 1, 'created', 'test', '2025-05-01', NULL, '2025-04-05 09:42:27', '2025-04-05 09:42:27', NULL, NULL, 2, ''),
(3, 5, 3, 'created', 'kemiri muka', '2025-04-28', NULL, '2025-04-05 09:44:29', '2025-04-05 09:44:29', NULL, NULL, 2, '');

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
(5, 'HK 3');

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
(4, 'approver', 'nisa', 'Bps3276', 'Anissa', 'Ahli muda', '2025-04-05 07:59:41', '2025-04-05 07:59:41');

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
  ADD KEY `jenis_agenda_id` (`jenis_agenda_id`);

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
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_agenda`
--
ALTER TABLE `tbl_jenis_agenda`
  MODIFY `jenis_agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  ADD CONSTRAINT `tbl_agenda_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_agenda_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_agenda_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_agenda_ibfk_4` FOREIGN KEY (`jenis_agenda_id`) REFERENCES `tbl_jenis_agenda` (`jenis_agenda_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
