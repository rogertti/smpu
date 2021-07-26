<?php
    include_once('conexao.php');
        
    $sql = "CHECK TABLE analise, analise_has_documentacao, cadastramento, contribuinte, documentacao, embargo, engenheiro, fiscalizacao, fiscalizacao_has_infracao, funcionario, habitese, habitese_has_item_habitese, historico_analise, imovel, infracao, item_habitese, protocolo, requerimento, timbrado, tipo_timbrado";
    $res = mysql_query($sql);    

        if(!$res) {
            die('Erro ao checar as tabelas');
        } else {
            $msg = 1;
        }

    unset($sql,$res);

    $sql = "ANALYSE TABLE analise, analise_has_documentacao, cadastramento, contribuinte, documentacao, embargo, engenheiro, fiscalizacao, fiscalizacao_has_infracao, funcionario, habitese, habitese_has_item_habitese, historico_analise, imovel, infracao, item_habitese, protocolo, requerimento, timbrado, tipo_timbrado";
    $res = mysql_query($sql);

        if(!$res) {
            die('Erro ao analisar as tabelas');
        } else {
            $msg++;
        }

    unset($sql,$res);

    $sql = "REPAIR TABLE analise, analise_has_documentacao, cadastramento, contribuinte, documentacao, embargo, engenheiro, fiscalizacao, fiscalizacao_has_infracao, funcionario, habitese, habitese_has_item_habitese, historico_analise, imovel, infracao, item_habitese, protocolo, requerimento, timbrado, tipo_timbrado";
    $res = mysql_query($sql);

        if(!$res) {
            die('Erro ao reparar as tabelas');
        } else {
            $msg++;
        }

    unset($sql,$res);

    $sql = "OPTIMIZE TABLE analise, analise_has_documentacao, cadastramento, contribuinte, documentacao, embargo, engenheiro, fiscalizacao, fiscalizacao_has_infracao, funcionario, habitese, habitese_has_item_habitese, historico_analise, imovel, infracao, item_habitese, protocolo, requerimento, timbrado, tipo_timbrado";
    $res = mysql_query($sql);

        if(!$res) {
            die('Erro ao otimizar as tabelas');
        } else {
            $msg++;
        }

    unset($sql,$res);

        if($msg == 4) {
            die('Todas as tabelas foram qualificadas');
        }

?>