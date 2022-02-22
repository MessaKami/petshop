-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 22 fév. 2022 à 00:39
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `accept_st`
--

DROP TABLE IF EXISTS `accept_st`;
CREATE TABLE IF NOT EXISTS `accept_st` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_a` varchar(150) NOT NULL,
  `int_a` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accept_st`
--

INSERT INTO `accept_st` (`id`, `name_a`, `int_a`) VALUES
(1, 'accepter', 3),
(2, 'en attente', 2),
(3, 'en attente de verification', 1),
(4, 'refuser', 0);

-- --------------------------------------------------------

--
-- Structure de la table `adoptions`
--

DROP TABLE IF EXISTS `adoptions`;
CREATE TABLE IF NOT EXISTS `adoptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `padoptions_name` varchar(150) NOT NULL,
  `padoptions_lastname` varchar(120) NOT NULL,
  `date_of_take` date NOT NULL,
  `padoptions_email` varchar(150) NOT NULL,
  `padoptions_phonenumber` varchar(150) NOT NULL,
  `accept` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pets`
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `race` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `pets_image` text NOT NULL,
  `date_of_disponibility` date NOT NULL,
  `location` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pets`
--

INSERT INTO `pets` (`id`, `name`, `race`, `description`, `pets_image`, `date_of_disponibility`, `location`) VALUES
(8, 'Madara', 'Chat', 'Test qfqfsf', 'kekofifanul_cool_tt.jpg', '2022-02-26', 'Apt 84400'),
(9, 'Madara', 'Chat', 'Test qfqfsf', 'kekofifanul_cool_tt.jpg', '2022-02-26', 'Apt 84400'),
(10, 'Madara', 'Chat', 'Test qfqfsf', 'kekofifanul_cool_tt.jpg', '2022-02-26', 'Apt 84400'),
(11, 'Madara', 'Chat', 'Test qfqfsf', 'kekofifanul_cool_tt.jpg', '2022-02-26', 'Apt 84400'),
(12, 'Madara', 'Chat', 'Test qfqfsf', 'kekofifanul_cool_tt.jpg', '2022-02-26', 'Apt 84400'),
(13, 'Madara', 'Chat', 'Test qfqfsf', 'kekofifanul_cool_tt.jpg', '2022-02-26', 'Apt 84400');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pdp` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phonenumber` varchar(150) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pdp`, `name`, `lastname`, `email`, `password`, `phonenumber`, `admin`) VALUES
(3, 'user_keko.png', 'Hanis', 'Wuarnier', 'kekopupule@outlook.fr', '$2y$10$Mc3zD0f/rAJrhhkHPgWQ1.G9fhveOKSX2VOpocAxKeZuJX.R3MmS2', '0601332305', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
