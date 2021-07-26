<?php
    $pyfiscalizacao = md5('idfiscalizacao');
    
    if (empty($_GET[''.$pyfiscalizacao.''])) { echo'Erro.'; exit; }
        
    include_once('conexao.php');
    
    //editando a fiscalizacao
    $sql = "UPDATE fiscalizacao SET monitor = 'V' WHERE idfiscalizacao = ".$_GET[''.$pyfiscalizacao.'']."";
    $res = mysql_query($sql);
        
        if(!$res) {
            echo'Erro, tente novamente.'; exit;
        }
        else {
            //editando o embargo
            #$sql2 = "UPDATE embargo SET monitor = 'X' WHERE fiscalizacao_idfiscalizacao = ".$_GET[''.$pyfiscalizacao.'']."";
            #$res2 = mysql_query($sql2);
            
                #if(!$res2) {
                #    echo'Erro, tente novamente.'; exit;
                #}
                #else {
                    //excluindo as infracoes
                    $sql3 = "DELETE FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$_GET[''.$pyfiscalizacao.'']."";
                    $res3 = mysql_query($sql3);

                        if(!$res3) {
                            echo'Erro, tente novamente.'; exit;
                        }
                        else {
                            header('location:relacaoNotificacao.php');   
                        }
                #}
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$sql2,$res2,$sql3,$res3,$pyfiscalizacao);
?>