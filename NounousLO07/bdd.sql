SET SQL_MODE = "ALLOW_INVALID_DATES";
--
-- Database: `nounou`
--

-- --------------------------------------------------------

--
-- Table structure for table `DISPONIBILITES`
--

CREATE TABLE `DISPONIBILITES` (
  `idNounou` int(15) NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') NOT NULL DEFAULT 'lundi',
  `heure_debut` int(11) NOT NULL,
  `heure_fin` int(11) NOT NULL,
  `recurrence` tinyint(1) DEFAULT '0',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DISPONIBILITES`
--

INSERT INTO `DISPONIBILITES` (`idNounou`, `jour`, `heure_debut`, `heure_fin`, `recurrence`, `date`) VALUES
(7632, 'lundi', 12, 14, 0, '2018-06-22'),
(7632, 'mardi', 9, 14, 1, NULL),
(7632, 'jeudi', 8, 23, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ENFANTS`
--

CREATE TABLE `ENFANTS` (
  `idParents` int(15) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `date_naissance` date NOT NULL,
  `restrictions_alim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ENFANTS`
--

INSERT INTO `ENFANTS` (`idParents`, `prenom`, `date_naissance`, `restrictions_alim`) VALUES
(7631, 'Gladys', '2000-06-14', 'Epinard'),
(7631, 'Timothée', '2015-06-09', 'Poireau, Avocat');

-- --------------------------------------------------------

--
-- Table structure for table `EVALUATION`
--

CREATE TABLE `EVALUATION` (
  `num_resa` int(11) NOT NULL,
  `note` enum('0','1','2','3','4','5') NOT NULL,
  `commentaire` varchar(300) NOT NULL,
  `rémunération` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EVALUATION`
--

INSERT INTO `EVALUATION` (`num_resa`, `note`, `commentaire`, `rémunération`) VALUES
(6, '2', 'très bonne fille', '0');

-- --------------------------------------------------------

--
-- Table structure for table `LANGUES`
--

CREATE TABLE `LANGUES` (
  `idNounou` int(15) NOT NULL,
  `langue` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `LANGUES`
--

INSERT INTO `LANGUES` (`idNounou`, `langue`) VALUES
(7632, 'arabe'),
(7632, 'espagnol');

-- --------------------------------------------------------

--
-- Table structure for table `NOUNOU`
--

CREATE TABLE `NOUNOU` (
  `idNounou` int(15) NOT NULL,
  `lien_photo` varchar(200) DEFAULT NULL,
  `age` int(2) NOT NULL,
  `annees_experience` int(2) NOT NULL,
  `presentation` varchar(300) NOT NULL,
  `revenus` decimal(65,0) DEFAULT NULL,
  `candidature` tinyint(1) NOT NULL DEFAULT '1',
  `blocage` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des nounous ';

--
-- Dumping data for table `NOUNOU`
--

INSERT INTO `NOUNOU` (`idNounou`, `lien_photo`, `age`, `annees_experience`, `presentation`, `revenus`, `candidature`, `blocage`) VALUES
(7632, 'girl2.png', 18, 2, 'Je parle très bien italien, et j adore les enfants!', NULL, 0, 0),
(7639, 'girl3.png', 21, 3, 'Bonjour a tous', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PARENTS`
--

CREATE TABLE `PARENTS` (
  `idParents` int(15) NOT NULL,
  `informations` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PARENTS`
--

INSERT INTO `PARENTS` (`idParents`, `informations`) VALUES
(7631, 'Nous sommes une famille agréable!');

-- --------------------------------------------------------

--
-- Table structure for table `RESERVATIONS`
--

CREATE TABLE `RESERVATIONS` (
  `num_resa` int(15) NOT NULL,
  `type_resa` enum('ponctuelle','etrangere','recu') NOT NULL,
  `idParents` int(15) NOT NULL,
  `idNounou` int(15) NOT NULL,
  `heure_debut` int(11) NOT NULL,
  `heure_fin` int(20) NOT NULL,
  `date` date DEFAULT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RESERVATIONS`
--

INSERT INTO `RESERVATIONS` (`num_resa`, `type_resa`, `idParents`, `idNounou`, `heure_debut`, `heure_fin`, `date`, `jour`) VALUES
(5, 'ponctuelle', 7631, 7632, 12, 14, '2018-06-22', NULL),
(6, 'recu', 7631, 7632, 9, 11, NULL, 'mardi'),
(9, 'etrangere', 7631, 7632, 8, 23, '0000-00-00', NULL);

--
-- Triggers `RESERVATIONS`
--
DELIMITER $$
CREATE TRIGGER `dispo_after_insert` AFTER INSERT ON `RESERVATIONS` FOR EACH ROW BEGIN

UPDATE DISPONIBILITES d
SET d.dispo = 0
WHERE d.idNounou = NEW.idNounou
AND d.date = NEW.date
AND d.jour = NEW.jour
AND d.heure_debut = NEW.heure_debut;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEURS`
--

CREATE TABLE `UTILISATEURS` (
  `id_utilisateur` int(15) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `ville` int(6) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telephone` int(12) NOT NULL,
  `login` varchar(40) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UTILISATEURS`
--

INSERT INTO `UTILISATEURS` (`id_utilisateur`, `nom`, `prenom`, `ville`, `email`, `telephone`, `login`, `mdp`, `admin`) VALUES
(7630, 'Lallier', 'Robin', 10000, 'robin.lallier29@gmail.com', 662509816, 'jujube', '$2y$10$if9CLGu45TVoTfcKm80Q4.JHkwVysZV/4OUvzJi8n7EobEiPkmw/.', 1),
(7631, 'Roger', 'Rolland', 10000, 'robin.lallier29@gmail.com', 662509816, 'litchi', '$2y$10$0syc3ETby3LSDL.3YYGCwuymZ22YqO.rJP9kzVyUwTKXpGbfv2LE2', 0),
(7632, 'Julie', 'Lescault', 10000, 'robin.lallier@utt.fr', 662509816, 'mangue', '$2y$10$T5K52Ii/5X7nYkAAKeb/teZzMGdPK5ON4/n4YibA8vbjiJAuSySAC', 0),
(7638, 'Mathilde', 'Jimenez', 10000, 'robin.lallier29@gmail.com', 662509816, 'poire', '$2y$10$DB9yzBOQoYKPtn09whrxxONHcrr0n41NXA3ADRFtM27Vb.M98uo9e', 0),
(7639, 'Claudine', 'Dutrou', 10000, 'robin.lallier29@gmail.com', 662509816, 'bambi', 'bambi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DISPONIBILITES`
--
ALTER TABLE `DISPONIBILITES`
  ADD PRIMARY KEY (`idNounou`,`jour`,`heure_debut`,`heure_fin`);

--
-- Indexes for table `ENFANTS`
--
ALTER TABLE `ENFANTS`
  ADD PRIMARY KEY (`idParents`,`prenom`);

--
-- Indexes for table `EVALUATION`
--
ALTER TABLE `EVALUATION`
  ADD PRIMARY KEY (`num_resa`);

--
-- Indexes for table `LANGUES`
--
ALTER TABLE `LANGUES`
  ADD PRIMARY KEY (`idNounou`,`langue`);

--
-- Indexes for table `NOUNOU`
--
ALTER TABLE `NOUNOU`
  ADD PRIMARY KEY (`idNounou`);

--
-- Indexes for table `PARENTS`
--
ALTER TABLE `PARENTS`
  ADD PRIMARY KEY (`idParents`);

--
-- Indexes for table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  ADD PRIMARY KEY (`num_resa`),
  ADD KEY `fk_resaparent` (`idParents`),
  ADD KEY `fk_resanounou` (`idNounou`);

--
-- Indexes for table `UTILISATEURS`
--
ALTER TABLE `UTILISATEURS`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  MODIFY `num_resa` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `UTILISATEURS`
--
ALTER TABLE `UTILISATEURS`
  MODIFY `id_utilisateur` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7640;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DISPONIBILITES`
--
ALTER TABLE `DISPONIBILITES`
  ADD CONSTRAINT `fk_disponounou` FOREIGN KEY (`idNounou`) REFERENCES `NOUNOU` (`idNounou`);

--
-- Constraints for table `ENFANTS`
--
ALTER TABLE `ENFANTS`
  ADD CONSTRAINT `fk_parentenfants` FOREIGN KEY (`idParents`) REFERENCES `PARENTS` (`idParents`);

--
-- Constraints for table `EVALUATION`
--
ALTER TABLE `EVALUATION`
  ADD CONSTRAINT `fk_eval` FOREIGN KEY (`num_resa`) REFERENCES `RESERVATIONS` (`num_resa`);

--
-- Constraints for table `LANGUES`
--
ALTER TABLE `LANGUES`
  ADD CONSTRAINT `fk_nounou` FOREIGN KEY (`idNounou`) REFERENCES `NOUNOU` (`idNounou`);

--
-- Constraints for table `NOUNOU`
--
ALTER TABLE `NOUNOU`
  ADD CONSTRAINT `fk_idnounou` FOREIGN KEY (`idNounou`) REFERENCES `UTILISATEURS` (`id_utilisateur`);

--
-- Constraints for table `PARENTS`
--
ALTER TABLE `PARENTS`
  ADD CONSTRAINT `fk_idparent` FOREIGN KEY (`idParents`) REFERENCES `UTILISATEURS` (`id_utilisateur`);

--
-- Constraints for table `RESERVATIONS`
--
ALTER TABLE `RESERVATIONS`
  ADD CONSTRAINT `fk_resanounou` FOREIGN KEY (`idNounou`) REFERENCES `NOUNOU` (`idNounou`),
  ADD CONSTRAINT `fk_resaparent` FOREIGN KEY (`idParents`) REFERENCES `PARENTS` (`idParents`);