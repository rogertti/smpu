<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idanalise'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idprotocolo'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['parecer'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['documentacao'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if ($filtro == 2) {
        //nao permitir ' ou "
        $_POST['responsavel'] = str_replace("'","&#39;",$_POST['responsavel']);
        $_POST['responsavel'] = str_replace('"','&#34;',$_POST['responsavel']);
        $_POST['responsavel'] = str_replace('"','&#37;',$_POST['responsavel']);
        $_POST['arquitetonico'] = str_replace("'","&#39;",$_POST['arquitetonico']);
        $_POST['arquitetonico'] = str_replace('"','&#34;',$_POST['arquitetonico']);
        $_POST['arquitetonico'] = str_replace('"','&#37;',$_POST['arquitetonico']);
        $_POST['hidrosanitario'] = str_replace("'","&#39;",$_POST['hidrosanitario']);
        $_POST['hidrosanitario'] = str_replace('"','&#34;',$_POST['hidrosanitario']);
        $_POST['hidrosanitario'] = str_replace('"','&#37;',$_POST['hidrosanitario']);
        $_POST['historico_arquitetonico'] = str_replace("'","&#39;",$_POST['historico_arquitetonico']);
        $_POST['historico_arquitetonico'] = str_replace('"','&#34;',$_POST['historico_arquitetonico']);
        $_POST['historico_arquitetonico'] = str_replace('"','&#37;',$_POST['historico_arquitetonico']);
        $_POST['historico_hidrosanitario'] = str_replace("'","&#39;",$_POST['historico_hidrosanitario']);
        $_POST['historico_hidrosanitario'] = str_replace('"','&#34;',$_POST['historico_hidrosanitario']);
        $_POST['historico_hidrosanitario'] = str_replace('"','&#37;',$_POST['historico_hidrosanitario']);
        
        if(!empty($_POST['datado'])) {
            //inverter data para ano-mÍs-dia
            $dia = substr($_POST['datado'],0,2);
            $mes = substr($_POST['datado'],3,2);
            $ano = substr($_POST['datado'],6);
            $_POST['datado'] = $ano."-".$mes."-".$dia;
            unset($dia,$mes,$ano);
        }
        
        //tratando texto
        $_POST['arquitetonico'] = htmlspecialchars($_POST['arquitetonico']);
        $_POST['arquitetonico'] = str_replace('&amp;','&',$_POST['arquitetonico']);
        //$_POST['arquitetonico'] = str_replace('&lt;pre&gt;','',$_POST['arquitetonico']);
        //$_POST['arquitetonico'] = str_replace('&lt;/pre&gt;','',$_POST['arquitetonico']);
        $_POST['hidrosanitario'] = htmlspecialchars($_POST['hidrosanitario']);
        $_POST['hidrosanitario'] = str_replace('&amp;','&',$_POST['hidrosanitario']);
        //$_POST['hidrosanitario'] = str_replace('&lt;pre&gt;','',$_POST['hidrosanitario']);
        //$_POST['hidrosanitario'] = str_replace('&lt;/pre&gt;','',$_POST['hidrosanitario']);
        $_POST['historico_arquitetonico'] = htmlspecialchars($_POST['historico_arquitetonico']);
        $_POST['historico_arquitetonico'] = str_replace('&amp;','&',$_POST['historico_arquitetonico']);
        //$_POST['historico_arquitetonico'] = str_replace('&lt;pre&gt;','',$_POST['historico_arquitetonico']);
        //$_POST['historico_arquitetonico'] = str_replace('&lt;/pre&gt;','',$_POST['historico_arquitetonico']);
        $_POST['historico_hidrosanitario'] = htmlspecialchars($_POST['historico_hidrosanitario']);
        $_POST['historico_hidrosanitario'] = str_replace('&amp;','&',$_POST['historico_hidrosanitario']);
        //$_POST['historico_hidrosanitario'] = str_replace('&lt;pre&gt;','',$_POST['historico_hidrosanitario']);
        //$_POST['historico_hidrosanitario'] = str_replace('&lt;/pre&gt;','',$_POST['historico_hidrosanitario']);
        
        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT protocolo_idprotocolo FROM analise WHERE protocolo_idprotocolo = '".$_POST['idprotocolo']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                #echo'Protocolo j&aacute; cadastrado.'; exit;
                $lin = mysql_fetch_object($res);
                    
                    if($lin->protocolo_idprotocolo != $_POST['idprotocolo']) {
                        echo'An&aacute;lise j&aacute; cadastrada.'; exit;    
                    }
            }
            
        unset($sql,$res,$ret,$lin);
        
        $sql = "UPDATE analise SET protocolo_idprotocolo = ".$_POST['idprotocolo'].",situacao = '".$_POST['situacao']."',responsavel = '".$_POST['responsavel']."',art_rrt = '".$_POST['art_rrt']."',arquitetonico = '".$_POST['arquitetonico']."',hidrosanitario = '".$_POST['hidrosanitario']."',parecer = '".$_POST['parecer']."',autentico = '".$_POST['autentico']."',ultimo_usuario = '".$_POST['ultimo_usuario']."',datado = '".$_POST['datado']."' WHERE idanalise = ".$_POST['idanalise']."";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //cuidando da parte de documentacao
                $documentacao = count($_POST['documentacao']);

                    if($documentacao > 0) {
                        //seleciona todas as infracoes da fiscalizacacao
                        $sql2 = "SELECT analise_idanalise,documentacao_iddocumentacao FROM analise_has_documentacao WHERE analise_idanalise = ".$_POST['idanalise']."";
                        $res2 = mysql_query($sql2);
                        $ret2 = mysql_num_rows($res2);

                            if($ret2 != 0) {
                                    //se as infracoes solicitadas forem maior que os registros ja cadastrados, entao acrescenta novas infracoes
                                    #if($ret2 < $documentacao) {
                                        for ($i = 0;$i < $documentacao;$i++) {
                                            $lin2 = mysql_fetch_object($res2);

                                                if($_POST['documentacao'][$i] != $lin2->infracao_idinfracao) {
                                                    $sql3 = "SELECT documentacao_iddocumentacao FROM analise_has_documentacao WHERE analise_idanalise = ".$_POST['idanalise']." AND infracao_idinfracao = ".$_POST['documentacao'][$i]."";
                                                    $res3 = mysql_query($sql3);
                                                    $ret3 = mysql_num_rows($res3);

                                                        if($ret3 == 0) {
                                                            $sql4 = "INSERT INTO analise_has_documentacao (analise_idanalise,documentacao_iddocumentacao) VALUES (".$_POST['idanalise'].",".$_POST['documentacao'][$i].")";
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
                                for ($i = 0;$i < $documentacao;$i++) {
                                    $sql3 = "INSERT INTO analise_has_documentacao (analise_idanalise,documentacao_iddocumentacao) VALUES (".$_POST['idanalise'].",".$_POST['documentacao'][$i].")";
                                    $res3 = mysql_query($sql3);
                                    unset($sql3,$res3);
                                }
                            }
                    }

                //cuidando dos historicos
                $sql5 = "INSERT INTO historico_analise (analise_idanalise,datado,hora,arquitetonico,hidrosanitario,monitor) VALUES (".$_POST['idanalise'].",'".date('Y-m-d')."','".date('H:m:s')."','".$_POST['historico_arquitetonico']."','".$_POST['historico_hidrosanitario']."','O')";
                $res5 = mysql_query($sql5);
                unset($sql5,$res5);

                $pyanalise = md5('idanalise');
                echo'<script>document.location = "printAnalise.php?'.$pyanalise.'='.$_POST['idanalise'].'"</script>';
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$pyanalise,$hora);
    }
    else {
        echo'Tente novamente.'; 
    }
?>
