-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2019 at 02:47 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mboopen`
--

-- --------------------------------------------------------

--
-- Table structure for table `aanmeldingen`
--

CREATE TABLE `aanmeldingen` (
  `aanmelding_id` int(11) NOT NULL,
  `speler_id` int(11) NOT NULL,
  `toernooi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aanmeldingen`
--

INSERT INTO `aanmeldingen` (`aanmelding_id`, `speler_id`, `toernooi_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 1, 1),
(4, 2, 2),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `gebruiker_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`gebruiker_id`, `username`, `password`, `rol`) VALUES
(1, 'jelle', 'poppen', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scholen`
--

CREATE TABLE `scholen` (
  `school_id` int(11) NOT NULL,
  `schoolnaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholen`
--

INSERT INTO `scholen` (`school_id`, `schoolnaam`) VALUES
(1, 'Albeda College'),
(2, 'Da Vinci College'),
(3, 'Drenthe College'),
(4, 'Graafschap College');

-- --------------------------------------------------------

--
-- Table structure for table `spelers`
--

CREATE TABLE `spelers` (
  `speler_id` int(11) NOT NULL,
  `roepnaam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(20) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spelers`
--

INSERT INTO `spelers` (`speler_id`, `roepnaam`, `tussenvoegsel`, `achternaam`, `school_id`) VALUES
(1, 'Michael', '', 'Bouman', 1),
(2, 'Elmar', '', 'Hammink', 2),
(3, 'Marinus', 'van', 'Laar', 3),
(4, 'Martin', '', 'Crum', 4);

-- --------------------------------------------------------

--
-- Table structure for table `toernooien`
--

CREATE TABLE `toernooien` (
  `toernooi_id` int(11) NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toernooien`
--

INSERT INTO `toernooien` (`toernooi_id`, `omschrijving`, `datum`) VALUES
(1, 'Voorjaarstoernooi', '2019-01-28'),
(2, 'Zomerbal', '2019-01-29'),
(3, 'Wintertoernooi', '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `wedstrijden`
--

CREATE TABLE `wedstrijden` (
  `wedstrijd_id` int(11) NOT NULL,
  `toernooi_id` int(11) NOT NULL,
  `ronde` int(11) NOT NULL,
  `speler1_id` int(11) NOT NULL,
  `speler2_id` int(11) NOT NULL,
  `score1` int(11) NOT NULL,
  `score2` int(11) NOT NULL,
  `winnaar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wedstrijden`
--

INSERT INTO `wedstrijden` (`wedstrijd_id`, `toernooi_id`, `ronde`, `speler1_id`, `speler2_id`, `score1`, `score2`, `winnaar_id`) VALUES
(1, 1, 0, 1, 2, 0, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aanmeldingen`
--
ALTER TABLE `aanmeldingen`
  ADD PRIMARY KEY (`aanmelding_id`),
  ADD KEY `speler_id` (`speler_id`),
  ADD KEY `toernooi_id` (`toernooi_id`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`gebruiker_id`);

--
-- Indexes for table `scholen`
--
ALTER TABLE `scholen`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `spelers`
--
ALTER TABLE `spelers`
  ADD PRIMARY KEY (`speler_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `toernooien`
--
ALTER TABLE `toernooien`
  ADD PRIMARY KEY (`toernooi_id`);

--
-- Indexes for table `wedstrijden`
--
ALTER TABLE `wedstrijden`
  ADD PRIMARY KEY (`wedstrijd_id`),
  ADD KEY `winnaar_id` (`winnaar_id`),
  ADD KEY `toernooi_id` (`toernooi_id`),
  ADD KEY `speler1_id` (`speler1_id`),
  ADD KEY `speler2_id` (`speler2_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aanmeldingen`
--
ALTER TABLE `aanmeldingen`
  MODIFY `aanmelding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `scholen`
--
ALTER TABLE `scholen`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `spelers`
--
ALTER TABLE `spelers`
  MODIFY `speler_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `toernooien`
--
ALTER TABLE `toernooien`
  MODIFY `toernooi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wedstrijden`
--
ALTER TABLE `wedstrijden`
  MODIFY `wedstrijd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aanmeldingen`
--
ALTER TABLE `aanmeldingen`
  ADD CONSTRAINT `aanmeldingen_ibfk_1` FOREIGN KEY (`toernooi_id`) REFERENCES `toernooien` (`toernooi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aanmeldingen_ibfk_2` FOREIGN KEY (`speler_id`) REFERENCES `spelers` (`speler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `spelers`
--
ALTER TABLE `spelers`
  ADD CONSTRAINT `spelers_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `scholen` (`school_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wedstrijden`
--
ALTER TABLE `wedstrijden`
  ADD CONSTRAINT `wedstrijden_ibfk_1` FOREIGN KEY (`toernooi_id`) REFERENCES `toernooien` (`toernooi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wedstrijden_ibfk_2` FOREIGN KEY (`speler1_id`) REFERENCES `spelers` (`speler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wedstrijden_ibfk_3` FOREIGN KEY (`speler2_id`) REFERENCES `spelers` (`speler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wedstrijden_ibfk_4` FOREIGN KEY (`winnaar_id`) REFERENCES `spelers` (`speler_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
