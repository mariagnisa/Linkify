-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost:3306
-- Tid vid skapande: 17 jan 2017 kl 20:20
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
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posts_id` int(11) NOT NULL,
  `published` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `uid`, `comment`, `posts_id`, `published`) VALUES
(4, 4, 'Awesome!', 2, '2017-01-11 11:02:21'),
(5, 4, 'Best info ever!', 2, '2017-01-11 11:13:01'),
(6, 4, 'Had to read that again!', 2, '2017-01-11 11:14:18'),
(7, 5, 'Really fantastic!', 2, '2017-01-11 13:13:04'),
(12, 3, 'Wow!', 4, '2017-01-12 14:35:52'),
(13, 3, 'Great guy!', 5, '2017-01-12 14:44:45'),
(14, 3, 'Hey, I have one too!', 9, '2017-01-12 14:56:27'),
(15, 3, 'Awesome movie!', 7, '2017-01-12 17:34:27'),
(16, 3, 'Truly, the best movie', 7, '2017-01-12 17:36:45'),
(17, 3, 'Such wow!', 8, '2017-01-12 17:39:29'),
(18, 3, 'Much wow!', 8, '2017-01-12 17:41:42'),
(21, 1, 'Awesome!', 12, '2017-01-14 13:10:21'),
(22, 1, 'Good job!', 15, '2017-01-14 13:18:50'),
(23, 1, 'Wow!', 17, '2017-01-15 11:06:53'),
(25, 5, 'Cool!', 9, '2017-01-15 17:50:36'),
(45, 8, 'Hey, first comment!', 23, '2017-01-16 15:11:55'),
(53, 5, 'wow', 15, '2017-01-17 10:46:24');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `uid`, `content`, `link`, `published`, `title`) VALUES
(2, 1, 'Some awesome info about me in swedish', 'https://sv.wikipedia.org/wiki/Legolas', '2017-01-10 02:03:22', 'Info about me'),
(4, 1, 'Awesome info about me', 'https://en.wikipedia.org/wiki/Legolas', '2017-01-11 20:25:54', 'Cool stuff'),
(5, 1, 'Fun facts of my pal', 'http://archiveofourown.org/tags/Gimli%20(Son%20of%20Gl%C3%B3in)*s*Legolas%20Greenleaf/works', '2017-01-10 02:10:23', 'Facts of Giml'),
(6, 1, 'Things you didn´t know about me', 'http://www.huffingtonpost.com/noble-smith/the-top-10-things-you-may_b_4438914.html', '2017-01-10 02:10:49', 'Secret stuff'),
(7, 2, 'Info about the best movie', 'https://sv.wikipedia.org/wiki/Sagan_om_ringen_(film)', '2017-01-10 02:11:46', 'Great movie'),
(8, 2, 'Good facts if you like to read', 'https://en.wikipedia.org/wiki/Frodo_Baggins', '2017-01-10 02:12:11', 'Facts '),
(9, 4, 'Good info about me', 'http://lotr.wikia.com/wiki/Samwise_Gamgee', '2017-01-10 02:13:58', 'My fanpage'),
(10, 4, 'Everything you wanna know', 'http://www.theonering.net/torwp/2013/05/16/71670-all-about-sam-why-the-main-character-of-the-lord-of-the-rings-is-really-samwise-gamgee/', '2017-01-10 02:14:36', 'All facts of me'),
(12, 5, 'I do as Legolas, here is some info about me.', 'https://sv.wikipedia.org/wiki/Aragorn', '2017-01-11 21:26:06', 'A good story'),
(13, 5, 'Hey, I got a fan page!', 'http://lotr.wikia.com/wiki/Aragorn_II_Elessar', '2017-01-12 13:23:59', 'Fan page'),
(15, 3, 'I have a fan page! Such wow.', 'http://lotr.wikia.com/wiki/Meriadoc_Brandybuck', '2017-01-15 13:14:16', 'What, fan page? Me?'),
(16, 1, 'The latest adventure folks!', 'http://www.thehobbit.com/', '2017-01-14 13:02:08', 'Adventure time'),
(17, 5, 'Have you seen this movie? Martin is like the best', 'http://www.thehobbit.com/', '2017-01-17 15:19:04', 'I love Martin Freeman!'),
(18, 3, 'Such amazed', 'http://www.lordoftherings.net/', '2017-01-15 16:16:48', 'Watch this!'),
(23, 8, 'Here is a wikipedia page', 'https://en.wikipedia.org/wiki/Gimli_(Middle-earth)', '2017-01-16 15:11:15', 'Wiki is your friend');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `username`, `bio`) VALUES
(1, 'Legolas Greenleaf', '$2y$10$/NKx3Y4vHtLBGllVwAwsg.uaWG2jEs284.6PhrDnEM2QVGT42WOWO', 'legolas@greenleaf.com', 'Legolas', ''),
(2, 'Frodo Baggins', '$2y$10$B4/MrNSc2xDXlgfoyMAMMOALB4RpHB6h5oxyaJRemVH69hna1nl72', 'frodo@baggins.com', 'Frodo', ''),
(3, 'Meriadoc Vinbock', '$2y$10$RKORtVutkR3UvYc73l6byef4GaR4ns9ApbvtUCVL7ojBHJk0iqKTO', 'merry@vinbock.com', 'Merry', 'Shire is the best place in the world!'),
(4, 'Samuel Gamgi', '$2y$10$NDBvU.RguEAu3GjWAwkSOO4rIv9mD25SLIF5hpMFHU.wk5/CgcJ/.', 'sam@gamgi.com', 'Sam', '“That there’s some good in this world,  and it’s worth fighting for.”'),
(5, 'Aragorn Arathorn', '$2y$10$CK9cpfdXUujaHNtyE.r8Tu4w8ZZd9lf2uigMEn9yaMSgNq8sfXPbO', 'aragorn@arathorn.com', 'Aragorn', 'Amazing'),
(6, 'Gandalf', '$2y$10$zGNXOsSThKar7d/pHY2O.ODQo61Rh07nOIu3OW5TcbRwZGZqf2CtG', 'gandalf@gandalf.com', 'Gandalf', ''),
(7, 'Peregrin Took', '$2y$10$AnBb0vcIRvUw/sOyS91eCeAoljVRxTBLQpiugjjywuzoWYcCRH82W', 'pippin@took.com', 'Pippin', ''),
(8, 'Gimli Gloins', '$2y$10$/NKx3Y4vHtLBGllVwAwsg.uaWG2jEs284.6PhrDnEM2QVGT42WOWO', 'gimli@gloin.se', 'gimli', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote_up` tinyint(1) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `votes`
--

