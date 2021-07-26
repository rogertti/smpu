<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '7a'; ?>
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
        <!-- Autocomplete -->
        <link href="css/autocomplete.min.css" rel="stylesheet" type="text/css" />
        <!-- Datepicker -->
        <link href="css/datepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Nova an&aacute;lise de projeto <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="nova-analise">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="autentico" value="<?php echo md5(microtime()); ?>">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        
                                        <div class="form-group">
                                            <label>Protocolo</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idprotocolo">
                                                <input type="text" id="protocolo_analise" class="form-control" maxlength="9" title="Protocolo" placeholder="Protocolo" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data da an&aacute;lise</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="datado" class="form-control" maxlength="10" title="Data da an&aacute;lise" placeholder="Data da an&aacute;lise" required />
                                            </div>
                                        </div>
                                        <div class="contain">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Inscri&ccedil;&atilde;o</span>
                                                        <input type="text" id="inscricao_analise" class="form-control" title="Inscri&ccedil;&atilde;o" placeholder="Inscri&ccedil;&atilde;o" disabled />
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
                                                </div>
                                                <div class="col-md-6">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Situa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <select class="form-control" id="situacao" title="Situa&ccedil;&atilde;o">
                                                    <option value="" selected>Situa&ccedil;&atilde;o</option>
                                                    <option value="Pr&eacute;-an&aacute;lise">Pr&eacute;-an&aacute;lise</option>
                                                    <option value="An&aacute;lise">An&aacute;lise</option>
                                                    <option value="Rean&aacute;lise">Rean&aacute;lise</option>
                                                    <option value="Substitui&ccedil;&atilde;o">Substitui&ccedil;&atilde;o</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Respons&aacute;vel t&eacute;cnico</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="hidden" id="idengenheiro">
                                                <input type="text" id="responsavel" class="form-control" maxlength="255" title="Respons&aacute;vel t&eacute;cnico pela execu&ccedil;&atilde;o da obra" placeholder="Respons&aacute;vel t&eacute;cnico pela execu&ccedil;&atilde;o da obra" />
                                            </div>
                                        </div>
                                        <div class="contain-engenheiro">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Telefone ou celular</span>
                                                        <input type="text" id="telefone_engenheiro" class="form-control" title="Telefone" placeholder="Telefone" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">E-mail</span>
                                                        <input type="text" id="email_engenheiro" class="form-control" title="E-mail" placeholder="E-mail" disabled />
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ART ou RRT de execu&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="art_rrt" class="form-control" maxlength="20" title="ART ou RRT de execu&ccedil;&atilde;o" placeholder="ART ou RRT de execu&ccedil;&atilde;o" />
                                            </div>
                                        </div>
                                        <?php
                                            include_once('conexao.php');

                                            //buscando as os itens da documentacao da analise
                                            $sql = "SELECT iddocumentacao,descricao FROM documentacao WHERE monitor = 'O' ORDER BY descricao";
                                            $res = mysql_query($sql);
                                            $ret = mysql_num_rows($res);

                                                if($ret != 0) {
                                                    echo'
                                                    <div class="form-group">
                                                        <i class="fa fa-asterisk"></i>
                                                        <label for="documentacao">Documenta&ccedil;&atilde;o</label>
                                                    </div>
                                                        <table class="table">';

                                                            while($lin = mysql_fetch_object($res)) {
                                                                echo'<tr><td><input type="checkbox" name="documentacao[]" value="'.$lin->iddocumentacao.'"></td> <td>'.$lin->descricao.'</td></tr>';
                                                            }

                                                        echo'</table><br>';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($conexao,$charset,$sql,$res,$ret,$lin);
                                        ?>
                                        <div class="form-group">
                                            <label>Projeto arquitet&ocirc;nico</label>
                                            <div class="input-group arquitetonico">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control txtfx" name="arquitetonico" id="arquitetonico" rows="6" title="Projeto arquitet&ocirc;nico" placeholder="Projeto arquitet&ocirc;nico"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Projeto hidrosanit&aacute;rio</label>
                                            <div class="input-group hidrosanitario">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control txtfx" name="hidrosanitario" id="hidrosanitario" rows="6" title="Projeto hidrosanit&aacute;rio" placeholder="Projeto hidrosanit&aacute;rio"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group col-md-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <table class="table">
                                                    <tr>
                                                        <td><input type="radio" name="parecer" value="Com pend&ecirc;ncias" required> Com pend&ecirc;ncias</td>
                                                        <td><input type="radio" name="parecer" value="Analisado" required> Analisado</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
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
        <!-- Autocomplete -->
        <script src="js/autocomplete.min.js" type="text/javascript"></script>
        <!-- Datepicker -->
        <script src="js/datepicker.min.js" type="text/javascript"></script>
        <!-- WYSIHTML5 -->
        <script src="ckeditor/ckeditor.js"></script>
        <script src="js/ckeditor.init.min.js"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".contain").hide();
                $(".contain-engenheiro").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* EDITOR */
                
                /*$(".txtfx").summernote({
                    toolbar: [
                        //[groupname, [button list]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['fontsize', ['fontsize']],
                        //['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                    ]
                });*/
            });          
        </script>
    </body>
</html>
