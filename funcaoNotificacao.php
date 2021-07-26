<?php
    $q = strtolower($_GET['q']);
	if (!$q) return;
    
    include_once('conexao.php');
    
    $sql = "SELECT idimovel,inscricao FROM imovel WHERE monitor = 'O' ORDER BY inscricao";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret != 0) {
            while($lin = mysql_fetch_row($res)) {
                $items[$lin[1]] = ($lin[0]);
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