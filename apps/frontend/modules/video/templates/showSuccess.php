<section id="content-video">
	
	<article id="video" itemprop="video" itemscope itemtype="http://schema.org/VideoObject" class="single">
		<div id="single-breadcrumb">
			<div class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			  <a href="http://www.jolatefri.com" itemprop="url">
			    <span itemprop="title">Vidéos</span>
			  </a> ›
			</div>  
			<div class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			  <a href="<?php echo url_for('@video_list_category?category='.$video->getCategory(), 'absolute=true')?>" itemprop="url">
			    <span itemprop="title"><?php echo $video->getCategory() ?></span>
			  </a> ›
			</div>  
			<div class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			  <a href="<?php echo $video->getUrlShow(true) ?>" itemprop="url">
			    <span itemprop="title"><?php echo $video->getTitle() ?></span>
			  </a>
			</div>
		</div>
		<div class="clear"></div>	
		<div class="block">
			<div id="header-player">
    			<div id="single-pub">
	    			<?php 
		    		$videoPub = sfConfig::get('app_video_pub');
		    		?>
					<?php echo Config::getConfig('pub');?>
					<div class="clear"></div>
	    		</div>
		    	<div id="single-related-facebook">
		    		<!--h3 class="title-col">Vos amis recommandent :</h3-->
		    		<div class="fb-like-box" data-href="http://www.facebook.com/Jolatefri.video" data-width="513" data-height="285" data-show-faces="true" data-border-color="#ffffff" data-stream="false" data-header="true"></div>
		    		<!--div class="fb-recommendations" data-site="http://www.jolatefri.com" data-width="500" data-height="273" data-header="false" data-border-color="#ffffff" data-font="trebuchet"></div-->
		    		<div class="clear"></div>
		    	</div>
		    	<div class="clear"></div>
		    </div>
	    	
    	</div>
    	<div id="player-video" class="block">	
    		
	    	
	    	<meta itemprop="thumbnail" content="/uploads/thumb-video/<?php echo $video->getThumbnail()?>" />
			<meta itemprop="interactionCount" content="UserPlays:<?php echo $video->getNbVue();?>" />
			<meta itemprop="interactionCount" content="UserComments:<?php echo $video->getNbComment();?>" />
			<div id="single-wrapper-header">
				<img itemprop="image" src="<?php echo $video->getSrcThumbnail(120,100) ?>" class='single-thumbnail' alt="<?php echo $video->getTitle() ?>" />
	
	    		<header class="single-header">
	    			<h1 itemprop="name" class="single-title"><a href="<?php echo $video->getUrlShow() ?>"><?php echo $video->getTitle() ?></a></h1>
	    			<?php if($sf_user->isSuperAdmin())
						echo link_to(' - Modifier', '/backend.php/video/'.$video->getId().'/edit');?>
		    			<p class="entry-info single-info">
							Posté il y a <time datetime="<?php echo $video->getCreatedAt() ?>"> <?php echo $video->getTimeLapse() ?></time> dans 
							<a href="<?php echo url_for('@video_list_category?category='.$video->getCategory())?>">
								vidéos <?php echo $video->getCategory() ?>
							</a>
							 - 
							<a href="<?php echo $video->getUrlShow() ?>#single-commentaire"><fb:comments-count href="<?php echo $video->getUrlShow(true) ?>"></fb:comments-count> commentaire(s)</a>
						</p>
	    		</header>
	    		<div class="single-share">
				
		    		<ul>	
		    			<li>
		    				<fb:like href="<?php echo $video->getUrlShow(true) ?>" layout="button_count" show_faces="false" width="90" font=""></fb:like>
		    			</li>
		    			<li>
							<g:plusone size="medium"></g:plusone>
							
							<script type="text/javascript">
							  window.___gcfg = {lang: 'fr'};
							
							  (function() {
							    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							    po.src = 'https://apis.google.com/js/plusone.js';
							    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
		    			</li>
		    			<li>
		    				<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $video->getUrlShow(true) ?>" data-text="<?php echo $video->getTitle() ?>" data-count="horizontal" data-via="jolatefri" data-lang="fr">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		    			</li>
		    			<li>
		    				<a target="_blank" href="http://www.tumblr.com/share/link?url=<?php echo urlencode($video->getUrlShow(true) ) ?>&name=<?php echo urlencode($video->getTitle()) ?>&description=<?php echo urlencode($video->getDescription(ESC_RAW)) ?>" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url('http://platform.tumblr.com/v1/share_1.png') top left no-repeat transparent;">Partager sur Tumblr</a>
		    			</li>
		    			<li>
		    				<!-- Place this tag where you want the su badge to render -->
							<su:badge layout="1" location="<?php echo $video->getUrlShow(true);?>"></su:badge>
							
							<!-- Place this snippet wherever appropriate --> 
							 <script type="text/javascript"> 
							 (function() { 
							     var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true; 
							      li.src = 'https://platform.stumbleupon.com/1/widgets.js'; 
							      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s); 
							 })(); 
							 </script>

		    			</li>
		    			<li>
		    				<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_counter addthis_pill_style"></a>
							</div>
							<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4eec8ed90d0cbf87"></script>
							<!-- AddThis Button END -->
		    			</li>
		    			<li>
		    				<script type="text/javascript">
		    					reddit_title='<?php echo $video->getTitle() ?>';
		    					reddit_newwindow='1';
		    					reddit_target='funny';
		    				</script>
		    				<script type="text/javascript" src="http://fr.reddit.com/static/button/button1.js"></script>
		    			</li>
		    			
		    		</ul>
		    	</div>
		    	<div class="clear"></div>
			</div>
			
    		
			<aside id="single-related">
	    				<?php include_component('video', 'videosRelative', array('category' => $video->getCategoryId()));?>
	  
	    		<div style="clear:both;"></div>
	    	</aside> 
    		
    		
			<div class="single-video border-grey">
    			<?php echo $video->getLecteurVideo(ESC_RAW) ?>
    		</div>
    		
    		
		</div>
		<div id="single-content">
			
			<section id="single-description" class="block"> 
				<h3>Description :</h3>
				<div itemprop="description">
					<p>
						<?php echo $video->getDescription(ESC_RAW) ?>
					</p>
				</div>
			</section>
		
   

			<div id="single-commentaire" class="block">
				<?php //include_component('commentaire', 'formCommentaireVideo', array('idVideo' => $video->getId()));?>
				<div class="fb-comments" data-href="<?php echo $video->getUrlShow(true) ?>" data-num-posts="100" data-width="625"></div>
		
			</div>
		</div>
	</article>


		<!-- Slot Meta Facebook -->
		
		<?php slot('meta_facebook') ?>
		   <meta property="og:title" content="<?php echo $video->getTitle() ?>"/>
		    <meta property="og:type" content="article"/>
		    <meta property="og:url" content="http://www.jolatefri.com<?php echo $video->getUrlShow() ?>"/>
		    <meta property="og:image" content="http://www.jolatefri.com<?php echo $video->getSrcThumbnail(150, 150) ?>"/>
		    <meta property="og:site_name" content="Jolatefri"/>
		    <meta property="og:description" content="<?php echo strip_tags($video->getDescription(ESC_RAW)) ?>"/>
		    <meta property="fb:admins" content="1017463707"/>
		    
		    <?php if($video->getMode() == 3):?>
		    <meta property="og:video" content="<?php echo $video->getUrlDmCloud();?>" />
		    <meta property="og:video:height" content="500" />
		    <meta property="og:video:width" content="635" />
		    <meta property="og:video:type" content="application/x-shockwave-flash" />
		    <meta property="og:video" content="<?php echo $video->getUrlDmCloud();?>" />
		    <meta property="og:video:type" content="video/mp4" />
		    <meta property="og:video" content="<?php echo $video->getUrlShow(true);?>" />
		    <meta property="og:video:type" content="text/html" />
		    <?php endif;?>
	<?php end_slot() ?>
		
		<?php slot('partage-video') ?>
			<ul>

    			<li class="facebook">
    				<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.jolatefri.com<?php echo $video->getUrlShow() ?>" send="true" layout="box_count" show_faces="false" width="90" font=""></fb:like>
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
    				<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?php echo $video->getTitle() ?>" data-count="vertical" data-via="jolatefri" data-lang="fr">Tweeter</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    			</li>
    		</ul>
		<?php end_slot() ?>
		
		<!-- /Slot Meta Facebook -->
		

	

</section>

<script>
$('facebook-jssdk').ready(function()
{
	FB.Event.subscribe('edge.create',
	    function(response) {
	    	console.log(response);
	    	$.ajax({
			  url: "<?php echo  url_for('ajax_facebook_like');?>",
			  data: {videoId:<?php echo $video->getId() ?>},
			  dataType: 'json',
			  success: function(data){
			    if(data.status.code)
			    {
			    	$.sticky(data.response);
			    }
			  }
			});
	        
	    }
	);
	
	FB.Event.subscribe('comment.create',
	    function(response) {
	    	$.ajax({
			  url: "<?php echo  url_for('ajax_facebook_comment');?>",
			  data: response,
			  dataType: 'json',
			  success: function(data){
			    if(data.status.code)
			    {
			    	$.sticky(data.response);
			    }
			  }
			});
	        
	    }
	);
});
	
</script>