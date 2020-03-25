-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 25 mars 2020 à 15:24
-- Version du serveur :  8.0.19-0ubuntu0.19.10.3
-- Version de PHP : 7.3.11-0ubuntu0.19.10.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pv_app_core_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `affair`
--

CREATE TABLE `affair` (
  `id_affair` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` int DEFAULT NULL,
  `meeting_type` enum('Chantier','Etude') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id_item` int NOT NULL,
  `position` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `follow_up` text COLLATE utf8mb4_unicode_ci,
  `ressources` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `visible` tinyint NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item_has_lot`
--

CREATE TABLE `item_has_lot` (
  `item_id_item` int NOT NULL,
  `lot_id_lot` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `id_lot` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affair_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pv`
--

CREATE TABLE `pv` (
  `id_pv` int NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_date` timestamp NOT NULL,
  `meeting_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_next_date` timestamp NULL DEFAULT NULL,
  `meeting_next_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affair_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_item`
--

CREATE TABLE `pv_has_item` (
  `pv_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_user`
--

CREATE TABLE `pv_has_user` (
  `pv_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status_PAE` enum('Présent','Absent, Excusé') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invited_current_meeting` tinyint(1) DEFAULT NULL,
  `invited_next_meeting` tinyint(1) DEFAULT NULL,
  `distribution` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `token` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organism` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `first_name`, `last_name`, `phone`, `group`, `function`, `organism`) VALUES
(2, 'baud@baud.fr', '1234', 'Baudouin', 'COUPEY', '0695847559', 'Dev', 'Dev fullstack', 'SAS'),
(3, 'contact@agencecasals.fr', '1234', 'Samuel', 'COUPEY', '0695847559', 'Maitrise d\'ouvrage', 'Archi', 'Casals');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affair`
--
ALTER TABLE `affair`
  ADD PRIMARY KEY (`id_affair`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Index pour la table `item_has_lot`
--
ALTER TABLE `item_has_lot`
  ADD PRIMARY KEY (`item_id_item`,`lot_id_lot`),
  ADD KEY `fk_item_has_lot_lot1_idx` (`lot_id_lot`),
  ADD KEY `fk_item_has_lot_item1_idx` (`item_id_item`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`id_lot`),
  ADD KEY `fk_lot_affair1_idx` (`affair_id`);

--
-- Index pour la table `pv`
--
ALTER TABLE `pv`
  ADD PRIMARY KEY (`id_pv`),
  ADD KEY `fk_pv_affair1_idx` (`affair_id`);

--
-- Index pour la table `pv_has_item`
--
ALTER TABLE `pv_has_item`
  ADD PRIMARY KEY (`pv_id`,`item_id`),
  ADD KEY `fk_pv_has_item_item1_idx` (`item_id`),
  ADD KEY `fk_pv_has_item_pv1_idx` (`pv_id`);

--
-- Index pour la table `pv_has_user`
--
ALTER TABLE `pv_has_user`
  ADD PRIMARY KEY (`pv_id`,`user_id`),
  ADD KEY `fk_pv_has_user_user1_idx` (`user_id`),
  ADD KEY `fk_pv_has_user_pv1_idx` (`pv_id`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token`),
  ADD KEY `fk_token_user1_idx` (`user_id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affair`
--
ALTER TABLE `affair`
  MODIFY `id_affair` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
  MODIFY `id_lot` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pv`
--
ALTER TABLE `pv`
  MODIFY `id_pv` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item_has_lot`
--
ALTER TABLE `item_has_lot`
  ADD CONSTRAINT `fk_item_has_lot_item1` FOREIGN KEY (`item_id_item`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `fk_item_has_lot_lot1` FOREIGN KEY (`lot_id_lot`) REFERENCES `lot` (`id_lot`);

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `fk_lot_affair1` FOREIGN KEY (`affair_id`) REFERENCES `affair` (`id_affair`);

--
-- Contraintes pour la table `pv`
--
ALTER TABLE `pv`
  ADD CONSTRAINT `fk_pv_affair1` FOREIGN KEY (`affair_id`) REFERENCES `affair` (`id_affair`);

--
-- Contraintes pour la table `pv_has_item`
--
ALTER TABLE `pv_has_item`
  ADD CONSTRAINT `fk_pv_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `fk_pv_has_item_pv1` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`);

--
-- Contraintes pour la table `pv_has_user`
--
ALTER TABLE `pv_has_user`
  ADD CONSTRAINT `fk_pv_has_user_pv1` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`),
  ADD CONSTRAINT `fk_pv_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user1` FOREIGN KEY (`user_id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
