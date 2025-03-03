-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2025 at 08:11 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u828504599_findearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'CashApp Account', 'cashapp-account', 'CashApp Account', '67bafaa12bebe.png', '2025-02-23 16:38:25', '2025-02-23 16:38:25'),
(2, 'Discount Panel', 'discount-panel', 'Discount Panel', '67bbf41deaa06.png', '2025-02-24 10:22:53', '2025-02-24 10:22:53'),
(3, 'Gift Card', 'gift-card', 'Gift Card', '67bbf44288bd0.png', '2025-02-24 10:23:30', '2025-02-24 10:23:30'),
(4, 'IP Proxy', 'ip-proxy', 'IP Proxy', '67bbf45ae6487.png', '2025-02-24 10:23:54', '2025-02-24 10:23:54'),
(5, 'Number Portal Site Recharge', 'number-portal-site-recharge', 'Number Portal Site Recharge', '67bbf480b6d56.png', '2025-02-24 10:24:32', '2025-02-24 10:24:32'),
(6, 'Other Products', 'other-products', 'Other Products', '67bbf49278655.png', '2025-02-24 10:24:50', '2025-02-24 10:24:50'),
(7, 'Topup', 'topup', 'Topup', '67bbf4a1e14c6.png', '2025-02-24 10:25:05', '2025-02-24 10:25:05'),
(8, 'Us Bank Account', 'us-bank-account', 'Us Bank Account', '67bbf4b47483d.png', '2025-02-24 10:25:24', '2025-02-24 10:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_0000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_12_151829_create_categories_table', 1),
(5, '2025_02_12_151912_create_products_table', 1),
(6, '2025_02_15_114448_create_orders_table', 1),
(7, '2025_02_20_195512_create_wallets_table', 1),
(8, '2025_02_21_152703_create_pages_table', 1),
(9, '2025_02_21_220238_create_socials_table', 1),
(10, '2025_02_22_164546_create_sliders_table', 1),
(11, '2025_02_22_212602_create_payment_methods_table', 1),
(12, '2025_02_23_012617_create_transactions_table', 1),
(13, '2025_02_23_141801_create_settings_table', 1),
(14, '2025_02_25_185353_create_product_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_details`)),
  `delivery_method` varchar(255) NOT NULL,
  `payment_option` varchar(255) NOT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `total` decimal(8,2) NOT NULL,
  `order_notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_details`, `delivery_method`, `payment_option`, `proof`, `total`, `order_notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '[{\"id\":7,\"quantity\":1}]', 'telegram', 'Btc', 'bf2ibTCdqx9kw3inZB5jlIy1RpJLQruHDMe54tkX.png', 5.00, 'telegaram', 'completed', '2025-02-28 22:45:21', '2025-02-28 23:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('agreedimogene@freesourcecodes.com', '$2y$12$ryF8Mg29E1TrgKi9TZOZGuYS.dZSiqho2fx/5zJ7fQtVTkHE3nDiy', '2025-03-01 00:17:10'),
('test@gmail.com', '$2y$12$vrVWwxDbHWFuy6CbvUaGDeES7bkfHjzJaln/iAwLNJ2y.6IPnogLS', '2025-03-01 00:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `instruction` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `rate`, `address`, `instruction`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Btc', 1.00, 'btc_kdsfkdjfdkfjdkfu8978e4ridjfi9384rejf93urofdu9e43rfdsfdsdsdsd', 'screenshot must', '67c1e4c6d0e18.png', 1, '2025-02-28 22:31:02', '2025-02-28 22:31:36'),
(2, 'Wallet', 1.00, NULL, NULL, '67c300b3387b4.png', 1, '2025-03-01 18:39:29', '2025-03-01 18:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `description`, `price`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(7, 8, 'Go2 bank', 'go2-bank', 'Go2 Bank  \r\nusa bank this bank you can use any website. this bank giving one virtual visa card.', 5.00, 10, 1, '2025-02-28 22:42:44', '2025-02-28 22:42:44'),
(8, 1, 'Cashapp Account 1 day old', 'cashapp-account-1-day-old', 'Cashapp Account 1 day old create. virtual card active cashapp account.', 10.00, 20, 1, '2025-02-28 22:55:50', '2025-02-28 22:55:50'),
(9, 1, 'Cashapp Account 1 Week Old', 'cashapp-account-1-week-old', 'Cashapp Account 1 Week Old. Virtual card active', 25.00, 10, 1, '2025-02-28 22:58:02', '2025-02-28 22:58:02'),
(10, 1, 'Cashapp Account 1 Months Old', 'cashapp-account-1-months-old', 'Cashapp Account 1 Months Old. Virtual card active', 45.00, 10, 1, '2025-02-28 23:09:23', '2025-02-28 23:09:23'),
(11, 1, 'Cashapp Account 2 months Old', 'cashapp-account-2-months-old', 'Cashapp Account 2 months Old. Virtual card active', 65.00, 5, 1, '2025-02-28 23:10:43', '2025-02-28 23:10:57'),
(12, 1, 'Cashapp Account 6 months + Old', 'cashapp-account-6-months-old', 'Cashapp Account 6 months + Old. Virtual card active', 100.00, 10, 1, '2025-02-28 23:13:07', '2025-02-28 23:13:07'),
(13, 1, 'Cashapp Account 1 years + Old', 'cashapp-account-1-years-old', 'Cashapp Account 1 years + Old', 100.00, 3, 1, '2025-02-28 23:16:02', '2025-02-28 23:16:10'),
(14, 1, 'Cashapp Account 2 Years + Old', 'cashapp-account-2-years-old', 'Cashapp Account 2 Years + Old', 120.00, 6, 1, '2025-02-28 23:17:49', '2025-02-28 23:17:49'),
(15, 2, 'Pia Proxy 100 ip panel', 'pia-proxy-100-ip-panel', 'Pia Proxy 100 ip panel only 20$', 20.00, 50, 1, '2025-02-28 23:24:01', '2025-02-28 23:24:01'),
(16, 4, 'pia proxy 1000 pis ip panel', 'pia-proxy-1000-pis-ip-panel', 'pia proxy 1000 pis ip panel', 50.00, 7, 1, '2025-02-28 23:26:21', '2025-02-28 23:26:21'),
(17, 4, 'pia proxy 2000 pies ip panel', 'pia-proxy-2000-pies-ip-panel', 'pia proxy 2000 pies ip panel', 100.00, 9, 1, '2025-02-28 23:28:06', '2025-02-28 23:28:06'),
(18, 3, 'Apple Gift Card 5$', 'apple-gift-card-5', 'Apple Gift Card 5$', 4.50, 2, 1, '2025-02-28 23:30:20', '2025-02-28 23:30:20'),
(19, 3, 'Razer gold gift card 5$', 'razer-gold-gift-card-5', 'Razer gold gift card 5$', 4.50, 1, 1, '2025-02-28 23:32:11', '2025-02-28 23:32:11'),
(20, 3, 'Google Play gift card 5$', 'google-play-gift-card-5', 'Google Play gift card 5$', 4.50, 3, 1, '2025-02-28 23:34:12', '2025-02-28 23:34:12'),
(21, 3, 'Amazon gift card 5$', 'amazon-gift-card-5', 'Amazon gift card 5$', 4.50, 6, 1, '2025-02-28 23:35:38', '2025-02-28 23:35:46'),
(22, 3, 'Visa token 5$', 'visa-token-5', 'Visa token 5$', 4.50, 3, 1, '2025-02-28 23:37:15', '2025-02-28 23:37:19'),
(23, 3, 'Visa token 10$', 'visa-token-10', 'Visa token 10$', 9.20, 4, 1, '2025-02-28 23:38:13', '2025-02-28 23:38:13'),
(24, 3, 'Visa token 20$', 'visa-token-20', 'Visa token 20$', 19.00, 5, 1, '2025-02-28 23:39:04', '2025-02-28 23:39:04'),
(25, 3, 'Mastercard token 10$', 'mastercard-token-10', 'Mastercard token 10$', 9.20, 5, 1, '2025-02-28 23:40:37', '2025-02-28 23:40:48'),
(26, 3, 'Mastercard token 20$', 'mastercard-token-20', 'Mastercard token 20$', 19.00, 6, 1, '2025-02-28 23:41:55', '2025-02-28 23:41:55'),
(27, 3, 'Mastercard token 50$', 'mastercard-token-50', 'Mastercard token 50$', 42.00, 6, 1, '2025-02-28 23:42:57', '2025-02-28 23:42:57'),
(28, 5, 'Textverifed 50$ Loaded account', 'textverifed-50-loaded-account', 'Textverifed 50$ Loaded account with mail access', 30.00, 2, 1, '2025-02-28 23:45:21', '2025-02-28 23:45:32'),
(29, 5, 'trueverifi 50$ Loaded account', 'trueverifi-50-loaded-account', 'trueverifi 50$ Loaded account', 30.00, 4, 1, '2025-02-28 23:47:31', '2025-02-28 23:47:31'),
(30, 5, 'Daiysms per 1$', 'daiysms-per-1', 'Daiysms per 1$ rate. how much dollar you want to buy type where and purchase.', 0.85, 1000, 1, '2025-02-28 23:54:42', '2025-02-28 23:54:57'),
(31, 6, 'tisocks panel 10$ credit', 'tisocks-panel-10-credit', 'tisocks panel. apnr telegram username othoba whatsapp number diben order korar por amder team apnr sathe jugajug korbe', 10.00, 10, 1, '2025-03-01 00:00:24', '2025-03-01 00:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `alt_text`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 7, '67c1e784d2230_1740760964.png', 'Go2 bank', '2025-02-28 22:42:44', '2025-02-28 22:42:44', NULL),
(8, 8, '67c1ea9696134_1740761750.png', 'Cashapp Account 1 day old', '2025-02-28 22:55:50', '2025-02-28 22:55:50', NULL),
(9, 9, '67c1eb1a30785_1740761882.png', 'Cashapp Account 1 Week Old', '2025-02-28 22:58:02', '2025-02-28 22:58:02', NULL),
(10, 10, '67c1edc39f2ba_1740762563.png', 'Cashapp Account 1 Months Old', '2025-02-28 23:09:23', '2025-02-28 23:09:23', NULL),
(11, 11, '67c1ee1381f8a_1740762643.png', 'Cashapp Account 2 months Old', '2025-02-28 23:10:43', '2025-02-28 23:10:43', NULL),
(12, 12, '67c1eea381220_1740762787.png', 'Cashapp Account 6 months + Old', '2025-02-28 23:13:07', '2025-02-28 23:13:07', NULL),
(13, 13, '67c1ef520d322_1740762962.png', 'Cashapp Account 1 years + Old', '2025-02-28 23:16:02', '2025-02-28 23:16:02', NULL),
(14, 14, '67c1efbd73d0a_1740763069.png', 'Cashapp Account 2 Years + Old', '2025-02-28 23:17:49', '2025-02-28 23:17:49', NULL),
(15, 15, '67c1f1316c9af_1740763441.png', 'Pia Proxy 100 ip panel', '2025-02-28 23:24:01', '2025-02-28 23:24:01', NULL),
(16, 16, '67c1f1bdd1b74_1740763581.png', 'pia proxy 1000 pis ip panel', '2025-02-28 23:26:21', '2025-02-28 23:26:21', NULL),
(17, 17, '67c1f22610fa4_1740763686.png', 'pia proxy 2000 pies ip panel', '2025-02-28 23:28:06', '2025-02-28 23:28:06', NULL),
(18, 18, '67c1f2acb6d21_1740763820.png', 'Apple Gift Card 5$', '2025-02-28 23:30:20', '2025-02-28 23:30:20', NULL),
(19, 19, '67c1f31b503b2_1740763931.png', 'Razer gold gift card 5$', '2025-02-28 23:32:11', '2025-02-28 23:32:11', NULL),
(20, 20, '67c1f394beb8c_1740764052.png', 'Google Play gift card 5$', '2025-02-28 23:34:12', '2025-02-28 23:34:12', NULL),
(21, 21, '67c1f3ea23c87_1740764138.png', 'Amazon gift card 5$', '2025-02-28 23:35:38', '2025-02-28 23:35:38', NULL),
(22, 22, '67c1f44b5c848_1740764235.png', 'Visa token 5$', '2025-02-28 23:37:15', '2025-02-28 23:37:15', NULL),
(23, 23, '67c1f485a6682_1740764293.png', 'Visa token 10$', '2025-02-28 23:38:13', '2025-02-28 23:38:13', NULL),
(24, 24, '67c1f4b8153a3_1740764344.png', 'Visa token 20$', '2025-02-28 23:39:04', '2025-02-28 23:39:04', NULL),
(25, 25, '67c1f51580b79_1740764437.png', 'Mastercard token 10$', '2025-02-28 23:40:37', '2025-02-28 23:40:37', NULL),
(26, 26, '67c1f563ad149_1740764515.png', 'Mastercard token 20$', '2025-02-28 23:41:55', '2025-02-28 23:41:55', NULL),
(27, 27, '67c1f5a197d97_1740764577.png', 'Mastercard token 50$', '2025-02-28 23:42:57', '2025-02-28 23:42:57', NULL),
(28, 28, '67c1f63179f13_1740764721.png', 'Textverifed 50$ Loaded account', '2025-02-28 23:45:21', '2025-02-28 23:45:21', NULL),
(29, 29, '67c1f6b32f23a_1740764851.png', 'trueverifi 50$ Loaded account', '2025-02-28 23:47:31', '2025-02-28 23:47:31', NULL),
(30, 30, '67c1f862f3ae9_1740765282.png', 'Daiysms per 1$', '2025-02-28 23:54:42', '2025-02-28 23:54:42', NULL),
(31, 31, '67c1f9b8b7984_1740765624.png', 'tisocks panel 10$ credit', '2025-03-01 00:00:24', '2025-03-01 00:00:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3gS4ziw2Dk91kZbl6vfaRLYP5lDC0xHFQqZaphwl', NULL, '2a02:4780:11:c0de::21', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicTRJempqbjJlMWdrZ1o5bXVacnJXZmZaS2M2T3NYWnhoUTNiS2ZpeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1740886318),
('BzLJOD1qgtKXudzeBIOL491IMCoRJDiAsAnTtoo4', NULL, '103.72.212.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWViQWxpNnB4eGpDaERSd1lLb2R3dVlDYXNBaVVQelZMMVB3aldPdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjIxO2E6Mjp7czo4OiJxdWFudGl0eSI7aToxO3M6NzoicHJvZHVjdCI7aToyMTt9fX0=', 1740975758),
('c4sExPhHC4Bv7Fr81cAreMGWrdX9jdxXNRKElmFB', 1, '59.153.103.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWxFQ0tuSGtzMzdYc1lnRkg5d0Nhalp6SFh3bmhpZ2ZVa1lkMEFjaiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1740919929),
('CRBOiOMgofIqPKye4h9EHGBrWXU5JjSsvbHeeavr', NULL, '2400:c600:452f:cda3:308e:2fff:feb2:fb80', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHIxR3JaS0ZuYzhQNkZ4Zm1vaFEwQ2ptUTVsajFUVWw5REQ1NGU4ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbS9wdWJsaWMvc2hvcC9pcC1wcm94eS9waWEtcHJveHktMTAwMC1waXMtaXAtcGFuZWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1740843209),
('cygfz2N1evtI3K0dRyzZ2Fst9UWRcCsG7zZZiMni', NULL, '103.72.212.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/496.0.0.54.107;FBBV/701828306;FBDV/iPhone11,8;FBMD/iPhone;FBSN/iOS;FBSV/18.1.1;FBSS/2;FBCR/;FBID/phone;FBLC/en_US;FBOP/80]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak55ZGNBbllHcXlDa09oYUExcEZxMExsN1ZMOU1kSnNXM1E2OFNhSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE2OiJodHRwczovL2ZpbmRlYXJuaW5nLm95ZWxhYi5jb20vP2FsX2FwcGxpbmtfZGF0YT0lN0IlMjJxcGxfam9pbl9pZCUyMiUzQSUyMkYzRDU4RDE0LUYzRjktNDc3QS1BRjQxLUYwMjhDQURFMjU0NCUyMiU3RCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740835059),
('FrSYcRwxQ2a1MuUsq5FIoTgTcqkaqbmLBP8JFb2P', NULL, '59.153.103.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnA5NmFkV29ENlN4V2U3dkFQSkI0TEFPWFB5ZUZyWDRSaldUT25WOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbS9wdWJsaWMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1740891641),
('IXyURrlffkJ2T741DCV6Qp8rNdHzQzyH8Rk0JdOQ', NULL, '103.72.212.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWNIelVIbm1lQ0ViZWRaMFNHb0c4ZzlSamR6U2U3NGg1TG5Sd1BwSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740847650),
('k4PDpuR0XL3zghA5XFwWrzKMevVq6cu8mR4BRomB', NULL, '46.17.174.172', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:98.0) Gecko/20100101 Firefox/98.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjR6NkJNdVZCdFc3T1RvbXdlWVRQMjJvSWhUdFI0MU1UNmpwbDFHaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740864583),
('nNuKTLNCHjWVhPjFaMrCsxo2Hxjfl1uwGWDibtJN', NULL, '103.72.212.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3NkbklXYjdVUmF0b01xMWZYTmdJT2VLOTA4NzlOM3paVWt6cFVmbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740918945),
('nslueAXQ7o8BBN712Ql24GOAnexzHBiiDzCdu2by', NULL, '2a02:4780:11:c0de::21', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZDBsWE1vSzFNN0MxaHozZFR5R2d4dDMzWmhBTnk5Y1RiMTAyM2oyMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1740977594),
('NTXwt299plNlXGq8uUX9ZEyAX1eEYizKEkB6qPtl', NULL, '82.197.68.199', 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjhRZlRXQnhlZ1JxcTRJbG1GcWJ1TkhhNTU1a2I5VkJwMkxhZ2cwciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740934741),
('R3HBDf0YeCa2k01Gd3mICkfgPfaQXD7viBjs5Q6l', NULL, '172.58.164.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVczQ3QyS3gxUXppOEhWQzEyYTd2VnVHTUZlbHB3ZnhyN0hGN2FSayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740907414),
('rJFmr1De6Wck2DKyIFpPOZu4WIvPYTyi4aiiU9eX', NULL, '59.153.103.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicjU1amh2QlhnUnF3RndQS2NlWWs3eTlxMkpldEVQQ2l6VllLV0VuRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODQ6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbS9wdWJsaWMvc2hvcC9udW1iZXItcG9ydGFsLXNpdGUtcmVjaGFyZ2UvZGFpeXNtcy1wZXItMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740915180),
('WRt0XmDmYwpfuucRRsViFy3TEVZO9q7PTwmqQET3', 1, '59.153.103.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTHV2QWczd01uRHpLZGtCYWNJWDlzYmMyQ1NqRUl4NjVseFRoTUFBdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbS9kYXNoYm9hcmQvcGF5bWVudC1tZXRob2RzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDA4MzI3Mzg7fXM6NDoiY2FydCI7YToyOntpOjEyO2E6Mjp7czo4OiJxdWFudGl0eSI7aToxO3M6NzoicHJvZHVjdCI7aToxMjt9aToxOTthOjI6e3M6ODoicXVhbnRpdHkiO2k6MTtzOjc6InByb2R1Y3QiO2k6MTk7fX19', 1740837119),
('Y66GAgz5UcuDjFk32fCp4CWQSnuU8G5bNSvOTidj', NULL, '172.59.194.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGNzanVWTDJOZmVFOUozV2xPbGk4TDJxODlNWnFVckN0Wm1JOERSbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbS8/cT10c29ja3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1740839039),
('Zb6VInkCFdgtCjh1zA4utvPhkyxUH4hj8dw7YtHw', NULL, '103.72.212.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieWtvOXBSNHp1S3ZLMjE5UkE0UUx0d2dRZnZHeTIwTEp6SzBHMDFYRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740914550),
('zwNeRi95vN7FTKPx7ofHMz9E16SKvrABn2R3fH1V', NULL, '172.58.164.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR05xcnQydnhMZ1BGN1NCWFRFR1JtQnp1anlDbDZOZ0g4cGFzZXkyYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHBzOi8vZmluZGVhcm5pbmcub3llbGFiLmNvbS9zaG9wL2Nhc2hhcHAtYWNjb3VudD9wYWdlPTEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1740908067);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'find earning', '67c1fab90461a.png', '2025-02-24 10:42:42', '2025-03-01 00:04:41'),
(2, 'Slider 2', '67bbf8dc585a4.jpg', '2025-02-24 10:43:08', '2025-02-24 10:43:08'),
(3, 'Slider 3', '67bbf8ee32697.jpg', '2025-02-24 10:43:26', '2025-02-24 10:43:26'),
(4, 'Slider 4', '67bbf906ec893.jpg', '2025-02-24 10:43:50', '2025-02-24 10:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `screenshot` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `payment_method_id`, `wallet_id`, `amount`, `status`, `screenshot`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 100.00, 'rejected', '9cLNv435SR3IDF4MQ64ymNIgo8QfhtdThMe2yJHP.png', '2025-02-28 22:32:39', '2025-02-28 22:33:35'),
(2, 3, 1, 1, 100.00, 'approved', '6Qx0MISEYn0GnEMnAbMPlGlYJARAUGd4mIrUCeaT.png', '2025-02-28 22:33:53', '2025-02-28 22:34:10'),
(3, 3, 1, 1, 10.00, 'pending', 'GAvxlCLvZvH5E4OSWjPN5l1NdMx0piDD2g0mFgJ1.png', '2025-03-01 00:26:52', '2025-03-01 00:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@findearning.us', NULL, NULL, '$2y$12$4BEzruc4IPpWhn1XSsyJhe73/ZF4uPzooXcIiuGzlm1j6z.6bXoT6', 1, 'mpB7NrNKf5rJVbv2p5atdPp1BaXlDzkxlM1EUYNRn5LFLQVhyNLOCrZISO7d', '2025-02-23 16:36:24', '2025-02-23 16:36:24'),
(2, 'Faisal Hasan', 'me@faisal.one', '01710541719', NULL, '$2y$12$S./eVDQ6T0gX9FI8ePkKy.KWAkcnCJ7zPHRUlDx4fckA/lhUsdiDK', 0, NULL, '2025-02-24 10:48:17', '2025-02-24 11:27:30'),
(3, 'test', 'test@gmail.com', '@test', NULL, '$2y$12$PmRJBbeTiGXiiMkJq3o4Qe7/8UKHqKkVdJn1qzomOZ4DCk7jisVtm', 0, 'TQn6A5lN1nYYXMtgAVc7qh5gmHAhcTbJ8XUxUxpnFzlws7cXNB9WiCCjf6X0', '2025-02-28 21:52:11', '2025-02-28 21:56:19'),
(4, 'test 1', 'agreedimogene@freesourcecodes.com', NULL, NULL, '$2y$12$NO7LfLg7r/Pc0gn3o53LkeJzMbFDeteiF6y6mLvG239p.XWgw1Eca', 0, NULL, '2025-03-01 00:16:59', '2025-03-01 00:16:59'),
(5, 'Gg', 'hhgff@gmail.com', 'Gg', NULL, '$2y$12$j0pmzsM9Y9WZ.q23OFLHNe.Fd/far1wPOw2iLMjWg59rSloSmUWRK', 0, NULL, '2025-03-03 10:22:02', '2025-03-03 10:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 3, 100.00, '2025-02-28 22:32:39', '2025-02-28 22:34:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
