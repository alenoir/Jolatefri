<?php

/**
 * feed actions.
 *
 * @package    jolatefri
 * @subpackage feed
 * @author     Antoine Lenoir
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class feedActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	
		$this->videos = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->orderBy('created_at DESC')
			->limit(20)
			->execute();
		
		$response = $this->getResponse();
		
		// HTTP headers
		$response->setContentType('text/xml');
		$response->setHttpHeader('Content-Language', 'en');
		$response->addVaryHttpHeader('Accept-Language');
		$response->addCacheControlHttpHeader('no-cache');
		
		$this->setLayout(false);
		
		/*$feed = new sfAtom1Feed();

	  $feed->setTitle('Jolatefri : Toujours plus de vidéos !');
	  $feed->setLink('http://www.jolatefri.com/');
	  $feed->setAuthorEmail('contact@jolatefri.com');
	  $feed->setAuthorName('Antoine Lenoir');
	
	  $feedImage = new sfFeedImage();
	  $feedImage->setFavicon('http://www.jolatefri.com/favicon.ico');
	  $feed->setImage($feedImage);
	
	  $videos = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->orderBy('created_at DESC')
			->limit(10)
			->offset('0')
			->execute();
	
	  foreach ($videos as $post)
	  {
	    $item = new sfFeedItem();
	    $item->setTitle($post->getTitle());
	    $item->setLink($post->getUrlShow());
	    $item->setAuthorName($post->getUsers()->getUsername());
	    $item->setPubdate($post->getCreatedAt());
	    $item->setUniqueId($post->getId());
		$img = new sfFeedEnclosure();
		$img->setUrl("http://www.jolatefri.com".$post->getOriginalThumbnail());
		$img->setMimeType("image/png");
		$item->setEnclosure($img);
		//var_dump($post->getDescription());
		//die();
	    $item->setDescription('<img src="" />'.strip_tags(sfOutputEscaperGetterDecorator::unescape($post->getDescription())));
	
	    $feed->addItem($item);
	  }
	
	  $this->feed = $feed;*/
	 
  }
  
  public function executeSitemapVideo(sfWebRequest $request)
  {
  		$this->videos = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
      		->addWhere('mode = 2')
			->orderBy('updated_at DESC')
			->execute();
		
		$response = $this->getResponse();
		
		// HTTP headers
		$response->setContentType('text/xml');
		$response->setHttpHeader('Content-Language', 'en');
		$response->addVaryHttpHeader('Accept-Language');
		$response->addCacheControlHttpHeader('no-cache');
		
		$this->setLayout(false);
  }
}
