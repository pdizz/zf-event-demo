<?php

namespace EventMapper;

use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $shared = $mvcEvent->getApplication()->getEventManager()->getSharedManager();
        $shared->attach(
            '*',
            '*',
            function (EventInterface $e) {
                echo get_class($e->getTarget()) . ' - ' . $e->getName() . PHP_EOL;
            },
            10000
        );
    }
}