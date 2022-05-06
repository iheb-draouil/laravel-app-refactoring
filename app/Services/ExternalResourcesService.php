<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

use Exception;
use Closure;

use App\Services\ExternalSystemAdapter\SystemAAdapter;
use App\Services\ExternalSystemAdapter\SystemBAdapter;
use App\Services\ExternalSystemAdapter\SystemCAdapter;

use App\AppModel\ServiceFailureResponse;
use App\AppModel\ServiceSuccessResponse;
use App\AppModel\ServiceResponse;

class ExternalResourcesService extends BaseExternalService
{
    private $max_attempt_count;

    public function __construct(
        SystemAAdapter $system_a_adapter,
        SystemBAdapter $system_b_adapter,
        SystemCAdapter $system_c_adapter,
        int $max_attempt_count = 10,
    ) {
        parent::__construct($system_a_adapter, $system_b_adapter, $system_c_adapter);
        $this->max_attempt_count = $max_attempt_count;
    }

    private function requestResource(Closure $service_call, string $service_token)
    {
        for ($i = 0; $i < $this->max_attempt_count; $i++) {
            
            try {
                $result = $service_call();
                Cache::put($service_token, $result, 900);
                return new ServiceSuccessResponse($result);
            }

            catch (Exception) { }

        }

        if (Cache::has($service_token)) {
            return new ServiceSuccessResponse(Cache::get($service_token));
        }

        return new ServiceFailureResponse();
    }

    public function getTitles(): ServiceResponse
    {
        $titles = [];

        foreach ($this->getExternalServiceAdapters() as $adapter)
        {
            $request_result = $this->requestResource(
                fn() => $adapter->requestTitles(),
                $adapter->getPrefix(),
            );

            if ($request_result instanceof ServiceFailureResponse)
            {
                return $request_result;
            }

            $titles = [...$titles, ...$request_result->getData()];
        }

        return new ServiceSuccessResponse($titles);
    }
}