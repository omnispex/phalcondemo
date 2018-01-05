<?php
use Phalcon\Mvc\ModelInterface,
	Phalcon\DiInterface,
	Phalcon\Mvc\Model\MetaData,
	Phalcon\Db\Column;

/**
 * MetaDataInitializer
 * Intitialize the metadata of a model/controller and stores it
 */
class MetaDataInitializer
{

	/**
	 * Initializes the model's meta-data
	 * @param Phalcon\Mvc\ModelInterface $model
	 * @param Phalcon\DiInterface $di
	 * @return array
	 */
	public function getMetaData(ModelInterface $model, DiInterface $di)
	{

		$reflection = $di['annotations']->get($model);
		$properties = $reflection->getPropertiesAnnotations();
		if (!$properties) 
		{
			throw new Exception("There are no properties defined on the class");
		}

		$attributes=array();
		$nullables=array();
		$dataTypes=array();
		$dataTypesBind=array();
		$numericTypes=array();
		$primaryKeys=array();
		$nonPrimaryKeys=array();
		$identity=false;

		foreach ($properties as $name => $collection) 
		{
			if ($collection->has('Column')) 
			{
				$arguments=$collection->get('Column')->getArguments();
				if (isset($arguments['column'])) 
				{
					$columnName=$arguments['column'];
				} 
				else 
				{
					$columnName=$name;
				}
				if (isset($arguments['type'])) 
				{
					switch ($arguments['type']) 
					{
                        case 'integer':
                            $dataTypes[$columnName] = Column::TYPE_INTEGER;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_INT;
                            $numericTypes[$columnName] = true;
                            break;
                        case 'string':
                            $dataTypes[$columnName] = Column::TYPE_VARCHAR;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
                            break;
                        case 'text':
                            $dataTypes[$columnName] = Column::TYPE_TEXT;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
                            break;
                        case 'decimal':
                            $dataTypes[$columnName] = Column::TYPE_DECIMAL;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_DECIMAL;
                            break;                          
                        case 'enum':
                            $dataTypes[$columnName] = Column::TYPE_VARCHAR;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
                            break;                        
                        case 'boolean':
                            $dataTypes[$columnName] = Column::TYPE_BOOLEAN;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_BOOL;
                            break;
                        case 'date':
                            $dataTypes[$columnName] = Column::TYPE_DATE;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
                            break;
                        case 'time':
                            $dataTypes[$columnName] = Column::TYPE_VARCHAR;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
                            break;                      
                        case 'datetime':
                            $dataTypes[$columnName] = Column::TYPE_DATETIME;
                            $dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
                            break;
					}
				} 
				else 
				{
					$dataTypes[$columnName] = Column::TYPE_VARCHAR;
					$dataTypesBind[$columnName] = Column::BIND_PARAM_STR;
				}

				if (!$collection->has('Identity')) 
				{
					if (isset($arguments['nullable'])) 
					{
						if (!$arguments['nullable']) 
						{
							$nullables[] = $columnName;
						}
					}
				}
				$attributes[] = $columnName;

				if ($collection->has('Primary')) 
				{
					$primaryKeys[] = $columnName;
				} 
				else 
				{
					$nonPrimaryKeys[] = $columnName;
				}
				if ($collection->has('Identity')) {
					$identity = $columnName;
				}

			}

		}

		return array(
            MetaData::MODELS_ATTRIBUTES => $attributes,
            MetaData::MODELS_PRIMARY_KEY => $primaryKeys,
            MetaData::MODELS_NON_PRIMARY_KEY => $nonPrimaryKeys,
            MetaData::MODELS_NOT_NULL => $nullables,
            MetaData::MODELS_DATA_TYPES => $dataTypes,
            MetaData::MODELS_DATA_TYPES_NUMERIC => $numericTypes,
            MetaData::MODELS_IDENTITY_COLUMN => $identity,
            MetaData::MODELS_DATA_TYPES_BIND => $dataTypesBind,
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => array(),
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => array()
        );
	}

	/**
	 * Initializes the model's column map
	 *
	 * @param Phalcon\Mvc\ModelInterface $model
	 * @param Phalcon\DiInterface $di
	 * @return array
	 */
	public function getColumnMaps(ModelInterface $model, DiInterface $di)
	{
		$reflection=$di['annotations']->get($model);
		$columnMap=array();
		$reverseColumnMap=array();
		$renamed=false;
		foreach ($reflection->getPropertiesAnnotations() as $name => $collection) 
		{
			if ($collection->has('Column')) 
			{
				$arguments=$collection->get('Column')->getArguments();
				if (isset($arguments['column'])) 
				{
					$columnName=$arguments['column'];
				} 
				else 
				{
					$columnName=$name;
				}

				$columnMap[$columnName]=$name;
				$reverseColumnMap[$name]=$columnName;

				if (!$renamed) 
				{
					if ($columnName !=$name) 
					{
						$renamed=true;
					}
				}
			}
		}
		if ($renamed) 
		{
			return array(
				MetaData::MODELS_COLUMN_MAP => $columnMap,
				MetaData::MODELS_REVERSE_COLUMN_MAP => $reverseColumnMap
			);
		}
		return null;
	}
}