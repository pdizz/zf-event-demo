<?php

namespace Authentication;

use Zend\Mvc\MvcEvent;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\MvcAuth\MvcAuthEvent;

class Module
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $shared   = $mvcEvent->getApplication()->getEventManager()->getSharedManager();

        $shared->attach(
            'Zend\Mvc\Application',
            MvcAuthEvent::EVENT_AUTHENTICATION,
            new CoinFlipListener(),
            1000
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