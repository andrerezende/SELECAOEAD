-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 06, 2011 as 10:06 PM
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `profsubs2011`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `ativo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `campus`
--

INSERT INTO `campus` (`id`, `nome`, `ativo`) VALUES
(1, 'BOM JESUS DA LAPA', NULL),
(2, 'CATU', NULL),
(6, 'SENHOR DO BONFIM', NULL),
(5, 'SANTA INÊS', NULL),
(9, 'VALENÇA', NULL),
(7, 'TEXEIRA DE FREITAS', NULL),
(3, 'ITAPETINGA', NULL),
(8, 'URUÇUCA', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `cod_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `ativo` char(50) DEFAULT NULL,
  `campus` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`cod_curso`, `nome`, `ativo`, `campus`) VALUES
(1, 'INFORMÁTICA', NULL, 1),
(2, 'INFORMÁTICA', NULL, 2),
(3, 'INFORMÁTICA', NULL, 3),
(5, 'INFORMÁTICA', NULL, 5),
(6, 'INFORMÁTICA', NULL, 6),
(7, 'INFORMÁTICA', NULL, 7),
(8, 'INFORMÁTICA', NULL, 8),
(9, 'INFORMÁTICA', NULL, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscrito`
--

CREATE TABLE IF NOT EXISTS `inscrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `endereco` varchar(128) NOT NULL,
  `bairro` varchar(128) NOT NULL,
  `cep` varchar(128) NOT NULL,
  `cidade` varchar(128) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `cpf` varchar(18) DEFAULT NULL,
  `rg` varchar(11) NOT NULL,
  `especial` varchar(15) DEFAULT NULL,
  `senha` varchar(20) NOT NULL,
  `nacionalidade` varchar(128) DEFAULT NULL,
  `telefone` varchar(128) NOT NULL,
  `telefone2` varchar(128) DEFAULT NULL,
  `celular` varchar(128) DEFAULT NULL,
  `datanascimento` varchar(10) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `estadocivil` varchar(45) DEFAULT NULL,
  `orgaoexpedidor` varchar(45) DEFAULT NULL,
  `uf` varchar(45) DEFAULT NULL,
  `dataexpedicao` varchar(10) DEFAULT NULL,
  `especial_descricao` varchar(128) DEFAULT NULL,
  `responsavel` varchar(128) DEFAULT NULL,
  `isencao` varchar(45) DEFAULT NULL,
  `declaracao` varchar(128) DEFAULT NULL,
  `localprova` varchar(128) DEFAULT NULL,
  `numinscricao` varchar(45) NOT NULL,
  `pagamento` varchar(45) DEFAULT NULL,
  `especial_prova` varchar(10) DEFAULT NULL,
  `especial_prova_descricao` varchar(128) DEFAULT NULL,
  `vaga_especial` varchar(10) DEFAULT NULL,
  `vaga_rede_publica` varchar(10) DEFAULT NULL,
  `vaga_rural` varchar(10) DEFAULT NULL,
  `campus` varchar(128) DEFAULT NULL,
  `cadastro_unico` varchar(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Extraindo dados da tabela `inscrito`
--

INSERT INTO `inscrito` (`id`, `nome`, `endereco`, `bairro`, `cep`, `cidade`, `estado`, `email`, `cpf`, `rg`, `especial`, `senha`, `nacionalidade`, `telefone`, `telefone2`, `celular`, `datanascimento`, `sexo`, `estadocivil`, `orgaoexpedidor`, `uf`, `dataexpedicao`, `especial_descricao`, `responsavel`, `isencao`, `declaracao`, `localprova`, `numinscricao`, `pagamento`, `especial_prova`, `especial_prova_descricao`, `vaga_especial`, `vaga_rede_publica`, `vaga_rural`, `campus`, `cadastro_unico`, `data_cadastro`, `ultima_alteracao`) VALUES
(82, 'SAULO LEAL DOS SANTOS', 'RUA DO ALBATROZ, 127', 'IMBUÍ', '41720-020', 'SALVADOR', 'BA', 'SAULOLEAL@GMAIL.COM', '00270249540', '0651975182', 'NÃO', '1', 'BRASIL', '', '', '', '09/10/1981', 'MASCULINO', 'SOLTEIRO(A)', 'SSP', 'BA', '01/01/2000', '', '', 'NAO', 'SIM', '', '0651975182091081', NULL, 'NÃO', '', 'NÃO', '', '', '6', '', '2011-01-04 10:38:45', '2011-01-05 16:38:30'),
(83, 'JOSÉ DA SILVA ALVES', 'RUA DO ROUXINOL, 115', 'IMBUí', '41720-020', 'SALVADOR', 'BA', 'SAULOLEA@YAHOO.COM.BR', '0123456789', '0123', 'OUTRA', '123', 'BRASIL', '(71) 3015-8850', '', '(71) 9981-8256', '01/01/1980', 'MASCULINO', 'SOLTEIRO(A)', 'SSP', 'BA', '01/01/2000', 'NECESSIDADE ESPECIAL', '', 'SIM', 'SIM', '', '01231', NULL, 'SIM', 'LEITOR', 'NAO', '', '', '1', '', '2011-01-05 15:23:21', NULL),
(84, 'JOSÉ DA SILVA ALVES', 'RUA DO ROUXINOL, 115', 'IMBUí', '41720-020', 'SALVADOR', 'BA', 'SAULOLEA@YAHOO.COM.BR', '01234567890', '0123', 'OUTRA', '1', 'BRASIL', '(71) 3015-8850', '', '(71) 9981-8256', '01/01/1980', 'MASCULINO', 'SOLTEIRO(A)', 'SSP', 'BA', '01/01/2000', 'NECESSIDADE ESPECIAL', '', 'SIM', 'SIM', '', '01237', NULL, 'SIM', 'LEITOR', 'NAO', '', '', '1', '', '2011-01-05 15:48:11', NULL),
(85, 'JOSÉ DA SILVA ALVES', '1', '1', '1', '1', 'BA', 'SAULOLEA@YAHOO.COM.BR', '1', '1', 'NÃO', '1', '1', '1', '', '1', '1', 'MASCULINO', 'SOLTEIRO(A)', '1', 'BA', '1', '', '', 'SIM', 'SIM', '', '17', NULL, 'NÃO', '', 'NAO', '', '', '7', '', '2011-01-05 16:22:01', NULL),
(87, 'JOÃO', '2', '2', '2', '2', 'BA', '2', '2', '2', 'NÃO', '2', '2', '2', '', '2', '2', 'MASCULINO', 'SOLTEIRO(A)', '2', 'BA', '2', '2', '', 'SIM', 'SIM', '', '27', NULL, 'NÃO', '', 'NAO', '', '', '2', '', '2011-01-05 17:04:36', NULL),
(88, 'VITOR PACHECO COSTA', 'RUA IBICARAí, Nº 15', 'CENTRO', '42700-000', 'LAURO DE FREITAS', 'BA', 'VITOR-P.C@HOTMAIL.COM', '15016867541', '0998872903', 'NÃO', '099605', 'BRASILEIRO', '(71) 3287-3475', '', '(71) 8626-7909', '27/10/1898', 'MASCULINO', 'SOLTEIRO(A)', 'SSP', 'BA', '23/12/2222', '', '', 'NAO', 'SIM', '', '15017', NULL, 'NÃO', '', 'NAO', '', '', '5', '', '2011-01-06 14:39:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscrito_curso`
--

CREATE TABLE IF NOT EXISTS `inscrito_curso` (
  `id_inscrito` int(11) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_inscrito`,`cod_curso`),
  KEY `cod_curso` (`cod_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inscrito_curso`
--

INSERT INTO `inscrito_curso` (`id_inscrito`, `cod_curso`) VALUES
(82, 28),
(83, 3),
(84, 3),
(85, 34),
(87, 8),
(88, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `localprova`
--

CREATE TABLE IF NOT EXISTS `localprova` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `ativo` varchar(45) DEFAULT NULL,
  `campus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `localprova`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

