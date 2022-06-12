-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 12. Jun 2022 um 03:16
-- Server-Version: 5.7.33
-- PHP-Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mysql`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `main`
--

CREATE TABLE `main` (
  `id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stops` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `main`
--

INSERT INTO `main` (`id`, `name`, `stops`) VALUES
('104', 'bus', '[\"Elversberg Friedhof\",\"Elversberg Grou00dfe Bergstr.\",\"Elversberg Markt\",\"Elversberg Kirche\",\"Elversberg Turnhalle\",\"Stadtbad\",\"Friedrichsthal\",\"Ludwigstr.\",\"Friedrichsthal\",\"Friedrichsthal (Saar) Markt\",\"Friedrichsthal (Saar) Bahnhof\",\"Oststr.\",\"Sulzbach (Saar) Altenwald\",\"Altenwald Markt\",\"Sulzbach (Saar)\",\"Altenwald Kirche\",\"Sulzbach (Saar)\",\"Hammersberg\",\"Sulzbach (Saar)\",\"Parallelstr.\",\"Sulzbach (Saar)\",\"Schnappacher Weg\",\"Sulzbach (Saar)\",\"Sulzbach (Saar) Rathaus\"]'),
('121', 'bus', '[\"Elversberg Friedhof\",\"Elversberg Große Bergstr.\",\"Elversberg Markt\",\"Elversberg Kirche\",\"Elversberg Turnhalle\",\"Stadtbad, Friedrichsthal\",\"Ludwigstr., Friedrichsthal\",\"Friedrichsthal (Saar) Markt\",\"Friedrichsthal (Saar) Bahnhof\",\"Oststr., Sulzbach (Saar) Altenwald\",\"Altenwald Markt, Sulzbach (Saar)\",\"Altenwald Kirche, Sulzbach (Saar)\",\"Hammersberg, Sulzbach (Saar)\",\"Parallelstr., Sulzbach (Saar)\",\"Schnappacher Weg, Sulzbach (Saar)\",\"Sulzbach (Saar) Rathaus\"]'),
('N14', 'bus', '[\"Elversberg Friedhof\",\"Elversberg Grou00dfe Bergstr.\",\"Elversberg Markt\",\"Elversberg Kirche\",\"Elversberg Turnhalle\",\"Stadtbad\",\"Friedrichsthal\",\"Ludwigstr.\",\"Friedrichsthal\",\"Friedrichsthal (Saar) Markt\",\"Friedrichsthal (Saar) Bahnhof\",\"Oststr.\",\"Sulzbach (Saar) Altenwald\",\"Altenwald Markt\",\"Sulzbach (Saar)\",\"Altenwald Kirche\",\"Sulzbach (Saar)\",\"Hammersberg\",\"Sulzbach (Saar)\",\"Parallelstr.\",\"Sulzbach (Saar)\",\"Schnappacher Weg\",\"Sulzbach (Saar)\",\"Sulzbach (Saar) Rathaus,\"]'),
('S1', 's-bahn', '[\"Elversberg Friedhof\",\"Elversberg Große Bergstr.\",\"Elversberg Markt\",\"Elversberg Kirche\",\"Elversberg Turnhalle\",\"Stadtbad, Friedrichsthal\",\"Ludwigstr., Friedrichsthal\",\"Friedrichsthal (Saar) Markt\",\"Friedrichsthal (Saar) Bahnhof\",\"Oststr., Sulzbach (Saar) Altenwald\",\"Altenwald Markt, Sulzbach (Saar)\",\"Altenwald Kirche, Sulzbach (Saar)\",\"Hammersberg, Sulzbach (Saar)\",\"Parallelstr., Sulzbach (Saar)\",\"Schnappacher Weg, Sulzbach (Saar)\",\"Sulzbach (Saar) Rathaus\"]'),
('T3', 'trolley', '[\"Elversberg Friedhof\",\"Elversberg Große Bergstr.\",\"Elversberg Markt\",\"Elversberg Kirche\",\"Elversberg Turnhalle\",\"Stadtbad, Friedrichsthal\",\"Ludwigstr., Friedrichsthal\",\"Friedrichsthal (Saar) Markt\",\"Friedrichsthal (Saar) Bahnhof\",\"Oststr., Sulzbach (Saar) Altenwald\",\"Altenwald Markt, Sulzbach (Saar)\",\"Altenwald Kirche, Sulzbach (Saar)\",\"Hammersberg, Sulzbach (Saar)\",\"Parallelstr., Sulzbach (Saar)\",\"Schnappacher Weg, Sulzbach (Saar)\",\"Sulzbach (Saar) Rathaus\"]');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
