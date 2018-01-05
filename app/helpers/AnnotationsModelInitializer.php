<?php
use Phalcon\Events\Event,
	Phalcon\Mvc\Model\Manager as ModelsManager;

/**
 * AnnotationsModelInitializer
 * Intitialize the model structure and stores it
 */
class AnnotationsModelInitializer extends Phalcon\Mvc\User\Plugin
{
	/**
	 * This is called after initialize the model
	 * @param Phalcon\Events\Event $event
     * @param Phalcon\Mvc\Model\Manager $manager
     * @param object $model
	 */
	public function afterInitialize(Event $event, ModelsManager $manager, $model)
	{
		$reflector = $this->annotations->get($model);
		$annotations = $reflector->getClassAnnotations();
		if ($annotations) 
		{
			foreach ($annotations as $annotation) 
			{
				switch ($annotation->getName()) 
				{
					case 'Source':
						$arguments = $annotation->getArguments();
						$manager->setModelSource($model, $arguments[0]);
						break;

					case 'hasOne':
						$arguments = $annotation->getArguments();
						$manager->addHasOne($model, $arguments[0], $arguments[1], $arguments[2]);
						break;

					case 'hasMany':
						$arguments = $annotation->getArguments();
						$manager->addHasMany($model, $arguments[0], $arguments[1], $arguments[2]);
						break;

					case 'hasManyToMany':
						$arguments = $annotation->getArguments();
						$manager->addHasManyToMany($model, $arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5], $arguments[6]);
						break;

					case 'belongsTo':
						$arguments = $annotation->getArguments();
						if (isset($arguments[3])) 
						{
							$manager->addBelongsTo($model, $arguments[0], $arguments[1], $arguments[2], $arguments[3]);
						} 
						else 
						{
							$manager->addBelongsTo($model, $arguments[0], $arguments[1], $arguments[2]);
						}
						break;

				}
			}
		}
	}
}