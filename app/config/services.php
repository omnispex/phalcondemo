<?php
use Phalcon\DI\FactoryDefault,
	Phalcon\Mvc\View,
	Phalcon\Mvc\Dispatcher as Dispatcher,
	Phalcon\Mvc\Url as UrlResolver,
	Phalcon\Flash\Direct,
	Phalcon\Events\Manager as EventsManager,
	Phalcon\Mvc\Model\Manager as ModelsManager,
	Phalcon\Mvc\Model\MetaData\Files as MetaDataAdapter,
	Phalcon\Mvc\Model\MetaData\Strategy\Annotations as StrategyAnnotations,
	Phalcon\Annotations\Adapter\Files as AnnotationsAdapter,
	Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,	
	Phalcon\Mvc\View\Engine\Volt as VoltEngine,	
	Phalcon\Cache\Frontend\Data as FrontendData,
	Phalcon\Cache\Backend\File,
    Pdo;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di=new FactoryDefault();
$di->set('config',$config);

/**
 * Dispatcher
 */
$di->set('dispatcher',function() 
{
    $eventsManager=new EventsManager();
    $eventsManager->attach("dispatch:beforeException",function($event,$dispatcher,$exception) 
    {
        if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) 
        {
            $dispatcher->forward(array(
                'controller' => 'index',
                'action' => 'error'
            ));
            return false;
        }
    });
    $eventsManager->attach('dispatch',new AnnotationsControllerInitializer());
    $dispatcher=new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
},true);

/**
 * Define where annotations are stored
 */
$di->set('annotations',function() use ($config)
{
	return new AnnotationsAdapter(array(
		'annotationsDir' => $config->website->cacheDir.'annotations/'
	));
});

/**
 * The URL component is used to generate all kind of urls in the website application
 */
$di->set('url',function() use ($config) 
{
	$url=new UrlResolver();
	$url->setBaseUri($config->website->baseUri);
	return $url;
},true);

/**
 * The Layout component is used to generate the pase path of the layout files (css/js) for your asset manager
 */
$di->set('layout',function() use ($config) 
{
	$layout=$config->website->layoutDir;
	return $layout;
},true);

/**
 * Setting up the view component
 */
$di->set('view',function() use ($config) 
{
	$view=new View();
	$view->setViewsDir($config->website->viewsDir);
	$view->registerEngines(array(
		'.volt' => function($view,$di) use ($config) 
		{
			$volt=new VoltEngine($view,$di);
			$volt->setOptions(array(
				'compiledPath' => $config->website->cacheDir.'volt/',
				'compiledSeparator' => '_',
				'compiledExtension' => '.chf',
				'compileAlways' => false
			));
			$compiler=$volt->getCompiler();
			$compiler->addFunction('in_array','in_array');
			return $volt;
		}
	));
	return $view;
},true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db2',function() use ($config)
{
	return new DbAdapter(array(
		'host' => $config->db->host,
		'username' => $config->db->username,
		'password' => $config->db->password,
		'dbname' => $config->db->dbname
	));
});

$di->set('db',function() use ($config)
{
    $connection = new MysqlCache(array(
        'host' => $config->db->host,
        'username' => $config->db->username,
        'password' => $config->db->password,
        'dbname' => $config->db->dbname,
        'options' => [Pdo::ATTR_EMULATE_PREPARES => false]
    ));
    $frontCache = new FrontendData(array(
        'lifetime' => 2592000
    ));
    $backendOptions = array(
        'cacheDir' => $config->website->cacheDir.'db/'
    );
    $connection->setCache(new File($frontCache,$backendOptions));
    return $connection;

    //SQLSTATE[HY093]: Invalid parameter number
});

/**
 * Loading routes from the routes.php file
 */
$di->set('router',function() {
	return require __DIR__ . '/router.php';
});

/**
 * Register a user component
 */
$di->set('formfields',function()
{
	return new Formfields();
});

//Register the flash service with custom CSS classes
$di->set('flash',function()
{
    $flash=new Direct(array(
        'error' => 'row errormessage',
        'success' => 'row successmessage',
        'warning' => 'row warningmessage',
        'notice' => 'row noticemessage',
    ));
    $flash->setAutoescape(false);
    return $flash;
});

/**
 * The URL to the website itself
 */
$di->set('websiteurl',function() use ($config) 
{
	return $config->urls->websiteUrl;
},true);
