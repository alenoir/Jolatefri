<section id="content">

    <h2>
    	La friteuse :
    </h2>
    <?php include_component('friteuse','addPost');?>
    <ul id="list-post-friteuse">
    	<?php foreach ($pager->getResults() as $post): ?>
    		<li class="entry">
  				<?php include_partial('onePost', array('post' => $post));?>
    		</li>
    	<?php endforeach; ?>
	</ul>
	<div id="pagination" class="bandeau noir">
	
		<?php $routes = sfContext::getInstance()->getRouting()->getCurrentRouteName(); ?>
		
		<?php

			$route = '@friteuse?page=';
	
		
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
			elseif($page == 1)
			{
				echo link_to($page, '/');
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