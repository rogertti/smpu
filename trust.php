<?php
    include_once('conexao.php');
    
    //no protocolo
    $sql = "SELECT * FROM protocolo WHERE autentico = '".$_POST['chave']."'";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {
            $lin = mysql_fetch_object($res);
            include_once('printTrustProtocolo.php');
            unset($sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3);
        }
        else {
            //na analise
            $sql = "SELECT * FROM analise WHERE autentico = '".$_POST['chave']."'";
            $res = mysql_query($sql);
            $ret = mysql_num_rows($res);
            
                if($ret != 0) {
                    $lin = mysql_fetch_object($res);
                    include_once('printTrustAnalise.php');
                    unset($sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2);
                }
                else {
                    //na fiscalizacao
                    $sql = "SELECT * FROM fiscalizacao WHERE autentico = '".$_POST['chave']."'";
                    $res = mysql_query($sql);
                    $ret = mysql_num_rows($res);
                    
                        if($ret != 0) {
                            $lin = mysql_fetch_object($res);
                            include_once('printTrustNotificacao.php');
                            unset($sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$dia,$mes,$ano);
                        }
                        else {
                            //no habitese
                            $sql = "SELECT * FROM habitese WHERE autentico = '".$_POST['chave']."'";
                            $res = mysql_query($sql);
                            $ret = mysql_num_rows($res);
                            
                                if($ret != 0) {
                                    $lin = mysql_fetch_object($res);
                                    include_once('printTrustHabitese.php');
                                    unset($sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$dia,$mes,$ano);
                                }
                                else {
                                    //no timbrado
                                    $sql = "SELECT * FROM timbrado WHERE autentico = '".$_POST['chave']."'";
                                    $res = mysql_query($sql);
                                    $ret = mysql_num_rows($res);

                                        if($ret > 0) {
                                            $lin = mysql_fetch_object($res);
                                            include_once('printTrustTimbrado.php');
                                            unset($sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$dia,$mes,$ano);
                                        }
                                        else {
                                            echo'no';
                                        }
                                }
                        }    
                }
        }
                        
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$ret3,$lin3,$dia,$mes,$ano);
?>
