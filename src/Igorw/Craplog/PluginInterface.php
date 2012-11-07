<?php

namespace Igorw\Craplog;

use Evenement\EventEmitterInterface;

interface PluginInterface
{
    function attachEvents(EventEmitterInterface $emitter);
}
