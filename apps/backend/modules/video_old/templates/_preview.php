
<article class="single">
	<form id="<?php echo $video->getId();?>">
	<header class="single-header">
		<input name="id" type="hidden" value="<?php echo $video->getId() ?>" />
		<h2 class="single-title"><input class="title" name="title" value="<?php echo $video->getTitle() ?>" /></h2>
	</header>
	<img src="<?php echo $video->getSrcThumbnail(140, 103) ?>" alt="<?php echo $video->getTitle() ?>" />
	<section class="single-content">
		<?php if($video->getMode() == 4):?>
    				<p class="entry-info single-info">
						Posté par <?php echo $video->getUsers()->getUsername() ?>, 
						<time> <?php echo $video->getTimeLapse() ?></time> dans 

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
						Posté par <?php echo $video->getUsers()->getUsername() ?>, 
						<time> <?php echo $video->getTimeLapse() ?></time> dans 

					</p>
    			<?php endif;?>
		<div class="single-description">
			<textarea id="description-<?php echo $video->getId() ?>" class="description" name="description"><?php echo $video->getDescription(ESC_RAW) ?></textarea>
		</div>
		<select class="category_id" name="category_id">
			<?php foreach($categories as $categorie):?>
			<option value="<?php echo $categorie->getId();?>"><?php echo $categorie->getName();?></option>
			<?php endforeach;?>
		</select>
	</section>
	<a class="valide" id="<?php echo $video->getId();?>" href="#">Valider</a>
	<a class="delete" id="<?php echo $video->getId();?>" href="#">Supprimer</a>
	</form>
	<form action="/backend_dev.php/video/convert" method="post" id="<?php echo $video->getId();?>">
		<input name="id" type="hidden" value="<?php echo $video->getId() ?>" />

		<input type="text" name="file" />
		<input type="submit" value="Convertir" />
	</form>
</article>

<!--script>
	CKEDITOR.replace( 'description-<?php echo $video->getId() ?>',
    {
        toolbar :
        [
            ['Styles', 'Format'],
            ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-', 'About']
        ]
    });
</script-->