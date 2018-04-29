/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `streaming` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `streaming`;

CREATE TABLE IF NOT EXISTS `abo` (
  `id_a` int(11) NOT NULL,
  `datedeb` datetime DEFAULT NULL,
  `datefin` datetime DEFAULT NULL,
  `id_u` int(11) NOT NULL,
  PRIMARY KEY (`id_a`),
  KEY `id_u` (`id_u`),
  CONSTRAINT `abo_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `users` (`id_u`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM `abo`;
/*!40000 ALTER TABLE `abo` DISABLE KEYS */;
INSERT INTO `abo` (`id_a`, `datedeb`, `datefin`, `id_u`) VALUES
	(31, '2018-04-29 14:08:08', '2018-05-04 14:08:08', 12);
/*!40000 ALTER TABLE `abo` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ban` (
  `id_b` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `debban` datetime DEFAULT NULL,
  `finban` datetime DEFAULT NULL,
  PRIMARY KEY (`id_b`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM `ban`;
/*!40000 ALTER TABLE `ban` DISABLE KEYS */;
/*!40000 ALTER TABLE `ban` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

DELETE FROM `categorie`;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_c`, `libelle`) VALUES
	(1, 'action'),
	(2, 'animation'),
	(3, 'aventure'),
	(4, 'comédie'),
	(5, 'drame'),
	(6, 'fantastique'),
	(7, 'guerre'),
	(9, 'horreur'),
	(11, 'science');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `critiquef` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(200) DEFAULT NULL,
  `id_f` int(11) NOT NULL,
  PRIMARY KEY (`id_c`),
  KEY `id_f` (`id_f`),
  CONSTRAINT `critiquef_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `film` (`id_f`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

DELETE FROM `critiquef`;
/*!40000 ALTER TABLE `critiquef` DISABLE KEYS */;
INSERT INTO `critiquef` (`id_c`, `lien`, `id_f`) VALUES
	(1, 'http://www.allocine.fr/film/fichefilm-225116/critiques/spectateurs/', 1),
	(2, 'http://www.allocine.fr/film/fichefilm_gen_cfilm%3D51612.html', 2),
	(3, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=221524.html', 3),
	(4, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=241900.html', 5),
	(5, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=189525.html', 6),
	(7, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=170399.html', 7),
	(8, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=228558.html', 8),
	(9, 'https://www.youtube.com/embed/1FJD7jZqZEk?showinfo=0', 8),
	(10, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=206775.html', 9),
	(11, 'http://www.allocine.fr/film/fichefilm_gen_cfilm=242054.html', 10);
/*!40000 ALTER TABLE `critiquef` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `critiques` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(300) DEFAULT NULL,
  `id_s` int(11) NOT NULL,
  PRIMARY KEY (`id_c`),
  KEY `id_s` (`id_s`),
  CONSTRAINT `critiques_ibfk_1` FOREIGN KEY (`id_s`) REFERENCES `serie` (`id_s`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

DELETE FROM `critiques`;
/*!40000 ALTER TABLE `critiques` DISABLE KEYS */;
INSERT INTO `critiques` (`id_c`, `lien`, `id_s`) VALUES
	(1, 'https://www.senscritique.com/serie/Vikings/1367211', 1),
	(2, 'http://www.allocine.fr/series/ficheserie_gen_cserie=3247.html', 6),
	(3, 'http://www.allocine.fr/series/ficheserie_gen_cserie=3517.html', 5),
	(4, 'http://www.allocine.fr/series/ficheserie_gen_cserie=7330.html', 4),
	(5, 'http://www.allocine.fr/series/ficheserie-11561/saison-23113/', 3),
	(6, 'http://www.allocine.fr/series/ficheserie_gen_cserie=19156.html', 2);
/*!40000 ALTER TABLE `critiques` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `film` (
  `id_f` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `id_c` int(11) NOT NULL,
  PRIMARY KEY (`id_f`),
  KEY `id_c` (`id_c`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `categorie` (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

DELETE FROM `film`;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_f`, `titre`, `description`, `id_c`) VALUES
	(1, 'Logan', 'En 2029, alors que les mutants sont en voie d’extinction, Logan vit discrètement comme chauffeur de limousine. Il veille cependant sur son vieil ami le professeur Charles Xavier, très affaibli.', 1),
	(2, 'Garfield', 'Garfield, chat paresseux, va devoir partager sa vie avec un nouveau locataire : le chien Odie, animal de compagnie de la vétérinaire dont son maître Jon est amoureux.', 4),
	(3, 'Seul sur Mars', 'En 2035, un équipage de la mission de la NASA Ares III œuvre sur le sol de Mars lorsque survient une tempête particulièrement élevée. La fusée utiliser pour repartir risque de tomber par le vent et détruite.', 11),
	(5, 'Annabelle Création ', 'Elle est de retour ! Encore traumatisés par la mort tragique de leur petite fille, un fabricant de poupées et sa femme recueillent une bonne sœur et les toutes jeunes pensionnaires d\'un orphelinat dévasté. Mais ce petit monde est bientôt la cible d\'Annabelle, créature du fabricant possédée par un démon', 9),
	(6, 'Pirate des Caraibe 5', 'Les temps sont durs pour le Capitaine Jack, et le destin semble même vouloir s’acharner lorsqu’un redoutable équipage fantôme mené par son vieil ennemi, le terrifiant Capitaine Salazar, s’échappe du Triangle du Diable pour anéantir tous les flibustiers écumant les flots… Sparrow compris ! Le seul espoir de survie du Capitaine Jack est de retrouver le légendaire Trident de Poséidon.', 3),
	(7, 'Kong', 'Un groupe d\'explorateurs plus différents les uns que les autres s\'aventurent au cœur d\'une île inconnue du Pacifique, aussi belle que dangereuse. Ils ne savent pas encore qu\'ils viennent de pénétrer sur le territoire de Kong.', 7),
	(8, 'Jurassic World 2', 'Cela fait maintenant quatre ans que les dinosaures se sont échappés de leurs enclos et ont détruit le parc à thème et complexe de luxe Jurassic World. Isla Nublar a été abandonnée par les humains alors que les dinosaures survivants sont livrés à eux-mêmes dans la jungle. Lorsque le volcan inactif de l\'île commence à rugir.', 6),
	(9, 'Coco', 'Depuis déjà plusieurs générations, la musique est bannie dans la famille de Miguel. Un vrai déchirement pour le jeune garçon dont le rêve ultime est de devenir un musicien aussi accompli que son idole, Ernesto de la Cruz. ', 2),
	(10, 'Moonlight', 'Après avoir grandi dans un quartier difficile de Miami, Chiron, un jeune homme tente de trouver sa place dans le monde. Moonlight évoque son parcours, de l’enfance à l’âge adulte.', 5);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `lienimgposter` (
  `id_imp` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(200) DEFAULT NULL,
  `id_f` int(11) NOT NULL,
  PRIMARY KEY (`id_imp`),
  KEY `id_f` (`id_f`),
  CONSTRAINT `lienimgposter_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `film` (`id_f`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

DELETE FROM `lienimgposter`;
/*!40000 ALTER TABLE `lienimgposter` DISABLE KEYS */;
INSERT INTO `lienimgposter` (`id_imp`, `lien`, `id_f`) VALUES
	(1, 'poster/logan.jpg', 1),
	(2, 'poster/garfield.jpg', 2),
	(3, 'poster/mars.jpg', 3),
	(5, 'poster/pirate.jpg', 6),
	(6, 'poster/kong.jpg', 7),
	(7, 'poster/jura.jpg', 8),
	(8, 'poster/coco.jpg', 9),
	(9, 'poster/ana.jpg', 5),
	(10, 'poster/moonlight.jpg', 10);
/*!40000 ALTER TABLE `lienimgposter` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `lienimgposters` (
  `id_imp` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(300) DEFAULT NULL,
  `id_s` int(11) NOT NULL,
  PRIMARY KEY (`id_imp`),
  KEY `id_s` (`id_s`),
  CONSTRAINT `lienimgposters_ibfk_1` FOREIGN KEY (`id_s`) REFERENCES `serie` (`id_s`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

DELETE FROM `lienimgposters`;
/*!40000 ALTER TABLE `lienimgposters` DISABLE KEYS */;
INSERT INTO `lienimgposters` (`id_imp`, `lien`, `id_s`) VALUES
	(1, 'poster/vikings.jpg', 1),
	(3, 'poster/stranger.jpg', 2),
	(4, 'poster/rm.jpg', 3),
	(5, 'poster/twd.jpg', 4),
	(6, 'poster/break.jpg', 5),
	(7, 'poster/bbt.jpg', 6);
/*!40000 ALTER TABLE `lienimgposters` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `notefilm` (
  `id_n` int(11) NOT NULL AUTO_INCREMENT,
  `note` varchar(1) NOT NULL,
  `id_u` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  PRIMARY KEY (`id_n`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM `notefilm`;
/*!40000 ALTER TABLE `notefilm` DISABLE KEYS */;
/*!40000 ALTER TABLE `notefilm` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `noteserie` (
  `id_ns` int(11) NOT NULL AUTO_INCREMENT,
  `note` varchar(1) NOT NULL,
  `id_u` int(11) NOT NULL,
  `id_s` int(11) NOT NULL,
  PRIMARY KEY (`id_ns`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM `noteserie`;
/*!40000 ALTER TABLE `noteserie` DISABLE KEYS */;
/*!40000 ALTER TABLE `noteserie` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `saison` (
  `id_sn` int(11) NOT NULL,
  PRIMARY KEY (`id_sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM `saison`;
/*!40000 ALTER TABLE `saison` DISABLE KEYS */;
INSERT INTO `saison` (`id_sn`) VALUES
	(1);
/*!40000 ALTER TABLE `saison` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `serie` (
  `id_s` int(11) NOT NULL AUTO_INCREMENT,
  `id_sn` int(11) NOT NULL,
  `episode` varchar(50) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `id_c` int(11) NOT NULL,
  `description` varchar(400) NOT NULL,
  PRIMARY KEY (`id_s`),
  KEY `id_c` (`id_c`),
  KEY `FK_serie_saison` (`id_sn`),
  CONSTRAINT `FK_serie_saison` FOREIGN KEY (`id_sn`) REFERENCES `saison` (`id_sn`),
  CONSTRAINT `serie_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `categorie` (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

DELETE FROM `serie`;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
INSERT INTO `serie` (`id_s`, `id_sn`, `episode`, `titre`, `id_c`, `description`) VALUES
	(1, 1, '1', 'Vikings', 1, 'Les exploits d\'un groupe de Vikings mené par Ragnar Lothbrok, l\'un des vikings les plus populaires de tous les temps au destin semi-légendaire, sont narrés par la série. Ragnar serait d\'origine norvégienne et suédoise, selon les sources. Il est supposé avoir unifié les clans vikings en un royaume aux frontières indéterminées à la fin du VIIIe siècle.'),
	(2, 1, '1', 'Stranger Things ', 6, 'A Hawkins, en 1983 dans l\'Indiana. Lorsque Will Byers disparaît de son domicile, ses amis se lancent dans une recherche semée d’embûches pour le retrouver. Dans leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite. Les garçons se lient d\'amitié avec la demoiselle tatouée du chiffre 11.'),
	(3, 1, '1', 'Rick et Morty ', 2, 'Les parents de Morty découvrent qu\'il était absent de l\'école pendant la moitié de l\'année scolaire. Il était avec Rick, en vadrouille dans l\'univers.'),
	(4, 1, '1', 'The walking Dead', 3, 'Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d\'hommes et de femmes mené par l\'officier Rick Grimes tente de survivre... Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde devenu méconnaissable, à travers leur périple dans le Sud profond des États-Unis.'),
	(5, 1, '1', 'Breaking Bad', 5, 'Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement. Son quotidien déjà morose devient carrément noir lorsqu\'il apprend qu\'il est atteint d\'un incurable cancer des poumons.'),
	(6, 1, '1', 'The Big Bang Theory', 4, 'Leonard et Sheldon pourraient vous dire tout ce que vous voudriez savoir à propos de la physique quantique. Mais ils seraient bien incapables de vous expliquer quoi que ce soit sur la vie réelle, le quotidien ou les relations humaines... Mais tout va changer avec l\'arrivée de la superbe Penny, leur voisine.');
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id_u` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `datelastco` datetime NOT NULL,
  `niveau` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_u`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_u`, `login`, `mdp`, `nom`, `prenom`, `mail`, `ip`, `date_inscription`, `datelastco`, `niveau`) VALUES
	(12, 'admin', '782dd27ea8e3b4f4095ffa38eeb4d20b59069077', 'azer', 'azer', 'azer@gmail.com', '::1', '2018-05-16 19:13:58', '2018-04-29 14:07:40', 2),
	(13, 'aaa', '7e240de74fb1ed08fa08d38063f6a6a91462a815', 'aaa', 'aaa', 'aaa@gmail.com', '::1', '2018-04-17 17:11:29', '2018-04-28 04:43:51', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `videof` (
  `id_v` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(200) DEFAULT NULL,
  `id_f` int(11) NOT NULL,
  PRIMARY KEY (`id_v`),
  KEY `id_f` (`id_f`),
  CONSTRAINT `videof_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `film` (`id_f`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

DELETE FROM `videof`;
/*!40000 ALTER TABLE `videof` DISABLE KEYS */;
INSERT INTO `videof` (`id_v`, `lien`, `id_f`) VALUES
	(1, 'https://www.youtube.com/embed/r2o_BA__1e4?rel=0&amp;showinfo=0', 1),
	(2, 'https://www.youtube.com/embed/63wTRmQmqfA?showinfo=0', 5),
	(4, 'https://www.youtube.com/embed/hVO8wchwtn0?showinfo=0', 3),
	(5, 'https://www.youtube.com/embed/CMCTm1D4Tac?showinfo=0', 2),
	(6, 'https://www.youtube.com/embed/3Td3oSC1isI?showinfo=0', 6),
	(7, 'https://www.youtube.com/embed/kK3NYrSYVts?showinfo=0', 7),
	(8, 'https://www.youtube.com/embed/GoKizKnHicQ?showinfo=0', 9),
	(9, 'https://www.youtube.com/embed/qxFgkv-8JWc?showinfo=0', 8),
	(10, 'https://www.youtube.com/embed/9NJj12tJzqc?showinfo=0', 10);
/*!40000 ALTER TABLE `videof` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `videos` (
  `id_v` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(300) DEFAULT NULL,
  `id_s` int(11) NOT NULL,
  `id_sn` int(11) NOT NULL,
  `episode` varchar(50) NOT NULL,
  PRIMARY KEY (`id_v`),
  KEY `FK_videos_serie` (`id_s`),
  KEY `FK_videos_saison` (`id_sn`),
  CONSTRAINT `FK_videos_saison` FOREIGN KEY (`id_sn`) REFERENCES `saison` (`id_sn`),
  CONSTRAINT `FK_videos_serie` FOREIGN KEY (`id_s`) REFERENCES `serie` (`id_s`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

DELETE FROM `videos`;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` (`id_v`, `lien`, `id_s`, `id_sn`, `episode`) VALUES
	(1, 'https://www.youtube.com/embed/mAl60ykBm4A?showinfo=0', 1, 1, '1'),
	(2, 'https://www.youtube.com/embed/LA7893f-B_A?showinfo=0', 2, 1, '1'),
	(3, 'https://www.youtube.com/embed/opRwgY7RDP0?showinfo=0', 3, 1, '1'),
	(4, 'https://www.youtube.com/embed/XvZR9RjUod8?showinfo=0', 4, 1, '1'),
	(5, 'https://www.youtube.com/embed/HhesaQXLuRY?showinfo=0', 5, 1, '1'),
	(6, 'https://www.youtube.com/embed/Ldv22Vnn4LY?showinfo=0', 6, 1, '1');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `vuef` (
  `id_v` int(11) NOT NULL AUTO_INCREMENT,
  `id_f` int(11) NOT NULL,
  `datevue` datetime DEFAULT NULL,
  PRIMARY KEY (`id_v`),
  KEY `id_f` (`id_f`),
  CONSTRAINT `vuef_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `film` (`id_f`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM `vuef`;
/*!40000 ALTER TABLE `vuef` DISABLE KEYS */;
/*!40000 ALTER TABLE `vuef` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `vues` (
  `id_v` int(11) NOT NULL AUTO_INCREMENT,
  `id_s` int(11) NOT NULL,
  `datevue` datetime DEFAULT NULL,
  `id_sn` int(11) DEFAULT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `episode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_v`),
  KEY `id_s` (`id_s`),
  KEY `FK_vues_saison` (`id_sn`),
  CONSTRAINT `FK_vues_saison` FOREIGN KEY (`id_sn`) REFERENCES `saison` (`id_sn`),
  CONSTRAINT `vues_ibfk_1` FOREIGN KEY (`id_s`) REFERENCES `serie` (`id_s`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

DELETE FROM `vues`;
/*!40000 ALTER TABLE `vues` DISABLE KEYS */;
INSERT INTO `vues` (`id_v`, `id_s`, `datevue`, `id_sn`, `titre`, `episode`) VALUES
	(37, 3, '2018-04-28 16:58:56', 1, 'Rick et Morty 1', '1');
/*!40000 ALTER TABLE `vues` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
