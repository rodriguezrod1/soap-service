<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientsRequest;
use App\UseCases\Client\StoreUseCases;


class ClientsController extends Controller
{

    private $storeUseCases;

    public function __construct(StoreUseCases $storeUseCases)
    {
        $this->storeUseCases = $storeUseCases;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientsRequest $request)
    {
        try {
            $client = $this->storeUseCases->execute($request->validated());
            return $this->successResponse($client, 'Client registered successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e, 500);
        }
    }
}
