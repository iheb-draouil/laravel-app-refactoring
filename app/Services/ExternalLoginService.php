<?php

namespace App\Services;

use Exception;

use App\Services\ExternalSystemAdapter\AbstractSystemAdapter;

use App\AppModel\ServiceSuccessResponse;
use App\AppModel\ServiceFailureResponse;
use App\AppModel\ServiceResponse;

class ExternalLoginService extends BaseExternalService
{
    public function verifyCredentials(string $login, string $password): ServiceResponse
    {
        $system_adapters = $this->getExternalServiceAdapters();

        $system_prefixes_union = $system_adapters
        ->map(fn(AbstractSystemAdapter $e) => $e->getPrefix())
        ->join('|');

        preg_match("/^($system_prefixes_union)_.*/", $login, $matches);

        if (count($matches) == 0)
        {
            return new ServiceFailureResponse();
        }

        foreach ($system_adapters as $adapter)
        {
            if ($adapter->getPrefix() == $matches[1])
            {
                if ($adapter->handleLogin($login, $password))
                {
                    return new ServiceSuccessResponse($adapter->getPrefix());
                }

                return new ServiceFailureResponse();
            }
        }

        throw new Exception("Attempted login from an unregistered system: prefix '{$matches[1]}'");
    }
}