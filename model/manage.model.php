<?php
	
class ManageModel extends Model{
	private $manage;

	function __construct(){
	}
	
	public function manageModel_getModel($mode = null){
		if($mode === 'user'){
			$this->manage = new UserModel();
		}
		else if($mode === 'article'){
			$this->manage = new ArticleModel();
		}
		else if($mode === 'site'){
			$this->manage = new SiteModel();
		}else {
			$this->manage = null;
		}
		
		return $this->manage;
	}
}
?>