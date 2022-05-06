<?php

namespace External\SystemB\Auth;

use External\SystemB\Exceptions\AuthenticationFailedException;

class AuthWS
{
    /**
     * On success returns nothing otherwise it throws an exception.
     *
     * @param string $login
     * @param string $password
     *
     * @throws AuthenticationFailedException
     * @return void
     */
    public function authenticate(string $login, string $password): void
    {
        if (preg_match('/^SYS_B_.*/', $login, $matches)
            && $password === 'some-password')
        {
            return;
        }

        throw new AuthenticationFailedException();
    }
}
