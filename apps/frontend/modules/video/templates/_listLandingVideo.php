<article class="polaroid <?php echo ($key)?'':'first';?> <?php echo ($key == 5)?'left':'';?>">
		<a class="polaroid-thumb" rel="nofollow" href="<?php echo $video->getUrlShow() ?>" title="<?php echo $video->getTitle() ?>">
			<img src="<?php echo $video->getSrcThumbnail(($key)?120:265,($key)?90:200) ?>" alt="<?php echo $video->getTitle() ?>" />
		</a>
		<a title="<?php echo $video->getTitle() ?>" class="hover-title" href="<?php echo $video->getUrlShow() ?>" >
			<?php if(!$key):?>
				<?php echo $video->getTitle() ?>
			<?php endif;?>
		</a>
		<?php if(!$key):?>
		<header class="resume">
			<?php echo image_tag('picto_time.png', array('class' => 'picto-time'));?>
			<time> 
				<?php echo $video->getTimeLapse() ?>
			</time>
			<div class="resume-comment">
					<fb:comments-count href=http://www.jolatefri.com<?php echo $video->getUrlShow() ?>></fb:comments-count>
				<?php echo image_tag('picto_comment.png', array('class' => 'picto-comment'));?>
			</div>
		</header>
		<?php endif;?>
</article>

