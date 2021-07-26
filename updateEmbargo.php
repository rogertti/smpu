<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idembargo'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idfiscalizacao'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['datado'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['hora'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['situacao'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if($filtro == 3) {
        //nao permitir ' ou "
        $_POST['fase'] = str_replace("'","&#39;",$_POST['fase']);
        $_POST['fase'] = str_replace('"','&#34;',$_POST['fase']);
        $_POST['situacao'] = str_replace("'","&#39;",$_POST['situacao']);
        $_POST['situacao'] = str_replace('"','&#34;',$_POST['situacao']);
        
        //inverter data para ano-mes-dia
        $dia = substr($_POST['datado'],0,2);
        $mes = substr($_POST['datado'],3,2);
        $ano = substr($_POST['datado'],6);
        $_POST['datado'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);
        
        //trantando o valor
        $_POST['valor'] = str_replace(',','',$_POST['valor']);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        /*$sql = "SELECT idembargo FROM embargo WHERE fiscalizacao_idfiscalizacao = '".$_POST['idfiscalizacao']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Embargo j&aacute; cadastrado.'; exit;
            }
            
        unset($sql,$res,$ret);*/
        
        //atualiza no banco
        $sql = "UPDATE embargo SET datado = '".$_POST['datado']."',hora = '".$_POST['hora']."',fase = '".$_POST['fase']."',valor = '".$_POST['valor']."',situacao = '".$_POST['situacao']."',codigo = '".$_POST['codigo']."' WHERE idembargo = ".$_POST['idembargo']."";
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
                                //se as infracoes solicitadas forem maior que os registros ja cadastrados, entao acrescenta novas infracoes
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
                            }
                            else {
                                for ($i = 0;$i < $motivo;$i++) {
                                    $sql3 = "INSERT INTO fiscalizacao_has_infracao (fiscalizacao_idfiscalizacao,infracao_idinfracao) VALUES (".$_POST['idfiscalizacao'].",".$_POST['motivo'][$i].")";
                                    $res3 = mysql_query($sql3);
                                    unset($sql3,$res3);
                                }
                            }
                    }
                
                echo'true';
            }
        
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$pyfiscalizacao,$idfiscalizacao,$motivo);
    }
    else {
        echo'Tente novamente.'; exit;
    }

    unset($msgnull,$filtro,$motivo);
?>