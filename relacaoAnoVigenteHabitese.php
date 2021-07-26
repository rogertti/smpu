<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    unset($_SESSION['folder']);
    $mn = '9c';
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
                    <h1>Rela&ccedil;&atilde;o dos habite-ses <small class="pull-right lead response"></small></h1>
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
                                        include_once('conexao.php');
                                        
                                        $sql = "SELECT idhabitese,protocolo_idprotocolo,datado,hora,situacao,observacao,album,monitor,autentico,ultimo_usuario FROM habitese WHERE datado >= '".date('Y-01-01')."' AND monitor = 'O' ORDER BY idhabitese,situacao DESC";
                                        $res = mysql_query($sql);
                                        $ret = mysql_num_rows($res);
                                        
                                            if($ret != 0) {
                                                $pyhabitese = md5('idhabitese');
                                                
                                                echo'
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Protocolo</th>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Endere&ccedil;o</th>
                                                            <th>Requerente</th>
                                                            <th>Data</th>
                                                            <th>Situa&ccedil;&atilde;o</th>
                                                            <th style="width: 60px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                
                                                        while($lin = mysql_fetch_object($res)) {
                                                            //invertendo data 00/00/0000   
                                                            $ano = substr($lin->datado,0,4);
                                                            $mes = substr($lin->datado,5,2);
                                                            $dia = substr($lin->datado,8);
                                                            $lin->datado = $dia."/".$mes."/".$ano;
                                                            
                                                                //verificando a situacao
                                                                if($lin->situacao == 'Aprovado') {
                                                                    $lin->situacao = '<span class="label label-success">'.$lin->situacao.'</span>';
                                                                }

                                                                if($lin->situacao == 'Pendente') {
                                                                    $lin->situacao = '<span class="label label-warning">'.$lin->situacao.'</span>';
                                                                }

                                                            //buscando a inscricao, o protocolo e o requerente
                                                            $sql2 = "SELECT imovel.inscricao,imovel.endereco,imovel.apto,imovel.bairro,protocolo.codigo,requerimento.requerente FROM habitese,protocolo,requerimento,imovel WHERE habitese.protocolo_idprotocolo = protocolo.idprotocolo AND protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                                                            $res2 = mysql_query($sql2);
                                                            $ret2 = mysql_num_rows($res2);
                                                                
                                                                if($ret2 != 0) {
                                                                    $lin2 = mysql_fetch_object($res2);
                                                                    $inscricao = $lin2->inscricao;
                                                                    $protocolo = $lin2->codigo;
                                                                    $requerente = $lin2->requerente;
                                                                    $endereco = $lin2->endereco.' - '.$lin2->apto.' - '.$lin2->bairro;
                                                                }
                                                                else {
                                                                    $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                                                    $protocolo = 'Protocolo inv&aacute;lido';
                                                                    $requerente = 'Requerente inv&aacute;lido';
                                                                }
                                                            
                                                            echo'
                                                            <tr>
                                                                <td>'.$protocolo.'</td>
                                                                <td>'.$inscricao.'</td>
                                                                <td>'.$endereco.'</td>
                                                                <td>'.$requerente.'</td>
                                                                <td>'.$lin->datado.' - '.$lin->hora.' h</td>
                                                                <td>'.$lin->situacao.'</td>
                                                                <td>
                                                                    <a class="tt" title="Imprimir o habite-se" href="printHabitese.php?'.$pyhabitese.'='.$lin->idhabitese.'"><i class="fa fa-print"></i></a>
                                                                    <a data-toggle="modal" data-target="#dados-habitese-'.$lin->idhabitese.'" class="tt" title="Ver os dados do habite-se" href="dadosHabitese.php?'.$pyhabitese.'='.$lin->idhabitese.'"><i class="fa fa-bars"></i></a>
                                                                    <a class="tt" title="Editar os dados do habite-se" href="editaHabitese.php?'.$pyhabitese.'='.$lin->idhabitese.'"><i class="fa fa-pencil"></i></a>
                                                                    <a class="delhbt tt" id="del-'.$lin->idhabitese.'" title="Excluir o habite-se" href="#"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>';
                                                            
                                                            $modal .= '
                                                            <!-- Modal dados -->
                                                            <div class="modal fade" id="dados-habitese-'.$lin->idhabitese.'" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content"></div>
                                                                </div>
                                                            </div>';
                                                            
                                                            unset($sql2,$res2,$ret2,$lin2,$inscricao,$protocolo,$requerente,$ano,$mes,$dia,$endereco);
                                                        }
                                                
                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Protocolo</th>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Endere&ccedil;o</th>
                                                            <th>Requerente</th>
                                                            <th>Data</th>
                                                            <th>Situa&ccedil;&atilde;o</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>';
                                            }
                                            else {
                                                $zero = 1;
                                                
                                                echo'<br>
                                                <div class="alert alert-info alert-dismissable">
                                                    <i class="fa fa-info"></i>
                                                    <b>Aviso!</b> Nenhum habite-se foi cadastrado ainda. <a href="novoHabitese.php">Cadastrar um habite-se</a>
                                                </div>';    
                                            }
                                        
                                        mysql_close($conexao);
                                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyhabitese);
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
        <!-- Data table -->
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /* TABLE */
                
                $(".table").dataTable({ "column": 6,"order": [[0,'desc'],[1,'asc']],stateSave: true });
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* ALERT */
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>