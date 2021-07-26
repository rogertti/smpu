<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '8b'; $raiz = 'fiscal'; ?>
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
                    <h1>Edita embargo <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyembargo = md5('idembargo');
                                            
                        $sql = "SELECT * FROM embargo WHERE idembargo = ".$_GET[''.$pyembargo.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                                
                                //invertendo a data 00/00/0000
                                $ano = substr($lin->datado,0,4);
                                $mes = substr($lin->datado,5,2);
                                $dia = substr($lin->datado,8);
                                $lin->datado = $dia."/".$mes."/".$ano;
                                
                                //selecionando dados da fiscalizacao
                                $sql3 = "SELECT fiscalizacao.notificacao,fiscalizacao.imovel_idimovel,fiscalizacao.funcionario_idfuncionario,fiscalizacao.album FROM embargo,fiscalizacao WHERE embargo.fiscalizacao_idfiscalizacao = fiscalizacao.idfiscalizacao AND fiscalizacao.idfiscalizacao = ".$lin->fiscalizacao_idfiscalizacao."";
                                $res3 = mysql_query($sql3);
                                $ret3 = mysql_num_rows($res3);
                                    
                                    if($ret3 != 0) {
                                        $lin3 = mysql_fetch_object($res3);
                                    }
                    ?>
                    <form class="edita-embargo" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idembargo" value="<?php echo $lin->idembargo; ?>">
                                        <input type="hidden" id="idfiscalizacao" value="<?php echo $lin->fiscalizacao_idfiscalizacao; ?>">
                                        <div class="uploader"></div>
                                        <br/>
                                        <div class="input-group col-md-12">
                                        <?php
                                            //mostrando as fotos subidas
                                            $pyfolder = md5('folder');
                                            $folder = $lin3->album;
                                            $dir = ''.$raiz.'/'.$lin3->album.'/';

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
                                        <div class="form-group">
                                            <label>Fiscaliza&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="fiscalizacao_embargo" class="form-control" value="<?php echo $lin3->notificacao; ?>" maxlength="18" title="N&uacute;mero da fiscaliza&ccedil;&atilde;o" placeholder="Fiscaliza&ccedil;&atilde;o" disabled />
                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            <?php
                                                //buscando informacoes do imovel
                                                $sql2 = "SELECT imovel.idimovel,imovel.inscricao,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento,contribuinte.nome,contribuinte.cpf_cnpj FROM contribuinte,imovel,fiscalizacao WHERE fiscalizacao.imovel_idimovel = imovel.idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND imovel.idimovel = ".$lin3->imovel_idimovel."";
                                                $res2 = mysql_query($sql2);
                                                $ret2 = mysql_num_rows($res2);
                                                    
                                                    if($ret2 != 0) {
                                                        $lin2 = mysql_fetch_object($res2);
                                                    }
                                                    else {
                                                        $disabled = 'true';
                                                        echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                    }
                                                
                                                #unset($sql2,$res2,$ret2,$lin2);
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Inscri&ccedil;&atilde;o</span>
                                                        <input type="text" id="imovel_notificacao" class="form-control" value="<?php echo $lin2->inscricao; ?>" maxlength="18" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Contribuinte</span>
                                                        <input type="text" id="contribuinte" class="form-control" value="<?php echo $lin2->nome; ?>" title="Contribuinte" placeholder="Contribuinte" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Documento</span>
                                                        <input type="text" id="documento" class="form-control" value="<?php echo $lin2->cpf_cnpj; ?>" title="Documento" placeholder="Documento" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Endere&ccedil;o</span>
                                                        <input type="text" id="endereco" class="form-control" value="<?php echo $lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro; ?>" title="Endere&ccedil;o" placeholder="Endere&ccedil;o" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Lote</span>
                                                        <input type="text" id="lote" class="form-control" value="<?php echo $lin2->lote; ?>" title="Lote" placeholder="Lote" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Quadra</span>
                                                        <input type="text" id="quadra" class="form-control" value="<?php echo $lin2->quadra; ?>" title="Quadra" placeholder="Quadra" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Loteamento</span>
                                                        <input type="text" id="loteamento" class="form-control" value="<?php echo $lin2->loteamento; ?>" title="Loteamento" placeholder="Loteamento" disabled />
                                                    </div>
                                                    <br>    
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label>Funcion&aacute;rio</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    //selecionando o usuario
                                                    $sql2 = "SELECT idfuncionario,nome FROM funcionario WHERE idfuncionario = ".$lin3->funcionario_idfuncionario."";
                                                    $res2 = mysql_query($sql2);
                                                    $ret2 = mysql_num_rows($res2);

                                                        if($ret2 != 0) {
                                                            $lin2 = mysql_fetch_object($res2);
                                                            echo'<input type="text" id="funcionario" class="form-control" value="'.$lin2->nome.'" title="Funcion&aacute;rio" placeholder="Funcion&aacute;rio" disabled />';
                                                        }
                                                        else {
                                                            $disabled = 'true';
                                                            echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                        }

                                                    unset($sql2,$res2,$ret2,$lin2);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="data_embargo" class="form-control" maxlength="10" value="<?php echo $lin->datado; ?>" title="Data de entrada" placeholder="Data" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hora</label>
                                            <div class="input-group col-md-4 col-lg-3 bootstrap-timepicker">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="hora" class="form-control" value="<?php echo $lin->hora; ?>" maxlength="5" title="Hora de entrada" placeholder="Hora" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Fase</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="fase" class="form-control" value="<?php echo $lin->fase; ?>" maxlength="255" title="Fase em que se encontra a obra" placeholder="Fase" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Situa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select class="form-control" id="situacao" title="Situa&ccedil;&atilde;o" required>
                                                <?php
                                                    if($lin->situacao == 'Desembargada') { echo'<option value="Desembargada" selected>Desembargada</option>'; } else { echo'<option value="Desembargada">Desembargada</option>'; }
                                                    if($lin->situacao == 'Embargada') { echo'<option value="Embargada" selected>Embargada</option>'; } else { echo'<option value="Embargada">Embargada</option>'; }
                                                ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>N&uacute;mero do embargo</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="codigo" class="form-control" value="<?php echo $lin->codigo; ?>" maxlength="20" title="N&uacute;mero do embargo" placeholder="N&uacute;mero do embargo" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Valor</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="valor" class="form-control" value="<?php echo $lin->valor; ?>" maxlength="10" title="Valor da multa" placeholder="Valor" />
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
                                            $sql2 = "SELECT idinfracao,descricao FROM infracao WHERE nivel = 'Grau mínimo' ORDER BY descricao";
                                            $res2 = mysql_query($sql2);
                                            $ret2 = mysql_num_rows($res2); 
                                                
                                                if($ret2 != 0) {
                                                    echo'
                                                    <div class="form-group"><i class="fa fa-asterisk"></i> <label for="motivo">Grau m&iacute;nimo</label></div>
                                                        <table class="table">';
                                                    
                                                            while($lin2 = mysql_fetch_object($res2)) {
                                                                //buscando as infracoes selecionadas
                                                                $sql3 = "SELECT infracao_idinfracao FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$lin->fiscalizacao_idfiscalizacao." AND infracao_idinfracao = ".$lin2->idinfracao."";
                                                                $res3 = mysql_query($sql3);
                                                                $ret3 = mysql_num_rows($res3);
                                                                    
                                                                    if($ret3 != 0) {
                                                                        echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin2->idinfracao.'" checked disabled></td> <td><a id="del-'.$lin2->idinfracao.'-'.$lin->fiscalizacao_idfiscalizacao.'-'.$lin->idembargo.'" class="delebr tt" title="Desmarcar essa infra&ccedil;&atilde;o" href="#"><i class="fa fa-trash-o"></i></a> '.$lin2->descricao.'</td></tr>';
                                                                        $motivo = 1;
                                                                    }
                                                                    else {
                                                                        echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin2->idinfracao.'"></td> <td>'.$lin2->descricao.'</td></tr>';    
                                                                    }
                                                                
                                                                unset($sql3,$res3,$ret3);
                                                            }
                                                        
                                                        echo'</table><br/>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($sql2,$res2,$ret2,$lin2);
                                            
                                            //buscando as infracoes de grau medio
                                            $sql2 = "SELECT idinfracao,descricao FROM infracao WHERE nivel = 'Grau médio' ORDER BY descricao";
                                            $res2 = mysql_query($sql2);
                                            $ret2 = mysql_num_rows($res2);

                                                if($ret2 != 0) {
                                                    echo'
                                                    <div class="form-group"><i class="fa fa-asterisk"></i> <label for="motivo">Grau m&eacute;dio</label></div>
                                                        <table class="table">';
                                                    
                                                            while($lin2 = mysql_fetch_object($res2)) {
                                                                //buscando as infracoes selecionadas
                                                                $sql3 = "SELECT infracao_idinfracao FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$lin->fiscalizacao_idfiscalizacao." AND infracao_idinfracao = ".$lin2->idinfracao."";
                                                                $res3 = mysql_query($sql3);
                                                                $ret3 = mysql_num_rows($res3);
                                                                    
                                                                    if($ret3 != 0) {
                                                                        echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin2->idinfracao.'" checked disabled></td> <td><a id="del-'.$lin2->idinfracao.'-'.$lin->fiscalizacao_idfiscalizacao.'-'.$lin->idembargo.'" class="delebr tt" title="Desmarcar essa infra&ccedil;&atilde;o" href="#"><i class="fa fa-trash-o"></i></a> '.$lin2->descricao.'</td></tr>';
                                                                        $motivo = 1;
                                                                    }
                                                                    else {
                                                                        echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin2->idinfracao.'"></td> <td>'.$lin2->descricao.'</td></tr>';    
                                                                    }
                                                                
                                                                unset($sql3,$res3,$ret3);
                                                            }
                                                        
                                                        echo'</table><br/>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($sql2,$res2,$ret2,$lin2);
                                            
                                            //buscando as infracoes de grau maximo
                                            $sql2 = "SELECT idinfracao,descricao FROM infracao WHERE nivel = 'Grau máximo' ORDER BY descricao";
                                            $res2 = mysql_query($sql2);
                                            $ret2 = mysql_num_rows($res2);

                                                if($ret2 != 0) {
                                                    echo'
                                                    <div class="form-group"><i class="fa fa-asterisk"></i> <label for="motivo">Grau m&aacute;ximo</label></div>
                                                        <table class="table">';
                                                    
                                                            while($lin2 = mysql_fetch_object($res2)) {
                                                                //buscando as infracoes selecionadas
                                                                $sql3 = "SELECT infracao_idinfracao FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$lin->fiscalizacao_idfiscalizacao." AND infracao_idinfracao = ".$lin2->idinfracao."";
                                                                $res3 = mysql_query($sql3);
                                                                $ret3 = mysql_num_rows($res3);
                                                                    
                                                                    if($ret3 != 0) {
                                                                        echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin2->idinfracao.'" checked disabled></td> <td><a id="del-'.$lin2->idinfracao.'-'.$lin->fiscalizacao_idfiscalizacao.'-'.$lin->idembargo.'" class="delebr tt" title="Desmarcar essa infra&ccedil;&atilde;o" href="#"><i class="fa fa-trash-o"></i></a> '.$lin2->descricao.'</td></tr>';
                                                                        $motivo = 1;
                                                                    }
                                                                    else {
                                                                        echo'<tr><td><input type="checkbox" name="motivo[]" value="'.$lin2->idinfracao.'"></td> <td>'.$lin2->descricao.'</td></tr>';    
                                                                    }
                                                                
                                                                unset($sql3,$res3,$ret3);
                                                            }
                                                        
                                                        echo'</table>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($sql2,$res2,$ret2,$lin2);
                                        ?>
                                        <input type="hidden" id="motivo_checked" value="<?php echo $motivo; ?>">    
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
                    <?php
                            } //$ret
                                            
                        mysql_close($conexao);
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$sql3,$res3,$ret3,$lin3,$pyembargo,$motivo);
                    ?> 
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
        <!-- Masked money -->
        <script src="js/maskedmoney.min.js" type="text/javascript"></script>
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