-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 juil. 2023 à 16:29
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bib_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `ID_Categorie` int(11) NOT NULL,
  `nom_categorie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`ID_Categorie`, `nom_categorie`) VALUES
(1, 'Science-fiction'),
(2, 'Romance'),
(3, 'Mystère');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `ID_Emprunt` int(11) NOT NULL,
  `ID_Livre` int(11) DEFAULT NULL,
  `ID_Membre` int(11) DEFAULT NULL,
  `Date_Emprunt` date NOT NULL,
  `Date_Retour` date DEFAULT NULL,
  `Statut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `ID_Livre` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Auteur` varchar(255) NOT NULL,
  `Année_de_publication` year(4) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `ID_Categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`ID_Livre`, `Titre`, `Auteur`, `Année_de_publication`, `ISBN`, `ID_Categorie`) VALUES
(1, 'Fondation', 'Isaac Asimov', 1951, '9780553803716', 1),
(2, 'Orgueil et Préjugés', 'Jane Austen', 0000, '9780141439518', 2),
(3, 'Le Nom de la Rose', 'Umberto Eco', 1980, '9782070372018', 3),
(4, '1984', 'George Orwell', 1949, '9780451524935', 1),
(5, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', 1954, '9782266282390', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `ID_Membre` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prénom` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Numéro_de_téléphone` varchar(20) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `réservations`
--

CREATE TABLE `réservations` (
  `ID_Reservation` int(11) NOT NULL,
  `ID_Livre` int(11) DEFAULT NULL,
  `ID_Membre` int(11) DEFAULT NULL,
  `Date_Reservation` date NOT NULL,
  `Statut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID_Categorie`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`ID_Emprunt`),
  ADD KEY `ID_Livre` (`ID_Livre`),
  ADD KEY `ID_Membre` (`ID_Membre`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`ID_Livre`),
  ADD KEY `ID_Categorie` (`ID_Categorie`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`ID_Membre`);

--
-- Index pour la table `réservations`
--
ALTER TABLE `réservations`
  ADD PRIMARY KEY (`ID_Reservation`),
  ADD KEY `ID_Livre` (`ID_Livre`),
  ADD KEY `ID_Membre` (`ID_Membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID_Categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `ID_Emprunt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `ID_Livre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `ID_Membre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `réservations`
--
ALTER TABLE `réservations`
  MODIFY `ID_Reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`ID_Livre`) REFERENCES `livres` (`ID_Livre`),
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`ID_Membre`) REFERENCES `membres` (`ID_Membre`);

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `livres_ibfk_1` FOREIGN KEY (`ID_Categorie`) REFERENCES `categories` (`ID_Categorie`);

--
-- Contraintes pour la table `réservations`
--
ALTER TABLE `réservations`
  ADD CONSTRAINT `réservations_ibfk_1` FOREIGN KEY (`ID_Livre`) REFERENCES `livres` (`ID_Livre`),
  ADD CONSTRAINT `réservations_ibfk_2` FOREIGN KEY (`ID_Membre`) REFERENCES `membres` (`ID_Membre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
