<?php require_once('config.php'); ?>
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
            .content { margin: 0; padding-top: 0; }
            pre.prefy { padding: 0; margin: 0; display: inherit; }
            pre.prefy p { padding: 0; margin: 0; }
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
        
        <div class="wrapper row-offcanvas row-offcanvas-left">    
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">                
                <!-- Main content -->
                <section class="content invoice">
                <?php
                    $lin->arquitetonico = trim($lin->arquitetonico);
                    $lin->hidrosanitario = trim($lin->hidrosanitario);
                    $lin->arquitetonico = str_replace("&nbsp;","",$lin->arquitetonico);
                    $lin->hidrosanitario = str_replace("&nbsp;","",$lin->hidrosanitario);

                    //selecionando os dados do protocolo
                    $sql2 = "SELECT protocolo.codigo,imovel.inscricao,contribuinte.nome,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                    $res2 = mysql_query($sql2);
                    $ret2 = mysql_num_rows($res2);

                        if($ret2 != 0) {
                            $lin2 = mysql_fetch_object($res2);
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
                            <h1 style="text-align: center;">PARECER T&Eacute;CNICO DE AN&Aacute;LISE DE PROJETO - <?php echo $lin2->codigo; ?></h1>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <!--<div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Protocolo: </strong><span class="lead"><strong></strong></span>
                        </div>
                    </div> /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Inscri&ccedil;&atilde;o: </strong><span><?php echo $lin2->inscricao; ?></span>
                        </div>
                        <div class="col-xs-6">
                            <strong>Tipo de obra: </strong><span><?php echo strtoupper($lin2->construcao); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Propriet&aacute;rio: </strong><span><?php echo strtoupper($lin2->nome); ?></span>
                        </div>
                        <div class="col-xs-6">
                            <strong>Requerente: </strong><span><?php echo strtoupper($lin2->requerente); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-8">
                            <strong>Endere&ccedil;o: </strong><span><?php echo strtoupper($lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Lote: </strong><span><?php echo strtoupper($lin2->lote); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>Quadra: </strong><span><?php echo strtoupper($lin2->quadra); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Loteamento: </strong><span><?php echo strtoupper($lin2->loteamento); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>&Aacute;rea: </strong><span><?php echo strtoupper($lin2->area); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>Situa&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin->situacao); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Respons&aacute;vel t&eacute;cnico: </strong><span><?php echo strtoupper($lin->responsavel); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>ART/RRT de execu&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin->art_rrt); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Projeto Arquitet&ocirc;nico/Desmembramento/Unifica&ccedil;&atilde;o: </strong><br/><span><pre class="prefy"><?php echo html_entity_decode($lin->arquitetonico); ?></pre></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Projeto Hidrosanit&aacute;rio: </strong><br/><span><pre class="prefy"><?php echo html_entity_decode($lin->hidrosanitario); ?></pre></span>
                        </div>
                    </div><!-- /.row -->
                    <br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <span><strong>Observa&ccedil;&otilde;es:</strong></span><br><br>
                            <span>&bull; N&atilde;o ser&atilde;o aceitos colagens, corretivos e rasuras a m&atilde;o livre nos projetos;</span><br>
                            <span>&bull; O projeto ser&aacute; reanalisado, podendo ter novas altera&ccedil;&otilde;es conforme rean&aacute;lise;</span><br>
                            <span>&bull; O projeto submetido a pre-an&aacute;lise, an&aacute;lise ou rean&aacute;lise, ser&aacute; devolvido no prazo máximo de 20 dias &uacute;teis, conforme lei municipal;</span><br/>
                            <span><strong><i>Os prazos podem ser prorrogados por igual per&iacute;odo, a crit&eacute;rio da autoridade competente.</i></strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br><br>
                    <div class="row invoice-info">
                        <div class="col-xs-3">
                            <strong>Cambori&uacute;, </strong><span><?php echo date('d/m/Y'); ?></span>
                        </div>
                        <div class="col-xs-9">
                            <strong>Assinatura e carimbo do respons&aacute;vel:</strong><br><br><span>______________________________________________________________________________________</span>
                        </div>
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
       <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
    </body>
</html>