<section id="content">
    <h1 style="display: none;">Recherche pour : vidéos <?php echo $query;?></h1>

    <?php if($videos->count()):?>
	    <h2>
	    	Recherche pour : <?php echo $query;?>
	    </h2>
	    <ol>
	    	<?php foreach ($videos as $video): ?>
	    		<li class="entry">
	  				<?php include_partial('listVideoIndex', array('video' => $video));?>
	    		</li>
	    	<?php endforeach; ?>
		</ol>
	<?php else:?>
		<h2>
    	Il n'y a pas de résultas pour le recherche : "<?php echo $query;?>". Mais ces vidéos peuvent t'interresser :
	    </h2>
	    <ol>
	    	<?php foreach ($videosOther as $video): ?>
	    		<li class="entry">
	  				<?php include_partial('video/listVideoIndex', array('video' => $video));?>
	    		</li>
	    	<?php endforeach; ?>
		</ol>
	<?php endif;?>
</section>