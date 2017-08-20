-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.21-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para dbprojetorat
DROP DATABASE IF EXISTS `dbprojetorat`;
CREATE DATABASE IF NOT EXISTS `dbprojetorat` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbprojetorat`;

-- Copiando estrutura para tabela dbprojetorat.chat
DROP TABLE IF EXISTS `chat`;
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
DELETE FROM `chat`;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
	(13, '2', '1', 'hey', '2017-04-14 12:13:57', 1),
	(14, '1', '2', 'aaaaaaaa', '2017-04-14 12:15:04', 1);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.chat_lastactivity
DROP TABLE IF EXISTS `chat_lastactivity`;
CREATE TABLE IF NOT EXISTS `chat_lastactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.chat_lastactivity: ~4 rows (aproximadamente)
DELETE FROM `chat_lastactivity`;
/*!40000 ALTER TABLE `chat_lastactivity` DISABLE KEYS */;
INSERT INTO `chat_lastactivity` (`id`, `user`, `time`) VALUES
	(1, '2', 1492183522),
	(2, '1', 1494890102),
	(3, '3', 1492172315),
	(4, '', 1492485126);
/*!40000 ALTER TABLE `chat_lastactivity` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.sample_friends
DROP TABLE IF EXISTS `sample_friends`;
CREATE TABLE IF NOT EXISTS `sample_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `confirmed` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.sample_friends: ~2 rows (aproximadamente)
DELETE FROM `sample_friends`;
/*!40000 ALTER TABLE `sample_friends` DISABLE KEYS */;
INSERT INTO `sample_friends` (`id`, `user1`, `user2`, `confirmed`) VALUES
	(1, 1, 2, 's'),
	(2, 1, 3, 's');
