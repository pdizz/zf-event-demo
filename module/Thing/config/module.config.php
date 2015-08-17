<?php
return array(
    'router' => array(
        'routes' => array(
            'thing.rest.thing' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/thing[/:thing_id]',
                    'defaults' => array(
                        'controller' => 'Thing\\V1\\Rest\\Thing\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'thing.rest.thing',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Thing\\V1\\Rest\\Thing\\ThingResource' => 'Thing\\V1\\Rest\\Thing\\ThingResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Thing\\V1\\Rest\\Thing\\Controller' => array(
            'listener' => 'Thing\\V1\\Rest\\Thing\\ThingResource',
            'route_name' => 'thing.rest.thing',
            'route_identifier_name' => 'thing_id',
            'collection_name' => 'thing',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Thing\\V1\\Rest\\Thing\\ThingEntity',
            'collection_class' => 'Thing\\V1\\Rest\\Thing\\ThingCollection',
            'service_name' => 'Thing',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Thing\\V1\\Rest\\Thing\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Thing\\V1\\Rest\\Thing\\Controller' => array(
                0 => 'application/vnd.thing.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Thing\\V1\\Rest\\Thing\\Controller' => array(
                0 => 'application/vnd.thing.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Thing\\V1\\Rest\\Thing\\ThingEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'thing.rest.thing',
                'route_identifier_name' => 'thing_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'Thing\\V1\\Rest\\Thing\\ThingCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'thing.rest.thing',
                'route_identifier_name' => 'thing_id',
                'is_collection' => true,
            ),
        ),
    ),
);
