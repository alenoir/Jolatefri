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
			$route = '@video_list_category_pager?category='.$category.'&page=';
		}
		elseif(isset($order))
		{
			$route = '@video_list_order_pager?order='.$order.'&page=';
		}
		else
		{
			$route = '@video_list_pager?page=';
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

<script>
	$(document).ready(function(){
		$('.entry').hover(
			function(){
				//console.log('ok');
				$(this).animate({
				    background: "#E7E7E7"
				}, 1500 );
  			},
			function(){
				//$(this).css({'background':'#ffffff'});
			}
		);
	});
</script>
<?php slot('meta_facebook') ?>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="http://www.jolatefri.com"/>
	<meta property="og:title" content="Jolatefri : toujours plus de vidéos !"/>
	<meta property="og:site_name" content="Jolatefri"/>
	
	<?php /*if($video->getMode() == 2):?>
	<meta property="og:video" content="http://www.jolatefri.com/player.swf?netstreambasepath=http%3A%2F%2Fwww.jolatefri.com%2F&id=player&file=<?php echo $video->getcode();?>&image=http://www.jolatefri.com/uploads/thumb-video/<?php echo $video->getThumbnail();?>&backcolor=CC00CC&frontcolor=000000&lightcolor=FFFF00&screencolor=000000&linktarget=http://www.jolatefri.com<?php echo $video->getUrlShow();?>&controlbar.position=bottom&display.icons=false" />
	<meta property="og:video:height" content="400" />
	<meta property="og:video:width" content="600" />
	<meta property="og:video:type" content="application/x-shockwave-flash" />
	<meta property="og:video" content="<?php echo $video->getcode();?>" />
	<meta property="og:video:type" content="video/mp4" />
	<meta property="og:video" content="http://www.jolatefri.com<?php echo $video->getUrlShow();?>" />
	<meta property="og:video:type" content="text/html" />
	<?php endif;*/?>
<?php end_slot() ?>