<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idfiscalizacao'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idimovel'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    #if (empty($_POST['idfuncionario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    #if (empty($_POST['album'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['inscricao'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['notificacao'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['funcionario'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['datado'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['hora'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['responsavel'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['prazo'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['motivo'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if($filtro == 7) {
        //nao permitir ' ou "
        $_POST['receptor'] = str_replace("'","&#39;",$_POST['receptor']);
        $_POST['receptor'] = str_replace('"','&#34;',$_POST['receptor']);
        $_POST['situacao'] = str_replace("'","&#39;",$_POST['situacao']);
        $_POST['situacao'] = str_replace('"','&#34;',$_POST['situacao']);
        $_POST['medida'] = str_replace("'","&#39;",$_POST['medida']);
        $_POST['medida'] = str_replace('"','&#34;',$_POST['medida']);
        $_POST['prazo'] = str_replace("'","&#39;",$_POST['prazo']);
        $_POST['prazo'] = str_replace('"','&#34;',$_POST['prazo']);
        
        //inverter data para ano-mes-dia
        $dia = substr($_POST['datado'],0,2);
        $mes = substr($_POST['datado'],3,2);
        $ano = substr($_POST['datado'],6);
        $_POST['datado'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);
        
        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT notificacao FROM fiscalizacao WHERE notificacao = '".$_POST['notificacao']."' AND idfiscalizacao <> ".$_POST['idfiscalizacao']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Notifica&ccedil;&atilde;o j&aacute; cadastrada.'; exit;
            }
            
        unset($sql,$res,$ret);
        
        //atualiza no banco
        $sql = "UPDATE fiscalizacao SET imovel_idimovel = ".$_POST['idimovel'].",notificacao = '".$_POST['notificacao']."',datado = '".$_POST['datado']."',hora = '".$_POST['hora']."',medida = '".$_POST['medida']."',prazo = '".$_POST['prazo']."',responsavel = '".$_POST['responsavel']."',situacao = '".$_POST['situacao']."',receptor = '".$_POST['receptor']."',monitor = 'O',autentico = '".$_POST['autentico']."',ultimo_usuario = '".$_POST['ultimo_usuario']."' WHERE idfiscalizacao = ".$_POST['idfiscalizacao']."";
        $res = mysql_query($sql);
        
            if(!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                $motivo = count($_POST['motivo']);
                
                    if($motivo > 0) {
                        //seleciona todas as infracoes da fiscalizacacao
                        $sql2 = "SELECT fiscalizacao_idfiscalizacao,infracao_idinfracao FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$_POST['idfiscalizacao']."";
                        $res2 = mysql_query($sql2);
                        $ret2 = mysql_num_rows($res2);

                            if($ret2 != 0) {    
                                    //se o mesmo numero de registros for igual as infracoes solicitadas, entao altera as campos da tabela
                                    /*if($ret2 == $motivo) {
                                        for ($i = 0;$i < count($_POST['motivo']);$i++) {
                                            $sql3 = "UPDATE fiscalizacao_has_infracao SET infracao_idinfracao = ".$_POST['motivo'][$i]." WHERE fiscalizacao_idfiscalizacao = ".$_POST['idfiscalizacao']."";
                                            $res3 = mysql_query($sql3);
                                            unset($sql3,$res3);
                                        }

                                        unset($i);
                                    }*/

                                    //se as infracoes solicitadas forem maior que os registros ja cadastrados, entao acrescenta novas infracoes
                                    #if($ret2 < $motivo) {
                                        for ($i = 0;$i < $motivo;$i++) {
                                            $lin2 = mysql_fetch_object($res2);

                                                if($_POST['motivo'][$i] != $lin2->infracao_idinfracao) {
                                                    $sql3 = "SELECT infracao_idinfracao FROM fiscalizacao_has_infracao WHERE fiscalizacao_idfiscalizacao = ".$_POST['idfiscalizacao']." AND infracao_idinfracao = ".$_POST['motivo'][$i]."";
                                                    $res3 = mysql_query($sql3);
                                                    $ret3 = mysql_num_rows($res3);

                                                        if($ret3 == 0) {
                                                            $sql4 = "INSERT INTO fiscalizacao_has_infracao (fiscalizacao_idfiscalizacao,infracao_idinfracao) VALUES (".$_POST['idfiscalizacao'].",".$_POST['motivo'][$i].")";
                                                            $res4 = mysql_query($sql4);
                                                            unset($sql4,$res4);
                                                        }

                                                    unset($sql3,$res3,$ret3);
                                                }
                                        }

                                        unset($i);
                                    #}
                            }
                            else {
                                for ($i = 0;$i < $motivo;$i++) {
                                    $sql3 = "INSERT INTO fiscalizacao_has_infracao (fiscalizacao_idfiscalizacao,infracao_idinfracao) VALUES (".$_POST['idfiscalizacao'].",".$_POST['motivo'][$i].")";
                                    $res3 = mysql_query($sql3);
                                    unset($sql3,$res3);
                                }
                            }
                    }
                
                $pyfiscalizacao = md5('idfiscalizacao');
                echo'<script>document.location = "printNotificacao.php?'.$pyfiscalizacao.'='.$_POST['idfiscalizacao'].'"</script>';
                #echo'true';
            }
        
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$pyfiscalizacao,$idfiscalizacao,$motivo);
    }
    else {
        echo'Tente novamente.'; exit;
    }

    unset($msgnull,$filtro,$motivo);
?>