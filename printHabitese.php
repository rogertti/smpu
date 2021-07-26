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

                    $pyhabitese = md5('idhabitese'); 
                    $sql = "SELECT * FROM habitese WHERE idhabitese = '".$_GET[''.$pyhabitese.'']."'";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);
                            
                            //invertendo data 00/00/0000   
                            $ano = substr($lin->datado,0,4);
                            $mes = substr($lin->datado,5,2);
                            $dia = substr($lin->datado,8);
                            $lin->datado = $dia."/".$mes."/".$ano;

                            //selecionando os dados do protocolo
                            $sql2 = "SELECT protocolo.codigo,imovel.inscricao,requerimento.requerente,requerimento.cpf_cnpj,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
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
                            <h1 style="text-align: center;">LAUDO DE VISTORIA PARA HABITE-SE</h1>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;"><?php echo $lin2->codigo; ?></h1>
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
                        <div class="col-xs-4">
                            <strong>Situa&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin->situacao); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>Data: </strong><span><?php echo strtoupper($lin->datado." - ".$lin->hora." h"); ?></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Observa&ccedil;&atilde;o: </strong><br><span><?php echo strtoupper($lin->observacao); ?></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                        <?php
                            //busca os itens
                            $sql3 = "SELECT habitese_has_item_habitese.situacao,item_habitese.descricao FROM habitese,habitese_has_item_habitese,item_habitese WHERE item_habitese.iditem_habitese = habitese_has_item_habitese.item_habitese_iditem_habitese AND habitese.idhabitese = habitese_has_item_habitese.habitese_idhabitese AND habitese.idhabitese = ".$lin->idhabitese." AND item_habitese.monitor = 'O' ORDER BY item_habitese.descricao";
                            $res3 = mysql_query($sql3);
                            $ret3 = mysql_num_rows($res3);

                                if($ret3 != 0) {
                                    echo'
                                    <table class="table table-bordered table-striped fonted">';

                                        while($lin3 = mysql_fetch_object($res3)) {
                                            echo'<tr><td>'.$lin3->descricao.'</td><td style="width: 100px;">'.$lin3->situacao.'</td></tr>';
                                        }

                                    echo'</table>';
                                }
                        ?>
                        </div>
                    </div>   
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                        <?php
                            //fotos
                            $dir = 'habitese/'.$lin->album.'/'; 

                                if(file_exists($dir)) { 
                                    $pon = opendir($dir);

                                        while($nitens = readdir($pon)) {
                                            $itens[] = $nitens;
                                        }

                                    sort($itens);

                                        foreach($itens as $listar) {
                                            if ($listar != "." && $listar != "..") { 
                                                $arquivos[] = $listar; 
                                            }
                                        }

                                        if (!empty($arquivos)) {
                                            foreach($arquivos as $listar) {
                                                if(!strstr($listar,'tb-')) {
                                                    $opt = substr($listar,3);
                                                    print'<div class="col-xs-6 thumbnail"><img src="'.$dir.''.$listar.'"></a></div>';
                                                }
                                            }
                                        }

                                    unset($pon,$nitens,$itens,$listar,$pastas,$n,$arquivos,$opt);
                                }
                        ?>    
                        </div>
                    </div>
                    <br/> 
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p class="text-center" style="font-size: 9px;">Impresso em <?php echo date('d/m/Y'); ?> &agrave;s <?php echo date('h:i:s'); ?>h por <?php echo base64_decode($_SESSION['name']); ?>, ip <?php echo $_SERVER['REMOTE_ADDR']; ?>. Editado pela &uacute;ltima vez por <?php echo $lin->ultimo_usuario; ?><br/>A autenticidade desse documento pode ser verificada em smpu.camboriu.sc.gov.br, com a chave <?php echo $lin->autentico; ?></p>
                        </div>
                    </div><!-- /.row -->
                <?php
                        }
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso habite-se v&aacute;lido.
                            </div>';
                        }

                    mysql_close($conexao);
                    unset($conexao,$charset,$sql,$res,$ret,$pyhabitese,$sql2,$res2,$ret2,$lin2);
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
                
                <?php if(!empty($lin)) { ?> $(window).on("load",function(){ print(); location.href = 'relacaoHabitese.php'; }); <?php } unset($lin); ?>
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>