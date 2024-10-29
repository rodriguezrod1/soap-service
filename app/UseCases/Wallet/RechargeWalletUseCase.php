<?php

namespace App\UseCases\Wallet;

use App\Services\Client\FindClientByDocumentAndPhoneService;
use App\Services\Wallet\RechargeWalletService;

class RechargeWalletUseCase
{
    protected $clientService;
    protected $walletService;

    public function __construct(FindClientByDocumentAndPhoneService $clientService, RechargeWalletService $walletService)
    {
        $this->clientService = $clientService;
        $this->walletService = $walletService;
    }


    public function execute($request)
    {
        $client = $this->clientService->findClientByDocumentAndPhone($request->document, $request->phone);
        if (!$client) {
            throw new \Exception('Client not found');
        }
        $this->walletService->rechargeWallet($client, $request->amount);
        return $client;
    }
}
