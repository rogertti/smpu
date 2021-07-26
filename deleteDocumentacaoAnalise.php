<?php
    $pydocumentacao = md5('iddocumentacao');
    $pyanalise = md5('idanalise');

    if (empty($_GET[''.$pydocumentacao.''])) { echo'Erro.'; exit; }
    if (empty($_GET[''.$pyanalise.''])) { echo'Erro.'; exit; }

    include_once('conexao.php');

    $sql = "DELETE FROM analise_has_documentacao WHERE analise_idanalise = ".$_GET[''.$pyanalise.'']." AND documentacao_iddocumentacao = ".$_GET[''.$pydocumentacao.'']."";
    $res = mysql_query($sql);

        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:editaAnalise.php?'.$pyanalise.'='.$_GET[''.$pyanalise.''].'');
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pydocumentacao,$pyanalise);
?>
