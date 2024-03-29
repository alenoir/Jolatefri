<?php

/**
 * sfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    jolatefri
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class sfGuardUser extends PluginsfGuardUser
{
	private function slug($string)
	{
	    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
	
	public function getSlugUsername()
	{
		return $this->slug($this->getUsername());
	}
	
	public function getUrlEdit()
	{
		$url = url_for('@user_edit?id='.$this->getId());
		return $url;
	}
	
	public function getUrlShow()
	{
		$url = url_for('@user_show?idUser='.$this->getId().'&username='.$this->getSlugUsername());
		return $url;
	}
	
	public function getSrcThumbnail($w, $h)
	{
		$photo = $this->getPhoto();
		$filename = sfConfig::get('sf_upload_dir').'/thumb-user/'.$photo;

		if (empty($photo))
		{
			$filename = '/uploads/thumb-user/default.png';
		}
		elseif(preg_match('#(graph.facebook)#', $this->getPhoto(), $matches, PREG_OFFSET_CAPTURE))
		{
			$filename = $this->getPhoto();
		}
		else 
		{
			if (!file_exists($filename))
			{
				$filename = '/uploads/thumb-user/default.png';
			}
			else
			{
				$filename = '/uploads/thumb-user/'.$this->getPhoto();
			}
			
		}
		return '/scripts/timthumb.php?src='.$filename.'&h='.$h.'&w='.$w.'&zc=1'; 
			
	}
	
	public function usernameIsSet()
	{
		if (preg_match("/@+([0-9]+)/", $this->getUsername())) {
		   return false;
		} else {
		    return true;
		}
	}
		
	public function isMyProfile()
	{
		if(sfContext::getInstance()->getUser()->isAuthenticated() && sfContext::getInstance()->getUser()->getGuardUser()->getId() == $this->getId())
			return true;
		else
			return false; 
	}
	
	public function updateScore($up)
	{
		$this->score = $this->score + $up;
		$this->save();
	}
	
}
