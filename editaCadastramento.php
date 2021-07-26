<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '10a'; ?>
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
        <!-- WYSIHTML5 -->
        <link href="css/summernote.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Edita cadastramento <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');

                        $pycadastramento = md5('idcadastramento');

                        $sql = "SELECT * FROM cadastramento WHERE idcadastramento = ".$_GET[''.$pycadastramento.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);

                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);

                                //invertendo a data 00/00/0000
                                $ano = substr($lin->data_alvara,0,4);
                                $mes = substr($lin->data_alvara,5,2);
                                $dia = substr($lin->data_alvara,8);
                                $lin->data_alvara = $dia."/".$mes."/".$ano;
                                unset($ano,$mes,$dia);

                                //invertendo a data 00/00/0000
                                $ano = substr($lin->data_habitese,0,4);
                                $mes = substr($lin->data_habitese,5,2);
                                $dia = substr($lin->data_habitese,8);
                                $lin->data_habitese = $dia."/".$mes."/".$ano;
                                unset($ano,$mes,$dia);

                                //selecionando os dados do protocolo
                                $sql2 = "SELECT protocolo.codigo,imovel.inscricao,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento,contribuinte.nome FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                                $res2 = mysql_query($sql2);
                                $ret2 = mysql_num_rows($res2);

                                    if($ret2 != 0) {
                                        $lin2 = mysql_fetch_object($res2);
                                    }
                    ?>
                    <form class="edita-cadastramento">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idcadastramento" value="<?php echo $lin->idcadastramento; ?>">

                                        <div class="form-group">
                                            <label>Protocolo</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idprotocolo" value="<?php echo $lin->protocolo_idprotocolo; ?>">
                                                <input type="text" id="protocolo_cadastramento" class="form-control" value="<?php echo $lin2->codigo; ?>" maxlength="9" title="Protocolo" placeholder="Protocolo" required />
                                            </div>
                                        </div>
                                        <div class="contain">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Inscri&ccedil;&atilde;o</span>
                                                        <input type="text" id="inscricao_analise" class="form-control" value="<?php echo $lin2->inscricao; ?>" title="Inscri&ccedil;&atilde;o" placeholder="Inscri&ccedil;&atilde;o" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Propriet&aacute;rio</span>
                                                        <input type="text" id="contribuinte" class="form-control" value="<?php echo $lin2->nome; ?>" title="Propriet&aacute;rio" placeholder="Propriet&aacute;rio" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Requerente</span>
                                                        <input type="text" id="requerente" class="form-control" value="<?php echo $lin2->requerente; ?>" title="Requerente" placeholder="Requerente" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Tipo de obra</span>
                                                        <input type="text" id="construcao" class="form-control" value="<?php echo $lin2->construcao; ?>" title="Tipo de obra" placeholder="Tipo de obra" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Endere&ccedil;o</span>
                                                        <input type="text" id="endereco" class="form-control" value="<?php echo $lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro; ?>" title="Endere&ccedil;o" placeholder="Endere&ccedil;o" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Lote</span>
                                                        <input type="text" id="lote" class="form-control" value="<?php echo $lin2->lote; ?>" title="Lote" placeholder="Lote" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Quadra</span>
                                                        <input type="text" id="quadra" class="form-control" value="<?php echo $lin2->quadra; ?>" title="Quadra" placeholder="Quadra" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Loteamento</span>
                                                        <input type="text" id="loteamento" class="form-control" value="<?php echo $lin2->loteamento; ?>" title="Loteamento" placeholder="Loteamento" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">&Aacute;rea</span>
                                                        <input type="text" id="area" class="form-control" value="<?php echo $lin2->area; ?> m&sup2;" title="&Aacute;rea" placeholder="&Aacute;rea" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alvar&aacute;</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="alvara" class="form-control" value="<?php echo $lin->alvara; ?>" maxlength="9" title="Alvar&aacute;" placeholder="Alvar&aacute;" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data do alvar&aacute;</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="data_alvara" class="form-control" value="<?php echo $lin->data_alvara; ?>" maxlength="9" title="Data do alvar&aacute;" placeholder="Data do alvar&aacute;" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Habite-se</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="habitese" class="form-control" value="<?php echo $lin->habitese; ?>" maxlength="9" title="Habite-se" placeholder="Habite-se" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data do habite-se</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="data_habitese" class="form-control" value="<?php echo $lin->data_habitese; ?>" maxlength="9" title="Data do habite-se" placeholder="Data do habite-se" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group col-md-3">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <table class="table">
                                                    <tr>
                                                    <?php
                                                        if($lin->parecer == 'Com pendências') {
                                                            echo'
                                                            <td><input type="radio" name="parecer" value="Com pend&ecirc;ncias" checked> Com pend&ecirc;ncias</td>
                                                            <td><input type="radio" name="parecer" value="Aprovado"> Aprovado</td>';
                                                        }

                                                        if($lin->parecer == 'Aprovado') {
                                                            echo'
                                                            <td><input type="radio" name="parecer" value="Com pend&ecirc;ncias"> Com pend&ecirc;ncias</td>
                                                            <td><input type="radio" name="parecer" value="Aprovado" checked> Aprovado</td>';
                                                        }
                                                    ?>
                                                    </tr>
                                                </table>
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
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$pycadastramento);
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
        <!-- Datepicker -->
        <script src="js/datepicker.min.js" type="text/javascript"></script>
        <!-- WYSIHTML5 -->
        <script src="js/summernote.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                $(".contain").hide();

                /* TOOLTIP */

                $(".tt").tooltip();
            });
        </script>
    </body>
</html>
