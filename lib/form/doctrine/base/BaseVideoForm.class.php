<?php

/**
 * Video form base class.
 *
 * @method Video getObject() Returns the current form's model object
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVideoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormTextarea(),
      'description'  => new sfWidgetFormTextarea(),
      'thumbnail'    => new sfWidgetFormTextarea(),
      'code'         => new sfWidgetFormTextarea(),
      'nbVue'        => new sfWidgetFormInputText(),
      'nbLike'       => new sfWidgetFormInputText(),
      'nbComment'    => new sfWidgetFormInputText(),
      'mode'         => new sfWidgetFormInputText(),
      'slug'         => new sfWidgetFormTextarea(),
      'is_activated' => new sfWidgetFormInputText(),
      'category_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => false)),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 1000)),
      'description'  => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'thumbnail'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'code'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'nbVue'        => new sfValidatorInteger(array('required' => false)),
      'nbLike'       => new sfValidatorInteger(array('required' => false)),
      'nbComment'    => new sfValidatorInteger(array('required' => false)),
      'mode'         => new sfValidatorInteger(array('required' => false)),
      'slug'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'is_activated' => new sfValidatorInteger(array('required' => false)),
      'category_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Category'))),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Video';
  }

}
