<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '8a'; $raiz = 'fiscal'; ?>
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
                    <h1>Nova notifica&ccedil;&atilde;o <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="nova-notificacao" enctype="multipart/form-data">
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
                                                        #echo'<input type="hidden" id="album" value="'.$_SESSION['folder'].'" />';
                                                        $folder = $_SESSION['folder'];
                                                    }
                                                    else {
                                                        #echo'<input type="hidden" id="album" value="'.$_SESSION['folder'].'" />';
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
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idimovel">
                                                <input type="text" id="imovel_notificacao" class="form-control" maxlength="18" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" required />
                                            </div>
                                        </div>
                                        <div class="contain">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Contribuinte</span>
                                                        <input type="text" id="contribuinte" class="form-control" title="Contribuinte" placeholder="Contribuinte" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Documento</span>
                                                        <input type="text" id="documento" class="form-control" title="Documento" placeholder="Documento" disabled />
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Notifica&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    include_once('conexao.php');

                                                    //montando o numero da notificacao
                                                    $sql = "SELECT idfiscalizacao FROM fiscalizacao ORDER BY idfiscalizacao DESC";
                                                    $res = mysql_query($sql);
                                                    $ret = mysql_num_rows($res);

                                                        if($ret == 0) {
                                                            echo'<input type="text" id="notificacao" class="form-control" maxlength="9" value="0001/'.date('Y').'" title="N&uacute;mero da notifica&ccedil;&atilde;o" placeholder="Notifica&ccedil;&atilde;o" required />';
                                                        }
                                                        else {
                                                            $lin = mysql_fetch_object($res);

                                                                switch(strlen($lin->idfiscalizacao)) {
                                                                    case 1:
                                                                        $lin->idfiscalizacao = $lin->idfiscalizacao + 1;

                                                                            if($lin->idfiscalizacao <= 9) { $lin->idfiscalizacao = "000".$lin->idfiscalizacao; }
                                                                            else { $lin->idfiscalizacao = "00".$lin->idfiscalizacao; }

                                                                        echo'<input type="text" id="notificacao" class="form-control" maxlength="9" value="'.$lin->idfiscalizacao.'/'.date('Y').'" title="N&uacute;mero da notifica&ccedil;&atilde;o" placeholder="Notifica&ccedil;&atilde;o" required />';
                                                                    break;
                                                                    case 2:
                                                                        $lin->idfiscalizacao = $lin->idfiscalizacao + 1;

                                                                            if($lin->idfiscalizacao <= 99) { $lin->idfiscalizacao = "00".$lin->idfiscalizacao; }
                                                                            else { $lin->idfiscalizacao = "0".$lin->idfiscalizacao; }

                                                                        echo'<input type="text" id="notificacao" class="form-control" maxlength="9" value="'.$lin->idfiscalizacao.'/'.date('Y').'" title="N&uacute;mero da notifica&ccedil;&atilde;o" placeholder="Notifica&ccedil;&atilde;o" required />';
                                                                    break;
                                                                    case 3:
                                                                        $lin->idfiscalizacao = $lin->idfiscalizacao + 1;

                                                                            if($lin->idfiscalizacao <= 999) { $lin->idfiscalizacao = "0".$lin->idfiscalizacao; }

                                                                        echo'<input type="text" id="notificacao" class="form-control" maxlength="9" value="'.$lin->idfiscalizacao.'/'.date('Y').'" title="N&uacute;mero da notifica&ccedil;&atilde;o" placeholder="Notifica&ccedil;&atilde;o" required />';
                                                                    break;
                                                                    case 4:
                                                                        $lin->idfiscalizacao = $lin->idfiscalizacao + 1;

                                                                            #if($lin->idfiscalizacao <= 9999) { $lin->idfiscalizacao = "00".$lin->idfiscalizacao; }
                                                                            #else { $lin->idfiscalizacao = "Erro"; }

                                                                        echo'<input type="text" id="notificacao" class="form-control" maxlength="9" value="'.$lin->idfiscalizacao.'/'.date('Y').'" title="N&uacute;mero da notifica&ccedil;&atilde;o" placeholder="Notifica&ccedil;&atilde;o" required />';
                                                                    break;
                                                                }
                                                        }

                                                    unset($sql,$res,$ret,$lin);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Funcion&aacute;rio</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    //selecionando o usuario logado
                                                    $sql = "SELECT idfuncionario,nome FROM funcionario WHERE idfuncionario = ".base64_decode($_SESSION['id'])."";
                                                    $res = mysql_query($sql);
                                                    $ret = mysql_num_rows($res);

                                                        if($ret != 0) {
                                                            $lin = mysql_fetch_object($res);
                                                            echo'<input type="hidden" id="idfuncionario" value="'.$lin->idfuncionario.'" />
                                                            <input type="text" id="funcionario" class="form-control" value="'.$lin->nome.'" title="Funcion&aacute;rio" placeholder="Funcion&aacute;rio" disabled />';
                                                        }
                                                        else {
                                                            $disabled = 'true';
                                                            echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                        }

                                                    unset($sql,$res,$ret,$lin);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="data_notificacao" class="form-control" maxlength="10" title="Data de entrada" placeholder="Data" required />
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
                                            <label>Fiscal Respons&aacute;vel</label>
                                            <div class="input-group col-md-6 col-lg-6">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select class="form-control" id="fiscal_responsavel" title="Fiscal Respons&aacute;vel" required>
                                                    <option value="" selected>Fiscal Respons&aacute;vel</option>
                                                    <option value="Anderson Piemotez">Anderson Piemotez</option>
                                                    <option value="Mauricio Viana da Silva">Mauricio Viana da Silva</option>
                                                    <option value="Ricardo Alexandre Arag&atilde;o">Ricardo Alexandre Arag&atilde;o</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Receptor</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="receptor" class="form-control" maxlength="255" title="Nome do receptor da notifica&ccedil;&atilde;o" placeholder="Receptor" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Situa&ccedil;&atilde;o</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="situacao" rows="6" title="Situa&ccedil;&atilde;o da obra" placeholder="Situa&ccedil;&atilde;o"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Medidas</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="medida" rows="6" title="Medidas &agrave; serem tomadas" placeholder="Medidas"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Prazo</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select id="prazo" class="form-control" title="Prazo para regulariza&ccedil;&atilde;o da obra" required>
                                                    <option value="" selected>Prazo</option>
                                                    <?php
                                                        for($i = 1;$i <= 30;$i++) {
                                                            if($i == 1) {
                                                                echo'<option value="'.$i.'">'.$i.' dia</option>';
                                                            }
                                                            else {
                                                                echo'<option value="'.$i.'">'.$i.' dias</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <?php
                                            //buscando as infracoes de grau minimo
                                            $sql = "SELECT idinfracao,descricao FROM infracao WHERE nivel = 'Grau mínimo' ORDER BY descricao";
                                            $res = mysql_query($sql);
                                            $ret = mysql_num_rows($res);

                                                if($ret != 0) {
                                                    echo'
                                                    <div class="form-group"><i class="fa fa-asterisk"></i> <label for="motivo">Grau m&iacute;nimo</label></div>
                                                        <table class="table">';
                                                    
                                                            while($lin = mysql_fetch_object($res)) {
                                                                echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin->idinfracao.'"></td> <td>'.$lin->descricao.'</td></tr>';
                                                            }
                                                        
                                                        echo'</table><br/>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($sql,$res,$ret,$lin);
                                            
                                            //buscando as infracoes de grau medio
                                            $sql = "SELECT idinfracao,descricao FROM infracao WHERE nivel = 'Grau médio' ORDER BY descricao";
                                            $res = mysql_query($sql);
                                            $ret = mysql_num_rows($res);

                                                if($ret != 0) {
                                                    echo'
                                                    <div class="form-group"><i class="fa fa-asterisk"></i> <label for="motivo">Grau m&eacute;dio</label></div>
                                                        <table class="table">';
                                                    
                                                            while($lin = mysql_fetch_object($res)) {
                                                                echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin->idinfracao.'"></td> <td>'.$lin->descricao.'</td></tr>';
                                                            }
                                                        
                                                        echo'</table><br/>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($sql,$res,$ret,$lin);
                                            
                                            //buscando as infracoes de grau maximo
                                            $sql = "SELECT idinfracao,descricao FROM infracao WHERE nivel = 'Grau máximo' ORDER BY descricao";
                                            $res = mysql_query($sql);
                                            $ret = mysql_num_rows($res);

                                                if($ret != 0) {
                                                    echo'
                                                    <div class="form-group"><i class="fa fa-asterisk"></i> <label for="motivo">Grau m&aacute;ximo</label></div>
                                                        <table class="table">';
                                                    
                                                            while($lin = mysql_fetch_object($res)) {
                                                                echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin->idinfracao.'"></td> <td>'.$lin->descricao.'</td></tr>';
                                                            }
                                                        
                                                        echo'</table>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            mysql_close($conexao);
                                            unset($conexao,$charset,$sql,$res,$ret,$lin);
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
                                <div class="alert alert-warning alert-dismissable warning">
                                    <i class="fa fa-warning"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <b>Alerta!</b> Algum campo obrigat&oacute;rio n&atilde;o est&aacute; preenchido.
                                </div>
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
