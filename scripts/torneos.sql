/* ============================================================
   ESQUEMA Y DATOS DE PRUEBA DEL TORNEO
   Crea las tablas y mete regiones, jugadores, personajes,
   rankings, torneos y la inscripcion (seeds) del torneo 1.
   ============================================================ */
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/* ============================================================
   REGION
   Localidades a las que se asigna un jugador o un torneo.
   ============================================================ */
CREATE TABLE `region` (
  `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `localidad` varchar(150) NOT NULL
);

INSERT INTO `region` (`id`, `localidad`) VALUES
(1, 'Huelva'),
(2, 'Sevilla'),
(3, 'Madrid'),
(4, 'Barcelona'),
(5, 'Malaga'),
(6, 'Valencia'),
(7, 'Murcia'),
(8, 'Cadiz');

/* ============================================================
   JUGADOR
   Cuenta de login. usuario es el nick que se ve en el cuadro.
   ============================================================ */
CREATE TABLE `jugador` (
  `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `usuario` varchar(150) NOT NULL UNIQUE,
  `pass` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `puntuacion` int(5) NOT NULL DEFAULT 0,
  `img` varchar(150) NOT NULL DEFAULT 'default.png',
  `id_region` int(5) NOT NULL,
  CONSTRAINT fk_region_jugador FOREIGN KEY (id_region) REFERENCES region(id) ON DELETE restrict ON UPDATE cascade
);

/* ============================================================
   JUGADORES DE PRUEBA
   id 1 = admin / admin (no se inscribe en torneos).
   El resto: usuario y pass jugador2, jugador3, ...
   Se mantienen puntuacion, imagen y region de cada id.
   ============================================================ */
