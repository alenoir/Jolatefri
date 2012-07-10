<?php

class getCommentsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'getComments';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [getComments|INFO] task does things.
Call it with:

  [php symfony getComments|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
	
	sfContext::createInstance($this->configuration);
	
	$videos = Doctrine_Core::getTable('Video')
			->createQuery('v')
			->where('v.is_activated = 1')
			->execute();
	
	foreach($videos as $video)
	{
		$url = 'http://www.jolatefri.com'.$video->getUrlShowCommand();
		//$url = 'http://www.jolatefri.com/owned/video/3076/que-regardent-les-femmes-chez-un-homme';
		$this->logSection($url, 'videos');
		
		$resultComment = json_decode(file_get_contents('https://graph.facebook.com/fql?q=select+post_fbid%2C+fromid%2C+object_id%2C+text%2C+time+from+comment+where+object_id+in+%28select+comments_fbid+from+link_stat+where+url+%3D%27'.$url.'%27%29&pretty=1'));
		$resultLike = json_decode(file_get_contents('https://graph.facebook.com/fql?q='.urlencode('SELECT url, normalized_url, share_count, like_count, comment_count, total_count, commentsbox_count, comments_fbid, click_count FROM link_stat WHERE url="'.$url.'"')));
		
		// like
		foreach($resultLike->data as $like)
		{
			$video->nbLike = $like->total_count;
		} 
		
		
		$this->log('Number Likes : '.$video->nbLike);
		
		$nbComment = 0;
		// comments
		foreach($resultComment->data as $comment)
		{
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
			$nbComment++;
			
			
		} 
	
		$this->log('Number Comments : '.$nbComment);
		
		$video->nbComment = $nbComment;
		$video->save();   
		
	}
		
  }

}
