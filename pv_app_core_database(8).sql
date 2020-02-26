-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 26 fév. 2020 à 15:43
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `affair`
--

INSERT INTO `affair` (`id_affair`, `name`, `address`, `progress`, `meeting_type`) VALUES
(1, 'Layrac', 'Place centrale', 15, 'Chantier'),
(2, 'Caster', 'Rue Principale', 80, 'Etude');

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
  `visible` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `position`, `note`, `follow_up`, `ressources`, `completion`, `completion_date`, `visible`, `created_at`) VALUES
(4, 1, 'note 5', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(5, 1, 'note', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(6, 1, 'note', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(7, 1, 'note 3', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(8, 1, 'note 3', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(9, 1, 'note 3', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(10, 1, 'note 3', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(11, 1, 'note 3', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 0, '2020-02-06 13:00:00'),
(12, 1, 'note 3', 'suivi', 'ressource', 'Entreprise', '2020-02-06 13:00:00', 1, '2020-02-06 13:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`id_lot`, `name`, `affair_id`) VALUES
(1, 'Gros oeuvre', 1),
(2, 'Mobilier', 1),
(3, 'Reseaux', 2),
(4, 'Planations', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv`
--

INSERT INTO `pv` (`id_pv`, `state`, `meeting_date`, `meeting_place`, `meeting_next_date`, `meeting_next_place`, `affair_id`) VALUES
(3, 'Terminé', '2020-02-06 13:00:00', 'sur place', '2020-02-07 13:00:00', 'sur place', 1),
(4, 'Terminé', '2020-02-06 14:00:00', 'Mairie', '2020-02-07 14:00:00', 'Mairie', 1),
(5, 'En cours', '2020-02-06 13:00:00', 'sur place', '2020-02-07 13:00:00', 'sur place', 2);

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
(3, 4),
(3, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12);

-- --------------------------------------------------------

--
-- Structure de la table `pv_has_user`
--

DROP TABLE IF EXISTS `pv_has_user`;
CREATE TABLE IF NOT EXISTS `pv_has_user` (
  `pv_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Présent','Absent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pv_id`,`user_id`),
  KEY `fk_pv_has_user_user1_idx` (`user_id`),
  KEY `fk_pv_has_user_pv1_idx` (`pv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv_has_user`
--

INSERT INTO `pv_has_user` (`pv_id`, `user_id`, `status`) VALUES
(3, 1, 'Présent'),
(4, 2, 'Présent');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `token` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`token`),
  KEY `fk_token_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `token`
--

INSERT INTO `token` (`token`, `device`, `expiration_date`, `user_id`) VALUES
('590dea5daf1fd47c1a65ba061e0a0f37c17caaf42854', 'desktop', '2020-02-21 14:28:17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organism` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `first_name`, `last_name`, `phone`, `user_group`, `function`, `organism`) VALUES
(1, 'baud@baud.fr', '1234', 'Baudouin', 'COUPEY', '0695847559', 'Dev', 'dev', 'SAS'),
(2, 'contact@agencecasals.fr', '1234', 'Sam', 'COUPEY', '0695847559', 'Maitre d\'oeuvre', 'Archi', 'Agence Casals');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `fk_lot_affair1` FOREIGN KEY (`affair_id`) REFERENCES `affair` (`id_affair`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pv`
--
ALTER TABLE `pv`
  ADD CONSTRAINT `fk_pv_affair1` FOREIGN KEY (`affair_id`) REFERENCES `affair` (`id_affair`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pv_has_item`
--
ALTER TABLE `pv_has_item`
  ADD CONSTRAINT `fk_pv_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id_item`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pv_has_item_pv1` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pv_has_user`
--
ALTER TABLE `pv_has_user`
  ADD CONSTRAINT `fk_pv_has_user_pv1` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pv_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
