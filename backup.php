<?php
    include_once('conexao.php');
    ini_set('max_execution_time', 600);
    set_time_limit(600);

    $return = '';
    $tables = array();
    $result = mysql_query('SHOW TABLES');

        while($row = mysql_fetch_row($result)) {
            $tables[] = $row[0];
        }

        //cycle through each table and format the data
        foreach($tables as $table) {
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
            #$return.= 'DROP TABLE '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";

                for($i = 0; $i < $num_fields; $i++) {
                    while($row = mysql_fetch_row($result)) {
                        $return.= 'INSERT INTO '.$table.' VALUES(';

                            for($j=0; $j<$num_fields; $j++) {
                                $row[$j] = addslashes($row[$j]);
                                $row[$j] = ereg_replace("\n","\\n",$row[$j]);

                                    if(isset($row[$j])) {
                                        $return.= '"'.$row[$j].'"' ;
                                    } 
                                    else { 
                                        $return.= '""';
                                    }

                                    if ($j<($num_fields-1)) { $return.= ','; }
                            } //for

                        $return.= ");\n";
                    } //while
                }// for

            $return.="\n\n\n";
        } //foreach

    //save the file
    $file = 'bd/backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
    $handle = fopen($file,'w+');
    fwrite($handle,$return);
    fclose($handle);
        
        //creating file to download
        if (file_exists($file)) {
            header('Content-Description: Back up');
            header('Content-Type: application/sql');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: '.filesize($file));
            readfile($file);
        }
 ?>