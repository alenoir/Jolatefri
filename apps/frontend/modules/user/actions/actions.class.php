<?php

/**
 * user actions.
 *
 * @package    jolatefri
 * @subpackage user
 * @author     Antoine Lenoir
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sf_guard_users = Doctrine_Core::getTable('SfGuardUser')
      ->createQuery('a')
      ->execute();
  }
  
  public function executeShow(sfWebRequest $request)
  {
	  	$this->forward404Unless($idUser = $request->getParameter('idUser'));
	    $this->forward404Unless($request->getParameter('username'));
	
	    $this->user = Doctrine_Core::getTable('SfGuardUser')
	      ->createQuery('u')
	      ->where('u.id = ?', array($idUser))
	      ->execute()->getFirst();
      
    	$q = Doctrine_Core::getTable('friteuse')
      		->createQuery('f')
			->where('f.user_id = ?', $idUser)
	  		->orderBy('id DESC');
	
      		
    	
      	$this->pager = new sfDoctrinePager('Friteuse', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
  }
	
	public function executeSetUsername(sfWebRequest $request)
  	{
  		if(($username = $request->getParameter('username')) && $request->isMethod(sfRequest::POST))
		{
			$user = $this->getUser()->getGuardUser();
			$user->setUsername($username);
			$user->save();
			
			return $this->redirect('@friteuse');
		}

		
    	
		
  	}
  
	public function executeAjaxFacebookConnect(sfWebRequest $request)
	{
		$result = array('status' => array('code' => 0, 'error' => ''), 'status' => '');
		
		$user = Doctrine_Core::getTable('sfGuardUser')
      		->createQuery('fp')
      		->where('fp.facebook_id = ?', array($request->getParameter('id')))
      		->execute()->getFirst();
		
		if($user)
		{
			$this->getUser()->signin($user, true);
			$result['status']['code'] = 1;
			$result['response'] = 'user already sunscribe, signin';
		}
		else 
		{
			$user = Doctrine_Core::getTable('sfGuardUser')
	      		->createQuery('fp')
	      		->where('fp.email_address = ?', array($request->getParameter('email')))
	      		->execute()->getFirst();
			
			if($user)
			{
				$user->facebook_id = $request->getParameter('id');
				$user->save();
				
				$this->getUser()->signin($user, true);
				
				
				$result['status']['code'] = 1;
				$result['response'] = 'user already sunscribe, signin and add facebook';
			}
			else {
				$newUser = new SfGuardUser();
		     	
		     	$newUser->first_name = $request->getParameter('first_name');
		     	$newUser->last_name = $request->getParameter('last_name');
		     	$newUser->email_address = $request->getParameter('email');
		     	$newUser->username = '@'.time();
				
				// get photo
				$url = 'http://graph.facebook.com/'.$request->getParameter('id').'/picture?type=large';
				$filename = time().'.png';
				$img = sfconfig::get('sf_upload_dir').'/thumb-user/'.$filename;
				file_put_contents($img, file_get_contents($url));
							
				
		     	$newUser->photo = $filename;
				
				$newUser->score = 100;
				
		     	$newUser->is_active = 1;
		     	//$newUser->username = $request->getParameter('email');
		     	$newUser->facebook_id = $request->getParameter('id');
		     	
		     	$newUser->save();
				
				$this->getUser()->signin($newUser, true);
				
				$result['status']['code'] = 1;
				$result['response'] = 'new-user';
			}
				
		}
		
		
		return $this->renderText(json_encode($result));
		
		
		
	}

	public function executeAjaxFacebookLike(sfWebRequest $request)
	{
		$result = array('status' => array('code' => 0, 'error' => ''), 'status' => '');
		
		// update score
		
		if($this->getUser()->isAuthenticated())
		{
			$exist = Doctrine_Core::getTable('User_like_video')
	      		->createQuery('ulv')
	      		->where('ulv.video_id = ?', $request->getParameter('videoId'))
	      		->addWhere('ulv.user_id = ?', $this->getUser()->getGuardUser()->getId())
				->execute();
						
			if(!$exist->count())
			{
				$score = sfConfig::get('app_score_like_video');
				
				$userViewVideo = new User_like_video();
				$userViewVideo->video_id = $request->getParameter('videoId');
				$userViewVideo->user_id = $this->getUser()->getGuardUser()->getId();
				$userViewVideo->save();	
							
				$user = $this->getUser()->getGuardUser();
			
				$user->score = $user->getScore() + $score;
				$user->save();
				
				$result['status']['code'] = 1;
				$result['response'] =  '<h3>Score : + '.$score.' points</h3><p>Ton score évolu, tu viens de gagner <b>'.$score.' points</b> pour avoir aimé de cette vidéo</p>';
					
			}
			else {
			$result['status']['code'] = 0;
			}
			
		}
		else {
			$result['status']['code'] = 0;
		}		
		
		
		return $this->renderText(json_encode($result));
	}
	
	public function executeAjaxFacebookComment(sfWebRequest $request)
	{
		$result = array('status' => array('code' => 0, 'error' => ''), 'status' => '');
		
		// add comment
		/*
		$resultComment = json_decode(file_get_contents('https://graph.facebook.com/'.$comment->fromid));
		$resultUser = json_decode(file_get_contents('https://graph.facebook.com/'.$comment->fromid));
		
		$commentaire = new Comment();
		
		$comments = Doctrine_Core::getTable('Comment')
			->createQuery('c')
			->where('c.fb_id = ?', $comment->post_fbid)
			->execute();
		if(!$comments->count())
		{
			$commentaire->fb_id = $comment->post_fbid;
			$commentaire->message = $comment->text;
			$commentaire->username = $resultUser->name;
			$commentaire->video_id = $video->id;
			$commentaire->save();
			$this->log('Add comment from : '.$resultUser->name);
		}
		*/
		// update score

		if($this->getUser()->isAuthenticated())
		{
			$score = sfConfig::get('app_score_comment_video');
			
			$user = $this->getUser()->getGuardUser();
		
			$user->score = $user->getScore() + $score;
			$user->save();
			
			$result['status']['code'] = 1;
			$result['response'] =  '<h3>Score : + '.$score.' points</h3><p>Ton score évolu, tu viens de gagner <b>'.$score.' points</b> pour avoir comenté de cette vidéo</p>';
				
		}
		else {
			$result['status']['code'] = 0;
		}
		
		return $this->renderText(json_encode($result));
	}
	
	
	public function executeAllUsername(sfWebRequest $request)
  	{		
		$users = Doctrine_Core::getTable('sfGuardUser')
      		->createQuery('u')
      		->execute();
		
		$arrayUsers = array();
	
		foreach($users as $user)
			$arrayUsers[] = strtolower($user['username']);
		return $this->renderText(json_encode($arrayUsers));
	}
	
	public function executeTwitterConnect()
	{
		
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		
		$_SESSION['access_token'] = $access_token;

		unset($_SESSION['oauth_token']);
		unset($_SESSION['oauth_token_secret']);
		
		if (200 == $connection->http_code) {
			$content = $connection->get('account/verify_credentials');
			 //var_dump($content); die();
			$user = Doctrine_Core::getTable('sfGuardUser')
	      		->createQuery('fp')
	      		->where('fp.twitter_id = ?', array($content->id))
	      		->execute()->getFirst();
			
			if($user)
			{
				$this->getUser()->signin($user, true);
				
			}
			else 
			{
				$newUser = new SfGuardUser();
		     	
		     	$newUser->first_name = $content->name;
		     	$newUser->email_address = $content->screen_name.'@jolatefri.com';
				$userCheck = Doctrine_Core::getTable('sfGuardUser')
	      			->createQuery('fp')
	      			->where('fp.username = ?', array($content->screen_name))
	      			->execute();
					
				if($userCheck->count())	
		     		$newUser->username = '@'.time();
				else
		     		$newUser->username = $content->screen_name;
				
				// get photo
				$url = $content->profile_image_url;
				$filename = time().'.png';
				$img = sfconfig::get('sf_upload_dir').'/thumb-user/'.$filename;
				file_put_contents($img, file_get_contents($url));
							
		     	$newUser->photo = $filename;
				
		     	$newUser->city = $content->time_zone;
				
		     	$newUser->score = 100;
				
		     	$newUser->is_active = 1;

		     	$newUser->twitter_id = $content->id;
		     	
		     	$newUser->save();
				
				$this->getUser()->signin($newUser, true);
				
				
			}
			  
		} 
				
		$this->redirect('@friteuse');
		
	}
	
	public function executeSignin(sfWebRequest $request)
	{
		
	}

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_user = sfContext::getInstance()->getUser()->getGuardUser());
    $this->form = new sfGuardUserForm($sf_guard_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('SfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('SfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $sf_guard_user->delete();

    $this->redirect('user/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();

      $this->redirect('user/edit?id='.$sf_guard_user->getId());
    }
  }
}
