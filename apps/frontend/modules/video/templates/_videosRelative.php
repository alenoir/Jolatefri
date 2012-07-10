<div id="videos-relatives" class="list-video-show">
	<h3>D'autres vidéos dans le même style !</h3>
	<ul>
		<?php foreach ($videos as $key => $video): ?>
			<li class="<?php echo ($key%2)?'last':'';?>">
				<a title="<?php echo $video->getTitle() ?>" class="thumbnail" href="<?php echo $video->getUrlShow() ?>">
					<img class="border-grey" src="<?php echo $video->getSrcThumbnail(130, 70) ?>" alt="<?php echo $video->getTitle() ?>" />
					<p><?php echo $video->getTitle() ?></p>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
