<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idimovel'])) { echo $msgnull.' Inscri&ccedil;&atilde;o cadastral inv&aacute;lida.'; exit; } else { $filtro = 1; }
    if (empty($_POST['engenheiro'])) { $_POST['engenheiro'] = 0; }
    if (empty($_POST['funcionario'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['recolhimento'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['entrada'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['hora'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['construcao'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if ($filtro == 5) {
        //n„o permitir ' ou "
        $_POST['requerente'] = str_replace("'","&#39;",$_POST['requerente']);
        $_POST['requerente'] = str_replace('"','&#34;',$_POST['requerente']);
        $_POST['construcao'] = str_replace("'","&#39;",$_POST['construcao']);
        $_POST['construcao'] = str_replace('"','&#34;',$_POST['construcao']);
        $_POST['referencia'] = str_replace("'","&#39;",$_POST['referencia']);
        $_POST['referencia'] = str_replace('"','&#34;',$_POST['referencia']);
        
        //trata o cpf/cnpj do requerente
        if ((!empty($_POST['cpf'])) and (empty($_POST['cnpj']))) { $documento = $_POST['cpf']; }
        if ((empty($_POST['cpf'])) and (!empty($_POST['cnpj']))) { $documento = $_POST['cnpj']; }
        
        //trata o telefone/celular do requerente
        if ((!empty($_POST['telefone'])) and (empty($_POST['celular']))) { $contato = $_POST['telefone']; }
        if ((empty($_POST['telefone'])) and (!empty($_POST['celular']))) { $contato = $_POST['celular']; }
        
        //inverter data para ano-mÍs-dia
        $dia = substr($_POST['entrada'],0,2);
        $mes = substr($_POST['entrada'],3,2);
        $ano = substr($_POST['entrada'],6);
        $_POST['entrada'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);
        
        $dia = substr($_POST['vencimento'],0,2);
        $mes = substr($_POST['vencimento'],3,2);
        $ano = substr($_POST['vencimento'],6);
        $_POST['vencimento'] = $ano."-".$mes."-".$dia;
        unset($dia,$mes,$ano);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        /*$sql = "SELECT recolhimento FROM requerimento WHERE imovel_idimovel = ".$_POST['idimovel']." AND recolhimento = '".$_POST['recolhimento']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);

            if ($ret != 0) {
                echo'O recolhimento '.$_POST['recolhimento'].' j&aacute; est&aacute; cadastrado para essa inscri&ccedil;&atilde;o'; exit;
            }

        unset($sql,$res,$ret);*/
        
        $sql = "INSERT INTO requerimento (imovel_idimovel,engenheiro_idengenheiro,funcionario_idfuncionario,requerente,cpf_cnpj,telefone,email,recolhimento,alvara,entrada,hora,construcao,area,vencido,vencimento,referencia,monitor,ultimo_usuario) VALUES (".$_POST['idimovel'].",".$_POST['engenheiro'].",".$_POST['funcionario'].",'".$_POST['requerente']."','".$documento."','".$contato."','".$_POST['email']."','".$_POST['recolhimento']."','".$_POST['alvara']."','".$_POST['entrada']."','".$_POST['hora']."','".$_POST['construcao']."','".$_POST['area']."','".$_POST['vencido']."','".$_POST['vencimento']."','".$_POST['referencia']."','O','".$_POST['ultimo_usuario']."')";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //echo'true';
                $sql2 = "SELECT idrequerimento FROM requerimento ORDER BY idrequerimento DESC LIMIT 0,1";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        $idrequerimento = $lin2->idrequerimento;
                        $pyrequerimento = md5('idrequerimento');
                        echo'<script>document.location = "printRequerimento.php?'.$pyrequerimento.'='.$idrequerimento.'"</script>';
                    }
                    else {
                        echo'true';
                    }
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$idrequerimento,$pyrequerimento,$contato,$documento);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>
