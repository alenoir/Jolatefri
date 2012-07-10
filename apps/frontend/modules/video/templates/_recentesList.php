<div id="recentes-list" class="list-sidebar">
	<ol>
		<?php foreach ($videos as $video): ?>
			<li>
				<a href="<?php echo $video->getUrlShow() ?>">
					<img class="border-grey" src="<?php echo $video->getSrcThumbnail(150,50) ?>" alt="<?php echo $video->getTitle() ?>" />

				</a>
			</li>
		<?php endforeach; ?>
	</ol>
</div>