INSERT INTO `votes` (`id`, `uid`, `vote_up`, `post_id`) VALUES
(10, 3, 1, 2),
(11, 3, 1, 8),
(14, 2, 1, 6),
(15, 2, 1, 15),
(16, 2, 1, 12),
(17, 2, 1, 10),
(19, 6, 1, 12),
(20, 6, 1, 8),
(21, 6, 1, 4),
(22, 6, 1, 9),
(23, 6, 1, 15),
(24, 1, 1, 13),
(26, 1, 1, 15),
(27, 5, 1, 8),
(28, 5, 1, 4),
(29, 5, 1, 9),
(30, 5, 1, 7),
(31, 5, 1, 2),
(32, 5, 1, 5),
(33, 5, 1, 16),
(34, 1, 1, 17),
(35, 3, 1, 17),
(36, 5, 1, 15),
(37, 8, 0, 18),
(38, 8, 1, 15),
(39, 8, 1, 17),
(40, 5, 0, 23),
(41, 5, 0, 18);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_COMMENTS_POSTS_ID_POSTS_ID` (`posts_id`),
  ADD KEY `FK_COMMENTS_UID_USERS_ID` (`uid`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_POSTS_UID_USERS_ID` (`uid`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_VOTES_POST_ID_POSTS_ID` (`post_id`),
  ADD KEY `FK_VOTES_UID_USERS_ID` (`uid`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT för tabell `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_COMMENTS_POSTS_ID_POSTS_ID` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_COMMENTS_UID_USERS_ID` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_POSTS_UID_USERS_ID` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `FK_VOTES_POST_ID_POSTS_ID` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VOTES_UID_USERS_ID` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
