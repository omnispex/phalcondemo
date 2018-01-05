<?php
/**
 * Categoryarticles
 *
 * Model Categoryarticles
 *
 * @Source('categoryarticles');
 * @belongsTo('categoryid','Categories','id', {'alias': 'category', 'reusable': true});
 * @belongsTo('articleid','Articles','id', {'alias': 'article', 'reusable': true});
 */
class Categoryarticles extends \Phalcon\Mvc\Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false, column="id", size="11")
     */
    public $id;
    
    /**
     * @Column(type="integer", nullable=false, column="categoryid", size="11")
     */
    public $categoryid;
     
    /**
     * @Column(type="integer", nullable=false, column="articleid", size="11")
     */
    public $articleid;
}