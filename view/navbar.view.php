<?php
	//需要提供$page_name $page_tooltip两个参数
	//
?>
<div class="navbar">
	<div class="container">
		<?php
			$login_site = $this->login_site_info;
			//print '<a href="../article/index" class="title" title="'.(isset($page_tooltip)?$page_tooltip:'').'">'.$login_site['blogtitle'].'</a>';
			print '<a href="../article/index" class="title" title="前往博客主页">'.$login_site['blogtitle'].'</a>';
		?>
		<a class="subtitle">@MiaoBlog,</a>
		<a class="subtitle" style="margin-left:0;" href="#">&nbsp<?php print $page_name?> </a>
		<?php
			if(isset($this->login_user_info)){
				$login_user = $this->login_user_info;
				print '<a href="../user/doLogout" class="welcome log">&nbsplogout~0.0</a>';
				print '<a href="../manage/index" class="welcome" title="前往个人中心">'.$login_user['username'].'，&nbsp欢迎你</a>';
			}else{
				print '<a onclick="userLogin(\'login-dialog\')" id="login" class="welcome log" title="登录">登录</a>';
			}
		?>
	</div>
</div>

<div class="slide-dialog" id="login-dialog">
	<div class="dialog login">
		<div class="blog-sidebar-header">
			<p class="blog-sidebar-header-content">管理员登录
				<span><a class="close">×</a></span>
			</p>
		</div>
		<form method="post" class="form-login" id="login-form">
			<table class="">
				<tr>
					<td>
						<label class="">用户名：</label>
					</td>
					<td>
						<input class="" type="text" name="username" maxlength="20" />
					</td>
				</tr>
				<tr>
					<td>
						<label class="">密码：</label>
					</td>
					<td>
						<input class="" type="password" name="password" maxlength="16" />
					</td>
				</tr>
				<tr colspan="2">
					<td>
						<a id="login-submit" class="btn btn-normal">登录</a>
					</td>
					<td>
						<input class="" type="checkbox" name="rememberme" /> 记住我
					</td>
				</tr>
			</table>
		</form>
		<script type="text/javascript">
			$('#login-submit').click(function(){
				$.post("../user/doLogin",
					$("#login-form").serialize(),
					function(data){
						if(data == 0){
							alert("用户名不存在");
						}else if(data == 1){
							alert("密码错误");
						}else if(data == 2){
							alert("登录成功");
							window.location.href = "index";
						}
					});
			});
		</script>
	</div>		
</div>
<script type="text/javascript">
	var width = document.documentElement.clientWidth;
	var height = document.documentElement.clientHeight;
	
	function userLogin(id){
		var dialog_id = "#" + id;
		
		$(dialog_id).fadeIn();
		$(dialog_id + " .dialog").slideDown();
		$(dialog_id).css('width', width);
		$(dialog_id).css('height', height);
	}
	
	$('.slide-dialog .close').click(function(){
		$('.slide-dialog .dialog').slideUp();
		$('.slide-dialog').fadeOut();
	});
	
	$(document).keydown(function(event){
		if($('.slide-dialog .dialog').css('display') == 'block'){
			if(event.keyCode == 27){
				$('.slide-dialog .dialog').slideUp();
				$('.slide-dialog').fadeOut();
			}
		}else{
			return ;
		}
	});
	
	window.onresize = function(){
		width = document.documentElement.clientWidth;
		height = document.documentElement.clientHeight;
		$('.slide-dialog').css('width', width);
		$('.slide-dialog').css('height', height);
	}
</script>