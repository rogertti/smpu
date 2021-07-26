<?php
    include_once('conexao.php');
    
    #$sql = "SELECT fiscalizacao.idfiscalizacao FROM fiscalizacao,imovel WHERE fiscalizacao.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$_GET['idimovel']." AND fiscalizacao.monitor = 'O'";
    $sql = "SELECT fiscalizacao.idfiscalizacao FROM fiscalizacao,imovel WHERE fiscalizacao.imovel_idimovel = imovel.idimovel AND imovel.idimovel = ".$_POST['idimovel']." AND fiscalizacao.monitor = 'O'";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {            
            while($lin = mysql_fetch_object($res)) {
                $imovel[$lin->idfiscalizacao] = $lin->idfiscalizacao;
            }
            
            echo json_encode($imovel);
        }
        else {
            echo'no';
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$imovel);
?>