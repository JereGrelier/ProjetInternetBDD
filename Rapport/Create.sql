-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 05 Avril 2022 à 18:17
-- Version du serveur: 5.5.29-0ubuntu0.12.04.2
-- Version de PHP: 5.3.10-1ubuntu3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `enaudy`
--

-- --------------------------------------------------------

--
-- Structure de la table `ATTAQUE`
--

CREATE TABLE IF NOT EXISTS `ATTAQUE` (
  `IdAttaque` int(11) NOT NULL AUTO_INCREMENT,
  `NomAttaque` text NOT NULL,
  `Puissance` int(11) NOT NULL,
  `Precision` int(11) NOT NULL,
  `TypeAttaque` int(11) NOT NULL,
  PRIMARY KEY (`IdAttaque`),
  KEY `TypeAttaque` (`TypeAttaque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Structure de la table `EFFICACITE`
--

CREATE TABLE IF NOT EXISTS `EFFICACITE` (
  `IdTypeAttaque` int(11) NOT NULL,
  `IdTypeDefense` int(11) NOT NULL,
  `Coefficient` int(11) NOT NULL,
  PRIMARY KEY (`IdTypeAttaque`,`IdTypeDefense`),
  KEY `IdTypeDefense` (`IdTypeDefense`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ESPECE`
--

CREATE TABLE IF NOT EXISTS `ESPECE` (
  `Numero` int(11) NOT NULL,
  `NomEspece` text NOT NULL,
  `TypeEspece` int(11) NOT NULL,
  `TypeEspece2` int(11) DEFAULT NULL,
  `Sprite` text NOT NULL,
  PRIMARY KEY (`Numero`),
  KEY `TypeEspece` (`TypeEspece`),
  KEY `TypeEspece2` (`TypeEspece2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `HABITAT`
--

CREATE TABLE IF NOT EXISTS `HABITAT` (
  `NumEspece` int(11) NOT NULL,
  `IdZone` int(11) NOT NULL,
  PRIMARY KEY (`NumEspece`,`IdZone`),
  KEY `IdZone` (`IdZone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `LOCALISATION`
--

CREATE TABLE IF NOT EXISTS `LOCALISATION` (
  `IdObjet` int(11) NOT NULL,
  `IdZone` int(11) NOT NULL,
  PRIMARY KEY (`IdObjet`,`IdZone`),
  KEY `IdZone` (`IdZone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `MONSTROPOCHE`
--

CREATE TABLE IF NOT EXISTS `MONSTROPOCHE` (
  `IdMonstropoche` int(11) NOT NULL AUTO_INCREMENT,
  `Surnom` text NOT NULL,
  `Etat` enum('Mission','Repos','Reproduction') NOT NULL,
  `PV` int(11) NOT NULL,
  `PE` int(11) NOT NULL,
  `Genre` enum('Male','Femelle','Binaire','Non binaire') NOT NULL,
  `NumEspece` int(11) NOT NULL,
  `IdObjet` int(11) DEFAULT NULL,
  `IdProprietaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMonstropoche`),
  KEY `NumEspece` (`NumEspece`,`IdObjet`,`IdProprietaire`),
  KEY `IdObjet` (`IdObjet`),
  KEY `IdProprietaire` (`IdProprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=77 ;

-- --------------------------------------------------------

--
-- Structure de la table `MOVESET_ESPECE`
--

CREATE TABLE IF NOT EXISTS `MOVESET_ESPECE` (
  `IdAttaque` int(11) NOT NULL,
  `NumEspece` int(11) NOT NULL,
  `PE_Requis` int(11) NOT NULL,
  PRIMARY KEY (`IdAttaque`,`NumEspece`),
  KEY `NumEspece` (`NumEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `MOVESET_MONSTROPOCHE`
--

CREATE TABLE IF NOT EXISTS `MOVESET_MONSTROPOCHE` (
  `IdAttaque` int(11) NOT NULL,
  `IdMonstropoche` int(11) NOT NULL,
  `Position` enum('1','2','3','4') NOT NULL,
  PRIMARY KEY (`IdAttaque`,`IdMonstropoche`),
  KEY `IdMonstropoche` (`IdMonstropoche`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `MUTATION`
--

CREATE TABLE IF NOT EXISTS `MUTATION` (
  `IdPreMutation` int(11) NOT NULL,
  `IdPostMutation` int(11) NOT NULL,
  `IdObjet` int(11) DEFAULT NULL,
  `PE_Requis` int(11) NOT NULL,
  PRIMARY KEY (`IdPreMutation`,`IdPostMutation`),
  KEY `IdObjet` (`IdObjet`),
  KEY `IdPostMutation` (`IdPostMutation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `OBJET`
--

CREATE TABLE IF NOT EXISTS `OBJET` (
  `IdObjet` int(11) NOT NULL AUTO_INCREMENT,
  `NomObjet` text NOT NULL,
  `BonusPuissance` float NOT NULL,
  `IsUnique` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdObjet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Structure de la table `PROPRIETAIRE`
--

CREATE TABLE IF NOT EXISTS `PROPRIETAIRE` (
  `IdProprietaire` int(11) NOT NULL AUTO_INCREMENT,
  `NomProprietaire` text NOT NULL,
  `IsJouable` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdProprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Structure de la table `TYPE`
--

CREATE TABLE IF NOT EXISTS `TYPE` (
  `IdType` int(11) NOT NULL AUTO_INCREMENT,
  `NomType` text NOT NULL,
  PRIMARY KEY (`IdType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Structure de la table `ZONE`
--

CREATE TABLE IF NOT EXISTS `ZONE` (
  `IdZone` int(11) NOT NULL AUTO_INCREMENT,
  `NomZone` text NOT NULL,
  PRIMARY KEY (`IdZone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ATTAQUE`
--
ALTER TABLE `ATTAQUE`
  ADD CONSTRAINT `ATTAQUE_ibfk_2` FOREIGN KEY (`TypeAttaque`) REFERENCES `TYPE` (`IdType`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `EFFICACITE`
--
ALTER TABLE `EFFICACITE`
  ADD CONSTRAINT `EFFICACITE_ibfk_6` FOREIGN KEY (`IdTypeDefense`) REFERENCES `TYPE` (`IdType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EFFICACITE_ibfk_5` FOREIGN KEY (`IdTypeAttaque`) REFERENCES `TYPE` (`IdType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ESPECE`
--
ALTER TABLE `ESPECE`
  ADD CONSTRAINT `ESPECE_ibfk_4` FOREIGN KEY (`TypeEspece2`) REFERENCES `TYPE` (`IdType`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ESPECE_ibfk_2` FOREIGN KEY (`TypeEspece`) REFERENCES `TYPE` (`IdType`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `HABITAT`
--
ALTER TABLE `HABITAT`
  ADD CONSTRAINT `HABITAT_ibfk_8` FOREIGN KEY (`IdZone`) REFERENCES `ZONE` (`IdZone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `HABITAT_ibfk_7` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `LOCALISATION`
--
ALTER TABLE `LOCALISATION`
  ADD CONSTRAINT `LOCALISATION_ibfk_4` FOREIGN KEY (`IdZone`) REFERENCES `ZONE` (`IdZone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `LOCALISATION_ibfk_3` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `MONSTROPOCHE`
--
ALTER TABLE `MONSTROPOCHE`
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_9` FOREIGN KEY (`IdProprietaire`) REFERENCES `PROPRIETAIRE` (`IdProprietaire`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_6` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_8` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `MOVESET_ESPECE`
--
ALTER TABLE `MOVESET_ESPECE`
  ADD CONSTRAINT `MOVESET_ESPECE_ibfk_8` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MOVESET_ESPECE_ibfk_7` FOREIGN KEY (`IdAttaque`) REFERENCES `ATTAQUE` (`IdAttaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `MOVESET_MONSTROPOCHE`
--
ALTER TABLE `MOVESET_MONSTROPOCHE`
  ADD CONSTRAINT `MOVESET_MONSTROPOCHE_ibfk_4` FOREIGN KEY (`IdMonstropoche`) REFERENCES `MONSTROPOCHE` (`IdMonstropoche`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MOVESET_MONSTROPOCHE_ibfk_3` FOREIGN KEY (`IdAttaque`) REFERENCES `ATTAQUE` (`IdAttaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `MUTATION`
--
ALTER TABLE `MUTATION`
  ADD CONSTRAINT `MUTATION_ibfk_8` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `MUTATION_ibfk_6` FOREIGN KEY (`IdPreMutation`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MUTATION_ibfk_7` FOREIGN KEY (`IdPostMutation`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
