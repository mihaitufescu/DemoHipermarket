-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 12, 2023 la 10:17 PM
-- Versiune server: 10.4.14-MariaDB
-- Versiune PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `hipermarket`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `angajat`
--

CREATE TABLE `angajat` (
  `id_angajat` int(11) NOT NULL,
  `serie_casa` int(11) DEFAULT NULL,
  `functie` varchar(32) NOT NULL,
  `salariu` int(5) NOT NULL,
  `nume_angajat` varchar(32) NOT NULL,
  `nr_telefon` varchar(12) NOT NULL,
  `data_angajare` date NOT NULL,
  `id_manager` int(11) DEFAULT NULL
) ;

--
-- Eliminarea datelor din tabel `angajat`
--

INSERT INTO `angajat` (`id_angajat`, `serie_casa`, `functie`, `salariu`, `nume_angajat`, `nr_telefon`, `data_angajare`, `id_manager`) VALUES
(12453, 24345, 'casier', 2850, 'Vaduva Alexandru', '0774897098', '2023-02-11', 12342),
(12454, 24346, 'manager', 3000, 'Popescu Maria', '0774897097', '2023-03-12', 0),
(12455, 24347, 'vanzator', 2500, 'Ionescu Ion', '0774897096', '2023-04-13', 12344);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bilant`
--

CREATE TABLE `bilant` (
  `cod_inregistrare` int(11) NOT NULL,
  `id_angajat` int(11) DEFAULT NULL,
  `capital` float NOT NULL,
  `profit` float DEFAULT NULL,
  `pierderi` float DEFAULT NULL
) ;

--
-- Eliminarea datelor din tabel `bilant`
--

INSERT INTO `bilant` (`cod_inregistrare`, `id_angajat`, `capital`, `profit`, `pierderi`) VALUES
(67554, 12453, 5677440, 2467450, 0),
(67555, 12454, 6578560, 2578560, NULL),
(67556, 12455, 7489670, 2689670, NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `casa_de_marcat`
--

CREATE TABLE `casa_de_marcat` (
  `serie_casa` int(11) NOT NULL,
  `nume_model` varchar(32) NOT NULL,
  `data_revizie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `casa_de_marcat`
--

