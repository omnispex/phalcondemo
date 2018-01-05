<?php
/**
 * Articles
 *
 * Model Articles
 *
 * @Source('articles');
 * @useDynamicUpdate(true);
 * @hasManyToMany(
 *  'id',
 *  'Categoryarticles',
 *  'articleid',
 *  'categoryid',
 *  'Categories',
 *  'id', {'alias': 'categories', 'reusable': true});
 * @belongsTo('publishid','Users','id', {'alias': 'publisher', 'reusable': true});
 * @hasOne('iconid','Images','id', {'alias': 'icon', 'reusable': true});
 */
class Articles extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", nullable=false, column="iconid", size="11")
     */
    public $iconid;

    /**
     * @Column(type="integer", nullable=false, column="slidercollectionid", size="11")
     */
    public $slidercollectionid;
     
    /**
     * @Column(type="integer", nullable=false, column="publishid")
     */
    public $publishid;  

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
     * @Column(type="string", nullable=false, column="websitetitle", size="100")
     */
    public $websitetitle;

    /**
     * @Column(type="string", nullable=false, column="websiteurl", size="100")
     */
    public $websiteurl;

    /**
     * @Column(type="string", nullable=false, column="filename", size="100")
     */
    public $filename;
     
    /**
     * @Column(type="integer", nullable=false, column="ordernumber", size="11")
     */
    public $ordernumber;
     
    /**
     * @Column(type="enum", nullable=false, column="trash", size="3")
     */
    public $trash;
     
    /**
     * @Column(type="date", nullable=false, column="adddate")
     */
    public $adddate;
     
    /**
     * @Column(type="date", nullable=false, column="modifydate")
     */
    public $modifydate;
     
    /**
     * @Column(type="date", nullable=false, column="publishdate")
     */
    public $publishdate;
     
    /**
     * @Column(type="date", nullable=false, column="expiredate")
     */
    public $expiredate;


    /**
     * Get the first category from the assigned categories
     * @return object
     */
    public function getMainCategory()
    {
        foreach($this->categories as $key=>$value)
        {
            if ($value->trash=='no' && $value->languagekey==$this->languagekey)
            {
                return $value;
                break;
            }
        }
    }  

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

    public function afterDelete()
    {
        // Clear articles cache (but first check if we have that service)
        if ($this->getDI()->has('modelsCache')) 
        {
            $this->getDI()->get('modelsCache')->flush();
        }
    }    
}