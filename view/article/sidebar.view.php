<div class="sidebar sidebar-right blog-sidebar wall">
	<div class="gradient-wall"></div>
	<div class="blog-sidebar-panel">
		<?php
			if(isset($login_site['blogdescription'])){
				print '<div class="blog-sidebar-header">'.
					  '<p class="blog-sidebar-header-content">站点描述</p>'.
					  '</div>';
				print '<div class="site-info">'.$login_site['blogdescription'].'</div>';
			}
		?>
	</div>
	<div class="blog-sidebar-panel">
		<div class="blog-sidebar-header"><p class="blog-sidebar-header-content">Search</p></div>
		<form>
			<div class="search-bar">
				<div class="search-content">
					<input type="text" name="textSearch" class="search-text" title="" />
					<input type="submit" name="btnSearch" class="search-submit" value="" title="search~" />
				</div>
			</div>
		</form>
	</div>
	<div class="blog-sidebar-panel">
		<div class="blog-sidebar-header"><p class="blog-sidebar-header-content">文章分类</p></div>
		<ul class="blog-sidebar-list">
			<?php
				$category_info = $this->category_info;
				foreach($category_info as $value){
					print '<li class="blog-category-item"><a href="categoryDetail?categoryid='.$value['categoryid'].'">'.$value['categoryname'].'</a></li>';
				}
			?>
		</ul>
	</div>
	<div class="blog-sidebar-panel">
		<div class="blog-sidebar-header"><p class="blog-sidebar-header-content">按照日期分类</p></div>
		<ul class="blog-sidebar-list">
			<?php
				
			?>
		</ul>
	</div>
	<div class="blog-sidebar-panel">
		<div class="blog-sidebar-header"><p class="blog-sidebar-header-content">异空间传送点</p></div>
		<ul class="blog-sidebar-list">
			<li class="blog-category-item"><a href="http://www.friparia.com" title="friparia的个人站点" target="_blank">Friparia</a></li>
		</ul>
	</div>
</div>