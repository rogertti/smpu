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

                    $pyprotocolo = md5('idprotocolo'); 
                    $sql = "SELECT * FROM protocolo WHERE idprotocolo = '".$_GET[''.$pyprotocolo.'']."'";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);

                            //busca contribuinte,cpf_cnpj,recolhimento,idfuncionario
                            #$sql2 = "SELECT contribuinte.nome,contribuinte.cpf_cnpj,imovel.inscricao,requerimento.recolhimento,requerimento.funcionario_idfuncionario FROM protocolo,requerimento,imovel,contribuinte WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND imovel.contribuinte_idcontribuinte = contribuinte.idcontribuinte AND requerimento.idrequerimento = ".$lin[1]."";
                            $sql2 = "SELECT imovel.*,requerimento.* FROM protocolo,requerimento,imovel WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
                            $res2 = mysql_query($sql2);
                            $ret2 = mysql_num_rows($res2);
                                
                                if($ret2 != 0) {
                                    $lin2 = mysql_fetch_object($res2);
                                } 
                                else {
                                    $zero = 1;
                                }
                            
                            //busca funcionario
                            $sql3 = "SELECT funcionario.nome FROM requerimento,funcionario WHERE requerimento.funcionario_idfuncionario = funcionario.idfuncionario AND funcionario.idfuncionario = ".$lin2->funcionario_idfuncionario."";
                            $res3 = mysql_query($sql3);
                            $ret3 = mysql_num_rows($res3);
                                
                                if($ret3 != 0) {
                                    $lin3 = mysql_fetch_object($res3);
                                } 
                                else {
                                    $zero = 1;
                                }
                ?>
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header" style="overflow: auto;">
                                <span class="pull-left">
                                    <cite>Prefeitura Municipal de Cambori&uacute;</cite><br>
                                    <cite style="font-size: 18px;">Secretaria Municipal de Planejamento Urbano</cite><br>
                                    <cite style="font-size: 13px;">Rua Get&uacute;lio Vargas, 77 - Centro</cite><br>
                                    <cite style="font-size: 13px;">(47)3365-9500 - Ramais: 9535 - 9536</cite><br>
                                    <cite style="font-size: 13px;">www.camboriu.sc.gov.br - smpu@camboriu.sc.gov.br</cite>
                                </span>
                                <span class="pull-right"><img src="img/flag.jpg" alt="Bandeira"></span>
                            </h2>                            
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <h1 style="text-align: center;">PROTOCOLO</h1>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;"><?php echo $lin->codigo.'<br>'.strtoupper($lin2->recolhimento); ?></h1>
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
                            <strong>Endere&ccedil;o: </strong><span><?php echo strtoupper($lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro); ?></span>
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
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 bord">
                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO REQUERENTE</strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-8">
                            <strong>Requerente: </strong><span><?php echo strtoupper($lin2->requerente); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>CPF/CNPJ: </strong><span><?php echo strtoupper($lin2->cpf_cnpj); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-8">
                            <strong>Tipo de constru&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin2->construcao); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>&Aacute;rea(m&sup2;): </strong><span><?php echo strtoupper($lin2->area); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 invoice-col">
                            <strong>Funcion&aacute;rio: </strong><span><?php echo strtoupper($lin3->nome); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 bord">
                            <span class="lead"><strong>PRAZOS</strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <span>&bull; An&aacute;lise de projeto, no m&aacute;ximo 20 dias &uacute;teis, conforme lei municipal;</span><br>
                            <span>&bull; Habite-se, no m&aacute;ximo 15 dias &uacute;teis, conforme lei municipal;</span><br>
                            <span>&bull; Consulta de viabilidade, declara&ccedil;&otilde;es e certid&otilde;es, no m&aacute;ximo 10 dias, conforme lei municipal;</span><br/>
                            <span><strong><i>Os prazos podem ser prorrogados caso haja corre&ccedil;&otilde;es.</i></strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p>Para a retirada dos documentos deste processo, fica submetida a apresenta&ccedil;&atilde;o deste protocolo.<br/>Se o interessado for o propriet&aacute;rio/requerente, dever&aacute; ser apresentado documento de idenfica&ccedil;&atilde;o.</p>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p class="text-center" style="font-size: 9px;">Impresso em <?php echo date('d/m/Y'); ?> &agrave;s <?php echo date('h:i:s'); ?>h por <?php echo base64_decode($_SESSION['name']); ?>, ip <?php echo $_SERVER['REMOTE_ADDR']; ?>. Editado pela &uacute;ltima vez por <?php echo $lin->ultimo_usuario; ?><br/>A autenticidade desse documento pode ser verificada em <strong>https://smpu.camboriu.sc.gov.br</strong> com a chave <strong><?php echo $lin->autentico; ?></strong><br>Para acompanhar o andamento desse protocolo acesse <strong>https://smpu.embracore.com.br/consultaPublicaProtocolo.php</strong></p>
                        </div>
                    </div><!-- /.row -->
                <?php
                        }
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso protocolo v&aacute;lido.
                            </div>';
                        }

                    mysql_close($conexao);
                    unset($conexao,$charset,$sql,$res,$ret,$pyprotocolo,$pyrequerimento,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$sql4,$res4,$ret4,$lin4,$sql5,$res5,$ret5,$lin5);
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
                
                <?php if(!empty($lin)) { ?> $(window).on("load",function(){ print(); location.href = 'inicio.php'; }); <?php } unset($lin); ?>
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
