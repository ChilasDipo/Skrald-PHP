-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 24. 11 2021 kl. 12:24:37
-- Serverversion: 10.4.21-MariaDB
-- PHP-version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycooldb`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rest_data`
--

CREATE TABLE `rest_data` (
  `ID` int(8) NOT NULL,
  `owner` int(5) NOT NULL,
  `date` datetime NOT NULL,
  `data` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `rest_data`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rest_menu`
--

CREATE TABLE `rest_menu` (
  `address` varchar(40) NOT NULL,
  `displayName` varchar(40) NOT NULL,
  `parent` int(5) NOT NULL DEFAULT 0,
  `displayOrder` int(2) NOT NULL,
  `access` int(3) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `rest_menu`
--

INSERT INTO `rest_menu` (`address`, `displayName`, `parent`, `displayOrder`, `access`, `active`) VALUES
('auth/admin/admin', 'Admin', 0, 8, 128, 1),
('auth/profile', 'Profil', 0, 9, 1, 1),
('auth/sensors', 'Mine sensorer', 0, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rest_pages`
--

CREATE TABLE `rest_pages` (
  `ID` int(5) NOT NULL,
  `page` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `parent` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `access` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rest_sensors`
--

CREATE TABLE `rest_sensors` (
  `ID` int(5) NOT NULL,
  `ownerID` int(5) NOT NULL,
  `address` varchar(32) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sensorType` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rest_sensortype`
--

CREATE TABLE `rest_sensortype` (
  `ID` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `script` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `rest_sensortype`
--

INSERT INTO `rest_sensortype` (`ID`, `name`, `description`, `script`) VALUES
(0, 'Temp/Humidity', 'Temperature and humidity sensor', ''),
(1, 'two-button', 'log two buttons', ''),
(2, 'Digital', 'Digital sensor 0 or 1', ''),
(6, 'Analog', 'Analog sensor', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rest_users`
--

CREATE TABLE `rest_users` (
  `ID` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `privileges` int(3) NOT NULL DEFAULT 1,
  `active` int(1) NOT NULL DEFAULT 2,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `activation` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `rest_data`
--
ALTER TABLE `rest_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `rest_menu`
--
ALTER TABLE `rest_menu`
  ADD UNIQUE KEY `address` (`address`);

--
-- Indeks for tabel `rest_pages`
--
ALTER TABLE `rest_pages`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indeks for tabel `rest_sensors`
--
ALTER TABLE `rest_sensors`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `APIkey` (`address`);

--
-- Indeks for tabel `rest_sensortype`
--
ALTER TABLE `rest_sensortype`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indeks for tabel `rest_users`
--
ALTER TABLE `rest_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `rest_data`
--
ALTER TABLE `rest_data`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `rest_pages`
--
ALTER TABLE `rest_pages`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `rest_sensors`
--
ALTER TABLE `rest_sensors`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `rest_users`
--
ALTER TABLE `rest_users`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
