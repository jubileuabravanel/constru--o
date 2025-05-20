-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.34 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para construcao
DROP DATABASE IF EXISTS `construcao`;
CREATE DATABASE IF NOT EXISTS `construcao` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `construcao`;

-- Copiando estrutura para tabela construcao.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela construcao.categorias: ~3 rows (aproximadamente)
INSERT INTO `categorias` (`id_categoria`, `nome`) VALUES
	(2, 'Acabamento'),
	(3, 'Ferramentas'),
	(1, 'Materiais');

-- Copiando estrutura para tabela construcao.produtos
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `unidade` int NOT NULL DEFAULT '0',
  `preco` decimal(10,2) NOT NULL DEFAULT '0.00',
  `categoria_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_produto`),
  KEY `FK_produtos_categorias` (`categoria_id`),
  CONSTRAINT `FK_produtos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela construcao.produtos: ~0 rows (aproximadamente)
INSERT INTO `produtos` (`id_produto`, `nome`, `unidade`, `preco`, `categoria_id`) VALUES
	(1, 'Maquita', 24, 55.00, 3),
	(2, 'Furadeira', 25, 35.00, 3),
	(3, 'Massa Corrida', 25, 15.00, 2),
	(4, 'Argamassa', 34, 15.00, 2),
	(5, 'Tijolo', 50000, 10.00, 1),
	(6, 'Cimento', 40000, 40.00, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
