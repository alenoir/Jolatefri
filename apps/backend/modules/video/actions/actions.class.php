<?php

require_once dirname(__FILE__).'/../lib/videoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/videoGeneratorHelper.class.php';

/**
 * video actions.
 *
 * @package    jolatefri
 * @subpackage video
 * @author     Antoine Lenoir
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class videoActions extends autoVideoActions
{
	public function preExecute()
  {
    $this->configuration = new videoGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new videoGeneratorHelper();

    parent::preExecute();
  }

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@video');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@video');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->video = $this->form->getObject();
  }

	public function executeNewImage(sfWebRequest $request)
  {
    $this->form = $form = new NewImageForm();
    
  }
  
  public function executeCreateImage(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NewImageForm();

    $this->processImageForm($request, $this->form);
    
    $this->getUser()->setFlash('ok', 'Merci !');

    $this->redirect('@homepage');
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->video = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->video = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->video);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->video = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->video);

    $this->processForm($request, $this->form);
	return $this->renderPartial('video/previewForm', array('video' => $this->video));
    //$this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
      $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('@video');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@video');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@video');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Video'));
    try
    {
      // validate ids
      $ids = $validator->clean($ids);

      // execute batch
      $this->$method($request);
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
    }

    $this->redirect('@video');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $records = Doctrine_Query::create()
      ->from('Video')
      ->whereIn('id', $ids)
      ->execute();

    foreach ($records as $record)
    {
      $record->delete();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    $this->redirect('@video');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $video = $this->video = $form->save();
		
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $video)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@video_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        if(!$request->isXmlHttpRequest())
        	$this->redirect(array('sf_route' => 'video_edit', 'sf_subject' => $video));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
    
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('video.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('video.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('Video');
    $pager->setQuery($this->buildQuery());
    $pager->setPage($this->getPage());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('video.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('video.page', 1, 'admin_module');
  }

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

  protected function addSortQuery($query)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    if (!in_array(strtolower($sort[1]), array('asc', 'desc')))
    {
      $sort[1] = 'desc';
    }

    $query->addOrderBy($sort[0] . ' ' . $sort[1]);
  }

  protected function getSort()
  {
    if (null !== $sort = $this->getUser()->getAttribute('video.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('video.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'desc';
    }

    $this->getUser()->setAttribute('video.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return Doctrine_Core::getTable('Video')->hasColumn($column);
  }

protected function processImageForm(sfWebRequest $request, sfForm $form)
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
  
  public function executeCheckVideo()
	{
		$this->videos = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('is_activated = 0')
      		->orderBy('created_at desc')
			->limit(10)
			->offset(0)
      		->execute();
			
		$this->categories = Doctrine_Core::getTable('Category')
      		->createQuery('v')
      		->orderBy('name asc')
      		->execute();
	}
	
	public function executeActivate(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('vid'))
      		->fetchOne();
      	
      	$friteuse = new Friteuse();
		
		$friteuse->title = $video->getTitle();
		$friteuse->code = $video->getLecteurVideo();
		$friteuse->image = $video->getThumbnail();
		
		$friteuse->save();
		
      	$video->is_activated = 3;
      	$video->save();
		
		$user = $video->getUsers();
		
		$user->score = $user->getScore() + 100;
		$user->save();
      	
      	return $this->renderPartial('video/activate');
	}
	
	public function executeAjaxEdit(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('id'))
      		->fetchOne();
      	
      	$video->title = $request->getParameter('title');
      	$video->category_id = $request->getParameter('category_id');
      	$video->description = $request->getParameter('description');
      	$video->save();
      	
      	return $this->renderPartial('video/activate');
	}

	public function executeConvert(sfWebRequest $request)
	{
		if(!$request->getParameter('id'))
		{
			$this->video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
			->where('is_activated = 1')
			->addWhere('mode = 0')
			->orderBy('id DESC')
      		->execute()->getFirst();
		}
		else {
			$this->video = Doctrine_Core::getTable('Video')
      		->createQuery('v')
      		->where('id = ?', $request->getParameter('id'))
      		->fetchOne();
		}
		
      	if($request->isMethod(sfRequest::POST))
		{
			$updatedAt = $this->video->getUpdatedAt();
  
			$videoFile = $request->getParameter('file');
			$this->video->code = 'http://www.jolatefri.com/uploads/videos/'.$videoFile;
			$this->video->mode = 2;
			$this->video->save();
			$this->video->setUpdatedAt($updatedAt);
			$this->video->save();

			$this->redirect($this->getRequest()->getReferer());
		}
	}

  
}
