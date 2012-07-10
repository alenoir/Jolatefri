<ul id="list-post-friteuse">
	<?php if($pager->getResults()->count()):?>
		<?php foreach ($pager->getResults() as $post): ?>
			<li class="entry">
				<?php include_partial('friteuse/onePost', array('post' => $post));?>
			</li>
		<?php endforeach; ?>
	<?php else:?>
		Cet utilisateur n'a pas encore posté...
	<?php endif;?>
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