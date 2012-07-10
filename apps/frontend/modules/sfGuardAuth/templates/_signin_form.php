<?php use_helper('I18N') ?>
<section id="content" class="signin form">
	<h2 class="title">S'identifier sur Jolatefri.com</h2>
	<form class="form-large" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
	  
	        	<?php echo $form['username']->renderLabel() ?><br />
	          <?php echo $form['username']->renderError() ?>
	          <?php echo $form['username'] ?>
	  
	        	<?php echo $form['password']->renderLabel() ?><br />
	          <?php echo $form['password']->renderError() ?>
	          <?php echo $form['password'] ?>
	
	        	<?php echo $form['remember']->renderLabel() ?><br />
	          <?php echo $form['remember']->renderError() ?>
	          <?php echo $form['remember'] ?>

	       <br />
	        <?php echo $form->renderHiddenFields(false) ?>
	          <input type="submit" value="Connexion" />
	          
	          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
	          <?php /*if (isset($routes['sf_guard_forgot_password'])): ?>
	            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Mot de passe oublié ?', null, 'sf_guard') ?></a>
	          <?php endif;*/ ?>
	
	          <?php if (isset($routes['sf_guard_register'])): ?>
	            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('S\'inscrire', null, 'sf_guard') ?></a>
	          <?php endif; ?>

	</form>
</section>

