<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = 1; ?>
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
                    <h1>Itens do habite-se <span class="pull-right"><small><a class="lead" href="novoItemHabitese.php">Novo item do habite-se</a></small></span></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-body table-responsive">
                                <?php
                                    include_once('conexao.php');

                                    $sql = "SELECT iditem_habitese,descricao,monitor FROM item_habitese WHERE monitor = 'O' ORDER BY descricao";
                                    $res = mysql_query($sql);
                                    $ret = mysql_num_rows($res);

                                        if($ret != 0) {
                                            $pyitemhabitese = md5('iditemhabitese');

                                            echo'
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Descri&ccedil;&atilde;o</th>
                                                        <th style="width: 30px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                                    while($lin = mysql_fetch_object($res)) {
                                                        echo'
                                                        <tr>
                                                            <td>'.$lin->descricao.'</td>
                                                            <td>
                                                                <a class="tt" title="Editar os dados do item do habite-se" href="editaItemHabitese.php?'.$pyitemhabitese.'='.$lin->iditem_habitese.'"><i class="fa fa-pencil"></i></a>
                                                                <a class="delithbt tt" id="del-'.$lin->iditem_habitese.'" title="Excluir o item do habite-se" href="#"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>';
                                                    }

                                                echo'
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Descri&ccedil;&atilde;o</th>
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
                                                <b>Aviso!</b> Os itens do habite-se abertos recentemente ser&atilde;o listados aqui.
                                            </div>';    
                                        }

                                    mysql_close($conexao);
                                    unset($conexao,$charset,$sql,$res,$ret,$lin,$pyitemhabitese);
                                ?>
                                </div>
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
                
                $(".table").dataTable({ "column": 2,"iDisplayLength": 25,stateSave: true });
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* COLORBOX */
                
                $(".fr").colorbox({iframe:true,width:"80%",height:"95%"});
                
                
                /* ALERT */
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
