<div id="list-category-sidebar">
	<h3>Catégories</h3>
	<ul>
		<?php foreach ($categorys as $category): ?>
		<li>
			<div id="cat-<?php echo $category->getName() ?>" class="list-category <?php //if($category->isCategory() echo 'is-category';?>)">
				<span style="display:none;" class="retour-category"></span>
				<a href="<?php echo url_for('@video_list_category?category='.$category->getName()) ?>"><?php echo $category->getName() ?></a>
			</div>
			
		</li>
		<?php endforeach; ?>
	</ul>
</div>

<script>

$(document).ready(function() {
	$('#list-category-sidebar li').hover(
	  function () {
	    $(this).children('.list-category').toggleClass('hover');
	    $(this).children('.list-category').children('.retour-category').toggle();
	  }, 
	  function () {
	    $(this).children('.list-category').toggleClass('hover');
	    $(this).children('.list-category').children('.retour-category').toggle();
	  }
	);

});

</script>