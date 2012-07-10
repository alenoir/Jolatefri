<?php

/**
 * Friteuse form base class.
 *
 * @method Friteuse getObject() Returns the current form's model object
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFriteuseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormTextarea(),
      'image'      => new sfWidgetFormTextarea(),
      'code'       => new sfWidgetFormTextarea(),
      'type'       => new sfWidgetFormInputText(),
      'nbVue'      => new sfWidgetFormInputText(),
      'slug'       => new sfWidgetFormTextarea(),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 1000)),
      'image'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'code'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'type'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'nbVue'      => new sfValidatorInteger(array('required' => false)),
      'slug'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('friteuse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friteuse';
  }

}
