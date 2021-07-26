<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '5a'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $cfg['titulo']; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Autocomplete -->
        <link href="css/autocomplete.min.css" rel="stylesheet" type="text/css" />
        <!-- Datepicker -->
        <link href="css/datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Timepicker -->
        <link href="css/timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- javascript desabilitado -->
        <noscript><div class="script-less"><p><?php echo $cfg['noscript']; ?></p></div></noscript>
        
        <!-- header logo: style can be found in header.less -->
        <header class="header"><?php include_once('header.php'); ?></header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas"><?php include_once('leftside.php'); ?></aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Edita requerimento <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyrequerimento = md5('idrequerimento');
                                            
                        $sql = "SELECT * FROM requerimento WHERE idrequerimento = ".$_GET[''.$pyrequerimento.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                                
                                //invertendo a data 00/00/0000
                                $ano = substr($lin->entrada,0,4);
                                $mes = substr($lin->entrada,5,2);
                                $dia = substr($lin->entrada,8);
                                $lin->entrada = $dia."/".$mes."/".$ano;
                                unset($ano,$mes,$dia);
                                
                                //invertendo a data 00/00/0000
                                $ano = substr($lin->vencimento,0,4);
                                $mes = substr($lin->vencimento,5,2);
                                $dia = substr($lin->vencimento,8);
                                $lin->vencimento = $dia."/".$mes."/".$ano;
                                unset($ano,$mes,$dia);
                    ?>
                    <form class="edita-requerimento">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idrequerimento" value="<?php echo $lin->idrequerimento; ?>">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        
                                        <div class="form-group">
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    $sql2 = "SELECT imovel.idimovel,imovel.inscricao FROM imovel,requerimento WHERE requerimento.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$lin->imovel_idimovel."";
                                                    $res2 = mysql_query($sql2);
                                                    $ret2 = mysql_num_rows($res2);

                                                        if($ret2 != 0) {
                                                            $lin2 = mysql_fetch_object($res2);
                                                            echo'<input type="hidden" id="idimovel" value="'.$lin2->idimovel.'" />
                                                            <input type="text" id="imovel" class="form-control" maxlength="18" value="'.$lin2->inscricao.'" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" disabled />';
                                                        }
                                                        else {
                                                            $disabled = 'true';
                                                            echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                        }

                                                    unset($sql2,$res2,$ret2,$lin2);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nome do requerente</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="requerente" class="form-control" maxlength="255" value="<?php echo $lin->requerente; ?>" title="Nome do requerente" placeholder="Nome do requerente" />
                                            </div>
                                        </div>
                                        <?php
                                            if(strlen($lin->cpf_cnpj) <= 14) {
                                        ?>
                                        <div class="form-group">
                                            <label>Documento do requerente</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="cpf" class="form-control" maxlength="14" value="<?php echo $lin->cpf_cnpj; ?>" placeholder="CPF" />
                                                <input type="text" id="cnpj" class="form-control hided" maxlength="18" placeholder="CNPJ" />
                                                <span class="info-here-4 mode msgcpf">
                                                    <a class="tt chginc" title="Mudar para CNPJ" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgper hided" title="Mudar para CPF" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        
                                            if(strlen($lin->cpf_cnpj) > 14) {
                                        ?>
                                        <div class="form-group">
                                            <label>Documento do requerente</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="cnpj" class="form-control" maxlength="18" value="<?php echo $lin->cpf_cnpj; ?>" placeholder="CNPJ" />
                                                <input type="text" id="cpf" class="form-control hided" maxlength="14" placeholder="CPF" />
                                                <span class="info-here-4 mode msgcnpj">
                                                    <a class="tt chgper" title="Mudar para CPF" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chginc hided" title="Mudar para CNPJ" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                
                                            if(strlen($lin->telefone) <= 13) {
                                        ?>
                                        <div class="form-group">
                                            <label>Contato do requerente</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="telefone" class="form-control" maxlength="13" value="<?php echo $lin->telefone; ?>" title="Telefone do requerente" placeholder="Telefone" />
                                                <input type="text" id="celular" class="form-control hided" maxlength="14" title="Celular do requerente" placeholder="Celular" />
                                                <span class="info-here-4 mode msgtel">
                                                    <a class="tt chgcel" title="Mudar para celular" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgtel hided" title="Mudar para telefone" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                
                                            if(strlen($lin->telefone) > 13) {
                                        ?>
                                        <div class="form-group">
                                            <label>Contato do requerente</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="celular" class="form-control" maxlength="14" value="<?php echo $lin->telefone; ?>" title="Celular do requerente" placeholder="Celular" />
                                                <input type="text" id="telefone" class="form-control hided" maxlength="13" title="Telefone do requerente" placeholder="Telefone" />
                                                <span class="info-here-4 mode msgcel">
                                                    <a class="tt chgtel" title="Mudar para telefone" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgcel hided" title="Mudar para celular" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label>E-mail do requerente</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="email" id="email" class="form-control" maxlength="100" value="<?php echo $lin->email; ?>" title="E-mail do requerente" placeholder="E-mail" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Arquiteto/Engenheiro</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <?php
                                                    $sql3 = "SELECT engenheiro.idengenheiro,engenheiro.nome FROM engenheiro,requerimento WHERE requerimento.engenheiro_idengenheiro = engenheiro.idengenheiro AND engenheiro.idengenheiro = ".$lin->engenheiro_idengenheiro."";
                                                    $res3 = mysql_query($sql3);
                                                    $ret3 = mysql_num_rows($res3);

                                                        if($ret3 != 0) {
                                                            $lin3 = mysql_fetch_row($res3);
                                                            echo'<input type="hidden" id="idengenheiro" value="'.$lin3->idengenheiro.'" />
                                                            <input type="text" id="engenheiro" class="form-control" maxlength="255" value="'.$lin3->nome.'" title="Arquiteto ou Engenheiro" placeholder="Arquiteto/Engenheiro" />';
                                                        }
                                                        else {
                                                            /*$disabled = 'true';
                                                            echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';*/
                                                            echo'<input type="hidden" id="idengenheiro" />
                                                            <input type="text" id="engenheiro" class="form-control" maxlength="255" title="Arquiteto ou Engenheiro" placeholder="Arquiteto/Engenheiro" />';
                                                        }

                                                    unset($sql3,$res3,$ret3,$lin3);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Funcion&aacute;rio</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    $sql4 = "SELECT funcionario.idfuncionario,funcionario.nome FROM funcionario,requerimento WHERE requerimento.funcionario_idfuncionario = funcionario.idfuncionario AND funcionario.idfuncionario = ".$lin->funcionario_idfuncionario."";
                                                    $res4 = mysql_query($sql4);
                                                    $ret4 = mysql_num_rows($res4);

                                                        if($ret4 != 0) {
                                                            $lin4 = mysql_fetch_row($res4);
                                                            echo'<input type="hidden" id="idfuncionario" value="'.$lin4->funcionario_idfuncionario.'" />
                                                            <input type="text" id="funcionario" class="form-control" value="'.$lin4->nome.'" title="Funcion&aacute;rio" placeholder="Funcion&aacute;rio" disabled />';
                                                        }
                                                        else {
                                                            $disabled = 'true';
                                                            echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                        }

                                                    unset($sql4,$res4,$ret4,$lin4);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de recolhimento</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select class="form-control" id="recolhimento" title="Tipo de recolhimento" required>
                                                <?php
                                                    if($lin->recolhimento == '2ª via de documento') { echo'<option value="2&#170; via de documento" selected>2&#170; via de documento</option>'; } else { echo'<option value="2&#170; via de documento">2&#170; via de documento</option>'; }
                                                    if($lin->recolhimento == '2ª via de habite-se e certificado de averbação') { echo'<option value="2&#170; via de habite-se e certificado de averba&ccedil;&atilde;o" selected>2&#170; via de habite-se e certificado de averba&ccedil;&atilde;o</option>'; } else { echo'<option value="2&#170; via de habite-se e certificado de averba&ccedil;&atilde;o">2&#170; via de habite-se e certificado de averba&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Alinhamento de calçada') { echo'<option value="Alinhamento de cal&ccedil;ada" selected>Alinhamento de cal&ccedil;ada</option>'; } else { echo'<option value="Alinhamento de cal&ccedil;ada">Alinhamento de cal&ccedil;ada</option>'; }
                                                    if($lin->recolhimento == 'Alinhamento de calçada e poste') { echo'<option value="Alinhamento de cal&ccedil;ada e poste" selected>Alinhamento de cal&ccedil;ada e poste</option>'; } else { echo'<option value="Alinhamento de cal&ccedil;ada e poste">Alinhamento de cal&ccedil;ada e poste</option>'; }
                                                    if($lin->recolhimento == 'Alinhamento de muro frontal') { echo'<option value="Alinhamento de muro frontal" selected>Alinhamento de muro frontal</option>'; } else { echo'<option value="Alinhamento de muro frontal">Alinhamento de muro frontal</option>'; }
                                                    if($lin->recolhimento == 'Alinhamento de poste') { echo'<option value="Alinhamento de poste" selected>Alinhamento de poste</option>'; } else { echo'<option value="Alinhamento de poste">Alinhamento de poste</option>'; }
                                                    if($lin->recolhimento == 'Aprovação de projeto') { echo'<option value="Aprova&ccedil;&atilde;o de projeto" selected>Aprova&ccedil;&atilde;o de projeto</option>'; } else { echo'<option value="Aprova&ccedil;&atilde;o de projeto">Aprova&ccedil;&atilde;o de projeto</option>'; }
                                                    if($lin->recolhimento == 'Aprovação de projeto, alinhamento de muro e numeração') { echo'<option value="Aprova&ccedil;&atilde;o de projeto, alinhamento de muro e numera&ccedil;&atilde;o" selected>Aprova&ccedil;&atilde;o de projeto, alinhamento de muro e numera&ccedil;&atilde;o</option>'; } else { echo'<option value="Aprova&ccedil;&atilde;o de projeto, alinhamento de muro e numera&ccedil;&atilde;o">Aprova&ccedil;&atilde;o de projeto, alinhamento de muro e numera&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Aprovação de projeto com acréscimo') { echo'<option value="Aprova&ccedil;&atilde;o de projeto com acr&eacute;scimo" selected>Aprova&ccedil;&atilde;o de projeto com acr&eacute;scimo</option>'; } else { echo'<option value="Aprova&ccedil;&atilde;o de projeto com acr&eacute;scimo">Aprova&ccedil;&atilde;o de projeto com acr&eacute;scimo</option>'; }
                                                    if($lin->recolhimento == 'Autorização de bate estaca') { echo'<option value="Autoriza&ccedil;&atilde;o de bate estaca" selected>Autoriza&ccedil;&atilde;o de bate estaca</option>'; } else { echo'<option value="Autoriza&ccedil;&atilde;o de bate estaca">Autoriza&ccedil;&atilde;o de bate estaca</option>'; }
                                                    if($lin->recolhimento == 'Autorização para demolição') { echo'<option value="Autoriza&ccedil;&atilde;o para demoli&ccedil;&atilde;o" selected>Autoriza&ccedil;&atilde;o para demoli&ccedil;&atilde;o</option>'; } else { echo'<option value="Autoriza&ccedil;&atilde;o para demoli&ccedil;&atilde;o">Autoriza&ccedil;&atilde;o para demoli&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Cancelamento de desmembramento') { echo'<option value="Cancelamento de desmembramento" selected>Cancelamento de desmembramento</option>'; } else { echo'<option value="Cancelamento de desmembramento">Cancelamento de desmembramento</option>'; }
                                                    if($lin->recolhimento == 'Cancelamento de projeto') { echo'<option value="Cancelamento de projeto" selected>Cancelamento de projeto</option>'; } else { echo'<option value="Cancelamento de projeto">Cancelamento de projeto</option>'; }
                                                    if($lin->recolhimento == 'Certidão de decadência') { echo'<option value="Certid&atilde;o de decad&ecirc;ncia" selected>Certid&atilde;o de decad&ecirc;ncia</option>'; } else { echo'<option value="Certid&atilde;o de decad&ecirc;ncia">Certid&atilde;o de decad&ecirc;ncia</option>'; }
                                                    if($lin->recolhimento == 'Certidão de demolição') { echo'<option value="Certid&atilde;o de demoli&ccedil;&atilde;o" selected>Certid&atilde;o de demoli&ccedil;&atilde;o</option>'; } else { echo'<option value="Certid&atilde;o de demoli&ccedil;&atilde;o">Certid&atilde;o de demoli&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Certidão de obra antiga') { echo'<option value="Certid&atilde;o de obra antiga" selected>Certid&atilde;o de obra antiga</option>'; } else { echo'<option value="Certid&atilde;o de obra antiga">Certid&atilde;o de obra antiga</option>'; }
                                                    if($lin->recolhimento == 'Confrontantes') { echo'<option value="Confrontantes" selected>Confrontantes</option>'; } else { echo'<option value="Confrontantes">Confrontantes</option>'; }
                                                    if($lin->recolhimento == 'Consulta de viabilidade') { echo'<option value="Consulta de viabilidade" selected>Consulta de viabilidade</option>'; } else { echo'<option value="Consulta de viabilidade">Consulta de viabilidade</option>'; }
                                                    if($lin->recolhimento == 'Consulta de viabilidade (MEI)') { echo'<option value="Consulta de viabilidade (MEI)" selected>Consulta de viabilidade (MEI)</option>'; } else { echo'<option value="Consulta de viabilidade (MEI)">Consulta de viabilidade (MEI)</option>'; }
                                                    if($lin->recolhimento == 'Declaração') { echo'<option value="Declara&ccedil;&atilde;o" selected>Declara&ccedil;&atilde;o</option>'; } else { echo'<option value="Declara&ccedil;&atilde;o">Declara&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Desmembramento') { echo'<option value="Desmembramento" selected>Desmembramento</option>'; } else { echo'<option value="Desmembramento">Desmembramento</option>'; }
                                                    if($lin->recolhimento == 'Desmembramento de área - Condomínio horizontal') { echo'<option value="Desmembramento de &aacute;rea - Condom&iacute;nio horizontal" selected>Desmembramento de &aacute;rea - Condom&iacute;nio horizontal</option>'; } else { echo'<option value="Desmembramento de &aacute;rea - Condom&iacute;nio horizontal">Desmembramento de &aacute;rea - Condom&iacute;nio horizontal</option>'; }
                                                    if($lin->recolhimento == 'Desmembramento e unificação') { echo'<option value="Desmembramento e unifica&ccedil;&atilde;o" selected>Desmembramento e unifica&ccedil;&atilde;o</option>'; } else { echo'<option value="Desmembramento e unifica&ccedil;&atilde;o">Desmembramento e unifica&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Diversos') { echo'<option value="Diversos" selected>Diversos</option>'; } else { echo'<option value="Diversos">Diversos</option>'; }
                                                    if($lin->recolhimento == 'Habite-se') { echo'<option value="Habite-se" selected>Habite-se</option>'; } else { echo'<option value="Habite-se">Habite-se</option>'; }
                                                    if($lin->recolhimento == 'Habite-se e certidão de averbação') { echo'<option value="Habite-se e certid&atilde;o de averba&ccedil;&atilde;o" selected>Habite-se e certid&atilde;o de averba&ccedil;&atilde;o</option>'; } else { echo'<option value="Habite-se e certid&atilde;o de averba&ccedil;&atilde;o">Habite-se e certid&atilde;o de averba&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Habite-se e renovação de alvará') { echo'<option value="Habite-se e renova&ccedil;&atilde;o de alvar&aacute;" selected>Habite-se e renova&ccedil;&atilde;o de alvar&aacute;</option>'; } else { echo'<option value="Habite-se e renova&ccedil;&atilde;o de alvar&aacute;">Habite-se e renova&ccedil;&atilde;o de alvar&aacute;</option>'; }
                                                    if($lin->recolhimento == 'Habite-se, certidão de averbação e renovação de alvará') { echo'<option value="Habite-se, certid&atilde;o de averba&ccedil;&atilde;o e renova&ccedil;&atilde;o de alvar&aacute;" selected>Habite-se, certid&atilde;o de averba&ccedil;&atilde;o e renova&ccedil;&atilde;o de alvar&aacute;</option>'; } else { echo'<option value="Habite-se, certid&atilde;o de averba&ccedil;&atilde;o e renova&ccedil;&atilde;o de alvar&aacute;">Habite-se, certid&atilde;o de averba&ccedil;&atilde;o e renova&ccedil;&atilde;o de alvar&aacute;</option>'; }
                                                    if($lin->recolhimento == 'Numeração') { echo'<option value="Numera&ccedil;&atilde;o" selected>Numera&ccedil;&atilde;o</option>'; } else { echo'<option value="Numera&ccedil;&atilde;o">Numera&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Obra existente') { echo'<option value="Obra existente" selected>Obra existente</option>'; } else { echo'<option value="Obra existente">Obra existente</option>'; }
                                                    if($lin->recolhimento == 'Planta situação') { echo'<option value="Planta situa&ccedil;&atilde;o" selected>Planta situa&ccedil;&atilde;o</option>'; } else { echo'<option value="Planta situa&ccedil;&atilde;o">Planta situa&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Plantas para carimbar') { echo'<option value="Plantas para carimbar" selected>Plantas para carimbar</option>'; } else { echo'<option value="Plantas para carimbar">Plantas para carimbar</option>'; }
                                                    if($lin->recolhimento == 'Pré-análise') { echo'<option value="Pr&eacute;-an&aacute;lise" selected>Pr&eacute;-an&aacute;lise</option>'; } else { echo'<option value="Pr&eacute;-an&aacute;lise">Pr&eacute;-an&aacute;lise</option>'; }
                                                    if($lin->recolhimento == 'Regularização') { echo'<option value="Regulariza&ccedil;&atilde;o com acr&eacute;scimo de &aacute;rea" selected>Regulariza&ccedil;&atilde;o com acr&eacute;scimo de &aacute;rea</option>'; } else { echo'<option value="Regulariza&ccedil;&atilde;o com acr&eacute;scimo de &aacute;rea">Regulariza&ccedil;&atilde;o com acr&eacute;scimo de &aacute;rea</option>'; }
                                                    if($lin->recolhimento == 'Regularização de obra') { echo'<option value="Regulariza&ccedil;&atilde;o de obra" selected>Regulariza&ccedil;&atilde;o de obra</option>'; } else { echo'<option value="Regulariza&ccedil;&atilde;o de obra">Regulariza&ccedil;&atilde;o de obra</option>'; }
                                                    if($lin->recolhimento == 'Renovação de alvará') { echo'<option value="Renova&ccedil;&atilde;o de alvar&aacute;" selected>Renova&ccedil;&atilde;o de alvar&aacute;</option>'; } else { echo'<option value="Renova&ccedil;&atilde;o de alvar&aacute;">Renova&ccedil;&atilde;o de alvar&aacute;</option>'; }
                                                    if($lin->recolhimento == 'Renovação de desmembramento') { echo'<option value="Renova&ccedil;&atilde;o de desmembramento" selected>Renova&ccedil;&atilde;o de desmembramento</option>'; } else { echo'<option value="Renova&ccedil;&atilde;o de desmembramento">Renova&ccedil;&atilde;o de desmembramento</option>'; }
                                                    if($lin->recolhimento == 'Renovação de unificação') { echo'<option value="Renova&ccedil;&atilde;o de unifica&ccedil;&atilde;o" selected>Renova&ccedil;&atilde;o de unifica&ccedil;&atilde;o</option>'; } else { echo'<option value="Renova&ccedil;&atilde;o de unifica&ccedil;&atilde;o">Renova&ccedil;&atilde;o de unifica&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Retificação de área') { echo'<option value="Retifica&ccedil;&atilde;o de &aacute;rea" selected>Retifica&ccedil;&atilde;o de &aacute;rea</option>'; } else { echo'<option value="Retifica&ccedil;&atilde;o de &aacute;rea">Retifica&ccedil;&atilde;o de &aacute;rea</option>'; }
                                                    if($lin->recolhimento == 'Solo criado') { echo'<option value="Solo criado" selected>Solo criado</option>'; } else { echo'<option value="Solo criado">Solo criado</option>'; }
                                                    if($lin->recolhimento == 'Substituição de desmembramento') { echo'<option value="Substitui&ccedil;&atilde;o de desmembramento" selected>Substitui&ccedil;&atilde;o de desmembramento</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o de desmembramento">Substitui&ccedil;&atilde;o de desmembramento</option>'; }
                                                    if($lin->recolhimento == 'Substituição de habite-se e certificado de averbação') { echo'<option value="Substitui&ccedil;&atilde;o de habite-se e certificado de averba&ccedil;&atilde;o" selected>Substitui&ccedil;&atilde;o de habite-se e certificado de averba&ccedil;&atilde;o</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o de habite-se e certificado de averba&ccedil;&atilde;o">Substitui&ccedil;&atilde;o de habite-se e certificado de averba&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Substituição de plantas') { echo'<option value="Substitui&ccedil;&atilde;o de plantas" selected>Substitui&ccedil;&atilde;o de plantas</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o de plantas">Substitui&ccedil;&atilde;o de plantas</option>'; }
                                                    if($lin->recolhimento == 'Substituição de projeto') { echo'<option value="Substitui&ccedil;&atilde;o de projeto" selected>Substitui&ccedil;&atilde;o de projeto</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o de projeto">Substitui&ccedil;&atilde;o de projeto</option>'; }
                                                    if($lin->recolhimento == 'Substituição de projeto com acréscimo') { echo'<option value="Substitui&ccedil;&atilde;o projeto com acr&eacute;scimo" selected>Substitui&ccedil;&atilde;o projeto com acr&eacute;scimo</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o projeto com acr&eacute;scimo">Substitui&ccedil;&atilde;o projeto com acr&eacute;scimo</option>'; }
                                                    if($lin->recolhimento == 'Substituição de titularidade') { echo'<option value="Substitui&ccedil;&atilde;o de titularidade" selected>Substitui&ccedil;&atilde;o de titularidade</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o de titularidade">Substitui&ccedil;&atilde;o de titularidade</option>'; }
                                                    if($lin->recolhimento == 'Substituição de unificação') { echo'<option value="Substitui&ccedil;&atilde;o de unifica&ccedil;&atilde;o" selected>Substitui&ccedil;&atilde;o de unifica&ccedil;&atilde;o</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o de unifica&ccedil;&atilde;o">Substitui&ccedil;&atilde;o de unifica&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Unificação') { echo'<option value="Unifica&ccedil;&atilde;o" selected>Unifica&ccedil;&atilde;o</option>'; } else { echo'<option value="Unifica&ccedil;&atilde;o">Unifica&ccedil;&atilde;o</option>'; }
                                                    if($lin->recolhimento == 'Uso do solo') { echo'<option value="Uso do solo" selected>Uso do solo</option>'; } else { echo'<option value="Uso do solo">Uso do solo</option>'; }
                                                    if($lin->recolhimento == "Vistoria da caixa d'água") { echo'<option value="Vistoria da caixa d&#39;&aacute;gua" selected>Vistoria da caixa d&#39;&aacute;gua</option>'; } else { echo'<option value="Vistoria da caixa d&#39;&aacute;gua">Vistoria da caixa d&#39;&aacute;gua</option>'; }
                                                    if($lin->recolhimento == "Vistoria da caixa d'água, do filtro e da fossa") { echo'<option value="Vistoria da caixa d&#39;&aacute;gua, do filtro e da fossa" selected>Vistoria da caixa d&#39;&aacute;gua, do filtro e da fossa</option>'; } else { echo'<option value="Vistoria da caixa d&#39;&aacute;gua, do filtro e da fossa">Vistoria da caixa d&#39;&aacute;gua, do filtro e da fossa</option>'; }
                                                    if($lin->recolhimento == 'Vistoria do filtro e da fossa') { echo'<option value="Vistoria do filtro e da fossa" selected>Vistoria do filtro e da fossa</option>'; } else { echo'<option value="Vistoria do filtro e da fossa">Vistoria do filtro e da fossa</option>'; }
                                                    if($lin->recolhimento == 'Vistoria da fossa') { echo'<option value="Vistoria da fossa" selected>Vistoria da fossa</option>'; } else { echo'<option value="Vistoria da fossa">Vistoria da fossa</option>'; }
                                                    if($lin->recolhimento == 'Vistoria da infra-estrutura') { echo'<option value="Vistoria da infra-estrutura" selected>Vistoria da infra-estrutura</option>'; } else { echo'<option value="Vistoria da infra-estrutura">Vistoria da infra-estrutura</option>'; }
                                                    if($lin->recolhimento == 'Vistoria sanitária') { echo'<option value="Vistoria sanit&aacute;ria" selected>Vistoria sanit&aacute;ria</option>'; } else { echo'<option value="Vistoria sanit&aacute;ria">Vistoria sanit&aacute;ria</option>'; }
                                                    if($lin->recolhimento == 'Zona urbana/rural') { echo'<option value="Zona urbana/rural" selected>Zona urbana/rural</option>'; } else { echo'<option value="Zona urbana/rural">Zona urbana/rural</option>'; }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alvar&aacute;</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="alvara" class="form-control" maxlength="20" value="<?php echo $lin->alvara; ?>" title="Alvar&aacute;" placeholder="Alvar&aacute;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Data</label>   
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="entrada" class="form-control" maxlength="10" value="<?php echo $lin->entrada; ?>" title="Data de entrada" placeholder="Entrada" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hora</label>
                                            <div class="input-group col-md-4 col-lg-3 bootstrap-timepicker">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="hora" class="form-control" maxlength="5" value="<?php echo $lin->hora; ?>" title="Hora de entrada" placeholder="Hora" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de constru&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <select class="form-control" id="construcao" title="Tipo de constru&ccedil;&atilde;o">
                                                <?php
                                                    if($lin->construcao == 'Comercial') { echo'<option value="Comercial" selected>Comercial</option>'; } else { echo'<option value="Comercial">Comercial</option>'; }
                                                    if($lin->construcao == 'Condomínio de Lotes') { echo'<option value="Condom&iacute;nio de Lotes" selected>Condom&iacute;nio de Lotes</option>'; } else { echo'<option value="Condom&iacute;nio de Lotes">Condom&iacute;nio de Lotes</option>'; }
                                                    if($lin->construcao == 'Desmembramento de Área') { echo'<option value="Desmembramento de &Aacute;rea" selected>Desmembramento de &Aacute;rea</option>'; } else { echo'<option value="Desmembramento de &Aacute;rea">Desmembramento de &Aacute;rea</option>'; }
                                                    if($lin->construcao == 'Industrial') { echo'<option value="Industrial" selected>Industrial</option>'; } else { echo'<option value="Industrial">Industrial</option>'; }                
                                                    if($lin->construcao == 'Loteamento') { echo'<option value="Loteamento" selected>Loteamento</option>'; } else { echo'<option value="Loteamento">Loteamento</option>'; }
                                                    if($lin->construcao == 'Misto') { echo'<option value="Misto" selected>Misto (Residencial e Comercial)</option>'; } else { echo'<option value="Misto">Misto (Residencial e Comercial)</option>'; }
                                                    if($lin->construcao == 'Residencial Casa Geminada') { echo'<option value="Residencial Casa Geminada" selected>Residencial Casa Geminada</option>'; } else { echo'<option value="Residencial Casa Geminada">Residencial Casa Geminada</option>'; }
                                                    if($lin->construcao == 'Residencial Multifamiliar') { echo'<option value="Residencial Multifamiliar" selected>Residencial Multifamiliar</option>'; } else { echo'<option value="Residencial Multifamiliar">Residencial Multifamiliar</option>'; }
                                                    if($lin->construcao == 'Residencial Unifamiliar') { echo'<option value="Residencial Unifamiliar" selected>Residencial Unifamiliar</option>'; } else { echo'<option value="Residencial Unifamiliar">Residencial Unifamiliar</option>'; }
                                                    if($lin->construcao == 'Sem construção') { echo'<option value="Sem constru&ccedil;&atilde;o" selected>Sem constru&ccedil;&atilde;o</option>'; } else { echo'<option value="Sem constru&ccedil;&atilde;o">Sem constru&ccedil;&atilde;o</option>'; }
                                                    if($lin->construcao == 'Unificação de Área') { echo'<option value="Unifica&ccedil;&atilde;o de &Aacute;rea" selected>Unifica&ccedil;&atilde;o de &Aacute;rea</option>'; } else { echo'<option value="Unifica&ccedil;&atilde;o de &Aacute;rea">Unifica&ccedil;&atilde;o de &Aacute;rea</option>'; }
                                                ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area" class="form-control" maxlength="20" value="<?php echo $lin->area; ?>" title="&Aacute;rea" placeholder="&Aacute;rea" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Ano vencido</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="vencido" class="form-control" maxlength="10" value="<?php echo $lin->vencido; ?>" title="Ano vencido" placeholder="Ano vencido" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Vencimento</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="vencimento" class="form-control" maxlength="10" value="<?php echo $lin->vencimento; ?>" title="Vencimento" placeholder="Vencimento" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Informa&ccedil;&otilde;es complementares</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="referencia" rows="6" title="Informa&ccedil;&otilde;es complementares" placeholder="Informa&ccedil;&otilde;es complementares"><?php echo $lin->referencia; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>   
                        </div>
                    
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-submit">Salvar</button>
                                    <button type="reset" class="btn btn-default">Limpar</button>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="alert alert-danger alert-dismissable danger">
                                    <i class="fa fa-ban"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                                <div class="alert alert-success alert-dismissable success">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                            } //$ret
                                            
                        mysql_close($conexao);
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyrequerimento);
                    ?>  
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Autocomplete -->
        <script src="js/autocomplete.min.js" type="text/javascript"></script>
        <!-- Masked -->
        <script src="js/masked.min.js" type="text/javascript"></script>
        <!-- Datepicker -->
        <script src="js/datepicker.min.js" type="text/javascript"></script>
        <!-- Timepicker -->
        <script src="js/timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".hided").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* MUDA CPF/CNPJ */
                
                $(".chginc").click(function(){
                    $("#cpf").hide();
                    $(".chginc").hide();
                    $("#cpf").val("");
                    $("#cnpj").show();
                    //$("#cnpj").show().attr("required","");
                    //$("#cpf").removeAttr("required","");
                    $(".chgper").show();
                    $(".mode").removeClass("msgcpf").addClass("msgcnpj");
                });
                
                $(".chgper").click(function(){
                    $("#cnpj").hide();
                    $(".chgper").hide();
                    $("#cnpj").val("");
                    $("#cpf").show()
                    //$("#cpf").show().attr("required","");
                    //$("#cnpj").removeAttr("required","");
                    $(".chginc").show();
                    $(".mode").removeClass("msgcnpj").addClass("msgcpf");
                });
                
                /* MUDA TELEFONE/CELULAR */
                
                $(".chgcel").click(function(){
                    $("#telefone").hide();
                    $(".chgcel").hide();
                    $("#telefone").val("");
                    $("#celular").show();
                    $(".chgtel").show();
                    $(".mode").removeClass("msgtel").addClass("msgcel");
                });
                
                $(".chgtel").click(function(){
                    $("#celular").hide();
                    $(".chgtel").hide();
                    $("#celular").val("");
                    $("#telefone").show();
                    $(".chgcel").show();
                    $(".mode").removeClass("msgcel").addClass("msgtel");
                });
            });
        </script>
        <?php
            if(!empty($disabled)) { echo'<script>$("input,select,textarea").prop("disabled",true);</script>'; unset($disabled); }
        ?>
    </body>
</html>