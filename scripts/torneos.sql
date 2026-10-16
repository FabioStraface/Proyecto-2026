SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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

INSERT INTO `jugador` (`id`, `usuario`,`pass`,`nombre`,`apellidos`, `puntuacion`, `img`, `id_region`) VALUES
(1, 'admin','admin','Szeth','Hijo-Hijo-Vallano', 999,'default.png', 2),
(2, 'FabioStraface','FabioStraface','Fabio Jesús','Miguel Straface', 50,'default.png', 1),
(3, 'Kaladin', 'Kaladin1234', 'Kaladin', 'Bendito por la Tormenta', 900, 'default.png', 1),
(4, 'Shallan', 'Shallan1234', 'Shallan', 'Davar', 700, 'default.png', 3),
(5, 'Dalinar', 'Dalinar1234', 'Dalinar', 'Kholin', 600, 'default.png', 6),
(6, 'Adolin', 'Adolin1234', 'Adolin', 'Kholin', 400, 'default.png', 7),
(7, 'Jasnah', 'Jasnah1234', 'Jasnah', 'Kholin', 500, 'default.png', 5),
(8, 'Navani', 'Navani1234', 'Navani', 'Kholin', 220, 'default.png', 2);

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

CREATE TABLE `partida` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `nombre_partida` VARCHAR(150) NOT NULL
);

INSERT INTO `partida` (`id`, `nombre_partida`) VALUES
(1,'Game 1'),
(2,'Game 2'),
(3,'Game 3'),
(4,'Game 4'),
(5,'Game 5');

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


CREATE TABLE `torneo` (
 `id_torneo` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `nombre` VARCHAR(150) NOT NULL,
 `lugar` varchar(150) NOT NULL,
 `descripcion` varchar(150) NOT NULL,
 `fecha_inicio` DATETIME NOT NULL,/*Aqui te dan la fecha*/
 `fecha_fin` DATETIME NOT NULL,
 `img` varchar(150) NOT NULL DEFAULT 'torneo_default.png',
 `id_ranking` int(5) NOT NULL,
 `id_region` int(5) NOT NULL,
  CONSTRAINT fk_ranking FOREIGN KEY (id_ranking) REFERENCES ranking(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_region_torneo FOREIGN KEY (id_region) REFERENCES region(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `torneo` (`id_torneo`, `nombre`, `lugar`, `descripcion`, `fecha_inicio`, `fecha_fin`, `img`,`id_ranking`, `id_region`) VALUES
(1,'RPLHouse','Sevilla','Torneo principal de la temporada','2026-10-23 13:13:00','2026-10-25 13:13:00', '1.jpg',1, 2),
(2,'Sherry','Jerez de la frontera','Torneo para jugadores de las posiciones inferiores','2026-12-12 13:13:00','2026-12-14 13:13:00', '2.jpg',3, 8),
(3,'Area Zero','Madrid','Torneo para jugadores de nivel intermedio','2026-12-23 13:13:00','2026-12-25 13:13:00', '3.jpg',4, 3),
(4,'Tram segunda parada','Barcelona','Torneo Nacional donde se reune el mejor nivel','2026-12-28 13:13:00','2026-12-31 13:13:00', '1.jpg',2, 4);

CREATE TABLE `torneo_jugador` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_torneos` int(5) NOT NULL,
 `id_jugador` int(5) NOT NULL,
 seed int(5) NOT NULL,
 CONSTRAINT fk_participan_torneo FOREIGN KEY (id_torneos) REFERENCES torneo(id_torneo) ON DELETE restrict ON UPDATE cascade,
 CONSTRAINT fk_participan_jugador FOREIGN KEY (id_jugador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `torneo_jugador` (`id`, `id_torneos`, `id_jugador`, `seed`) VALUES
(1,1,2,1),
(2,1,1,2),
(3,1,3,3),
(4,1,4,4),
(5,1,5,5),
(6,1,6,6),
(7,2,5,1),
(8,2,6,2),
(9,3,3,1),
(10,3,4,2);

CREATE TABLE `jugador_partida` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_jugador` int(5) NOT NULL,
 `id_partida` int(5) NOT NULL,
 CONSTRAINT fk_juega_jugador FOREIGN KEY (id_jugador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade,
 CONSTRAINT fk_juega_partida FOREIGN KEY (id_partida) REFERENCES partida(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `jugador_partida` (`id`, `id_jugador`, `id_partida`) VALUES
(1,1,1),
(2,2,1),
(3,3,2),
(4,4,2),
(5,5,3),
(6,6,3),
(7,1,4),
(8,3,4),
(9,5,5),
(10,6,5),
(11,3,3),
(12,4,3);

CREATE TABLE `jugador_personaje_partida` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_jugador` int(5) NOT NULL,
 `id_personaje` int(5) NOT NULL,
 `id_partida` int(5) NOT NULL,
 CONSTRAINT fk_utiliza_jugador FOREIGN KEY (id_jugador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade,
 CONSTRAINT fk_utiliza_personaje FOREIGN KEY (id_personaje) REFERENCES personaje(id) ON DELETE restrict ON UPDATE cascade,
 CONSTRAINT fk_utiliza_partida FOREIGN KEY (id_partida) REFERENCES partida(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `jugador_personaje_partida` (`id`, `id_jugador`, `id_personaje`, `id_partida`) VALUES
(1,1,1,1),
(2,2,3,1),
(3,3,2,2),
(4,4,4,2),
(5,5,5,3),
(6,6,6,3),
(7,1,1,4),
(8,3,2,4),
(9,5,5,5),
(10,6,4,5);

