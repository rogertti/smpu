<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '9a'; $raiz = 'habitese'; ?>
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
        <!-- Upload -->
        <link href="css/plupload.min.css" rel="stylesheet" type="text/css" />
        <!-- Colorbox -->
        <link href="css/colorbox.min.css" rel="stylesheet" type="text/css" />
        <!-- Autocomplete -->
        <link href="css/autocomplete.min.css" rel="stylesheet" type="text/css" />
        <!-- Datepicker -->
        <link href="css/datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Timepicker -->
        <link href="css/timepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Novo habite-se <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="novo-habitese" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="uploader"></div>
                                        <br/>
                                        <div class="input-group col-md-12">
                                        <?php
                                            //criando o diretorio
                                            $pyfolder = md5('folder');
                                            
                                                    if(!isset($_SESSION['folder'])) {
                                                        $_SESSION['folder'] = md5(microtime());
                                                        $folder = $_SESSION['folder'];
                                                    }
                                                    else {
                                                        $folder = $_SESSION['folder'];
                                                    }

                                            //mostrando as fotos subidas
                                            $dir = ''.$raiz.'/'.$folder.'/'; 

                                                if(file_exists($dir)) { 
                                                    $pon = opendir($dir);

                                                        while ($nitens = readdir($pon)) {
                                                            $itens[] = $nitens;
                                                        }

                                                    sort($itens);

                                                        foreach ($itens as $listar) {
                                                            if ($listar != "." && $listar != "..") { 
                                                                $arquivos[] = $listar; 
                                                            }
                                                        }

                                                        if (!empty($arquivos)) {
                                                            echo'<div class="thumb">';  

                                                                foreach($arquivos as $listar) {
                                                                    if (strstr($listar,'tb-')) {
                                                                        $opt = substr($listar,3);
                                                                        print'
                                                                        <div class="col-md-3 thumbnail">
                                                                            <a class="multi" href="'.$dir.''.$opt.'">
                                                                                <img src="'.$dir.''.$listar.'">
                                                                            </a>
                                                                            <div class="caption">
                                                                                <a class="delphoto tt" id="del-'.$dir.''.$opt.'" title="Excluir foto" href="#">
                                                                                    <i class="fa fa-trash-o"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>';
                                                                    }
                                                                }

                                                            echo'</div>';
                                                        }

                                                    unset($pon,$nitens,$itens,$listar,$pastas,$n,$arquivos);
                                                }
                                        ?>
                                        </div>
                                        
                                        <input type="hidden" id="album" value="<?php echo $folder; ?>">
                                        <input type="hidden" id="autentico" value="<?php echo md5(microtime()); ?>">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        
                                        <div class="form-group">
                                            <label>Protocolo</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idprotocolo">
                                                <input type="text" id="protocolo_habitese" class="form-control" maxlength="9" title="Protocolo" placeholder="Protocolo" required />
                                            </div>
                                        </div>
                                        <div class="contain">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Inscri&ccedil;&atilde;o</span>
                                                        <input type="text" id="inscricao_habitese" class="form-control" title="Inscri&ccedil;&atilde;o" placeholder="Inscri&ccedil;&atilde;o" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Propriet&aacute;rio</span>
                                                        <input type="text" id="contribuinte" class="form-control" title="Propriet&aacute;rio" placeholder="Propriet&aacute;rio" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Requerente</span>
                                                        <input type="text" id="requerente" class="form-control" title="Requerente" placeholder="Requerente" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Tipo de obra</span>
                                                        <input type="text" id="construcao" class="form-control" title="Tipo de obra" placeholder="Tipo de obra" disabled />
                                                    </div>    
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Endere&ccedil;o</span>
                                                        <input type="text" id="endereco" class="form-control" title="Endere&ccedil;o" placeholder="Endere&ccedil;o" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Lote</span>
                                                        <input type="text" id="lote" class="form-control" title="Lote" placeholder="Lote" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Quadra</span>
                                                        <input type="text" id="quadra" class="form-control" title="Quadra" placeholder="Quadra" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Loteamento</span>
                                                        <input type="text" id="loteamento" class="form-control" title="Loteamento" placeholder="Loteamento" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">&Aacute;rea</span>
                                                        <input type="text" id="area" class="form-control" title="&Aacute;rea" placeholder="&Aacute;rea" disabled />
                                                    </div>
                                                    <br>    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="datado" class="form-control" value="<?php echo date("d/m/Y"); ?>" maxlength="10" title="Data" placeholder="Data" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hora</label>
                                            <div class="input-group col-md-4 col-lg-3 bootstrap-timepicker">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="hora" class="form-control" maxlength="5" title="Hora de entrada" placeholder="Hora" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Observa&ccedil;&atilde;o</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="observacao" rows="6" title="Observa&ccedil;&atilde;o" placeholder="Observa&ccedil;&atilde;o"></textarea>
                                            </div>
                                        </div>
                                        <div class="input-group col-md-8 col-lg-6">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <table class="table">
                                                <tr>
                                                    <td><input type="radio" name="situacao" value="Pendente" required> Pendente</td>
                                                    <td><input type="radio" name="situacao" value="Aprovado" required> Aprovado</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                    <?php
                                        include_once('conexao.php');
                                        
                                        //buscando os itens do habite-se
                                        $sql = "SELECT iditem_habitese,descricao FROM item_habitese WHERE monitor = 'O' ORDER BY descricao";
                                        $res = mysql_query($sql);
                                        $ret = mysql_num_rows($res);

                                            if($ret != 0) {
                                                echo'
                                                <!--<input type="hidden" id="itens" value="'.$ret.'">-->
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sim</th>
                                                            <th>N&atilde;o</th>
                                                            <th>N&atilde;o se aplica</th>
                                                            <th>Descri&ccedil;&atilde;o</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                        while($lin = mysql_fetch_object($res)) {
                                                            echo'
                                                            <tr>
                                                                <td><input type="radio" name="item'.$lin->iditem_habitese.'" value="Sim" required></td>
                                                                <td><input type="radio" name="item'.$lin->iditem_habitese.'" value="N&atilde;o" required></td>
                                                                <td><input type="radio" name="item'.$lin->iditem_habitese.'" value="N&atilde;o se aplica" required></td>
                                                                <td>'.$lin->descricao.'</td>
                                                            </tr>';
                                                        }

                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Sim</th>
                                                            <th>N&atilde;o</th>
                                                            <th>N&atilde;o se aplica</th>
                                                            <th>Descri&ccedil;&atilde;o</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>';
                                            }
                                            else {
                                                $disabled = 'true';
                                                echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                            }
                                        
                                        mysql_close($conexao);
                                        unset($conexao,$charset,$sql,$res,$ret,$lin,$i);
                                    ?>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-submit">Salvar</button>
                                    <button type="reset" class="btn btn-default">Limpar</button>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="alert alert-danger alert-dismissable danger">
                                    <i class="fa fa-ban"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                                <div class="alert alert-success alert-dismissable success">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                            </div>
                        </div>
                    </form> 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Upload -->
        <script src="js/plupload.min.js"></script>
        <script src="js/pluploadQueue.min.js"></script>
        <!-- Colorbox -->
        <script src="js/colorbox.min.js" type="text/javascript"></script>
        <!-- Autocomplete -->
        <script src="js/autocomplete.min.js" type="text/javascript"></script>
        <!-- Masked -->
        <script src="js/masked.min.js" type="text/javascript"></script>
        <!-- Datepicker -->
        <script src="js/datepicker.min.js" type="text/javascript"></script>
        <!-- Timepicker -->
        <script src="js/timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".contain").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* UPLOAD */
                $(".uploader").pluploadQueue({
                    // General settings
                    runtimes : 'html5',
                    url : 'upload.php?<?php echo $pyfolder; ?>=<?php echo $folder; ?>&raiz=<?php echo $raiz; ?>',
                    max_file_size : '10mb',
                    chunk_size : '1mb',
                    unique_names : true,

                    // Resize images on clientside if we can
                    resize : {width : 800, height : 600, quality : 70},

                    // Specify what files to browse for
                    filters : [
                       {title : "Image files", extensions : "jpg,gif,png"},
                       {title : "Zip files", extensions : "zip"}
                    ],

                    init : {
                        UploadComplete: function(up, file, info) {
                            setTimeout(1000);
                            window.location.reload();
                        }
                    }
                });

                /* COLORBOX */

                $(".multi").colorbox({rel:"multi",transition:"fade"});

                /* LINK */

                //$(".goindex").click(function(){ location.href = 'inicio.php'; });
                //$(".gohere").click(function(){ location.reload(); });

                /* EXCLUIR FOTO */

                /*$(".delphoto").click(function() {
                    $.ajax({
                        url: "deleteFoto.php?<?php echo $pyfolder; ?>=<?php echo $dir.$opt; ?>&raiz=<?php echo $raiz; ?>",
                        cache: false
                    })

                    .done(function() { location.reload(); });
                });*/
                
                $(".delphoto").click(function(){
                    var click = this.id.split('-');
                    var id = click[1];

                        if(confirm('Excluir a foto?')) {
                            $.ajax({
                                url: "deleteFoto.php?<?php echo $pyfolder; ?>="+id+"&raiz=<?php echo $raiz; ?>",
                                cache: false
                            })
                            .done(function() { location.reload(); });
                        }

                    return true;
                });
            });
        </script>
        <?php
            if(!empty($disabled)) { echo'<script>$("input,select,textarea").prop("disabled",true);</script>'; unset($disabled); }
        ?>
    </body>
</html>
