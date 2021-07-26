<?php
    //header('location: https://smpu.embracore.com.br');
    //exit;
    require_once('config.php');
    if(isset($_SESSION['key'])) { header('location:inicio.php'); }
    if(file_exists('installAplicativo.php')) { header('location:installAplicativo.php'); }
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
        
        <div class="form-box">
            <div class="alert alert-warning alert-dismissable browse">
                <i class="fa fa-warning"></i> Algumas funcionalidades est&atilde;o comprometidas nesse navegador.
            </div>
            
            <div class="header">Login</div>
            <form class="form-login">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" id="usuario" class="form-control" maxlength="100" title="Usu&aacute;rio" placeholder="Usu&aacute;rio" required />
                    </div>
                    <div class="form-group">
                        <input type="password" id="senha" class="form-control" maxlength="10" title="Senha" placeholder="Senha" required />
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block btn-submit">Entrar</button>
                    <p><a data-toggle="modal" data-target="#request-pass" href="#"><i class="fa fa-meh-o"></i> Esqueci minha senha</a></p>
                    <p><a data-toggle="modal" data-target="#request-key" href="#"><i class="fa fa-key"></i> Verificar autenticidade de um documento</a></p>
                    <div class="alert alert-info alert-dismissable info">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Modals -->
        <div class="modal fade" id="request-pass" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-reset">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Recuperar senha</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="email" id="email" class="form-control" maxlength="100" title="Email" placeholder="Email" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-olive btn-submit">Enviar</button>
                        </div>
                        <div class="alert alert-info alert-dismissable recover">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="request-key" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-trust">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Verificar autenticidade</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" id="chave" class="form-control" maxlength="50" title="Chave" placeholder="Chave" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-olive btn-submit">Enviar</button>
                        </div>
                        <div class="genuine"></div>
                    </form>
                </div>
            </div>
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