INSERT INTO `jugador` (`id`, `usuario`,`pass`,`nombre`,`apellidos`, `puntuacion`, `img`, `id_region`) VALUES
(1, 'admin', 'admin', 'Admin', '1', 999, 'default.png', 2),
(2, 'jugador2', 'jugador2', 'Jugador', '2', 50, 'default.png', 1),
(3, 'jugador3', 'jugador3', 'Jugador', '3', 900, 'default.png', 1),
(4, 'jugador4', 'jugador4', 'Jugador', '4', 700, 'default.png', 3),
(5, 'jugador5', 'jugador5', 'Jugador', '5', 600, 'default.png', 6),
(6, 'jugador6', 'jugador6', 'Jugador', '6', 400, 'default.png', 7),
(7, 'jugador7', 'jugador7', 'Jugador', '7', 500, 'default.png', 5),
(8, 'jugador8', 'jugador8', 'Jugador', '8', 220, 'default.png', 2),
(9, 'jugador9', 'jugador9', 'Jugador', '9', 121, 'default.png', 1),
(10, 'jugador10', 'jugador10', 'Jugador', '10', 327, 'default.png', 2),
(11, 'jugador11', 'jugador11', 'Jugador', '11', 514, 'default.png', 3),
(12, 'jugador12', 'jugador12', 'Jugador', '12', 974, 'default.png', 4),
(13, 'jugador13', 'jugador13', 'Jugador', '13', 524, 'default.png', 5),
(14, 'jugador14', 'jugador14', 'Jugador', '14', 662, 'default.png', 6),
(15, 'jugador15', 'jugador15', 'Jugador', '15', 880, 'default.png', 7),
(16, 'jugador16', 'jugador16', 'Jugador', '16', 975, 'default.png', 8),
(17, 'jugador17', 'jugador17', 'Jugador', '17', 105, 'default.png', 1),
(18, 'jugador18', 'jugador18', 'Jugador', '18', 905, 'default.png', 2),
(19, 'jugador19', 'jugador19', 'Jugador', '19', 228, 'default.png', 3),
(20, 'jugador20', 'jugador20', 'Jugador', '20', 916, 'default.png', 4),
(21, 'jugador21', 'jugador21', 'Jugador', '21', 615, 'default.png', 5),
(22, 'jugador22', 'jugador22', 'Jugador', '22', 636, 'default.png', 6),
(23, 'jugador23', 'jugador23', 'Jugador', '23', 569, 'default.png', 7),
(24, 'jugador24', 'jugador24', 'Jugador', '24', 430, 'default.png', 8),
(25, 'jugador25', 'jugador25', 'Jugador', '25', 802, 'default.png', 1),
(26, 'jugador26', 'jugador26', 'Jugador', '26', 586, 'default.png', 2),
(27, 'jugador27', 'jugador27', 'Jugador', '27', 560, 'default.png', 3),
(28, 'jugador28', 'jugador28', 'Jugador', '28', 862, 'default.png', 4),
(29, 'jugador29', 'jugador29', 'Jugador', '29', 748, 'default.png', 5),
(30, 'jugador30', 'jugador30', 'Jugador', '30', 795, 'default.png', 6),
(31, 'jugador31', 'jugador31', 'Jugador', '31', 786, 'default.png', 7),
(32, 'jugador32', 'jugador32', 'Jugador', '32', 502, 'default.png', 8),
(33, 'jugador33', 'jugador33', 'Jugador', '33', 769, 'default.png', 1),
(34, 'jugador34', 'jugador34', 'Jugador', '34', 791, 'default.png', 2),
(35, 'jugador35', 'jugador35', 'Jugador', '35', 600, 'default.png', 3),
(36, 'jugador36', 'jugador36', 'Jugador', '36', 451, 'default.png', 4),
(37, 'jugador37', 'jugador37', 'Jugador', '37', 245, 'default.png', 5),
(38, 'jugador38', 'jugador38', 'Jugador', '38', 2, 'default.png', 6),
(39, 'jugador39', 'jugador39', 'Jugador', '39', 628, 'default.png', 7),
(40, 'jugador40', 'jugador40', 'Jugador', '40', 82, 'default.png', 8),
(41, 'jugador41', 'jugador41', 'Jugador', '41', 113, 'default.png', 1),
(42, 'jugador42', 'jugador42', 'Jugador', '42', 294, 'default.png', 2),
(43, 'jugador43', 'jugador43', 'Jugador', '43', 836, 'default.png', 3),
(44, 'jugador44', 'jugador44', 'Jugador', '44', 100, 'default.png', 4),
(45, 'jugador45', 'jugador45', 'Jugador', '45', 460, 'default.png', 5),
(46, 'jugador46', 'jugador46', 'Jugador', '46', 11, 'default.png', 6),
(47, 'jugador47', 'jugador47', 'Jugador', '47', 834, 'default.png', 7),
(48, 'jugador48', 'jugador48', 'Jugador', '48', 912, 'default.png', 8),
(49, 'jugador49', 'jugador49', 'Jugador', '49', 701, 'default.png', 1),
(50, 'jugador50', 'jugador50', 'Jugador', '50', 502, 'default.png', 2),
(51, 'jugador51', 'jugador51', 'Jugador', '51', 695, 'default.png', 3),
(52, 'jugador52', 'jugador52', 'Jugador', '52', 321, 'default.png', 4),
(53, 'jugador53', 'jugador53', 'Jugador', '53', 215, 'default.png', 5),
(54, 'jugador54', 'jugador54', 'Jugador', '54', 406, 'default.png', 6),
(55, 'jugador55', 'jugador55', 'Jugador', '55', 257, 'default.png', 7),
(56, 'jugador56', 'jugador56', 'Jugador', '56', 356, 'default.png', 8),
(57, 'jugador57', 'jugador57', 'Jugador', '57', 951, 'default.png', 1),
(58, 'jugador58', 'jugador58', 'Jugador', '58', 365, 'default.png', 2),
(59, 'jugador59', 'jugador59', 'Jugador', '59', 824, 'default.png', 3),
(60, 'jugador60', 'jugador60', 'Jugador', '60', 385, 'default.png', 4),
(61, 'jugador61', 'jugador61', 'Jugador', '61', 763, 'default.png', 5),
(62, 'jugador62', 'jugador62', 'Jugador', '62', 525, 'default.png', 6),
(63, 'jugador63', 'jugador63', 'Jugador', '63', 653, 'default.png', 7),
(64, 'jugador64', 'jugador64', 'Jugador', '64', 78, 'default.png', 8),
(65, 'jugador65', 'jugador65', 'Jugador', '65', 740, 'default.png', 1),
(66, 'jugador66', 'jugador66', 'Jugador', '66', 348, 'default.png', 2),
(67, 'jugador67', 'jugador67', 'Jugador', '67', 91, 'default.png', 3),
(68, 'jugador68', 'jugador68', 'Jugador', '68', 570, 'default.png', 4),
(69, 'jugador69', 'jugador69', 'Jugador', '69', 550, 'default.png', 5),
(70, 'jugador70', 'jugador70', 'Jugador', '70', 299, 'default.png', 6),
(71, 'jugador71', 'jugador71', 'Jugador', '71', 294, 'default.png', 7),
(72, 'jugador72', 'jugador72', 'Jugador', '72', 468, 'default.png', 8),
(73, 'jugador73', 'jugador73', 'Jugador', '73', 144, 'default.png', 1),
(74, 'jugador74', 'jugador74', 'Jugador', '74', 897, 'default.png', 2),
(75, 'jugador75', 'jugador75', 'Jugador', '75', 660, 'default.png', 3),
(76, 'jugador76', 'jugador76', 'Jugador', '76', 720, 'default.png', 4),
(77, 'jugador77', 'jugador77', 'Jugador', '77', 733, 'default.png', 5),
(78, 'jugador78', 'jugador78', 'Jugador', '78', 591, 'default.png', 6),
(79, 'jugador79', 'jugador79', 'Jugador', '79', 316, 'default.png', 7),
(80, 'jugador80', 'jugador80', 'Jugador', '80', 25, 'default.png', 8),
(81, 'jugador81', 'jugador81', 'Jugador', '81', 868, 'default.png', 1),
(82, 'jugador82', 'jugador82', 'Jugador', '82', 727, 'default.png', 2),
(83, 'jugador83', 'jugador83', 'Jugador', '83', 377, 'default.png', 3),
(84, 'jugador84', 'jugador84', 'Jugador', '84', 372, 'default.png', 4),
(85, 'jugador85', 'jugador85', 'Jugador', '85', 472, 'default.png', 5),
(86, 'jugador86', 'jugador86', 'Jugador', '86', 432, 'default.png', 6),
(87, 'jugador87', 'jugador87', 'Jugador', '87', 92, 'default.png', 7),
(88, 'jugador88', 'jugador88', 'Jugador', '88', 408, 'default.png', 8),
(89, 'jugador89', 'jugador89', 'Jugador', '89', 912, 'default.png', 1),
(90, 'jugador90', 'jugador90', 'Jugador', '90', 599, 'default.png', 2),
(91, 'jugador91', 'jugador91', 'Jugador', '91', 567, 'default.png', 3),
(92, 'jugador92', 'jugador92', 'Jugador', '92', 510, 'default.png', 4),
(93, 'jugador93', 'jugador93', 'Jugador', '93', 888, 'default.png', 5),
(94, 'jugador94', 'jugador94', 'Jugador', '94', 119, 'default.png', 6),
(95, 'jugador95', 'jugador95', 'Jugador', '95', 435, 'default.png', 7),
(96, 'jugador96', 'jugador96', 'Jugador', '96', 518, 'default.png', 8),
(97, 'jugador97', 'jugador97', 'Jugador', '97', 821, 'default.png', 1),
(98, 'jugador98', 'jugador98', 'Jugador', '98', 768, 'default.png', 2),
(99, 'jugador99', 'jugador99', 'Jugador', '99', 887, 'default.png', 3),
(100, 'jugador100', 'jugador100', 'Jugador', '100', 614, 'default.png', 4),
(101, 'jugador101', 'jugador101', 'Jugador', '101', 896, 'default.png', 5),
(102, 'jugador102', 'jugador102', 'Jugador', '102', 502, 'default.png', 6),
(103, 'jugador103', 'jugador103', 'Jugador', '103', 407, 'default.png', 7),
(104, 'jugador104', 'jugador104', 'Jugador', '104', 938, 'default.png', 8),
(105, 'jugador105', 'jugador105', 'Jugador', '105', 537, 'default.png', 1),
(106, 'jugador106', 'jugador106', 'Jugador', '106', 264, 'default.png', 2),
(107, 'jugador107', 'jugador107', 'Jugador', '107', 864, 'default.png', 3),
(108, 'jugador108', 'jugador108', 'Jugador', '108', 430, 'default.png', 4),
(109, 'jugador109', 'jugador109', 'Jugador', '109', 577, 'default.png', 5),
(110, 'jugador110', 'jugador110', 'Jugador', '110', 948, 'default.png', 6),
(111, 'jugador111', 'jugador111', 'Jugador', '111', 490, 'default.png', 7),
(112, 'jugador112', 'jugador112', 'Jugador', '112', 525, 'default.png', 8),
(113, 'jugador113', 'jugador113', 'Jugador', '113', 530, 'default.png', 1),
(114, 'jugador114', 'jugador114', 'Jugador', '114', 824, 'default.png', 2),
(115, 'jugador115', 'jugador115', 'Jugador', '115', 25, 'default.png', 3),
(116, 'jugador116', 'jugador116', 'Jugador', '116', 589, 'default.png', 4),
(117, 'jugador117', 'jugador117', 'Jugador', '117', 229, 'default.png', 5),
(118, 'jugador118', 'jugador118', 'Jugador', '118', 784, 'default.png', 6),
(119, 'jugador119', 'jugador119', 'Jugador', '119', 132, 'default.png', 7),
(120, 'jugador120', 'jugador120', 'Jugador', '120', 837, 'default.png', 8),
(121, 'jugador121', 'jugador121', 'Jugador', '121', 50, 'default.png', 1),
(122, 'jugador122', 'jugador122', 'Jugador', '122', 985, 'default.png', 2),
(123, 'jugador123', 'jugador123', 'Jugador', '123', 721, 'default.png', 3),
(124, 'jugador124', 'jugador124', 'Jugador', '124', 535, 'default.png', 4),
(125, 'jugador125', 'jugador125', 'Jugador', '125', 908, 'default.png', 5),
(126, 'jugador126', 'jugador126', 'Jugador', '126', 686, 'default.png', 6),
(127, 'jugador127', 'jugador127', 'Jugador', '127', 105, 'default.png', 7),
(128, 'jugador128', 'jugador128', 'Jugador', '128', 734, 'default.png', 8),
(129, 'jugador129', 'jugador129', 'Jugador', '129', 637, 'default.png', 1),
(130, 'jugador130', 'jugador130', 'Jugador', '130', 439, 'default.png', 2),
(131, 'jugador131', 'jugador131', 'Jugador', '131', 481, 'default.png', 3),
(132, 'jugador132', 'jugador132', 'Jugador', '132', 145, 'default.png', 4),
(133, 'jugador133', 'jugador133', 'Jugador', '133', 493, 'default.png', 5),
(134, 'jugador134', 'jugador134', 'Jugador', '134', 905, 'default.png', 6),
(135, 'jugador135', 'jugador135', 'Jugador', '135', 234, 'default.png', 7),
(136, 'jugador136', 'jugador136', 'Jugador', '136', 870, 'default.png', 8),
(137, 'jugador137', 'jugador137', 'Jugador', '137', 907, 'default.png', 1),
(138, 'jugador138', 'jugador138', 'Jugador', '138', 124, 'default.png', 2),
(139, 'jugador139', 'jugador139', 'Jugador', '139', 641, 'default.png', 3),
(140, 'jugador140', 'jugador140', 'Jugador', '140', 717, 'default.png', 4),
(141, 'jugador141', 'jugador141', 'Jugador', '141', 467, 'default.png', 5),
(142, 'jugador142', 'jugador142', 'Jugador', '142', 690, 'default.png', 6),
(143, 'jugador143', 'jugador143', 'Jugador', '143', 480, 'default.png', 7),
(144, 'jugador144', 'jugador144', 'Jugador', '144', 731, 'default.png', 8),
(145, 'jugador145', 'jugador145', 'Jugador', '145', 951, 'default.png', 1),
(146, 'jugador146', 'jugador146', 'Jugador', '146', 982, 'default.png', 2),
(147, 'jugador147', 'jugador147', 'Jugador', '147', 558, 'default.png', 3),
(148, 'jugador148', 'jugador148', 'Jugador', '148', 257, 'default.png', 4),
(149, 'jugador149', 'jugador149', 'Jugador', '149', 573, 'default.png', 5),
(150, 'jugador150', 'jugador150', 'Jugador', '150', 411, 'default.png', 6);

