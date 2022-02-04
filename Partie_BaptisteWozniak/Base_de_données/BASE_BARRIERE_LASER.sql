-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 02 fév. 2022 à 19:20
-- Version du serveur :  10.5.12-MariaDB-0+deb11u1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `BASE_BARRIERE_LASER`
--

-- --------------------------------------------------------

--
-- Structure de la table `Alertes`
--

CREATE TABLE `Alertes` (
  `idAlertes` int(11) NOT NULL,
  `instantAlerte` datetime DEFAULT NULL,
  `alerteEnCours` tinyint(4) DEFAULT NULL,
  `messageAlerte` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Campagne`
--

CREATE TABLE `Campagne` (
  `idCampagne` int(11) NOT NULL,
  `Description` longtext DEFAULT NULL,
  `Longitude` varchar(50) DEFAULT NULL,
  `Latitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Mesures`
--

CREATE TABLE `Mesures` (
  `idMesures` int(11) NOT NULL,
  `instantMesure` datetime DEFAULT NULL,
  `intervalle_T11-T12` int(11) DEFAULT NULL,
  `intervalle_T11-T21` int(11) DEFAULT NULL,
  `Camp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Parametres`
--

CREATE TABLE `Parametres` (
  `idParametres` int(11) NOT NULL,
  `distanceInterBarrieres` float DEFAULT NULL,
  `repertoireImages` varchar(255) DEFAULT NULL,
  `ipServeur` varchar(15) DEFAULT NULL,
  `ipCam1` varchar(15) DEFAULT NULL,
  `ipCam2` varchar(15) DEFAULT NULL,
  `ipModuleAcquisition` varchar(15) DEFAULT NULL,
  `WIFI_SSID` varchar(50) DEFAULT NULL,
  `WIFI_KEY` varchar(50) DEFAULT NULL,
  `niveauBatterie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `privileges` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Alertes`
--
ALTER TABLE `Alertes`
  ADD PRIMARY KEY (`idAlertes`);

--
-- Index pour la table `Campagne`
--
ALTER TABLE `Campagne`
  ADD PRIMARY KEY (`idCampagne`);

--
-- Index pour la table `Mesures`
--
ALTER TABLE `Mesures`
  ADD PRIMARY KEY (`idMesures`),
  ADD KEY `Camp` (`Camp`);

--
-- Index pour la table `Parametres`
--
ALTER TABLE `Parametres`
  ADD PRIMARY KEY (`idParametres`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Mesures`
--
ALTER TABLE `Mesures`
  ADD CONSTRAINT `Mesures_ibfk_1` FOREIGN KEY (`Camp`) REFERENCES `Campagne` (`idCampagne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
