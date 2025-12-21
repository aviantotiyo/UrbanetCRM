-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 21 Des 2025 pada 03.07
-- Versi server: 5.7.39
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_categories`
--

CREATE TABLE `data_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_categories`
--

INSERT INTO `data_categories` (`id`, `kode_kategori`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
('019b34ed-3559-70e0-ac24-0668847d2eb3', 'IT-123', 'Router', 'router xpn dan gpon', '2025-12-19 04:45:19', '2025-12-19 04:45:19', NULL),
('019b34ee-a4a7-7326-96f8-9422e0591386', 'IT-77', 'Kabel', 'kabel dropcore', '2025-12-19 04:46:53', '2025-12-19 04:46:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_warehouses`
--

CREATE TABLE `data_warehouses` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_gudang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gudang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci,
  `jenis` enum('internal','personal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_warehouses`
--

INSERT INTO `data_warehouses` (`id`, `kode_gudang`, `nama_gudang`, `lokasi`, `jenis`, `created_at`, `updated_at`) VALUES
('019b27d2-f23d-7000-a12f-40cbeaedb4e2', 'TX-ABC', 'Gudang A', 'jawa timur', 'internal', '2025-12-16 15:41:34', '2025-12-16 15:57:47'),
('019b27e3-e4c9-709f-abc8-14639c4e1147', 'TX-ABCD', 'Gudang B', 'Jawa tengah', 'internal', '2025-12-16 16:00:05', '2025-12-16 16:00:05'),
('019b2ae4-124a-7324-ba71-f39483d8e07b', 'TX-ABC1', 'Gudang POP Driyorejo 1A', 'Jalan Mekar sari RT4/45', 'internal', '2025-12-17 05:59:08', '2025-12-17 06:20:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_16_221545_create_data_warehouses_table', 1),
(2, '2025_12_19_110618_create_data_categories_table', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_categories`
--
ALTER TABLE `data_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_categories_kode_kategori_unique` (`kode_kategori`);

--
-- Indeks untuk tabel `data_warehouses`
--
ALTER TABLE `data_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_warehouses_kode_gudang_unique` (`kode_gudang`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
