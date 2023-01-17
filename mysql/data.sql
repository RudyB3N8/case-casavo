-- --------------------------------------------------------
-- Hôte:                         localhost
-- Version du serveur:           8.0.31 - MySQL Community Server - GPL
-- SE du serveur:                Linux
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour casavo
CREATE DATABASE IF NOT EXISTS `casavo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `casavo`;

-- Listage de la structure de table casavo. biens
CREATE TABLE IF NOT EXISTS `biens` (
  `id` int NOT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `code_postal` char(5) DEFAULT NULL,
  `adresse` text,
  `superficie` int DEFAULT NULL,
  `prix` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table casavo.biens : ~3 rows (environ)
INSERT INTO `biens` (`id`, `ville`, `code_postal`, `adresse`, `superficie`, `prix`) VALUES
	(1, 'Paris', '75002', '87-89 Rue Montmartre', 60, 250000),
	(2, 'Paris', '75005', '28 Rue Monge', 48, 220000),
	(3, 'Boulogne-Billancourt', '92100', '1 Rue Carnot', 80, 350000);

-- Listage de la structure de table casavo. clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `envoie_nouveau_bien` tinyint DEFAULT NULL,
  `notif_nouveau_bien` tinyint DEFAULT NULL,
  `status_du_compte` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table casavo.clients : ~5 rows (environ)
INSERT INTO `clients` (`id`, `nom`, `email`, `envoie_nouveau_bien`, `notif_nouveau_bien`, `status_du_compte`) VALUES
	(1, 'Madelene Bellefeuille', 'madelenebellefeuille@dayrep.com', 1, 1, 2),
	(2, 'Éric Barrière', 'ericbarriere@jourrapide.com', 1, 0, 1),
	(3, 'Galatee Chaussée', 'galateechaussee@dayrep.com', 1, 0, 2),
	(4, 'Porter Faubert', 'porterfaubert@jourrapide.com', 0, 1, 2),
	(5, 'Cinderella Rousseau', 'cinderellarousseau@jourrapide.com', 0, 0, 3);

-- Listage de la structure de table casavo. critere_client
CREATE TABLE IF NOT EXISTS `critere_client` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `code_postal` char(5) DEFAULT NULL,
  `superficie_min` int DEFAULT NULL,
  `superficie_max` int DEFAULT NULL,
  `prix_min` float DEFAULT NULL,
  `prix_max` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `CritereClient_Clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table casavo.critere_client : ~6 rows (environ)
INSERT INTO `critere_client` (`id`, `client_id`, `ville`, `code_postal`, `superficie_min`, `superficie_max`, `prix_min`, `prix_max`) VALUES
	(1, 1, 'Paris', '75002', 55, 65, 180000, 200000),
	(2, 2, 'Paris', '75002', 50, 70, 200000, 300000),
	(3, 2, 'Paris', '75005', 40, 50, 200000, 300000),
	(4, 3, 'Paris', '75005', 35, 55, 180000, 300000),
	(5, 4, 'Boulogne-Billancourt', '92100', 70, 85, 350000, 400000),
	(6, 5, 'Boulogne-Billancourt', '92100', 70, 85, 300000, 375000);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
