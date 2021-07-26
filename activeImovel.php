<?php
    $pyimovel = md5('idimovel');
    
    if (empty($_GET[''.$pyimovel.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE imovel SET monitor = 'O' WHERE idimovel = ".$_GET[''.$pyimovel.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoImovel.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyimovel);
?>