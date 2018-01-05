<?php
$loader=new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
	array(
		$config->website->controllersDir,
		$config->website->modelsDir,
		$config->website->helpersDir,
		$config->website->layoutDir
	)
)->register();
