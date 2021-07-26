<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
?>
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
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <style rel="stylesheet" type="text/css" media="print">
            body { font-size: 12px; }    
        </style>
        
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
        
        <!-- header logo: style can be found in header.less 
        <header class="header"><?php #include_once('header.php'); ?></header>-->
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar 
            <aside class="left-side sidebar-offcanvas"><?php #include_once('leftside.php'); ?></aside>-->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">                
                <!-- Content Header (Page header) 
                <section class="content-header">
                    <h1>In&iacute;cio</h1>
                </section>-->

                <!-- Main content -->
                <section class="content invoice">
                <?php
                    include_once('conexao.php');

                    $pyrequerimento = md5('idrequerimento'); 
                    $sql = "SELECT * FROM requerimento WHERE idrequerimento = '".$_GET[''.$pyrequerimento.'']."'";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);

                            //busca a inscricao
                            $sql2 = "SELECT imovel.inscricao,imovel.cep,imovel.endereco,imovel.bairro,imovel.cidade,imovel.estado,imovel.lote,imovel.quadra,imovel.loteamento,imovel.matricula FROM imovel,requerimento WHERE requerimento.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$lin->imovel_idimovel."";
                            $res2 = mysql_query($sql2);
                            $ret2 = mysql_num_rows($res2);

                                if($ret2 != 0) {
                                    $lin2 = mysql_fetch_object($res2);
                                } 
                                else {
                                    $zero = 1;
                                }

                            //busca o engenheiro
                            $sql3 = "SELECT engenheiro.nome FROM engenheiro,requerimento WHERE requerimento.engenheiro_idengenheiro = engenheiro.idengenheiro AND engenheiro.idengenheiro = ".$lin->engenheiro_idengenheiro."";
                            $res3 = mysql_query($sql3);
                            $ret3 = mysql_num_rows($res3);

                                if($ret3 != 0) {
                                    $lin3 = mysql_fetch_object($res3);
                                } 
                                else {
                                    $zero = 1;
                                }

                            //busca o funcionario
                            $sql4 = "SELECT funcionario.nome FROM funcionario,requerimento WHERE requerimento.funcionario_idfuncionario = funcionario.idfuncionario AND funcionario.idfuncionario = ".$lin->funcionario_idfuncionario."";
                            $res4 = mysql_query($sql4);
                            $ret4 = mysql_num_rows($res4);

                                if($ret4 != 0) {
                                    $lin4 = mysql_fetch_object($res4);
                                } 
                                else {
                                    $zero = 1;
                                }
                            
                            //busca o contribuinte
                            $sql5 = "SELECT contribuinte.nome,contribuinte.cpf_cnpj FROM contribuinte,imovel,requerimento WHERE requerimento.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$lin->imovel_idimovel."";
                            $res5 = mysql_query($sql5);
                            $ret5 = mysql_num_rows($res5);

                                if($ret5 != 0) {
                                    $lin5 = mysql_fetch_object($res5);
                                } 
                                else {
                                    $zero = 1;
                                }
                            
                            //invertendo data 00/00/0000   
                            $ano = substr($lin->entrada,0,4);
                            $mes = substr($lin->entrada,5,2);
                            $dia = substr($lin->entrada,8);
                            $lin->entrada = $dia."/".$mes."/".$ano;

                            //invertendo data 00/00/0000   
                            $ano = substr($lin->vencimento,0,4);
                            $mes = substr($lin->vencimento,5,2);
                            $dia = substr($lin->vencimento,8);
                            $lin->vencimento = $dia."/".$mes."/".$ano;
                ?>
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header" style="overflow: auto;">
                                <span class="pull-left">
                                    <cite>Prefeitura Municipal de Cambori&uacute;</cite><br>
                                    <cite style="font-size: 18px;">Secretaria Municipal de Planejamento Urbano</cite><br>
                                    <cite style="font-size: 13px;">Rua Get&uacute;lio Vargas, 77 - Centro</cite><br>
                                    <cite style="font-size: 13px;">(47)3365-9500 - www.camboriu.sc.gov.br</cite>
                                </span>
                                <span class="pull-right"><img src="img/flag.jpg" alt="Bandeira"></span>
                            </h2>                            
                        </div>
                    </div>
                    
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <h1 style="text-align: center;">REQUERIMENTO</h1>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;"><?php echo strtoupper($lin->recolhimento); ?></h1>
                        </div>
                    </div>
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 bord">
                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO IM&Oacute;VEL</strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>Inscri&ccedil;&atilde;o: </strong><span><?php echo $lin2->inscricao; ?></span>
                        </div>
                        <div class="col-xs-8">
                            <strong>Endere&ccedil;o: </strong><span><?php echo strtoupper($lin2->endereco.' - '.$lin2->bairro); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>Lote: </strong><span><?php echo strtoupper($lin2->lote); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Quadra: </strong><span><?php echo strtoupper($lin2->quadra); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Loteamento: </strong><span><?php echo strtoupper($lin2->loteamento); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Ano(s) vencido(s): </strong><span><?php echo $lin->vencido; ?></span>
                        </div>
                        <div class="col-xs-6">
                            <strong>Alvar&aacute;: </strong><span><?php echo strtoupper($lin->alvara); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 bord">
                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO REQUERENTE</strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Requerente: </strong><span><strong><?php echo strtoupper($lin->requerente); ?></strong></span>
                        </div>
                        <div class="col-xs-3">
                            <strong>CPF/CNPJ: </strong><span><?php echo $lin->cpf_cnpj; ?></span>
                        </div>
                        <div class="col-xs-3">
                            <strong>Telefone: </strong><span><?php echo $lin->telefone; ?></span>
                        </div>
                    </div><!-- /.row -->
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>E-mail: </strong><span><?php echo strtoupper($lin->email); ?></span>
                        </div>
                        <div class="col-xs-5">
                            <strong>Tipo de constru&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin->construcao); ?></span>
                        </div>
                        <div class="col-xs-3">
                            <strong>&Aacute;rea(m&sup2;): </strong><span><?php echo strtoupper($lin->area); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Arquiteto/Engenheiro: </strong><span><strong><?php echo strtoupper($lin3->nome); ?></strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 bord">
                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES COMPLEMENTARES</strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <span style="text-align: justify;"><?php echo $lin->referencia; ?></span>
                        </div>
                    </div>
                    <br><br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p class="lead" style="text-align: center;">Este requerimento ficar&aacute; aguardando o pagamento da taxa por no m&aacute;ximo 30 dias</p>
                        </div>
                    </div><!-- /.row -->
                    <br>
                    <div class="row invoice-info">
                        <div class="col-xs-3">
                            <strong>Cambori&uacute;, </strong><span><?php echo date('d/m/Y'); ?></span>
                        </div>
                        <!--<div class="col-xs-9">
                            <strong>Requerente:</strong><br><br><span>________________________________________________________________</span>
                        </div>
                        <div class="col-xs-2">
                            <strong>Cambori&uacute;, </strong><span><?php echo date('d/m/Y'); ?></span>
                        </div>
                        <div class="col-xs-3">
                            <strong>Propriet&aacute;rio:</strong><br><br><span>________________________________</span>
                        </div>
                        <div class="col-xs-3">
                            <strong>Respons&aacute;vel:</strong><br><br><span>________________________________</span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Funcion&aacute;rio: </strong><span><?php echo $lin4->nome; ?></span>
                        </div>-->
                    </div><!-- /.row -->
                    <br><br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p style="font-size: 9px;text-align: center;">
                                Impresso em <?php echo date('d/m/Y'); ?> &agrave;s <?php echo date('h:i:s'); ?>h por <?php echo base64_decode($_SESSION['name']); ?>, ip <?php echo $_SERVER['REMOTE_ADDR']; ?>. Editado pela &uacute;ltima vez por <?php echo $lin->ultimo_usuario; ?>
                            </p>
                        </div>
                    </div><!-- /.row -->
                <?php
                        }
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso requerimento v&aacute;lido.
                            </div>';
                        }

                    mysql_close($conexao);
                    unset($conexao,$charset,$sql,$res,$ret,$pyrequerimento,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$sql4,$res4,$ret4,$lin4,$sql5,$res5,$ret5,$lin5);
                ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
       <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /* PRINT */
                
                <?php if(!empty($lin)) { ?> print(); location.href = 'relacaoRequerimento.php'; <?php } unset($lin); ?>
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>