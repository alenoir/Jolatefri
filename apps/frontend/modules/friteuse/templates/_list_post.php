<article class="entry-friteuse">
	<header class="entry-header">
		<h2>
			<a href="<?php echo $post->getUrlShow();?>" title="<?php echo $post->getTitle() ?>"><?php echo $post->getTitle() ?></a>
		</h2>
		<p class="entry-meta">
			Posté il y a <?php echo $post->getTimeLapse();?> par 
			<a class="username" href="<?php echo $post->getAuthorLink();?>" title="Profil de <?php echo $post->getAuthor();?>">
				<?php echo $post->getAuthor();?>
			</a>
		</p>
		
	</header>
	<section class="entry-content">
		<a href="<?php echo $post->getUrlShow();?>" title="<?php echo $post->getTitle() ?>">
			<img src="/uploads/friteuse/<?php echo $post->getImage() ?>" width="150" />
		</a>
		
	</section>
	

	<div class="clear"></div>
</article>