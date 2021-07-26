<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idhabitese'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idprotocolo'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['itens'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['inserts'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
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
        $sql = "SELECT protocolo_idprotocolo FROM habitese WHERE protocolo_idprotocolo = '".$_POST['idprotocolo']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                $lin = mysql_fetch_object($res);
                    
                    if($lin->protocolo_idprotocolo != $_POST['idprotocolo']) {
                        echo'Habite-se j&aacute; cadastrado.'; exit;    
                    }
            }
            
        unset($sql,$res,$ret,$lin);
        
        //atualiza no banco
        $sql = "UPDATE habitese SET protocolo_idprotocolo = ".$_POST['idprotocolo'].",datado = '".$_POST['datado']."',hora = '".$_POST['hora']."',situacao = '".$_POST['situacao']."',observacao = '".$_POST['observacao']."',autentico = '".$_POST['autentico']."',ultimo_usuario = '".$_POST['ultimo_usuario']."' WHERE idhabitese = ".$_POST['idhabitese']."";
        $res = mysql_query($sql);
        
            if(!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                $x = $_POST['inserts'];
                $dif = $_POST['itens'] - $_POST['inserts'];
                
                    if($dif == 0) {
                        //atualiza os itens
                        for ($i = 0;$i < $_POST['inserts'];$i++) {
                            $item = explode('=',$_POST['item'][$i]);
                            $item[0] = str_replace('item','',$item[0]);

                            $sql3 = "UPDATE habitese_has_item_habitese SET situacao = '".$item[1]."' WHERE habitese_idhabitese = ".$_POST['idhabitese']." AND item_habitese_iditem_habitese = ".$item[0]."";
                            $res3 = mysql_query($sql3);

                                if(!$res) {
                                    echo'Tente novamente.'; exit;
                                }

                            unset($sql3,$res3,$item);
                        }    
                    }
                
                    if($dif > 0) {
                        //atualiza os itens
                        for ($i = 0;$i < $_POST['inserts'];$i++) {
                            $item = explode('=',$_POST['item'][$i]);
                            $item[0] = str_replace('item','',$item[0]);

                            $sql3 = "UPDATE habitese_has_item_habitese SET situacao = '".$item[1]."' WHERE habitese_idhabitese = ".$_POST['idhabitese']." AND item_habitese_iditem_habitese = ".$item[0]."";
                            $res3 = mysql_query($sql3);
                            
                                if(!$res) {
                                    echo'Tente novamente.'; exit;
                                }

                            unset($sql3,$res3,$item);
                        }
                        
                        //insere novos itens
                        for ($i = 0;$i < $dif;$i++) {
                            $item = explode('=',$_POST['item'][$x]);
                            $item[0] = str_replace('item','',$item[0]);

                            $sql3 = "INSERT INTO habitese_has_item_habitese (habitese_idhabitese,item_habitese_iditem_habitese,situacao) VALUES (".$_POST['idhabitese'].",".$item[0].",'".$item[1]."')";
                            $res3 = mysql_query($sql3);
                            
                                if(!$res) {
                                    echo'Tente novamente.'; exit;
                                }
                                
                            $x++;
                            unset($sql3,$res3,$item);
                        }
                    }
                
                $pyhabitese = md5('idhabitese');
                echo'<script>document.location = "printHabitese.php?'.$pyhabitese.'='.$_POST['idhabitese'].'"</script>';
                #echo'true';
            }
        
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$sql2,$res2,$ret2,$lin2,$sql3,$res3,$pyfiscalizacao,$idfiscalizacao,$pyhabitese,$i,$x,$dif);
    }
    else {
        echo'Tente novamente.'; exit;
    }

    unset($msgnull,$filtro,$motivo);
?>