<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<?php include_once(WEBROOT.'view/htmlhead.view.php'); ?>
		<script type="text/javascript" src="../assets/javascript/ckeditor/ckeditor.js"></script>
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
						<div class="form-header">
							<h2>添加新文章</h2>
						</div>
						<form method="post" id="articleAddForm">
							<div class="form-group">
								<label>Title：</label>
								<br />
								<textarea name="articleAdd[title]" cols="60" rows="1"></textarea>
							</div>
							<div class="form-group">
								<label>摘要：</label>
								<br />
								<textarea name="articleAdd[summary]" cols="60" rows="5"></textarea>
							</div>
							<div class="form-group">
								<label>标签：</label>
								<input class="form-input" type="text" name="articleAdd[label]" />
							</div>
							<div class="form-group">
								<label>文章密码：</label>
								<input class="form-input" type="password" name="articleAdd[password]" />
							</div>
							<div class="form-group">
								<label>文章可见性：</label>
								<br />
								<input type="radio" name="articleAdd[visibility]" value="10" />私人笔记，仅作者可见
								<br />
								<input type="radio" name="articleAdd[visibility]" value="0"  checked="checked" />全员可见无限制
							</div>
							<div class="form-group">
								<label>文章分类：</label>
								<select name="articleAdd[categoryid]">
								<?php
									$category_info = $this->category_info;
									foreach($category_info as $value){
										print '<option value="'.$value['categoryid'].'">'.$value['categoryname'].'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label>正文部分：</label>
								<textarea id="editor" name="articleAdd[content]" cols="60" rows="15"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace('articleAdd[content]');
								</script>
							</div>
							<div class="form-group">
								<input class="btn btn-submit" id="articleSubmit" type="button" value="Submit" />
								<script type="text/javascript">
									$("#articleSubmit").click(function(){
										for (instance in CKEDITOR.instances){
											CKEDITOR.instances[instance].updateElement();
										}
										$.post("ajaxArticleAdd",
										$("#articleAddForm").serialize(),
										function(data){
											//alert(data);
											if(data == 1){
												alert("Success!");
												window.location.href = "articleList";
											}else{
												alert("Sorry.Failed.");
											}
										});
									});
								</script>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="for-copyright">
				<?php include_once(WEBROOT.'view/copyright.view.php'); ?>
			</div>
		</div>
	</body>
</html>