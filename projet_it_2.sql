-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 mars 2025 à 19:49
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_it_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `email_confirmations`
--

CREATE TABLE `email_confirmations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `confirmation_code` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `reset_token`, `expires_at`, `created_at`) VALUES
(1, 'gainspropre2@gmail.com', 'd5e8c8443ddbc415e801222191d05c28', '2025-01-27 14:24:58', '2025-01-27 12:24:58');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `date_naissance`, `contact`, `email`, `password_hash`, `email_verified`, `created_at`) VALUES
(10, 'NDJAVE', 'David Jacques', '2001-04-30', '065303986', 'dndjave@gmail.com', '$2y$10$WpwOp9nFjdW.i/fSO6xfWOIChrjfaeY2bFKCWvJEruxz0cPU183cG', 1, '2025-01-23 07:40:50'),
(14, 'wild', 'prince', '2024-12-29', '77131577', 'gainspropre2@gmail.com', '$2y$10$imz5MkTYtsJK/ylsHKy6z.4FKzNupwiN876ekbvowkre1FFDPAiuO', 1, '2025-01-23 09:04:27'),
(15, 'michel', 'alec', '2001-01-06', '074504118', 'aleceam3@gmail.com', '$2y$10$FfqQVDjDFKnGhIzgiJbBUOLfdt/2pbkaddcX4ErUaUQw7hOZ1SEzC', 1, '2025-01-23 20:35:20'),
(20, 'tototo', 'fifif', '2025-01-03', '0142545521', 'obameondo33@gmail.com', '$2y$10$DbzXfOmPmhYS/Ugif60d.uva29cdoBop6z/VOM9UHfS4pqZbjWzRy', 1, '2025-01-24 08:33:40'),
(21, 'Moussa', 'toto', '4223-04-05', '545454', 'juralde15@gmail.com', NULL, 1, '2025-01-24 10:35:35');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `email_confirmations`
--
ALTER TABLE `email_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `email_confirmations`
--
ALTER TABLE `email_confirmations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `email_confirmations`
--
ALTER TABLE `email_confirmations`
  ADD CONSTRAINT `email_confirmations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
