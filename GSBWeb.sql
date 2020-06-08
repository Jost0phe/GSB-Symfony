-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 08 Juin 2020 à 00:28
-- Version du serveur :  5.7.30-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `GSBWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(1, 'CL');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_frais`
--

CREATE TABLE `fiche_frais` (
  `id` int(11) NOT NULL,
  `visiteur_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `libelle` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mois` date NOT NULL,
  `nb_justificatifs` int(11) NOT NULL,
  `montant_valide` decimal(10,2) NOT NULL,
  `date_modif` date NOT NULL,
  `etp` double NOT NULL,
  `km` double NOT NULL,
  `nui` double NOT NULL,
  `rep` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `fiche_frais`
--

INSERT INTO `fiche_frais` (`id`, `visiteur_id`, `etat_id`, `libelle`, `mois`, `nb_justificatifs`, `montant_valide`, `date_modif`, `etp`, `km`, `nui`, `rep`) VALUES
(2, 1, 1, NULL, '2020-06-07', 0, '160.00', '2020-06-07', 40, 40, 40, 40),
(3, 1, 1, NULL, '2020-06-07', 0, '200.00', '2020-06-07', 50, 50, 50, 50),
(4, 1, 1, NULL, '2020-06-07', 0, '200.00', '2020-06-07', 50, 50, 50, 50),
(5, 1, 1, NULL, '2020-06-07', 0, '7607.00', '2020-06-07', 28, 27, 278, 7274);

-- --------------------------------------------------------

--
-- Structure de la table `frais_forfait`
--

CREATE TABLE `frais_forfait` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais_forfait`
--

CREATE TABLE `ligne_frais_forfait` (
  `id` int(11) NOT NULL,
  `visiteur_id` int(11) NOT NULL,
  `frais_forfait_id` int(11) NOT NULL,
  `mois` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais_hors_forfait`
--

CREATE TABLE `ligne_frais_hors_forfait` (
  `id` int(11) NOT NULL,
  `visiteur_id` int(11) NOT NULL,
  `mois_id` int(11) NOT NULL,
  `libelle` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `montant` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200607173434', '2020-06-07 17:34:37');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_embauche` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `date_embauche`) VALUES
(1, 'Jonathan', 'Finck', 'jfinck', 'mpb3t', '6 Rue des Lilas', '75001', 'Paris', '2012-03-20');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5FC0A6A77F72333D` (`visiteur_id`),
  ADD KEY `IDX_5FC0A6A7D5E86FF` (`etat_id`);

--
-- Index pour la table `frais_forfait`
--
ALTER TABLE `frais_forfait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligne_frais_forfait`
--
ALTER TABLE `ligne_frais_forfait`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BD293ECF7B70375E` (`frais_forfait_id`),
  ADD KEY `IDX_BD293ECF7F72333D` (`visiteur_id`);

--
-- Index pour la table `ligne_frais_hors_forfait`
--
ALTER TABLE `ligne_frais_hors_forfait`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EC01626D7F72333D` (`visiteur_id`),
  ADD UNIQUE KEY `UNIQ_EC01626DFA0749B8` (`mois_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `frais_forfait`
--
ALTER TABLE `frais_forfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ligne_frais_forfait`
--
ALTER TABLE `ligne_frais_forfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ligne_frais_hors_forfait`
--
ALTER TABLE `ligne_frais_hors_forfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD CONSTRAINT `FK_5FC0A6A77F72333D` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id`),
  ADD CONSTRAINT `FK_5FC0A6A7D5E86FF` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`);

--
-- Contraintes pour la table `ligne_frais_forfait`
--
ALTER TABLE `ligne_frais_forfait`
  ADD CONSTRAINT `FK_BD293ECF7B70375E` FOREIGN KEY (`frais_forfait_id`) REFERENCES `frais_forfait` (`id`),
  ADD CONSTRAINT `FK_BD293ECF7F72333D` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id`);

--
-- Contraintes pour la table `ligne_frais_hors_forfait`
--
ALTER TABLE `ligne_frais_hors_forfait`
  ADD CONSTRAINT `FK_EC01626D7F72333D` FOREIGN KEY (`visiteur_id`) REFERENCES `fiche_frais` (`id`),
  ADD CONSTRAINT `FK_EC01626DFA0749B8` FOREIGN KEY (`mois_id`) REFERENCES `fiche_frais` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
