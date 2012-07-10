<?php

/**
 * sfGuardUser form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RegisterForm extends BasesfGuardUserForm
{
  	public function configure()
 	{
	  	unset(
	      $this['first_name'],
	      $this['last_name'],
	      $this['is_active'],
	      $this['is_super_admin'],
	      $this['updated_at'],
	      $this['groups_list'],
	      $this['permissions_list'],
	      $this['last_login'],
	      $this['created_at'],
	      $this['updated_at'],
	      $this['salt'],
	      $this['algorithm']
	    );
	
	    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
	    $this->validatorSchema['password']->setOption('required', false);
	    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
	    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
	
	    $this->widgetSchema->moveField('password_again', 'after', 'password');
	
	    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'Les deux password doivent être identique.')));
		
	    $this->validatorSchema['password']->setOption('required', true);
	
		$this->widgetSchema->setLabels(array(
	 	 'username'    => 'Pseudo',
	 	 'email_address'   => 'Adresse Mail',
	 	 'password' => 'Mot de passe',
	 	 'password_again' => 'Verification du mot de passe',	
		));
		
		$this->validatorSchema['email_address'] = new sfValidatorEmail(array(), array('invalid' => 'L\'email est invalide', 'required' => 'Email obligatoire'));
		
		$this->validatorSchema->setPostValidator(
	      new sfValidatorAnd(array(
	        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address')), array('invalid' => 'Cet email est déjà utilisé')),
	        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')), array('invalid' => 'Ce pseudo est déjà utilisé')),
	      ))
	    );
  	}
}
