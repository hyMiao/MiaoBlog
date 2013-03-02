<?php

class View{
	function __construct(){
		
	}
	
	public function display($controllername, $action){
		$controller = lcfirst(str_replace('Controller', '', $controllername));
		include_once(WEBROOT.'/view/'.$controller.'/'.$action.'.view.php');
	}
}
?>