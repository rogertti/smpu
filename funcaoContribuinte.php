<?php
    #header("Content-Type: text/html; charset=ISO-8859-1",true);
    ini_set('display_errors', 'on');

    $q = strtolower($_GET['q']);
    if (!$q) return;
    
    include_once('conexao.php');
    
    $sql = "SELECT idcontribuinte,nome FROM contribuinte ORDER BY nome";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {
            while($lin = mysql_fetch_object($res)) {
                $items[$lin->nome] = ($lin->idcontribuinte);
            }
            
            foreach ($items as $key=>$value) {
                if (strpos(strtolower($key), $q) !== false) {
                    echo "$key|$value\n";
                }	
            }
        }
    
    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$items,$key,$value);
?>