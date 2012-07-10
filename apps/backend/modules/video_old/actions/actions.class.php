<?php

require_once dirname(__FILE__).'/../lib/videoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/videoGeneratorHelper.class.php';

/**
 * video actions.
 *
 * @package    jolatefri
 * @subpackage video
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class videoActions extends autoVideoActions
{
		
	public function executeCheckVideo()
	{
		$this->videos = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 0')
      		->orderBy('created_at desc')
			->limit(10)
			->offset(0)
      		->execute();
			
		$this->categories = Doctrine_Core::getTable('Category')
      		->createQuery('v')
      		->orderBy('name asc')
      		->execute();
	}
	
	public function executeActivate(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('vid'))
      		->fetchOne();
      	
      	$video->is_activated = 1;
      	$video->save();
		
		$user = $video->getUsers();
		
		$user->score = $user->getScore() + 100;
		$user->save();
      	
      	return $this->renderPartial('video/activate');
	}
	
	public function executeAjaxEdit(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('id'))
      		->fetchOne();
      	
      	$video->title = $request->getParameter('title');
      	$video->category_id = $request->getParameter('category_id');
      	$video->description = $request->getParameter('description');
      	$video->save();
      	
      	return $this->renderPartial('video/activate');
	}

	public function executeConvert(sfWebRequest $request)
	{
		if(!$request->getParameter('id'))
		{
			$this->video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
			->where('is_activated = 1')
			->addWhere('mode = 0')
			->orderBy('id DESC')
      		->execute()->getFirst();
		}
		else {
			$this->video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('id'))
      		->fetchOne();
		}
		
      	if($request->isMethod(sfRequest::POST))
		{
			$updatedAt = $this->video->getUpdatedAt();
  
			$videoFile = $request->getParameter('file');
			$this->video->code = 'http://www.jolatefri.com/uploads/videos/'.$videoFile;
			$this->video->mode = 2;
			$this->video->save();
			$this->video->setUpdatedAt($updatedAt);
			$this->video->save();

			$this->redirect($this->getRequest()->getReferer());
		}
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('vid'))
      		->fetchOne();
      	
      	$video->is_activated = 2;
      	$video->save();
      	
      	return $this->renderPartial('video/activate');
	}
}
