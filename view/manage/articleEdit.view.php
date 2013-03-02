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
							<script type="text/javascript">
								
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