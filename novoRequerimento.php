<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '5a'; ?>
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
        <!-- Timepicker -->
        <link href="css/timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Colorbox -->
        <link href="css/colorbox.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Novo requerimento <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="novo-requerimento">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        
                                        <div class="form-group">
                                            <label>Inscri&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idimovel" />
                                                <input type="text" id="imovel" class="form-control" maxlength="18" title="Inscri&ccedil;&atilde;o do im&oacute;vel" placeholder="Inscri&ccedil;&atilde;o" required />
                                                <span class="info-here-5 busted hided">
                                                    <cite>Im&oacute;vel/obra irregular</cite> <a data-toggle="modal" data-target="#dados-notificacao" class="tt busted-href" title="Ver os dados da notifica&ccedil;&atilde;o" href="#"><i class="fa fa-bars"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nome do requerente</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="requerente" class="form-control" maxlength="255" title="Nome do requerente" placeholder="Nome do requerente" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Documento do requerente</label>
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
                                            <label>Contato do requerente</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="telefone" class="form-control" maxlength="13" title="Telefone do requerente" placeholder="Telefone" />
                                                <input type="text" id="celular" class="form-control hided" maxlength="14" title="Celular do requerente" placeholder="Celular" />
                                                <span class="info-here-4 mode msgtel">
                                                    <a class="tt chgcel" title="Mudar para celular" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgtel hided" title="Mudar para telefone" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail do requerente</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="email" id="email" class="form-control" maxlength="100" title="E-mail do requerente" placeholder="E-mail" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Arquiteto/Engenheiro</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="hidden" id="idengenheiro" />
                                                <input type="text" id="engenheiro" class="form-control" maxlength="255" title="Arquiteto ou Engenheiro" placeholder="Arquiteto/Engenheiro" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Funcion&aacute;rio</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <?php
                                                    include_once('conexao.php');

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

                                                    mysql_close($conexao);
                                                    unset($conexao,$charset,$sql,$res,$ret,$lin);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de recolhimento</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select class="form-control" id="recolhimento" title="Tipo de recolhimento" required>
                                                    <option value="" selected>Tipo de recolhimento</option>
                                                    <option value="2&#170; via de documento">2&#170; via de documento</option>
                                                    <option value="2&#170; via de habite-se e certificado de averba&ccedil;&atilde;o">2&#170; via de habite-se e certificado de averba&ccedil;&atilde;o</option>
                                                    <option value="Alinhamento de cal&ccedil;ada">Alinhamento de cal&ccedil;ada</option>
                                                    <option value="Alinhamento de cal&ccedil;ada e poste">Alinhamento de cal&ccedil;ada e poste</option>
                                                    <option value="Alinhamento de muro frontal">Alinhamento de muro frontal</option>
                                                    <option value="Alinhamento de poste">Alinhamento de poste</option>
                                                    <option value="Aprova&ccedil;&atilde;o de projeto">Aprova&ccedil;&atilde;o de projeto</option>
                                                    <option value="Aprova&ccedil;&atilde;o de projeto, alinhamento de muro e numera&ccedil;&atilde;o">Aprova&ccedil;&atilde;o de projeto, alinhamento de muro e numera&ccedil;&atilde;o</option>
                                                    <option value="Aprova&ccedil;&atilde;o de projeto com acr&eacute;scimo">Aprova&ccedil;&atilde;o de projeto com acr&eacute;scimo</option>
                                                    <option value="Autoriza&ccedil;&atilde;o de bate estaca">Autoriza&ccedil;&atilde;o de bate estaca</option>
                                                    <option value="Autoriza&ccedil;&atilde;o para demoli&ccedil;&atilde;o">Autoriza&ccedil;&atilde;o para demoli&ccedil;&atilde;o</option>
                                                    <option value="Cancelamento de desmembramento">Cancelamento de desmembramento</option>
                                                    <option value="Cancelamento de projeto">Cancelamento de projeto</option>
                                                    <option value="Certid&atilde;o de decad&ecirc;ncia">Certid&atilde;o de decad&ecirc;ncia</option>
                                                    <option value="Certid&atilde;o de demoli&ccedil;&atilde;o">Certid&atilde;o de demoli&ccedil;&atilde;o</option>
                                                    <option value="Certid&atilde;o de obra antiga">Certid&atilde;o de obra antiga</option>
                                                    <option value="Confrontantes">Confrontantes</option>
                                                    <option value="Consulta de viabilidade">Consulta de viabilidade</option>
                                                    <option value="Consulta de viabilidade (MEI)">Consulta de viabilidade (MEI)</option>
                                                    <option value="Declara&ccedil;&atilde;o">Declara&ccedil;&atilde;o</option>
                                                    <option value="Desmembramento">Desmembramento</option>
                                                    <option value="Desmembramento de &aacute;rea - Condom&iacute;nio horizontal">Desmembramento de &aacute;rea - Condom&iacute;nio horizontal</option>
                                                    <option value="Desmembramento e unifica&ccedil;&atilde;o">Desmembramento e unifica&ccedil;&atilde;o</option>
                                                    <option value="Diversos">Diversos</option>
                                                    <option value="Habite-se">Habite-se</option>
                                                    <option value="Habite-se e certid&atilde;o de averba&ccedil;&atilde;o">Habite-se e certid&atilde;o de averba&ccedil;&atilde;o</option>
                                                    <option value="Habite-se e renova&ccedil;&atilde;o de alvar&aacute;">Habite-se e renova&ccedil;&atilde;o de alvar&aacute;</option>
                                                    <option value="Habite-se, certid&atilde;o de averba&ccedil;&atilde;o e renova&ccedil;&atilde;o de alvar&aacute;">Habite-se, certid&atilde;o de averba&ccedil;&atilde;o e renova&ccedil;&atilde;o de alvar&aacute;</option>
                                                    <option value="Numera&ccedil;&atilde;o">Numera&ccedil;&atilde;o</option>
                                                    <option value="Obra existente">Obra existente</option>
                                                    <option value="Planta situa&ccedil;&atilde;o">Planta situa&ccedil;&atilde;o</option>
                                                    <option value="Plantas para carimbar">Plantas para carimbar</option>
                                                    <option value="Pr&eacute;-an&aacute;lise">Pr&eacute;-an&aacute;lise</option>
                                                    <option value="Regulariza&ccedil;&atilde;o com acr&eacute;scimo de &aacute;rea">Regulariza&ccedil;&atilde;o com acr&eacute;scimo de &aacute;rea</option>
                                                    <option value="Regulariza&ccedil;&atilde;o de obra">Regulariza&ccedil;&atilde;o de obra</option>
                                                    <option value="Renova&ccedil;&atilde;o de alvar&aacute;">Renova&ccedil;&atilde;o de alvar&aacute;</option>
                                                    <option value="Renova&ccedil;&atilde;o de desmembramento">Renova&ccedil;&atilde;o de desmembramento</option>
                                                    <option value="Renova&ccedil;&atilde;o de unifica&ccedil;&atilde;o">Renova&ccedil;&atilde;o de unifica&ccedil;&atilde;o</option>
                                                    <option value="Retifica&ccedil;&atilde;o de &aacute;rea">Retifica&ccedil;&atilde;o de &aacute;rea</option>
                                                    <option value="Solo criado">Solo criado</option>
                                                    <option value="Substitui&ccedil;&atilde;o de desmembramento">Substitui&ccedil;&atilde;o de desmembramento</option>
                                                    <option value="Substitui&ccedil;&atilde;o de habite-se e certificado de averba&ccedil;&atilde;o">Substitui&ccedil;&atilde;o de habite-se e certificado de averba&ccedil;&atilde;o</option>
                                                    <option value="Substitui&ccedil;&atilde;o de plantas">Substitui&ccedil;&atilde;o de plantas</option>
                                                    <option value="Substitui&ccedil;&atilde;o de projeto">Substitui&ccedil;&atilde;o de projeto</option>
                                                    <option value="Substitui&ccedil;&atilde;o projeto com acr&eacute;scimo">Substitui&ccedil;&atilde;o projeto com acr&eacute;scimo</option>
                                                    <option value="Substitui&ccedil;&atilde;o de titularidade">Substitui&ccedil;&atilde;o de titularidade</option>
                                                    <option value="Substitui&ccedil;&atilde;o de unifica&ccedil;&atilde;o">Substitui&ccedil;&atilde;o de unifica&ccedil;&atilde;o</option>
                                                    <option value="Unifica&ccedil;&atilde;o">Unifica&ccedil;&atilde;o</option>
                                                    <option value="Uso do solo">Uso do solo</option>
                                                    <option value="Vistoria da caixa d&#39;&aacute;gua">Vistoria da caixa d&#39;&aacute;gua</option>
                                                    <option value="Vistoria da caixa d&#39;&aacute;gua, do filtro e da fossa">Vistoria da caixa d&#39;&aacute;gua, do filtro e da fossa</option>
                                                    <option value="Vistoria do filtro e da fossa">Vistoria do filtro e da fossa</option>
                                                    <option value="Vistoria da fossa">Vistoria da fossa</option>
                                                    <option value="Vistoria da infra-estrutura">Vistoria da infra-estrutura</option>
                                                    <option value="Vistoria sanit&aacute;ria">Vistoria sanit&aacute;ria</option>
                                                    <option value="Zona urbana/rural">Zona urbana/rural</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alvar&aacute;</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="alvara" class="form-control" maxlength="20" title="Alvar&aacute;" placeholder="Alvar&aacute;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="entrada" class="form-control" maxlength="10" value="<?php echo date('d/m/Y'); ?>" title="Data de entrada" placeholder="Entrada" required />
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
                                            <label>Tipo de obra</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <select class="form-control" id="construcao" title="Tipo de obra">
                                                    <option value="" selected>Tipo de obra</option>
                                                    <option value="Comercial">Comercial</option>
                                                    <option value="Condom&iacute;nio de Lotes">Condom&iacute;nio de Lotes</option>
                                                    <option value="Desmembramento de &Aacute;rea">Desmembramento de &Aacute;rea</option>
                                                    <option value="Industrial">Industrial</option>
                                                    <option value="Loteamento">Loteamento</option>
                                                    <option value="Misto">Misto (Residencial e Comercial)</option>
                                                    <option value="Residencial Casa Geminada">Residencial Casa Geminada</option>
                                                    <option value="Residencial Multifamiliar">Residencial Multifamiliar</option>
                                                    <option value="Residencial Unifamiliar">Residencial Unifamiliar</option>
                                                    <option value="Sem constru&ccedil;&atilde;o">Sem constru&ccedil;&atilde;o</option>
                                                    <option value="Unifica&ccedil;&atilde;o de &Aacute;rea">Unifica&ccedil;&atilde;o de &Aacute;rea</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>&Aacute;rea</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="area" class="form-control" maxlength="20" title="&Aacute;rea" placeholder="&Aacute;rea" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Ano vencido</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="vencido" class="form-control" maxlength="10" title="Ano vencido" placeholder="Ano vencido" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Vencimento</label>
                                            <div class="input-group col-md-6 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="vencimento" class="form-control" maxlength="10" title="Vencimento" placeholder="Vencimento" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Informa&ccedil;&otilde;es complementares</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control" id="referencia" rows="6" title="Informa&ccedil;&otilde;es complementares" placeholder="Informa&ccedil;&otilde;es complementares"></textarea>
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
        <!-- Datepicker -->
        <script src="js/datepicker.min.js" type="text/javascript"></script>
        <!-- Timepicker -->
        <script src="js/timepicker.min.js" type="text/javascript"></script>
        <!-- Colorbox -->
        <script src="js/colorbox.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".hided").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* COLORBOX */
                
                $(".fr").colorbox({iframe:true,width:"80%",height:"95%"});
                
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
                
                /* MUDA TELEFONE/CELULAR */
                
                $(".chgcel").click(function(){
                    $("#telefone").hide();
                    $(".chgcel").hide();
                    $("#telefone").val("");
                    $("#celular").show();
                    $(".chgtel").show();
                    $(".mode").removeClass("msgtel").addClass("msgcel");
                });
                
                $(".chgtel").click(function(){
                    $("#celular").hide();
                    $(".chgtel").hide();
                    $("#celular").val("");
                    $("#telefone").show();
                    $(".chgcel").show();
                    $(".mode").removeClass("msgcel").addClass("msgtel");
                });
            });
        </script>
        <?php
            if(!empty($disabled)) { echo'<script>$("input,select,textarea").prop("disabled",true);</script>'; unset($disabled); }
        ?>
    </body>
</html>