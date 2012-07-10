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
	protected static $modes = array('Youtube', 'Embed', 'Vidéo Jolatefri', 'Vidéos Dailymotion Cloud');
	protected static $status = array('En attente', 'Publié', 'Désactivé');
	
  public function configure()
  {
  	$this->setWidgets(array(
      'title'         => new sfWidgetFormTextarea(),
      'description'   => new sfWidgetFormTextarea(),
      'thumbnail'     => new sfWidgetFormInputFile(),
      'code'          => new sfWidgetFormTextarea(),
      'slug'          => new sfWidgetFormInputText(),
      'mode'          => new sfWidgetFormChoice(array('choices' => self::$modes)),
      'is_activated'  => new sfWidgetFormChoice(array('choices' => self::$status)),
      'category_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => false)),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
    ));
	
	$this->setValidators(array(
      'title'         => new sfValidatorString(array('max_length' => 1000)),
      'description'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'thumbnail'     => new sfValidatorFile(array(
											      'mime_types' => 'web_images',
											      'path' => sfConfig::get('sf_upload_dir').'/thumb-video',
											      'required' => false
											    )),
      'code'          => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'slug'          => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'mode'          => new sfValidatorInteger(array('required' => false)),
      'is_activated'  => new sfValidatorInteger(array('required' => false)),
      'category_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Category'))),
      'user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
    ));

    $this->widgetSchema->setNameFormat('video[%s]');
  
	}

}
