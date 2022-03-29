-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 29 Mars 2022 à 15:32
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ATTAQUE`
--

INSERT INTO `ATTAQUE` (`IdAttaque`, `NomAttaque`, `Puissance`, `Precision`, `TypeAttaque`) VALUES
(1, 'Tire-Bouchon', 130, 80, 1),
(2, 'Pop', 260, 10, 2),
(3, 'Pi-Rate', 190, 30, 6),
(4, 'Test', 20, 100, 7);

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
  `Sprite` text NOT NULL,
  PRIMARY KEY (`Numero`),
  KEY `TypeEspece` (`TypeEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `ESPECE`
--

INSERT INTO `ESPECE` (`Numero`, `NomEspece`, `TypeEspece`, `Sprite`) VALUES
(1, 'Bulbabshinte', 9, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png'),
(2, 'Bierebizarre', 9, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/2.png'),
(3, 'Florizzara', 9, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/3.png'),
(4, 'sakÃ©mÃ¨che', 5, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/4.png'),
(5, 'Reptincidre', 5, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/5.png'),
(6, 'dralcoolfeu', 5, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/6.png'),
(7, 'Vodkarapuce', 4, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/7.png'),
(8, 'Carabu', 4, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/8.png'),
(9, 'Tortrinque', 4, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/9.png'),
(25, 'Pickequettechu', 6, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/25.png');

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

--
-- Contenu de la table `HABITAT`
--

INSERT INTO `HABITAT` (`NumEspece`, `IdZone`) VALUES
(4, 1),
(5, 1),
(6, 1),
(25, 3),
(1, 4),
(2, 4),
(3, 4),
(7, 5),
(8, 5),
(9, 5);

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
  `Genre` enum('Mâle','Femelle','Binaire','Non binaire') NOT NULL,
  `NumEspece` int(11) NOT NULL,
  `IdObjet` int(11) DEFAULT NULL,
  `IdProprietaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMonstropoche`),
  KEY `NumEspece` (`NumEspece`,`IdObjet`,`IdProprietaire`),
  KEY `IdObjet` (`IdObjet`),
  KEY `IdProprietaire` (`IdProprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `MONSTROPOCHE`
--

INSERT INTO `MONSTROPOCHE` (`IdMonstropoche`, `Surnom`, `Etat`, `PV`, `PE`, `Genre`, `NumEspece`, `IdObjet`, `IdProprietaire`) VALUES
(2, 'Bastian H', 'Repos', 10, 0, 'Femelle', 5, 3, 1),
(5, 'Flora', 'Repos', 33, 0, 'Femelle', 3, 1, 2);

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

--
-- Contenu de la table `MOVESET_ESPECE`
--

INSERT INTO `MOVESET_ESPECE` (`IdAttaque`, `NumEspece`, `PE_Requis`) VALUES
(2, 1, 3),
(4, 1, 25);

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

--
-- Contenu de la table `MOVESET_MONSTROPOCHE`
--

INSERT INTO `MOVESET_MONSTROPOCHE` (`IdAttaque`, `IdMonstropoche`, `Position`) VALUES
(1, 2, '1'),
(2, 2, '2'),
(3, 2, '3'),
(4, 2, '4');

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

--
-- Contenu de la table `MUTATION`
--

INSERT INTO `MUTATION` (`IdPreMutation`, `IdPostMutation`, `IdObjet`, `PE_Requis`) VALUES
(1, 2, NULL, 16),
(2, 3, NULL, 32);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `PROPRIETAIRE` (
  `IdProprietaire` int(11) NOT NULL AUTO_INCREMENT,
  `NomProprietaire` text NOT NULL,
  `IsJouable` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdProprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `TYPE` (
  `IdType` int(11) NOT NULL AUTO_INCREMENT,
  `NomType` text NOT NULL,
  PRIMARY KEY (`IdType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=14 ;

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

CREATE TABLE IF NOT EXISTS `ZONE` (
  `IdZone` int(11) NOT NULL AUTO_INCREMENT,
  `NomZone` text NOT NULL,
  PRIMARY KEY (`IdZone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

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
  ADD CONSTRAINT `ESPECE_ibfk_2` FOREIGN KEY (`TypeEspece`) REFERENCES `TYPE` (`IdType`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `HABITAT`
--
ALTER TABLE `HABITAT`
  ADD CONSTRAINT `HABITAT_ibfk_2` FOREIGN KEY (`IdZone`) REFERENCES `ZONE` (`IdZone`) ON UPDATE CASCADE,
  ADD CONSTRAINT `HABITAT_ibfk_1` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `LOCALISATION`
--
ALTER TABLE `LOCALISATION`
  ADD CONSTRAINT `LOCALISATION_ibfk_2` FOREIGN KEY (`IdZone`) REFERENCES `ZONE` (`IdZone`) ON UPDATE CASCADE,
  ADD CONSTRAINT `LOCALISATION_ibfk_1` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `MONSTROPOCHE`
--
ALTER TABLE `MONSTROPOCHE`
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_5` FOREIGN KEY (`IdProprietaire`) REFERENCES `PROPRIETAIRE` (`IdProprietaire`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_1` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MONSTROPOCHE_ibfk_4` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `MOVESET_ESPECE`
--
ALTER TABLE `MOVESET_ESPECE`
  ADD CONSTRAINT `MOVESET_ESPECE_ibfk_2` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MOVESET_ESPECE_ibfk_1` FOREIGN KEY (`IdAttaque`) REFERENCES `ATTAQUE` (`IdAttaque`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `MOVESET_MONSTROPOCHE`
--
ALTER TABLE `MOVESET_MONSTROPOCHE`
  ADD CONSTRAINT `MOVESET_MONSTROPOCHE_ibfk_2` FOREIGN KEY (`IdMonstropoche`) REFERENCES `MONSTROPOCHE` (`IdMonstropoche`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MOVESET_MONSTROPOCHE_ibfk_1` FOREIGN KEY (`IdAttaque`) REFERENCES `ATTAQUE` (`IdAttaque`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `MUTATION`
--
ALTER TABLE `MUTATION`
  ADD CONSTRAINT `MUTATION_ibfk_5` FOREIGN KEY (`IdPostMutation`) REFERENCES `ESPECE` (`Numero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MUTATION_ibfk_3` FOREIGN KEY (`IdObjet`) REFERENCES `OBJET` (`IdObjet`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MUTATION_ibfk_4` FOREIGN KEY (`IdPreMutation`) REFERENCES `ESPECE` (`Numero`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `TYPE_ESPECE`
--
ALTER TABLE `TYPE_ESPECE`
  ADD CONSTRAINT `TYPE_ESPECE_ibfk_2` FOREIGN KEY (`NumEspece`) REFERENCES `ESPECE` (`Numero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TYPE_ESPECE_ibfk_1` FOREIGN KEY (`IdType`) REFERENCES `TYPE` (`IdType`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
