	<h3>
		<a href="<?php echo url_for('@friteuse');?>" title="Direction la friteuse">Direction la friteuse ></a>
	</h3>
	<ul id="list-home-friteuse">
		
	
		<?php foreach($posts as $post):?>
			<li>
				<a href="<?php echo $post->getUrlShow();?>" title="<?php echo $post->getTitle() ?>">
					<img src="<?php echo $post->getSrcThumbnail(135, 80) ?>" /><br />
					<?php echo $post->getTitle() ?>
				</a>
	
			</li>
		<?php endforeach;?>
	</ul>	
	
	<div class="clear"></div>
