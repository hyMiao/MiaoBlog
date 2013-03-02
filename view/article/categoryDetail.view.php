<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<?php include_once(WEBROOT.'view/htmlhead.view.php'); ?>
	</head>
	<body>
		<div class="for-navbar">
			<?php include_once(WEBROOT.'view/navbar.view.php'); ?>
		</div>
		<div class="container">
			<div class="for-header">
				<?php include_once(WEBROOT.'view/header.view.php'); ?>
			</div>
			<div class="content">
				<div class="width width7 wall">
					<div class="gradient-wall"></div>
					<?php
						$articles = $this->category_article;
						if(!empty($articles)){
							foreach($articles as $article){
								//var_dump($article);
								if(!isset($article['label'])){
									$article['label'] = '无标签';
								}
								print '<div class="blog-article-info">'.
										 '<div class="article-title">'.
											 '<a href="articleDetail?articleid='.$article['articleid'].'"><b>'.$article['title'].'</b></a>'.
										 '</div>'.
										 '<div class="article-category">'.
											 '<span>分类：'.$article['categoryid'].'</span>'.
										 '</div>'.
										 '<div class="article-label">'.
											 '<span>标签：'.$article['label'].'</span>'.
										 '</div>'.
										 '<div class="article-summary">'.
											 $article['summary'].
										 '</div>'.					
										 '<div class="article-control">'.
											 '<a href="articleDetail?articleid='.$article['articleid'].'">查看全文</a>'.
											 '<span>阅读('.')</span>'.
											 '<span>有用('.')</span>'.
										 '</div>'.
										 '<div class="article-time">'.
											 '<span>提交时间：'.$article['submit_time'].'</span>'.
										 '</div>'.
									 '</div><br />';
							}
						}else{
							print '<div class="article-none">这个分类下还没有任何文章哦~！</div>';
						}
					?>
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