<div class="module profile">
<?php if (!$sf_user->isAuthenticated()):?>
	
		<?php include_component('user','socialConnect');?>


<?php else:?>
	
	<img src="<?php echo $sf_user->getGuardUser()->getSrcThumbnail(70,50);?>" class="photo" />
	<h2 class="username">
		<?php echo ucfirst($sf_user->getGuardUser()->getUsername());?><br />
		<span class="score">Score : <?php echo $sf_user->getGuardUser()->getScore();?> <?php echo ($sf_user->getGuardUser()->getScore())?'pts':'';?></span>
	</h2>
	<div class="clear"></div>
	
	<a href="<?php echo url_for('@user_settings');?>" class="button user edit">Modifier mon profil</a>
<?php endif;?>
	
	<?php //include_component('user','actuUser');?>
	
</div>