-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2025 pada 13.05
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
  `file_path_absen` text DEFAULT NULL,
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

INSERT INTO `tbl_agenda` (`agenda_id`, `jenis_agenda_id`, `user_id`, `status`, `keterangan`, `file_path_absen`, `assign_at`, `read_at`, `created_at`, `updated_at`, `updated_by`, `approved_at`, `approved_by`, `created_by`, `reject_reason`) VALUES
(9, 1, 5, 'approved', 'tepat waktu!', NULL, '2025-04-15', NULL, '2025-04-15 06:35:52', '2025-04-15 06:35:52', NULL, '2025-04-15 06:37:51', 4, 2, ''),
(10, NULL, NULL, 'approved', 'UPACARA KORPRI', NULL, '2025-04-17', NULL, '2025-04-16 05:36:36', '2025-04-16 05:36:36', NULL, '2025-04-16 05:36:36', 2, 2, ''),
(11, NULL, NULL, 'approved', 'Jum\'at Berkah ', NULL, '2025-04-18', NULL, '2025-04-16 08:35:39', '2025-04-16 08:35:39', NULL, '2025-04-16 08:35:39', 2, 2, ''),
(12, NULL, NULL, 'approved', 'Rapat Resmi Mitra Sensu 2026', NULL, '2025-04-30', NULL, '2025-04-16 08:36:20', '2025-04-16 09:17:49', 2, '2025-04-16 08:36:20', 2, 2, ''),
(13, 4, 8, 'rejected', '', NULL, '2025-04-17', NULL, '2025-04-16 08:37:49', '2025-04-16 08:37:49', NULL, '2025-04-16 09:16:50', 4, 2, 'Telat'),
(14, 6, 9, 'approved', '', NULL, '2025-04-18', NULL, '2025-04-16 08:38:11', '2025-04-16 08:38:11', NULL, '2025-04-16 08:42:16', 4, 2, ''),
(15, 3, 1, 'done', '', 'img/bukti_absen/15_lola_dwi_ferbyantii_2025-04-16.jpg', '2025-04-16', NULL, '2025-04-16 08:38:38', '2025-04-20 10:10:30', NULL, '2025-04-16 08:42:14', 4, 2, ''),
(16, 4, 10, 'approved', 'Jam 1 siang', NULL, '2025-04-16', NULL, '2025-04-16 09:14:36', '2025-04-16 09:14:36', NULL, '2025-04-16 09:15:49', 4, 2, ''),
(17, NULL, NULL, 'approved', 'Rapat', NULL, '2025-04-16', NULL, '2025-04-16 09:40:15', '2025-04-16 09:40:15', NULL, '2025-04-16 09:40:15', 2, 2, ''),
(18, 1, 3, 'approved', 'haha', NULL, '2025-04-17', NULL, '2025-04-16 09:46:44', '2025-04-16 09:46:44', NULL, '2025-04-16 09:47:02', 4, 2, ''),
(19, 2, 3, 'created', 'pp', NULL, '2025-04-20', NULL, '2025-04-19 06:19:18', '2025-04-19 06:19:18', NULL, NULL, NULL, 2, ''),
(20, 1, 1, 'done', '', 'img/bukti_absen/20_lola_dwi_ferbyantii_2025-04-20.png', '2025-04-20', NULL, '2025-04-20 11:02:59', '2025-04-20 11:04:29', NULL, '2025-04-20 11:03:25', 4, 2, '');

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
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_role`, `username`, `password`, `nama_karyawan`, `jabatan`, `tanggal_lahir`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
(1, 'karyawan', 'Lola', 'Bps3276', 'Lola Dwi Ferbyantii', 'Statistisi Ahli Pertama', '1997-04-13', 'Perempuan', '2025-03-29 07:22:48', '2025-04-19 08:00:44'),
(2, 'admin', 'Perdi', 'Bps3276', 'Perdi irmawan p', 'Statistisi Ahli Muda', '1984-09-26', 'Laki-laki', '2025-03-29 07:25:08', '2025-03-29 07:25:08'),
(3, 'karyawan', 'jati', 'Bps3276', 'Djati', 'Statistik Ahli Pertama', '2000-01-02', 'Laki-laki', '2025-04-05 07:59:05', '2025-04-05 07:59:05'),
(4, 'approver', 'nisa', 'Bps3276', 'Anissa', ' Statistik Ahli Pertama', '1999-02-20', 'Perempuan', '2025-04-05 07:59:41', '2025-04-05 07:59:41'),
(8, 'karyawan', 'arif', 'bps123', 'Arif Syafrudin ', 'Pengolah Data', '1980-08-23', 'Laki-laki', '2025-04-16 08:32:00', '2025-04-16 08:32:00'),
(9, 'karyawan', 'anis', 'bps123', 'Anis Dyah Rahmawati', 'Statistik Ahli Muda', '1980-07-27', 'Perempuan', '2025-04-16 08:34:47', '2025-04-16 08:34:47'),
(10, 'karyawan', 'dinda', 'bps123', 'Dienda syafira', 'Statistik Ahli Muda', '2000-09-26', 'Perempuan', '2025-04-16 09:13:17', '2025-04-16 09:13:17');

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
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
