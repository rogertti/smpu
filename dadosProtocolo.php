<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Dados do protocolo</h4>
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

                                $pyprotocolo = md5('idprotocolo');                    
                                $sql = "SELECT * FROM protocolo WHERE idprotocolo = ".$_GET[''.$pyprotocolo.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $lin = mysql_fetch_object($res);

                                        //busca a inscricao e o recolhimento
                                        $sql2 = "SELECT imovel.inscricao,requerimento.recolhimento FROM imovel,requerimento,protocolo WHERE protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND requerimento.idrequerimento = ".$lin->requerimento_idrequerimento."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                                $inscricao = $lin2->inscricao;
                                                $recolhimento = $lin2->recolhimento;
                                            } 
                                            else {
                                                $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                                $recolhimento = 'Recolhimento inv&aacute;lido';
                                            }

                                        echo'
                                        <table class="table table-bordered table-striped fonted">
                                            <tr><th>N&uacute;mero do protocolo</th><td>'.$lin->codigo.'</td></tr>
                                            <tr><th>Inscri&ccedil;&atilde;o do im&oacute;vel</th><td>'.$inscricao.'</td></tr>
                                            <tr><th>Recolhimento</th><td>'.$recolhimento.'</td></tr>
                                            <tr><th>Taxa</th><td>R$ '.$lin->taxa.'</td></tr>
                                            <tr><th>Situa&ccedil;&atilde;o</th><td>'.$lin->situacao.'</td></tr>
                                            <tr><th>Observa&ccedil;&atilde;o</th><td>'.$lin->observacao.'</td></tr>
                                        </table>';
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
    <a class="btn btn-primary" href="editaProtocolo.php?<?php echo $pyprotocolo; ?>=<?php echo $lin->idprotocolo; ?>" target="_parent">Editar os dados</a>
    <a class="btn btn-primary" href="printDadosProtocolo.php?<?php echo $pyprotocolo; ?>=<?php echo $lin->idprotocolo; ?>" target="_parent">Imprimir os dados</a>
</div>
<?php mysql_close($conexao); ?>