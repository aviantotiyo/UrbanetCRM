-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2026 pada 08.22
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
-- Database: `urbanet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('urbanet-cache-illuminate:queue:restart', 'i:1763946356;', 2079306356),
('urbanet-cache-login:ddc4ffcb055f09b3d9a8dccf4c6034bd9e15fa4b', 'i:1;', 1766286946),
('urbanet-cache-login:ddc4ffcb055f09b3d9a8dccf4c6034bd9e15fa4b:timer', 'i:1766286946;', 1766286946),
('urbanet-cache-tripay_payment_channels', 'a:7:{i:0;a:13:{s:5:\"group\";s:15:\"Virtual Account\";s:4:\"code\";s:5:\"BNIVA\";s:4:\"name\";s:19:\"BNI Virtual Account\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";i:0;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";s:4:\"0.00\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:10000;s:14:\"maximum_amount\";i:10000000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/n22Qsh8jMa1583433577.png\";s:6:\"active\";b:1;}i:1;a:13:{s:5:\"group\";s:15:\"Virtual Account\";s:4:\"code\";s:5:\"BRIVA\";s:4:\"name\";s:19:\"BRI Virtual Account\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";i:0;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";s:4:\"0.00\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:10000;s:14:\"maximum_amount\";i:10000000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/8WQ3APST5s1579461828.png\";s:6:\"active\";b:1;}i:2;a:13:{s:5:\"group\";s:15:\"Virtual Account\";s:4:\"code\";s:9:\"MANDIRIVA\";s:4:\"name\";s:23:\"Mandiri Virtual Account\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";i:0;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";s:4:\"0.00\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:10000;s:14:\"maximum_amount\";i:10000000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/T9Z012UE331583531536.png\";s:6:\"active\";b:1;}i:3;a:13:{s:5:\"group\";s:15:\"Virtual Account\";s:4:\"code\";s:5:\"BCAVA\";s:4:\"name\";s:19:\"BCA Virtual Account\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:5500;s:7:\"percent\";i:0;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:5500;s:7:\"percent\";s:4:\"0.00\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:10000;s:14:\"maximum_amount\";i:10000000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/ytBKvaleGy1605201833.png\";s:6:\"active\";b:1;}i:4;a:13:{s:5:\"group\";s:15:\"Virtual Account\";s:4:\"code\";s:5:\"BSIVA\";s:4:\"name\";s:19:\"BSI Virtual Account\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";i:0;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:4250;s:7:\"percent\";s:4:\"0.00\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:10000;s:14:\"maximum_amount\";i:10000000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/tEclz5Assb1643375216.png\";s:6:\"active\";b:1;}i:5;a:13:{s:5:\"group\";s:17:\"Convenience Store\";s:4:\"code\";s:9:\"INDOMARET\";s:4:\"name\";s:9:\"Indomaret\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:3500;s:7:\"percent\";i:0;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:3500;s:7:\"percent\";s:4:\"0.00\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:10000;s:14:\"maximum_amount\";i:2500000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/zNzuO5AuLw1583513974.png\";s:6:\"active\";b:1;}i:6;a:13:{s:5:\"group\";s:8:\"E-Wallet\";s:4:\"code\";s:5:\"QRIS2\";s:4:\"name\";s:4:\"QRIS\";s:4:\"type\";s:6:\"direct\";s:12:\"fee_merchant\";a:2:{s:4:\"flat\";i:0;s:7:\"percent\";i:0;}s:12:\"fee_customer\";a:2:{s:4:\"flat\";i:750;s:7:\"percent\";d:0.7;}s:9:\"total_fee\";a:2:{s:4:\"flat\";i:750;s:7:\"percent\";s:4:\"0.70\";}s:11:\"minimum_fee\";N;s:11:\"maximum_fee\";N;s:14:\"minimum_amount\";i:1000;s:14:\"maximum_amount\";i:5000000;s:8:\"icon_url\";s:72:\"https://assets.tripay.co.id/upload/payment-icon/8ewGzP6SWe1649667701.png\";s:6:\"active\";b:1;}}', 1763724694);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_bank_manual`
--

