<section id="content">
	<span class="choice-filter">
    	<a href="<?php echo url_for('@video_list_best_like?filter=week');?>" <?php echo ($filter == 'week')? 'class="current"':'';?>>semaine</a> | 
    	<a href="<?php echo url_for('@video_list_best_like?filter=month');?>" <?php echo ($filter == 'month')? 'class="current"':'';?>>mois</a> | 
    	<a href="<?php echo url_for('@video_list_best_like?filter=all');?>" <?php echo ($filter == 'all')? 'class="current"':'';?>>année</a>
    </span>
    <h2>
    	Les vidéos les mieux notées : 
    	
    </h2>
    

    <ol>
    	<?php foreach ($pager->getResults() as $video): ?>
    		<li class="entry">
  				<?php include_partial('listVideoIndex', array('video' => $video));?>
    		</li>
    	<?php endforeach; ?>
	</ol>
	<div id="pagination" class="bandeau noir">
	
		<?php $routes = sfContext::getInstance()->getRouting()->getCurrentRouteName(); ?>
		
		<?php
		
		$route = '@video_list_best_like?filter='.$filter.'&page=';
		
		?>
		<span class="retour-left"></span>
		<span class="retour-right"></span>
		<?php if ($pager->haveToPaginate()): ?>
		<div id="previous-page">
			<?php echo link_to('Précedent', $route.$pager->getPreviousPage());?>
		</div>
		<div id="next-page">
			<?php echo link_to('Suivant', $route.$pager->getNextPage());?>
		</div>
		<div id="number-page">
		<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
			<?php if($page == $pager->getPage())
			{
				echo '<span>'.$page.'</span>';
			}
			else
			{
				echo link_to($page, $route.$page);
			}
			?>
		<?php endforeach ?>
		</div>
		<?php endif ?>	
	</div>
</section>

<?php slot('meta_facebook') ?>

	<meta property="og:type" content="video.other"/>
	<meta property="og:url" content="http://www.jolatefri.com"/>
	<meta property="og:title" content="Jolatefri : toujours plus de vidéos !"/>
	<meta property="og:site_name" content="Jolatefri"/>
	
<?php end_slot() ?>