<?php
    $pyfolder = md5('folder');
    $exp = explode('/',$_GET[''.$pyfolder.'']);
    #echo $_GET[''.$pyfolder.'']." - ".$exp[1]." - ".$exp[2]; exit;
    
    $del = unlink($_GET[''.$pyfolder.'']);
    $del = unlink(''.$_GET['raiz'].'/'.$exp[1].'/tb-'.$exp[2]);
        
        if (!$del) {
            echo'Erro ao excluir a foto.'; exit;
        }
        /*else {
            header('location:fotoVeiculo.php?'.$pyfolder.'='.$exp[1].'');
        }*/
    
    unset($pyfolder,$del,$exp);
?>