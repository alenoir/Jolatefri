<?php

/**
 * Friteuse form.
 *
 * @package    jolatefri
 * @subpackage form
 * @author     Antoine Lenoir
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FriteuseVideoForm extends BaseFriteuseForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'title'      => new sfWidgetFormInputText(),
      'code'       => new sfWidgetFormInputText(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'title'      => new sfValidatorString(array('max_length' => 1000, 'required' => true)),
      'code'       => new sfValidatorString(array('max_length' => 1000, 'required' => true)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'type'    => new sfValidatorString(array('max_length' => 10)),
    ));
    $this->widgetSchema->setNameFormat('friteuseVideo[%s]');
	
	$this->widgetSchema->setLabels(array(
	  'title'    => 'Un titre',
	  'code' => 'Une vidéo youtube',
	));
	
	$this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'postValidator')))
    );
	
  }
  
  	public function postValidator($validator, $values)
  	{
	    if ($values['type'] == 'image')
	    {
	    	//if(empty($values['image']))
				//throw new sfValidatorError($validator, 'Tu as oublié de mettre une image...');
	    }
		elseif ($values['type'] == 'video')
		{
			$url = parse_url($values['code']);
			if(isset($url['query']))
				parse_str($url['query'], $query);
			else
				$query = false;
			
			if(isset($url['host']) && strstr($url['host'], 'youtube') && isset($query['v']))
			{
				$values['type'] = 'youtube';
				$values['code'] = $query['v'];
			}
			elseif(isset($url['host']) && strstr($url['host'], 'youtu'))
			{
			
				$values['type'] = 'youtube';
				$values['code'] = str_replace('/', '', $url['path']);
				
			}
			else
			{
				throw new sfValidatorError($validator, 'Il faut mettre un lien vers une vidéo de youtube');
			}
		}
		else
		{
			throw new sfValidatorError($validator, 'no type');
		}
 
    	return $values;
  	}
	
	
	
}
