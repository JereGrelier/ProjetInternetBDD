-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 05 Avril 2022 à 14:01
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

DROP TABLE IF EXISTS `ATTAQUE`;
CREATE TABLE IF NOT EXISTS `ATTAQUE` (
  `IdAttaque` int(11) NOT NULL AUTO_INCREMENT,
  `NomAttaque` text NOT NULL,
  `Puissance` int(11) NOT NULL,
  `Precision` int(11) NOT NULL,
  `TypeAttaque` int(11) NOT NULL,
  PRIMARY KEY (`IdAttaque`),
  KEY `TypeAttaque` (`TypeAttaque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `ATTAQUE`
--

INSERT INTO `ATTAQUE` (`IdAttaque`, `NomAttaque`, `Puissance`, `Precision`, `TypeAttaque`) VALUES
(1, 'Tire-Bouchon', 130, 80, 1),
(2, 'Pop', 260, 10, 2),
(3, 'Pi-Rate', 190, 30, 6),
(5, 'Pression', 120, 70, 2);

-- --------------------------------------------------------

--
-- Structure de la table `EFFICACITE`
--

DROP TABLE IF EXISTS `EFFICACITE`;
CREATE TABLE IF NOT EXISTS `EFFICACITE` (
  `IdTypeAttaque` int(11) NOT NULL,
  `IdTypeDefense` int(11) NOT NULL,
  `Coefficient` int(11) NOT NULL,
  PRIMARY KEY (`IdTypeAttaque`,`IdTypeDefense`),
  KEY `IdTypeDefense` (`IdTypeDefense`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `EFFICACITE`
--

INSERT INTO `EFFICACITE` (`IdTypeAttaque`, `IdTypeDefense`, `Coefficient`) VALUES
(1, 2, 2),
(1, 4, 1),
(2, 1, 1),
(2, 4, 1),
(4, 1, 2),
(4, 2, 1),
(6, 7, 1),
(7, 9, 0),
(8, 6, 1),
(9, 7, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ESPECE`
--

DROP TABLE IF EXISTS `ESPECE`;
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

--
-- Contenu de la table `ESPECE`
--

INSERT INTO `ESPECE` (`Numero`, `NomEspece`, `TypeEspece`, `TypeEspece2`, `Sprite`) VALUES
(1, 'Bulbabshinte', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png'),
(2, 'Bierebizarre', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/2.png'),
(3, 'Florizzara', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/3.png'),
(4, 'sakÃ©mÃ¨che', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/4.png'),
(5, 'Reptincidre', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/5.png'),
(6, 'dralcoolfeu', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/6.png'),
(7, 'Vodkarapuce', 4, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/7.png'),
(8, 'Carabu', 4, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/8.png'),
(9, 'Tortrinque', 4, 6, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/9.png'),
(25, 'Pickequettechu', 6, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/25.png');

-- --------------------------------------------------------

--
-- Structure de la table `HABITAT`
--

DROP TABLE IF EXISTS `HABITAT`;
CREATE TABLE IF NOT EXISTS `HABITAT` (
  `NumEspece` int(11) NOT NULL,
  `IdZone` int(11) NOT NULL,
  PRIMARY KEY (`NumEspece`,`IdZone`),
  KEY `IdZone` (`IdZone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `HABITAT`
--

INSERT INTO `HABITAT` (`NumEspece`, `IdZone`) VALUES
(4, 1),
(5, 1),
(6, 1),
(1, 2),
(25, 3),
(2, 4),
(3, 4),
(7, 5),
(8, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Structure de la table `LOCALISATION`
--

DROP TABLE IF EXISTS `LOCALISATION`;
CREATE TABLE IF NOT EXISTS `LOCALISATION` (
  `IdObjet` int(11) NOT NULL,
  `IdZone` int(11) NOT NULL,
  PRIMARY KEY (`IdObjet`,`IdZone`),
  KEY `IdZone` (`IdZone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `LOCALISATION`
--

INSERT INTO `LOCALISATION` (`IdObjet`, `IdZone`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(3, 4),
(1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `MONSTROPOCHE`
--

DROP TABLE IF EXISTS `MONSTROPOCHE`;
CREATE TABLE IF NOT EXISTS `MONSTROPOCHE` (
  `IdMonstropoche` int(11) NOT NULL AUTO_INCREMENT,
  `Surnom` text NOT NULL,
  `Etat` enum('Mission','Repos','Reproduction') NOT NULL,
  `PV` int(11) NOT NULL,
  `PE` int(11) NOT NULL,
  `Genre` enum('Mâle','Femelle','Binaire','Non binaire') NOT NULL,
  `NumEspece` int(11) NOT NULL,
  `IdObjet` int(11) DEFAULT NULL,
  `IdProprietaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMonstropoche`),
  KEY `NumEspece` (`NumEspece`,`IdObjet`,`IdProprietaire`),
  KEY `IdObjet` (`IdObjet`),
  KEY `IdProprietaire` (`IdProprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `MONSTROPOCHE`
--

INSERT INTO `MONSTROPOCHE` (`IdMonstropoche`, `Surnom`, `Etat`, `PV`, `PE`, `Genre`, `NumEspece`, `IdObjet`, `IdProprietaire`) VALUES
(2, 'Bastian H', 'Reproduction', 10, 0, 'Non binaire', 5, 3, 1),
(57, 'YOANN D S', 'Repos', 32, 0, 'Binaire', 9, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `MOVESET_ESPECE`
--

DROP TABLE IF EXISTS `MOVESET_ESPECE`;
CREATE TABLE IF NOT EXISTS `MOVESET_ESPECE` (
  `IdAttaque` int(11) NOT NULL,
  `NumEspece` int(11) NOT NULL,
  `PE_Requis` int(11) NOT NULL,
  PRIMARY KEY (`IdAttaque`,`NumEspece`),
  KEY `NumEspece` (`NumEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `MOVESET_ESPECE`
--

INSERT INTO `MOVESET_ESPECE` (`IdAttaque`, `NumEspece`, `PE_Requis`) VALUES
(1, 5, 2),
(1, 9, 60),
(2, 2, 22),
(2, 5, 23),
(2, 25, 45),
(3, 1, 3),
(3, 4, 10),
(3, 5, 6),
(5, 6, 44),
(5, 8, 18);

-- --------------------------------------------------------

--
-- Structure de la table `MOVESET_MONSTROPOCHE`
--

DROP TABLE IF EXISTS `MOVESET_MONSTROPOCHE`;
CREATE TABLE IF NOT EXISTS `MOVESET_MONSTROPOCHE` (
  `IdAttaque` int(11) NOT NULL,
  `IdMonstropoche` int(11) NOT NULL,
  `Position` enum('1','2','3','4') NOT NULL,
  PRIMARY KEY (`IdAttaque`,`IdMonstropoche`),
  KEY `IdMonstropoche` (`IdMonstropoche`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `MOVESET_MONSTROPOCHE`
--

INSERT INTO `MOVESET_MONSTROPOCHE` (`IdAttaque`, `IdMonstropoche`, `Position`) VALUES
(1, 2, '1'),
(1, 57, '3'),
(2, 2, '2'),
(2, 57, '1'),
(3, 2, '3'),
(3, 57, '4'),
(5, 2, '4'),
(5, 57, '2');

-- --------------------------------------------------------

--
-- Structure de la table `MUTATION`
--

DROP TABLE IF EXISTS `MUTATION`;
CREATE TABLE IF NOT EXISTS `MUTATION` (
  `IdPreMutation` int(11) NOT NULL,
  `IdPostMutation` int(11) NOT NULL,
  `IdObjet` int(11) DEFAULT NULL,
  `PE_Requis` int(11) NOT NULL,
  PRIMARY KEY (`IdPreMutation`,`IdPostMutation`),
  KEY `IdObjet` (`IdObjet`),
  KEY `IdPostMutation` (`IdPostMutation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `MUTATION`
--

INSERT INTO `MUTATION` (`IdPreMutation`, `IdPostMutation`, `IdObjet`, `PE_Requis`) VALUES
(1, 2, 3, 13),
(2, 3, NULL, 32);

-- --------------------------------------------------------

--
-- Structure de la table `OBJET`
--

DROP TABLE IF EXISTS `OBJET`;
CREATE TABLE IF NOT EXISTS `OBJET` (
  `IdObjet` int(11) NOT NULL AUTO_INCREMENT,
  `NomObjet` text NOT NULL,
  `BonusPuissance` float NOT NULL,
  `IsUnique` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdObjet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `OBJET`
--

INSERT INTO `OBJET` (`IdObjet`, `NomObjet`, `BonusPuissance`, `IsUnique`) VALUES
(1, 'Pierre', 1.8, 1),
(3, 'Choppe', 2.5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `PROPRIETAIRE`
--

DROP TABLE IF EXISTS `PROPRIETAIRE`;
CREATE TABLE IF NOT EXISTS `PROPRIETAIRE` (
  `IdProprietaire` int(11) NOT NULL AUTO_INCREMENT,
  `NomProprietaire` text NOT NULL,
  `IsJouable` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdProprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `PROPRIETAIRE`
--

INSERT INTO `PROPRIETAIRE` (`IdProprietaire`, `NomProprietaire`, `IsJouable`) VALUES
(1, 'Enzo Naudy', 0),
(2, 'Jeremy Grelier', 1);

-- --------------------------------------------------------

--
-- Structure de la table `TYPE`
--

DROP TABLE IF EXISTS `TYPE`;
CREATE TABLE IF NOT EXISTS `TYPE` (
  `IdType` int(11) NOT NULL AUTO_INCREMENT,
  `NomType` text NOT NULL,
  PRIMARY KEY (`IdType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `TYPE`
--

INSERT INTO `TYPE` (`IdType`, `NomType`) VALUES
(1, 'Vin rouge'),
(2, 'Champagne'),
(4, 'Vodka'),
(5, 'Tequila'),
(6, 'Rhum'),
(7, 'Vin rosÃ©'),
(8, 'Vin blanc'),
(9, 'Pisco');

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_ESPECE`
--

DROP TABLE IF EXISTS `TYPE_ESPECE`;
CREATE TABLE IF NOT EXISTS `TYPE_ESPECE` (
  `IdType` int(11) NOT NULL,
  `NumEspece` int(11) NOT NULL,
  PRIMARY KEY (`IdType`,`NumEspece`),
  KEY `NumEspece` (`NumEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ZONE`
--

DROP TABLE IF EXISTS `ZONE`;
CREATE TABLE IF NOT EXISTS `ZONE` (
  `IdZone` int(11) NOT NULL AUTO_INCREMENT,
  `NomZone` text NOT NULL,
  PRIMARY KEY (`IdZone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `ZONE`
--

INSERT INTO `ZONE` (`IdZone`, `NomZone`) VALUES
(1, 'Bar'),
(2, 'Cave a vin'),
(3, 'Chai'),
(4, 'Brasserie'),
(5, 'Pub'),
(6, 'Distillerie');

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
  ADD CONSTRAINT `EFFICACITE_ibfk_4` FOREIGN KEY (`IdTypeDefense`) REFERENCES `TYPE` (`IdType`) ON UPDATE CASCADE,
  ADD CONSTRAINT `EFFICACITE_ibfk_3` FOREIGN KEY (`IdTypeAttaque`) REFERENCES `TYPE` (`IdType`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_7` FOREIGN KEY (`IdProprietaire`) REFERENCES `PROPRIETAIRE` (`IdProprietaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_4` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_6` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Contraintes pour la table `TYPE_ESPECE`
--
ALTER TABLE `TYPE_ESPECE`
  ADD CONSTRAINT `TYPE_ESPECE_ibfk_4` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TYPE_ESPECE_ibfk_3` FOREIGN KEY (`IdType`) REFERENCES `TYPE` (`IdType`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
