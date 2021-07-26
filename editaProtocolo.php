<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = 6; ?>
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
                    <h1>Edita protocolo <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyprotocolo = md5('idprotocolo');
                                            
                        $sql = "SELECT * FROM protocolo WHERE idprotocolo = ".$_GET[''.$pyprotocolo.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                    ?>
                    <form class="edita-protocolo">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idprotocolo" value="<?php echo $lin->idprotocolo; ?>">
                                        <input type="hidden" id="autentico" value="<?php echo md5(microtime()); ?>">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        
                                        <div class="form-group">
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    //busca a inscricao e o recolhimento
                                                    $sql2 = "SELECT imovel.idimovel,imovel.inscricao FROM imovel,requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
                                                    $res2 = mysql_query($sql2);
                                                    $ret2 = mysql_num_rows($res2);

                                                        if($ret2 != 0) {
                                                            $lin2 = mysql_fetch_object($res2);
                                                            $idimovel = $lin2->idimovel;
                                                            echo'<input type="text" id="imovel_inscricao" class="form-control" maxlength="18" value="'.$lin2->inscricao.'" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" disabled />';
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
                                            <label>Requerimento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    $sql3 = "SELECT requerimento.idrequerimento,requerimento.recolhimento FROM requerimento,imovel WHERE requerimento.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$idimovel."";
                                                    $res3 = mysql_query($sql3);
                                                    $ret3 = mysql_num_rows($res3);

                                                        if($ret3 != 0) {
                                                            echo'<select id="requerimento" class="form-control" title="Requerimento">';

                                                                while($lin3 = mysql_fetch_object($res3)) {
                                                                    if($lin3->idrequerimento == $lin->requerimento_idrequerimento) {
                                                                        echo'<option value="'.$lin3->idrequerimento.'" selected>'.$lin3->idrequerimento.' - '.$lin3->recolhimento.'</option>';
                                                                    }
                                                                    else {
                                                                        echo'<option value="'.$lin3->idrequerimento.'">'.$lin3->idrequerimento.' - '.$lin3->recolhimento.'</option>';
                                                                    }
                                                                }

                                                            echo'</select>';
                                                        } 
                                                        else {
                                                            $disabled = 'true';
                                                            echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                        }

                                                    unset($sql3,$res3,$ret3,$lin3,$idimovel);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Protocolo</label>
                                            <div class="input-group col-md-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="protocolo" class="form-control" maxlength="10" value="<?php echo $lin->codigo; ?>" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Taxa</label>
                                            <div class="input-group col-md-2">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="taxa" class="form-control" maxlength="10" value="<?php echo $lin->taxa; ?>" title="Taxa" placeholder="Taxa" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Situa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="situacao" class="form-control" maxlength="255" value="<?php echo $lin->situacao; ?>" title="Situa&ccedil;&atilde;o" placeholder="Situa&ccedil;&atilde;o" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Observa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="observacao" rows="6" title="Observa&ccedil;&atilde;o" placeholder="Observa&ccedil;&atilde;o"><?php echo $lin->observacao; ?></textarea>
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
                            <div class="col-md-3 col-lg-4">
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
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyprotocolo);
                    ?> 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
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
                /* TOOLTIP */
                
                $('.tt').tooltip();
            });
        </script>
        <?php
            if(!empty($disabled)) { echo'<script>$("input,select,textarea").prop("disabled",true);</script>'; unset($disabled); }
        ?>
    </body>
</html>