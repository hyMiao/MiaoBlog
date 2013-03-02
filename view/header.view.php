<div class="header">
	<div class="header-title">
		<div class="header-blog-title">
			<?php print $login_site['blogtitle']; ?>
		</div>
		<div class="header-blog-subtitle">
			<?php 
				if(isset($login_site['blogsubtitle']))
					print $login_site['blogsubtitle']; 
			?>
		</div>
	</div>
	<div class="navbar">
		<ul>
			<li>
				<a href="../article/index">
					Home
					<span>首页</span>
				</a>
				
			</li>
			<li>
				<a href="../article/categoryInfo">
					Category
					<span>分类目录</span>
				</a>
			</li>
			<li>
				<a href="../article/categoryInfo">
					About
					<span>关于我们</span>
				</a>
			</li>
		</ul>
	</div>
</div>