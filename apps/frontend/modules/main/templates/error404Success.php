<section id="content" class="error404">
	
	<h2>
    	Cette page n'existe plus...
    </h2>
    <img src="/images/voiture_frite.png"  width="490px"/>
	<h2>
    	Tu es perdu ? Ces vidéos peuvent t'interresser :
    </h2>
    <ol>
    	<?php foreach ($videos as $video): ?>
    		<li class="entry">
  				<?php include_partial('video/listVideoIndex', array('video' => $video));?>
    		</li>
    	<?php endforeach; ?>
	</ol>
</section>