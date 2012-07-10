<?php
 
class userComponents extends sfComponents
{
  public function executeSmallProfile()
  {
  	$this->user = $this->getUser()->getGuardUser();
  }
  
  public function executeHeaderProfile()
  {
  	$this->user = $this->getUser()->getGuardUser();
  }
  
	public function executeSetUsername(sfWebRequest $request) {
		$this->form = new SetUsernameForm();

	}
	
	public function executeSidebarUserList(sfWebRequest $request) {
		
		$this->users = Doctrine_Query::create()
			->from('sfGuardUser')
		    ->orderby('score desc')
			->where('is_active = 1 ')
			->addWhere('username != ?', 'jolatefri')
		    ->limit(10)
			->execute();
			

	}
	
	public function executeActuUser(sfWebRequest $request) {
		
		$videoViews = Doctrine_Query::create()
			->from('user_view_video')
		    ->orderby('created_at desc')
		    ->limit(10)
			->execute();
			
		$videolikes = Doctrine_Query::create()
			->from('user_like_video')
		    ->orderby('created_at desc')
		    ->limit(10)
			->execute();
		
		$tmpDateVideo = array();
		$tmpVideo = array();
		$i = 0;
		foreach($videoViews as $videoView)
		{
			$tmpDateVideo[$i] = $videoView->getCreatedAt();
			$tmpVideo[$i] = $videoView;
			$i++;
		}
		
		foreach($videolikes as $videolike)
		{
			$tmpDateVideo[$i] = $videolike->getCreatedAt();
			$tmpVideo[$i] = $videolike;
			$i++;
		}
		
		arsort($tmpDateVideo);
	
		$count = 0;
		foreach($tmpDateVideo as $key => $value)
		{
			switch($tmpVideo[$key]->getModelName())
			{
				case 'User_view_video':
					$actus[] = '<img src="'.$tmpVideo[$key]->getUser()->getSrcThumbnail(30, 30).'" /><p>'.link_to($tmpVideo[$key]->getUser()->getUsername(),$tmpVideo[$key]->getUser()->getUrlShow()).' a regardé '.link_to('une vidéo',$tmpVideo[$key]->getVideo()->getUrlShow()).'</p><span class="time">'.$tmpVideo[$key]->getTimeLapse().'</span>';
					break;
					
				case 'User_like_video':
					$actus[] = '<img src="'.$tmpVideo[$key]->getUser()->getSrcThumbnail(30, 30).'" /><p>'.link_to($tmpVideo[$key]->getUser()->getUsername(),$tmpVideo[$key]->getUser()->getUrlShow()).' a aimé '.link_to('une vidéo',$tmpVideo[$key]->getVideo()->getUrlShow()).'</p><span class="time">'.$tmpVideo[$key]->getTimeLapse().'</span>';
					break;
			}
			
			if($count == 10)
				break;
			
			$count++;
		}
		
		
		$this->actus = $actus;
	}
	
	public function executeSocialConnect(sfWebRequest $request) {
		
		$response = $this->getResponse();
		
	    $this->loginTwitterUrl = $this->getUser()->getUrlLoginTwitter($request);
	
			
	}
	
	private function twitterInit()
	{
  
	  	$this->twitter = new tmhOAuth(array(
		  'consumer_key'    => sfConfig::get('app_twitter_consumer_key'),
		  'consumer_secret' => sfConfig::get('app_twitter_consumer_secret'),
		));

	}
	

}
