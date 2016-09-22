-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Wrz 2016, 15:24
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `text` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `name`, `surname`, `createdate`) VALUES
(1, '0', '1@1.pl', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '0', '0000-00-00 00:00:00'),
(2, '0', '1@2.pl', '7c222fb2927d828af22f592134e8932480637c0d', '', '0', '0000-00-00 00:00:00'),
(3, '0', '2@1.pl', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '0', '0000-00-00 00:00:00'),
(4, '0', '3@1.pl', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '0', '0000-00-00 00:00:00'),
(5, '0', '4@4.pl', '', '', '0', '0000-00-00 00:00:00'),
(6, '0', '5@4.pl', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '0', '0000-00-00 00:00:00'),
(7, '0', '6@6.pl', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '', '0', '0000-00-00 00:00:00'),
(8, '0', 'ggg@tttl.pl', 'da39a3ee5e6b4b0d3255bfef95601890', '', '0', '0000-00-00 00:00:00'),
(9, '0', 'gutek@g.com', '4ff1a33e188b7b86123d6e3be2722a23514a83b4', '', '0', '0000-00-00 00:00:00'),
(10, '0', 'gutek@g2.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '', '0', '0000-00-00 00:00:00'),
(11, '0', 'gutek@g3.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '', '0', '0000-00-00 00:00:00'),
(12, 'gutek', 'gutek@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'imie', 'nazwisko', '0000-00-00 00:00:00'),
(13, '0', 'hee@test.pl', 'da39a3ee5e6b4b0d3255bfef95601890', '', '0', '0000-00-00 00:00:00'),
(14, '0', 'test@est.pl', 'da39a3ee5e6b4b0d3255bfef95601890', '', '0', '0000-00-00 00:00:00'),
(15, '0', 'test@o2.pl', 'da39a3ee5e6b4b0d3255bfef95601890', '', '0', '0000-00-00 00:00:00'),
(16, '0', 'test@test.pl', 'da39a3ee5e6b4b0d3255bfef95601890', '', '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_profile_images`
--

CREATE TABLE `users_profile_images` (
  `id` int(11) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `background` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_profile_stats`
--

CREATE TABLE `users_profile_stats` (
  `id` int(11) NOT NULL,
  `Tweets` int(11) NOT NULL,
  `Following` int(11) NOT NULL,
  `Followers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_profile_stats`
--

INSERT INTO `users_profile_stats` (`id`, `Tweets`, `Following`, `Followers`) VALUES
(12, 0, 12, 4);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_profile_images`
--
ALTER TABLE `users_profile_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `users_profile_images`
--
ALTER TABLE `users_profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
