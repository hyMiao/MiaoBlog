<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../assets/css/common.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/myblog.css" />
	</head>
	
	<body>
		<div class="login" style="background-color:#f7f7f7;">
			<?php print $this->msg ?>
			<div class="blog-sidebar-header">
				<p class="blog-sidebar-header-content">LogIn</p>
			</div>
			<form action="doLogin" method="post" class="form-login">
				<table class="">
					<tr>
						<td>
							<label class="">Username：</label>
						</td>
						<td>
							<input class="" type="text" name="username" maxlength="20" />
						</td>
					</tr>
					<tr>
						<td>
							<label class="">Password：</label>
						</td>
						<td>
							<input class="" type="password" name="password" maxlength="16" />
						</td>
					</tr>
					<tr colspan="2">
						<td>
							<input class="btn btn-normal" type="submit" value="LogIn" />
						</td>
						<td>
							<input class="" type="checkbox" name="rememberme" /> Remember me
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="copyright">
		</div>
	</body>
</html>
