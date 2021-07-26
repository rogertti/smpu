<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    unset($_SESSION['folder']);
    $mn = '2b';
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
                    <h1>Rela&ccedil;&atilde;o dos im&oacute;veis</h1>
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
                                        
                                        $sql = "SELECT idimovel,contribuinte_idcontribuinte,inscricao,matricula,cep,endereco,apto,complemento,edificio_condominio,bairro,cidade,estado,tipo_obra,garagem,lote,quadra,loteamento,fracao,area_lote,area_unidade,area_anexo,area_englobada,area_construida,habitese,testada,alvara,monitor FROM imovel WHERE monitor = 'O' ORDER BY idimovel,inscricao,matricula DESC LIMIT 300";
                                        $res = mysql_query($sql);
                                        $ret = mysql_num_rows($res);
                                        
                                            if($ret != 0) {
                                                $pyimovel = md5('idimovel');
                                                $modal = '';
                                                
                                                echo'
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Matr&iacute;cula</th>
                                                            <th>Contribuinte</th>
                                                            <th>Lote</th>
                                                            <th>Quadra</th>
                                                            <th style="width: 45px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                
                                                        while($lin = mysql_fetch_object($res)) {
                                                            //busca o nome do contribuintes
                                                            $sql2 = "SELECT contribuinte.nome FROM contribuinte,imovel WHERE imovel.contribuinte_idcontribuinte = contribuinte.idcontribuinte AND contribuinte.idcontribuinte = ".$lin->contribuinte_idcontribuinte."";
                                                            $res2 = mysql_query($sql2);
                                                            $ret2 = mysql_num_rows($res2);
                                                            
                                                                if($ret2 != 0) {
                                                                    $lin2 = mysql_fetch_object($res2);
                                                                    $contribuinte = $lin2->nome;
                                                                } 
                                                                else {
                                                                    $contribuinte = 'Contribuinte inv&aacute;lido';
                                                                }
                                                            
                                                            //verificando se o imóvel possui fiscalização
                                                            /*$sql3 = "SELECT idfiscalizacao FROM fiscalizacao WHERE imovel_idimovel = ".$lin[0]."";
                                                            $res3 = mysql_query($sql3);
                                                            $ret3 = mysql_num_rows($res3);
                                                            
                                                                if($ret3 != 0) {
                                                                    $fiscalizacao = '<a class="tt" title="Ver as fiscaliza&ccedil;&otilde;es do im&oacute;vel" href="dadosFiscalizacaoImovel.php?'.$pyimovel.'='.$lin[0].'"><i class="fa fa-shield"></i></a>';
                                                                }
                                                                else {
                                                                    $fiscalizacao = '';
                                                                }*/ 
                                                            
                                                            echo'
                                                            <tr>
                                                                <td>'.$lin->inscricao.'</td>
                                                                <td>'.$lin->matricula.'</td>
                                                                <td>'.$contribuinte.'</td>
                                                                <td>'.$lin->lote.'</td>
                                                                <td>'.$lin->quadra.'</td>
                                                                <td>
                                                                    <a data-toggle="modal" data-target="#dados-imovel-'.$lin->idimovel.'" class="tt" title="Ver os dados do im&oacute;vel" href="dadosImovel.php?'.$pyimovel.'='.$lin->idimovel.'"><i class="fa fa-bars"></i></a>
                                                                    <a class="tt" title="Editar os dados do im&oacute;vel" href="editaImovel.php?'.$pyimovel.'='.$lin->idimovel.'"><i class="fa fa-pencil"></i></a>
                                                                    <a class="delimv tt" id="del-'.$lin->idimovel.'" title="Excluir o im&oacute;vel" href="#"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>';
                                                            
                                                            $modal .= '
                                                            <!-- Modal dados -->
                                                            <div class="modal fade" id="dados-imovel-'.$lin->idimovel.'" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content"></div>
                                                                </div>
                                                            </div>';
                                                            
                                                            unset($sql2,$res2,$ret2,$lin2,$contribuinte,$fiscalizacao);
                                                        }
                                                
                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Inscri&ccedil;&atilde;o</th>
                                                            <th>Matr&iacute;cula</th>
                                                            <th>Contribuinte</th>
                                                            <th>Lote</th>
                                                            <th>Quadra</th>
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
                                                    <b>Aviso!</b> Nenhum im&oacute;vel foi cadastrado ainda. <a href="novoImovel.php">Cadastrar um im&oacute;vel</a>
                                                </div>';    
                                            }
                                        
                                        mysql_close($conexao);
                                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyimovel);
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
                
                $(".table").dataTable({ "column": 6,"order": [[0,'desc'],[2,'asc']],stateSave: true });
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* ALERT */
                
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>