<?php
    include_once('conexao.php');
    
    $sql = "SELECT requerimento.idrequerimento,requerimento.recolhimento FROM requerimento,imovel WHERE requerimento.imovel_idimovel = imovel.idimovel AND requerimento.monitor = 'O' AND imovel.idimovel = ".$_GET['idimovel']."";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);

        if($ret != 0) {            
            while($lin = mysql_fetch_object($res)) {
                $imovel[$lin->idrequerimento] = $lin->recolhimento;
            }
            
            echo json_encode($imovel);
        }
        else {
            echo'no';
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$imovel);
?>