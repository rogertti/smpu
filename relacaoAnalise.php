<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    unset($_SESSION['folder']);
    $mn = '7b';

    $getmes = md5('mes');
    $getano = md5('ano');

        if(isset($_GET[''.$getmes.''])) {
            $mes = $_GET[''.$getmes.''];
        } else {
            $mes = date('m');
        }

        if(isset($_GET['left'])) {
            if($mes == '12') {
                $ano = $_GET[''.$getano.''] - 1;
            } else {
                $ano = $_GET[''.$getano.''];
            }
        }

        if(isset($_GET['right'])) {
            if($mes == '01') {
                $ano = $_GET[''.$getano.''] + 1;
            } else {
                $ano = $_GET[''.$getano.''];
            }
        }

        if(isset($_GET['pick'])) {
            $ano = $_GET[''.$getano.''];
        }

        if ((!isset($_GET['left'])) and (!isset($_GET['right'])) and (!isset($_GET['pick']))) {
            $ano = date('Y');
        }
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
        <!-- Date Picker -->
        <link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Rela&ccedil;&atilde;o das an&aacute;lises <small class="pull-right lead response"></small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <!--<div class="box-header">
                                    <h3 class="box-title">Rela&ccedil;&atilde;o dos contribuintes</h3>                                    
                                </div>-->
                                <div class="box-body table-responsive">
                                    <?php
                                        function mes_extenso ($fmes) {
                                            switch ($fmes) {
                                                case '01': $fmes = 'Janeiro'; break;
                                                case '02': $fmes = 'Fevereiro'; break;
                                                case '03': $fmes = 'Mar&ccedil;o'; break;
                                                case '04': $fmes = 'Abril'; break;
                                                case '05': $fmes = 'Maio'; break;
                                                case '06': $fmes = 'Junho'; break;
                                                case '07': $fmes = 'Julho'; break;
                                                case '08': $fmes = 'Agosto'; break;
                                                case '09': $fmes = 'Setembro'; break;
                                                case '10': $fmes = 'Outubro'; break;
                                                case '11': $fmes = 'Novembro'; break;
                                                case '12': $fmes = 'Dezembro'; break;
                                            }
            
                                            return $fmes;
                                        }
                                        
                                        $mesleft = $mes - 1;
                                        $mesright = $mes + 1;
            
                                            if(strlen($mesleft) == 1) {
                                                $mesleft = '0'.$mesleft;
            
                                                    if($mesleft == '00') {
                                                        $mesleft = '12';
                                                    }
                                            }
            
                                            if(strlen($mesright) == 1) {
                                                $mesright = '0'.$mesright;
            
                                                    if($mesright == '13') {
                                                        $mesright = '01';
                                                    }
                                            } else {
                                                if($mesright == '13') {
                                                    $mesright = '01';
                                                }
                                            }

                                        echo'
                                        <div class="div-time">
                                            <div class="div-time-left text-center">
                                                <a class="lead" href="relacaoAnalise.php?'.$getmes.'='.$mesleft.'&'.$getano.'='.$ano.'&left=1" title="M&ecirc;s anterior">
                                                    <i class="fa fa-arrow-left"></i>
                                                </a>
                                            </div>
                                            <div class="div-time-center">
                                                <p class="lead text-center">
                                                    <!--<span class="text-bold text-uppercase">'.mes_extenso($mes).' de '.$ano.'</span>-->
                                                    <input type="text" class="date-pick text-center" value="'.mes_extenso($mes).' de '.$ano.'" readonly>
                                                </p>
                                            </div>
                                            <div class="div-time-right text-center">
                                                <a class="lead" href="relacaoAnalise.php?'.$getmes.'='.$mesright.'&'.$getano.'='.$ano.'&right=1" title="Pr&oacute;ximo m&ecirc;s">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <hr>';

                                        include_once('conexao.php');
                                        
                                        #$sql = "SELECT idanalise,protocolo_idprotocolo,situacao,responsavel,art_rrt,arquitetonico,hidrosanitario,parecer,monitor,autentico,ultimo_usuario,datado FROM analise WHERE monitor = 'O' ORDER BY idanalise,situacao DESC";
                                        $sql = "SELECT idanalise,protocolo_idprotocolo,situacao,responsavel,art_rrt,arquitetonico,hidrosanitario,parecer,monitor,autentico,ultimo_usuario,datado FROM analise WHERE datado LIKE '".$ano."-".$mes."%' AND monitor = 'O' ORDER BY idanalise,situacao DESC";
                                        $res = mysql_query($sql);
                                        $ret = mysql_num_rows($res);
                                        
                                            if($ret != 0) {
                                                $pyanalise = md5('idanalise');
                                                $modal = '';
                                                
                                                echo'
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Protocolo</th>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Requerente</th>
                                                            <th>Data</th>
                                                            <th>Situa&ccedil;&atilde;o</th>
                                                            <th>ART/RRT</th>
                                                            <th>Parecer</th>
                                                            <th style="width: 80px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                
                                                        while($lin = mysql_fetch_object($res)) {
                                                            if(!empty($lin->datado)) {
                                                                //invertendo a data 00/00/0000
                                                                $ano = substr($lin->datado,0,4);
                                                                $mes = substr($lin->datado,5,2);
                                                                $dia = substr($lin->datado,8);
                                                                $lin->datado = $dia."/".$mes."/".$ano;
                                                            }
                                                            
                                                            //verificando a situacao
                                                            if($lin->parecer == 'Aprovado') {
                                                                #$lin->parecer = '<span class="label label-success">'.$lin->parecer.'</span>';
                                                                $lin->parecer = '<span class="label label-success">Analisado</span>';
                                                            }

                                                            if($lin->parecer == 'Analisado') {
                                                                $lin->parecer = '<span class="label label-success">'.$lin->parecer.'</span>';
                                                            }
                                                            
                                                            if($lin->parecer == 'Com pendências') {
                                                                #$lin[7] = '<span class="label label-warning">'.$lin[7].'</span>';
                                                                $lin->parecer = '<span class="label label-warning">Pendente</span>';
                                                            }
                                                            
                                                            //buscando a inscricao, o protocolo e o requerente
                                                            $sql2 = "SELECT imovel.inscricao,protocolo.codigo,requerimento.requerente,requerimento.email FROM analise,protocolo,requerimento,imovel WHERE analise.protocolo_idprotocolo = protocolo.idprotocolo AND protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                                                            $res2 = mysql_query($sql2);
                                                            $ret2 = mysql_num_rows($res2);
                                                                
                                                                if($ret2 != 0) {
                                                                    $lin2 = mysql_fetch_object($res2);
                                                                    $inscricao = $lin2->inscricao;
                                                                    $protocolo = $lin2->codigo;
                                                                    $requerente = $lin2->requerente;

                                                                        if(!empty($lin2->email)) {
                                                                            $html_email = '<a class="emlans tt" id="eml-'.$lin->idanalise.'" title="Enviar a an&aacute;lise por e-mail" href="#"><i class="fa fa-envelope-o"></i></a>';
                                                                        }
                                                                        else {
                                                                            $html_email = '';
                                                                        }
                                                                }
                                                                else {
                                                                    $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                                                    $protocolo = 'Protocolo inv&aacute;lido';
                                                                    $requerente = 'Requerente inv&aacute;lido';
                                                                    $html_email = '';
                                                                }
                                                            
                                                            echo'
                                                            <tr>
                                                                <td>'.$protocolo.'</td>
                                                                <td>'.$inscricao.'</td>
                                                                <td>'.$requerente.'</td>
                                                                <td>'.$lin->datado.'</td>
                                                                <td>'.$lin->situacao.'</td>
                                                                <td>'.$lin->art_rrt.'</td>
                                                                <td>'.$lin->parecer.'</td>
                                                                <td>
                                                                    '.$html_email.'
                                                                    <a class="tt" title="Imprimir a an&aacute;lise" href="printAnalise.php?'.$pyanalise.'='.$lin->idanalise.'"><i class="fa fa-print"></i></a>
                                                                    <a data-toggle="modal" data-target="#dados-analise-'.$lin->idanalise.'" class="tt" title="Ver os dados da an&aacute;lise" href="dadosAnalise.php?'.$pyanalise.'='.$lin->idanalise.'"><i class="fa fa-bars"></i></a>
                                                                    <a class="tt" title="Editar os dados da an&aacute;lise" href="editaAnalise.php?'.$pyanalise.'='.$lin->idanalise.'"><i class="fa fa-pencil"></i></a>
                                                                    <a class="delans tt" id="del-'.$lin->idanalise.'" title="Excluir a an&aacute;lise" href="#"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>';
                                                            
                                                            $modal .= '
                                                            <!-- Modal dados -->
                                                            <div class="modal fade" id="dados-analise-'.$lin->idanalise.'" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content"></div>
                                                                </div>
                                                            </div>';
                                                            
                                                            unset($sql2,$res2,$ret2,$lin2,$inscricao,$protocolo,$requerente,$ano,$mes,$dia,$html_email);
                                                        }
                                                
                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Protocolo</th>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Requerente</th>
                                                            <th>Data</th>
                                                            <th>Situa&ccedil;&atilde;o</th>
                                                            <th>ART/RRT</th>
                                                            <th>Parecer</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>';
                                            }
                                            else {
                                                $zero = 1;
                                                $modal = '';
                                                
                                                echo'<br>
                                                <div class="alert alert-info alert-dismissable">
                                                    <i class="fa fa-info"></i>
                                                    <b>Aviso!</b> Nenhuma an&aacute;lise foi cadastrada ainda. <a href="novaAnalise.php">Cadastrar uma an&aacute;lise</a>
                                                </div>';    
                                            }
                                        
                                        mysql_close($conexao);
                                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyanalise);
                                    ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                    <?php echo $modal; unset($modal); ?> 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Date Picker -->
        <script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
        <!-- Data table -->
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /* DATEPICKER */

                $(".date-pick").datepicker({
                    language: 'pt-BR',
                    format: "mm yyyy",
                    startView: 1,
                    minViewMode: 1
                }).on('hide', function(e) {
                    var dt = e.target.value.split(' ');
                    location.href = "relacaoAnalise.php?<?php echo $getmes; ?>=" + dt[0] + "&<?php echo $getano; ?>=" + dt[1] + "&pick=1";
                });

                /* TABLE */
                
                $(".table").dataTable({ "column": 8,"order": [[0,'desc'],[1,'asc']],stateSave: true });
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* ALERT */
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
