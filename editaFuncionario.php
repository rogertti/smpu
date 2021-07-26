<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '4a'; ?>
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
                    <!--<h1>Edita funcion&aacute;rio <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>-->
                    <h1>Perfil <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyfuncionario = md5('idfuncionario');
                                            
                        #$sql = "SELECT * FROM funcionario WHERE idfuncionario = ".base64_decode($_SESSION['id'])."";
                        $sql = "SELECT * FROM funcionario WHERE idfuncionario = ".$_GET[''.$pyfuncionario.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                    ?>
                    <form class="edita-funcionario">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idfuncionario" value="<?php echo $lin->idfuncionario; ?>" />
                                        
                                        <div class="form-group">
                                            <label>Matr&iacute;cula</label>
                                            <div class="input-group col-md-4 col-lg-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="matricula_funcionario" class="form-control" maxlength="10" value="<?php echo $lin->matricula; ?>" title="Matr&iacute;cula" placeholder="Matr&iacute;cula" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="nome" class="form-control" maxlength="255" value="<?php echo $lin->nome; ?>" title="Nome" placeholder="Nome" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Usu&aacute;rio</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="usuario" class="form-control" maxlength="10" value="<?php echo base64_decode($lin->usuario); ?>" title="Usu&aacute;rio" placeholder="Usu&aacute;rio" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <div class="input-group col-md-6 col-lg-4">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="password" id="senha" class="form-control" maxlength="10" value="<?php echo base64_decode($lin->senha); ?>" title="Senha" placeholder="Senha" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="email" id="email" class="form-control" maxlength="100" value="<?php echo $lin->email; ?>" title="E-mail" placeholder="E-mail" required />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                            <?php
                                                if($lin->tipo == 'ADM') {
                                                    echo'<span class="radio-inline"><input type="radio" name="tipo" value="ADM" title="N&iacute;vel de acesso" checked> Administrador</span>
                                                    <span class="radio-inline"><input type="radio" name="tipo" value="USR" title="N&iacute;vel de acesso"> Usu&aacute;rio</span>';
                                                }
                                
                                                if($lin->tipo == 'USR') {
                                                    echo'<span class="radio-inline"><input type="radio" name="tipo" value="ADM" title="N&iacute;vel de acesso"> Administrador</span>
                                                    <span class="radio-inline"><input type="radio" name="tipo" value="USR" title="N&iacute;vel de acesso" checked> Usu&aacute;rio</span>';
                                                }
                                            ?>
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
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyfuncionario);
                    ?> 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
    </body>
</html>