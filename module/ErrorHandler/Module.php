<?php

namespace ErrorHandler;

use Zend\Mvc\MvcEvent;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class Module
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $eventManager = $mvcEvent->getApplication()->getEventManager();

        $eventManager->attach(
            MvcEvent::EVENT_FINISH,
            function(MvcEvent $event) {
                $response = $event->getParam('response');

                if (!$response instanceof ApiProblemResponse) {
                    return;
                }

                $response = new ApiProblemResponse(new ApiProblem(500, 'An unexpected exception occurred.'));
                $event->setResponse($response);
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

    public function onException(MvcEvent $event) {
        $response = $event->getParam('response');

        if (!$response instanceof ApiProblemResponse) {
            return;
        }

        $response = new ApiProblemResponse(new ApiProblem(500, 'An unexpected exception occurred.'));
        $event->setResponse($response);
    }
}