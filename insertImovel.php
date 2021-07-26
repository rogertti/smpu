<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    #if (empty($_POST['album'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['idcontribuinte'])) {
        if (empty($_POST['contribuinte'])) { $ca = 1; $filtro = 1; } else { $cc = 1; $filtro = 1; }
        if ((empty($_POST['cpf'])) and (empty($_POST['cnpj']))) { $ca++; $documento = ''; $filtro++; } 
        else { 
            $cc++;
            $filtro++;
             
            if ((!empty($_POST['cpf'])) and (empty($_POST['cnpj']))) { $documento = $_POST['cpf']; }
            if ((empty($_POST['cpf'])) and (!empty($_POST['cnpj']))) { $documento = $_POST['cnpj']; }
        }
        
        if($ca == 2) {
            $_POST['idcontribuinte'] = 0;
        }
    } 
    else { $filtro = 2; }
    if (empty($_POST['inscricao'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['matricula'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['endereco'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['numero'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['bairro'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['cidade'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['estado'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['lote'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['quadra'])) { echo $msgnull; exit; } else { $filtro++; }
    #if (empty($_POST['loteamento'])) { echo $msgnull; exit; } else { $filtro++; }
    
    
    if ($filtro == 3) {
        //n„o permitir ' ou "
        #$_POST['inscricao'] = str_replace("'","&#39;",$_POST['inscricao']);
        #$_POST['inscricao'] = str_replace('"','&#34;',$_POST['inscricao']);
        $_POST['endereco'] = str_replace("'","&#39;",$_POST['endereco']);
        $_POST['endereco'] = str_replace('"','&#34;',$_POST['endereco']);
        $_POST['bairro'] = str_replace("'","&#39;",$_POST['bairro']);
        $_POST['bairro'] = str_replace('"','&#34;',$_POST['bairro']);
        #$_POST['cidade'] = str_replace("'","&#39;",$_POST['cidade']);
        #$_POST['cidade'] = str_replace('"','&#34;',$_POST['cidade']);
        $_POST['garagem'] = str_replace("'","&#39;",$_POST['garagem']);
        $_POST['garagem'] = str_replace('"','&#34;',$_POST['garagem']);
        $_POST['lote'] = str_replace("'","&#39;",$_POST['lote']);
        $_POST['lote'] = str_replace('"','&#34;',$_POST['lote']);
        $_POST['quadra'] = str_replace("'","&#39;",$_POST['quadra']);
        $_POST['quadra'] = str_replace('"','&#34;',$_POST['quadra']);
        $_POST['loteamento'] = str_replace("'","&#39;",$_POST['loteamento']);
        $_POST['loteamento'] = str_replace('"','&#34;',$_POST['loteamento']);
        
        //tratando o endereco
        $_POST['endereco'] = $_POST['endereco'].", ".$_POST['numero'];
        
        include_once('conexao.php');
        
        //verifica se já existe
        $sql = "SELECT idimovel,monitor FROM imovel WHERE inscricao = '".$_POST['inscricao']."'";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                $lin = mysql_fetch_object($res);
                $pyimovel = md5('idimovel');
                
                    if($lin->monitor == 'X') {
                        echo'Im&oacute;vel desativado. <a href="activeImovel.php?'.$pyimovel.'='.$lin->idimovel.'">Ativar im&oacute;vel</a>'; exit;
                    }
                    
                    if($lin->monitor == 'O') {
                        echo'Im&oacute;vel j&aacute; cadastrado.'; exit;    
                    }
            }
            
        unset($sql,$res,$ret,$lin,$pyimovel);
        
        //inserindo o contribuinte
        if(isset($cc)) {
            if($cc <= 2) {
                $sql = "INSERT INTO contribuinte (nome,codigo,cpf_cnpj) VALUES ('".$_POST['contribuinte']."','".$_POST['codigo_contribuinte']."','".$documento."')";
                $res = mysql_query($sql);

                    if (!$res) {
                        echo'Tente novamente.'; exit;
                    }
                    else {
                        $sql2 = "SELECT idcontribuinte FROM contribuinte ORDER BY idcontribuinte DESC";
                        $res2 = mysql_query($sql2);
                        $lin = mysql_fetch_object($res2);
                        $_POST['idcontribuinte'] = $lin->idcontribuinte;
                    }

                unset($sql,$res,$sql2,$res2,$lin);    
            }
        }
        
        //inserindo o imovel
        $sql = "INSERT INTO imovel (contribuinte_idcontribuinte,inscricao,matricula,cep,endereco,apto,complemento,edificio_condominio,bairro,cidade,estado,tipo_obra,garagem,lote,quadra,loteamento,fracao,area_lote,area_unidade,area_anexo,area_englobada,area_construida,habitese,testada,alvara,monitor) VALUES (".$_POST['idcontribuinte'].",'".$_POST['inscricao']."','".$_POST['matricula']."','".$_POST['cep']."','".$_POST['endereco']."','".$_POST['apto']."','".$_POST['complemento']."','".$_POST['edificio']."','".$_POST['bairro']."','','','".$_POST['tipo_obra']."','".$_POST['garagem']."','".$_POST['lote']."','".$_POST['quadra']."','".$_POST['loteamento']."','".$_POST['fracao']."','".$_POST['area_lote']."','".$_POST['area_unidade']."','".$_POST['area_anexo']."','".$_POST['area_englobada']."','".$_POST['area_construida']."','".$_POST['habitese']."','".$_POST['testada']."','".$_POST['alvara']."','O')";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                echo'true';
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$idimovel,$pyimovel,$idcontribuinte,$pycontribuinte,$pyfolder,$documento,$ca,$cc);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>