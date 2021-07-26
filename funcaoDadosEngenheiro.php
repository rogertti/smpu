<?php
    include_once('conexao.php');

    $sql = "SELECT telefone,email FROM engenheiro WHERE idengenheiro = ".$_GET['idengenheiro']."";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);

        if($ret != 0) {
            while($lin = mysql_fetch_object($res)) {
                $protocolo[$lin->telefone] = $lin->telefone.'-'.$lin->email;
            }

            echo json_encode($protocolo);
        }
        else {
            echo'no';
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$protocolo);
?>
