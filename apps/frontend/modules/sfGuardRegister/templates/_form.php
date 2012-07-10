<?php use_helper('I18N') ?>
<section id="content" class="signin form">
	<h2 class="title">S'inscrire sur Jolatefri.com</h2>
	<form class="form-large" action="<?php echo url_for('@sf_guard_register') ?>" method="post">

	        	<?php echo $form['email_address']->renderLabel() ?><br />
	          <?php echo $form['email_address']->renderError() ?>
	          <?php echo $form['email_address'] ?>

	        	<?php echo $form['username']->renderLabel() ?><br />
	          <?php echo $form['username']->renderError() ?>
	          <?php echo $form['username'] ?>

	        	<?php echo $form['password']->renderLabel() ?><br />
	          <?php echo $form['password']->renderError() ?>
	          <?php echo $form['password'] ?>

	        	<?php echo $form['password_again']->renderLabel() ?><br />
	          <?php echo $form['password_again']->renderError() ?>
	          <?php echo $form['password_again'] ?>
				<br />
	        	<?php echo $form->renderHiddenFields(false) ?>
	          <input type="submit" name="register" value="S'inscrire" />

	</form>
</section>