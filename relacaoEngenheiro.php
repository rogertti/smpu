<?php 
    require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); }
    unset($_SESSION['folder']);
    $mn = '3b';
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
                    <h1>Rela&ccedil;&atilde;o dos arquitetos/engenheiros</h1>
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
                                        
                                        $sql = "SELECT idengenheiro,cau_crea,nome,usuario,senha,telefone,email,monitor FROM engenheiro WHERE monitor = 'O' ORDER BY nome";
                                        $res = mysql_query($sql);
                                        $ret = mysql_num_rows($res);
                                        
                                            if($ret != 0) {
                                                $pyengenheiro = md5('idengenheiro');
                                                
                                                echo'
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>CAU/CREA</th>
                                                            <th>Nome</th>
                                                            <th>Telefone</th>
                                                            <th>E-mail</th>
                                                            <th style="width: 30px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                                
                                                        while($lin = mysql_fetch_object($res)) {
                                                            if(strlen($lin->cau_crea) >= 8) { $tipo = 'Arquiteto'; }
                                                            if(strlen($lin->cau_crea) <= 7) { $tipo = 'Engenheiro'; }
                                                            
                                                            echo'
                                                            <tr>
                                                                <td>'.$tipo.'</td>
                                                                <td>'.$lin->cau_crea.'</td>
                                                                <td>'.$lin->nome.'</td>
                                                                <td>'.$lin->telefone.'</td>
                                                                <td>'.$lin->email.'</td>
                                                                <td>
                                                                    <a class="tt" title="Editar os dados do engenheiro" href="editaEngenheiro.php?'.$pyengenheiro.'='.$lin->idengenheiro.'"><i class="fa fa-pencil"></i></a>
                                                                    <a class="deleng tt" id="del-'.$lin->idengenheiro.'" title="Excluir o engenheiro" href="#"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>';
                                                        }
                                                
                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>CAU/CREA</th>
                                                            <th>Nome</th>
                                                            <th>Telefone</th>
                                                            <th>E-mail</th>
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
                                                    <b>Aviso!</b> Nenhum engenheiro/arquiteto foi cadastrado ainda. <a href="novoEngenheiro.php">Cadastrar um engenheiro</a>
                                                </div>';    
                                            }
                                        
                                        mysql_close($conexao);
                                        unset($conexao,$charset,$sql,$res,$ret,$lin,$tipo);
                                    ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /* TABLE */
                
                $(".table").dataTable({ "column": 6,"order": [[2,'asc']],stateSave: true });
                
                /* TOOLTIP */
                
                $('.tt').tooltip();
                
                /* ALERT */
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
