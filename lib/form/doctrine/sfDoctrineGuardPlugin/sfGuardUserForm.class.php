<?php

/**
 * sfGuardUser form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends BasesfGuardUserForm
{
  public function configure()
  {
  	parent::setup();
	
  	$years = range(2000, 1910);
	foreach($years as $year)
		$yearRange{$year} = $year; 
	
  	$genderChoice = array('' =>'', 'Homme' => 'Homme', 'Femme' => 'Femme');
	
  	$this->setWidgets(array(
      'first_name'       => new sfWidgetFormInputText(),
      'last_name'        => new sfWidgetFormInputText(),
      'username'         => new sfWidgetFormInputText(),
      'gender'           => new sfWidgetFormchoice(array('choices' => $genderChoice)),
      'photo'        	 => new sfWidgetFormInputFile(),
      'website'          => new sfWidgetFormInputText(),
      'city'             => new sfWidgetFormInputText(),
      'birthday'         => new sfWidgetFormDate(array('years' => $yearRange, 'format' => '%day%/%month%/%year%')),
      'about'            => new sfWidgetFormTextarea(),

    ));

    $this->setValidators(array(
      'first_name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'username'         => new sfValidatorString(array('max_length' => 128)),
      'gender'           => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($genderChoice))),
      'photo'	         => new sfValidatorFile(array(
      												'mime_types' => 'web_images', 
      												'path' => sfConfig::get('sf_upload_dir') . '/thumb-user', 
      												'required' => false
												)),      'website'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'birthday'         => new sfValidatorDate(array('required' => false)),
      'about'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
    ));

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

	$this->mergePostValidator( new sfValidatorCallback(array('callback' => array($this, 'checkUniqueUsernam'))) );

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    
		
  }

	public function checkUniqueUsernam($validator, $values) 
  	{ 
	    $username = isset($values['username']) ? $values['username'] : NULL; 
	
	    if(sfGuardUserTable::getInstance()->isUnique($username, $this->getObject()->getId())) 
	    { 
	      throw new sfValidatorErrorSchema($validator, array( 
	          'username' => new sfValidatorError($validator, 'Ce nom d\'utilisateur existe déjà') 
	      )); 
	    } 
	    return $values; 
  	}	
  
}
