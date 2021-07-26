<?php
    $pyfiscalizacao = md5('idfiscalizacao');
    
    if (empty($_GET[''.$pyfiscalizacao.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE fiscalizacao SET monitor = 'X' WHERE idfiscalizacao = ".$_GET[''.$pyfiscalizacao.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoNotificacao.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyfiscalizacao);
?>