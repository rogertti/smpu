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
                    $sql = "SELECT * FROM protocolo WHERE idprotocolo = ".$_GET[''.$pyprotocolo.'']."";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);
                            
                            //busca a inscricao e o recolhimento
                            $sql2 = "SELECT imovel.inscricao,requerimento.recolhimento FROM imovel,requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
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
                            <h1 style="text-align: center;">DADOS DO PROTOCOLO</h1>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;"><?php echo $lin->codigo; ?></h1>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>Inscri&ccedil;&atilde;o do im&oacute;vel: </strong><span><?php echo strtoupper($lin2->inscricao); ?></span>
                        </div>
                        <div class="col-xs-8">
                            <strong>Recolhimento: </strong><span><?php echo strtoupper($lin2->recolhimento); ?></span>
                        </div>
                    </div>
                    
                    <div class="row invoice-info">
                        <div class="col-xs-4">
                            <strong>Taxa: </strong><span><?php echo strtoupper("R$ ".$lin->taxa); ?></span>
                        </div>
                        <div class="col-xs-8">
                            <strong>Situa&ccedil;&atilde;o: </strong><span><?php echo strtoupper($lin->situacao); ?></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Observa&ccedil;&atilde;o: </strong><br/><span><pre class="prefy"><?php echo $lin->observacao; ?></pre></span>
                        </div>
                    </div><!-- /.row -->
                <?php
                        }
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso dados de um protocolo v&aacute;lido.
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
                
                <?php if(!empty($lin)) { ?> print(); location.href = 'inicio.php'; <?php } unset($lin); ?>
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>