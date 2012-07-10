<header id="header">
	
	<?php include_component('category', 'menuHeader');?>
	<div id="header-content">
		<div id="couche5">
			<div id="couche4">
				<div id="couche3">
					<div id="couche2">
						<div id="auth-header">
							<?php include_component('user', 'headerProfile');?>
						</div>
						<a href="<?php echo url_for('@homepage');?>">
						<div id="couche1">
						</div>
						</a>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<nav id="menuHeader">
		
		<ul>
			<li class="home">
				<a href="<?php echo url_for('@homepage');?>">Accueil</a>
			</li>
			<li>
				<a href="<?php echo url_for('@video_list_pager');?>">Les plus récentes</a>
			</li>
			<li>
				<a href="<?php echo url_for('@video_list_best_vue');?>">Les meilleures vidéos</a>
			</li>
			<li>
				<a href="<?php echo url_for('@video_list_best_like');?>">Les mieux notées</a>
			</li>	
			<li>
				<a href="<?php echo url_for('@video_list_best_comment');?>">Les plus commentées</a>
			</li>			
			<li id="search">
				<form action="<?php echo url_for('@video_search');?>" method="post">
					<input type="text" name="query" value="Recherche..." />
					<input type="submit" />
				</form>
			</li>
	
		</ul>
	</nav>
</header>
<script>
	$(document).ready(function(){
		$('input[name=query]').focus(function(){
			$(this).val('');
		});
	});
</script>
