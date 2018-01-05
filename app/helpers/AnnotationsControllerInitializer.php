<?php
use Phalcon\Events\Event, 
    Phalcon\Mvc\Dispatcher, 
    Phalcon\Mvc\User\Plugin;
/**
 * AnnotationsControllerInitializer
 * Intitialize the controller structure and stores it
 */
class AnnotationsControllerInitializer extends Plugin
{
    /**
     * This event is executed before every route is executed in the dispatcher
     * @param Phalcon\Events\Event $event
     * @param Phalcon\Mvc\Dispatcher $dispatcher
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $annotations=$this->annotations->getMethod(
            $dispatcher->getControllerClass(),
            $dispatcher->getActiveMethod()
        );
        if ($annotations->has('Cache')) 
        {
            $annotation=$annotations->get('Cache');
            $lifetime=$annotation->getNamedParameter('lifetime');
            $options=array('lifetime' => $lifetime);
            if ($annotation->hasNamedParameter('key')) 
            {
                $options['key']=$annotation->getNamedParameter('key');
            }
            $this->view->cache($options);
        }
    }
}