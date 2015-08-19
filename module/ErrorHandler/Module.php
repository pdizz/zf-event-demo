<?php

namespace ErrorHandler;

use Zend\Mvc\MvcEvent;
use ZF\ApiProblem\ApiProblemResponse;

class Module
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $eventManager = $mvcEvent->getApplication()->getEventManager();
        $logger = $mvcEvent->getApplication()->getServiceManager()->get('Log\App');

        $eventManager->attach(
            MvcEvent::EVENT_FINISH,
            function(MvcEvent $event) use ($logger) {
                $response = $event->getParam('response');

                if ($response instanceof ApiProblemResponse) {
                    $logger->log(1, $response);
                }
            }
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}