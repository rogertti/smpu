<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Dados do requerimento</h4>
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

                                $pyrequerimento = md5('idrequerimento');                    
                                $sql = "SELECT * FROM requerimento WHERE idrequerimento = ".$_GET[''.$pyrequerimento.'']."";
                                $res = mysql_query($sql);
                                $ret = mysql_num_rows($res);

                                    if($ret != 0) {
                                        $lin = mysql_fetch_object($res);

                                        //invertendo data 00/00/0000   
                                        $ano = substr($lin->entrada,0,4);
                                        $mes = substr($lin->entrada,5,2);
                                        $dia = substr($lin->entrada,8);
                                        $lin->entrada = $dia."/".$mes."/".$ano;

                                        $ano = substr($lin->vencimento,0,4);
                                        $mes = substr($lin->vencimento,5,2);
                                        $dia = substr($lin->vencimento,8);
                                        $lin->vencimento = $dia."/".$mes."/".$ano;

                                        //busca a inscricao
                                        $sql2 = "SELECT imovel.inscricao FROM imovel,requerimento WHERE requerimento.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$lin->imovel_idimovel."";
                                        $res2 = mysql_query($sql2);
                                        $ret2 = mysql_num_rows($res2);

                                            if($ret2 != 0) {
                                                $lin2 = mysql_fetch_object($res2);
                                                $inscricao = $lin2->inscricao;
                                            } 
                                            else {
                                                $inscricao = 'Inscri&ccedil;&atilde;o inv&aacute;lida';
                                            }

                                        //busca o engenheiro
                                        $sql3 = "SELECT engenheiro.nome FROM engenheiro,requerimento WHERE requerimento.engenheiro_idengenheiro = engenheiro.idengenheiro AND engenheiro.idengenheiro = ".$lin->engenheiro_idengenheiro."";
                                        $res3 = mysql_query($sql3);
                                        $ret3 = mysql_num_rows($res3);

                                            if($ret3 != 0) {
                                                $lin3 = mysql_fetch_object($res3);
                                                $engenheiro = $lin3->nome;
                                            } 
                                            else {
                                                $engenheiro = 'Engenheiro inv&aacute;lido';
                                            }

                                        //busca o funcionario
                                        $sql4 = "SELECT funcionario.nome FROM funcionario,requerimento WHERE requerimento.funcionario_idfuncionario = funcionario.idfuncionario AND funcionario.idfuncionario = ".$lin->funcionario_idfuncionario."";
                                        $res4 = mysql_query($sql4);
                                        $ret4 = mysql_num_rows($res4);

                                            if($ret4 != 0) {
                                                $lin4 = mysql_fetch_object($res4);
                                                $funcionario = $lin4->nome;
                                            } 
                                            else {
                                                $funcionario = 'Funcion&aacute;rio inv&aacute;lido';
                                            }

                                        echo'
                                        <table class="table table-bordered table-striped fonted">
                                            <tr><th>Inscri&ccedil;&atilde;o</th><td>'.$inscricao.'</td><th>Complementar</th><td>'.$lin->referencia.'</td></tr>
                                            <tr><th>Requerente</th><td>'.$lin->requerente.' - '.$lin->cpf_cnpj.'</td><th>Alvar&aacute;</th><td>'.$lin->alvara.'</td></tr>
                                            <tr><th>Telefone</th><td>'.$lin->telefone.'</td><th>Entrada</th><td>'.$lin->entrada.' - '.$lin->hora.' h</td></tr>
                                            <tr><th>E-mail</th><td>'.$lin->email.'</td><th>Constru&ccedil;&atilde;o</th><td>'.$lin->construcao.'</td></tr>
                                            <tr><th>Engenheiro</th><td>'.$engenheiro.'</td><th>&Aacute;rea</th><td>'.$lin->area.' m&sup2;</td></tr>
                                            <tr><th>Funcion&aacute;rio</th><td>'.$funcionario.'</td><th>Vencido</th><td>'.$lin->vencido.'</td></tr>
                                            <tr><th>Recolhimento</th><td>'.$lin->recolhimento.'</td><th>Vencimento</th><td>'.$lin->vencimento.'</td></tr>
                                            <tr></tr>
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
    <a class="btn btn-primary" href="editaRequerimento.php?<?php echo $pyrequerimento; ?>=<?php echo $lin->idrequerimento; ?>" target="_parent">Editar os dados</a>
</div>
<?php mysql_close($conexao); ?>