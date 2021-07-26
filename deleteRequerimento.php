<?php
    $pyrequerimento = md5('idrequerimento');
    
    if (empty($_GET[''.$pyrequerimento.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE requerimento SET monitor = 'X' WHERE idrequerimento = ".$_GET[''.$pyrequerimento.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoRequerimento.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyrequerimento);
?>