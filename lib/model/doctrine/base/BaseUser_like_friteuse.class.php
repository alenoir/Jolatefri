<?php

/**
 * BaseUser_like_friteuse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $friteuse_id
 * @property sfGuardUser $User
 * @property Friteuse $Friteuse
 * 
 * @method integer            getUserId()      Returns the current record's "user_id" value
 * @method integer            getFriteuseId()  Returns the current record's "friteuse_id" value
 * @method sfGuardUser        getUser()        Returns the current record's "User" value
 * @method Friteuse           getFriteuse()    Returns the current record's "Friteuse" value
 * @method User_like_friteuse setUserId()      Sets the current record's "user_id" value
 * @method User_like_friteuse setFriteuseId()  Sets the current record's "friteuse_id" value
 * @method User_like_friteuse setUser()        Sets the current record's "User" value
 * @method User_like_friteuse setFriteuse()    Sets the current record's "Friteuse" value
 * 
 * @package    jolatefri
 * @subpackage model
 * @author     Antoine Lenoir
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUser_like_friteuse extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_like_friteuse');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('friteuse_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'Cascade'));

        $this->hasOne('Friteuse', array(
             'local' => 'friteuse_id',
             'foreign' => 'id',
             'onDelete' => 'Cascade'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}