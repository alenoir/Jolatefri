<section id="content" class="new-video form">
	<h2 class="title">Proposer des images</h2>
		
		<form action="<?php echo url_for('video/'.($form->getObject()->isNew() ? 'createImage' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" enctype="multipart/form-data">
		<?php if (!$form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
		<?php endif; ?>
		
		  <table id="new-video">
		    <tfoot>
		      <tr>
		        <td colspan="2">
		          <?php echo $form->renderHiddenFields(false) ?>
		         <input type="hidden" name="type" value="image" />
		          <input type="submit" value="Save" />
		        </td>
		      </tr>
		    </tfoot>
		    <tbody>
		      <?php echo $form->renderGlobalErrors() ?>
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
		      <tr>
		      	<td>
		      		<h3>Liste d'images :</h3>
		      		<ul id="list-images">
		      			<li>
		      				<label>Image : </label>
		      				<input type="file" name="images[]" multiple />
		      			</li>
		      		</ul>
		      		
		      		<br />
		      		<a href="#" class="add-image">+ ajouter un nouvelle image</a>
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
			$('.add-image').click(function(){
				$('#list-images').append('<li><label>Image : </label><input type="file" name="images[]" multiple /></li>');
				return false;			
			});
		});
		</script>
</section>