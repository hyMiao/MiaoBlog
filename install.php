<?php
require_once('config/global.config.php');
define('ACCESS_ALLOW', 1);
if(ACCESS_ALLOW != 1){
	header('Location:article/index');
}
if(INSTALL_ACCOMPLISH == true){
	header('Location:article/index');
}else{
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/common.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/install.css" />
		<script type="text/javascript" src="assets/javascript/jquery-1.9.1.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div ></div>
			<div class="content">
				<?php 
					if(!isset($_GET['step'])){
						$step = 0;
					}else{
						$step = $_GET['step'];
					}
					switch($step){
						case 1:
							$_SESSION['step'] = 2;
				?>
				<div class="step" id="step1">
					<p>欢迎使用MiaoBlog个人博客框架</p>
					<p style="margin-bottom:40px;">使用前请确认php的pdo扩展已经安装</p>
					<a class="btn btn-normal" href="?step=2">Next</a>
				</div>
				<?php
							break;
						case 2:
							if((!isset($_SESSION['step']))||($_SESSION['step'] != 2))
								if((isset($_SESSION['step']))&&($_SESSION['step'] != 5))
									header('refresh:0;url=?step=1');
								//var_dump($_SESSION['step']);
				?>
				<div class="step" id="step2">
					<table class="table-info">
						<form  method="post" action="?step=3">
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>数据库产品类型</label>
									</td>
									<td>
										<input type="text" name="dbconfig[db_type]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>数据库登录主机</label>
									</td>
									<td>
										<input type="text" name="dbconfig[db_host]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>数据库名称</label>
									</td>
									<td>
										<input type="text" name="dbconfig[db_name]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>数据库登录用户</label>
									</td>
									<td>
										<input type="text" name="dbconfig[db_user]" />
									</td>
								</div>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>数据库登录密码</label>
									</td>
									<td>
										<input type="password" name="dbconfig[db_password]" />
									</td>
								</div>
							</tr>
							<tr>
								<td colspan="2">
									<p>注：若使用mysql请在产品类型处填写mysql，建议使用mysql<br/>本地主机请在登录主机处填写localhost</p>
								</td>
							</tr>
							<tr>
								<div class="form-group">
									<td colspan="2">
										<a class="btn btn-normal" href="?step=1">Back</a>
										<input class="btn btn-normal" type="submit" value="Submit" />
									</td>
								</div>
							</tr>
						</form>
					</table>
				</div>
				<?php
							$_SESSION['step'] = 3;
							break;
						case 3:
							if((!isset($_SESSION['step']))||($_SESSION['step'] != 3)){
								//header('refresh:0;url=?step=1');
								header('refresh:0;url=?step='.$_SESSION['step']);
							}else{
				?>
				<div class="step" id="step3">
					<?php
						$install_flag = false;
						
						if(!isset($_POST['dbconfig'])){
							$_SESSION['step'] = 2;
							print '<p>未接收到数据</p><p>1s后返回上一页面</p>';
							header('refresh:1;url=?step=2');
						}else{
						
							if(isset($_POST['dbconfig'])){
								$dbconfig = $_POST['dbconfig'];
								$db_type = $dbconfig['db_type'];
								$db_host = $dbconfig['db_host'];
								$db_name = $dbconfig['db_name'];
								$db_user = $dbconfig['db_user'];
								$db_password = $dbconfig['db_password'];
								
								try{
									$dsn = $db_type.':host='.$db_host.';dbname='.$db_name;
									$dbh = new PDO($dsn, $db_user, $db_password);
									$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$install_flag = true;
								}catch(PDOException $e){
									print "DB Connect Error!Error Msg:".$e->getMessage()."<br />";
									print 'ErrorCode:'.($e->getCode());
									$install_flag = false;
								}
							}
									
							if($install_flag == true){
								try{
									if($content = file_get_contents('sql/miaoblog.sql')){
										$sqls = array();
										$sqls = explode(';', $content);
										foreach($sqls as $sql){
											$result = $dbh->exec($sql);
										}
										$install_flag = true;
									}else{
										print 'DB Import Error!Error Msg:'.$e->getMessage().'<br />';
										$install_flag = false;
									}
								}catch(PDOException $e){
									print 'DB Import Error!Error Msg:'.$e->getMessage().'<br />';
									print 'ErrorCode:'.($e->getCode());
									$install_flag = false;
								}
							}
							
							if($install_flag == true){
								$install_flag = false;
								
								for($i = 0;$i <= 10;$i ++){
									if($content = file_get_contents('config/db.config.php')){
										if($fp = fopen('config/db.config.php', 'w')){
											/*
											$content = str_replace("'PDO_DB_TYPE', ''", "'PDO_DB_TYPE', '".$db_type."'", $content);
											$content = str_replace("'PDO_DB_HOST', ''", "'PDO_DB_HOST', '".$db_host."'", $content);
											$content = str_replace("'PDO_DB_NAME', ''", "'PDO_DB_NAME', '".$db_name."'", $content);
											$content = str_replace("'PDO_DB_USER', ''", "'PDO_DB_USER', '".$db_user."'", $content);
											$content = str_replace("'PDO_DB_PASSWORD', ''", "'PDO_DB_PASSWORD', '".$db_password."'", $content);
											*/
											$content = preg_replace("/'PDO_DB_TYPE', '(.)*'/", "'PDO_DB_TYPE', '".$db_type."'", $content);
											$content = preg_replace("/'PDO_DB_HOST', '(.)*'/", "'PDO_DB_HOST', '".$db_host."'", $content);
											$content = preg_replace("/'PDO_DB_NAME', '(.)*'/", "'PDO_DB_NAME', '".$db_name."'", $content);
											$content = preg_replace("/'PDO_DB_USER', '(.)*'/", "'PDO_DB_USER', '".$db_user."'", $content);
											$content = preg_replace("/'PDO_DB_PASSWORD', '(.)*'/", "'PDO_DB_PASSWORD', '".$db_password."'", $content);
											try{
												fwrite($fp,$content);
												fclose($fp);
												$install_flag = true;
											}catch(Exception $e){
												print 'File Error'.$e->getMessage().'<br />';
												$install_flag = false;
											}
										}else{
											print 'File Error'.$e->getMessage().'<br />';
											$install_flag = false;
										}
									}else{
										print 'File Error'.$e->getMessage().'<br />';
										$install_flag = false;
									}
									
									if($install_flag == true){
										break;
									}
								}
								
								if($install_flag == false){
									print '<p>数据库配置文件写入失败</p><p>请重新进行安装操作或者手动进行配置文件的修改</p>';
								}
							}
							
							if($install_flag == true){
								/*
								$_SESSION['db_type'] = $db_type;
								$_SESSION['db_host'] = $db_host;
								$_SESSION['db_name'] = $db_name;
								$_SESSION['db_user'] = $db_user;
								$_SESSION['db_password'] = $db_password;
								*/
								$_SESSION['step'] = 4;
								header('refresh:0;url=?step=4');
							}else{
								print '<p>数据库连接出现错误 请检查填写信息是否正确</p><p>3s后返回数据库信息填写界面</p>';
								$_SESSION['step'] = 2;
								header('refresh:3;url=?step=2');
							}
						}
					}
					?>
				</div>
				<?php
							break;
						case 4:
							if((!isset($_SESSION['step']))||($_SESSION['step'] != 4))
								//header('refresh:0;url=?step=1');
								if((isset($_SESSION['step']))&&($_SESSION['step'] != 7))
									header('refresh:0;url=?step='.$_SESSION['step']);
				?>
				<div class="step" id="step4">
					<?php print '数据库连接成功！'; ?>
					<table class="table-info">
						<form  method="post" action="?step=5">
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>站点名：</label>
									</td>
									<td>
										<input type="text" name="site[blogtitle]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>站点副标题：</label>
									</td>
									<td>
										<input type="text" name="site[blogsubtitle]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>站点描述：</label>
									</td>
									<td>
										<input type="text" name="site[blogdescription]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>作者介绍：</label>
									</td>
									<td>
										<input type="text" name="site[userdescription]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td colspan="2">
										<a class="btn btn-normal" href="?step=2">Back</a>
										<input class="btn btn-normal" type="submit" value="Submit" />
									</td>
								</div>
							</tr>
						</form>
					</table>
				</div>
				<?php
							$_SESSION['step'] = 5;
							break;
						case 5:
							if((!isset($_SESSION['step']))||($_SESSION['step'] != 5)){
								//header('refresh:0;url=?step=1');
								header('refresh:0;url=?step='.$_SESSION['step']);
							}else{
				?>
				<div class="step" id="step5">
					<?php
						$install_flag = true;
						
						if(!isset($_POST['site'])){
							$_SESSION['step'] = 4;
							print '未接收到数据<br />1s后返回上一页面<br />';
							header('refresh:1;url=?step=4');
						}
						
						if(isset($_POST['site'])){
							//$siteinfo = $_POST['site'];
							$_SESSION['site'] = $_POST['site'];
							//$_SESSION['blogtitle'] = $siteinfo['blogtitle'];
							//$_SESSION['blogsubtitle'] = $siteinfo['blogsubtitle'];
							//$_SESSION['blogdescription'] = $siteinfo['blogdescription'];
							//$_SESSION['userdescription'] = $siteinfo['userdescription'];
							$_SESSION['step'] = 6;
							header('refresh:0;url=?step=6');
						}
					}
					?>
				</div>
				<?php
							break;
						case 6:
							if((!isset($_SESSION['step']))||($_SESSION['step'] != 6)){
								//header('refresh:0;url=?step=1');
								if(($_SESSION['step'] == 3)){
									$_SESSION['step'] = 2;
									header('refresh:0;url=?step=2');
									//var_dump($_SESSION['step']);
								}else{
									header('refresh:0;url=?step='.$_SESSION['step']);
								}
							}
				?>
				<div class="step" id="step6">
					<table class="table-info">
						<form  method="post" action="?step=7">
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>用户名：</label>
									</td>
									<td>
										<input type="text" name="admin[username]" />
									</td>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<td class="table-label">
										<label>密码：</label>
									</td>
									<td>
										<input type="password" name="admin[pwd]" />
									</td>
								</div>
							</tr>
							<tr>	
								<div class="form-group">
									<td class="table-label">
										<label>昵称（用于评论）：</label>
									</td>
									<td>
										<input type="text" name="admin[nickname]" />
									</td>
								</div>
							</tr>	
							<tr>	
								<div class="form-group">
									<td class="table-label">
										<label>email：</label>
									</td>
									<td>
										<input type="text" name="admin[email]" />
									</td>
								</div>
							</tr>	
							<tr>	
								<div class="form-group">
									<td class="table-label">
										<label>phone：</label>
									</td>
									<td>
										<input type="text" name="admin[phone]" />
									</td>
								</div>
							</tr>	
							<tr>	
								<div class="form-group">
									<td class="table-label">
										<label>备注：</label>
									</td>
									<td>
										<input type="text" name="admin[comment]" />
									</td>
								</div>
							</tr>	
							<tr>	
								<div class="form-group">
									<td colspan="2">
										<a class="btn btn-normal" href="?step=4">Back</a>
										<input class="btn btn-normal" type="submit" value="Submit"/>
									</td>
								</div>
							</tr>
						</form>
					</table>
				</div>
				<?php
							$_SESSION['step'] = 7;
							break;
						case 7:
							if((!isset($_SESSION['step']))||($_SESSION['step'] != 7)){
								//header('refresh:0;url=?step=1');
								header('refresh:0;url=?step='.$_SESSION['step']);
							}else{
				?>
				<div class="step" id="step7">
				<?php
					$install_flag = true;
					
					if(!isset($_POST['admin'])){
						$_SESSION['step'] = 6;
						print '未接收到数据<br />1s后返回上一页面<br />';
						header('refresh:1;url=?step=6');
					}else{
						/*
						$db_type = $_SESSION['db_type'];
						$db_host = $_SESSION['db_host'];
						$db_name = $_SESSION['db_name'];
						$db_user = $_SESSION['db_user'];
						$db_password = $_SESSION['db_password'];
						*/
					
						if(($install_flag == true)&&(isset($_POST['admin']))){
							$admin = $_POST['admin'];
							foreach($admin as $key=>$value){
								if(($value == '')||(!isset($value))){
									unset($admin[$key]);
								}
							}
							$admin['pwd'] = md5($admin['pwd']);
							$user = new UserModel();
							$result = $user->userModel_add($admin);
							if($result){
								$install_flag = true;
							}else{
								$install_flag = false;
								print '内容设定出现错误，3s后返回上一页面<br />';
								$_SESSION['step'] = 6;
								header('refresh:3;url=?step=6');
							}
						}
						
						if(($install_flag == true)&&(isset($_SESSION['site']))){
							$site = $_SESSION['site'];
							foreach($site as $key=>$value){
								if(($value == '')||(!isset($value))){
									unset($site[$key]);
								}
							}
							$new_site = new SiteModel();
							$result = $new_site->siteModel_editSiteInfo('insert', $site);
							if($result){
								$install_flag = true;
							}else{
								$install_flag = false;
								print '站点内容设定出现错误，3s后返回站点内容设置页面<br />';
								$_SESSION['step'] = 4;
								header('refresh:3;url=?step=4');
							}
						}
						
						if($install_flag == true){
							$install_flag = false;
							
							for($i = 0;$i <= 10;$i ++){
								if($content = file_get_contents('config/global.config.php')){
									if($fp = fopen('config/global.config.php', 'w')){
										$content = preg_replace("/'INSTALL_ACCOMPLISH', (.)*\);/", "'INSTALL_ACCOMPLISH', true);", $content);
										try{
											fwrite($fp,$content);
											fclose($fp);
											$install_flag = true;
										}catch(Exception $e){
											print 'File Error'.$e->getMessage().'<br />';
											$install_flag = false;
										}
									}else{
										print 'File Error'.$e->getMessage().'<br />';
										$install_flag = false;
									}
								}else{
									print 'File Error'.$e->getMessage().'<br />';
									$install_flag = false;
								}
								
								if($install_flag == true){
									break;
								}
							}
							
							if($install_flag == false){
								print '全局配置文件写入失败<br />无法修改安装完成标识<br />请重新进行安装操作或者手动进行配置文件的修改<br />';
							}
						}
						
						if($install_flag == true){
							print '<p>恭喜安装成功!</p><p>3s后引导您进入博客首页</p>';
							header('refresh:3;url=article/index');
						}
					}
				}
				?>
				</div>
				<?php
						break;
					default:
						header('refresh:0;url=?step=1');
						break;
					}
				?>
			</div>
			<div class="copyright"></div>
		</div>
	</body>
</html>
<?php }?>