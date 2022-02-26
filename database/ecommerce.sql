-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 04 fév. 2022 à 17:56
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.2-dev

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot_de_passe` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `url-img` varchar(255) DEFAULT NULL,
  `nom-img` varchar(255) DEFAULT NULL,
  `date_de_naissance` date NOT NULL,
  `addresse` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `mot_de_passe`, `email`, `prenom`, `nom`, `url-img`, `nom-img`, `date_de_naissance`, `addresse`) VALUES
(1, '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin@gmail.com', 'admin', 'admin', 'app-assets/images/portrait/small/', 'avatar-s-1.jpg', '1998-02-24', 'alger');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot_de_passe` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `url-img` varchar(255) DEFAULT NULL,
  `nom-img` varchar(255) DEFAULT NULL,
  `date_de_naissance` date NOT NULL,
  `lieu_de_naissance` varchar(20) NOT NULL,
  `addresse` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse-de-facturation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `mot_de_passe`, `email`, `prenom`, `nom`, `url-img`, `nom-img`, `date_de_naissance`, `lieu_de_naissance`, `addresse`, `telephone`, `adresse-de-facturation`) VALUES
(1, '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'user@gmail.com', 'user', 'user', 'app-assets/images/portrait/small/', 'avatar-s-1.jpg', '1998-02-24', 'alger', 'alger', '0659460948', 'souidania alger'),
(2, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'moh@gmail.com', 'mo', 'sai', 'app-assets/images/portrait/small/', 'avatar-s-1.jpg', '2022-01-26', 'alger', 'alger', '0659460948', 'souidania zeralda algr');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_de_commande` date NOT NULL,
  `etat` varchar(30) NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idclient` (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date_de_commande`, `etat`, `idclient`) VALUES
(3, '2022-01-24', 'en commander', 1),
(4, '2022-01-31', 'en panier', 1),
(7, '2022-02-03', 'acceptee', 2),
(8, '2022-02-03', 'refusee', 2);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `Sujet` varchar(255) DEFAULT NULL,
  `idadmin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idadmin` (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `message`, `email`, `Sujet`, `idadmin`) VALUES
(18, 'Cisco', 'dd', 'user@gmail.com', 'dddd', 1),
(19, 'Sisco', 'dd', 'admin@gmail.com', 'cccccccc', 1),
(20, 'ccc', 'dd', 'moh@gmail.com', 'xddSEDFgsvv', 1),
(21, 'ccc', 'dd', 'moh@gmail.com', 'xddSEDFgsvv', 1),
(22, 'ccc', 'dd', 'moh@gmail.com', 'xddSEDFgsvv', 1),
(23, 'ccc', 'dd', 'moh@gmail.com', 'xddSEDFgsvv', 1),
(24, 'ccc', 'dd', 'moh@gmail.com', 'xddSEDFgsvv', 1),
(25, 'ccc', 'dd', 'moh@gmail.com', 'xddSEDFgsvv', 1);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_de_livraison` date DEFAULT NULL,
  `etat` varchar(255) NOT NULL,
  `idcommande` int(11) NOT NULL,
  `idadmin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idcommande_2` (`idcommande`),
  KEY `idcommande` (`idcommande`),
  KEY `idadmin` (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `date_de_livraison`, `etat`, `idcommande`, `idadmin`) VALUES
(8, '2022-02-25', 'en attendant', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` varchar(50) NOT NULL,
  `montane` varchar(50) NOT NULL,
  `idproduit` int(11) NOT NULL,
  `idcommande` int(11) NOT NULL,
  `idadmin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idproduit` (`idproduit`),
  KEY `idcommande` (`idcommande`),
  KEY `idadmin` (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `quantity`, `montane`, `idproduit`, `idcommande`, `idadmin`) VALUES
(6, '1', '16000', 11, 3, 1),
(7, '4', '64000', 11, 4, 1),
(10, '2', '32000', 11, 7, 1),
(11, '1', '6000', 10, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `Description` text NOT NULL,
  `Specification` text NOT NULL,
  `prix` varchar(20) NOT NULL,
  `url-img` varchar(255) DEFAULT NULL,
  `nom-img` varchar(255) DEFAULT NULL,
  `idadmin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idadmin` (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `contenu`, `Description`, `Specification`, `prix`, `url-img`, `nom-img`, `idadmin`) VALUES
(10, 'boite de stérilisation à uvc', 'Stérilisateur UV-C multifonctionnel qui tue jusqu\'à 99,9% des bactéries placées à l\'intérieur de l\'appareil. Il vous suffit de placer des objets comme des écouteurs, des bijoux, des montres et des masques à l\'intérieur pour les stériliser grâce à la technologie UV-C. Vous pouvez', '', '', '6000', 'assets/img/produit/', 'product-41.jpg', 1),
(11, 'concentrateur d\'oxygène sysmed', 'Le concentrateur à usage médical SysMed OC série d\'oxygène adopte le principe de la technologie d\'adsorption pour l\'oscillation de pression. À température normale, l\'appareil peut séparer en continu l\'oxygène médical à une concentration élevée de l\'air, lorsqu\'il est en fonctionnement. Le dispositif est facile à utiliser et rapidement prêt à l\'emploi, le débit peut être ajusté.\r\n\r\nConcentrateur rend ses forces haute fiabilité, le niveau d\'entretien bas et un niveau assez faible bruit.\r\nCela se traduit par une augmentation du poids et de la taille; en particulier, cependant, qui a une incidence par rapport à la machine, étant pourvue de roulettes pour faciliter le transport.\r\n\r\n', '', '', '16000', 'assets/img/produit/', 'Oxygen-Concentrator_2.jpg', 1),
(12, 'Le modèle YE660D', 'Yuweel ? tensiomètre numérique YE660D, mesure de la pression artérielle et du pouls du bras\r\n', '', '', '1500', 'assets/img/produit/', 'HTB1BFCUJXXXXXa7apXXq6xXFXXXI.jpg', 1),
(13, 'batonnet de stérilisation a Uvc', 'faite par le voyant LED lampe Ã  ultraviolet profonde perles.\r\nContient des ultra-fin de la puce ultra-fine.', 'aaaa', 'aaaa', '800', 'assets/img/produit/', 'Hb7297d19c1c9481888930be099bd4c18k.jpg', 1),
(14, 'Concentrateur d\'oxygène kongsong', 'Notre concentrateur d\'oxygène médical adopte le principe mondial avancé du PSA, fournit de l\'oxygène standard de l\'industrie médicale par des molécules d\'oxygène séparées et filtrées et des molécules d\'azote de l\'air directement à température ambiante. Il produit de l\'oxygène de manière purement physique, sans aucun additif, sans aucun approvisionnement, sans pollution de l\'environnement, frais et naturel.\r\n', '', '', '16000', 'assets/img/produit/', 'High-flow-10L-oxygen-concentrator-dual-flow-for-tw1.jpg', 1),
(17, 'Nébuliseur à Compresseur YUWELL 405B Portable', 'Le corps d?une taille de la paume pèse seulement 240g, c?est une innovation révolutionnaire\r\nInjecter les médicaments à travers l?atomisation en respectant les prescriptions du médecin permet de soulager une variété de maladies respiratoires supérieures et inférieures\r\nPortable, facile à stocker, élégant, plus aimable\r\nOpération simple, sans entretien quotidien, utilisation par plus de 6 millions de personnes, qualité de conscience\r\nFiable, faible taux de défaillance, longue durée de vie', '', '', '8000', 'assets/img/produit/', '71w11WIdw6L._AC_SL1500_.jpg', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `admin_ibfk_4` FOREIGN KEY (`idadmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `admin_ibfk_3` FOREIGN KEY (`idadmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`idcommande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idadmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idcommande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idproduit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`idadmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