CREATE TABLE `data_bank_manual` (
  `id` char(36) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_bank_manual`
--

INSERT INTO `data_bank_manual` (`id`, `nama_bank`, `nama_pic`, `no_rek`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1596d65a-c069-11f0-9d1c-782bcbb73c12', 'BCA', 'Tiyo Avianto', '114445522', 'active', '2025-11-13 08:15:38', '2025-11-13 08:15:38', NULL),
('1596f720-c069-11f0-9d1c-782bcbb73c12', 'BRI', 'Tiyo Avianto', '336699887744', 'active', '2025-11-13 08:15:38', '2025-11-13 08:15:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_billing`
--

CREATE TABLE `data_billing` (
  `id` char(36) NOT NULL,
  `client_id` char(36) NOT NULL,
  `new_member` tinyint(1) NOT NULL DEFAULT 0,
  `reference` varchar(255) DEFAULT NULL,
  `merchant_ref` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_name` varchar(255) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `fee_merchant` varchar(255) DEFAULT NULL,
  `fee_customer` varchar(255) DEFAULT NULL,
  `amount_received` varchar(255) DEFAULT NULL,
  `pay_code` varchar(255) DEFAULT NULL,
  `qr_url` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `expired_time` varchar(255) DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `after_tax` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `billing_create` datetime NOT NULL,
  `billing_paid` datetime DEFAULT NULL,
  `kode_unik` int(11) DEFAULT NULL,
  `bank_name_manual` varchar(255) DEFAULT NULL,
  `exp_tx_bank` datetime DEFAULT NULL,
  `partner_id` char(36) DEFAULT NULL,
  `bank_check` varchar(255) DEFAULT NULL,
  `message_count` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_billing`
--

INSERT INTO `data_billing` (`id`, `client_id`, `new_member`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `total_amount`, `point`, `fee_merchant`, `fee_customer`, `amount_received`, `pay_code`, `qr_url`, `status`, `expired_time`, `instructions`, `after_tax`, `tax`, `billing_create`, `billing_paid`, `kode_unik`, `bank_name_manual`, `exp_tx_bank`, `partner_id`, `bank_check`, `message_count`, `deleted_at`, `created_at`, `updated_at`) VALUES
('019a2ac5-65fc-722b-8d4f-bfe156071e80', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', 1, NULL, 'INV-610L62JU', 'Bayar Manual', 'Bayar Manual', 42099, NULL, '0', '0', '42099', NULL, NULL, 'PAID', NULL, NULL, 37468, 4631, '2025-10-28 19:22:51', '2025-10-29 10:14:09', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-10-28 12:22:51', '2025-10-29 03:14:09'),
('019a2b69-8018-7389-991f-70072a3b5ede', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 1, NULL, 'INV-49GE48RL', 'Bayar Manual', 'Bayar Manual', 19355, NULL, '0', '0', '19355', NULL, NULL, 'PAID', NULL, NULL, 17226, 2129, '2025-10-28 22:22:05', '2025-10-30 05:06:21', NULL, NULL, NULL, NULL, NULL, 0, '2025-10-29 22:46:20', '2025-10-28 15:22:05', '2025-10-29 22:46:20'),
('019a402d-02e8-7227-bd43-2b5b8b7d0a78', '019a3d59-f090-701a-b9b3-ebcffadda253', 1, 'DEV-T1549309449P6KUR', 'INV-83VO92FY', 'BNIVA', 'BNI Virtual Account', 257834, 2000, NULL, '4250', '253584', '565816560228638', NULL, 'UNPAID', '2025-11-19 00:45:58', '[{\"title\":\"Wondr By BNI\",\"steps\":[\"Buka Aplikasi Wondr By BNI\",\"Pilih menu <b>Virtual Account<\\/b>\",\"Pilih <b>Tujuan Baru<\\/b>\",\"Masukkan Nomor <b>Virtual Account<\\/b>\",\"Klik tombol <b>Lanjut<\\/b>\",\"Akan ditampikan detail transaksi, Pilih rekening sumber dana\",\"Klik tombol <b>Lanjut<\\/b>\",\"Pastikan semua informasi sudah sesuai kemudian klik <b>Transaksi Sekarang<\\/b>\",\"Masukan PIN Anda\",\"Transaksi selesai, simpan bukti pembayaran Anda\"]},{\"title\":\"Internet Banking\",\"steps\":[\"Login ke internet banking Bank BNI Anda\",\"Pilih menu <b>Transaksi<\\/b> lalu klik menu <b>Virtual Account Billing<\\/b>\",\"Masukkan Nomor VA (<b>565816560228638<\\/b>) lalu pilih <b>Rekening Debit<\\/b>\",\"Detail transaksi akan ditampilkan, pastikan data sudah sesuai\",\"Masukkan respon key BNI appli 2\",\"Transaksi sukses, simpan bukti transaksi Anda\"]},{\"title\":\"ATM BNI\",\"steps\":[\"Masukkan kartu Anda\",\"Pilih Bahasa\",\"Masukkan PIN ATM Anda\",\"Kemudian, pilih <b>Menu Lainnya<\\/b>\",\"Pilih <b>Transfer<\\/b> dan pilih jenis rekening yang akan digunakan (Contoh: Dari rekening Tabungan)\",\"Pilih <b>Virtual Account Billing<\\/b>. Masukkan Nomor VA (<b>565816560228638<\\/b>)\",\"Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi\",\"Konfirmasi, apabila telah selesai, lanjutkan transaksi\",\"Transaksi Anda telah selesai\"]},{\"title\":\"Mobile Banking BNI\",\"steps\":[\"Akses BNI Mobile Banking dari handphone kemudian masukkan <b>User ID dan Password<\\/b>\",\"Pilih menu <b>Transfer<\\/b>\",\"Pilih menu <b>Virtual Account Billing<\\/b> kemudian pilih rekening debet\",\"Masukkan Nomor <b>Virtual Account<\\/b>\",\"Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi\",\"Konfirmasi transaksi dan masukkan Password Transaksi\",\"Pembayaran Anda Telah Berhasil\"]}]', NULL, NULL, '2025-11-01 23:08:03', '2025-11-02 12:05:44', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-11-01 16:08:03', '2025-11-18 00:47:00'),
('019a439d-9cc9-73f8-8d13-2719d923330e', '019a021c-48d4-7068-9596-04d59c9357b9', 0, NULL, 'INV-23UH56WT', 'MITRA', 'MITRA', 198895, NULL, '3500', NULL, '198834', NULL, NULL, 'UNPAID', '2025-11-15 02:52:29', NULL, 176962, 21872, '2025-10-19 15:09:54', NULL, 61, 'BCA', '2025-11-21 08:49:31', '91bacb70-4335-42ec-ac77-ad04cde78ae2', '1', 4, NULL, '2025-11-02 08:09:54', '2025-11-21 02:46:58'),
('019a53ea-c425-7127-94a5-e995a254885c', '22253285-4362-42ff-b84d-895ee24bdc62', 1, NULL, 'INV-21VI60WT', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, 'UNPAID', NULL, NULL, NULL, NULL, '2025-11-05 19:08:05', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-11-05 12:08:05', '2025-12-11 01:55:49'),
('019a7116-29ae-7372-92b4-1ed6841cfa8c', '0b295ed1-dd57-482d-a438-bcfb82ff5c6e', 1, NULL, 'INV-334N87RR', 'MITRA-POINT', 'MITRA-POINT', 0, 127167, NULL, NULL, '0', NULL, NULL, 'PAID', NULL, NULL, NULL, NULL, '2025-11-11 11:04:29', '2025-11-14 07:54:35', 0, 'POINT', NULL, 'bcc3e7ff-1882-4fb2-91a5-fea47095a195', NULL, 1, NULL, '2025-11-11 04:04:29', '2025-11-14 00:54:35'),
('019a8f3d-e633-71c6-8d21-d673c0e519b5', 'a84ccd50-71f0-4122-b0d4-c126daeb58f8', 1, NULL, 'INV-60S663EJ', 'MITRA', 'MITRA', 125706, 0, '3500', NULL, '125668', NULL, NULL, 'UNPAID', NULL, NULL, 111845, 13823, '2025-11-17 07:36:29', NULL, 38, 'BCA', '2025-12-06 09:38:12', 'bcc3e7ff-1882-4fb2-91a5-fea47095a195', '1', 3, NULL, '2025-11-17 00:36:29', '2025-12-06 01:38:18'),
('019a99b3-d94e-7043-b703-58a8632523ab', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 1, NULL, 'INV-ILXEPK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UNPAID', NULL, NULL, NULL, NULL, '2025-11-19 08:21:31', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-11-19 01:21:31', '2025-11-19 01:21:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_billing_item`
--

CREATE TABLE `data_billing_item` (
  `id` char(36) NOT NULL,
  `merchant_ref_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `billing_cycle` datetime NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_billing_item`
--

INSERT INTO `data_billing_item` (`id`, `merchant_ref_id`, `sku`, `name`, `amount`, `billing_cycle`, `discount`, `denda`, `created_at`, `updated_at`, `deleted_at`) VALUES
('04b08b7e-b229-4499-860f-3f94100beafb', 'INV-334N87RR', 'home-30', 'Home 30Mbps', 126667, '2025-11-11 11:04:29', 1500, 2000, '2025-11-11 04:04:29', '2025-11-11 04:04:29', NULL),
('13680de5-e68c-4fc6-8c14-a5e3f0bbae48', NULL, NULL, 'Home 20Mbps', 62834, '2025-11-17 14:19:57', NULL, NULL, '2025-11-17 07:19:57', '2025-11-17 07:19:57', NULL),
('18bf41ca-b73f-11f0-88a7-782bcbb73c12', 'INV-83VO92FY', 'home-30', 'Home 30Mbps', 50000, '2025-11-01 17:22:31', 1000, 5000, '2025-11-01 16:22:32', '2025-11-01 16:22:32', NULL),
('2481d7a7-9ea1-49f2-a19a-8db749f303ff', 'INV-23UH56WT', 'home-20', 'Home 20Mbps', 150000, '2025-10-19 15:09:54', 1000, 1500, '2025-10-19 08:09:54', '2025-11-20 12:27:08', NULL),
('2632c0ae-e737-47a5-9b43-cac2d8cc0db6', 'INV-60S663EJ', NULL, 'Home 20Mbps', 62834, '2025-11-17 07:40:19', NULL, NULL, '2025-11-17 00:40:19', '2025-11-17 00:40:19', NULL),
('3408ffe9-61b3-405d-a8d3-cabf978ca61d', 'INV-610L62JU', 'home-20', 'Home 20Mbps', 14033, '2025-10-28 19:22:51', NULL, NULL, '2025-10-28 12:22:51', '2025-10-28 12:22:51', NULL),
('45d7a2b0-28fa-434e-bcd1-86925d3806b4', 'INV-21VI60WT', 'home-30', 'Home 30Mbps', 166667, '2025-11-05 19:08:05', NULL, NULL, '2025-11-05 12:08:05', '2025-11-05 12:08:05', NULL),
('47323426-1c01-4b09-9b72-72b6d047fe6e', 'INV-610L62JU', 'home-20', 'Home 20Mbps', 14033, '2025-10-28 19:31:32', NULL, NULL, '2025-10-28 12:31:32', '2025-10-28 12:31:32', NULL),
('56ab7e64-f968-4773-bf45-78b5aaf1ed87', NULL, NULL, 'Home 20Mbps', 62834, '2025-11-17 14:05:58', NULL, NULL, '2025-11-17 07:05:58', '2025-11-17 07:05:58', NULL),
('6ac16a0b-a1c7-4183-94ee-7188d3ad6a9c', NULL, 'home-30', 'Home 30Mbps', 200000, '2025-11-19 07:52:41', NULL, NULL, '2025-11-19 00:52:41', '2025-11-19 00:52:41', NULL),
('6ea9ea0a-6057-4b71-be57-c56fcabc0733', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:39:44', NULL, NULL, '2025-11-05 04:39:44', '2025-11-05 04:39:44', NULL),
('72baa8ed-758f-4dd8-8170-bc00bea503b2', 'INV-49GE48RL', 'home-30', 'Home 30Mbps', 19355, '2025-10-28 22:22:05', NULL, NULL, '2025-10-28 15:22:05', '2025-10-28 15:22:05', NULL),
('75c1b80f-faaf-4a8c-8efd-8373ac2e7027', NULL, 'home-30', 'Home 30Mbps', 200000, '2025-11-17 18:56:41', NULL, NULL, '2025-11-17 11:56:41', '2025-11-17 11:56:41', NULL),
('776856d3-5dcb-4787-8cff-ff9a2c062c52', NULL, 'home-20', 'Home 20Mbps', 53167, '2025-11-20 19:16:33', NULL, NULL, '2025-11-20 12:16:39', '2025-11-20 12:16:39', NULL),
('8966eca4-bb22-4b4d-8279-3338c57d7ed2', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:33:36', NULL, NULL, '2025-11-05 04:33:36', '2025-11-05 04:33:36', NULL),
('8a19aaae-849b-4f93-8343-742c809c39bf', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:49:51', NULL, NULL, '2025-11-05 04:49:51', '2025-11-05 04:49:51', NULL),
('8d45a48b-e44f-4e86-95ce-f5663278dd82', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 18:19:47', NULL, NULL, '2025-11-05 11:19:47', '2025-11-05 11:19:47', NULL),
('9233a036-64e0-4560-a52d-c349a8ae49ce', 'INV-23UH56WT', 'home-20', 'Home 20Mbps', 48334, '2025-11-20 21:54:57', NULL, NULL, '2025-11-20 14:54:57', '2025-11-20 22:29:55', NULL),
('a904eca5-cd04-4bfe-a41c-8d23a2f2548b', 'INV-60S663EJ', NULL, 'Home 20Mbps', 62834, '2025-11-17 07:36:29', NULL, NULL, '2025-11-17 00:36:29', '2025-11-17 00:36:29', NULL),
('afe613f5-64a2-4dad-9f12-ce6a0283589d', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:27:46', NULL, NULL, '2025-11-05 04:27:46', '2025-11-05 04:27:46', NULL),
('bb63bb9a-c1b8-4d0c-9716-9910e2e9a506', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:52:41', NULL, NULL, '2025-11-05 04:52:41', '2025-11-05 04:52:41', NULL),
('c8ba1e12-6c7b-4621-93d3-f3fc77abc727', 'INV-83VO92FY', 'home-30', 'Home 30Mbps', 193334, '2025-10-04 23:08:03', 1000, 5000, '2025-11-01 16:08:03', '2025-11-01 16:08:03', NULL),
('cfb1caed-039a-4fa3-a751-87057546cdd3', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:45:51', NULL, NULL, '2025-11-05 04:45:51', '2025-11-05 04:45:51', NULL),
('d171dcdb-daf9-477c-bf54-e2f71eee20b4', NULL, NULL, 'Home 20Mbps', 62834, '2025-11-17 14:15:46', NULL, NULL, '2025-11-17 07:15:46', '2025-11-17 07:15:46', NULL),
('d1ebf265-1e47-4fbb-bd86-b46d93d53254', 'INV-ILXEPK', 'home-30', 'Home 30Mbps', 46667, '2025-11-23 15:52:48', NULL, NULL, '2025-11-23 08:52:48', '2025-11-23 08:52:48', NULL),
('d5594ab5-2cff-4939-bf40-aab91690d9aa', 'INV-610L62JU', 'home-20', 'Home 20Mbps', 14033, '2025-10-28 19:35:20', NULL, NULL, '2025-10-28 12:35:20', '2025-10-28 12:35:20', NULL),
('d5b4a502-3545-4638-b645-545bf89e565b', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:40:40', NULL, NULL, '2025-11-05 04:40:40', '2025-11-05 04:40:40', NULL),
('e04a1e65-dc1a-4fdc-bb02-80a6b10de625', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:47:53', NULL, NULL, '2025-11-05 04:47:53', '2025-11-05 04:47:53', NULL),
('eefeb99b-58a9-4e3e-9025-6341b5598139', NULL, 'home-30', 'Home 30Mbps', 166667, '2025-11-05 11:22:16', NULL, NULL, '2025-11-05 04:22:16', '2025-11-05 04:22:16', NULL),
('fde3b112-80de-44e2-8c33-b9bfa8d6b624', NULL, 'home-30', 'Home 30Mbps', 86667, '2025-11-17 14:25:01', NULL, NULL, '2025-11-17 07:25:01', '2025-11-17 07:25:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_billing_log`
--

CREATE TABLE `data_billing_log` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `client_id` char(36) NOT NULL,
  `merchant_ref_id` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_billing_log`
--

INSERT INTO `data_billing_log` (`id`, `user_id`, `client_id`, `merchant_ref_id`, `status`, `created_at`, `updated_at`) VALUES
('019a31fc-b99a-7255-ab59-d013571b328c', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'INV-49GE48RL', 'Pembayaran manual berhasil dilakukan oleh System Admin untuk tagihan INV-49GE48RL', '2025-10-29 22:00:37', '2025-10-29 22:00:37'),
('019a3201-fa69-72d3-876c-839207b3f0ff', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'INV-49GE48RL', 'Pembayaran manual berhasil dilakukan oleh System Admin untuk tagihan INV-49GE48RL', '2025-10-29 22:06:21', '2025-10-29 22:06:21'),
('019a3226-92f8-73c4-af80-b675b1c45cea', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'INV-49GE48RL', 'Tagihan INV-49GE48RL dihapus oleh System Admin', '2025-10-29 22:46:20', '2025-10-29 22:46:20'),
('019b0b17-fc38-7176-849a-66ebde090fec', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '22253285-4362-42ff-b84d-895ee24bdc62', 'INV-21VI60WT', 'Pembayaran manual berhasil dilakukan oleh System Admin untuk tagihan INV-21VI60WT', '2025-12-11 01:47:59', '2025-12-11 01:47:59'),
('019b0b1f-256d-710e-9a47-644e598726ad', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '22253285-4362-42ff-b84d-895ee24bdc62', 'INV-21VI60WT', 'Tagihan INV-21VI60WT dihapus oleh System Admin', '2025-12-11 01:55:49', '2025-12-11 01:55:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_clients`
--

CREATE TABLE `data_clients` (
  `id` char(36) NOT NULL,
  `nopel` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `loc_client` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `tagihan` varchar(255) DEFAULT NULL,
  `promo_day` int(11) DEFAULT NULL,
  `promo_day_start` datetime DEFAULT NULL,
  `promo_day_end` datetime DEFAULT NULL,
  `status_promo` tinyint(1) NOT NULL DEFAULT 0,
  `user_pppoe` varchar(255) NOT NULL,
  `pass_pppoe` varchar(255) NOT NULL,
  `name_profile` varchar(255) DEFAULT NULL,
  `limit_radius` varchar(255) DEFAULT NULL,
  `odp_id` char(36) DEFAULT NULL,
  `odp_port_id` char(36) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `active_user` datetime DEFAULT NULL,
  `status` enum('active','isolir','suspend','inactive','booking') NOT NULL DEFAULT 'booking',
  `note` text DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `foto_depan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_clients`
--

INSERT INTO `data_clients` (`id`, `nopel`, `nama`, `no_hp`, `email`, `nik`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `loc_client`, `lat`, `long`, `paket`, `tagihan`, `promo_day`, `promo_day_start`, `promo_day_end`, `status_promo`, `user_pppoe`, `pass_pppoe`, `name_profile`, `limit_radius`, `odp_id`, `odp_port_id`, `tag`, `active_user`, `status`, `note`, `point`, `foto_depan`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0199fab2-d664-7063-a76a-dda899f5a407', 'PYF-21526299', 'Budi Raharjo', '08123456789', NULL, '12345678', 'Perumahan Griya Karya Sejahtera Blok 56', 'PANTI', 'KABUPATEN JEMBER', 'JAWA TIMUR', '-6.123.123456', NULL, NULL, 'home 20', '25000', NULL, NULL, NULL, 0, 'PYF-21526299', '302533', NULL, NULL, NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-10-18 21:20:48', '2025-10-18 21:20:48', NULL),
('0199fabd-7863-7040-ae5e-cd770a627af3', 'ID54337005', 'Bayu Aji Wicaksono', '62812345678', NULL, '1234124', 'Jln Puntodewo 230 RT/RW 01/03 Desa Ngadiyoto', 'PANTI', 'KABUPATEN JEMBER', 'JAWA TIMUR', '65.2454.2354', NULL, NULL, '10Mbps', '100000', NULL, NULL, NULL, 0, 'ID54337005', '546646', 'home20', '10M/10M', NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-10-18 21:32:25', '2025-10-18 21:32:25', NULL),
('0199fbbb-279f-734a-b796-ff5db01a2ef2', 'ID24020261', 'Dani Budi Wiyoto', '08123456777', NULL, '123456794563', 'Perumahan Krian Indah', 'PANTI', 'KABUPATEN JEMBER', 'JAWA TIMUR', '-5623.2356', NULL, NULL, 'Home 20Mb', '25000', NULL, NULL, NULL, 0, 'ID24020261', '341430', 'home-20mb', '20M/20M', NULL, NULL, NULL, NULL, 'inactive', NULL, NULL, NULL, '2025-10-19 02:09:30', '2025-10-27 04:08:33', '2025-10-27 04:08:33'),
('019a00fc-13f3-73b3-9d6a-5451252fab51', 'ID27336642', 'Jauhari Ahmad Fatoni', '62812345678', NULL, '1234567891234567', 'Jalan Raya Musi Duhwa Rt05 Rw09', 'DOLOPO', 'KABUPATEN MADIUN', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 30Mbps', '200000', NULL, NULL, NULL, 0, 'ID27336642', '275361', 'home-30', '30M/30M', NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-10-20 02:38:31', '2025-10-20 02:38:31', NULL),
('019a00fe-af77-736a-b598-9c6e6acabbf2', 'ID49329835', 'Rahayu Wilujeng Asri', '628564788411', 'rahayu@gmail.com', '2345124571450001', 'Perumahan Krian Indah Blok 6/2', 'RANUYOSO', 'KABUPATEN LUMAJANG', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', NULL, NULL, 'Home 20Mbps', '145000', NULL, NULL, NULL, 0, 'ID49329835', '675751', 'home-20', '20M/20M', NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-10-20 02:41:22', '2025-10-20 02:41:22', NULL),
('019a0106-5b0c-7374-8515-86978dd6bdb4', 'ID22895204', 'Agus Jaya Renjana', '62812457784', 'agus@gmail.com', '5689123487845111', 'Jalan Rahasia Rt5 Rw8', 'TANJUNGANOM', 'KABUPATEN NGANJUK', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', NULL, NULL, 'Home 20Mbps', '145000', NULL, NULL, NULL, 0, 'ID22895204', '852470', 'home-20', '20M/20M', NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-10-20 02:49:45', '2025-10-20 02:49:45', NULL),
('019a0107-badc-7059-83e5-fd1a63141711', 'ID53458766', 'Bayu Wicaksono Jaya', '6281256778541', 'bayu@gmail.com', '4561456784564122', 'Areka Jalan Musi Ampera No 56', 'SUKOMORO', 'KABUPATEN MAGETAN', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', NULL, NULL, 'Home 20Mbps', '145000', NULL, NULL, NULL, 0, 'ID53458766', '412894', 'home-20', '20M/20M', NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-10-20 02:51:15', '2025-10-20 04:53:17', NULL),
('019a021c-48d4-7068-9596-04d59c9357b9', 'ID73286349', 'Cristin Natalia Sari', '6281234400055', 'tiyoavianto@gmail.com', '5689451278235689', 'Jalan Nias Sentosa No 20', 'ROWOKANGKUNG', 'KABUPATEN LUMAJANG', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.123456', '6.1245', 'Home 20Mbps', '145000', 0, '2025-11-02 00:00:00', NULL, 0, 'ID73286349', '595335', 'home-20', '20M/20M', NULL, NULL, NULL, '2025-11-02 15:09:52', 'suspend', NULL, 0, NULL, '2025-10-20 07:53:19', '2025-11-20 03:25:45', NULL),
('019a0224-28fa-72ba-9d2b-6c847149e361', 'ID76102684', 'Dian Nusantoro', '6285674558874', 'dian@gmail.com', '2356457894512345', 'Jalan Kapuas No 5 RT09 RW07', 'MENGANTI', 'KABUPATEN GRESIK', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.4063726', '112.5841074', 'Home 30Mbps', '200000', 0, '2025-10-22 00:00:00', NULL, 0, 'ID76102684', '871803', 'home-30', '30M/30M', NULL, NULL, NULL, '2025-10-22 09:26:01', 'inactive', NULL, NULL, NULL, '2025-10-20 08:01:55', '2025-10-27 04:08:11', '2025-10-27 04:08:11'),
('019a0a2f-3a1d-7338-8ecd-1142899e573a', 'ID28370123', 'Perwira Utama Karya Raya', '6281554477805', 'perwira@gmail.com', '1234567844741222', 'Jalan Nias Merdeka Raya No 45 Rt 04 Rw 06', 'SOOKO', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-1245.454', '112.5841074', 'Home 30Mbps', '200000', 0, '2025-10-28 00:00:00', NULL, 0, 'ID28370123', '647908', 'home-30', '10M/10M 30M/30M 7500K/7500K 24/24 8 1250K/1250K', '0199faf2-9a90-7201-8f13-7d5aaab3e586', '019a09a4-d495-7220-8181-62c61cccb5b6', NULL, '2025-10-28 22:22:04', 'active', NULL, NULL, NULL, '2025-10-22 04:30:58', '2025-10-28 15:22:04', NULL),
('019a0ff8-6782-71e6-ac4f-aec442caa8c1', 'ID32587583', 'Nisa Pratiwisari Mulyana', '6281234578954', 'nisa@gmail.com', '1244785547841211', 'Jalan Arupati Dalam Xi/09 Rt 06 Rw 08 Magersari', 'PARANG', 'KABUPATEN MAGETAN', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.4063726', '112.5841074', 'Home 20Mbps', '145000', 0, '2025-10-28 00:00:00', NULL, 0, 'ID32587583', '865756', 'home-20', '20M/20M', NULL, NULL, NULL, NULL, 'active', NULL, 120000, 'https://is3.cloudhost.id/urbanet-dev/client_photos/foto_depan_51292fe1-7fb4-4587-8d78-d1fb1778ebe5.jpg', '2025-10-23 07:28:49', '2025-11-05 12:08:02', NULL),
('019a3d59-f090-701a-b9b3-ebcffadda253', 'ID01436308', 'Eko Hadi Hery Mulcahyono', '62812344000551', 'mail@mail.com', '1234567844741221', NULL, 'TRAWAS', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 30Mbps', '200000', 0, '2025-11-01 00:00:00', NULL, 0, 'ID01436308', '865475', 'home-30', '10M/10M 30M/30M 7500K/7500K 24/24 8 1250K/1250K', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a402a-cbf7-7066-ac8d-ab3b854d9e1e', NULL, '2025-11-01 23:05:56', 'active', NULL, 0, 'https://is3.cloudhost.id/urbanet-dev/client_photos/foto_depan_369740bf-8e20-467b-961a-c9981d8a4fac.jpg', '2025-11-01 02:58:15', '2025-11-18 00:47:00', NULL),
('0b295ed1-dd57-482d-a438-bcfb82ff5c6e', 'ID38032074', 'Widodo Raharjo', '6281234444777', 'widodo@gmail.com', '1237894567894560', 'Jalan mawar merah 24', 'WONOAYU', 'KABUPATEN SIDOARJO', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 30Mbps', '200000', 0, '2025-11-11 00:00:00', NULL, 0, 'ID38032074', '945154', 'home-30', '10M/10M 30M/30M 7500K/7500K 24/24 8 1250K/1250K', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a523f-d020-73d7-a4e3-3429cfb7a1af', NULL, '2025-11-11 11:04:28', 'active', NULL, 2833, NULL, '2025-11-05 03:18:21', '2025-11-14 00:54:36', NULL),
('22253285-4362-42ff-b84d-895ee24bdc62', 'ID86330369', 'Andi Liu', '628124564544', NULL, '6543216543216544', 'Jauh baget pokoknya', 'TEGALOMBO', 'KABUPATEN PACITAN', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 30Mbps', '200000', 0, '2025-11-10 00:00:00', NULL, 0, 'ID86330369', '069662', 'home-30', '10M/10M 30M/30M 7500K/7500K 24/24 8 1250K/1250K', NULL, NULL, NULL, '2025-11-10 11:09:53', 'inactive', NULL, NULL, NULL, '2025-11-05 12:04:01', '2025-11-17 00:36:01', NULL),
('29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'ID29641338', 'Jauhari Ahmad Image', '6281234400', NULL, '2233144578874454', 'Jalan pucat pasi', 'WONOASRI', 'KABUPATEN MADIUN', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.4063726', '112.5841074', 'Home 30Mbps', '200000', 0, '2025-11-25 00:00:00', NULL, 0, 'ID29641338', '988202', 'home-30', '10M/10M 30M/30M 7500K/7500K 24/24 8 1250K/1250K', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', NULL, '2025-11-25 02:31:42', 'active', NULL, NULL, 'https://is3.cloudhost.id/urbanet-dev/client_photos/foto_depan_fd9747f4-3429-4f5c-b03e-9d0cd8ea8f54.jpg', '2025-11-17 07:24:26', '2025-11-24 19:31:42', NULL),
('5dac9a8b-c077-488b-975b-725737b93f28', 'ID68237864', 'Test Uji Coba', '6285688988', NULL, '3211233211235641', 'test', 'SUKOMORO', 'KABUPATEN MAGETAN', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 20Mbps', '145000', NULL, NULL, NULL, 0, 'ID68237864', '969819', NULL, NULL, NULL, NULL, NULL, NULL, 'booking', NULL, NULL, NULL, '2025-11-10 08:38:20', '2025-11-10 08:38:20', NULL),
('94121b90-ff2d-42cc-9a52-a9daace0c936', 'ID94121B90', 'Jauhari Ahmad', '62856789788', NULL, '9876543219876543', 'Jalan Merdeka Barat No 54 Rt43 Rw43', 'MOJOANYAR', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 20Mbps', '145000', 0, '2025-11-10 00:00:00', NULL, 0, 'ID94121B90', '367632', 'home-20', '20M/20M', NULL, NULL, NULL, '2025-11-10 11:08:55', 'inactive', NULL, NULL, NULL, '2025-11-10 02:36:33', '2025-11-10 04:09:36', NULL),
('a84ccd50-71f0-4122-b0d4-c126daeb58f8', 'ID49101447', 'Tes Ulang', '62812344000558', NULL, '1234567844741229', 'Jalan Durian Panjang 54', 'NGANTANG', 'KABUPATEN MALANG', 'JAWA TIMUR', NULL, NULL, NULL, 'Home 20Mbps', '145000', 0, '2025-11-17 00:00:00', NULL, 0, 'ID49101447', '156406', NULL, NULL, NULL, NULL, NULL, '2025-11-17 07:40:14', 'inactive', NULL, 0, NULL, '2025-11-17 00:14:38', '2025-12-05 23:12:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_clients_partner`
--

CREATE TABLE `data_clients_partner` (
  `id` char(36) NOT NULL,
  `partner_id` char(36) NOT NULL,
  `paket_id` char(36) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `status` enum('pending','process','active','reject') NOT NULL,
  `client_prospect_id` char(36) NOT NULL,
  `fee` int(11) DEFAULT NULL,
  `fee_paid` tinyint(1) NOT NULL DEFAULT 0,
  `fee_date_paid` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_clients_partner`
--

INSERT INTO `data_clients_partner` (`id`, `partner_id`, `paket_id`, `nik`, `nama`, `no_hp`, `email`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `status`, `client_prospect_id`, `fee`, `fee_paid`, `fee_date_paid`, `created_at`, `updated_at`, `deleted_at`) VALUES
('3ad6faaa-02b1-4b08-8594-5e6a0ef19501', '9ca00a5a-c7ca-4ea6-8a87-4585e269e2af', '0199fb3e-c759-72de-96a2-3054ee23e240', '1234567844741229', 'Tes Ulang', '6281234444779', 'tes@gmaill.com', 'Jalan Durian Panjang 54', 'NGANTANG', 'KABUPATEN MALANG', 'JAWA TIMUR', 'active', 'a84ccd50-71f0-4122-b0d4-c126daeb58f8', 25000, 0, NULL, '2025-11-15 17:08:58', '2025-12-10 03:13:29', NULL),
('9ec17038-5793-4295-8627-68b1aec68454', '9ca00a5a-c7ca-4ea6-8a87-4585e269e2af', '0199fb3e-c759-72de-96a2-3054ee23e240', '5050505050505055', 'Dari Mitra', '6288811188888', NULL, 'Jalan Mawar Merah 24', 'MOJOANYAR', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', 'pending', '14bef0b0-6270-49b8-bbe7-606f7a339d04', 0, 0, NULL, '2025-11-15 16:09:40', '2025-12-10 03:13:29', NULL),
('c29bd54b-a7e4-416a-bc05-f1b759b8f94e', '9ca00a5a-c7ca-4ea6-8a87-4585e269e2af', '0199fb40-84cd-704b-a2ae-dab974c79453', '1234567844741223', 'Eko Hadi Hery Mulcahyono 1', '6281234444774', 'eko@gmail.com', 'Jalan Mawar Merah 24', 'SUKOMORO', 'KABUPATEN MAGETAN', 'JAWA TIMUR', 'pending', '20786374-63e9-435f-a3f5-d3bc3401ecc4', 0, 0, NULL, '2025-11-15 17:11:10', '2025-11-16 12:20:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_clients_prospect`
--

CREATE TABLE `data_clients_prospect` (
  `id` char(36) NOT NULL,
  `client_id` char(36) NOT NULL,
  `paket_id` char(36) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','process','active','reject') NOT NULL DEFAULT 'pending',
  `client_prospect_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_clients_prospect`
--

INSERT INTO `data_clients_prospect` (`id`, `client_id`, `paket_id`, `nama`, `nik`, `no_hp`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `point`, `status`, `client_prospect_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('01bebb9c-8f83-4921-8fdc-5da8df82ccbb', '019a021c-48d4-7068-9596-04d59c9357b9', '0199fb3e-c759-72de-96a2-3054ee23e240', 'Test Uji Coba', '3211233211235641', '6285688988', 'test', 'SUKOMORO', 'KABUPATEN MAGETAN', 'JAWA TIMUR', 0, 'process', '5dac9a8b-c077-488b-975b-725737b93f28', '2025-11-10 08:18:21', '2025-11-10 08:38:20', NULL),
('551d8e09-b2d8-4f5e-8752-03b15e11d48a', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', NULL, 'Andi Liu', '6543216543216544', '628124564544', 'Jauh baget pokoknya', 'TEGALOMBO', 'KABUPATEN PACITAN', 'JAWA TIMUR', 0, 'active', '22253285-4362-42ff-b84d-895ee24bdc62', '2025-11-03 08:15:02', '2025-11-05 12:08:02', NULL),
('5969dcfb-cbce-4886-8f25-98f85e64685a', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', NULL, 'Widodo Raharjo', '1237894567894560', '6281234444777', 'Jalan mawar merah 24', 'WONOAYU', 'KABUPATEN SIDOARJO', 'JAWA TIMUR', 0, 'active', '0b295ed1-dd57-482d-a438-bcfb82ff5c6e', '2025-11-03 08:44:44', '2025-11-05 04:49:51', NULL),
('e80419bd-8626-41f4-a1f4-f3083891ffd0', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', NULL, 'bayu wirawan', '12341234', '0812312312', 'jalan mustoko', 'maospati', 'magetan', 'jatim', 0, 'pending', 'c5ed0b78-a206-45ca-a6e2-c5dbc95debe1', '2025-11-03 07:25:51', '2025-11-03 07:25:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_clients_regist`
--

CREATE TABLE `data_clients_regist` (
  `id` char(36) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `paket_id` char(36) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `status` enum('pending','process','active','reject') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_clients_regist`
--

INSERT INTO `data_clients_regist` (`id`, `nik`, `paket_id`, `nama`, `email`, `no_hp`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('367f09cb-6358-496c-84dc-afc109abb494', '4474.1230123', '0199fb3e-c759-72de-96a2-3054ee23e240', 'Eko Hadi Hery Mulcahyono', NULL, '62812344447773', '123', 'MAOSPATI', 'KABUPATEN SIDOARJO', 'BANTEN', 'pending', '2025-11-06 03:30:22', '2025-11-06 03:30:22', NULL),
('94121b90-ff2d-42cc-9a52-a9daace0c936', '9876543219876543', '0199fb3e-c759-72de-96a2-3054ee23e240', 'Jauhari Ahmad', 'mishelmaulana9@gmail.com', '62856789788', 'Jalan Merdeka Barat No 54 Rt43 Rw43', 'MOJOANYAR', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', 'active', '2025-11-10 01:29:31', '2025-11-10 04:08:55', NULL),
('9904080c-15ad-4553-b7c3-9cfba2394305', '0000000000000000', '0199fb40-84cd-704b-a2ae-dab974c79453', 'Eko Hadi Hery Mulcahyono', 'bayu@gmail.com', '6280000000000', 'qwe', 'qwe', 'qwe', 'qwe', 'pending', '2025-11-06 05:00:23', '2025-11-06 09:50:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_clients_sales`
--

CREATE TABLE `data_clients_sales` (
  `id` char(36) NOT NULL,
  `users_id` char(36) NOT NULL,
  `paket_id` char(36) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `status` enum('pending','process','active','reject') NOT NULL DEFAULT 'pending',
  `client_prospect_id` char(36) DEFAULT NULL,
  `loc_client` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `foto_depan` varchar(255) DEFAULT NULL,
  `fee` int(11) NOT NULL DEFAULT 0,
  `fee_paid` tinyint(1) NOT NULL DEFAULT 0,
  `fee_date_paid` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_clients_sales`
--

INSERT INTO `data_clients_sales` (`id`, `users_id`, `paket_id`, `nik`, `nama`, `no_hp`, `email`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `status`, `client_prospect_id`, `loc_client`, `lat`, `long`, `foto_depan`, `fee`, `fee_paid`, `fee_date_paid`, `deleted_at`, `created_at`, `updated_at`) VALUES
('11d9be4c-2766-4864-83bd-3f5c235f384e', '019a2114-3f48-72ab-ba66-dcaec69ccc1b', '0199fb3e-c759-72de-96a2-3054ee23e240', '5648744588779521', 'Bardolo Joyo Kuwumo', '628547784454', 'bardolo@gmail.com', 'Jalan Kapal Api', 'PUNGGING', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', 'pending', '4546a650-e7b4-4bde-bdc0-b904165730c9', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.4063726', '112.5841074', NULL, 0, 0, NULL, NULL, '2025-11-17 08:32:15', '2025-11-17 08:32:15'),
('1a12ffbd-71c8-4137-b60a-5e873797448a', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb3e-c759-72de-96a2-3054ee23e240', '0055005500550050', 'Tes Image S3 Job', '6281245644444', NULL, 'Test', 'TRAWAS', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', 'pending', '8e366496-f0d3-481a-b90b-bf090f94bf27', NULL, NULL, NULL, 'https://is3.cloudhost.id/urbanet-dev/client_photos/foto_depan_7e3952aa-0a85-471d-8106-0bf2f6c82feb.jpg', 0, 0, NULL, NULL, '2025-11-18 02:10:51', '2025-11-18 02:10:56'),
('4ab7c2db-0d0f-4704-814c-ab0d59b1f724', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb3e-c759-72de-96a2-3054ee23e240', '3030303030220330', 'Tes Email Validasi', '628562356855', 'testo@gmail.com', 'jauh', 'TEGALOMBO', 'KABUPATEN PACITAN', 'JAWA TIMUR', 'pending', '56e66308-8c79-4a94-9a44-a33e14bda45a', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-11-17 09:07:24', '2025-11-17 09:07:24'),
('510a3abd-783a-42e5-a49a-8d1c6c21e7ad', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb3e-c759-72de-96a2-3054ee23e240', '123456', 'Tes Email', '08124', 'mail@mail.com', 'jauh', 'MAOSPATI', 'KABUPATEN SIDOARJO', 'JAWA TIMUR', 'pending', 'a9304534-d9ea-438b-b3c3-adb8a571be3d', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-11-17 02:15:32', '2025-11-17 02:15:32'),
('59ddb016-8ad1-48a0-92fa-c1c8a2047053', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb40-84cd-704b-a2ae-dab974c79453', '2233144578874454', 'Jauhari Ahmad Image', '6284544547', 'image@gmail.com', 'Jalan pucat pasi', 'WONOASRI', 'KABUPATEN MADIUN', 'JAWA TIMUR', 'active', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.4063726', '112.5841074', 'https://is3.cloudhost.id/urbanet-dev/client_photos/foto_depan_fd9747f4-3429-4f5c-b03e-9d0cd8ea8f54.jpg', 50000, 1, '2025-12-09 11:44:14', NULL, '2025-11-17 06:36:21', '2025-12-09 04:44:14'),
('8b45f446-c72e-4223-a43e-2f013c31a320', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb3e-c759-72de-96a2-3054ee23e240', '1010100101010101', 'Tes Image S3', '628222110011', NULL, 'jauh baget', 'TEGALOMBO', 'KABUPATEN PACITAN', 'JAWA TIMUR', 'active', 'e7a4aa08-c263-49f2-bf0c-9e5993d28827', NULL, NULL, NULL, 'https://is3.cloudhost.id/urbanet-dev/client_photos/foto_depan_93c4ecf1-c9d2-468e-add0-fab139d221ad.jpg', 50000, 0, NULL, NULL, '2025-11-17 08:53:00', '2025-12-09 04:44:14'),
('92ffc68e-8d4e-43c6-9033-e577a80d8946', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb40-84cd-704b-a2ae-dab974c79453', '1234567844741228', 'Widodo Raharjo', '6281245645410', NULL, 'jalan gajar maha', 'NGUNTORONADI', 'KABUPATEN MAGETAN', 'JAWA TIMUR', 'pending', 'd7f98bd4-dbf3-4f0d-af85-1f2cd32b19c2', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-11-17 03:34:02', '2025-11-17 05:13:11'),
('f9935b0f-478a-476c-b1f7-54389c6e10ee', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fb3e-c759-72de-96a2-3054ee23e240', '1234456789', 'Andi Cu', '081234564', NULL, 'jauh', 'MAOSPATI', 'KABUPATEN SIDOARJO', 'JAWA TIMUR', 'pending', '1dae43a3-000b-49eb-ba3e-5bbc99ef6fd7', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-11-17 01:52:08', '2025-11-17 01:52:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_client_logs`
--

CREATE TABLE `data_client_logs` (
  `id` char(36) NOT NULL,
  `users_id` char(36) NOT NULL,
  `client_id` char(36) NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_client_logs`
--

INSERT INTO `data_client_logs` (`id`, `users_id`, `client_id`, `status`, `created_at`, `updated_at`) VALUES
('019a09bc-ddbd-7056-b24e-6ef895962105', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0224-28fa-72ba-9d2b-6c847149e361', 'User System Admin telah menambahkan relasi ODP(ODP.R.TH.01)/Port(A1) dari Client (Dian Nusantoro)', '2025-10-22 02:26:03', '2025-10-22 02:26:03'),
('019a0a2f-3a35-7157-8372-78a05e7e4240', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'User System Admin telah menambahkan pelanggan baru (Perwira Utama Abadi) dengan NOPel ID28370123', '2025-10-22 04:30:58', '2025-10-22 04:30:58'),
('019a0a33-787b-719b-b3b3-1b967e5e7822', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'User System Admin telah memperbarui data pelanggan (Perwira Utama Wijaya). Field diubah: nama, no_hp', '2025-10-22 04:35:36', '2025-10-22 04:35:36'),
('019a0a37-6845-703d-bcbc-a1b9ef245c59', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'User System Admin telah memperbarui data pelanggan (Perwira Utama Karya - ID28370123). Field diubah: nama, no_hp', '2025-10-22 04:39:54', '2025-10-22 04:39:54'),
('019a0ff8-682b-73e0-b381-5861b91e303a', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', 'User System Admin telah menambahkan pelanggan baru (Nisa Pratiwisari Mulyana) dengan NOPel ID32587583', '2025-10-23 07:28:49', '2025-10-23 07:28:49'),
('019a23ad-a25e-7001-a586-35b9e7d606f3', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0224-28fa-72ba-9d2b-6c847149e361', 'User System Admin telah meng-isolir Client (Dian Nusantoro)', '2025-10-27 03:19:33', '2025-10-27 03:19:33'),
('019a23b0-8411-7315-b7be-4a2df248ad00', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0224-28fa-72ba-9d2b-6c847149e361', 'User System Admin telah membuka isolir Client (Dian Nusantoro)', '2025-10-27 03:22:42', '2025-10-27 03:22:42'),
('019a23d8-b2b5-71e3-887c-015136b33b5b', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'User System Admin telah menonaktifkan client (Perwira Utama Karya) dan menghapus relasi ODP/Port', '2025-10-27 04:06:35', '2025-10-27 04:06:35'),
('019a23da-2abc-70db-9de8-8906e263123d', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0224-28fa-72ba-9d2b-6c847149e361', 'User System Admin telah menonaktifkan client (Dian Nusantoro) dan menghapus relasi ODP/Port', '2025-10-27 04:08:11', '2025-10-27 04:08:11'),
('019a23da-81a5-70f0-966c-a2293a36773b', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '0199fbbb-279f-734a-b796-ff5db01a2ef2', 'User System Admin telah menonaktifkan client (Dani Budi Wiyoto) dan menghapus relasi ODP/Port', '2025-10-27 04:08:33', '2025-10-27 04:08:33'),
('019a24f0-b86a-73d3-8ce4-5b449db9f20d', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a0a2f-3a1d-7338-8ecd-1142899e573a', 'User System Admin telah memperbarui data pelanggan (Perwira Utama Karya Raya - ID28370123). Field diubah: nama, limit_radius', '2025-10-27 09:12:26', '2025-10-27 09:12:26'),
('019a3d59-f107-7269-8043-3ad79296ae35', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a3d59-f090-701a-b9b3-ebcffadda253', 'User System Admin telah menambahkan pelanggan baru (Eko Hadi Hery Mulcahyono) dengan NOPel ID01436308', '2025-11-01 02:58:15', '2025-11-01 02:58:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_csr`
--

CREATE TABLE `data_csr` (
  `id` char(36) NOT NULL,
  `nopel` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `detail_pic` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `loc_client` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `foto_depan` varchar(255) DEFAULT NULL,
  `user_pppoe` varchar(255) NOT NULL,
  `pass_pppoe` varchar(255) NOT NULL,
  `name_profile` varchar(255) DEFAULT NULL,
  `limit_radius` varchar(255) DEFAULT NULL,
  `odp_id` char(36) DEFAULT NULL,
  `odp_port_id` char(36) DEFAULT NULL,
  `status` enum('booking','active','isolir','suspend','inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_csr`
--

INSERT INTO `data_csr` (`id`, `nopel`, `nama`, `detail_pic`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `loc_client`, `lat`, `long`, `paket`, `foto_depan`, `user_pppoe`, `pass_pppoe`, `name_profile`, `limit_radius`, `odp_id`, `odp_port_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('75c9af8d-e0af-4ce9-a529-1bb3939d941a', 'CSR-46753507', 'Client Dengan Photo', NULL, 'Areka Jalan Musi Ampera', 'SOOKO', 'KABUPATEN MOJOKERTO', 'JAWA TIMUR', NULL, NULL, NULL, 'Paket 3Mbps', 'https://is3.cloudhost.id/urbanet-dev/client_csr_photos/foto_depan_6037f42c-acb3-4e22-9633-613d59a52f31.png', 'CSR-46753507', '327472', 'lite-3Mbps', '3M/3M', NULL, NULL, 'inactive', '2025-12-04 22:32:01', '2025-12-05 08:17:13', NULL),
('87fcf3c8-c476-4df9-a14b-294a0e8a3944', 'CSR-90368092', 'Pos Satpam Perum Krian Indah 2', NULL, 'Jalan Rahasia Rt5 Rw8', 'ROWOKANGKUNG', 'KABUPATEN LUMAJANG', 'JAWA TIMUR', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-7.123456', '6.1245', 'Paket 3Mbps', 'https://is3.cloudhost.id/urbanet-dev/client_csr_photos/foto_depan_3b494bef-53e1-4083-8359-2533ab5b7afa.png', 'CSR-90368092', '559578', 'lite-3Mbps', '3M/3M', NULL, NULL, 'inactive', '2025-12-04 14:43:54', '2025-12-05 08:41:16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_img`
--

CREATE TABLE `data_img` (
  `id` char(36) NOT NULL,
  `client_id` char(36) NOT NULL,
  `data_ticket_hc_id` char(36) DEFAULT NULL,
  `data_ticket_id` char(36) DEFAULT NULL,
  `url_img` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_img`
--

INSERT INTO `data_img` (`id`, `client_id`, `data_ticket_hc_id`, `data_ticket_id`, `url_img`, `tag`, `deleted_at`, `created_at`, `updated_at`) VALUES
('35296389-c725-41af-85e4-87421f3f323b', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', 'f4021622-afd3-4e03-b950-e9b9e654b995', NULL, 'https://is3.cloudhost.id/urbanet-dev/ticket_docs/doc_hc_728967ea-6e32-480b-a37b-c52c614635cc.jpg', 'doc_hc', NULL, '2025-11-01 07:18:43', '2025-11-01 07:18:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mutasi`
--

CREATE TABLE `data_mutasi` (
  `id` char(36) NOT NULL,
  `mutation_id` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `mutasi_check` int(10) UNSIGNED DEFAULT NULL,
  `mutasi_check_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_mutasi`
--

INSERT INTO `data_mutasi` (`id`, `mutation_id`, `account_number`, `bank`, `bank_name`, `type`, `description`, `amount`, `balance`, `date`, `mutasi_check`, `mutasi_check_time`, `created_at`, `updated_at`) VALUES
('1ec76e41-2d66-4999-8df4-350202e2b5f4', 'G1kaEL1KBkg', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 230025.00TRI DESI VIKA', '125710', '51727823.05', '2025-12-05 19:54:31', 1, '2025-12-06 07:22:35', '2025-12-05 13:57:34', '2025-12-06 00:22:35'),
('20f5769d-e4ca-40ae-95b2-4f5d96571913', 'PyjEE1avJj6', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 150040.00TRI DESI VIKA', '125710', '46416445.05', '2025-12-05 08:31:40', 1, NULL, '2025-12-05 13:57:34', '2025-12-05 23:44:40'),
('27414012-61c4-4602-9cef-d68b4b0ba42c', 'eMkbaLd4RWY', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 205016.00TRI DESI VIKA', '205016', '51497798.05', '2025-12-05 19:54:30', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('2a9c8e16-84f1-480a-83ed-94054b93ac0e', '1ajMp7pYKzv', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95051 3336000.00TriPay Settlement TRIJAYA DIGITAL GR', '3336000', '49882487.05', '2025-12-05 14:07:13', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('3b958e80-2a1c-4cdc-b113-40f9768862cf', 'mVz55Kaa5zv', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 205036.00TRI DESI VIKA', '205036', '50607682.05', '2025-12-05 19:37:56', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('4ae69580-09d8-4db7-9439-7abc5d300226', 'NZjxaqX5lW4', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 130049.00TRI DESI VIKA', '130049', '50272608.05', '2025-12-05 17:09:08', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('5d4ab6bd-bc61-4665-8e66-2527b030b6a2', 'Arz6l7885WK', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 115018.00TRI DESI VIKA', '115018', '51177755.05', '2025-12-05 19:37:56', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('6c30749e-1109-4c8b-b7c9-3f70164b4034', '3ykVRollPkN', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 250037.00TRI DESI VIKA', '250037', '51062737.05', '2025-12-05 19:37:56', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('820833d0-2f0f-4dbd-ae3f-b8838bf9e952', 'KwjmdLDwZzr', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 130038.00TRI DESI VIKA', '130038', '50402646.05', '2025-12-05 19:04:58', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('8b78c941-ba56-439d-b29a-56795d582f1b', 'bLjJpq9BekO', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 230025.00TRI DESI VIKA', '230025', '51957848.05', '2025-12-05 19:54:31', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('93ca5158-64ba-4922-99ac-7fc05d635d4a', 'NEzldL66gzm', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 205018.00TRI DESI VIKA', '205018', '50812700.05', '2025-12-05 19:37:56', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('b038b797-55a3-4816-a89d-c014222c7f6f', 'rNkDEA66nzd', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 115027.00TRI DESI VIKA', '115027', '51292782.05', '2025-12-05 19:37:56', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('dccea6b8-77be-4eba-810d-af6de01c9267', 'olk47y033WJ', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 130042.00TRI DESI VIKA', '130042', '46546487.05', '2025-12-05 12:23:03', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('eefd8431-db8f-4565-98c5-62397f4d93cd', 'bLjJpqDg9kO', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 130031.00TRI DESI VIKA', '130031', '50142559.05', '2025-12-05 16:52:38', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34'),
('fd98b214-62a8-4eca-8f1e-c83cb99f88b9', 'G1kaELYNgkg', '8630241783', 'BCA', 'Tiyo Avianto', 'CR', 'TRSF E-BANKING CR0512/FTSCY/WS95271 130041.00TRI DESI VIKA', '130041', '50012528.05', '2025-12-05 16:52:37', 0, NULL, '2025-12-05 13:57:34', '2025-12-05 13:57:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_odc`
--

CREATE TABLE `data_odc` (
  `id` char(36) NOT NULL,
  `server_id` char(36) DEFAULT NULL,
  `kode_odc` varchar(255) NOT NULL,
  `nama_odc` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `prov` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `loc_odp` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `port_cap` varchar(255) DEFAULT NULL,
  `port_install` varchar(255) DEFAULT NULL,
  `rasio` varchar(255) DEFAULT NULL,
  `warna_core` varchar(255) DEFAULT NULL,
  `core_cable` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_odc`
--

INSERT INTO `data_odc` (`id`, `server_id`, `kode_odc`, `nama_odc`, `alamat`, `prov`, `kota`, `kec`, `desa`, `loc_odp`, `lat`, `long`, `port_cap`, `port_install`, `rasio`, `warna_core`, `core_cable`, `note`, `image`, `created_at`, `updated_at`) VALUES
('0199fc21-0197-7066-91f0-4365920d09a0', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODC.FTTH.1.0', 'ODC Desa Serambi', NULL, 'JAWA TIMUR', 'KABUPATEN NGANJUK', 'SAWAHAN', NULL, NULL, NULL, NULL, '8', '8', '1:8', 'Ungu, Putih', '24C', NULL, NULL, '2025-10-19 04:00:45', '2025-10-26 04:30:30'),
('0199fc79-4d69-7395-85cc-8774c8fb9713', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODC.FTTH.1.1', 'ODC Desa Serambi', 'Jalan Nias Merdeka Raya No 45 Rt 04 Rw 06', 'JAWA TIMUR', 'KABUPATEN GRESIK', 'DRIYOREJO', 'Pakal', NULL, NULL, NULL, '8', '8', '1:8', 'Green', '24C', NULL, NULL, '2025-10-19 05:37:12', '2025-10-25 09:01:28'),
('0199fcd7-1355-738a-873d-d70ef9c2bcb1', '0199fb86-288f-71e9-b0fd-9e0ee858aaca', 'ODC.FTTH.1.2', 'ODC Desa Serambi', 'Perumahan Krian Indah', 'JAWA TIMUR', 'KABUPATEN GRESIK', 'CERME', 'Lor Kali', 'https://maps.app.goo.gl/cpMkXL8AoPtwzudk8', '-7.4063726', '112.5841074', '8', '8', '1:8', 'Black', '24C', NULL, NULL, '2025-10-19 07:19:37', '2025-10-19 07:19:37'),
('019a1a26-b137-7120-ac66-ee6e9eb0a139', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODC.CEM.01.02', 'ODC.CEM.01.02', 'Jalan Nias Merdeka Raya No 45 Rt 04 Rw 06', 'JAWA TIMUR', 'KABUPATEN MAGETAN', 'SIDOREJO', 'Ranoyoso', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27', '-1245.454', '112.5841074', '16', '16', '1:8', 'Kuning', '24C', NULL, NULL, '2025-10-25 06:55:34', '2025-10-26 04:29:41'),
('019a2470-2982-734f-b590-41dbe95d4e8e', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODC.CEM.01.03', 'ODC.CEM.01.03', 'Jalan Areka jalan musi ampera raya 5', '35', 'KABUPATEN MAGETAN', 'SIDOREJO', 'Poncol', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27v', '-1245.454', '112.5841074', '8', '8', '1:8', 'Blue/Orange', '24C', NULL, NULL, '2025-10-27 06:52:01', '2025-10-27 06:59:34'),
('019a247c-782f-711b-a4a9-1571d1bfbe82', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODC.CEM.01.04', 'ODC.CEM.01.04', 'Jalan Arupati Dalam Xi/09 Rt 06 Rw 08 Magersari', '35', 'KABUPATEN MAGETAN', 'NGUNTORONADI', 'Ranoyoso', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27v', '-1245.454', '112.5841074', '16', '8', '1:8', 'Orange/Red', '24C', NULL, NULL, '2025-10-27 07:05:28', '2025-10-27 07:05:28'),
('019a249c-4ed3-705a-9c6d-4738e3d638cf', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODC.CEM.01.05', 'ODC.CEM.01.05', 'Jalan Arupati Dalam Xi/09 Rt 06 Rw 08 Magersari', 'JAWA TIMUR', 'KABUPATEN JOMBANG', 'MEGALUH', 'Ranoyoso', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27v', '-1245.454', '112.5841074', '8', '8', '1:8', 'Blue/Orange', '24C', NULL, NULL, '2025-10-27 07:40:14', '2025-10-27 08:10:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_odc_port`
--

CREATE TABLE `data_odc_port` (
  `id` char(36) NOT NULL,
  `odc_id` char(36) DEFAULT NULL,
  `odp_id` char(36) NOT NULL,
  `port_numb` varchar(255) NOT NULL,
  `status` enum('available','reserved','active','faulty','blocked') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_odc_port`
--

INSERT INTO `data_odc_port` (`id`, `odc_id`, `odp_id`, `port_numb`, `status`, `created_at`, `updated_at`) VALUES
('019a1ebc-d0e5-7383-9aaf-d1d0d6f67e30', '019a1a26-b137-7120-ac66-ee6e9eb0a139', '0199fb01-f1a9-733c-8981-28ce4ff1bc35', 'A1', 'available', '2025-10-26 04:18:02', '2025-10-26 04:18:02'),
('019a247e-8061-7303-acaf-75a0a1654fec', '019a247c-782f-711b-a4a9-1571d1bfbe82', '0199fb61-f79e-726a-a178-a5a1fc78cac5', 'A2', 'available', '2025-10-27 07:07:41', '2025-10-27 07:09:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_odp`
--

CREATE TABLE `data_odp` (
  `id` char(36) NOT NULL,
  `kode_odp` varchar(255) NOT NULL,
  `server_id` char(36) DEFAULT NULL,
  `nama_odp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `prov` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `loc_odp` varchar(255) DEFAULT NULL,
  `port_cap` varchar(255) DEFAULT NULL,
  `port_install` varchar(255) DEFAULT NULL,
  `vlan` varchar(255) DEFAULT NULL,
  `warna_core` varchar(255) DEFAULT NULL,
  `core_cable` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_odp`
--

INSERT INTO `data_odp` (`id`, `kode_odp`, `server_id`, `nama_odp`, `alamat`, `prov`, `kota`, `kec`, `desa`, `loc_odp`, `port_cap`, `port_install`, `vlan`, `warna_core`, `core_cable`, `note`, `created_at`, `updated_at`) VALUES
('0199faf2-9a90-7201-8f13-7d5aaab3e586', 'ODP.R.TH.01', NULL, 'ODP.R.TH.01', 'Areka jalan musi', NULL, NULL, NULL, NULL, '-622.12.22654', '16', '8', NULL, 'Blue', '24C', NULL, '2025-10-18 22:30:27', '2025-10-18 22:30:27'),
('0199fb01-f1a9-733c-8981-28ce4ff1bc35', 'ODP.G.F.01', NULL, 'ODP Krian Indah', NULL, NULL, NULL, NULL, NULL, '6521.23564.214', '16', '16', NULL, 'Orange', '24C', NULL, '2025-10-18 22:47:12', '2025-10-18 22:47:12'),
('0199fb4d-9cd8-7217-9a74-f0a558905eda', 'ODP.R.TY.01', NULL, 'ODP Jalan Kencono', 'Areka jalan musi ampera', NULL, NULL, NULL, NULL, '5623.235645', '16', '16', '101', NULL, '24C', 'Merek kabel Global warna hitam', '2025-10-19 00:09:51', '2025-10-19 00:09:51'),
('0199fb61-f79e-726a-a178-a5a1fc78cac5', 'ODP.R.TH.02', NULL, 'ODP Jalan Kencono', 'Areka jalan musi ampera', 'JAWA TIMUR', 'KOTA SURABAYA', 'RUNGKUT', 'Pakal', '-95456.236-985621', '8', '8', '105', 'Blue', '24C', NULL, '2025-10-19 00:32:05', '2025-10-26 06:03:53'),
('0199fb68-16e2-7089-aa0f-b0e0dbb8eff5', 'ODP.R.TH.03', NULL, 'ODP Jalan Kencono', 'Areka jalan musi ampera', 'JAWA TIMUR', 'KABUPATEN GRESIK', 'BENJENG', 'Lor Kali', '-95456.236-985621', '16', '8', '103', 'Green', '24C', NULL, '2025-10-19 00:38:46', '2025-10-19 00:38:46'),
('0199fb91-fc6a-7036-8303-47a7fc886b9f', 'ODP.R.TH.04', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODP Jalan Kencono', 'Areka jalan musi ampera', 'JAWA TIMUR', 'KABUPATEN GRESIK', 'DRIYOREJO', 'Lor Kali', '-5623.12345', '8', '8', '1034', 'Green', '24C', NULL, '2025-10-19 01:24:32', '2025-10-19 01:24:32'),
('019a1eb1-e607-7241-afe6-a796c525b5b6', 'ODP.TEST.1.1', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODP.TEST.1.1', 'Jalan Arupati Dalam Xi/09 Rt 06 Rw 08 Magersari', 'JAWA TIMUR', 'KABUPATEN MAGETAN', 'SUKOMORO', 'Poncol', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs2ytt', '16', '16', '1034', 'Orange/Red', '24C', NULL, '2025-10-26 04:06:06', '2025-10-27 06:39:17'),
('019a2467-80a3-72ef-aadd-4d52b430f041', 'ODP.TEST.1.2', '0199fb87-0763-7033-b7f3-8ea85b656952', 'ODP.TEST.1.2', 'Jalan Arupati Dalam Xi/09 Rt 06 Rw 08 Magersari', 'JAWA TIMUR', 'KABUPATEN MALANG', 'NGANTANG', 'Ranoyoso', 'https://maps.app.goo.gl/YZKJaJuhwXUFCJs27v', '8', '8', '1034', 'Ungu, Putih', '24C', NULL, '2025-10-27 06:42:34', '2025-10-27 06:42:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_odp_logs`
--

CREATE TABLE `data_odp_logs` (
  `id` char(36) NOT NULL,
  `users_id` char(36) DEFAULT NULL,
  `odp_id` char(36) DEFAULT NULL,
  `odp_port` char(36) DEFAULT NULL,
  `client_id` char(36) DEFAULT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_odp_logs`
--

INSERT INTO `data_odp_logs` (`id`, `users_id`, `odp_id`, `odp_port`, `client_id`, `status`, `created_at`, `updated_at`) VALUES
('019a53ea-c58a-70f6-bfbb-917055113892', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, '22253285-4362-42ff-b84d-895ee24bdc62', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Andi Liu)', '2025-11-05 12:08:06', '2025-11-05 12:08:06'),
('019a6bf3-837a-7220-afd6-f1de9ad29b0a', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, '22253285-4362-42ff-b84d-895ee24bdc62', 'User System Admin telah menonaktifkan Client (Andi Liu) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-10 04:08:32', '2025-11-10 04:08:32'),
('019a6bf4-8237-70e4-97a5-a5a18a7b45f0', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, '94121b90-ff2d-42cc-9a52-a9daace0c936', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-10 04:09:37', '2025-11-10 04:09:37'),
('019a7113-f44c-720a-b4bf-fbdebe949f88', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a523f-d020-73d7-a4e3-3429cfb7a1af', '0b295ed1-dd57-482d-a438-bcfb82ff5c6e', 'User System Admin telah menonaktifkan Client (Widodo Raharjo) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A4)', '2025-11-11 04:02:04', '2025-11-11 04:02:04'),
('019a7115-3b70-706c-9cd2-0da4d8bd4977', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a523f-d020-73d7-a4e3-3429cfb7a1af', '0b295ed1-dd57-482d-a438-bcfb82ff5c6e', 'User System Admin telah menonaktifkan Client (Widodo Raharjo) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A4)', '2025-11-11 04:03:28', '2025-11-11 04:03:28'),
('019a8f3d-7e9a-700a-a19b-5ed8e247592f', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, '22253285-4362-42ff-b84d-895ee24bdc62', 'User System Admin telah menonaktifkan Client (Andi Liu) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 00:36:03', '2025-11-17 00:36:03'),
('019a8f3d-e843-71cc-b7d1-add800e8f6e0', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, 'a84ccd50-71f0-4122-b0d4-c126daeb58f8', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Tes Ulang)', '2025-11-17 00:36:30', '2025-11-17 00:36:30'),
('019a8f40-9cc2-70cb-83c3-47d0d7397dd5', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, 'a84ccd50-71f0-4122-b0d4-c126daeb58f8', 'User System Admin telah menonaktifkan Client (Tes Ulang) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 00:39:27', '2025-11-17 00:39:27'),
('019a8f41-6707-703d-bf85-d9dd7338c948', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, 'a84ccd50-71f0-4122-b0d4-c126daeb58f8', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Tes Ulang)', '2025-11-17 00:40:19', '2025-11-17 00:40:19'),
('019a90a2-0641-7325-94bf-f958f7575a69', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, 'a84ccd50-71f0-4122-b0d4-c126daeb58f8', 'User System Admin telah menonaktifkan Client (Tes Ulang) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 07:05:28', '2025-11-17 07:05:28'),
('019a90a2-7bdd-71e2-b4bf-7dc9aee32245', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, NULL, 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Jauhari Ahmad Image)', '2025-11-17 07:05:59', '2025-11-17 07:05:59'),
('019a90ab-75f6-7393-84c2-6c6bfbd46623', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Jauhari Ahmad Image)', '2025-11-17 07:15:47', '2025-11-17 07:15:47'),
('019a90ad-486c-72fa-a776-4a41bfc7c93d', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 07:17:46', '2025-11-17 07:17:46'),
('019a90af-4a71-721a-88cf-1f1a27f88c82', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Jauhari Ahmad Image)', '2025-11-17 07:19:58', '2025-11-17 07:19:58'),
('019a90b1-80f0-72ba-af02-7477c9438980', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 07:22:23', '2025-11-17 07:22:23'),
('019a90b3-ed13-731a-93da-6da33539a67b', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Jauhari Ahmad Image)', '2025-11-17 07:25:02', '2025-11-17 07:25:02'),
('019a9178-21a9-717e-ac63-7485b8d8d272', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 10:59:20', '2025-11-17 10:59:20'),
('019a9178-e7a9-73dc-b575-5d1291712b53', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Jauhari Ahmad Image)', '2025-11-17 11:00:11', '2025-11-17 11:00:11'),
('019a918b-654a-730a-9f96-0838096955c6', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-17 11:20:23', '2025-11-17 11:20:23'),
('019a918b-d6ea-7384-b223-82b66bf75dc8', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A5) dari Client (Jauhari Ahmad Image)', '2025-11-17 11:20:52', '2025-11-17 11:20:52'),
('019a9f4b-ef85-715b-996a-033f8037290a', NULL, '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '019a021c-48d4-7068-9596-04d59c9357b9', '[SYSTEM] Client (Cristin Natalia Sari)-(ID73286349) dinonaktifkan otomatis dan ODP(ODP.TEST.1.1)/Port(A3) dilepas karena tidak membayar hingga akhir bulan.', '2025-11-20 03:25:45', '2025-11-20 03:25:45'),
('019aafe8-d2fc-731a-902a-0d83b0e32a02', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A5)', '2025-11-23 08:51:02', '2025-11-23 08:51:02'),
('019aafea-1196-706d-a6e9-fe265f260df3', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 08:52:24', '2025-11-23 08:52:24'),
('019aafea-2b66-705d-8329-d8dcf2e46072', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 08:52:30', '2025-11-23 08:52:30'),
('019aafea-7187-730f-8a59-c36705a6a419', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 08:52:48', '2025-11-23 08:52:48'),
('019aaff2-015f-727b-bcde-9db134b092aa', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 09:01:04', '2025-11-23 09:01:04'),
('019aaff2-500a-707e-8174-06f75181ac38', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 09:01:24', '2025-11-23 09:01:24'),
('019aaff5-fea5-71a3-a4bf-47a1a551e16c', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 09:05:25', '2025-11-23 09:05:25'),
('019aaff6-410e-7396-b06c-9a83183baa10', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 09:05:42', '2025-11-23 09:05:42'),
('019aaff8-a331-71c3-b80f-7e1fc33dce01', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 09:08:18', '2025-11-23 09:08:18'),
('019aaff8-e0a0-7030-a482-9f910e303ea1', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 09:08:34', '2025-11-23 09:08:34'),
('019aaffa-90b7-71ad-9663-f10264a6787e', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 09:10:25', '2025-11-23 09:10:25'),
('019aaffa-dbb7-70f6-ab1f-e82dbedcaff7', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 09:10:44', '2025-11-23 09:10:44'),
('019aaffc-f6a8-70e8-93a3-44bcbb85afde', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 09:13:02', '2025-11-23 09:13:02'),
('019aaffd-4b90-7364-8e0d-758a7f2c9b64', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 09:13:24', '2025-11-23 09:13:24'),
('019aafff-fc35-728e-9b5c-538c323f4a4a', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-23 09:16:20', '2025-11-23 09:16:20'),
('019ab000-4e68-724c-9704-4cd1030366c7', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-23 09:16:41', '2025-11-23 09:16:41'),
('019ab369-5c24-700b-b6c5-0a0542fd04e5', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-24 01:10:17', '2025-11-24 01:10:17'),
('019ab369-ca76-7327-976c-de9d5f8744aa', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-24 01:10:46', '2025-11-24 01:10:46'),
('019ab37d-0c2d-71c4-8e41-4265c66efd8f', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-24 01:31:48', '2025-11-24 01:31:48'),
('019ab37d-7921-70c6-9ccd-0d2ef8bb8dcd', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-24 01:32:16', '2025-11-24 01:32:16'),
('019ab37e-bc9f-70e7-acd2-d9b9270992cc', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-24 01:33:38', '2025-11-24 01:33:38'),
('019ab37f-100c-71a0-844e-881579056c1d', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-24 01:34:00', '2025-11-24 01:34:00'),
('019ab392-2445-73fa-9084-dfc825044105', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-24 01:54:50', '2025-11-24 01:54:50'),
('019ab392-75c9-7212-ab1e-1208c46c4a95', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-24 01:55:11', '2025-11-24 01:55:11'),
('019ab731-be89-7043-9681-3d875e6fed75', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-24 18:48:01', '2025-11-24 18:48:01'),
('019ab733-e1fd-7116-9267-b5050d88af75', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-24 18:50:22', '2025-11-24 18:50:22'),
('019ab759-80c4-70c5-8fce-8a3f537fcf4b', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menonaktifkan Client (Jauhari Ahmad Image) dan melepas relasi ODP(ODP.TEST.1.1)/Port(A3)', '2025-11-24 19:31:27', '2025-11-24 19:31:27'),
('019ab75b-24ab-73ef-a6fe-c91ce272bfbe', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a439d-10a9-70d9-a69d-ed944d7d22d2', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'User System Admin telah menambahkan relasi ODP(ODP.TEST.1.1)/Port(A3) dari Client (Jauhari Ahmad Image)', '2025-11-24 19:33:15', '2025-11-24 19:33:15'),
('019ae7e3-a8eb-727e-9ab3-dbe08bc1ba3b', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah\' ditambahkan oleh System Admin pada 2025-12-04 12:44:08', '2025-12-04 05:44:08', '2025-12-04 05:44:08'),
('019ae8a4-beb3-739a-9cb6-6afaf626782c', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah\' ditambahkan oleh System Admin pada 2025-12-04 16:15:02', '2025-12-04 09:15:02', '2025-12-04 09:15:02'),
('019ae9a8-4d9e-71f4-8e9d-2f952573dedb', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah\' ditambahkan oleh System Admin pada 2025-12-04 20:58:32', '2025-12-04 13:58:32', '2025-12-04 13:58:32'),
('019ae9d1-d597-73ca-a83b-f3df957337e7', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah\' ditambahkan oleh System Admin pada 2025-12-04 21:43:54', '2025-12-04 14:43:54', '2025-12-04 14:43:54'),
('019aeb73-6c9b-73ac-9931-417cbc10768c', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah\' diubah oleh System Admin pada 2025-12-05 05:20:01', '2025-12-04 22:20:01', '2025-12-04 22:20:01'),
('019aeb7e-687f-7329-a4be-96b7d37d32b1', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019ae9d3-ae87-7398-b52d-f39f97aee3ab', NULL, 'User CSR \'Client Dengan Photo\' ditambahkan oleh System Admin pada 2025-12-05 05:32:01', '2025-12-04 22:32:01', '2025-12-04 22:32:01'),
('019aed28-f95c-7051-a487-d18e9273458a', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah\' diubah oleh System Admin pada 2025-12-05 13:17:56', '2025-12-05 06:17:56', '2025-12-05 06:17:56'),
('019aed29-8db1-71b6-a0cd-b36d927b6f0a', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah 3\' diubah oleh System Admin pada 2025-12-05 13:18:34', '2025-12-05 06:18:34', '2025-12-05 06:18:34'),
('019aed88-8957-72fc-b586-ec6b118b7d5e', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah 3\' diubah oleh System Admin pada 2025-12-05 15:02:19', '2025-12-05 08:02:19', '2025-12-05 08:02:19'),
('019aed8b-ac76-7394-a5a3-6d4533498cfc', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah 2\' diubah oleh System Admin pada 2025-12-05 15:05:45', '2025-12-05 08:05:45', '2025-12-05 08:05:45'),
('019aed8f-e430-7204-8cc0-d14dbbb828a1', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019ae9d3-ae87-7398-b52d-f39f97aee3ab', NULL, 'User CSR \'Client Dengan Photo\' diubah oleh System Admin pada 2025-12-05 15:10:21', '2025-12-05 08:10:21', '2025-12-05 08:10:21'),
('019aed90-a78a-7197-982e-ea4bc4b56a20', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019ae9d3-ae87-7398-b52d-f39f97aee3ab', NULL, 'User CSR \'Client Dengan Photo\' diubah oleh System Admin pada 2025-12-05 15:11:11', '2025-12-05 08:11:11', '2025-12-05 08:11:11'),
('019aed96-2d64-72b5-891c-982b6b2964dc', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019ae9d3-ae87-7398-b52d-f39f97aee3ab', NULL, 'User CSR \'Client Dengan Photo\' dinonaktifkan oleh System Admin pada 2025-12-05 15:17:13', '2025-12-05 08:17:13', '2025-12-05 08:17:13'),
('019aedac-3445-72b7-bb97-2fd508bf65b7', '61b9a2e6-0549-474e-a962-ea5654e3f93e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a90ab-160b-7223-a6df-9100bc7102eb', NULL, 'User CSR \'Pos Satpam Perum Krian Indah 2\' dinonaktifkan dari ODP ODP.TEST.1.1, Port A5 oleh System Admin pada 2025-12-05 15:41:17', '2025-12-05 08:41:17', '2025-12-05 08:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_odp_port`
--

CREATE TABLE `data_odp_port` (
  `id` char(36) NOT NULL,
  `odp_id` char(36) NOT NULL,
  `client_id` char(36) DEFAULT NULL,
  `client_csr_id` char(36) DEFAULT NULL,
  `port_numb` varchar(255) NOT NULL,
  `status` enum('available','reserved','active','faulty','blocked') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_odp_port`
--

INSERT INTO `data_odp_port` (`id`, `odp_id`, `client_id`, `client_csr_id`, `port_numb`, `status`, `created_at`, `updated_at`) VALUES
('019a09a4-d495-7220-8181-62c61cccb5b6', '0199faf2-9a90-7201-8f13-7d5aaab3e586', '019a0a2f-3a1d-7338-8ecd-1142899e573a', NULL, 'A1', 'reserved', '2025-10-22 01:59:48', '2025-10-28 15:22:04'),
('019a1efb-d251-71fc-81ba-55a4c225bb5a', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', NULL, 'A1', 'reserved', '2025-10-26 05:26:51', '2025-10-28 12:35:17'),
('019a402a-cbf7-7066-ac8d-ab3b854d9e1e', '019a1eb1-e607-7241-afe6-a796c525b5b6', '019a3d59-f090-701a-b9b3-ebcffadda253', NULL, 'A2', 'reserved', '2025-11-01 16:05:37', '2025-11-01 16:05:56'),
('019a439d-10a9-70d9-a69d-ed944d7d22d2', '019a1eb1-e607-7241-afe6-a796c525b5b6', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', NULL, 'A3', 'reserved', '2025-11-02 08:09:18', '2025-11-24 19:31:42'),
('019a523f-d020-73d7-a4e3-3429cfb7a1af', '019a1eb1-e607-7241-afe6-a796c525b5b6', '0b295ed1-dd57-482d-a438-bcfb82ff5c6e', NULL, 'A4', 'reserved', '2025-11-05 04:21:45', '2025-11-11 04:04:28'),
('019a90ab-160b-7223-a6df-9100bc7102eb', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, NULL, 'A5', 'available', '2025-11-17 07:15:22', '2025-12-05 08:41:16'),
('019ae9d3-ae87-7398-b52d-f39f97aee3ab', '019a1eb1-e607-7241-afe6-a796c525b5b6', NULL, NULL, 'A6', 'available', '2025-12-04 14:45:55', '2025-12-05 08:17:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_paket`
--

CREATE TABLE `data_paket` (
  `id` char(36) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `harga` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `tayang` tinyint(1) NOT NULL DEFAULT 1,
  `name_profile` varchar(255) DEFAULT NULL,
  `limit_radius` varchar(255) DEFAULT NULL,
  `ip_pool` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_paket`
--

INSERT INTO `data_paket` (`id`, `nama_paket`, `deskripsi`, `harga`, `active`, `tayang`, `name_profile`, `limit_radius`, `ip_pool`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0199fb3e-c759-72de-96a2-3054ee23e240', 'Home 20Mbps', 'Paketan khusus untuk perumahan', '145000', 1, 1, 'home-20', '20M/20M', NULL, '2025-10-18 23:53:39', '2025-10-20 05:17:05', NULL),
('0199fb40-84cd-704b-a2ae-dab974c79453', 'Home 30Mbps', 'Home VLAN20', '200000', 1, 1, 'home-30', '10M/10M 30M/30M 7500K/7500K 24/24 8 1250K/1250K', NULL, '2025-10-18 23:55:33', '2025-10-25 05:52:49', NULL),
('019ab3e2-66c9-71c0-8e81-c9c6a82ce624', 'Home 10Mbps', NULL, '130000', 1, 1, 'home-10mbps', '10M/10M', 'IPPool_10Mbp', '2025-11-24 03:22:30', '2025-11-24 03:22:30', NULL),
('019ab3ee-225f-733a-b6e6-17d9a8f3ab50', 'Home 5Mbps', NULL, '120000', 1, 1, 'home-5mbps', '3M/3M', 'IPPool_5Mbp', '2025-11-24 03:35:19', '2025-11-24 06:19:49', NULL),
('019ab48c-ad57-70a5-9e83-8c341889a81b', 'Paket 3Mbps', NULL, '80000', 1, 1, 'lite-3Mbps', '3M/3M', 'Iite-3Mbps', '2025-11-24 06:28:29', '2025-11-24 06:28:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_partner`
--

CREATE TABLE `data_partner` (
  `id` char(36) NOT NULL,
  `nama_partner` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `secret_token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_pic` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_partner`
--

INSERT INTO `data_partner` (`id`, `nama_partner`, `no_hp`, `alamat`, `provinsi`, `kabupaten`, `kecamatan`, `secret_token`, `password`, `status`, `bank_name`, `bank_pic`, `bank_account`, `created_at`, `updated_at`, `deleted_at`) VALUES
('37a5af1c-73c5-4a98-98ee-3444edc633c0', 'Toko Sri Rahayu', '628112233447', 'Jalan Perwira Kencana 5', 'JAWA TIMUR', 'KABUPATEN MALANG', 'KROMENGAN', 'nunRyfrcs1loBIvweEEGwyYbwDWupnDC', '$2y$12$okt4D3QmAweN.bJ/DwxkeuwvWYM8aWI9wG41vkdszMIUeqAJrniNC', 'active', 'BCA', 'Budi Karya', '1245784512', '2025-11-14 13:52:41', '2025-11-21 03:49:30', NULL),
('91bacb70-4335-42ec-ac77-ad04cde78ae2', 'Toko Kelontong Warnajaya', '6287745855212', 'Jalan Ngadirojo Perwirayana No 78', 'JAWA TIMUR', 'KABUPATEN SIDOARJO', 'WONOAYU', 'ojNaeuMbOBt458VdrAHOI6GmrbL1a809', '$2y$12$PVB9afJtO6Edb3hOnKzdHu.oGluHyS5UnxFf2LeuUXbvx0RAU94vW', 'active', NULL, NULL, NULL, '2025-11-14 12:31:46', '2025-11-14 12:31:46', NULL),
('9ca00a5a-c7ca-4ea6-8a87-4585e269e2af', 'Toko Beras Ngadirojo', '628554455665', 'Jalan Werkudoro 45 Jipangan', 'JAWA TIMUR', 'KABUPATEN MAGETAN', 'SUKOMORO', 'CkAKExVahaf2Y2fCnjkFRxga0zvddxad', '$2y$12$6G04jQ18LF.yRl34eqt1m.PEFAqscHbNOvnz5glTbc6wh6qTcJv3y', 'active', NULL, NULL, NULL, '2025-11-14 12:38:33', '2025-11-14 12:38:33', NULL),
('bcc3e7ff-1882-4fb2-91a5-fea47095a195', 'Toko Beras 2', '62856565656', 'Jalan Garuda Pancasila 234 Blok 3/C Pejompongan', 'JAWA TIMUR', 'KABUPATEN SIDOARJO', 'WONOAYU', '20b04Gn8MiHDpq0ADhvkFwK1j1qDUxEK', '$2y$12$d7BFgDOKC7UJXaLsrz5K/ubl.9euLsm6Y5t6IqPDOgQJzL2XZxa.S', 'active', NULL, NULL, NULL, '2025-11-10 15:04:09', '2025-11-15 08:57:47', NULL),
('d06f4f48-bc12-40bc-ae7e-55e2c84294a9', 'Toko Sembako Lirboyo', '62855664411', 'Jalan Prawira Marta 45 RT4/RW6', 'JAWA TIMUR', 'KABUPATEN GRESIK', 'KEDAMEAN', '2UGxj32PU3cq7SNNlRszRAfHg73ov7ex', '$2y$12$sLLCCaLY4lojVScLdRMh2uwx6LsNr3jLZFmj7Pq5ffl92oxcGcC7O', 'active', NULL, NULL, NULL, '2025-11-10 15:26:47', '2025-11-14 14:19:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_server`
--

CREATE TABLE `data_server` (
  `id` char(36) NOT NULL,
  `nama_pop` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `ip_public` varchar(255) NOT NULL,
  `ip_static` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `radius_secret` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_server`
--

INSERT INTO `data_server` (`id`, `nama_pop`, `lokasi`, `ip_public`, `ip_static`, `user`, `password`, `radius_secret`, `created_at`, `updated_at`) VALUES
('0199fb86-288f-71e9-b0fd-9e0ee858aaca', 'POP Gresik Driyorejo', 'Perumahan Krida Ria Rahayu', '130.132.12.45', '192.168.100.1', 'adminurbanet', 'urbanet', NULL, '2025-10-19 01:11:37', '2025-10-19 01:11:37'),
('0199fb87-0763-7033-b7f3-8ea85b656952', 'POP Gresik Cerme', 'Perumahan Cerme Gresik', '128.12.45.15', '192.168.200.1', 'adminurbanet', 'urbanet', NULL, '2025-10-19 01:12:34', '2025-10-19 01:12:34'),
('019ab917-5e5a-724e-868c-7e004ff03783', 'Sibar POP', 'Server POP 1 Sidoarjo Barat', '141.13.14.56', '192.168.1.2', 'adminMikrotik', '123123', 'radiussecret', '2025-11-25 03:38:27', '2025-11-26 02:24:25'),
('019abdfc-49f5-7140-ad60-0aaaeffd7770', 'POP Radius 2', 'Jalan Radius 2', '182.17.255.78', '192.168.100.3', 'adminMikrotik', 'mikrotik456', 'RahasiaSekali', '2025-11-26 02:26:59', '2025-11-26 02:45:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_setting`
--

CREATE TABLE `data_setting` (
  `id` char(36) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `fee_merchant_billing` int(11) DEFAULT NULL,
  `fee_merchant_sales` int(11) DEFAULT NULL,
  `fee_sales_internal` int(11) DEFAULT NULL,
  `fee_engineer_sales` int(11) DEFAULT NULL,
  `fee_engineer` int(11) DEFAULT NULL,
  `fee_engineer_2` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_setting`
--

INSERT INTO `data_setting` (`id`, `denda`, `point`, `tax`, `fee_merchant_billing`, `fee_merchant_sales`, `fee_sales_internal`, `fee_engineer_sales`, `fee_engineer`, `fee_engineer_2`, `created_at`, `updated_at`) VALUES
('019a31e5-2931-72ba-8e1c-04791f5ae4fa', 5, 30000, 11, 3500, 25000, 50000, 30000, 70000, 50000, '2025-10-29 21:34:53', '2025-12-07 07:29:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_team_site`
--

CREATE TABLE `data_team_site` (
  `id` char(36) NOT NULL,
  `users_id` char(36) NOT NULL,
  `users_id_2` char(36) DEFAULT NULL,
  `users_id_3` char(36) DEFAULT NULL,
  `data_ticket_hc_id` char(36) DEFAULT NULL,
  `data_ticket_id` char(36) DEFAULT NULL,
  `client_id` char(36) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `fee_2` int(11) DEFAULT NULL,
  `fee_3` int(11) DEFAULT NULL,
  `fee_paid` tinyint(1) NOT NULL DEFAULT 0,
  `fee_paid_2` tinyint(1) NOT NULL DEFAULT 0,
  `fee_paid_3` tinyint(1) NOT NULL DEFAULT 0,
  `fee_paid_at` datetime DEFAULT NULL,
  `fee2_paid_at` datetime DEFAULT NULL,
  `fee3_paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_team_site`
--

INSERT INTO `data_team_site` (`id`, `users_id`, `users_id_2`, `users_id_3`, `data_ticket_hc_id`, `data_ticket_id`, `client_id`, `fee`, `fee_2`, `fee_3`, `fee_paid`, `fee_paid_2`, `fee_paid_3`, `fee_paid_at`, `fee2_paid_at`, `fee3_paid_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
('2a73d52c-4659-4614-ac18-064fa6bd6e4b', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, '885b5020-ff24-48db-bf7b-f205d518d962', '019a00fe-af77-736a-b598-9c6e6acabbf2', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-31 03:36:00', '2025-10-31 03:36:00', NULL),
('2bc8e230-7239-4dc4-b1bc-50e5fba9c200', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, NULL, '0199fab2-d664-7063-a76a-dda899f5a407', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-31 05:43:37', '2025-10-31 05:43:37', NULL),
('3198bee4-7ff3-49be-b887-a7a39ce92b38', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, NULL, '0199fab2-d664-7063-a76a-dda899f5a407', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-31 05:45:05', '2025-10-31 05:45:05', NULL),
('48e6aa24-4e8b-4cc0-8f8f-40de2fcf998c', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, 'c7185ad6-08e9-43c5-b48d-fbbf5e77911c', '019a00fe-af77-736a-b598-9c6e6acabbf2', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-30 11:59:52', '2025-10-30 11:59:52', NULL),
('55498f92-3eb4-4eb7-a241-33e037975e94', '019a209f-86dd-71be-a26b-313933a09843', '019a209f-86dd-71be-a26b-313933a09843', NULL, 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 70000, 50000, NULL, 1, 1, 0, '2025-12-09 09:28:53', '2025-12-09 09:28:54', NULL, '2025-12-07 01:37:27', '2025-12-09 02:28:54', NULL),
('65a8c893-b771-40ea-a747-d1b9bfd8b845', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, 'ed534e0f-f27b-4b91-a6da-6bdf897ae440', '019a00fc-13f3-73b3-9d6a-5451252fab51', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-30 12:02:56', '2025-10-30 12:02:56', NULL),
('6d0ed78a-15e7-4392-ac74-6ee0833d2599', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, NULL, '0199fab2-d664-7063-a76a-dda899f5a407', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-31 05:45:53', '2025-10-31 05:45:53', NULL),
('77c5a34e-a498-4300-9770-8e5edfb09512', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, '2972611a-21bd-4efc-88e7-c232eb35236d', '0199fabd-7863-7040-ae5e-cd770a627af3', 70000, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-30 11:42:04', '2025-10-30 11:42:04', NULL),
('8f78851c-4ebc-4719-94ba-5f4c97502f60', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, '044fdb60-9371-4624-b87e-61d99405d3fd', '019a00fe-af77-736a-b598-9c6e6acabbf2', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-31 03:33:58', '2025-10-31 03:33:58', NULL),
('b591cede-16b4-4e8b-868e-97079919dfd5', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, 'febfdfb5-93c6-4354-85be-b186214eb7ff', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-12-07 00:26:03', '2025-12-07 00:26:03', NULL),
('ebd760dd-0e75-4f1b-84cc-9a9e987701af', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, NULL, '3b46fa71-8ad8-47a5-8a1a-239bdd8bb179', '0199fabd-7863-7040-ae5e-cd770a627af3', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-10-30 11:38:27', '2025-10-30 11:38:27', NULL),
('f150ae25-7e1c-482e-8f0b-b8cd0c392a4f', '019a209f-86dd-71be-a26b-313933a09843', NULL, NULL, 'f4021622-afd3-4e03-b950-e9b9e654b995', NULL, '019a0ff8-6782-71e6-ac4f-aec442caa8c1', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-11-01 07:17:52', '2025-11-01 07:17:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ticket`
--

CREATE TABLE `data_ticket` (
  `id` char(36) NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `client_id` char(36) NOT NULL,
  `type_task` enum('Gangguan','Customers Support','Support NOC','Maintenance') NOT NULL,
  `detail_task` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('open','cancel','process','finish') NOT NULL,
  `status_finish` datetime DEFAULT NULL,
  `solving` varchar(255) DEFAULT NULL,
  `ticket_guarantee` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_ticket`
--

INSERT INTO `data_ticket` (`id`, `ticket_code`, `client_id`, `type_task`, `detail_task`, `note`, `status`, `status_finish`, `solving`, `ticket_guarantee`, `created_at`, `updated_at`, `deleted_at`) VALUES
('044fdb60-9371-4624-b87e-61d99405d3fd', 'TC-V9WDWISB', '019a00fe-af77-736a-b598-9c6e6acabbf2', 'Gangguan', 'adaptor mati', NULL, 'finish', '2025-10-31 10:34:33', 'Ganti Adaptor', 0, '2025-10-31 03:33:58', '2025-10-31 03:34:33', NULL),
('2972611a-21bd-4efc-88e7-c232eb35236d', 'TC-JISND3AU', '0199fabd-7863-7040-ae5e-cd770a627af3', 'Gangguan', NULL, 'finish', 'process', '2025-10-31 10:42:49', 'Ganti Router', 0, '2025-10-30 11:42:04', '2025-10-31 03:42:49', NULL),
('3b46fa71-8ad8-47a5-8a1a-239bdd8bb179', 'TC-1XR3A1VI', '0199fabd-7863-7040-ae5e-cd770a627af3', 'Gangguan', 'adaptor mati', NULL, 'process', NULL, NULL, 0, '2025-10-30 11:38:27', '2025-10-30 11:38:27', NULL),
('885b5020-ff24-48db-bf7b-f205d518d962', 'TC-647P02MZ', '019a00fe-af77-736a-b598-9c6e6acabbf2', 'Gangguan', 'adaptor mati', NULL, 'finish', '2025-10-31 10:36:12', 'Ganti Router', 1, '2025-10-31 03:36:00', '2025-10-31 03:36:12', NULL),
('8b614fe7-8a44-4fc6-b8a6-b3df0722833d', 'TC-GZYMILJR', '0199fab2-d664-7063-a76a-dda899f5a407', 'Gangguan', 'router mati total', NULL, 'process', NULL, 'Ganti Router', 0, '2025-10-30 06:41:11', '2025-10-30 06:41:11', NULL),
('c7185ad6-08e9-43c5-b48d-fbbf5e77911c', 'TC-FKP1ZXGJ', '019a00fe-af77-736a-b598-9c6e6acabbf2', 'Gangguan', NULL, NULL, 'finish', '2025-10-31 10:28:26', 'Ganti Router', 0, '2025-10-30 11:59:52', '2025-10-31 03:28:26', NULL),
('ed534e0f-f27b-4b91-a6da-6bdf897ae440', 'TC-AOV63IIX', '019a00fc-13f3-73b3-9d6a-5451252fab51', 'Gangguan', 'test', 'test', 'finish', '2025-10-31 10:40:42', 'Ganti Router', 0, '2025-10-30 12:02:56', '2025-10-31 03:40:42', NULL),
('f3df0a7c-5213-41c7-b6cd-42a53cc74f85', 'TC-U9HCGGB5', '0199fab2-d664-7063-a76a-dda899f5a407', 'Gangguan', 'router mati total', NULL, 'cancel', NULL, 'Ganti Router', 0, '2025-10-30 06:40:59', '2025-10-30 06:48:54', NULL),
('febfdfb5-93c6-4354-85be-b186214eb7ff', 'TC-CVR3DIZB', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'Support NOC', 'Ganti password Wifi', 'Password sudah di sesuai dengan permintaan', 'finish', '2025-12-07 07:26:44', 'Setting NOC', 0, '2025-12-07 00:26:03', '2025-12-07 00:26:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ticket_hc`
--

CREATE TABLE `data_ticket_hc` (
  `id` char(36) NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `client_id` char(36) NOT NULL,
  `note` text DEFAULT NULL,
  `status` enum('open','process','pending','cancel','finish') NOT NULL,
  `merk_kabel` varchar(255) DEFAULT NULL,
  `panjang_kabel` varchar(255) DEFAULT NULL,
  `sambungan_kabel` varchar(255) DEFAULT NULL,
  `status_finish` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_ticket_hc`
--

INSERT INTO `data_ticket_hc` (`id`, `ticket_code`, `client_id`, `note`, `status`, `merk_kabel`, `panjang_kabel`, `sambungan_kabel`, `status_finish`, `created_at`, `updated_at`, `deleted_at`) VALUES
('dd5c8a02-c622-4a63-be70-e81fe5003453', 'PSB-0LHB3L24', '29d61368-e1cd-4c48-9115-bbf3e4f1aac3', 'pelanggan minta kabel di lewatkan samping pintu', 'finish', NULL, NULL, NULL, '2025-12-09 08:25:39', '2025-12-07 01:37:27', '2025-12-09 01:25:39', NULL),
('f4021622-afd3-4e03-b950-e9b9e654b995', 'PSB-61U5NDXT', '019a0ff8-6782-71e6-ac4f-aec442caa8c1', NULL, 'finish', 'global', '150', '2', '2025-11-01 16:48:36', '2025-11-01 07:17:51', '2025-11-01 09:48:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ticket_log`
--

CREATE TABLE `data_ticket_log` (
  `id` char(36) NOT NULL,
  `data_ticket_hc_id` char(36) DEFAULT NULL,
  `data_ticket_id` char(36) DEFAULT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_ticket_log`
--

INSERT INTO `data_ticket_log` (`id`, `data_ticket_hc_id`, `data_ticket_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('02fbf240-2e78-43c0-81b0-dff5a96344fe', NULL, NULL, 'Tiket PSB-48QTRERG diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 01-11-2025 14:07:51', '2025-11-01 07:07:51', '2025-11-01 07:07:51', NULL),
('0f5e0625-1f25-4854-b235-b062d7a8b0f7', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 08:50:48', '2025-12-07 01:50:48', '2025-12-07 01:50:48', NULL),
('42695c2d-1148-47fa-8b18-85966e1b092a', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 09-12-2025 08:25:39', '2025-12-09 01:25:39', '2025-12-09 01:25:39', NULL),
('42aca20a-0429-44d7-b6a1-593666be48ab', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 08:41:55', '2025-12-07 01:41:55', '2025-12-07 01:41:55', NULL),
('44e53e9a-c9ff-415a-af69-b60fb617e55e', NULL, NULL, 'Tiket PSB-48QTRERG diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 01-11-2025 14:08:34', '2025-11-01 07:08:34', '2025-11-01 07:08:34', NULL),
('45c084f1-3525-4df5-ba55-6e2be0c65bb6', 'f4021622-afd3-4e03-b950-e9b9e654b995', NULL, 'Tiket PSB-61U5NDXT diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 01-11-2025 16:48:37', '2025-11-01 09:48:37', '2025-11-01 09:48:37', NULL),
('466a629e-3ace-4af2-9e74-f7b7ecfffccd', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 14:30:16', '2025-12-07 07:30:16', '2025-12-07 07:30:16', NULL),
('5e6f7aad-02bc-45d3-a207-4c1f65459653', NULL, 'febfdfb5-93c6-4354-85be-b186214eb7ff', 'Ticket dengan kode TC-CVR3DIZB untuk client Jauhari Ahmad Image telah ditujukan kepada Wahyu Hidayat pada 07-12-2025 07:26:03', '2025-12-07 00:26:03', '2025-12-07 00:26:03', NULL),
('5eb5fda3-e19a-4384-b8a1-582822c43678', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 09:35:20', '2025-12-07 02:35:20', '2025-12-07 02:35:20', NULL),
('740db084-8c7b-4b7d-b46c-498de4ec4ae7', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 14:33:36', '2025-12-07 07:33:36', '2025-12-07 07:33:36', NULL),
('78022953-b183-47fd-a0a4-66f421bec47c', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Ticket PSB dengan kode PSB-0LHB3L24 untuk client Jauhari Ahmad Image telah ditujukan kepada Wahyu Hidayat pada 07-12-2025 08:37:27', '2025-12-07 01:37:27', '2025-12-07 01:37:27', NULL),
('a2c40078-d93e-4671-b160-f25a3d1bff63', 'f4021622-afd3-4e03-b950-e9b9e654b995', NULL, 'Tiket PSB-61U5NDXT diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 01-11-2025 14:18:31', '2025-11-01 07:18:31', '2025-11-01 07:18:31', NULL),
('af241396-7fb4-404e-8ced-c716bf2ddb11', NULL, 'febfdfb5-93c6-4354-85be-b186214eb7ff', 'Tiket TC-CVR3DIZB diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 07:26:44', '2025-12-07 00:26:44', '2025-12-07 00:26:44', NULL),
('afd36b28-5cdf-43dc-bb88-343614072a96', 'f4021622-afd3-4e03-b950-e9b9e654b995', NULL, 'Ticket PSB dengan kode PSB-61U5NDXT untuk client Nisa Pratiwisari Mulyana telah ditujukan kepada Wahyu Hidayat pada 01-11-2025 14:17:52', '2025-11-01 07:17:52', '2025-11-01 07:17:52', NULL),
('c9a53c7d-db4c-4620-869a-32d05b23172d', 'dd5c8a02-c622-4a63-be70-e81fe5003453', NULL, 'Tiket PSB-0LHB3L24 diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 07-12-2025 09:45:27', '2025-12-07 02:45:27', '2025-12-07 02:45:27', NULL),
('df5e81a0-2a8f-49b8-9c29-da429b2541d0', NULL, NULL, 'Tiket PSB-LRSFLLOL diperbarui oleh System Admin dan ditangani oleh teknisi Wahyu Hidayat pada 01-11-2025 14:06:00', '2025-11-01 07:06:00', '2025-11-01 07:06:00', NULL);

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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_18_040859_create_personal_access_tokens_table', 1),
(5, '2025_10_19_021758_create_clients_table', 2),
(6, '2025_10_19_022341_create_data_clients_table', 3),
(7, '2025_10_19_025551_create_data_pakets_table', 4),
(8, '2025_10_19_025907_create_data_odps_table', 5),
(10, '2025_10_19_030404_create_data_odp_ports_table', 6),
(11, '2025_10_19_070507_add_vlan_to_data_odp_table', 7),
(12, '2025_10_19_080235_create_data_server_table', 8),
(13, '2025_10_19_081520_add_server_id_to_data_odp_table', 9),
(14, '2025_10_19_105225_create_data_odc_table', 10),
(15, '2025_10_19_111430_create_data_odc_port_table', 11),
(16, '2025_10_19_112304_add_odc_id_to_data_odc_port_table', 12),
(17, '2025_10_19_133123_add_location_fields_to_data_odc_table', 13),
(18, '2025_10_20_115726_add_active_tayang_to_data_paket_table', 14),
(19, '2025_10_20_140608_add_location_and_promo_fields_to_data_clients_table', 15),
(21, '2025_10_20_143213_create_data_billing_table', 16),
(22, '2025_10_21_082532_create_data_odp_logs_table', 17),
(23, '2025_10_21_083544_add_users_id_to_data_odp_logs_table', 18),
(28, '2025_10_21_142150_add_new_member_to_data_billing_table', 20),
(30, '2025_10_22_084447_create_data_client_logs_table', 21),
(31, '2025_10_22_204249_add_denda_and_after_tax_to_data_billing_table', 22),
(32, '2025_10_22_204722_add_total_amount_and_discount_to_data_billing_table', 23),
(33, '2025_10_22_205118_add_point_to_data_clients_table', 24),
(34, '2025_10_25_105659_create_password_reset_tokens_table', 25),
(35, '2025_10_26_194231_add_active_and_first_login_to_users_table', 26),
(36, '2025_10_21_132723_alter_data_billing_reference_nullable', 27),
(37, '2025_10_27_110345_alter_odp_foreign_keys_in_data_client_table', 28),
(38, '2025_10_28_183612_create_data_billing_item_table', 29),
(39, '2025_10_28_184705_alter_data_billing_add_item_id_and_remove_legacy_fields', 29),
(40, '2025_10_28_190258_alter_data_billing_remove_item_id_and_index_merchant_ref', 30),
(41, '2025_10_28_190320_alter_data_billing_item_add_merchant_ref_id', 30),
(42, '2025_10_29_095142_add_tax_to_data_billing_table', 31),
(43, '2025_10_29_100808_add_denda_to_data_billing_item_table', 32),
(44, '2025_10_30_041905_create_data_setting_table', 33),
(45, '2025_10_30_045143_create_data_billing_log_table', 34),
(46, '2025_10_30_052731_add_soft_deletes_to_data_billing_table', 35),
(48, '2025_10_30_102022_create_data_ticket_table', 36),
(49, '2025_10_30_104234_create_data_ticket_hc_table', 37),
(50, '2025_10_30_181304_create_data_team_site_table', 38),
(51, '2025_10_30_185058_create_data_ticket_log_table', 39),
(52, '2025_10_31_123638_update_note_column_in_data_ticket_hc_table', 40),
(53, '2025_10_31_222637_create_data_img_table', 41),
(54, '2025_11_02_113134_change_instructions_to_text_in_data_billing', 42),
(55, '2025_11_03_140052_create_data_clients_prospect_table', 43),
(56, '2025_11_03_143705_add_nik_to_data_clients_prospect_table', 44),
(57, '2025_11_04_045931_add_point_to_data_billing_table', 45),
(58, '2025_11_06_091800_add_paket_id_to_data_clients_prospect_table', 46),
(59, '2025_11_06_095054_create_data_clients_regist_table', 47),
(60, '2025_11_10_212856_create_data_partner_table', 48),
(61, '2025_11_12_081158_add_partner_fields_to_data_billing_table', 49),
(62, '2025_11_13_151501_create_data_bank_manual_table', 50),
(63, '2025_11_15_215039_update_enum_role_users_table', 51),
(64, '2025_11_15_221315_create_data_clients_partner_table', 52),
(65, '2025_11_15_225741_add_paket_id_to_data_clients_partner_table', 53),
(66, '2025_11_16_001404_add_email_to_data_clients_partner_table', 54),
(67, '2025_11_17_082238_create_data_clients_sales_table', 55),
(68, '2025_11_17_091253_update_data_clients_sales_add_email_and_unique_prospect_id', 56),
(69, '2025_11_19_095940_add_message_count_to_data_billing_table', 57),
(70, '2025_11_21_103308_add_bank_fields_to_data_partner_table', 58),
(71, '2025_11_24_100204_add_ip_pool_to_data_paket_table', 59),
(72, '2025_11_25_093910_add_radius_secret_to_data_server_table', 60),
(73, '2025_12_03_085822_create_data_csr_table', 61),
(74, '2025_12_03_101030_add_status_to_data_csr_table', 62),
(75, '2025_12_03_105349_add_client_csr_id_to_data_odp_port_table', 63),
(76, '2025_12_05_160032_create_data_mutasi_table', 64),
(77, '2025_12_07_081814_add_users2_users3_fee2_fee3_to_data_team_site_table', 65),
(78, '2025_12_07_142551_add_fee_engineer2_to_data_setting_table', 66),
(79, '2025_12_08_044722_add_fee_paid_columns_to_data_team_site_table', 67);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('lookitsautumn@gmail.com', '$2y$12$vKdETAJzCzP2MbgPNDDd8eynQgL9J0SDszBAVjqVNL8KljGEo2sCi', '2025-11-17 02:27:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` char(36) NOT NULL,
  `name` text NOT NULL,
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
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Finance','NOC','CustomerCare','Installer','Sales','Legal','AdminCust') DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_first_login` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `active`, `is_first_login`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
('019a209d-e242-72cf-b09e-0d08d2945878', 'Autumn', 'lookitsautumn@gmail.com', NULL, '$2y$12$E5uM82ZE83VLGeXwupUCzOnV97Xje2R02VvvcYjD0xGGdF4hD8dR2', 'Sales', 1, 1, NULL, NULL, '2025-10-26 13:03:29', '2025-10-26 13:03:29'),
('019a209f-86dd-71be-a26b-313933a09843', 'Wahyu Hidayat', 'wahyu@gmail.com', NULL, '$2y$12$YMjTrOL8kTfNnQ2c2Z2rz.c7HGQbuVPg2ZqQ4oxev0HIgnbRIhkju', 'Installer', 1, 0, NULL, NULL, '2025-10-26 13:05:17', '2025-10-27 02:19:23'),
('019a20af-c9e3-7329-83f5-c1624ed2aa5c', 'Coba', 'coba@gmail.com', '2025-10-26 15:00:19', '$2y$12$0pDA7CSq2zslHB/gIPGL8.iNq0R9HpEo8dlRDgpQbR.nr4nGf3WO2', 'Sales', 1, 0, NULL, NULL, '2025-10-26 13:23:02', '2025-10-26 15:00:19'),
('019a2114-3f48-72ab-ba66-dcaec69ccc1b', 'Team Finance', 'halo.kidz.id@gmail.com', '2025-10-27 03:54:55', '$2y$12$GD.JpCyPP6T6PTAw0tTkJuWMU/pL6El0XEBzPNwUm29S4NKpD/bx.', 'Sales', 1, 0, '82RtdtefAKkeL84OKhBqfsDA3iuxsRB53ZGti9BuFXe7QQDLjL78ttpFzNfv', NULL, '2025-10-26 15:12:46', '2025-11-17 08:17:00'),
('61b9a2e6-0549-474e-a962-ea5654e3f93e', 'System Admin', 'tiyoavianto@gmail.com', '2025-10-17 22:17:21', '$2y$12$0pDA7CSq2zslHB/gIPGL8.iNq0R9HpEo8dlRDgpQbR.nr4nGf3WO2', 'Admin', 1, 0, 'tRHgDfkl9wy0fggWVaIUHcjBGXalByFaVFUIr1O5hChu2oCNJoerJ53a6RjP', NULL, '2025-10-17 21:57:26', '2025-10-25 04:42:11'),
('b291d1f3-c35c-11f0-9d1c-782bcbb73c12', 'Sales Admin', 'sales@sales.com', '2025-11-17 02:24:50', '$2y$12$0pDA7CSq2zslHB/gIPGL8.iNq0R9HpEo8dlRDgpQbR.nr4nGf3WO2', 'Sales', 1, 0, NULL, NULL, '2025-11-17 02:24:50', '2025-11-17 02:24:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `data_bank_manual`
--
ALTER TABLE `data_bank_manual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_billing`
--
ALTER TABLE `data_billing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_billing_merchant_ref_unique` (`merchant_ref`),
  ADD UNIQUE KEY `merchant_ref_unique` (`merchant_ref`),
  ADD KEY `data_billing_client_id_foreign` (`client_id`),
  ADD KEY `data_billing_partner_id_foreign` (`partner_id`);

--
-- Indeks untuk tabel `data_billing_item`
--
ALTER TABLE `data_billing_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_billing_item_merchant_ref_id_foreign` (`merchant_ref_id`);

--
-- Indeks untuk tabel `data_billing_log`
--
ALTER TABLE `data_billing_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_billing_log_user_id_foreign` (`user_id`),
  ADD KEY `data_billing_log_client_id_foreign` (`client_id`),
  ADD KEY `data_billing_log_merchant_ref_id_foreign` (`merchant_ref_id`);

--
-- Indeks untuk tabel `data_clients`
--
ALTER TABLE `data_clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_clients_nopel_unique` (`nopel`),
  ADD UNIQUE KEY `data_clients_user_pppoe_unique` (`user_pppoe`),
  ADD KEY `data_clients_odp_id_foreign` (`odp_id`),
  ADD KEY `data_clients_odp_port_id_foreign` (`odp_port_id`);

--
-- Indeks untuk tabel `data_clients_partner`
--
ALTER TABLE `data_clients_partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_clients_partner_partner_id_foreign` (`partner_id`),
  ADD KEY `data_clients_partner_client_prospect_id_index` (`client_prospect_id`),
  ADD KEY `data_clients_partner_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `data_clients_prospect`
--
ALTER TABLE `data_clients_prospect`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_clients_prospect_client_id_foreign` (`client_id`),
  ADD KEY `data_clients_prospect_client_prospect_id_index` (`client_prospect_id`),
  ADD KEY `data_clients_prospect_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `data_clients_regist`
--
ALTER TABLE `data_clients_regist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_clients_regist_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `data_clients_sales`
--
ALTER TABLE `data_clients_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_clients_sales_client_prospect_id_unique` (`client_prospect_id`),
  ADD KEY `data_clients_sales_users_id_foreign` (`users_id`),
  ADD KEY `data_clients_sales_paket_id_foreign` (`paket_id`),
  ADD KEY `data_clients_sales_client_prospect_id_index` (`client_prospect_id`);

--
-- Indeks untuk tabel `data_client_logs`
--
ALTER TABLE `data_client_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_client_logs_users_id_foreign` (`users_id`),
  ADD KEY `data_client_logs_client_id_foreign` (`client_id`);

--
-- Indeks untuk tabel `data_csr`
--
ALTER TABLE `data_csr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_csr_nopel_unique` (`nopel`),
  ADD UNIQUE KEY `data_csr_user_pppoe_unique` (`user_pppoe`),
  ADD KEY `data_csr_odp_id_foreign` (`odp_id`),
  ADD KEY `data_csr_odp_port_id_foreign` (`odp_port_id`);

--
-- Indeks untuk tabel `data_img`
--
ALTER TABLE `data_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_img_client_id_foreign` (`client_id`),
  ADD KEY `data_img_data_ticket_hc_id_foreign` (`data_ticket_hc_id`),
  ADD KEY `data_img_data_ticket_id_foreign` (`data_ticket_id`);

--
-- Indeks untuk tabel `data_mutasi`
--
ALTER TABLE `data_mutasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_mutasi_mutation_id_unique` (`mutation_id`);

--
-- Indeks untuk tabel `data_odc`
--
ALTER TABLE `data_odc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_odc_kode_odc_unique` (`kode_odc`),
  ADD KEY `data_odc_server_id_foreign` (`server_id`);

--
-- Indeks untuk tabel `data_odc_port`
--
ALTER TABLE `data_odc_port`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_odc_port_odp_id_port_numb_unique` (`odp_id`,`port_numb`),
  ADD KEY `data_odc_port_odc_id_foreign` (`odc_id`);

--
-- Indeks untuk tabel `data_odp`
--
ALTER TABLE `data_odp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_odp_kode_odp_unique` (`kode_odp`),
  ADD KEY `data_odp_server_id_foreign` (`server_id`);

--
-- Indeks untuk tabel `data_odp_logs`
--
ALTER TABLE `data_odp_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_odp_logs_odp_id_index` (`odp_id`),
  ADD KEY `data_odp_logs_odp_port_index` (`odp_port`),
  ADD KEY `data_odp_logs_client_id_index` (`client_id`),
  ADD KEY `data_odp_logs_users_id_index` (`users_id`);

--
-- Indeks untuk tabel `data_odp_port`
--
ALTER TABLE `data_odp_port`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_odp_port_odp_id_port_numb_unique` (`odp_id`,`port_numb`),
  ADD KEY `data_odp_port_client_id_index` (`client_id`),
  ADD KEY `data_odp_port_status_index` (`status`),
  ADD KEY `data_odp_port_client_csr_id_foreign` (`client_csr_id`);

--
-- Indeks untuk tabel `data_paket`
--
ALTER TABLE `data_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_partner`
--
ALTER TABLE `data_partner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_partner_no_hp_unique` (`no_hp`),
  ADD UNIQUE KEY `data_partner_secret_token_unique` (`secret_token`);

--
-- Indeks untuk tabel `data_server`
--
ALTER TABLE `data_server`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_setting`
--
ALTER TABLE `data_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_team_site`
--
ALTER TABLE `data_team_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_team_site_users_id_foreign` (`users_id`),
  ADD KEY `data_team_site_data_ticket_hc_id_foreign` (`data_ticket_hc_id`),
  ADD KEY `data_team_site_data_ticket_id_foreign` (`data_ticket_id`),
  ADD KEY `data_team_site_client_id_foreign` (`client_id`),
  ADD KEY `data_team_site_users_id_2_foreign` (`users_id_2`),
  ADD KEY `data_team_site_users_id_3_foreign` (`users_id_3`);

--
-- Indeks untuk tabel `data_ticket`
--
ALTER TABLE `data_ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_ticket_ticket_code_unique` (`ticket_code`),
  ADD KEY `data_ticket_client_id_foreign` (`client_id`);

--
-- Indeks untuk tabel `data_ticket_hc`
--
ALTER TABLE `data_ticket_hc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_ticket_hc_ticket_code_unique` (`ticket_code`),
  ADD KEY `data_ticket_hc_client_id_foreign` (`client_id`);

--
-- Indeks untuk tabel `data_ticket_log`
--
ALTER TABLE `data_ticket_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_ticket_log_data_ticket_hc_id_foreign` (`data_ticket_hc_id`),
  ADD KEY `data_ticket_log_data_ticket_id_foreign` (`data_ticket_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

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
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_billing`
--
ALTER TABLE `data_billing`
  ADD CONSTRAINT `data_billing_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_billing_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `data_partner` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_billing_item`
--
ALTER TABLE `data_billing_item`
  ADD CONSTRAINT `data_billing_item_merchant_ref_id_foreign` FOREIGN KEY (`merchant_ref_id`) REFERENCES `data_billing` (`merchant_ref`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_billing_log`
--
ALTER TABLE `data_billing_log`
  ADD CONSTRAINT `data_billing_log_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_billing_log_merchant_ref_id_foreign` FOREIGN KEY (`merchant_ref_id`) REFERENCES `data_billing` (`merchant_ref`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_billing_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_clients`
--
ALTER TABLE `data_clients`
  ADD CONSTRAINT `data_clients_odp_id_foreign` FOREIGN KEY (`odp_id`) REFERENCES `data_odp` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_clients_odp_port_id_foreign` FOREIGN KEY (`odp_port_id`) REFERENCES `data_odp_port` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_clients_partner`
--
ALTER TABLE `data_clients_partner`
  ADD CONSTRAINT `data_clients_partner_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `data_paket` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_clients_partner_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `data_partner` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_clients_prospect`
--
ALTER TABLE `data_clients_prospect`
  ADD CONSTRAINT `data_clients_prospect_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_clients_prospect_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `data_paket` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_clients_regist`
--
ALTER TABLE `data_clients_regist`
  ADD CONSTRAINT `data_clients_regist_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `data_paket` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_clients_sales`
--
ALTER TABLE `data_clients_sales`
  ADD CONSTRAINT `data_clients_sales_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `data_paket` (`id`),
  ADD CONSTRAINT `data_clients_sales_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_client_logs`
--
ALTER TABLE `data_client_logs`
  ADD CONSTRAINT `data_client_logs_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_client_logs_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_csr`
--
ALTER TABLE `data_csr`
  ADD CONSTRAINT `data_csr_odp_id_foreign` FOREIGN KEY (`odp_id`) REFERENCES `data_odp` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_csr_odp_port_id_foreign` FOREIGN KEY (`odp_port_id`) REFERENCES `data_odp_port` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_img`
--
ALTER TABLE `data_img`
  ADD CONSTRAINT `data_img_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_img_data_ticket_hc_id_foreign` FOREIGN KEY (`data_ticket_hc_id`) REFERENCES `data_ticket_hc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_img_data_ticket_id_foreign` FOREIGN KEY (`data_ticket_id`) REFERENCES `data_ticket` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_odc`
--
ALTER TABLE `data_odc`
  ADD CONSTRAINT `data_odc_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `data_server` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_odc_port`
--
ALTER TABLE `data_odc_port`
  ADD CONSTRAINT `data_odc_port_odc_id_foreign` FOREIGN KEY (`odc_id`) REFERENCES `data_odc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `data_odc_port_odp_id_foreign` FOREIGN KEY (`odp_id`) REFERENCES `data_odp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_odp`
--
ALTER TABLE `data_odp`
  ADD CONSTRAINT `data_odp_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `data_server` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_odp_logs`
--
ALTER TABLE `data_odp_logs`
  ADD CONSTRAINT `data_odp_logs_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `data_odp_logs_odp_id_foreign` FOREIGN KEY (`odp_id`) REFERENCES `data_odp` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `data_odp_logs_odp_port_foreign` FOREIGN KEY (`odp_port`) REFERENCES `data_odp_port` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `data_odp_logs_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_odp_port`
--
ALTER TABLE `data_odp_port`
  ADD CONSTRAINT `data_odp_port_client_csr_id_foreign` FOREIGN KEY (`client_csr_id`) REFERENCES `data_csr` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_odp_port_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_odp_port_odp_id_foreign` FOREIGN KEY (`odp_id`) REFERENCES `data_odp` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_team_site`
--
ALTER TABLE `data_team_site`
  ADD CONSTRAINT `data_team_site_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_team_site_data_ticket_hc_id_foreign` FOREIGN KEY (`data_ticket_hc_id`) REFERENCES `data_ticket_hc` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_team_site_data_ticket_id_foreign` FOREIGN KEY (`data_ticket_id`) REFERENCES `data_ticket` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_team_site_users_id_2_foreign` FOREIGN KEY (`users_id_2`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_team_site_users_id_3_foreign` FOREIGN KEY (`users_id_3`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_team_site_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_ticket`
--
ALTER TABLE `data_ticket`
  ADD CONSTRAINT `data_ticket_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_ticket_hc`
--
ALTER TABLE `data_ticket_hc`
  ADD CONSTRAINT `data_ticket_hc_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `data_clients` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_ticket_log`
--
ALTER TABLE `data_ticket_log`
  ADD CONSTRAINT `data_ticket_log_data_ticket_hc_id_foreign` FOREIGN KEY (`data_ticket_hc_id`) REFERENCES `data_ticket_hc` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_ticket_log_data_ticket_id_foreign` FOREIGN KEY (`data_ticket_id`) REFERENCES `data_ticket` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
