<?php
$website='/hosts/sites/phalcondemo/';
return new \Phalcon\Config(array(
    'db' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost:8889',
        'username'    => 'root',
        'password'    => 'root',
        'dbname'      => 'articles'
    ),
    'common' => array(
        'defaultLanguage' => 'en'
    ),
    'urls' => array(
        'websiteUrl'     => 'http://temp.localhost:8888',
    ),
    'website' => array(
        'controllersDir' => $website.'app/controllers/',
        'viewsDir'       => $website.'app/views/',
        'cacheDir'       => $website.'app/cache/',
        'layoutDir'      => $website.'app/layout/',
        'modelsDir'      => $website.'app/models/',
        'helpersDir'      => $website.'app/helpers/',
        'baseUri'        => '/'
    ),
));
