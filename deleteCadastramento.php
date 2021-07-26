<?php
    $pycadastramento = md5('idcadastramento');

    if (empty($_GET[''.$pycadastramento.''])) { echo'Erro.'; exit; }

    include_once('conexao.php');

    $sql = "UPDATE cadastramento SET monitor = 'X' WHERE idcadastramento = ".$_GET[''.$pycadastramento.'']."";
    $res = mysql_query($sql);

        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoCadastramento.php');
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pycadastramento);
?>
