<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    unset($_SESSION['folder']);
    $mn = '5d';
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
                    <h1>Rela&ccedil;&atilde;o dos requerimentos</h1>
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
                                        
                                        $sql = "SELECT idrequerimento,imovel_idimovel,engenheiro_idengenheiro,funcionario_idfuncionario,requerente,cpf_cnpj,telefone,email,recolhimento,alvara,entrada,hora,construcao,area,vencido,vencimento,referencia,monitor,ultimo_usuario FROM requerimento WHERE entrada >= '".date('Y-01-01')."' AND monitor = 'O' ORDER BY idrequerimento,requerente,recolhimento DESC";
                                        $res = mysql_query($sql);
                                        $ret = mysql_num_rows($res);
                                        
                                            if($ret != 0) {
                                                $pyrequerimento = md5('idrequerimento');
                                                $modal = '';
                                                
                                                echo'
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Requerente</th>
                                                            <!--<th>Funcion&aacute;rio</th>-->
                                                            <th>Recolhimento</th>
                                                            <th>Entrada</th>
                                                            <th style="width: 60px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                
                                                        while($lin = mysql_fetch_object($res)) {
                                                            //invertendo data 00/00/0000   
                                                            $ano = substr($lin->entrada,0,4);
                                                            $mes = substr($lin->entrada,5,2);
                                                            $dia = substr($lin->entrada,8);
                                                            $lin->entrada = $dia."/".$mes."/".$ano;
                                                            
                                                            //busca a inscricao
                                                            $sql2 = "SELECT imovel.inscricao FROM imovel,requerimento WHERE requerimento.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$lin->imovel_idimovel."";
                                                            $res2 = mysql_query($sql2);
                                                            $ret2 = mysql_num_rows($res2);
                                                            
                                                                if($ret2 != 0) {
                                                                    $lin2 = mysql_fetch_object($res2);
                                                                    $inscricao = $lin2->inscricao;
                                                                } 
                                                                else {
                                                                    $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                                                }
                                                            
                                                            //busca o funcionario
                                                            $sql3 = "SELECT funcionario.nome FROM funcionario,requerimento WHERE requerimento.funcionario_idfuncionario = funcionario.idfuncionario AND funcionario.idfuncionario = ".$lin->funcionario_idfuncionario."";
                                                            $res3 = mysql_query($sql3);
                                                            $ret3 = mysql_num_rows($res3);
                                                            
                                                                if($ret3 != 0) {
                                                                    $lin3 = mysql_fetch_object($res3);
                                                                    $funcionario = $lin3->nome;
                                                                } 
                                                                else {
                                                                    $funcionario = 'Funcion&aacute;rio inv&aacute;lido';
                                                                }
                                                            
                                                            echo'
                                                            <tr>
                                                                <td>'.$inscricao.'</td>
                                                                <td>'.$lin->requerente.' - '.$lin->cpf_cnpj.'</td>
                                                                <!--<td>'.$funcionario.'</td>-->
                                                                <td>'.$lin->recolhimento.'</td>
                                                                <td>'.$lin->entrada.' - '.$lin->hora.' h</td>
                                                                <td>
                                                                    <a class="tt" title="Imprimir o requerimento" href="printRequerimento.php?'.$pyrequerimento.'='.$lin->idrequerimento.'"><i class="fa fa-print"></i></a>
                                                                    <a data-toggle="modal" data-target="#dados-requerimento-'.$lin->idrequerimento.'" class="tt" title="Ver os dados do requerimento" href="dadosRequerimento.php?'.$pyrequerimento.'='.$lin->idrequerimento.'"><i class="fa fa-bars"></i></a>
                                                                    <a class="tt" title="Editar os dados do requerimento" href="editaRequerimento.php?'.$pyrequerimento.'='.$lin->idrequerimento.'"><i class="fa fa-pencil"></i></a>
                                                                    <a class="delreq tt" id="del-'.$lin->idrequerimento.'" title="Excluir o requerimento" href="#"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>';
                                                            
                                                            $modal .= '
                                                            <!-- Modal dados -->
                                                            <div class="modal fade" id="dados-requerimento-'.$lin->idrequerimento.'" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content"></div>
                                                                </div>
                                                            </div>';
                                                            
                                                            unset($sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$inscricao,$funcionario);
                                                        }
                                                
                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Requerente</th>
                                                            <!--<th>Funcion&aacute;rio</th>-->
                                                            <th>Recolhimento</th>
                                                            <th>Entrada</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>';
                                            }
                                            else {
                                                $zero = 1;
                                                
                                                echo'
                                                <br/>
                                                <div class="alert alert-info alert-dismissable">
                                                    <i class="fa fa-info"></i>
                                                    <b>Aviso!</b> Nenhum requerimento foi cadastrado ainda. <a href="novoRequerimento.php">Cadastrar um requerimento</a>
                                                </div>';    
                                            }
                                        
                                        mysql_close($conexao);
                                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyrequerimento);
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
                
                $(".table").dataTable({ "column": 5,"order": [[0,'desc'],[1,'asc']],stateSave: true });
                
                /* TOOLTIP */
                
                $('.tt').tooltip();
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>