<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '2a'; ?>
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
                    <h1>Novo im&oacute;vel/obra <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="novo-imovel">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <!--<input type="hidden" id="album" value="<?php echo md5(microtime()); ?>" />-->
                                        
                                        <div class="form-group">
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="inscricao" class="form-control" maxlength="18" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Contribuinte</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="hidden" id="idcontribuinte" />
                                                <input type="text" id="contribuinte" class="form-control" maxlength="255" title="Contribuinte" placeholder="Contribuinte" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>C&oacute;digo do contribuinte</label>
                                            <div class="input-group col-md-6 col-lg-5">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="codigo_contribuinte" class="form-control" maxlength="20" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" />
                                                <?php
                                                    /*include_once('conexao.php');

                                                    $sql = "SELECT idcontribuinte FROM contribuinte ORDER BY idcontribuinte DESC";
                                                    $res = mysql_query($sql);
                                                    $ret = mysql_num_rows($res);

                                                        if($ret == 0) {
                                                            echo'<input type="text" id="codigo_contribuinte" class="form-control" maxlength="5" value="00001" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" required />';
                                                        }
                                                        else {
                                                            $lin = mysql_fetch_row($res);

                                                                switch(strlen($lin[0])) {
                                                                    case 1:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 9) { $lin[0] = "0000".$lin[0]; }
                                                                            else { $lin[0] = "000".$lin[0]; }

                                                                        echo'<input type="text" id="codigo_contribuinte" class="form-control" maxlength="5" value="'.$lin[0].'" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" required />';
                                                                    break;
                                                                    case 2:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 99) { $lin[0] = "000".$lin[0]; }
                                                                            else { $lin[0] = "00".$lin[0]; }

                                                                        echo'<input type="text" id="codigo_contribuinte" class="form-control" maxlength="5" value="'.$lin[0].'" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" required />';
                                                                    break;
                                                                    case 3:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 999) { $lin[0] = "00".$lin[0]; }
                                                                            else { $lin[0] = "0".$lin[0]; }

                                                                        echo'<input type="text" id="codigo_contribuinte" class="form-control" maxlength="5" value="'.$lin[0].'" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" required />';
                                                                    break;
                                                                    case 4:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 9999) { $lin[0] = "0".$lin[0]; }

                                                                        echo'<input type="text" id="codigo_contribuinte" class="form-control" maxlength="5" value="'.$lin[0].'" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo" required />';
                                                                    break;
                                                                    case 5:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 9999) { $lin[0] = "00".$lin[0]; }
                                                                            else { $lin[0] = "Erro"; }

                                                                        echo'<input type="text" id="codigo_contribuinte" class="form-control" maxlength="5" value="'.$lin[0].'" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" required />';
                                                                    break;
                                                                }
                                                        }

                                                    #mysql_close($conexao);
                                                    #unset($conexao,$charset,$sql,$res,$ret,$lin);
                                                    unset($sql,$res,$ret,$lin);*/
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Documento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="cpf" class="form-control" maxlength="14" title="CPF" placeholder="CPF" />
                                                <input type="text" id="cnpj" class="form-control hided" maxlength="18" title="CNPJ" placeholder="CNPJ" />
                                                <span class="info-here-4 mode msgcpf">
                                                    <a class="tt chginc" title="Mudar para CNPJ" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgper hided" title="Mudar para CPF" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Matr&iacute;cula</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="matricula" class="form-control" maxlength="5" placeholder="Matr&iacute;cula" />
                                                <?php
                                                    /*$sql = "SELECT idimovel FROM imovel ORDER BY idimovel DESC";
                                                    $res = mysql_query($sql);
                                                    $ret = mysql_num_rows($res);

                                                        if($ret == 0) {
                                                            echo'<input type="text" id="matricula" class="form-control" maxlength="5" value="00001" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" required />';
                                                        }
                                                        else {
                                                            $lin = mysql_fetch_row($res);

                                                                switch(strlen($lin[0])) {
                                                                    case 1:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 9) { $lin[0] = "0000".$lin[0]; }
                                                                            else { $lin[0] = "000".$lin[0]; }

                                                                        echo'<input type="text" id="matricula" class="form-control" maxlength="5" value="'.$lin[0].'" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" required />';
                                                                    break;
                                                                    case 2:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 99) { $lin[0] = "000".$lin[0]; }
                                                                            else { $lin[0] = "00".$lin[0]; }

                                                                        echo'<input type="text" id="matricula" class="form-control" maxlength="5" value="'.$lin[0].'" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" required />';
                                                                    break;
                                                                    case 3:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 999) { $lin[0] = "00".$lin[0]; }
                                                                            else { $lin[0] = "0".$lin[0]; }

                                                                        echo'<input type="text" id="matricula" class="form-control" maxlength="5" value="'.$lin[0].'" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" required />';
                                                                    break;
                                                                    case 4:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 9999) { $lin[0] = "0".$lin[0]; }

                                                                        echo'<input type="text" id="matricula" class="form-control" maxlength="5" value="'.$lin[0].'" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" required />';
                                                                    break;
                                                                    case 5:
                                                                        $lin[0] = $lin[0] + 1;

                                                                            if($lin[0] <= 9999) { $lin[0] = "00".$lin[0]; }
                                                                            else { $lin[0] = "Erro"; }

                                                                        echo'<input type="text" id="matricula" class="form-control" maxlength="5" value="'.$lin[0].'" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" required />';
                                                                    break;
                                                                }
                                                        }

                                                    mysql_close($conexao);
                                                    unset($conexao,$charset,$sql,$res,$ret,$lin);*/
                                                ?>
                                            </div>
                                        </div>
                                        <!--<div class="input-group col-md-3">
                                            <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                            <input type="text" id="cep" class="form-control" maxlength="9" title="CEP" placeholder="CEP" />
                                            <span class="info-here msgcep"></span>
                                        </div>
                                        <br/>-->
                                        <div class="form-group">
                                            <label>Endere&ccedil;o</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="endereco" class="form-control" maxlength="255" title="Endere&ccedil;o" placeholder="Endere&ccedil;o" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>N&uacute;mero</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="numero" class="form-control" maxlength="100" title="Separe os n&uacute;meros por ponto e v&iacute;rgula" placeholder="N&uacute;mero" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Apto</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="apto" class="form-control" maxlength="20" title="N&uacute;mero do apartamento" placeholder="Apto" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Complemento</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="complemento" class="form-control" maxlength="100" title="Complemento" placeholder="Complemento" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Edif&iacute;cio</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="edificio" class="form-control" maxlength="45" title="Edif&iacute;cio/Condom&iacute;nio" placeholder="Edif&iacute;cio/Condom&iacute;nio" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="bairro" class="form-control" maxlength="100" title="Bairro" placeholder="Bairro" />
                                            </div>
                                        </div>
                                        <!--<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <input type="text" id="cidade" class="form-control" maxlength="100" title="Cidade" placeholder="Cidade" required />
                                        </div>
                                        <br/>
                                        <div class="input-group col-md-3">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <select class="form-control" id="estado" title="Estado">
                                                <option value="AC">AC</option>
                                                <option value="AL">AL</option>
                                                <option value="AM">AM</option>
                                                <option value="AP">AP</option>
                                                <option value="BA">BA</option>
                                                <option value="CE">CE</option>
                                                <option value="DF">DF</option>
                                                <option value="ES">ES</option>
                                                <option value="GO">GO</option>
                                                <option value="MA">MA</option>
                                                <option value="MG">MG</option>
                                                <option value="MS">MS</option>
                                                <option value="MT">MT</option>
                                                <option value="PA">PA</option>
                                                <option value="PB">PB</option>
                                                <option value="PE">PE</option>
                                                <option value="PI">PI</option>
                                                <option value="PR">PR</option>
                                                <option value="RJ">RJ</option>
                                                <option value="RN">RN</option>
                                                <option value="RO">RO</option>
                                                <option value="RR">RR</option>
                                                <option value="RS">RS</option>
                                                <option value="SC" selected="selected">SC</option>
                                                <option value="SE">SE</option>
                                                <option value="SP">SP</option>
                                                <option value="TO">TO</option>
                                            </select>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Tipo de obra</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <select class="form-control" id="tipo_obra" title="Tipo de obra">
                                                    <option value="" selected>Tipo de obra</option>
                                                    <option value="Residencial">Residencial</option>
                                                    <option value="Comercial">Comercial</option>
                                                    <option value="Galp&atilde;o">Galp&atilde;o</option>
                                                    <option value="Misto">Misto</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Garagem</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="garagem" class="form-control" maxlength="20" title="Garagem" placeholder="Garagem" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lote</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="lote" class="form-control" maxlength="20" title="Lote" placeholder="Lote" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Quadra</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="quadra" class="form-control" maxlength="20" title="Quadra" placeholder="Quadra" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Loteamento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="loteamento" class="form-control" maxlength="20" title="Loteamento" placeholder="Loteamento" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Fra&ccedil;&atilde;o ideal</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="fracao" class="form-control" maxlength="10" title="Fra&ccedil;&atilde;o ideal do terreno" placeholder="Fra&ccedil;&atilde;o ideal" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea do lote</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_lote" class="form-control" maxlength="10" title="&Aacute;rea do lote" placeholder="&Aacute;rea do lote" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea da unidade</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_unidade" class="form-control" maxlength="10" title="&Aacute;rea da unidade" placeholder="&Aacute;rea da unidade" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea do anexo</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_anexo" class="form-control" maxlength="10" title="&Aacute;rea do anexo" placeholder="&Aacute;rea do anexo" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea englobada</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_englobada" class="form-control" maxlength="10" title="&Aacute;rea englobada" placeholder="&Aacute;rea englobada" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea total constru&iacute;da</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_construida" class="form-control" maxlength="10" title="&Aacute;rea total constru&iacute;da" placeholder="&Aacute;rea total constru&iacute;da" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Testada principal</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="testada" class="form-control" maxlength="10" title="Testada principal" placeholder="Testada principal" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alvar&aacute;</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="alvara" class="form-control" maxlength="20" title="Alvar&aacute; de constru&ccedil;atilde;o" placeholder="Alvar&aacute;" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Habite-se</label>
                                            <div class="input-group col-md-8">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="habitese" class="form-control" maxlength="45" title="Habite-se" placeholder="Habite-se" />
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
                                    <button type="reset" class="btn btn-default clearimv">Limpar</button>
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
        <!-- Mask -->
        <script src="js/masked.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".hided").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* MUDA CPF/CNPJ */
                
                $(".chginc").click(function(){
                    $("#cpf").hide();
                    $(".chginc").hide();
                    $("#cpf").val("");
                    $("#cnpj").show();
                    //$("#cnpj").show().attr("required","");
                    //$("#cpf").removeAttr("required","");
                    $(".chgper").show();
                    $(".mode").removeClass("msgcpf").addClass("msgcnpj");
                });
                
                $(".chgper").click(function(){
                    $("#cnpj").hide();
                    $(".chgper").hide();
                    $("#cnpj").val("");
                    $("#cpf").show();
                    //$("#cpf").show().attr("required","");
                    //$("#cnpj").removeAttr("required","");
                    $(".chginc").show();
                    $(".mode").removeClass("msgcnpj").addClass("msgcpf");
                });
            });
        </script>
    </body>
</html>
