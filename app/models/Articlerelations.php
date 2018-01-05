<?php
/**
 * Articlerelations
 *
 * Model Articlerelations
 *
 * @Source('articlerelations');
 * @belongsTo('articleid','Articles','id', {'alias': 'article', 'reusable': true});
 * @belongsTo('relationid','Articles','id', {'alias': 'relation', 'reusable': true});
 */
class Articlerelations extends \Phalcon\Mvc\Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false, column="id", size="11")
     */
    public $id;

    /**
     * @Column(type="integer", nullable=false, column="articleid", size="11")
     */
    public $articleid;
     
    /**
     * @Column(type="integer", nullable=false, column="relationid", size="11")
     */
    public $relationid;
}