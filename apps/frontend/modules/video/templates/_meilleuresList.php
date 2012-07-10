
<div id="recentes-list" class="list-sidebar">
	<h3>
		Les 10 vidéos à ne pas manquer !
	</h3>
	<ol>
		<?php foreach ($videos as $video): ?>
			<li>
				<a href="<?php echo $video->getUrlShow() ?>">
					<img class="border-grey thumb" src="<?php echo $video->getSrcThumbnail(295,90) ?>" alt="<?php echo $video->getTitle() ?>" />
					<div class="title-list"><?php echo $video->getTitle(); ?></div>
				</a>
			</li>
		<?php endforeach; ?>
	</ol>
</div>