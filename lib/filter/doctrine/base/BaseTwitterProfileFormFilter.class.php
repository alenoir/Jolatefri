<?php

/**
 * TwitterProfile filter form base class.
 *
 * @package    jolatefri
 * @subpackage filter
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTwitterProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'            => new sfWidgetFormFilterInput(),
      'access_token'        => new sfWidgetFormFilterInput(),
      'access_token_secret' => new sfWidgetFormFilterInput(),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'            => new sfValidatorPass(array('required' => false)),
      'access_token'        => new sfValidatorPass(array('required' => false)),
      'access_token_secret' => new sfValidatorPass(array('required' => false)),
      'user_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Users'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('twitter_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TwitterProfile';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'username'            => 'Text',
      'access_token'        => 'Text',
      'access_token_secret' => 'Text',
      'user_id'             => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
