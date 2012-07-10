<ul id="list-footer-cat" class="list-footer">
	<?php foreach ($searchs as $search): ?>
	<li>
		<a href="<?php echo url_for('@video_search_get?query='.$search->getContent()) ?>"><?php echo $search->getContent() ?></a>		
	</li>
	<?php endforeach; ?>
</ul>
