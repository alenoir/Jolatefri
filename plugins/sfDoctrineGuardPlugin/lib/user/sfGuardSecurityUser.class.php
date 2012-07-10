<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardSecurityUser.class.php 30264 2010-07-16 16:59:21Z Jonathan.Wage $
 */
class sfGuardSecurityUser extends sfBasicSecurityUser
{
  protected $user = null;

  /**
   * Initializes the sfGuardSecurityUser object.
   *
   * @param sfEventDispatcher $dispatcher The event dispatcher object
   * @param sfStorage $storage The session storage object
   * @param array $options An array of options
   */
  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
 
    parent::initialize($dispatcher, $storage, $options);

    if (!$this->isAuthenticated())
    {
      // remove user if timeout
      $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
      $this->user = null;
      
	  //$this->twitterCheckLogin();

	  //$this->facebookCheckLogin();
    }
    
    
  }

  /**
   * Returns the referer uri.
   *
   * @param string $default The default uri to return
   * @return string $referer The referer
   */
  public function getReferer($default)
  {
    $referer = $this->getAttribute('referer', $default);
    $this->getAttributeHolder()->remove('referer');

    return $referer;
  }

  /**
   * Sets the referer.
   *
   * @param string $referer
   */
  public function setReferer($referer)
  {
    if (!$this->hasAttribute('referer'))
    {
      $this->setAttribute('referer', $referer);
    }
  }

  /**
   * Returns whether or not the user has the given credential.
   *
   * @param string $credential The credential name
   * @param boolean $useAnd Whether or not to use an AND condition
   * @return boolean
   */
  public function hasCredential($credential, $useAnd = true)
  {
    if (empty($credential))
    {
      return true;
    }

    if (!$this->getGuardUser())
    {
      return false;
    }

    if ($this->getGuardUser()->getIsSuperAdmin())
    {
      return true;
    }

    return parent::hasCredential($credential, $useAnd);
  }

  /**
   * Returns whether or not the user is a super admin.
   *
   * @return boolean
   */
  public function isSuperAdmin()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getIsSuperAdmin() : false;
  }

  /**
   * Returns whether or not the user is anonymous.
   *
   * @return boolean
   */
  public function isAnonymous()
  {
    return !$this->isAuthenticated();
  }

  /**
   * Signs in the user on the application.
   *
   * @param sfGuardUser $user The sfGuardUser id
   * @param boolean $remember Whether or not to remember the user
   * @param Doctrine_Connection $con A Doctrine_Connection object
   */
  public function signIn($user, $remember = false, $con = null)
  {
    // signin
    $this->setAttribute('user_id', $user->getId(), 'sfGuardSecurityUser');
    $this->setAuthenticated(true);
    $this->clearCredentials();
    $this->addCredentials($user->getAllPermissionNames());

    // save last login
    $user->setLastLogin(date('Y-m-d H:i:s'));
    $user->save($con);

    // remember?
    if ($remember)
    {
      $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);

      // remove old keys
      Doctrine_Core::getTable('sfGuardRememberKey')->createQuery()
        ->delete()
        ->where('created_at < ?', date('Y-m-d H:i:s', time() - $expiration_age))
        ->execute();

      // remove other keys from this user
      Doctrine_Core::getTable('sfGuardRememberKey')->createQuery()
        ->delete()
        ->where('user_id = ?', $user->getId())
        ->execute();

      // generate new keys
      $key = $this->generateRandomKey();

      // save key
      $rk = new sfGuardRememberKey();
      $rk->setRememberKey($key);
      $rk->setUser($user);
      $rk->setIpAddress($_SERVER['REMOTE_ADDR']);
      $rk->save($con);

      // make key as a cookie
      $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
      sfContext::getInstance()->getResponse()->setCookie($remember_cookie, $key, time() + $expiration_age);
    }
  }

  /**
   * Returns a random generated key.
   *
   * @param int $len The key length
   * @return string
   */
  protected function generateRandomKey($len = 20)
  {
    return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
  }

  /**
   * Signs out the user.
   *
   */
  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
    $this->user = null;
    $this->clearCredentials();
    $this->setAuthenticated(false);
    $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);
    $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
    sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', time() - $expiration_age);
  }

  /**
   * Returns the related sfGuardUser.
   *
   * @return sfGuardUser
   */
  public function getGuardUser()
  {
    if (!$this->user && $id = $this->getAttribute('user_id', null, 'sfGuardSecurityUser'))
    {
      $this->user = Doctrine_Core::getTable('sfGuardUser')->find($id);

      if (!$this->user)
      {
        // the user does not exist anymore in the database
        $this->signOut();

        throw new sfException('The user does not exist anymore in the database.');
      }
    }

    return $this->user;
  }

  /**
   * Returns the string representation of the object.
   *
   * @return string
   */
  public function __toString()
  {
    return $this->getGuardUser()->__toString();
  }

  /**
   * Returns the sfGuardUser object's username.
   *
   * @return string
   */
  public function getUsername()
  {
    return $this->getGuardUser()->getUsername();
  }

  /**
   * Returns the name(first and last) of the user
   *
   * @return string
   */
  public function getName()
  {
    return $this->getGuardUser()->getName();
  }

  /**
   * Returns the sfGuardUser object's email.
   *
   * @return string
   */
  public function getEmail()
  {
    return $this->getGuardUser()->getEmail();
  }

  /**
   * Sets the user's password.
   *
   * @param string $password The password
   * @param Doctrine_Collection $con A Doctrine_Connection object
   */
  public function setPassword($password, $con = null)
  {
    $this->getGuardUser()->setPassword($password);
    $this->getGuardUser()->save($con);
  }

  /**
   * Returns whether or not the given password is valid.
   *
   * @return boolean
   */
  public function checkPassword($password)
  {
    return $this->getGuardUser()->checkPassword($password);
  }

  /**
   * Returns whether or not the user belongs to the given group.
   *
   * @param string $name The group name
   * @return boolean
   */
  public function hasGroup($name)
  {
    return $this->getGuardUser() ? $this->getGuardUser()->hasGroup($name) : false;
  }

  /**
   * Returns the user's groups.
   *
   * @return array|Doctrine_Collection
   */
  public function getGroups()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getGroups() : array();
  }

  /**
   * Returns the user's group names.
   *
   * @return array
   */
  public function getGroupNames()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getGroupNames() : array();
  }

  /**
   * Returns whether or not the user has the given permission.
   *
   * @param string $name The permission name
   * @return string
   */
  public function hasPermission($name)
  {
    return $this->getGuardUser() ? $this->getGuardUser()->hasPermission($name) : false;
  }

  /**
   * Returns the Doctrine_Collection of single sfGuardPermission objects.
   *
   * @return Doctrine_Collection
   */
  public function getPermissions()
  {
    return $this->getGuardUser()->getPermissions();
  }

  /**
   * Returns the array of permissions names.
   *
   * @return array
   */
  public function getPermissionNames()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getPermissionNames() : array();
  }

  /**
   * Returns the array of all permissions.
   *
   * @return array
   */
  public function getAllPermissions()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getAllPermissions() : array();
  }

  /**
   * Returns the array of all permissions names.
   *
   * @return array
   */
  public function getAllPermissionNames()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getAllPermissionNames() : array();
  }

  /**
   * Returns the related profile object.
   *
   * @return Doctrine_Record
   */
  public function getProfile()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getProfile() : null;
  }

  /**
   * Adds a group from its name to the current user.
   *
   * @param string $name The group name
   * @param Doctrine_Connection $con A Doctrine_Connection object
   */
  public function addGroupByName($name, $con = null)
  {
    return $this->getGuardUser()->addGroupByName($name, $con);
  }

  /**
   * Adds a permission from its name to the current user.
   *
   * @param string $name The permission name
   * @param Doctrine_Connection $con A Doctrine_Connection object
   */
  public function addPermissionByName($name, $con = null)
  {
    return $this->getGuardUser()->addPermissionByName($name, $con);
  }
  
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
	     	
	     	
	     	
	     	// save photo
	     $this->saveImage('http://graph.facebook.com/'.$infoUser['id'].'/picture', 'user-'.$newUser->id.'.png');
	     
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
  
  public function twitterCheckLogin()
  {
  	$this->twitterInit();

	// check our authentication status
    if($this->isLogTwitter) {
    
    	$infoUser = $this->twitterUser;

		$this->twitterProfile = Doctrine_Core::getTable('TwitterProfile')
	      ->createQuery('a')
	      ->where('a.id = ?', $infoUser->id)
	      ->execute();
	      
	     if($this->twitterProfile->count())
	     {
	        $this->login($this->twitterProfile[0]->getUsers(), 'tw');
	        
	     }
	     else
	     {
	     	$username = $this->checkUsername($infoUser->screen_name);

	     	$newUser = new SfGuardUser();
	     	
	     	$newUser->email_address = $infoUser->screen_name.'@twitter.com';
	     	$newUser->is_active = 1;
	     	$newUser->username = $username;
	     	$newUser->photo = $infoUser->profile_image_url;
	     	
	     	$newUser->save();
	     	
	     	$newTwitter = new TwitterProfile();

	     	$newTwitter->id = $infoUser->id;
	     	$newTwitter->username = $infoUser->screen_name;
	     	//$newTwitter->access_token = $_SESSION['oauth_token'];
	     	//$newTwitter->access_token_secret = $_SESSION['oauth_token_secret'];
	     	$newTwitter->user_id = $newUser->id;
	     	
	     	$newTwitter->save();
	     	
	     	$this->login($newUser, 'tw');
	     	
	     	
	     }
    	$this->isAuthenticated = true;
		$success =true;
    }
    else {
        // start authentication process
       	        
       // $this->loginTwitterUrl = $this->twitter->auth();

    }
  	
  	
  	
  }
  
  private function login($user, $method)
  {
  	
  	$this->signin($user, true);
	     		
	if($method)
	{
		$this->setAttribute('social', $method);
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
  
  private function twitterInit()
  {
  	$this->isLogTwitter = false;
	
	$this->loginTwitterUrl = '';
	
	if (!empty($_SESSION['access_token']) && !empty($_SESSION['access_token']['oauth_token']) && !empty($_SESSION['access_token']['oauth_token_secret'])) { 
		// On a les tokens d'accès, l'authentification est OK.
	
		$access_token = $_SESSION['access_token'];
	
		/* On créé la connexion avec twitter en donnant les tokens d'accès en paramètres.*/ 
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'), $access_token['oauth_token'], $access_token['oauth_token_secret']);
		
		/* On récupère les informations sur le compte twitter du visiteur */
		$this->twitterUser = $connection->get('account/verify_credentials');
		$this->isLogTwitter = true;
	}
	elseif(isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] === $_REQUEST['oauth_token']) {
		// Les tokens d'accès ne sont pas encore stockés, il faut vérifier l'authentification
		
		/* On créé la connexion avec twitter en donnant les tokens d'accès en paramètres.*/ 
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		
		/* On vérifie les tokens et récupère le token d'accès */
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		
		/* On stocke en session les token d'accès et on supprime ceux qui ne sont plus utiles. */
		$_SESSION['access_token'] = $access_token;
		//unset($_SESSION['oauth_token']);
		//unset($_SESSION['oauth_token_secret']);
		
		if (200 == $connection->http_code) {
			$this->twitterUser = $connection->get('account/verify_credentials');
			$this->isLogTwitter = true;
		}
		else {
			$this->isLogTwitter = false;
		}
		
	}
	else {
		$urlRedi = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'));
		/* On demande les tokens à Twitter, et on passe l'URL de callback */
		$request_token = $connection->getRequestToken('http://www.jolatefri.com'.$_SERVER["REQUEST_URI"]);
		
		/* On sauvegarde le tout en session */
		$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		
		/* On test le code de retour HTTP pour voir si la requête précédente a correctement fonctionné */
		switch ($connection->http_code) {
		  case 200:
		    /* On construit l'URL de callback avec les tokens en params GET */
		    $this->loginTwitterUrl = $connection->getAuthorizeURL($token);
		    break;
		  default:
		    echo 'Impossible de se connecter à twitter ... Merci de renouveler votre demande plus tard.';
		    break;
		}
	}
	
  }
	
	 private function checkUsername($username)
  {
  	$this->sf_guard_users = Doctrine_Core::getTable('SfGuardUser')
	      ->createQuery('a')
	      ->where('a.username = ?', $username)
	      ->execute();
		  
	if($this->sf_guard_users->count())
		return $username.'_';
	else
		return $username;
		 
  }
  
	private function saveImage($image_url, $name)
	{

		$image = file_get_contents($image_url);

		curl_close($ch);
		
		$f = fopen(sfConfig::get('sf_upload_dir').'/thumb-user/'.$name, 'w');
		fwrite($f, $image);
		fclose($f);

	}

}
