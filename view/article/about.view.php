<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<?php include_once(WEBROOT.'view/htmlhead.view.php'); ?>
	</head>
	<body>
		<div class="for-navbar">
			<?php 
				$page_name = '主页';
				$page_tooltip = '';
				include_once(WEBROOT.'view/navbar.view.php'); 
			?>
		</div>
		<div class="container">
			<div class="for-header">
				<?php include_once(WEBROOT.'view/header.view.php'); ?>
			</div>
			<div class="content">
				<div class="width width7 wall">
					<div class="gradient-wall"></div>
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