-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `php-todos`;
CREATE DATABASE `php-todos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `php-todos`;

DROP TABLE IF EXISTS `todos`;
CREATE TABLE `todos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `done` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `todos` (`id`, `description`, `rank`, `done`) VALUES
(1,	'Importer la base de données',	1,	CONV('1', 2, 10) + 0),
(2,	'Utiliser Composer pour installer le projet',	2,	CONV('1', 2, 10) + 0),
(3,	'Créer un modèle pour les tâches à faire',	3,	CONV('0', 2, 10) + 0),
(4,	'Créer un contrôleur pour gérer les différentes requêtes',	4,	CONV('0', 2, 10) + 0),
(5,	'Créer une vue pour générer les pages HTML',	5,	CONV('0', 2, 10) + 0);

-- 2020-10-30 08:06:23