<?php
	require_once('config/global.config.php');
	
	if(INSTALL_ACCOMPLISH == false){
		
	}
	$pdotest = new DB_pdo('mysql', 'localhost', 'learn', 'learn', 'learn');
	var_dump($pdotest->db_column_query('SELECT gid FROM user'));	
	var_dump($request_url);
?>

<a href="class/db.class.php">a</a>