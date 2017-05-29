-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 apr 2017 om 21:25
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ijburgcollege`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tijdlijn`
--

CREATE TABLE `tijdlijn` (
  `id` int(11) NOT NULL,
  `start_year` varchar(25) NOT NULL,
  `start_month` varchar(150) DEFAULT NULL,
  `start_day` varchar(55) DEFAULT NULL,
  `end_year` varchar(10) DEFAULT NULL,
  `end_month` varchar(10) DEFAULT NULL,
  `end_day` varchar(10) DEFAULT NULL,
  `bg_url` varchar(255) DEFAULT NULL,
  `media_caption` varchar(255) DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `text_headline` varchar(255) DEFAULT NULL,
  `text_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tijdlijn`
--

INSERT INTO `tijdlijn` (`id`, `start_year`, `start_month`, `start_day`, `end_year`, `end_month`, `end_day`, `bg_url`, `media_caption`, `media_url`, `text_headline`, `text_text`) VALUES
(6, '2005', '10', '10', '2005', '02', '01', '              https://upload.wikimedia.org/wikipedia/commons/1/1a/Spring_Outing_of_the_Tang_Court.jpg\r\n', 'hallo', 'https://en.wikipedia.org/wiki/Tang_Dynasty', 'Titel 1', 'dit is een test uit de database'),
(8, '2006', '10', '10', '2006', '11', '11', '              https://upload.wikimedia.org/wikipedia/commons/1/1a/Spring_Outing_of_the_Tang_Court.jpg\r\n', 'hallo', 'https://en.wikipedia.org/wiki/Tang_Dynasty', 'Titel 2', 'dit is een test uit de database'),
(9, '2007', '10', '10', '2007', '11', '11', '              https://upload.wikimedia.org/wikipedia/commons/1/1a/Spring_Outing_of_the_Tang_Court.jpg\r\n', 'hallo', 'https://en.wikipedia.org/wiki/Tang_Dynasty', 'Titel 3', 'dit is een test uit de database');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tijdlijn`
--
ALTER TABLE `tijdlijn`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tijdlijn`
--
ALTER TABLE `tijdlijn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
