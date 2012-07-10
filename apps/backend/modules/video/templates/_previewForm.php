<section id="content">
		<p>Url : http://www.jolatefri.com/<?php echo $video->getCategory() ?>/<?php echo $video->getSlug() ?></p>
		<a href="#">
    		<img class="thumb-video" itemprop="image" src="<?php echo $video->getSrcThumbnail(80, 80) ?>" alt="<?php echo $video->getTitle() ?>" />
    	</a>
		<article class="single">
    		<header class="single-heade">
    			<h1 itemprop="name" class="single-title"><a href="#"><?php echo $video->getTitle() ?></a></h1>
    		</header>
    		<section class="single-content">
    			<?php if($video->getMode() == 4):?>
    				<p class="entry-info single-info">
						Posté par <a href="#"><?php echo $video->getUsers()->getUsername() ?></a>, 
						<time> <?php echo $video->getTimeLapse() ?></time> dans 
						<a href="#">
							 <?php echo $video->getCategory() ?>
						</a>
					</p>
    				<?php foreach($video->getImages() as $image):?>
    					<a href="<?php echo $image['origin'];?>" rel="shadowbox[Mixed];">
    						<img class="image-post border-grey" src="<?php echo $image['thumb'];?>" />
    					</a>
    				<?php endforeach;?>
    			<?php else:?>
	    			<div class="single-video border-grey">
	    				<?php echo $video->getLecteurVideo(ESC_RAW) ?>
	    			</div>
	    			<p class="entry-info single-info">
						Posté par <a href="#"><?php echo $video->getUsers()->getUsername() ?></a>, 
						<time> <?php echo $video->getTimeLapse() ?></time> dans 
						<a href="#">
							vidéos <?php echo $video->getCategory() ?>
						</a>
					</p>
    			<?php endif;?>
    			
    			<div itemprop="description" class="single-description">
					<p>
						<?php echo $video->getDescription(ESC_RAW) ?>
					</p>
    			</div>
    		</section>
			<footer class="single-footer entry-footer">
				<p>
					<?php echo $video->getNbVue() ?> vues
				</p>
			</footer>
    	</article>
</section>
