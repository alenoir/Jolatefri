<div id="header-profile">
<?php
if (!$sf_user->isAuthenticated())
{
?>
	<?php include_component('user','socialConnect');?>

<?php
}
?>
<?php
if ($user):?>
	<a class="thumb" href="<?php echo $user->getUrlShow();?>" title="Profil de <?php echo $user->getUsername();?>">
		<img class="border-grey" src="<?php echo $user->getSrcThumbnail(20, 20) ?>" />
	</a>
	<span class="username">
		<?php echo $user->getUsername();?>
	</span>
	 | 
	<a class="username" href="/friteuse" title="La friteuse">
		La friteuse
	</a>
	<!--
	<a class="username" href="<?php echo $user->getUrlShow();?>" title="Profil de <?php echo $user->getUsername();?>">
		<?php echo $user->getUsername();?>
	</a>
	 | 
	<a class="my-account" href="<?php echo $user->getUrlShow();?>" title="Profil de <?php echo $user->getUsername();?>">
		Mon compte
	</a>
	-->
	 | 
	<a class="signout" href="<?php echo url_for('@sf_guard_signout');?>">Deconnexion</a>
<?php endif;?>
</div>
