-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 15 mai 2020 à 15:30
-- Version du serveur :  8.0.20-0ubuntu0.19.10.1
-- Version de PHP : 7.3.11-0ubuntu0.19.10.4

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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` int DEFAULT NULL,
  `meeting_type` enum('Chantier','Etude') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `affair`
--

INSERT INTO `affair` (`id_affair`, `name`, `address`, `progress`, `meeting_type`, `description`) VALUES
(1, 'Affaire de test 2', 'Castera Lectourois', NULL, 'Chantier', 'Ceci est la description de l\'affaire'),
(2, 'Affaire de test 2', 'Castera Lectourois 2', 75, 'Chantier', 'Ceci est la description de l\'affaire'),
(3, 'Affaire etude test 2', 'La bas der 2', 25, 'Etude', 'Ceci est la description de l\'affaire'),
(4, 'Affaire de test 2', 'Castera Lectourois 2', 30, 'Chantier', 'Ceci est la description de l\'affaire'),
(5, 'Affaire de test 2', 'Castera Lectourois 2', 30, 'Chantier', 'Ceci est la description de l\'affaire'),
(6, 'Affaire de test 2', 'Castera Lectourois 2', 30, 'Chantier', 'Ceci est la description de l\'affaire'),
(7, 'Affaire de test 2', 'Castera Lectourois khgbfr', 30, 'Chantier', 'Ceci est la description de l\'affaire'),
(8, 'Affaire de test 2', 'Castera Lectourois khgbfr', 30, 'Etude', 'Ceci est la description de l\'affaire'),
(9, 'Affaire de test 2', 'Castera Lectourois', 70, 'Etude', 'Ceci est la description de l\'affaire');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id_item` int NOT NULL,
  `position` int NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `follow_up` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ressources` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `visible` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `position`, `note`, `follow_up`, `ressources`, `completion`, `completion_date`, `visible`, `created_at`) VALUES
(1, 1, 'note 4', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(2, 1, 'note 4', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(3, 2, 'note grtzt', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(4, 2, 'note grtzt', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(5, 2, 'note grtzt', 'suivi', 'ressource', 'Test', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(6, 3, 'note grtzt', 'suivi', 'ressource', 'Urgent', '2020-02-11 23:00:00', 0, '2020-02-06 13:00:00'),
(7, 4, 'test', '', NULL, NULL, '2020-05-06 22:00:00', 1, '2020-05-06 09:06:40');

-- --------------------------------------------------------

--
-- Structure de la table `item_has_lot`
--

CREATE TABLE `item_has_lot` (
  `item_id` int NOT NULL,
  `lot_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item_has_lot`
--

INSERT INTO `item_has_lot` (`item_id`, `lot_id`) VALUES
(5, 7),
(6, 7),
(5, 8),
(6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `id_lot` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `affair_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`id_lot`, `name`, `affair_id`) VALUES
(7, 'lot 1 ', 2),
(8, 'lot 2', 2),
(9, 'lot 3', 2),
(12, 'Test', 2),
(13, 'hello', 2),
(21, 'test 3', 3),
(23, 'test', 3),
(24, 'y_egiushbdfipu', 3);

-- --------------------------------------------------------

--
-- Structure de la table `pv`
--

