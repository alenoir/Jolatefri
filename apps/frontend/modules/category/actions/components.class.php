<?php
 
class categoryComponents extends sfComponents
{
  public function executeListSidebar()
  {
    $this->categorys = Doctrine_Core::getTable('Category')
      ->createQuery('a')
      ->execute();
  }
  
  public function executeListFooter()
  {
    $this->categorys = Doctrine_Core::getTable('Category')
      ->createQuery('a')
      ->execute();
  }
  public function executeMenuHeader()
  {
    $this->categorys = Doctrine_Core::getTable('Category')
      ->createQuery('a')
	  ->orderBy('name')
      ->execute();
  }
}