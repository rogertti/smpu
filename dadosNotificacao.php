<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Dados da notifica&ccedil;&atilde;o</h4>
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

                                $pyfiscalizacao = md5('idfiscalizacao');

                                $sql = "SELECT * FROM fiscalizacao WHERE idfiscalizacao = ".$_GET[''.$pyfiscalizacao.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $lin = mysql_fetch_object($res);

                                        //invertendo data 00/00/0000   
                                        $ano = substr($lin->datado,0,4);
                                        $mes = substr($lin->datado,5,2);
                                        $dia = substr($lin->datado,8);
                                        $lin->datado = $dia."/".$mes."/".$ano;

                                        //busca a inscricao
                                        $sql2 = "SELECT imovel.inscricao,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM imovel,fiscalizacao WHERE fiscalizacao.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$lin->imovel_idimovel."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                                $inscricao = $lin2->inscricao;
                                            } 
                                            else {
                                                $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                            }

                                        //verifica se houve embargo
                                        /*$sql3 = "SELECT embargo.idembargo FROM embargo,fiscalizacao WHERE embargo.fiscalizacao_idfiscalizacao = fiscalizacao.idfiscalizacao AND fiscalizacao.idfiscalizacao = ".$lin[0]."";
                                        $res3 = mysql_query($sql3);
                                        $ret3 = mysql_num_rows($res3);

                                            if($ret3 != 0) {
                                                $embargo = '<a class="tt" title="Obra embargada" href="#"><i class="fa fa-ban"></i></a>';
                                            } 
                                            else {
                                                $embargo = '';
                                            }*/
                                        echo'
                                        <table class="table table-bordered table-striped fonted">
                                            <tr><th>Inscri&ccedil;&atilde;o do im&oacute;vel</th><td>'.$inscricao.'</td><th>Endere&ccedil;o</th><td>'.$lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro.'</td></tr>
                                            <tr><th>N&uacute;mero da notifica&ccedil;&atilde;o</th><td>'.$lin->notificacao.'</td><th>Lote</th><td>'.$lin2->lote.'</td></tr>
                                            <tr><th>Data/Hora</th><td>'.$lin->datado.' - '.$lin->hora.' h</td><th>Quadra</th><td>'.$lin2->quadra.'</td></tr>
                                            <tr><th>Respons&aacute;vel</th><td>'.$lin->responsavel.'</td><th>Loteamento</th><td>'.$lin2->loteamento.'</td></tr>
                                            <tr><th>Situa&ccedil;&atilde;o</th><td colspan="3">'.$lin->situacao.'</td></tr>
                                            <tr><th>Receptor</th><td colspan="3">'.$lin->receptor.'</td></tr>
                                            <tr><th>Medidas</th><td><pre class="prefy">'.$lin->medida.'</pre></td><th>Prazo</th><td><pre class="prefy">'.$lin->prazo.'</pre></td></tr>
                                        </table>';

                                        //busca os motivos
                                        $sql4 = "SELECT infracao.nivel,infracao.descricao FROM fiscalizacao,fiscalizacao_has_infracao,infracao WHERE infracao.idinfracao = fiscalizacao_has_infracao.infracao_idinfracao AND fiscalizacao.idfiscalizacao = fiscalizacao_has_infracao.fiscalizacao_idfiscalizacao AND fiscalizacao.idfiscalizacao = ".$lin->idfiscalizacao." ORDER BY infracao.nivel DESC";
                                        $res4 = mysql_query($sql4);
                                        $ret4 = mysql_num_rows($res4);

                                            if($ret4 != 0) {
                                                echo'
                                                <table class="table table-bordered table-striped fonted">
                                                    <tr><th colspan="2">Motivos</th></tr>';

                                                    while($lin4 = mysql_fetch_object($res4)) {
                                                        echo'<tr><td>'.$lin4->nivel.'</td> <td>'.$lin4->descricao.'</td></tr>';
                                                    }

                                                echo'</table>';
                                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                            <?php
                                    //fotos
                                    $dir = 'fiscal/'.$lin->album.'/'; 

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
                                                    echo'<div class="row"><div class="col-md-12 thumb">';  

                                                        foreach($arquivos as $listar) {
                                                            if (strstr($listar,'tb-')) {
                                                                $opt = substr($listar,3);
                                                                print'<div class="col-md-2 thumbnail"><img src="'.$dir.''.$listar.'"></a></div>';
                                                            }
                                                        }

                                                    echo'</div></div>';
                                                }

                                            unset($pon,$nitens,$itens,$listar,$pastas,$n,$arquivos);
                                        }
                                    } #$ret
                            ?>
            </section>
        </aside>
    </div>
</div>
<div class="modal-footer">
    <a class="btn btn-primary" href="editaNotificacao.php?<?php echo $pyfiscalizacao; ?>=<?php echo $lin->idfiscalizacao; ?>" target="_parent">Editar os dados</a>
</div>
<?php mysql_close($conexao); ?>
