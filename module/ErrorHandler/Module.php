<?php

namespace ErrorHandler;

use Zend\Mvc\MvcEvent;
use ZF\ApiProblem\ApiProblemResponse;

class Module
{
    /**
     * @var \Zend\Log\Logger
     */
    protected $logger;

    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $eventManager = $mvcEvent->getApplication()->getEventManager();
        $this->logger = $mvcEvent->getApplication()->getServiceManager()->get('Log\App');

        $eventManager->attach(
            MvcEvent::EVENT_FINISH,
            function(MvcEvent $event) {
                $response = $event->getParam('response');

                if (!$response instanceof ApiProblemResponse) {
                    return;
                }

                $this->logger->log(1, $response);
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

        $this->logger->log(1, $response);
    }
}