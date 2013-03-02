<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<?php include_once(WEBROOT.'view/htmlhead.view.php'); ?>
	</head>
	<body>
		<div class="for-navbar">
			<?php include_once('navbar.view.php'); ?>
		</div>
		<div class="container">
			<div class="for-header">
				<?php include_once(WEBROOT.'header.view.php'); ?>
			</div>
			<div class="content">
				<div class="width width3">
					<div class="for-sidebar">
						<?php include_once('sidebar.view.php'); ?>
					</div>
				</div>
				<div class="width width7 wall">
					<div class="gradient-wall"></div>
					<?php
						$article_detail = $this->article_detail;
							print '<div class="blog-article-detail">'.
									  '<div class="article-title">'.
										  '<b>'.$article_detail['title'].'</b></a>'.
									  '</div>'.
									  '<div class="article-category">'.
										  '<span>分类：'.$article_detail['categoryinfo'].'</span>'.
									  '</div>'.
									  '<div class="article-label">'.
										  '<span>标签：'.
										  ((($article_detail['label'] == '')||(!isset($article_detail['label'])))?'无标签':$article_detail['label']).
										  '</span>'.
									  '</div>'.
									      '<div class="article-summary">摘要：'.
										  (isset($article_detail['summary'])?$article_detail['summary']:'无').
									  '</div>'.					
									  '<div class="article-content">'.
										  $article_detail['content'].
									  '</div>'.
									  '<div class="article-time submit-time">'.
									      '<span>文章提交时间：'.$article_detail['submit_time'].'</span>'.
									  '</div>'.
									  '<div class="article-time update-time">'.
										  '<span>上次修改时间：'.$article_detail['last_update_time'].'</span>'.
									  '</div>'.
								  '</div>';
					?>
				</div>
				
			</div>
			<div class="for-copyright">
				<?php include_once(WEBROOT.'view/copyright.view.php'); ?>
			</div>
		</div>
	</body>
</html>