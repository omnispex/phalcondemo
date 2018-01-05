<?php
$router=new \Phalcon\Mvc\Router();
$router->removeExtraSlashes(true);
$router->setDefaults(
	array(
	    'controller' => 'index',
	    'action' => 'index'
	)
);

$router->add('', 
	array(
		'controller' => 'index',
		'action' => 'index'
	)
);

$router->add('/', 
	array(
		'controller' => 'index',
		'action' => 'index'
	)
);

$router->add('/index', 
	array(
		'controller' => 'index',
		'action' => 'index'
	)
);

$router->add('/welcome', 
	array(
		'controller' => 'index',
		'action' => 'index'
	)
);

$router->add('/welcome/', 
	array(
		'controller' => 'index',
		'action' => 'index'
	)
);

return $router;
