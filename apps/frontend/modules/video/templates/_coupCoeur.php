<div id="coup-coeur">
	<?php foreach ($videos as $video): ?>
		<a href="<?php echo $video->getUrlShow() ?>">
			<img class="border-grey" src="<?php echo $video->getSrcThumbnail(265, 137)?>" alt="<?php echo $video->getTitle() ?>" />
		</a>
		<a href="<?php echo $video->getUrlShow() ?>"><?php echo $video->getTitle() ?></a>
	<?php endforeach; ?>
</div>
