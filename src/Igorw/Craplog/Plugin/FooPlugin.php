<?php

namespace Igorw\Craplog\Plugin;

use Evenement\EventEmitterInterface;
use Igorw\Craplog\PluginInterface;

class FooPlugin implements PluginInterface
{
    public function attachEvents(EventEmitterInterface $emitter)
    {
        $emitter->on('foo', function () {
            echo 'bar!';
        });
    }
}
