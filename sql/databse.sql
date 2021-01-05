-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2020 at 02:53 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `login_time` datetime DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `mobile`, `image`, `status`, `login_time`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Addministrator', 'admin', 'admin@admin.com', '08098987878', 'admin_1538903120.jpg', 1, '2018-05-04 14:36:07', '$2y$10$RFSj.6Nfd0T2DNAWFMMoj.vVmlixySIzeGwAfJEaNHap4j7xBuIqS', '37Gwfna22KaCxMMgckQqCNUllXZ9ZXazesNr26mVLgUHfWegngjsKwsWhkaT', '2018-03-26 06:08:23', '2020-04-30 11:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `account`, `accname`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FIRST CITY MONUMENT BANK', '1234567890', 'Merkley', 1, '2018-10-18 18:00:00', '2020-04-21 02:41:04'),
(2, 'Guarantee Trust Bank', '1234567890', 'Barklios', 1, '2018-10-18 18:00:00', '2020-04-20 00:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `basic_settings`
--

CREATE TABLE `basic_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sitename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `baseurl` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sym` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration` tinyint(1) NOT NULL DEFAULT 0,
  `login` int(55) NOT NULL,
  `maintain` int(55) DEFAULT NULL,
  `rubies_secretkey` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rubies_publickey` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clubkonnect_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clubkonnect_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutterwave_url` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://api.flutterwave.com/v3',
  `flutterwave_seckey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_create_charges` int(255) NOT NULL DEFAULT 0,
  `card_terminate_charges` int(255) NOT NULL DEFAULT 0,
  `dollar_rate` int(255) NOT NULL DEFAULT 450,
  `sms_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `husmotoken` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decoderfee` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electricityfee` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smscharge` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_verification` tinyint(1) NOT NULL DEFAULT 0,
  `email_notification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_notification` tinyint(4) NOT NULL DEFAULT 0,
  `level_one` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_two` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_three` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sending_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `transcharge` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depocharge` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal` int(2) NOT NULL,
  `cron` tinyint(4) NOT NULL DEFAULT 0,
  `map_api` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` tinyint(4) NOT NULL DEFAULT 0,
  `refcom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `trxcancel` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minbonus` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc` varchar(44) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bvn` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step4` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step5` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `htitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hstitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_settings`
--

INSERT INTO `basic_settings` (`id`, `sitename`, `baseurl`, `phone`, `email`, `address`, `currency`, `currency_sym`, `registration`, `login`, `maintain`, `rubies_secretkey`, `rubies_publickey`, `clubkonnect_key`, `clubkonnect_id`, `flutterwave_url`, `flutterwave_seckey`, `card_create_charges`, `card_terminate_charges`, `dollar_rate`, `sms_token`, `husmotoken`, `decoderfee`, `electricityfee`, `smscharge`, `email_verification`, `sms_verification`, `email_notification`, `sms_notification`, `level_one`, `level_two`, `level_three`, `sending_charge`, `transcharge`, `depocharge`, `decimal`, `cron`, `map_api`, `location`, `refcom`, `trxcancel`, `about`, `about_title`, `terms`, `privacy`, `policy`, `rate`, `bonus`, `minbonus`, `ref`, `kyc`, `vision`, `mission`, `goal`, `bvn`, `step1`, `step2`, `step3`, `step4`, `step5`, `htitle`, `hstitle`, `facebook`, `google`, `twitter`, `instagram`, `theme`, `timezone`, `created_at`, `updated_at`) VALUES
(1, 'Vision-X Crypto', 'https://test2.visionxcrypto.com', '09067444445', 'do-not-reply@url.com', 'Wuse Zone 2, Eragon, Australia', 'NGN', '₦', 1, 1, 0, 'SK-0000993932865280971-PROD-0C1EBA8BA84344A28B72219F6F01FE588ADE6A85FB584759B62987435993B74A', 'PK-0000993932865280971-PROD-12D13D9164744F46B86C211E469B2645FE6FE6155AD04CEE9C0BE71CE7F187B3', 'W5352Q23GDS924D7UA1B84YYY506178I69DDE4JR1ZRAR80FCBQF819D4T7HKI85', 'CK10123847', 'https://api.flutterwave.com/v3', 'FLWSECK-177db13c1e7de07156f65b714cf90b02-X', 50, 50, 450, 'kEJD70yfyhvru5SOjYjLJ3RZUD6m72AbRfdO05XRLD0CsMDMdeoKsRL6oHu7', '7012e7302be559c7b91fdd3585190009efc92628', '100', '100', '5', 0, 1, 1, 0, '3', '2', '1', '40', '100', '50', 2, 0, 'AIzaSyDi-rrw9lb-uKY1vHd9gkzuBpj4-hiBsUA', 0, '0', '30', '<span style=\"color: rgb(128, 128, 163); font-family: Poppins, sans-serif; font-size: 16px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</span>', 'Who We Are', 'AJAX (Asynchronous JavaScript and XML) is the art of exchanging data with a server, and updating parts of a web page – without reloading the whole page.\r\n\r\nOur earlier blog post already explained about form submission without page refresh, but it was done by using  ajax, PHP and jQuery.\r\n\r\nNow you will learn same functionality using ajax, PHP and Javascript through this blog post . Just follow our post or download it to use.', 'AJAX (Asynchronous JavaScript and XML) is the art of exchanging data with a server, and updating parts of a web page – without reloading the whole page.\r\n\r\nOur earlier blog post already explained about form submission without page refresh, but it was done by using  ajax, PHP and jQuery.\r\n\r\nNow you will learn same functionality using ajax, PHP and Javascript through this blog post . Just follow our post or download it to use.', 'AJAX (Asynchronous JavaScript and XML) is the art of exchanging data with a server, and updating parts of a web page – without reloading the whole page.\r\n\r\nOur earlier blog post already explained about form submission without page refresh, but it was done by using  ajax, PHP and jQuery.\r\n\r\nNow you will learn same functionality using ajax, PHP and Javascript through this blog post . Just follow our post or download it to use.', '389.7', '12', '12', '5', '12', 'AJAX (Asynchronous JavaScript and XML) is the art of exchanging data with a server, and updating parts of a web page – without reloading the whole page.\r\n\r\nOur earlier blog post already explained about form submission without page refresh, but it was done by using  ajax, PHP and jQuery.\r\n\r\nNow you will learn same functionality using ajax, PHP and Javascript through this blog post . Just follow our post or download it to use.', 'AJAX (Asynchronous JavaScript and XML) is the art of exchanging data with a server, and updating parts of a web page – without reloading the whole page.\r\n\r\nOur earlier blog post already explained about form submission without page refresh, but it was done by using  ajax, PHP and jQuery.\r\n\r\nNow you will learn same functionality using ajax, PHP and Javascript through this blog post . Just follow our post or download it to use.', 'AJAX (Asynchronous JavaScript and XML) is the art of exchanging data with a server, and updating parts of a web page – without reloading the whole page.\r\n\r\nOur earlier blog post already explained about form submission without page refresh, but it was done by using  ajax, PHP and jQuery.\r\n\r\nNow you will learn same functionality using ajax, PHP and Javascript through this blog post . Just follow our post or download it to use.', '50', 'Reg', 'Log', 'App', 'Red', 'Blue', 'DM Exchange Pro Version', 'The Best Cryptocurrency Trading Script OnThe Internet', 'www.facebook.com/url', 'www.googleplus.com/url', 'www.twitter.com/url', 'www.instagram.com/url', 'blue.css', 'Africa/Lagos', NULL, '2020-12-04 17:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alerts', 1, '2018-06-10 05:01:22', '2018-10-08 00:00:46'),
(2, 'Urgent', 1, '2018-06-10 05:01:49', '2018-10-08 00:00:33'),
(3, 'Sales', 1, '2018-06-10 05:02:01', '2018-10-08 00:00:10'),
(4, 'Purchase', 1, '2018-06-10 05:02:14', '2018-10-07 23:59:56'),
(5, 'Promo', 1, '2018-10-07 23:47:15', '2018-10-07 23:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cryptowallets`
--

CREATE TABLE `cryptowallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `coin_id` int(11) NOT NULL,
  `name` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `balance` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cryptowallets`
--

INSERT INTO `cryptowallets` (`id`, `coin_id`, `name`, `address`, `user_id`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(125, 1, 'Ethereum', '3J98t1WpEZ73CNmQviecrnyiWrnqRhWNLy', 10, '0.99876759', 1, '2020-04-08 00:05:50', '2020-04-12 14:46:19'),
(127, 3, 'Bitcoin Cash', '3J98T1WPEZ73CNMQVIECRNYIWRNQRHWNLY', 10, '99.80936', 1, '2020-04-08 00:05:50', '2020-04-23 10:20:32'),
(128, 4, 'Litecoin', '0', 10, '1', 1, '2020-04-08 00:05:50', '2020-04-08 00:05:50'),
(129, 5, 'Bitcoin', '3J98t1WpEZ73CNmQviecrnyiWrnqRhWNLy', 10, '1218.40085', 1, '2020-04-08 00:05:50', '2020-04-23 10:56:10'),
(130, 10, 'Dash', '0', 10, '0', 1, '2020-04-08 00:05:50', '2020-04-08 00:05:50'),
(131, 11, 'Perfect Money', '0', 10, '0', 1, '2020-04-08 00:05:50', '2020-04-08 00:05:50'),
(132, 112, 'Doge', '0', 10, '0', 1, '2020-04-08 16:14:42', '2020-04-08 16:14:42'),
(133, 1, 'Ethereum', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(134, 3, 'Bitcoin Cash', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(135, 4, 'Litecoin', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(136, 5, 'Bitcoin', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(137, 10, 'Dash', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(138, 11, 'Perfect Money', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(139, 112, 'Doge', '0', 14, '0', 1, '2020-04-25 14:14:43', '2020-04-25 14:14:43'),
(140, 1, 'Ethereum', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(141, 3, 'Bitcoin Cash', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(142, 4, 'Litecoin', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(143, 5, 'Bitcoin', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(144, 10, 'Dash', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(145, 11, 'Perfect Money', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(146, 112, 'Doge', '0', 15, '0', 1, '2020-04-29 06:47:26', '2020-04-29 06:47:26'),
(147, 1, 'Ethereum', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(148, 3, 'Bitcoin Cash', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(149, 4, 'Litecoin', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(150, 5, 'Bitcoin', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(151, 10, 'Dash', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(152, 11, 'Perfect Money', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(153, 112, 'Doge', '0', 16, '0', 1, '2020-04-29 15:47:19', '2020-04-29 15:47:19'),
(154, 1, 'Ethereum', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(155, 3, 'Bitcoin Cash', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(156, 4, 'Litecoin', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(157, 5, 'Bitcoin', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(158, 10, 'Dash', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(159, 11, 'Perfect Money', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(160, 112, 'Doge', '0', 17, '0', 1, '2020-05-10 19:03:19', '2020-05-10 19:03:19'),
(161, 1, 'Ethereum', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(162, 3, 'Bitcoin Cash', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(163, 4, 'Litecoin', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(164, 5, 'Bitcoin', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(165, 10, 'Dash', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(166, 11, 'Perfect Money', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(167, 112, 'Doge', '0', 18, '0', 1, '2020-05-15 19:22:59', '2020-05-15 19:22:59'),
(168, 1, 'Ethereum', '0', 19, '0', 1, '2020-09-29 19:59:38', '2020-09-29 19:59:38'),
(169, 3, 'Bitcoin Cash', '0', 19, '0', 1, '2020-09-29 19:59:38', '2020-09-29 19:59:38'),
(170, 4, 'Litecoin', '0', 19, '0', 1, '2020-09-29 19:59:38', '2020-09-29 19:59:38'),
(171, 5, 'Bitcoin', '0', 19, '0', 1, '2020-09-29 19:59:39', '2020-09-29 19:59:39'),
(172, 10, 'Dash', '0', 19, '0', 1, '2020-09-29 19:59:39', '2020-09-29 19:59:39'),
(173, 11, 'Perfect Money', '0', 19, '0', 1, '2020-09-29 19:59:39', '2020-09-29 19:59:39'),
(174, 112, 'Doge', '0', 19, '0', 1, '2020-09-29 19:59:39', '2020-09-29 19:59:39'),
(175, 1, 'Ethereum', '0', 20, '0', 1, '2020-10-08 10:37:39', '2020-10-08 10:37:39'),
(176, 3, 'Bitcoin Cash', '0', 20, '0', 1, '2020-10-08 10:37:39', '2020-10-08 10:37:39'),
(177, 4, 'Litecoin', '0', 20, '0', 1, '2020-10-08 10:37:39', '2020-10-08 10:37:39'),
(178, 5, 'Bitcoin', '0', 20, '0', 1, '2020-10-08 10:37:40', '2020-10-08 10:37:40'),
(179, 10, 'Dash', '0', 20, '0', 1, '2020-10-08 10:37:40', '2020-10-08 10:37:40'),
(180, 11, 'Perfect Money', '0', 20, '0', 1, '2020-10-08 10:37:40', '2020-10-08 10:37:40'),
(181, 112, 'Doge', '0', 20, '0', 1, '2020-10-08 10:37:40', '2020-10-08 10:37:40'),
(182, 1, 'Ethereum', '0', 21, '0', 1, '2020-10-09 20:30:23', '2020-10-09 20:30:23'),
(183, 3, 'Bitcoin Cash', '0', 21, '0', 1, '2020-10-09 20:30:23', '2020-10-09 20:30:23'),
(184, 4, 'Litecoin', '0', 21, '0', 1, '2020-10-09 20:30:23', '2020-10-09 20:30:23'),
(185, 5, 'Bitcoin', '0', 21, '0', 1, '2020-10-09 20:30:24', '2020-10-09 20:30:24'),
(186, 10, 'Dash', '0', 21, '0', 1, '2020-10-09 20:30:24', '2020-10-09 20:30:24'),
(187, 11, 'Perfect Money', '0', 21, '0', 1, '2020-10-09 20:30:24', '2020-10-09 20:30:24'),
(188, 112, 'Doge', '0', 21, '0', 1, '2020-10-09 20:30:24', '2020-10-09 20:30:24'),
(189, 1, 'Ethereum', '0', 22, '0', 1, '2020-10-09 20:36:08', '2020-10-09 20:36:08'),
(190, 3, 'Bitcoin Cash', '0', 22, '0', 1, '2020-10-09 20:36:08', '2020-10-09 20:36:08'),
(191, 4, 'Litecoin', '0', 22, '0', 1, '2020-10-09 20:36:09', '2020-10-09 20:36:09'),
(192, 5, 'Bitcoin', '0', 22, '0', 1, '2020-10-09 20:36:09', '2020-10-09 20:36:09'),
(193, 10, 'Dash', '0', 22, '0', 1, '2020-10-09 20:36:09', '2020-10-09 20:36:09'),
(194, 11, 'Perfect Money', '0', 22, '0', 1, '2020-10-09 20:36:09', '2020-10-09 20:36:09'),
(195, 112, 'Doge', '0', 22, '0', 1, '2020-10-09 20:36:10', '2020-10-09 20:36:10'),
(196, 1, 'Ethereum', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(197, 3, 'Bitcoin Cash', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(198, 4, 'Litecoin', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(199, 5, 'Bitcoin', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(200, 10, 'Dash', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(201, 11, 'Perfect Money', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(202, 112, 'Doge', '0', 23, '0', 1, '2020-10-15 17:12:41', '2020-10-15 17:12:41'),
(203, 1, 'Ethereum', '0', 24, '0', 1, '2020-10-15 17:19:13', '2020-10-15 17:19:13'),
(204, 3, 'Bitcoin Cash', '0', 24, '0', 1, '2020-10-15 17:19:14', '2020-10-15 17:19:14'),
(205, 4, 'Litecoin', '0', 24, '0', 1, '2020-10-15 17:19:14', '2020-10-15 17:19:14'),
(206, 5, 'Bitcoin', '0', 24, '0', 1, '2020-10-15 17:19:14', '2020-10-15 17:19:14'),
(207, 10, 'Dash', '0', 24, '0', 1, '2020-10-15 17:19:14', '2020-10-15 17:19:14'),
(208, 11, 'Perfect Money', '0', 24, '0', 1, '2020-10-15 17:19:14', '2020-10-15 17:19:14'),
(209, 112, 'Doge', '0', 24, '0', 1, '2020-10-15 17:19:14', '2020-10-15 17:19:14'),
(210, 1, 'Ethereum', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(211, 3, 'Bitcoin Cash', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(212, 4, 'Litecoin', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(213, 5, 'Bitcoin', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(214, 10, 'Dash', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(215, 11, 'Perfect Money', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(216, 112, 'Doge', '0', 25, '0', 1, '2020-10-28 03:35:47', '2020-10-28 03:35:47'),
(217, 1, 'Ethereum', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(218, 3, 'Bitcoin Cash', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(219, 4, 'Litecoin', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(220, 5, 'Bitcoin', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(221, 10, 'Dash', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(222, 11, 'Perfect Money', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(223, 112, 'Doge', '0', 28, '0', 1, '2020-10-28 15:24:41', '2020-10-28 15:24:41'),
(224, 1, 'Ethereum', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(225, 3, 'Bitcoin Cash', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(226, 4, 'Litecoin', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(227, 5, 'Bitcoin', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(228, 10, 'Dash', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(229, 11, 'Perfect Money', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(230, 112, 'Doge', '0', 29, '0', 1, '2020-11-07 16:27:47', '2020-11-07 16:27:47'),
(231, 1, 'Ethereum', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(232, 3, 'Bitcoin Cash', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(233, 4, 'Litecoin', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(234, 5, 'Bitcoin', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(235, 10, 'Dash', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(236, 11, 'Perfect Money', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(237, 112, 'Doge', '0', 30, '0', 1, '2020-11-07 17:26:51', '2020-11-07 17:26:51'),
(238, 1, 'Ethereum', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(239, 3, 'Bitcoin Cash', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(240, 4, 'Litecoin', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(241, 5, 'Bitcoin', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(242, 10, 'Dash', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(243, 11, 'Perfect Money', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(244, 112, 'Doge', '0', 31, '0', 1, '2020-11-07 19:39:56', '2020-11-07 19:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_id` int(55) DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `buy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_coin` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `icon`, `api_id`, `price`, `exchange`, `sell`, `buy`, `payment_id`, `image`, `is_coin`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ethereum', 'ETH', 'eth', 1027, '6.78298810917909', '4', '400', '435', 'ethereum2.png', 'ethereum2.png', 1, 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(3, 'Bitcoin Cash', 'BCH', 'btc-alt', 1839, '253.722168217656', '5', '390', '400', 'BCH987784654341', 'bitcoin-cash_1539867845.png', 1, 0, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29'),
(4, 'Litecoin', 'LTC', 'ltc', 2, '47.2300754331777', '5', '370', '400', 'litecoin2.png', 'litecoin2.png', 1, 0, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(5, 'Bitcoin', 'BTC', 'btc', 1, '8176.04012491238', NULL, '450', '400', '2WXGHHJSLIHBJSBHKUW78JH', 'bitcoin2.png', 1, 1, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39'),
(10, 'Dash', 'DASH', 'dash', 131, '84.9192122465504', '7', '400', '400', 'Dash3132332131', 'dash_1539868063.png', 1, 0, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29'),
(11, 'Perfect Money', 'PM', 'paypal', NULL, '1', NULL, '390', '420', 'demo.pm@pm.com', 'perfect-money_1540216154.png', 0, 1, NULL, '2018-10-22 07:49:14', '2020-04-28 13:24:33'),
(112, 'Doge', 'DGE', 'dash', 74, '78.78', '8', '380', '400', 'Dash3132332131', 'dash_1539868063.png', 1, 0, NULL, '2018-02-15 00:36:57', '2020-04-17 13:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `image` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `gateway_id`, `currency_id`, `amount`, `title`, `charge`, `usd`, `trx`, `status`, `image`, `code`, `created_at`, `updated_at`) VALUES
(42, 10, 513, NULL, '500', NULL, '30', '1.36', 'LMuyWoVH2o6Pingh', 1, '5f80d47f0d38a.jpg', '73228623623623', '2020-10-09 20:18:07', '2020-10-09 20:25:11'),
(43, 10, 103, NULL, '500', NULL, '18', '1.33', 'Z3hKYI8Q87ybBhUF', 0, NULL, NULL, '2020-10-17 21:11:28', '2020-10-17 21:11:28'),
(44, 10, 0, NULL, '500', NULL, '0', '1.28', 'bPiZI13nOYKIF2Ml', 0, NULL, NULL, '2020-10-25 13:02:05', '2020-10-25 13:02:05'),
(45, 10, 513, NULL, '500', NULL, '30', '1.36', 'ITk77Q7JAmI4cMGu', 0, NULL, NULL, '2020-10-25 13:12:10', '2020-10-25 13:12:10'),
(46, 10, 514, NULL, '500', NULL, '30', '1.36', '6y4xyJJbzrpHjzG8', 0, NULL, NULL, '2020-10-25 13:14:38', '2020-10-25 13:14:38'),
(47, 10, 513, NULL, '100', NULL, '10', '0.28', 'mEcvGvI9Vmhx99Cp', 0, NULL, NULL, '2020-10-25 13:42:06', '2020-10-25 13:42:06'),
(48, 10, 0, NULL, '600', NULL, '0', '1.54', 'nuzpCZaDMjVVpOu8', 0, NULL, NULL, '2020-10-25 14:06:20', '2020-10-25 14:06:20'),
(49, 10, 513, NULL, '1000', NULL, '55', '2.71', 'AC4C6SPsKNkRIndB', 0, NULL, NULL, '2020-10-25 14:26:35', '2020-10-25 14:26:35'),
(50, 10, 515, NULL, '500', NULL, '30', '1.36', 'h8ITmAwbVR8E3ii3', 0, NULL, NULL, '2020-10-25 14:46:27', '2020-10-25 14:46:27'),
(51, 10, 102, NULL, '500', NULL, '30', '1.36', 'MQ2PAASUI9laxZrU', 0, NULL, NULL, '2020-10-25 15:09:00', '2020-10-25 15:09:00'),
(52, 10, 102, NULL, '500', NULL, '30', '1.36', 'xyyhWBNkHm5CEQHr', 0, NULL, NULL, '2020-10-25 15:51:05', '2020-10-25 15:51:05'),
(53, 10, 102, NULL, '500', NULL, '30', '1.36', 'KJpDyXunwSC3YD8P', 0, NULL, NULL, '2020-10-25 15:54:05', '2020-10-25 15:54:05'),
(54, 10, 102, NULL, '500', NULL, '30', '1.36', 'm79Vc7ObW612ZF6g', 0, NULL, NULL, '2020-10-25 16:13:42', '2020-10-25 16:13:42'),
(55, 10, 102, NULL, '100', NULL, '10', '0.28', 'DJmDBxeXhCBGxhkS', 0, NULL, NULL, '2020-10-25 18:30:17', '2020-10-25 18:30:17'),
(56, 10, 0, NULL, '5000', NULL, '0', '12.83', '8SPLAloDdeo7KxmT', 0, NULL, NULL, '2020-10-26 20:36:49', '2020-10-26 20:36:49'),
(57, 10, 513, NULL, '20000', NULL, '1005', '53.9', 'SwowPQQuJDWznK5C', 0, NULL, NULL, '2020-10-26 20:40:54', '2020-10-26 20:40:54'),
(58, 10, 514, NULL, '20000', NULL, '1005', '53.9', 'x4kIT4smJLmEVIEo', 0, NULL, NULL, '2020-10-26 20:41:13', '2020-10-26 20:41:13'),
(59, 10, 102, NULL, '20000', NULL, '1005', '53.9', 'WVXAXG6mkeDxS4cL', 0, NULL, NULL, '2020-10-26 20:41:27', '2020-10-26 20:41:27'),
(60, 10, 0, NULL, '5000', NULL, '0', '12.83', 'IALLDaoYEjXBMTZj', 0, NULL, NULL, '2020-10-26 23:02:14', '2020-10-26 23:02:14'),
(61, 10, 513, NULL, '5000', NULL, '255', '13.48', 'vTqIWJpJgcaoF4bu', 0, NULL, NULL, '2020-10-27 13:23:15', '2020-10-27 13:23:15'),
(62, 10, 0, NULL, '5000', NULL, '0', '12.83', '1iQIuuQJUkLdH63H', 0, NULL, NULL, '2020-10-27 13:23:53', '2020-10-27 13:23:53'),
(63, 10, 0, NULL, '5', NULL, '0', '0.01', 'Lf26pgTemQAOtCtc', 0, NULL, NULL, '2020-10-29 00:48:10', '2020-10-29 00:48:10'),
(64, 25, 0, NULL, '5000', NULL, '0', '12.83', 'ICyN19fgSsGGkUQL', 0, NULL, NULL, '2020-10-29 14:19:15', '2020-10-29 14:19:15'),
(65, 10, 0, NULL, '5999', NULL, '0', '15.39', 'wdkpD5G3lowYSxmS', 0, NULL, NULL, '2020-10-31 19:36:22', '2020-10-31 19:36:22'),
(66, 10, 513, NULL, '500', NULL, '30', '1.36', 'tpHiRZGQqO3jlBzc', 0, NULL, NULL, '2020-11-02 23:20:02', '2020-11-02 23:20:02'),
(67, 10, 513, NULL, '700', NULL, '40', '1.9', 'is8xq6CBSNU645lj', 0, NULL, NULL, '2020-11-06 22:23:19', '2020-11-06 22:23:19'),
(68, 10, 0, NULL, '60000', NULL, '0', '153.96', 'xKejFXFLL0L2PLJR', 0, NULL, NULL, '2020-11-06 22:24:47', '2020-11-06 22:24:47'),
(69, 10, 0, NULL, '60000', NULL, '0', '153.96', 'qyTJ70DE7ApgBJ9C', 0, NULL, NULL, '2020-11-06 22:24:49', '2020-11-06 22:24:49'),
(70, 10, 0, NULL, '8000', NULL, '0', '20.53', 'URYbQGBqP9RbTRPu', 0, NULL, NULL, '2020-11-06 22:26:46', '2020-11-06 22:26:46'),
(71, 10, 0, NULL, '1000', NULL, '0', '2.57', 'j4MsavIYuEqtqd4q', 0, NULL, NULL, '2020-11-06 22:36:38', '2020-11-06 22:36:38'),
(72, 25, 0, NULL, '1000', NULL, '0', '2.57', 'PTiWqIcw1N6IJxgm', 0, NULL, NULL, '2020-11-07 16:19:59', '2020-11-07 16:19:59'),
(73, 29, 0, NULL, '1000', NULL, '0', '2.57', 'CfwUqoeOOgX8JKfk', 0, NULL, NULL, '2020-11-07 16:28:07', '2020-11-07 16:28:07'),
(74, 29, 0, NULL, '98000.00', NULL, '0', '0', '123', 1, NULL, NULL, '2020-11-07 17:37:30', '2020-11-07 17:37:30'),
(75, 31, 0, NULL, '50.00', NULL, '0', '0', '123', 1, NULL, NULL, '2020-11-07 19:34:26', '2020-11-07 19:34:26'),
(76, 31, 0, NULL, '50.00', NULL, '0', '0', '123', 1, NULL, NULL, '2020-11-07 19:42:29', '2020-11-07 19:42:29'),
(77, 10, 0, NULL, '5000', NULL, '0', '12.83', 'bkN2ICOmtiBFG9BA', 0, NULL, NULL, '2020-11-08 13:45:28', '2020-11-08 13:45:28'),
(78, 10, 0, NULL, '600', NULL, '0', '1.54', '6cVMWhWDGhGuUbEp', 0, NULL, NULL, '2020-11-08 13:58:45', '2020-11-08 13:58:45'),
(79, 10, 0, NULL, '600', NULL, '0', '1.54', 'QHfic1fUtYkJGnlD', 0, NULL, NULL, '2020-11-08 14:00:49', '2020-11-08 14:00:49'),
(80, 10, 0, NULL, '5000', NULL, '0', '12.83', 'y7cyUxq6lWxw16mu', 0, NULL, NULL, '2020-11-09 02:28:49', '2020-11-09 02:28:49'),
(81, 10, 0, NULL, '5000', NULL, '0', '12.83', 'dFutjXYWJbyuvCMZ', 0, NULL, NULL, '2020-11-09 14:01:28', '2020-11-09 14:01:28'),
(82, 31, 0, NULL, '500', NULL, '0', '1.28', 'yS3e0WzZbWFMG7yk', 0, NULL, NULL, '2020-11-10 03:38:45', '2020-11-10 03:38:45'),
(83, 10, 0, NULL, '5000', NULL, '0', '12.83', 'EQ0otI6sQhFNaz0t', 0, NULL, NULL, '2020-11-12 16:49:33', '2020-11-12 16:49:33'),
(84, 10, 0, NULL, '200', NULL, '0', '0.51', '5qi0NNkatoBn3Dbu', 0, NULL, NULL, '2020-11-12 21:33:25', '2020-11-12 21:33:25'),
(85, 10, 0, NULL, '1000', NULL, '50', '2.57', 'YYLIZIoGDj1c4HNq', 0, NULL, NULL, '2020-11-12 21:41:20', '2020-11-12 21:41:20'),
(86, 31, 0, NULL, '1000', NULL, '50', '2.57', 'M1UJKaCdGRlp14PN', 0, NULL, NULL, '2020-11-13 01:19:20', '2020-11-13 01:19:20'),
(87, 10, 0, NULL, '50', NULL, '50', '0.13', 'Qgj9m6oEcw1uTkHL', 0, NULL, NULL, '2020-11-13 01:27:03', '2020-11-13 01:27:03'),
(88, 31, 0, NULL, '1000.00', NULL, '50', '0', 'DSFGYBIZCJIEMT6HYQJ9', 1, NULL, NULL, '2020-11-13 01:28:30', '2020-11-13 01:28:30'),
(89, 31, 0, NULL, '5000', NULL, '50', '12.83', 'G3VtFmkZV9qUaMds', 0, NULL, NULL, '2020-11-13 06:59:11', '2020-11-13 06:59:11'),
(90, 31, 0, NULL, '100', NULL, '50', '0.26', '8Mzh5jTB7cZ5FgRe', 0, NULL, NULL, '2020-11-13 17:04:33', '2020-11-13 17:04:33'),
(91, 31, 0, NULL, '1000', NULL, '50', '2.57', '9ZcSWMpenrec0FrM', 0, NULL, NULL, '2020-11-18 02:42:08', '2020-11-18 02:42:08'),
(92, 31, 0, NULL, '1000', NULL, '50', '2.57', 'l2T2un9kTGrqexi9', 0, NULL, NULL, '2020-11-18 02:42:08', '2020-11-18 02:42:08'),
(93, 31, 0, NULL, '1000.00', NULL, '50', '0', 'JOF8QACYAEA0HVJUN3J2', 1, NULL, NULL, '2020-11-18 02:43:51', '2020-11-18 02:43:51'),
(94, 31, 0, NULL, '5000.00', NULL, '50', '0', 'GMIXROBPPZMIA4DDDSCF', 1, NULL, NULL, '2020-11-18 16:00:08', '2020-11-18 16:00:08'),
(95, 31, 0, NULL, '2000', NULL, '50', '5.13', 'zML2qUu6lc33flP3', 0, NULL, NULL, '2020-11-18 18:16:57', '2020-11-18 18:16:57'),
(96, 31, 0, NULL, '2000.00', NULL, '50', '0', 'OCKC9FRPVGVHRV3NGKIJ', 1, NULL, NULL, '2020-11-18 18:19:32', '2020-11-18 18:19:32'),
(97, 31, 0, NULL, '20000', NULL, '50', '51.32', 'U6ozpANJjsz0oYbn', 0, NULL, NULL, '2020-11-18 18:47:45', '2020-11-18 18:47:45'),
(98, 31, 513, NULL, '5000', NULL, '255', '13.48', 'ZbnOS55vb3A2KRne', 0, NULL, NULL, '2020-11-19 21:10:12', '2020-11-19 21:10:12'),
(99, 31, 514, NULL, '5000', NULL, '255', '13.48', 'PQXJ0mmmX6qXs1TK', 2, '5fb69973ae368.jpg', 'NG', '2020-11-19 21:11:33', '2020-11-19 21:12:35'),
(100, 31, 513, NULL, '5000', NULL, '255', '13.48', 'wXu3pkxNnPvwEzxt', 0, NULL, NULL, '2020-11-19 21:13:34', '2020-11-19 21:13:34'),
(101, 31, 0, NULL, '5000', NULL, '50', '12.83', '3mzbt0gMpPO2BfbU', 0, NULL, NULL, '2020-11-19 22:42:43', '2020-11-19 22:42:43'),
(102, 31, 0, NULL, '20000', NULL, '50', '51.32', 'dn0cVB5MtFN4Qz4l', 0, NULL, NULL, '2020-11-25 01:03:27', '2020-11-25 01:03:27'),
(103, 10, 0, NULL, '1000', NULL, '50', '2.57', 'G8luvMg7GXrk7K1O', 0, NULL, NULL, '2020-11-27 00:54:17', '2020-11-27 00:54:17'),
(104, 25, 0, NULL, '2000', NULL, '50', '5.13', 'Uwm9MKdhQl3ylX3e', 0, NULL, NULL, '2020-11-28 00:13:01', '2020-11-28 00:13:01'),
(105, 25, 0, NULL, '2000', NULL, '50', '5.13', 'BXSV0w9SD7XMLcLd', 0, NULL, NULL, '2020-11-28 00:13:02', '2020-11-28 00:13:02'),
(106, 10, 0, NULL, '450', NULL, '50', '1.15', 'cOgjp6EY3vGHfuDJ', 0, NULL, NULL, '2020-12-10 09:10:29', '2020-12-10 09:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `etemplates`
--

CREATE TABLE `etemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `esender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emessage` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smsapi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `etemplates`
--

INSERT INTO `etemplates` (`id`, `esender`, `mobile`, `emessage`, `smsapi`, `created_at`, `updated_at`) VALUES
(1, 'do-not-reply@coinex.com', '+01234567890', '<br><div class=\"wrapper\" style=\"background-color: #f2f2f2;\"><table id=\"emb-email-header-container\" class=\"header\" style=\"border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto;\" align=\"center\"><tbody><tr><td style=\"padding: 0; width: 600px;\"><br><div class=\"header__logo emb-logo-margin-box\" style=\"font-size: 26px; line-height: 32px; color: #c3ced9; font-family: Roboto,Tahoma,sans-serif; margin: 6px 20px 20px 20px;\"><img style=\"height: auto; width: 100%; border: 0; max-width: 312px;\" src=\"{{asset(\'assets/images/logo/logo.png\')}}\" alt=\"\" width=\"312\" height=\"44\"><br></div></td></tr></tbody></table><br><table class=\"layout layout--no-gutter\" style=\"border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;\" align=\"center\"><tbody><tr><td class=\"column\" style=\"padding: 0; text-align: left; vertical-align: top; color: #60666d; font-size: 14px; line-height: 21px; font-family: sans-serif; width: 600px;\"><br><div style=\"margin-left: 20px; margin-right: 20px;\"><font size=\"4\">Hi {{name}},<br></font><p><strong>{{message}}</strong></p></div><div style=\"margin-left: 20px; margin-right: 20px; margin-bottom: 24px;\"><br><p class=\"size-14\" style=\"margin-top: 0; margin-bottom: 0; font-size: 14px; line-height: 21px;\">Thanks,<br> <strong>{{$basic->sitename}} TEAM</strong></p><br></div><br></td></tr></tbody></table><br></div>', 'https://api.infobip.com/api/v3/sendsms/plain?user=****&password=****&sender=Exchangeo&SMSText={{message}}&GSM={{number}}&type=longSMS', '2018-01-09 23:45:09', '2020-04-29 00:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Is registration required on your site?', '<div>No, registration is not required. But if you sign up on our service, you can participate in the cumulative discount program and referral program.</div><div><br></div>', '2018-04-15 02:14:58', '2018-10-08 03:17:43'),
(2, 'How to make an exchange on your site?', '<div>You need to choose the direction of exchange and fill out an application for exchange. Click the Exchange button and follow the instructions that you will see in the confirmation window of the exchange request. If you have any questions in the exchange process, please contact the operator via the online help chat.</div><div><br></div>', '2018-04-15 02:15:11', '2018-10-08 03:19:27'),
(4, 'Do you have an affiliate program?', '<div>Yes. We have a very clear and transparent affiliate program, according to which you can receive 25% of our earnings for exchanging the users you cited. Remuneration payments are from 1 PMUSD. In your office you can track the operations of your referrals online. You can get acquainted with more detailed information after registration in your Personal Account.</div><div><br></div>', '2018-10-04 01:19:53', '2018-10-08 03:20:22'),
(6, 'How do I manage my  account?', 'To make changes to your account information, first go to your account Settings\r\n\r\nSign in to your account.\r\nSelect “Settings”.\r\nFrom “Settings”, select “Profile information”.\r\nTo change your password\r\n\r\nSelect “edit password”.\r\nEnter your current password.\r\nEnter your new password twice.\r\nSelect “change password” to complete and save your changes.\r\nTo change your address\r\n\r\nSelect “edit address”.\r\nEnter your new address.\r\nSelect “change address” to complete and save your changes.\r\nTo change your phone number\r\n\r\nSelect “edit phone number”.\r\nEnter your new phone number.\r\nSelect “change phone number” to complete and save your changes.\r\nTo change your email address\r\n\r\nSelect “edit email address”.\r\nEnter your new emai- address\r\nSelect “change email” to complete and save your changes.', '2018-10-04 01:20:48', '2020-04-20 02:00:35'),
(9, 'Welcome to the system. We hope......', 'Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......', '2020-04-21 02:38:20', '2020-04-21 02:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `main_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minamo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maxamo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin` int(22) DEFAULT NULL,
  `val1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'paytm Website',
  `val4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'paytm Industry Type',
  `val5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'paytm Channel ID',
  `val6` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'paytm Transaction URL',
  `val7` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'paytm Transaction Status URL',
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `main_name`, `name`, `minamo`, `maxamo`, `fixed_charge`, `percent_charge`, `rate`, `coin`, `val1`, `val2`, `val3`, `val4`, `val5`, `val6`, `val7`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Naira Wallet', 'Naira Wallet', '1', '55555555', NULL, NULL, NULL, 0, 'FLWPUBK_TEST-6973a7e9de42fd1e19e8ab8c73c5fdc3-X', NULL, NULL, NULL, NULL, NULL, 'flutter.png', 0, NULL, '2020-04-29 09:19:09'),
(100, 'Flutterwave', 'Flutterwave', '1', '55555555', NULL, NULL, NULL, 0, 'FLWPUBK_TEST-6973a7e9de42fd1e19e8ab8c73c5fdc3-X', NULL, NULL, NULL, NULL, NULL, 'flutter.png', 0, NULL, '2020-04-29 09:19:09'),
(102, 'CoinPayment', 'Perfect Money', '10', '1000000', '05', '5', '80', 1, 'U5220203', 'reg4e54h1grt1j', '7020ad85d8b76516FEf3FB86C5322EBeBcb64E2E5f6Fd7638E8208EBfc2b83a1', NULL, NULL, 'USD', 'pm.jpg', 1, NULL, '2020-04-24 03:58:40'),
(103, 'Stripe', 'Stripe', '10', '50000', '3', '3', '80', 0, 'sk_test_aat3tzBCCXXBkS4sxY3M8A1B', 'pk_test_AU3G7doZ1sbdpJLj0NaozPBu', NULL, NULL, NULL, NULL, 'stripe.png', 0, NULL, '2018-05-27 18:11:50'),
(107, 'Paystack', 'PayStack', '1', '999999999', NULL, NULL, NULL, 0, 'pk_test_257c929b64cda13f16d17e16b6fdec762aef0559', 'sk_test_ae65fab010dd2e551b8c9801528ed635c047baf2', NULL, NULL, NULL, NULL, 'paystac.png', 0, NULL, '2020-04-29 09:01:47'),
(512, 'CoinGate', 'CoinGate', '10', '1000000', '05', '5', '80', 1, 'Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N', NULL, NULL, NULL, NULL, NULL, 'pay-a.png', 0, '2018-07-08 16:00:00', '2018-05-20 23:20:54'),
(513, 'Bitcoin', 'Bitcoin', '10', '1000000', '05', '5', '80', 1, 'a1be7959e59ee24619a6743680aa90fd', 'cd2435dd9cd172a96dfe04f07bb97080b32d9a5eb7e2b56724ee756c55021fcd', '7020ad85d8b76516FEf3FB86C5322EBeBcb64E2E5f6Fd7638E8208EBfc2b83a1', NULL, NULL, 'USD', 'bitcoin2.png', 1, NULL, '2020-04-24 03:58:40'),
(514, 'Ethereum', 'Ethereum', '10', '1000000', '05', '5', '80', 1, 'a1be7959e59ee24619a6743680aa90fd', 'cd2435dd9cd172a96dfe04f07bb97080b32d9a5eb7e2b56724ee756c55021fcd', '7020ad85d8b76516FEf3FB86C5322EBeBcb64E2E5f6Fd7638E8208EBfc2b83a1', NULL, NULL, 'USD', 'ethereum2.png', 1, NULL, '2020-04-24 03:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `internets`
--

CREATE TABLE `internets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `network` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internets`
--

INSERT INTO `internets` (`id`, `name`, `code`, `amount`, `price`, `network`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(40, 'MTN 100 MB Data BUNDLE', 'D-MFIN-5-100MB', '100.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(41, 'MTN 200 MB Data BUNDLE', 'D-MFIN-5-200MB', '200.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(42, 'MTN 750 MB Data BUNDLE', 'D-MFIN-5-750MB', '500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(43, 'MTN 1500 MB Data BUNDLE', 'D-MFIN-5-1.5GB', '1000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(44, 'MTN 4500 MB Data BUNDLE', 'D-MFIN-5-4.5GB', '2000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(45, 'MTN 15000 MB Data BUNDLE', 'D-MFIN-5-15GB', '5000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(46, 'MTN 40000 MB Data BUNDLE', 'D-MFIN-5-40GB', '10000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(47, 'MTN 3000 MB Data BUNDLE', 'D-MFIN-5-3GB', '1500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(48, 'MTN 20000 MB Data BUNDLE', 'D-MFIN-5-20GB', '6000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(49, 'MTN 50 MB Data BUNDLE', 'D-MFIN-5-50MB', '50.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(50, 'MTN 350 MB Data BUNDLE', 'D-MFIN-5-350MB', '300.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(51, 'MTN 2000 MB Data BUNDLE', 'D-MFIN-5-2GB', '1200.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(52, 'MTN 10000 MB Data BUNDLE', 'D-MFIN-5-10GB', '3500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(53, 'MTN 75000 MB Data BUNDLE', 'D-MFIN-5-75GB', '15000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(54, 'MTN 110000 MB Data BUNDLE', 'D-MFIN-5-110GB', '20000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(55, 'MTN 120000 MB Data BUNDLE', 'D-MFIN-5-120GB', '30000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(56, 'MTN 150000 MB Data BUNDLE', 'D-MFIN-5-150GB-90D', '50000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(57, 'MTN 20 MB Data BUNDLE', 'D-MFIN-5-20MB', '25.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(58, 'MTN 160 MB Data BUNDLE', 'D-MFIN-5-160MB', '150.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(59, 'MTN 6000 MB Data BUNDLE', 'D-MFIN-5-6GB', '2500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(60, 'MTN 8000 MB Data BUNDLE', 'D-MFIN-5-8GB', '3000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(61, 'MTN 30000 MB Data BUNDLE', 'D-MFIN-5-30GB', '13500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(62, 'MTN 90000 MB Data BUNDLE', 'D-MFIN-5-90GB', '40000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(63, 'MTN 150000 MB Data BUNDLE', 'D-MFIN-5-150GB', '65000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(64, 'MTN 250000 MB Data BUNDLE', 'D-MFIN-5-250GB', '75000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(65, 'MTN 325000 MB Data BUNDLE', 'D-MFIN-5-325GB', '100000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(66, 'MTN 400000 MB Data BUNDLE', 'D-MFIN-5-400GB', '120000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(67, 'MTN 1000000 MB Data BUNDLE', 'D-MFIN-5-1000GB', '300000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(68, 'MTN 1500000 MB Data BUNDLE', 'D-MFIN-5-1500GB', '450000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(69, 'MTN 1000 MB Data BUNDLE', 'D-MFIN-5-1GB', '300.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(70, 'MTN 2500 MB Data BUNDLE', 'D-MFIN-5-2.5GB', '500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(71, 'MTN 1000 MB Data BUNDLE', 'D-MFIN-5-1GB-7D', '500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(72, 'MTN 6000 MB Data BUNDLE', 'D-MFIN-5-6GB-7D', '1500.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(73, 'MTN 75000 MB Data BUNDLE', 'D-MFIN-5-75GB-60D', '20000.0', '0', 'MTN', 1, NULL, '2020-10-31 23:26:45', '2020-10-31 23:26:45'),
(74, '9mobile 25 MB Data BUNDLE', 'D-MFIN-2-25MB', '50.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(75, '9mobile 100 MB Data BUNDLE', 'D-MFIN-2-100MB', '100.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(76, '9mobile 650 MB Data BUNDLE', 'D-MFIN-2-650MB', '200.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(77, '9mobile 1000 MB Data BUNDLE', 'D-MFIN-2-1GB', '300.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(78, '9mobile 500 MB Data BUNDLE', 'D-MFIN-2-500MB', '500.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(79, '9mobile 1500 MB Data BUNDLE', 'D-MFIN-2-1.5GB', '1000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(80, '9mobile 2000 MB Data BUNDLE', 'D-MFIN-2-2GB', '1200.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(81, '9mobile 7000 MB Data BUNDLE', 'D-MFIN-2-7GB', '1500.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(82, '9mobile 4500 MB Data BUNDLE', 'D-MFIN-2-4.5GB', '2000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(83, '9mobile 4000 MB Data BUNDLE', 'D-MFIN-2-4GB', '3000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(84, '9mobile 11000 MB Data BUNDLE', 'D-MFIN-2-11GB', '4000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(85, '9mobile 15000 MB Data BUNDLE', 'D-MFIN-2-15GB', '5000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(86, '9mobile 11500 MB Data BUNDLE', 'D-MFIN-2-11.5GB', '8000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(87, '9mobile 40000 MB Data BUNDLE', 'D-MFIN-2-40GB', '10000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(88, '9mobile 75000 MB Data BUNDLE', 'D-MFIN-2-75GB', '15000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(89, '9mobile 27500 MB Data BUNDLE', 'D-MFIN-2-27.5GB', '18000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(90, '9mobile 30000 MB Data BUNDLE', 'D-MFIN-2-30GB', '27500.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(91, '9mobile 60000 MB Data BUNDLE', 'D-MFIN-2-60GB', '55000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(92, '9mobile 100000 MB Data BUNDLE', 'D-MFIN-2-100GB', '84992.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(93, '9mobile 120000 MB Data BUNDLE', 'D-MFIN-2-120GB', '110000.0', '0', '9MOBILE', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(94, 'Airtel 25 MB Data BUNDLE', 'D-MFIN-1-25MB', '49.99', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(95, 'Airtel 75 MB Data BUNDLE', 'D-MFIN-1-75MB', '99.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(96, 'Airtel 200 MB Data BUNDLE', 'D-MFIN-1-200MB', '199.03', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(97, 'Airtel 1000 MB Data BUNDLE', 'D-MFIN-1-1GB', '299.03', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(98, 'Airtel 2000 MB Data BUNDLE', 'D-MFIN-1-2GB-1D', '499.03', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(99, 'Airtel 750 MB Data BUNDLE', 'D-MFIN-1-750MB', '499.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(100, 'Airtel 1500 MB Data BUNDLE', 'D-MFIN-1-1.5GB', '999.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(101, 'Airtel 2000 MB Data BUNDLE', 'D-MFIN-1-2GB-30D', '1199.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(102, 'Airtel 6000 MB Data BUNDLE', 'D-MFIN-1-6GB-7D', '1499.03', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(103, 'Airtel 3000 MB Data BUNDLE', 'D-MFIN-1-3GB', '1499.01', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(104, 'Airtel 4500 MB Data BUNDLE', 'D-MFIN-1-4.5GB', '1999.01', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(105, 'Airtel 8000 MB Data BUNDLE', 'D-MFIN-1-8GB', '2999.02', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(106, 'Airtel 6000 MB Data BUNDLE', 'D-MFIN-1-6GB', '2499.01', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(107, 'Airtel 11000 MB Data BUNDLE', 'D-MFIN-1-11GB', '3999.01', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(108, 'Airtel 15000 MB Data BUNDLE', 'D-MFIN-1-15GB', '4999.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(109, 'Airtel 40000 MB Data BUNDLE', 'D-MFIN-1-40GB', '9999.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(110, 'Airtel 75000 MB Data BUNDLE', 'D-MFIN-1-75GB', '14999.0', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(111, 'Airtel 110000 MB Data BUNDLE', 'D-MFIN-1-110GB', '19999.02', '0', 'AIRTEL', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(112, 'GLO 105 MB Data', 'D-MFIN-6-105MB', '100.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(113, 'GLO 350 MB Data', 'D-MFIN-6-350MB', '200.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(114, 'GLO 1050 MB Data', 'D-MFIN-6-1.05GB', '500.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(115, 'GLO 2500 MB Data', 'D-MFIN-6-2.5GB', '1000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(116, 'GLO 4100 MB Data', 'D-MFIN-6-4.1GB', '1500.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(117, 'GLO 5800 MB Data', 'D-MFIN-6-5.8GB', '2000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(118, 'GLO 7700 MB Data', 'D-MFIN-6-7.7GB', '2500.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(119, 'GLO 10000 MB Data', 'D-MFIN-6-10GB', '3000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(120, 'GLO 13250 MB Data', 'D-MFIN-6-13.25GB', '4000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(121, 'GLO 18250 MB Data', 'D-MFIN-6-18.25GB', '5000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(122, 'GLO 29500 MB Data', 'D-MFIN-6-29.5GB', '8000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(123, 'GLO 50000 MB Data', 'D-MFIN-6-50GB', '10000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(124, 'GLO 93000 MB Data', 'D-MFIN-6-93GB', '15000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(125, 'GLO 119000 MB Data', 'D-MFIN-6-119GB', '18000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50'),
(126, 'GLO 138000 MB Data', 'D-MFIN-6-138GB', '20000.0', '0', 'GLO', 1, NULL, '2020-10-31 23:32:50', '2020-10-31 23:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `invests`
--

CREATE TABLE `invests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `interest` decimal(11,2) NOT NULL DEFAULT 0.00,
  `period` int(11) NOT NULL,
  `hours` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_rec_time` int(11) NOT NULL DEFAULT 0,
  `next_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `capital_status` tinyint(1) NOT NULL COMMENT '1 = YES & 0 = NO',
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tnum` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btcwallet` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btcvalue` varchar(77) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invests`
--

INSERT INTO `invests` (`id`, `user_id`, `plan_id`, `amount`, `interest`, `period`, `hours`, `time_name`, `return_rec_time`, `next_time`, `last_time`, `status`, `capital_status`, `trx`, `tnum`, `btcwallet`, `btcvalue`, `image`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 500.00, 50.00, 5, '1', 'Hourly', 4, '2020-11-17 07:56:09', '2020-10-06 21:56:39', 1, 1, 'FCTRB48WKZZ9', NULL, NULL, '', NULL, '2020-10-02 03:57:28', '2020-10-06 21:56:39'),
(2, 10, 1, 500.00, 50.00, 5, '1', 'Hourly', 4, '2020-11-17 07:56:09', '2020-10-06 21:56:39', 1, 1, '189256271037', NULL, NULL, '', NULL, '2020-10-02 12:27:16', '2020-10-06 21:56:40'),
(3, 10, 2, 1000.00, 200.00, 10, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 1, 1, '536781120045', NULL, NULL, '', NULL, '2020-10-02 12:27:51', '2020-10-02 12:27:51'),
(4, 19, 2, 1234.00, 246.80, 10, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 1, 1, '48949140554', NULL, NULL, '', NULL, '2020-10-02 13:46:36', '2020-10-02 13:46:36'),
(5, 10, 1, 12.00, 1.20, 5, '1', 'Hourly', 4, '2020-11-17 07:56:09', '2020-10-06 21:56:39', 1, 1, '786364777027', NULL, NULL, '', NULL, '2020-10-02 13:48:58', '2020-10-06 21:56:40'),
(6, 10, 1, 12.00, 1.20, 5, '1', 'Hourly', 4, '2020-11-17 07:56:09', '2020-10-06 21:56:39', 1, 1, '68749845214', NULL, NULL, '', NULL, '2020-10-02 13:51:38', '2020-10-06 21:56:40'),
(7, 10, 1, 500.00, 50.00, 5, '1', 'Hourly', 3, '2020-11-17 07:56:09', '2020-10-06 21:56:39', 1, 1, '314035193384', NULL, NULL, '', NULL, '2020-10-03 05:31:19', '2020-10-06 21:56:40'),
(8, 10, 2, 12.00, 24.00, 2, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 0, 0, '73333632878', NULL, NULL, '', NULL, '2020-10-06 19:52:12', '2020-10-06 19:52:12'),
(9, 10, 2, 12.00, 24.00, 2, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 17, 0, '408109182923', 'xdgssgsdgsd436626236tadasasasg', NULL, '', '5f7ce101f4036.jpg', '2020-10-06 19:53:02', '2020-10-06 20:49:25'),
(10, 10, 2, 12.00, 24.00, 2, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 17, 0, '324830923776', 'dsfsdg235236236236', NULL, '', '5f7d0118f07f3.jpg', '2020-10-06 22:42:59', '2020-10-07 12:20:25'),
(11, 10, 1, 12.00, 1.20, 5, '1', 'Hourly', 0, '2020-11-17 07:56:09', NULL, 2, 1, '772929328277', '3252352352326', NULL, '', '5f7ec832cd731.jpg', '2020-10-08 07:02:54', '2020-10-08 07:05:06'),
(12, 10, 2, 12.00, 24.00, 2, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 2, 0, '153853406451', '25235235', 'dsfsfdffasfasasgasgs', '', '5f7edada85b7e.jpg', '2020-10-08 07:30:12', '2020-10-08 08:24:42'),
(13, 10, 2, 12.00, 24.00, 2, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 101, 0, '404450614764', NULL, NULL, '', NULL, '2020-10-08 08:28:59', '2020-10-08 08:28:59'),
(14, 10, 1, 500.00, 50.00, 5, '1', 'Hourly', 0, '2020-11-17 07:56:09', NULL, 1, 1, '383628817231', NULL, NULL, '', NULL, '2020-10-08 08:30:56', '2020-10-08 08:30:56'),
(15, 10, 1, 500.00, 50.00, 5, '1', 'Hourly', 0, '2020-11-17 07:56:09', NULL, 101, 1, '29038942016', NULL, NULL, '', NULL, '2020-10-08 08:32:47', '2020-10-08 08:32:47'),
(16, 10, 1, 100.00, 10.00, 5, '1', 'Hourly', 0, '2020-11-17 07:56:09', NULL, 101, 1, '23505438902', NULL, NULL, '0.009173', NULL, '2020-10-08 14:22:07', '2020-10-08 14:22:07'),
(17, 10, 1, 500.00, 50.00, 5, '1', 'Hourly', 0, '2020-11-17 07:56:09', NULL, 2, 1, '43180120207', '4564', '54745636356', '0.045235000000000004', '5f80b90baa3d6.jpg', '2020-10-09 18:23:22', '2020-10-09 18:24:59'),
(18, 10, 3, 41.00, 87.33, -1, '168', 'Weekly', 0, '2020-11-17 07:56:09', NULL, 1, 0, '35621028946', NULL, NULL, '0', NULL, '2020-10-27 13:13:59', '2020-10-27 13:13:59'),
(19, 10, 2, 500.00, 75.00, 0, '720', 'Monthly', 0, '2021-01-08 13:36:49', NULL, 1, 0, '405949245745', NULL, NULL, '0', NULL, '2020-12-09 13:36:49', '2020-12-09 13:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `investyields`
--

CREATE TABLE `investyields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invest_id` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT 0.00,
  `main_amo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(11,2) DEFAULT 0.00,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investyields`
--

INSERT INTO `investyields` (`id`, `invest_id`, `user_id`, `amount`, `main_amo`, `charge`, `type`, `remark`, `title`, `trx`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 500.00, '999500', 0.00, '-', 'invest', 'Invested On Bronze', '8D7K45QTDYWM', '2020-10-02 03:57:28', '2020-10-02 03:57:28'),
(2, NULL, 1, 50.00, '50', 0.00, '+', 'interest', 'Interest & Capital Return 0 USD Added on Your interest wallet Wallet', 'JBXGKSK3Q7CO', '2020-10-02 05:30:18', '2020-10-02 05:30:18'),
(3, NULL, 10, 50.00, '50', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '705143218460', '2020-10-03 05:27:10', '2020-10-03 05:27:10'),
(4, NULL, 10, 50.00, '100', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '83562102943', '2020-10-03 05:27:10', '2020-10-03 05:27:10'),
(5, NULL, 10, 1.20, '101.2', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '509832683277', '2020-10-03 05:27:10', '2020-10-03 05:27:10'),
(6, NULL, 10, 1.20, '102.4', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '962686421572', '2020-10-03 05:27:11', '2020-10-03 05:27:11'),
(7, '1', 10, 50.00, '152.4', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '654381886564', '2020-10-03 06:47:06', '2020-10-03 06:47:06'),
(8, '2', 10, 50.00, '202.4', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '697134931345', '2020-10-03 06:47:06', '2020-10-03 06:47:06'),
(9, '5', 10, 1.20, '203.6', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '368337928984', '2020-10-03 06:47:06', '2020-10-03 06:47:06'),
(10, '6', 10, 1.20, '204.79999999999998', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '544748330997', '2020-10-03 06:47:07', '2020-10-03 06:47:07'),
(11, '7', 10, 50.00, '254.79999999999998', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '862289411639', '2020-10-03 06:47:07', '2020-10-03 06:47:07'),
(12, '1', 10, 50.00, '304.79999999999995', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '50157929340', '2020-10-03 09:47:35', '2020-10-03 09:47:35'),
(13, '2', 10, 50.00, '354.79999999999995', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '304367810039', '2020-10-03 09:47:35', '2020-10-03 09:47:35'),
(14, '5', 10, 1.20, '355.99999999999994', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '439918114637', '2020-10-03 09:47:36', '2020-10-03 09:47:36'),
(15, '6', 10, 1.20, '357.19999999999993', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '308017594362', '2020-10-03 09:47:36', '2020-10-03 09:47:36'),
(16, '7', 10, 50.00, '407.19999999999993', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '178242799086', '2020-10-03 09:47:37', '2020-10-03 09:47:37'),
(17, '1', 10, 50.00, '957.1999999999999', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '751488964059', '2020-10-06 21:56:39', '2020-10-06 21:56:39'),
(18, '2', 10, 50.00, '1007.1999999999999', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '518333180790', '2020-10-06 21:56:40', '2020-10-06 21:56:40'),
(19, '5', 10, 1.20, '1008.4', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '91851178137', '2020-10-06 21:56:40', '2020-10-06 21:56:40'),
(20, '6', 10, 1.20, '1009.6', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '212403863971', '2020-10-06 21:56:40', '2020-10-06 21:56:40'),
(21, '7', 10, 50.00, '1059.6', 0.00, '+', 'interest', 'Interest & Capital Return 0 NGN Added on Your interest wallet Wallet', '8485394945', '2020-10-06 21:56:41', '2020-10-06 21:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `localbanks`
--

CREATE TABLE `localbanks` (
  `id` int(11) NOT NULL,
  `bank` varchar(223) NOT NULL,
  `code` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `localbanks`
--

INSERT INTO `localbanks` (`id`, `bank`, `code`) VALUES
(1, 'Access Bank', '044'),
(2, 'Aso Savinhgs and Loan', '401'),
(3, 'Citi Bank', '023'),
(4, 'Covenant Microfinance Bank', '551'),
(5, 'Diamond Bank', '063'),
(6, 'Eco Bank', '050'),
(7, 'Eco Mobile', '307'),
(8, 'Ekondo Microfinance Bank', '562'),
(9, 'Enterprise Bank', '084'),
(10, 'Equitorial Trust Bank', '040'),
(11, 'Fidelity Bank', '070'),
(12, 'Fidelity Mobile', '318'),
(13, 'First Bank', '011'),
(14, 'First City Monument Bank', '214'),
(15, 'First Inland Bank', '085'),
(16, 'Guarantee Trust Bank', '058'),
(17, 'Heritage Bank', '030'),
(18, 'Jaiz Bank', '301'),
(19, 'Keystone Bank', '082'),
(20, 'Main Street Bank', '014'),
(21, 'PAGA', '327'),
(22, 'Skye Bank', '076'),
(23, 'Stanbic IBTC BAnk', '221'),
(24, 'Stanbic Mobile', '304'),
(25, 'Standard Chartered Bank', '068'),
(26, 'Sterline Bank', '232'),
(27, 'Sterline Mobile', '326'),
(28, 'Sun Trust Bank', '100'),
(29, 'Union Bank of Nigeria', '32'),
(30, 'United Bank For Africa', '33'),
(31, 'Unity Bank', '215'),
(32, 'Wema Bank', '35'),
(33, 'Zenith Bank', '57'),
(34, 'Zenith Mobile', '322');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `description` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `admin` int(55) NOT NULL DEFAULT 0,
  `view` int(55) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `title`, `image`, `details`, `status`, `admin`, `view`, `created_at`, `updated_at`) VALUES
(133, 10, 'Coin Purchased', NULL, 'Your ₦55362 with transaction number 823430403950cryptocurrency purchase was successful. Please wait while our server verifies your purchase. Your account will be credited once payment is confirmed by our server, Thank you for choosing DM Exchange Pro', 1, 1, 0, '2020-10-01 10:45:37', '2020-10-05 22:35:49'),
(134, 10, 'Coin Sold', NULL, 'Your USD123 sale with transaction number 648424516956 was successful. Please wait while our server verifies your sale. Your account will be credited once payment is confirmed by our server, Thank you for choosing DM Exchange Pro', 1, 1, 0, '2020-10-01 20:40:24', '2020-10-05 20:01:02'),
(135, 10, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 1, 1, 0, '2020-10-01 21:03:52', '2020-10-01 21:04:03'),
(136, 10, 'KYC Submission Approved', NULL, 'Your KYC submission has been approved. You are now eligible to buy cryptocurrencies and earn bonus as well as offers on DM Exchange Pro Congratulations', 1, 1, 0, '2020-10-03 09:51:48', '2020-10-05 14:12:31'),
(138, 19, 'Credit Alert', NULL, 'Your deposit wallet has been credited with a sum of NGN500. Thank you for choosing DM Exchange Pro', 0, 1, 0, '2020-10-05 23:41:17', '2020-10-05 23:41:17'),
(139, 19, 'Credit Alert', NULL, 'Your deposit wallet has been credited with a sum of NGN500000. Thank you for choosing DM Exchange Pro', 0, 1, 0, '2020-10-05 23:41:57', '2020-10-05 23:41:57'),
(140, 10, 'Credit Alert', NULL, 'Your deposit wallet has been credited with a sum of NGN500. Thank you for choosing DM Exchange Pro', 0, 1, 0, '2020-10-05 23:42:23', '2020-10-05 23:42:23'),
(141, 10, 'Credit Alert', NULL, 'Your deposit wallet has been credited with a sum of NGN5000. Thank you for choosing DM Exchange Pro', 0, 1, 0, '2020-10-05 23:42:48', '2020-10-05 23:42:48'),
(142, 2, 'Credit Alert', NULL, 'Your deposit wallet has been credited with a sum of NGN500. Thank you for choosing DM Exchange Pro', 0, 1, 0, '2020-10-05 23:43:49', '2020-10-05 23:43:49'),
(143, 10, 'Investment Plan Created', NULL, 'Your bitcoin investent of USD12.00  with transaction number 408109182923 was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing MyCoin', 0, 1, 0, '2020-10-06 20:26:26', '2020-10-06 20:26:26'),
(144, 10, 'Investment Plan Created', NULL, 'Your bitcoin investent of USD12.00  with transaction number 324830923776 was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing MyCoin', 0, 1, 0, '2020-10-06 22:43:20', '2020-10-06 22:43:20'),
(145, 10, 'Investment Plan Created', NULL, 'Your bitcoin investent of USD12.00  with transaction number 772929328277 was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing MyCoin', 0, 1, 0, '2020-10-08 07:05:06', '2020-10-08 07:05:06'),
(146, 10, 'Investment Plan Created', NULL, 'Your bitcoin investent of USD12.00  with transaction number 153853406451 was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing MyCoin', 1, 1, 0, '2020-10-08 08:24:42', '2020-12-05 08:29:05'),
(147, 10, 'Investment Plan Created', NULL, 'Your bitcoin investent of USD500.00  with transaction number 43180120207 was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing MyCoin', 0, 1, 0, '2020-10-09 18:24:20', '2020-10-09 18:24:20'),
(148, 10, 'Investment Plan Created', NULL, 'Your bitcoin investent of USD500.00  with transaction number 43180120207 was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing MyCoin', 0, 1, 0, '2020-10-09 18:24:59', '2020-10-09 18:24:59'),
(149, 10, 'Deposit Approved', NULL, 'Your pending deposit of NGN 500 has been approved. Thank you for choosing MyCoin', 0, 1, 0, '2020-10-09 20:25:12', '2020-10-09 20:25:12'),
(150, 10, 'Coin Purchased', NULL, 'Your ₦ with transaction number 669249385768cryptocurrency purchase was successful. Please wait while our server verifies your purchase. Your account will be credited once payment is confirmed by our server, Thank you for choosing Visionx', 0, 1, 0, '2020-10-29 10:21:18', '2020-10-29 10:21:18'),
(151, 10, 'Coin Sold', NULL, 'Your USD1234 sale with transaction number 651938724422 was successful. Please wait while our server verifies your sale. Your account will be credited once payment is confirmed by our server, Thank you for choosing Visionx', 0, 1, 0, '2020-10-29 10:53:31', '2020-10-29 10:53:31'),
(152, 10, 'Sales Approved', NULL, 'Your cryptocurrency sales with transaction number 651938724422 has been approved. You fund has been credited to your account as required. Thank you for choosing us', 1, 1, 0, '2020-10-29 11:07:57', '2020-11-10 03:59:23'),
(153, 10, 'Sales Approved', NULL, 'Your cryptocurrency sales with transaction number 651938724422 has been approved. You fund has been credited to your account as required. Thank you for choosing us', 1, 1, 0, '2020-10-29 11:08:57', '2020-11-10 03:48:38'),
(154, 10, 'Sales Approved', NULL, 'Your cryptocurrency sales with transaction number 651938724422 has been approved. You fund has been credited to your account as required. Thank you for choosing us', 1, 1, 0, '2020-10-29 11:09:54', '2020-11-07 01:39:48'),
(155, 10, 'Coin Sold', NULL, 'Your USD5000 sale with transaction number 999346453169 was successful. Please wait while our server verifies your sale. Your account will be credited once payment is confirmed by our server, Thank you for choosing Vision-X Crypto', 1, 1, 0, '2020-11-09 20:23:30', '2020-11-10 03:48:20'),
(156, 10, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 0, 1, 0, '2020-11-11 17:25:57', '2020-11-11 17:25:57'),
(157, 10, 'Bank Transfer Approved', NULL, 'Your other bank transfer with transaction number WGZYT9KYIKQRORACUBXF was approved', 1, 1, 0, '2020-11-12 21:17:10', '2020-11-13 22:19:46'),
(158, 10, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number BF6C9JUUOHBWAFJTT3FT was rejected', 0, 1, 0, '2020-11-12 21:17:28', '2020-11-12 21:17:28'),
(159, 10, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number BF6C9JUUOHBWAFJTT3FT was rejected', 0, 1, 0, '2020-11-12 21:17:44', '2020-11-12 21:17:44'),
(160, 10, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number RJQ0QCDX5KWUFWQXAKWU was rejected', 1, 1, 0, '2020-11-12 21:32:07', '2020-11-12 21:51:30'),
(161, 31, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 0, 1, 0, '2020-11-13 01:43:47', '2020-11-13 01:43:47'),
(162, 31, 'KYC Submission Approved', NULL, 'Your KYC submission has been approved. You are now eligible to buy cryptocurrencies and earn bonus as well as offers on Vision-X Crypto Congratulations', 1, 1, 0, '2020-11-13 01:44:05', '2020-11-13 01:46:38'),
(163, 31, 'Coin Sold', NULL, 'Your USD2 sale with transaction number 59511392311 was successful. Please wait while our server verifies your sale. Your account will be credited once payment is confirmed by our server, Thank you for choosing Vision-X Crypto', 1, 1, 0, '2020-11-13 01:46:13', '2020-11-13 01:46:32'),
(164, 31, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number IB1DRKJQK8G9CCLDSBQK was rejected', 1, 1, 0, '2020-11-13 17:13:25', '2020-11-13 17:13:53'),
(165, 31, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number I913EGOIGKLEYPDKZ3WR was rejected', 1, 1, 0, '2020-11-13 17:14:11', '2020-11-13 17:16:40'),
(166, 31, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number ZVQDY2C7Q4E768LGYOTI was rejected', 1, 1, 0, '2020-11-13 17:14:21', '2020-11-13 17:16:37'),
(167, 10, 'Bank Transfer Rejected', NULL, 'Your other bank transfer with transaction number A8GUNS6C75UYWCUOOAVO was rejected', 1, 1, 0, '2020-11-13 17:14:35', '2020-11-13 22:15:36'),
(168, 31, 'Bank Transfer Approved', NULL, 'Your other bank transfer with transaction number HWBV2WIJHVEIM9Z1OCG2 was approved', 1, 1, 0, '2020-11-13 17:16:14', '2020-11-13 17:16:46'),
(169, 25, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-04 16:54:59', '2020-12-04 16:54:59'),
(170, 25, 'KYC Submission Rejected', NULL, 'Your KYC submission was not approved as it doesnt meet the requied standard or you uploaded un-supported document. Please try again', 0, 1, 0, '2020-12-04 16:55:39', '2020-12-04 16:55:39'),
(171, 25, 'KYC Submission Deleted', NULL, 'Your KYC submission has been deleted from our server. Please re-upload another document for verification purpose. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-04 16:56:05', '2020-12-04 16:56:05'),
(172, 25, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-04 20:38:29', '2020-12-04 20:38:29'),
(173, 25, 'KYC Submission Deleted', NULL, 'Your KYC submission has been deleted from our server. Please re-upload another document for verification purpose. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-04 20:40:31', '2020-12-04 20:40:31'),
(174, 25, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-04 20:42:11', '2020-12-04 20:42:11'),
(175, 25, 'KYC Submission Deleted', NULL, 'Your KYC submission has been deleted from our server. Please re-upload another document for verification purpose. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-04 20:44:12', '2020-12-04 20:44:12'),
(176, 10, 'KYC Submission Deleted', NULL, 'Your KYC submission has been deleted from our server. Please re-upload another document for verification purpose. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-05 08:18:50', '2020-12-05 08:18:50'),
(177, 10, 'KYC Submited', NULL, 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved', 0, 1, 0, '2020-12-05 08:21:48', '2020-12-05 08:21:48'),
(178, 10, 'KYC Submission Approved', NULL, 'Your KYC submission has been approved. You are now eligible to buy cryptocurrencies and earn bonus as well as offers on Vision-X Crypto Congratulations', 1, 1, 0, '2020-12-05 08:22:43', '2020-12-05 08:27:15'),
(179, 30, 'Credit Alert', NULL, 'Your deposit wallet has been credited with a sum of NGN10000000. Thank you for choosing Vision-X Crypto', 0, 1, 0, '2020-12-20 08:19:44', '2020-12-20 08:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `max` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `airtime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`id`, `name`, `code`, `symbol`, `image`, `min`, `max`, `airtime`, `internet`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Airtel', 'AIRTEL', 'airtel', 'airtel.png', '100', '435', '1', '1', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(3, 'Globacom', 'GLO', 'glo', 'glo.png', '390', '400', '1', '1', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29'),
(4, 'MTN', 'MTN', 'mtn', 'mtn.png', '370', '400', '1', '1', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(5, '9mobile', '9MOBILE', '9mobile', '9mob.png', '450', '400', '1', '1', 1, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'test@test.com', 'oo0RKc0HePW3Ap9H1mIijEUc7WxqHV', '2020-11-11 15:11:09'),
(2, 'test@test.com', 'Cu8YDgW4ISmeeU4DnDUkRE8n5tbNO1', '2020-11-11 15:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_min` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `withdraw_max` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '10',
  `fix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `withdraw_min`, `withdraw_max`, `fix`, `percent`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Naira Wallet', '10', '2000', '25', '1.10', '3', 1, '2017-07-28 09:10:00', '2018-09-19 13:43:17'),
(2, 'Internet Transfer', '10', '2000', '25', '1.10', '3', 1, '2017-07-28 09:10:00', '2018-09-19 13:43:17'),
(3, 'Mobile Transfer', '10', '20000', '2', '1.8', '1', 1, '2017-08-09 15:06:21', '2018-09-19 13:42:36'),
(4, 'Quick Teller Transfer\r\n', '10', '20000', '2', '1.8', '1', 1, '2017-08-09 15:06:21', '2018-09-19 13:42:36'),
(5, 'USSD\r\n', '10', '20000', '2', '1.8', '1', 1, '2017-08-09 15:06:21', '2018-09-19 13:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_amount` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_status` int(11) NOT NULL COMMENT '1 = ''%'' / 0 =''currency''',
  `times` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `capital_back_status` int(11) NOT NULL,
  `lifetime_status` int(11) NOT NULL,
  `repeat_time` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `minimum`, `maximum`, `fixed_amount`, `interest`, `interest_status`, `times`, `status`, `featured`, `capital_back_status`, `lifetime_status`, `repeat_time`, `created_at`, `updated_at`) VALUES
(1, 'Bronze', '200', '200', '200', '15', 1, '720', 1, 1, 0, 0, '0', '2020-10-02 03:49:00', '2020-11-30 20:56:43'),
(2, 'Sliver', '500', '500', '500', '15', 1, '720', 1, 1, 0, 0, '0', '2020-10-02 03:49:45', '2020-11-30 21:00:12'),
(3, 'Gold', '1000', '1000', '1000', '15', 1, '720', 1, 0, 0, 0, '0', '2020-10-05 22:20:36', '2020-11-30 21:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `hit` int(11) NOT NULL DEFAULT 0,
  `notify` int(55) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `cat_id`, `title`, `image`, `details`, `status`, `hit`, `notify`, `created_at`, `updated_at`) VALUES
(2, 2, 'It is a long established fact that a reader', 'assets/images/post/post_1587481835.jpg', '<p style=\"font-size: 16px; color: rgba(30, 48, 86, 0.8); line-height: 30px; font-family: Poppins, sans-serif;\"></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div><p></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\"></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div><p></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div></div></div>', 1, 38, 0, '2018-06-12 18:00:00', '2018-10-08 01:04:44'),
(4, 1, 'labore et dolore magna aliqua', 'assets/images/post/post_1587481835.jpg', '<p style=\"font-size: 16px; color: rgba(30, 48, 86, 0.8); line-height: 30px; font-family: Poppins, sans-serif;\"></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div><p></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div>', 1, 7, 0, '2018-06-08 18:00:00', '2018-10-08 01:08:29'),
(6, 3, 'Hashpower transfer for Users', 'assets/images/post/post_1587481835.jpg', '<p style=\"font-size: 16px; color: rgba(30, 48, 86, 0.8); line-height: 30px; font-family: Poppins, sans-serif;\"></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div><p></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div>', 1, 18, 0, '2018-06-10 06:41:15', '2018-10-08 01:03:48'),
(7, 2, 'Hashpower for CryptoNight Users', 'assets/images/post/post_1587303778.jpg', '<p style=\"font-size: 16px; color: rgba(30, 48, 86, 0.8); line-height: 30px; font-family: Poppins, sans-serif;\"><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div>', 1, 55, 0, '2018-06-10 06:41:27', '2018-10-08 00:56:55'),
(9, 4, 'There is no one who loves pain itself', 'assets/images/post/post_1587481835.jpg', '<p style=\"font-size: 16px; color: rgba(30, 48, 86, 0.8); line-height: 30px; font-family: Poppins, sans-serif;\"><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div>', 1, 15, 0, '2018-06-10 06:42:21', '2018-10-08 00:56:38'),
(10, 2, 'labore et dolore magna aliqua', 'assets/images/post/post_1587481835.jpg', '<p style=\"font-size: 16px; color: rgba(30, 48, 86, 0.8); line-height: 30px; font-family: Poppins, sans-serif;\"><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div></p><div class=\"single-blog\" style=\"box-sizing: border-box; margin-bottom: 37px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"part-text\" style=\"box-sizing: border-box;\"><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"><div class=\"part-text\"><p style=\"margin-top: 24px; line-height: 1.6; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div><div class=\"single-blog\" style=\"margin-bottom: 37px;\"></div><p style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 1rem; line-height: 1.6; font-size: 16px; color: rgb(128, 128, 163);\">Lorem Ipsum is simply dummy text ofthe anadthe printing of typesetting industry is not fire for dummy texat the dummy text ofthe anadthe printing dummy text ofthe anadthe breath in printing of dummy text ofthe anadthe printing of dummy text ofthe anadthe local market for printing of typesetting industrydummy texat the dummy.</p></div></div>', 1, 53, 0, '2018-06-10 06:48:58', '2018-10-08 00:56:23'),
(11, 1, 'Welcome to the system. We hope......', 'assets/images/post/post_1587303778.jpg', 'ddfgfdfdgfdhfdhfdhfdhfhdhdfhfdhfdhfh', 1, 0, 1, '2020-04-19 11:52:19', '2020-04-19 11:52:19'),
(12, 2, 'Welcome to the system. We hope......', 'assets/images/post/post_1587303778.jpg', 'We are glshdjsd skdjvjdkvb sdmnvbjdsbv sdnkdmnsbvjsdhvjbv dksjbdjsblsdsd gdkjsgshg sdkbgjksdbgds gkjdsbgjd gsdkjgbdsg sdgdsgsg', 1, 0, 1, '2020-04-19 12:42:59', '2020-04-19 12:42:59'),
(13, 2, 'Welcome to the system. We hope......', 'assets/images/post/post_1587481835.jpg', 'Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......Welcome to the system. We hope......', 1, 0, 1, '2020-04-21 14:10:36', '2020-04-21 14:10:36'),
(14, 2, 'update your transaction pin', 'assets/images/post/post_1607101381.jpg', 'ensure to update your transaction pin', 1, 0, 1, '2020-12-04 17:03:01', '2020-12-04 17:03:01'),
(15, 1, 'kyc', 'assets/images/post/post_1607257945.jpg', 'KYC processes are also employed by companies of all sizes for the purpose of ensuring their proposed customers, agents, consultants, or distributors are anti-bribery compliant, and are actually who they claim to be.', 1, 0, 1, '2020-12-06 12:32:25', '2020-12-06 12:32:25'),
(16, 1, 'Blockchain is the tech', 'assets/images/post/post_1608132103.jpg', 'Blockchain is the tech. Bitcoin is merely the first mainstream manifestation of its potential.\r\n\r\nIt eliminates the need for banks, gets rid of credit card fees, currency exchange fees, money transfer fees, and reduces the need for lawyers in transitions.\r\n#bitcoin  #cryptocurrency', 1, 0, 1, '2020-12-16 15:21:43', '2020-12-16 15:21:43'),
(17, 1, 'What is blockchain', 'assets/images/post/post_1608537765.jpg', 'A Blockchain is a decentralized ledger. Instead of a central authority it’s maintained by so called miners. Miners add transactions to the ledger and keep a copy of the blockchain.\r\n\r\n Blockchain can be said to also be a public electronic ledger built around a P2P system that can be openly shared among disparate users to create an unchangeable record of transactions, each time-stamped and linked to the previous one. Every time a set of transactions is added, that data becomes another block in the chain (hence, the name).\r\n\r\nBlockchain can only be updated by consensus between participants in the system, and once new data is entered it can never be erased. It is a write-once, append-many technology, making it a verifiable and auditable record of each and every transaction.\r\n\r\nThe major innovation of blockchain technology is that peers can reach consensus in a decentralized manner. Miners need to contribute significant computing power to win the right to add a new block to the blockchain. For each accepted block a miner is rewarded with a fixed amount of bitcoin.\r\nYou may wonder, if there is no central authority, who checks that nobody cheats the system? A combination of financial incentives and cryptography ensure that no user can benefit from cheating.\r\n\r\nA malicious miner would have to use more power than the majority of all honest miners combined to convince the network that its version is the real one. Due to the cost of electricity, it’s not feasible to do so. The incentive of the block reward and the distribution of mining power enforce honest behavior.\r\nBlockchain transactions are appended to the ledger in batches “called blocks” and every block of transactions references the previous block. If someone would try to change a past transaction, it could not be kept secret, because it would break the cryptographic link to all the blocks with transactions that followed it.\r\nWhile Bitcoin was the first application of blockchain technology, it can be used for many other applications.', 1, 0, 1, '2020-12-21 08:02:45', '2020-12-21 08:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `powers`
--

CREATE TABLE `powers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billercode` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `powers`
--

INSERT INTO `powers` (`id`, `name`, `symbol`, `image`, `code`, `billercode`, `type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Eko Electric', 'PHCN', 'ekedc.png', '01', 'EKO_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(2, 'Jos Electric', 'JED', 'jed2.png', '06', 'JOS_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39'),
(3, 'Ikeja Electric ', 'IKEDC', 'ikedc.png', '02', 'IKEJA_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29'),
(4, 'Kano Electric', 'KEDCO', 'kedco.png', '04', 'KANO_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(5, 'Port Harcourt Electric', 'PHED', 'phedc.jpg', '05', NULL, NULL, 0, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39'),
(6, 'Ibadan Electric', 'IBED', 'ibadan.png', '05', 'IBADAN_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39'),
(7, 'Kaduna Electric', 'KAD', 'kaduna.jpg', '05', 'KADUNA_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39'),
(8, 'Eko Electric', 'PHCN', 'ekedc.png', '01', 'EKO_ELECT_POSTPAID', 'Postpaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(9, 'Abuja Electric', 'ABEL', 'abuja.jpeg', '01', 'ABUJA_ELECT_PREPAID', 'Postpaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:28'),
(10, 'Ibadan Electric Postpaid', 'IBED', 'ibadan.png', '05', 'IBADAN_ELECT_POSTPAID', 'Postpaid', 1, NULL, '2018-02-15 00:36:57', '2020-09-29 17:48:39'),
(11, 'Ikeja Electric ', 'IKEDC', 'ikedc.png', '02', 'IKEJA_ELECT_POSTPAID', 'Postpaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29'),
(12, 'Enugu Electric ', 'IKEDC', 'enugu.png', '02', 'ENUGU_ELECT_POSTPAID', 'Postpaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29'),
(13, 'Enugu Electric ', 'IKEDC', 'enugu.png', '02', 'ENUGU_ELECT_PREPAID', 'Prepaid', 1, NULL, '2018-02-15 00:36:57', '2020-04-29 11:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `smss`
--

CREATE TABLE `smss` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smss`
--

INSERT INTO `smss` (`id`, `user_id`, `transaction_id`, `message`, `phone`, `amount`, `created_at`, `updated_at`) VALUES
(42, 10, 'SQNMCNFNHXPRNGULJ8GT', 'We are good to go now', '08031975397', '5', '2020-10-29 13:46:24', '2020-10-29 13:46:24'),
(43, 10, 'DPSZC8ONRE7QRVTPT9AN', 'We want to come', '08031975397', '5', '2020-10-29 14:22:36', '2020-10-29 14:22:36'),
(44, 10, 'QRQSS1IBSRQWJIRNADGA', 'Hello joseph', '08156995030', '5', '2020-10-31 12:43:59', '2020-10-31 12:43:59'),
(45, 31, 'TM84FQ44JA1AWSQF9SOD', 'Hello, how are you doing today?', '09094469333', '5', '2020-11-13 01:34:45', '2020-11-13 01:34:45'),
(46, 10, 'TODSZ3L1VGX3YNDGENDF', 'Hello Ruth, thanks for today', '08126709385', '5', '2020-11-27 01:13:38', '2020-11-27 01:13:38'),
(47, 10, 'O9YJUUM9JZZKLPXCLT9M', 'Hello Ruth, thanks for today', '08126709385', '5', '2020-11-27 01:13:39', '2020-11-27 01:13:39'),
(48, 10, '6MMLFXLW01IDDU4Y54TS', 'Hello Joseph', '08156995030', '5', '2020-11-27 01:20:47', '2020-11-27 01:20:47'),
(49, 10, 'HZGTWTDRPDCN1SCRQ20I', 'How far please call me, I misplaced my phone', '08141246409', '5', '2020-12-08 19:13:00', '2020-12-08 19:13:00'),
(50, 10, 'O5MYJMYVY5PCH2BY1J1G', 'It’s me Joe', '08141246409', '5', '2020-12-09 09:16:07', '2020-12-09 09:16:07'),
(51, 31, 'AF0UZ69BZ9WHQKNAP0LS', 'Hello', '08156995030', '5', '2020-12-09 09:18:38', '2020-12-09 09:18:38'),
(52, 31, 'GSRPQTKYSXEJCTPM8DU6', 'Hello it’s me Joseph', '08141246409', '5', '2020-12-09 09:20:00', '2020-12-09 09:20:00'),
(53, 31, 'G75RMCDVVDILSKKOHBBM', 'Hello it’s me Joseph', '08156995030', '5', '2020-12-09 09:29:28', '2020-12-09 09:29:28'),
(54, 35, 'WMOG2Q4FRVO7KPUUIJEZ', 'Test Message', '08166939205', '5', '2020-12-15 13:59:27', '2020-12-15 13:59:27'),
(55, 35, '4BBAFH8PE7BXGQRNK5VH', 'Your interview is tomorrow. Kindly be punctual.', '08166939205', '5', '2020-12-15 14:01:35', '2020-12-15 14:01:35'),
(56, 10, '4BBLPVAJUBSNCIQZPWZ7', 'Hi Test', '08166939205', '5', '2020-12-19 05:40:56', '2020-12-19 05:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(55) DEFAULT NULL,
  `code` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `details`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, '10', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters', 1, '345', '2018-09-12 18:00:00', '2018-10-06 01:33:35'),
(3, '10', 'Testtimony ooThere is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain. There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain', 0, '535', '2018-07-02 08:59:54', '2020-04-23 18:54:50'),
(4, '10', 'Great great', 0, 'EFRXTQ', '2020-05-16 07:50:07', '2020-05-16 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `time_settings`
--

CREATE TABLE `time_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_settings`
--

INSERT INTO `time_settings` (`id`, `name`, `slug`, `time`, `created_at`, `updated_at`) VALUES
(1, 'Hourly', 'Hours', '1', '2020-10-02 03:46:07', '2020-10-05 22:30:46'),
(2, 'Daily', 'Days', '24', '2020-10-02 03:46:18', '2020-10-02 03:46:18'),
(3, 'Weekly', 'Weeks', '168', '2020-10-02 03:46:44', '2020-10-02 03:46:44'),
(4, 'Monthly', 'Months', '720', '2020-10-02 03:47:12', '2020-10-02 03:47:12'),
(5, 'Yearly', 'Years', '8760', '2020-10-02 03:47:38', '2020-10-05 22:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+',
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `type`, `method`, `account_number`, `pin`, `serial`, `unit`, `ref`, `remark`, `details`, `trx`, `status`, `gateway`, `created_at`, `updated_at`) VALUES
(8, 10, '100', '1', '8', '08031975397', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'JDFSDNBDSUJW733445344', '1', 'mtn', '2020-10-16 10:33:40', '2020-10-01 10:45:37'),
(10, 10, '100', '1', NULL, '08031975397', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'UUWKJH2OJHSDDSHUHSD', '1', 'glo', '2020-10-16 20:05:27', '2020-10-01 20:40:24'),
(11, 10, '100', '1', NULL, '08031975397', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'YYT2062KJN9YDOOUDOOV', '1', 'mtn', '2020-10-16 12:54:29', '2020-10-16 12:54:29'),
(12, 10, '100', '5', 'ADETUNJI OLUWAKAYODE AYORINDE', '0577118011', NULL, NULL, NULL, NULL, 'Fund transfer is successful', NULL, 'YYT2062KJN9YDOOUDOOV', '1', 'FCMB', '2020-10-16 12:54:29', '2020-10-16 12:54:29'),
(13, 10, '100', '5', 'ADETUNJI OLUWAKAYODE AYORINDE', '0577118011', NULL, NULL, NULL, NULL, 'Approved or completed successfully', NULL, '4CZTQUKFYYVBQ4ZPV7LF', '1', 'FCMB', '2020-10-17 13:38:52', '2020-10-17 13:38:52'),
(14, 10, '200', '5', 'ADETUNJI OLUWAKAYODE AYORINDE', '0577118011', NULL, NULL, NULL, NULL, 'Approved or completed successfully', NULL, 'HIC9UTR5JYATNI4KQRYK', '1', 'FCMB', '2020-10-17 18:37:56', '2020-10-17 18:37:56'),
(15, 10, '800', '3', 'gotv_jolli', '022434084', NULL, NULL, NULL, NULL, 'Gotv subscription was successful', NULL, 'HIC9UTR5JYATNI4KQRYK', '1', 'GOTV', '2020-10-17 18:37:56', '2020-10-17 18:37:56'),
(16, 10, '100', '4', 'PREPAID', '2865280971', '0658-9983-3600-7697-5488', '19151795', '4.4Kwh', '20201031FT0011859934', 'Meter payment was successful on ', 'JOSEPH MONDAY AKANJI (Meter Number: 45040117777)', 'OHO8SJ', '1', 'IKEJA_ELECT_PREPAID', '2020-10-31 17:37:44', '2020-10-31 17:37:44'),
(17, 10, '100', '4', 'PREPAID', '45040117777', '6700-8731-1459-8712-0453', '19153379', '4.4Kwh', '20201031FT0011863978', 'Meter payment was successful on ', 'JOSEPH MONDAY AKANJI (Meter Number: 45040117777)', 'IGWPWE', '1', 'IKEJA_ELECT_PREPAID', '2020-10-31 18:16:25', '2020-10-31 18:16:25'),
(18, 10, '100', '4', 'PREPAID', '45040117777', '6583-4700-6640-9396-4069', '19155384', '4.4Kwh', '20201031FT0011869050', 'Meter payment was successful on ', 'JOSEPH MONDAY AKANJI (Meter Number: 45040117777)', 'K38RVE', '1', 'IKEJA_ELECT_PREPAID', '2020-10-31 19:01:34', '2020-10-31 19:01:34'),
(19, 10, '100', '4', 'PREPAID', '45040117777', '3449-9354-0710-9768-6380', '19155574', '4.4Kwh', '20201031FT0011869485', 'Meter payment was successful on ', 'JOSEPH MONDAY AKANJI (Meter Number: 45040117777)', '0IA6LT', '1', 'IKEJA_ELECT_PREPAID', '2020-10-31 19:05:33', '2020-10-31 19:05:33'),
(20, 10, '100', '1', NULL, '08031975397', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'IAGSFVKWAELINZFIQTWR', '1', 'mtn', '2020-10-31 21:12:25', '2020-10-31 21:12:25'),
(21, 10, '100', '2', 'MTN 100 MB Data BUNDLE', NULL, NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'NUR1WOLMUDQ0CR2VLP6X', '1', 'mtn', '2020-10-31 22:21:41', '2020-10-31 22:21:41'),
(22, 10, '100', '2', 'MTN 100 MB Data BUNDLE', '08031975397', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, '62YA2RJED1RSER8AZ6BR', '1', 'MTN', '2020-11-01 00:34:45', '2020-11-01 00:34:45'),
(23, 10, '100', '2', 'MTN 100 MB Data BUNDLE', '08031975397', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'FQ5L9ZXEIIAPBXVBTVK9', '1', 'MTN', '2020-11-01 00:46:29', '2020-11-01 00:46:29'),
(24, 10, '100', '1', NULL, '09094469333', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '8CME4MKHTEAZYLW7S7PY', '1', '9mobile', '2020-11-06 22:09:29', '2020-11-06 22:09:29'),
(25, 10, '1000', '5', 'AMARE NELSON', '0164101389', NULL, NULL, NULL, NULL, 'Approved or completed successfully', NULL, 'ZKSYAQSEWWA3CSKR6LUT', '1', 'GUARANTY TRUST BANK PLC', '2020-11-06 22:13:21', '2020-11-06 22:13:21'),
(26, 10, '200', '1', NULL, '09057550661', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'XL3QQSZXF359NTL5IIB9', '1', 'glo', '2020-11-07 01:30:12', '2020-11-07 01:30:12'),
(27, 10, '1000', '5', 'ALFRED PRINCESS', '2133805010', NULL, NULL, NULL, NULL, 'Approved or completed successfully', NULL, 'SBHFBZYSAN9CWMTNASHS', '1', 'FCMB', '2020-11-07 01:35:01', '2020-11-07 01:35:01'),
(32, 10, '500', '5', 'Adekola James', '05664476744', NULL, NULL, NULL, NULL, NULL, NULL, 'RJQ0QCDX5KWUFWQXAKWU', '2', 'AB MICROFINANCE BANK', '2020-11-12 20:24:44', '2020-11-12 21:31:35'),
(33, 10, '2', '5', 'Adenoma John', '05272638373', NULL, NULL, NULL, NULL, NULL, NULL, 'BF6C9JUUOHBWAFJTT3FT', '2', 'BOSAK MICROFINANCE BANK', '2020-11-12 20:39:15', '2020-11-12 21:17:28'),
(34, 10, '2', '5', 'Adekunle Gold', '085545454', NULL, NULL, NULL, NULL, NULL, NULL, 'WGZYT9KYIKQRORACUBXF', '1', 'CHIKUM MICROFINANCE BANK', '2020-11-12 20:53:21', '2020-11-12 21:17:10'),
(35, 10, '100', '5', 'ADETUNJI AYORINDE OL', '0033349394', NULL, NULL, NULL, NULL, 'Approved or completed successfully', NULL, 'KUSGPQMYW15XFZRZNPV5', '1', 'ACCESS BANK PLC', '2020-11-13 01:24:07', '2020-11-13 01:24:07'),
(36, 10, '100', '5', 'AFESHIMIME AKANJI', '3109311718', NULL, NULL, NULL, NULL, 'Hghghgh', NULL, 'A8GUNS6C75UYWCUOOAVO', '2', 'FIRST BANK OF NIGERIA PLC', '2020-11-13 01:24:59', '2020-11-13 17:14:35'),
(37, 31, '100', '2', '9mobile 1000 MB Data BUNDLE', '09094469333', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'OZGFSHVTOCZ6WUAZQQW7', '1', '9MOBILE', '2020-11-13 01:34:00', '2020-11-13 01:34:00'),
(38, 31, '100', '5', 'nelson amare', '0164101389', NULL, NULL, NULL, NULL, '1234', NULL, 'ZVQDY2C7Q4E768LGYOTI', '2', 'GUARANTY TRUST BANK PLC', '2020-11-13 01:39:00', '2020-11-13 17:14:21'),
(39, 31, '100', '5', 'AKANJI AFESHIMIME', '3109311718', NULL, NULL, NULL, NULL, 'Approved or completed successfully', NULL, 'IAL3AJY6Y3KVIV6SJN1N', '1', 'FIRST BANK OF NIGERIA PLC', '2020-11-13 01:39:33', '2020-11-13 01:39:33'),
(40, 31, '100', '5', 'Joseph', '3109311718', NULL, NULL, NULL, NULL, 'Joezyfresh', NULL, 'I913EGOIGKLEYPDKZ3WR', '2', 'FIRST BANK OF NIGERIA PLC', '2020-11-13 06:41:04', '2020-11-13 17:14:11'),
(41, 31, '20', '5', 'Joseph', '3109311718', NULL, NULL, NULL, NULL, 'Ikdkdkd', NULL, 'IB1DRKJQK8G9CCLDSBQK', '2', 'FIRST BANK OF NIGERIA PLC', '2020-11-13 17:07:32', '2020-11-13 17:13:25'),
(42, 31, '10', '5', 'Joseph', '3109311718', NULL, NULL, NULL, NULL, 'Joseph for card', NULL, 'HWBV2WIJHVEIM9Z1OCG2', '1', 'FIRST BANK OF NIGERIA PLC', '2020-11-13 17:15:54', '2020-11-13 17:16:14'),
(43, 10, '500', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'OZLZI5QNJIAWNXUXIQZG', '1', 'Virtual card', '2020-11-14 16:16:43', '2020-11-14 16:16:43'),
(44, 10, '500', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'XZGOJYJ5LWZPWWCRXE3P', '1', 'Virtual card', '2020-11-14 16:21:34', '2020-11-14 16:21:34'),
(45, 10, '500', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'SA5UAFBUCVB97HXDNV9M', '1', 'Virtual card', '2020-11-14 16:22:23', '2020-11-14 16:22:23'),
(46, 10, '500', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, '0UEOICRICVIQK8F1XONS', '1', 'Virtual card', '2020-11-14 16:23:24', '2020-11-14 16:23:24'),
(47, 10, '1050', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'I0PHVW8SOE2JGMQAD7YZ', '1', 'Virtual card', '2020-11-15 20:48:43', '2020-11-15 20:48:43'),
(48, 10, '30', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'KHGJTJJJGO4JSMDLE3YX', '1', 'Virtual card', '2020-11-15 20:49:33', '2020-11-15 20:49:33'),
(49, 10, '20', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'KJXQFYLG9XYQHJHM9FKT', '1', 'Virtual card', '2020-11-15 20:50:55', '2020-11-15 20:50:55'),
(50, 10, '60', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, '6NJI23LA28HO2HTN7U5W', '1', 'Virtual card', '2020-11-15 20:52:35', '2020-11-15 20:52:35'),
(51, 10, '25', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'M9VIMLKBAJIZ4FLPPCPN', '1', 'Virtual card', '2020-11-15 20:53:34', '2020-11-15 20:53:34'),
(52, 10, '2', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'QYBCUFBAGD4JQOFXAEQO', '1', 'Virtual card', '2020-11-15 21:07:49', '2020-11-15 21:07:49'),
(53, 10, '450', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card credited successfully with USD1', NULL, 'GD9BMUZHOVBFSYA4ILRT', '1', 'Fund Virtual card', '2020-11-15 21:35:41', '2020-11-15 21:35:41'),
(54, 10, '2000', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'RNNDQTKJWBSHTYZQ3TVK', '1', 'Virtual card', '2020-11-15 21:36:54', '2020-11-15 21:36:54'),
(55, 10, '1', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'TAYBOGF53IUYGIMNA8FC', '1', 'Virtual card', '2020-11-15 21:37:18', '2020-11-15 21:37:18'),
(56, 10, '900', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card credited successfully with USD2', NULL, 'GRZSCCFSW2N63DXVLMGA', '1', 'Fund Virtual card', '2020-11-15 21:38:02', '2020-11-15 21:38:02'),
(57, 10, '120', '1', NULL, '536613*******8900', NULL, NULL, NULL, NULL, 'Virtual card credited successfully with NGN120', NULL, 'AE7205IDH8EKCK13X2ID', '1', 'Fund Virtual card', '2020-11-15 21:40:07', '2020-11-15 21:40:07'),
(58, 31, '200', '1', NULL, '416046*******1293', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'LJ7VB5ULAS8SZZCROST0', '1', 'Virtual card', '2020-11-18 05:29:37', '2020-11-18 05:29:37'),
(59, 31, '100', '1', NULL, '416046*******1293', NULL, NULL, NULL, NULL, 'Virtual card credited successfully with NGN100', NULL, 'VFXMAD8PKTI5DDS4S5KN', '1', 'Fund Virtual card', '2020-11-18 05:45:25', '2020-11-18 05:45:25'),
(60, 31, '100', '1', NULL, '416046*******2945', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'NZH8N9DYSHXL9GSZYO4R', '1', 'Virtual card', '2020-11-18 05:47:55', '2020-11-18 05:47:55'),
(61, 31, '100', '1', NULL, '416046*******1293', NULL, NULL, NULL, NULL, 'Virtual card credited successfully with NGN100', NULL, 'KYALAXQTBETB0R7CZGVO', '1', 'Fund Virtual card', '2020-11-18 06:20:23', '2020-11-18 06:20:23'),
(62, 31, '5000', '1', NULL, '416046*******7399', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'I8JOSJCHHK0GTEJMW1QL', '1', 'Virtual card', '2020-11-18 17:09:50', '2020-11-18 17:09:50'),
(63, 31, '1000', '1', NULL, '08113833319', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'MGKHJVET2OMJTIVUNTOP', '1', 'glo', '2020-11-18 18:13:14', '2020-11-18 18:13:14'),
(64, 31, '500', '1', NULL, '07017878435', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'SEJWCAMRDJGMBDQONQDF', '1', 'airtel', '2020-11-18 18:22:08', '2020-11-18 18:22:08'),
(65, 31, '5', '1', NULL, '428803*******0893', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'W5HMPWNFSFYCTYAZ9HRK', '1', 'Virtual card', '2020-11-18 21:17:25', '2020-11-18 21:17:25'),
(66, 31, '5', '1', NULL, '428803*******6514', NULL, NULL, NULL, NULL, 'Virtual card created successfully', NULL, 'TPFLVLNWPHYGFQPF4HL9', '1', 'Virtual card', '2020-11-19 16:42:21', '2020-11-19 16:42:21'),
(67, 31, '200', '1', NULL, '08038923890', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'S7PL0TDGYYYVZUHVT3HH', '1', 'mtn', '2020-11-20 16:46:52', '2020-11-20 16:46:52'),
(68, 10, '1000', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'I3WY6T9WPGGMB4SEBIOY', '1', 'glo', '2020-11-27 00:37:09', '2020-11-27 00:37:09'),
(69, 10, '300', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '1LHADXMJ9D8OKT8RT5AC', '1', 'glo', '2020-11-30 19:12:41', '2020-11-30 19:12:41'),
(70, 10, '300', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'DDWVI0VAOQQ7MYABPJVM', '1', 'glo', '2020-12-02 16:15:47', '2020-12-02 16:15:47'),
(71, 10, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'DSZZGRDVR2QK6VHDKSPO', '1', 'glo', '2020-12-05 08:23:42', '2020-12-05 08:23:42'),
(72, 31, '200', '1', NULL, '08064027902', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '8RJIBM9LOBPAATU6DL0R', '1', 'mtn', '2020-12-06 08:39:11', '2020-12-06 08:39:11'),
(73, 10, '100', '1', NULL, '09156995030', NULL, NULL, NULL, NULL, 'Transaction Failed', NULL, '4LMOBPNRR2RSMEHCJM9D', '1', 'glo', '2020-12-07 09:49:24', '2020-12-07 09:49:24'),
(74, 10, '100', '1', NULL, '08141246409', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'UYXSLFYUWEL5LFK718TX', '1', 'mtn', '2020-12-08 19:11:54', '2020-12-08 19:11:54'),
(75, 35, '100', '1', NULL, '08166939205', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'PQX0W0MNZKIWDTTIOASL', '1', 'MTN', '2020-12-09 20:43:12', '2020-12-09 20:43:12'),
(76, 35, '100', '1', NULL, '08166939205', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'T6JU171JGZVDXAFYTOCL', '1', 'mtn', '2020-12-10 12:15:10', '2020-12-10 12:15:10'),
(77, 35, '100', '1', NULL, '08166939205', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'XAMS7HBP0QYSGVPGOXZB', '1', 'mtn', '2020-12-11 09:46:16', '2020-12-11 09:46:16'),
(78, 35, '100', '1', NULL, '08166939205', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'NDJGP1KALDKSC2MB7J7B', '1', 'airtel', '2020-12-11 13:24:31', '2020-12-11 13:24:31'),
(79, 35, '100', '1', NULL, '081669392', NULL, NULL, NULL, NULL, 'Invalid mobilenumber expected 11 digits,', NULL, 'WHWD0XK4QBKTW00MTXSW', '1', 'airtel', '2020-12-11 13:31:15', '2020-12-11 13:31:15'),
(80, 31, '200', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'STH4SZV7BUGQXQ9OKLWL', '1', 'glo', '2020-12-11 15:38:21', '2020-12-11 15:38:21'),
(81, 10, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '1AHTX2KWDO8A4PI95QRL', '1', 'glo', '2020-12-13 07:47:04', '2020-12-13 07:47:04'),
(82, 31, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'YE3FETUVXKBTFNJDGPWG', '1', 'glo', '2020-12-16 14:57:53', '2020-12-16 14:57:53'),
(83, 10, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'MHMBLJOILJORMTQ9RNF1', '1', 'glo', '2020-12-18 08:21:10', '2020-12-18 08:21:10'),
(84, 10, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '4ATGISY6HFSVNE6N7WNN', '1', 'glo', '2020-12-18 19:57:06', '2020-12-18 19:57:06'),
(85, 10, '100', '2', NULL, '07011223737', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'EOINJYISTLU875PQG2U9', '1', 'airtel', '2020-12-19 05:36:51', '2020-12-19 05:36:51'),
(86, 10, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'HPNORUDSSVOX7Y05DAIX', '1', 'glo', '2020-12-19 11:06:01', '2020-12-19 11:06:01'),
(87, 35, '100', '2', NULL, '08166939205', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'YE2CFNBRAVHKXYVDXVTA', '1', 'MTN', '2020-12-19 23:45:58', '2020-12-19 23:45:58'),
(88, 10, '100', '2', NULL, '07011223737', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'DROUG2YZ6QXSH7T7J6JA', '1', 'airtel', '2020-12-20 00:06:55', '2020-12-20 00:06:55'),
(89, 25, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'HWG5WJ2YWNJYWY0RLYS5', '1', 'glo', '2020-12-20 08:37:29', '2020-12-20 08:37:29'),
(90, 35, '100', '1', NULL, '08166939206', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'AIVOIWIPQSOJQWMUEEJA', '1', 'MTN', '2020-12-20 11:55:56', '2020-12-20 11:55:56'),
(91, 10, '100', '1', NULL, '08166939205', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '8GKUWSF6FFO5UI2BBWXQ', '1', 'mtn', '2020-12-21 14:16:10', '2020-12-21 14:16:10'),
(92, 10, '100', '2', NULL, '07011223737', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, 'IEZOEILKFIFYAZBQORXO', '1', 'airtel', '2020-12-21 14:16:42', '2020-12-21 14:16:42'),
(93, 10, '100', '1', NULL, '08166939205', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'RMWGBZSSBCZQPPILIPKC', '1', 'mtn', '2020-12-25 12:13:20', '2020-12-25 12:13:20'),
(94, 10, '100', '2', NULL, '08166939205', NULL, NULL, NULL, NULL, 'MobileData purchase is successful', NULL, '2MJUSYQP65ORIJOEU1SQ', '1', 'mtn', '2020-12-25 12:14:18', '2020-12-25 12:14:18'),
(95, 31, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, 'RZBSXDE2OWYU07BOWX93', '1', 'glo', '2020-12-25 12:24:41', '2020-12-25 12:24:41'),
(96, 31, '100', '1', NULL, '08156995030', NULL, NULL, NULL, NULL, 'Airtime purchase is successful', NULL, '6CXO8W4OAWL0LJFMZR1J', '1', 'glo', '2020-12-26 17:41:55', '2020-12-26 17:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `user_id`, `transaction_id`, `amount`, `send_details`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 'ZK6PRXXIHRP7WEIWZEZX', '400', 'Test1234', 2, '2020-05-09 22:45:14', '2020-05-09 22:45:14'),
(2, 10, 'VRS4KH8LNUF6TXDOUHY5', '20000', 'Bit254', 2, '2020-05-10 19:06:41', '2020-05-10 19:06:41'),
(3, 10, '7CQD32LJGIVASYXCOVXJ', '20000', 'Bit254', 2, '2020-05-10 19:07:51', '2020-05-10 19:07:51'),
(4, 17, 'DNY93TJMWPHEGSOV8S0Z', '12000', 'test1234', 2, '2020-05-10 19:11:56', '2020-05-10 19:11:56'),
(5, 17, 'E26GX9NATVFPR3ZSACUI', '5000', 'test1234', 2, '2020-05-12 03:31:59', '2020-05-12 03:31:59'),
(6, 10, 'OVAUPFYRAPO2WJII4ZJH', '100', 'joseph1995', 2, '2020-12-05 01:25:34', '2020-12-05 01:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `trxes`
--

CREATE TABLE `trxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `main_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `amountpaid` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depositor` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tnum` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+',
  `wallet` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `rate` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `getamo` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountnumber` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` int(22) DEFAULT NULL,
  `timeout` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trxes`
--

INSERT INTO `trxes` (`id`, `user_id`, `amount`, `main_amo`, `amountpaid`, `depositor`, `action`, `title`, `tnum`, `image`, `charge`, `type`, `wallet`, `currency_id`, `rate`, `price`, `getamo`, `method`, `bank`, `remark`, `trx`, `status`, `bankname`, `accountname`, `accountnumber`, `gateway`, `timeout`, `created_at`, `updated_at`) VALUES
(8, 10, '123', '55362', '55362', 'wwtwe', NULL, NULL, '435', '5f75c16184abc.jpg', '12', '1', 'dsgsdhshsdh', 5, '450', '8176.04012491238', '0.015043957480739266', '8', '2', NULL, '823430403950', '2', NULL, NULL, NULL, NULL, '2020-10-01 13:03:40', '2020-10-01 10:33:40', '2020-10-01 10:45:37'),
(10, 10, '123', '49212', NULL, NULL, NULL, NULL, 'asgsagas', '5f764cc889298.jpg', '12', '2', NULL, 3, '400', '253.722168217656', NULL, NULL, '0', NULL, '648424516956', '2', NULL, NULL, NULL, NULL, '2020-10-01 22:35:27', '2020-10-01 20:05:27', '2020-10-01 20:40:24'),
(13, 10, '12', '4692', '4692', 'test1234', NULL, NULL, '736168416386', NULL, '12', '1', '123', 11, '390', '1', '12', '1', '1', NULL, '669249385768', '1', NULL, NULL, NULL, 1, '2020-10-29 07:48:09', '2020-10-29 10:18:09', '2020-10-29 10:21:18'),
(14, 10, '1234', '493612', NULL, NULL, NULL, NULL, '324626236236236326236327237272727', '5f9a66ebe9582.jpg', '12', '2', NULL, 5, '400', '8176.04012491238', NULL, NULL, '0', NULL, '651938724422', '2', 'VisionX', 'test1234', '4460008942', NULL, '2020-10-29 08:23:00', '2020-10-29 10:53:00', '2020-10-29 11:09:54'),
(15, 10, '5000', '2000012', NULL, NULL, NULL, NULL, NULL, NULL, '12', '2', NULL, 5, '400', '8176.04012491238', NULL, NULL, '0', NULL, '274117678402', '0', 'VisionX', 'test1234', '4460008942', NULL, '2020-10-29 08:53:13', '2020-10-29 11:23:13', '2020-10-29 12:23:13'),
(18, 10, '5000', '2100012', NULL, NULL, NULL, NULL, NULL, NULL, '12', '2', NULL, 11, '420', '1', NULL, NULL, '0', NULL, '374107671699', '0', 'VisionX', 'test1234', '4460008942', NULL, '2020-10-31 17:10:49', '2020-10-31 19:40:49', '2020-10-31 20:40:49'),
(20, 10, '5000', '2000012', NULL, NULL, NULL, NULL, NULL, NULL, '12', '2', NULL, 5, '400', '8176.04012491238', NULL, NULL, '0', NULL, '210856763259', '0', 'VisionX', 'test1234', '4460008942', NULL, '2020-10-31 17:14:25', '2020-10-31 19:44:25', '2020-10-31 20:44:25'),
(23, 10, '5000', '2250012', NULL, NULL, NULL, NULL, NULL, NULL, '12', '1', 'Ughuhiuiui', 5, '450', '8176.04012491238', '0.6115429870219214', '1', '1', NULL, '946615632582', '0', NULL, NULL, NULL, 1, '2020-11-08 18:28:38', '2020-11-08 21:58:38', '2020-11-08 22:58:38'),
(24, 10, '5000', '2000012', NULL, NULL, NULL, NULL, 'Scrvfbgbgngnhn', '5fa95ef2c23de.jpg', '12', '2', NULL, 5, '400', '8176.04012491238', NULL, NULL, '0', NULL, '999346453169', '1', 'VisionX', 'test1234', '4460008942', NULL, '2020-11-09 16:11:38', '2020-11-09 19:41:38', '2020-11-09 20:23:30'),
(25, 10, '5000', '1950012', NULL, NULL, NULL, NULL, NULL, NULL, '12', '1', '2151515151545454', 11, '390', '1', '5000', '1', '1', NULL, '768184709935', '0', NULL, NULL, NULL, 1, '2020-11-11 12:12:40', '2020-11-11 15:42:40', '2020-11-11 16:42:44'),
(26, 10, '5000', '2100012', NULL, NULL, NULL, NULL, NULL, NULL, '12', '2', NULL, 11, '420', '1', NULL, NULL, '0', NULL, '339227709536', '0', 'VisionX', 'test1234', '4460008942', NULL, '2020-11-11 12:22:54', '2020-11-11 15:52:54', '2020-11-11 16:52:55'),
(27, 31, '2', '900', NULL, NULL, NULL, NULL, '1234677', '5fad9f15c1348.jpg', '100', '2', NULL, 5, '400', '8176.04012491238', NULL, NULL, '0', NULL, '59511392311', '1', 'VisionX', 'testaccount2', '4460412679', NULL, '2020-11-12 22:15:45', '2020-11-13 01:45:45', '2020-11-13 01:46:13'),
(28, 31, '1500', '600100', NULL, NULL, NULL, NULL, NULL, NULL, '100', '2', NULL, 5, '400', '8176.04012491238', NULL, NULL, '0', NULL, '256401119899', '0', 'VisionX', 'testaccount2', '4460412679', NULL, '2020-11-13 03:27:16', '2020-11-13 06:57:16', '2020-11-13 07:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verify` tinyint(4) NOT NULL DEFAULT 0,
  `email_verify` tinyint(4) NOT NULL DEFAULT 0,
  `bvn_verify` int(77) NOT NULL DEFAULT 0,
  `bvn_time` varchar(66) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_time` datetime DEFAULT NULL,
  `phone_time` datetime DEFAULT NULL,
  `refer` int(11) NOT NULL DEFAULT 0,
  `level` tinyint(4) NOT NULL DEFAULT 0,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bonus` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT '0.00',
  `bank` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Set',
  `bankcode` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountno` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankyes` int(1) NOT NULL DEFAULT 0,
  `paypal` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Set',
  `btcaddress` varchar(77) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Set',
  `ethaddress` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `ltcaddress` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `verified` int(22) DEFAULT NULL,
  `dob` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdrawpass` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT '1234',
  `withdrawpass_used` int(77) DEFAULT 0,
  `locked` int(77) NOT NULL DEFAULT 0,
  `api_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `phone`, `account_number`, `image`, `password`, `verification_code`, `sms_code`, `phone_verify`, `email_verify`, `bvn_verify`, `bvn_time`, `email_time`, `phone_time`, `refer`, `level`, `reference`, `balance`, `bonus`, `bank`, `bankcode`, `accountno`, `accountname`, `bankyes`, `paypal`, `btcaddress`, `ethaddress`, `ltcaddress`, `status`, `verified`, `dob`, `gender`, `login_time`, `address`, `city`, `state`, `zip_code`, `country`, `provider`, `provider_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `time`, `timezone`, `withdrawpass`, `withdrawpass_used`, `locked`, `api_token`) VALUES
(10, 'Adekunle', 'Gold', 'test1234', 'test@test.com', '+23480319753979', '4460008942', 'assets/images/user/1601558082_.jpg', '$2y$10$6mWJLg2o4h2KoRncGfaS4urjj8H3XxrpD3xta4uoeIWoNDWrwkTkS', 'PYS4M1', 'ARCQOH', 1, 1, 1, '2020-10-17 21:50:42', '2020-04-06 22:53:38', '2020-10-28 11:03:08', 0, 1, NULL, '0.9899999999999807', '121', 'ACCESS BANK PLC', '000014', '0033349394', 'ADETUNJI AYORINDE OL', 1, 'user@paypal.com', 'btcwallet', 'Ethwallet', 'Ltcwallet', 1, 2, '02/06/2020', NULL, '2020-12-30 00:38:58', 'My Address Is Real, Adekola', 'Ikeja', NULL, '234', 'Nauru', NULL, NULL, '0Kmr0zhmEWzr4rkARrUz0JD9JbkFjN1zROsEHsQ3nBGGnTw08vDBEkDT9x4d', NULL, '2020-04-06 21:48:38', '2020-12-30 00:38:58', '2020-05-17 08:25:00', 'Africa/Lagos', '1234', 0, 0, '5sY3cDiyz3WPuiCSjLG8wi23VQTehpiJ4nI2QbPPy6GsCq0q145zAR91PsLP'),
(19, 'Adekunleasfsa', 'qwrqrqasgasg', 'test1234afasgas', 'adetue@gmail.comasgasgasga', '1412424142421', NULL, NULL, '$2y$10$0Zhv3bNV7/GsF3HDl8JueusPxwzRDCeN4dlAKhbBiO.whxI6y1abq', 'EI72UP', 'LI3YM7', 1, 1, 0, NULL, '2020-09-29 21:04:37', '2020-09-29 21:04:37', 10, 0, NULL, '500500', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, '2020-09-10', 'Male', NULL, '2106078395asfag', NULL, 'Juzur Hawar', NULL, 'Bahrain', NULL, NULL, 'dxGeLoaWeFjn2ZBCaJOJmGa3SRugX00qZv17d9nDR8N4P1Ow9yk5SvxI6f2N', NULL, '2020-09-29 19:59:37', '2020-10-05 23:41:57', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(20, 'Adekunle', 'qwrqrqsfdss', 'test123423532523', 'mhgkaka235325235yode@gmail.com', NULL, NULL, NULL, '$2y$10$SMYfsMo/PSVEHS5cYnqKLuHQ9YocsEgdBQandJ7b17xVD88pLZJuW', '59UC5U', 'GNK2FW', 1, 1, 0, NULL, '2020-10-08 11:42:33', '2020-10-08 11:42:33', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, '2020-10-15', 'Female', NULL, NULL, NULL, NULL, NULL, 'Bahamas', NULL, NULL, 'uQl25NSXzKz4wAHXykSIEUuhuvDiAHsACQrjbDAzhIPCR1qs10rkBNF3i19g', NULL, '2020-10-08 10:37:33', '2020-10-08 10:37:33', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(21, 'jheeewwtewtew', 'eywyweyey', 'admin@admin.com436346', 'adetue@gmail.comafasfs', '1412424', NULL, NULL, '$2y$10$ntw0qdJn2bT8CIhzE7gjReDhguzfD6PJdK9tKFuKljQaxMNBmsPJi', 'BGNYSN', 'N9YKBT', 1, 1, 0, NULL, '2020-10-09 21:35:18', '2020-10-09 21:35:18', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, '2020-10-22', 'Male', NULL, '2106078395436', NULL, 'Sandy Point', NULL, 'Bahamas', NULL, NULL, 'ePk1y6CHgFMnQtTG7oOj6PVs7HLy4UF51J0e9G1FTplB48oRAeBayojnHVR1', NULL, '2020-10-09 20:30:19', '2020-10-09 20:30:19', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(22, 'sdsdgsd', 'dsgdsgsd', 'dsdssdgsdg', 'a@aas.com', '673253252353', NULL, NULL, '$2y$10$rabYruGPLiX.pbp0/HeeZemhIsVsOxtk4Ip8HMyE5zfM0ieLReXpO', '3KSZOM', 'KHJODM', 1, 1, 0, NULL, '2020-10-09 21:41:02', '2020-10-09 21:41:02', 10, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, '2020-10-30', 'Female', NULL, 'dfdsfsdgsgdsgdsgsdds', NULL, 'Konar', NULL, 'Afghanistan', NULL, NULL, 'ldQbITtcwzHYwEkYl54HKnW0rRs0ZK7qAZuslSpSf7EYnPD12llTKur9dNSN', NULL, '2020-10-09 20:36:02', '2020-10-09 20:36:02', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(23, 'Ademola', 'Adele', 'ademoladele', 'ademoladele@gmail.com', '0804524545425', '4460985703', NULL, '$2y$10$oJEP1KrwXK2n6L0Bs12ciOW29VITqc6C35rl/H6Nlu3Z03UOfdexK', 'KJND0E', 'TSD3F3', 1, 1, 0, NULL, '2020-10-15 18:17:39', '2020-10-15 18:17:39', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KZVChtGWGBMhHFPVNNhJm4UNIaXZiLssu501aiTVs9ZUtoMa4weg8dKI6SlW', NULL, '2020-10-15 17:12:39', '2020-10-15 17:12:39', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(24, 'Joe', 'Amadi', 'joeamadi', 'joeamadi@gmail.com', '1746735232432', '4460894093', NULL, '$2y$10$In4jFtYaJ1luRjioFa2m7eIliqfq6AOrMQvrWqL0Q7PMqHEfWLhSG', 'HABMTZ', 'LJRGMJ', 1, 1, 0, NULL, '2020-10-15 18:24:10', '2020-10-15 18:24:10', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-15 17:19:10', '2020-10-15 17:19:10', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(25, 'joseph', 'joseph', 'joseph1995', 'joezy1995@gmail.com', '08156995030', '4460391822', 'assets/images/user/1604685175_.jpg', '$2y$10$o0tZBQtuoheO8Nfn7izXTeaFsjR1mPlqHQVk/QA5z0Pak4WUZ04Fq', 'ASBXDW', '302012', 1, 1, 0, NULL, '2020-10-27 23:29:12', '2020-10-27 23:34:37', 0, 0, NULL, '0', '0.00', 'FIRST BANK OF NIGERIA PLC', '000016', '3109311718', 'AKANJI AFESHIMIME', 1, 'Not Set', 'Not Set', '0', '0', 1, 0, 'February', NULL, '2020-12-29 09:11:05', 'Lagos', 'Lagos', NULL, '100261', NULL, NULL, NULL, 'ODHdwe61hjqcUcDcXiSvTsQB9CdqeU4NYJXGp62hpKvgC4UA0VQNt8NGtr7l', NULL, '2020-10-28 03:24:12', '2020-12-29 09:11:06', NULL, 'Africa/Lagos', '1995', 1, 0, 'jko3aNs0USZyYQaVRXkUZLH7KTP6qKCmCHOHq2VX6h6tuNoqOJbyrrvFZ6LV'),
(28, 'asgagas', 'sagsagas', '08031975397', 'adetunjioluwakayode@gmail.com', '08031975397', '4460416627', NULL, '$2y$10$fVKZuzpu6kD05Y6ukIF/o.xV9dpi23IHenzL1J7jm6oaL/owfvVna', 'CQVBZZ', 'XZCATX', 1, 1, 0, NULL, '2020-10-28 11:28:38', '2020-10-28 11:24:38', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28 15:23:38', '2020-10-28 15:24:40', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(29, 'Test', 'Account', 'testaccount', 'testaccount@gmail.com', '588886595959', '4460353145', NULL, '$2y$10$DcYw.WoGz3VsF58VZr13YuCwsVsM.eyWMx4CUGVedLCTiGnJa62fK', 'LYAY9Z', '9WM1MM', 1, 1, 0, NULL, '2020-11-06 23:37:33', '2020-11-06 23:33:33', 0, 0, NULL, '98751', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, '2020-12-20 08:10:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6ZeOHQKbdFOEYbcJZnn7fbuG7NExxl4acXgtQC23EUte63OMlYk5qGNduHcE', NULL, '2020-11-07 04:32:33', '2020-12-20 08:10:38', NULL, 'Africa/Lagos', '1234', 0, 0, 'c5al94J8incuPDryEBTHW0ulJ2sXcUCZpYUhNlctQMTQmsLx9RD2mABVv0YC'),
(30, 'Test95', 'Test95', 'test95', 'test95@test.com', '0808045484648787', '4460578026', NULL, '$2y$10$CPmxh1LBb.avRM2vo80crOTJZI6tnd5VnuZS87VP7W1YvjgO2TBDO', 'ETQRNR', 'GACZLF', 1, 1, 0, NULL, '2020-11-07 12:29:23', '2020-11-07 12:25:23', 0, 0, NULL, '10000000', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 0, NULL, NULL, NULL, '2020-11-07 12:38:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yjeZs0VRlfSsvgcVe7dU1Pab7u0UyRWwGbglic7Sw97OB5gkqg6FjUwdB0pJ', '2020-12-20 08:20:38', '2020-11-07 17:24:23', '2020-12-20 08:20:38', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(31, 'Test', 'Account2', 'testaccount2', 'testaccount2@gmail.com', '08054558444', '4460412679', NULL, '$2y$10$aGz1SzmVfJJMfrsKD7YHfeq2BS1zuevipl5XLxh4jv0gsQKPCSbDS', 'INNOLZ', 'BLZMOS', 1, 1, 1, '2020-11-12 20:37:54', '2020-11-07 14:30:54', '2020-11-07 14:26:54', 0, 0, NULL, '120', '12', 'FIRST BANK OF NIGERIA PLC', '000016', '3109311718', 'AKANJI AFESHIMIME', 1, 'Not Set', 'Not Set', '0', '0', 1, 2, NULL, NULL, '2020-12-26 17:59:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tFsU3DnYNqTJJGMrqObG5lsRQqPmB6L2YUQiAT0XtVBvxfsd1PtvteRXJCUQ', NULL, '2020-11-07 19:25:54', '2020-12-26 17:59:01', NULL, 'Africa/Lagos', '1234', 0, 0, 'ghnADHZisAYaDas6RMZDzbgs52KUm0XlsTKC7xUuS26dMhh01Q5qmtf5iHkW'),
(32, 'Solomon', 'gbeta', 'solotron', 'sgbeta@outlook.com', '+2348154992990', '4460689041', NULL, '$2y$10$1PsybiwaSqjn.slzGN1QHOTflpMvuzrc/JSeeq8Mwzk4Qz2ite3ES', 'MMKO4T', '8GCM3D', 0, 1, 0, NULL, '2020-11-09 09:18:17', '2020-11-09 09:27:02', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-09 14:13:17', '2020-11-09 14:27:02', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(33, 'Samji', 'Diamond', 'samji', 'samjidiamond@gmail.com', '08166939205', '4460835075', NULL, '$2y$10$pwyDFGyK7MaBxX1yYzVkFOJBMPWP/u.yNDEF/hWT.GTI.WD6MoK2O', 'TI7NNC', 'R8KGTV', 0, 1, 0, NULL, '2020-12-05 15:42:04', '2020-12-05 15:38:04', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, '2020-12-22 07:03:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-05 15:37:04', '2020-12-22 07:03:54', NULL, 'Africa/Lagos', '1234', 0, 0, 'kwDOUfwZDUYyRh9w8AtxWpfRhUKWfeboMg4UCssKbQg4SKvdjvZcZ5VHxgNc'),
(34, 'Adeyemo', 'Tolulope', 'tolutopup', 'tolutopup@gmail.com', '08161325039', '4460596253', NULL, '$2y$10$UAaEsy9x1tFzapa4reRD8.CzxpfAHMf6gpBLTJzOGdOXmYm8H1diC', 'BK9INO', '3HHEIX', 0, 1, 0, NULL, '2020-12-06 14:39:04', '2020-12-06 14:35:04', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, '2020-12-28 14:03:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-06 14:34:04', '2020-12-28 14:03:26', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(35, 'Samji', 'Baba', 'sammy', 'samji@visionx.com', '08166939206', '4460342411', NULL, '$2y$10$WdcZ1SFb3GE6Fgzrilj.q.4UrG6g5dja0YWtni4KAJy9scLhrIV2e', 'QEUV2L', '582012', 1, 1, 0, NULL, '2020-12-07 15:59:09', '2020-12-07 15:55:09', 0, 0, NULL, '290', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, '2020-12-30 00:43:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-07 15:54:09', '2020-12-30 00:43:56', NULL, 'Africa/Lagos', '1234', 0, 0, 'Ladme1cKmkjC4xttdOuuNJspM8NdcAGcu0zy2KwOWj0v0u8JoheiSrDKkc8F'),
(36, 'Samdo', 'Baddest', 'sambad', 'sambad@gmail.com', '08166939207', '4460234515', NULL, '$2y$10$YNBK/aXWI7WbGSjrgGfsdOFw0x934Yb3vD4bOEoQ/eP9s/n0P9UpG', 'VSLUFY', 'TDWGYO', 0, 1, 0, NULL, '2020-12-08 14:19:59', '2020-12-08 14:16:00', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-08 14:15:00', '2020-12-08 14:15:00', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(37, 'Olawole', 'Kadijat', 'kadipo', 'kadijato@gmail.com', '07066939207', '4460373436', NULL, '$2y$10$kXMAeiC6rjZleEY4uuBL0unXbcxyxhpadQlWeoYZelRfZrPZiv1Nq', 'P6Q2H4', 'WKWWI9', 0, 1, 0, NULL, '2020-12-08 14:43:26', '2020-12-08 14:39:27', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-08 14:38:26', '2020-12-08 14:38:27', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(38, 'Chinko', 'Ekun', 'chikun', 'Chichiko@gmail.com', '08166939208', '4460274555', NULL, '$2y$10$Or.rmDNsU/M3Gy053IV/aekUOTeG9T5w.yWFrzbV1Iw3rTTcYZSCy', 'XQJ3VD', 'NUCDKX', 0, 1, 0, NULL, '2020-12-08 14:44:55', '2020-12-08 14:40:56', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-08 14:39:56', '2020-12-08 14:39:56', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(39, 'Samblack', 'Daviva', 'samdaviva', 'samdavik@gmail.com', '12345678098', '4460493769', NULL, '$2y$10$NHGbvQpv7nnTgJ1xaDCbZes0QItTakaTQTcJfPraCquJuDcdSeIs.', 'WHFXZW', 'WZXXHZ', 1, 1, 0, NULL, '2020-12-09 11:13:09', '2020-12-09 11:09:09', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-09 11:08:09', '2020-12-09 11:31:55', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(40, 'joezy', 'test', 'joezy1995', 'cafisi6984@94jo.com', '12293508803', '4460780611', NULL, '$2y$10$NqHeFqzOrUYuxOLCfSLWB.iDqEF5k5ISdCfiyfOE06x3IwEtl2GqG', 'CLVFEG', 'BMZKMJ', 0, 1, 0, NULL, '2020-12-20 07:52:36', '2020-12-20 07:48:36', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 0, NULL, NULL, NULL, '2020-12-20 07:54:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-20 07:56:09', '2020-12-20 07:47:36', '2020-12-20 07:56:09', NULL, 'Africa/Lagos', '1234', 0, 0, 'OgHS3BEoN12uVrQEBvJ6iDX06D3G5nrN86KbLuebW4G43RU4X5KDLGQdRR50'),
(41, 'joe', 'test', 'joezytest', 'rexit63053@94jo.com', '08153353131', '4460384097', NULL, '$2y$10$dr.gV5Htb0TgIs/eXGuZveLEB5jPZ/iRumZKYfmPcG3FR1LQFADxu', 'N0V1RH', '7WPLM2', 0, 1, 0, NULL, '2020-12-20 07:57:43', '2020-12-20 07:53:43', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-20 07:56:02', '2020-12-20 07:52:43', '2020-12-20 07:56:02', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(42, 'kan', 'rin', 'kenmcdevins', 'cheritonken2018@gmail.com', '070657558585', '4460565629', NULL, '$2y$10$C8DdEeILAffuPmlzMLXsbO.AdrgoEG7NhcRsu.Ji0M1CogsLAtet.', 'GBZNC3', '37BEX5', 0, 1, 0, NULL, '2020-12-20 13:10:31', '2020-12-20 13:06:31', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-20 13:05:31', '2020-12-20 13:05:31', NULL, 'Africa/Lagos', '1234', 0, 0, NULL),
(43, 'Adeyemo', 'Tolulope', 'tolujohn', 'diamondtopup316@gmail.com', '07067571403', '4460807526', NULL, '$2y$10$dmp8xu4jANuyDJB6qVI8w.Mstm0mB1ZNoiCdqkPEdmlemNXYCgFqu', '6IQM2S', 'OJZXK7', 0, 1, 0, NULL, '2020-12-28 15:09:06', '2020-12-28 15:05:06', 0, 0, NULL, '0', '0.00', 'Not Set', NULL, NULL, NULL, 0, 'Not Set', 'Not Set', '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-28 15:04:06', '2020-12-28 15:04:06', NULL, 'Africa/Lagos', '1234', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `location`, `details`, `created_at`, `updated_at`) VALUES
(172, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-09-29 19:19:08', '2020-09-29 19:19:08'),
(173, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-09-29 22:59:09', '2020-09-29 22:59:09'),
(174, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-09-30 08:23:25', '2020-09-30 08:23:25'),
(175, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-09-30 17:39:47', '2020-09-30 17:39:47'),
(176, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-01 06:18:21', '2020-10-01 06:18:21'),
(177, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-01 18:07:01', '2020-10-01 18:07:01'),
(178, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-01 21:12:13', '2020-10-01 21:12:13'),
(179, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-02 08:23:35', '2020-10-02 08:23:35'),
(180, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-02 11:02:03', '2020-10-02 11:02:03'),
(181, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-03 05:14:31', '2020-10-03 05:14:31'),
(182, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-03 18:42:45', '2020-10-03 18:42:45'),
(183, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-05 06:06:40', '2020-10-05 06:06:40'),
(184, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-05 14:03:14', '2020-10-05 14:03:14'),
(185, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-05 17:56:39', '2020-10-05 17:56:39'),
(186, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-06 05:47:36', '2020-10-06 05:47:36'),
(187, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-06 18:49:09', '2020-10-06 18:49:09'),
(188, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 06:36:21', '2020-10-08 06:36:21'),
(189, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 06:37:10', '2020-10-08 06:37:10'),
(190, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36 OPR/71.0.3770.198', '2020-10-08 06:38:52', '2020-10-08 06:38:52'),
(191, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 06:40:55', '2020-10-08 06:40:55'),
(192, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 07:19:11', '2020-10-08 07:19:11'),
(193, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 08:43:33', '2020-10-08 08:43:33'),
(194, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 13:09:11', '2020-10-08 13:09:11'),
(195, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-08 17:55:49', '2020-10-08 17:55:49'),
(196, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-09 05:52:19', '2020-10-09 05:52:19'),
(197, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-09 10:49:30', '2020-10-09 10:49:30'),
(198, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-09 18:07:58', '2020-10-09 18:07:58'),
(199, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-09 18:08:19', '2020-10-09 18:08:19'),
(200, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-09 20:36:32', '2020-10-09 20:36:32'),
(201, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36', '2020-10-15 12:27:30', '2020-10-15 12:27:30'),
(202, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-16 04:31:15', '2020-10-16 04:31:15'),
(203, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-16 11:37:16', '2020-10-16 11:37:16'),
(204, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-16 15:15:52', '2020-10-16 15:15:52'),
(205, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-17 03:10:21', '2020-10-17 03:10:21'),
(206, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-17 18:07:56', '2020-10-17 18:07:56'),
(207, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-19 05:54:15', '2020-10-19 05:54:15'),
(208, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-20 07:32:54', '2020-10-20 07:32:54'),
(209, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-22 03:58:05', '2020-10-22 03:58:05'),
(210, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-22 23:46:06', '2020-10-22 23:46:06'),
(211, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-23 00:02:35', '2020-10-23 00:02:35'),
(212, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', '2020-10-23 05:59:01', '2020-10-23 05:59:01'),
(213, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-23 07:24:54', '2020-10-23 07:24:54'),
(214, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-23 16:58:47', '2020-10-23 16:58:47'),
(215, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-24 07:11:44', '2020-10-24 07:11:44'),
(216, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-24 07:11:44', '2020-10-24 07:11:44'),
(217, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-24 12:12:04', '2020-10-24 12:12:04'),
(218, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-24 12:12:04', '2020-10-24 12:12:04'),
(219, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-25 11:50:18', '2020-10-25 11:50:18'),
(220, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-25 11:50:18', '2020-10-25 11:50:18'),
(221, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-25 15:50:50', '2020-10-25 15:50:50'),
(222, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-25 15:50:50', '2020-10-25 15:50:50'),
(223, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-26 20:34:47', '2020-10-26 20:34:47'),
(224, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-26 20:36:14', '2020-10-26 20:36:14'),
(225, 10, '156.146.59.43', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-26 21:01:38', '2020-10-26 21:01:38'),
(226, 10, '197.210.70.140', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 8.1.0; Infinix X650) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-10-26 22:03:29', '2020-10-26 22:03:29'),
(227, 10, '154.120.99.66', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-26 22:41:30', '2020-10-26 22:41:30'),
(228, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', '2020-10-26 23:00:59', '2020-10-26 23:00:59'),
(229, 10, '197.210.70.140', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 8.1.0; Infinix X650) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-10-27 01:36:11', '2020-10-27 01:36:11'),
(230, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-27 02:07:27', '2020-10-27 02:07:27'),
(231, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36 Edg/86.0.622.51', '2020-10-27 02:36:20', '2020-10-27 02:36:20'),
(232, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-27 12:10:37', '2020-10-27 12:10:37'),
(233, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-27 16:48:27', '2020-10-27 16:48:27'),
(234, 10, '156.146.59.17', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-27 18:56:42', '2020-10-27 18:56:42'),
(235, 10, '197.210.54.121', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 8.1.0; Infinix X650) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-10-27 19:34:16', '2020-10-27 19:34:16'),
(236, 10, '129.205.113.247', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-27 19:51:39', '2020-10-27 19:51:39'),
(237, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-28 00:46:10', '2020-10-28 00:46:10'),
(238, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-28 04:31:53', '2020-10-28 04:31:53'),
(239, 25, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-28 04:34:19', '2020-10-28 04:34:19'),
(240, 10, '156.146.59.17', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-28 11:16:23', '2020-10-28 11:16:23'),
(241, 10, '156.146.59.5', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-28 15:01:59', '2020-10-28 15:01:59'),
(242, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-28 15:52:54', '2020-10-28 15:52:54'),
(243, 10, '156.146.59.22', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-28 18:44:29', '2020-10-28 18:44:29'),
(244, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 12_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-29 00:46:05', '2020-10-29 00:46:05'),
(245, 10, '105.112.71.77', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 12_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-29 04:09:23', '2020-10-29 04:09:23'),
(246, 10, '156.146.59.41', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-29 08:39:58', '2020-10-29 08:39:58'),
(247, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-29 11:21:16', '2020-10-29 11:21:16'),
(248, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-29 11:21:40', '2020-10-29 11:21:40'),
(249, 10, '102.89.0.59', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 8.1.0; Infinix X650) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-10-29 11:44:17', '2020-10-29 11:44:17'),
(250, 25, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-29 12:24:15', '2020-10-29 12:24:15'),
(251, 25, '105.112.70.155', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-29 13:06:47', '2020-10-29 13:06:47'),
(252, 25, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-29 14:13:01', '2020-10-29 14:13:01'),
(253, 10, '129.205.124.137', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-29 14:28:35', '2020-10-29 14:28:35'),
(254, 25, '105.112.70.155', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-29 17:03:21', '2020-10-29 17:03:21'),
(255, 10, '105.112.48.123', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-30 12:01:50', '2020-10-30 12:01:50'),
(256, 10, '105.112.48.123', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-30 19:41:17', '2020-10-30 19:41:17'),
(257, 10, '105.112.18.79', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-31 12:43:06', '2020-10-31 12:43:06'),
(258, 10, '105.112.18.79', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-31 12:54:21', '2020-10-31 12:54:21'),
(259, 25, '105.112.18.79', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-31 12:54:43', '2020-10-31 12:54:43'),
(260, 25, '105.112.186.99', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-31 13:40:39', '2020-10-31 13:40:39'),
(261, 10, '156.146.59.35', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-31 14:04:38', '2020-10-31 14:04:38'),
(262, 10, '197.210.65.16', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-10-31 15:06:09', '2020-10-31 15:06:09'),
(263, 10, '197.210.65.16', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-10-31 18:25:34', '2020-10-31 18:25:34'),
(264, 10, '105.112.39.65', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-10-31 19:26:34', '2020-10-31 19:26:34'),
(265, 10, '105.112.39.65', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-31 19:59:53', '2020-10-31 19:59:53'),
(266, 25, '105.112.39.65', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-10-31 20:01:31', '2020-10-31 20:01:31'),
(267, 10, '156.146.59.11', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-10-31 21:55:35', '2020-10-31 21:55:35'),
(268, 10, '105.112.33.77', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-02 23:18:26', '2020-11-02 23:18:26'),
(269, 10, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-03 21:06:12', '2020-11-03 21:06:12'),
(270, 25, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-04 02:50:47', '2020-11-04 02:50:47'),
(271, 10, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-04 02:57:36', '2020-11-04 02:57:36'),
(272, 10, '156.146.59.9', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36', '2020-11-06 18:36:59', '2020-11-06 18:36:59'),
(273, 10, '197.210.64.98', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-06 19:41:35', '2020-11-06 19:41:35'),
(274, 10, '105.112.66.180', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-06 21:10:22', '2020-11-06 21:10:22'),
(275, 10, '105.112.66.180', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-06 21:24:09', '2020-11-06 21:24:09'),
(276, 10, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36', '2020-11-06 21:43:37', '2020-11-06 21:43:37'),
(277, 10, '129.205.113.245', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-06 21:51:43', '2020-11-06 21:51:43'),
(278, 10, '129.205.113.245', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-06 21:53:08', '2020-11-06 21:53:08'),
(279, 25, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', '2020-11-06 21:56:08', '2020-11-06 21:56:08'),
(280, 10, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', '2020-11-06 21:56:53', '2020-11-06 21:56:53'),
(281, 10, '197.210.226.216', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-06 21:58:31', '2020-11-06 21:58:31'),
(282, 10, '197.210.226.216', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-06 22:21:31', '2020-11-06 22:21:31'),
(283, 10, '197.210.227.93', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-06 22:29:20', '2020-11-06 22:29:20'),
(284, 10, '105.112.70.104', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-06 22:42:11', '2020-11-06 22:42:11'),
(285, 25, '105.112.70.104', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-06 22:49:53', '2020-11-06 22:49:53'),
(286, 25, '105.112.70.104', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-06 23:11:12', '2020-11-06 23:11:12'),
(287, 25, '105.112.70.104', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-06 23:17:51', '2020-11-06 23:17:51'),
(288, 25, '129.205.124.144', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-07 01:15:53', '2020-11-07 01:15:53'),
(289, 10, '197.210.226.216', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-11-07 01:27:18', '2020-11-07 01:27:18'),
(290, 25, '129.205.124.141', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36', '2020-11-07 12:12:26', '2020-11-07 12:12:26'),
(291, 25, '129.205.124.141', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36', '2020-11-07 12:21:39', '2020-11-07 12:21:39'),
(292, 29, '129.205.124.141', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36', '2020-11-07 12:28:23', '2020-11-07 12:28:23'),
(293, 25, '129.205.124.146', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-07 16:17:37', '2020-11-07 16:17:37'),
(294, 25, '129.205.124.146', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-07 16:19:30', '2020-11-07 16:19:30'),
(295, 29, '102.89.3.35', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-07 16:19:57', '2020-11-07 16:19:57'),
(296, 25, '129.205.124.146', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-07 17:28:27', '2020-11-07 17:28:27'),
(297, 30, '129.205.124.146', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-07 17:38:14', '2020-11-07 17:38:14'),
(298, 31, '129.205.124.146', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-07 19:39:56', '2020-11-07 19:39:56'),
(299, 31, '105.112.67.190', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-08 01:46:37', '2020-11-08 01:46:37'),
(300, 10, '105.112.33.27', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-08 13:43:24', '2020-11-08 13:43:24'),
(301, 10, '105.112.33.231', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-08 17:31:43', '2020-11-08 17:31:43'),
(302, 10, '105.112.33.231', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-08 17:32:39', '2020-11-08 17:32:39'),
(303, 25, '129.205.124.150', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36', '2020-11-08 19:40:52', '2020-11-08 19:40:52'),
(304, 10, '105.112.71.236', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-08 21:31:54', '2020-11-08 21:31:54'),
(305, 10, '105.112.71.236', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-09 02:26:29', '2020-11-09 02:26:29'),
(306, 10, '105.112.25.212', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-09 13:59:09', '2020-11-09 13:59:09'),
(307, 10, '105.112.69.113', 'Unknown', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-09 19:38:05', '2020-11-09 19:38:05'),
(308, 10, '129.205.124.159', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-10 03:36:41', '2020-11-10 03:36:41'),
(309, 31, '129.205.124.150', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-10 03:37:34', '2020-11-10 03:37:34'),
(310, 10, '129.205.124.180', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36', '2020-11-10 23:37:32', '2020-11-10 23:37:32'),
(311, 10, '102.89.0.224', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-11 15:00:06', '2020-11-11 15:00:06'),
(312, 10, '102.89.1.71', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-11 15:36:47', '2020-11-11 15:36:47'),
(313, 10, '129.205.124.170', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-11 15:39:41', '2020-11-11 15:39:41'),
(314, 10, '156.146.59.28', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-11 15:45:30', '2020-11-11 15:45:30'),
(315, 10, '129.205.124.170', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-11 18:24:40', '2020-11-11 18:24:40'),
(316, 10, '129.205.124.170', 'Unknown', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-11 20:54:51', '2020-11-11 20:54:51'),
(317, 25, '129.205.124.170', 'Unknown', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-11 21:52:25', '2020-11-11 21:52:25'),
(318, 25, '129.205.124.170', 'Unknown', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-11 21:53:02', '2020-11-11 21:53:02'),
(319, 10, '156.146.59.40', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-12 13:54:30', '2020-11-12 13:54:30'),
(320, 10, '197.210.64.169', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-12 13:58:26', '2020-11-12 13:58:26'),
(321, 10, '197.210.45.34', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-12 14:58:58', '2020-11-12 14:58:58'),
(322, 10, '129.205.124.161', 'Unknown', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-12 16:17:54', '2020-11-12 16:17:54'),
(323, 10, '129.205.124.161', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-12 16:49:10', '2020-11-12 16:49:10'),
(324, 10, '197.210.8.124', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-12 18:36:27', '2020-11-12 18:36:27'),
(325, 10, '156.146.59.35', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-12 19:40:37', '2020-11-12 19:40:37'),
(326, 10, '197.210.64.225', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-12 21:31:16', '2020-11-12 21:31:16'),
(327, 10, '105.112.18.153', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-13 01:11:17', '2020-11-13 01:11:17'),
(328, 31, '197.210.85.184', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0', '2020-11-13 01:18:36', '2020-11-13 01:18:36'),
(329, 10, '197.210.85.184', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0', '2020-11-13 01:21:13', '2020-11-13 01:21:13'),
(330, 25, '105.112.18.153', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-13 01:21:33', '2020-11-13 01:21:33'),
(331, 10, '105.112.18.153', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-13 01:22:08', '2020-11-13 01:22:08'),
(332, 31, '197.210.85.184', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0', '2020-11-13 01:25:58', '2020-11-13 01:25:58'),
(333, 31, '197.210.85.184', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0', '2020-11-13 01:28:54', '2020-11-13 01:28:54'),
(334, 31, '105.112.18.153', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1 Safari/605.1.15', '2020-11-13 01:32:04', '2020-11-13 01:32:04'),
(335, 31, '129.205.113.232', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-13 02:29:27', '2020-11-13 02:29:27'),
(336, 31, '129.205.113.232', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-13 02:31:38', '2020-11-13 02:31:38'),
(337, 31, '129.205.124.161', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', '2020-11-13 06:37:29', '2020-11-13 06:37:29'),
(338, 10, '105.112.39.92', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-13 17:03:12', '2020-11-13 17:03:12'),
(339, 31, '105.112.39.92', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-13 17:04:10', '2020-11-13 17:04:10'),
(340, 10, '197.210.29.219', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-13 21:22:58', '2020-11-13 21:22:58'),
(341, 31, '129.205.124.161', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-13 21:23:33', '2020-11-13 21:23:33'),
(342, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-13 19:30:59', '2020-11-13 19:30:59'),
(343, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-14 06:12:39', '2020-11-14 06:12:39'),
(344, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-14 11:42:14', '2020-11-14 11:42:14'),
(345, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-14 16:13:15', '2020-11-14 16:13:15'),
(346, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-15 10:55:52', '2020-11-15 10:55:52'),
(347, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-15 16:20:57', '2020-11-15 16:20:57'),
(348, 10, '::1', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-15 20:35:55', '2020-11-15 20:35:55'),
(349, 10, '197.210.8.253', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-17 13:01:18', '2020-11-17 13:01:18'),
(350, 10, '105.112.66.35', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-17 13:22:40', '2020-11-17 13:22:40'),
(351, 10, '105.112.66.35', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-17 13:26:09', '2020-11-17 13:26:09'),
(352, 10, '197.210.8.253', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-11-17 13:37:40', '2020-11-17 13:37:40'),
(353, 10, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-17 14:17:26', '2020-11-17 14:17:26'),
(354, 10, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-17 16:03:24', '2020-11-17 16:03:24'),
(355, 10, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-17 17:00:47', '2020-11-17 17:00:47'),
(356, 10, '105.112.66.35', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-17 23:17:26', '2020-11-17 23:17:26'),
(357, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-18 02:31:31', '2020-11-18 02:31:31'),
(358, 10, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-18 02:33:06', '2020-11-18 02:33:06'),
(359, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-18 02:41:44', '2020-11-18 02:41:44'),
(360, 31, '104.200.142.138', 'North America, United States , Dallas', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-18 05:24:53', '2020-11-18 05:24:53'),
(361, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-18 05:31:37', '2020-11-18 05:31:37'),
(362, 31, '197.210.226.197', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0', '2020-11-18 06:17:17', '2020-11-18 06:17:17'),
(363, 10, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-18 14:34:48', '2020-11-18 14:34:48'),
(364, 10, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-18 14:38:31', '2020-11-18 14:38:31'),
(365, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-18 14:40:07', '2020-11-18 14:40:07'),
(366, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-18 15:58:35', '2020-11-18 15:58:35'),
(367, 31, '197.210.65.60', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-18 16:53:49', '2020-11-18 16:53:49'),
(368, 31, '197.210.55.109', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-11-18 17:57:17', '2020-11-18 17:57:17'),
(369, 31, '105.112.66.130', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-18 18:32:53', '2020-11-18 18:32:53'),
(370, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-18 18:46:55', '2020-11-18 18:46:55'),
(371, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-18 19:19:04', '2020-11-18 19:19:04'),
(372, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36 Edg/86.0.622.69', '2020-11-18 19:21:52', '2020-11-18 19:21:52'),
(373, 31, '105.112.74.230', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-18 20:47:51', '2020-11-18 20:47:51'),
(374, 31, '197.210.65.60', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-18 21:16:37', '2020-11-18 21:16:37'),
(375, 31, '197.210.54.122', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-11-19 00:52:59', '2020-11-19 00:52:59'),
(376, 31, '129.205.124.165', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-19 16:24:08', '2020-11-19 16:24:08'),
(377, 31, '129.205.113.238', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-19 20:45:39', '2020-11-19 20:45:39'),
(378, 10, '129.205.113.238', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-20 00:10:48', '2020-11-20 00:10:48'),
(379, 25, '129.205.113.238', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-20 00:56:47', '2020-11-20 00:56:47'),
(380, 31, '129.205.124.185', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-20 14:17:02', '2020-11-20 14:17:02'),
(381, 31, '197.210.85.177', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-11-20 16:45:38', '2020-11-20 16:45:38'),
(382, 10, '105.112.76.5', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-22 22:47:45', '2020-11-22 22:47:45'),
(383, 10, '156.146.59.3', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-23 11:40:22', '2020-11-23 11:40:22'),
(384, 10, '156.146.59.3', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-11-23 11:41:14', '2020-11-23 11:41:14'),
(385, 25, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-25 00:05:33', '2020-11-25 00:05:33'),
(386, 31, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-25 01:02:32', '2020-11-25 01:02:32'),
(387, 10, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36 Edg/87.0.664.41', '2020-11-25 01:31:35', '2020-11-25 01:31:35'),
(388, 10, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36 Edg/87.0.664.41', '2020-11-25 01:56:48', '2020-11-25 01:56:48'),
(389, 31, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36 Edg/87.0.664.41', '2020-11-25 04:27:33', '2020-11-25 04:27:33'),
(390, 25, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-25 04:28:00', '2020-11-25 04:28:00'),
(391, 25, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36 Edg/87.0.664.41', '2020-11-25 04:28:36', '2020-11-25 04:28:36'),
(392, 25, '129.205.124.187', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-25 05:19:36', '2020-11-25 05:19:36'),
(393, 10, '105.112.50.11', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-27 00:34:22', '2020-11-27 00:34:22'),
(394, 10, '105.112.50.11', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-27 00:34:51', '2020-11-27 00:34:51'),
(395, 10, '105.112.50.11', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-27 00:35:18', '2020-11-27 00:35:18'),
(396, 31, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-27 02:51:51', '2020-11-27 02:51:51'),
(397, 10, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-27 17:31:30', '2020-11-27 17:31:30'),
(398, 31, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-27 17:33:28', '2020-11-27 17:33:28'),
(399, 10, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-27 23:20:23', '2020-11-27 23:20:23'),
(400, 25, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-27 23:21:48', '2020-11-27 23:21:48'),
(401, 25, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-28 00:12:05', '2020-11-28 00:12:05'),
(402, 10, '129.205.124.228', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-28 00:17:11', '2020-11-28 00:17:11'),
(403, 10, '129.205.124.221', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-28 21:41:37', '2020-11-28 21:41:37'),
(404, 10, '129.205.124.221', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-29 02:16:11', '2020-11-29 02:16:11'),
(405, 10, '105.112.71.95', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-30 17:31:01', '2020-11-30 17:31:01'),
(406, 10, '129.205.124.221', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-11-30 17:36:00', '2020-11-30 17:36:00');
INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `location`, `details`, `created_at`, `updated_at`) VALUES
(407, 10, '129.205.124.221', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-11-30 19:11:47', '2020-11-30 19:11:47'),
(408, 10, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-02 16:14:56', '2020-12-02 16:14:56'),
(409, 10, '197.210.8.89', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-02 23:33:09', '2020-12-02 23:33:09'),
(410, 10, '197.210.8.89', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-03 01:47:38', '2020-12-03 01:47:38'),
(411, 10, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', '2020-12-03 01:58:11', '2020-12-03 01:58:11'),
(412, 10, '197.210.8.89', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Nokia 4.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.114 Mobile Safari/537.36', '2020-12-03 02:45:41', '2020-12-03 02:45:41'),
(413, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-03 02:50:26', '2020-12-03 02:50:26'),
(414, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-03 11:24:47', '2020-12-03 11:24:47'),
(415, 10, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-03 11:25:41', '2020-12-03 11:25:41'),
(416, 25, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-03 11:27:03', '2020-12-03 11:27:03'),
(417, 25, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-03 13:45:27', '2020-12-03 13:45:27'),
(418, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-03 14:35:51', '2020-12-03 14:35:51'),
(419, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-03 14:39:03', '2020-12-03 14:39:03'),
(420, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-03 17:35:22', '2020-12-03 17:35:22'),
(421, 10, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.67 Safari/537.36 Edg/87.0.664.52', '2020-12-03 17:54:28', '2020-12-03 17:54:28'),
(422, 25, '105.112.147.95', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-04 16:13:53', '2020-12-04 16:13:53'),
(423, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-04 16:33:27', '2020-12-04 16:33:27'),
(424, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-04 16:34:03', '2020-12-04 16:34:03'),
(425, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-04 16:42:38', '2020-12-04 16:42:38'),
(426, 10, '105.112.144.47', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-04 20:03:41', '2020-12-04 20:03:41'),
(427, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-04 20:37:16', '2020-12-04 20:37:16'),
(428, 25, '129.205.124.241', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-04 20:40:56', '2020-12-04 20:40:56'),
(429, 10, '102.89.2.6', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0', '2020-12-05 00:42:23', '2020-12-05 00:42:23'),
(430, 10, '129.205.124.247', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-05 08:13:15', '2020-12-05 08:13:15'),
(431, 10, '129.205.124.247', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-05 08:13:45', '2020-12-05 08:13:45'),
(432, 10, '197.210.44.244', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0', '2020-12-05 08:27:01', '2020-12-05 08:27:01'),
(433, 31, '197.210.84.77', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-12-06 08:36:50', '2020-12-06 08:36:50'),
(434, 31, '197.210.84.77', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-12-06 08:38:13', '2020-12-06 08:38:13'),
(435, 10, '102.89.2.148', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-12-06 12:15:39', '2020-12-06 12:15:39'),
(436, 34, '197.210.28.157', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-06 14:46:09', '2020-12-06 14:46:09'),
(437, 25, '129.205.124.245', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', '2020-12-07 09:07:10', '2020-12-07 09:07:10'),
(438, 25, '129.205.124.245', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.67 Safari/537.36 Edg/87.0.664.55', '2020-12-07 09:08:34', '2020-12-07 09:08:34'),
(439, 10, '129.205.124.245', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', '2020-12-07 09:46:42', '2020-12-07 09:46:42'),
(440, 34, '105.112.74.4', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:79.0) Gecko/20100101 Firefox/79.0', '2020-12-07 11:24:04', '2020-12-07 11:24:04'),
(441, 35, '102.89.3.187', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-07 15:54:36', '2020-12-07 15:54:36'),
(442, 35, '86.106.74.186', 'Unknown', 'PostmanRuntime/7.26.8', '2020-12-07 15:56:15', '2020-12-07 15:56:15'),
(443, 35, '86.106.74.186', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-07 15:56:21', '2020-12-07 15:56:21'),
(444, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:02:51', '2020-12-08 13:02:51'),
(445, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:02:56', '2020-12-08 13:02:56'),
(446, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-08 13:03:01', '2020-12-08 13:03:01'),
(447, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:03:05', '2020-12-08 13:03:05'),
(448, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:05:21', '2020-12-08 13:05:21'),
(449, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:05:59', '2020-12-08 13:05:59'),
(450, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:07:27', '2020-12-08 13:07:27'),
(451, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:08:16', '2020-12-08 13:08:16'),
(452, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:09:42', '2020-12-08 13:09:42'),
(453, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:11:05', '2020-12-08 13:11:05'),
(454, 35, '197.210.64.178', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-08 13:11:40', '2020-12-08 13:11:40'),
(455, 10, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-08 19:09:33', '2020-12-08 19:09:33'),
(456, 10, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-09 09:14:32', '2020-12-09 09:14:32'),
(457, 10, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-09 09:15:25', '2020-12-09 09:15:25'),
(458, 31, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-09 09:18:03', '2020-12-09 09:18:03'),
(459, 31, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-09 09:28:57', '2020-12-09 09:28:57'),
(460, 35, '197.210.44.105', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-09 11:36:42', '2020-12-09 11:36:42'),
(461, 35, '197.210.44.105', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-09 11:42:07', '2020-12-09 11:42:07'),
(462, 35, '197.210.44.105', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-09 11:45:06', '2020-12-09 11:45:06'),
(463, 35, '197.210.44.105', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-09 11:46:31', '2020-12-09 11:46:31'),
(464, 10, '156.146.59.5', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36', '2020-12-09 13:26:52', '2020-12-09 13:26:52'),
(465, 10, '102.89.3.81', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-12-09 13:34:24', '2020-12-09 13:34:24'),
(466, 35, '197.210.8.1', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-09 19:12:37', '2020-12-09 19:12:37'),
(467, 35, '185.206.225.34', 'Europe, Norway , Oslo', 'PostmanRuntime/7.26.8', '2020-12-09 20:37:28', '2020-12-09 20:37:28'),
(468, 10, '102.89.1.248', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-10 08:13:05', '2020-12-10 08:13:05'),
(469, 10, '197.210.8.240', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-12-10 09:10:00', '2020-12-10 09:10:00'),
(470, 35, '102.89.1.74', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-10 09:18:26', '2020-12-10 09:18:26'),
(471, 35, '197.210.29.161', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-10 12:14:42', '2020-12-10 12:14:42'),
(472, 10, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-10 12:54:28', '2020-12-10 12:54:28'),
(473, 25, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-10 12:59:20', '2020-12-10 12:59:20'),
(474, 31, '197.210.54.251', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-10 14:22:20', '2020-12-10 14:22:20'),
(475, 10, '129.205.124.242', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-10 15:47:13', '2020-12-10 15:47:13'),
(476, 35, '102.89.0.215', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-11 09:38:33', '2020-12-11 09:38:33'),
(477, 35, '102.89.0.168', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-11 12:31:24', '2020-12-11 12:31:24'),
(478, 31, '129.205.124.245', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-11 15:37:02', '2020-12-11 15:37:02'),
(479, 35, '197.210.28.111', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-11 15:51:38', '2020-12-11 15:51:38'),
(480, 35, '197.210.28.111', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-11 15:52:44', '2020-12-11 15:52:44'),
(481, 35, '197.210.28.111', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-11 15:54:49', '2020-12-11 15:54:49'),
(482, 35, '197.210.28.111', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-11 16:36:29', '2020-12-11 16:36:29'),
(483, 35, '102.89.2.54', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-11 17:08:49', '2020-12-11 17:08:49'),
(484, 35, '102.89.1.85', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-11 22:38:41', '2020-12-11 22:38:41'),
(485, 35, '102.89.0.188', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-11 22:49:44', '2020-12-11 22:49:44'),
(486, 35, '197.210.65.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-12 07:58:14', '2020-12-12 07:58:14'),
(487, 35, '197.210.29.145', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-12 16:00:05', '2020-12-12 16:00:05'),
(488, 10, '129.205.124.245', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-12 20:58:54', '2020-12-12 20:58:54'),
(489, 31, '129.205.124.245', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-12 21:00:39', '2020-12-12 21:00:39'),
(490, 10, '129.205.113.250', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-13 07:46:06', '2020-12-13 07:46:06'),
(491, 31, '129.205.124.243', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-13 17:24:41', '2020-12-13 17:24:41'),
(492, 10, '129.205.124.243', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-13 17:25:46', '2020-12-13 17:25:46'),
(493, 35, '197.210.65.208', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-14 08:37:08', '2020-12-14 08:37:08'),
(494, 35, '197.210.65.208', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-14 08:42:04', '2020-12-14 08:42:04'),
(495, 35, '102.89.0.194', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-14 09:58:56', '2020-12-14 09:58:56'),
(496, 35, '102.89.0.194', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-14 10:35:56', '2020-12-14 10:35:56'),
(497, 35, '197.210.29.46', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-14 18:22:03', '2020-12-14 18:22:03'),
(498, 35, '197.210.8.214', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-15 05:24:10', '2020-12-15 05:24:10'),
(499, 35, '197.210.8.214', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-15 07:02:24', '2020-12-15 07:02:24'),
(500, 35, '197.210.8.214', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-15 07:12:21', '2020-12-15 07:12:21'),
(501, 35, '197.210.28.181', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-15 10:03:08', '2020-12-15 10:03:08'),
(502, 10, '129.205.124.243', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-15 11:12:44', '2020-12-15 11:12:44'),
(503, 35, '197.210.28.181', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-15 13:29:14', '2020-12-15 13:29:14'),
(504, 35, '197.210.28.181', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-15 13:57:55', '2020-12-15 13:57:55'),
(505, 35, '197.210.28.181', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-15 14:00:03', '2020-12-15 14:00:03'),
(506, 10, '197.210.47.83', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 10; Infinix X682B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36', '2020-12-15 14:13:44', '2020-12-15 14:13:44'),
(507, 35, '102.89.1.74', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-15 15:47:57', '2020-12-15 15:47:57'),
(508, 35, '102.89.0.18', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-15 22:11:58', '2020-12-15 22:11:58'),
(509, 31, '129.205.124.243', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-16 14:57:16', '2020-12-16 14:57:16'),
(510, 31, '197.210.226.125', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1', '2020-12-16 20:56:49', '2020-12-16 20:56:49'),
(511, 35, '102.89.0.33', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-17 18:38:18', '2020-12-17 18:38:18'),
(512, 10, '129.205.124.243', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-18 08:20:34', '2020-12-18 08:20:34'),
(513, 35, '197.210.28.241', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-18 13:55:40', '2020-12-18 13:55:40'),
(514, 35, '197.210.28.241', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-18 14:03:39', '2020-12-18 14:03:39'),
(515, 35, '197.210.28.241', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-18 14:46:26', '2020-12-18 14:46:26'),
(516, 35, '197.210.28.241', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-18 15:44:02', '2020-12-18 15:44:02'),
(517, 10, '197.210.28.241', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-18 15:45:16', '2020-12-18 15:45:16'),
(518, 35, '197.210.8.101', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-18 16:37:08', '2020-12-18 16:37:08'),
(519, 35, '197.210.8.101', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-18 17:09:44', '2020-12-18 17:09:44'),
(520, 35, '197.210.8.101', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-18 17:12:58', '2020-12-18 17:12:58'),
(521, 10, '129.205.113.249', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-18 19:56:00', '2020-12-18 19:56:00'),
(522, 10, '197.210.29.76', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 05:09:27', '2020-12-19 05:09:27'),
(523, 35, '197.210.29.76', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 05:10:16', '2020-12-19 05:10:16'),
(524, 35, '102.89.3.49', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 05:30:09', '2020-12-19 05:30:09'),
(525, 35, '197.210.44.19', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 06:05:06', '2020-12-19 06:05:06'),
(526, 35, '102.89.0.192', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 09:23:26', '2020-12-19 09:23:26'),
(527, 10, '102.89.1.86', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 09:23:49', '2020-12-19 09:23:49'),
(528, 10, '129.205.113.249', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-19 11:05:28', '2020-12-19 11:05:28'),
(529, 35, '102.89.3.227', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-19 12:12:03', '2020-12-19 12:12:03'),
(530, 10, '91.219.215.42', 'Unknown', 'PostmanRuntime/7.26.8', '2020-12-19 12:43:43', '2020-12-19 12:43:43'),
(531, 35, '102.89.3.227', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-19 12:46:23', '2020-12-19 12:46:23'),
(532, 35, '102.89.1.35', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 14:54:21', '2020-12-19 14:54:21'),
(533, 35, '102.89.1.35', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 14:56:43', '2020-12-19 14:56:43'),
(534, 35, '102.89.0.99', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 15:31:12', '2020-12-19 15:31:12'),
(535, 35, '197.210.29.154', 'Unknown', 'PostmanRuntime/7.26.8', '2020-12-19 17:09:37', '2020-12-19 17:09:37'),
(536, 35, '102.89.0.175', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 21:38:40', '2020-12-19 21:38:40'),
(537, 10, '197.210.8.159', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 23:40:09', '2020-12-19 23:40:09'),
(538, 35, '197.210.8.159', 'Unknown', 'PostmanRuntime/7.26.8', '2020-12-19 23:44:45', '2020-12-19 23:44:45'),
(539, 35, '197.210.8.159', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 23:54:58', '2020-12-19 23:54:58'),
(540, 35, '197.210.8.159', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-19 23:57:07', '2020-12-19 23:57:07'),
(541, 35, '197.210.8.159', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-20 00:04:44', '2020-12-20 00:04:44'),
(542, 10, '197.210.8.159', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-20 00:05:47', '2020-12-20 00:05:47'),
(543, 25, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 07:09:50', '2020-12-20 07:09:50'),
(544, 25, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 07:11:23', '2020-12-20 07:11:23'),
(545, 40, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 07:54:27', '2020-12-20 07:54:27'),
(546, 31, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 07:57:30', '2020-12-20 07:57:30'),
(547, 29, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 08:10:38', '2020-12-20 08:10:38'),
(548, 10, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 08:13:11', '2020-12-20 08:13:11'),
(549, 10, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 08:22:06', '2020-12-20 08:22:06'),
(550, 10, '129.205.124.246', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-20 08:22:33', '2020-12-20 08:22:33'),
(551, 31, '129.205.124.246', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-20 08:23:12', '2020-12-20 08:23:12'),
(552, 31, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 08:27:21', '2020-12-20 08:27:21'),
(553, 25, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 08:32:02', '2020-12-20 08:32:02'),
(554, 31, '129.205.124.246', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-20 08:33:38', '2020-12-20 08:33:38'),
(555, 25, '129.205.124.246', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '2020-12-20 08:36:32', '2020-12-20 08:36:32'),
(556, 35, '197.210.29.87', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-20 11:35:00', '2020-12-20 11:35:00'),
(557, 35, '102.89.3.236', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-21 09:14:02', '2020-12-21 09:14:02'),
(558, 35, '102.89.3.200', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-21 10:58:50', '2020-12-21 10:58:50'),
(559, 10, '129.205.124.176', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36 Edg/87.0.664.66', '2020-12-21 13:56:46', '2020-12-21 13:56:46'),
(560, 35, '197.210.29.221', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-21 13:59:01', '2020-12-21 13:59:01'),
(561, 35, '197.210.29.221', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-21 13:59:20', '2020-12-21 13:59:20'),
(562, 10, '197.210.29.221', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-21 14:02:29', '2020-12-21 14:02:29'),
(563, 10, '129.205.124.176', 'Unknown', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36 Edg/87.0.664.66', '2020-12-21 22:48:55', '2020-12-21 22:48:55'),
(564, 33, '91.219.215.26', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-22 07:03:54', '2020-12-22 07:03:54'),
(565, 35, '91.219.215.26', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-22 07:04:25', '2020-12-22 07:04:25'),
(566, 10, '197.210.28.73', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-22 23:42:28', '2020-12-22 23:42:28'),
(567, 10, '197.210.45.103', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 12:57:26', '2020-12-23 12:57:26'),
(568, 10, '197.210.8.135', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 13:12:59', '2020-12-23 13:12:59'),
(569, 10, '197.210.8.135', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 14:40:03', '2020-12-23 14:40:03'),
(570, 10, '197.210.8.135', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 16:31:01', '2020-12-23 16:31:01'),
(571, 10, '197.210.8.135', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 17:55:17', '2020-12-23 17:55:17'),
(572, 35, '197.210.8.135', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-23 17:59:44', '2020-12-23 17:59:44'),
(573, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 20:39:53', '2020-12-23 20:39:53'),
(574, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 21:02:42', '2020-12-23 21:02:42'),
(575, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 22:41:43', '2020-12-23 22:41:43'),
(576, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 22:47:23', '2020-12-23 22:47:23'),
(577, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 22:54:07', '2020-12-23 22:54:07'),
(578, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 23:13:03', '2020-12-23 23:13:03'),
(579, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-23 23:20:56', '2020-12-23 23:20:56'),
(580, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 00:19:22', '2020-12-24 00:19:22'),
(581, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 00:32:37', '2020-12-24 00:32:37'),
(582, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 00:33:38', '2020-12-24 00:33:38'),
(583, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 00:36:23', '2020-12-24 00:36:23'),
(584, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 00:39:11', '2020-12-24 00:39:11'),
(585, 35, '197.210.8.209', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 00:46:55', '2020-12-24 00:46:55'),
(586, 10, '102.89.3.239', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 18:16:44', '2020-12-24 18:16:44'),
(587, 10, '102.89.3.232', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 18:16:44', '2020-12-24 18:16:44'),
(588, 10, '102.89.3.239', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 18:57:04', '2020-12-24 18:57:04'),
(589, 10, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-24 23:38:18', '2020-12-24 23:38:18'),
(590, 10, '86.106.74.186', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-24 23:51:09', '2020-12-24 23:51:09'),
(591, 35, '86.106.74.186', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-25 00:02:21', '2020-12-25 00:02:21'),
(592, 10, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 00:52:36', '2020-12-25 00:52:36'),
(593, 10, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 00:53:59', '2020-12-25 00:53:59'),
(594, 35, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 03:41:00', '2020-12-25 03:41:00'),
(595, 35, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 03:48:24', '2020-12-25 03:48:24'),
(596, 35, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 03:52:01', '2020-12-25 03:52:01'),
(597, 10, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 03:58:13', '2020-12-25 03:58:13'),
(598, 35, '197.210.29.255', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 04:11:03', '2020-12-25 04:11:03'),
(599, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 06:33:44', '2020-12-25 06:33:44'),
(600, 35, '197.210.28.230', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-25 06:34:43', '2020-12-25 06:34:43'),
(601, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 07:04:58', '2020-12-25 07:04:58'),
(602, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 07:22:07', '2020-12-25 07:22:07'),
(603, 35, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 07:26:43', '2020-12-25 07:26:43'),
(604, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 07:32:12', '2020-12-25 07:32:12'),
(605, 35, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 07:45:23', '2020-12-25 07:45:23'),
(606, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 08:14:22', '2020-12-25 08:14:22'),
(607, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 09:00:17', '2020-12-25 09:00:17'),
(608, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 09:04:52', '2020-12-25 09:04:52'),
(609, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 09:25:09', '2020-12-25 09:25:09'),
(610, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 09:25:18', '2020-12-25 09:25:18'),
(611, 35, '197.210.28.230', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-25 09:26:07', '2020-12-25 09:26:07'),
(612, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 09:26:25', '2020-12-25 09:26:25'),
(613, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 09:28:21', '2020-12-25 09:28:21'),
(614, 10, '129.205.124.172', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-25 12:10:26', '2020-12-25 12:10:26'),
(615, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 12:11:19', '2020-12-25 12:11:19'),
(616, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 12:11:27', '2020-12-25 12:11:27'),
(617, 10, '197.210.28.230', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 12:13:00', '2020-12-25 12:13:00'),
(618, 31, '129.205.124.172', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-25 12:24:05', '2020-12-25 12:24:05'),
(619, 25, '129.205.124.172', 'Unknown', 'Dart/2.11 (dart:io)', '2020-12-25 12:30:32', '2020-12-25 12:30:32'),
(620, 31, '197.210.29.199', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 13:30:26', '2020-12-25 13:30:26'),
(621, 10, '197.210.8.12', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-25 20:05:42', '2020-12-25 20:05:42'),
(622, 31, '129.205.124.172', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-26 14:44:29', '2020-12-26 14:44:29'),
(623, 10, '129.205.124.172', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-26 14:45:51', '2020-12-26 14:45:51'),
(624, 10, '129.205.124.172', 'Unknown', 'Mozilla/5.0 (iPad; CPU OS 14_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-26 14:46:09', '2020-12-26 14:46:09'),
(625, 31, '129.205.113.187', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-26 17:33:40', '2020-12-26 17:33:40'),
(626, 25, '129.205.113.187', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-26 17:35:14', '2020-12-26 17:35:14'),
(627, 31, '129.205.113.187', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-26 17:39:19', '2020-12-26 17:39:19'),
(628, 10, '129.205.113.187', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-26 17:48:28', '2020-12-26 17:48:28'),
(629, 25, '129.205.113.187', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-26 17:51:14', '2020-12-26 17:51:14'),
(630, 31, '129.205.113.187', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-26 17:59:01', '2020-12-26 17:59:01'),
(631, 35, '102.89.1.42', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-27 21:23:43', '2020-12-27 21:23:43'),
(632, 10, '102.89.1.78', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-28 10:33:02', '2020-12-28 10:33:02'),
(633, 35, '102.89.0.173', 'Africa, Nigeria , Lagos', 'PostmanRuntime/7.26.8', '2020-12-28 11:42:23', '2020-12-28 11:42:23'),
(634, 34, '197.210.61.84', 'Africa, Nigeria , Lagos', 'Mozilla/5.0 (Linux; Android 9; Infinix X650D) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.92 Mobile Safari/537.36', '2020-12-28 14:03:27', '2020-12-28 14:03:27'),
(635, 10, '102.89.1.34', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-28 15:11:15', '2020-12-28 15:11:15'),
(636, 10, '102.89.0.201', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-29 06:47:41', '2020-12-29 06:47:41'),
(637, 10, '129.205.124.175', 'Unknown', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/86.0.4240.93 Mobile/15E148 Safari/604.1', '2020-12-29 08:54:22', '2020-12-29 08:54:22'),
(638, 25, '197.210.8.55', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-29 09:11:06', '2020-12-29 09:11:06'),
(639, 10, '197.210.8.55', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-29 09:28:09', '2020-12-29 09:28:09'),
(640, 10, '197.210.29.124', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-29 10:46:43', '2020-12-29 10:46:43'),
(641, 10, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-29 20:40:08', '2020-12-29 20:40:08'),
(642, 10, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:12:47', '2020-12-30 00:12:47'),
(643, 35, '197.210.65.174', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:14:24', '2020-12-30 00:14:24'),
(644, 35, '197.210.65.174', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:16:51', '2020-12-30 00:16:51'),
(645, 35, '197.210.65.174', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:17:06', '2020-12-30 00:17:06'),
(646, 35, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:19:34', '2020-12-30 00:19:34'),
(647, 35, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:19:42', '2020-12-30 00:19:42'),
(648, 35, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:19:59', '2020-12-30 00:19:59'),
(649, 35, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:29:28', '2020-12-30 00:29:28'),
(650, 10, '197.210.65.57', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:34:26', '2020-12-30 00:34:26'),
(651, 10, '102.89.3.238', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:38:58', '2020-12-30 00:38:58'),
(652, 35, '197.210.65.174', 'Africa, Nigeria , Lagos', 'Dart/2.11 (dart:io)', '2020-12-30 00:43:56', '2020-12-30 00:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallets`
--

CREATE TABLE `user_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0.00000000',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_wallets`
--

INSERT INTO `user_wallets` (`id`, `user_id`, `balance`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, 10, '832.1199999999999', 'interest_wallet', 1, '2020-10-02 03:42:30', '2020-10-27 13:13:59'),
(3, 20, '0', 'interest_wallet', 1, '2020-10-08 10:37:34', '2020-10-08 10:37:34'),
(4, 21, '0', 'interest_wallet', 1, '2020-10-09 20:30:19', '2020-10-09 20:30:19'),
(5, 22, '0', 'interest_wallet', 1, '2020-10-09 20:36:02', '2020-10-09 20:36:02'),
(6, 23, '0', 'interest_wallet', 1, '2020-10-15 17:12:39', '2020-10-15 17:12:39'),
(7, 24, '0', 'interest_wallet', 1, '2020-10-15 17:19:10', '2020-10-15 17:19:10'),
(8, 25, '0', 'interest_wallet', 1, '2020-10-28 03:24:12', '2020-10-28 03:24:12'),
(9, 26, '0', 'interest_wallet', 1, '2020-10-28 15:10:35', '2020-10-28 15:10:35'),
(10, 27, '9000', 'interest_wallet', 1, '2020-10-28 15:19:06', '2020-10-28 15:19:06'),
(11, 28, '0', 'interest_wallet', 1, '2020-10-28 15:23:38', '2020-10-28 15:23:38'),
(12, 29, '0', 'interest_wallet', 1, '2020-11-07 04:32:33', '2020-11-07 04:32:33'),
(13, 30, '0', 'interest_wallet', 1, '2020-11-07 17:24:23', '2020-11-07 17:24:23'),
(14, 31, '0', 'interest_wallet', 1, '2020-11-07 19:25:54', '2020-11-07 19:25:54'),
(15, 32, '0', 'interest_wallet', 1, '2020-11-09 14:13:17', '2020-11-09 14:13:17'),
(16, 33, '0', 'interest_wallet', 1, '2020-12-05 15:37:04', '2020-12-05 15:37:04'),
(17, 34, '0', 'interest_wallet', 1, '2020-12-06 14:34:04', '2020-12-06 14:34:04'),
(18, 35, '0', 'interest_wallet', 1, '2020-12-07 15:54:09', '2020-12-07 15:54:09'),
(19, 36, '0', 'interest_wallet', 1, '2020-12-08 14:15:00', '2020-12-08 14:15:00'),
(20, 37, '0', 'interest_wallet', 1, '2020-12-08 14:38:27', '2020-12-08 14:38:27'),
(21, 38, '0', 'interest_wallet', 1, '2020-12-08 14:39:56', '2020-12-08 14:39:56'),
(22, 39, '0', 'interest_wallet', 1, '2020-12-09 11:08:09', '2020-12-09 11:08:09'),
(23, 40, '0', 'interest_wallet', 1, '2020-12-20 07:47:36', '2020-12-20 07:47:36'),
(24, 41, '0', 'interest_wallet', 1, '2020-12-20 07:52:43', '2020-12-20 07:52:43'),
(25, 42, '0', 'interest_wallet', 1, '2020-12-20 13:05:31', '2020-12-20 13:05:31'),
(26, 43, '0', 'interest_wallet', 1, '2020-12-28 15:04:06', '2020-12-28 15:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(55) DEFAULT NULL,
  `type` varchar(55) DEFAULT NULL,
  `image1` varchar(55) DEFAULT NULL,
  `image2` varchar(55) DEFAULT NULL,
  `number` varchar(55) DEFAULT NULL,
  `date` varchar(55) DEFAULT NULL,
  `status` int(55) DEFAULT NULL,
  `created_at` varchar(55) DEFAULT NULL,
  `updated_at` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `user_id`, `type`, `image1`, `image2`, `number`, `date`, `status`, `created_at`, `updated_at`) VALUES
(11, 31, 'Driver\'s Licence', '5fad9e834537d.jpg', '5fad9e834726c.jpg', '12345678', '2010-07-06', 1, '2020-11-12 20:43:47', '2020-11-12 20:44:05'),
(15, 10, 'Driver\'s Licence', '5fcb431cd4cc4.jpg', '5fcb431cd5429.jpg', '3109311718', '3002-02-01', 1, '2020-12-05 08:21:48', '2020-12-05 08:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `verifieds`
--

CREATE TABLE `verifieds` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(55) DEFAULT NULL,
  `number` varchar(99) DEFAULT NULL,
  `firstName` varchar(55) DEFAULT NULL,
  `lastName` varchar(55) DEFAULT NULL,
  `phoneNumber` varchar(55) DEFAULT NULL,
  `gender` varchar(55) DEFAULT NULL,
  `dateOfBirth` varchar(55) DEFAULT NULL,
  `base64Image` text DEFAULT NULL,
  `created_at` varchar(55) DEFAULT NULL,
  `updated_at` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verifieds`
--

INSERT INTO `verifieds` (`id`, `user_id`, `number`, `firstName`, `lastName`, `phoneNumber`, `gender`, `dateOfBirth`, `base64Image`, `created_at`, `updated_at`) VALUES
(12, 10, '22222222222', 'aishatu', 'SADIQ', '08034903346', 'Female', '02-Feb-1987', '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', '2020-10-17 21:50:01', '2020-10-17 21:50:01'),
(13, 10, '22222222222', 'aishatu', 'SADIQ', '08034903346', 'Female', '02-Feb-1987', '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', '2020-10-17 21:50:42', '2020-10-17 21:50:42'),
(14, 31, '22174518307', 'NELSON', 'AMARE', '08053682074', 'Male', '02-Mar-1985', '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', '2020-11-12 20:37:54', '2020-11-12 20:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `virtual_cards`
--

CREATE TABLE `virtual_cards` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` text NOT NULL,
  `pan` text NOT NULL,
  `masked_pan` text NOT NULL,
  `city` varchar(90) NOT NULL,
  `state` varchar(90) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `cvv` int(5) NOT NULL,
  `expiration` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `country` varchar(900) NOT NULL,
  `currency` varchar(30) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `card_id` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `virtual_cards`
--

INSERT INTO `virtual_cards` (`id`, `user_id`, `name`, `pan`, `masked_pan`, `city`, `state`, `address`, `postal_code`, `cvv`, `expiration`, `type`, `country`, `currency`, `amount`, `status`, `card_id`, `created_at`, `updated_at`) VALUES
(1, 10, 'Samji Diamond', '5366130699778900', '536613*******8900', 'San Francisco', 'CA', '333 fremont road', NULL, 134, '2023-01', 'mastercard', 'NG', 'NGN', 2120, 'active', '43ec6e92-9eb7-48ad-91c8-7bee425a33cf', '2020-11-15 21:36:54', '2020-11-17 07:56:10'),
(2, 10, 'Baddest Nigga', '5366130699778900', '536613*******8900', 'San Francisco', 'CA', '333 fremont road', NULL, 134, '2023-01', 'mastercard', 'US', 'USD', 3, 'active', '43ec6e92-9eb7-48ad-91c8-7bee425a33cf', '2020-11-15 21:37:18', '2020-11-17 07:56:10'),
(3, 31, 'Samji Diamond', '4160462381781293', '416046*******1293', 'San Francisco', 'CA', '333 fremont road', NULL, 352, '2023-11', 'visa', 'NG', 'NGN', 400, 'terminated', '812102bb-3122-423e-ab3d-39e9628a7995', '2020-11-18 05:29:37', '2020-12-12 21:01:31'),
(4, 31, 'Sammy Card', '4160466501332945', '416046*******2945', 'San Francisco', 'CA', '333 fremont road', NULL, 862, '2023-11', 'visa', 'NG', 'NGN', 100, 'terminated', '722f55e1-028f-441b-b5d2-a73705a9e5e4', '2020-11-18 05:47:55', '2020-11-18 05:48:32'),
(5, 31, 'Sammy test', '4160465950807399', '416046*******7399', 'San Francisco', 'CA', '333 fremont road', NULL, 676, '2023-11', 'visa', 'NG', 'NGN', 5000, 'terminated', '90bb338b-8547-47d3-b061-2092afb31e34', '2020-11-18 17:09:50', '2020-11-18 17:12:28'),
(6, 31, 'Samji B.', '4288030068190893', '428803*******0893', 'San Francisco', 'CA', '333 fremont road', NULL, 429, '2024-11', 'visa', 'US', 'USD', 5, 'terminated', '07fdb833-9071-4b7e-8d2e-5d75e33bca80', '2020-11-18 21:17:25', '2020-11-18 21:23:27'),
(7, 31, 'Ighalo Davidson', '4288030067736514', '428803*******6514', 'San Francisco', 'CA', '333 fremont road', NULL, 14, '2024-11', 'visa', 'US', 'USD', 5, 'terminated', '5e977daf-80ba-468d-ad39-87d449286b1c', '2020-11-19 16:42:21', '2020-11-19 16:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_logs`
--

CREATE TABLE `withdraw_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_logs`
--

INSERT INTO `withdraw_logs` (`id`, `user_id`, `method_id`, `transaction_id`, `wallet_id`, `currency_id`, `amount`, `charge`, `net_amount`, `send_details`, `message`, `status`, `created_at`, `updated_at`) VALUES
(27, 10, 2, 'WA3JVXPZEMU0L91DQVR9', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-09-30 19:25:36', '2020-09-30 19:25:36'),
(28, 10, 2, 'KLBGDV7ER08JLRNOXYEK', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-09-30 19:25:57', '2020-09-30 19:25:57'),
(29, 10, 2, 'RQ384PXTE6BITC9GXWSC', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-09-30 19:26:18', '2020-09-30 19:26:18'),
(30, 19, 2, 'OQVPBY0DX9BLTZGAV58P', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-09-30 19:26:44', '2020-09-30 19:26:44'),
(31, 10, 2, 'PY4MKZDGFNUDOOLALNBE', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 2, '2020-09-30 19:27:13', '2020-10-07 12:56:31'),
(32, 10, 2, '1K52MNMRVAJWOGEONQNZ', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 2, '2020-09-30 19:31:39', '2020-10-07 12:55:24'),
(36, 10, 4, '4NXPRRZOYUUYYR9JGOLL', NULL, NULL, '100', '3.8', '103.8', NULL, NULL, 0, '2020-10-08 13:09:32', '2020-10-08 13:09:32'),
(37, 10, 4, 'Q3T4JYM1QTP5VOMCIMOZ', NULL, NULL, '100', '3.8', '103.8', 'Cash App Name: 325, Account Name: 262, Account Number: 23623', NULL, 1, '2020-10-08 13:11:00', '2020-10-08 13:11:09'),
(38, 10, 1, 'BFGCFOXEXEZ0SB47KGST', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-10-08 13:13:53', '2020-10-08 13:13:53'),
(39, 10, 1, 'VQXSPHFKCV3EVFGQQ1MH', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-10-08 13:13:59', '2020-10-08 13:13:59'),
(40, 10, 1, 'IJOQIT6ZYNWMKYITRSOF', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-10-08 13:14:04', '2020-10-08 13:14:04'),
(41, 10, 1, 'OMLTHJY3NMU8QTS0BIYD', NULL, NULL, '123', '26.35', '149.35', NULL, NULL, 0, '2020-10-08 13:14:16', '2020-10-08 13:14:16'),
(42, 10, 1, 'SFSW8OHHKBVY6XQFNVOA', NULL, NULL, '123', '26.35', '149.35', 'qsdsdcsdvsfv', NULL, 1, '2020-10-08 13:16:52', '2020-10-08 13:17:01'),
(43, 10, 2, 'FAF0O37QFESE2KYA4RRJ', NULL, NULL, '12', '25.13', '37.129999999999995', 'dfsfsd', NULL, 1, '2020-10-08 13:26:04', '2020-10-08 13:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_min` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `withdraw_max` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '10',
  `fix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `withdraw_min`, `withdraw_max`, `fix`, `percent`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cryptocurrency', '10', '2000000000', '25', '1.10', '3', 1, '2017-07-28 09:10:00', '2018-09-19 13:43:17'),
(2, 'Paypal', '10', '2000000000', '25', '1.10', '3', 0, '2017-07-28 09:10:00', '2018-09-19 13:43:17'),
(3, 'Bank Transfer', '10', '2000000000', '2', '1.8', '1', 1, '2017-08-09 15:06:21', '2018-09-19 13:42:36'),
(4, 'Cash App', '10', '200000000000', '2', '1.8', '1', 0, '2017-08-09 15:06:21', '2018-09-19 13:42:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cryptowallets`
--
ALTER TABLE `cryptowallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etemplates`
--
ALTER TABLE `etemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internets`
--
ALTER TABLE `internets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invests`
--
ALTER TABLE `invests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investyields`
--
ALTER TABLE `investyields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localbanks`
--
ALTER TABLE `localbanks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `powers`
--
ALTER TABLE `powers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smss`
--
ALTER TABLE `smss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_settings`
--
ALTER TABLE `time_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trxes`
--
ALTER TABLE `trxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallets`
--
ALTER TABLE `user_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifieds`
--
ALTER TABLE `verifieds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `basic_settings`
--
ALTER TABLE `basic_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cryptowallets`
--
ALTER TABLE `cryptowallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `etemplates`
--
ALTER TABLE `etemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- AUTO_INCREMENT for table `internets`
--
ALTER TABLE `internets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `invests`
--
ALTER TABLE `invests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `investyields`
--
ALTER TABLE `investyields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `localbanks`
--
ALTER TABLE `localbanks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `powers`
--
ALTER TABLE `powers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `smss`
--
ALTER TABLE `smss`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time_settings`
--
ALTER TABLE `time_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trxes`
--
ALTER TABLE `trxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=653;

--
-- AUTO_INCREMENT for table `user_wallets`
--
ALTER TABLE `user_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `verifieds`
--
ALTER TABLE `verifieds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
