<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '5c'; ?>
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
        <!-- Date Range Picker -->
        <link href="css/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Data table -->
        <link href="css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Relat&oacute;rio de Requerimento <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Input addon -->
                            <div class="box box-info">
                                <div class="box-body table-responsive">
                                    <div class="form-group">
                                        <label>Per&iacute;odo</label>
                                        <div class="form input-group col-sm-4 col-md-4 col-lg-3">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <input type="text" id="periodo" class="form-control" title="Per&iacute;odo" placeholder="Per&iacute;odo" required />
                                            <!--<span class="info-here-1">
                                                <a class="repreq tt" title="Gerar relat&oacute;rio" href="#"><i class="fa fa-pie-chart"></i></a>
                                            </span>-->
                                        </div>
                                    </div>
                                    <div class="input-group col-md-3 col-lg-2">
                                        <a class="repreq btn btn-primary" href="#">Gerar</a>
                                    </div>
                                    
                                    <?php
                                        $pyperiodo = md5('periodo');
                                        
                                        if(isset($_GET[''.$pyperiodo.''])) {
                                            $periodoA = substr($_GET[''.$pyperiodo.''],0,10);
                                            $periodoAA = substr($_GET[''.$pyperiodo.''],0,10);
                                            $periodoB = substr($_GET[''.$pyperiodo.''],13);
                                            $periodoBB = substr($_GET[''.$pyperiodo.''],13);
                                            
                                            //inverter data para ano-mÍs-dia
                                            $dia = substr($periodoA,0,2);
                                            $mes = substr($periodoA,3,2);
                                            $ano = substr($periodoA,6);
                                            $periodoA = $ano."-".$mes."-".$dia;
                                            unset($dia,$mes,$ano);
                                            
                                            $dia = substr($periodoB,0,2);
                                            $mes = substr($periodoB,3,2);
                                            $ano = substr($periodoB,6);
                                            $periodoB = $ano."-".$mes."-".$dia;
                                            unset($dia,$mes,$ano);
                                            
                                            include_once('conexao.php');
                                            
                                            $sql = "SELECT requerimento.recolhimento,COUNT(*) AS soma,ROUND(SUM(protocolo.taxa),2) AS total FROM requerimento,protocolo WHERE requerimento.entrada BETWEEN '".$periodoA."' AND '".$periodoB."' AND protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.monitor = 'O' GROUP BY requerimento.recolhimento";
                                            $res = mysql_query($sql);
                                            $ret = mysql_num_rows($res);
                                            
                                                if($ret != 0) {
                                                    $donut = '';
                                                    $i = 1;
                                                    
                                                    echo'
                                                    <h3 class="lead">Entre '.$periodoAA.' e '.$periodoBB.'</h3><hr/>
                                                    
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Recolhimento</th>
                                                                <th>Quantidade</th>
                                                                <th>Valor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                            
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
                                                    
                                                        echo'
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Recolhimento</th>
                                                                <th>Quantidade</th>
                                                                <th>Valor</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    
                                                    <figure class="donut"></figure>';
                                                }
                                                else {
                                                    $zero = 1;
                                                
                                                    echo'
                                                    <br/>
                                                    <div class="alert alert-info alert-dismissable info">
                                                        <i class="fa fa-info"></i>
                                                        <b>Aviso!</b> Nenhum requerimento foi encontrado nesse intervalo de datas.
                                                    </div>'; 
                                                }
                                            
                                            mysql_close($conexao);
                                            unset($conexao,$charset,$sql,$res,$ret,$lin,$periodoAA,$periodoBB,$i);
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>   
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <div class="box-footer">
                                <a class="btn btn-primary btn-submit print-req" href="printRelatorioRequerimento.php?<?php echo $pyperiodo; ?>=<?php echo $periodoA.' - '.$periodoB; ?>">Imprimir</a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <div class="alert alert-danger alert-dismissable danger">
                                <i class="fa fa-ban"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Date Range Picker -->
        <script src="js/daterangepicker.min.js" type="text/javascript"></script>
        <!-- Data table -->
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- Highcharts -->
        <script src="js/highcharts.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".print-req").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* TABLE */
                
                $(".table").show(function() { 
                    $(".table").dataTable({ "column": 4,"iDisplayLength": 50,stateSave: true });
                    $(".print-req").show();
                });
                
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
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".info").show(); <?php } unset($zero); ?>
            });
        </script>
        <?php unset($periodoA,$periodoB,$pyperiodo); ?>
    </body>
</html>