<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idprotocolo'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['album'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    #if (empty($_POST['itens'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['protocolo_habitese'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['datado'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['hora'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['situacao'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['item'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if($filtro == 5) {
        //nao permitir ' ou "
        $_POST['observacao'] = str_replace("'","&#39;",$_POST['observacao']);
        $_POST['observacao'] = str_replace('"','&#34;',$_POST['observacao']);
            
            //tratando os itens
            if(strstr($_POST['item'],'situacao=Pendente,')) {
                $_POST['item'] = str_replace('situacao=Pendente,','',$_POST['item']);
                $_POST['item'] = substr($_POST['item'],0,-1);
            }    
            
            if(strstr($_POST['item'],'situacao=Aprovado,')) {
                $_POST['item'] = str_replace('situacao=Aprovado,','',$_POST['item']);
                $_POST['item'] = substr($_POST['item'],0,-1);
            }
        
        //tratando o item
        $_POST['item'] = explode(',',$_POST['item']);
        
        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);
        
        //inverter data para ano-mes-dia
        $dia = substr($_POST['datado'],0,2);
        $mes = substr($_POST['datado'],3,2);
        $ano = substr($_POST['datado'],6);
        $_POST['datado'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT idhabitese FROM habitese WHERE protocolo_idprotocolo = '".$_POST['idprotocolo']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                #echo'Habite-se j&aacute; cadastrado.'; exit;
                $pyhabitese = md5('idhabitese');
                $lin = mysql_fetch_object($res);
                echo'Esse protocolo j&aacute; possui um habite-se cadastrado, se n&atilde;o est&aacute; vis&iacute;vel pode ter sido exclu&iacute;do. <a href="activeHabitese.php?'.$pyhabitese.'='.$lin->idhabitese.'">Ativar o habite-se</a>'; exit;
            }
            
        unset($sql,$res,$ret,$lin,$pyhabitese);
        
        //insere no banco
        $sql = "INSERT INTO habitese (protocolo_idprotocolo,datado,hora,situacao,observacao,album,monitor,autentico,ultimo_usuario) VALUES (".$_POST['idprotocolo'].",'".$_POST['datado']."','".$_POST['hora']."','".$_POST['situacao']."','".$_POST['observacao']."','".$_POST['album']."','O','".$_POST['autentico']."','".$_POST['ultimo_usuario']."')";
        $res = mysql_query($sql);
        
            if(!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //inserindo os motivos
                $sql2 = "SELECT idhabitese FROM habitese ORDER BY idhabitese DESC LIMIT 0,1";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        
                        for ($i = 0;$i < count($_POST['item']);$i++) {
                            $item = explode('=',$_POST['item'][$i]);
                            $item[0] = str_replace('item','',$item[0]);
                            
                            $sql3 = "INSERT INTO habitese_has_item_habitese (habitese_idhabitese,item_habitese_iditem_habitese,situacao) VALUES (".$lin2->idhabitese.",".$item[0].",'".$item[1]."')";
                            $res3 = mysql_query($sql3);
                            
                                if(!$res) {
                                    echo'Tente novamente.'; exit;
                                }
                            
                            unset($sql3,$res3,$item);
                        }
                    }
                
                $pyhabitese = md5('idhabitese');
                echo'<script>document.location = "printHabitese.php?'.$pyhabitese.'='.$lin2->idhabitese.'"</script>';
                #echo'true';
            }
        
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$pyfiscalizacao,$idfiscalizacao,$pyhabitese);
    }
    else {
        echo'Tente novamente.'; exit;
    }

    unset($msgnull,$filtro,$motivo);
?>