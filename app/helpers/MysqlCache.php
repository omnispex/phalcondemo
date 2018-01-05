<?php
/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/
use Phalcon\Kernel;
/**
 * Fetches all the data in a result providing a serializable resultset
 */
class SerializeQuery
{
    protected $data=[];
    protected $position=0;

    /**
     * Class constructor.
     * The resultset is completely fetched
     * @param mixed $result
     */
    public function __construct($result)
    {
        $this->data=$result->fetchAll();
    }

    /**
     * Returns the number of rows in the internal array
     *
     * @return integer
     */
    public function numRows()
    {
        return count($this->data);
    }

    /**
     * Fetches a row in the resultset
     *
     * @return array|boolean
     */
    public function fetch()
    {
        if (!isset($this->data[$this->position]))
        {
            return false;
        }
        return $this->data[$this->position++];
    }
    /**
     * Changes the fetch mode, this is not implemented yet
     *
     * @param int $fetchMode
     */
    public function setFetchMode(int $fetchMode)
    {
    }

    /**
     * Returns the full data in the resultset
     *
     * @return array
     */
    public function fetchAll()
    {
        return $this->data;
    }

    /**
     * Resets the internal pointer
     */
    public function __wakeup()
    {
        $this->position=0;
    }
}

/**
 * Every query executed via this adapter is automatically cached
 */
class MysqlCache extends Phalcon\Db\Adapter\Pdo\Mysql
{
    /**
     * Class constructor avoids the automatic connection.
     *
     * @param array $descriptor
     */
    public function __construct($descriptor)
    {
        $this->_descriptor=$descriptor;
        $this->_dialect=new Phalcon\Db\Dialect\Mysql();
    }

    /**
     * Sets a handler to cache the data
     *
     * @param \Phalcon\Cache\BackendInterface $cache
     */
    public function setCache($cache)
    {
        $this->_cache=$cache;
    }

    /**
     * The queries executed are stored in the cache
     *
     * @param mixed  $sqlStatement
     * @param mixed  $bindParams
     * @param mixed  $bindTypes
     * @return SerializeQuery
     */
    public function query($sqlStatement,$bindParams=null,$bindTypes=null)
    {
        /**
         * The key is the full sql statement + its parameters
         */
        if (is_array($bindParams))
        {
            $key = \Phalcon\Kernel::preComputeHashKey($sqlStatement . '//' . join('|', $bindParams));
        }
        else
            {
            $key = \Phalcon\Kernel::preComputeHashKey($sqlStatement);
        }
        if ($this->_cache->exists($key))
        {
            $value=$this->_cache->get($key);
            if (!is_null($value))
            {
                return $value;
            }
        }
        $this->internalConnect();
        $data=parent::query($sqlStatement,$bindParams,$bindTypes);
        if (is_object($data))
        {
            $result=new SerializeQuery($data);
            $this->_cache->save($key,$result);
            return $result;
        }
        $this->_cache->save($key,$data);
        return false;
    }

    /**
     * Executes the SQL statement without caching
     *
     * @param mixed $sqlStatement
     * @param array $bindParams
     * @param array $bindTypes
     * @return boolean
     */
    public function execute($sqlStatement,$bindParams=null,$bindTypes=null)
    {
        $this->internalConnect();
        return parent::execute($sqlStatement,$bindParams,$bindTypes);
    }

    /**
     * Checks if a table exists
     *
     * @param mixed $tableName
     * @param mixed $schemaName
     * @return boolean
     */
    public function tableExists($tableName,$schemaName=null)
    {
        $this->internalConnect();
        return parent::tableExists($tableName,$schemaName);
    }

    /**
     * Checks if exist an active connection, if not, makes a connection
     */
    protected function internalConnect()
    {
        if (!$this->_pdo)
        {
            $this->connect();
        }
    }
}
