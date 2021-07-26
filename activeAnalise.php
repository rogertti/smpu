<?php
    $pyanalise = md5('idanalise');
    
    if (empty($_GET[''.$pyanalise.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE analise SET monitor = 'O' WHERE idanalise = ".$_GET[''.$pyanalise.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoAnalise.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyanalise);
?>