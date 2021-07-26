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
        <style>.alert {display: block;}</style>

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
                    <h1>Timbrado <span class="pull-right"><small><a class="lead" data-toggle="modal" data-target="#novo-timbrado" href="#"><i class="fa fa-file-text"></i> Novo documento timbrado</a></small></span></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-body table-responsive">
                                <?php
                                    include_once('conexao.php');

                                    $sql = "SELECT idtimbrado,tipo_timbrado_idtipo_timbrado,protocolo,SUBSTR(texto, 1, 100) AS texto,autentico FROM timbrado WHERE monitor = 'O' ORDER BY protocolo";
                                    $res = mysql_query($sql);
                                    $ret = mysql_num_rows($res);

                                        if($ret != 0) {
                                            $py = md5('idtimbrado');

                                            echo'
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Protocolo</th>
                                                        <th>Tipo</th>
                                                        <th>Texto</th>
                                                        <th style="width: 50px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                                    while($lin = mysql_fetch_object($res)) {
                                                        $sql2 = "SELECT tipo_timbrado.descricao FROM tipo_timbrado,timbrado WHERE tipo_timbrado.idtipo_timbrado = timbrado.tipo_timbrado_idtipo_timbrado AND timbrado.tipo_timbrado_idtipo_timbrado = ".$lin->tipo_timbrado_idtipo_timbrado."";
                                                        $res2 = mysql_query($sql2);
                                                        $ret2 = mysql_num_rows($res2);

                                                            if($ret > 0) {
                                                                $lin2 = mysql_fetch_object($res2);
                                                                $tipo = $lin2->descricao;
                                                                unset($lin2);
                                                            }

                                                        echo'
                                                        <tr>
                                                            <td>'.$lin->protocolo.'</td>
                                                            <td>'.$tipo.'</td>
                                                            <td>'.$lin->texto.'...</td>
                                                            <td>
                                                                <a class="tt" title="Imprimir o documento timbrado" href="printTimbrado.php?'.$py.'='.$lin->idtimbrado.'"><i class="fa fa-print"></i></a>
                                                                <a class="tt" data-toggle="modal" data-target="#edita-timbrado" title="Editar o documento timbrado" href="editaTimbrado.php?'.$py.'='.$lin->idtimbrado.'"><i class="fa fa-pencil"></i></a>
                                                                <a class="deltimbre tt" id="del-'.$lin->idtimbrado.'" title="Excluir o documento timbrado" href="#"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>';

                                                        unset($sql2,$res2,$ret2,$tipo);
                                                    }

                                                echo'
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Protocolo</th>
                                                        <th>Tipo</th>
                                                        <th>Texto</th>
                                                        <th style="width: 50px;"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>';
                                        }
                                        else {
                                            $zero = 1;

                                            echo'<br>
                                            <div class="alert alert-info alert-dismissable" style="display: block;">
                                                <i class="fa fa-info"></i>
                                                <b>Aviso!</b> Os documentos timbrados ser&atilde;o listados aqui.
                                            </div>';
                                        }

                                    #mysql_close($conexao);
                                    unset($sql,$res,$ret,$lin,$py);
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="novo-timbrado" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="novo-timbrado">
                        <div class="modal-header">
                            <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Novo documento timbrado <small>(<i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio)</small></h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="autentico" value="<?php echo md5(microtime()); ?>">
                            <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">

                            <div class="form-group">
                                <label for="protocolo"><i class="fa fa-asterisk"></i> Protocolo</label>
                                <div class="input-group col-md-2">
                                <?php
                                    $sql = "SELECT idtimbrado,protocolo FROM timbrado ORDER BY idtimbrado DESC LIMIT 0,1";
                                    $res = mysql_query($sql);
                                    $ret = mysql_num_rows($res);

                                        if($ret == 0) {
                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="0001/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>';
                                        }
                                        else {
                                            $lin = mysql_fetch_object($res);

                                            //QUEBRAMOS O CODIGO NA BARRA PARA DEPURAR O ANO
                                            $array_codigo = explode('/', $lin->protocolo);
                                            $array_codigo[0] = $array_codigo[0] + 1;

                                                //SE O ANO CADASTRADO FOR IGUAL AO ATUAL MONTA AS SEQUENCIAS ABAIXO
                                                if($array_codigo[1] == date('Y')) {
                                                    switch(strlen($array_codigo[0])) {
                                                        case 1:
                                                            if($array_codigo[0] <= 9) { $array_codigo[0] = "000".$array_codigo[0]; }
                                                            else { $array_codigo[0] = "00".$array_codigo[0]; }
                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>';
                                                        break;
                                                        case 2:
                                                            if($array_codigo[0] <= 99) { $array_codigo[0] = "00".$array_codigo[0]; }
                                                            else { $array_codigo[0] = "0".$array_codigo[0]; }
                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>';
                                                        break;
                                                        case 3:
                                                            if($array_codigo[0] <= 999) { $array_codigo[0] = "0".$array_codigo[0]; }
                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>';
                                                        break;
                                                        case 4:
                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>';
                                                        break;
                                                    }
                                                }
                                                //SENAO ZERA O CONTADOR
                                                else {
                                                    echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="0001/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>';
                                                }

                                            unset($lin,$array_codigo);
                                        }

                                    unset($sql,$res,$ret);
                                ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tipo"><i class="fa fa-asterisk"></i> Tipo</label>
                                <div class="input-group col-md-4">
                                    <select id="tipo" class="form-control" title="Tipo de documento" required>
                                        <option value="" selected>Tipo</option>
                                        <?php
                                            $sql = "SELECT idtipo_timbrado,descricao FROM tipo_timbrado WHERE monitor = 'O' ORDER BY descricao";
                                            $res = mysql_query($sql);
                                            $ret = mysql_num_rows($res);

                                                if($ret > 0) {
                                                    while($lin = mysql_fetch_object($res)) {
                                                        echo'<option value="'.$lin->idtipo_timbrado.'">'.$lin->descricao.'</option>';
                                                    }

                                                    unset($lin);
                                                }

                                            unset($sql,$res,$ret);
                                        ?>
                                    </select>
                                    <span class="input-group-addon">
                                        <a data-toggle="modal" data-target="#novo-tipo" href="#"><i class="fa fa-plus fa-fw"></i></a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="texto"><i class="fa fa-asterisk"></i> Texto</label>
                                <textarea class="form-control" id="texto" rows="10" title="Texto do documento timbrado" placeholder="Texto" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary btn-flat btn-submit-novo-timbrado">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="novo-tipo" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="novo-tipo-timbrado">
                        <div class="modal-header">
                            <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Novo tipo de documento timbrado <small>(<i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio)</small></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="descricao"><i class="fa fa-asterisk"></i> Descri&ccedil;&atilde;o</label>
                                <input type="text" id="descricao" class="form-control" maxlength="255" title="Digite o nome do novo item" placeholder="Descri&ccedil;&atilde;o" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary btn-flat btn-submit-novo-tipo-timbrado">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edita-timbrado" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"></div>
            </div>
        </div><!-- /.modal -->

        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- WYSIHTML5 -->
        <script src="ckeditor/ckeditor.js"></script>
        <!-- Data table -->
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- Smoke -->
        <script src="js/smoke.min.js" type="text/javascript"></script>
        <!-- Mask -->
        <script src="js/masked.min.js" type="text/javascript"></script>
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

            /* CKEDITOR */

            if (CKEDITOR.env.ie && CKEDITOR.env.version < 9) {
                CKEDITOR.tools.enableHtml5Elements(document);
            }

            var initEditor = (function () {
                function isWysiwygareaAvailable() {
                    // If in development mode, then the wysiwygarea must be available.
                    // Split REV into two strings so builder does not replace it :D.
                    if (CKEDITOR.revision === ('%RE' + 'V%')) {
                        return true;
                    }

                    return !!CKEDITOR.plugins.get('wysiwygarea');
                }

                var wysiwygareaAvailable = isWysiwygareaAvailable(), isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

                return function () {
                    var editorElement = CKEDITOR.document.getById('texto');

                    // :(((
                    if (isBBCodeBuiltIn) {
                        editorElement.setHtml(
                            'Hello world!\n\n' + 'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
                        );
                    }

                    // Depending on the wysiwygare plugin availability initialize classic or inline editor.
                    if (wysiwygareaAvailable) {
                        CKEDITOR.replace('texto', {height: '600px'});
                    } else {
                        editorElement.setAttribute('contenteditable', 'true');
                        CKEDITOR.inline('texto');

                        // TODO we can consider displaying some info box that
                        // without wysiwygarea the classic editor may not work.
                    }
                };
            }());

            initEditor();
        </script>
    </body>
</html>
<?php unset($conexao,$charset); ?>
