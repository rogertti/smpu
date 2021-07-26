<?php
    $pystatus = md5('status');
    
    if (empty($_GET[''.$pystatus.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE licenca_app SET monitor = '".$_GET[''.$pystatus.'']."'";
    $res = mysql_query($sql);
        
        if(!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:inicio.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyhabitese);
?>