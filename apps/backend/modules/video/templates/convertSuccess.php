
<article class="single">
	<form action="" method="post" id="<?php echo $video->getId();?>">
		<header class="single-header">
			<input name="id" type="hidden" value="<?php echo $video->getId() ?>" />
			<h2 class="single-title"><?php echo $video->getTitle() ?></h2>
		</header>
		<img src="<?php echo $video->getSrcThumbnail(140, 103) ?>" alt="<?php echo $video->getTitle() ?>" />
		<section class="single-content">

    			<div class="single-video border-grey">
    				<?php echo $video->getLecteurVideo(ESC_RAW) ?>
    			</div>
			<input type="text" name="file" />
		</section>
		<input type="submit" value="envoyer" />
	</form>
</article>
