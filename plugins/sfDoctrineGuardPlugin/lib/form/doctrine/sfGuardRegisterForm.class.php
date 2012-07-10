<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
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