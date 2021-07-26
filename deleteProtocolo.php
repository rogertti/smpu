<?php
    $pyprotocolo = md5('idprotocolo');
    
    if (empty($_GET[''.$pyprotocolo.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE protocolo SET monitor = 'X' WHERE idprotocolo = ".$_GET[''.$pyprotocolo.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:inicio.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyprotocolo);
?>