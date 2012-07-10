<div id="small-profile">
<?php
if (!$sf_user->isAuthenticated())
{
	include_component('sfGuardAuth','auth');
}
?>
<?php
if ($user):?>
	<a class="username" href="<?php echo $user->getUrlShow();?>" title="Profil de <?php echo $user->getUsername();?>">
		<img class="border-grey" src="<?php echo $user->getSrcThumbnail(50, 50) ?>" />
	</a>
	<div id="details-small-profile">
		<a class="username" href="<?php echo $user->getUrlShow();?>" title="Profil de <?php echo $user->getUsername();?>">
			<?php echo $user->getUsername();?>
		</a>
		<ul>
			<li>
				Score : <?php echo $user->getScore();?>
			</li>
		</ul>
	</div>
	
	
<?php endif;?>
</div>
