-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 avr. 2020 à 11:25
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pv_app_core_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `affair`
--

DROP TABLE IF EXISTS `affair`;
CREATE TABLE IF NOT EXISTS `affair` (
  `id_affair` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` int(11) DEFAULT NULL,
  `meeting_type` enum('Chantier','Etude') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_affair`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `affair`
--

INSERT INTO `affair` (`id_affair`, `name`, `address`, `progress`, `meeting_type`) VALUES
(1, 'Affaire de test 2', 'Castera Lectourois', NULL, 'Chantier'),
(2, 'Affaire de test 2', 'Castera Lectourois', NULL, 'Chantier'),
(3, 'Affaire etude test', 'La bas der', NULL, 'Etude');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `follow_up` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ressources` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `visible` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `position`, `note`, `follow_up`, `ressources`, `completion`, `completion_date`, `visible`, `created_at`) VALUES
(1, 1, 'note 4', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(2, 1, 'note 4', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(3, 2, 'note grtzt', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(4, 2, 'note grtzt', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(5, 2, 'note grtzt', 'suivi', 'ressource', 'Array', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00'),
(6, 2, 'note grtzt', 'suivi', 'ressource', 'A faire', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `item_has_lot`
--

DROP TABLE IF EXISTS `item_has_lot`;
CREATE TABLE IF NOT EXISTS `item_has_lot` (
  `item_id` int(11) NOT NULL,
  `lot_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`lot_id`),
  KEY `fk_item_has_lot_lot1_idx` (`lot_id`),
  KEY `fk_item_has_lot_item1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item_has_lot`
--

INSERT INTO `item_has_lot` (`item_id`, `lot_id`) VALUES
(5, 7),
(5, 8),
(6, 7),
(6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

DROP TABLE IF EXISTS `lot`;
CREATE TABLE IF NOT EXISTS `lot` (
  `id_lot` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affair_id` int(11) NOT NULL,
  PRIMARY KEY (`id_lot`),
  KEY `fk_lot_affair1_idx` (`affair_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`id_lot`, `name`, `affair_id`) VALUES
(7, 'lot 1 ', 2),
(8, 'lot 2', 2),
(9, 'lot 3', 2),
(12, 'Test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `pv`
--

DROP TABLE IF EXISTS `pv`;
CREATE TABLE IF NOT EXISTS `pv` (
  `id_pv` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `meeting_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_next_date` timestamp NULL DEFAULT NULL,
  `meeting_next_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affair_id` int(11) NOT NULL,
  PRIMARY KEY (`id_pv`),
  KEY `fk_pv_affair1_idx` (`affair_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv`
--

INSERT INTO `pv` (`id_pv`, `state`, `meeting_date`, `meeting_place`, `meeting_next_date`, `meeting_next_place`, `affair_id`) VALUES
(1, 'En cours', '2020-03-26 15:44:37', 'Indéfini', NULL, NULL, 1),
(2, 'En cours', '2020-03-26 15:46:28', 'Indéfini', NULL, NULL, 2),
(3, 'En cours', '2020-04-02 08:17:41', 'Indéfini', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_item`
--

DROP TABLE IF EXISTS `pv_has_item`;
CREATE TABLE IF NOT EXISTS `pv_has_item` (
  `pv_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`pv_id`,`item_id`),
  KEY `fk_pv_has_item_item1_idx` (`item_id`),
  KEY `fk_pv_has_item_pv1_idx` (`pv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv_has_item`
--

INSERT INTO `pv_has_item` (`pv_id`, `item_id`) VALUES
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_user`
--

DROP TABLE IF EXISTS `pv_has_user`;
CREATE TABLE IF NOT EXISTS `pv_has_user` (
  `pv_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_PAE` enum('Présent','Absent','Excusé') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invited_current_meeting` tinyint(1) DEFAULT NULL,
  `invited_next_meeting` tinyint(1) DEFAULT NULL,
  `distribution` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pv_id`,`user_id`),
  KEY `fk_pv_has_user_user1_idx` (`user_id`),
  KEY `fk_pv_has_user_pv1_idx` (`pv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv_has_user`
--

INSERT INTO `pv_has_user` (`pv_id`, `user_id`, `status_PAE`, `invited_current_meeting`, `invited_next_meeting`, `distribution`) VALUES
(2, 2, NULL, NULL, NULL, NULL),
(2, 13, NULL, NULL, NULL, NULL),
(2, 14, 'Absent', NULL, NULL, NULL),
(2, 15, 'Excusé', NULL, NULL, NULL),
(2, 16, 'Absent', NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `token` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_user` int(11) NOT NULL,
  PRIMARY KEY (`token`),
  KEY `fk_token_user1_idx` (`user_id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organism` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `first_name`, `last_name`, `phone`, `user_group`, `function`, `organism`) VALUES
(2, 'baud@baud.fr', '81dc9bdb52d04dc20036dbd8313ed055', 'Baudouin', 'COUPEY', '0695847559', 'Dev', 'Dev fullstack', 'SAS'),
(3, 'contact@agencecasals.fr', '81dc9bdb52d04dc20036dbd8313ed055', 'Samuel', 'COUPEY', '0695847559', 'Maitrise d\'ouvrage', 'Archi', 'Casals'),
(8, 'de@de.fr', 'Affaire de test 2', 'rfqef', 'gtqfrqe', '0123456897', 'ftreqgtr', 'fqzfre', 'gtqerf'),
(9, 'frtg@gtfr.Gtgt', 'Affaire de test 2', 'freqf', 'gtsrgt', '0123456789', 'fqrefre', 'gtsqrg', 'frqef'),
(10, 'FREG@de.fr', 'Affaire de test 2', 'Sam', 'Coupe', '0123456789', 'frea', 'freqarg', 'AETGR'),
(11, 'baudcou@gt.f', 'Affaire de test 2', 'Sam', 'coupcoup', '0123456789', 'UHudeF', 'FORIEA', 'OIJR'),
(12, 'gtyh@tgt.fr', 'Affaire de test 2', 'greg', 'treheythe', '0123456789', 'eytghrt', 'gyethyte', 'egtgzrth'),
(13, 'TRSG@GTG.FR', 'Affaire de test 2', 'Samr ', 'freag', '0123456799', 'tzrgrz', 'ftrhrz', 'GTRZSH'),
(14, 'fr@fr.gt', 'Affaire de test 2', 'Ici', 'dreaqifj', '0124567893', 'treoig', 'gtoih', 'GOIRTHA'),
(15, 'buyfr@fr.gt', 'Affaire de test 2', 'Same', 'Coup', '0695847559', 'Ici', 'Lad', 'irhoi'),
(16, 'baud@fr.Fr', 'Affaire de test 2', 'Jen', 'Michel', '0123456789', 'Idice', 'derftr', 'freag');

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
