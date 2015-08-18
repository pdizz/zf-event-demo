<?php
namespace Thing\V1\Rest\OtherThing;

class OtherThingResourceFactory
{
    public function __invoke($services)
    {
        return new OtherThingResource();
    }
}
