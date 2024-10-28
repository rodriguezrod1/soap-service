<?php

namespace App\UseCases\Client;

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

    public function store($request)
    {
        return $this->storeService->store($request);
    }
}
