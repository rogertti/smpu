<?php
    $pyengenheiro = md5('idengenheiro');
    
    if (empty($_GET[''.$pyengenheiro.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE engenheiro SET monitor = 'X' WHERE idengenheiro = ".$_GET[''.$pyengenheiro.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoEngenheiro.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyengenheiro);
?>