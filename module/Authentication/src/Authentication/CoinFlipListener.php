<?php

namespace Authentication;

use ZF\MvcAuth\Identity\AuthenticatedIdentity;
use ZF\MvcAuth\Identity\GuestIdentity;
use ZF\MvcAuth\MvcAuthEvent;

class CoinFlipListener
{
    public function __invoke(MvcAuthEvent $event)
    {
        if ((bool) mt_rand(0, 1)) {
            return new AuthenticatedIdentity('User');
        }

        return false;
    }
}