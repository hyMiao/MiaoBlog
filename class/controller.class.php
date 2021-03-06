<?php
/**
 *		MiaoBlog OpenSource Web Frame
 *		PoweredBy PlanetMiao  &&  DesignedBy hyMiao@PlanetMiaoTeam
 * 		Version: 0.0.0 Beta
 * 		Generated By hyMiao on Jan.28th, 2013
 *		More info: http://www.planetMiao.com
 */
/**
 *		MiaoBlog Controller类文件
 *		
 *		本文件用于配置Controller类供其他Controller进行继承
 *		同时提供通用的变量及操作
 */ 
 
class Controller{
	private $modelname = '';
	protected $model = null;
	protected $view = null;
	protected $post = null;
	protected $get = null;
	
	function __construct($controllername = null){
		$modelname = str_replace('Controller', 'Model', $controllername);
		$this->model = new $modelname();
		
		$this->view = new View();
	}
	

}
?>