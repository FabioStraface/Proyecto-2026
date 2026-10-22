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
(8, 'Navani', 'Navani1234', 'Navani', 'Kholin', 220, 'default.png', 2),
(9, 'JonSnow', 'Demo0009!', 'Jon', 'Snow', 121, 'default.png', 1),
(10, 'DaenerysTargaryen', 'Demo0010!', 'Daenerys', 'Targaryen', 327, 'default.png', 2),
(11, 'TyrionLannister', 'Demo0011!', 'Tyrion', 'Lannister', 514, 'default.png', 3),
(12, 'CerseiLannister', 'Demo0012!', 'Cersei', 'Lannister', 974, 'default.png', 4),
(13, 'JaimeLannister', 'Demo0013!', 'Jaime', 'Lannister', 524, 'default.png', 5),
(14, 'AryaStark', 'Demo0014!', 'Arya', 'Stark', 662, 'default.png', 6),
(15, 'SansaStark', 'Demo0015!', 'Sansa', 'Stark', 880, 'default.png', 7),
(16, 'BranStark', 'Demo0016!', 'Bran', 'Stark', 975, 'default.png', 8),
(17, 'NedStark', 'Demo0017!', 'Ned', 'Stark', 105, 'default.png', 1),
(18, 'RobbStark', 'Demo0018!', 'Robb', 'Stark', 905, 'default.png', 2),
(19, 'SandorClegane', 'Demo0019!', 'Sandor', 'Clegane', 228, 'default.png', 3),
(20, 'GregorClegane', 'Demo0020!', 'Gregor', 'Clegane', 916, 'default.png', 4),
(21, 'BrienneTarth', 'Demo0021!', 'Brienne', 'Tarth', 615, 'default.png', 5),
(22, 'JorahMormont', 'Demo0022!', 'Jorah', 'Mormont', 636, 'default.png', 6),
(23, 'OberynMartell', 'Demo0023!', 'Oberyn', 'Martell', 569, 'default.png', 7),
(24, 'TheonGreyjoy', 'Demo0024!', 'Theon', 'Greyjoy', 430, 'default.png', 8),
(25, 'Ygritte', 'Demo0025!', 'Ygritte', 'Juego de Tronos', 802, 'default.png', 1),
(26, 'SamwellTarly', 'Demo0026!', 'Samwell', 'Tarly', 586, 'default.png', 2),
(27, 'PetyrBaelish', 'Demo0027!', 'Petyr', 'Baelish', 560, 'default.png', 3),
(28, 'Varys', 'Demo0028!', 'Varys', 'Juego de Tronos', 862, 'default.png', 4),
(29, 'MonkeyDLuffy', 'Demo0029!', 'Monkey', 'D Luffy', 748, 'default.png', 5),
(30, 'RoronoaZoro', 'Demo0030!', 'Roronoa', 'Zoro', 795, 'default.png', 6),
(31, 'VinsmokeSanji', 'Demo0031!', 'Vinsmoke', 'Sanji', 786, 'default.png', 7),
(32, 'Nami', 'Demo0032!', 'Nami', 'One Piece', 502, 'default.png', 8),
(33, 'Usopp', 'Demo0033!', 'Usopp', 'One Piece', 769, 'default.png', 1),
(34, 'TonyTonyChopper', 'Demo0034!', 'Tony', 'Tony Chopper', 791, 'default.png', 2),
(35, 'NicoRobin', 'Demo0035!', 'Nico', 'Robin', 600, 'default.png', 3),
(36, 'Franky', 'Demo0036!', 'Franky', 'One Piece', 451, 'default.png', 4),
(37, 'Brook', 'Demo0037!', 'Brook', 'One Piece', 245, 'default.png', 5),
(38, 'Jinbe', 'Demo0038!', 'Jinbe', 'One Piece', 2, 'default.png', 6),
(39, 'Shanks', 'Demo0039!', 'Shanks', 'One Piece', 628, 'default.png', 7),
(40, 'PortgasDAce', 'Demo0040!', 'Portgas', 'D Ace', 82, 'default.png', 8),
(41, 'TrafalgarLaw', 'Demo0041!', 'Trafalgar', 'Law', 113, 'default.png', 1),
(42, 'EustassKid', 'Demo0042!', 'Eustass', 'Kid', 294, 'default.png', 2),
(43, 'BoaHancock', 'Demo0043!', 'Boa', 'Hancock', 836, 'default.png', 3),
(44, 'DraculeMihawk', 'Demo0044!', 'Dracule', 'Mihawk', 100, 'default.png', 4),
(45, 'DonquixoteDoflamingo', 'Demo0045!', 'Donquixote', 'Doflamingo', 460, 'default.png', 5),
(46, 'CharlotteKatakuri', 'Demo0046!', 'Charlotte', 'Katakuri', 11, 'default.png', 6),
(47, 'Kaido', 'Demo0047!', 'Kaido', 'One Piece', 834, 'default.png', 7),
(48, 'BigMom', 'Demo0048!', 'Big', 'Mom', 912, 'default.png', 8),
(49, 'Vin', 'Demo0049!', 'Vin', 'Mistborn', 701, 'default.png', 1),
(50, 'Kelsier', 'Demo0050!', 'Kelsier', 'Mistborn', 502, 'default.png', 2),
(51, 'ElendVenture', 'Demo0051!', 'Elend', 'Venture', 695, 'default.png', 3),
(52, 'Sazed', 'Demo0052!', 'Sazed', 'Mistborn', 321, 'default.png', 4),
(53, 'Marsh', 'Demo0053!', 'Marsh', 'Mistborn', 215, 'default.png', 5),
(54, 'Breeze', 'Demo0054!', 'Breeze', 'Mistborn', 406, 'default.png', 6),
(55, 'Ham', 'Demo0055!', 'Ham', 'Mistborn', 257, 'default.png', 7),
(56, 'Spook', 'Demo0056!', 'Spook', 'Mistborn', 356, 'default.png', 8),
(57, 'Clubs', 'Demo0057!', 'Clubs', 'Mistborn', 951, 'default.png', 1),
(58, 'Dockson', 'Demo0058!', 'Dockson', 'Mistborn', 365, 'default.png', 2),
(59, 'Tindwyl', 'Demo0059!', 'Tindwyl', 'Mistborn', 824, 'default.png', 3),
(60, 'TenSoon', 'Demo0060!', 'TenSoon', 'Mistborn', 385, 'default.png', 4),
(61, 'Rashek', 'Demo0061!', 'Rashek', 'Mistborn', 763, 'default.png', 5),
(62, 'WaxilliumLadrian', 'Demo0062!', 'Waxillium', 'Ladrian', 525, 'default.png', 6),
(63, 'Wayne', 'Demo0063!', 'Wayne', 'Mistborn', 653, 'default.png', 7),
(64, 'MarasiColms', 'Demo0064!', 'Marasi', 'Colms', 78, 'default.png', 8),
(65, 'SterisHarms', 'Demo0065!', 'Steris', 'Harms', 740, 'default.png', 1),
(66, 'MilesDagouter', 'Demo0066!', 'Miles', 'Dagouter', 348, 'default.png', 2),
(67, 'NarutoUzumaki', 'Demo0067!', 'Naruto', 'Uzumaki', 91, 'default.png', 3),
(68, 'SasukeUchiha', 'Demo0068!', 'Sasuke', 'Uchiha', 570, 'default.png', 4),
(69, 'SakuraHaruno', 'Demo0069!', 'Sakura', 'Haruno', 550, 'default.png', 5),
(70, 'KakashiHatake', 'Demo0070!', 'Kakashi', 'Hatake', 299, 'default.png', 6),
(71, 'ItachiUchiha', 'Demo0071!', 'Itachi', 'Uchiha', 294, 'default.png', 7),
(72, 'MadaraUchiha', 'Demo0072!', 'Madara', 'Uchiha', 468, 'default.png', 8),
(73, 'ObitoUchiha', 'Demo0073!', 'Obito', 'Uchiha', 144, 'default.png', 1),
(74, 'MinatoNamikaze', 'Demo0074!', 'Minato', 'Namikaze', 897, 'default.png', 2),
(75, 'Jiraiya', 'Demo0075!', 'Jiraiya', 'Naruto', 660, 'default.png', 3),
(76, 'Tsunade', 'Demo0076!', 'Tsunade', 'Naruto', 720, 'default.png', 4),
(77, 'Orochimaru', 'Demo0077!', 'Orochimaru', 'Naruto', 733, 'default.png', 5),
(78, 'HinataHyuga', 'Demo0078!', 'Hinata', 'Hyuga', 591, 'default.png', 6),
(79, 'NejiHyuga', 'Demo0079!', 'Neji', 'Hyuga', 316, 'default.png', 7),
(80, 'RockLee', 'Demo0080!', 'Rock', 'Lee', 25, 'default.png', 8),
(81, 'MightGuy', 'Demo0081!', 'Might', 'Guy', 868, 'default.png', 1),
(82, 'Gaara', 'Demo0082!', 'Gaara', 'Naruto', 727, 'default.png', 2),
(83, 'ShikamaruNara', 'Demo0083!', 'Shikamaru', 'Nara', 377, 'default.png', 3),
(84, 'PainNagato', 'Demo0084!', 'Pain', 'Nagato', 372, 'default.png', 4),
(85, 'KillerBee', 'Demo0085!', 'Killer', 'Bee', 472, 'default.png', 5),
(86, 'HashiramaSenju', 'Demo0086!', 'Hashirama', 'Senju', 432, 'default.png', 6),
(87, 'SonGoku', 'Demo0087!', 'Son', 'Goku', 92, 'default.png', 7),
(88, 'Vegeta', 'Demo0088!', 'Vegeta', 'Dragon Ball', 408, 'default.png', 8),
(89, 'SonGohan', 'Demo0089!', 'Son', 'Gohan', 912, 'default.png', 1),
(90, 'Piccolo', 'Demo0090!', 'Piccolo', 'Dragon Ball', 599, 'default.png', 2),
(91, 'Trunks', 'Demo0091!', 'Trunks', 'Dragon Ball', 567, 'default.png', 3),
(92, 'Bulma', 'Demo0092!', 'Bulma', 'Dragon Ball', 510, 'default.png', 4),
(93, 'Krillin', 'Demo0093!', 'Krillin', 'Dragon Ball', 888, 'default.png', 5),
(94, 'Freezer', 'Demo0094!', 'Freezer', 'Dragon Ball', 119, 'default.png', 6),
(95, 'Cell', 'Demo0095!', 'Cell', 'Dragon Ball', 435, 'default.png', 7),
(96, 'MajinBuu', 'Demo0096!', 'Majin', 'Buu', 518, 'default.png', 8),
(97, 'Beerus', 'Demo0097!', 'Beerus', 'Dragon Ball', 821, 'default.png', 1),
(98, 'Whis', 'Demo0098!', 'Whis', 'Dragon Ball', 768, 'default.png', 2),
(99, 'Androide18', 'Demo0099!', 'Androide', '18', 887, 'default.png', 3),
(100, 'Androide17', 'Demo0100!', 'Androide', '17', 614, 'default.png', 4),
(101, 'Broly', 'Demo0101!', 'Broly', 'Dragon Ball', 896, 'default.png', 5),
(102, 'IchigoKurosaki', 'Demo0102!', 'Ichigo', 'Kurosaki', 502, 'default.png', 6),
(103, 'RukiaKuchiki', 'Demo0103!', 'Rukia', 'Kuchiki', 407, 'default.png', 7),
(104, 'ByakuyaKuchiki', 'Demo0104!', 'Byakuya', 'Kuchiki', 938, 'default.png', 8),
(105, 'SosukeAizen', 'Demo0105!', 'Sosuke', 'Aizen', 537, 'default.png', 1),
(106, 'KenpachiZaraki', 'Demo0106!', 'Kenpachi', 'Zaraki', 264, 'default.png', 2),
(107, 'ToshiroHitsugaya', 'Demo0107!', 'Toshiro', 'Hitsugaya', 864, 'default.png', 3),
(108, 'OrihimeInoue', 'Demo0108!', 'Orihime', 'Inoue', 430, 'default.png', 4),
(109, 'UryuIshida', 'Demo0109!', 'Uryu', 'Ishida', 577, 'default.png', 5),
(110, 'KisukeUrahara', 'Demo0110!', 'Kisuke', 'Urahara', 948, 'default.png', 6),
(111, 'YoruichiShihoin', 'Demo0111!', 'Yoruichi', 'Shihoin', 490, 'default.png', 7),
(112, 'Aragorn', 'Demo0112!', 'Aragorn', 'El Señor de los Anillos', 525, 'default.png', 8),
(113, 'Legolas', 'Demo0113!', 'Legolas', 'El Señor de los Anillos', 530, 'default.png', 1),
(114, 'Gimli', 'Demo0114!', 'Gimli', 'El Señor de los Anillos', 824, 'default.png', 2),
(115, 'Gandalf', 'Demo0115!', 'Gandalf', 'El Señor de los Anillos', 25, 'default.png', 3),
(116, 'FrodoBolson', 'Demo0116!', 'Frodo', 'Bolson', 589, 'default.png', 4),
(117, 'SamGamyi', 'Demo0117!', 'Sam', 'Gamyi', 229, 'default.png', 5),
(118, 'Boromir', 'Demo0118!', 'Boromir', 'El Señor de los Anillos', 784, 'default.png', 6),
(119, 'Faramir', 'Demo0119!', 'Faramir', 'El Señor de los Anillos', 132, 'default.png', 7),
(120, 'Eowyn', 'Demo0120!', 'Eowyn', 'El Señor de los Anillos', 837, 'default.png', 8),
(121, 'Galadriel', 'Demo0121!', 'Galadriel', 'El Señor de los Anillos', 50, 'default.png', 1),
(122, 'Elrond', 'Demo0122!', 'Elrond', 'El Señor de los Anillos', 985, 'default.png', 2),
(123, 'Saruman', 'Demo0123!', 'Saruman', 'El Señor de los Anillos', 721, 'default.png', 3),
(124, 'YujiItadori', 'Demo0124!', 'Yuji', 'Itadori', 535, 'default.png', 4),
(125, 'SatoruGojo', 'Demo0125!', 'Satoru', 'Gojo', 908, 'default.png', 5),
(126, 'MegumiFushiguro', 'Demo0126!', 'Megumi', 'Fushiguro', 686, 'default.png', 6),
(127, 'NobaraKugisaki', 'Demo0127!', 'Nobara', 'Kugisaki', 105, 'default.png', 7),
(128, 'RyomenSukuna', 'Demo0128!', 'Ryomen', 'Sukuna', 734, 'default.png', 8),
(129, 'KentoNanami', 'Demo0129!', 'Kento', 'Nanami', 637, 'default.png', 1),
(130, 'MakiZenin', 'Demo0130!', 'Maki', 'Zenin', 439, 'default.png', 2),
(131, 'YutaOkkotsu', 'Demo0131!', 'Yuta', 'Okkotsu', 481, 'default.png', 3),
(132, 'SuguruGeto', 'Demo0132!', 'Suguru', 'Geto', 145, 'default.png', 4),
(133, 'TojiFushiguro', 'Demo0133!', 'Toji', 'Fushiguro', 493, 'default.png', 5),
(134, 'ErenYeager', 'Demo0134!', 'Eren', 'Yeager', 905, 'default.png', 6),
(135, 'MikasaAckerman', 'Demo0135!', 'Mikasa', 'Ackerman', 234, 'default.png', 7),
(136, 'ArminArlert', 'Demo0136!', 'Armin', 'Arlert', 870, 'default.png', 8),
(137, 'LeviAckerman', 'Demo0137!', 'Levi', 'Ackerman', 907, 'default.png', 1),
(138, 'ErwinSmith', 'Demo0138!', 'Erwin', 'Smith', 124, 'default.png', 2),
(139, 'HangeZoe', 'Demo0139!', 'Hange', 'Zoe', 641, 'default.png', 3),
(140, 'ReinerBraun', 'Demo0140!', 'Reiner', 'Braun', 717, 'default.png', 4),
(141, 'AnnieLeonhart', 'Demo0141!', 'Annie', 'Leonhart', 467, 'default.png', 5),
(142, 'JeanKirstein', 'Demo0142!', 'Jean', 'Kirstein', 690, 'default.png', 6),
(143, 'HistoriaReiss', 'Demo0143!', 'Historia', 'Reiss', 480, 'default.png', 7),
(144, 'GonFreecss', 'Demo0144!', 'Gon', 'Freecss', 731, 'default.png', 8),
(145, 'KilluaZoldyck', 'Demo0145!', 'Killua', 'Zoldyck', 951, 'default.png', 1),
(146, 'Kurapika', 'Demo0146!', 'Kurapika', 'Hunter x Hunter', 982, 'default.png', 2),
(147, 'LeorioParadinight', 'Demo0147!', 'Leorio', 'Paradinight', 558, 'default.png', 3),
(148, 'HisokaMorow', 'Demo0148!', 'Hisoka', 'Morow', 257, 'default.png', 4),
(149, 'ChrolloLucilfer', 'Demo0149!', 'Chrollo', 'Lucilfer', 573, 'default.png', 5),
(150, 'IsaacNetero', 'Demo0150!', 'Isaac', 'Netero', 411, 'default.png', 6);

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
 `max_entrant` INT(5) NOT NULL CHECK (`max_entrant` IN (32, 64, 128)),
 `id_ranking` int(5) NOT NULL,
 `id_region` int(5) NOT NULL,
 `id_usuario` int(5) NOT NULL,
  CONSTRAINT fk_ranking FOREIGN KEY (id_ranking) REFERENCES ranking(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_region_torneo FOREIGN KEY (id_region) REFERENCES region(id) ON DELETE restrict ON UPDATE cascade,
  CONSTRAINT fk_jugador_torneo FOREIGN KEY (id_usuario) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `torneo` (`id_torneo`, `nombre`, `lugar`, `descripcion`, `fecha_inicio`, `fecha_fin`, `img`, `max_entrant`,`id_ranking`, `id_region`, `id_usuario`) VALUES
(1,'RPLHouse','Sevilla','Torneo principal de la temporada','2026-10-23 13:13:00','2026-10-25 13:13:00', '1.jpg', 32,1, 2, 2),
(2,'Sherry','Jerez de la frontera','Torneo para jugadores de las posiciones inferiores','2026-12-12 13:13:00','2026-12-14 13:13:00','2.jpg', 64,3, 8, 3),
(3,'Area Zero','Madrid','Torneo para jugadores de nivel intermedio','2026-12-23 13:13:00','2026-12-25 13:13:00', '3.jpg', 128,4, 3, 5),
(4,'Tram segunda parada','Barcelona','Torneo Nacional donde se reune el mejor nivel','2026-12-28 13:13:00','2026-12-31 13:13:00', '1.jpg', 128,2, 4, 3);

CREATE TABLE `torneo_jugador` (
 `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `id_torneos` int(5) NOT NULL,
 `id_jugador` int(5) NOT NULL,
 seed int(5) NOT NULL,
 CONSTRAINT fk_participan_torneo FOREIGN KEY (id_torneos) REFERENCES torneo(id_torneo) ON DELETE restrict ON UPDATE cascade,
 CONSTRAINT fk_participan_jugador FOREIGN KEY (id_jugador) REFERENCES jugador(id) ON DELETE restrict ON UPDATE cascade
);

INSERT INTO `torneo_jugador` (`id`, `id_torneos`, `id_jugador`, `seed`) VALUES
(1, 1, 2, 32),(2, 1, 1, 1),(3, 1, 3, 6),(4, 1, 4, 13),(5, 1, 5, 17),
(6, 1, 6, 26),(11, 1, 7, 24),(12, 1, 8, 29),(13, 1, 9, 30),(14, 1, 10, 27),
(15, 1, 11, 22),(16, 1, 12, 3),(17, 1, 13, 21),(18, 1, 14, 14),(19, 1, 15, 7),
(20, 1, 16, 2),(21, 1, 17, 31),(22, 1, 18, 5),(23, 1, 19, 28),(24, 1, 20, 4),
(25, 1, 21, 16),(26, 1, 22, 15),(27, 1, 23, 19),(28, 1, 24, 25),(29, 1, 25, 9),
(30, 1, 26, 18),(31, 1, 27, 20),(32, 1, 28, 8),(33, 1, 29, 12),(34, 1, 30, 10),
(35, 1, 31, 11),(36, 1, 32, 23);



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

