<?php

/**
 * Category
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    jolatefri
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Category extends BaseCategory
{
	private function isCategory($string)
	{
	    $route = sfContext::getInstance()->getRouting()->getCurrentRoute();
	    echo $route;
	}
}