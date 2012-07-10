<?php

/**
 * video actions.
 *
 * @package    jolatefri
 * @subpackage video
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class videoActions extends sfActions
{
  public function executeFacebook(sfWebRequest $request)
  {
   		
    	$q = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1');
      		
      	if($category = $request->getParameter('category'))
	    {
	    	$q->leftJoin('v.Category ca');
	    	$q->addWhere('ca.name = ?', array($category));
	    	$this->category = $category;
			echo 'ok';
	    }
    	
    	if($request->getParameter('order') == 'vues')
    	{
    		$this->order = $request->getParameter('order');
    		$q->orderBy('nbVue desc');
    	}
    	elseif($request->getParameter('order') == 'commentaires')
    	{
    		$q->leftJoin('v.Commentaire co');
    		$q->groupBy('co.video_id');
    		$q->select('*, SUM(co.video_id) as nbCom');
    		$q->orderBy('nbCom desc');
    		$this->order = $request->getParameter('order');
    	}
    	else
    	{
    		$q->orderBy('created_at DESC');
    	}
    	
      	$this->pager = new sfDoctrinePager('Video', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
		
		

  }
  
  public function executeLanding(sfWebRequest $request)
  {
   		$this->nowVideos = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->orderBy('created_at DESC')
			->limit(8)
			->offset(0)
			->execute();
			
		$this->vueVideos = Doctrine_Core::getTable('Video')
	      ->createQuery('v')
		  ->where('is_activated = 1')
		  ->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 week')))
		  ->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-4 month')))
	      ->orderby('v.nbVue DESC')
	      ->limit(8)
	      ->offset('0')
	      ->execute();
		
		$this->bestVideos = Doctrine_Core::getTable('Video')
	      ->createQuery('v')
		  ->where('is_activated = 1')
		  ->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 week')))
		  ->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-4 month')))
	      ->orderby('v.nbLike DESC')
	      ->limit(8)
	      ->offset('0')
	      ->execute();
		  
		$this->commentVideos = Doctrine_Core::getTable('Video')
	      ->createQuery('v')
		  ->where('is_activated = 1')
	      ->orderby('v.nbComment DESC')
	      ->limit(8)
	      ->offset('0')
	      ->execute();
			
		
	
  }
  public function executeIndex(sfWebRequest $request)
  {

    	$q = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->leftJoin('v.Category ca')
			->leftJoin('v.Users u');
      	
		
		
      	if(($category = $request->getParameter('category')) && $request->getParameter('category') != 'videos')
	    {
	    	$q->addWhere('ca.name = ?', array($category));
	    	$this->category = $category;
			
			// déclaration des métas
			$this->getContext()->getResponse()->addMeta('title', 'Vidéos '.$category." | Jolatefri : toujours plus de vidéos buzz, humouret fun  du web !");
			$this->getContext()->getResponse()->addMeta('description',  'Vidéos '.$category." | Jolatefri : toujours plus de vidéos humour, fun et buzz du web !");
	   
	    }
    	
    	if($request->getParameter('order') == 'vues')
    	{
    		$this->order = $request->getParameter('order');
    		$q->orderBy('nbVue desc');
    	}
    	elseif($request->getParameter('order') == 'commentaires')
    	{
    		$q->leftJoin('v.Commentaire co');
    		$q->groupBy('co.video_id');
    		$q->select('*, SUM(co.video_id) as nbCom');
    		$q->orderBy('nbCom desc');
    		$this->order = $request->getParameter('order');
    	}
    	else
    	{
			$q->orderBy('created_at DESC');
    	}
    	
		//$this->forward404Unless($q->execute()->count());
		
      	$this->pager = new sfDoctrinePager('Video', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
		

  }

	public function executeBestLike(sfWebRequest $request)
  {
   		
		if($request->getParameter('filter'))
		{
			$this->filter = $request->getParameter('filter');
		}
		else
		{
			$this->filter = 'all';
		}
		
    	$q = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->leftJoin('v.Category ca')
			->leftJoin('v.Users u');
      	
		switch($this->filter)
		{
			case 'month':
				$q->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 day')))
	  			->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-1 month')));
				break;
			case 'week':
				$q->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 day')))
	  			->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-1 week')));
				break;
		}

    	$q->orderBy('nbLike desc');

      	$this->pager = new sfDoctrinePager('Video', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
		

  }

	public function executeBestComment(sfWebRequest $request)
  {
   		
		if($request->getParameter('filter'))
		{
			$this->filter = $request->getParameter('filter');
		}
		else
		{
			$this->filter = 'all';
		}
		
    	$q = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->leftJoin('v.Category ca')
			->leftJoin('v.Users u');
      	
		switch($this->filter)
		{
			case 'month':
				$q->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 day')))
	  			->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-1 month')));
				break;
			case 'week':
				$q->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 day')))
	  			->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-1 week')));
				break;
			
		}

    	$q->orderBy('nbComment desc');

      	$this->pager = new sfDoctrinePager('Video', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
		

  }
	public function executeBestVue(sfWebRequest $request)
  {
   		
		if($request->getParameter('filter'))
		{
			$this->filter = $request->getParameter('filter');
		}
		else
		{
			$this->filter = 'all';
		}
		
    	$q = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 1')
			->leftJoin('v.Category ca')
			->leftJoin('v.Users u');
      	
		switch($this->filter)
		{
			case 'month':
				$q->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 day')))
	  			->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-1 month')));
				break;
			case 'week':
				$q->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 day')))
	  			->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-1 week')));
				break;
			
		}

    	$q->orderBy('nbVue desc');

      	$this->pager = new sfDoctrinePager('Video', sfConfig::get('app_max_video_page'));
      	$this->pager->setQuery($q);
		$this->pager->getQuery();
		$this->pager->setPage($this->getRequestParameter('page',1));
		$this->pager->init();
		

  }
  
  	public function executeShow(sfWebRequest $request)
  	{
  		$slug = $request->getParameter('slug');
  		if(isset($slug))
		{
			$this->video = $video = $this->getRoute()->getObject();
		}
		else {
			$this->forward404Unless($idVideo = $request->getParameter('id'));
		    $this->video  = $video = Doctrine_Core::getTable('Video')->findById($idVideo)->getFirst();
			$this->forward404Unless($this->video->count());
		}
	  	
		
    

    	
    	$this->forward404Unless($video->getIsActivated() == 1);
		$video->updateLuceneIndex();
    	// déclaration des métas
		$this->getContext()->getResponse()->addMeta('title', strip_tags($video->getTitle('ESC_RAW')));
		$this->getContext()->getResponse()->addMeta('image', 'http://www.jolatefri.com'.$video->getSrcThumbnail(150, 150));
		$this->getContext()->getResponse()->addMeta('description', strip_tags($video->getDescription('ESC_RAW')));
   
    	//update nb vue
    
    	Doctrine_Core::getTable('Video')->updateVue($video->getId());
		
		// update score

		if($this->getUser()->isAuthenticated())
		{
			$exist = Doctrine_Core::getTable('User_view_video')
	      		->createQuery('uvv')
	      		->where('uvv.video_id = ?', $video->getId())
	      		->addWhere('uvv.user_id = ?', $this->getUser()->getGuardUser()->getId())
				->execute();
						
			if(!$exist->count())
			{
				$score = sfConfig::get('app_score_view_video');
				
				$userViewVideo = new User_view_video();
				$userViewVideo->video_id = $video->getId();
				$userViewVideo->user_id = $this->getUser()->getGuardUser()->getId();
				$userViewVideo->save();	
							
				$user = $this->getUser()->getGuardUser();
			
				$user->score = $user->getScore() + $score;
				$user->save();
				
				$this->getUser()->setFlash('notice', '<h3>Score : + '.$score.' points</h3><p>Ton score évolu, tu viens de gagner <b>'.$score.' points</b> pour avoir regardé cette vidéo</p>');
					
			}
		}
		
	
    
  	}



  public function executeSearchYoutube(sfWebRequest $request)
  {
  	
  	if($request->isMethod(sfRequest::POST))
  	{
  		$q = $request->getParameter('query');
  		
  		
	  	require_once 'Zend/Gdata/YouTube.php';
	  	
	  	$yt = new Zend_Gdata_YouTube();
		$yt->setMajorProtocolVersion(2);
		$query = $yt->newVideoQuery();
		$query->setOrderBy('relevance');
		$query->setVideoQuery($q); 
		 
		// on récupère un flux XML avec la liste des vidéos
		$flux = $yt->getVideoFeed($query);
		
		$this->videos = $flux;
  	}
  	
    return $this->renderPartial('video/searchYoutube');
    
  }
  
  public function executePreviewYoutube(sfWebRequest $request)
  {
  	$this->wrongUrl = false;
  	
  	if($request->isMethod(sfRequest::POST))
  	{
   		if(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/watch\?v=)([A-Za-z0-9-_]*)#', $request->getParameter('url'), $matches, PREG_OFFSET_CAPTURE))
   		{

			$youCode = $matches[7][0];
			$this->code = $youCode;
			
			$this->urlImage = 'http://img.youtube.com/vi/'.$youCode.'/0.jpg';
		}
		else
		{
			$this->wrongUrl = true;
		}
   	}
  	
    return $this->renderPartial('video/previewYoutube');
    
  }
  
  public function executeNewPortail(sfWebRequest $request)
  {
    
  }
  
  public function executeNewVideo(sfWebRequest $request)
  {
    $this->form = $form = new NewVideoForm();
    
  }
  
  public function executeNewImage(sfWebRequest $request)
  {
    $this->form = $form = new NewImageForm();
    
  }

  public function executeCreateVideo(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NewVideoForm();

    $this->processForm($request, $this->form);
    
    $this->getUser()->setFlash('ok', 'Merci !');

    $this->redirect('@homepage');
  }
  
  public function executeCreateImage(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NewImageForm();

    $this->processForm($request, $this->form);
    
    $this->getUser()->setFlash('ok', 'Merci !');

    $this->redirect('@homepage');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($video = Doctrine_Core::getTable('Video')->find(array($request->getParameter('id'))), sprintf('Object video does not exist (%s).', $request->getParameter('id')));
    $this->form = new NewVideoForm($video);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($video = Doctrine_Core::getTable('Video')->find(array($request->getParameter('id'))), sprintf('Object video does not exist (%s).', $request->getParameter('id')));
    $this->form = new NewVideoForm($video);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('vid'))
      		->fetchOne();

      	$video->delete();
      	
      	return $this->renderText('ok');
	}

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
  		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    	if ($form->isValid())
    	{
    		$file = $form->getValue('thumbnail');
    		$code = $form->getValue('code');
 			
 			$video = $form->save();
 			
 			if($file)
 			{
 				$filename = 'uploaded_'.sha1($file->getOriginalName());
	  			$extension = $file->getExtension($file->getOriginalExtension());
	  			$path = sfConfig::get('sf_upload_dir').'/thumb-video/'.$filename.$extension;
	  			$file->save($path);
				
				$video->thumbnail = $filename.$extension;
				$video->save();
 			}
 			elseif(preg_match('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})/watch\?v=)([A-Za-z0-9-_]*)#', $code, $matches, PREG_OFFSET_CAPTURE))
 			{
 				$youCode = $matches[7][0];
 				$video->code = $youCode;
 				
 				$url = 'http://img.youtube.com/vi/'.$youCode.'/0.jpg';
				$img = sfConfig::get('sf_upload_dir').'/thumb-video/'.$video->getSlugTitle().'.jpg';
				file_put_contents($img, file_get_contents($url));
				$video->thumbnail = $video->getSlugTitle().'.jpg';
				
				$video->save();

 			}

			if(isset($_FILES))
			{
				$uploaded = 0;
				foreach ($_FILES['images']['name'] as $i => $name) 
				{ 
        
			        if ($_FILES['images']['error'][$i] == 4) { 
			            continue;  
			        } 
			        
			        if ($_FILES['images']['error'][$i] == 0) { 
			            
			             if ($_FILES['images']['size'][$i] > 99439443) { 
			                $message[] = "$name exceeded file limit."; 
			                continue;   
			             } 
			             
						$content_dir = sfConfig::get('sf_upload_dir').'/images/'; // dossier où sera déplacé le fichier
	
					    $tmp_file = $_FILES['images']['tmp_name'][$i];
					
					    if( !is_uploaded_file($tmp_file) )
					    {
					        exit("Le fichier est introuvable");
					    }
					
					    // on vérifie maintenant l'extension
					    $type_file = $_FILES['images']['type'][$i];
						$extension = explode('image/', $type_file);
					
					    // on copie le fichier dans le dossier de destination
					    $name_file = $_FILES['images']['name'][$i];
						
						$nameImage = $video->getSlugTitle().'-'.$uploaded.'.'.$extension[1];
						
					    if( !move_uploaded_file($tmp_file, $content_dir . $nameImage) )
					    {
					       exit("Impossible de copier le fichier dans $content_dir");
					    }
						
						$image = new Images();
						
						$image->video_id = $video->id;
						$image->name = $nameImage;
			            $image->save();
						
						if($uploaded == 0)
						{


							$video->mode = 4;
							$video->thumbnail = $nameImage;
							$video->save();
						}
			            $uploaded++; 
			        } 
			   } 
			}
  			
      		
			
      		//$this->redirect('video/edit?id='.$video->getId());
    	}
  }

	public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'video', 'index');
 
    $this->videos = Doctrine_Core::getTable('Video') ->getForLuceneQuery($query);

	$this->query = $query;
	if($this->videos)
	{
		$search = new Search();

		$search->content =  htmlspecialchars_decode($query);
		//$search->save();
	}
	else
	{
		$this->videosOther = Doctrine_Core::getTable('Video')
	      ->createQuery('v')
	      ->select('*, RANDOM() AS rand')
		  ->where('is_activated = 1')
	      ->orderby('rand')
	      ->limit('10')
	      ->offset('0')      
	      ->execute();
	}

			// déclaration des métas
			$this->getContext()->getResponse()->addMeta('title', 'Vidéos : '.$query." | Jolatefri : toujours plus de vidéos humour, fun et buzz du web !");
			$this->getContext()->getResponse()->addMeta('description',  'Vidéos '.$query." | Jolatefri : toujours plus de vidéos humour, fun et buzz du web !");
	   
  }



  ///////////////////
  public function executeMajVideo(sfWebRequest $request)
  {
  	ini_set ( "memory_limit", "200M" );
  	mysql_connect('localhost', 'jolatefri', '8163264') or die("erreur de connexion au serveur");

	mysql_select_db('dev') or die("erreur de connexion a la base de donnees");
	
	// Creation et envoi de la requete
	$query = "SELECT * FROM contenu";
	
	$result = mysql_query($query);
	$i=0;
	// Recuperation des resultats
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		
		$video = Doctrine_Core::getTable('Video')
	      ->createQuery('v')
		  ->where('id = ?', $row['idVideo'])      
	      ->execute()->getFirst();
		  
		if($video)
		{
				$content = $row['descriptionVideo'];

				$video->description = utf8_encode($row['descriptionVideo']);
				$video->code = $row['lienVideo'];
				
				$video->save();
				}
	}
	die();
  }

	
}