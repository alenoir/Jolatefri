<?php use_helper('I18N', 'Date') ?>
<?php include_partial('video/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Video', array(), 'messages') ?></h1>

  <?php include_partial('video/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('video/form_header', array('video' => $video, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('video/form', array('video' => $video, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('video/form_footer', array('video' => $video, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<script type="text/javascript">
	CKEDITOR.replace( 'video_description',
    {
        toolbar :
        [
            ['Styles', 'Format'],
            ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-', 'About']
        ]
    });

$(document).ready(function(){
	$('#video_code').keyup(function(){
	
		var url = $(this).val();
		$.ajax({
			url: '/video/previewYoutube',
			data: "url="+url,
			type: 'post',
			success: function(data){
				$('#preview-video').html(data);
			}
		});
	});
});
</script>