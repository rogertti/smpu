<?php
    try {
        include_once('conexao.php');
        $pyanalise = md5('idanalise');

            switch($_GET['tipo']) {
                case 'arquitetonico':
                    $sql = "SELECT historico_analise.datado,historico_analise.hora,historico_analise.arquitetonico FROM historico_analise,analise WHERE historico_analise.analise_idanalise = analise.idanalise AND analise.idanalise = ".$_GET[''.$pyanalise.'']."";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            echo'
                            <div class="modal-header">
                                <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Hist&oacute;rico do projeto arquitet&ocirc;nico</h4>
                            </div>
                            <div class="modal-body">';

                                while($lin = mysql_fetch_object($res)) {
                                    $ano = substr($lin->datado,0,4);
                                    $mes = substr($lin->datado,5,2);
                                    $dia = substr($lin->datado,8);
                                    $lin->datado = $dia."/".$mes."/".$ano;
                                    unset($ano,$mes,$dia);

                                    echo'
                                    <p><strong>Data: '.$lin->datado.' - Hor&aacute;rio: '.$lin->hora.'</strong></p>
                                    '.htmlspecialchars_decode($lin->arquitetonico).'
                                    <hr>';
                                }

                            echo'
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary btn-flat btn-submit-edita-item-documentacao">Salvar</button>
                            </div>';

                            unset($lin);
                        }
                        else {
                            echo'
                            <div class="modal-header">
                                <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Hist&oacute;rico do projeto arquitet&ocirc;nico</h4>
                            </div>
                            <div class="modal-body">
                                <p>Nenhum hist&oacute;rico registrado.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary btn-flat btn-submit-edita-item-documentacao">Salvar</button>
                            </div>';
                        }

                    unset($sql,$res,$ret);
                break;

                case 'hidrosanitario':
                    $sql = "SELECT historico_analise.datado,historico_analise.hora,historico_analise.hidrosanitario FROM historico_analise,analise WHERE historico_analise.analise_idanalise = analise.idanalise AND analise.idanalise = ".$_GET[''.$pyanalise.'']."";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);

                        if($ret != 0) {
                            echo'
                            <div class="modal-header">
                                <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Hist&oacute;rico do projeto hidrosanit&aacute;rio</h4>
                            </div>
                            <div class="modal-body">';

                                while($lin = mysql_fetch_object($res)) {
                                    $ano = substr($lin->datado,0,4);
                                    $mes = substr($lin->datado,5,2);
                                    $dia = substr($lin->datado,8);
                                    $lin->datado = $dia."/".$mes."/".$ano;
                                    unset($ano,$mes,$dia);

                                    echo'
                                    <p><strong>Data: '.$lin->datado.' - Hor&aacute;rio: '.$lin->hora.'</strong></p>
                                    '.htmlspecialchars_decode($lin->hidrosanitario).'
                                    <hr>';
                                }

                            echo'
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-flat closed" data-dismiss="modal">Fechar</button>
                                <!--<button type="submit" class="btn btn-primary btn-flat btn-submit-edita-item-documentacao">Salvar</button>-->
                            </div>';

                            unset($lin);
                        }
                        else {
                            echo'
                            <div class="modal-header">
                                <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Hist&oacute;rico do projeto arquitet&ocirc;nico</h4>
                            </div>
                            <div class="modal-body">
                                <p>Nenhum hist&oacute;rico registrado.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-flat closed" data-dismiss="modal">Fechar</button>
                                <!--<button type="submit" class="btn btn-primary btn-flat btn-submit-edita-item-documentacao">Salvar</button>-->
                            </div>';
                        }

                    unset($sql,$res,$ret);
                break;
            }

        mysql_close($conexao);
        unset($conexao,$charset,$pyanalise);

        echo'
        <script>
            $(document).ready(function () {
                /* MODAL */

                $(".closed").click(function () {
                    location.reload();
                });
            });
        </script>';
    }
    catch(PDOException $e) {
        echo'Falha ao conectar o servidor '.$e->getMessage();
    }
?>
