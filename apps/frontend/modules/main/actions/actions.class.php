<?php

/**
 * main actions.
 *
 * @package    jolatefri
 * @subpackage main
 * @author     Antoine Lenoir
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeError404(sfWebRequest $request)
  {
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
      ->select('*, RANDOM() AS rand')
	  ->where('is_activated = 1')
      ->orderby('rand')
      ->limit('10')
      ->offset('0')      
      ->execute();
  }
}
