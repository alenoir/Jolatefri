
<li class="entry-landing <?php echo ($key%3 == 0)?'first clear':'';?>">
	<a class="thumb-link" href="<?php echo $video->getUrlShow();?>" title="Voir : <?php echo $video->getTitle();?>">
		<div class="wrapper-link">
			<img src="<?php echo $video->getSrcThumbnail(180, 105);?>" alt="<?php echo $video->getTitle();?>" />
		
			<!--div class="info">
				<span class="like"><?php echo $video->getNbLike();?></span>
				<span class="comment"><?php echo $video->getNbComment();?></span>
				<a class="category" href="<?php echo $video->getUrlShow();?>" title="<?php echo $video->getTitle();?>"><?php echo $video->getCategory();?></a>
			</div-->
			<h3 class="title">
				<?php echo $video->getTitle();?>
			</h3>
		</div>
	</a>
</li>