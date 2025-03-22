-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2025 at 11:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_ames`
--

-- --------------------------------------------------------

--
-- Table structure for table `ames`
--

CREATE TABLE `ames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` enum('Masculin','Féminin') NOT NULL,
  `age` INTEGER NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `date_premier_contact` date DEFAULT NULL,
  `priere_du_salut` tinyint(1) NOT NULL DEFAULT 0,
  `invitation_temple` tinyint(1) NOT NULL DEFAULT 0,
  `invitation_fi` tinyint(1) NOT NULL DEFAULT 0,
  `famille_impact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ;

--
-- Dumping data for table `ames`
--

INSERT INTO `ames` (`id`, `nom`, `prenom`, `sexe`, `age`, `adresse`, `telephone`, `date_premier_contact`, `priere_du_salut`, `invitation_temple`, `invitation_fi`, `famille_impact_id`, `created_at`, `updated_at`, `user_id`) VALUES
(15, 'FOUMBOULA', 'Jeff', 'Masculin', 26, 'Pediatrie', '074121212', '2025-02-15', 1, 1, 0, NULL, '2025-03-14 21:30:44', '2025-03-14 21:32:01', 1),
(16, 'MBA', 'Germaine', 'Féminin', 24, 'Carefour SNI', '063242526', '2025-02-15', 1, 1, 0, NULL, '2025-03-14 21:31:44', '2025-03-14 21:31:44', 1),
(17, 'MAKOSSO', 'Yves', 'Masculin', 24, 'Derriere la pédiatrie', '062343536', '2025-02-01', 1, 0, 0, NULL, '2025-03-16 16:21:39', '2025-03-16 16:21:39', 3),
(18, 'OUSMANE', 'Tierno', 'Masculin', 23, 'Charbonnage vers la boulangerie', '06734283', '2025-02-01', 1, 1, 0, NULL, '2025-03-16 16:23:03', '2025-03-16 16:23:03', 3),
(19, 'MBA MBA', 'Brigitte', 'Féminin', 32, 'Lalala à Droite', '07534236', '2025-02-08', 1, 1, 0, NULL, '2025-03-16 16:24:16', '2025-03-16 16:24:16', 3),
(20, 'BONGOTTA', 'Armel', 'Masculin', 42, 'Cité Damas', '065543234', '2025-02-22', 1, 1, 1, 4, '2025-03-16 16:59:10', '2025-03-16 18:02:09', 8),
(21, 'AKERET', 'Wendy', 'Féminin', 36, 'Charbonnage', '056543423', '2025-03-02', 1, 1, 0, 6, '2025-03-16 17:00:33', '2025-03-16 17:00:33', 8);

-- --------------------------------------------------------

--
-- Table structure for table `entretiens`
--

CREATE TABLE `entretiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ame_id` bigint(20) UNSIGNED NOT NULL,
  `numero_entretien` INTEGER NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_entretien` date NOT NULL,
  `defis` text DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `evaluation` enum('faible','moyen','engagé','très engagé') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `entretiens`
--

INSERT INTO `entretiens` (`id`, `ame_id`, `numero_entretien`, `user_id`, `date_entretien`, `defis`, `resume`, `evaluation`, `created_at`, `updated_at`) VALUES
(16, 16, 1, 1, '2025-03-09', 'Pas de Bible', '- Procurer une bible\r\n- L\'Affecter à la Famille Impact du PK8', 'moyen', '2025-03-14 22:20:34', '2025-03-14 22:20:34'),
(17, 18, 1, 3, '2025-02-23', 'Problème de transport', '- La Famille Impact X doit contribué à son affermissement', 'moyen', '2025-03-16 16:56:18', '2025-03-16 16:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--


-- --------------------------------------------------------

--
-- Table structure for table `famille_impacts`
--



--
-- Dumping data for table `famille_impacts`
--

INSERT INTO `famille_impacts` (`id`, `nom`, `pilote1_nom`, `pilote1_tel`, `pilote2_nom`, `pilote2_tel`, `created_at`, `updated_at`) VALUES
(1, 'Famille Impact Gros Bouquet', 'Xavier Andy2', '045545456', 'maman Alloguo Genevier', '65465465', '2025-03-08 10:59:35', '2025-03-08 16:07:58'),
(4, 'Famille Impact Nombakele', 'Ancien Gilbert', '07474747', 'Ep. Gilbert', '0652123487', '2025-03-08 12:10:04', '2025-03-08 16:08:16'),
(5, 'Famille Impact IAI', 'Pr. Kombila', '457869631', 'Ep. Kombila', '12145748578', '2025-03-08 16:16:06', '2025-03-08 16:16:06'),
(6, 'Famille I Charbonnage', 'Diacre John', '8779879887', 'Ep. John', '8979878779', '2025-03-10 12:19:19', '2025-03-10 12:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` INTEGER NOT NULL
);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2014_10_12_100000_create_password_resets_table', 1),
(26, '2019_08_19_000000_create_failed_jobs_table', 1),
(27, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
)  ;

-- --------------------------------------------------------

--
-- Table structure for table `suivis`
--

