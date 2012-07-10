<?php

class myUser extends sfGuardSecurityUser
{
	
	public function hasUsername()
	{
		$user = $this->getGuardUser();
		
		return ($user->getUsername())?true:false;
	}
	
	public function getUrlLoginTwitter(sfRequest $request)
	{
		
		if($request->getParameterHolder()->get('urlLoginTwitter'))
			return $request->getParameterHolder()->get('urlLoginTwitter');
		else 
			return $this->setUrlLoginTwitter($request);
	}
	
	public function setUrlLoginTwitter(sfRequest $request)
	{
		$connection = new TwitterOAuth(sfConfig::get('app_twitter_consumer_key'), sfConfig::get('app_twitter_consumer_secret'));
 
		/* Get temporary credentials. */
		$request_token = $connection->getRequestToken(url_for('@callback_twitter_connect','absolute=true'));
		
		/* Save temporary credentials to session. */
		$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		 
		/* If last connection failed don't display authorization link. */
		switch ($connection->http_code) {
		  case 200:
		    /* Build authorize URL and redirect user to Twitter. */
		   $this->loginTwitterUrl = $connection->getAuthorizeURL($token);
		   $request->getParameterHolder()->set('urlLoginTwitter', $this->loginTwitterUrl);
		    return $this->loginTwitterUrl;
		    break;
		  default:
		    /* Show notification if something went wrong. */
		    echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}
}
