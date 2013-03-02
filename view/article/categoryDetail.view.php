<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<?php include_once(WEBROOT.'view/htmlhead.view.php'); ?>
	</head>
	<body>
		<div class="for-navbar">
			<?php 
				$page_name = '分类文章查看页面';
				$page_tooltip = '';
				include_once(WEBROOT.'view/navbar.view.php'); 
			?>
		</div>
		<div class="container">
			<div class="for-header">
				<?php include_once(WEBROOT.'view/header.view.php'); ?>
			</div>
			<div class="content">
				<div class="width width7 wall">
					<div class="gradient-wall"></div>
					<?php
						$page_amount = $this->page_amount;
						$current_page = ((!isset($_GET['page'])) || ($_GET['page'] == ''))?1:$_GET['page'];
						$articles = $this->category_article;
						
						if(!empty($articles)){
							foreach($articles as $article){
								//var_dump($article);
								if(!isset($article['label'])){
									$article['label'] = '无标签';
								}
								$summaryid = 'summary'.$article['articleid'];
								$article['summary'] = preg_replace('/\r*/', '', $article['summary']);
								$article['summary'] = preg_replace('/(\r\n)*/', '', $article['summary']);
								$article['summary'] = preg_replace('/\n*/', '', $article['summary']);
								$article['summary'] = str_replace('"', '\"', $article['summary']);
								print '<div class="blog-article-info">'.
										 '<div class="article-title">'.
											 '<a href="articleDetail?articleid='.$article['articleid'].'">'.$article['title'].'</a>'.
										 '</div>'.
										'<div class="article-category">'.
											 '<span>分类：<a target="_blank" href="categoryDetail?categoryid='.$article['categoryid'].'">'.$article['categoryinfo'].'</a></span>'.
										 '</div>'.
										 '<div class="article-label">'.
											 '<span>标签：'.$article['label'].'</span>'.
										 '</div>'.
										 '<div class="article-summary" id="'.$summaryid.'">'.
											'<script type="text/javascript">'.
												'document.getElementById("'.$summaryid.'").innerHTML = "'.$article['summary'].'";'.
											'</script>'. 
										 '</div>'.							
										 '<div class="article-control">'.
											 '<a target="_blank" href="articleDetail?articleid='.$article['articleid'].'">查看全文</a>'.
											 '<span>阅读('.$article['read_count'].')</span>'.
											 '<span><a>有用</a>('.$article['useful_count'].')</span>'.
										 '</div>'.
										 '<div class="article-time">'.
											 '<span>提交时间：'.$article['submit_time'].'</span>'.
										 '</div>'.
									     '<div class="seperator-horizontal">'.'</div>'.
									 '</div><br />'."\n";
							}
						}else{
							print '<div class="article-none">这个分类下还没有任何文章哦~！</div>';
						}
					?>
					<div class="for-pagebar">
						<?php include_once('categoryDetail_pagebar.view.php'); ?>
					</div>
				</div>
				<div class="width width3">
					<div class="for-sidebar">
						<?php include_once('sidebar.view.php'); ?>
					</div>
				</div>
			</div>
			<div class="for-copyright">
				<?php include_once(WEBROOT.'view/copyright.view.php'); ?>
			</div>
		</div>
	</body>
</html>