<div id="content">
	<h1>
		Modifier mon profil
	</h1>
	
	<?php use_stylesheets_for_form($form) ?>
	<?php use_javascripts_for_form($form) ?>
	
	<form class="form-large user" action="<?php echo url_for('user/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	
	  <table>
	    <tfoot>
	      <tr>
	        <td colspan="2">
	          <?php echo $form->renderHiddenFields(false) ?>
	          <input type="submit" value="Enregistrer" />
	        </td>
	      </tr>
	    </tfoot>
	    <tbody>
	      <?php echo $form->renderGlobalErrors() ?>
	      <tr>
	        <td>
	        	<?php echo $form['first_name']->renderLabel() ?>
	          	<?php echo $form['first_name']->renderError() ?><br />
	          	<?php echo $form['first_name'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['last_name']->renderLabel() ?>
	          	<?php echo $form['last_name']->renderError() ?><br />
	          	<?php echo $form['last_name'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['username']->renderLabel() ?>
	          	<?php echo $form['username']->renderError() ?><br />
	          	<?php echo $form['username'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['photo']->renderLabel() ?>
	          	<?php echo $form['photo']->renderError() ?><br />
	          	<?php echo $form['photo'] ?>
	        </td>
	      </tr>

	      <tr>
	        <td>
	        	<?php echo $form['gender']->renderLabel() ?>
	          	<?php echo $form['gender']->renderError() ?><br />
	          	<?php echo $form['gender'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['website']->renderLabel() ?>
	          	<?php echo $form['website']->renderError() ?><br />
	          	<?php echo $form['website'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['city']->renderLabel() ?>
	          	<?php echo $form['city']->renderError() ?><br />
	          	<?php echo $form['city'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['birthday']->renderLabel() ?>
	          	<?php echo $form['birthday']->renderError() ?><br />
	          	<?php echo $form['birthday'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['about']->renderLabel() ?>
	          	<?php echo $form['about']->renderError() ?><br />
	          	<?php echo $form['about'] ?>
	        </td>
	      </tr>
	    </tbody>
	  </table>
	</form>


</div>