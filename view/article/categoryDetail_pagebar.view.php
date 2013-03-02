<?php //源文件中需要提供$current_page $page_amount 两个参数?>
<ul class="pagebar">
	<li class="pagebar-header">
		<?php 
			$category_id = $this->category_id;
			($current_page <= $page_amount)?
			print $current_page.'/'.$page_amount:
			print '&infin;/'.$page_amount;		
		?>
	</li>&nbsp;
	<li class="pagebar-item"><a href="?categoryid=<?php print $category_id; ?>&page=1">&lt;&lt;&nbsp;首页</a></li>&nbsp;
	<li class="pagebar-item">
		<?php
			($current_page == 1)?
			print '<a>&lt Back</a>':
			print '<a href="?categoryid='.$category_id.'&page='.($current_page - 1).'">&lt Back</a>';
		?>
	</li>&nbsp;
		<?php
			$i = 0;
			$start_page = $current_page - 2;
			if($current_page > 2)
			print '<li class="pagebar-item"><a>...</a></li>&nbsp;';
			for($i;$i <= 4;$i ++){
				if(($start_page + $i <= 0))
					continue;
				else if(($start_page + $i) > $page_amount)
					break;
				else{
					(($start_page + $i) == $current_page)?
					print '<li class="pagebar-item pagebar-item-active"><a href="?categoryid='.$category_id.'&page='.($start_page + $i).'">'.($start_page + $i).'</a></li>&nbsp;':
					print '<li class="pagebar-item"><a href="?categoryid='.$category_id.'&page='.($start_page + $i).'">'.($start_page + $i).'</a></li>&nbsp;';
				}
			}
			if($current_page < ($page_amount - 2))
				print '<li class="pagebar-item"><a>...</a></li>&nbsp;';
		?>
	<li class="pagebar-item">
		<?php
			($current_page == $page_amount)?
			print '<a>Next &gt</a>':
			print '<a href="?categoryid='.$category_id.'&page='.($current_page + 1).'">Next &gt</a>';
		?>
	</li>&nbsp;
	<li class="pagebar-item"><a href="?categoryid=<?php print $category_id; ?>&page=<?php print $page_amount; ?>">尾页&nbsp;&gt;&gt;</a></li>
</ul>