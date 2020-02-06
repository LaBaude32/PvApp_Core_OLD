-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 06 fév. 2020 à 10:04
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
-- Structure de la table `affaire`
--

DROP TABLE IF EXISTS `affaire`;
CREATE TABLE IF NOT EXISTS `affaire` (
  `id_affaire` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avancement` int(11) DEFAULT NULL,
  `type_reu` enum('Chantier','Etude') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_affaire`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `affaire`
--

INSERT INTO `affaire` (`id_affaire`, `nom`, `adresse`, `avancement`, `type_reu`) VALUES
(1, 'Layrac', 'Place du village', 15, 'Chantier'),
(2, 'Castera ', 'Rue principale', 100, 'Etude');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `suite_a_donner` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ressources` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `echance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_echeance` timestamp NULL DEFAULT NULL,
  `visible` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item_has_pv`
--

DROP TABLE IF EXISTS `item_has_pv`;
CREATE TABLE IF NOT EXISTS `item_has_pv` (
  `item_id` int(11) NOT NULL,
  `pv_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`pv_id`),
  KEY `fk_item_has_pv_pv1_idx` (`pv_id`),
  KEY `fk_item_has_pv_item1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

DROP TABLE IF EXISTS `lot`;
CREATE TABLE IF NOT EXISTS `lot` (
  `id_lot` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affaire_id` int(11) NOT NULL,
  PRIMARY KEY (`id_lot`),
  KEY `fk_lot_affaire1_idx` (`affaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`id_lot`, `name`, `affaire_id`) VALUES
(1, 'Gros oeuvre', 1),
(2, 'Mobilier', 1),
(3, 'Plantation', 2),
(4, 'Réseaux', 2);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id_personne`, `email`, `password`, `first_name`, `last_name`, `telephone`, `groupe`, `fonction`, `organisme`) VALUES
(1, 'baudcoupey@hotmail.fr', '1234', 'Baudouin', 'Coupey', '0695847559', 'Développement', 'Développeur', 'SAS Baud Dev'),
(2, 'contact@agencecasals.fr', 'azer', 'Samuel', 'Coupey', '0562285081', 'Maitre d\'oeuvre', 'Architecte', 'Agence Casals');

-- --------------------------------------------------------

--
-- Structure de la table `personne_has_pv_with_statut`
--

DROP TABLE IF EXISTS `personne_has_pv_with_statut`;
CREATE TABLE IF NOT EXISTS `personne_has_pv_with_statut` (
  `pv_id` int(11) NOT NULL,
  `personne_id` int(11) NOT NULL,
  `statut` enum('Présent','Absent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pv_id`,`personne_id`),
  KEY `fk_pv_has_personne_personne1_idx` (`personne_id`),
  KEY `fk_pv_has_personne_pv1_idx` (`pv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pv`
--

DROP TABLE IF EXISTS `pv`;
CREATE TABLE IF NOT EXISTS `pv` (
  `id_pv` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_reunion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lieu_reunion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_pro_reunion` timestamp NULL DEFAULT NULL,
  `lieu_pro_reunion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affaire_id` int(11) NOT NULL,
  PRIMARY KEY (`id_pv`),
  KEY `fk_pv_affaire1_idx` (`affaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pv`
--

INSERT INTO `pv` (`id_pv`, `etat`, `date_reunion`, `lieu_reunion`, `date_pro_reunion`, `lieu_pro_reunion`, `affaire_id`) VALUES
(1, 'Terminé', '2020-02-04 09:30:00', 'En Mairie', '2020-02-06 09:30:00', 'Sur place', 1),
(2, 'En cours', '2020-02-04 09:30:00', 'En Mairie', '2020-02-06 09:30:00', 'Sur place', 1),
(3, 'En cours', '2020-02-02 15:00:00', 'Sur place', '2020-02-04 15:00:00', 'Sur place', 2),
(4, 'En cours', '2020-02-04 15:00:00', 'Sur place', '2020-02-10 15:00:00', 'En mairie', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item_has_pv`
--
ALTER TABLE `item_has_pv`
  ADD CONSTRAINT `fk_item_has_pv_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `fk_item_has_pv_pv1` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`);

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `fk_lot_affaire1` FOREIGN KEY (`affaire_id`) REFERENCES `affaire` (`id_affaire`);

--
-- Contraintes pour la table `personne_has_pv_with_statut`
--
ALTER TABLE `personne_has_pv_with_statut`
  ADD CONSTRAINT `fk_pv_has_personne_personne1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id_personne`),
  ADD CONSTRAINT `fk_pv_has_personne_pv1` FOREIGN KEY (`pv_id`) REFERENCES `pv` (`id_pv`);

--
-- Contraintes pour la table `pv`
--
ALTER TABLE `pv`
  ADD CONSTRAINT `fk_pv_affaire1` FOREIGN KEY (`affaire_id`) REFERENCES `affaire` (`id_affaire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
