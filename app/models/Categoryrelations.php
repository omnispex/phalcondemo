<?php
/**
 * Categoryrelations
 *
 * Model Categoryrelations
 *
 * @Source('categoryrelations');
 * @belongsTo('categoryid','Categories','id', {'alias': 'category', 'reusable': true});
 * @belongsTo('relationid','Categories','id', {'alias': 'relation', 'reusable': true});
 */
class Categoryrelations extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", nullable=false, column="relationid", size="11")
     */
    public $relationid;
}