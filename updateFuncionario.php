<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idfuncionario'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['nome'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['matricula'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['usuario'])) { echo $msgnull; exit; } else { 
        $filtro++;
        $_POST['usuario'] = trim($_POST['usuario']);
        $_POST['usuario'] = base64_encode($_POST['usuario']);
    }
    if (empty($_POST['senha'])) { echo $msgnull; exit; } else { 
        $filtro++;
        $_POST['senha'] = trim($_POST['senha']);
        $_POST['senha'] = base64_encode($_POST['senha']);
    }
    if (empty($_POST['email'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if ($filtro == 6) {
        //n„o permitir ' ou "
        $_POST['nome'] = str_replace("'","&#39;",$_POST['nome']);
        $_POST['nome'] = str_replace('"','&#34;',$_POST['nome']);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT matricula FROM funcionario WHERE matricula = '".$_POST['matricula']."' AND idfuncionario <> ".$_POST['idfuncionario']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Funcion&aacute;rio j&aacute; cadastrado.'; exit;
            }
            
        unset($sql,$res,$ret);
        
        //verificar se usuário já existe
        /*$sql = "SELECT contribuinte.email,engenheiro.usuario,funcionario.usuario FROM contribuinte,engenheiro,funcionario WHERE (contribuinte.email = '".$_POST['email']."' OR engenheiro.usuario = '".$_POST['usuario']."' OR funcionario.usuario = '".$_POST['usuario']."') AND idfuncionario <> ".$_POST['idfuncionario']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Usu&aacute;rio e/ou email j&aacute existe.'; exit;
            }
            
        unset($sql,$res,$ret);*/
        
        $sql = "UPDATE funcionario SET nome = '".$_POST['nome']."',matricula = '".$_POST['matricula']."',usuario = '".$_POST['usuario']."',senha = '".$_POST['senha']."',email = '".$_POST['email']."',tipo = '".$_POST['tipo']."' WHERE idfuncionario = ".$_POST['idfuncionario']."";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                echo'true';
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>