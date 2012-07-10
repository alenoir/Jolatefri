<header id="header">
<div id="header-content">
		<div id="couche5">
			<div id="couche4">
				<div id="couche3">
					<div id="couche2">
						<div id="couche1">
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
<nav id="menuHeader">
	<ul>
		<li>
			<a href="<?php echo url_for('@homepage');?>">< Retour à Jolatefri</a>
		</li>
		<li>
			<a href="<?php echo url_for('@friteuse');?>">La friteuse</a>
		</li>
		<li>
			<a href="<?php echo url_for('@friteuse_random');?>">Aléatoire</a>
		</li>
		
		<?php if ($sf_user->isAuthenticated()):?>
			<li class="right">
				<a href="<?php echo url_for('@sf_guard_signout');?>">Deconnexion</a>
			</li>
			<li class="right profile">
				
				<a href="<?php echo url_for('@user_settings');?>">
					<img src="<?php echo $sf_user->getGuardUser()->getSrcThumbnail(30,30);?>" class="photo" />
					<span class="username" >
						<?php echo ucfirst($sf_user->getGuardUser()->getUsername());?>
					</span>
				</a>
			</li>
		<?php endif;?>
	</ul>
	<div class="clear"></div>
</nav>

</header>
<script>
	$(document).ready(function(){
		$('input[name=query]').focus(function(){
			$(this).val('');
		});
	});
</script>
