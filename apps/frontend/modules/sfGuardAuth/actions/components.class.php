<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthComponents.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: components.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthComponents extends BasesfGuardAuthComponents
{
	
	public function executeAuth()
	{
		$this->isAuthenticated = false;
    	$this->user = $this->getUser();
		$this->twitterCheckLogin();

		$this->facebookCheckLogin();
	}
	
	public function executeTwitterAuth()
	{
		$this->isAuthenticated = false;
    	$this->user = $this->getUser();
		$this->twitterCheckLogin();
	}
	
	public function executeFacebookAuth()
	{
		$this->isAuthenticated = false;
    	$this->user = $this->getUser();
		$this->facebookCheckLogin();
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
  	$this->getUser()->twitterCheckLogin();
  	$this->loginTwitterUrl = $this->getUser()->loginTwitterUrl;
	  	
  }
  
 
  
  private function login($user, $method)
  {
  	$this->user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $this->request->getUri() : $this->request->getReferer());
  	
  	$this->getUser()->signin($user, true);
	     		
	if($method)
	{
		$this->getUser()->setAttribute('social', $method);
	}
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
  

}