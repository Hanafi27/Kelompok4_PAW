-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2025 pada 08.30
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
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `vision` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `vision`, `mission`, `image_path`, `created_at`, `updated_at`) VALUES
(3, 'JOKOWI DODO', 'Indonesia emas 2045', 'Hidup Jokowi!!!', 'candidates/sqYnZeZtSQCzZDpEDKttQ7lgMp9t4NwSYK47QBhy.png', '2025-06-05 08:34:09', '2025-06-05 08:34:09'),
(5, 'Anies Baswedan', 'aflksjfjsdlkfjlksdjglkjsdkgjdsgd', 'glfldkgjfdgldfgkfdlkglfdklg;kf;ldg;lfkl;hh', 'candidates/lfmKe11tEO9L7KFzZRkDp2L3OS7aVeY7sZ8dq0ya.png', '2025-06-10 01:29:53', '2025-06-10 01:29:54'),
(6, 'Prabowo', 'djdlksdfjldsfjkdsjfkljdslkfjsdffdsg', 'sdlkaslkdjlsakjlkjaslkfjalsfjkdjlkgjldksjgg', 'candidates/QgNJkm4WkDZ9LOxKhyIGKuwxfV91mTXRnOgjE0fR.png', '2025-06-10 23:25:30', '2025-06-10 23:25:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_07_20_085458_create_candidates_table', 1),
(7, '2024_07_20_085460_create_votes_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$Z0MNMmrKptoYqQaWc2PpDeS41Uq97.rUR8BchfQadtGiCLn/Bpwra', 'admin', NULL, '2025-06-04 21:01:19', '2025-06-04 21:01:19'),
(6, 'lionel andres messi', 'messi@gmail.com', NULL, '$2y$12$AcEkpmjwz72Y/4QhsRorNuCQJbCWWN5A7olV5UL/BY6ijdDucFFp6', 'user', 'uPbs0cmhiBDD0W6vTvLmVTsKWhpY3DQo4glBUvMSPfISHcnPeYhsZgx0NVY3', '2025-06-05 08:07:36', '2025-06-08 11:35:48'),
(8, 'mbappe', 'mbappe@gmail.com', NULL, '$2y$12$Ym4WXMZ6migGHIsmWkq1meVCMivVGn2RPcq9JNP.DVd.H4WXYdi52', 'user', NULL, '2025-06-09 01:00:42', '2025-06-09 01:00:42'),
(9, 'neymar', 'neymar@gmail.com', NULL, '$2y$12$PP/OpbYUhNbuqqsccwZUv.TkoU/bo./50DhKOwyic2Ox9XMJbBI36', 'user', NULL, '2025-06-09 02:05:18', '2025-06-09 02:05:18'),
(10, 'dembele', 'dembele@gmail.com', NULL, '$2y$12$WLubwfHlM6boXvHw/Mnuheo18blSB0EBghyRjI0efd8A3agazDBG6', 'user', NULL, '2025-06-09 07:57:44', '2025-06-09 07:57:44'),
(11, 'bellingham', 'belingham@gmail.com', NULL, '$2y$12$WPzv33kBqwl1NGLy0Y4wr.0xyty6CaupMxG3QcnddNvWx51SYSXPa', 'user', NULL, '2025-06-10 00:19:33', '2025-06-10 00:19:58'),
(12, 'Yamal', 'yamal@gmail.com', NULL, '$2y$12$90Vsgw8linJ97U26JnDAa.dDnO863i96TNEzmUV58lt/8SsiaZsmK', 'user', NULL, '2025-06-10 01:31:50', '2025-06-10 01:31:50'),
(13, 'muller', 'muller@gmail.com', NULL, '$2y$12$d6ly5JHN4dCfWQOvRJZQ0.DR3yXfPtuzSiDhdxAnlWebeJRWtZ1ni', 'user', NULL, '2025-06-10 01:42:09', '2025-06-10 01:42:09'),
(14, 'Kaka', 'kaka@gmail.com', NULL, '$2y$12$F0Hui1ji2SbU1R/RMdaL8u5xb4QawUAUW703rLsPSxKosrIUC0/Im', 'user', NULL, '2025-06-10 23:26:13', '2025-06-10 23:26:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `candidate_id`, `created_at`, `updated_at`) VALUES
(2, 6, 3, '2025-06-05 08:34:24', '2025-06-05 08:34:24'),
(4, 8, 3, '2025-06-09 01:00:51', '2025-06-09 01:00:51'),
(5, 9, 3, '2025-06-09 02:06:15', '2025-06-09 02:06:15'),
(6, 10, 3, '2025-06-09 07:57:53', '2025-06-09 07:57:53'),
(7, 11, 3, '2025-06-10 00:20:05', '2025-06-10 00:20:05'),
(8, 12, 5, '2025-06-10 01:36:48', '2025-06-10 01:36:48'),
(9, 13, 5, '2025-06-10 01:43:02', '2025-06-10 01:43:02'),
(10, 14, 6, '2025-06-10 23:26:24', '2025-06-10 23:26:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes_user_id_foreign` (`user_id`),
  ADD KEY `votes_candidate_id_foreign` (`candidate_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
