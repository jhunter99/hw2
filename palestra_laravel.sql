-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 25, 2021 alle 21:29
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palestra_laravel`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `abbonamento`
--

CREATE TABLE `abbonamento` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `corso` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `quota` float DEFAULT NULL,
  `scadenza` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `abbonamento`
--

INSERT INTO `abbonamento` (`id`, `cliente`, `corso`, `tipo`, `data_inizio`, `quota`, `scadenza`) VALUES
(11, 2, 1, 'annuale', '2021-06-25', 300, '2022-06-25'),
(12, 2, 3, 'mensile', '2021-06-12', 40, '2021-07-12'),
(14, 1, 2, 'semestrale', '2021-06-25', 180, '2021-12-25'),
(15, 1, 1, 'mensile', '2021-06-17', 40, '2021-07-17');

--
-- Trigger `abbonamento`
--
DELIMITER $$
CREATE TRIGGER `allinea_num_iscritti` BEFORE INSERT ON `abbonamento` FOR EACH ROW begin
    CASE NEW.corso
            WHEN '1' THEN update corso set num_iscritti=num_iscritti+1 where corso.nome = 'SALA PESI';
            WHEN '2' THEN update corso set num_iscritti=num_iscritti+1 where corso.nome = 'ZUMBA';
            WHEN '3' THEN update corso set num_iscritti=num_iscritti+1 where corso.nome = 'FUNCTIONAL TRAINING';
            WHEN '4' THEN update corso set num_iscritti=num_iscritti+1 where corso.nome = 'INDOOR CYCLING';
            WHEN '5' THEN update corso set num_iscritti=num_iscritti+1 where corso.nome = 'KARATE';
            WHEN '6' THEN update corso set num_iscritti=num_iscritti+1 where corso.nome = 'GINNASTICA CORRETTIVA';
    END CASE;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blocco_homepage`
--

CREATE TABLE `blocco_homepage` (
  `id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `image_src` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `blocco_homepage`
--

INSERT INTO `blocco_homepage` (`id`, `title`, `image_src`, `description`) VALUES
(1, 'Corsi', 'img/CORSI.jpg', 'La nostra ampia offerta di corsi'),
(2, 'Sala Pesi', 'img/SALA PESI.jpg', 'Gli esercizi che è possibile fare in Sala Pesi'),
(3, 'Orari', 'img/ORARI.png', 'La tabella completa con gli orari dei corsi'),
(4, 'Stage', 'img/STAGE.jpeg', 'Gli Stage organizzati per i nostri clienti'),
(5, 'Staff', 'img/STAFF.jpg', 'Il dirigente, il personale di segreteria e gli istruttori'),
(6, 'Gallery', 'img/GALLERY.jpg', 'Una carrellata dei momenti vissuti alla Power Fitness Gym');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cognome`, `data_di_nascita`, `email`, `username`, `password`) VALUES
(1, 'Erika', 'Bini', '2000-06-22', 'erikabini2000@outlook.it', 'Erika2000', 'Bini2000!'),
(2, 'Giuseppe', 'Salvatori', '2002-05-07', 'giuseppesalvatori@gmail.com', 'Giuseppe02', 'Salvatori02!'),
(3, 'Rosanna', 'Schiavo', '1987-07-15', 'rosannaschiavo@outlook.it', 'Rosanna87', 'Schiavo87!'),
(4, 'Dylan', 'Mare', '1992-02-24', 'dylanmare@gmail.com', 'Dylan92', 'Mare92!!'),
(5, 'Alessia', 'Ragusa', '2004-09-15', 'alessiaragusa@gmail.com', 'Alessia04', 'Ragusa04!');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `num_iscritti` int(11) DEFAULT NULL,
  `image_url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`id`, `nome`, `num_iscritti`, `image_url`) VALUES
(1, 'SALA PESI', 2, 'img/SALA_PESI2.jpg'),
(2, 'ZUMBA', 1, 'img/ZUMBA2.jpg'),
(3, 'FUNCTIONAL TRAINING', 1, 'img/FUNCTIONAL_TRAINING.jpg'),
(4, 'INDOOR CYCLING', 0, 'img/INDOOR_CYCLING2.jpg'),
(5, 'KARATE', 0, 'img/KARATE2.jpg'),
(6, 'GINNASTICA CORRETTIVA', 0, 'img/GINNASTICA_CORRETTIVA.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnamento`
--

