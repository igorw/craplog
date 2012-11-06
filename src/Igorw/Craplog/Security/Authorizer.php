<?php

namespace Igorw\Craplog\Security;

class Authorizer
{
    public function hasRole($user, $role)
    {
        return in_array($role, $user['roles']);
    }

    public function ensureHasRole($user, $role)
    {
        if (!in_array($role, $user['roles'])) {
            throw new NotAuthorizedException();
        }
    }
}
