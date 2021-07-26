<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';

    if(empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if(empty($_POST['servidor'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if(empty($_POST['banco'])) { echo $msgnull; exit; } else { $filtro++; }
    if(empty($_POST['usuario_mysql'])) { echo $msgnull; exit; } else { $filtro++; }
    if(empty($_POST['usuario_app'])) { echo $msgnull; exit; } else { $filtro++; }
    if(empty($_POST['senha_app'])) { echo $msgnull; exit; } else { $filtro++; }

    if($filtro == 5) {
        $conexao = mysqli_connect($_POST['servidor'],$_POST['usuario_mysql'],$_POST['senha_mysql']);

            if(!$conexao) {
                echo'Falha na conex&atilde;o.'; exit;
            }
            else {
                $charset = mysqli_character_set_name($conexao);

                //criando o banco
                $sql = "CREATE DATABASE IF NOT EXISTS ".$_POST['banco']." DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
                $res = mysqli_query($conexao,$sql);

                    if(!$res) {
                        echo'Conex&atilde;o ativa, mas hove falha ao criar o banco.'; exit;
                    }
                    else {
                        mysqli_select_db($conexao,$_POST['banco']);
                        mysqli_query($conexao,"SET NAMES utf8");
                        mysqli_query($conexao,"SET CHARACTER_SET utf8");

                        //criando as tabelas
                        $sql2 = "CREATE TABLE IF NOT EXISTS `analise` (
                                  `idanalise` bigint(20) NOT NULL AUTO_INCREMENT,
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
                                  `datado` date DEFAULT NULL,
                                  PRIMARY KEY (`idanalise`),
                                  KEY `fk_analise_protocolo1_idx` (`protocolo_idprotocolo`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err = 1; }    

                        $sql2 = "CREATE TABLE IF NOT EXISTS `contribuinte` (
                                  `idcontribuinte` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `nome` varchar(255) NOT NULL,
                                  `codigo` varchar(20) DEFAULT NULL,
                                  `cpf_cnpj` varchar(18) NOT NULL,
                                  PRIMARY KEY (`idcontribuinte`),
                                  KEY `idx_1` (`cpf_cnpj`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }    

                        $sql2 = "CREATE TABLE IF NOT EXISTS `embargo` (
                                  `idembargo` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `fiscalizacao_idfiscalizacao` bigint(20) NOT NULL,
                                  `datado` date NOT NULL,
                                  `hora` varchar(5) NOT NULL,
                                  `fase` varchar(255) DEFAULT NULL,
                                  `valor` varchar(20) DEFAULT NULL,
                                  `situacao` varchar(15) NOT NULL COMMENT 'Embargada ou desembargada;',
                                  `monitor` varchar(1) NOT NULL,
                                  `codigo` varchar(20) DEFAULT NULL,
                                  PRIMARY KEY (`idembargo`),
                                  KEY `fk_embargo_fiscalizacao1_idx` (`fiscalizacao_idfiscalizacao`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `engenheiro` (
                                  `idengenheiro` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `cau_crea` varchar(10) DEFAULT NULL COMMENT 'CAU = (letra)00000-0; CREA = 00000-0;',
                                  `nome` varchar(255) NOT NULL,
                                  `usuario` varchar(30) DEFAULT NULL,
                                  `senha` varchar(30) DEFAULT NULL,
                                  `email` varchar(100) DEFAULT NULL,
                                  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;',
                                  PRIMARY KEY (`idengenheiro`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `fiscalizacao` (
                                  `idfiscalizacao` bigint(20) NOT NULL AUTO_INCREMENT,
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
                                  `ultimo_usuario` varchar(255) NOT NULL,
                                  PRIMARY KEY (`idfiscalizacao`),
                                  KEY `fk_fiscalizacao_imovel1_idx` (`imovel_idimovel`),
                                  KEY `fk_fiscalizacao_funcionario1_idx` (`funcionario_idfuncionario`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `fiscalizacao_has_infracao` (
                                  `fiscalizacao_idfiscalizacao` bigint(20) NOT NULL,
                                  `infracao_idinfracao` bigint(20) NOT NULL,
                                  PRIMARY KEY (`fiscalizacao_idfiscalizacao`,`infracao_idinfracao`),
                                  KEY `fk_fiscalizacao_has_infracao_infracao1_idx` (`infracao_idinfracao`),
                                  KEY `fk_fiscalizacao_has_infracao_fiscalizacao1_idx` (`fiscalizacao_idfiscalizacao`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `funcionario` (
                                  `idfuncionario` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `matricula` varchar(10) NOT NULL,
                                  `nome` varchar(255) NOT NULL,
                                  `usuario` varchar(30) NOT NULL COMMENT 'encriptado por base64',
                                  `senha` varchar(30) NOT NULL COMMENT 'encriptado por base64',
                                  `email` varchar(100) NOT NULL,
                                  `tipo` char(3) NOT NULL COMMENT 'ADM para administrador;\nUSR para usuário;',
                                  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;',
                                  PRIMARY KEY (`idfuncionario`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }
                        
                        $sql2 = "INSERT INTO funcionario (matricula,nome,usuario,senha,email,tipo,monitor) VALUES ('00000','".$_POST['usuario_app']."','".$_POST['usuario_app']."','".$_POST['senha_app']."','".$_POST['email']."','ADM','O')";
                        $res2 = mysqli_query($conexao,$sql2);
                        #if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `habitese` (
                                  `idhabitese` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `protocolo_idprotocolo` bigint(20) NOT NULL,
                                  `datado` date NOT NULL,
                                  `hora` varchar(5) NOT NULL,
                                  `situacao` varchar(10) NOT NULL COMMENT 'Aprovado ou pendente',
                                  `observacao` text,
                                  `album` varchar(50) NOT NULL,
                                  `monitor` char(1) NOT NULL COMMENT 'O = aberto; X = fechado;',
                                  `autentico` varchar(50) NOT NULL,
                                  `ultimo_usuario` varchar(255) NOT NULL,
                                  PRIMARY KEY (`idhabitese`),
                                  KEY `fk_habitese_protocolo1_idx` (`protocolo_idprotocolo`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `habitese_has_item_habitese` (
                                  `habitese_idhabitese` bigint(20) NOT NULL,
                                  `item_habitese_iditem_habitese` bigint(20) NOT NULL,
                                  `situacao` varchar(15) NOT NULL COMMENT 'sim, não ou não se aplica',
                                  PRIMARY KEY (`habitese_idhabitese`,`item_habitese_iditem_habitese`),
                                  KEY `fk_item_habitese_has_habitese_habitese1_idx` (`habitese_idhabitese`),
                                  KEY `fk_item_habitese_has_habitese_item_habitese1_idx` (`item_habitese_iditem_habitese`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `imovel` (
                                  `idimovel` bigint(20) NOT NULL AUTO_INCREMENT,
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
                                  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;',
                                  PRIMARY KEY (`idimovel`),
                                  KEY `fk_imovel_contribuinte1_idx` (`contribuinte_idcontribuinte`),
                                  KEY `idx_1` (`monitor`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `infracao` (
                                  `idinfracao` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `nivel` varchar(45) NOT NULL,
                                  `descricao` tinytext NOT NULL,
                                  `valor` varchar(20) DEFAULT NULL,
                                  `monitor` varchar(1) NOT NULL,
                                  PRIMARY KEY (`idinfracao`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `item_habitese` (
                                  `iditem_habitese` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `descricao` tinytext NOT NULL,
                                  `monitor` char(1) NOT NULL COMMENT 'O = aberto; X = fechado;',
                                  PRIMARY KEY (`iditem_habitese`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `protocolo` (
                                  `idprotocolo` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `requerimento_idrequerimento` bigint(20) DEFAULT NULL COMMENT 'Não pode ser campo obrigatório porque pode existir protocolos avulsos.',
                                  `codigo` varchar(9) NOT NULL COMMENT '0000/ano',
                                  `taxa` varchar(10) DEFAULT NULL,
                                  `situacao` varchar(255) NOT NULL,
                                  `observacao` text,
                                  `monitor` varchar(1) NOT NULL COMMENT 'O = ativo; X = desativo;',
                                  `autentico` varchar(50) NOT NULL,
                                  `ultimo_usuario` varchar(255) NOT NULL,
                                  PRIMARY KEY (`idprotocolo`),
                                  KEY `fk_protocolo_requerimento2_idx` (`requerimento_idrequerimento`),
                                  KEY `idx_1` (`monitor`),
                                  KEY `idx_2` (`codigo`,`monitor`),
                                  KEY `idx_monitor` (`monitor`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                        $sql2 = "CREATE TABLE IF NOT EXISTS `requerimento` (
                                  `idrequerimento` bigint(20) NOT NULL AUTO_INCREMENT,
                                  `imovel_idimovel` bigint(20) NOT NULL,
                                  `engenheiro_idengenheiro` bigint(20) DEFAULT NULL,
                                  `funcionario_idfuncionario` bigint(20) NOT NULL,
                                  `recolhimento_idrecolhimento` bigint(20) NOT NULL,
                                  `requerente` varchar(255) DEFAULT NULL,
                                  `cpf_cnpj` varchar(18) DEFAULT NULL,
                                  `telefone` varchar(13) DEFAULT NULL COMMENT '(00)0000-0000',
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
                                  `ultimo_usuario` varchar(255) NOT NULL,
                                  PRIMARY KEY (`idrequerimento`),
                                  KEY `fk_servico_funcionario1_idx` (`funcionario_idfuncionario`),
                                  KEY `fk_servico_engenheiro1_idx` (`engenheiro_idengenheiro`),
                                  KEY `fk_servico_imovel1_idx` (`imovel_idimovel`),
                                  KEY `idx_1` (`monitor`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                        $res2 = mysqli_query($conexao,$sql2);
                        if(!$res2) { $err++; }

                            if($err == 14) {
                                echo'Conex&atilde;o ativa e banco criado, mas houve falha ao criar as tabelas do banco.'; exit;
                            }
                            else {
                                //criando o arquivo de conex&atilde;o
                                $arquivo = fopen('conexao.php','w+');
                                fwrite($arquivo,'<?php'.PHP_EOL);
                                fwrite($arquivo,chr(9).'define("DB_HOST","'.$_POST['servidor'].'");'.PHP_EOL);
                                fwrite($arquivo,chr(9).'define("DB_USER","'.$_POST['usuario_mysql'].'");'.PHP_EOL);
                                fwrite($arquivo,chr(9).'define("DB_PASS","'.$_POST['senha_mysql'].'");'.PHP_EOL);
                                fwrite($arquivo,chr(9).'define("DB_DATA","'.$_POST['banco'].'");'.PHP_EOL);
                                fwrite($arquivo,chr(9).''.PHP_EOL);
                                fwrite($arquivo,chr(9).'$conexao = mysqli_connect(DB_HOST,DB_USER,DB_PASS);'.PHP_EOL);
                                fwrite($arquivo,chr(9).'$charset = mysqli_character_set_name($conexao);'.PHP_EOL);
                                fwrite($arquivo,chr(9).'mysqli_select_db($conexao,DB_DATA);'.PHP_EOL);
                                fwrite($arquivo,chr(9).'mysqli_query($conexao,"SET NAMES utf8");'.PHP_EOL);
                                fwrite($arquivo,chr(9).'mysqli_query($conexao,"SET CHARACTER_SET utf8");'.PHP_EOL);
                                fwrite($arquivo,'?>');
                                fclose($arquivo);

                                rename('installAplicativo.php','installAplicativo-done.php');
                                echo'true';
                            }
                    } //else banco
            } //else conexao
    } //if filtro

    unset($msgnull,$filtro,$conexao,$charset,$sql,$res,$sql2,$res2,$err,$arquivo);
?>
