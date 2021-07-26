<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['criterio'])) { echo $msgnull; exit; } else { $filtro = 1; }
    
    if($filtro == 1) {
        //nao permitir ' ou "
        $_POST['criterio'] = str_replace("'","&#39;",$_POST['criterio']);
        $_POST['criterio'] = str_replace('"','&#34;',$_POST['criterio']);
        
        include_once('conexao.php');
        
        /*A busca serå divida em 3 partes: 
            - a primeira é pelo número do protocolo, ou seja, diretamente pelo protocolo, retornando os dados exatos.
            - a segunda é pela inscrição do imóvel, é uma busca exata, mas com vários resultados para a mesma matrícula.
            - a terceira é pelo nome ou documento do requerente, primeiro traz o nome do respectivo requerente e depois os protocolos atrelados ao requerente. */
        
        //primeira busca: protocolo
        
        $sql = "SELECT * FROM protocolo WHERE codigo = '".$_POST['criterio']."' AND monitor = 'O'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
                
            if($ret != 0) {
                $pyprotocolo = md5('idprotocolo');
                
                $lin = mysql_fetch_object($res);
                
                echo'                        
                <div class="row">        
                    <div class="col-md-12">
                        <!-- Input addon -->
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="input-group col-md-2">
                                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>';
                                    
                                        //busca a inscricao e o recolhimento
                                        $sql2 = "SELECT imovel.inscricao FROM imovel,requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                                echo'<input type="text" class="form-control" value="'.$lin2->inscricao.'" title="Inscri&ccedil;&atilde;o do im&oacute;vel" disabled />';
                                            } 
                                            else {
                                                echo'<span class="help-block">Inscri&ccedil;&atilde;o inv&aacute;lida</span>';
                                            }

                                        unset($sql2,$res2,$ret2,$lin2);
                                echo'    
                                </div>
                                <br/>
                                <div class="input-group col-md-4">
                                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>';
                                    
                                        $sql3 = "SELECT requerimento.recolhimento FROM requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
                                        $res3 = mysql_query($sql3);
                                        $ret3 = mysql_num_rows($res3);

                                            if($ret3 != 0) {
                                                $lin3 = mysql_fetch_object($res3);
                                                echo'<input type="text" class="form-control" value="'.$lin3->recolhimento.'" title="Recolhimento" disabled />';
                                            } 
                                            else {
                                                echo'<span class="help-block">N&atilde;o &eacute; poss&iacute;vel continuar.</span>';
                                            }

                                        unset($sql3,$res3,$ret3,$lin3);
                                echo'    
                                </div>
                                <br/>
                                <div class="input-group col-md-2">
                                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                    <input type="text" class="form-control" value="'.$lin->codigo.'" title="N&uacute;mero de protocolo" disabled />
                                </div>
                                <br/>
                                <div class="input-group col-md-2">
                                    <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                    <input type="text" class="form-control" value="'.$lin->taxa.'" title="Taxa" disabled />
                                </div>
                                <br/>
                                <div class="input-group col-md-6">
                                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                    <input type="text" class="form-control" value="'.$lin->situacao.'" title="Situa&ccedil;&atilde;o" disabled />
                                </div>
                                <br/>
                                <div class="input-group col-md-6">
                                    <span class="input-group-addon"><i class="fa fa-square-o"></i></span>
                                    <textarea class="form-control" rows="6" title="Observa&ccedil;&atilde;o" disabled>'.$lin->observacao.'</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="box-footer">
                            <a class="btn btn-primary" title="Editar os dados do protocolo" href="editaProtocolo.php?'.$pyprotocolo.'='.$lin->idprotocolo.'">Editar</a>
                            <a class="btn btn-default" title="Imprimir o protocolo" href="printProtocolo.php?'.$pyprotocolo.'='.$lin->idprotocolo.'">Imprimir</a>
                        </div>
                    </div>    
                </div>';
            }
            else {
                //segunda busca: inscrição

                $sql2 = "SELECT protocolo.idprotocolo,imovel.inscricao,requerimento.recolhimento,protocolo.codigo,protocolo.situacao FROM imovel,requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND protocolo.monitor = 'O' AND imovel.inscricao = '".$_POST['criterio']."'";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);
                
                    if($ret2 != 0) {
                        $pyprotocolo = md5('idprotocolo');

                        echo'
                        <!-- Data table -->
                        <link href="css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />
                        <!-- Colorbox -->
                        <link href="css/colorbox.min.css" rel="stylesheet" type="text/css" />

                        <div class="row">        
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Inscri&ccedil;&atilde;o</th>
                                                    <th>C&oacute;digo</th>
                                                    <th>Recolhimento</th>
                                                    <th>Situacao</th>
                                                    <th style="width: 43px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                                                while($lin2 = mysql_fetch_object($res2)) {
                                                    echo'
                                                    <tr>
                                                        <td>'.$lin2->inscricao.'</td>
                                                        <td>'.$lin2->codigo.'</td>
                                                        <td>'.$lin2->recolhimento.'</td>
                                                        <td>'.$lin2->situacao.'</td>
                                                        <td>
                                                            <a class="tt" title="Imprimir o protocolo" href="printProtocolo.php?'.$pyprotocolo.'='.$lin2->idprotocolo.'"><i class="fa fa-print"></i></a>
                                                            <a class="fr tt" title="Ver os dados do protocolo" href="dadosProtocolo.php?'.$pyprotocolo.'='.$lin2->idprotocolo.'"><i class="fa fa-bars"></i></a>
                                                            <a class="tt" title="Editar os dados do protocolo" href="editaProtocolo.php?'.$pyprotocolo.'='.$lin2->idprotocolo.'"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>';    
                                                }

                                            echo'
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Inscri&ccedil;&atilde;o</th>
                                                    <th>C&oacute;digo</th>
                                                    <th>Recolhimento</th>
                                                    <th>Situacao</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data table -->
                        <script src="js/datatables.min.js" type="text/javascript"></script>
                        <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
                        <!-- Colorbox -->
                        <script src="js/colorbox.min.js" type="text/javascript"></script>
                        <script type="text/javascript">
                            $(function() {
                                /* TABLE */

                                $(".table").dataTable({ "column": 5 });

                                /* TOOLTIP */

                                $(".tt").tooltip();

                                /* COLORBOX */

                                $(".fr").colorbox({iframe:true,width:"80%",height:"75%"});
                            });
                        </script>';
                    }
                    else {
                        // terceira busca: requerente/documento
                        
                        $sql3 = "SELECT idrequerimento,requerente,cpf_cnpj,telefone,email,recolhimento FROM requerimento WHERE (requerente like '%".$_POST['criterio']."%' OR cpf_cnpj like '%".$_POST['criterio']."%') AND monitor = 'O'";
                        $res3 = mysql_query($sql3);
                        $ret3 = mysql_num_rows($res3);
                        
                            if($ret3 != 0) {
                                $pyrequerimento = md5('idrequerimento');
                        
                                echo'
                                <!-- Data table -->
                                <link href="css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />
                                <!-- Colorbox -->
                                <link href="css/colorbox.min.css" rel="stylesheet" type="text/css" />

                                <div class="row">        
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="box-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 80px;">Protocolos</th>
                                                            <th>Requerente</th>
                                                            <th>Documento</th>
                                                            <th>Recolhimento</th>
                                                            <th>Telefone</th>
                                                            <th>E-mail</th>
                                                            <th style="width: 15px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                        while($lin3 = mysql_fetch_object($res3)) {
                                                            //sql para verificar quantos protocolos estão disponíveis para tal requerente
                                                            $sql4 = "SELECT COUNT(idprotocolo) AS total FROM requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.idrequerimento = ".$lin3->idrequerimento." AND protocolo.monitor = 'O'";
                                                            $res4 = mysql_query($sql4);
                                                            $ret4 = mysql_num_rows($res4);
                                                            
                                                                if($ret4 != 0) {
                                                                    $lin4 = mysql_fetch_row($res4);
                                                                    $prt = $lin4->total;
                                                                }
                                                                else {
                                                                    $prt = 0;
                                                                }
                                                            
                                                            echo'
                                                            <tr>
                                                                <td>'.$prt.'</td>
                                                                <td>'.$lin3->requerente.'</td>
                                                                <td>'.$lin3->cpf_cnpj.'</td>
                                                                <td>'.$lin3->recolhimento.'</td>
                                                                <td>'.$lin3->telefone.'</td>
                                                                <td>'.$lin3->email.'</td>
                                                                <td>
                                                                    <a class="tt" title="Visualizar os protocolos do requerente" href="searchOdd.php?'.$pyrequerimento.'='.$lin3->idrequerimento.'"><i class="fa fa-ticket"></i></a>
                                                                </td>
                                                            </tr>'; 
                                                        }

                                                    echo'
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Protocolos</th>
                                                            <th>Requerente</th>
                                                            <th>Documento</th>
                                                            <th>Recolhimento</th>
                                                            <th>Telefone</th>
                                                            <th>E-mail</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data table -->
                                <script src="js/datatables.min.js" type="text/javascript"></script>
                                <script src="js/datatables.bootstrap.min.js" type="text/javascript"></script>
                                <!-- Colorbox -->
                                <script src="js/colorbox.min.js" type="text/javascript"></script>
                                <script type="text/javascript">
                                    $(function() {
                                        /* TABLE */

                                        $(".table").dataTable({ "column": 7 });

                                        /* TOOLTIP */

                                        $(".tt").tooltip();

                                        /* COLORBOX */

                                        $(".fr").colorbox({iframe:true,width:"80%",height:"75%"});
                                    });
                                </script>';
                            }
                            else {
                                echo'
                                <div class="alert alert-info alert-dismissable" style="display: block;">
                                    <i class="fa fa-info"></i>
                                    <b>Aviso!</b> Nada encontrado, tente <a href="novoProtocolo.php">abrir um novo protocolo</a>.
                                </div>';    
                            }
                    }
            } //else 2
        
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$pyprotocolo,$pyrequerimento,$prt);
    }
    else {
        echo'Tente novamente.';
    }
    
    unset($msgnull,$filtro);
?>