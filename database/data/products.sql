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
(21, 3, 'Amazon gift card 5$', 'amazon-gift-card-5', 'Amazon gift card 5$', 4.50, 3, 1, '2025-02-28 23:35:38', '2025-03-09 10:41:31'),
(22, 3, 'Visa token 5$', 'visa-token-5', 'Visa token 5$', 4.50, 3, 1, '2025-02-28 23:37:15', '2025-02-28 23:37:19'),
(23, 3, 'Visa token 10$', 'visa-token-10', '✅ (Product Description)  ✅ Visa token 10$ Email Delivery send your gmail or telegram if you want whatasapp delivery then send your whatsapp number.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\ndkjfd\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\njkdjfdkasfsdka\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nlkdjfkdsaf', 9.20, 2, 1, '2025-02-28 23:38:13', '2025-03-08 21:28:34'),
(24, 3, 'Visa token 20$', 'visa-token-20', 'Visa token 20$', 19.00, 5, 1, '2025-02-28 23:39:04', '2025-02-28 23:39:04'),
(25, 3, 'Mastercard token 10$', 'mastercard-token-10', 'Mastercard token 10$', 9.20, 5, 1, '2025-02-28 23:40:37', '2025-02-28 23:40:48'),
(26, 3, 'Mastercard token 20$', 'mastercard-token-20', 'Mastercard token 20$', 19.00, 6, 1, '2025-02-28 23:41:55', '2025-02-28 23:41:55'),
(27, 3, 'Mastercard token 50$', 'mastercard-token-50', 'Mastercard token 50$', 42.00, 6, 1, '2025-02-28 23:42:57', '2025-02-28 23:42:57'),
(28, 5, 'Textverifed 50$ Loaded account', 'textverifed-50-loaded-account', 'Textverifed 50$ Loaded account with mail access', 30.00, 2, 1, '2025-02-28 23:45:21', '2025-02-28 23:45:32'),
(29, 5, 'trueverifi 50$ Loaded account', 'trueverifi-50-loaded-account', 'trueverifi 50$ Loaded account', 30.00, 4, 1, '2025-02-28 23:47:31', '2025-02-28 23:47:31'),
(31, 6, 'tisocks panel 10$ credit', 'tisocks-panel-10-credit', 'tisocks panel. apnr telegram username othoba whatsapp number diben order korar por amder team apnr sathe jugajug korbe', 10.00, 10, 1, '2025-03-01 00:00:24', '2025-03-01 00:00:24'),
(32, 1, 'New 1', 'new-1', 'ABC', 1.00, 1, 1, '2025-03-04 07:49:45', '2025-03-09 10:34:46'),
(33, 1, 'Daiysms per 1$', 'daiysms-per-1', 'Daiysms per 1$ rate. how much dollar you want to buy type where and purchase.', 0.85, 95, 1, '2025-03-04 20:25:41', '2025-03-09 11:32:37');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
