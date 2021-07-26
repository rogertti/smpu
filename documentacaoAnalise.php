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
        <!-- Smoke -->
        <link href="css/smoke.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Documenta&ccedil;&atilde;o da an&aacute;lise <span class="pull-right"><small><a class="lead" data-toggle="modal" data-target="#novo-item-documento-analise" href="#">Novo item da documenta&ccedil;&atilde;o da an&aacute;lise</a></small></span></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-body table-responsive">
                                <?php
                                    include_once('conexao.php');

                                    $sql = "SELECT iddocumentacao,descricao FROM documentacao WHERE monitor = 'O' ORDER BY descricao";
                                    $res = mysql_query($sql);
                                    $ret = mysql_num_rows($res);

                                        if($ret != 0) {
                                            $pydocumentacao = md5('iddocumentacao');

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
                                                                <a class="tt" data-toggle="modal" data-target="#edita-item-documento-analise" title="Editar o item da documenta&ccedil;&atilde;o da an&aacute;lise" href="editaDocumentacaoAnalise.php?'.$pydocumentacao.'='.$lin->iddocumentacao.'"><i class="fa fa-pencil"></i></a>
                                                                <a class="delitdcangr tt" id="del-'.$lin->iddocumentacao.'" title="Excluir o item da documenta&ccedil;&atilde;o da an&aacute;lise" href="#"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>';
                                                    }

                                                echo'
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Descri&ccedil;&atilde;o</th>
                                                        <th style="width: 30px;"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>';
                                        }
                                        else {
                                            $zero = 1;

                                            echo'<br>
                                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                                <i class="fa fa-info"></i>
                                                <b>Aviso!</b> Os itens da documenta&ccedil;&atilde;o ser&atilde;o listados aqui.
                                            </div>';
                                        }

                                    mysql_close($conexao);
                                    unset($conexao,$charset,$sql,$res,$ret,$lin,$pydocumentacao);
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="novo-item-documento-analise" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="novo-item-documento-analise">
                        <div class="modal-header">
                            <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Novo item da documenta&ccedil;&atilde;o da an&aacute;lise <small>(<i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio)</small></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="descricao"><i class="fa fa-asterisk"></i> Descri&ccedil;&atilde;o</label>
                                <input type="text" id="descricao" class="form-control" maxlength="255" title="Digite o nome do novo item" placeholder="Descri&ccedil;&atilde;o" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary btn-flat btn-submit-novo-item-documentacao">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edita-item-documento-analise" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div><!-- /.modal -->

        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Data table -->
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- Smoke -->
        <script src="js/smoke.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                /* TABLE */

                $(".table").dataTable({ "column": 4,"iDisplayLength": 25,stateSave: true });

                /* TOOLTIP */

                $(".tt").tooltip();


                /* ALERT */
                <?php if(!empty($zero)) { ?> $(".alert").show(); <?php } unset($zero); ?>
            });
        </script>
    </body>
</html>
