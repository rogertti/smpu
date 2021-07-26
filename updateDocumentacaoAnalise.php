<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';

    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['iddocumentacao'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['descricao'])) { echo $msgnull; exit; } else { $filtro = 1; }

    if ($filtro == 1) {
        //n„o permitir ' ou "
        $_POST['descricao'] = str_replace("'","&#39;",$_POST['descricao']);
        $_POST['descricao'] = str_replace('"','&#34;',$_POST['descricao']);
        $_POST['descricao'] = str_replace('%','&#37;',$_POST['descricao']);

        include_once('conexao.php');

        //verifica se cadastro já existe
        $sql = "SELECT iddocumentacao FROM documentacao WHERE descricao = '".$_POST['descricao']."' AND iddocumentacao <> ".$_POST['iddocumentacao']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);

            if ($ret != 0) {
                echo'Documenta&ccedil;&atilde;o j&aacute; cadastrada.'; exit;
            }

        unset($sql,$res,$ret);

        //insere no banco
        $sql = "UPDATE documentacao SET descricao = '".$_POST['descricao']."' WHERE iddocumentacao = ".$_POST['iddocumentacao']."";
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
