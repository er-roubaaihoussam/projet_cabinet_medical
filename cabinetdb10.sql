-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 19 fév. 2022 à 23:38
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cabinetdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `ant`
--

CREATE TABLE `ant` (
  `idAnt` int(11) NOT NULL,
  `idCompte` int(11) NOT NULL,
  `maladie` varchar(100) NOT NULL,
  `typ` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ant`
--

INSERT INTO `ant` (`idAnt`, `idCompte`, `maladie`, `typ`) VALUES
(1, 1, 'mal1', 'Personnel'),
(2, 1, 'mal2', 'Familial et Personnel'),
(3, 1, 'mal3', 'Familial');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `IdCompte` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `TypeCompte` varchar(20) NOT NULL,
  `PrenomUser` varchar(50) NOT NULL,
  `NomUser` varchar(50) NOT NULL,
  `TelephoneUser` varchar(9) NOT NULL,
  `NaissanceUser` date NOT NULL,
  `addressUser` varchar(150) NOT NULL,
  `CinUser` varchar(15) NOT NULL,
  `SexeUser` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`IdCompte`, `Email`, `Password`, `TypeCompte`, `PrenomUser`, `NomUser`, `TelephoneUser`, `NaissanceUser`, `addressUser`, `CinUser`, `SexeUser`, `Ville`) VALUES
(1, 'mohamed@gmail.com', 'mohamed', 'patient', 'Mohamed', 'GI2021', '067777777', '2021-12-24', 'blalab d', 'LB333333', '0', NULL),
(2, 'docteur-mohamed@gmail.com', 'docteur', 'medecin', 'docteur', 'mohamed', '061234567', '2022-01-09', 'bla', 'LN121212', '0', 'EL KELAA DES SRAGHNA'),
(3, 'secretaire-amina@gmail.com', 'secretaire', 'secretaire', 'secretaire', 'amina', '068765432', '2021-12-08', 'bl', 'LN121213', '1', 'EL HAJEB'),
(4, 'mohamed2@gmail.com', 'mohamed2', 'patient', 'mohamed', 'Mohamed2', '067878778', '2022-01-06', 'Hay Salam Groupe D Rue QS No 56', 'LB311212', '0', 'CASABLANCA'),
(5, 'salma@gmail.com', 'salma', 'patient', 'salma', 'patient2', '062323232', '2022-01-11', 'lsalslqmlsqsqlmqsmlmlqsml', 'LN332323', 'Femme', 'CASABLANCA'),
(6, 'mohamedtest@gmail.com', '000', 'patient', 'test', 'mohamedtest', '067777777', '2022-01-27', 'haysyqsshqs', 'LB333333', 'Homme', 'CASABLANCA'),
(7, 'mohamedtest2@gmail.com', '000', 'patient', 'test2', 'mohamedtest2', '078778586', '2022-02-02', 'sqllqslqsll', 'LB333333', 'Homme', 'Ksar El KEBIR'),
(8, 'mohamedtest3@gmail.com', 'LB333333', 'patient', 'test3', 'mohamedtest3', '067777777', '2022-01-26', 'sdddddd', 'LB333333', 'Homme', 'Ksar El KEBIR'),
(9, 'momokanfoudi@gmail.com', 'momo', 'patient', 'kan', 'momo', '068888888', '2022-01-05', 'kkkkk', 'sd', 'Homme', 'CASABLANCA'),
(10, 'mohamedtest4@gmail.com', 'mohamed', 'patient', 'mohamed', 'test4', '067777777', '2000-06-01', 'sdsdsdsd', 'LB333333', 'Homme', 'CASABLANCA'),
(11, 'mohamedtest5@gmail.com', 'mohamed', 'patient', 'mohamed', 'mohamedtest5', '067777777', '1999-02-12', 'dssssssssssss', 'LB333333', 'Homme', 'CASABLANCA'),
(12, 'mohamedtest6@gmail.com', 'LB333333', 'patient', 'mohamed', 'test6', '067777777', '1999-02-12', 'sdsdsd', 'LB333333', 'Homme', 'CHICHAOUA'),
(13, 'dssd@gmail.com', 'sdsd', 'patient', 'sdsd', 'qsqs', 'sdsdsd', '2022-02-25', 'wxwx', 'sdsd', 'Homme', 'CASABLANCA'),
(14, 'sd@mals.com', 's', 'patient', 'sds', 'sd', 'sd', '2022-02-05', 'sd', 's', 'Homme', 'CASABLANCA'),
(15, 'sdsd@mail.com', 'sdsd', 'patient', 'zdds', 'sdsd', 'sdsd', '2022-03-03', 'sdsd', 'sdsd', 'Homme', 'CASABLANCA'),
(16, 'sdsdsd@gmail.com', 'ddfdf', 'patient', 'dssd', 'sdsdsd', 'sdsd', '2022-03-09', 'dfdfdf', 'ddfdf', 'Homme', 'CASABLANCA'),
(17, 'sdsd@mial.com', 'sddssd', 'patient', 'sdds', 'sdsd', 'sdd', '2022-02-24', 'sd@mail.com', 'sddssd', 'Homme', 'CASABLANCA'),
(19, 'sdklskld@mail.com', 'dsklklsdks', 'patient', 'sdlskldk@mail.com', 'sdlskld', 'dslsdk', '2022-03-02', 'sdklsdkl', 'dsklklsdks', 'Homme', 'CASABLANCA'),
(20, 'sdklklsd@mail.com', 's,kdnk', 'patient', 'klsdlkkl', 'sklsdkl', 'sdlskldkl', '2022-02-25', 'sd,sd,k', 's,kdnk', 'Homme', 'CASABLANCA'),
(21, 'aaa@gmail.com', '123456', 'patient', 'khalil', 'salmi', '066666666', '2022-02-25', 'klklklklkl', 'ffffff', 'Homme', 'CASABLANCA'),
(23, 'nbbb@gmail.com', 'ffffff', 'patient', 'khalil', 'lll', '888', '2022-02-12', 'klklklklkl', 'ffffff', 'Homme', 'CASABLANCA');

-- --------------------------------------------------------

--
-- Structure de la table `compterendu`
--

CREATE TABLE `compterendu` (
  `IdCompteRendu` int(11) NOT NULL,
  `DateCreationCompteRendu` date NOT NULL,
  `Synthese` varchar(500) NOT NULL,
  `idDossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `IdConsultation` int(11) NOT NULL,
  `IdCompteRendu` int(11) DEFAULT NULL,
  `dateConsultation` date NOT NULL,
  `Conclusion` text DEFAULT NULL,
  `IdCompte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `consultation`
--

INSERT INTO `consultation` (`IdConsultation`, `IdCompteRendu`, `dateConsultation`, `Conclusion`, `IdCompte`) VALUES
(1, NULL, '2022-02-09', 'il faut', 20),
(4, NULL, '2022-02-09', NULL, 20),
(5, NULL, '2022-02-18', 'lllll', 21),
(6, NULL, '2022-02-18', '123', 21),
(7, NULL, '2022-02-21', 'il il', 21),
(8, NULL, '2022-02-21', '', 6),
(9, NULL, '2022-02-21', NULL, 21);

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `idDepense` int(11) NOT NULL,
  `DateDepense` datetime NOT NULL DEFAULT current_timestamp(),
  `Motif` varchar(150) NOT NULL,
  `Montant` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`idDepense`, `DateDepense`, `Motif`, `Montant`) VALUES
(1, '2022-02-08 00:00:00', 'Medicaments', 1000),
(2, '2022-02-09 00:35:49', 'FACTURE', 3000);

-- --------------------------------------------------------

--
-- Structure de la table `diagnostic`
--

CREATE TABLE `diagnostic` (
  `IdDiagnostic` int(11) NOT NULL,
  `typeDiagnostic` varchar(255) NOT NULL,
  `resultat` varchar(255) NOT NULL,
  `observation` text DEFAULT NULL,
  `IdConsultation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `diagnostic`
--

INSERT INTO `diagnostic` (`IdDiagnostic`, `typeDiagnostic`, `resultat`, `observation`, `IdConsultation`) VALUES
(1, 'Paleur palmaire', 'oui', 'jkjkj', 1),
(2, 'Ictère', 'oui', 'ooooo', 1),
(3, 'Dermatose', 'non', 'kkllk', 1),
(4, 'Pouls fémoraux présents', 'non', '', 1),
(5, 'Auscultaion cardiaque normale', 'non', '', 1),
(6, 'Contage tuberculeux', 'non', '', 1),
(7, 'Notion d\'asthme', 'non', '', 1),
(8, 'Examen pleuro-pulmonaire normal', 'non', '', 1),
(9, 'Motricité normale', 'non', '', 1),
(10, 'Sensibilité normale', 'non', '', 1),
(11, 'Réflexes normaux', 'non', '', 1),
(12, 'Enurésie', 'non', '', 1),
(13, 'Difficultés de langue', 'non', '', 1),
(40, 'Paleur palmaire', 'non', NULL, 4),
(41, 'Ictère', 'non', NULL, 4),
(42, 'Dermatose', 'non', NULL, 4),
(43, 'Pouls fémoraux présents', 'non', NULL, 4),
(44, 'Auscultaion cardiaque normale', 'non', NULL, 4),
(45, 'Contage tuberculeux', 'non', NULL, 4),
(46, 'Notion d\'asthme', 'non', NULL, 4),
(47, 'Examen pleuro-pulmonaire normal', 'non', NULL, 4),
(48, 'Motricité normale', 'non', NULL, 4),
(49, 'Sensibilité normale', 'non', NULL, 4),
(50, 'Réflexes normaux', 'non', NULL, 4),
(51, 'Enurésie', 'non', NULL, 4),
(52, 'Difficultés de langue', 'non', NULL, 4),
(53, 'Paleur palmaire', 'non', '', 5),
(54, 'Ictère', 'non', '', 5),
(55, 'Dermatose', 'non', '', 5),
(56, 'Pouls fémoraux présents', 'non', '', 5),
(57, 'Auscultaion cardiaque normale', 'non', '', 5),
(58, 'Contage tuberculeux', 'non', '', 5),
(59, 'Notion d\'asthme', 'non', '', 5),
(60, 'Examen pleuro-pulmonaire normal', 'non', '', 5),
(61, 'Motricité normale', 'non', '', 5),
(62, 'Sensibilité normale', 'non', '', 5),
(63, 'Réflexes normaux', 'non', '', 5),
(64, 'Enurésie', 'non', '', 5),
(65, 'Difficultés de langue', 'non', '', 5),
(66, 'Paleur palmaire', 'non', '', 6),
(67, 'Ictère', 'non', '', 6),
(68, 'Dermatose', 'non', '', 6),
(69, 'Pouls fémoraux présents', 'non', '', 6),
(70, 'Auscultaion cardiaque normale', 'non', '', 6),
(71, 'Contage tuberculeux', 'non', '', 6),
(72, 'Notion d\'asthme', 'non', '', 6),
(73, 'Examen pleuro-pulmonaire normal', 'non', '', 6),
(74, 'Motricité normale', 'non', '', 6),
(75, 'Sensibilité normale', 'non', '', 6),
(76, 'Réflexes normaux', 'non', '', 6),
(77, 'Enurésie', 'non', '', 6),
(78, 'Difficultés de langue', 'non', '', 6),
(79, 'Paleur palmaire', 'oui', 'jkjkj', 7),
(80, 'Ictère', 'oui', 'ooooo', 7),
(81, 'Dermatose', 'oui', 'kkllk', 7),
(82, 'Pouls fémoraux présents', 'non', '', 7),
(83, 'Auscultaion cardiaque normale', 'non', '', 7),
(84, 'Contage tuberculeux', 'non', '', 7),
(85, 'Notion d\'asthme', 'non', '', 7),
(86, 'Examen pleuro-pulmonaire normal', 'non', '', 7),
(87, 'Motricité normale', 'non', '', 7),
(88, 'Sensibilité normale', 'non', '', 7),
(89, 'Réflexes normaux', 'non', '', 7),
(90, 'Enurésie', 'non', '', 7),
(91, 'Difficultés de langue', 'non', '', 7),
(92, 'Paleur palmaire', 'oui', '', 8),
(93, 'Ictère', 'oui', '', 8),
(94, 'Dermatose', 'non', '', 8),
(95, 'Pouls fémoraux présents', 'non', '', 8),
(96, 'Auscultaion cardiaque normale', 'non', '', 8),
(97, 'Contage tuberculeux', 'non', '', 8),
(98, 'Notion d\'asthme', 'non', '', 8),
(99, 'Examen pleuro-pulmonaire normal', 'non', '', 8),
(100, 'Motricité normale', 'non', '', 8),
(101, 'Sensibilité normale', 'non', '', 8),
(102, 'Réflexes normaux', 'non', '', 8),
(103, 'Enurésie', 'non', '445454', 8),
(104, 'Difficultés de langue', 'non', '', 8),
(105, 'Paleur palmaire', 'non', NULL, 9),
(106, 'Ictère', 'non', NULL, 9),
(107, 'Dermatose', 'non', NULL, 9),
(108, 'Pouls fémoraux présents', 'non', NULL, 9),
(109, 'Auscultaion cardiaque normale', 'non', NULL, 9),
(110, 'Contage tuberculeux', 'non', NULL, 9),
(111, 'Notion d\'asthme', 'non', NULL, 9),
(112, 'Examen pleuro-pulmonaire normal', 'non', NULL, 9),
(113, 'Motricité normale', 'non', NULL, 9),
(114, 'Sensibilité normale', 'non', NULL, 9),
(115, 'Réflexes normaux', 'non', NULL, 9),
(116, 'Enurésie', 'non', NULL, 9),
(117, 'Difficultés de langue', 'non', NULL, 9);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `IdDocument` int(11) NOT NULL,
  `TypeDocument` int(11) NOT NULL,
  `DateCreationDocument` int(11) NOT NULL,
  `idDossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `dossierpatient`
--

CREATE TABLE `dossierpatient` (
  `IdDossier` int(11) NOT NULL,
  `DateCreationDossier` datetime NOT NULL,
  `DateModificationDossier` datetime NOT NULL,
  `idFiche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fichepatient`
--

CREATE TABLE `fichepatient` (
  `IdFiche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `idRdv` int(11) NOT NULL,
  `DateRdv` datetime NOT NULL,
  `prix` double NOT NULL DEFAULT 200,
  `IdCompte` int(11) NOT NULL,
  `idFiche` int(11) NOT NULL,
  `rdvConfirme` varchar(150) NOT NULL DEFAULT 'false',
  `statut` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`idRdv`, `DateRdv`, `prix`, `IdCompte`, `idFiche`, `rdvConfirme`, `statut`) VALUES
