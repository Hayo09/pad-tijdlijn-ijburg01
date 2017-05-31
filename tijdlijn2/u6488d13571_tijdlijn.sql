# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.35)
# Database: u6488d13571_tijdlijn
# Generation Time: 2017-03-27 20:06:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table docent
# ------------------------------------------------------------

DROP TABLE IF EXISTS `docent`;

CREATE TABLE `docent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) DEFAULT NULL,
  `mentorklas_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `docent` WRITE;
/*!40000 ALTER TABLE `docent` DISABLE KEYS */;

INSERT INTO `docent` (`id`, `voornaam`, `achternaam`, `mentorklas_id`, `email`)
VALUES
	(0,'Lars Kort',NULL,NULL,'lars.kort94@gmail.com'),
	(9,'Lars Kort',NULL,NULL,'lars.kort94@gmail.com'),
	(32,'Lars Kort',NULL,NULL,'lars.kort94@gmail.com');

/*!40000 ALTER TABLE `docent` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table elementen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `elementen`;

CREATE TABLE `elementen` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tijdlijn_id` int(11) DEFAULT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `jaar` varchar(255) DEFAULT NULL,
  `beschrijving` varchar(500) DEFAULT NULL,
  `afbeelding_url` varchar(255) DEFAULT NULL,
  `docent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `elementen` WRITE;
/*!40000 ALTER TABLE `elementen` DISABLE KEYS */;

INSERT INTO `elementen` (`id`, `tijdlijn_id`, `titel`, `jaar`, `beschrijving`, `afbeelding_url`, `docent_id`)
VALUES
	(225,73,'Titel1','1905','Beschrijving1','',1),
	(226,73,'Titel2','1920','Beschrijving2','',1),
	(227,73,'Titel3','1940','Beschrijving3','',1),
	(228,73,'Titel4','1960','Beschrijving4','',1),
	(229,73,'Titel5','1980','Beschrijving5','',1),
	(292,93,'Gebeurtenis 1','1850','Gebeurtenis 12','',1),
	(293,93,'Gebeurtenis 2','1860','Gebeurtenis 22','',1);

/*!40000 ALTER TABLE `elementen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table klas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `klas`;

CREATE TABLE `klas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `docent_id` int(11) DEFAULT NULL,
  `naam` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `klas` WRITE;
/*!40000 ALTER TABLE `klas` DISABLE KEYS */;

INSERT INTO `klas` (`id`, `docent_id`, `naam`)
VALUES
	(1,1,'IS108'),
	(2,2,'IS109'),
	(3,3,'IS1010');

/*!40000 ALTER TABLE `klas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) DEFAULT NULL,
  `leeftijd` int(11) DEFAULT NULL,
  `klas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tijdlijn
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tijdlijn`;

CREATE TABLE `tijdlijn` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL DEFAULT '',
  `beschrijving` varchar(500) DEFAULT '',
  `afbeelding_url` varchar(255) DEFAULT NULL,
  `url_id` int(11) NOT NULL,
  `vak_id` int(11) NOT NULL,
  `klas_id` int(11) NOT NULL,
  `docent_id` int(11) NOT NULL,
  `jaar_start` varchar(255) NOT NULL DEFAULT '',
  `jaar_eind` varchar(255) NOT NULL DEFAULT '',
  `aantal_elementen` int(11) NOT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tijdlijn` WRITE;
/*!40000 ALTER TABLE `tijdlijn` DISABLE KEYS */;

INSERT INTO `tijdlijn` (`id`, `titel`, `beschrijving`, `afbeelding_url`, `url_id`, `vak_id`, `klas_id`, `docent_id`, `jaar_start`, `jaar_eind`, `aantal_elementen`, `createdate`)
VALUES
	(73,'Titel van Tijdlijn','Beschrijving van Tijdlijn','URL',24,2,3,9,'1900','2000',5,'2017-03-27 19:59:56'),
	(93,'Titel 2','BEschrijving','',27,1,1,32,'1800','1900',2,'2017-03-27 22:00:56');

/*!40000 ALTER TABLE `tijdlijn` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table url_tijdlijn
# ------------------------------------------------------------

DROP TABLE IF EXISTS `url_tijdlijn`;

CREATE TABLE `url_tijdlijn` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tijdlijn_id` int(11) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `url_tijdlijn` WRITE;
/*!40000 ALTER TABLE `url_tijdlijn` DISABLE KEYS */;

INSERT INTO `url_tijdlijn` (`id`, `tijdlijn_id`, `url`)
VALUES
	(24,73,'tijdlijn.php?tid=73'),
	(27,93,'tijdlijn.php?tid=93');

/*!40000 ALTER TABLE `url_tijdlijn` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vak
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vak`;

CREATE TABLE `vak` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `docent_id` int(11) DEFAULT NULL,
  `naam` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `vak` WRITE;
/*!40000 ALTER TABLE `vak` DISABLE KEYS */;

INSERT INTO `vak` (`id`, `docent_id`, `naam`)
VALUES
	(1,1,'Geschiedenis'),
	(2,1,'Biologie'),
	(3,2,'Engels');

/*!40000 ALTER TABLE `vak` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
