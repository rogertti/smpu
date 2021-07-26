<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['idinfracao'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['nivel'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['descricao'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['valor'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if ($filtro == 3) {
        //n„o permitir ' ou "
        $_POST['descricao'] = str_replace("'","&#39;",$_POST['descricao']);
        $_POST['descricao'] = str_replace('"','&#34;',$_POST['descricao']);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT idinfracao FROM infracao WHERE nivel = '".$_POST['nivel']."' AND descricao = '".$_POST['descricao']."' AND idinfracao <> ".$_POST['idinfracao']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Infra&ccedil;&atilde;o j&aacute; cadastrada.'; exit;
            }
            
        unset($sql,$res,$ret);
        
        //insere no banco
        $sql = "UPDATE infracao SET nivel = '".$_POST['nivel']."',descricao = '".$_POST['descricao']."',valor = '".$_POST['valor']."' WHERE idinfracao = ".$_POST['idinfracao']."";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                echo'true';
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res);   
    }
    else {
        echo'Tente novamente.'; 
    }

    unset($filtro,$msgnull);
?>