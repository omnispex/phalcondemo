<?php
/**
 * Categories
 *
 * Model Categories
 *
 * @Source('categories');
 * @useDynamicUpdate(true);
 * @hasManyToMany(
 *  'id',
 *  'Categoryarticles',
 *  'categoryid',
 *  'articleid',
 *  'Articles',
 *  'id', {'alias': 'articles', 'reusable': true});
 * @hasManyToMany(
 *  'id',
 *  'Categoryrelations',
 *  'categoryid',
 *  'relationid',
 *  'Categories',
 *  'id', {'alias': 'relations', 'reusable': true});
 * @belongsTo('parentid','Categories','id', {'alias': 'parent', 'reusable': true});
 * @hasOne('iconid','Images','id', {'alias': 'icon', 'reusable': true});
 */
class Categories extends \Phalcon\Mvc\Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false, column="id", size="11")
     */
    public $id;
     
    /**
     * @Column(type="string", nullable=false, column="languagekey", size="3")
     */
    public $languagekey;

    /**
     * @Column(type="integer", nullable=false, column="parentid", size="11")
     */
    public $parentid;
     
    /**
     * @Column(type="integer", nullable=false, column="iconid", size="11")
     */
    public $iconid;

    /**
     * @Column(type="integer", nullable=false, column="slidercollectionid", size="11")
     */
    public $slidercollectionid;

    /**
     * @Column(type="string", nullable=false, column="pagetitle", size="100")
     */
    public $pagetitle;
     
    /**
     * @Column(type="string", nullable=false, column="listtitle", size="100")
     */
    public $listtitle;
     
    /**
     * @Column(type="string", nullable=false, column="listdescription", size="250")
     */
    public $listdescription;
     
    /**
     * @Column(type="text", nullable=false, column="content")
     */
    public $content;
     
    /**
     * @Column(type="string", nullable=false, column="seotitle", size="100")
     */
    public $seotitle;
     
    /**
     * @Column(type="string", nullable=false, column="seodescription", size="150")
     */
    public $seodescription;
     
    /**
     * @Column(type="string", nullable=false, column="seokeywords", size="150")
     */
    public $seokeywords;
     
    /**
     * @Column(type="string", nullable=false, column="filename", size="30")
     */
    public $filename;
     
    /**
     * @Column(type="integer", nullable=false, column="depth", size="11")
     */
    public $depth;
     
    /**
     * @Column(type="integer", nullable=false, column="ordernumber", size="11")
     */
    public $ordernumber;
     
    /**
     * @Column(type="enum", nullable=false, column="trash", size="3")
     */
    public $trash;
     
    /**
     * @Column(type="string", nullable=false, column="idrange")
     */
    public $idrange;
     
    /**
     * @Column(type="string", nullable=false, column="titlerange")
     */
    public $titlerange;
     
    /**
     * @Column(type="string", nullable=false, column="filenamerange")
     */
    public $filenamerange;

    /**
     * Get image object if an icon is available
     * @return object
     */
    public function getIcon()
    {
        $object=new stdClass();  
        if ($this->iconid>0)
        {
            $image=Images::findFirst($this->iconid);
            $object->filename=$image->filename;
            $object->path=$image->path;
            $object->extension=$image->extension;
            $object->thumbnail=$image->thumbnail;
        }
        else
        {
            $object->filename=null;
            $object->path=null;
            $object->extension=null;
            $object->thumbnail=null;            
        }
        return $object;
    }

    /**
     * Get string of child id's from a category
     * @param int $value the category id
     * @return string
     */
    public static function getChildren($value) 
    {
        $children=$value.",";
        $builder=self::find(array(
            "parentid=:parentid:",
            "columns" => array('id','parentid'),
            "bind" => array('parentid' => $value)
        )); 
        $count=1;
        foreach ($builder as $build)  
        {
            $parentid=$build->parentid;
            $children.="".$value.",".$build->id.",";
            self::getChildren($build->id);
            $count++;
        }
        return $children;     
    }
}