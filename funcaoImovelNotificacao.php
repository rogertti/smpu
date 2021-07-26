<?php
    include_once('conexao.php');
    
    $sql = "SELECT contribuinte.nome,contribuinte.cpf_cnpj,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento FROM contribuinte,imovel WHERE contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND imovel.idimovel = ".$_GET['idimovel']."";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {            
            while($lin = mysql_fetch_object($res)) {
                $imovel[$lin->nome] = $lin->cpf_cnpj.'|'.$lin->endereco.'|'.$lin->apto.'|'.$lin->complemento.'|'.$lin->edificio_condominio.'|'.$lin->bairro.'|'.$lin->lote.'|'.$lin->quadra.'|'.$lin->loteamento;
            }
            
            echo json_encode($imovel);
        }
        else {
            echo'no';
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$imovel);
?>