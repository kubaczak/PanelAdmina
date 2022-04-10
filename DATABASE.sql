-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Cze 2021, 14:39
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `psi3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `nazwa`) VALUES
(1, 'Zdjęcia'),
(2, 'Natura'),
(3, 'Programowanie'),
(4, 'Vlog');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loginlog`
--

CREATE TABLE `loginlog` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `adres_ip` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `loginlog`
--

INSERT INTO `loginlog` (`ID`, `user_ID`, `data`, `token`, `adres_ip`) VALUES
(1, 1, '2021-05-16 21:18:34', '07GRpX1EfLDBE4sSImM5sfEjQr4F83G2bdYRswzzUXXLt9ZUXOBTLhv0rSirCGzq', '::1'),
(2, 1, '2021-05-17 20:30:29', 'zAUOMo7UAE0ShsbO1VBBBwO6vXedGkGckuOdMAVLn0cFqjDAWPExrbucl8WNh9Fz', '::1'),
(3, 1, '2021-05-17 21:22:02', 'AVPb6XJJBFpMN2BhcI3Hpp8GxRc1wy7XqQ4tgiAmUkKh51c3W0EFYZkKiCYP92Jl', '::1'),
(4, 1, '2021-05-20 17:22:17', '5ad6zFglRIZe8iQbntxxNaSNeNhB5OZPFfJYpuIODDN91JN4lf3O9lmhFczU4I2w', '::1'),
(5, 1, '2021-05-22 12:04:17', 'CZ2rLAgBcfJxnjeys78zISQcOlk9Q9Ppw5F2B0gW7H4yw259krftGmXGcGBkVDSX', '::1'),
(6, 1, '2021-05-22 12:11:21', 'VjuYITHbYU7MaRSIhuLgx4e6geizHl01x0E4jq3DLfLBQsaq17cO5pJMGPbTbUJj', '::1'),
(7, 1, '2021-05-22 13:23:13', 'aiXeNt57bPO9Iu0KVfJp8lcguQMh3e8kfQkoAQAMgque1atdFiaoqVtvFDfpbJI6', '::1'),
(8, 1, '2021-05-23 21:58:48', 'W1SnN8HPmuOjBPzaJujdBhft6my4JlqKBvLAsBfp9RF71B67268itowsvYZHLHxZ', '::1'),
(9, 1, '2021-05-25 11:41:13', 'PyUxf9LMy3KyQ08WqC71f5sJ3taVvQiT88BGKxOWYS4qrNEzLQQg041kEur01K5G', '::1'),
(10, 1, '2021-05-25 19:11:17', 'qAk1BPUftLaoPSnRchjXAyy2NxGuAzlemolYUase6quWAWrQGOUnGyc0gVhMQR0d', '::1'),
(11, 1, '2021-06-04 18:28:02', '13HeTgpIRWocYoCz8ahA0ymxcGB6XPP2xHKkmFj8oHM98JTonDh4lZsUm3Wty3Rz', '::1'),
(12, 1, '2021-06-05 11:55:54', 'axasq0VS6Bf7u7CHHcGMiaXzcqNETVlvr05TRuxiAKHD3puvKkgVev6OWO00DfmB', '::1'),
(13, 1, '2021-06-05 12:12:16', 'xeRK0Wx99sZmMFULdMtVtzekSLyOYNxOQ0aZtCCynqJaKzdQjWgp2sIiU5bgFsuG', ''),
(14, 1, '2021-06-05 12:13:25', '6c3bnETMnNHaHlWnxq3GofvcIaFdiyH0YMEoVPQYcz87nxX58QA2E7kTX0V8Xlj4', ''),
(15, 1, '2021-06-05 12:13:58', 'iqnvEoBAbJ215o9M55HB2rF3uzVkXngCS62REYyHEPxBy7EaFgPLAkpIEMnBXehh', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `tags` varchar(512) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `photo` varchar(1024) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`id`, `status`, `title`, `slug`, `content`, `category`, `tags`, `creator`, `data`, `photo`) VALUES
(1, 1, 'Małe i ładne kotki', 'first-post', 'Tutaj widzicie kotka. Na ogół jest on dosyć słodki, w sumie jak wszystkie zwierzątka. A więc myślę że się wam podoba a teraz następny kotek. Tak masz racje ten kotek też jest bardzo ładny.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nlol', 2, '#kotki', 1, '2021-05-20 16:46:20', ''),
(3, 1, 'Czy kotki są słodkie?', '', 'A więc, TAK! Kotki są słodkie! Kotki to najsłodsze zwierzątka czteronożne na świecie? Nie wierzysz mi? Wystarczy na nie spojrzeć. Mimo że te małe diabełki strasznie się lenią oraz drapią, ich puszysta sierść oraz mruczenie sprawia że żaden człowiek na ziemi nie jest w stanie się im oprzeć!\r\n\r\nTwierdzisz, że ty dasz radę? Otóż nie! Jesteś wielkim błędzie!\r\n\r\nA wiedziałeś, że dodatkowo mają śliczne oczka! Niesamowite!\r\n\r\nAle ich pogryzienie nadal boli...', 4, '#cat #cute #eyes', 1, '2021-05-22 14:48:42', 'https://www.koty.pl/wp-content/uploads/2013/09/czarny-kot.jpg'),
(4, 1, 'Czy jestem warty twojej uwagi? ', 'edited', 'A co gdyby tak jednego dnia z samego rana po prostu się nie obudzić? Ktos by po płakał? Kto by pamiętał o moim życiu i kto by pomyślał ile cierpienia i swojego zaangażowania muszę wprowadzić aby nie sprawić zawodu ludziom w moim otoczeniu. A co gdybym był zapamiętany, ale jednak nie wiedział jaki mam pomysł na życie? No bo, co jeśli zostane zapamiętany ze względu na mój codzienny tryb życia, albo na moją tqórczość. Chciałbym abym został zapamiętany jako bohater. Tak po prostu, nie chcę aby ktoś myślał że nie byłem winny żadnemu człowiekowi chociażby kroplę krwi albo innego rodzaju płynu ustrojowego. Jedyne o czym marzę to to, aby nie musieć martwić się o każdy kolejny dzień i o to abym mógł po prostu myśleć o codziennych sprawach i ze spokojem lub nawet z pełym uśmiechem po prostu iść spać i widzieć kolejny dzień kolejnego dnia. No wiesz, niby to nic niezwykłego ale naprawdę marzę o tym całym sercem.', 4, '#lol #haha #moje_życie', 1, '2021-05-22 17:33:19', 'https://www.imperiumtapet.com/public/uploads/preview/dmuchawiec-311535375398jtaaiaoqd6.jpg'),
(6, 1, 'Ile dni ma rok?', '', 'Aby utworzyć nową stronę w moim panelu administratora, należy kliknąć w przycisk \"Utwórz nowy post\" w górnej części panelu. Gdy to zrobimy pojawi się nam strona do tworzenia nowego postu. Wystarczy, że wypełnimy wszystkie tabelki zgodnie z naszym zapotrzebowaniem i strona będzie gotowa.\r\n\r\nDziękuję bardzo, zostaw like komentarz i zapisz tą stronę do ulubionych!\r\n\r\nZedytować', 3, '#poradnik #pomoc #tutorial', 1, '2021-05-23 22:01:48', ''),
(7, 1, 'Testowy post', 'first', 'Utworzyłem zwykły testowy post, aby sprawdzić jak działa sytuowanie kolejnych postów pod sobą. Mam nadzieję że będzie to wyglądać w miarę fajnie i nie wybuchnie, bo byłoby szkoda gdyby wybuchło XD', 1, '#test', 1, '2021-06-05 11:49:55', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `imie` varchar(255) DEFAULT NULL,
  `nazwisko` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `haslo` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `imie`, `nazwisko`, `email`, `haslo`, `login`) VALUES
(1, 'Jakub', 'Wisniewski', '', '', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `loginlog`
--
ALTER TABLE `loginlog`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `loginlog`
--
ALTER TABLE `loginlog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
