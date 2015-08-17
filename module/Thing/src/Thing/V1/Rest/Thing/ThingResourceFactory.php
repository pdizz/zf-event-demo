<?php
namespace Thing\V1\Rest\Thing;

class ThingResourceFactory
{
    public function __invoke($services)
    {
        return new ThingResource();
    }
}
