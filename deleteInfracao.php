<?php
    $pyinfracao = md5('idinfracao');
    $pyfiscalizacao = md5('idfiscalizacao');
    $pyembargo = md5('idembargo');
    $pynembargo = md5('nembargo');

    if (empty($_GET[''.$pyinfracao.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    $sql = "DELETE FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$_GET[''.$pyfiscalizacao.'']." AND infracao_idinfracao = ".$_GET[''.$pyinfracao.'']."";
    $res = mysql_query($sql);
        
        if (!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            //se vier o id do embargo vier por get, veio de editaEmbargo.php
            if(isset($_GET[''.$pyembargo.''])) {
                header('location:editaEmbargo.php?'.$pyembargo.'='.$_GET[''.$pyembargo.''].'');
            }
            
            //se vier n embargo vier por get, veio de novoEmbargo.php
            if(isset($_GET[''.$pynembargo.''])) {
                header('location:novoEmbargo.php?'.$pyfiscalizacao.'='.$_GET[''.$pyfiscalizacao.''].'');
            }
            
            //se nenhuma das duas vier por get, veio de editaNotificacao.php
            if((!isset($_GET[''.$pyembargo.''])) and (!isset($_GET[''.$pynembargo.'']))) {
                header('location:editaNotificacao.php?'.$pyfiscalizacao.'='.$_GET[''.$pyfiscalizacao.''].'');    
            }
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$pyinfracao,$pyfiscalizacao,$pyembargo,$pynembargo);
?>