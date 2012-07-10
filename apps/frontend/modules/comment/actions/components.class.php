<?php
 
class commentComponents extends sfComponents
{
  public function executeModuleSidebar()
  {
    $this->comments = Doctrine_Core::getTable('Comment')
      ->createQuery('c')
	  ->orderBy('created_at DESC')
	  ->limit(7)
	  ->offset(0)
      ->execute();
  }
  
  
}