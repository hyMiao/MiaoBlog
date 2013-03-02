<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../assets/css/common.css" />
	</head>
	
	<body>
		<div class="login">
			<?php print $this->msg ?>
			<form action="doLogin" method="post" class="form-login">
				<div class="form-group horizontal">
					<label class="form-label">用户名：</label>
					<input class="form-input" type="text" name="username" maxlength="20" />
				</div>
				<div class="form-group horizontal">
					<label class="form-label">密码：</label>
					<input class="form-input" type="password" name="password" maxlength="16" />
				</div>
				<div class="form-submit">
					<input class="checkbox" type="checkbox" name="rememberme" /> 记住我
					<input class="button-submit" type="submit" value="登录" />
				</div>
			</form>
		</div>
		<div class="copyright">
		</div>
	</body>
</html>
