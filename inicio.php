<?php 
    require_once('config.php');

    if(empty($_SESSION['key'])) { header('location:./'); }
    
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
                    <h1>In&iacute;cio/Rela&ccedil;&atilde;o dos protocolos <small class="pull-right lead response"></small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-body table-responsive">
                                <?php
                                    #include_once('conexao.php');

                                    #$sql = "SELECT * FROM protocolo WHERE monitor = 'O' ORDER BY idprotocolo,codigo,situacao DESC";
                                    #$sql = "SELECT * FROM protocolo WHERE codigo LIKE '%/".date('Y')."' AND monitor = 'O' ORDER BY idprotocolo,codigo,situacao DESC";
                                    $sql = "SELECT idprotocolo,requerimento_idrequerimento,codigo,taxa,situacao,observacao,monitor,autentico,ultimo_usuario FROM protocolo WHERE codigo LIKE '%/".date('Y')."' AND monitor = 'O' ORDER BY idprotocolo DESC LIMIT 300";
                                    #$sql = "CALL relacao_protocolo()";
                                    $res = mysql_query($sql);
                                    $ret = mysql_num_rows($res);
                                    
                                        if($ret != 0) {
                                            $pyprotocolo = md5('idprotocolo');
                                            $modal = '';

                                            echo'
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Protocolo</th>
                                                        <th>Inscri&ccedil;&atilde;o</th>
                                                        <th>Requerente</th>
                                                        <th>Endere&ccedil;o</th>
                                                        <th>Recolhimento</th>
                                                        <th>Situa&ccedil;&atilde;o</th>
                                                        <th style="color: #fff;">Botoesacao</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                            
                                                    while($lin = mysql_fetch_object($res)) {
                                                        //busca a inscricao e o recolhimento
                                                        $sql2 = "SELECT imovel.inscricao,requerimento.recolhimento,requerimento.requerente,requerimento.email,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.cidade,imovel.estado FROM imovel,requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
                                                        $res2 = mysql_query($sql2);
                                                        $ret2 = mysql_num_rows($res2);
                                                        
                                                            if($ret2 != 0) {
                                                                $lin2 = mysql_fetch_object($res2);
                                                                $inscricao = $lin2->inscricao;
                                                                $recolhimento = $lin2->recolhimento;
                                                                $requerente = $lin2->requerente;
                                                                #$endereco = $lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro.' - '.$lin2->cidade.' - '.$lin2->estado;
                                                                $endereco = $lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro;

                                                                    if(!empty($lin2->email)) {
                                                                        $html_email = '<a class="emlprt tt" id="eml-'.$lin->idprotocolo.'" title="Enviar o protocolo por e-mail" href="#"><i class="fa fa-envelope-o"></i></a>';
                                                                    }
                                                                    else {
                                                                        $html_email = '';
                                                                    }
                                                            } 
                                                            else {
                                                                $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                                                $recolhimento = 'Recolhimento inv&aacute;lido';
                                                                $requerente = $lin2->requerente;
                                                                $endereco = 'Endere&ccedil;o inv&aacute;lido';
                                                                $html_email = '';
                                                            }
                                                        
                                                        echo'
                                                        <tr>
                                                            <td>'.$lin->codigo.'</td>
                                                            <td>'.$inscricao.'</td>
                                                            <td>'.$requerente.'</td>
                                                            <td>'.$endereco.'</td>
                                                            <td>'.$recolhimento.'</td>
                                                            <td><span class="label label-primary">'.$lin->situacao.'</span></td>
                                                            <td>
                                                                '.$html_email.'
                                                                <a class="tt" title="Imprimir o protocolo" href="printProtocolo.php?'.$pyprotocolo.'='.$lin->idprotocolo.'"><i class="fa fa-print"></i></a>
                                                                <a data-toggle="modal" data-target="#dados-protocolo-'.$lin->idprotocolo.'" class="tt" title="Ver os dados do protocolo" href="dadosProtocolo.php?'.$pyprotocolo.'='.$lin->idprotocolo.'"><i class="fa fa-bars"></i></a>
                                                                <a class="tt" title="Editar os dados do protocolo" href="editaProtocolo.php?'.$pyprotocolo.'='.$lin->idprotocolo.'"><i class="fa fa-pencil"></i></a>
                                                                <a class="delprt tt" id="del-'.$lin->idprotocolo.'" title="Excluir o protocolo" href="#"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>';
                                                        
                                                        $modal .= '
                                                        <!-- Modal dados -->
                                                        <div class="modal fade" id="dados-protocolo-'.$lin->idprotocolo.'" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content"></div>
                                                            </div>
                                                        </div>';

                                                        unset($inscricao,$recolhimento,$requerente,$endereco,$html_email);
                                                    }

                                                echo'
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Protocolo</th>
                                                        <th>Inscri&ccedil;&atilde;o</th>
                                                        <th>Requerente</th>
                                                        <th>Endere&ccedil;o</th>
                                                        <th>Recolhimento</th>
                                                        <th>Situa&ccedil;&atilde;o</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>';
                                        }
                                        else {
                                            $zero = 1;

                                            echo'<br>
                                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                                <i class="fa fa-info"></i>
                                                <b>Aviso!</b> Os protocolos abertos recentemente neste ano ser&atilde;o listados aqui.
                                            </div>';    
                                        }

                                    mysql_close($conexao);
                                    unset($conexao,$charset,$sql,$res,$ret,$lin,$pyprotocolo);
                                ?>
                                </div>
                            </div>    
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
                
                $(".table").DataTable({
                    "column": 7,
                    "order": [[0,'desc'],[1,'asc']],
                    stateSave: true
                });
                
                /* TOOLTIP */
                
                $('.tt').tooltip();
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
