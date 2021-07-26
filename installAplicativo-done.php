<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $cfg['titulo']; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <!--[if lte IE 8]><script>location.href = "http://www.browsehappy.com"</script><![endif]-->
    </head>
    <body class="bg-black">
        <!-- javascript desabilitado -->
        <noscript><div class="script-less"><p><?php echo $cfg['noscript']; ?></p></div></noscript>
        
        <div class="form-box" style="margin-top: 6px;">
            <div class="alert alert-warning alert-dismissable browse">
                <i class="fa fa-warning"></i> Algumas funcionalidades est&atilde;o comprometidas nesse navegador.
            </div>
            
            <div class="header">Instalar aplicativo</div>
            <form class="form-install">
                <div class="body bg-gray">
                    <div class="form-group">
                        <label>Servidor</label>
                        <div class="input-group col-md-12">
                            <input type="text" id="servidor" class="form-control" maxlength="100" title="Servidor MySQL" placeholder="Servidor MySQL" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Banco de dados</label>
                        <div class="input-group col-md-12">
                            <input type="text" id="banco" class="form-control" maxlength="100" title="Banco de dados" placeholder="Banco de dados" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Usu&aacute;rio Mysql</label>
                        <div class="input-group col-md-12">
                            <input type="text" id="usuario_mysql" class="form-control" maxlength="10" title="Usu&aacute;rio do servidor MySQL" placeholder="Usu&aacute;rio do servidor MySQL" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Senha Mysql</label>
                        <div class="input-group col-md-12">
                            <input type="password" id="senha_mysql" class="form-control" maxlength="10" title="Senha do servidor MySQL" placeholder="Senha do servidor MySQL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Usu&aacute;rio do aplicativo</label>
                        <div class="input-group col-md-12">
                            <input type="text" id="usuario_app" class="form-control" maxlength="10" title="Usu&aacute;rio do aplicativo" placeholder="Usu&aacute;rio do aplicativo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Senha do aplicativo</label>
                        <div class="input-group col-md-12">
                            <input type="password" id="senha_app" class="form-control" maxlength="10" title="Senha do aplicativo" placeholder="Senha do aplicativo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <div class="input-group col-md-12">
                            <input type="email" id="email" class="form-control" maxlength="100" title="E-mail" placeholder="E-mail" required>
                        </div>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block btn-submit">Salvar</button>
                    <div class="alert alert-success success"></div>
                    <div class="alert alert-danger danger"></div>
                </div>
            </form>
        </div>
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        
        <!-- App -->
        <script src="js/app.js" type="text/javascript"></script>
        <!--[if IE 9]><script>$(".browse").show();</script><![endif]-->
    </body>
</html>
