<section id="content">
			
	<?php include_component('friteuse', 'controlPost', array('post' => $post));?>
	
	<?php include_partial('onePost', array('post' => $post));?>
    	
	<div id="single-commentaire">
		<div class="fb-comments" data-href="http://www.jolatefri.com<?php echo $post->getUrlShow() ?>" data-num-posts="100" data-width="635"></div>
	</div>
	
	<!-- Slot Meta Facebook -->
	
	<?php slot('meta_facebook') ?>
		<meta property="og:title" content="<?php echo $post->getTitle() ?>"/>
	    <meta property="og:type" content="article"/>
	    <meta property="og:url" content="http://www.jolatefri.com<?php echo $post->getUrlShow() ?>"/>
	    <meta property="og:image" content="http://www.jolatefri.com/uploads/friteuse/<?php echo $post->getImage() ?>"/>
	    <meta property="og:site_name" content="Jolatefri"/>
	    <meta property="og:description" content="<?php echo $post->getTitle() ?>"/>
	    <meta property="fb:app_id" content="138964119509027"/>
	    <?php /*if($post->getMode() == 2):?>
	    <meta property="og:video" content="http://www.jolatefri.com/player.swf?netstreambasepath=http%3A%2F%2Fwww.jolatefri.com%2F&id=player&file=<?php echo $post->getcode();?>&image=http://www.jolatefri.com/uploads/thumb-video/<?php echo $post->getThumbnail();?>&backcolor=CC00CC&frontcolor=000000&lightcolor=FFFF00&screencolor=000000&linktarget=http://www.jolatefri.com<?php echo $post->getUrlShow();?>&controlbar.position=bottom&display.icons=false" />
	    <meta property="og:video:height" content="400" />
	    <meta property="og:video:width" content="600" />
	    <meta property="og:video:type" content="application/x-shockwave-flash" />
	    <meta property="og:video" content="<?php echo $post->getcode();?>" />
	    <meta property="og:video:type" content="video/mp4" />
	    <meta property="og:video" content="http://www.jolatefri.com<?php echo $post->getUrlShow();?>" />
	    <meta property="og:video:type" content="text/html" />
	    <?php endif;*/?>
	<?php end_slot() ?>
		
	<?php slot('partage-video') ?>
		<ul>

			<li class="facebook">
				<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.jolatefri.com<?php echo $post->getUrlShow() ?>" send="true" layout="box_count" show_faces="false" width="90" font=""></fb:like>
			</li>
			<li class="google">
				<g:plusone size="tall"></g:plusone>
				
				<script type="text/javascript">
				  window.___gcfg = {lang: 'fr'};
				
				  (function() {
				    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				    po.src = 'https://apis.google.com/js/plusone.js';
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</li>
			<li class="twitter">
				<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?php echo $post->getTitle() ?>" data-count="vertical" data-via="jolatefri" data-lang="fr">Tweeter</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</li>
		</ul>
	<?php end_slot() ?>
		
	<!-- /Slot Meta Facebook -->
		

	

</section>
    