(1, '2022-01-01 00:00:00', 200, 4, 0, 'false', ''),
(2, '2022-01-01 00:00:00', 200, 5, 0, 'false', ''),
(12, '2022-01-03 09:30:00', 200, 7, 0, 'false', ''),
(13, '2022-01-03 10:00:00', 200, 8, 0, 'false', ''),
(14, '2022-01-03 10:30:00', 200, 4, 0, 'false', ''),
(15, '2022-01-03 13:00:00', 200, 11, 0, 'false', ''),
(16, '2022-01-03 15:30:00', 200, 12, 0, 'false', ''),
(34, '2022-02-09 10:30:00', 200, 20, 0, 'true', ''),
(38, '2022-02-18 14:30:00', 200, 21, 0, 'true', 'terminé'),
(39, '2022-02-21 10:00:00', 200, 21, 0, 'true', 'terminé'),
(40, '2022-02-21 10:30:00', 200, 6, 0, 'true', 'terminé'),
(41, '2022-02-21 09:30:00', 200, 21, 0, 'true', NULL),
(42, '2022-02-25 10:00:00', 200, 21, 0, 'false', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `idRecette` int(11) NOT NULL,
  `DateRecette` datetime NOT NULL DEFAULT current_timestamp(),
  `Montant` double NOT NULL,
  `Mode` varchar(150) NOT NULL,
  `idRdv` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `DateRecette`, `Montant`, `Mode`, `idRdv`) VALUES
