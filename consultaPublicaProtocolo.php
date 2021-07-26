<?php
    require_once('config.php');
    #if(isset($_SESSION['key'])) { header('location:inicio.php'); }
?>
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
    <body>
        <section class="content invoice">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-inline form-protocolo-publico">
                        <div class="form-group">
                            <label for="protocolo">Buscar dados do protocolo</label>
                            <input type="text" id="protocolo" class="form-control" maxlength="9" title="Buscar dados do protocolo" placeholder="Protocolo" pattern="[0-9]{4}/[0-9]{4}" required>
                            <button type="submit" class="btn bg-olive btn-submit">Buscar</button>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 public"></div>
            </div>
        </section>
        
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        
        <!-- App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            (function($) {
                var fade = 300;
                
                /* CONSULTA PUBLICA PROTOCOLO */

                $(".form-protocolo-publico").submit(function () {
                    $(".btn-submit").html('<img src="img/loader.gif">').fadeTo(fade, 1);

                    $.post("consultaPublicaProtocoloResult.php", { protocolo:$("#protocolo").val(),rand:Math.random() }, function(data){    
                        $(".public").fadeTo(fade,0.1,function () {
                            $(this).html(data).fadeTo(fade, 1);
                        });
                    });

                    $(".btn-submit").html('Buscar').fadeTo(fade, 1);
                    return false;
                });
            }(jQuery));
        </script>
        <!--[if IE 9]><script>$(".browse").show();</script><![endif]-->
    </body>
</html>