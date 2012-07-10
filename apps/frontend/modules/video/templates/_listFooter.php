<ul id="list-footer-video" class="list-footer list-video-show">
	<?php foreach ($videos as $video): ?>
	<li>
				<a class="thumbnail" href="<?php echo $video->getUrlShow() ?>">
					<img class="border-grey" src="<?php echo $video->getSrcThumbnail(52, 37) ?>" alt="<?php echo $video->getTitle() ?>" />
					<span><?php echo $video->getTitle() ?></span>
				</a>
	</li>
	<?php endforeach; ?>
</ul>
