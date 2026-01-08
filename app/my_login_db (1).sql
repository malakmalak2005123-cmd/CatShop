-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 nov. 2025 à 15:25
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_login_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `image` varchar(80) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `sexe` enum('Male','Female') DEFAULT NULL,
  `description_courte` text DEFAULT NULL,
  `caracteristiques` text DEFAULT NULL,
  `prix` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image`, `name`, `age`, `sexe`, `description_courte`, `caracteristiques`, `prix`, `Type`) VALUES
(12, 'image6.png', 'lily', '2 mois', 'Female', 'Très douce, adore les caresses et s’entend avec d’autres chats.', 'Vaccinée', '2 500 MAD', 'Scottish Fold'),
(13, 'image1.png', 'bagira', '5 mois', 'Male', 'Très sociable. adore les câlins et suivre son humain partout.', 'Vaccinée', '4 000 MAD', 'British Shorthair'),
(14, 'image2.png', 'simba', '2 ans', 'Male', 'Très affectueux et calme', 'Vacciné', '7 000 MAD', 'Maine Coon'),
(15, 'image3.png', 'noura', '1 an', 'Female', 'Douce et curieuse , aime les coins tranquilles et les siestes au soleil.', 'Vaccinée', '5 200 MAD', 'Persan (Persian)'),
(16, 'image4.png', 'marcelin', '3 mois', 'Female', 'Très énergique, adore jouer avec balles et cordes, très curieux.', 'Vacciné', '9 00 MAD', 'European Shorthair'),
(17, 'image5.png', 'bimo', '1 mois', 'Male', 'Très calme et sociable', 'Vacciné, stérilisé', '2 500 MAD', 'Siamoise'),
(19, 'WhatsApp Image 2025-10-12 à 03.14.03_884c44ec.jpg', 'yopy', '1 ', 'Female', 'gentille', 'vaccine', '9 000 MAD', 'null');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'malak', 'mluh@gmail.com', '$2y$10$NDGEo0Uz0oIeG81c2AssGeVA2IQ71Al5NCwXCradTD7mBE9ThQUeS', 'admin'),
(2, 'malak', 'mluh@gmail.com', '$2y$10$XtbpMJtYqACQCjv.pmayTuQZ2YOdGfPRjegG0Nc/FRUhK0Ncszzua', 'user'),
(3, 'malak', 'malak@gmail.com', '$2y$10$AEOomtTJBWaW9bkboVqfleeYYJQf3YkTa30LGbkmd6zUs..l6Y1d6', 'user'),
(4, 'malak', 'malak@gmail.com', '$2y$10$nXgyGaX1Bk7LAgeYpj9g/eppv6k5wmVbPIvlYbZiHfiaBbrpgNkRi', 'user'),
(6, 'emmy', 'emmy@gmail.com', '$2y$10$RUIcyTD961hdTc5mKmeWWO7Lypi.0tOFdtZfzew4TOZgyBYvxfTOG', 'user'),
(7, 'abdel9ader', 'abdel9ader@gmail.com', '$2y$10$OrFZEaw9h7JZrDQrHffS2OgqA.VXSJ3WV67MPzNUovK04E3uHh61.', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
