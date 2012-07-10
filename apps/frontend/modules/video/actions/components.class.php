<?php
 
class videoComponents extends sfComponents
{
  public function executeCoupCoeur()
  {
  	$idCoupCoeur = Config::getConfig('coupDeCoeur');
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
      ->where('v.id = ?', array($idCoupCoeur))
      ->execute();
  }
  
  public function executeSlideShowLanding()
  {
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
	  ->where('is_activated = 1')
	  ->leftJoin('v.Category ca')
	  ->leftJoin('v.Users u')
      ->orderby('v.created_at DESC')
      ->limit('5')
      ->offset('0')
      ->execute();
  }
  
  public function executeMeilleuresList()
  {
  	
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
	  ->where('is_activated = 1')
	  ->leftJoin('v.Category ca')
	  ->leftJoin('v.Users u')
	  ->addWhere( 'v.created_at <= ?', date('Y-m-d H:i:s', strtotime('-1 week')))
	  ->addWhere( 'v.created_at >= ?', date('Y-m-d H:i:s', strtotime('-2 month')))
      ->orderby('v.nbVue DESC')
      ->limit('10')
      ->offset('0')
      ->execute();
  }
  
  public function executeRecentesList()
  {
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
	  ->leftJoin('v.Category ca')
	  ->leftJoin('v.Users u')
	  ->where('is_activated = 1')
      ->orderby('v.created_at DESC')
      ->limit('5')
      ->offset('0')      
      ->execute();
  }
  
  public function executeVideosRelative()
  {
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
      ->select('*, RANDOM() AS rand')
	  ->leftJoin('v.Category ca')
	  ->leftJoin('v.Users u')
      ->where('v.category_id = ?', array($this->category))
	  ->andWhere('is_activated = 1')
      ->orderby('rand')
      ->limit('6')
      ->offset('0')      
      ->execute();
  }
  
  public function executeVideosHasard()
  {
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
      ->select('*, RANDOM() AS rand')
	  ->leftJoin('v.Category ca')
	  ->leftJoin('v.Users u')
	  ->where('is_activated = 1')
      ->orderby('rand')
      ->limit('5')
      ->offset('0')      
      ->execute();
  }

	public function executeListFooter()
  {
    $this->videos = Doctrine_Core::getTable('Video')
      ->createQuery('v')
      ->select('*, RANDOM() AS rand')
	  ->leftJoin('v.Category ca')
	  ->leftJoin('v.Users u')
	  ->where('is_activated = 1')
      ->orderby('rand')
      ->limit('5')
      ->offset('0')      
      ->execute();
	  
	 /*foreach($this->videos as $video)
	 {
	 	$video->updateLuceneIndex();
	 }*/
  }
}