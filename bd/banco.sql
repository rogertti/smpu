--
-- Banco de dados: `embracore18`
--
CREATE DATABASE IF NOT EXISTS `embracore18` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `embracore18`;

--
-- Estrutura para tabela `analise`
--

CREATE TABLE IF NOT EXISTS `analise` (
  `idanalise` bigint(20) NOT NULL,
  `protocolo_idprotocolo` bigint(20) NOT NULL,
  `situacao` varchar(15) DEFAULT NULL COMMENT 'pré-análise, análise ou reanálise',
  `responsavel` varchar(255) DEFAULT NULL,
  `art_rrt` varchar(20) DEFAULT NULL,
  `arquitetonico` longtext,
  `hidrosanitario` longtext,
  `parecer` varchar(20) DEFAULT NULL COMMENT 'com pendências ou aprovado',
  `monitor` varchar(1) NOT NULL,
  `autentico` varchar(50) NOT NULL,
  `ultimo_usuario` varchar(255) NOT NULL,
  `datado` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2284 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `analise_has_documentacao`
--

CREATE TABLE IF NOT EXISTS `analise_has_documentacao` (
  `analise_idanalise` bigint(20) NOT NULL,
  `documentacao_iddocumentacao` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estrutura para tabela `cadastramento`
--

CREATE TABLE IF NOT EXISTS `cadastramento` (
  `idcadastramento` bigint(20) NOT NULL,
  `protocolo_idprotocolo` bigint(20) NOT NULL,
  `alvara` varchar(20) NOT NULL,
  `data_alvara` date NOT NULL,
  `habitese` varchar(20) NOT NULL,
  `data_habitese` date NOT NULL,
  `parecer` varchar(20) NOT NULL COMMENT 'com pendências ou aprovado',
  `monitor` varchar(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=686 DEFAULT CHARSET=latin1;

--
-- Estrutura para tabela `documentacao`
--

CREATE TABLE IF NOT EXISTS `documentacao` (
  `iddocumentacao` bigint(20) NOT NULL,
  `descricao` tinytext NOT NULL,
  `monitor` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estrutura para tabela `embargo`
--

CREATE TABLE IF NOT EXISTS `embargo` (
  `idembargo` bigint(20) NOT NULL,
  `fiscalizacao_idfiscalizacao` bigint(20) NOT NULL,
  `datado` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `fase` varchar(255) DEFAULT NULL,
  `valor` varchar(20) DEFAULT NULL,
  `situacao` varchar(15) NOT NULL COMMENT 'Embargada ou desembargada;',
  `monitor` varchar(1) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `engenheiro`
--

CREATE TABLE IF NOT EXISTS `engenheiro` (
  `idengenheiro` bigint(20) NOT NULL,
  `cau_crea` varchar(10) DEFAULT NULL COMMENT 'CAU = (letra)00000-0; CREA = 00000-0;',
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;'
) ENGINE=MyISAM AUTO_INCREMENT=313 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `fiscalizacao`
--

CREATE TABLE IF NOT EXISTS `fiscalizacao` (
  `idfiscalizacao` bigint(20) NOT NULL,
  `imovel_idimovel` bigint(20) NOT NULL,
  `funcionario_idfuncionario` bigint(20) NOT NULL,
  `notificacao` varchar(9) NOT NULL COMMENT '0000/ano',
  `datado` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `medida` text,
  `prazo` varchar(255) DEFAULT NULL,
  `responsavel` varchar(100) DEFAULT NULL,
  `situacao` text,
  `receptor` varchar(255) DEFAULT NULL,
  `album` varchar(50) NOT NULL,
  `monitor` varchar(1) NOT NULL,
  `autentico` varchar(50) NOT NULL,
  `ultimo_usuario` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=466 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `fiscalizacao_has_infracao`
--

CREATE TABLE IF NOT EXISTS `fiscalizacao_has_infracao` (
  `fiscalizacao_idfiscalizacao` bigint(20) NOT NULL,
  `infracao_idinfracao` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `idfuncionario` bigint(20) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(30) NOT NULL COMMENT 'encriptado por base64',
  `senha` varchar(30) NOT NULL COMMENT 'encriptado por base64',
  `email` varchar(100) NOT NULL,
  `tipo` char(3) NOT NULL COMMENT 'ADM para administrador;\nUSR para usuário;',
  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;'
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `habitese`
--

CREATE TABLE IF NOT EXISTS `habitese` (
  `idhabitese` bigint(20) NOT NULL,
  `protocolo_idprotocolo` bigint(20) NOT NULL,
  `datado` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `situacao` varchar(10) NOT NULL COMMENT 'Aprovado ou pendente',
  `observacao` text,
  `album` varchar(50) NOT NULL,
  `monitor` char(1) NOT NULL COMMENT 'O = aberto; X = fechado;',
  `autentico` varchar(50) NOT NULL,
  `ultimo_usuario` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=909 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `habitese_has_item_habitese`
--

CREATE TABLE IF NOT EXISTS `habitese_has_item_habitese` (
  `habitese_idhabitese` bigint(20) NOT NULL,
  `item_habitese_iditem_habitese` bigint(20) NOT NULL,
  `situacao` varchar(15) NOT NULL COMMENT 'sim, não ou não se aplica'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `historico_analise`
--

CREATE TABLE IF NOT EXISTS `historico_analise` (
  `idhistorico_analise` bigint(20) NOT NULL,
  `analise_idanalise` bigint(20) NOT NULL,
  `datado` date NOT NULL,
  `hora` time NOT NULL,
  `arquitetonico` longtext NOT NULL,
  `hidrosanitario` longtext NOT NULL,
  `monitor` char(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2934 DEFAULT CHARSET=latin1;

--
-- Estrutura para tabela `imovel`
--

CREATE TABLE IF NOT EXISTS `imovel` (
  `idimovel` bigint(20) NOT NULL,
  `contribuinte_idcontribuinte` bigint(20) NOT NULL,
  `inscricao` varchar(18) NOT NULL COMMENT '00.00.000.0000.000',
  `matricula` varchar(5) DEFAULT NULL COMMENT '00000',
  `cep` varchar(9) DEFAULT NULL COMMENT '00000-000',
  `endereco` mediumtext,
  `apto` varchar(20) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `edificio_condominio` varchar(45) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `tipo_obra` varchar(15) DEFAULT NULL COMMENT 'residencial,comercial ou galpão',
  `garagem` varchar(20) DEFAULT NULL,
  `lote` varchar(20) DEFAULT NULL,
  `quadra` varchar(20) DEFAULT NULL,
  `loteamento` varchar(20) DEFAULT NULL,
  `fracao` varchar(10) DEFAULT NULL,
  `area_lote` varchar(10) DEFAULT NULL,
  `area_unidade` varchar(10) DEFAULT NULL,
  `area_anexo` varchar(10) DEFAULT NULL,
  `area_englobada` varchar(10) DEFAULT NULL,
  `area_construida` varchar(10) DEFAULT NULL,
  `habitese` varchar(45) DEFAULT NULL COMMENT '0000/ano',
  `testada` varchar(10) DEFAULT NULL,
  `alvara` varchar(20) DEFAULT NULL,
  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;'
) ENGINE=MyISAM AUTO_INCREMENT=8807 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `infracao`
--

CREATE TABLE IF NOT EXISTS `infracao` (
  `idinfracao` bigint(20) NOT NULL,
  `nivel` varchar(45) NOT NULL,
  `descricao` tinytext NOT NULL,
  `valor` varchar(20) DEFAULT NULL,
  `monitor` varchar(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `item_habitese`
--

CREATE TABLE IF NOT EXISTS `item_habitese` (
  `iditem_habitese` bigint(20) NOT NULL,
  `descricao` tinytext NOT NULL,
  `monitor` char(1) NOT NULL COMMENT 'O = aberto; X = fechado;'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `licenca_app`
--

CREATE TABLE IF NOT EXISTS `licenca_app` (
  `idlicenca_app` bigint(20) NOT NULL,
  `monitor` char(1) NOT NULL COMMENT 'O ou X'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Estrutura para tabela `protocolo`
--

CREATE TABLE IF NOT EXISTS `protocolo` (
  `idprotocolo` bigint(20) NOT NULL,
  `requerimento_idrequerimento` bigint(20) DEFAULT NULL COMMENT 'Não pode ser campo obrigatório porque pode existir protocolos avulsos.',
  `codigo` varchar(10) NOT NULL COMMENT '0000/ano',
  `taxa` varchar(10) DEFAULT NULL,
  `situacao` varchar(255) NOT NULL,
  `observacao` text,
  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;',
  `autentico` varchar(50) NOT NULL,
  `ultimo_usuario` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17028 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `requerimento`
--

CREATE TABLE IF NOT EXISTS `requerimento` (
  `idrequerimento` bigint(20) NOT NULL,
  `imovel_idimovel` bigint(20) NOT NULL,
  `engenheiro_idengenheiro` bigint(20) DEFAULT NULL,
  `funcionario_idfuncionario` bigint(20) NOT NULL,
  `requerente` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(18) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL COMMENT '(00)0000-0000',
  `email` varchar(100) DEFAULT NULL,
  `recolhimento` varchar(100) NOT NULL,
  `alvara` varchar(20) DEFAULT NULL,
  `entrada` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `construcao` varchar(45) DEFAULT NULL COMMENT 'unifamiliar, multifamiliar, comercial ou misto',
  `area` varchar(20) DEFAULT NULL,
  `vencido` varchar(10) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `referencia` text,
  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;',
  `ultimo_usuario` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20119 DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `timbrado`
--

CREATE TABLE IF NOT EXISTS `timbrado` (
  `idtimbrado` bigint(20) NOT NULL,
  `tipo_timbrado_idtipo_timbrado` bigint(20) NOT NULL,
  `protocolo` varchar(9) NOT NULL,
  `texto` longtext NOT NULL,
  `autentico` varchar(50) NOT NULL,
  `ultimo_usuario` varchar(255) NOT NULL,
  `monitor` char(1) NOT NULL COMMENT 'O = ativo; X = inativo; '
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Estrutura para tabela `tipo_timbrado`
--

CREATE TABLE IF NOT EXISTS `tipo_timbrado` (
  `idtipo_timbrado` bigint(20) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `monitor` char(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;