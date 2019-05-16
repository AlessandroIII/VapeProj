-- TABELLA LIQUIDI

INSERT INTO `liquido` (`id`, `nome`, `prezzo`, `VG`, `PG`, `note`, `creatore`, `prefatto`, `data_inserimento`, `disattivo`) VALUES
(1, 'Ficurinia Ghiacciato', 0.00, 50, 50, '', 4, 0, '2019-04-30 10:36:49', 0),
(3, 'Pomberry Horny Flava', 12.90, 50, 50, 'Fragola, Mango, Melone Maturo e Ghiaccio', 1, 1, '2019-05-02 11:09:42', 0),
(6, 'Nairobi', 25.00, 30, 70, 'Ananas, mango, champagne', 7, 1, '2019-05-04 10:35:32', 0),
(7, 'Cortecca', 0.00, 50, 50, 'Non', 7, 0, '2019-05-04 10:38:15', 0),
(8, 'PepsiTwist ', 0.00, 50, 50, '', 1, 0, '2019-05-04 15:42:12', 0),
(9, 'Prova', 0.00, 50, 50, '', 1, 0, '2019-05-04 22:57:45', 0),
(10, 'Corteccia', 0.00, 50, 50, '', 1, 0, '2019-05-04 22:58:22', 0);

-- TABELLA COMPOSIZIONE
INSERT INTO `composizione` (`id_liquido`, `id_aroma`, `quantita`) VALUES
(1, 3, 10),
(6, 1, 3),
(6, 6, 2),
(6, 2, 4),
(6, 3, 2),
(7, 1, 2),
(7, 6, 2),
(7, 5, 2),
(8, 1, 12),
(8, 2, 12),
(9, 6, 10),
(9, 2, 12),
(10, 5, 10),
(10, 1, 15),
(10, 7, 7);

-- TABELLA LIVELLI
-- INSERT INTO `level` (`id`, `descrizione`, `background_color`, `color`) VALUES
-- (1, 'Basic Activity', '#dff0d8', '#3c763d'),
-- (2, 'New Data', '#ffffff', '#73879c'),
-- (3, 'Update', '#fcf8e3', '#8a6d3b'),
-- (4, 'Delete', '#f2dede', '#a94442');

-- TABELLA AROMA
INSERT INTO `aroma` (`id`, `nome`, `produttore`, `ml`, `prezzo`, `link`, `pezzi`, `dose_consigliata`, `note`, `creatore`, `data_inserimento`, `disattivo`) VALUES
(1, 'Limone ', 'KING LIQUID ', 10.00, 3.90, 'www.svapodream.it', 1, 5, '', '1', '2019-05-03 08:52:50', 0),
(2, 'Coca Cola', 'KING LIQUID', 10.00, 3.90, 'www.svapodream.it', 1, 10, '', '1', '2019-05-03 08:07:46', 0),
(3, 'Ficurinia Ghiacciato', 'DREAMODS', 10.00, 8.00, 'www.svapodream.it', 1, 10, '', '4', '2019-05-03 08:07:43', 0),
(6, 'Cocco', 'KING LIQUID', 10.00, 3.90, 'www.svapodream.it', 1, 12, '', '7', '2019-05-04 10:29:50', 1),
(5, 'Pop Corn', 'KING LIQUID', 10.00, 10.00, 'www.svapodream.it', 1, 5, '', '8', '2019-05-04 09:04:56', 1),
(7, 'Donut ', 'KING LIQUID ', 10.00, 3.90, 'www.svapodream.it', 1, 10, '', '1', '2019-05-04 15:47:57', 0);

