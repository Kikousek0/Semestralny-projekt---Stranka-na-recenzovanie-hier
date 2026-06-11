-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 11.Jún 2026, 16:17
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `formular`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `release_year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `release_year`, `created_at`) VALUES
(1, 'The Witcher 3: Wild Hunt', 'RPG', 2015, '2026-05-18 15:59:44'),
(2, 'Counter-Strike 2', 'FPS', 2023, '2026-05-18 15:59:44'),
(3, 'Cyberpunk 2077', 'RPG', 2020, '2026-05-18 15:59:44'),
(5, 'League of Legends', 'MMO/RPG', 2009, '2026-05-18 18:13:53');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `reviews`
--

INSERT INTO `reviews` (`id`, `game_id`, `author`, `text`, `rating`, `created_at`) VALUES
(1, 5, 'Jozko Mrkvička', 'Strata chute do života je fajn prídavok :D', 4, '2026-05-18 18:24:26'),
(2, 2, 'Anomaly', 'Me buy case me happy', 5, '2026-05-18 18:25:17');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `udaje`
--

CREATE TABLE `udaje` (
  `ID` int(11) NOT NULL,
  `meno` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sprava` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `udaje`
--

INSERT INTO `udaje` (`ID`, `meno`, `email`, `sprava`) VALUES
(1, 'Jožko Táčky', 'jozkot@gmail.com', 'Aké to je pekné'),
(2, 'Julia Molotovova', 'juliam@post.sk', 'čo to ma byt za stranku toto');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexy pre tabuľku `udaje`
--
ALTER TABLE `udaje`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pre tabuľku `udaje`
--
ALTER TABLE `udaje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
