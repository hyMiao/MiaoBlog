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
						<div class="blog-table">
							<?php
								$user = $this->userinfo;
								$html = '<table>'.
											'<tr>'.
												'<th class="table-title" colspan="4">用户信息</th>'.
											'</tr>'.
											'<tr>'.
												'<td>uid：</td><td>'.$user['uid'].'</td>'.
												'<td>用户名：</td><td>'.$user['username'].'</td>'.
											'</tr>'.
											'<tr>'.
												'<td>email：</td><td>'.$user['email'].'</td>'.
												'<td>联系电话：</td><td>'.$user['phone'].'</td>'.
											'</tr>'.
											'<tr>'.
												'<td>注册时间：</td><td>'.$user['sign_time'].'</td>'.
												'<td>上次登录时间：</td><td>'.$user['last_access_time'].'</td>'.
											'</tr>'.
											'<tr>'.
												'<td>上次登录ip：</td><td colspan="3">'.$user['last_access_ip'].'</td>'.
											'</tr>'.
											'<tr>'.
												'<td>备注：</td><td colspan="3">'.$user['comment'].'</td>'.
											'</tr>'.
										'</table>';
								print $html;
							?>
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