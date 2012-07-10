<?php

/**
 * BaseVideo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property string $description
 * @property string $thumbnail
 * @property string $code
 * @property integer $nbVue
 * @property integer $nbLike
 * @property integer $nbComment
 * @property integer $mode
 * @property string $slug
 * @property integer $is_activated
 * @property integer $category_id
 * @property integer $user_id
 * @property Category $Category
 * @property sfGuardUser $Users
 * @property Doctrine_Collection $Commentaire
 * @property Doctrine_Collection $UserViews
 * @property Doctrine_Collection $UserLikes
 * 
 * @method string              getTitle()        Returns the current record's "title" value
 * @method string              getDescription()  Returns the current record's "description" value
 * @method string              getThumbnail()    Returns the current record's "thumbnail" value
 * @method string              getCode()         Returns the current record's "code" value
 * @method integer             getNbVue()        Returns the current record's "nbVue" value
 * @method integer             getNbLike()       Returns the current record's "nbLike" value
 * @method integer             getNbComment()    Returns the current record's "nbComment" value
 * @method integer             getMode()         Returns the current record's "mode" value
 * @method string              getSlug()         Returns the current record's "slug" value
 * @method integer             getIsActivated()  Returns the current record's "is_activated" value
 * @method integer             getCategoryId()   Returns the current record's "category_id" value
 * @method integer             getUserId()       Returns the current record's "user_id" value
 * @method Category            getCategory()     Returns the current record's "Category" value
 * @method sfGuardUser         getUsers()        Returns the current record's "Users" value
 * @method Doctrine_Collection getCommentaire()  Returns the current record's "Commentaire" collection
 * @method Doctrine_Collection getUserViews()    Returns the current record's "UserViews" collection
 * @method Doctrine_Collection getUserLikes()    Returns the current record's "UserLikes" collection
 * @method Video               setTitle()        Sets the current record's "title" value
 * @method Video               setDescription()  Sets the current record's "description" value
 * @method Video               setThumbnail()    Sets the current record's "thumbnail" value
 * @method Video               setCode()         Sets the current record's "code" value
 * @method Video               setNbVue()        Sets the current record's "nbVue" value
 * @method Video               setNbLike()       Sets the current record's "nbLike" value
 * @method Video               setNbComment()    Sets the current record's "nbComment" value
 * @method Video               setMode()         Sets the current record's "mode" value
 * @method Video               setSlug()         Sets the current record's "slug" value
 * @method Video               setIsActivated()  Sets the current record's "is_activated" value
 * @method Video               setCategoryId()   Sets the current record's "category_id" value
 * @method Video               setUserId()       Sets the current record's "user_id" value
 * @method Video               setCategory()     Sets the current record's "Category" value
 * @method Video               setUsers()        Sets the current record's "Users" value
 * @method Video               setCommentaire()  Sets the current record's "Commentaire" collection
 * @method Video               setUserViews()    Sets the current record's "UserViews" collection
 * @method Video               setUserLikes()    Sets the current record's "UserLikes" collection
 * 
 * @package    jolatefri
 * @subpackage model
 * @author     Antoine Lenoir
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVideo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('video');
        $this->hasColumn('title', 'string', 1000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1000,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('thumbnail', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('code', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('nbVue', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('nbLike', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('nbComment', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('mode', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('slug', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('is_activated', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Category', array(
             'local' => 'category_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as Users', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasMany('Comment as Commentaire', array(
             'local' => 'id',
             'foreign' => 'video_id'));

        $this->hasMany('User_view_video as UserViews', array(
             'local' => 'id',
             'foreign' => 'video_id'));

        $this->hasMany('User_like_video as UserLikes', array(
             'local' => 'id',
             'foreign' => 'video_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}