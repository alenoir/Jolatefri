<section id="content" class="landing">

    <h2>
    	Les dernières vidéos
    </h2>
    <ol>
    	<?php foreach ($nowVideos as $key => $video): ?>
    		<li class="entry-landing">
  				<?php include_partial('listLandingVideo', array('video' => $video, 'key' => $key));?>
    		</li>
    	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<a href="#" class="button">
		Voir les dernières vidéos
	</a>
	
	<h2>
    	Les vidéos à ne pas manquer
    </h2>
    <ol>
    	<?php foreach ($bestVideos as $key => $video): ?>
    		<li class="entry-landing">
  				<?php include_partial('listLandingVideo', array('video' => $video, 'key' => $key));?>
    		</li>
    	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<a href="#" class="button">
		Voir les meilleures vidéos
	</a>
</section>

<script>
	$(document).ready(function(){
		$(".hover-title").live({
		  mouseover: function() {
		    $(this).animate({
	    				opacity: 1
	    			},100);
		  },
		  mouseout: function() {
		    $(this).animate({
	    				opacity: 0
	    			},100);
		  }
		});
		$( '.hover-title' ).mTip( {
				align		: 'bottom'
		} );

	});
</script>