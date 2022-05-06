<?php

namespace External\SystemB\Exceptions;

use Exception;

class AuthenticationFailedException extends Exception
{
    protected $message = 'Authentication failed';
}
