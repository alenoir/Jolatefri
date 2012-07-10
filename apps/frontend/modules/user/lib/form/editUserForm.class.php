<?php
class editUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
  	$years = range(2000, 1910);
	foreach($years as $year)
		$yearRange{$year} = $year; 
	
  	$genderChoice = array('' =>'', 'Homme' => 'Homme', 'Femme' => 'Femme');
	
	$this->setWidgets(array(
      'first_name'       => new sfWidgetFormInputText(),
      'last_name'        => new sfWidgetFormInputText(),
      'username'         => new sfWidgetFormInputText(),
      'photo'        	 => new sfWidgetFormInputFile(),
      'gender'           => new sfWidgetFormchoice(array('choices' => $genderChoice)),
      'website'          => new sfWidgetFormInputText(),
      'city'             => new sfWidgetFormInputText(),
      'birthday'         => new sfWidgetFormDate(array('years' => $yearRange, 'format' => '%day%/%month%/%year%')),
      'about'            => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'first_name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'username'         => new sfValidatorAnd(array(
						        new sfValidatorString(array('max_length' => 12, 'required' => true)),
						        new sfValidatorCallback(
								    array('callback'=>
								      array($this, 'postValidate')
								    )
								  )
						      )),
      'photo'	         => new sfValidatorFile(array(
      												'mime_types' => 'web_images', 
      												'path' => sfConfig::get('sf_upload_dir') . '/thumb-user', 
      												'required' => false
												)),
      'gender'           => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($genderChoice))),
      'website'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'birthday'         => new sfValidatorDate(array(
      												'required' => false
												)),
      'about'            => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
    ));
    
	$this->validatorSchema->setPostValidator(new sfValidatorDoctrineUnique(array('model'=>'sfGuardUser', 'column'=>'username')));
	
	$this->widgetSchema->setLabels(array(
	  'first_name'    => 'Prénom',
	  'last_name'   => 'Nom',
	  'username' => 'Pseudo',
	  'photo' => 'Image de profil',
	  'gender' => 'Genre',
	  'website' => 'Site web',
	  'city' => 'Ville',
	  'birthday' => 'Anniversaire',
	  'about' => 'Bio',
	));

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
  }

	public function postValidate($validator, $value) {
	 
	 	if($this->getObject()->getUsername() == $value['username'])
	    	return $value;
		else
		{
			return new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'username'));
		}
	    
	 
	  
	 
	}
}