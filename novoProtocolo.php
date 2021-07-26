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
                    <h1>Novo protocolo <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="novo-protocolo">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="autentico" value="<?php echo md5(microtime()); ?>">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        
                                        <div class="form-group">
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idimovel" />
                                                <input type="text" id="imovel_inscricao" class="form-control" maxlength="18" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" required />
                                                <span class="info-here-5 busted hided">
                                                    <cite>Im&oacute;vel/obra irregular</cite> <a data-toggle="modal" data-target="#dados-notificacao" class="tt busted-href" title="Ver os dados da notifica&ccedil;&atilde;o" href="#"><i class="fa fa-bars"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Requerimento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select id="requerimento" class="form-control" title="Requerimento" disabled></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Protocolo</label>
                                            <div class="input-group col-md-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    include_once('conexao.php');
                                                    
                                                    $sql = "SELECT idprotocolo,codigo FROM protocolo ORDER BY idprotocolo DESC LIMIT 1";
                                                    #$sql = "SELECT idprotocolo,codigo FROM protocolo ORDER BY idprotocolo DESC";
                                                    $res = mysql_query($sql);
                                                    $ret = mysql_num_rows($res);

                                                        if($ret == 0) {
                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="0001/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                        }
                                                        else {
                                                            $lin = mysql_fetch_object($res);

                                                            //QUEBRAMOS O CODIGO NA BARRA PARA DEPURAR O ANO
                                                            $array_codigo = explode('/', $lin->codigo);
                                                            $array_codigo[0] = $array_codigo[0] + 1;
                                                            
                                                                //SE O ANO CADASTRADO FOR IGUAL AO ATUAL MONTA AS SEQUENCIAS ABAIXO
                                                                if($array_codigo[1] == date('Y')) {
                                                                    /*switch(strlen($lin->idprotocolo)) {
                                                                        case 1:
                                                                            $lin->idprotocolo = $lin->idprotocolo + 1;

                                                                                if($lin->idprotocolo <= 9) { $lin->idprotocolo = "000".$lin->idprotocolo; }
                                                                                else { $lin->idprotocolo = "00".$lin->idprotocolo; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$lin->idprotocolo.'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 2:
                                                                            $lin->idprotocolo = $lin->idprotocolo + 1;

                                                                                if($lin->idprotocolo <= 99) { $lin->idprotocolo = "00".$lin->idprotocolo; }
                                                                                else { $lin->idprotocolo = "0".$lin->idprotocolo; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$lin->idprotocolo.'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 3:
                                                                            $lin->idprotocolo = $lin->idprotocolo + 1;

                                                                                if($lin->idprotocolo <= 999) { $lin->idprotocolo = "0".$lin->idprotocolo; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$lin->idprotocolo.'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 4:
                                                                            $lin->idprotocolo = $lin->idprotocolo + 1;

                                                                                #if($lin->idprotocolo <= 9999) { $lin->idprotocolo = "00".$lin->idprotocolo; }
                                                                                #else { $lin->idprotocolo = "Erro"; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$lin->idprotocolo.'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                    }*/
                                                                    switch(strlen($array_codigo[0])) {
                                                                        case 1:
                                                                            #$array_codigo[0] = $array_codigo[0] + 1;

                                                                                if($array_codigo[0] <= 9) { $array_codigo[0] = "000".$array_codigo[0]; }
                                                                                else { $array_codigo[0] = "00".$array_codigo[0]; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 2:
                                                                            #$array_codigo[0] = $array_codigo[0] + 1;

                                                                                if($array_codigo[0] <= 99) { $array_codigo[0] = "00".$array_codigo[0]; }
                                                                                else { $array_codigo[0] = "0".$array_codigo[0]; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 3:
                                                                            #$array_codigo[0] = $array_codigo[0] + 1;

                                                                                if($array_codigo[0] <= 999) { $array_codigo[0] = "0".$array_codigo[0]; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 4:
                                                                            #$array_codigo[0] = $array_codigo[0] + 1;

                                                                                #if($array_codigo[0] <= 9999) { $array_codigo[0] = "00".$array_codigo[0]; }
                                                                                #else { $array_codigo[0] = "Erro"; }

                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                        case 5:
                                                                            #$array_codigo[0] = $array_codigo[0] + 1;

                                                                                #if($array_codigo[0] <= 9999) { $array_codigo[0] = "00".$array_codigo[0]; }
                                                                                #else { $array_codigo[0] = "Erro"; }
                                                                            
                                                                            echo'<input type="text" id="protocolo" class="form-control" maxlength="10" value="'.$array_codigo[0].'/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                        break;
                                                                    }
                                                                }
                                                                //SENAO ZERA O CONTADOR
                                                                else {
                                                                    echo'<input type="text" id="protocolo" class="form-control" maxlength="9" value="0001/'.date('Y').'" title="N&uacute;mero de protocolo" placeholder="Protocolo" disabled />';
                                                                }
                                                        }

                                                    mysql_close($conexao);
                                                    unset($conexao,$charset,$sql,$res,$ret,$lin,$array_codigo);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Taxa</label>
                                        <div class="input-group col-md-2">
                                            <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                            <input type="text" id="taxa" class="form-control" maxlength="10" title="Taxa" placeholder="Taxa" />
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Situa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="situacao" class="form-control" maxlength="255" title="Situa&ccedil;&atilde;o" placeholder="Situa&ccedil;&atilde;o" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Observa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="observacao" rows="6" title="Observa&ccedil;&atilde;o" placeholder="Observa&ccedil;&atilde;o"></textarea>
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
                                    <button type="reset" class="btn btn-default clearprt">Limpar</button>
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
                </section><!-- /.content -->
                
                <!-- Modal  dados -->
                <div class="modal fade" id="dados-notificacao" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"></div>
                    </div>
                </div>
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
                $(".hided").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
            });
        </script>
        <?php
            if(!empty($disabled)) { echo'<script>$("input,select,textarea").prop("disabled",true);</script>'; unset($disabled); }
        ?>
    </body>
</html>
