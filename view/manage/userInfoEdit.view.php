<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset='utf-8' />
		<link rel="stylesheet" type="text/css" href="../assets/css/common.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/myblog.css" />
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
					<div id="action_page">
						<div>
							<?php $user = $this->userinfo; ?>
							<div class="form-header">
								<h2>用户信息修改</h2>
							</div>
							<form method="post" action="userInfoEditPost">
								<div class="form-group">
									<label>E-mail：</label>
									<input class="form-input" type="text" name="userEdit[email]" value="<?php print $user['email']; ?>" />
								</div>
								<div class="form-group">
									<label>密码：</label>
									<input class="form-input" type="password" name="userEdit[pwd]"/>
								</div>
								<div class="form-group">
									<label>电话：</label>
									<input class="form-input" type="text" name="userEdit[phone]" value="<?php print $user['phone']; ?>" />
								</div>
								<div class="form-group">
									<label>备注：</label>
									<textarea name="userEdit[comment]" cols="60" rows="10"><?php print $user['comment']; ?></textarea>
								</div>
								<div class="form-group">
									<input class="btn btn-normal" type="submit" value="Save" />
								</div>
							</form>
						</div>
						<div class="">
							<?php
								
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="for-copyright">
				<?php include_once(WEBROOT.'view/copyright.view.php'); ?>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		function loadPage(string){
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('action_page').innerHTML=xmlhttp.responseText;
				}
			}
			//xmlhttp.open("POST", "../view/manage/ajax_manage.php", true);
			xmlhttp.open("POST", "ajaxManage", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			string = 'action_name=' + string;
			xmlhttp.send(string);
		}
	</script>

</html>