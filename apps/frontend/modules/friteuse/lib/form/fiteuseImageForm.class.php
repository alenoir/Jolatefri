<?php

/**
 * Friteuse form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FriteuseImageForm extends BaseFriteuseForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'title'      => new sfWidgetFormInputText(),
      'image'      => new sfWidgetFormInputFile(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'title'      => new sfValidatorString(array('required' => true)),
      'image'      => new sfValidatorFile(array(
											      'mime_types' => 'web_images',
											      'path' => sfConfig::get('sf_upload_dir').'/friteuse',
											      'required' => true
											    )),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'type'    => new sfValidatorString(array('max_length' => 10)),
    ));
    
	
	$this->widgetSchema->setLabels(array(
	  'title'    => 'Un titre',
	  'image'   => 'Une image',
	));
	
	$this->widgetSchema->setNameFormat('friteuseImage[%s]');

  }
	
	
}
