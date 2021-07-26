<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';

    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['protocolo'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['tipo'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['texto'])) { echo $msgnull; exit; } else { $filtro++; }

    if ($filtro == 3) {
        //nao permitir ' ou "
        $_POST['texto'] = str_replace("'","&#39;",$_POST['texto']);
        $_POST['texto'] = str_replace('"','&#34;',$_POST['texto']);
        $_POST['texto'] = str_replace('%','&#37;',$_POST['texto']);

        //tratando texto
        $_POST['texto'] = htmlspecialchars($_POST['texto']);
        $_POST['texto'] = str_replace('&amp;','&',$_POST['texto']);

        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);

        include_once('conexao.php');

        //verifica se cadastro já existe
        /*$sql = "SELECT idtimbrado FROM timbrado WHERE protocolo = '".$_POST['protocolo']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);

            if ($ret != 0) {
                $pytimbrado = md5('idtimbrado');
                $lin = mysql_fetch_object($res);
                echo'Esse protocolo j&aacute; possui uma an&aacute;lise cadastrada, se n&atilde;o est&aacute; vis&iacute;vel pode ter sido exclu&iacute;da. <a href="activeAnalise.php?'.$pytimbrado.'='.$lin->idtimbrado.'">Ativar a an&aacute;lise</a>'; exit;
            }

        unset($sql,$res,$ret,$lin,$pytimbrado);*/

        $sql = "INSERT INTO timbrado (tipo_timbrado_idtipo_timbrado,protocolo,texto,autentico,ultimo_usuario,monitor) VALUES (".$_POST['tipo'].",'".$_POST['protocolo']."','".$_POST['texto']."','".$_POST['autentico']."','".$_POST['ultimo_usuario']."','O')";
        $res = mysql_query($sql);

            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //echo'true';
                $sql2 = "SELECT idtimbrado FROM timbrado ORDER BY idtimbrado DESC LIMIT 0,1";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        $pytimbrado = md5('idtimbrado');
                        echo'<url>printTimbrado.php?'.$pytimbrado.'='.$lin2->idtimbrado.'</url>';
                        unset($lin2,$pytimbrado);
                    }
                    else {
                        echo'true';
                    }

                unset($sql2,$res2,$ret2);
            }

        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull);
    }
    else {
        echo'Tente novamente.';
    }
?>
