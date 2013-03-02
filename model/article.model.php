<?php
/**
 *		MiaoBlog OpenSource Web Frame
 *		PoweredBy PlanetMiao  &&  DesignedBy hyMiao@PlanetMiaoTeam
 * 		Version: 0.0.0 Beta
 * 		Generated By hyMiao on Feb.1st, 2013
 *		More info: http://www.planetMiao.com
 */
 
/**
 *		MiaoBlog ArticleModel类文件
 *		
 *		本文件用于配置Article模型
 */
 
class ArticleModel extends Model{
	function __construct(){
		parent::__construct();
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_getArticleInfo()函数
	 *		
	 *		函数有两个参数，第一个是mode，用于设置函数的运行方式，第二个是参数数组，用于传递参数
	 *		mode有三种取值：
	 *		1、$mode = 'all'，全获取模式，获取全部文章信息
	 *				参数数组不用填写任何信息
	 *	 	2、$mode = 'article'，文章指定获取模式，根据每个文章唯一的articleid来获取对应文章信息
	 *				参数数组只有一个参数，即文章的articleid
	 *		3、$mode = 'search'，搜索模式，根据关键词对全部文章进行搜索
	 *				参数数组只有一个元素，即搜索匹配模式，匹配模式下标为pattern
	 *		返回值为一个数组，数组中为查询结果，包含字段和数值下标的数组
	 */
	function articleModel_getArticleInfo($mode = null, $params = array()){
		$sql = '';
		
		switch($mode){
			case 'all':
				$sql = 'SELECT * FROM blog_article';
				break;
			case 'article':
				$sql = 'SELECT * FROM blog_article WHERE articleid = '.$params['articleid'];
				break;
			case 'search':
				$pattern = $params['pattern'];
				$pattern = '%'.$pattern.'%';
				$sql = 'SELECT * FROM blog_article WHERE '.
						'title LIKE '.$pattern.' OR '.
						'summary LIKE '.$pattern.' OR '.
						'label LIKE '.$pattern.' OR '.
						'content LIKE '.$pattern;
				break;
			default:
				return null;
		}
		
		return $this->pdodbh->db_query($sql);
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_editArticle()函数
	 *		
	 *		函数有两个参数，第一个是mode，用于设置函数的运行方式，第二个是参数数组，用于传递参数
	 *		mode有三种取值：
	 *		1、$mode = 'insert'，文章添加模式，向数据库中添加新文章
	 *				参数数组中要求必须填写title, content字段值
	 *				选择填写summary, categoryid, label, password, visibility字段值
	 *	 	2、$mode = 'update'，文章更新模式，更新指定articleid文章的记录
	 *				参数数组中要求必须填写articleid字段值
	 *				同时填写进行更新的字段的名称和值
	 *		3、$mode = 'delete'，文章删除模式，删除指定articleid文章的记录
	 *				参数数组只有一个元素，为articleid的字段值
	 *		返回值为一个数组，数组中为查询结果，包含字段和数值下标的数组
	 */
	function articleModel_editArticle($mode = null, $params = array()){
		$sql = '';
		$result = null;
		
		switch($mode){
			case 'insert':
				$keys = '';
				$values = '';
				foreach($params as $key=>$value){
					if(isset($value)){
						if($values !== ''){
							$keys = $keys.', ';
							$values = $values.', ';
						}
						$keys = $keys.$key;
						$values = $values.'\''.$value.'\'';
					}
				}
				$submit_time = date('Y-m-d H:i:s');
				//$last_update_time = $submit_time;
				$keys = $keys.', submit_time, last_update_time';
				$values = $values.', \''.$submit_time.'\', \''.$submit_time.'\'';
				$sql = 'INSERT INTO blog_article ('.$keys.') VALUES ('.$values.')';
				$result = $this->pdodbh->db_insert($sql);
				//var_dump($sql);
				//var_dump($result);
				break;
			case 'update':
				$articleid = $params['articleid'];
				unset($params['articleid']);
				foreach($params as $key=>$value){
					if(isset($value)){
						if($sql !== ''){
							$sql = $sql.', ';
						}
						$sql = $sql.$key.' = \''.$value.'\'';
					}
				}
				$sql = 'UPDATE blog_article SET '.$sql.' WHERE articleid = '.$articleid;
				$result = $this->pdodbh->db_update($sql);
				break;
			case 'delete':
				$sql = 'DELETE FROM blog_article WHERE articleid = '.$params['articleid'];
				$result = $this->pdodbh->db_delete($sql);
				break;
			default:
				return false;
		}
		
		return $result;
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_queryArticleColumn()函数
	 *		
	 *		函数有两个参数，第一个是条件字段参数数组，为条件字段以及其限定值
	 *		第二个是查询字段参数，为查询字段的字段名（注意：仅能查询一列）
	 *		返回值为一个数组，数组中为查询结果，即所查询的列的值
	 */
	function articleModel_queryArticleColumn($params = array(), $queryparam){
		$sql = '';
		foreach($params as $key=>$value){
			if(isset($value)){
				if($sql !== ''){
					$sql = $sql.' AND ';
				}
				$sql = $sql.$key.' = '.$value;
			}
		}
		$sql = 'SELECT '.$queryparam.' FROM blog_article WHERE '.$sql;
		$result = $this->pdodbh->db_query_column($sql);
		
		return $result;
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_queryArticle()函数
	 *		
	 *		函数有两个参数，第一个是条件字段参数数组，为条件字段以及其限定值
	 *		第二个是查询字段参数数组，为查询字段的字段名
	 *		返回值为一个数组，数组中为查询结果，包含字段和数值下标的数组
	 */
	function articleModel_queryArticle($params = array(), $queryparams = array()){
		$sql = '';
		$keys = '';
		$queries = '';
		foreach($params as $key=>$value){
			if(isset($value)){
				if($keys !== ''){
					$keys = $keys.' AND ';
				}
				$keys = $keys.$key.' = '.$value;
			}
		}
		foreach($queryparams as $value){
			if(isset($value)){
				if($queries !== ''){
					$queries = $queries.', ';
				}
				$queries = $queries.$value;
			}
		}
		$sql = 'SELECT '.$queries.' FROM blog_article WHERE '.$keys;
		$result = $this->pdodbh->db_query($sql);
		
		return $result;
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_queryCategoryArticle()函数
	 *		
	 *		函数只有一个参数，即所要进行查询的分类的id
	 *		返回值为该分类下所有文章的记录
	 */
	function articleModel_queryCategoryArticle($categoryid = null){
		$sql = 'SELECT * FROM blog_article WHERE categoryid = '.$categoryid;
		$result = $this->pdodbh->db_query($sql);
		
		return $result;
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_queryCategoryInfo()函数
	 *		
	 *		函数无参数，
	 *		返回值为全部分类信息
	 */
	function articleModel_queryCategoryInfo(){
		$sql = 'SELECT * FROM blog_category';
		$result = $this->pdodbh->db_query($sql);
		
		return $result;
	}
	
	/**
	 *		MiaoBlog ArticleModel::articleModel_queryOneCategory()函数
	 *		
	 *		函数只有一个参数，即分类的id
	 *		返回值为某一特定分类的相关信息
	 */
	function articleModel_queryOneCategory($categoryid = null){
		$sql = 'SELECT * FROM blog_category WHERE categoryid = \''.$categoryid.'\'';
		$result = $this->pdodbh->db_query($sql);
		
		return $result;
	}
}
?>