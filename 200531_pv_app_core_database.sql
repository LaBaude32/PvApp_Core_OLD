-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 31 mai 2020 à 16:52
-- Version du serveur :  8.0.20-0ubuntu0.19.10.1
-- Version de PHP : 7.3.11-0ubuntu0.19.10.6

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
(13, 'Maison individuelle', 'Higueres 32700 Catstera Lectourois', 85, 'Etude', 'Descriptions'),
(15, 'Réalisation d\'une piscine', 'Higueres 32700 Castera-Lectourois', 0, 'Chantier', '');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id_item` int NOT NULL,
  `position` int NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `follow_up` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ressources` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `visible` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `position`, `note`, `follow_up`, `ressources`, `completion`, `completion_date`, `visible`, `created_at`) VALUES
(18, 1, 'Un levé topographique est necessaire pour lancer la mission', 'demande de devis à faire (levé topo 3D + décpoupage en volume)', 'client', 'Urgent', '2020-05-24 22:00:00', 1, '2020-05-23 09:40:17'),
(19, 2, 'L\'AVP doit aller aussi loin que possible dans la démarche HQE', '', '', '', '2020-05-15 22:00:00', 1, '2020-05-23 09:41:00'),
(20, 3, 'Un étage au dessus de la cuisine est souhaité', 'Vérifier la faisabilité règlementaire au PLU', 'CASALS', 'Urgent', '2020-05-23 22:00:00', 1, '2020-05-23 09:42:13'),
(21, 4, 'dggsd', '', '', '', NULL, 1, '2020-05-23 10:13:50'),
(22, 4, 'Contacter la SAUR pour modification de branchement', '', 'CASALS', 'A faire', '2020-07-13 22:00:00', 1, '2020-05-23 10:17:12'),
(23, 1, '', 'Le contrat d\'honoraires est à renvoyer signé à CASALS', 'Client', 'Urgent', NULL, 0, '2020-05-24 19:24:45'),
(24, 2, 'L\'organigramme présenté ce jour est validé à exception de la position de la piscine', 'A modifier pour la prochaine réunion, en phase ESQ+', 'CASALS', 'A faire', '2020-05-30 22:00:00', 1, '2020-05-24 19:26:36'),
(25, 1, 'Le levé topo existe', 'A transmettre à l\'entreprise', 'CASALS', 'Urgent', '2020-05-25 22:00:00', 1, '2020-05-24 19:48:11'),
(26, 2, '', 'Transmettre le plan d\'EXE avec les notes de calcul ', 'entreprise DONIS', 'A faire', '2020-05-30 22:00:00', 1, '2020-05-24 19:50:18'),
(27, 5, 'test 2', 'de gthy', '', '', NULL, 1, '2020-05-24 20:41:05'),
(28, 1, 'test 1', '', '', '', NULL, 1, '2020-05-24 22:13:32'),
(29, 1, 'UNe note', 'Suite', '', 'A faire', '2020-05-12 22:00:00', 0, '2020-05-25 16:56:44'),
(30, 2, 'Une deuxieme note', '', '', '', NULL, 1, '2020-05-25 16:57:43'),
(31, 1, 'Etanchélité de la fontaine', 'Utiliser de la résine', 'BTP entreprise', 'Urgent', '2020-05-26 22:00:00', 1, '2020-05-26 10:19:07'),
(32, 1, 'Agrandire legerement la fosse pour la plomberie', 'Verifier avec l\'entreprise de plomberie', 'BTP', 'Urgent', NULL, 1, '2020-05-26 10:26:16'),
(33, 2, 'Préparation des végétaux', '', 'végétal SARL', 'A faire', NULL, 1, '2020-05-26 10:26:44'),
(34, 3, '', 'Transmettre les plans de plomberie à l\'entreprise de BTP', 'Plomberie René ', 'Urgent', NULL, 1, '2020-05-26 10:27:31'),
(35, 2, 'Peinture de la fontine', '', '', '', NULL, 1, '2020-05-26 11:31:27'),
(36, 4, 'Verfier la comptaibilité des plante avec l\'etanchelité', '', '', '', NULL, 1, '2020-05-26 11:32:38'),
(37, 3, 'Un item', 'suite', '', 'A faire', '2020-05-12 22:00:00', 1, '2020-05-26 12:53:51');

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
(26, 25),
(25, 26),
(32, 33),
(36, 34),
(33, 35),
(36, 35),
(34, 36);

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
(25, 'Piscine', 14),
(26, 'Terrassements', 14),
(27, 'Espaces Verts', 14),
(28, 'Maçonneries', 14),
(29, 'Etancheité', 14),
(33, 'Maçonnerie', 15),
(34, 'Etanchelité', 15),
(35, 'Vegetaux', 15),
(36, 'Plomberie', 15);

