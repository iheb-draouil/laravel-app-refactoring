<?php

namespace App\Services\ExternalSystemAdapter;

use External\SystemB\Exceptions\AuthenticationFailedException;
use External\SystemB\Resources\ResourceService;
use External\SystemB\Auth\AuthWS;

class SystemBAdapter extends AbstractSystemAdapter
{
    protected string $prefix = 'SYS_B';

    public function __construct(AuthWS $auth_service, ResourceService $resources_service)
    {
        $this->auth_service = $auth_service;
        $this->resources_service = $resources_service;
    }

    public function handleLogin(string $login, string $password): bool
    {
        try {
            $this->auth_service->authenticate($login, $password);
            return true;
        }

        catch (AuthenticationFailedException $e) {
            return false;
        }
    }

    public function requestTitles(): array
    {
        return $this->resources_service->getTitles();
    }
}