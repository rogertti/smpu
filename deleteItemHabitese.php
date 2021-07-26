<?php
    $pyitemhabitese = md5('iditemhabitese');
    
    if (empty($_GET[''.$pyitemhabitese.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE item_habitese SET monitor = 'X' WHERE iditem_habitese = ".$_GET[''.$pyitemhabitese.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:habitese.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyitemhabitese);
?>