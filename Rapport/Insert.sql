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
-- Contenu de la table `ZONE`
--

INSERT INTO `ZONE` (`IdZone`, `NomZone`) VALUES
(1, 'Bar'),
(2, 'Cave a vin'),
(3, 'Chai'),
(4, 'Brasserie'),
(5, 'Pub'),
(6, 'Distillerie'),
(15, 'DiscothÃ¨que');

-- --------------------------------------------------------

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
(9, 'Pisco'),
(21, 'Gin');

-- --------------------------------------------------------

--
-- Contenu de la table `ATTAQUE`
--

INSERT INTO `ATTAQUE` (`IdAttaque`, `NomAttaque`, `Puissance`, `Precision`, `TypeAttaque`) VALUES
(1, 'Tire-Bouchon', 130, 80, 1),
(2, 'Pop', 60, 10, 2),
(3, 'Pi-Rate', 190, 30, 6),
(5, 'Pression', 120, 70, 2),
(12, 'Shooter', 250, 50, 4),
(13, 'Ivresse', 80, 100, 5);

-- --------------------------------------------------------

--
-- Contenu de la table `OBJET`
--

INSERT INTO `OBJET` (`IdObjet`, `NomObjet`, `BonusPuissance`, `IsUnique`) VALUES
(24, 'GlaÃ§on', 1.8, 0),
(25, 'Touillette', 1.1, 0),
(26, 'Dessous de verre', 0.4, 0),
(27, 'Tranche de citron', 2.4, 1);

-- --------------------------------------------------------

--
-- Contenu de la table `PROPRIETAIRE`
--

INSERT INTO `PROPRIETAIRE` (`IdProprietaire`, `NomProprietaire`, `IsJouable`) VALUES
(1, 'Enzo Naudy', 0),
(2, 'Jeremy Grelier', 1),
(17, 'Bastian Hologne', 1);

-- --------------------------------------------------------

--
-- Contenu de la table `ESPECE`
--

INSERT INTO `ESPECE` (`Numero`, `NomEspece`, `TypeEspece`, `TypeEspece2`, `Sprite`) VALUES
(1, 'Bulbabshinte', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png'),
(2, 'Bierebizarre', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/2.png'),
(3, 'Florizzara', 9, 8, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/3.png'),
(4, 'Sakemeche', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/4.png'),
(5, 'Reptincidre', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/5.png'),
(6, 'Dralcoolfeu', 5, 1, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/6.png'),
(7, 'Vodkarapuce', 4, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/7.png'),
(8, 'Carabu', 4, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/8.png'),
(9, 'Tortrinque', 4, 7, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/9.png'),
(10, 'Chenivrant', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/10.png'),
(11, 'Liessacier', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/11.png'),
(12, 'Wiskyllusion', 9, 6, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/12.png'),
(13, 'Aspisco', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/13.png'),
(14, 'Toxicoconfort', 9, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/14.png'),
(15, 'MarcMardgnan', 9, 1, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/15.png'),
(16, 'Roulcoolisme', 2, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/16.png'),
(17, 'RoucuraÃ§ao', 2, 6, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/17.png'),
(18, 'Roucognac', 2, 6, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/18.png'),
(19, 'Rattatalcool', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/19.png'),
(20, 'RattatacachaÃ§a', 5, 6, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/20.png'),
(21, 'Piafabuveur', 1, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/21.png'),
(22, 'Rapasdepicole', 1, 8, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/22.png'),
(23, 'Aboire', 7, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/23.png'),
(24, 'Arblanc', 8, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/24.png'),
(25, 'Pickequettechu', 6, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/25.png'),
(26, 'Raichupito', 6, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/26.png'),
(50, 'Taupiquoleur', 6, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/50.png'),
(51, 'Triopiquolo', 6, 4, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/51.png'),
(120, 'Starilatropbu', 21, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/120.png'),
(493, 'Arculsec', 4, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/493.png'),
(649, 'Genepi', 5, NULL, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/649.png');

-- --------------------------------------------------------

--
-- Contenu de la table `EFFICACITE`
--

INSERT INTO `EFFICACITE` (`IdTypeAttaque`, `IdTypeDefense`, `Coefficient`) VALUES
(1, 2, 2),
(1, 4, 1),
(1, 9, 1),
(2, 1, 1),
(2, 4, 1),
(4, 1, 2),
(4, 2, 1),
(6, 7, 1),
(7, 9, 0),
(8, 6, 1),
(9, 2, 3),
(9, 7, 0);

-- --------------------------------------------------------

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
-- Contenu de la table `MUTATION`
--

INSERT INTO `MUTATION` (`IdPreMutation`, `IdPostMutation`, `IdObjet`, `PE_Requis`) VALUES
(1, 2, NULL, 16),
(2, 3, NULL, 36),
(4, 5, NULL, 16),
(5, 6, NULL, 36),
(7, 8, NULL, 16),
(8, 9, NULL, 36),
(10, 11, NULL, 7),
(11, 12, NULL, 10),
(13, 14, NULL, 7),
(14, 15, NULL, 10),
(16, 17, NULL, 18),
(17, 18, NULL, 36),
(19, 20, NULL, 20),
(21, 22, NULL, 20),
(23, 24, NULL, 22),
(25, 26, 27, 22),
(50, 51, NULL, 26);

-- --------------------------------------------------------

--
-- Contenu de la table `MONSTROPOCHE`
--

INSERT INTO `MONSTROPOCHE` (`IdMonstropoche`, `Surnom`, `Etat`, `PV`, `PE`, `Genre`, `NumEspece`, `IdObjet`, `IdProprietaire`) VALUES
(2, 'Bastian H', 'Reproduction', 10, 0, 'Non binaire', 5, NULL, 1),
(57, 'YOANN D S', 'Repos', 32, 0, 'Binaire', 9, NULL, NULL),
(75, 'DEUS', 'Repos', 100, 0, 'Femelle', 493, 27, 17),
(76, 'Mackognac', 'Repos', 100, 0, 'Male', 12, 24, 17);

-- --------------------------------------------------------

--
-- Contenu de la table `MOVESET_MONSTROPOCHE`
--

INSERT INTO `MOVESET_MONSTROPOCHE` (`IdAttaque`, `IdMonstropoche`, `Position`) VALUES
(1, 2, '1'),
(1, 57, '3'),
(1, 75, '4'),
(2, 2, '2'),
(2, 57, '1'),
(3, 2, '3'),
(3, 57, '4'),
(3, 75, '3'),
(5, 2, '4'),
(5, 57, '2'),
(5, 75, '1'),
(13, 75, '2');

-- --------------------------------------------------------

--
-- Contenu de la table `HABITAT`
--

INSERT INTO `HABITAT` (`NumEspece`, `IdZone`) VALUES
(4, 1),
(5, 1),
(6, 1),
(13, 1),
(14, 1),
(15, 1),
(23, 1),
(50, 1),
(51, 1),
(120, 1),
(1, 2),
(22, 2),
(24, 2),
(10, 3),
(11, 3),
(21, 3),
(25, 3),
(26, 3),
(2, 4),
(3, 4),
(19, 4),
(649, 4),
(7, 5),
(8, 5),
(9, 5),
(16, 5),
(17, 5),
(18, 5),
(12, 6),
(20, 6),
(493, 6);

-- --------------------------------------------------------

--
-- Contenu de la table `LOCALISATION`
--

INSERT INTO `LOCALISATION` (`IdObjet`, `IdZone`) VALUES
(27, 2),
(24, 3),
(25, 3),
(24, 4),
(26, 15);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
