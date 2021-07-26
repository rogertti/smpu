<?php require_once('config.php'); if (empty($_SESSION['key'])) { header('location:./'); } $mn = '7a'; ?>
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
                    <h1>Edita an&aacute;lise de projeto <small><i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio</small></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                        include_once('conexao.php');
                                            
                        $pyanalise = md5('idanalise');
                                            
                        $sql = "SELECT * FROM analise WHERE idanalise = ".$_GET[''.$pyanalise.'']."";
                        $res = mysql_query($sql);
                        $ret = mysql_num_rows($res);
                                            
                            if($ret != 0) {
                                $lin = mysql_fetch_object($res);
                                
                                if(!empty($lin->datado)) {
                                    //invertendo a data 00/00/0000
                                    $ano = substr($lin->datado,0,4);
                                    $mes = substr($lin->datado,5,2);
                                    $dia = substr($lin->datado,8);
                                    $lin->datado = $dia."/".$mes."/".$ano;
                                    unset($ano,$mes,$dia);
                                }
                                
                                //selecionando os dados do protocolo
                                $sql2 = "SELECT protocolo.codigo,imovel.inscricao,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento,contribuinte.nome FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                                $res2 = mysql_query($sql2);
                                $ret2 = mysql_num_rows($res2);
                                    
                                    if($ret2 != 0) {
                                        $lin2 = mysql_fetch_object($res2);
                                    }

                                //selecionando os dados do engenheiro
                                $sql3 = "SELECT telefone,email FROM engenheiro WHERE nome = '".$lin->responsavel."'";
                                $res3 = mysql_query($sql3);
                                $ret3 = mysql_num_rows($res3);

                                    if($ret3 != 0) {
                                        $lin3 = mysql_fetch_object($res3);
                                    }
                    ?>
                    <form class="edita-analise">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input addon -->
                                <div class="box box-info">
                                    <div class="box-body">
                                        <input type="hidden" id="idanalise" value="<?php echo $lin->idanalise; ?>">
                                        <input type="hidden" id="autentico" value="<?php echo md5(microtime()); ?>">
                                        <input type="hidden" id="ultimo_usuario" value="<?php echo base64_decode($_SESSION['name']); ?>">
                                        <input type="hidden" id="historico_arquitetonico" value="<?php echo $lin->arquitetonico; ?>">
                                        <input type="hidden" id="historico_hidrosanitario" value="<?php echo $lin->hidrosanitario; ?>">
                                        
                                        <div class="form-group">
                                            <label>Protocolo</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="hidden" id="idprotocolo" value="<?php echo $lin->protocolo_idprotocolo; ?>">
                                                <input type="text" id="protocolo_analise" class="form-control" value="<?php echo $lin2->codigo; ?>" maxlength="9" title="Protocolo" placeholder="Protocolo" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data da an&aacute;lise</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                <input type="text" id="datado" class="form-control" value="<?php echo $lin->datado; ?>" maxlength="10" title="Data da an&aacute;lise" placeholder="Data da an&aacute;lise" required />
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
                                            <label>Situa&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-3 col-lg-2">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <select class="form-control" id="situacao" title="Situa&ccedil;&atilde;o">
                                                <?php
                                                    if($lin->situacao == 'Pré-análise') { echo'<option value="Pr&eacute;-an&aacute;lise" selected>Pr&eacute;-an&aacute;lise</option>'; } else { echo'<option value="Pr&eacute;-an&aacute;lise">Pr&eacute;-an&aacute;lise</option>'; }
                                                    if($lin->situacao == 'Análise') { echo'<option value="An&aacute;lise" selected>An&aacute;lise</option>'; } else { echo'<option value="An&aacute;lise">An&aacute;lise</option>'; }
                                                    if($lin->situacao == 'Reanálise') { echo'<option value="Rean&aacute;lise" selected>Rean&aacute;lise</option>'; } else { echo'<option value="Rean&aacute;lise">Rean&aacute;lise</option>'; }
                                                    if($lin->situacao == 'Substituição') { echo'<option value="Substitui&ccedil;&atilde;o" selected>Substitui&ccedil;&atilde;o</option>'; } else { echo'<option value="Substitui&ccedil;&atilde;o">Substitui&ccedil;&atilde;o</option>'; }
                                                ?>        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Respons&aacute;vel t&eacute;cnico</label>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="hidden" id="idengenheiro">
                                                <input type="text" id="responsavel" class="form-control" value="<?php echo $lin->responsavel; ?>" maxlength="255" title="Respons&aacute;vel t&eacute;cnico pela execu&ccedil;&atilde;o da obra" placeholder="Respons&aacute;vel t&eacute;cnico pela execu&ccedil;&atilde;o da obra" />
                                            </div>
                                        </div>
                                        <div class="contain-engenheiro">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Telefone ou celular</span>
                                                        <input type="text" id="telefone_engenheiro" class="form-control" value="<?php echo $lin3->telefone; ?>" title="Telefone" placeholder="Telefone" disabled />
                                                    </div>
                                                    <br/>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">E-mail</span>
                                                        <input type="text" id="email_engenheiro" class="form-control" value="<?php echo $lin3->email; ?>" title="E-mail" placeholder="E-mail" disabled />
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ART ou RRT de execu&ccedil;&atilde;o</label>
                                            <div class="input-group col-md-3">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <input type="text" id="art_rrt" class="form-control" value="<?php echo $lin->art_rrt; ?>" maxlength="20" title="ART ou RRT de execu&ccedil;&atilde;o" placeholder="ART ou RRT de execu&ccedil;&atilde;o" />
                                            </div>
                                        </div>
                                        <?php
                                            //buscando as infracoes de grau minimo
                                            $sql2 = "SELECT iddocumentacao,descricao FROM documentacao WHERE monitor = 'O' ORDER BY descricao";
                                            $res2 = mysql_query($sql2);
                                            $ret2 = mysql_num_rows($res2);

                                                if($ret2 != 0) {
                                                    echo'
                                                    <div class="form-group">
                                                        <i class="fa fa-asterisk"></i>
                                                        <label for="documentacao">Documenta&ccedil;&atilde;o</label>
                                                    </div>
                                                    <table class="table">';

                                                        while($lin2 = mysql_fetch_object($res2)) {
                                                            //buscando os itens da documentacao selecionadas
                                                            $sql3 = "SELECT documentacao_iddocumentacao FROM analise_has_documentacao WHERE analise_idanalise = ".$lin->idanalise." AND documentacao_iddocumentacao = ".$lin2->iddocumentacao."";
                                                            $res3 = mysql_query($sql3);
                                                            $ret3 = mysql_num_rows($res3);

                                                                if($ret3 != 0) {
                                                                    echo'<tr><td><input type="checkbox" name="documentacao[]" value="'.$lin2->iddocumentacao.'" checked disabled></td> <td><a id="del-'.$lin2->iddocumentacao.'-'.$lin->idanalise.'" class="delitdcan tt" title="Desmarcar esse item" href="#"><i class="fa fa-trash-o"></i></a> '.$lin2->descricao.'</td></tr>';
                                                                    $documentacao = 1;
                                                                }
                                                                else {
                                                                    echo'<tr><td><input type="checkbox" name="documentacao[]" value="'.$lin2->iddocumentacao.'"></td> <td>'.$lin2->descricao.'</td></tr>';
                                                                }

                                                            unset($sql3,$res3,$ret3);
                                                        }

                                                    echo'</table><br/>
                                                    <input type="hidden" id="documentacao_checked" value="'.$documentacao.'">';
                                                }
                                                else {
                                                    $disabled = 'true';
                                                    echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                                }

                                            unset($sql2,$res2,$ret2,$lin2,$documentacao);
                                        ?>
                                        <div class="form-group">
                                            <label>Projeto arquitet&ocirc;nico - <a data-toggle="modal" data-target="#historico-analise" href="historicoAnalise.php?<?php echo $pyanalise; ?>=<?php echo $lin->idanalise; ?>&tipo=arquitetonico">Hist&oacute;rico do projeto arquitet&ocirc;nico</a></label>
                                            <div class="input-group arquitetonico">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control txtfx" id="arquitetonico" rows="6" title="Projeto arquitet&ocirc;nico" placeholder="Projeto arquitet&ocirc;nico"><?php echo $lin->arquitetonico; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Projeto hidrosanit&aacute;rio - <a data-toggle="modal" data-target="#historico-analise" href="historicoAnalise.php?<?php echo $pyanalise; ?>=<?php echo $lin->idanalise; ?>&tipo=hidrosanitario">Hist&oacute;rico do projeto hidrosanit&aacute;rio</a></label>
                                            <div class="input-group hidrosanitario">
                                                <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                                <textarea class="form-control txtfx" id="hidrosanitario" rows="6" title="Projeto hidrosanit&aacute;rio" placeholder="Projeto hidrosanit&aacute;rio"><?php echo $lin->hidrosanitario; ?></textarea>
                                            </div>
                                        </div>
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
                                                        <td><input type="radio" name="parecer" value="Analisado" checked> Analisado</td>';
                                                    }

                                                    if($lin->parecer == 'Analisado') {
                                                        echo'
                                                        <td><input type="radio" name="parecer" value="Com pend&ecirc;ncias"> Com pend&ecirc;ncias</td>
                                                        <td><input type="radio" name="parecer" value="Analisado" checked> Analisado</td>';
                                                    }
                                                ?>
                                                </tr>
                                            </table>
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
                        unset($conexao,$charset,$sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$pyanalise);
                    ?>  
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div class="modal fade" id="historico-analise" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"></div>
            </div>
        </div><!-- /.modal -->

        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Autocomplete -->
        <script src="js/autocomplete.min.js" type="text/javascript"></script>
        <!-- Datepicker -->
        <script src="js/datepicker.min.js" type="text/javascript"></script>
        <!-- WYSIHTML5 -->
        <script src="ckeditor/ckeditor.js"></script>
        <script src="js/ckeditor.init.min.js"></script>
        <!-- AdminLTE App -->
        <script src="js/app.js" type="text/javascript"></script>
        <script>
            $(function() {
                //$(".contain").hide();
                
                /* TOOLTIP */
                
                $(".tt").tooltip();
                
                /* EDITOR */
                
                /*$(".txtfx").summernote({
                    toolbar: [
                        //[groupname, [button list]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['fontsize', ['fontsize']],
                        //['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                    ]
                });*/
            });
        </script>
    </body>
</html>
