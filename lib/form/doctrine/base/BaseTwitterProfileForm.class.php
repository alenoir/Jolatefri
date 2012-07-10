<?php

/**
 * TwitterProfile form base class.
 *
 * @method TwitterProfile getObject() Returns the current form's model object
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTwitterProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputText(),
      'username'            => new sfWidgetFormInputText(),
      'access_token'        => new sfWidgetFormInputText(),
      'access_token_secret' => new sfWidgetFormInputText(),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorInteger(),
      'username'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'access_token'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'access_token_secret' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('twitter_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TwitterProfile';
  }

}
