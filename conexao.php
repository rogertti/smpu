<?php
    define("DB_TYPE","mysql");
	define("DB_HOST","mysql.embracore.com.br");
	define("DB_USER","embracore18");
	define("DB_PASS","emb3974");
	define("DB_DATA","embracore18");

    $conexao = mysql_connect(DB_HOST,DB_USER,DB_PASS);
 	$charset = mysql_client_encoding($conexao);
 	mysql_select_db(DB_DATA);
 	mysql_query("SET NAMES utf8");
 	mysql_query("SET CHARACTER_SET utf8");
?>
