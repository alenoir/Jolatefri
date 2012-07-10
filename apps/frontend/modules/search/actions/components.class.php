<?php
 
class searchComponents extends sfComponents
{
  public function executeListFooter()
  {
    $this->searchs = Doctrine_Core::getTable('Search')
      ->createQuery('s')
      ->select('*, COUNT(s.content) as nb')
	  ->groupBy('s.content')
	  ->orderBy('id DESC')
	  ->limit('10')
	  ->offset('0')
      ->execute();
	  
  }
  

}