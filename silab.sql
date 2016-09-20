-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Wrz 2016, 15:05
-- Wersja serwera: 5.6.21
-- Wersja PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `silab`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` bigint(20) unsigned NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  `Surname` varchar(30) COLLATE utf8_bin NOT NULL,
  `Login` varchar(30) COLLATE utf8_bin NOT NULL,
  `Password` varchar(30) COLLATE utf8_bin NOT NULL,
  `Permissions` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `Name`, `Surname`, `Login`, `Password`, `Permissions`) VALUES
(2, 'Jan', 'Nowak', 'jnowak', 'jnowak', 3),
(8, 'Michał', 'Michałski', 'mmichalski', 'mmichalski', 4),
(48, 'testowy', 'testowy', 'testowy', 'testowy', 1),
(50, 'Adam', 'Aniedam', 'Adamski', 'adam111', 0),
(51, 'NowyUser', 'NowyUser', 'NowyUser', 'NowyUser', 0),
(70, 'abecadlo', 'abecadlo', 'abecadlo', 'abecadlo', 0),
(72, '123456', '123456', '123456', '123456', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
`ID` bigint(20) unsigned NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  `Surname` varchar(30) COLLATE utf8_bin NOT NULL,
  `Sex` varchar(15) COLLATE utf8_bin NOT NULL,
  `MaidenName` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(60) COLLATE utf8_bin NOT NULL,
  `ZipCode` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `workers`
--

INSERT INTO `workers` (`ID`, `Name`, `Surname`, `Sex`, `MaidenName`, `Email`, `ZipCode`) VALUES
(28, 'pracownik3', 'pracownik3', 'mÄ™Å¼czyzna', 'pracownik3', 'pracownik3@op.pl', '88-965'),
(29, 'pracownik4', 'pracownik4', 'mÄ™Å¼czyzna', 'pracownik4', 'pracownik4@a.pl', '66-985'),
(31, 'pracownik11', 'pracownik11', 'mÄ™Å¼czyzna', 'pracownik11', 'pracownik11@1.pl', '55-665'),
(32, 'pracownik12', 'pracownik12', 'mÄ™Å¼czyzna', 'pracownik12', 'pracownik12@12.pl', '42-365'),
(41, 'Jan', 'Nowak', 'mÄ™Å¼czyzna', 'Nowak', 'jnowak@o.pl', '88-888'),
(42, 'Jan', 'Jan', 'kobieta', 'jan', 'a@a.pl', '88-888'),
(43, 'Janek', 'Janek', 'mÄ™Å¼czyzna', 'Janek', 'jan@ek.pl', '88-999'),
(44, 'Janek1', 'Janwwk', 'mÄ™Å¼czyzna', 'Janek', 'jan@jan.pl', '33-333'),
(45, 'Jan', 'Janek', 'mÄ™Å¼czyzna', 'janek', 'jan@jan.pl', '88-998'),
(46, 'Adam', 'Adam', 'kobieta', 'Adam', 'a@dam.pl', '22-333'),
(47, 'Janeuk', 'jajajajaja', 'mÄ™Å¼czyzna', 'jajajajaja', 'ja@ja.pl', '22-333'),
(48, 'Jane1', 'janek', 'mÄ™Å¼czyzna', 'janekkk', 'aa@aa.pl', '65-895'),
(49, 'Janek', 'Janek', 'kobieta', 'aaaaaaa', 'a@b.pl', '85-999');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT dla tabeli `workers`
--
ALTER TABLE `workers`
MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
