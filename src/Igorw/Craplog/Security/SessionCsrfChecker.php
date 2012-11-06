<?php

namespace Igorw\Craplog\Security;

use Igorw\Craplog\Session;

class SessionCsrfChecker
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function createToken()
    {
        return $this->session->id();
    }

    public function isValid($token)
    {
        return $this->session->id() === $token;
    }

    public function ensureIsValid($token)
    {
        if (!$this->isValid($token)) {
            throw new InvalidCsrfTokenException();
        }
    }
}
