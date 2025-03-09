-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 09, 2025 at 05:48 AM
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
(31, 31, '67c1f9b8b7984_1740765624.png', 'tisocks panel 10$ credit', '2025-03-01 00:00:24', '2025-03-01 00:00:24', NULL),
(32, 31, '67c65beea3f2b_1741052910.png', 'tisocks panel 10$ credit', '2025-03-04 07:48:30', '2025-03-04 07:48:30', NULL),
(33, 32, '67c65c397950c_1741052985.jpg', 'New', '2025-03-04 07:49:45', '2025-03-04 07:49:45', NULL),
(35, 33, '67c70d65857cd_1741098341.png', 'Daiysms per 1$', '2025-03-04 20:25:41', '2025-03-04 20:25:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
