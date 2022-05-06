<?php

namespace External\SystemA\Auth;

class LoginService
{
    /**
     * Authenticates user. On success it returns true otherwise false.
     *
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function login(string $login, string $password): bool
    {
        if (preg_match('/^SYS_A_.*/', $login, $matches))
        {
            return $password === 'some-password';
        }

        return false;
    }
}
