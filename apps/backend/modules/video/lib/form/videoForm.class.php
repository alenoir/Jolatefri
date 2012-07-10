<?php

/**
 * Video form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VideoForm extends BaseVideoForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'title'         => new sfWidgetFormTextarea(),
      'description'   => new sfWidgetFormTextarea(),
      'thumbnail'     => new sfWidgetFormInputFile(),
      'code'          => new sfWidgetFormTextarea(),
      'mode'          => new sfWidgetFormInputText(),
      'slug'          => new sfWidgetFormInputText(),
      'is_activated'  => new sfWidgetFormInputText(),
      'category_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => false)),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));
	
	$this->setValidators(array(
      'title'         => new sfValidatorString(array('max_length' => 1000)),
      'description'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'thumbnail'     => new sfValidatorString(array(
											      'mime_types' => 'web_images',
											      'path' => sfConfig::get('sf_upload_dir')
											    )),
      'slug'         => new sfValidatorInteger(array('required' => false)),
      'code'         => new sfValidatorInteger(array('required' => false)),
      'mode'          => new sfValidatorInteger(array('required' => false)),
      'is_activated'  => new sfValidatorInteger(array('required' => false)),
      'category_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Category'))),
      'user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
    ));

    $this->widgetSchema->setNameFormat('video[%s]');
	
  }
}