-- --------------------------------------------------------

--
-- Structure de la table `pv`
--

CREATE TABLE `pv` (
  `id_pv` int NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_date` timestamp NOT NULL,
  `meeting_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_next_date` timestamp NULL DEFAULT NULL,
  `meeting_next_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` timestamp NULL DEFAULT NULL,
  `affair_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv`
--

INSERT INTO `pv` (`id_pv`, `state`, `meeting_date`, `meeting_place`, `meeting_next_date`, `meeting_next_place`, `release_date`, `affair_id`, `created_at`) VALUES
(11, 'Terminé', '2020-05-24 20:59:17', 'sur site', '2020-05-25 12:00:00', 'sur site', '2020-05-24 22:09:26', 13, '2020-05-28 21:09:09'),
(12, 'Terminé', '2020-05-24 19:37:43', 'a l\'agence', NULL, 'sur site', '2020-05-24 22:11:04', 13, '2020-05-28 21:09:09'),
(17, 'En cours', '2020-05-26 10:00:00', 'En Mairie', '2020-05-20 11:10:00', 'Sur place', NULL, 13, '2020-05-28 21:09:09'),
(18, 'En cours', '2020-05-28 11:30:00', 'Sur place', '2020-05-27 12:15:00', 'Sur place', NULL, 13, '2020-05-28 21:09:09'),
(19, 'Terminé', '2020-05-26 10:24:09', 'Indéfini', NULL, '', '2020-05-26 12:54:56', 15, '2020-05-28 21:09:09'),
(22, 'En cours', '2020-05-28 20:00:00', 'Pv test owner 2', NULL, '', '2020-05-28 20:49:02', 13, '2020-05-28 21:09:09'),
(23, 'En cours', '2020-05-28 21:00:00', 'pv test pour number', NULL, '', NULL, 13, '2020-05-28 21:23:07');

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
(11, 18),
(11, 19),
(11, 20),
(11, 22),
(12, 24),
(11, 27),
(18, 31),
(19, 32),
(19, 33),
(19, 34),
(18, 35),
(19, 36);

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
  `owner` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv_has_user`
--

INSERT INTO `pv_has_user` (`pv_id`, `user_id`, `status_PAE`, `invited_current_meeting`, `invited_next_meeting`, `distribution`, `owner`) VALUES
(11, 2, 'Présent', NULL, NULL, NULL, 1),
(11, 19, 'Présent', NULL, NULL, NULL, 1),
(11, 21, 'Présent', NULL, NULL, NULL, 1),
(11, 22, 'Absent', NULL, NULL, NULL, 1),
(12, 20, 'Présent', NULL, NULL, NULL, 1),
(18, 24, 'Présent', NULL, NULL, NULL, 1),
(19, 2, 'Présent', NULL, NULL, NULL, 1),
(22, 2, 'Présent', NULL, NULL, NULL, 1),
(23, 2, 'Présent', NULL, NULL, NULL, 1);

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
(2, 'baud@baud.fr', '$2y$10$IhujVYBhMSs.R5tM6P9eruh4IsBJquhgaf3SEDnjxPn4V.2YGHIMy', 'Baudouin', 'COUPEY', '0695847559', 'Maîtrise d\'oeuvre', '', 'SAS'),
(3, 'contact@agencecasals.fr', '81dc9bdb52d04dc20036dbd8313ed055', 'Samuel', 'COUPEY', '0695847559', 'Maitrise d\'ouvrage', 'Archi', 'Casals'),
(17, 'baudouin.coupey@protonmail.com', '$2y$10$7zehqlRxXWWxzFFtObzycul2YiW8cH1cRtd1VPRE.a39v2aS5kC.m', 'Baudouin', 'Coupey', '0695845759', '', '', ''),
(18, 'contact@agencecasals.fr', '$2y$10$YvhBs54pKLsjmC6UGRm26OpayKLfxdYy.p8oHb1FHBOmMMrB2VV5S', 'Samuel', 'Coupey', '0684374215', 'MOE', '', 'CASALS'),
(20, 'gestion@agencecsals.fr', '$2y$10$IbOGOCE.hp2/VPSdiTp7.e83jwK65gG0XJObGG0DaHOG2.6HNJcXa', 'astrid', 'Coupey', '0562685929', 'MOE', '', ''),
(24, 'baudouin.coupey@casals.fr', '$2y$10$Sh0BCKkagNzn88hYcdJ.j.s6uSIMmZjyXO3CZ/V6pLmDq64B7w74y', 'Baudouin', 'Coupey', '0123456789', 'Maitre d\'ouvrage', '', 'Casals');

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
  MODIFY `id_affair` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
  MODIFY `id_lot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `pv`
--
ALTER TABLE `pv`
  MODIFY `id_pv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
