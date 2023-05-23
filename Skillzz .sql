-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 23 mai 2023 à 21:13
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Skillzz`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `mailA` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`nom`, `prénom`, `mailA`, `mdp`) VALUES
('deviez', 'laurent', 'laurent.debize@gmail.com', 'laurentdebize10');

-- --------------------------------------------------------

--
-- Structure de la table `Association`
--

CREATE TABLE `Association` (
  `nomCompT` varchar(255) NOT NULL,
  `nomMatière` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Association`
--

INSERT INTO `Association` (`nomCompT`, `nomMatière`) VALUES
('arduino', 'elec 1'),
('arduino', 'elec 2'),
('DES ', 'elec 2'),
('DES', 'maths 1'),
('intégral', 'elec 2'),
('intégral', 'maths 2'),
('intégral ', 'physique 2');

-- --------------------------------------------------------

--
-- Structure de la table `Classe`
--

CREATE TABLE `Classe` (
  `numClasse` int(20) NOT NULL,
  `numPromo` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Classe`
--

INSERT INTO `Classe` (`numClasse`, `numPromo`) VALUES
(1, 2026),
(2, 2026),
(3, 2026),
(4, 2027),
(5, 2027),
(6, 2027);

-- --------------------------------------------------------

--
-- Structure de la table `CompTransverse`
--

CREATE TABLE `CompTransverse` (
  `nomCompT` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `evalProf` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CompTransverse`
--

INSERT INTO `CompTransverse` (`nomCompT`, `description`, `evalProf`) VALUES
('arduino', 'gérer arduino', 1),
('DES', 'savoir faire les DES', 1),
('intégral', 'savoir utiliser les intégrales', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Compétence`
--

CREATE TABLE `Compétence` (
  `nomComp` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `nomMatière` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Compétence`
--

INSERT INTO `Compétence` (`nomComp`, `descriptions`, `nomMatière`) VALUES
('AOP', 'connaître les AOP', 'elec 1'),
('Bode', 'faire un diagramme de Bode', 'elec 2'),
('DL', 'développements limités', 'maths 1'),
('Kicad', 'logiciel KiCad', 'elec 2'),
('Maxwell', 'Maxwell farday\r\nMaxwell Ampère\r\nMaxwell Flux\r\nMaxwell Gauss\r\n', 'physique 2'),
('NE555', 'utiliser le NE555', 'elec 1'),
('Quartus', 'gérer le logiciel qu\'argus', 'elec 2'),
('Scilab', 'Utiliser le logiciel Scilab ', 'elec 2'),
('Transistor', 'comprendre le fonctionnement d\'un transistor', 'elec 2');

-- --------------------------------------------------------

--
-- Structure de la table `Elève`
--

CREATE TABLE `Elève` (
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `mailE` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `école` varchar(255) NOT NULL,
  `numClasse` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Elève`
--

INSERT INTO `Elève` (`nom`, `prénom`, `mailE`, `mdp`, `école`, `numClasse`) VALUES
('jolie', 'Angelina', 'Angelina.jolie@gmail.com', 'angelinajolie10', 'ece', 3),
('franck', 'etienne', 'Etienne.franck@gmail.com', 'etiennefranck10', 'ece', 1),
('richard', 'paul', 'paul.richard@gmail.com', 'paulrichard10', 'ece', 1),
('cruise', 'tom', 'tom.cruise@gmail.com', 'tomcruise10', 'ece', 4);

-- --------------------------------------------------------

--
-- Structure de la table `Enseigné`
--

CREATE TABLE `Enseigné` (
  `mailP` varchar(255) NOT NULL,
  `numClasse` int(20) NOT NULL,
  `nomMatière` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Enseigné`
--

INSERT INTO `Enseigné` (`mailP`, `numClasse`, `nomMatière`) VALUES
('Eric.dupond@gmail.com', 1, 'elec 2'),
('Eric.dupond@gmail.com', 2, 'elec 2'),
('Eric.dupond@gmail.com', 3, 'elec 2'),
('Eric.dupond@gmail.com', 4, 'elec 1'),
('jean.martin@gmail.com', 2, 'physique 2'),
('jean.moulin@gmail.com', 2, 'maths 2'),
('tony.stark@gmail.com', 4, 'maths 1'),
('tony.stark@gmail.com', 5, 'maths 1');

-- --------------------------------------------------------

--
-- Structure de la table `Evaluation`
--

CREATE TABLE `Evaluation` (
  `demandeur` varchar(255) NOT NULL,
  `receveur` varchar(255) NOT NULL,
  `compétence` varchar(255) NOT NULL,
  `dateEval` date DEFAULT NULL,
  `matière` varchar(255) NOT NULL,
  `evalEleve` int(4) DEFAULT NULL,
  `evalProf` int(11) DEFAULT NULL,
  `commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Evaluation`
--

INSERT INTO `Evaluation` (`demandeur`, `receveur`, `compétence`, `dateEval`, `matière`, `evalEleve`, `evalProf`, `commentaire`) VALUES
('Eric.dupond@gmail.com', 'angelina.jolie@gmail.com', 'Bode', '2023-05-28', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'angelina.jolie@gmail.com', 'KiCad', '2023-05-23', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'Angelina.jolie@gmail.com', 'Quartus', '2023-05-27', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'etienne.franck@gmail.com', 'Bode', '2023-05-28', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'etienne.franck@gmail.com', 'KiCad', '2023-05-23', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'etienne.franck@gmail.com', 'Quartus', '2023-05-27', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'etienne.franck@gmail.com', 'Scilab', '2023-05-20', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'paul.richard@gmail.com', 'Bode', '2023-05-28', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'paul.richard@gmail.com', 'KiCad', '2023-05-23', 'elec 2', NULL, NULL, NULL),
('Eric.dupond@gmail.com', 'paul.richard@gmail.com', 'Quartus', '2023-05-27', 'elec 2', 3, 3, 'oui '),
('Eric.dupond@gmail.com', 'paul.richard@gmail.com', 'Scilab', '2023-05-19', 'elec 2', 2, 3, NULL),
('Eric.dupond@gmail.com', 'paul.richard@gmail.com', 'Transistor', NULL, 'elec 2', 3, NULL, NULL),
('jean.martin@gmail.com', 'paul.richard@gmail.com', 'Maxwell', '2023-05-23', 'physique 2', NULL, NULL, NULL),
('laurent.debize@gmail.com', 'angelina.jolie@gmail.com', 'intégral', '2023-05-31', 'compT', NULL, NULL, NULL),
('laurent.debize@gmail.com', 'Eric.dupond@gmail.com', 'AOP', '2023-06-22', 'elec 1', NULL, NULL, NULL),
('laurent.debize@gmail.com', 'etienne.franck@gmail.com', 'intégral', '2023-05-31', 'compT', NULL, NULL, NULL),
('laurent.debize@gmail.com', 'paul.richard@gmail.com', 'intégral', '2023-05-31', 'compT', NULL, 0, ''),
('laurent.debize@gmail.com', 'tom.cruise@gmail.com', 'DES', '2023-06-11', 'compT', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Matière`
--

CREATE TABLE `Matière` (
  `nomMatière` varchar(255) NOT NULL,
  `volumeH` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Matière`
--

INSERT INTO `Matière` (`nomMatière`, `volumeH`) VALUES
('allemand', 6),
('elec 1', 10),
('elec 2', 8),
('espagnol ', 4),
('info 1', 8),
('info 2', 7),
('maths 1', 10),
('maths 2', 8),
('physique 1', 7),
('physique 2', 12);

-- --------------------------------------------------------

--
-- Structure de la table `Prof`
--

CREATE TABLE `Prof` (
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `mailP` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Prof`
--

INSERT INTO `Prof` (`nom`, `prénom`, `mailP`, `mdp`) VALUES
('Eric', 'dupond', 'Eric.dupond@gmail.com', 'ericdupond10'),
('martin', 'jean', 'jean.martin@gmail.com', 'jeanmartin10'),
('Moulin', 'Jean', 'jean.moulin@gmail.com', 'jeanmoulin10'),
('Stark', 'Tony', 'tony.stark@gmail.com', 'tonystark10');

-- --------------------------------------------------------

--
-- Structure de la table `Promo`
--

CREATE TABLE `Promo` (
  `numPromo` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Promo`
--

INSERT INTO `Promo` (`numPromo`) VALUES
(2026),
(2027);

-- --------------------------------------------------------

--
-- Structure de la table `suiviMatière`
--

CREATE TABLE `suiviMatière` (
  `mailE` varchar(255) NOT NULL,
  `nomMatière` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `suiviMatière`
--

INSERT INTO `suiviMatière` (`mailE`, `nomMatière`) VALUES
('Angelina.jolie@gmail.com', 'elec 2'),
('Angelina.jolie@gmail.com', 'maths 2'),
('Angelina.jolie@gmail.com', 'physique 2'),
('Etienne.franck@gmail.com', 'elec 2'),
('Etienne.franck@gmail.com', 'maths 2'),
('Etienne.franck@gmail.com', 'physique 2'),
('paul.richard@gmail.com', 'elec 2'),
('paul.richard@gmail.com', 'physique 2'),
('tom.cruise@gmail.com', 'elec 1'),
('tom.cruise@gmail.com', 'espagnol'),
('tom.cruise@gmail.com', 'maths 1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`mailA`);

--
-- Index pour la table `Association`
--
ALTER TABLE `Association`
  ADD PRIMARY KEY (`nomCompT`,`nomMatière`);

--
-- Index pour la table `Classe`
--
ALTER TABLE `Classe`
  ADD PRIMARY KEY (`numClasse`,`numPromo`);

--
-- Index pour la table `CompTransverse`
--
ALTER TABLE `CompTransverse`
  ADD PRIMARY KEY (`nomCompT`);

--
-- Index pour la table `Compétence`
--
ALTER TABLE `Compétence`
  ADD PRIMARY KEY (`nomComp`,`nomMatière`);

--
-- Index pour la table `Elève`
--
ALTER TABLE `Elève`
  ADD PRIMARY KEY (`mailE`,`numClasse`);

--
-- Index pour la table `Enseigné`
--
ALTER TABLE `Enseigné`
  ADD PRIMARY KEY (`mailP`,`numClasse`,`nomMatière`);

--
-- Index pour la table `Evaluation`
--
ALTER TABLE `Evaluation`
  ADD PRIMARY KEY (`demandeur`,`receveur`,`compétence`,`matière`);

--
-- Index pour la table `Matière`
--
ALTER TABLE `Matière`
  ADD PRIMARY KEY (`nomMatière`);

--
-- Index pour la table `Prof`
--
ALTER TABLE `Prof`
  ADD PRIMARY KEY (`mailP`);

--
-- Index pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD PRIMARY KEY (`numPromo`);

--
-- Index pour la table `suiviMatière`
--
ALTER TABLE `suiviMatière`
  ADD PRIMARY KEY (`mailE`,`nomMatière`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
