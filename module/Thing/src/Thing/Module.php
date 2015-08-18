<?php
namespace Thing;

use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
//        $request = $mvcEvent->getRequest();
//        if (!$request instanceof \Zf\ContentNegotiation\Request) {
//            return;
//        }
//
//        $routeMatch = $mvcEvent->getRouter()->match($request);
//        if (!$routeMatch) {
//            return;
//        }
//
//        $routeName = $routeMatch->getMatchedRouteName();
//        if ('thing.rest.thing' !== $routeName) {
//            return;
//        }
//
        $hal = $mvcEvent->getApplication()->getServiceManager()->get('ViewHelperManager')->get('Hal');
        $hal->getEventManager()->attach(
            'renderEntity',
            [$this, 'onRenderEntity']
        );
    }

    public function onRenderEntity(EventInterface $event)
    {
        $halEntity = $event->getParam('entity');
        $link = new \ZF\Hal\Link\Link('search');
        $link->setUrl('http://www.google.com/?q=thing' . $halEntity->entity->getId());
        $halEntity->getLinks()->add($link);
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
}
