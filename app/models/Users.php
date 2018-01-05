<?php
/**
 * Users
 *
 * Model Users
 *
 * @Source('users');
 */
class Users extends \Phalcon\Mvc\Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false, column="id", size="11")
     */
    public $id;

    /**
     * @Column(type="integer", nullable=false, column="roleid", size="11")
     */
    public $roleid;
     
    /**
     * @Column(type="string", nullable=false, column="languagekey", size="3")
     */
    public $languagekey;
     
    /**
     * @Column(type="string", nullable=false, column="username", size="30")
     */
    public $username;
     
    /**
     * @Column(type="string", nullable=false, column="password", size="30")
     */
    public $password;
     
    /**
     * @Column(type="string", nullable=false, column="realname", size="100")
     */
    public $realname;
     
    /**
     * @Column(type="string", nullable=false, column="emailaddress", size="100")
     */
    public $emailaddress;
     
    /**
     * @Column(type="enum", nullable=false, column="trash", size="3")
     */
    public $trash;

}