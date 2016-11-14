CREATE DATABASE IF NOT EXISTS `dbprojetorat` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbprojetorat`;


-- Copiando estrutura para tabela dbprojetorat.tbcliente
CREATE TABLE IF NOT EXISTS `tbcliente` (
  `codCli` int(10) NOT NULL AUTO_INCREMENT,
  `nomCli` varchar(50) NOT NULL,
  `nomRes` varchar(50) NOT NULL,
  `emlRes` varchar(50) NOT NULL,
  PRIMARY KEY (`codCli`)
)

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela dbprojetorat.tbprojeto
CREATE TABLE IF NOT EXISTS `tbprojeto` (
  `codPrj` int(10) NOT NULL AUTO_INCREMENT,
  `nomPrj` varchar(50) NOT NULL,
  `nomPrd` varchar(50) NOT NULL,
  `datIni` date NOT NULL,
  `codCli` int(10) NOT NULL,
  PRIMARY KEY (`codPrj`),
  KEY `fk_projeto_cliente` (`codCli`),
  CONSTRAINT `fk_projeto_cliente` FOREIGN KEY (`codCli`) REFERENCES `tbcliente` (`codCli`)
  `nomCli` varchar(50) NOT NULL,
  PRIMARY KEY (`codPrj`)
)

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

CREATE TABLE IF NOT EXISTS `tbprojeto` (
  `codPrj` int(10) NOT NULL AUTO_INCREMENT,
  `nomPrj` varchar(50) NOT NULL,
  `nomPrd` varchar(50) NOT NULL,
  `datIni` date NOT NULL,
  `codCli` int(10) NOT NULL,
  PRIMARY KEY (`codPrj`))