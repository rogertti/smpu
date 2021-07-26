<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Dados do im&oacute;vel</h4>
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
                                $sql = "SELECT * FROM imovel WHERE idimovel = ".$_GET[''.$pyimovel.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $lin = mysql_fetch_object($res);

                                        //busca o nome do contribuintes
                                        $sql2 = "SELECT contribuinte.nome FROM contribuinte,imovel WHERE imovel.contribuinte_idcontribuinte = contribuinte.idcontribuinte AND contribuinte.idcontribuinte = ".$lin->contribuinte_idcontribuinte."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                                $contribuinte = $lin2->nome;
                                            } 
                                            else {
                                                $contribuinte = 'Contribuinte inv&aacute;lido';
                                            }

                                        echo'
                                        <table class="table table-bordered table-striped fonted">
                                            <tr><th>Contribuinte</th><td>'.$contribuinte.'</td><th>Fra&ccedil;&atilde;o do terreno</th><td>'.$lin->fracao.'</td></tr>
                                            <tr><th>Inscri&ccedil;&atilde;o</th><td>'.$lin->inscricao.'</td><th>&Aacute;rea do lote</th><td>'.$lin->area_lote.' m&sup2;</td></tr>
                                            <tr><th>Matr&iacute;cula</th><td>'.$lin->matricula.'</td><th>&Aacute;rea da unidade</th><td>'.$lin->area_unidade.' m&sup2;</td></tr>
                                            <tr><th>Endere&ccedil;o</th><td>'.$lin->endereco.' - '.$lin->apto.' - '.$lin->complemento.' - '.$lin->edificio_condominio.' - '.$lin->bairro.'</td><th>&Aacute;rea do anexo</th><td>'.$lin->area_anexo.' m&sup2;</td></tr>
                                            <tr><th>Tipo de obra</th><td>'.$lin->tipo_obra.'</td><th>&Aacute;rea englobada</th><td>'.$lin->area_englobada.' m&sup2;</td></tr>
                                            <tr><th>Garagem</th><td>'.$lin->garagem.'</td><th>&Aacute;rea constru&iacute;da</th><td>'.$lin->area_construida.' m&sup2;</td></tr>
                                            <tr><th>Lote</th><td>'.$lin->lote.'</td><th>Habite-se</th><td>'.$lin->habitese.'</td></tr>
                                            <tr><th>Quadra</th><td>'.$lin->quadra.'</td><th>Testada</th><td>'.$lin->testada.'</td></tr>
                                            <tr><th>Loteamento</th><td>'.$lin->loteamento.'</td><th>Alvar&aacute;</th><td>'.$lin->alvara.'</td></tr>
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
    <a class="btn btn-primary" href="editaImovel.php?<?php echo $pyimovel ?>=<?php echo $lin->idimovel; ?>" target="_parent">Editar os dados</a>
</div>
<?php mysql_close($conexao); ?>