<?php
/**
 *		MiaoBlog OpenSource Web Frame
 *		PoweredBy PlanetMiao  &&  DesignedBy hyMiao@PlanetMiaoTeam
 * 		Version: 0.0.0 Beta
 * 		Generated By hyMiao on Jan.28th, 2013
 *		More info: http://www.planetMiao.com
 */

/**
 *		MiaoBlog Model类文件
 *		
 *		本文件用于配置Model类供其他Model进行继承
 *		同时提供通用的变量及操作
 */ 

class Model{
	protected $pdodbh = null;
	
	function __construct(){
		$this->pdodbh = new DB_pdo(PDO_DB_TYPE, PDO_DB_HOST, PDO_DB_NAME, PDO_DB_USER, PDO_DB_PASSWORD);
		//var_dump($this->pdoInstance->db_column_query('SELECT gid FROM user'));
	}
	
}

//$mo = new Model();
?>