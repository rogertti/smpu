<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Dados da an&aacute;lise</h4>
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

                                $pyanalise = md5('idanalise');                    
                                $sql = "SELECT * FROM analise WHERE idanalise = ".$_GET[''.$pyanalise.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $lin = mysql_fetch_object($res);

                                        $lin->arquitetonico = str_replace("&nbsp;","",$lin->arquitetonico);
                                        $lin->hidrosanitario = str_replace("&nbsp;","",$lin->hidrosanitario);

                                        if(!empty($lin->datado)) {
                                            //invertendo a data 00/00/0000
                                            $ano = substr($lin->datado,0,4);
                                            $mes = substr($lin->datado,5,2);
                                            $dia = substr($lin->datado,8);
                                            $lin->datado = $dia."/".$mes."/".$ano;
                                        }

                                        //selecionando os dados do protocolo
                                        $sql2 = "SELECT protocolo.codigo,imovel.inscricao,contribuinte.nome,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                            } 

                                        //buscando a documentação
                                        $sql3 = "SELECT iddocumentacao,descricao FROM documentacao WHERE monitor = 'O' ORDER BY descricao";
                                        $res3 = mysql_query($sql3);
                                        $ret3 = mysql_num_rows($res3);

                                            if($ret3 != 0) {
                                                $documentacao = '';

                                                    while($lin3 = mysql_fetch_object($res3)) {
                                                        //buscando os itens da documentacao selecionadas
                                                        $sql4 = "SELECT documentacao_iddocumentacao FROM analise_has_documentacao WHERE analise_idanalise = ".$lin->idanalise." AND documentacao_iddocumentacao = ".$lin3->iddocumentacao."";
                                                        $res4 = mysql_query($sql4);
                                                        $ret4 = mysql_num_rows($res4);

                                                            if($ret4 != 0) {
                                                                $documentacao .= '&radic; '.$lin3->descricao.'<br>';
                                                            }
                                                            else {
                                                                $documentacao .= '&times; '.$lin3->descricao.'<br>';
                                                            }

                                                        unset($sql4,$res4,$ret4);
                                                    }
                                            }

                                        echo'
                                        <table class="table table-bordered table-striped fonted">
                                            <tr><th>Protocolo</th><td style="width: 450px;">'.$lin2->codigo.'</td><th style="width: 100px;">Endere&ccedil;o</th><td>'.$lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro.'</td></tr>
                                            <tr><th>Inscri&ccedil;&atilde;o</th><td>'.$lin2->inscricao.'</td><th>Lote</th><td>'.$lin2->lote.'</td></tr>
                                            <tr><th>Propriet&aacute;rio</th><td>'.$lin2->nome.'</td><th>Quadra</th><td>'.$lin2->quadra.'</td></tr>
                                            <tr><th>Requerente</th><td>'.$lin2->requerente.'</td><th>Loteamento</th><td>'.$lin2->loteamento.'</td></tr>
                                            <tr><th>Tipo de obra</th><td>'.$lin2->construcao.'</td><th>&Aacute;rea</th><td>'.$lin2->area.' m&sup2;</td></tr>
                                            <tr><th>Situa&ccedil;&atilde;o</th><td>'.$lin->situacao.'</td><th>ART/RRT</th><td>'.$lin->art_rrt.'</td></tr>
                                            <tr><th>Respons&aacute;vel</th><td>'.$lin->responsavel.'</td><th>Parecer</th><td>'.$lin->parecer.'</td></tr>
                                            <tr><th>Data</th><td colspan="3">'.$lin->datado.'</td></tr>
                                            <tr><th>Documenta&ccedil;&atilde;o</th><td colspan="3">'.$documentacao.'</td></tr>
                                            <tr><th>Projeto Arquitet&ocirc;nico</th><td colspan="3">'.htmlspecialchars_decode($lin->arquitetonico).'</td></tr>
                                            <tr><th>Projeto Hidrosanit&aacute;rio</th><td colspan="3">'.htmlspecialchars_decode($lin->hidrosanitario).'</td></tr>
                                        </table>';

                                        unset($lin,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$sql4,$res4,$ret4,$documentacao);
                                    }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>
</div>
<div class="modal-footer">
    <a class="btn btn-primary" href="editaAnalise.php?<?php echo $pyanalise ?>=<?php echo $lin->idanalise; ?>" target="_parent">Editar os dados</a>
</div>
<?php mysql_close($conexao); ?>