CREATE TABLE `suivis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ame_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_appel` date NOT NULL,
  `defis` text DEFAULT NULL,
  `venu_eglise` tinyint(1) NOT NULL DEFAULT 0,
  `date_venu_eglise` date DEFAULT NULL,
  `formation_initiale` tinyint(1) NOT NULL DEFAULT 0,
  `date_debut_formation` date DEFAULT NULL,
  `etat_formation` enum('début','en cours','terminé') DEFAULT NULL,
  `assiste_famille_impact` tinyint(1) NOT NULL DEFAULT 0,
  `date_famille_impact` date DEFAULT NULL,
  `niveau_engagement` enum('faible','moyen','engagé','très engagé') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `suivis`
--

INSERT INTO `suivis` (`id`, `ame_id`, `user_id`, `date_appel`, `defis`, `venu_eglise`, `date_venu_eglise`, `formation_initiale`, `date_debut_formation`, `etat_formation`, `assiste_famille_impact`, `date_famille_impact`, `niveau_engagement`, `created_at`, `updated_at`) VALUES
(12, 16, 1, '2025-02-18', 'RAS', 1, '2025-03-16', 0, NULL, NULL, 0, NULL, 'moyen', '2025-03-14 21:33:54', '2025-03-14 21:33:54'),
(13, 15, 1, '2025-02-19', 'RAS', 0, NULL, 0, NULL, NULL, 1, NULL, 'faible', '2025-03-14 21:35:06', '2025-03-14 21:35:06'),
(14, 16, 1, '2025-02-20', 'RAS', 1, '2025-02-23', 0, NULL, NULL, 1, NULL, 'moyen', '2025-03-14 21:53:18', '2025-03-14 21:53:18'),
(15, 15, 1, '2025-02-25', 'Enfin venu à l\'église', 1, '2025-03-02', 0, NULL, NULL, 1, NULL, 'faible', '2025-03-14 21:54:56', '2025-03-14 21:54:56'),
(16, 16, 1, '2025-03-05', 'RAS', 1, '2025-03-09', 0, NULL, NULL, 1, NULL, 'faible', '2025-03-14 22:07:55', '2025-03-14 22:07:55'),
(17, 15, 1, '2025-03-07', NULL, 1, '2025-03-15', 1, '2025-03-10', 'début', 0, NULL, 'moyen', '2025-03-14 22:11:40', '2025-03-14 22:11:40'),
(18, 19, 3, '2025-02-04', NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 'faible', '2025-03-16 16:51:30', '2025-03-16 16:51:30'),
(19, 19, 3, '2025-02-12', NULL, 1, '2025-02-16', 0, NULL, NULL, 0, NULL, 'faible', '2025-03-16 16:53:17', '2025-03-16 16:53:17'),
(20, 20, 8, '2025-02-25', 'Pas de téléphone en ce moment', 1, '2025-02-26', 0, NULL, NULL, 0, NULL, 'faible', '2025-03-16 17:02:28', '2025-03-16 17:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','admin_general','star') NOT NULL DEFAULT 'star',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'star1', 'star1@exemple.com', '2025-03-08 08:47:22', '$2y$10$PmIdshLgBIymS3hOZT3mpuTZZtFNSxF9wShoWW8V9DLn7Zr90zWzG', 'star', NULL, NULL, NULL),
(2, 'admin1', 'admin1@exemple.com', '2025-03-08 08:54:48', '$2y$10$PmIdshLgBIymS3hOZT3mpuTZZtFNSxF9wShoWW8V9DLn7Zr90zWzG', 'admin_general', 'gppAAbW6UgtJW1Ds4WFNmlGChLh4IeNxSZnMf7FazEbQq21sjQMaYUBNfNZP', NULL, NULL),
(3, 'star2', 'star2@exemple.com', NULL, '$2y$10$PmIdshLgBIymS3hOZT3mpuTZZtFNSxF9wShoWW8V9DLn7Zr90zWzG', 'star', NULL, NULL, NULL),
(4, 'superadmin', 'superadmin@exemple.com', NULL, '$2y$10$PmIdshLgBIymS3hOZT3mpuTZZtFNSxF9wShoWW8V9DLn7Zr90zWzG', 'super_admin', NULL, NULL, '2025-03-08 11:57:45'),
(8, 'star3', 'star3@exemple.com', NULL, '$2y$10$PmIdshLgBIymS3hOZT3mpuTZZtFNSxF9wShoWW8V9DLn7Zr90zWzG', 'star', NULL, '2025-03-10 12:18:36', '2025-03-10 12:18:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ames`
--


--
-- Indexes for table `entretiens`
--


--
-- Indexes for table `failed_jobs`
--


--
-- Indexes for table `famille_impacts`
--


--
-- Indexes for table `migrations`
--


--
-- Indexes for table `password_resets`
--


--
-- Indexes for table `password_reset_tokens`
--


--
-- Indexes for table `personal_access_tokens`
--


--
-- Indexes for table `suivis`
--


--
-- Indexes for table `users`
--


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ames`
--


--
-- AUTO_INCREMENT for table `entretiens`
--


--
-- AUTO_INCREMENT for table `failed_jobs`
--


--
-- AUTO_INCREMENT for table `famille_impacts`
--

--
-- AUTO_INCREMENT for table `migrations`
--


--
-- AUTO_INCREMENT for table `personal_access_tokens`
--


--
-- AUTO_INCREMENT for table `suivis`
--


--
-- AUTO_INCREMENT for table `users`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `ames`
--


--
-- Constraints for table `entretiens`
--


--
-- Constraints for table `suivis`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
