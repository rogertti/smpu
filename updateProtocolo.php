<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idprotocolo'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['requerimento'])) { echo $msgnull; exit; } else { $filtro = 1; }
    #if (empty($_POST['codigo'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['situacao'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if ($filtro == 2) {
        //n„o permitir ' ou "
        $_POST['situacao'] = str_replace("'","&#39;",$_POST['situacao']);
        $_POST['situacao'] = str_replace('"','&#34;',$_POST['situacao']);
        $_POST['observacao'] = str_replace("'","&#39;",$_POST['observacao']);
        $_POST['observacao'] = str_replace('"','&#34;',$_POST['observacao']);
        
        //trantando a taxa
        $_POST['taxa'] = str_replace(',','',$_POST['taxa']);
        
        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        /*$sql = "SELECT codigo FROM protocolo WHERE codigo = '".$_POST['codigo']."' AND idprotocolo <> ".$_POST['idprotocolo']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Protocolo j&aacute; cadastrado.'; exit;
            }
            
        unset($sql,$res,$ret);*/
        
        $sql = "UPDATE protocolo SET requerimento_idrequerimento = ".$_POST['requerimento'].",taxa = '".$_POST['taxa']."',situacao = '".$_POST['situacao']."',observacao = '".$_POST['observacao']."',autentico = '".$_POST['autentico']."',ultimo_usuario = '".$_POST['ultimo_usuario']."' WHERE idprotocolo = ".$_POST['idprotocolo']."";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //echo'true';
                $pyprotocolo = md5('idprotocolo');
                echo'<script>document.location = "printProtocolo.php?'.$pyprotocolo.'='.$_POST['idprotocolo'].'"</script>';
                    
                //buscando o idservico cadastrado
                /*$sql2 = "SELECT idservico FROM servico WHERE protocolo = '".$_POST['protocolo']."'";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);
                
                    if($ret2 != 0) {
                        $lin = mysql_fetch_row($res2);
                        $idservico = $lin[0];
                        $pyservico = md5('idservico');
                    }
                
                //Caso o serviço seja "consulta de viabilidade" ou "habite-se de qualquer natureza" ou "vistoria sanitária",
                //redireciona para um formulário específico
                switch($_POST['recolhimento']) {
                    case 'Consulta de viabilidade':
                        echo'<script>document.location = "novaViabilidade.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                    
                    case 'Habite-se':
                        echo'<script>document.location = "novaHabitese.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                    
                    case 'Habite-se e certidão de averbação':
                        echo'<script>document.location = "novaHabitese.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                    
                    case 'Habite-se e renovação de álvara':
                        echo'<script>document.location = "novaHabitese.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                    
                    case 'Habite-se, certidão de averbação e renovação de álvara':
                        echo'<script>document.location = "novaHabitese.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                    
                    case 'Vistoria sanitária':
                        echo'<script>document.location = "novaSanitaria.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                    
                    default:
                        //echo'true';
                        echo'<script>document.location = "printProtocolo.php?'.$pyservico.'='.$idservico.'"</script>';
                    break;
                }*/
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$idservico,$pyservico);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>