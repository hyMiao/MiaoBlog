<?php

class ManageController extends Controller{
	private $usermanage = null;
	private $articlemanage = null;
	private $sitemanage = null;
	private $username = null;
	private $user = null;
	private $user_tmp = null;

	function __construct(){
		parent::__construct(__CLASS__);
		
		$this->usermanage = $this->model->manageModel_getModel('user');
		$this->articlemanage = $this->model->manageModel_getModel('article');
		$this->sitemanage = $this->model->manageModel_getModel('site');
		
		$this->login_site_info = $this->sitemanage->siteModel_getSiteInfo();
		$this->login_site_info = $this->login_site_info[0];
		
		if(!($this->checkSession())){
			header('Location:../error/error403.html');
		}
		$this->user = $this->usermanage->userModel_getUserInfo();
		//$this->user = $this->usermanage->userModel_getUserInfo(array('username'=>'admin_hy'));
		
		//$user_tmp = $this->user[0];
		$user_tmp = $this->user;
		$user_tmp = $user_tmp[0];
		foreach($user_tmp as $key=>$value){
			if(($value === '') || (!isset($value))){
				$user_tmp[$key] = '无';
			}
		}
		
		$this->user_tmp = $user_tmp;
		
		$this->view->userinfo = $this->user_tmp;
		$this->view->login_site_info = $this->login_site_info;
	}
	
	function index(){
		$this->view->display(__CLASS__, __FUNCTION__);
	}
	
	function userInfoEdit(){
		$this->view->userinfo = $this->user_tmp;
		$this->view->display(__CLASS__, __FUNCTION__);

	}
	
	function articleList(){
		$this->view->article_list = $this->articlemanage->articleModel_getArticleInfo('all', array());
		$this->view->display(__CLASS__, __FUNCTION__);
	}
	
	function articleAdd(){
		$this->view->category_info = $this->articlemanage->articleModel_queryCategoryInfo();
		$this->view->display(__CLASS__, __FUNCTION__);
	}
	
	function articleEdit(){
		//$this->view->display(__CLASS__, __FUNCTION__);
		//$result = $this->articlemanage->articleModel_editArticle('update', $params);
		$this->view->display(__CLASS__, __FUNCTION__);
	}
	
	function ajaxUserInfoEditPost(){
		//$this->view->display(__CLASS__, __FUNCTION__);
		//其实检查下面这几个好像是废话- -
		//反正检查了session 没session也进不来- -有session的也没人会如此疼吧...
		$this->checkSource(__FUNCTION__);
		if(!isset($_POST['userEdit'])){
			header('Location:index');
		}
		$user_edit = $_POST['userEdit'];
		foreach($user_edit as $key=>$value){
			if($value === '')
				unset($user_edit[$key]);
		}
		$user_edit = array_reverse($user_edit);
		$user_edit['username'] = $_SESSION['username'];
		//$user_edit['username'] = 'admin_hy';
		$user_edit = array_reverse($user_edit);
		if(isset($user_edit['pwd'])){
			$user_edit['pwd'] = md5($user_edit['pwd']);		
		}
		$result = $this->usermanage->userModel_changeInfo('user', $user_edit);
	}	
	
	function ajaxArticleAdd(){
		//$this->view->display(__CLASS__, __FUNCTION__);
		$params = $_POST['articleAdd'];
		//var_dump($params);
		foreach($params as $key=>$value){
			if($value === '')
				unset($params[$key]);
		}
		if(isset($params['password'])){
			$params['password'] = md5($params['password']);
		}
		$result = $this->articlemanage->articleModel_editArticle('insert', $params);
		if($result === true){
			print 1;
		}else{
			//$this->view->msg = 'Article add failed.Please try to add again';
			print 0;
		}
	}
	
	function ajaxArticleDelete(){
		$articleid = $_POST['articleid'];
		//var_dump($articleid);
		$result = $this->articlemanage->articleModel_editArticle('delete', array('articleid'=>$articleid));
		//var_dump($result);
		if($result === true){
			print 1;
		}else{
			//$this->view->msg = 'Article add failed.Please try to add again';
			print 0;
		}
	}
	
	function articleVisibilityChange(){
		$articleid = $_POST['articleid'];
		$visibility = $_POST['visibility'];
		$result = $this->articlemanage->articleModel_editArticle('update', array('articleid'=>$articleid, 'visibility'=>$visibility));
	}
	
	function checkSession(){
		if(isset($_SESSION['username'])){
			$this->username = $_SESSION['username'];
			return true;
		}else{
			return false;
		}
	}
	
	function checkSource($function){
		$check_str = 'http://'.$_SERVER['HTTP_HOST'].str_replace($function, 'index', $_SERVER['REQUEST_URI']);
		if((!isset($_SERVER['HTTP_REFERER'])) || ($check_str != $_SERVER['HTTP_REFERER'])){
			header('Location:index');
		}
	}
	
	function ajaxManage(){
		$action_name = $_POST['action_name'];
		//$action_name = $_GET['action_name'];
		switch($action_name){
			case 'am':
				break;
			case 'aa':
				
				//var_dump($this->view->category_info);
				break;
			case 'ae':
				break;
			case 'uie':
				$this->userInfoPost();
				break;
			default:
				header('HTTP/1.1 404 Not Found');
				break;
		}
	}
}
?>