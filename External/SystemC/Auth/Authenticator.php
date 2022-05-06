<?php

namespace External\SystemC\Auth;

use External\SystemC\Auth\Responses\Failure;
use External\SystemC\Auth\Responses\Success;
use External\SystemC\Auth\Responses\IResponse;

class Authenticator
{
    /**
     * On success returns Success otherwise Failure.
     *
     * @param string $login
     * @param string $password
     *
     * @return IResponse
     */
    public function auth(string $login, string $password): IResponse
    {
        if (preg_match('/^SYS_C_.*/', $login, $matches)
            && $password === 'some-password')
        {
            return new Success();
        }

        return new Failure();
    }
}
