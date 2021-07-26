<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['nome'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if ((empty($_POST['cau'])) and (empty($_POST['crea']))) { echo $msgnull; exit; } 
    else { 
        $filtro++;
        if ((!empty($_POST['cau'])) and (empty($_POST['crea']))) { $documento = $_POST['cau']; }
        if ((empty($_POST['cau'])) and (!empty($_POST['crea']))) { $documento = $_POST['crea']; }
    }
    /*if (empty($_POST['usuario'])) { echo $msgnull; exit; } else {
        $filtro++;
        $_POST['usuario'] = base64_encode($_POST['usuario']);
    }
    if (empty($_POST['senha'])) { echo $msgnull; exit; } else { 
        $filtro++;
        $_POST['senha'] = base64_encode($_POST['senha']);
    }
    if (empty($_POST['email'])) { echo $msgnull; exit; } else { $filtro++; }*/
    
    if ($filtro == 2) {
        //n„o permitir ' ou "
        $_POST['nome'] = str_replace("'","&#39;",$_POST['nome']);
        $_POST['nome'] = str_replace('"','&#34;',$_POST['nome']);
        
        //trata o telefone/celular do requerente
        if ((!empty($_POST['telefone'])) and (empty($_POST['celular']))) { $contato = $_POST['telefone']; }
        if ((empty($_POST['telefone'])) and (!empty($_POST['celular']))) { $contato = $_POST['celular']; }
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT cau_crea FROM engenheiro WHERE cau_crea = '".$_POST['cau']."' OR cau_crea = '".$_POST['crea']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Engenheiro j&aacute; cadastrado.'; exit;
            }
            
        unset($sql,$res,$ret);
        
        //verificar se usuário já existe
        /*$sql = "SELECT contribuinte.email,engenheiro.usuario,funcionario.usuario FROM contribuinte,engenheiro,funcionario WHERE contribuinte.email = '".$_POST['email']."' OR engenheiro.usuario = '".$_POST['usuario']."' OR funcionario.usuario = '".$_POST['usuario']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Usu&aacute;rio e/ou email j&aacute existe.'; exit;
            }
            
        unset($sql,$res,$ret);*/
        
        #$sql = "INSERT INTO engenheiro (nome,cau,crea,usuario,senha,email) VALUES ('".$_POST['nome']."','".$_POST['cau']."','".$_POST['crea']."','".$_POST['usuario']."','".$_POST['senha']."','".$_POST['email']."')";
        $sql = "INSERT INTO engenheiro (nome,cau_crea,usuario,senha,telefone,email,monitor) VALUES ('".$_POST['nome']."','".$documento."','','','".$contato."','".$_POST['email']."','O')";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                echo'true';
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$documento,$contato);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>
