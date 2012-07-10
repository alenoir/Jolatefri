<?php use_helper('I18N') ?>
<section id="content" class="signin form">
	<h2 class="title">S'inscrire sur Jolatefri.com</h2>
	<form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
	  <table>
	    <tbody>
	      <tr>
	        <td>
	        	<?php echo $form['email_address']->renderLabel() ?><br />
	          <?php echo $form['email_address']->renderError() ?>
	          <?php echo $form['email_address'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['username']->renderLabel() ?><br />
	          <?php echo $form['username']->renderError() ?>
	          <?php echo $form['username'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['password']->renderLabel() ?><br />
	          <?php echo $form['password']->renderError() ?>
	          <?php echo $form['password'] ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['password_again']->renderLabel() ?><br />
	          <?php echo $form['password_again']->renderError() ?>
	          <?php echo $form['password_again'] ?>
	        </td>
	      </tr>
	     </tbody>
	    <tfoot>
	      <tr>
	        <td colspan="2">
	        	<?php echo $form->renderHiddenFields(false) ?>
	          <input type="submit" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" />
	        </td>
	      </tr>
	    </tfoot>
	  </table>
	</form>
</section>