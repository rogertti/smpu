<?php
    try {
        include_once('conexao.php');

        $pydocumentacao = md5('iddocumentacao');
        $sql = "SELECT iddocumentacao,descricao FROM documentacao WHERE iddocumentacao = ".$_GET[''.$pydocumentacao.'']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);

            if($ret != 0) {
                $lin = mysql_fetch_object($res);
?>
<form class="edita-item-documento-analise">
    <div class="modal-header">
        <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar o item da documenta&ccedil;&atilde;o da an&aacute;lise <small>(<i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio)</small></h4>
    </div>
    <div class="modal-body">
        <input type="hidden" id="iddocumentacao" value="<?php echo $lin->iddocumentacao; ?>">

        <div class="form-group">
            <label for="descricao"><i class="fa fa-asterisk"></i> Descri&ccedil;&atilde;o</label>
            <input type="text" id="descricao-" class="form-control" value="<?php echo $lin->descricao; ?>" maxlength="255" title="Digite o nome do item" placeholder="Descri&ccedil;&atilde;o" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary btn-flat btn-submit-edita-item-documentacao">Salvar</button>
    </div>
</form>
<script src="js/app.js"></script>
<?php
                unset($lin);
            }
            else {
                echo'
                <div class="callout">
                    <h4>Par&acirc;mentro incorreto</h4>
                </div>';
            }

        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$pydocumentacao);
    }
    catch(PDOException $e) {
        echo'Falha ao conectar o servidor '.$e->getMessage();
    }
?>