/*!40000 ALTER TABLE `sample_friends` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbatividade
DROP TABLE IF EXISTS `tbatividade`;
CREATE TABLE IF NOT EXISTS `tbatividade` (
  `codAti` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RAT_codRAT` int(10) unsigned DEFAULT NULL,
  `Usuario_codUsu` int(10) unsigned DEFAULT NULL,
  `datAti` date DEFAULT NULL,
  `horIni` time DEFAULT NULL,
  `horFin` time DEFAULT NULL,
  `desAti` varchar(200) DEFAULT NULL,
  `tipFat` int(1) DEFAULT NULL,
  PRIMARY KEY (`codAti`),
  KEY `fk_tbatividade_tbrat` (`RAT_codRAT`),
  KEY `fk_tbatividade_tbusuario` (`Usuario_codUsu`),
  CONSTRAINT `fk_tbatividade_tbrat` FOREIGN KEY (`RAT_codRAT`) REFERENCES `tbrat` (`codRat`),
  CONSTRAINT `fk_tbatividade_tbusuario` FOREIGN KEY (`Usuario_codUsu`) REFERENCES `tbusuario` (`codUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbatividade: ~33 rows (aproximadamente)
DELETE FROM `tbatividade`;
/*!40000 ALTER TABLE `tbatividade` DISABLE KEYS */;
INSERT INTO `tbatividade` (`codAti`, `RAT_codRAT`, `Usuario_codUsu`, `datAti`, `horIni`, `horFin`, `desAti`, `tipFat`) VALUES
	(1, 6, 7, '2017-08-09', '20:55:48', '20:55:49', 'Descriçao', 1),
	(2, 6, 7, '2017-08-09', '20:56:18', '20:56:19', 'Descriçao2', 1),
	(3, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(4, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(5, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(6, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(7, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(8, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(9, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(10, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(11, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(12, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(13, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(14, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(15, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(16, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(17, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(18, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(19, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(20, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(21, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(22, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(23, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(24, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(25, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(26, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(27, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(28, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(29, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(30, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(31, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(32, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0),
	(33, 8, 1, '1970-01-01', '01:00:00', '01:00:00', '', 0);
/*!40000 ALTER TABLE `tbatividade` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbcliente
DROP TABLE IF EXISTS `tbcliente`;
CREATE TABLE IF NOT EXISTS `tbcliente` (
  `codCli` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desRazaoSocial` char(100) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbcliente: ~3 rows (aproximadamente)
DELETE FROM `tbcliente`;
/*!40000 ALTER TABLE `tbcliente` DISABLE KEYS */;
INSERT INTO `tbcliente` (`codCli`, `desRazaoSocial`, `numCEP`, `numCNPJ`, `desCid`, `desUF`, `desBai`, `desEnd`, `numEnd`, `telCli`, `iesCli`, `nomCli`) VALUES
	(1, 'Gestao Eireli1', '', '73932394000191', 'Blumenau', '', '', '', 0, '', '', 'Gestao'),
	(2, 'Senior2', '', '', 'Joinville', '', '', '', 0, '', '', 'Senior'),
	(3, 'Gestao Sistemas e Servicos de Informatica LTDA', '', '', 'Joinville', '', '', '', 0, '', '', 'Senior Joinville');
/*!40000 ALTER TABLE `tbcliente` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbcomissao
DROP TABLE IF EXISTS `tbcomissao`;
CREATE TABLE IF NOT EXISTS `tbcomissao` (
  `codCom` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`codCom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbcomissao: ~0 rows (aproximadamente)
DELETE FROM `tbcomissao`;
/*!40000 ALTER TABLE `tbcomissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcomissao` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbdespesa
DROP TABLE IF EXISTS `tbdespesa`;
CREATE TABLE IF NOT EXISTS `tbdespesa` (
  `codDsp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Tipodespesa_CodTipDsp` int(10) unsigned NOT NULL DEFAULT '0',
  `desDsp` varchar(100) DEFAULT NULL,
  `vlrUni` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`codDsp`),
  KEY `fk_tbdespesa_tbtipodespesa` (`Tipodespesa_CodTipDsp`),
  CONSTRAINT `fk_tbdespesa_tbtipodespesa` FOREIGN KEY (`Tipodespesa_CodTipDsp`) REFERENCES `tbtipodespesa` (`codTipDsp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbdespesa: ~1 rows (aproximadamente)
DELETE FROM `tbdespesa`;
/*!40000 ALTER TABLE `tbdespesa` DISABLE KEYS */;
INSERT INTO `tbdespesa` (`codDsp`, `Tipodespesa_CodTipDsp`, `desDsp`, `vlrUni`) VALUES
	(6, 1, 'KM Rodado1', 1000.00);
/*!40000 ALTER TABLE `tbdespesa` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbdespesarat
DROP TABLE IF EXISTS `tbdespesarat`;
CREATE TABLE IF NOT EXISTS `tbdespesarat` (
  `seqDsp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Despesa_codDsp` int(10) unsigned DEFAULT NULL,
  `RAT_codRAT` int(10) unsigned DEFAULT NULL,
  `Fatdespesa_codTipFat` int(10) unsigned DEFAULT NULL,
  `Usuario_codUsu` int(10) unsigned DEFAULT NULL,
  `datDsp` date DEFAULT NULL,
  `obsDsp` varchar(200) DEFAULT NULL,
  `qtdDsp` int(10) unsigned DEFAULT NULL,
  `totDsp` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`seqDsp`),
  KEY `fk_tbdespesarat_tbrat` (`RAT_codRAT`),
  KEY `fk_tbdespesarat_tbusuario` (`Usuario_codUsu`),
  KEY `fk_tbdespesarat_tbdespesa` (`Despesa_codDsp`),
  KEY `fk_tbdespesarat_tbfatdespesa` (`Fatdespesa_codTipFat`),
  CONSTRAINT `fk_tbdespesarat_tbdespesa` FOREIGN KEY (`Despesa_codDsp`) REFERENCES `tbdespesa` (`codDsp`),
  CONSTRAINT `fk_tbdespesarat_tbfatdespesa` FOREIGN KEY (`Fatdespesa_codTipFat`) REFERENCES `tbfatdespesa` (`codFatDsp`),
  CONSTRAINT `fk_tbdespesarat_tbrat` FOREIGN KEY (`RAT_codRAT`) REFERENCES `tbrat` (`codRat`),
  CONSTRAINT `fk_tbdespesarat_tbusuario` FOREIGN KEY (`Usuario_codUsu`) REFERENCES `tbusuario` (`codUsu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbdespesarat: ~0 rows (aproximadamente)
DELETE FROM `tbdespesarat`;
/*!40000 ALTER TABLE `tbdespesarat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbdespesarat` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbempresa
DROP TABLE IF EXISTS `tbempresa`;
CREATE TABLE IF NOT EXISTS `tbempresa` (
  `codEmp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomEmp` char(40) DEFAULT NULL,
  PRIMARY KEY (`codEmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbempresa: ~0 rows (aproximadamente)
DELETE FROM `tbempresa`;
/*!40000 ALTER TABLE `tbempresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbempresa` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbfatdespesa
DROP TABLE IF EXISTS `tbfatdespesa`;
CREATE TABLE IF NOT EXISTS `tbfatdespesa` (
  `codFatDsp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desFatDsp` varchar(2) DEFAULT NULL,
  `detFatDsp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codFatDsp`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbfatdespesa: ~4 rows (aproximadamente)
DELETE FROM `tbfatdespesa`;
/*!40000 ALTER TABLE `tbfatdespesa` DISABLE KEYS */;
INSERT INTO `tbfatdespesa` (`codFatDsp`, `desFatDsp`, `detFatDsp`) VALUES
	(1, 'FR', 'Fatura e reembolsa'),
	(2, 'FN', 'Fatura e não reembolsa'),
	(3, 'NR', 'Não reembolsa'),
	(4, 'NN', 'Não fatura e não reembolsa');
/*!40000 ALTER TABLE `tbfatdespesa` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbpapel
DROP TABLE IF EXISTS `tbpapel`;
CREATE TABLE IF NOT EXISTS `tbpapel` (
  `codPap` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desPap` char(50) DEFAULT NULL,
  PRIMARY KEY (`codPap`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbpapel: ~2 rows (aproximadamente)
DELETE FROM `tbpapel`;
/*!40000 ALTER TABLE `tbpapel` DISABLE KEYS */;
INSERT INTO `tbpapel` (`codPap`, `desPap`) VALUES
	(1, 'Adminstrador'),
	(2, 'Consultor');
/*!40000 ALTER TABLE `tbpapel` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbproduto
DROP TABLE IF EXISTS `tbproduto`;
CREATE TABLE IF NOT EXISTS `tbproduto` (
  `codPro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desPro` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codPro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbproduto: ~4 rows (aproximadamente)
DELETE FROM `tbproduto`;
/*!40000 ALTER TABLE `tbproduto` DISABLE KEYS */;
INSERT INTO `tbproduto` (`codPro`, `desPro`) VALUES
	(1, 'Consultoria'),
	(2, 'Consultoria TI'),
	(3, 'Instalacao Ambiente'),
	(4, 'Implantacao RH2');
/*!40000 ALTER TABLE `tbproduto` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbprojeto
DROP TABLE IF EXISTS `tbprojeto`;
CREATE TABLE IF NOT EXISTS `tbprojeto` (
  `codPrj` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Produto_codPro` int(10) unsigned NOT NULL,
  `Cliente_codCli` int(10) unsigned NOT NULL,
  `nomPrj` varchar(40) DEFAULT NULL,
  `datIni` date DEFAULT NULL,
  `vlrHor` float DEFAULT NULL,
  `obsPrj` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`codPrj`),
  KEY `Projeto_FKIndex1` (`Cliente_codCli`),
  KEY `Projeto_FKIndex2` (`Produto_codPro`),
  CONSTRAINT `fk_tbprojeto_tbcliente` FOREIGN KEY (`Cliente_codCli`) REFERENCES `tbcliente` (`codCli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbprojeto_tbproduto` FOREIGN KEY (`Produto_codPro`) REFERENCES `tbproduto` (`codPro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbprojeto: ~6 rows (aproximadamente)
DELETE FROM `tbprojeto`;
/*!40000 ALTER TABLE `tbprojeto` DISABLE KEYS */;
INSERT INTO `tbprojeto` (`codPrj`, `Produto_codPro`, `Cliente_codCli`, `nomPrj`, `datIni`, `vlrHor`, `obsPrj`) VALUES
	(1, 1, 1, 'Consultoria Pontual', '2017-05-15', 153.7, ''),
	(2, 2, 1, 'Consultoria TI', '2017-05-15', 141, ''),
	(3, 3, 1, 'Instalacao Ambiente', '2017-05-15', NULL, 'teste'),
	(4, 1, 1, 'Implantacao Seguranca', '2017-05-15', NULL, 'teste'),
	(6, 1, 1, 'Implantacao SDE', '1990-11-11', NULL, 'teste'),
	(7, 1, 1, 'Implantacao ERP', '1990-11-11', 1, '');
/*!40000 ALTER TABLE `tbprojeto` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbrat
DROP TABLE IF EXISTS `tbrat`;
CREATE TABLE IF NOT EXISTS `tbrat` (
  `codRat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Usuario_codUsu` int(10) unsigned NOT NULL,
  `Cliente_codCli` int(10) unsigned NOT NULL,
  `Responsavel_codRes` int(10) unsigned NOT NULL,
  `Projeto_codPrj` int(10) unsigned NOT NULL,
  `Produto_codPro` int(10) unsigned NOT NULL,
  `Situacao_codSit` int(10) unsigned NOT NULL,
  `datRat` date NOT NULL,
  PRIMARY KEY (`codRat`),
  KEY `RAT_FKIndex1` (`Usuario_codUsu`),
  KEY `RAT_FKIndex3` (`Cliente_codCli`),
  KEY `tbrat_fk_6` (`Projeto_codPrj`),
  KEY `tbrat_fk_7` (`Situacao_codSit`),
  KEY `tbrat_fk_3` (`Responsavel_codRes`),
  KEY `fk_tbrat_tbproduto` (`Produto_codPro`),
  CONSTRAINT `fk_tbrat_tbcliente` FOREIGN KEY (`Cliente_codCli`) REFERENCES `tbcliente` (`codCli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbrat_tbproduto` FOREIGN KEY (`Produto_codPro`) REFERENCES `tbproduto` (`codPro`),
  CONSTRAINT `fk_tbrat_tbprojeto` FOREIGN KEY (`Projeto_codPrj`) REFERENCES `tbprojeto` (`codPrj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbrat_tbresponsavel` FOREIGN KEY (`Responsavel_codRes`) REFERENCES `tbresponsavel` (`codRes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbrat_tbsituacao` FOREIGN KEY (`Situacao_codSit`) REFERENCES `tbsituacaorat` (`codSit`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbrat_tbusuario` FOREIGN KEY (`Usuario_codUsu`) REFERENCES `tbusuario` (`codUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbrat: ~2 rows (aproximadamente)
DELETE FROM `tbrat`;
/*!40000 ALTER TABLE `tbrat` DISABLE KEYS */;
INSERT INTO `tbrat` (`codRat`, `Usuario_codUsu`, `Cliente_codCli`, `Responsavel_codRes`, `Projeto_codPrj`, `Produto_codPro`, `Situacao_codSit`, `datRat`) VALUES
	(6, 7, 1, 1, 1, 1, 3, '0000-00-00'),
	(8, 7, 2, 2, 2, 2, 3, '0000-00-00');
/*!40000 ALTER TABLE `tbrat` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbresponsavel
DROP TABLE IF EXISTS `tbresponsavel`;
CREATE TABLE IF NOT EXISTS `tbresponsavel` (
  `codRes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Cliente_codCli` int(10) unsigned NOT NULL,
  `nomRes` varchar(100) DEFAULT NULL,
  `emlRes` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codRes`),
  KEY `Responsavel_FKIndex1` (`Cliente_codCli`),
  CONSTRAINT `fk_tbresponsavel_tbcliente` FOREIGN KEY (`Cliente_codCli`) REFERENCES `tbcliente` (`codCli`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbresponsavel: ~2 rows (aproximadamente)
DELETE FROM `tbresponsavel`;
/*!40000 ALTER TABLE `tbresponsavel` DISABLE KEYS */;
INSERT INTO `tbresponsavel` (`codRes`, `Cliente_codCli`, `nomRes`, `emlRes`) VALUES
	(1, 1, 'Eder', 'eder@gmail.com.'),
	(2, 2, 'Franco', 'franco@gmail.com');
/*!40000 ALTER TABLE `tbresponsavel` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbsituacaorat
DROP TABLE IF EXISTS `tbsituacaorat`;
CREATE TABLE IF NOT EXISTS `tbsituacaorat` (
  `codSit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desSit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codSit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbsituacaorat: ~6 rows (aproximadamente)
DELETE FROM `tbsituacaorat`;
/*!40000 ALTER TABLE `tbsituacaorat` DISABLE KEYS */;
INSERT INTO `tbsituacaorat` (`codSit`, `desSit`) VALUES
	(1, 'Digitado'),
	(2, 'Enviado'),
	(3, 'Aprovado'),
	(4, 'Faturado'),
	(5, 'Cancelado'),
	(6, 'Rejeitado');
/*!40000 ALTER TABLE `tbsituacaorat` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbtipodespesa
DROP TABLE IF EXISTS `tbtipodespesa`;
CREATE TABLE IF NOT EXISTS `tbtipodespesa` (
  `codTipDsp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desTipDsp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codTipDsp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbtipodespesa: ~2 rows (aproximadamente)
DELETE FROM `tbtipodespesa`;
/*!40000 ALTER TABLE `tbtipodespesa` DISABLE KEYS */;
INSERT INTO `tbtipodespesa` (`codTipDsp`, `desTipDsp`) VALUES
	(1, 'Deslocamento'),
	(2, 'Pedagio');
/*!40000 ALTER TABLE `tbtipodespesa` ENABLE KEYS */;

-- Copiando estrutura para tabela dbprojetorat.tbusuario
DROP TABLE IF EXISTS `tbusuario`;
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `codUsu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Papel_codPap` int(10) unsigned NOT NULL,
  `nomUsu` varchar(50) NOT NULL,
  `sobrenomeUsu` varchar(100) DEFAULT NULL,
  `senUsu` varchar(50) NOT NULL,
  `codsit` int(1) NOT NULL,
  `desEml` varchar(50) DEFAULT NULL,
  `perCom` float DEFAULT NULL,
  PRIMARY KEY (`codUsu`),
  KEY `Usuario_FKIndex1` (`Papel_codPap`),
  CONSTRAINT `fk_tbusuario_tbpapel` FOREIGN KEY (`Papel_codPap`) REFERENCES `tbpapel` (`codPap`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dbprojetorat.tbusuario: ~4 rows (aproximadamente)
DELETE FROM `tbusuario`;
/*!40000 ALTER TABLE `tbusuario` DISABLE KEYS */;
INSERT INTO `tbusuario` (`codUsu`, `Papel_codPap`, `nomUsu`, `sobrenomeUsu`, `senUsu`, `codsit`, `desEml`, `perCom`) VALUES
	(1, 1, 'admin', 'admin', 'admin', 1, 'admin', NULL),
	(7, 2, 'Lucas', 'Nascimento', 'lucas', 1, 'lucas', 10),
	(8, 2, 'Joao', 'Silva', 'joao', 1, 'joao', 12),
	(9, 2, 'Jose', 'Souza', 'jose', 1, 'jose@jose.com.br', 1);
/*!40000 ALTER TABLE `tbusuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
