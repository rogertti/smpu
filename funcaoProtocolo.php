<?php
    include_once('conexao.php');
    
    $sql = "SELECT imovel.inscricao,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento,contribuinte.nome FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$_GET['idprotocolo']."";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {            
            while($lin = mysql_fetch_object($res)) {
                $protocolo[$lin->inscricao] = $lin->requerente.'-'.$lin->construcao.'-'.$lin->area.'-'.$lin->endereco.'-'.$lin->apto.'-'.$lin->complemento.'-'.$lin->edificio_condominio.'-'.$lin->bairro.'-'.$lin->lote.'-'.$lin->quadra.'-'.$lin->loteamento.'-'.$lin->nome;
            }
            
            echo json_encode($protocolo);
        }
        else {
            echo'no';
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$protocolo);
?>