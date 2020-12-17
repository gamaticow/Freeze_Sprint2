-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 17 déc. 2020 à 23:55
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `20inf2pj_td21g2`
--
CREATE DATABASE IF NOT EXISTS `20inf2pj_td21g2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `20inf2pj_td21g2`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id_Art` int(11) NOT NULL,
  `Nom_Article` varchar(255) NOT NULL,
  `Cont_Art` text NOT NULL,
  `Auteur_Art` int(11) NOT NULL,
  `Date_Art` datetime NOT NULL,
  `Theme_Art` varchar(50) DEFAULT NULL,
  `Resume_Art` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `Id_Cli` int(11) NOT NULL,
  `Pseudo_Cli` varchar(50) NOT NULL,
  `Mdp_Cli` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE `droit` (
  `Id_Art` int(11) NOT NULL,
  `Id_Cli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

CREATE TABLE `motcle` (
  `Id_Art` int(11) NOT NULL,
  `Mot_Cle_Art` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id_Art`),
  ADD KEY `Auteur_Art` (`Auteur_Art`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id_Cli`),
  ADD UNIQUE KEY `Pseudo_Cli` (`Pseudo_Cli`);

--
-- Index pour la table `droit`
--
ALTER TABLE `droit`
  ADD KEY `Id_Art` (`Id_Art`),
  ADD KEY `Id_Cli` (`Id_Cli`);

--
-- Index pour la table `motcle`
--
ALTER TABLE `motcle`
  ADD KEY `Id_Art` (`Id_Art`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id_Art` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `Id_Cli` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `ARTICLE_ibfk_1` FOREIGN KEY (`Auteur_Art`) REFERENCES `client` (`Id_Cli`);

--
-- Contraintes pour la table `droit`
--
ALTER TABLE `droit`
  ADD CONSTRAINT `DROIT_ibfk_1` FOREIGN KEY (`Id_Art`) REFERENCES `article` (`Id_Art`),
  ADD CONSTRAINT `DROIT_ibfk_2` FOREIGN KEY (`Id_Cli`) REFERENCES `client` (`Id_Cli`);

--
-- Contraintes pour la table `motcle`
--
ALTER TABLE `motcle`
  ADD CONSTRAINT `MOTCLE_ibfk_1` FOREIGN KEY (`Id_Art`) REFERENCES `article` (`Id_Art`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
