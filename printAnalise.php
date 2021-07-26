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

                    $pyanalise = md5('idanalise'); 
                    $sql = "SELECT * FROM analise WHERE idanalise = '".$_GET[''.$pyanalise.'']."'";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);
                            
                            $lin->arquitetonico = trim($lin->arquitetonico);
                            $lin->hidrosanitario = trim($lin->hidrosanitario);
                            $lin->arquitetonico = str_replace("&nbsp;","",$lin->arquitetonico);
                            $lin->hidrosanitario = str_replace("&nbsp;","",$lin->hidrosanitario);
                            
                            if(!empty($lin->datado)) {
                                //invertendo a data 00/00/0000
                                $ano = substr($lin->datado,0,4);
                                $mes = substr($lin->datado,5,2);
                                $dia = substr($lin->datado,8);
                                $lin->datado = $dia."/".$mes."/".$ano;
                            }
                            
                            //selecionando os dados do protocolo
                            $sql2 = "SELECT protocolo.codigo,imovel.inscricao,contribuinte.nome,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                            $res2 = mysql_query($sql2);
                            $ret2 = mysql_num_rows($res2);
                                
                                if($ret2 != 0) {
                                    $lin2 = mysql_fetch_object($res2);
                                } 
                                else {
                                    $zero = 1;
                                }

                            //selecionando os dados do engenheiro
                            $sql6 = "SELECT telefone,email FROM engenheiro WHERE nome = '".$lin->responsavel."'";
                            $res6 = mysql_query($sql6);
                            $ret6 = mysql_num_rows($res6);

                                if($ret6 != 0) {
                                    $lin6 = mysql_fetch_object($res6);
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
                    <br>
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
                            <strong>ART/RRT de execu&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin->art_rrt); ?></span>
                        </div>
                        <div class="col-xs-4"></div>
                    </div><!-- /.row -->

                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Respons&aacute;vel t&eacute;cnico: </strong><span><?php echo strtoupper($lin->responsavel); ?></span>
                        </div>
                        <div class="col-xs-6">
                            <strong>Telefone: </strong><span><?php echo strtoupper($lin6->telefone); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>E-mail: </strong><span><?php echo strtoupper($lin6->email); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Data da an&aacute;lise: </strong><span><?php echo strtoupper($lin->datado); ?></span>
                        </div>
                        <div class="col-xs-4"></div>
                    </div><!-- /.row -->
                    <br>
                    <?php
                        //buscando as infracoes de grau minimo
                        $sql2 = "SELECT iddocumentacao,descricao FROM documentacao WHERE monitor = 'O' ORDER BY descricao";
                        $res2 = mysql_query($sql2);
                        $ret2 = mysql_num_rows($res2);

                            if($ret2 != 0) {
                                echo'
                                <div class="row invoice-info">
                                    <div class="col-xs-12">
                                        <strong>Documenta&ccedil;&atilde;o que falta ser entregue: </strong><br>
                                        <span>
                                            <table class="table">';

                                    while($lin2 = mysql_fetch_object($res2)) {
                                        //buscando os itens da documentacao selecionadas
                                        $sql3 = "SELECT documentacao_iddocumentacao FROM analise_has_documentacao WHERE analise_idanalise = ".$lin->idanalise." AND documentacao_iddocumentacao = ".$lin2->iddocumentacao."";
                                        $res3 = mysql_query($sql3);
                                        $ret3 = mysql_num_rows($res3);

                                            if($ret3 == 0) {
                                                echo'<tr><td>'.$lin2->descricao.'</td></tr>';
                                            }

                                        unset($sql3,$res3,$ret3,$lin2);
                                    }

                                            echo'
                                            </table>
                                        </span>
                                    </div>
                                </div><!-- /.row -->';
                            }

                        unset($sql2,$res2,$ret2);
                    ?>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Projeto Arquitet&ocirc;nico/Desmembramento/Unifica&ccedil;&atilde;o: </strong><br><span><?php echo htmlspecialchars_decode($lin->arquitetonico); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Projeto Hidrosanit&aacute;rio: </strong><br><span><?php echo htmlspecialchars_decode($lin->hidrosanitario); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <span><strong>Observa&ccedil;&otilde;es:</strong></span><br><br>
                            <span>&bull; N&atilde;o ser&atilde;o aceitos colagens, corretivos e rasuras a m&atilde;o livre nos projetos;</span><br>
                            <span>&bull; O projeto ser&aacute; reanalisado, podendo ter novas altera&ccedil;&otilde;es conforme rean&aacute;lise;</span><br>
                            <span>&bull; O projeto submetido a pre-an&aacute;lise, an&aacute;lise ou rean&aacute;lise, ser&aacute; devolvido no prazo máximo de 20 dias &uacute;teis, conforme lei municipal;</span><br>
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
                    <br><br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p style="font-size: 9px;text-align: center;">Impresso em <?php echo date('d/m/Y'); ?> &agrave;s <?php echo date('h:i:s'); ?>h por <?php echo base64_decode($_SESSION['name']); ?>, ip <?php echo $_SERVER['REMOTE_ADDR']; ?>. Editado pela &uacute;ltima vez por <?php echo $lin->ultimo_usuario; ?><br>A autenticidade desse documento pode ser verificada em smpu.camboriu.sc.gov.br, com a chave <?php echo $lin->autentico; ?></p>
                        </div>
                    </div><!-- /.row -->
                <?php
                        }
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso an&aacute;lise v&aacute;lida.
                            </div>';
                        }

                    mysql_close($conexao);
                    unset($conexao,$charset,$sql,$res,$ret,$pyanalise,$pyrequerimento,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$sql4,$res4,$ret4,$lin4,$sql5,$res5,$ret5,$lin5,$sql6,$res6,$ret6,$lin6,$dia,$mes,$ano);
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
                
                <?php if(!empty($lin)) { ?> print(); location.href = 'relacaoAnalise.php'; <?php } unset($lin); ?>
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
