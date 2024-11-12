-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Sep 2024 pada 15.06
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
-- Database: `rbo`
--

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
-- Struktur dari tabel `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rincian_indikator_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  `penanggung_jawab` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriterias`
--

INSERT INTO `kriterias` (`id`, `rincian_indikator_id`, `kriteria`, `penanggung_jawab`, `created_at`, `updated_at`) VALUES
(1, 1, 'kriteria 1', 'pj 1', '2024-08-19 02:35:43', '2024-08-19 02:35:43'),
(2, 1, 'kriteria 2', 'pj 2', '2024-08-19 02:35:43', '2024-08-19 02:35:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_details`
--

CREATE TABLE `kriteria_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `proses` text NOT NULL,
  `skor` text NOT NULL,
  `bukti` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriteria_details`
--

INSERT INTO `kriteria_details` (`id`, `kriteria_id`, `proses`, `skor`, `bukti`, `created_at`, `updated_at`) VALUES
(1, 1, 'proses', '0.00', 'public/upload/bukti/mencoba', NULL, NULL),
(2, 2, 'proses 2.1', '0.00', 'public/upload/bukti/tidak ada', NULL, NULL),
(3, 2, 'proses 2.2', '0.90', 'public/upload/bukti/default_filename', NULL, NULL);

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
(6, '2024_07_22_072407_create_tabel_data', 1),
(7, '2024_07_22_072416_create_tabel_rincian_indikator', 1),
(8, '2024_07_30_074013_create_permission_tables', 1),
(9, '2024_08_02_015531_create_kriterias_table', 1),
(10, '2024_08_12_024440_create_kriteria_details_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

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
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'roles.index', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(2, 'roles.create', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(3, 'roles.store', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(4, 'roles.show', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(5, 'roles.edit', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(6, 'roles.update', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(7, 'roles.destroy', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(8, 'permissions.index', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(9, 'permissions.create', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(10, 'permissions.store', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(11, 'permissions.show', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(12, 'permissions.edit', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(13, 'permissions.update', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(14, 'permissions.destroy', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(15, 'users.index', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(16, 'users.create', 'web', '2024-08-19 02:28:39', '2024-08-19 02:28:39'),
(17, 'users.store', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(18, 'users.show', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(19, 'users.edit', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(20, 'users.update', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(21, 'users.destroy', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(22, 'data.index', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(23, 'data.view', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(24, 'data.show', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(25, 'data.store', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(26, 'data.create', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(27, 'data.edit', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(28, 'data.delete', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(29, 'file.show', 'web', '2024-08-31 01:33:18', '2024-08-31 01:33:18');

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
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-08-19 02:28:40', '2024-08-19 02:28:40'),
(2, 'user', 'web', '2024-08-19 02:28:41', '2024-08-19 02:28:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(29, 1),
(29, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_data`
--

CREATE TABLE `tabel_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang_kerja` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `penjelasan` text NOT NULL,
  `indikator` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tabel_data`
--

INSERT INTO `tabel_data` (`id`, `bidang_kerja`, `tujuan`, `penjelasan`, `indikator`, `text`, `created_at`, `updated_at`) VALUES
(1, 'bidang kinerja', 'tujuan', 'penjelasan', 'indikator', 'mencoba', '2024-08-19 02:35:43', '2024-08-19 02:35:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_rincian_indikator`
--

CREATE TABLE `tabel_rincian_indikator` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tabel_data_id` bigint(20) UNSIGNED NOT NULL,
  `rincian_indikator` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tabel_rincian_indikator`
--

INSERT INTO `tabel_rincian_indikator` (`id`, `tabel_data_id`, `rincian_indikator`, `created_at`, `updated_at`) VALUES
(1, 1, 'rincian 1', '2024-08-19 02:35:43', '2024-08-19 02:35:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$10$rL8eHyQYqSQnLk6uqPjtzOoDoL6LgGv8SApMburIhvin2IqKTBg0a', NULL, '2024-08-19 02:28:41', '2024-08-19 02:28:41'),
(2, 'User', 'user@gmail.com', 'user', NULL, '$2y$10$8fUbWIyZIT631d87f8eIZuH6fVukfkOpcKAg/ngRfoeJQvNYgxC7O', NULL, '2024-08-19 02:28:41', '2024-08-19 02:28:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriterias_rincian_indikator_id_foreign` (`rincian_indikator_id`);

--
-- Indeks untuk tabel `kriteria_details`
--
ALTER TABLE `kriteria_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_details_kriteria_id_foreign` (`kriteria_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `tabel_data`
--
ALTER TABLE `tabel_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabel_rincian_indikator`
--
ALTER TABLE `tabel_rincian_indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tabel_rincian_indikator_tabel_data_id_foreign` (`tabel_data_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `kriteria_details`
--
ALTER TABLE `kriteria_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tabel_data`
--
ALTER TABLE `tabel_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tabel_rincian_indikator`
--
ALTER TABLE `tabel_rincian_indikator`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD CONSTRAINT `kriterias_rincian_indikator_id_foreign` FOREIGN KEY (`rincian_indikator_id`) REFERENCES `tabel_rincian_indikator` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria_details`
--
ALTER TABLE `kriteria_details`
  ADD CONSTRAINT `kriteria_details_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabel_rincian_indikator`
--
ALTER TABLE `tabel_rincian_indikator`
  ADD CONSTRAINT `tabel_rincian_indikator_tabel_data_id_foreign` FOREIGN KEY (`tabel_data_id`) REFERENCES `tabel_data` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
