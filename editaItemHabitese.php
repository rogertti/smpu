<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = 1; ?>
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
                    <h1>Edita item do habite-se <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyitemhabitese = md5('iditemhabitese');
                                            
                        $sql = "SELECT * FROM item_habitese WHERE iditem_habitese = ".$_GET[''.$pyitemhabitese.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                    ?>
                    <form class="edita-item-habitese">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="iditemhabitese" value="<?php echo $lin->iditem_habitese; ?>">
                                        
                                        <div class="form-group">
                                            <label>Descri&ccedil;&atilde;o</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <textarea class="form-control" id="descricao" rows="6" title="Descri&ccedil;&atilde;o" placeholder="Descri&ccedil;&atilde;o" required><?php echo $lin->descricao; ?></textarea>
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
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$pyitemhabitese);
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