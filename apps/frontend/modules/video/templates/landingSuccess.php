<section class="landing content">

    <h2>
    	Les dernières vidéos
    </h2>
    <ol>
    	<?php foreach ($nowVideos as $key => $video): ?>
    		<?php include_partial('video/landingList', array('video' => $video, 'key' => $key));?>
    	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<a href="<?php echo url_for('@video_list');?>" class="button">
		Plus de vidéos >
	</a>

</section>
<section class="landing content">

    <h2>
    	Les vidéos à ne pas manquer
    </h2>
    <ol>
    	<?php foreach ($bestVideos as $key => $video): ?>
    		<?php include_partial('video/landingList', array('video' => $video, 'key' => $key));?>
    	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<a href="<?php echo url_for('@video_list_best_like');?>" class="button">
		Plus de vidéos >
	</a>

</section>
<section class="landing content">

    <h2>
    	Les vidéos les plus vues
    </h2>
    <ol>
    	<?php foreach ($vueVideos as $key => $video): ?>
    		<?php include_partial('video/landingList', array('video' => $video, 'key' => $key));?>
    	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<a href="<?php echo url_for('@video_list_best_vue');?>" class="button">
		Plus de vidéos >
	</a>

</section>
<section class="landing content">

    <h2>
    	Les vidéos les plus commentées
    </h2>
    <ol>
    	<?php foreach ($commentVideos as $key => $video): ?>
    		<?php include_partial('video/landingList', array('video' => $video, 'key' => $key));?>
    	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<a href="<?php echo url_for('@video_list_best_comment');?>" class="button">
		Plus de vidéos >
	</a>

</section>