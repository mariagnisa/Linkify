-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost:3306
-- Tid vid skapande: 10 jan 2017 kl 15:26
-- Serverversion: 5.5.49-log
-- PHP-version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `linkify`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote_uid` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `uid`, `content`, `link`, `published`, `title`) VALUES
(2, 1, 'Some awesome info about me in swedish', 'https://sv.wikipedia.org/wiki/Legolas', '2017-01-10 02:03:22', 'Info about me'),
(3, 1, 'Some awesome info about me in swedish', 'https://sv.wikipedia.org/wiki/Legolas', '2017-01-10 02:05:08', 'Info in swedish'),
(4, 1, 'Awesome info', 'https://en.wikipedia.org/wiki/Legolas', '2017-01-10 02:09:49', 'Info in english'),
(5, 1, 'Fun facts of my pal', 'http://archiveofourown.org/tags/Gimli%20(Son%20of%20Gl%C3%B3in)*s*Legolas%20Greenleaf/works', '2017-01-10 02:10:23', 'Facts of Giml'),
(6, 1, 'Things you didn´t know about me', 'http://www.huffingtonpost.com/noble-smith/the-top-10-things-you-may_b_4438914.html', '2017-01-10 02:10:49', 'Secret stuff'),
(7, 2, 'Info about the best movie', 'https://sv.wikipedia.org/wiki/Sagan_om_ringen_(film)', '2017-01-10 02:11:46', 'Great movie'),
(8, 2, 'Good facts if you like to read', 'https://en.wikipedia.org/wiki/Frodo_Baggins', '2017-01-10 02:12:11', 'Facts '),
(9, 4, 'Good info about me', 'http://lotr.wikia.com/wiki/Samwise_Gamgee', '2017-01-10 02:13:58', 'My fanpage'),
(10, 4, 'Everything you wanna know', 'http://www.theonering.net/torwp/2013/05/16/71670-all-about-sam-why-the-main-character-of-the-lord-of-the-rings-is-really-samwise-gamgee/', '2017-01-10 02:14:36', 'All facts of me');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `username`, `bio`) VALUES
(1, 'Legolas Greenleaf', '$2y$10$/NKx3Y4vHtLBGllVwAwsg.uaWG2jEs284.6PhrDnEM2QVGT42WOWO', 'legolas@greenleaf.com', 'Legolas', ''),
(2, 'Frodo Baggins', '$2y$10$B4/MrNSc2xDXlgfoyMAMMOALB4RpHB6h5oxyaJRemVH69hna1nl72', 'frodo@baggins.com', 'Frodo', ''),
(3, 'Meriadoc Vinbock', '$2y$10$Np228jrzV0EcSgtegpggMep8soXGhkvLShT9wDqWYTc0Ug.sJCrdW', 'merry@vinbock.com', 'Merry', ''),
(4, 'Samuel Gamgi', '$2y$10$NDBvU.RguEAu3GjWAwkSOO4rIv9mD25SLIF5hpMFHU.wk5/CgcJ/.', 'sam@gamgi.com', 'Sam', '');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
