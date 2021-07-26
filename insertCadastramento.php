<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';

    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idprotocolo'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['alvara'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['data_alvara'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['habitese'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['data_habitese'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['parecer'])) { echo $msgnull; exit; } else { $filtro++; }

    if ($filtro == 5) {
        //inverter data para ano-mÍs-dia
        $dia = substr($_POST['data_alvara'],0,2);
        $mes = substr($_POST['data_alvara'],3,2);
        $ano = substr($_POST['data_alvara'],6);
        $_POST['data_alvara'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);

        //inverter data para ano-mÍs-dia
        $dia = substr($_POST['data_habitese'],0,2);
        $mes = substr($_POST['data_habitese'],3,2);
        $ano = substr($_POST['data_habitese'],6);
        $_POST['data_habitese'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);

        include_once('conexao.php');

        //verifica se cadastro já existe
        $sql = "SELECT idcadastramento FROM cadastramento WHERE protocolo_idprotocolo = '".$_POST['idprotocolo']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);

            if ($ret != 0) {
                $pycadastramento = md5('idcadastramento');
                $lin = mysql_fetch_object($res);
                echo'Esse protocolo j&aacute; possui um cadastramento, se n&atilde;o est&aacute; vis&iacute;vel pode ter sido exclu&iacute;da. <a href="activeCadastramento.php?'.$pycadastramento.'='.$lin->idcadastramento.'">Ativar a an&aacute;lise</a>'; exit;
            }

        unset($sql,$res,$ret,$lin,$pycadastramento);

        $sql = "INSERT INTO cadastramento (protocolo_idprotocolo,alvara,data_alvara,habitese,data_habitese,parecer,monitor) VALUES (".$_POST['idprotocolo'].",'".$_POST['alvara']."','".$_POST['data_alvara']."','".$_POST['habitese']."','".$_POST['data_habitese']."','".$_POST['parecer']."','O')";
        $res = mysql_query($sql);

            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                #echo'true';
                $sql2 = "SELECT imovel.idimovel FROM imovel,requerimento,protocolo,cadastramento WHERE cadastramento.protocolo_idprotocolo = protocolo.idprotocolo AND protocolo.requerimento_idrequerimento = requerimento.idrequerimento AND requerimento.imovel_idimovel = imovel.idimovel AND cadastramento.protocolo_idprotocolo = ".$_POST['idprotocolo']."";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        $sql3 = "UPDATE imovel SET alvara = '".$_POST['alvara']."', habitese = '".$_POST['habitese']."' WHERE idimovel = ".$lin2->idimovel."";
                        $res3 = mysql_query($res3);
                        echo'true';
                    }
                /*$sql2 = "SELECT idcadastramento FROM cadastramento ORDER BY idcadastramento DESC LIMIT 0,1";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        $pyanalise = md5('idcadastramento');
                        echo'<script>document.location = "printCadastramento.php?'.$pycadastramento.'='.$lin2->idcadastramento.'"</script>';
                    }
                    else {
                        echo'true';
                    }*/
            }

        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$pycadastramento,$lin2,$sql3,$res3);
    }
    else {
        echo'Tente novamente.';
    }
?>
