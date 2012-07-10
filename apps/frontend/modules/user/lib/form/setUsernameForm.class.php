<?php
class SetUsernameForm extends sfGuardUserForm
{
  public function configure()
  {
	$this->setWidgets(array(
      'username'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'username'       => new sfValidatorString(array('max_length' => 12, 'required' => true)),
    ));
    
  }
}