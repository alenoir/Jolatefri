	<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('video/'.($form->getObject()->isNew() ? 'createVideo' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

  <table id="new-video">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
         
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td>
        	<?php echo $form['code']->renderLabel() ?>
          <?php echo $form['code']->renderError() ?>
          <?php echo $form['code'] ?>
        </td>
      </tr>
      <tr>
        <td>
        	<div id="preview-video"></div>
        </td>
      </tr>
      <tr>
        <td>
        	<?php echo $form['title']->renderLabel() ?>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <td>
        	<?php echo $form['description']->renderLabel() ?>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <td>
        	<?php echo $form['category_id']->renderLabel() ?>
          <?php echo $form['category_id']->renderError() ?>
          <?php echo $form['category_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

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