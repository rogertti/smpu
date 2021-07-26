<?php
    session_start();
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    ini_set('display_errors', 'on');
    error_reporting(E_WARNING);
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['usuario'])) { echo $msgnull; exit; } else { $usuario = base64_decode($_POST['usuario']); $_POST['usuario'] = trim($_POST['usuario']); /*$_POST['usuario'] = base64_encode($_POST['usuario']);*/ $filtro = 1; }
    if (empty($_POST['senha'])) { echo $msgnull; exit; } else { $senha = base64_decode($_POST['senha']); $_POST['senha'] = trim($_POST['senha']); /*$_POST['senha'] = base64_encode($_POST['senha']);*/ $filtro++; }
    
    if ($filtro == 2) {    
        include_once('conexao.php');
        
        //buscando na tabela contribuinte        
        $sql = "SELECT idcontribuinte,cpf_cnpj FROM contribuinte WHERE codigo = '".$senha."' AND cpf_cnpj = '".$usuario."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
        
            if($ret != 0) {
                $lin = mysql_fetch_object($res);
                $_SESSION['id'] = base64_encode($lin->idcontribuinte);
                $_SESSION['key'] = base64_encode($lin->cpf_cnpj);
                echo'contribuinte';
            }
            else {
                $nn = 1;
            }
        
        unset($sql,$res,$ret,$lin);
        
        //buscando na tabela engenheiro        
        /*$sql = "SELECT idengenheiro,crea FROM engenheiro WHERE usuario = '".$_POST['usuario']."' AND senha = '".$_POST['senha']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
        
            if($ret != 0) {
                $lin = mysql_fetch_row($res);
                $_SESSION['key'] = md5($lin[1]);
                echo'engenheiro';
            }
            else { $nn++; }
        
        unset($sql,$res,$ret,$lin);*/
        
        //buscando na tabela funcionario        
        $sql = "SELECT idfuncionario,matricula,nome,tipo FROM funcionario WHERE usuario = '".$_POST['usuario']."' AND senha = '".$_POST['senha']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
        
            if($ret != 0) {
                $lin = mysql_fetch_object($res);
                $_SESSION['id'] = base64_encode($lin->idfuncionario);
                $_SESSION['key'] = base64_encode($lin->matricula);
                $_SESSION['name'] = base64_encode($lin->nome);
                $_SESSION['type'] = base64_encode($lin->tipo);
                
                echo'funcionario';
            }
            else {
                $nn++;
            }
        
        mysql_close($conexao);
            
            if($nn == 2) { echo'Esse login n&atilde;o existe.'; }
            
        unset($conexao,$charset,$sql,$res,$ret,$lin,$filtro,$msgnull,$email,$nn,$usuario,$senha);
    }
?>
