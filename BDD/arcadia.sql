-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 20 nov. 2024 à 21:01
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
-- Base de données : `arcadia`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin1', 'password1', 'admin1@zooarcadia.com'),
(2, 'admin2', 'password2', 'admin2@zooarcadia.com');

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `race` varchar(50) NOT NULL,
  `etat_animal` varchar(100) NOT NULL,
  `nourriture_proposee` varchar(100) NOT NULL,
  `grammage_nourriture` int(11) NOT NULL,
  `date_passage` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `prenom`, `race`, `etat_animal`, `nourriture_proposee`, `grammage_nourriture`, `date_passage`) VALUES
(1, 'Leo', 'Lion', 'En bonne santé', 'Viande', 5000, '2023-10-10 10:00:00'),
(2, 'Tiggy', 'Tigre', 'En bonne santé', 'Viande', 4500, '2023-10-11 11:00:00'),
(3, 'Ellie', 'Éléphant', 'En bonne santé', 'Herbes', 10000, '2023-10-12 09:00:00'),
(4, 'Leo', 'Lion', 'En bonne santé', 'Viande', 5000, '2023-10-10 10:00:00'),
(5, 'Tiggy', 'Tigre', 'En bonne santé', 'Viande', 4500, '2023-10-11 11:00:00'),
(6, 'Ellie', 'Éléphant', 'En bonne santé', 'Herbes', 10000, '2023-10-12 09:00:00'),
(7, 'Zara', 'Zèbre', 'En bonne santé', 'Foin', 3000, '2023-10-13 08:00:00'),
(8, 'Gerry', 'Girafe', 'En bonne santé', 'Feuilles', 7000, '2023-10-14 07:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_avis` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `admin_id`, `commentaire`, `date_avis`) VALUES
(1, 1, 'Très bon service et personnel accueillant.', '2023-10-20 14:30:00'),
(2, 2, 'Les animaux semblent bien soignés et heureux.', '2023-10-21 16:45:00');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_contact` datetime NOT NULL,
  `motif` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `email`, `message`, `date_contact`, `motif`, `description`) VALUES
(1, 'Alice', 'alice@example.com', 'Bonjour, j\'aimerais en savoir plus sur les horaires d\'ouverture.', '2023-10-15 08:30:00', NULL, NULL),
(2, 'Bob', 'bob@example.com', 'J\'ai perdu un objet lors de ma visite, pouvez-vous m\'aider à le retrouver ?', '2023-10-16 09:45:00', NULL, NULL),
(3, '', 'HAMIDMAHAMAT04@gmail.com', '', '2024-11-17 19:01:59', 'visiter les zoo', 'je souhaite visite le zooo arcadia'),
(4, '', 'toto@gmail.com', '', '2024-11-17 19:04:55', 'visiter les zoo', 'Bonjour je souhaite savoir si vous etez ouvert lundi?'),
(5, '', 'toto@gmail.com', '', '2024-11-17 19:08:06', 'visiter les zoo', 'bonsoir');

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `motif` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`id`, `nom`, `prenom`, `role`, `email`, `telephone`, `motif`) VALUES
(1, 'Dupont', 'Jean', 'Gardien', 'jean.dupont@zooarcadia.com', '0123456789', NULL),
(2, 'Martin', 'Sophie', 'Guide', 'sophie.martin@zooarcadia.com', '0987654321', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quantite_disponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `food`
--

INSERT INTO `food` (`id`, `nom`, `type`, `quantite_disponible`) VALUES
(1, 'Viande de boeuf', 'Viande', 1000),
(2, 'Herbes fraîches', 'Plante', 2000),
(3, 'Viande de boeuf', 'Viande', 1000),
(4, 'Herbes fraîches', 'Plante', 2000),
(5, 'Foin', 'Plante', 1500),
(6, 'Feuilles d\'acacia', 'Plante', 500),
(7, 'Poisson', 'Viande', 800);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `description`, `prix`) VALUES
(1, 'Billeterie', 'Vente de billets d\'entrée', 15.00),
(2, 'Petit Train', 'Tour guidé en petit train', 5.00);

-- --------------------------------------------------------

--
-- Structure de la table `soins`
--

CREATE TABLE `soins` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `veterinaire_id` int(11) NOT NULL,
  `date_soin` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `soins`
--

INSERT INTO `soins` (`id`, `animal_id`, `veterinaire_id`, `date_soin`, `description`) VALUES
(1, 1, 1, '2023-11-01 14:00:00', 'Examen général'),
(2, 2, 2, '2023-11-02 15:00:00', 'Vaccination');

-- --------------------------------------------------------

--
-- Structure de la table `veterinaire`
--

CREATE TABLE `veterinaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `specialite` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `veterinaire`
--

INSERT INTO `veterinaire` (`id`, `nom`, `prenom`, `email`, `telephone`, `specialite`) VALUES
(1, 'Durand', 'Pierre', 'pierre.durand@zooarcadia.com', '0123456780', 'Mammifères'),
(2, 'Lefevre', 'Camille', 'camille.lefevre@zooarcadia.com', '0987654322', 'Oiseaux');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `soins`
--
ALTER TABLE `soins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `veterinaire_id` (`veterinaire_id`);

--
-- Index pour la table `veterinaire`
--
ALTER TABLE `veterinaire`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `soins`
--
ALTER TABLE `soins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `veterinaire`
--
ALTER TABLE `veterinaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `soins`
--
ALTER TABLE `soins`
  ADD CONSTRAINT `soins_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `soins_ibfk_2` FOREIGN KEY (`veterinaire_id`) REFERENCES `veterinaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