CREATE TABLE `insegnamento` (
  `id` int(11) NOT NULL,
  `istruttore` int(11) NOT NULL,
  `corso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `insegnamento`
--

INSERT INTO `insegnamento` (`id`, `istruttore`, `corso`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 3, 5),
(5, 4, 3),
(6, 4, 4),
(7, 5, 6),
(8, 6, 4),
(9, 7, 1),
(10, 8, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `istruttore`
--

CREATE TABLE `istruttore` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `formazione` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `istruttore`
--

INSERT INTO `istruttore` (`id`, `nome`, `cognome`, `data_di_nascita`, `formazione`) VALUES
(1, 'Marcello', 'Barbieri', '1990-05-18', 'CERTIFICAZIONE FIF'),
(2, 'Lorella', 'Sala', '1985-08-06', 'CERTIFICAZIONE ZUMBA ACADEMY'),
(3, 'Benedetto', 'Filippini', '1961-07-26', 'CERTIFICAZIONE CONI'),
(4, 'Luciano', 'Benetti', '1973-10-09', 'CERTIFICAZIONE FIF'),
(5, 'Umberto', 'Lucci', '1977-03-15', 'LAUREA IN SCIENZE MOTORIE'),
(6, 'Saverio', 'Costantini', '1985-02-11', 'CERTIFICAZIONE FIF'),
(7, 'Gianluigi', 'Lelli', '1987-12-30', 'CERTIFICAZIONE FIF'),
(8, 'Tatiana', 'Pagani', '1983-11-14', 'CERTIFICAZIONE FIF');

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `id` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `titolo` varchar(30) DEFAULT NULL,
  `image_src` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`id`, `cliente`, `titolo`, `image_src`) VALUES
(86, 3, 'Stage', 'img/STAGE.jpeg'),
(87, 3, 'Gallery', 'img/GALLERY.jpg'),
(88, 3, 'Orari', 'img/ORARI.png'),
(89, 3, 'Corsi', 'img/CORSI.jpg'),
(94, 1, 'Corsi', 'img/CORSI.jpg'),
(95, 1, 'Sala Pesi', 'img/SALA PESI.jpg'),
(111, 2, 'Corsi', 'img/CORSI.jpg'),
(114, 2, 'Sala Pesi', 'img/SALA PESI.jpg'),
(115, 2, 'Orari', 'img/ORARI.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `ricetta`
--

CREATE TABLE `ricetta` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ingredienti` varchar(200) DEFAULT NULL,
  `calorie` varchar(30) DEFAULT NULL,
  `grassi` varchar(30) DEFAULT NULL,
  `grassi_saturi` varchar(30) DEFAULT NULL,
  `carboidrati` varchar(30) DEFAULT NULL,
  `zuccheri` varchar(30) DEFAULT NULL,
  `proteine` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ricetta`
--

INSERT INTO `ricetta` (`id`, `cliente`, `nome`, `ingredienti`, `calorie`, `grassi`, `grassi_saturi`, `carboidrati`, `zuccheri`, `proteine`) VALUES
(45, 2, 'cena lunedì', '200g pollo, 100g pane, 70g lattuga', '706kcal', '33.514g', '9.4173g', '50.241g', '6.5680000000000005g', '48.865g'),
(52, 1, 'pranzo giovedì', '100g pasta, 30g olio, 40g formaggio', '798kcal', '45.038000000000004g', '10.233699999999999g', '75.202g', '2.782g', '22.656g');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abbonamento`
--
ALTER TABLE `abbonamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new_cliente` (`cliente`),
  ADD KEY `new_corso` (`corso`);

--
-- Indici per le tabelle `blocco_homepage`
--
ALTER TABLE `blocco_homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `insegnamento`
--
ALTER TABLE `insegnamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new_corso` (`corso`),
  ADD KEY `new_istruttore` (`istruttore`);

--
-- Indici per le tabelle `istruttore`
--
ALTER TABLE `istruttore`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cliente` (`cliente`,`titolo`),
  ADD KEY `new_cliente` (`cliente`);

--
-- Indici per le tabelle `ricetta`
--
ALTER TABLE `ricetta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cliente` (`cliente`,`nome`),
  ADD KEY `new_cliente` (`cliente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `abbonamento`
--
ALTER TABLE `abbonamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `blocco_homepage`
--
ALTER TABLE `blocco_homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `insegnamento`
--
ALTER TABLE `insegnamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `istruttore`
--
ALTER TABLE `istruttore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT per la tabella `ricetta`
--
ALTER TABLE `ricetta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `abbonamento`
--
ALTER TABLE `abbonamento`
  ADD CONSTRAINT `abbonamento_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `abbonamento_ibfk_2` FOREIGN KEY (`corso`) REFERENCES `corso` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `insegnamento`
--
ALTER TABLE `insegnamento`
  ADD CONSTRAINT `insegnamento_ibfk_1` FOREIGN KEY (`istruttore`) REFERENCES `istruttore` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `insegnamento_ibfk_2` FOREIGN KEY (`corso`) REFERENCES `corso` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `ricetta`
--
ALTER TABLE `ricetta`
  ADD CONSTRAINT `ricetta_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
