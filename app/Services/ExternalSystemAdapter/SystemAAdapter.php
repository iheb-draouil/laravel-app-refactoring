<?php

namespace App\Services\ExternalSystemAdapter;

use External\SystemA\Resources\ResourceService;
use External\SystemA\Auth\LoginService;

class SystemAAdapter extends AbstractSystemAdapter
{
    protected string $prefix = 'SYS_A';
    
    public function __construct(LoginService $auth_service, ResourceService $resources_service)
    {
        $this->auth_service = $auth_service;
        $this->resources_service = $resources_service;
    }

    public function handleLogin(string $login, string $password): bool
    {
        return $this->auth_service->login($login, $password);
    }

    public function requestTitles(): array
    {
        return collect($this->resources_service->getTitles()['titles'])
        ->pluck('title')
        ->all();
    }
}