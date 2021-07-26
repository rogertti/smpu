<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Dados do habite-se</h4>
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

                                $pyhabitese = md5('idhabitese');                    
                                $sql = "SELECT * FROM habitese WHERE idhabitese = ".$_GET[''.$pyhabitese.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $lin = mysql_fetch_object($res);

                                        //invertendo data 00/00/0000   
                                        $ano = substr($lin->datado,0,4);
                                        $mes = substr($lin->datado,5,2);
                                        $dia = substr($lin->datado,8);
                                        $lin->datado = $dia."/".$mes."/".$ano;

                                        //selecionando os dados do protocolo
                                        $sql2 = "SELECT protocolo.codigo,imovel.inscricao,contribuinte.nome,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                            } 

                                        echo'
                                        <table class="table table-bordered table-striped fonted">
                                            <tr><th>Protocolo</th><td>'.$lin2->codigo.'</td><th>Endere&ccedil;o</th><td>'.$lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro.'</td></tr>
                                            <tr><th>Inscri&ccedil;&atilde;o</th><td>'.$lin2->inscricao.'</td><th>Lote</th><td>'.$lin2->lote.'</td></tr>
                                            <tr><th>Propriet&aacute;rio</th><td>'.$lin2->nome.'</td><th>Quadra</th><td>'.$lin2->quadra.'</td></tr>
                                            <tr><th>Requerente</th><td>'.$lin2->requerente.'</td><th>Loteamento</th><td>'.$lin2->loteamento.'</td></tr>
                                            <tr><th>Tipo de obra</th><td>'.$lin2->construcao.'</td><th>&Aacute;rea</th><td>'.$lin2->area.' m&sup2;</td></tr>
                                            <tr><th>Data</th><td>'.$lin->datado.' - '.$lin->hora.' h</td><th>Observa&ccedil;&atilde;o</th><td rowspan="2">'.$lin->observacao.'</td></tr>
                                            <tr><th>Situa&ccedil;&atilde;o</th><td>'.$lin->situacao.'</td></tr>

                                        </table>';

                                        //busca os itens
                                        $sql3 = "SELECT habitese_has_item_habitese.situacao,item_habitese.descricao FROM habitese,habitese_has_item_habitese,item_habitese WHERE item_habitese.iditem_habitese = habitese_has_item_habitese.item_habitese_iditem_habitese AND habitese.idhabitese = habitese_has_item_habitese.habitese_idhabitese AND habitese.idhabitese = ".$lin->idhabitese." AND item_habitese.monitor = 'O' ORDER BY item_habitese.descricao";
                                        $res3 = mysql_query($sql3);
                                        $ret3 = mysql_num_rows($res3);

                                            if($ret3 != 0) {
                                                echo'
                                                <table class="table table-bordered table-striped fonted">';

                                                    while($lin3 = mysql_fetch_object($res3)) {
                                                        echo'<tr><td>'.$lin3->descricao.'</td><td style="width: 100px;">'.$lin3->situacao.'</td></tr>';
                                                    }

                                                echo'</table>';
                                            }

                                        //fotos
                                        $dir = 'habitese/'.$lin->album.'/'; 

                                            if(file_exists($dir)) { 
                                                $pon = opendir($dir);

                                                    while ($nitens = readdir($pon)) {
                                                        $itens[] = $nitens;
                                                    }

                                                sort($itens);

                                                    foreach ($itens as $listar) {
                                                        if ($listar != "." && $listar != "..") { 
                                                            $arquivos[] = $listar; 
                                                        }
                                                    }

                                                    if (!empty($arquivos)) {
                                                        echo'<div class="col-md-12 thumb">';  

                                                            foreach($arquivos as $listar) {
                                                                if (strstr($listar,'tb-')) {
                                                                    $opt = substr($listar,3);
                                                                    print'<div class="col-md-2 thumbnail"><img src="'.$dir.''.$listar.'"></a></div>';
                                                                }
                                                            }

                                                        echo'</div>';
                                                    }

                                                unset($pon,$nitens,$itens,$listar,$pastas,$n,$arquivos);
                                            }
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
    <a class="btn btn-primary" href="editaHabitese.php?<?php echo $pyhabitese; ?>=<?php echo $lin->idhabitese; ?>" target="_parent">Editar os dados</a>
</div>
<?php mysql_close($conexao); ?>