<div class="navbar">
	<div class="container">
		<?php
			$login_site = $this->login_site_info;
			print '<a href="../article/index" class="title" title="前往博客主页">'.$login_site['blogtitle'].'</a>';
		?>
		<a class="subtitle">@MiaoBlog,</a>
		<a class="subtitle" style="margin-left:0;" href="#">&nbsp主页</a>
		<?php
			if(isset($this->login_user_info)){
				$login_user = $this->login_user_info;
				print '<a href="../user/doLogout" class="welcome">&nbsplogout~0.0</a>';
				print '<a href="../manage/index" class="welcome" title="前往个人中心">'.$login_user['username'].'，&nbsp欢迎你</a>';
			}else{
				print '<a href="../user/index" class="welcome" title="登录">登录</a>';
			}
		?>
	</div>
</div>