<?php
    $pyhabitese = md5('idhabitese');
    
    if (empty($_GET[''.$pyhabitese.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE habitese SET monitor = 'X' WHERE idhabitese = ".$_GET[''.$pyhabitese.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoHabitese.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyhabitese);
?>