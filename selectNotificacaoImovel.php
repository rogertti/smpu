<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Notifica&ccedil;&otilde;es deste im&oacute;vel</h4>
</div>
<div class="modal-body">
    <!-- javascript desabilitado -->
    <noscript><div class="script-less"><p><?php echo $cfg['noscript']; ?></p></div></noscript>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side strech">                
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-body">
                            <?php
                                include_once('conexao.php');

                                $pyimovel = md5('idimovel');

                                $sql = "SELECT * FROM fiscalizacao WHERE imovel_idimovel = ".$_GET[''.$pyimovel.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $pyfiscalizacao = md5('idfiscalizacao');
                                        $pyembargo = md5('idembargo');
                                        $modal = '';
                                        
                                        echo'
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Inscri&ccedil;&atilde;o</th>
                                                    <th>N&uacute;mero</th>
                                                    <th>Data/Hora</th>
                                                    <th>Propriet&aacute;rio</th>
                                                    <th>Retorno</th>
                                                    <th style="width: 60px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                        
                                            while($lin = mysql_fetch_object($res)) {
                                                //invertendo data 00/00/0000   
                                                $ano = substr($lin->datado,0,4);
                                                $mes = substr($lin->datado,5,2);
                                                $dia = substr($lin->datado,8);
                                                $lin->datado = $dia."/".$mes."/".$ano;

                                                //contador
                                                $ultimo = date("t",mktime(0,0,0,$mes,'01',$ano));
                                                $soma = $dia + $lin->prazo;

                                                    if($soma > 31) {
                                                        $dia = $ultimo - $dia;
                                                        $dia = abs($dia - $lin->prazo);
                                                        $mes = $mes + 1;

                                                            if($dia < 10) { $dia = '0'.$dia; }
                                                            if($mes < 10) { $mes = '0'.$mes; }
                                                    }
                                                    else {
                                                        $dia = $soma;

                                                            if($dia < 10) { $dia = '0'.$dia; }
                                                    }

                                                $inicio = date("Y-m-d");
                                                $fim = $ano."-".$mes."-".$dia;
                                                $dif = strtotime($fim) - strtotime($inicio);
                                                $prazo = floor($dif / (60 * 60 * 24));

                                                    //ordenando o prazo
                                                    if($prazo == 0) { $prazo = '<span class="label label-default">Hoje &eacute; dia de vistoriar a obra</span>'; }
                                                    if($prazo < 0) { $prazo = abs($prazo); $prazo = '<span class="label label-warning">H&aacute; <strong>'.$prazo.'</strong> dia(s) a obra deveria ter sido vistoriada</span>'; }
                                                    if($prazo > 0) { $prazo = '<span class="label label-primary">Falta(m) <strong>'.$prazo.'</strong> dia(s) para vistoriar a obra</span>'; }

                                                //busca a inscricao
                                                $sql2 = "SELECT imovel.inscricao,contribuinte.nome FROM contribuinte,imovel,fiscalizacao WHERE fiscalizacao.imovel_idimovel = imovel.idimovel AND imovel.contribuinte_idcontribuinte = contribuinte.idcontribuinte AND imovel.idimovel = ".$lin->imovel_idimovel."";
                                                $res2 = mysql_query($sql2);
                                                $ret2 = mysql_num_rows($res2);

                                                    if($ret2 != 0) {
                                                        $lin2 = mysql_fetch_object($res2);
                                                        $inscricao = $lin2->inscricao;
                                                        $contribuinte = $lin2->nome;
                                                    } 
                                                    else {
                                                        $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                                        $contribuinte = 'Contribuinte inv&aacute;lido';
                                                    }

                                                //verifica se houve embargo
                                                $sql3 = "SELECT embargo.idembargo,embargo.situacao FROM embargo,fiscalizacao WHERE embargo.fiscalizacao_idfiscalizacao = fiscalizacao.idfiscalizacao AND fiscalizacao.idfiscalizacao = ".$lin->idfiscalizacao."";
                                                $res3 = mysql_query($sql3);
                                                $ret3 = mysql_num_rows($res3);

                                                    if($ret3 != 0) {
                                                        $lin3 = mysql_fetch_object($res3);

                                                            if($lin3->situacao == 'Embargada') {
                                                                $embargo = '<a class="tt" title="Desembargar a obra" href="editaEmbargo.php?'.$pyembargo.'='.$lin3->idembargo.'" style="color: red;"><i class="fa fa-ban"></i></a>';
                                                                $prazo = '<span class="label label-danger">Obra embargada</span>';
                                                            }

                                                            if($lin3->situacao == 'Desembargada') {
                                                                $embargo = '<a class="tt" title="Embargar a obra" href="editaEmbargo.php?'.$pyembargo.'='.$lin3->idembargo.'"><i class="fa fa-ban"></i></a>';
                                                            }
                                                    } 
                                                    else {
                                                        $embargo = '<a class="tt" title="Embargar a obra" href="novoEmbargo.php?'.$pyfiscalizacao.'='.$lin->idfiscalizacao.'"><i class="fa fa-ban"></i></a>';
                                                    }

                                                    //verifica se foi corrigido
                                                    if($lin->monitor == 'O') {
                                                        $corrigi = '<a class="rghntf tt" id="rgh-'.$lin->idfiscalizacao.'" title="Corrigir a notifica&ccedil;&atilde;o" href="#"><i class="fa fa-check"></i></a>';
                                                    }
                                                    else {
                                                        $corrigi = '<a class="tt" title="Notifica&ccedil;&atilde;o corrigida" href="#"><i class="fa fa-check" style="color: green;"></i></a>';
                                                        $embargo = '';
                                                        $prazo = '<span class="label label-success">Obra regular</span>';
                                                    }

                                                echo'
                                                <tr>
                                                    <td>'.$inscricao.'</td>
                                                    <td>'.$lin->notificacao.'</td>
                                                    <td>'.$lin->datado.' - '.$lin->hora.' h</td>
                                                    <td>'.$contribuinte.'</td>
                                                    <td>'.$prazo.'</td>
                                                    <td>
                                                        '.$embargo.'
                                                        <!--'.$corrigi.'-->
                                                        <a class="tt" title="Imprimir a notifica&ccedil;&atilde;o" href="printNotificacao.php?'.$pyfiscalizacao.'='.$lin->idfiscalizacao.'"><i class="fa fa-print"></i></a>
                                                        <!--<a data-toggle="modal" data-target="#dados-notificacao-'.$lin->idfiscalizacao.'" class="tt" title="Ver os dados da notifica&ccedil;&atilde;o" href="dadosNotificacao.php?'.$pyfiscalizacao.'='.$lin->idfiscalizacao.'"><i class="fa fa-bars"></i></a>-->
                                                        <a class="tt" title="Editar os dados da notifica&ccedil;&atilde;o" href="editaNotificacao.php?'.$pyfiscalizacao.'='.$lin->idfiscalizacao.'"><i class="fa fa-pencil"></i></a>
                                                        <!--<a class="delntf tt" id="del-'.$lin->idfiscalizacao.'" title="Excluir a notifica&ccedil;&atilde;o" href="#"><i class="fa fa-trash-o"></i></a>-->
                                                    </td>
                                                </tr>';

                                                $modal .= '
                                                <!-- Modal dados -->
                                                <div class="modal fade" id="dados-notificacao-'.$lin->idfiscalizacao.'" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content"></div>
                                                    </div>
                                                </div>';

                                                unset($inscricao,$contribuinte,$embargo,$corrigi,$dia,$mes,$ano,$sql2,$res2,$ret2,$lin2,$inicio,$fim,$prazo,$ultimo,$dif,$soma);
                                            }
                                        
                                            echo'
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Inscri&ccedil;&atilde;o</th>
                                                    <th>N&uacute;mero</th>
                                                    <th>Data/Hora</th>
                                                    <th>Propriet&aacute;rio</th>
                                                    <th>Retorno</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>';
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                            <?php
                                    } #$ret
                                
                                #echo $modal; unset($modal);
                            ?>
            </section>
        </aside>
    </div>
</div>
<div class="modal-footer">
    <!--<a class="btn btn-primary" href="editaNotificacao.php?<?php echo $pyimovel; ?>=<?php echo $lin->idfiscalizacao; ?>" target="_parent">Editar os dados</a>-->
</div>
<?php mysql_close($conexao); ?>