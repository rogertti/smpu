<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idimovel'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idfuncionario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['album'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['inscricao'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['notificacao'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['funcionario'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['datado'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['hora'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['responsavel'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['prazo'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['motivo'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if($filtro == 8) {
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
        #$sql = "SELECT notificacao FROM fiscalizacao WHERE imovel_idimovel = ".$_POST['idimovel']."";
        $sql = "SELECT notificacao FROM fiscalizacao WHERE notificacao = '".$_POST['notificacao']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Notifica&ccedil;&atilde;o j&aacute; cadastrada.'; exit;
            }
            
        unset($sql,$res,$ret);
        
        //insere no banco
        $sql = "INSERT INTO fiscalizacao (imovel_idimovel,funcionario_idfuncionario,notificacao,datado,hora,medida,prazo,responsavel,situacao,receptor,album,monitor,autentico,ultimo_usuario) VALUES (".$_POST['idimovel'].",".$_POST['idfuncionario'].",'".$_POST['notificacao']."','".$_POST['datado']."','".$_POST['hora']."','".$_POST['medida']."','".$_POST['prazo']."','".$_POST['responsavel']."','".$_POST['situacao']."','".$_POST['receptor']."','".$_POST['album']."','O','".$_POST['autentico']."','".$_POST['ultimo_usuario']."')";
        $res = mysql_query($sql);
        
            if(!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //inserindo os motivos
                $sql2 = "SELECT idfiscalizacao FROM fiscalizacao ORDER BY idfiscalizacao DESC LIMIT 0,1";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        #$idfiscalizacao = $lin2[0];
                        #$pyfiscalizacao = md5('idfiscalizacao');
                        #echo'<script>document.location = "printRequerimento.php?'.$pyrequerimento.'='.$idrequerimento.'"</script>';
                        
                        for ($i = 0;$i < count($_POST['motivo']);$i++) {
                            $sql3 = "INSERT INTO fiscalizacao_has_infracao (fiscalizacao_idfiscalizacao,infracao_idinfracao) VALUES (".$lin2->idfiscalizacao.",".$_POST['motivo'][$i].")";
                            $res3 = mysql_query($sql3);
                            
                                if(!$res) {
                                    echo'Tente novamente.'; exit;
                                }
                            
                            unset($sql3,$res3);
                        }
                    }
                
                $pyfiscalizacao = md5('idfiscalizacao');
                echo'<script>document.location = "printNotificacao.php?'.$pyfiscalizacao.'='.$lin2->idfiscalizacao.'"</script>';
                #echo'true';
            }
        
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$pyfiscalizacao,$idfiscalizacao,$i);
    }
    else {
        echo'Tente novamente.'; exit;
    }

    unset($msgnull,$filtro,$motivo);
?>