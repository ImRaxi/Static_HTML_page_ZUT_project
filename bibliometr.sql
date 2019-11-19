-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Lis 2019, 21:19
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bibliometr`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autorzy`
--

CREATE TABLE `autorzy` (
  `id_autor` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwiako` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `nazwa uczelni` text COLLATE utf8_polish_ci NOT NULL,
  `data utworzenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `autorzy`
--

INSERT INTO `autorzy` (`id_autor`, `imie`, `nazwiako`, `email`, `nazwa uczelni`, `data utworzenia`) VALUES
(1, 'Igor', 'Jakubowski', 'i.jakubowski@gmail.com', 'ZUT', '2019-11-11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autorzy_publikacja`
--

CREATE TABLE `autorzy_publikacja` (
  `id_autor` int(11) NOT NULL,
  `id_publikacji` int(11) NOT NULL,
  `id_DOI` int(11) NOT NULL,
  `id_punkt` int(11) NOT NULL,
  `współautor` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `data publikacji` date NOT NULL,
  `tytuł` text COLLATE utf8_polish_ci NOT NULL,
  `publikacja` text CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `nazwa uczelni` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `autorzy_publikacja`
--

INSERT INTO `autorzy_publikacja` (`id_autor`, `id_publikacji`, `id_DOI`, `id_punkt`, `współautor`, `data publikacji`, `tytuł`, `publikacja`, `nazwa uczelni`) VALUES
(0, 0, 0, 0, 'Filip Szeszko', '2019-11-11', 'Moja pierwsza publikacja', 'Adres HTML', 'ZUT');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `publikacje`
--

CREATE TABLE `publikacje` (
  `id_autor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_publikacji` int(11) NOT NULL,
  `id_DOI` int(11) NOT NULL,
  `id_punkty` int(11) NOT NULL,
  `współautor` text COLLATE utf8_polish_ci NOT NULL,
  `data publikacji` date NOT NULL,
  `tytuł` text COLLATE utf8_polish_ci NOT NULL,
  `publikacja` text COLLATE utf8_polish_ci NOT NULL,
  `nazwa uczelni` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `publikacje`
--

INSERT INTO `publikacje` (`id_autor`, `id_user`, `id_publikacji`, `id_DOI`, `id_punkty`, `współautor`, `data publikacji`, `tytuł`, `publikacja`, `nazwa uczelni`) VALUES
(0, 0, 0, 0, 0, 'Anna Gołąbek', '2019-11-11', 'Moja druga publikacja', 'Adres HTML', 'ZUT');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `użytkownik`
--

CREATE TABLE `użytkownik` (
  `id_user` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `hasło` text COLLATE utf8_polish_ci NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `email` longtext COLLATE utf8_polish_ci NOT NULL,
  `nazwa uczelni` text COLLATE utf8_polish_ci NOT NULL,
  `data utworzenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `użytkownik`
--

INSERT INTO `użytkownik` (`id_user`, `id_admin`, `nazwa`, `hasło`, `imie`, `nazwisko`, `email`, `nazwa uczelni`, `data utworzenia`) VALUES
(1, 0, 'Użytkownik1', '1234', 'Paweł', 'Krawczak', 'p.krwaczak@gmail.com', 'ZUT', '2019-11-11');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `autorzy`
--
ALTER TABLE `autorzy`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indeksy dla tabeli `użytkownik`
--
ALTER TABLE `użytkownik`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `autorzy`
--
ALTER TABLE `autorzy`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `użytkownik`
--
ALTER TABLE `użytkownik`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
