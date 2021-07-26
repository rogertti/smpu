<?php
    session_start();

    try {
        include_once('conexao.php');

        $py = md5('idtimbrado');
        $sql = "SELECT idtimbrado,tipo_timbrado_idtipo_timbrado,protocolo,texto FROM timbrado WHERE idtimbrado = ".$_GET[''.$py.'']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);

            if($ret != 0) {
                $lin = mysql_fetch_object($res);
?>
<form class="edita-timbrado">
    <div class="modal-header">
        <button type="button" class="close closed" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar documento timbrado <small>(<i class="fa fa-asterisk"></i> Campo obrigat&oacute;rio)</small></h4>
    </div>
    <div class="modal-body">
        <input type="hidden" id="idtimbrado" value="<?php echo $lin->idtimbrado; ?>">
        <input type="hidden" id="ultimo_usuario-" value="<?php echo base64_decode($_SESSION['name']); ?>">

        <div class="form-group">
            <label for="protocolo-"><i class="fa fa-asterisk"></i> Protocolo</label>
            <div class="input-group col-md-2">
                <input type="text" id="protocolo-" class="form-control" maxlength="9" value="<?php echo $lin->protocolo; ?>" title="N&uacute;mero de protocolo" placeholder="Protocolo" required>
            </div>
        </div>
        <div class="form-group">
            <label for="tipo-"><i class="fa fa-asterisk"></i> Tipo</label>
            <div class="input-group col-md-4">
                <select id="tipo-" class="form-control" title="Tipo de documento" required>
                    <?php
                        $sql2 = "SELECT idtipo_timbrado,descricao FROM tipo_timbrado WHERE monitor = 'O' ORDER BY descricao";
                        $res2 = mysql_query($sql2);
                        $ret2 = mysql_num_rows($res2);

                            if($ret2 > 0) {
                                while($lin2 = mysql_fetch_object($res2)) {
                                    if($lin2->idtipo_timbrado == $lin->tipo_timbrado_idtipo_timbrado) {
                                        echo'<option value="'.$lin2->idtipo_timbrado.'" selected>'.$lin2->descricao.'</option>';
                                    }
                                    else {
                                        echo'<option value="'.$lin2->idtipo_timbrado.'">'.$lin2->descricao.'</option>';
                                    }
                                }

                                unset($lin2);
                            }

                        unset($sql2,$res2,$ret2);
                    ?>
                </select>
                <span class="input-group-addon">
                    <a data-toggle="modal" data-target="#novo-tipo" href="#"><i class="fa fa-plus fa-fw"></i></a>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="texto_"><i class="fa fa-asterisk"></i> Texto</label>
            <textarea class="form-control" id="texto_" rows="10" title="Texto do documento timbrado" placeholder="Texto" required><?php echo $lin->texto; ?></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left closed" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary btn-flat btn-submit-edita-timbrado">Salvar</button>
    </div>
</form>
<script src="js/app.js"></script>
<script>
    var initEditor = (function () {
        function isWysiwygareaAvailable() {
            // If in development mode, then the wysiwygarea must be available.
            // Split REV into two strings so builder does not replace it :D.
            if (CKEDITOR.revision === ('%RE' + 'V%')) {
                return true;
            }

            return !!CKEDITOR.plugins.get('wysiwygarea');
        }

        var wysiwygareaAvailable = isWysiwygareaAvailable(), isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

        return function () {
            var editorElement = CKEDITOR.document.getById('texto_');

            // :(((
            if (isBBCodeBuiltIn) {
                editorElement.setHtml(
                    'Hello world!\n\n' + 'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
                );
            }

            // Depending on the wysiwygare plugin availability initialize classic or inline editor.
            if (wysiwygareaAvailable) {
                CKEDITOR.replace('texto_', {height: '600px'});
            } else {
                editorElement.setAttribute('contenteditable', 'true');
                CKEDITOR.inline('texto_');

                // TODO we can consider displaying some info box that
                // without wysiwygarea the classic editor may not work.
            }
        };
    }());

    initEditor();
</script>
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
        unset($conexao,$charset,$sql,$res,$ret,$py);
    }
    catch(PDOException $e) {
        echo'Falha ao conectar o servidor '.$e->getMessage();
    }
?>
