<?php

namespace Igorw\Painblog;

class Session
{
    public function init()
    {
        if (isset($_COOKIE[session_name()])) {
            $this->start();
        }
    }

    public function start()
    {
        session_start();
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public function set($name, $value)
    {
        $this->start();
        $_SESSION[$name] = $value;
    }

    public function destroy()
    {
        setcookie(session_name(), '', 0);
    }
}
