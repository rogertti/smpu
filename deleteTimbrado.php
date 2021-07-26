<?php
    $py = md5('idtimbrado');

    if (empty($_GET[''.$py.''])) { echo'Erro.'; exit; }

    include_once('conexao.php');

    $sql = "UPDATE timbrado SET monitor = 'X' WHERE idtimbrado = ".$_GET[''.$py.'']."";
    $res = mysql_query($sql);

        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:timbrado.php');
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$py);
?>
