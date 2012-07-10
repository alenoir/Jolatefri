<?php use_stylesheet('main.css') ?>

<?php if($videos):?>
<?php foreach($videos as $video):?>
	<?php $miniature = $video->getVideoThumbnails();
	echo '<img class="videoThumb" id="'. $video->getFlashPlayerUrl() .'" src="' . $miniature[0]['url'].'" alt="" />';?>
<?php endforeach;?>
<?php endif;?>