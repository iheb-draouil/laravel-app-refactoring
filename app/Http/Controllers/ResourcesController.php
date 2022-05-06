<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\AppModel\ServiceSuccessResponse;
use App\Services\ExternalResourcesService;

class ResourcesController extends Controller
{
    private $resource_service;

    public function __construct(ExternalResourcesService $resource_service)
    {
        $this->resource_service = $resource_service;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getTitles(): JsonResponse
    {
        $result = $this->resource_service->getTitles();

        if ($result instanceof ServiceSuccessResponse)
        {
            return response()->json($result->getData());
        }

        return response()->json([
            'status' => 'failure'
        ]);
    }
}
