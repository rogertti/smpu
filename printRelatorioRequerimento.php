<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    #ob_start();
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
            svg { position: relative; right: 120px; }
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

                    $pyperiodo = md5('periodo');
                    $periodoA = substr($_GET[''.$pyperiodo.''],0,10);
                    $periodoB = substr($_GET[''.$pyperiodo.''],13);

                    $sql = "SELECT requerimento.recolhimento,COUNT(*) AS soma,ROUND(SUM(protocolo.taxa),2) AS total FROM requerimento,protocolo WHERE requerimento.entrada BETWEEN '".$periodoA."' AND '".$periodoB."' AND protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.monitor = 'O' GROUP BY requerimento.recolhimento";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);
                        
                        if($ret != 0) {
                            //invertendo data 00/00/0000   
                            $ano = substr($periodoA,0,4);
                            $mes = substr($periodoA,5,2);
                            $dia = substr($periodoA,8);
                            $periodoA = $dia."/".$mes."/".$ano;
                            unset($dia,$mes,$ano);
                            
                            $ano = substr($periodoB,0,4);
                            $mes = substr($periodoB,5,2);
                            $dia = substr($periodoB,8);
                            $periodoB = $dia."/".$mes."/".$ano;
                            unset($dia,$mes,$ano);
                            
                            $donut = '';
                            $i = 1;
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
                            <h1 style="text-align: center;">RELAT&Oacute;RIO DE REQUERIMENTO<br/><cite class="lead"><?php echo $periodoA; ?> &Agrave; <?php echo $periodoB; ?></cite></h1>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Recolhimento</th>
                                        <th>Quantidade</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while($lin = mysql_fetch_object($res)) {
                                        echo'
                                        <tr>
                                            <td>'.$lin->recolhimento.'</td>
                                            <td>'.$lin->soma.'</td>
                                            <td>R$ '.number_format($lin->total,2,'.',',').'</td>
                                        </tr>';
                                        
                                        if($i < $ret) {
                                            $donut .= '["'.$lin->recolhimento.'",'.$lin->soma.'],';
                                        }
                                        else {
                                            $donut .= '["'.$lin->recolhimento.'",'.$lin->soma.']';
                                        }
                                    }
                                ?>   
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Recolhimento</th>
                                        <th>Quantidade</th>
                                        <th>Valor</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.row -->
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-10">
                            <div class="donut"></div>
                        </div>
                    </div>
                <?php
                        }
                        else {
                            $zero = 1;

                            echo'
                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                <i class="fa fa-info"></i>
                                <b>Aviso!</b> Somente ser&aacute impresso relat&oacute;rio v&aacute;lido.
                            </div>';
                        }

                    mysql_close($conexao);
                    unset($conexao,$charset,$sql,$res,$ret,$pyperiodo,$periodoA,$periodoB,$i);
                ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
       <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Highcharts -->
        <script src="js/highcharts.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /*  HIGHCHART */

                $(".donut").show(function() { $('.donut').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 1,
                        plotShadow: false
                    },
                    title: {
                        text: ''
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    fontFamily: 'Source Sans Pro,sans-serif',
                                    fontSize: '10px',
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Requerimentos',
                        data: [ <?php echo $donut; unset($donut); ?> ]
                    }]
                }); });
                
                /* PRINT */
                
                <?php if(isset($lin)) { ?> print(); location.href = 'relatorioRequerimento.php'; <?php } unset($lin); ?>
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
<?php
    #$html = ob_get_contents();
    #ob_end_clean();
?>