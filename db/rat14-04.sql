-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.16-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para dbprojetorat
CREATE DATABASE IF NOT EXISTS `dbprojetorat` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbprojetorat`;


-- Copiando estrutura para tabela dbprojetorat.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.chat: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
	(13, '2', '1', 'hey', '2017-04-14 12:13:57', 1),
	(14, '1', '2', 'aaaaaaaa', '2017-04-14 12:15:04', 1);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.chat_lastactivity
CREATE TABLE IF NOT EXISTS `chat_lastactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.chat_lastactivity: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `chat_lastactivity` DISABLE KEYS */;
INSERT INTO `chat_lastactivity` (`id`, `user`, `time`) VALUES
	(1, '2', 1492183522),
	(2, '1', 1492190541),
	(3, '3', 1492172315),
	(4, '', 1492178734);
/*!40000 ALTER TABLE `chat_lastactivity` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.sample_friends
CREATE TABLE IF NOT EXISTS `sample_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `confirmed` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.sample_friends: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `sample_friends` DISABLE KEYS */;
INSERT INTO `sample_friends` (`id`, `user1`, `user2`, `confirmed`) VALUES
	(1, 1, 2, 's'),
	(2, 1, 3, 's');
/*!40000 ALTER TABLE `sample_friends` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbatividade
CREATE TABLE IF NOT EXISTS `tbatividade` (
  `codAti` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datAti` date DEFAULT NULL,
  `horIni` time DEFAULT NULL,
  `horFin` time DEFAULT NULL,
  `desAti` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`codAti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbatividade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbatividade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbatividade` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbcliente
CREATE TABLE IF NOT EXISTS `tbcliente` (
  `codCli` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desRazaoSocial` char(40) DEFAULT NULL,
  `numCEP` varchar(8) DEFAULT NULL,
  `numCNPJ` varchar(14) DEFAULT NULL,
  `desCid` varchar(50) DEFAULT NULL,
  `desUF` varchar(2) DEFAULT NULL,
  `desBai` varchar(50) DEFAULT NULL,
  `desEnd` varchar(100) DEFAULT NULL,
  `numEnd` decimal(10,0) DEFAULT NULL,
  `telCli` varchar(11) DEFAULT NULL,
  `iesCli` varchar(9) DEFAULT NULL,
  `nomCli` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codCli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbcliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbcliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcliente` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbcomissao
CREATE TABLE IF NOT EXISTS `tbcomissao` (
  `codCom` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`codCom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbcomissao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbcomissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcomissao` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbdespesa
CREATE TABLE IF NOT EXISTS `tbdespesa` (
  `codDsp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desDsp` int(40) unsigned DEFAULT NULL,
  `qtdDsp` decimal(10,0) DEFAULT NULL,
  `vlrDsp` decimal(10,0) DEFAULT NULL,
  `totDsp` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`codDsp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbdespesa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbdespesa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbdespesa` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbempresa
CREATE TABLE IF NOT EXISTS `tbempresa` (
  `codEmp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomEmp` char(40) DEFAULT NULL,
  PRIMARY KEY (`codEmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbempresa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbempresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbempresa` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbperfil
CREATE TABLE IF NOT EXISTS `tbperfil` (
  `codPer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desPer` char(50) DEFAULT NULL,
  PRIMARY KEY (`codPer`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbperfil: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbperfil` DISABLE KEYS */;
INSERT INTO `tbperfil` (`codPer`, `desPer`) VALUES
	(1, 'Adminstrador');
