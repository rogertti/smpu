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
                    //invertendo data 00/00/0000   
                    $ano = substr($lin->datado,0,4);
                    $mes = substr($lin->datado,5,2);
                    $dia = substr($lin->datado,8);
                    $lin->datado = $dia."/".$mes."/".$ano;

                    //selecionando os dados do imovel 
                    $sql2 = "SELECT imovel.inscricao,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento,contribuinte.nome,contribuinte.cpf_cnpj FROM imovel,fiscalizacao,contribuinte WHERE fiscalizacao.imovel_idimovel = imovel.idimovel AND imovel.contribuinte_idcontribuinte = contribuinte.idcontribuinte AND imovel.idimovel = ".$lin->imovel_idimovel."";
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
                            <h1 style="text-align: center;">FISCALIZA&Ccedil;&Atilde;O</h1>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;"><?php echo $lin->notificacao; ?></h1>
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
                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO CONTRIBUINTE</strong></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-8">
                            <strong>Requerente: </strong><span><?php echo strtoupper($lin2->nome); ?></span>
                        </div>
                        <div class="col-xs-4">
                            <strong>CPF/CNPJ: </strong><span><?php echo strtoupper($lin2->cpf_cnpj); ?></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Data: </strong><span><?php echo strtoupper($lin->datado." - ".$lin->hora." h"); ?></span>
                        </div>
                        <div class="col-xs-6">
                            <strong>Prazo: </strong><span><?php echo strtoupper($lin->prazo." dias"); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Respons&aacute;vel: </strong><span><?php echo strtoupper($lin->responsavel); ?></span>
                        </div>
                        <div class="col-xs-6">
                            <strong>Receptor: </strong><span><?php echo strtoupper($lin->receptor); ?></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Situa&ccedil;&atilde;o: </strong><br/><span><pre class="prefy"><?php echo $lin->situacao; ?></pre></span>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Medida: </strong><br/><span><pre class="prefy"><?php echo $lin->medida; ?></pre></span>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                        <?php
                            //busca os motivos
                            $sql3 = "SELECT infracao.nivel,infracao.descricao FROM fiscalizacao,fiscalizacao_has_infracao,infracao WHERE infracao.idinfracao = fiscalizacao_has_infracao.infracao_idinfracao AND fiscalizacao.idfiscalizacao = fiscalizacao_has_infracao.fiscalizacao_idfiscalizacao AND fiscalizacao.idfiscalizacao = ".$lin->idfiscalizacao." ORDER BY infracao.nivel DESC";
                            $res3 = mysql_query($sql3);
                            $ret3 = mysql_num_rows($res3);

                                if($ret3 != 0) {
                                    echo'
                                    <table class="table table-bordered table-striped fonted">
                                        <tr><th colspan="2">Motivos</th></tr>';

                                        while($lin3 = mysql_fetch_object($res3)) {
                                            echo'<tr><td>'.$lin3->descricao.'</td> <td>'.$lin3->nivel.'</td></tr>';
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
                            $dir = 'fiscal/'.$lin->album.'/'; 

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