<?php

/**
 * friteuse actions.
 *
 * @package    jolatefri
 * @subpackage friteuse
 * @author     Antoine Lenoir
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class friteuseActions extends sfActions
{
  	public function executeIndex(sfWebRequest $request)
  	{

   		$q = Doctrine_Core::getTable('friteuse')
      		->createQuery('a')
	  		->orderBy('id DESC');
	
      		
    	
      	$this->pager = new sfDoctrinePager('Friteuse', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
  	}
	
	public function executeAjaxFriteuseAdd(sfWebRequest $request)
  	{
  		$reponse = array('data' => array(), 'error' =>false);
		$score = sfConfig::get('app_score_post_friteuse');
		
		switch($request->getParameter('type'))
		{
			case 'video':
				$formVideo = new FriteuseVideoForm();
				
				$formVideo->bind($request->getParameter($formVideo->getName()), $request->getFiles($formVideo->getName()));
			    if ( $formVideo->isValid() )
			    {
			      	$friteuse = $formVideo->save();
					
					$reponse['data']['html'] = $this->getPartial('friteuse/onePost', array('post' => $friteuse));
					$reponse['data']['response'] =  '<h3>Score : + '.$score.' points</h3><p>Ton score évolu, tu viens de gagner <b>'.$score.' points</b> pour posté dans la Friteuse !</p>';
					
			    }
				else 
				{
					$reponse['error']['html'] = $formVideo->renderGlobalErrors();
				}
				break;
				
			case 'image':
				$formImage = new FriteuseImageForm();
				
				$formImage->bind($request->getParameter($formImage->getName()), $request->getFiles($formImage->getName()));
			    if ( $formImage->isValid() )
			    {
			    	
			      	$friteuse = $formImage->save();
					
					
					
					$this->getUser()->setFlash('notice', '<h3>Score : + '.$score.' points</h3><p>Ton score évolu, tu viens de gagner <b>'.$score.' points</b> pour avoir posté dans la Friteuse ! !</p>');
					
					return $this->redirect('@friteuse');
			    }
				else 
				{
					return $this->redirect('@friteuse');
				}
				break;
		}
				
	
		return $this->renderText(json_encode($reponse));
  	}

	public function executeShow(sfWebRequest $request)
  	{
  		$slug = $request->getParameter('slug');
  		if(isset($slug))
		{
			$this->post = $this->getRoute()->getObject();
		}
		else {
    		$this->forward404Unless($this->post = Doctrine_Core::getTable('friteuse')->find(array($request->getParameter('id'))), sprintf('Object friteuse does not exist (%s).', $request->getParameter('id')));
		}

	}
	
	
	public function executeRandom(sfWebRequest $request)
  	{
    	$this->post = Doctrine_Query::create()
      		->select('id, RANDOM() AS rand')
			->from('Friteuse')
		    ->orderby('rand')
		    ->limit(1)
			->execute()->getFirst();
			
		$this->setTemplate('show');
	  
  	}
	
	
	
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new friteuseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new friteuseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
	
	
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($friteuse = Doctrine_Core::getTable('friteuse')->find(array($request->getParameter('id'))), sprintf('Object friteuse does not exist (%s).', $request->getParameter('id')));
    $this->form = new friteuseForm($friteuse);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($friteuse = Doctrine_Core::getTable('friteuse')->find(array($request->getParameter('id'))), sprintf('Object friteuse does not exist (%s).', $request->getParameter('id')));
    $this->form = new friteuseForm($friteuse);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($friteuse = Doctrine_Core::getTable('friteuse')->find(array($request->getParameter('id'))), sprintf('Object friteuse does not exist (%s).', $request->getParameter('id')));
    $friteuse->delete();

    $this->redirect('friteuse/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $friteuse = $form->save();

      $this->redirect('friteuse/edit?id='.$friteuse->getId());
    }
  }
}
