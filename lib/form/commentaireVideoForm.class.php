<?php

/**
 * Video form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentaireVideoForm extends BaseCommentaireForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'message'    => new sfWidgetFormTextarea(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'video_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'message'    => new sfValidatorString(array('max_length' => 1000)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
      'video_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Video'))),
    ));
	
	unset(
    	$this['id'], $this['created_at'], $this['updated_at']
    );
    
    $this->widgetSchema->setNameFormat('commentaire[%s]');
	
	if(sfContext::getInstance()->getUser()->isAuthenticated())
		$this->setDefault('user_id', sfContext::getInstance()->getUser()->getGuardUser()->getId());

  }
}