-- TABELLA LOG
INSERT INTO `log` (`id`, `azione`, `utente`, `level`, `data_inserimento`) VALUES
(1, ' ha effettuato il logout', 1, 1, '2019-05-04 12:05:12'),
(2, ' ha effettuato il login', 1, 1, '2019-05-04 12:05:14'),
(3, ' ha effettuato il login', 7, 1, '2019-05-04 12:22:15'),
(4, ' ha inserito Cocco', 7, 2, '2019-05-04 12:23:14'),
(5, ' ha effettuato il login', 1, 1, '2019-05-04 12:25:54'),
(6, ' ha eliminato 6', 7, 4, '2019-05-04 12:29:50'),
(7, ' ha eliminato 6', 7, 4, '2019-05-04 12:29:53'),
(8, ' ha effettuato il logout', 1, 1, '2019-05-04 12:31:08'),
(9, ' ha effettuato il login', 4, 1, '2019-05-04 12:31:24'),
(10, ' ha effettuato il logout', 4, 1, '2019-05-04 12:34:11'),
(11, ' ha effettuato il login', 1, 1, '2019-05-04 12:34:16'),
(12, ' ha eliminato 7', 7, 4, '2019-05-04 12:38:23'),
(13, ' ha eliminato 6', 7, 4, '2019-05-04 12:38:26'),
(14, ' ha effettuato il logout', 7, 1, '2019-05-04 12:44:12'),
(15, ' ha effettuato il login', 9, 1, '2019-05-04 12:44:59'),
(16, ' ha effettuato il login', 1, 1, '2019-05-04 13:52:14'),
(17, ' ha disconnesso tutti gli utenti', 1, 3, '2019-05-04 13:53:16'),
(18, ' ha modificato il suo profilo', 1, 2, '2019-05-04 14:09:11'),
(19, ' ha modificato il suo profilo', 1, 2, '2019-05-04 14:09:22'),
(20, ' ha modificato il suo profilo', 1, 2, '2019-05-04 14:09:30'),
(21, ' ha modificato il suo profilo', 1, 2, '2019-05-04 15:10:49'),
(22, ' ha effettuato il logout', 1, 1, '2019-05-04 15:10:50'),
(23, ' ha effettuato il login', 1, 1, '2019-05-04 15:10:52'),
(24, ' ha modificato il suo profilo', 1, 2, '2019-05-04 15:11:11'),
(25, ' ha modificato il suo profilo', 1, 2, '2019-05-04 15:11:22'),
(26, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:07:05'),
(27, ' ha effettuato il logout', 1, 1, '2019-05-04 16:08:13'),
(28, ' ha effettuato il login', 1, 1, '2019-05-04 16:08:18'),
(29, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:08:23'),
(30, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:08:31'),
(31, ' ha effettuato il logout', 1, 1, '2019-05-04 16:20:50'),
(32, ' ha effettuato il login', 1, 1, '2019-05-04 16:20:56'),
(33, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:21:04'),
(34, ' ha effettuato il logout', 1, 1, '2019-05-04 16:21:14'),
(35, ' ha effettuato il login', 1, 1, '2019-05-04 16:21:25'),
(36, ' ha effettuato il logout', 1, 1, '2019-05-04 16:21:28'),
(37, ' ha effettuato il login', 4, 1, '2019-05-04 16:22:07'),
(38, ' ha effettuato il logout', 1, 1, '2019-05-04 16:22:24'),
(39, ' ha effettuato il login', 1, 1, '2019-05-04 16:22:53'),
(40, ' ha effettuato il logout', 4, 1, '2019-05-04 16:23:54'),
(41, ' ha effettuato il login', 4, 1, '2019-05-04 16:23:56'),
(42, ' ha effettuato il login', 1, 1, '2019-05-04 16:24:36'),
(43, ' ha effettuato il login', 1, 1, '2019-05-04 16:26:49'),
(44, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:27:11'),
(45, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:27:29'),
(46, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:32:30'),
(47, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:54:34'),
(48, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:54:42'),
(49, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:54:48'),
(50, ' ha modificato il suo profilo', 1, 2, '2019-05-04 16:55:00'),
(51, ' ha effettuato il login', 1, 1, '2019-05-04 17:45:56'),
(52, ' ha inserito Donut ', 1, 2, '2019-05-04 17:47:57'),
(53, ' ha disattivato tutti gli utenti', 1, 4, '2019-05-04 17:48:54'),
(54, ' ha disconnesso tutti gli utenti', 1, 3, '2019-05-04 17:48:55'),
(55, ' ha riattivato tutti gli utenti', 1, 3, '2019-05-04 17:49:05'),
(56, ' ha disconnesso tutti gli utenti', 1, 3, '2019-05-04 17:49:27'),
(57, ' ha effettuato il login', 1, 1, '2019-05-05 00:56:35'),
(58, ' ha effettuato il login', 1, 1, '2019-05-05 12:17:04');









