-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 23. Aug 2019 um 22:47
-- Server-Version: 10.1.41-MariaDB-0ubuntu0.18.04.1
-- PHP-Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `nxtbyte_bot`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bots`
--

CREATE TABLE `bots` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `interface_name` varchar(255) NOT NULL,
  `template` varchar(200) NOT NULL,
  `node` int(11) NOT NULL DEFAULT '1',
  `server` varchar(200) NOT NULL,
  `botid` int(11) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `audio.stream` varchar(2000) NOT NULL,
  `audio.volume` int(3) NOT NULL DEFAULT '20',
  `channel_commander` smallint(1) NOT NULL DEFAULT '0',
  `is_online` smallint(1) NOT NULL,
  `host_password` varchar(200) NOT NULL,
  `default_channel` varchar(200) NOT NULL,
  `node_online` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `changelog`
--

CREATE TABLE `changelog` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `jobtype` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `remembered_logins`
--

CREATE TABLE `remembered_logins` (
  `token` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `smn_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_history`
--

CREATE TABLE `ticket_history` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(60) NOT NULL,
  `activation_token` varchar(300) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `max_bots` int(11) NOT NULL DEFAULT '2',
  `profile_img` text,
  `language` varchar(5) NOT NULL DEFAULT 'de',
  `private_streamurl` text NOT NULL,
  `force_node` int(11) DEFAULT NULL,
  `2fa` varchar(1000) DEFAULT NULL,
  `addr_street` varchar(300) DEFAULT NULL,
  `addr_number` varchar(5) DEFAULT NULL,
  `addr_city` varchar(300) DEFAULT NULL,
  `addr_country` varchar(300) DEFAULT NULL,
  `addr_plz` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `successfully` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `changelog`
--
ALTER TABLE `changelog`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `remembered_logins`
--
ALTER TABLE `remembered_logins`
  ADD PRIMARY KEY (`token`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `expires_at` (`expires_at`);

--
-- Indizes für die Tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indizes für die Tabelle `ticket_history`
--
ALTER TABLE `ticket_history`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `name` (`name`);

--
-- Indizes für die Tabelle `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bots`
--
ALTER TABLE `bots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT für Tabelle `changelog`
--
ALTER TABLE `changelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `ticket_history`
--
ALTER TABLE `ticket_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT für Tabelle `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `remembered_logins`
--
ALTER TABLE `remembered_logins`
  ADD CONSTRAINT `remembered_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
