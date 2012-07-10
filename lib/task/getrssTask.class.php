<?php

class getrssTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'get-rss';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [get-rss|INFO] task does things.
Call it with:

  [php symfony get-rss|INFO]
EOF;
  }

  	protected function execute($arguments = array(), $options = array())
  	{
		// initialize the database connection
	    $databaseManager = new sfDatabaseManager($this->configuration);
	    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
		
		// http://video.kamaz.fr/rss
		
		$this->logSection('http://video.kamaz.fr/rss', 'videos');

		$url = 'http://video.kamaz.fr/rss';
		
		$string = file_get_contents($url);
		$xml= new SimpleXMLElement($string,LIBXML_NOCDATA);
		$ns=$xml->getNamespaces(true);
 
		foreach($xml->channel->item as $item)
		{
			$link = $item->link;
			
			$content = file_get_contents($link);
			
			preg_match_all("/<title>(.*)<\/title>/i", $content, $matches);
			$this->title = $matches[1][0];
			$this->description = $matches[1][0].' // '.$url;

			if(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/v/)([A-Za-z0-9-_]*)#', $content, $matches, PREG_OFFSET_CAPTURE))
			{
				$this->youCode = $matches[7][0];
				$this->insertVideo();
			}
			
		}
		
		
		

		$urls = array('http://www.spi0n.com/feed/', 'http://feeds.feedburner.com/blogmarrant', 'http://www.fail-buzz.com/feed/', 'http://feeds.feedburner.com/bestbuzz', 'http://feeds.feedburner.com/SitesQuiBuzz?format=xml', 'http://buzz-videos.com/feed', 'http://www.videos-2-buzz.fr/spip.php?page=backend');
		
		
		foreach($urls as $url)
			$this->parseUrl($url);
		
		$url = 'http://feeds.feedburner.com/blogspot/YwUBj?format=xml';
		$string = file_get_contents($url);
		$xml= new SimpleXMLElement($string,LIBXML_NOCDATA);
		$ns=$xml->getNamespaces(true);
 
		foreach($xml->entry as $item)
		{
			$this->title = (string) $item->title;
			$this->description = (string) $item->description.' // '.$url;
			$content = (string) $item->content ;
			
			if(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/v/)([A-Za-z0-9-_]*)#', $content, $matches, PREG_OFFSET_CAPTURE))
			{
				
 				$this->youCode = $matches[7][0];
				$this->insertVideo();
			
			}
			if(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/embed/)([A-Za-z0-9-_]*)#', $content, $matches, PREG_OFFSET_CAPTURE))
			{
		
				$this->youCode = $matches[7][0];
				$this->insertVideo();
			}
		}
		
  	}
	
	private function parseUrl($url)
	{
		$this->logSection($url, 'videos');
		
			
		$string = file_get_contents($url);
		$xml= new SimpleXMLElement($string,LIBXML_NOCDATA);
		$ns=$xml->getNamespaces(true);
 
		foreach($xml->channel->item as $item)
		{
			$this->title = (string) $item->title;
			$this->description = (string) $item->description.' // '.$url;
			$content = (string) $item->children($ns['content']);
			
			if(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/v/)([A-Za-z0-9-_]*)#', $content, $matches, PREG_OFFSET_CAPTURE))
			{
				
 				$this->youCode = $matches[7][0];
				$this->insertVideo();
			
			}
			if(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/embed/)([A-Za-z0-9-_]*)#', $content, $matches, PREG_OFFSET_CAPTURE))
			{
		
				$this->youCode = $matches[7][0];
				$this->insertVideo();
			}
		}
			
				
	}
	
	private function insertVideo()
	{
		$video = Doctrine_Core::getTable('Video')
			->createQuery('v')
			->where('code = ?', $this->youCode)
			->execute();

		if(!$video->count())
		{
			$this->log('Add video : '.$this->title);
			
			$video = new Video();
			
			$video->title = $this->title;
			$video->description = $this->description;
			$video->code = $this->youCode;
		
			$url = 'http://img.youtube.com/vi/'.$this->youCode.'/0.jpg';
			$img = sfConfig::get('sf_upload_dir').'/thumb-video/'.$video->getSlugTitle().'.jpg';
			file_put_contents($img, file_get_contents($url));
			$video->thumbnail = $video->getSlugTitle().'.jpg';
			
			$video->category_id = 15;
			$video->user_id = 1;
			
			$video->save();
		}
		else
		{
			$this->log('Video already exist : '.$this->title);
		}
	}
}
