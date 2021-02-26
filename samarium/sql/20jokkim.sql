-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2021 at 07:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20jokkim`
--

-- --------------------------------------------------------

--
-- Table structure for table `esiintyjat`
--

CREATE TABLE `esiintyjat` (
  `EsiintyjäID` int(11) NOT NULL,
  `Sukunimi` varchar(50) NOT NULL,
  `Etunimi` varchar(50) NOT NULL,
  `Taiteilijanimi` varchar(50) NOT NULL,
  `ManagerID` int(11) NOT NULL,
  `MusiikkityyliID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `esiintyjat`
--

INSERT INTO `esiintyjat` (`EsiintyjäID`, `Sukunimi`, `Etunimi`, `Taiteilijanimi`, `ManagerID`, `MusiikkityyliID`) VALUES
(1, 'Rytkönen', 'Karl', 'B.I.G Mistake', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keikat`
--

CREATE TABLE `keikat` (
  `KeikkaID` int(11) NOT NULL,
  `Päivämäärä` date NOT NULL,
  `Alkamisaika` date NOT NULL,
  `EsiintyjäID` int(11) NOT NULL,
  `KeikkapaikkaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keikat`
--

INSERT INTO `keikat` (`KeikkaID`, `Päivämäärä`, `Alkamisaika`, `EsiintyjäID`, `KeikkapaikkaID`) VALUES
(1, '2021-01-08', '2021-01-09', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keikkapaikat`
--

CREATE TABLE `keikkapaikat` (
  `KeikkapaikkaID` int(11) NOT NULL,
  `Lähiosoite` varchar(100) NOT NULL,
  `Postiosoite` int(11) NOT NULL,
  `Postitoimipaikka` varchar(50) NOT NULL,
  `Puhelin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keikkapaikat`
--

INSERT INTO `keikkapaikat` (`KeikkapaikkaID`, `Lähiosoite`, `Postiosoite`, `Postitoimipaikka`, `Puhelin`) VALUES
(1, 'Tehtaankatu 5D2', 37600, 'Valkeakoski', '0406403478'),
(2, 'Hepolamminkatu 10', 33720, 'Tampere', '0356567360');

-- --------------------------------------------------------

--
-- Table structure for table `managerit`
--

CREATE TABLE `managerit` (
  `ManagerID` int(11) NOT NULL,
  `Sukunimi` varchar(50) NOT NULL,
  `Etunimi` varchar(50) NOT NULL,
  `PalkkausPvm` date NOT NULL,
  `Puhelin` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managerit`
--

INSERT INTO `managerit` (`ManagerID`, `Sukunimi`, `Etunimi`, `PalkkausPvm`, `Puhelin`, `Email`) VALUES
(1, 'Vainio', 'Roni', '2021-01-06', '0408737540', 'ei');

-- --------------------------------------------------------

--
-- Table structure for table `musiikkityylit`
--

CREATE TABLE `musiikkityylit` (
  `MusiikkityyliID` int(11) NOT NULL,
  `Tyyli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `musiikkityylit`
--

INSERT INTO `musiikkityylit` (`MusiikkityyliID`, `Tyyli`) VALUES
(1, 'Rock'),
(2, 'Hip-Hop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esiintyjat`
--
ALTER TABLE `esiintyjat`
  ADD PRIMARY KEY (`EsiintyjäID`),
  ADD KEY `ManagerID` (`ManagerID`),
  ADD KEY `MusiikkityyliID` (`MusiikkityyliID`);

--
-- Indexes for table `keikat`
--
ALTER TABLE `keikat`
  ADD PRIMARY KEY (`KeikkaID`),
  ADD KEY `EsiintyjäID` (`EsiintyjäID`),
  ADD KEY `KeikkapaikkaID` (`KeikkapaikkaID`);

--
-- Indexes for table `keikkapaikat`
--
ALTER TABLE `keikkapaikat`
  ADD PRIMARY KEY (`KeikkapaikkaID`);

--
-- Indexes for table `managerit`
--
ALTER TABLE `managerit`
  ADD PRIMARY KEY (`ManagerID`);

--
-- Indexes for table `musiikkityylit`
--
ALTER TABLE `musiikkityylit`
  ADD PRIMARY KEY (`MusiikkityyliID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esiintyjat`
--
ALTER TABLE `esiintyjat`
  MODIFY `EsiintyjäID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `managerit`
--
ALTER TABLE `managerit`
  MODIFY `ManagerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `esiintyjat`
--
ALTER TABLE `esiintyjat`
  ADD CONSTRAINT `esiintyjat_ibfk_1` FOREIGN KEY (`ManagerID`) REFERENCES `managerit` (`ManagerID`),
  ADD CONSTRAINT `esiintyjat_ibfk_2` FOREIGN KEY (`MusiikkityyliID`) REFERENCES `musiikkityylit` (`MusiikkityyliID`);

--
-- Constraints for table `keikat`
--
ALTER TABLE `keikat`
  ADD CONSTRAINT `keikat_ibfk_1` FOREIGN KEY (`EsiintyjäID`) REFERENCES `esiintyjat` (`EsiintyjäID`),
  ADD CONSTRAINT `keikat_ibfk_2` FOREIGN KEY (`KeikkapaikkaID`) REFERENCES `keikkapaikat` (`KeikkapaikkaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
