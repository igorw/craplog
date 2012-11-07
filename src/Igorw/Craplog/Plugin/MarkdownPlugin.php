<?php

namespace Igorw\Craplog\Plugin;

use dflydev\markdown\MarkdownParser;
use Evenement\EventEmitterInterface;
use Igorw\Craplog\Event\PostEvent;
use Igorw\Craplog\PluginInterface;

class MarkdownPlugin implements PluginInterface
{
    public function attachEvents(EventEmitterInterface $emitter)
    {
        $emitter->on('post.created', function (PostEvent $event) {
            $event->post['format'] = 'markdown';
        });

        $emitter->on('post.render', function (PostEvent $event) {
            if (isset($event->post['format']) && 'markdown' === $event->post['format']) {
                $parser = new MarkdownParser();
                $event->post['body'] = $parser->transformMarkdown($event->post['body']);
            }
        });
    }
}
