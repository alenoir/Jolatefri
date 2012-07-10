<section id="content">
    <h2>
    	Elles font le tour de la toile :
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
		
		if(isset($category))
		{
			$route = '@video_facebook?category='.$category.'&page=';
		}
		elseif(isset($order))
		{
			$route = '@video_facebook?order='.$order.'&page=';
		}
		else
		{
			$route = '@video_facebook?page=';
		}
		
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