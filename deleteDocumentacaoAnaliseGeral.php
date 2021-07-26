<?php
    $pydocumentacao = md5('iddocumentacao');

    if (empty($_GET[''.$pydocumentacao.''])) { echo'Erro.'; exit; }

    include_once('conexao.php');

    $sql = "UPDATE documentacao SET monitor = 'X' WHERE iddocumentacao = ".$_GET[''.$pydocumentacao.'']."";
    $res = mysql_query($sql);

        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:documentacaoAnalise.php');
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pydocumentacao);
?>
