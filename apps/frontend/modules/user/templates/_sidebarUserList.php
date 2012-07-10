<div class="module user-list">
	<ul>
		<?php foreach($users as $user):?>
		<li>
			<a href="<?php echo $user->getUrlShow();?>" class="link-user">
				<img class="thumb-user" src="<?php echo $user->getSrcThumbnail(30, 30);?>" />
				<span class="username"><?php echo $user->getUsername();?></span>	
				<span class="score-user"><?php echo $user->getScore();?></span>
			</a>
			<div class="clear"></div>
		</li>
		<?php endforeach;?>
	</ul>
	
</div>
