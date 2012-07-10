<div id="header_user" class="block">
	<img src="<?php echo $user->getSrcThumbnail(120,120);?>" class="photo" />
	
	<div id="infos">
		<h2 class="username"><?php echo ucfirst($user->getUsername()) ?></h2>
		<p class="about">
			<?php echo $user->getAbout() ?>
		</p>
		<a class="website" target="_blank" rel="nofollow" href="<?php echo $user->getWebsite() ?>" >
			<?php echo $user->getWebsite() ?>
		</a>
	</div>
	
	<div id="stats">
		<ul>
			<li>
				Score : <?php echo $user->getScore() ?>
			</li>
		</ul>
	</div>
</div>
