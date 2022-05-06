<?php

namespace App\Services\ExternalSystemAdapter;

use External\SystemC\Auth\Responses\Success;
use External\SystemC\Resources\ResourceService;
use External\SystemC\Auth\Authenticator;

class SystemCAdapter extends AbstractSystemAdapter
{
    protected string $prefix = 'SYS_C';

    public function __construct(Authenticator $auth_service, ResourceService $resources_service)
    {
        $this->auth_service = $auth_service;
        $this->resources_service = $resources_service;
    }

    public function handleLogin(string $login, string $password): bool
    {
        $result = $this->auth_service->auth($login, $password);
        
        if ($result instanceof Success)
        {
            return true;
        }

        return false;
    }

    public function requestTitles(): array
    {
        return $this->resources_service->getTitles()['titles'];
    }
}