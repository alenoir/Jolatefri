<ul id="list-footer-cat" class="list-footer">
	<?php foreach ($categorys as $category): ?>
	<li>
		<a href="<?php echo url_for('@video_list_category?category='.$category->getName()) ?>" title="Vidéos <?php echo $category->getName() ?>">Vidéos <?php echo $category->getName() ?></a>		
	</li>
	<?php endforeach; ?>
</ul>
