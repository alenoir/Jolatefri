<a class="link-video" rel="nofollow" href="<?php echo $video->getUrlShow() ?>" title="<?php echo $video->getTitle() ?>"></a>
<article>
	<div class="entry-thumbnail border-grey">
		<a rel="nofollow" href="<?php echo $video->getUrlShow() ?>" title="<?php echo $video->getTitle() ?>">
			<img src="<?php echo $video->getSrcThumbnail(200, 150) ?>" alt="<?php echo $video->getTitle() ?>" />
		</a>
		<div class="entry-category">
			<span class="retour-category"></span>
			<span class="category">
				<?php echo $video->getCategory() ?>
			</span>
		</div>
	</div>
	<header class="entry-header">
		<h3>
			<a href="<?php echo $video->getUrlShow() ?>" title="<?php echo $video->getTitle() ?>">
				<?php echo $video->getTitle() ?>
			</a>
		</h3>
		<p class="entry-info">
			Par <a rel="nofollow" href="<?php echo $video->getUsers()->getUrlShow() ?>"><?php echo $video->getUsers()->getUsername() ?></a>, 
			<time> <?php echo $video->getTimeLapse() ?></time>
		</p>
	</header>
	<div class="entry-content">
		<?php echo $video->getExcerpt(ESC_RAW) ?>
		<!--div class="wrapper-share">
    		<ul>
    			<li class="facebook">
    				<fb:like href="http://www.jolatefri.com<?php echo $video->getUrlShow() ?>" layout="button_count" show_faces="false" width="90" font=""></fb:like>
    			</li>
    			<li>
					<g:plusone size="medium" href="http://www.jolatefri.com<?php echo $video->getUrlShow() ?>"></g:plusone>
					
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
    				<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?php echo $video->getTitle() ?>" data-count="horizontal" data-via="jolatefri" data-lang="fr" data-url="http://www.jolatefri.com<?php echo $video->getUrlShow() ?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    			</li>
    		</ul>
    	</div-->		
    	<!--a class="read-more button" href="<?php echo $video->getUrlShow() ?>" title="Voir la vidéo >">
			Voir la vidéo >
		</a>
		<!-- iframe src="http://www.facebook.com/plugins/comments.php?href=http://www.jolatefri.com<?php echo $video->getUrlShow() ?>&permalink=1" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:16px;" allowTransparency="true"></iframe --> 
	</div>
	<!-- footer class="entry-footer">
		<p>
			<?php echo $video->getNbVue() ?> vues - <a href="http://www.jolatefri.com<?php echo $video->getUrlShow() ?>#disqus_thread"><?php echo $video->getTitle() ?></a>
		</p>
	</footer -->
	<div class="clear"></div>
</article>
