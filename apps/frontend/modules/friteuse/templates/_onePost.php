<article class="single">
	
	<header class="single-header">
		<h2 itemprop="name" class="single-title"><a href="<?php echo $post->getUrlShow() ?>"><?php echo $post->getTitle() ?></a></h2>
		<p class="single-meta">
			Posté il y a <?php echo $post->getTimeLapse();?> par 
			<a class="username" href="<?php echo $post->getAuthorLink();?>" title="Profil de <?php echo $post->getAuthor();?>">
				<?php echo $post->getAuthor();?>
			</a>
		</p>
	</header>
	<section class="single-content">
		<?php echo $post->getFullContent(ESC_RAW) ?>

	</section>
	
</article>
<div class="single-share">
	<ul>
		<!--li class="title">
			Vous Aimez ?
		</li-->
		<li>
			<div class="fb-like" data-send="false" data-href="http://www.jolatefri.com/<?php echo $post->getUrlShow() ?>" data-layout="button_count" data-width="90" data-show-faces="false"></div>    			
		</li>
		<li id="google">
			<g:plusone size="medium" href="http://www.jolatefri.com/<?php echo $post->getUrlShow() ?>"></g:plusone>
			
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
			<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.jolatefri.com<?php echo $post->getUrlShow() ?>" data-text="<?php echo $post->getTitle() ?>" data-count="horizontal" data-via="jolatefri" data-lang="fr">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</li>
		<li id="tumblr">
			<?php
			if($post->getCode())
			{
				?>
		    	<a target="_blank" href="http://www.tumblr.com/share/link?url=<?php echo urlencode($post->getUrlShow(true) ) ?>&name=<?php echo urlencode($post->getTitle()) ?>" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:20px; height:20px; background:url('http://platform.tumblr.com/v1/share_4.png') top left no-repeat transparent;">Partager sur Tumblr</a>
				<?php
			}
			else {
				?>
				<a target="_blank" href="http://www.tumblr.com/share/photo?source=<?php echo urlencode('http://www.jolatefri.com/uploads/friteuse/'.$post->getImage() ) ?>&caption=<?php echo urlencode($post->getTitle()) ?>&clickthru=<?php echo urlencode($post->getUrlShow(true)) ?>" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:20px; height:20px; background:url('http://platform.tumblr.com/v1/share_4.png') top left no-repeat transparent;">Share on Tumblr</a>
				<?php
			}
			?>
		</li>
		<?php
		if(!$post->getCode())
		{
			?>
			<li>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($post->getUrlShow(true) ) ?>&media=<?php echo urlencode('http://www.jolatefri.com/uploads/friteuse/'.$post->getImage() ) ?>&description=<?php echo $post->getTitle() ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
				<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
			</li>
			<?php
		}
		?>
		<li>
			<!-- Place this tag where you want the su badge to render -->
			<su:badge layout="1" location="<?php echo $post->getUrlShow(true);?>"></su:badge>
			
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
			<script type="text/javascript">
				reddit_title='<?php echo $post->getTitle() ?>';
				reddit_url = "<?php echo $post->getUrlShow(true);?>";
				reddit_newwindow='1';
				reddit_target='funny';
			</script>
			<script type="text/javascript" src="http://fr.reddit.com/static/button/button1.js"></script>

		</li>
	</ul>
</div>  	
