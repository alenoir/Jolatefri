<div id="control-post">
	<?php if($nextPost):?>
	<div id="next-post">
		<a class="link-post button" href="<?php echo $nextPost->getUrlShow() ?>">
			<img class="thumb-post" src="<?php echo $nextPost->getSrcThumbnail(50, 50) ?>" />
			<span class="title-post"><?php echo $nextPost->getTitle() ?></span>
		</a>
	</div>
	<?php endif;?>
	<?php if($previousPost):?>
	<div id="previous-post" >
		<a class="link-post button" href="<?php echo $previousPost->getUrlShow() ?>">
			<img class="thumb-post" src="<?php echo $previousPost->getSrcThumbnail(50, 50) ?>" />
			<span class="title-post"><?php echo $previousPost->getTitle() ?></span>
		</a>
	</div>
	<?php endif;?>
	<div class="clear"></div>
</div>