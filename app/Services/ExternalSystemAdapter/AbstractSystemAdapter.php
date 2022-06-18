<?php

namespace App\Services\ExternalSystemAdapter;

use Exception;

abstract class AbstractSystemAdapter
{
    protected string $prefix;
    
    public $auth_service;
    public $resources_service;

    public function getPrefix(): string
    {
        if ($this->prefix === null) {
            throw new Exception("A system adapter must set the 'prefix' field.");
        }

        if ($this->prefix == '') {
            throw new Exception("A system adapter 'prefix' field cannot be an empty string.");
        }

        return $this->prefix;
    }
    
    public abstract function handleLogin(string $login, string $password): bool;
    public abstract function requestTitles(): array;
}