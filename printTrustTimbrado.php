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
                    /*include_once('conexao.php');

                    $py = md5('idtimbrado');
                    $sql = "SELECT idtimbrado,tipo_timbrado_idtipo_timbrado,protocolo,texto,autentico,ultimo_usuario FROM timbrado WHERE idtimbrado = '".$_GET[''.$py.'']."'";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);*/

                    //selecionando o tipo
                    $sql2 = "SELECT tipo_timbrado.descricao FROM tipo_timbrado,timbrado WHERE tipo_timbrado.idtipo_timbrado = timbrado.tipo_timbrado_idtipo_timbrado AND timbrado.tipo_timbrado_idtipo_timbrado = ".$lin->tipo_timbrado_idtipo_timbrado."";
                    $res2 = mysql_query($sql2);
                    $ret2 = mysql_num_rows($res2);

                        if($ret2 != 0) {
                            $lin2 = mysql_fetch_object($res2);
                        }
                        else {
                            $zero = 1;
                        }

                        //selecionando o mes
                        switch(date('m')) {
                            case '01': $mes = 'janeiro'; break;
                            case '02': $mes = 'fevereiro'; break;
                            case '03': $mes = 'mar&ccedil;o'; break;
                            case '04': $mes = 'abril'; break;
                            case '05': $mes = 'maio'; break;
                            case '06': $mes = 'junho'; break;
                            case '07': $mes = 'julho'; break;
                            case '08': $mes = 'agosto'; break;
                            case '09': $mes = 'setembro'; break;
                            case '10': $mes = 'outubro'; break;
                            case '11': $mes = 'novembro'; break;
                            case '12': $mes = 'dezembro'; break;
                        }
                ?>
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header" style="overflow: auto;">
                                <span class="pull-left">
                                    <cite>Prefeitura Municipal de Cambori&uacute;</cite><br>
                                    <cite style="font-size: 18px;">Secretaria Municipal de Planejamento Urbano</cite><br>
                                    <cite style="font-size: 13px;">Rua Get&uacute;lio Vargas, 77 - Centro - Cambori&uacute; - SC</cite><br>
                                    <cite style="font-size: 13px;">(47)3365-9500 - Ramais: 9535 - 9536</cite><br>
                                    <cite style="font-size: 13px;">Ouvidoria 0800-6469500 - ouvidoria@cidadedecamboriu.sc.gov.br</cite>
                                </span>
                                <span class="pull-right"><img src="img/flag.jpg" alt="Bandeira"></span>
                            </h2>
                        </div>
                    </div>

                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <h1 style="text-align: center;"><?php echo $lin2->descricao.' - '.$lin->protocolo; ?></h1>
                        </div>
                    </div>

                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <?php echo htmlspecialchars_decode($lin->texto); ?>
                        </div>
                    </div>
                    <br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <strong>Cambori&uacute;, </strong><span><?php echo date('d').' de '.$mes.' de '.date('Y'); ?></span>
                        </div>
                    </div>
                    <br><br>
                    <div class="row invoice-info">
                        <div class="col-xs-12 text-center">
                            <strong>RODRIGO MEIRINHO MORIMOTO</strong><br>
                            <span>Secret&aacute;rio Municipal de Planejamento Urbano</span>
                        </div>
                    </div>
                    <br><br>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <p style="font-size: 9px;text-align: center;">Impresso em <?php echo date('d/m/Y'); ?> &agrave;s <?php echo date('h:i:s'); ?>h por <?php echo base64_decode($_SESSION['name']); ?>, ip <?php echo $_SERVER['REMOTE_ADDR']; ?>. Editado pela &uacute;ltima vez por <?php echo $lin->ultimo_usuario; ?><br>A autenticidade desse documento pode ser verificada em smpu.camboriu.sc.gov.br, com a chave <?php echo $lin->autentico; ?></p>
                        </div>
                    </div>
                <?php
                        /*}
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso an&aacute;lise v&aacute;lida.
                            </div>';
                        }

                    mysql_close($conexao);
                    unset($conexao,$charset,$sql,$res,$ret,$py,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$sql4,$res4,$ret4,$lin4,$sql5,$res5,$ret5,$lin5,$sql6,$res6,$ret6,$lin6,$dia,$mes,$ano);*/
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
    </body>
</html>
