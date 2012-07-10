<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@video') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('video/form_fieldset', array('video' => $video, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('video/form_actions', array('video' => $video, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
<div id="wrapper-preview">
	<?php include_partial('video/previewForm', array('video' => $video));?>
</div>

<script>
$(document).ready(function(){
	CKEDITOR.replace( 'video_description',
    {
        toolbar :
        [
            ['Styles', 'Format'],
            ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-', 'About']
        ]
    });

	$('form *').focusout(function(){
			
		var data = $(this).closest('form').serialize();
		$.ajax({
			url: '/backend_dev.php/video/<?php echo $video->getId();?>',
			data: data,
			type: 'post',
			success: function(data){
				$('#wrapper-preview').html(data);
			}
		});
		return false;
	}); 
});
  	
</script>
