<?php

namespace Igorw\Craplog\Event;

class PostEvent
{
    public $post;

    public function __construct(array $post)
    {
        $this->post = $post;
    }
}