/* ============================================================
   PERSONAJE
   Personajes jugables en cada game del reporte.
   ============================================================ */
CREATE TABLE `personaje` (
  `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `logo` varchar(150) NOT NULL DEFAULT 'logo_default.png'
);

INSERT INTO `personaje` (`id`, `nombre`, `logo`) VALUES
(1, 'Fabio', 'logo_default.png'),
(2, 'Mario', 'logo_default.png'),
(3, 'Jonny Bravo', 'logo_default.png'),
(4, 'Agallas el perro cobarde', 'logo_default.png'),
(5, 'Superman', 'logo_default.png'),
(6, 'Spiderman', 'logo_default.png'),
(7, 'Vinicius', 'logo_default.png');


/* ============================================================
   RANKING
   Listas de ranking a las que se puede vincular un torneo.
   ============================================================ */
CREATE TABLE `ranking` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_jugador` int(5) NOT NULL,
 CONSTRAINT fk_jugador FOREIGN KEY (id_jugador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `ranking` (`id`, `id_jugador`) VALUES
(1,3),
(2,5),
(3,8),
(4,7),
(5,2),
(6,4),
(7,6);


/* ============================================================
   TORNEO
   Cabecera del evento: fechas, plaza, max_entrant y organizador.
   ============================================================ */
CREATE TABLE `torneo` (
 `id_torneo` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `nombre` VARCHAR(150) NOT NULL,
 `lugar` varchar(150) NOT NULL,
 `descripcion` varchar(150) NOT NULL,
 `fecha_inicio` DATETIME NOT NULL,/*Aqui te dan la fecha*/
 `fecha_fin` DATETIME NOT NULL,
 `img` varchar(150) NOT NULL DEFAULT 'torneo_default.png',
 `max_entrant` INT(5) NOT NULL CHECK (`max_entrant` IN (32, 64)),
 `estado` BOOLEAN NOT NULL DEFAULT false,
 `id_ranking` int(5) NOT NULL,
 `id_region` int(5) NOT NULL,
 `id_usuario` int(5) NOT NULL,
  CONSTRAINT fk_ranking FOREIGN KEY (id_ranking) REFERENCES ranking(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_region_torneo FOREIGN KEY (id_region) REFERENCES region(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_jugador_torneo FOREIGN KEY (id_usuario) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `torneo` (`id_torneo`, `nombre`, `lugar`, `descripcion`, `fecha_inicio`, `fecha_fin`, `img`, `max_entrant`, `estado`,`id_ranking`, `id_region`, `id_usuario`) VALUES
(1,'RPLHouse','Sevilla','Torneo principal de la temporada','2026-11-04 13:13:00','2026-11-07 13:13:00', '1.jpg', 32,false,1, 2, 2),
(2,'Sherry','Jerez de la frontera','Torneo para jugadores de las posiciones inferiores','2026-11-04 13:13:00','2026-11-07 13:13:00','2.jpg', 64,false,3, 8, 3),
(3,'Area Zero','Madrid','Torneo para jugadores de nivel intermedio','2026-11-04 13:13:00','2026-11-07 13:13:00', '3.jpg', 32,false,4, 3, 5),
(4,'Tram segunda parada','Barcelona','Torneo Nacional donde se reune el mejor nivel','2026-11-04 13:13:00','2026-11-07 13:13:00', '1.jpg', 64,false,2, 4, 3);

/* ============================================================
   PARTIDAS
   Cada fila es un game (o el preliminar vacio) de un set.
   ronda = letra del cuadro, pools = 1-4 o 0 en la final.
   ============================================================ */
CREATE TABLE `partidas` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_jugador1` int(5) NULL,
 `id_personaje1` int(5) NULL,
 `id_jugador2` int(5) NULL,
 `id_personaje2` int(5) NULL,
 `id_torneo` int(5) NOT NULL,
 `puntuacion_conseguida` int(5) NULL,
 `ronda` varchar(150) NOT NULL,
 `game` INT(5) NULL CHECK (`game` IN (1, 2, 3, 4, 5)),
 `pools` INT(5) NULL CHECK (`game` IN (1, 2, 3, 4, 5)),
 `ganador` int(5) NULL,
  CONSTRAINT fk_jugador1 FOREIGN KEY (id_jugador1) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_personaje1 FOREIGN KEY (id_personaje1) REFERENCES personaje(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_jugador2 FOREIGN KEY (id_jugador2) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_personaje2 FOREIGN KEY (id_personaje2) REFERENCES personaje(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_torneo_partida FOREIGN KEY (id_torneo) REFERENCES torneo(id_torneo) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_ganador FOREIGN KEY (ganador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);


/* ============================================================
   TORNEO_JUGADOR
   Torneo 1: 32. Torneo 2: 64. Torneo 3 (Area Zero): 20 al azar
   de esos 32. El admin no entra. Seed: mas puntos = seed mas baja.
   fecha_inscripcion: aleatoria y siempre anterior a fecha_inicio del torneo.
   ============================================================ */
CREATE TABLE `torneo_jugador` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_torneos` int(5) NOT NULL,
 `id_jugador` int(5) NOT NULL,
 seed int(5) NOT NULL,
 `fecha_inscripcion` DATETIME NOT NULL,
 CONSTRAINT fk_participan_torneo FOREIGN KEY (id_torneos) REFERENCES torneo(id_torneo) ON DELETE restrict ON UPDATE cascade,
 CONSTRAINT fk_participan_jugador FOREIGN KEY (id_jugador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `torneo_jugador` (`id`, `id_torneos`, `id_jugador`, `seed`, `fecha_inscripcion`) VALUES
(1, 1, 16, 1, '2026-10-27 01:08:35'),(2, 1, 12, 2, '2026-09-24 13:52:16'),(3, 1, 20, 3, '2026-09-20 22:33:26'),(4, 1, 18, 4, '2026-09-22 07:46:08'),(5, 1, 3, 5, '2026-10-26 11:52:02'),
(6, 1, 15, 6, '2026-10-22 13:55:03'),(7, 1, 28, 7, '2026-10-17 21:22:47'),(8, 1, 25, 8, '2026-10-28 13:51:18'),(9, 1, 30, 9, '2026-10-27 11:38:38'),(10, 1, 31, 10, '2026-10-27 12:52:48'),
(11, 1, 33, 11, '2026-10-13 20:30:40'),(12, 1, 29, 12, '2026-10-30 05:26:21'),(13, 1, 4, 13, '2026-10-15 01:52:52'),(14, 1, 14, 14, '2026-10-06 08:47:39'),(15, 1, 22, 15, '2026-09-26 20:07:33'),
(16, 1, 21, 16, '2026-09-29 11:25:49'),(17, 1, 5, 17, '2026-10-02 14:36:15'),(18, 1, 26, 18, '2026-10-09 06:58:12'),(19, 1, 23, 19, '2026-10-07 19:26:17'),(20, 1, 27, 20, '2026-10-20 14:17:55'),
(21, 1, 13, 21, '2026-10-23 15:40:32'),(22, 1, 11, 22, '2026-10-20 07:25:17'),(23, 1, 32, 23, '2026-11-03 22:26:13'),(24, 1, 7, 24, '2026-10-29 14:36:54'),(25, 1, 24, 25, '2026-10-28 06:17:54'),
(26, 1, 6, 26, '2026-11-02 00:52:33'),(27, 1, 10, 27, '2026-10-17 22:47:28'),(28, 1, 19, 28, '2026-10-18 11:32:30'),(29, 1, 8, 29, '2026-10-20 01:47:41'),(30, 1, 9, 30, '2026-10-29 03:14:05'),
(31, 1, 17, 31, '2026-10-11 23:18:34'),(32, 1, 2, 32, '2026-11-02 02:20:57');

/* Torneo 2 (Sherry): 64 jugadores al azar, seed 1 = mas puntuacion */
INSERT INTO `torneo_jugador` (`id`, `id_torneos`, `id_jugador`, `seed`, `fecha_inscripcion`) VALUES
(33, 2, 16, 1, '2026-10-26 18:15:11'),(34, 2, 57, 2, '2026-09-25 20:02:39'),(35, 2, 145, 3, '2026-09-29 12:21:15'),(36, 2, 48, 4, '2026-09-30 16:41:54'),
(37, 2, 89, 5, '2026-10-15 03:04:22'),(38, 2, 125, 6, '2026-10-16 17:01:02'),(39, 2, 3, 7, '2026-10-25 12:10:00'),(40, 2, 101, 8, '2026-10-21 02:43:12'),
(41, 2, 99, 9, '2026-09-28 20:18:07'),(42, 2, 81, 10, '2026-10-28 13:50:31'),(43, 2, 28, 11, '2026-10-28 17:54:30'),(44, 2, 43, 12, '2026-09-30 19:06:15'),
(45, 2, 59, 13, '2026-11-01 23:49:43'),(46, 2, 97, 14, '2026-10-01 11:35:32'),(47, 2, 25, 15, '2026-10-11 05:35:38'),(48, 2, 30, 16, '2026-10-10 11:14:20'),
(49, 2, 34, 17, '2026-10-10 04:04:20'),(50, 2, 31, 18, '2026-10-10 05:32:30'),(51, 2, 118, 19, '2026-10-14 06:21:37'),(52, 2, 98, 20, '2026-10-01 12:03:11'),
(53, 2, 29, 21, '2026-10-24 14:10:57'),(54, 2, 82, 22, '2026-10-02 03:50:20'),(55, 2, 123, 23, '2026-10-21 08:47:35'),(56, 2, 49, 24, '2026-10-04 20:40:48'),
(57, 2, 4, 25, '2026-10-28 12:21:48'),(58, 2, 126, 26, '2026-10-25 11:59:47'),(59, 2, 14, 27, '2026-10-07 17:23:00'),(60, 2, 139, 28, '2026-10-28 17:11:22'),
(61, 2, 22, 29, '2026-09-30 11:11:10'),(62, 2, 21, 30, '2026-09-24 07:13:50'),(63, 2, 35, 31, '2026-10-31 16:59:09'),(64, 2, 26, 32, '2026-10-20 08:34:37'),
(65, 2, 68, 33, '2026-09-26 23:44:42'),(66, 2, 23, 34, '2026-10-31 02:11:30'),(67, 2, 27, 35, '2026-10-16 22:03:09'),(68, 2, 147, 36, '2026-10-27 06:25:07'),
(69, 2, 69, 37, '2026-10-01 21:32:02'),(70, 2, 105, 38, '2026-11-03 08:00:23'),(71, 2, 124, 39, '2026-09-21 11:08:36'),(72, 2, 62, 40, '2026-10-13 15:49:53'),
(73, 2, 112, 41, '2026-10-30 16:53:14'),(74, 2, 96, 42, '2026-11-03 05:48:19'),(75, 2, 11, 43, '2026-10-12 14:11:49'),(76, 2, 92, 44, '2026-09-29 01:07:36'),
(77, 2, 102, 45, '2026-09-28 23:11:33'),(78, 2, 7, 46, '2026-09-22 17:54:17'),(79, 2, 111, 47, '2026-10-16 02:24:45'),(80, 2, 130, 48, '2026-09-25 08:40:53'),
(81, 2, 108, 49, '2026-10-06 07:40:31'),(82, 2, 6, 50, '2026-10-25 13:02:31'),(83, 2, 58, 51, '2026-11-01 06:27:13'),(84, 2, 56, 52, '2026-10-10 02:42:44'),
(85, 2, 66, 53, '2026-10-13 22:01:32'),(86, 2, 10, 54, '2026-11-02 16:17:50'),(87, 2, 42, 55, '2026-11-02 06:56:02'),(88, 2, 71, 56, '2026-10-30 22:26:58'),
(89, 2, 148, 57, '2026-10-19 03:00:47'),(90, 2, 37, 58, '2026-10-11 12:14:48'),(91, 2, 135, 59, '2026-10-21 23:59:54'),(92, 2, 19, 60, '2026-10-23 04:33:50'),
(93, 2, 73, 61, '2026-10-22 13:53:04'),(94, 2, 9, 62, '2026-10-20 17:43:18'),(95, 2, 67, 63, '2026-10-15 05:58:52'),(96, 2, 121, 64, '2026-10-24 04:03:02');

/* Torneo 3 (Area Zero): 20 de los 32 del torneo 1, seed por puntuacion */
INSERT INTO `torneo_jugador` (`id`, `id_torneos`, `id_jugador`, `seed`, `fecha_inscripcion`) VALUES
(97, 3, 16, 1, '2026-10-08 09:14:53'),(98, 3, 12, 2, '2026-10-21 15:11:31'),(99, 3, 20, 3, '2026-10-08 01:30:54'),(100, 3, 18, 4, '2026-09-29 02:13:27'),
(101, 3, 3, 5, '2026-10-01 14:23:31'),(102, 3, 15, 6, '2026-10-01 08:25:38'),(103, 3, 25, 7, '2026-10-27 20:35:52'),(104, 3, 30, 8, '2026-10-02 08:32:14'),
(105, 3, 31, 9, '2026-10-30 18:57:50'),(106, 3, 4, 10, '2026-10-02 07:45:30'),(107, 3, 14, 11, '2026-10-30 16:01:52'),(108, 3, 22, 12, '2026-10-06 03:11:21'),
(109, 3, 5, 13, '2026-10-03 00:16:15'),(110, 3, 26, 14, '2026-11-01 05:37:51'),(111, 3, 24, 15, '2026-10-12 03:32:03'),(112, 3, 6, 16, '2026-10-13 09:45:25'),
(113, 3, 10, 17, '2026-10-29 18:42:18'),(114, 3, 19, 18, '2026-10-23 18:00:58'),(115, 3, 9, 19, '2026-10-20 07:07:47'),(116, 3, 2, 20, '2026-10-26 03:05:28');

