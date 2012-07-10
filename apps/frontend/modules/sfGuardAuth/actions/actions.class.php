<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Antoine Lenoir <antoine.alenoir@gmail.com>
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{

  public function executeSignin($request)
  {
  	$this->request = $request;
    $this->user = $this->getUser();
    if ($this->user->isAuthenticated())
    {
      return $this->redirect('@friteuse');
    }
		
    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin'); 
    $this->form = new $class();
	
	 
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues(); 

        $this->login($values['user'], '');
      }
    }
    else
    {
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $this->user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
  }

  public function executeSignout($request)
  {
    /*if($this->getUser()->getAttribute('social') == 'tw')
    {
    	$this->twitterInit();
    	$this->twitter->endSession();
    }*/

    if($this->getUser()->getAttribute('social') == 'fb')
    {
    	$this->facebookInit();
    	header('location:'.$this->facebook->getLogoutUrl());
    }
    
    $this->getUser()->signOut();

    $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

    $this->redirect('@homepage');
    
    
  }

  public function executeSecure($request)
  {
    $this->getResponse()->setStatusCode(403);
  }

  public function executePassword($request)
  {
    throw new sfException('This method is not yet implemented.');
  }
 	
 	/*
 	* social login
 	*/
  
  private function facebookCheckLogin()
  {
  
  	$this->facebookInit();
  	
  	$user = $this->facebook->getUser();
  	  	
  	if ( $user ) {
  	
  		$infoUser = $this->facebook->api('/me');

		$this->sf_guard_users = Doctrine_Core::getTable('SfGuardUser')
	      ->createQuery('a')
	      ->where('a.email_address = ?', $infoUser['email'])
	      ->execute();
	      
	     if($this->sf_guard_users->count())
	     {
	        $this->login($this->sf_guard_users[0], 'fb');  
	     }
	     else
	     {
	     	$newUser = new SfGuardUser();
	     	
	     	$newUser->first_name = $infoUser['first_name'];
	     	$newUser->last_name = $infoUser['last_name'];
	     	$newUser->email_address = $infoUser['email'];
	     	$newUser->photo = 'http://graph.facebook.com/'.$infoUser['id'].'/picture';
	     	$newUser->is_active = 1;
	     	$newUser->username = $infoUser['first_name'].' '.$infoUser['last_name'];
	     	
	     	$newUser->save();
	     	
	     	$newFacebok = new FacebookProfile();

	     	$newFacebok->id = $infoUser['id'];
	     	$newFacebok->access_token = $this->facebook->getAccessToken();
	     	$newFacebok->user_id = $newUser->id;
	     	
	     	$newFacebok->save();
	     	
	     	$this->login($newUser, 'fb');
	     	
	     	
	     }
	     $this->isAuthenticated = true;
	      
	} else {
		$this->loginFacebookUrl = $this->facebook->getLoginUrl(array(
															           'canvas'    => 1,
															           'fbconnect' => 0,
															           'scope' => 'publish_stream,user_photos,email,offline_access'
																	)
																);
	}
  	
  }
  
  private function twitterCheckLogin()
  {
  	$this->twitterInit();
	
	// check our authentication status
    if($this->twitter->isAuthed()) {
    
    	$infoUser = $this->twitter->userdata;
  		
		$this->sf_guard_users = Doctrine_Core::getTable('SfGuardUser')
	      ->createQuery('a')
	      ->where('a.username = ?', $infoUser->screen_name)
	      ->execute();
	      
	     if($this->sf_guard_users->count())
	     {
	        $this->login($this->sf_guard_users[0], 'tw');
	        
	     }
	     else
	     {
	     	$newUser = new SfGuardUser();
	     	
	     	$newUser->email_address = $infoUser->screen_name.'@twitter.com';
	     	$newUser->is_active = 1;
	     	$newUser->username = $infoUser->screen_name;
	     	$newUser->photo = $infoUser->profile_image_url;
	     	
	     	$newUser->save();
	     	
	     	$newTwitter = new TwitterProfile();

	     	$newTwitter->id = $infoUser->id;
	     	$newTwitter->username = $infoUser->screen_name;
	     	$newTwitter->access_token = $_COOKIE['access_token'];
	     	$newTwitter->access_token_secret = $_COOKIE['access_token_secret'];
	     	$newTwitter->user_id = $newUser->id;
	     	
	     	$newTwitter->save();
	     	
	     	$this->login($newUser, 'tw');
	     	
	     	
	     }
    	$this->isAuthenticated = true;
		$success =true;
		$access_token = $_COOKIE['access_token'];
		$access_token_secret = $_COOKIE['access_token_secret'];
    }
    else {
        // start authentication process
       	        
        $this->loginTwitterUrl = $this->twitter->auth();

    }
  	
  	
  }
  
  private function login($user, $method)
  {
  	$this->user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $this->request->getUri() : $this->request->getReferer());
  	
  	$this->getUser()->signin($user, true);
	     		
	if($method)
	{
		$this->getUser()->setAttribute('social', $method);
	}
	
	$this->redirect('' != $signoutUrl ? $signoutUrl : '@friteuse');
  }
  
  /*
  * Init social
  */
  
  private function facebookInit()
  {
  	// Create our Application instance.
	$config = array(
		'appId'  => sfConfig::get('app_facebook_app_id'),
		'secret' => sfConfig::get('app_facebook_app_secret'),
		'cookie' => true,
	);
	
	// Initiate the library
	$this->facebook = new facebook($config);
  }
  
  private function twitterInit()
  {
  	$isLoggedOnTwitter = false;

	if (!empty($_SESSION['access_token']) && !empty($_SESSION['access_token']['oauth_token']) && !empty($_SESSION['access_token']['oauth_token_secret'])) { 
		// On a les tokens d'accès, l'authentification est OK.
	
		$access_token = $_SESSION['access_token'];
	
		/* On créé la connexion avec twitter en donnant les tokens d'accès en paramètres.*/ 
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'), $access_token['oauth_token'], $access_token['oauth_token_secret']);
		
		/* On récupère les informations sur le compte twitter du visiteur */
		$connection->delete();
	}
	elseif(isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] === $_REQUEST['oauth_token']) {
		// Les tokens d'accès ne sont pas encore stockés, il faut vérifier l'authentification
		
		/* On créé la connexion avec twitter en donnant les tokens d'accès en paramètres.*/ 
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		
		$connection->delete();
		
	}
	else {
		
	}
  }
}
