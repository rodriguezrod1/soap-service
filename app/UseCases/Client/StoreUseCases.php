<?php

namespace App\UseCases\Client;

use App\Http\Resources\Client\StoreResource;
use App\Services\Client\StoreService;

class StoreUseCases
{

    private $storeService;

    /**
     * Create a new class instance.
     */
    public function __construct(
        StoreService $storeService
    ) {
        $this->storeService = $storeService;
    }

    public function execute($request)
    {
        $response =  $this->storeService->execute($request);
        return new StoreResource($response);
    }
}