(31, '2022-02-12 00:24:24', 200, 'Espèce', 34),
(16, '2022-02-09 20:33:41', 150, 'ESPECE', 0),
(33, '2022-02-18 10:17:49', 200, 'Espèce', 35),
(35, '2022-02-18 14:34:54', 200, 'Espèce', 38),
(36, '2022-02-18 15:10:44', 200, 'Espèce', 39),
(37, '2022-02-18 15:16:17', 200, 'Espèce', 40),
(38, '2022-02-19 19:59:28', 200, 'Espèce', 41);

-- --------------------------------------------------------

--
-- Structure de la table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `resetpassword`
--

INSERT INTO `resetpassword` (`id`, `code`, `email`) VALUES
(1, '161db499ed1eeb', 'mohamed2@gmail.com'),
(2, '161db49da56b6f', 'momokanfoudi@gmail.com'),
(3, '161db4a41b1fa1', 'momokanfoudi@gmail.com'),
(4, '161db4a5176b74', 'momokanfoudi@gmail.com'),
(5, '161dcacd7706df', 'momokanfoudi@gmail.com'),
(8, '161df1d8236f5f', 'momokanfoudi@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ant`
--
ALTER TABLE `ant`
  ADD PRIMARY KEY (`idAnt`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`IdCompte`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `compterendu`
--
ALTER TABLE `compterendu`
  ADD PRIMARY KEY (`IdCompteRendu`),
  ADD KEY `idDossier` (`idDossier`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`IdConsultation`),
  ADD UNIQUE KEY `idCompteRendu` (`IdCompteRendu`,`IdConsultation`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`idDepense`);

--
-- Index pour la table `diagnostic`
--
ALTER TABLE `diagnostic`
  ADD PRIMARY KEY (`IdDiagnostic`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD KEY `idDossier` (`idDossier`);

--
-- Index pour la table `dossierpatient`
--
ALTER TABLE `dossierpatient`
  ADD PRIMARY KEY (`IdDossier`),
  ADD KEY `idFiche` (`idFiche`);

--
-- Index pour la table `fichepatient`
--
ALTER TABLE `fichepatient`
  ADD PRIMARY KEY (`IdFiche`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`idRdv`),
  ADD KEY `idCompte` (`IdCompte`),
  ADD KEY `idFiche` (`idFiche`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`idRecette`),
  ADD KEY `idRdv` (`idRdv`);

--
-- Index pour la table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ant`
--
ALTER TABLE `ant`
  MODIFY `idAnt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `IdCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `compterendu`
--
ALTER TABLE `compterendu`
  MODIFY `IdCompteRendu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `IdConsultation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `idDepense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `diagnostic`
--
ALTER TABLE `diagnostic`
  MODIFY `IdDiagnostic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT pour la table `dossierpatient`
--
ALTER TABLE `dossierpatient`
  MODIFY `IdDossier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fichepatient`
--
ALTER TABLE `fichepatient`
  MODIFY `IdFiche` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `idRdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `idRecette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
