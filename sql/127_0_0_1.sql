-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2024 at 12:33 PM
-- Server version: 8.2.0
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_panel`
--
CREATE DATABASE IF NOT EXISTS `admin_panel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `admin_panel`;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Database: `eshop_fr`
--
CREATE DATABASE IF NOT EXISTS `eshop_fr` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `eshop_fr`;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'fa-solid fa-tags',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `icon`) VALUES
(1, 'Téléphones', 'fa-solid fa-mobile-screen-button'),
(2, 'Ordinateurs', 'fa-solid fa-laptop'),
(3, 'Montres connectées', 'fa-solid fa-clock'),
(18, 'Claviers', 'fa-solid fa-tags');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `product_id`, `quantity`, `order_date`, `order_state`) VALUES
(182, 111, 49, 1, '2024-04-22 11:04:13', 'in_cart'),
(181, 141, 58, 1, '2024-04-22 10:49:42', 'paid'),
(175, 141, 46, 1, '2024-04-22 10:42:20', 'paid'),
(180, 141, 56, 1, '2024-04-22 10:49:42', 'paid'),
(172, 133, 49, 1, '2024-04-22 00:33:51', 'paid'),
(161, 133, 48, 1, '2024-04-21 23:48:27', 'paid'),
(168, 111, 49, 1, '2024-04-21 23:57:09', 'in_cart'),
(159, 133, 47, 1, '2024-04-21 23:48:26', 'paid'),
(171, 133, 46, 1, '2024-04-22 00:24:27', 'paid'),
(170, 133, 49, 2, '2024-04-22 00:24:27', 'paid'),
(74, 15, 51, 2, '2024-04-21 12:19:21', 'paid'),
(73, 15, 54, 1, '2024-04-21 12:19:17', 'paid'),
(173, 133, 50, 1, '2024-04-22 00:34:18', 'paid'),
(169, 15, 54, 1, '2024-04-22 00:06:51', 'paid'),
(165, 133, 49, 1, '2024-04-21 23:51:04', 'paid'),
(167, 111, 56, 1, '2024-04-21 23:56:56', 'paid'),
(152, 15, 47, 1, '2024-04-21 23:15:46', 'paid'),
(154, 15, 54, 1, '2024-04-21 23:25:16', 'paid'),
(155, 15, 55, 2, '2024-04-21 23:25:17', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `metier`
--

DROP TABLE IF EXISTS `metier`;
CREATE TABLE IF NOT EXISTS `metier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metier`
--

INSERT INTO `metier` (`id`, `libelle`) VALUES
(1, 'Étudiant(e)'),
(2, 'Enseignant(e)'),
(3, 'Ingénieur(e)'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `mode_paiement` enum('card','paypal') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `payment_date`, `montant`, `mode_paiement`) VALUES
(1, 15, '2024-04-10 02:32:57', 4039.94, 'card'),
(2, 15, '2024-04-09 02:35:29', 2179.98, 'paypal'),
(3, 15, '2024-04-20 04:24:17', 4699.95, 'paypal'),
(4, 15, '2024-04-20 04:24:24', 2179.98, 'paypal'),
(5, 15, '2024-04-20 04:24:36', 1861.97, 'card'),
(6, 15, '2024-04-20 04:27:58', 235.98, 'card'),
(7, 15, '2024-04-20 04:32:11', 439.98, 'card'),
(8, 15, '2024-04-20 13:53:16', 3781.95, 'paypal'),
(9, 15, '2024-04-20 14:01:44', 1219.98, 'card'),
(10, 15, '2024-04-21 02:16:03', 12531.87, 'card'),
(11, 15, '2024-04-21 02:59:59', 7089.95, 'card'),
(12, 15, '2024-04-21 03:21:17', 1209.98, 'card'),
(13, 15, '2024-04-21 03:22:14', 2409.97, 'card'),
(14, 15, '2024-04-21 03:23:15', 1431.98, 'card'),
(15, 15, '2024-04-21 03:25:16', 1329.98, 'card'),
(16, 15, '2024-04-21 03:32:01', 2169.98, 'card'),
(17, 15, '2024-04-21 03:32:32', 1311.98, 'card'),
(18, 15, '2024-04-21 03:33:58', 429.98, 'card'),
(19, 15, '2024-04-21 12:08:14', 1431.98, 'paypal'),
(20, 15, '2024-04-21 12:19:35', 11547.89, 'paypal'),
(21, 15, '2024-04-21 15:52:26', 2091.97, 'paypal'),
(22, 15, '2024-04-21 23:24:57', 0.00, 'card'),
(23, 133, '2024-04-21 23:50:56', 0.00, 'card'),
(24, 133, '2024-04-21 23:51:09', 0.00, 'paypal'),
(25, 15, '2024-04-21 23:55:00', 0.00, 'paypal'),
(26, 111, '2024-04-21 23:56:59', 0.00, 'card'),
(27, 15, '2024-04-22 00:06:56', 0.00, 'card'),
(28, 133, '2024-04-22 00:31:57', 3829.58, 'card'),
(29, 133, '2024-04-22 00:34:25', 2468.78, 'card'),
(30, 141, '2024-04-22 10:43:08', 5028.38, 'card'),
(31, 141, '2024-04-22 10:43:42', 1208.79, 'paypal'),
(32, 141, '2024-04-22 10:49:49', 669.97, 'card');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `prix` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `categorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `reference`, `description`, `prix`, `stock`, `categorie_id`) VALUES
(46, 'T01_I15P', 'iPhone 15 Pro Max', 1184.99, 5, 1),
(47, 'T02_SGS24', 'Samsung Galaxy S24 Ultra', 1084.99, 8, 1),
(48, 'T03_X13T', 'Xiaomi 13T', 649.99, 6, 1),
(49, 'T04_HP60P', 'Huawei P60 Pro', 999.00, 0, 1),
(50, 'T05_SGZF4', 'Samsung Galaxy Z Flip 5', 1049.99, 1, 1),
(51, 'O01_MBP16', 'MacBook Pro 16', 2399.99, 1, 2),
(52, 'O02_MBA13', 'MacBook Air 13', 1799.99, 3, 2),
(53, 'O03_SURFPRO8', 'Microsoft Surface Pro 8', 1299.99, 7, 2),
(54, 'O04_DELLXPS', 'Dell XPS 15', 1799.99, 0, 2),
(55, 'O05_HPOMEN', 'HP Omen 15', 1099.99, 2, 2),
(56, 'M01_APSE6', 'Apple Watch SE 6', 349.99, 11, 3),
(57, 'M02_SWGA2', 'Samsung Galaxy Active 2', 100.99, 3, 3),
(58, 'M03_FITV4', 'Fitbit Versa 4', 199.99, 5, 3),
(59, 'M04_GARMINVIVO', 'Garmin Vivoactive 4', 249.99, 5, 3),
(60, 'M05_HUAWEIGT', 'Huawei GT 2', 179.99, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `metier_id` int DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `metier_id` (`metier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mdp`, `genre`, `date_naissance`, `metier_id`, `verification_token`, `role`, `verification_date`) VALUES
(111, 'Koné', 'Mohamed Lamine', 'mohamed@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2003-01-01', 1, 'random_token_1', 'user', '2024-04-18 00:00:00'),
(15, 'EL MAHDAOUI', 'Abdellatif', 'abdellatif.elmahdaoui@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2000-01-27', 1, '1f0db68602f8f9160c92283c481b3ad9', 'user', '2023-04-18 00:00:00'),
(110, 'Collins', 'Christina', 'christina.collins@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1988-09-18', 2, 'random_token_42', 'user', NULL),
(12, 'EL-MAHDAOUI', 'Abdellatif', 'elmahdaoui@cy-tech.fr', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2000-01-27', 1, '66888029d19326af141aa2dd8172ea91', 'admin', '2024-04-10 00:00:00'),
(109, 'Russell', 'Matthew', 'matthew.russell@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1983-04-23', 1, 'random_token_41', 'user', '2024-05-28 00:00:00'),
(108, 'Evans', 'Vanessa', 'vanessa.evans@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1991-11-27', 4, 'random_token_40', 'user', '2024-06-15 00:00:00'),
(107, 'Phillips', 'William', 'william.phillips@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1986-07-02', 3, 'random_token_39', 'user', '2024-04-16 00:00:00'),
(106, 'Turner', 'Alyssa', 'alyssa.turner@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1990-02-05', 2, 'random_token_38', 'user', '2024-04-16 00:00:00'),
(105, 'Roberts', 'Robert', 'robert.roberts@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1981-09-10', 1, 'random_token_37', 'user', '2024-04-17 00:00:00'),
(104, 'Carter', 'Alexandra', 'alexandra.carter@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1992-04-15', 4, 'random_token_36', 'user', '2024-04-10 00:00:00'),
(103, 'Mitchell', 'Daniel', 'daniel.mitchell@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1987-11-20', 3, 'random_token_35', 'user', '2024-06-14 00:00:00'),
(102, 'Campbell', 'Katherine', 'katherine.campbell@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1989-06-25', 1, 'random_token_34', 'user', '2024-04-30 00:00:00'),
(101, 'Ramirez', 'Jonathan', 'jonathan.ramirez@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1983-01-30', 1, 'random_token_33', 'user', '2024-05-19 00:00:00'),
(100, 'Hill', 'Hannah', 'hannah.hill@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1994-08-05', 4, 'random_token_32', 'user', '2024-06-01 00:00:00'),
(99, 'Nelson', 'Nathan', 'nathan.nelson@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1985-03-10', 3, 'random_token_31', 'user', '2024-05-27 00:00:00'),
(98, 'Baker', 'Courtney', 'courtney.baker@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1990-12-13', 1, 'random_token_30', 'user', '2024-04-28 00:00:00'),
(97, 'Adams', 'Patrick', 'patrick.adams@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1981-07-18', 1, 'random_token_29', 'user', '2024-05-31 00:00:00'),
(96, 'Green', 'Brittany', 'brittany.green@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1992-02-21', 4, 'random_token_28', 'user', '2024-05-16 00:00:00'),
(95, 'Scott', 'Joshua', 'joshua.scott@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1983-09-26', 1, 'random_token_27', 'user', '2024-05-08 00:00:00'),
(94, 'King', 'Kayla', 'kayla.king@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1988-05-01', 2, 'random_token_26', 'user', '2024-04-10 00:00:00'),
(93, 'Hall', 'Jacob', 'jacob.hall@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1984-06-25', 1, 'random_token_25', 'user', '2024-04-10 00:00:00'),
(92, 'Perez', 'Tiffany', 'tiffany.perez@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1991-02-28', 4, 'random_token_24', 'user', '2024-05-08 00:00:00'),
(91, 'Walker', 'Brandon', 'brandon.walker@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1986-11-05', 1, 'random_token_23', 'user', '2024-04-17 00:00:00'),
(90, 'Robinson', 'Stephanie', 'stephanie.robinson@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1989-07-10', 2, 'random_token_22', 'user', '2024-04-18 00:00:00'),
(89, 'Lewis', 'Nicholas', 'nicholas.lewis@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1983-02-15', 1, 'random_token_21', 'user', '2024-04-16 00:00:00'),
(88, 'Clark', 'Lauren', 'lauren.clark@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1994-10-22', 4, 'random_token_20', 'user', '2024-06-15 00:00:00'),
(87, 'Harris', 'Jonathan', 'jonathan.harris@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1988-06-27', 3, 'random_token_19', 'user', '2024-05-12 00:00:00'),
(86, 'Gonzalez', 'Rachel', 'rachel.gonzalez@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1992-03-02', 2, 'random_token_18', 'user', '2024-04-21 00:00:00'),
(85, 'Lee', 'Brian', 'brian.lee@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1987-12-07', 1, 'random_token_17', 'user', '2024-06-09 00:00:00'),
(84, 'Young', 'Erica', 'erica.young@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1993-11-20', 4, 'random_token_16', 'user', '2024-04-23 00:00:00'),
(83, 'Hernandez', 'Matthew', 'matthew.hernandez@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1981-03-24', 3, 'random_token_15', 'user', '2024-05-01 00:00:00'),
(82, 'Thomas', 'Melissa', 'melissa.thomas@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1994-09-09', 2, 'random_token_14', 'user', '2024-06-07 00:00:00'),
(81, 'Taylor', 'Ryan', 'ryan.taylor@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1982-06-28', 1, 'random_token_13', 'user', '2024-06-09 00:00:00'),
(80, 'Wilson', 'Sarah', 'sarah.wilson@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1991-12-13', 4, 'random_token_12', 'user', '2024-05-20 00:00:00'),
(79, 'Rodriguez', 'James', 'james.rodriguez@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1984-02-02', 3, 'random_token_11', 'user', '2024-04-30 00:00:00'),
(78, 'Davis', 'Amanda', 'amanda.davis@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1986-08-22', 2, 'random_token_10', 'user', '2024-05-20 00:00:00'),
(77, 'Martinez', 'Christopher', 'christopher.martinez@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1993-01-07', 1, 'random_token_9', 'user', '2024-05-01 00:00:00'),
(76, 'Miller', 'Jessica', 'jessica.miller@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1989-10-18', 4, 'random_token_8', 'user', '2024-06-09 00:00:00'),
(75, 'Garcia', 'Daniel', 'daniel.garcia@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1987-04-12', 3, 'random_token_7', 'user', '2024-05-05 00:00:00'),
(74, 'Jones', 'Jennifer', 'jennifer.jones@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1995-07-05', 2, 'random_token_6', 'user', '2024-06-08 00:00:00'),
(73, 'Brown', 'David', 'david.brown@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1983-03-30', 1, 'random_token_5', 'user', '2024-04-16 00:00:00'),
(72, 'Williams', 'Emily', 'emily.williams@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1992-11-25', 4, 'random_token_4', 'user', '2024-05-28 00:00:00'),
(71, 'Johnson', 'Michael', 'michael.johnson@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1985-06-10', 3, 'random_token_3', 'user', '2024-05-19 00:00:00'),
(70, 'Smith', 'Alice', 'alice.smith@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1988-09-20', 2, 'random_token_2', 'user', '2024-04-29 00:00:00'),
(69, 'Doe', 'John', 'john.doe@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1990-05-15', 1, 'random_token_1', 'user', '2024-04-27 00:00:00'),
(112, 'Smith', 'Alice', 'alice.smith1@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1988-09-20', 2, 'random_token_2', 'user', '2024-04-19 00:00:00'),
(113, 'Johnson', 'Michael', 'michael.johnson1@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1985-06-10', 3, 'random_token_3', 'user', '2024-04-10 00:00:00'),
(114, 'Williams', 'Emily', 'emily.williams1@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '1992-11-25', 4, 'random_token_4', 'user', '2024-04-09 00:00:00'),
(115, 'Brown', 'David', 'david.brown1@example.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1983-03-30', 1, 'random_token_5', 'user', '2024-04-22 00:00:00'),
(116, 'awgarstone', 'heavy', '3770heavy@awgarstone.com', '81dc9bdb52d04dc20036dbd8313ed055', 'F', '2003-02-04', 2, 'c0061a24dcb7c9614b669446205d5556', 'user', '2024-04-20 23:36:50'),
(135, 'blankawga', 'blankawnecom', '1705flying@awgarstone.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2001-06-08', 2, 'ccce1b7afe865f7abe9b5fd0e4261369', 'user', NULL),
(133, 'Barakat', 'Khaled', '3502thundering@awgarstone.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2008-03-05', 1, 'e5c2e805e4359093f71cb07f46117e12', 'user', '2024-04-21 23:47:06'),
(134, 'blankawga', 'blankawnecom', 'blank531@awgarstone.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2001-06-08', 2, '104d86e389fcdc07ebd127ed4cc42f88', 'user', NULL),
(139, 'Zhang', 'Clement', 'notableveradis@fthcapital.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2003-01-06', 1, '1227ee0194739bf243f8a0294daaaf86', 'user', NULL),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
