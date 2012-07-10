<?php

/**
 * Video form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NewVideoForm extends BaseVideoForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'title'         => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'code'          => new sfWidgetFormInputText(),
      'nbVue'         => new sfWidgetFormInputText(),
      'nbCommentaire' => new sfWidgetFormInputText(),
      'category_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => false)),
      'user_id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'title'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'code'          => new sfValidatorPass(array('required' => false)),
      'nbVue'         => new sfValidatorInteger(array('required' => false)),
      'nbCommentaire' => new sfValidatorInteger(array('required' => false)),
      'category_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Category'))),
      'user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
    ));
    
    unset(
    	$this['id'], $this['created_at'], $this['updated_at'], $this['is_activated']
    );
	
	$this->widgetSchema->setLabels(array(
		'title' => 'Titre', 
		'description' => 'Description',
		'code' => 'Lien vers youtube',
		'Catégorie' => 'Catégorie'
	));
	
	$this->setDefault('user_id', sfContext::getInstance()->getUser()->getGuardUser()->getId()
);

	$this->widgetSchema->setNameFormat('video[%s]');
  }
}
