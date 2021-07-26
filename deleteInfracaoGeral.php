<?php
    $pyinfracao = md5('idinfracao');
    
    if (empty($_GET[''.$pyinfracao.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE infracao SET monitor = 'X' WHERE idinfracao = ".$_GET[''.$pyinfracao.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:infracao.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyinfracao);
?>