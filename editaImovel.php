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
                    <h1>Edita im&oacute;vel/Obra <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyimovel = md5('idimovel');
                                            
                        $sql = "SELECT * FROM imovel WHERE idimovel = ".$_GET[''.$pyimovel.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                                
                                //selecionando o nome do cliente
                                $sql2 = "SELECT contribuinte.* FROM contribuinte,imovel WHERE imovel.contribuinte_idcontribuinte = contribuinte.idcontribuinte AND contribuinte.idcontribuinte = ".$lin->contribuinte_idcontribuinte."";
                                $res2 = mysql_query($sql2);
                                $ret2 = mysql_num_rows($res2);
                                
                                    if($ret2 != 0) {
                                        $lin2 = mysql_fetch_object($res2);
                                        $contribuinte = $lin2->nome;
                                    } 
                                
                                //verificando se o imóvel possui fiscalização
                                /*$sql3 = "SELECT idfiscalizacao,foto FROM fiscalizacao WHERE imovel_idimovel = ".$lin[0]."";
                                $res3 = mysql_query($sql3);
                                $ret3 = mysql_num_rows($res3);

                                    if($ret3 != 0) {
                                        $lin3 = mysql_fetch_row($res3);
                                        $fiscalizacao = $lin3[0];
                                        $album = $lin3[1];
                                        //essa variavel será usada para controlar o redirecionamento do update
                                        $alt = 'true';
                                    }
                                    else {
                                        $fiscalizacao = '';
                                        $album = md5(microtime());
                                        $alt = 'false';
                                    }*/
                                
                                #unset($sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3);
                    ?>
                    <form class="edita-imovel">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idimovel" value="<?php echo $lin->idimovel; ?>" />
                                        <!--<input type="hidden" id="idfiscalizacao" value="<?php echo $fiscalizacao; ?>" />
                                        <input type="hidden" id="album" value="<?php echo $album; ?>" />
                                        <input type="hidden" id="alt" value="<?php echo $alt; ?>" />-->
                                        
                                        <div class="form-group">
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="inscricao" class="form-control" maxlength="18" value="<?php echo $lin->inscricao; ?>" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" required />
                                                <span class="info-here-4">
                                                    <a class="tt chgcnt" title="Cadastrar um novo contribuinte para esse im&oacute;vel" href="#"><i class="fa fa-user"></i></a>
                                                    <a class="tt chgund hided" title="Desfazer" href="#"><i class="fa fa-rotate-left"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            if(isset($contribuinte)) {
                                        ?>
                                        <div class="form-group">
                                            <label>Contribuinte</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="hidden" id="idcontribuinte" value="<?php echo $lin->contribuinte_idcontribuinte; ?>" />
                                                <input type="text" id="contribuinte" class="form-control" maxlength="255" value="<?php echo $lin2->nome; ?>" title="Contribuinte" placeholder="Contribuinte" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>C&oacute;digo do contribuinte</label>
                                            <div class="input-group col-md-6 col-lg-5">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="codigo_contribuinte" class="form-control" maxlength="20" value="<?php echo $lin2->codigo; ?>" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" />
                                            </div>
                                        </div>
                                        <?php
                                            if(strlen($lin2->cpf_cnpj) <= 14) {
                                        ?>
                                        <div class="form-group">
                                            <label>Documento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="cpf" class="form-control" maxlength="14" value="<?php echo $lin2->cpf_cnpj; ?>" placeholder="CPF" />
                                                <input type="text" id="cnpj" class="form-control hided" maxlength="18" placeholder="CNPJ" />
                                                <span class="info-here-4 mode msgcpf">
                                                    <a class="tt chginc" title="Mudar para CNPJ" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgper hided" title="Mudar para CPF" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        
                                            if(strlen($lin2->cpf_cnpj) > 14) {
                                        ?>
                                        <div class="form-group">
                                            <label>Documento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="cnpj" class="form-control" maxlength="18" value="<?php echo $lin2->cpf_cnpj; ?>" placeholder="CNPJ" />
                                                <input type="text" id="cpf" class="form-control hided" maxlength="14" placeholder="CPF" />
                                                <span class="info-here-4 mode msgcnpj">
                                                    <a class="tt chgper" title="Mudar para CPF" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chginc hided" title="Mudar para CNPJ" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                            } //isset
                                            else {
                                        ?>
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
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="codigo_contribuinte" class="form-control" maxlength="10" title="C&oacute;digo do contribuinte" placeholder="C&oacute;digo do contribuinte" />
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
                                        <?php
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label>Matr&iacute;cula</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="matricula" class="form-control" maxlength="5" value="<?php echo $lin->matricula; ?>" title="Matr&iacute;cula do im&oacute;vel" placeholder="Matr&iacute;cula" />
                                            </div>
                                        </div>
                                        <!--<div class="input-group col-md-3">
                                            <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                            <input type="text" id="cep" class="form-control" maxlength="9" value="<?php echo $lin->cep; ?>" title="CEP" placeholder="CEP" />
                                            <span class="info-here msgcep"></span>
                                        </div>
                                        <br/>-->
                                        <div class="form-group">
                                            <label>Endere&ccedil;o</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <?php
                                                    $endereco = explode(', ',$lin->endereco);
                                                ?>
                                                <input type="text" id="endereco" class="form-control" maxlength="255" value="<?php echo $endereco[0]; ?>" title="Endere&ccedil;o" placeholder="Endere&ccedil;o" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>N&uacute;mero</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="numero" class="form-control" maxlength="100" value="<?php echo $endereco[1]; ?>" title="Separe os n&uacute;meros por ponto e v&iacute;rgula" placeholder="N&uacute;mero" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Apto</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="apto" class="form-control" maxlength="20" value="<?php echo $lin->apto; ?>" title="N&uacute;mero do apartamento" placeholder="Apto" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Complemento</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="complemento" class="form-control" maxlength="100" value="<?php echo $lin->complemento; ?>" title="Complemento" placeholder="Complemento" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Edif&iacute;cio</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="edificio" class="form-control" maxlength="45" value="<?php echo $lin->edificio_condominio; ?>" title="Edif&iacute;cio/Condom&iacute;nio" placeholder="Edif&iacute;cio/Condom&iacute;nio" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="bairro" class="form-control" maxlength="100" value="<?php echo $lin->bairro; ?>" title="Bairro" placeholder="Bairro" />
                                            </div>
                                        </div>
                                        <!--<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <input type="text" id="cidade" class="form-control" maxlength="100" value="<?php echo $lin->cidade; ?>" title="Cidade" placeholder="Cidade" required />
                                        </div>
                                        <br/>
                                        <div class="input-group col-md-3">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <select class="form-control" id="estado" title="Estado">
                                            <?php
                                                  if($lin->estado == 'AC') {echo'<option value="AC" selected="selected">AC</option>';} else {echo'<option value="AC">AC</option>';}
                                                  if($lin->estado == 'AL') {echo'<option value="AL" selected="selected">AL</option>';} else {echo'<option value="AL">AL</option>';}
                                                  if($lin->estado == 'AM') {echo'<option value="AM" selected="selected">AM</option>';} else {echo'<option value="AM">AM</option>';}
                                                  if($lin->estado == 'AP') {echo'<option value="AP" selected="selected">AP</option>';} else {echo'<option value="AP">AP</option>';}
                                                  if($lin->estado == 'BA') {echo'<option value="BA" selected="selected">BA</option>';} else {echo'<option value="BA">BA</option>';}
                                                  if($lin->estado == 'CE') {echo'<option value="CE" selected="selected">CE</option>';} else {echo'<option value="CE">CE</option>';}
                                                  if($lin->estado == 'DF') {echo'<option value="DF" selected="selected">DF</option>';} else {echo'<option value="DF">DF</option>';}
                                                  if($lin->estado == 'ES') {echo'<option value="ES" selected="selected">ES</option>';} else {echo'<option value="ES">ES</option>';}
                                                  if($lin->estado == 'GO') {echo'<option value="GO" selected="selected">GO</option>';} else {echo'<option value="GO">GO</option>';}
                                                  if($lin->estado == 'MA') {echo'<option value="MA" selected="selected">MA</option>';} else {echo'<option value="MA">MA</option>';}
                                                  if($lin->estado == 'MG') {echo'<option value="MG" selected="selected">MG</option>';} else {echo'<option value="MG">MG</option>';}
                                                  if($lin->estado == 'MS') {echo'<option value="MS" selected="selected">MS</option>';} else {echo'<option value="MS">MS</option>';}
                                                  if($lin->estado == 'MT') {echo'<option value="MT" selected="selected">MT</option>';} else {echo'<option value="MT">MT</option>';}   
                                                  if($lin->estado == 'PA') {echo'<option value="PA" selected="selected">PA</option>';} else {echo'<option value="PA">PA</option>';}
                                                  if($lin->estado == 'PB') {echo'<option value="PB" selected="selected">PB</option>';} else {echo'<option value="PB">PB</option>';}
                                                  if($lin->estado == 'PE') {echo'<option value="PE" selected="selected">PE</option>';} else {echo'<option value="PE">PE</option>';}
                                                  if($lin->estado == 'PI') {echo'<option value="PI" selected="selected">PI</option>';} else {echo'<option value="PI">PI</option>';}
                                                  if($lin->estado == 'PR') {echo'<option value="PR" selected="selected">PR</option>';} else {echo'<option value="PR">PR</option>';}
                                                  if($lin->estado == 'RJ') {echo'<option value="RJ" selected="selected">RJ</option>';} else {echo'<option value="RJ">RJ</option>';}
                                                  if($lin->estado == 'RN') {echo'<option value="RN" selected="selected">RN</option>';} else {echo'<option value="RN">RN</option>';}
                                                  if($lin->estado == 'RO') {echo'<option value="RO" selected="selected">RO</option>';} else {echo'<option value="RO">RO</option>';}
                                                  if($lin->estado == 'RR') {echo'<option value="RR" selected="selected">RR</option>';} else {echo'<option value="RR">RR</option>';}
                                                  if($lin->estado == 'RS') {echo'<option value="RS" selected="selected">RS</option>';} else {echo'<option value="RS">RS</option>';}  
                                                  if($lin->estado == 'SC') {echo'<option value="SC" selected="selected">SC</option>';} else {echo'<option value="SC">SC</option>';}
                                                  if($lin->estado == 'SE') {echo'<option value="SE" selected="selected">SE</option>';} else {echo'<option value="SE">SE</option>';}
                                                  if($lin->estado == 'SP') {echo'<option value="SP" selected="selected">SP</option>';} else {echo'<option value="SP">SP</option>';}
                                                  if($lin->estado == 'TO') {echo'<option value="TO" selected="selected">TO</option>';} else {echo'<option value="TO">TO</option>';}
                                            ?>    
                                            </select>
                                        </div>
                                        <br/>-->
                                        <div class="form-group">
                                            <label>Tipo de obra</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <select class="form-control" id="tipo_obra" title="Tipo de obra">
                                                <?php
                                                    if(empty($lin->tipo_obra)) {
                                                        echo'
                                                        <option value="" selected>Tipo de obra</option>
                                                        <option value="Geminada">Geminada</option>
                                                        <option value="Residencial">Residencial</option>
                                                        <option value="Comercial">Comercial</option>
                                                        <option value="Galp&atilde;o">Galp&atilde;o</option>
                                                        <option value="Misto">Misto</option>';
                                                    }
                                                    else {
                                                        if($lin->tipo_obra == 'Residencial') {echo'<option value="Residencial" selected>Residencial</option>';} else {echo'<option value="Residencial">Residencial</option>';}
                                                        if($lin->tipo_obra == 'Comercial') {echo'<option value="Comercial" selected>Comercial</option>';} else {echo'<option value="Comercial">Comercial</option>';}
                                                        if($lin->tipo_obra == 'Galpão') {echo'<option value="Galp&atilde;o" selected>Galp&atilde;o</option>';} else {echo'<option value="Galp&atilde;o">Galp&atilde;o</option>';}
                                                        if($lin->tipo_obra == 'Misto') {echo'<option value="Misto" selected>Misto</option>';} else {echo'<option value="Misto">Misto</option>';}
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Garagem</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="garagem" class="form-control" maxlength="20" value="<?php echo $lin->garagem; ?>" title="Garagem" placeholder="Garagem" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lote</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="lote" class="form-control" maxlength="20" value="<?php echo $lin->lote; ?>" title="Lote" placeholder="Lote" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Quadra</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="quadra" class="form-control" maxlength="20" value="<?php echo $lin->quadra; ?>" title="Quadra" placeholder="Quadra" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Loteamento</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="loteamento" class="form-control" maxlength="20" value="<?php echo $lin->loteamento; ?>" title="Loteamento" placeholder="Loteamento" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Fra&ccedil;&atilde;o ideal</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="fracao" class="form-control" maxlength="20" value="<?php echo $lin->fracao; ?>" title="Fra&ccedil;&atilde;o ideal do terreno" placeholder="Fra&ccedil;&atilde;o ideal" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute; do lote</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_lote" class="form-control" maxlength="20" value="<?php echo $lin->area_lote; ?>" title="&Aacute;rea do lote" placeholder="&Aacute;rea do lote" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea da unidade</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_unidade" class="form-control" maxlength="20" value="<?php echo $lin->area_unidade; ?>" title="&Aacute;rea da unidade" placeholder="&Aacute;rea da unidade" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea do anexo</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_anexo" class="form-control" maxlength="20" value="<?php echo $lin->area_anexo; ?>" title="&Aacute;rea do anexo" placeholder="&Aacute;rea do anexo" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea englobada</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_englobada" class="form-control" maxlength="20" value="<?php echo $lin->area_englobada; ?>" title="&Aacute;rea englobada" placeholder="&Aacute;rea englobada" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea total constru&iacute;da</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area_construida" class="form-control" maxlength="100" value="<?php echo $lin->area_construida; ?>" title="&Aacute;rea total constru&iacute;da" placeholder="&Aacute;rea total constru&iacute;da" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Testada principal</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="testada" class="form-control" maxlength="20" value="<?php echo $lin->testada; ?>" title="Testada principal" placeholder="Testada principal" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alvar&aacute;</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="alvara" class="form-control" maxlength="20" value="<?php echo $lin->alvara; ?>" title="Alvar&aacute; de constru&ccedil;atilde;o" placeholder="Alvar&aacute;" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Habite-se</label>
                                            <div class="input-group col-md-8">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="habitese" class="form-control" maxlength="45" value="<?php echo $lin->habitese; ?>" title="Habite-se" placeholder="Habite-se" />
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
                    <?php
                            } //$ret
                                            
                        mysql_close($conexao);
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyimovel,$contribuinte,$album,$alt,$fiscalizacao,$endereco,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3);
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
                
                $(".chgcnt").click(function(){
                    $(".chgcnt").hide();
                    $(".chgund").show();
                    $("#idcontribuinte").val("");
                    $("#contribuinte").val("");
                    $("#codigo_contribuinte").val("");
                    $("#cpf").val("");
                    $("#cnpj").val("");
                });
                
                $(".chgund").click(function(){
                    location.reload();
                });
            });
        </script>
    </body>
</html>