INSERT INTO `casa_de_marcat` (`serie_casa`, `nume_model`, `data_revizie`) VALUES
(24345, 'Tremol2', '2023-02-13'),
(24346, 'Samsung', '2023-03-10'),
(24347, 'Sharp', '2023-04-10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `contract`
--

CREATE TABLE `contract` (
  `id_contract` int(11) NOT NULL,
  `id_furnizor` int(11) NOT NULL,
  `data_incheiere_contract` date NOT NULL,
  `data_expirare_contract` date NOT NULL,
  `contravaloare` float NOT NULL
) ;

--
-- Eliminarea datelor din tabel `contract`
--

INSERT INTO `contract` (`id_contract`, `id_furnizor`, `data_incheiere_contract`, `data_expirare_contract`, `contravaloare`) VALUES
(56563, 67877, '2023-01-08', '2023-02-18', 789006),
(56564, 67878, '2023-03-08', '2023-04-18', 879107),
(56565, 67879, '2023-05-08', '2023-06-18', 969208);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `furnizor`
--

CREATE TABLE `furnizor` (
  `id_furnizor` int(11) NOT NULL,
  `nr_telefon_furnizor` varchar(12) NOT NULL,
  `adresa` varchar(64) NOT NULL,
  `nume_furnizor` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `furnizor`
--

INSERT INTO `furnizor` (`id_furnizor`, `nr_telefon_furnizor`, `adresa`, `nume_furnizor`) VALUES
(67877, '0786567324', 'Bucuresti, Str. Padesu, Nr.1, Bloc 1B, Et.2, Ap.56', 'SC Romprest SA'),
(67878, '0786567326', 'Timisoara, Str. Mihai Viteazul, Nr.3, Bloc 3C, Et.4, Ap.90', 'SC Prodair SA'),
(67879, '0786567325', 'Cluj-Napoca, Str. Independentei, Nr.2, Bloc 2A, Et.3, Ap.78', 'SC Fructex SA');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `inchidere_casa`
--

CREATE TABLE `inchidere_casa` (
  `id_inchidere_casa` int(11) NOT NULL,
  `serie_casa` int(11) NOT NULL,
  `inventar_monetar` float NOT NULL,
  `pierderi` float NOT NULL,
  `data_inchidere_casa` date NOT NULL
) ;

--
-- Eliminarea datelor din tabel `inchidere_casa`
--

INSERT INTO `inchidere_casa` (`id_inchidere_casa`, `serie_casa`, `inventar_monetar`, `pierderi`, `data_inchidere_casa`) VALUES
(233422, 24345, 6789.54, 23, '2023-01-11'),
(233423, 24346, 7890.65, 12, '2023-02-10'),
(233424, 24347, 8901.76, 34, '2023-03-10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `produs`
--

CREATE TABLE `produs` (
  `id_produs` int(11) NOT NULL,
  `id_raion` int(11) DEFAULT NULL,
  `id_furnizor` int(11) NOT NULL,
  `nume_produs` varchar(32) NOT NULL,
  `tip_produs` varchar(32) NOT NULL,
  `data_expirare` date DEFAULT NULL
) ;

--
-- Eliminarea datelor din tabel `produs`
--

INSERT INTO `produs` (`id_produs`, `id_raion`, `id_furnizor`, `nume_produs`, `tip_produs`, `data_expirare`) VALUES
(35332, 4567, 67877, 'Lapte semidegresat UHT 1.5%', 'Lapte', '2023-04-13'),
(35333, 4568, 67878, 'Salam de Sibiu', 'Carne', '2023-05-14'),
(35334, 4569, 67879, 'Mere Golden', 'Fructe', '2023-06-15');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `raion`
--

CREATE TABLE `raion` (
  `id_raion` int(11) NOT NULL,
  `nume_raion` varchar(32) NOT NULL,
  `numar_angajati_repartizati` int(2) NOT NULL
) ;

--
-- Eliminarea datelor din tabel `raion`
--

INSERT INTO `raion` (`id_raion`, `nume_raion`, `numar_angajati_repartizati`) VALUES
(4567, 'Lactate', 2),
(4568, 'Carne', 3),
(4569, 'Fructe', 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `repartitie_raion`
--

CREATE TABLE `repartitie_raion` (
  `id_angajat` int(11) NOT NULL,
  `id_raion` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `repartitie_raion`
--

INSERT INTO `repartitie_raion` (`id_angajat`, `id_raion`, `data`) VALUES
(12453, 4567, '2023-01-13'),
(12454, 4568, '2023-02-14'),
(12455, 4569, '2023-03-15');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `angajat`
--
ALTER TABLE `angajat`
  ADD PRIMARY KEY (`id_angajat`),
  ADD UNIQUE KEY `nr_telefon` (`nr_telefon`),
  ADD KEY `fk_serie_casa` (`serie_casa`);

--
-- Indexuri pentru tabele `bilant`
--
ALTER TABLE `bilant`
  ADD PRIMARY KEY (`cod_inregistrare`),
  ADD KEY `fk_angajat_bilant` (`id_angajat`);

--
-- Indexuri pentru tabele `casa_de_marcat`
--
ALTER TABLE `casa_de_marcat`
  ADD PRIMARY KEY (`serie_casa`);

--
-- Indexuri pentru tabele `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id_contract`),
  ADD KEY `fk_furnizor_contract` (`id_furnizor`);

--
-- Indexuri pentru tabele `furnizor`
--
ALTER TABLE `furnizor`
  ADD PRIMARY KEY (`id_furnizor`),
  ADD UNIQUE KEY `nr_telefon_furnizor` (`nr_telefon_furnizor`),
  ADD UNIQUE KEY `adresa` (`adresa`),
  ADD UNIQUE KEY `nume_furnizor` (`nume_furnizor`);

--
-- Indexuri pentru tabele `inchidere_casa`
--
ALTER TABLE `inchidere_casa`
  ADD PRIMARY KEY (`id_inchidere_casa`),
  ADD KEY `fk_inchidere_casa` (`serie_casa`);

--
-- Indexuri pentru tabele `produs`
--
ALTER TABLE `produs`
  ADD PRIMARY KEY (`id_produs`),
  ADD KEY `fk_raion` (`id_raion`),
  ADD KEY `fk_furnizor_produs` (`id_furnizor`);

--
-- Indexuri pentru tabele `raion`
--
ALTER TABLE `raion`
  ADD PRIMARY KEY (`id_raion`),
  ADD UNIQUE KEY `nume_raion` (`nume_raion`);

--
-- Indexuri pentru tabele `repartitie_raion`
--
ALTER TABLE `repartitie_raion`
  ADD PRIMARY KEY (`id_raion`,`id_angajat`),
  ADD KEY `fk_repartitie_angajat` (`id_angajat`,`id_raion`) USING BTREE;

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `angajat`
--
ALTER TABLE `angajat`
  MODIFY `id_angajat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `bilant`
--
ALTER TABLE `bilant`
  MODIFY `cod_inregistrare` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `casa_de_marcat`
--
ALTER TABLE `casa_de_marcat`
  MODIFY `serie_casa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24348;

--
-- AUTO_INCREMENT pentru tabele `contract`
--
ALTER TABLE `contract`
  MODIFY `id_contract` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `furnizor`
--
ALTER TABLE `furnizor`
  MODIFY `id_furnizor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67880;

--
-- AUTO_INCREMENT pentru tabele `inchidere_casa`
--
ALTER TABLE `inchidere_casa`
  MODIFY `id_inchidere_casa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `produs`
--
ALTER TABLE `produs`
  MODIFY `id_produs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `raion`
--
ALTER TABLE `raion`
  MODIFY `id_raion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `angajat`
--
ALTER TABLE `angajat`
  ADD CONSTRAINT `fk_serie_casa` FOREIGN KEY (`serie_casa`) REFERENCES `casa_de_marcat` (`serie_casa`);

--
-- Constrângeri pentru tabele `bilant`
--
ALTER TABLE `bilant`
  ADD CONSTRAINT `fk_angajat_bilant` FOREIGN KEY (`id_angajat`) REFERENCES `angajat` (`id_angajat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constrângeri pentru tabele `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `fk_furnizor_contract` FOREIGN KEY (`id_furnizor`) REFERENCES `furnizor` (`id_furnizor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `inchidere_casa`
--
ALTER TABLE `inchidere_casa`
  ADD CONSTRAINT `fk_inchidere_casa` FOREIGN KEY (`serie_casa`) REFERENCES `casa_de_marcat` (`serie_casa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `produs`
--
ALTER TABLE `produs`
  ADD CONSTRAINT `fk_furnizor_produs` FOREIGN KEY (`id_furnizor`) REFERENCES `furnizor` (`id_furnizor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_raion` FOREIGN KEY (`id_raion`) REFERENCES `raion` (`id_raion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `repartitie_raion`
--
ALTER TABLE `repartitie_raion`
  ADD CONSTRAINT `fk_repartitie_angajat` FOREIGN KEY (`id_angajat`) REFERENCES `angajat` (`id_angajat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_repartitie_raion` FOREIGN KEY (`id_raion`) REFERENCES `raion` (`id_raion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
