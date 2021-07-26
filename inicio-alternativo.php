<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    unset($_SESSION['folder']);
    $mn = 1;
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
        <!-- Data table -->
        <link href="css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Colorbox -->
        <link href="css/colorbox.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>In&iacute;cio <small class="pull-right lead response"></small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                        <?php
                            include_once('conexao.php');

                            $sql = "SELECT COUNT(idprotocolo) AS total FROM protocolo WHERE monitor = 'O'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);

                                if($ret != 0) {
                                    $lin = mysql_fetch_row($res);
                                    echo'
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3>'.$lin[0].'</h3>
                                            <p>Protocolos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-ticket"></i>
                                        </div>
                                        <a class="small-box-footer" href="relacaoProtocolo.php">
                                            Visualizar todos <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>';
                                }
                                else {
                                    #$zero = 1;

                                    echo'
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3>Nenhum</h3>
                                            <p>Protocolo</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-ticket"></i>
                                        </div>
                                    </div>';    
                                }
                            
                            unset($sql,$res,$ret,$lin);
                        ?>    
                        </div>
                        <div class="col-lg-4 col-xs-6">
                        <?php
                            $sql = "SELECT COUNT(idrequerimento) AS total FROM requerimento WHERE monitor = 'O'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);

                                if($ret != 0) {
                                    $lin = mysql_fetch_row($res);
                                    echo'
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>'.$lin[0].'</h3>
                                            <p>Requerimentos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <a class="small-box-footer" href="relacaoRequerimento.php">
                                            Visualizar todos <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>';
                                }
                                else {
                                    #$zero = 1;

                                    echo'
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>Nenhum</h3>
                                            <p>Requerimento</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                    </div>';    
                                }
                            
                            unset($sql,$res,$ret,$lin);
                        ?>    
                        </div>
                        <div class="col-lg-4 col-xs-6">
                        <?php
                            $sql = "SELECT COUNT(idimovel) AS total FROM imovel WHERE monitor = 'O'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);

                                if($ret != 0) {
                                    $lin = mysql_fetch_row($res);
                                    echo'
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3>'.$lin[0].'</h3>
                                            <p>Im&oacute;veis</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <a class="small-box-footer" href="relacaoImovel.php">
                                            Visualizar todos <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>';
                                }
                                else {
                                    #$zero = 1;

                                    echo'
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3>Nenhum</h3>
                                            <p>Im&oacute;vel</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                    </div>';    
                                }
                            
                            unset($sql,$res,$ret,$lin);
                        ?>    
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                        <?php
                            $sql = "SELECT COUNT(idanalise) AS total FROM analise WHERE monitor = 'O'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);

                                if($ret != 0) {
                                    $lin = mysql_fetch_row($res);
                                    echo'
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3>'.$lin[0].'</h3>
                                            <p>An&aacute;lises</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-rss"></i>
                                        </div>
                                        <a class="small-box-footer" href="relacaoAnalise.php">
                                            Visualizar todas <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>';
                                }
                                else {
                                    #$zero = 1;

                                    echo'
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3>Nenhuma</h3>
                                            <p>An&aacute;lise</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-rss"></i>
                                        </div>
                                    </div>';    
                                }
                            
                            unset($sql,$res,$ret,$lin);
                        ?>
                        </div>
                        <div class="col-lg-4 col-xs-6">
                        <?php
                            $sql = "SELECT COUNT(idfiscalizacao) AS total FROM fiscalizacao WHERE monitor = 'O'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);

                                if($ret != 0) {
                                    $lin = mysql_fetch_row($res);
                                    echo'
                                    <div class="small-box bg-teal">
                                        <div class="inner">
                                            <h3>'.$lin[0].'</h3>
                                            <p>Notifica&ccedil;&otilde;es</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                        <a class="small-box-footer" href="relacaoNotificacao.php">
                                            Visualizar todas <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>';
                                }
                                else {
                                    #$zero = 1;

                                    echo'
                                    <div class="small-box bg-teal">
                                        <div class="inner">
                                            <h3>Nenhuma</h3>
                                            <p>Notifica&ccedil;&atilde;o</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </div>';    
                                }
                            
                            unset($sql,$res,$ret,$lin);
                        ?>
                        </div>
                        <div class="col-lg-4 col-xs-6">
                        <?php
                            $sql = "SELECT COUNT(idhabitese) AS total FROM habitese WHERE monitor = 'O'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);

                                if($ret != 0) {
                                    $lin = mysql_fetch_row($res);
                                    echo'
                                    <div class="small-box bg-light-blue">
                                        <div class="inner">
                                            <h3>'.$lin[0].'</h3>
                                            <p>Habite-ses</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                        <a class="small-box-footer" href="relacaoHabitese.php">
                                            Visualizar todos <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>';
                                }
                                else {
                                    #$zero = 1;

                                    echo'
                                    <div class="small-box bg-light-blue">
                                        <div class="inner">
                                            <h3>Nenhum</h3>
                                            <p>Habite-se</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-building"></i>
                                        </div>
                                    </div>';    
                                }
                            
                            mysql_close($conexao);
                            unset($conexao,$charset,$sql,$res,$ret,$lin);
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
        <!-- Data table -->
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- Colorbox -->
        <script src="js/colorbox.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /* TABLE */
                
                $(".table").dataTable({ "column": 7,"order": [[0,'desc'],[1,'asc']] });
                
                /* TOOLTIP */
                
                $('.tt').tooltip();
                
                /* COLORBOX */
                
                $(".fr").colorbox({iframe:true,width:"80%",height:"75%"});
                
                
                /* ALERT */
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>