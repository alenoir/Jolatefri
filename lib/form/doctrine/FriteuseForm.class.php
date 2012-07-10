<?php

/**
 * Friteuse form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FriteuseForm extends BaseFriteuseForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'title'      => new sfWidgetFormInputText(),
      'image'      => new sfWidgetFormInputFile(),
      'code'       => new sfWidgetFormInputText(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'title'      => new sfValidatorString(array('max_length' => 1000, 'required' => true)),
      'image'      => new sfValidatorFile(array(
											      'mime_types' => 'web_images',
											      'path' => sfConfig::get('sf_upload_dir').'/friteuse',
											      'required' => false
											    )),
      'code'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'type'    => new sfValidatorString(array('max_length' => 10)),
    ));
    $this->widgetSchema->setNameFormat('friteuse[%s]');
	
	$this->widgetSchema->setLabels(array(
	  'title'    => 'Un titre',
	  'image'   => 'une image',
	  'code' => 'une vidéo youtube',
	));
	
	
  }
	
	
	
}
