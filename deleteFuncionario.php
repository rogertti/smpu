<?php
    $pyfuncionario = md5('idfuncionario');
    
    if (empty($_GET[''.$pyfuncionario.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "UPDATE funcionario SET monitor = 'X' WHERE idfuncionario = ".$_GET[''.$pyfuncionario.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            header('location:relacaoFuncionario.php');
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyfuncionario);
?>