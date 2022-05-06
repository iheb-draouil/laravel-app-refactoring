<?php

namespace App\Services;

use Exception;

use App\Services\ExternalSystemAdapter\SystemAAdapter;
use App\Services\ExternalSystemAdapter\SystemBAdapter;
use App\Services\ExternalSystemAdapter\SystemCAdapter;

class BaseExternalService
{
    private $external_system_adapters;

    public function __construct(
        SystemAAdapter $system_a_adapter,
        SystemBAdapter $system_b_adapter,
        SystemCAdapter $system_c_adapter,
    ) {

        $adapters = collect([
            $system_a_adapter,
            $system_b_adapter,
            $system_c_adapter,
        ]);

        $unique_prefixes = $adapters
        ->map(fn($e) => $e->getPrefix())
        ->unique()
        ->count();

        if ($unique_prefixes < $adapters->count())
        {
            throw new Exception('Some of the supplied system adapters share the same prefix');
        }

        $this->external_system_adapters = $adapters;
    }

    protected function getExternalServiceAdapters()
    {
        return $this->external_system_adapters;
    }
}