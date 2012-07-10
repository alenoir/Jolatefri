<div id="videos-relatives" class="list-video-show">
	<ul>
		<?php foreach ($videos as $video): ?>
			<li>
				<a class="thumbnail" href="<?php echo $video->getUrlShow() ?>">
					<img class="border-grey" src="<?php echo $video->getSrcThumbnail(90, 60) ?>" alt="<?php echo $video->getTitle() ?>" />
					<span><?php echo $video->getTitle() ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>