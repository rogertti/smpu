<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
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
        $_POST['arquitetonico'] = str_replace('%','&#37;',$_POST['arquitetonico']);
        $_POST['hidrosanitario'] = str_replace("'","&#39;",$_POST['hidrosanitario']);
        $_POST['hidrosanitario'] = str_replace('"','&#34;',$_POST['hidrosanitario']);
        $_POST['hidrosanitario'] = str_replace('"','&#37;',$_POST['hidrosanitario']);
        
        //tratando texto
        $_POST['arquitetonico'] = htmlspecialchars($_POST['arquitetonico']);
        $_POST['arquitetonico'] = str_replace('&amp;','&',$_POST['arquitetonico']);
        $_POST['hidrosanitario'] = htmlspecialchars($_POST['hidrosanitario']);
        $_POST['hidrosanitario'] = str_replace('&amp;','&',$_POST['hidrosanitario']);
        
        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);
        
        if(!empty($_POST['datado'])) {
            //inverter data para ano-mÍs-dia
            $dia = substr($_POST['datado'],0,2);
            $mes = substr($_POST['datado'],3,2);
            $ano = substr($_POST['datado'],6);
            $_POST['datado'] = $ano."-".$mes."-".$dia;
            unset($dia,$mes,$ano);
        }
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT idanalise FROM analise WHERE protocolo_idprotocolo = '".$_POST['idprotocolo']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                $pyanalise = md5('idanalise');
                $lin = mysql_fetch_object($res);
                echo'Esse protocolo j&aacute; possui uma an&aacute;lise cadastrada, se n&atilde;o est&aacute; vis&iacute;vel pode ter sido exclu&iacute;da. <a href="activeAnalise.php?'.$pyanalise.'='.$lin->idanalise.'">Ativar a an&aacute;lise</a>'; exit;
            }
            
        unset($sql,$res,$ret,$lin,$pyanalise);
        
        $sql = "INSERT INTO analise (protocolo_idprotocolo,situacao,responsavel,art_rrt,arquitetonico,hidrosanitario,parecer,monitor,autentico,ultimo_usuario,datado) VALUES (".$_POST['idprotocolo'].",'".$_POST['situacao']."','".$_POST['responsavel']."','".$_POST['art_rrt']."','".$_POST['arquitetonico']."','".$_POST['hidrosanitario']."','".$_POST['parecer']."','O','".$_POST['autentico']."','".$_POST['ultimo_usuario']."','".$_POST['datado']."')";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //echo'true';
                $sql2 = "SELECT idanalise FROM analise ORDER BY idanalise DESC LIMIT 0,1";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        $pyanalise = md5('idanalise');

                            for ($i = 0;$i < count($_POST['documentacao']);$i++) {
                                $sql3 = "INSERT INTO analise_has_documentacao (analise_idanalise,documentacao_iddocumentacao) VALUES (".$lin2->idanalise.",".$_POST['documentacao'][$i].")";
                                $res3 = mysql_query($sql3);

                                    if(!$res) {
                                        echo'Tente novamente.'; exit;
                                    }

                                unset($sql3,$res3);
                            }

                        echo'<script>document.location = "printAnalise.php?'.$pyanalise.'='.$lin2->idanalise.'"</script>';
                    }
                    else {
                        echo'true';
                    }
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$pyanalise);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>
