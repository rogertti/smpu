<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '3a'; ?>
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
        <!-- header logo: style can be found in header.less -->
        <header class="header"><?php include_once('header.php'); ?></header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- javascript desabilitado -->
            <noscript><div class="script-less"><p><?php echo $cfg['noscript']; ?></p></div></noscript>
            
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas"><?php include_once('leftside.php'); ?></aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Novo arquiteto/engenheiro <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form class="novo-engenheiro">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <select id="tipo" class="form-control" title="Tipo" required>
                                                    <option value="1" selected>Arquiteto</option>
                                                    <option value="2">Engenheiro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="nome" class="form-control" maxlength="255" title="Nome" placeholder="Nome" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Documento</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="cau" class="form-control" maxlength="10" title="CAU" placeholder="CAU" required />
                                                <input type="text" id="crea" class="form-control hided" maxlength="10" title="CREA" placeholder="CREA" />
                                                <!--<span class="info-here-3 mode msgarq">
                                                    <a class="tt chgeng" title="Mudar para CREA" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgarq hided" title="Mudar para CAU" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>-->
                                            </div>
                                        </div>
                                        <!--<br/>
                                        <div class="input-group col-md-3">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <input type="text" id="crea" class="form-control hided" maxlength="7" placeholder="CREA" required />
                                        </div>
                                        <br/>
                                        <div class="input-group col-md-4">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <input type="text" id="usuario" class="form-control" maxlength="10" placeholder="Usu&aacute;rio" required />
                                        </div>
                                        <br/>
                                        <div class="input-group col-md-4">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <input type="password" id="senha" class="form-control" maxlength="10" placeholder="Senha" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Telefone ou celular</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="telefone" class="form-control" maxlength="13" placeholder="Telefone ou celular" required />
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <label>Contato do arquiteto/engenheiro</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="telefone" class="form-control" maxlength="13" title="Telefone do arquiteto/engenheiro" placeholder="Telefone" />
                                                <input type="text" id="celular" class="form-control hided" maxlength="14" title="Celular do arquiteto/engenheiro" placeholder="Celular" />
                                                <span class="info-here-4 mode msgtel">
                                                    <a class="tt chgcel" title="Mudar para celular" href="#"><i class="fa fa-exchange"></i></a>
                                                    <a class="tt chgtel hided" title="Mudar para telefone" href="#"><i class="fa fa-exchange"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="email" id="email" class="form-control" maxlength="100" placeholder="E-mail" required />
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
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Mask -->
        <script src="js/masked.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".hided").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* MUDA CAU/CREA */
                
                $("#tipo").change(function(){
                    if($(this).val() == '1') {
                        $("#crea").hide();
                        $(".chgarq").hide();
                        $("#crea").val("");
                        $("#cau").show().attr("required","");
                        $("#crea").removeAttr("required","");
                        $(".chgeng").show();
                        $(".mode").removeClass("msgeng").addClass("msgarq");
                    }
                    
                    if($(this).val() == '2') {
                        $("#cau").hide();
                        $(".chgeng").hide();
                        $("#cau").val("");
                        $("#crea").show().attr("required","");
                        $("#cau").removeAttr("required","");
                        $(".chgarq").show();
                        $(".mode").removeClass("msgarq").addClass("msgeng");
                    }
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
                
                /*$(".chgeng").click(function(){
                    $("#cau").hide();
                    $(".chgeng").hide();
                    $("#cau").val("");
                    $("#crea").show().attr("required","");
                    $("#cau").removeAttr("required","");
                    $(".chgarq").show();
                    $(".mode").removeClass("msgarq").addClass("msgeng");
                });
                
                $(".chgarq").click(function(){
                    $("#crea").hide();
                    $(".chgarq").hide();
                    $("#crea").val("");
                    $("#cau").show().attr("required","");
                    $("#crea").removeAttr("required","");
                    $(".chgeng").show();
                    $(".mode").removeClass("msgeng").addClass("msgarq");
                });*/
            });
        </script>
    </body>
</html>
