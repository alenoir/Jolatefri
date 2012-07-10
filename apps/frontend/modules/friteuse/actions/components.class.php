<?php
 
class friteuseComponents extends sfComponents
{
  public function executeHomePreview()
  {
    $this->posts = Doctrine_Core::getTable('Friteuse')
      ->createQuery('v')
      ->orderBy('id DESC')
	  ->limit(6)
	  ->offset(0)
      ->execute();
  }
  
  public function executeAddPost()
  {
  		$this->formImage = new FriteuseImageForm();
  		$this->formVideo = new FriteuseVideoForm();
		
		
		if($this->getUser()->isAuthenticated())
		{
			$this->formImage->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
			$this->formImage->setDefault('type', 'image');
			$this->formVideo->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
			$this->formVideo->setDefault('type', 'video');
		}
  }
  
 	public function executeControlPost()
  	{
  		$this->nextPost = Doctrine_Query::create()
			->from('Friteuse')
		    ->orderby('id desc')
			->where('id < ?', $this->post->getId())
		    ->limit(1)
			->execute()->getFirst();
			
		$this->previousPost = Doctrine_Query::create()
			->from('Friteuse')
		    ->orderby('id asc')
			->where('id > ?', $this->post->getId())
		    ->limit(1)
			->execute()->getFirst();
  	}

}