<?php
error_reporting(E_ALL);
date_default_timezone_set('Europe/Amsterdam');
try
{
    $config=include __DIR__."/../app/config/settings.php";
    include __DIR__."/../app/config/loader.php";
    include __DIR__."/../app/config/services.php";
    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    $output=$application->handle()->getContent();
    echo $output;
}
catch (Phalcon\Exception $e)
{
    echo $e->getMessage();
}
catch (PDOException $e)
{
    echo $e->getMessage();
}