-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 09, 2025 at 05:49 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `image`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'CashApp Account', 'cashapp-account', 'CashApp Account', '67bafaa12bebe.png', 1, 1, '2025-02-23 16:38:25', '2025-03-08 16:05:40'),
(2, 'Discount Panel', 'discount-panel', 'Discount Panel', '67bbf41deaa06.png', 1, 2, '2025-02-24 10:22:53', '2025-03-08 16:05:40'),
(3, 'Gift Card', 'gift-card', 'Gift Card', '67bbf44288bd0.png', 1, 4, '2025-02-24 10:23:30', '2025-03-08 16:05:40'),
(4, 'IP Proxy', 'ip-proxy', 'IP Proxy', '67bbf45ae6487.png', 1, 5, '2025-02-24 10:23:54', '2025-03-08 16:05:40'),
(5, 'Number Portal Site Recharge', 'number-portal-site-recharge', 'Number Portal Site Recharge', '67bbf480b6d56.png', 1, 6, '2025-02-24 10:24:32', '2025-03-08 16:05:40'),
(6, 'Other Products', 'other-products', 'Other Products', '67bbf49278655.png', 1, 7, '2025-02-24 10:24:50', '2025-03-08 16:05:40'),
(7, 'Topup', 'topup', 'Topup', '67bbf4a1e14c6.png', 1, 3, '2025-02-24 10:25:05', '2025-03-08 16:05:40'),
(8, 'Us Bank Account', 'us-bank-account', 'Us Bank Account', '67bbf4b47483d.png', 1, 8, '2025-02-24 10:25:24', '2025-03-08 16:05:40'),
(12, 'Test secnd', 'test-secnd', 'Test secnd', '67cd2465065c5.png', 1, NULL, '2025-03-09 11:17:25', '2025-03-09 11:17:25'),
(13, 'Test Third', 'test-third', 'Test Third', '67cd248633071.png', 1, NULL, '2025-03-09 11:17:58', '2025-03-09 11:17:58'),
(14, 'Test one', 'test-one', 'Test one', '67cd25004e2f2.png', 1, NULL, '2025-03-09 11:20:00', '2025-03-09 11:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
