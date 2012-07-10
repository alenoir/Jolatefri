<nav id="menuHeader">
	<ul>
		<?php foreach ($categorys as $category): ?>
		<li>
			<a href="<?php echo url_for('@video_list_category?category='.$category->getName()) ?>"><?php echo ucfirst($category->getName()); ?></a>
		</li>
		<?php endforeach; ?>
		
	</ul>
</nav>