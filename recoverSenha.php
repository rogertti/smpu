<?php
    ini_set('SMTP','smtp.camboriu.sc.gov.br');
    ini_set('smtp_port',587);

    //mail
    $nome = "SMPU";
    $remetente = "smpu@camboriu.sc.gov.br";
    $assunto = "Recupere sua senha";
    $header = implode("\n",array("From: $nome <$remetente>","Subject: $assunto","Return-Path: $remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=iso-8859-1"));
    
    include_once('conexao.php');
    
    $sql = "SELECT senha FROM contribuinte WHERE email = '".$_POST['email']."'";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {
            $lin = mysql_fetch_object($res);
            $conteudo = 'Sua senha &eacute; <strong>'.base64_decode($lin->senha).'</strong>';
        }
        else {
            $sql = "SELECT senha FROM funcionario WHERE email = '".$_POST['email']."'";
            $res = mysql_query($sql);
            $ret = mysql_num_rows($res);
                
                if($ret != 0) {
                    $lin = mysql_fetch_object($res);
                    $conteudo = 'Sua senha &eacute; <strong>'.base64_decode($lin->senha).'</strong>';
                }
            
            unset($sql,$res,$ret,$lin);
        }
                        
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin);

        if(!mail($_POST['email'],$assunto,$conteudo,$header)) {
            echo'A mensagem n&atilde;o foi enviada';
        }
        else {
            echo'true';
        }

    unset($nome,$remetente,$assunto,$header,$conteudo);
?>