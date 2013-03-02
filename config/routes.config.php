<?php
/**
 *		MiaoBlog OpenSource Web Frame
 *		PoweredBy PlanetMiao  &&  DesignedBy hyMiao@PlanetMiaoTeam
 * 		Version: 0.0.0 Beta
 * 		Generated By hyMiao on Jan.29th, 2013
 *		More info: http://www.planetMiao.com
 */
 
/**
 *		MiaoBlog 路由及页面分发配置文件
 *		
 *		本文件用于将url定位到指定位置
 */

//require_once('global.config.php');
 
$request_url = $_SERVER['REQUEST_URI'];
$query_string = $_SERVER['QUERY_STRING'];
if(isset($query_string)){
	$request_url = preg_replace('/\?(.*)/', '', $request_url);
	//var_dump($request_url);
}

$request_url_array = explode('/', $request_url);
$action = array_pop($request_url_array);
if($action === ''){
	$action = array_pop($request_url_array);
}
$controller = array_pop($request_url_array);

#unit_test
//var_dump($request_url_array);
//var_dump($controller);
//var_dump($action);

?>