CREATE TABLE `pv` (
  `id_pv` int NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meeting_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_next_date` timestamp NULL DEFAULT NULL,
  `meeting_next_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` timestamp NULL DEFAULT NULL,
  `affair_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv`
--

INSERT INTO `pv` (`id_pv`, `state`, `meeting_place`, `meeting_next_date`, `meeting_next_place`, `release_date`, `affair_id`) VALUES
(1, 'En cours', 'Indéfini', NULL, NULL, '2020-05-08 07:45:26', 1),
(2, 'En cours', 'Sur place ou là', NULL, 'en mairie', '2020-05-08 15:11:06', 2),
(3, 'Terminé', 'ici et la', NULL, '', NULL, 3),
(4, 'En cours', 'France entière', NULL, '', NULL, 2),
(5, 'En cours', 'icioupeutetrela bas', NULL, 'coucou', NULL, 2),
(6, 'En cours', 'erfrtgtr', NULL, '', NULL, 2),
(7, 'En cours', 'test 2', NULL, '', NULL, 2),
(8, 'Terminé', 'test 3', NULL, '', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_item`
--

CREATE TABLE `pv_has_item` (
  `pv_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv_has_item`
--

INSERT INTO `pv_has_item` (`pv_id`, `item_id`) VALUES
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_user`
--

CREATE TABLE `pv_has_user` (
  `pv_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status_PAE` enum('Présent','Absent','Excusé') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invited_current_meeting` tinyint(1) DEFAULT NULL,
  `invited_next_meeting` tinyint(1) DEFAULT NULL,
  `distribution` tinyint(1) DEFAULT NULL,
  `owner` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv_has_user`
--

INSERT INTO `pv_has_user` (`pv_id`, `user_id`, `status_PAE`, `invited_current_meeting`, `invited_next_meeting`, `distribution`, `owner`) VALUES
(2, 2, 'Présent', NULL, NULL, NULL, 1),
(2, 13, 'Présent', NULL, NULL, NULL, 0),
(2, 14, 'Absent', NULL, NULL, NULL, 0),
(2, 15, 'Excusé', NULL, NULL, NULL, 0),
(2, 16, 'Absent', NULL, NULL, NULL, 0),
(3, 2, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `token` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_function` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organism` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `first_name`, `last_name`, `phone`, `user_group`, `user_function`, `organism`) VALUES
(2, 'baud@baud.fr', '$2y$10$IhujVYBhMSs.R5tM6P9eruh4IsBJquhgaf3SEDnjxPn4V.2YGHIMy', 'Baudouin', 'COUPEY', '0695847559', 'Maîtrise d\'oeuvre', 'test', 'SAS'),
(3, 'contact@agencecasals.fr', '81dc9bdb52d04dc20036dbd8313ed055', 'Samuel', 'COUPEY', '0695847559', 'Maitrise d\'ouvrage', 'Archi', 'Casals'),
(8, 'de@de.fr', 'Affaire de test 2', 'rfqef', 'gtqfrqe', '0123456897', 'ftreqgtr', 'fqzfre', 'gtqerf'),
(9, 'frtg@gtfr.Gtgt', 'Affaire de test 2', 'freqf', 'gtsrgt', '0123456789', 'fqrefre', 'gtsqrg', 'frqef'),
(10, 'FREG@de.fr', 'Affaire de test 2', 'Sam', 'Coupe', '0123456789', 'frea', 'freqarg', 'AETGR'),
(11, 'baudcou@gt.f', 'Affaire de test 2', 'Sam', 'coupcoup', '0123456789', 'UHudeF', 'FORIEA', 'OIJR'),
(12, 'gtyh@tgt.fr', 'Affaire de test 2', 'greg', 'treheythe', '0123456789', 'eytghrt', 'gyethyte', 'egtgzrth'),
(13, 'TRSG@GTG.FR', 'Affaire de test 2', 'Samr ', 'freag', '0123456799', 'Maîtrise d\'oeuvre', 'test', 'GTRZSH'),
(14, 'fr@fr.gt', 'Affaire de test 2', 'Ici', 'dreaqifj', '0124567893', 'Maîtrise d\'oeuvre', 'test', 'GOIRTHA'),
(15, 'buyfr@fr.gt', 'Affaire de test 2', 'Same', 'Coup', '0695847559', 'Maîtrise d\'ouvrage', 'test', 'Mairie'),
(16, 'baud@fr.Fr', 'Affaire de test 2', 'Jen', 'Michel', '0123456789', 'Idice', 'derftr', 'freag'),
(17, 'baudouin.coupey@protonmail.com', '$2y$10$7zehqlRxXWWxzFFtObzycul2YiW8cH1cRtd1VPRE.a39v2aS5kC.m', 'Baudouin', 'Coupey', '0695845759', '', '', '');

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
  ADD PRIMARY KEY (`item_id`,`lot_id`),
  ADD KEY `fk_item_has_lot_lot1_idx` (`lot_id`),
  ADD KEY `fk_item_has_lot_item1_idx` (`item_id`);

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
  MODIFY `id_affair` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
  MODIFY `id_lot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `pv`
--
ALTER TABLE `pv`
  MODIFY `id_pv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item_has_lot`
--
ALTER TABLE `item_has_lot`
  ADD CONSTRAINT `fk_item_has_lot_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `fk_item_has_lot_lot1` FOREIGN KEY (`lot_id`) REFERENCES `lot` (`id_lot`);

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
  ADD CONSTRAINT `fk_pv_has_user_pv1_idx` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_pv_has_user_user1_idx` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user1` FOREIGN KEY (`user_id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
