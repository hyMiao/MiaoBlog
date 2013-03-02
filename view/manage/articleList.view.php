<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset='utf-8' />
		<link rel="stylesheet" type="text/css" href="../assets/css/common.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/myblog.css" />
		<script type="text/javascript" src="../assets/javascript/jquery-1.9.1.min.js"></script>
	</head>
	<body>
		<div class="navbar">
			<?php include_once('navbar.view.php'); ?>
		</div>
		<div class="container">
			<div class="header"></div>
			<div class="content">
				<div class="width width3">
					<?php include(WEBROOT.'view/manage/sidebar.view.php');?>
				</div>
				<div class="width width7">
					<div>
						<div class="blog-table">
							<table>
							<?php
								$article_list = $this->article_list;
								print '<tr><th class="table-title" colspan="12">文章列表</th></tr>';
								if(isset($article_list)){
									foreach($article_list as $article){
										print '<tr>'.
											      '<td style="width:30px;">'.$article['articleid'].'</td>'.
											      '<td style="min-width:150px;">'.
													  '<a href="../article/articleDetail?articleid='.$article['articleid'].'">'.$article['title'].'</a>'.
												  '</td>'.
											      '<td>'.$article['submit_time'].'</td>'.
											      '<td>'.
												      '<a href="articleEdit?articleid='.$article['articleid'].'">修改</a> '.
													  '<a id="articleDelete" onclick="ajaxArticleDelete('.$article['articleid'].')">删除</a>'.
												  '</td>'.
											  '</tr>';											  
									}
								}
							?>
							</table>
							<script type="text/javascript">
								function ajaxArticleDelete(id){
									$.post("ajaxArticleDelete",
									{
										articleid:id
									},
									function(data){
										if(data == 1){
											alert("Article Delete Success!");
											window.location.href = "articleList";
										}else{
											alert("Sorry.Article Delete Failed.");
										}
									});
								}
							</script>
						</div>
						<div id="response">
						</div>
					</div>
				</div>
			</div>
			<div class="for-copyright">
				<?php include_once(WEBROOT.'view/copyright.view.php'); ?>
			</div>
		</div>
	</body>
</html>