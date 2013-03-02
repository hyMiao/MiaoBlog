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
					<div class="blog-categoryInfo">
						<div class="blog-sidebar-header"><p class="blog-sidebar-header-content">文章分类</p></div>
						<ul class="blog-sidebar-list">
							<?php
								$page_amount = 10;
								$current_page = ((!isset($_GET['page'])) || ($_GET['page'] == ''))?1:$_GET['page'];
								$category_info = $this->category_info;
								foreach($category_info as $value){
									print '<li class="blog-category-item"><a href="categoryDetail?categoryid='.$value['categoryid'].'">'.$value['categoryname'].'('.$value['article_count'].')</a></li>';
								}
							?>
						</ul>
					</div>
					<div class="for-pagebar">
						<?php include_once(WEBROOT.'view/pagebar.view.php'); ?>
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