/*!40000 ALTER TABLE `tbperfil` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbproduto
CREATE TABLE IF NOT EXISTS `tbproduto` (
  `codPro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desPro` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codPro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbproduto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbproduto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbproduto` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbprojeto
CREATE TABLE IF NOT EXISTS `tbprojeto` (
  `codPrj` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Produto_codPro` int(10) unsigned NOT NULL,
  `Cliente_codCli` int(10) unsigned NOT NULL,
  `nomPrj` varchar(40) DEFAULT NULL,
  `nomPrd` int(10) unsigned DEFAULT NULL,
  `datIni` date DEFAULT NULL,
  PRIMARY KEY (`codPrj`),
  KEY `Projeto_FKIndex1` (`Cliente_codCli`),
  KEY `Projeto_FKIndex2` (`Produto_codPro`),
  CONSTRAINT `tbprojeto_ibfk_1` FOREIGN KEY (`Cliente_codCli`) REFERENCES `tbcliente` (`codCli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbprojeto_ibfk_2` FOREIGN KEY (`Produto_codPro`) REFERENCES `tbproduto` (`codPro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbprojeto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbprojeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbprojeto` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbrat
CREATE TABLE IF NOT EXISTS `tbrat` (
  `codRat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Atividade_codAti` int(10) unsigned NOT NULL,
  `Despesa_codDsp` int(10) unsigned NOT NULL,
  `Cliente_codCli` int(10) unsigned NOT NULL,
  `Produto_codPro` int(10) unsigned NOT NULL,
  `Usuario_codUsu` int(10) unsigned NOT NULL,
  PRIMARY KEY (`codRat`),
  KEY `RAT_FKIndex1` (`Usuario_codUsu`),
  KEY `RAT_FKIndex2` (`Produto_codPro`),
  KEY `RAT_FKIndex3` (`Cliente_codCli`),
  KEY `RAT_FKIndex4` (`Despesa_codDsp`),
  KEY `RAT_FKIndex5` (`Atividade_codAti`),
  CONSTRAINT `tbrat_ibfk_1` FOREIGN KEY (`Usuario_codUsu`) REFERENCES `tbusuario` (`codUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbrat_ibfk_2` FOREIGN KEY (`Produto_codPro`) REFERENCES `tbproduto` (`codPro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbrat_ibfk_3` FOREIGN KEY (`Cliente_codCli`) REFERENCES `tbcliente` (`codCli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbrat_ibfk_4` FOREIGN KEY (`Despesa_codDsp`) REFERENCES `tbdespesa` (`codDsp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbrat_ibfk_5` FOREIGN KEY (`Atividade_codAti`) REFERENCES `tbatividade` (`codAti`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbrat: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbrat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbrat` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbresponsavel
CREATE TABLE IF NOT EXISTS `tbresponsavel` (
  `codRes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Cliente_codCli` int(10) unsigned NOT NULL,
  `nomRes` varchar(100) DEFAULT NULL,
  `emlRes` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codRes`),
  KEY `Responsavel_FKIndex1` (`Cliente_codCli`),
  CONSTRAINT `tbresponsavel_ibfk_1` FOREIGN KEY (`Cliente_codCli`) REFERENCES `tbcliente` (`codCli`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbresponsavel: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbresponsavel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbresponsavel` ENABLE KEYS */;


-- Copiando estrutura para tabela dbprojetorat.tbusuario
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `codUsu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Perfil_codPer` int(10) unsigned NOT NULL,
  `nomUsu` varchar(50) NOT NULL,
  `senUsu` varchar(50) NOT NULL,
  `codsit` int(1) NOT NULL,
  `desEml` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codUsu`),
  KEY `Usuario_FKIndex1` (`Perfil_codPer`),
  CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`Perfil_codPer`) REFERENCES `tbperfil` (`codPer`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbusuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `tbusuario` DISABLE KEYS */;
INSERT INTO `tbusuario` (`codUsu`, `Perfil_codPer`, `nomUsu`, `senUsu`, `codsit`, `desEml`) VALUES
	(1, 1, 'admin', 'admin', 1, 'admin@admin.com.br'),
	(2, 1, 'teste_rat', 'teste', 1, 'teste@teste.com.br');
/*!40000 ALTER TABLE `tbusuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
